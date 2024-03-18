<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none" >
    <div class="container-xl">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav flex-row order-md-last">
        <div class="d-none d-md-flex">
          <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode" data-bs-toggle="tooltip"
   data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler-icons.io/i/moon -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
          </a>
          <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode" data-bs-toggle="tooltip"
   data-bs-placement="bottom">
            <!-- Download SVG icon from http://tabler-icons.io/i/sun -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
          </a>
          <div class="nav-item dropdown d-none d-md-flex me-3">
            {{-- If you want to add notification in here --}}
          </div>
        </div>
        <div class="nav-item dropdown">
          <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
            <span class="avatar avatar-sm">
              <img src="{{ asset('/photo-user/'.Auth::user()->photo_profile)}}" alt="profile">
              @if(Auth::user()->status == "Active")
              <span class="badge bg-green badge-notification"></span>
              @elseif(Auth::user()->status == "Busy")
              <span class="badge bg-pink badge-notification"></span>
              @elseif(Auth::user()->status == "Offline")
              <span class="badge bg-secondary badge-notification"></span>
              @endif
            </span>
            <div class="d-none d-xl-block ps-2">
              <div>{{ Auth::user()->fullname }}</div>
              <div class="mt-1 small text-muted">
                @if(Auth::user()->id_role == 1)
                    Superadmin
                @elseif(Auth::user()->id_role == 2)
                    Admin
                @elseif(Auth::user()->id_role == 3)
                    Freelance
                @elseif(Auth::user()->id_role == 4)
                    <span class="text-red">Pro Freelance</span>
                @else
                    Status tidak dikenali
                @endif
            </div>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalStatus">Status</a>
            <a href="{{ route('workspace.settings', ['#tabs-activity-7']) }}" class="dropdown-item">Profile</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('workspace.settings') }}" class="dropdown-item">Settings</a>
            <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
            <div class="dropdown-divider"></div>
            {{-- upgrade to premium, make this button at button --}}
            @if (Auth::user()->id_role == 3)
            <a href="{{ route('workspace.subscriptions.upgradeshow') }}" class="dropdown-item" style="background-color: #003cbe; color:white; width: 100px; height:35px;">Upgrade to Premium</a>
            @endif
        </div>
        
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="col">
          <!-- Page pre-title -->
          <div class="page-pretitle">
            {{ $pretitle ?? "POLA | Kelola Proyek Freelance" }}
          </div>
          <h2 class="page-title">
            {{ isset($title) ? $title : 'POLA | Kelola Proyek Freelance' }}
          </h2>
        </div>
      </div>
    </div>
  </header>

  <div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="modalStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Change Status</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('workspace.dashboard.storeStatus', ['id' => Auth()->user()->id]) }}" method="POST">
            @csrf
            @method('PUT')
        
            <?php
                // Ambil nilai status dari database
                $userStatus = Auth::user()->status;
            ?>
        
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="status" id="statusActive" value="Active" {{ $userStatus == 'Active' ? 'checked' : '' }}>
                <label class="form-check-label h3" for="statusActive">
                    <i class="bi bi-circle-fill text-success me-2"></i> Active
                </label>
                <small class="text-muted">Available for communication</small>
            </div>
            <hr>
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="status" id="statusBusy" value="Busy" {{ $userStatus == 'Busy' ? 'checked' : '' }}>
                <label class="form-check-label h3" for="statusBusy">
                    <i class="bi bi-bell-fill text-danger me-2"></i> Busy (Do Not Disturb)
                </label>
                <small class="text-muted">Do not disturb mode enabled</small>
            </div>
            <hr>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="status" id="statusOffline" value="Offline" {{ $userStatus == 'Offline' ? 'checked' : '' }}>
                <label class="form-check-label h3" for="statusOffline">
                    <i class="bi bi-bell-slash-fill text-secondary me-2"></i> Offline
                </label>
                <small class="text-muted">Currently offline</small>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        
      </div>
      

      </div>
    </div>
  </div>