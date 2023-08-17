@extends('layouts.auth')

@section('content')
  <section class="bg-gray vh-100">
    <div class="container">
      <div class="row pt-5 justify-content-center">
        <div class="col-12 col-lg-6 my-auto mb-5 mb-lg-auto me-0">
          <div class="d-none d-lg-block">
            <h2>Connect, Share, and Learn with Discussr</h2>
            <p>
            <ul>
              <li>Need help? Seek guidance in the Discussions</li>
              <li>Seek assistance in the Discussions if you're facing challenges</li>
              <li>Share your knowledge by answering questions</li>
            </ul>
            </p>
          </div>
          <div class="d-block d-lg-none fs-4 text-center">
            Register your account within a minute. No cost involved.
          </div>
        </div>
        <div class="col-12 col-lg-3 h-100">
          <a href="#" class="nav-link mb-4 text-center">
            <img src="{{ asset('assets/images/logo_title_dark.png') }}" alt="Logo" class="h-64px">
          </a>
          <div class="card mb-5">
            <!-- ./Form -->
            <form action="{{ route('register.regist') }}" method="POST">
              @csrf
              <!-- ./Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="name@example.com"
                  class="form-control @error('email') is-invalid @enderror" autocomplete="off" autofocus />
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <!-- ./Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" id="password" placeholder="********"
                    class="form-control border-end-0 pe-0 rounded-0 rounded-start-0 @error('password') is-invalid @enderror" />
                  <span class="input-group-text bg-white border-start-0 pe-auto @error('password') border-danger rounded-end @enderror">
                    <a href="javascript:;" id="password-toggle">
                      <img src="{{ asset('assets/images/eye-slash.png') }}" alt="Password Toggle" id="password-toggle-img" />
                    </a>
                  </span>
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <!-- ./Username -->
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="johndoe114"
                  class="form-control @error('username') is-invalid @enderror" autocomplete="off" />
                @error('username')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
              <!-- ./RegisterButton -->
              <div class="mb-3 d-grid">
                <button type="submit" class="btn btn-dark rounded-2">Register</button>
              </div>
            </form>
            <!-- ./EndForm -->
          </div>
          <div class="text-center">
            Already have an account? <a href="{{ route('login') }}"><u>Log in</u></a>
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
