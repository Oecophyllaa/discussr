@extends('layouts.app')

@section('content')
  <section class="bg-gray pt-4 pb-5">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-4 mb-5 mb-lg-0">
          <div class="d-flex mb-4">
            <div class="avatar-wrapper rounded-circle overflow-hidden flex-shrink-0 me-4">
              <img src="{{ asset('assets/images/avatar.png') }}" alt="avatar" class="avatar">
            </div>
            <div>
              <div class="mb-4">
                <div class="fs-2 fw-bold mb-1 lh-1 text-break">
                  oecophylla
                </div>
                <div class="color-gray">
                  Member since 1 year ago
                </div>
              </div>
            </div>
          </div>
          <div>
            <input type="text" id="current-url" class="d-none" value="{{ request()->url() }}" />
            <a id="share-profile" class="btn btn-dark me-4" href="javascript:;">Share</a>
          </div>
        </div>
        <div class="col-12 col-lg-8">
          <!-- user-discussions -->
          <div class="mb-5">
            <h2 class="mb-3">My Discussions</h2>
            <div>
              <!-- threads-card -->
              <div class="card card-discussions">
                <div class="row">
                  <div class="col-12 col-lg-2 mb-1 mb-lg-0 d-flex flex-row flex-lg-column align-items-end">
                    <div class="text-nowrap me-2 me-lg-0">
                      3 Likes
                    </div>
                    <div class="text-nowrap color-gray">
                      10 Replies
                    </div>
                  </div>
                  <div class="col-12 col-lg-10">
                    <a href="#">
                      <h3>Lorem ipsum, dolor sit amet consectetur?</h3>
                    </a>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas tempore laborum excepturi. Sequi deleniti libero quidem suscipit
                      amet?
                      ...
                    </p>
                    <div class="row">
                      <div class="col me-1 me-lg-2">
                        <a href="#">
                          <span class="badge rounded-pill text-bg-light">Relationship</span>
                        </a>
                      </div>
                      <div class="col-5 col-lg-4">
                        <div class="avatar-sm-wrapper d-inline-block">
                          <a href="#" class="me-1">
                            <img src="{{ asset('assets/images/avatar-sm.png') }}" alt="small avatar" class="avatar rounded-circle">
                          </a>
                        </div>
                        <span class="fs-12px">
                          <a href="#" class="me-1 fw-bold">
                            Oecophylla
                          </a>
                          <span class="color-gray">2 hours ago</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- threads-card -->
              <div class="card card-discussions">
                <div class="row">
                  <div class="col-12 col-lg-2 mb-1 mb-lg-0 d-flex flex-row flex-lg-column align-items-end">
                    <div class="text-nowrap me-2 me-lg-0">
                      3 Likes
                    </div>
                    <div class="text-nowrap color-gray">
                      10 Replies
                    </div>
                  </div>
                  <div class="col-12 col-lg-10">
                    <a href="#">
                      <h3>Lorem ipsum, dolor sit amet consectetur?</h3>
                    </a>
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Quas tempore laborum excepturi. Sequi deleniti libero quidem suscipit
                      amet?
                      ...
                    </p>
                    <div class="row">
                      <div class="col me-1 me-lg-2">
                        <a href="#">
                          <span class="badge rounded-pill text-bg-light">Relationship</span>
                        </a>
                      </div>
                      <div class="col-5 col-lg-4">
                        <div class="avatar-sm-wrapper d-inline-block">
                          <a href="#" class="me-1">
                            <img src="{{ asset('assets/images/avatar-sm.png') }}" alt="small avatar" class="avatar rounded-circle">
                          </a>
                        </div>
                        <span class="fs-12px">
                          <a href="#" class="me-1 fw-bold">
                            Oecophylla
                          </a>
                          <span class="color-gray">2 hours ago</span>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- user-replies -->
          <div>
            <h2 class="mb-3">My Replies</h2>
            <div>
              <!-- replies-card -->
              <div class="card card-discussions">
                <div class="row align-items-center">
                  <div class="col-2 col-lg-1 text-center">
                    12
                  </div>
                  <div class="col">
                    <span>Replied to</span>
                    <span class="fw-bold text-primary">
                      <a href="#">
                        Lorem ipsum dolor sit amet, consectetur adipisicing?
                      </a>
                    </span>
                  </div>
                </div>
              </div>

              <!-- replies-card -->
              <div class="card card-discussions">
                <div class="row align-items-center">
                  <div class="col-2 col-lg-1 text-center">
                    12
                  </div>
                  <div class="col">
                    <span>Replied to</span>
                    <span class="fw-bold text-primary">
                      <a href="#">
                        Lorem ipsum dolor sit amet, consectetur adipisicing?
                      </a>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

<!-- share-profile-cta-alert -->
@push('after-script')
  <script>
    $(document).ready(function() {
      $('#share-profile').click(function() {
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
    })
  </script>
@endpush
