@extends('layouts.app')

@section('content')
  <section class="bg-gray pt-4 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-5">
          <form action="#" method="POST">
            <div class="d-flex flex-column flex-md-row mb-4">
              <!-- ./Avatar -->
              <div class="edit-avatar-wrapper mb-3 mb-md-0 mx-auto mx-md-0">
                <div class="avatar-wrapper rounded-circle overflow-hidden flex-shrink-0 me-4">
                  <img id="avatar" src="{{ asset('assets/images/avatar-white.png') }}" alt="avatar-image" />
                </div>
                <label for="picture" class="btn p-0 edit-avatar-show">
                  <img src="{{ asset('assets/images/edit-circle.png') }}" alt="Edit Avatar Icon">
                </label>
                <input type="file" class="d-none" id="picture" name="picture" accept="image/" />
              </div>
              <div>
                <!-- ./Username -->
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" id="username" autofocus />
                </div>
                <!-- ./Password -->
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" id="password" />
                  <div class="fs-12px color-gray">
                    Empty this if you don't want to change your password
                  </div>
                </div>
                <!-- ./Confirm-Password -->
                <div class="mb-3">
                  <label for="confirm-password" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" name="confirm-password" id="confirm-password" />
                  <div class="fs-12px color-gray">
                    Empty this if you don't want to change your password
                  </div>
                </div>
              </div>
            </div>
            <div>
              <button class="btn btn-dark me-4" type="submit">Save</button>
              <a href="">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('after-script')
  <script>
    $('#picture').on('change', function(e) {
      var output = $('#avatar');
      output.attr('src', URL.createObjectURL(e.target.files[0]));
      output.onload = function() {
        URL.revokeObjectURL(output.attr('src'));
      }
    });
  </script>
@endpush
