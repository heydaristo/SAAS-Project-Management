@extends('template')

@section('body')
<div class="col-md">
    <div class="card">
      <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#tabs-home-7" class="nav-link" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                  Billing</a>
              </li>
              <li class="nav-item" role="presentation">
                <a href="#tabs-home-7" class="nav-link" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
                  Plan</a>
              </li>
          <li class="nav-item" role="presentation">
            <a href="#tabs-home-7" class="nav-link" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l-2 0l9 -9l9 9l-2 0"></path><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path></svg>
              Business</a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
              Notification</a>
          </li>
          <li class="nav-item" role="presentation">
            <a href="#tabs-activity-7" class="nav-link active" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12h4l3 8l4 -16l3 8h4"></path></svg>
              Account & Security</a>
          </li>
        </ul>
      </div>
      <div class="card-body">
        <div class="tab-content">
          <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
            <h4>Home tab</h4>
            <div>Cursus turpis vestibulum, dui in pharetra vulputate id sed non turpis ultricies fringilla at sed facilisis lacus pellentesque purus nibh</div>
          </div>
          <div class="tab-pane" id="tabs-profile-7" role="tabpanel">
            <h4>Profile tab</h4>
            <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc amet, pellentesque id egestas velit sed</div>
          </div>
          <div class="tab-pane" id="tabs-activity-7" role="tabpanel">
            <div class="card-body">
                <h2 class="mb-4">My Account</h2>
                <div class="row align-items-center">
                  <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url({{Auth::user()->photo_profile}})"></span>
                  </div>

                  <div class="col-auto">
                    <form enctype="multipart/form-data" id="profileForm" action="{{route('workspace.settings.upload')}}" method="post" >
                        @csrf
                        <input name="photo_profile" type="file" id="actual-btn" hidden>
                        <label for="actual-btn" class="btn btn-primary">Upload</label>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
                
                  <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                      Delete avatar
                    </a></div>
                </div>
                <div class="row g-3 mt-3">
                    <form action="#" method="post">
                    <fieldset class="form-fieldset">
                    <div class="col-md">
                        <h3 class="card-title">Profile</h3>
                        <div class="form-label">Fullname</div>
                        <input type="text" class="form-control" value="Tabler">
                    </div>
                  <div class="col-md mt-3">
                        <div class="form-label">Profession</div>
                        <input type="text" class="form-control" value="560afc32">
                  </div>
                  <div class="col-md mt-3">
                        <div class="form-label">Experience Level</div>
                        <input type="text" class="form-control" value="Peimei, China">
                  </div>
                  <div class="col-md mt-3">
                    <div class="form-label">Organization</div>
                    <input type="text" class="form-control" value="Peimei, China">
              </div>
                  <div class="col-md mt-3">
                        <div class="form-label">Email</div>
                        <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
                        <input type="text" class="form-control" value="paweluna@howstuffworks.com">
                  </div>
                    {{-- add button --}}
                    <div class="col-md mt-3">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                </div>
                </fieldset>
                <h3 class="card-title mt-4">Password</h3>
                <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
                <div>
                  <a href="#" class="btn">
                    Set new password
                  </a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- add ajax --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
        $(document).ready(function(){
            $('#actual-btn').change(function(){
                // ajax
                // var formData = new FormData($('#profileForm')[0]);
                // $.ajax({
                //     url: '{{route('workspace.settings.upload')}}',
                //     type: 'post',
                //     data: formData,
                //     contentType: false,
                //     processData: false,
                //     success: function(response){
                //         console.log(formData);
                //     },
                //     error: function(error) {
                //         console.log(error);
                //     }
                // });
            });
        });

</script>

  @endsection