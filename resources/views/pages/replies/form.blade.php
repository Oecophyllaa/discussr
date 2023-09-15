@extends('layouts.app')

@section('content')
  <section class="bg-gary pt-4 pb-5">
    <div class="container">
      <div class="mb-5">
        <div class="d-flex align-items-center">
          <div class="d-flex">
            <div class="fs-2 fw-bold me-2 mb-0">
              Share Your Insight
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-lg-8 mb-5 mb-lg-0">
          <div class="card card-discussions mb-5">
            <div class="row">
              <div class="col-12">
                <!-- ./Answer-Form -->
                <form action="{{ route('answers.update', $answer->id) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">
                    <label for="answer" class="form-label">Help with a Solution</label>
                    <textarea class="form-control" id="answer" name="answer">{{ $answer->answer ?? old('answer') }}</textarea>
                  </div>
                  <div>
                    <button class="btn btn-dark me-4" type="submit">Submit</button>
                    <a href="{{ route('discussions.show', $answer->discussion->slug) }}">Cancel</a>
                  </div>
                </form>
                <!-- ./End-Answer-Form -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('after-script')
  <!-- summernote-config -->
  <script>
    $(document).ready(function() {
      $('#answer').summernote({
        placeholder: 'Your genius answer',
        tabSize: 2,
        height: 320,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link']],
          ['view', ['codeview', 'help']],
        ]
      });

      $('span.note-icon-caret').remove();
    });
  </script>
@endpush
