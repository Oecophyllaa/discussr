@extends('layouts.auth')

@section('content')
  <section class="bg-gray vh-100">
    <div class="container h-100 pt-5">
      <div class="row justify-content-center">
        <div class="col-12 col-lg-3">
          <a href="#" class="nav-link mb-5 text-center">
            <img class="h-50px" src="{{ asset('assets/images/logo_title_dark.png') }}" alt="Discussr Logo" />
          </a>

          <div class="card mb-5">
            <form action="" method="POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" placeholder="name@example.com" class="form-control" autocomplete="off" autofocus />
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" id="password" placeholder="********"
                    class="form-control border-end-0 pe-0 rounded-0 rounded-start-0" />
                  <span class="input-group-text bg-white border-start-0 pe-auto">
                    <a href="javascript:;" id="password-toggle">
                      <img src="{{ asset('assets/images/eye-slash.png') }}" alt="Password Toggle" id="password-toggle-img" />
                    </a>
                  </span>
                </div>
              </div>
              <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-dark rounded-2">Login</button>
              </div>
            </form>
          </div>
          <div class="text-center">
            Don't have an account? <a href="#" class="text-underline"><u>Sign Up</u></a>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('after-script')
  <script>
    let isPasswordRevealed = false;

    $('#password-toggle').on('click', function() {
      isPasswordRevealed = !isPasswordRevealed;

      if (isPasswordRevealed) {
        $('#password-toggle-img').attr('src', "{{ asset('assets/images/eye.png') }}");
        $('#password').attr('type', 'text');
      } else {
        $('#password-toggle-img').attr('src', "{{ asset('assets/images/eye-slash.png') }}");
        $('#password').attr('type', 'password');
      }
    })
  </script>
@endpush
