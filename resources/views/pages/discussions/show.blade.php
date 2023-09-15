@extends('layouts.app')

@section('content')
  <section class="bg-gray pt-4 pb-5">
    <div class="container">
      <!-- ./Breadcrumbs -->
      <div class="mb-5">
        <div class="d-flex align-items-center">
          <div class="d-flex">
            <div class="fs-2 fw-bold color-gray me-2 mb-0">Discussions</div>
            <div class="fs-2 fw-bold color-gray me-2 mb-0">&gt;</div>
          </div>
          <h2 class="mb-0">{{ $discussion->title }}</h2>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-lg-8 mb-5 mb-lg-0">
          <div class="card card-discussions mb-5">
            <div class="row">
              <!-- ./Discussion-Likes -->
              <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                <a id="discussion-like" href="javascript:;" data-liked="{{ $discussion->liked() }}">
                  <img src="{{ $discussion->liked() ? $likedImage : $likeImage }}" id="discussion-like-icon" alt="Like" class="like-icon mb-1">
                </a>
                <span id="discussion-like-count" class="fs-4 color-gray mb-1">{{ $discussion->likeCount }}</span>
              </div>
              <!-- ./Discussion-Details -->
              <div class="col-11">
                <div>
                  {!! $discussion->content !!}
                </div>
                <!-- ./Discussion-Categories -->
                <div class="mb-3">
                  <a href="{{ route('discussions.categories.show', $discussion->category->slug) }}">
                    <span class="badge rounded-pill text-bg-light">{{ $discussion->category->slug }}</span>
                  </a>
                </div>
                <div class="row align-items-start justify-content-between">
                  <!-- ./Action-Discussion-Button -->
                  <div class="col">
                    <!-- ./Share-Button -->
                    <span class="color-gray me-2">
                      <a href="javascript:;" id="share-discussion">
                        <small>Share</small>
                      </a>
                      <input type="text" value="{{ route('discussions.show', $discussion->slug) }}" id="current-url" class="d-none" />
                    </span>

                    @if ($discussion->user_id === auth()->id())
                      <!-- ./Edit-Button -->
                      <span class="color-gray me-2">
                        <a href="{{ route('discussions.edit', $discussion->slug) }}">
                          <small>Edit</small>
                        </a>
                      </span>

                      <!-- ./Delete-Button -->
                      <form action="{{ route('discussions.destroy', $discussion->slug) }}" method="POST" class="d-inline-block lh-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="color-gray btn p-0 lh-1" id="delete-discussion">
                          <small class="card-discussion-delete-btn">Delete</small>
                        </button>
                      </form>
                    @endif
                  </div>
                  <!-- ./Discussion-User -->
                  <div class="col-5 col-lg-3 d-flex">
                    <a href="#" class="card-discussions-show-avatar-wrapper flex-shrink-0 rounded-circle overflow-hidden me-1">
                      <img
                        src="{{ filter_var($discussion->user->picture, FILTER_VALIDATE_URL) ? $discussion->user->picture : Storage::url($discussion->user->picture) }}"
                        alt="{{ $discussion->user->username }}" class="avatar">
                    </a>
                    <div class="fs-12px lh-1">
                      <span class="text-dark">
                        <a href="#" class="fw-bold d-flex align-items-start text-break mb-1">
                          {{ $discussion->user->username }}
                        </a>
                      </span>
                      <span class="color-gray">{{ $discussion->created_at->diffForHumans() }}</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          @php
            $answerCount = $discussion->answers->count();
          @endphp
          <h3 class="mb-5">{{ $answerCount . ' ' . Str::plural('Answer', $answerCount) }}</h3>

          <div class="mb-5">
            @forelse ($discussionAnswers as $answer)
              <!-- ./Discussion-Answers -->
              <div class="card card-discussions">
                <div class="row">
                  <!-- ./Answer-Likes -->
                  <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                    <!-- ./Answer-Like-Icon-Button -->
                    <a href="javascript:;" data-id="{{ $answer->id }}" data-liked="{{ $answer->liked() }}"
                      class="answer-like d-flex flex-column justify-content-start align-items-center">
                      <img src="{{ $answer->liked() ? $likedImage : $likeImage }}" alt="like icon" class="answer-like-icon like-icon mb-1" />
                      <!-- ./Answer-Like-Counter -->
                      <span class="answer-like-count fs-4 color-gray mb-1">{{ $answer->likeCount }}</span>
                    </a>
                  </div>
                  <div class="col-11">
                    <!-- ./Answer-Details -->
                    <div>
                      {!! $answer->answer !!}
                    </div>
                    <div class="row align-items-end justify-content-end">
                      <div class="col">
                        @if ($answer->user_id === auth()->id())
                          <span class="color-gray me-2">
                            <a href="{{ route('answers.edit', $answer->id) }}">
                              <small>Edit</small>
                            </a>
                          </span>
                        @endif
                      </div>
                      <!-- ./Answer-User-Info -->
                      <div class="col-5 col-lg-3 d-flex">
                        <a href="#" class="card-discussions-show-avatar-wrapper flex-shrink-0 rounded-circle overflow-hidden me-1">
                          <img
                            src="{{ filter_var($answer->user->picture, FILTER_VALIDATE_URL) ? $answer->user->picture : Storage::url($answer->user->picture) }}"
                            alt="{{ $answer->user->username }}" class="avatar">
                        </a>
                        <div class="fs-12px lh-1">
                          <span class="{{ $answer->user->username === $discussion->user->username ? 'text-dark' : '' }}">
                            <a href="#" class="fw-bold d-flex align-items-start text-break mb-1">
                              {{ $answer->user->username }}
                            </a>
                          </span>
                          <span class="color-gray">22 minutes ago</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div class="card card-discussions">
                No response have been posted.
              </div>
            @endforelse

            {{ $discussionAnswers->links() }}
          </div>

          @auth
            <!-- ./Answer-Input -->
            <h3 class="mb-5">Your Response</h3>
            <div class="card card-discussions">
              <form action="{{ route('discussions.answer.store', $discussion->slug) }}" method="POST">
                @csrf
                <div class="mb-3">
                  <textarea name="answer" id="answer">{{ old('answer') }}</textarea>
                </div>
                <div>
                  <button class="btn btn-dark me-4" type="submit">Submit</button>
                </div>
              </form>
            </div>
          @endauth
          @guest
            <div class="fw-bold text-center">
              Please <a href="{{ route('login') }}" class="text-info">log in</a> or <a href="{{ route('register') }}" class="text-info">create an
                account</a> to participate in this discussion.
            </div>
          @endguest
        </div>

        <div class="col-12 col-lg-4">
          <div class="card">
            <h3>All Categories</h3>
            <div>
              @foreach ($categories as $category)
                <a href="{{ route('discussions.categories.show', $category->slug) }}">
                  <span class="badge rounded-pill text-bg-light">{{ $category->name }}</span>
                </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

<!-- ./Additional-Scripts -->
@push('after-script')
  <script>
    $(document).ready(function() {
      // Share Button
      $('#share-discussion').click(function() {
        let copyText = $('#current-url');

        copyText[0].select();
        copyText[0].setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.val());

        Swal.fire({
          icon: 'success',
          text: 'Link to this discussion copied successfuly',
          showConfirmButton: false,
          timer: 1500
        });
      });

      // Answer Summernote
      $('#answer').summernote({
        placeholder: 'Offer your insights here',
        tabSize: 2,
        height: 220,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']],
          ['view', ['codeview', 'help']],
        ],
      });
      $('span.note-icon-caret').remove();

      // Like Button
      $('#discussion-like').click(function() {
        var isLiked = $(this).data('liked');
        var likeRoute = isLiked ? '{{ route('discussions.unlike', $discussion->slug) }}' :
          '{{ route('discussions.like', $discussion->slug) }}';

        $.ajax({
          method: 'POST',
          url: likeRoute,
          data: {
            '_token': '{{ csrf_token() }}'
          }
        }).done(function(res) {
          if (res.status === 'success') {
            $('#discussion-like-count').text(res.data.likeCount);

            if (isLiked) {
              $('#discussion-like-icon').attr('src', '{{ $likeImage }}');
            } else {
              $('#discussion-like-icon').attr('src', '{{ $likedImage }}');
            }

            $('#discussion-like').data('liked', !isLiked);
          }
        });
      });

      // Delete Confirmation
      $('#delete-discussion').click(function(e) {
        if (!confirm('Delete this discussion?')) {
          e.preventDefault();
        }
      });

      // Answer Like
      $('.answer-like').click(function() {
        var $this = $(this);
        var id = $this.data('id');
        var isLiked = $this.data('liked');
        var likeRoute = isLiked ? '{{ url('') }}/answer/' + id + '/unlike' : '{{ url('') }}/answer/' + id + '/like';

        $.ajax({
          method: 'POST',
          url: likeRoute,
          data: {
            '_token': '{{ csrf_token() }}'
          }
        }).done(function(res) {
          if (res.status === 'success') {
            $this.find('.answer-like-count').text(res.data.likeCount);

            if (isLiked) {
              $this.find('.answer-like-icon').attr('src', '{{ $likeImage }}');
            } else {
              $this.find('.answer-like-icon').attr('src', '{{ $likedImage }}');
            }

            $this.data('liked', !isLiked);
          }
        });
      });
    });
  </script>
@endpush
