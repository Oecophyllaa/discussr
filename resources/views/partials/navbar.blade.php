<!-- ./Navbar -->
<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
  <div class="container flex justify-content-between">
    <a class="navbar-link" href="{{ route('home') }}">
      <img class="h-32px" src="{{ asset('assets/images/logo.png') }}" alt="Discussr Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse" id="navbarSupportedContent">
      <!-- ./Navbar-Menus -->
      <ul class="navbar-nav mx-0 mx-lg-3">
        <li class="nav-item d-block d-lg-none d-xl-block">
          <a class="nav-link {{ Route::currentRouteName() === 'home' ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Route::currentRouteName() === 'discussions.index' ? 'active' : '' }}"
            href="{{ route('discussions.index') }}">Discussions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-nowrap" href="{{ route('home') }}#about-us">About Us</a>
        </li>
      </ul>

      <!-- ./Search-Form -->
      <form class="d-flex w-100 me-4 my-2 my-lg-0" role="search" action="{{ route('discussions.index') }}" method="GET">
        <div class="input-group">
          <span class="input-group-text bg-white border-end-0">
            <img src="{{ asset('assets/images/magnifier.png') }}" alt="">
          </span>
          <input class="form-control border-start-0 ps-0" type="search" name="search" value="{{ $search ?? '' }}" placeholder="Search"
            aria-label="Search">
        </div>
      </form>

      <ul class="navbar-nav ms-auto my-2 my-lg-0">
        <!-- ./LogedIn -->
        @auth
          <li class="nav-item my-auto dropdown">
            <!-- ./Nav-Avatar -->
            <a class="nav-link p-0 d-flex align-items-center" href="javascript:;" data-bs-toggle="dropdown">
              <div class="avatar-nav-wrapper me-2">
                <img
                  src="{{ filter_var(auth()->user()->picture, FILTER_VALIDATE_URL) ? auth()->user()->picture : Storage::url(auth()->user()->picture) }}"
                  alt="{{ auth()->user()->username }}" class="avatar rounded-circle">
              </div>
              <span class="fw-bold">{{ auth()->user()->username }}</span>
            </a>
            <!-- ./Nav-Dropdown -->
            <ul class="dropdown-menu mt-2">
              <li>
                <a href="{{ route('users.show', auth()->user()->username) }}" class="dropdown-item">My Profile</a>
              </li>
              <li>
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="dropdown-item">Log out</button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
        <!-- ./Guest -->
        @guest
          <li class="nav-item my-auto">
            <a class="nav-link text-nowrap {{ Route::currentRouteName() === 'login' ? 'active' : '' }}" href="{{ route('login') }}">Log In</a>
          </li>
          <li class="nav-item ps-1 pe-0">
            <a class="btn btn-dark-primary" href="{{ route('register') }}">Sign Up</a>
          </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>
<!-- ./EndNavbar -->
