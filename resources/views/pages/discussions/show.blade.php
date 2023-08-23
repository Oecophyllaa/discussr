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
                <p>
                  {!! $discussion->content !!}
                </p>
                <!-- ./Discussion-Categories -->
                <div class="mb-3">
                  <a href="{{ route('discussions.categories.show', $discussion->category->slug) }}">
                    <span class="badge rounded-pill text-bg-light">{{ $discussion->category->slug }}</span>
                  </a>
                </div>
                <div class="row align-items-start justify-content-between">
                  <!-- share-discussion-cta -->
                  <div class="col">
                    <span class="color-gray me-2">
                      <a href="javascript:;" id="share-discussion">
                        <small>Share</small>
                      </a>
                      <input type="text" value="{{ route('discussions.show', $discussion->slug) }}" id="current-url" class="d-none" />
                    </span>
                  </div>
                  <!-- discussion-user -->
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

          <h3 class="mb-5">2 Answer</h3>

          <div class="mb-5">
            <!-- ./Discussion-Answers -->
            <div class="card card-discussions">
              <div class="row">
                <!-- reply-likes -->
                <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                  <a href="#">
                    <img src="{{ asset('assets/images/liked_alt.png') }}" alt="like icon" class="like-icon mb-1" />
                  </a>
                  <span class="fs-4 color-gray mb-1">3</span>
                </div>
                <div class="col-11">
                  <!-- reply-details -->
                  <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque dolorum quidem provident, neque ut aut. Lorem ipsum dolor sit.
                  </p>
                  <div class="row align-items-end justify-content-end">
                    <!-- reply-users -->
                    <div class="col-5 col-lg-3 d-flex">
                      <a href="#" class="card-discussions-show-avatar-wrapper flex-shrink-0 rounded-circle overflow-hidden me-1">
                        <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar" class="avatar">
                      </a>
                      <div class="fs-12px lh-1">
                        <span class="text-dark">
                          <a href="#" class="fw-bold d-flex align-items-start text-break mb-1">
                            Hyungmon
                          </a>
                        </span>
                        <span class="color-gray">22 minutes ago</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="card card-discussions">
              <div class="row">
                <div class="col-1 d-flex flex-column justify-content-start align-items-center">
                  <a href="#">
                    <img src="{{ asset('assets/images/like.png') }}" alt="like icon" class="like-icon mb-1" />
                  </a>
                  <span class="fs-4 color-gray mb-1">3</span>
                </div>
                <div class="col-11">
                  <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Itaque dolorum quidem provident, neque ut aut. Lorem ipsum dolor sit.
                  </p>
                  <div class="row align-items-end justify-content-end">
                    <div class="col-5 col-lg-3 d-flex">
                      <a href="#" class="card-discussions-show-avatar-wrapper flex-shrink-0 rounded-circle overflow-hidden me-1">
                        <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar" class="avatar">
                      </a>
                      <div class="fs-12px lh-1">
                        <span class="text-dark">
                          <a href="#" class="fw-bold d-flex align-items-start text-break mb-1">
                            Hyungmon
                          </a>
                        </span>
                        <span class="color-gray">22 minutes ago</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="fw-bold text-center">
            Please <a href="{{ route('login') }}" class="text-info">log in</a> or <a href="{{ route('register') }}" class="text-info">create an
              account</a> to participate in this discussion.
          </div>
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

<!-- share-cta-alert -->
@push('after-script')
  <script>
    $(document).ready(function() {
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
      })

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
        })
      });
    })
  </script>
@endpush
