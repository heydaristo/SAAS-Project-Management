@extends('template')

@section('body')
    <div class="col-md">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-home-7" class="nav-link active" data-bs-toggle="tab" aria-selected="true"
                            role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-receipt-2"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16l-3 -2l-2 2l-2 -2l-2 2l-2 -2l-3 2" />
                                <path d="M14 8h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5m2 0v1.5m0 -9v1.5" />
                            </svg>
                            Billing</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-home-7" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                            role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-timeline"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M4 16l6 -7l5 5l5 -6" />
                                <path d="M15 14m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M10 9m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M4 16m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                                <path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" />
                            </svg>
                            Plan</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-home-7" class="nav-link" data-bs-toggle="tab" aria-selected="true"
                            role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report-money"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M14 11h-2.5a1.5 1.5 0 0 0 0 3h1a1.5 1.5 0 0 1 0 3h-2.5" />
                                <path d="M12 17v1m0 -8v1" />
                            </svg>
                            Business</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-profile-7" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab"
                            tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-filled"
                                width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M14.235 19c.865 0 1.322 1.024 .745 1.668a3.992 3.992 0 0 1 -2.98 1.332a3.992 3.992 0 0 1 -2.98 -1.332c-.552 -.616 -.158 -1.579 .634 -1.661l.11 -.006h4.471z"
                                    stroke-width="0" fill="currentColor" />
                                <path
                                    d="M12 2c1.358 0 2.506 .903 2.875 2.141l.046 .171l.008 .043a8.013 8.013 0 0 1 4.024 6.069l.028 .287l.019 .289v2.931l.021 .136a3 3 0 0 0 1.143 1.847l.167 .117l.162 .099c.86 .487 .56 1.766 -.377 1.864l-.116 .006h-16c-1.028 0 -1.387 -1.364 -.493 -1.87a3 3 0 0 0 1.472 -2.063l.021 -.143l.001 -2.97a8 8 0 0 1 3.821 -6.454l.248 -.146l.01 -.043a3.003 3.003 0 0 1 2.562 -2.29l.182 -.017l.176 -.004z"
                                    stroke-width="0" fill="currentColor" />
                            </svg>
                            Notification</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a href="#tabs-activity-7" class="nav-link" data-bs-toggle="tab" aria-selected="false"
                            role="tab" tabindex="-1"><!-- Download SVG icon from http://tabler-icons.io/i/activity -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M3 12h4l3 8l4 -16l3 8h4"></path>
                            </svg>
                            Account & Security</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active show" id="tabs-home-7" role="tabpanel">
                        <h4>Home tab</h4>
                        <div>Cursus turpis vestibulum, dui in pharetra vulputate id sed non turpis ultricies fringilla at
                            sed facilisis lacus pellentesque purus nibh</div>
                    </div>
                    <div class="tab-pane" id="tabs-profile-7" role="tabpanel">
                        <h4>Profile tab</h4>
                        <div>Fringilla egestas nunc quis tellus diam rhoncus ultricies tristique enim at diam, sem nunc
                            amet, pellentesque id egestas velit sed</div>
                    </div>
                    <div class="tab-pane" id="tabs-activity-7" role="tabpanel">
                        <div class="card-body">
                            <h2 class="mb-4">My Account</h2>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <span class="avatar avatar-xl" id="previewAvatar">
                                        @if (Auth::user()->photo_profile)
                                            <img src="{{ asset('photo-user/' . Auth::user()->photo_profile) }}"
                                                alt="Preview Image"
                                                style="max-width: 100%; max-height: 100%; display: block;">
                                        @else
                                            <img src="{{ asset('photo-user/defaultphoto.jpg') }}" alt="Default Avatar"
                                                style="max-width: 100%; max-height: 100%; display: block;">
                                        @endif
                                    </span>
                                </div>

                                <div class="col-auto">
                                    <form enctype="multipart/form-data" id="profileForm"
                                        action="{{ route('workspace.settings.upload') }}" method="post">
                                        @csrf
                                        <input name="photo_profile" type="file" id="actual-btn" hidden
                                            accept="image/*">
                                        <label for="actual-btn" class="btn btn-primary">Change</label>
                                    </form>
                                </div>

                                <div class="col-auto">
                                    <form action="{{ route('workspace.settings.deleteProfile') }}" method="POST"
                                        id="deleteForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" id="deleteButton" class="btn btn-ghost-danger"
                                            onclick="deleteAvatar()">Delete Avatar</button>
                                    </form>
                                </div>
                            </div>
                            <div class="row g-3 mt-3">

                                <form action="{{ route('workspace.settings.update') }}" method="post" id="profileForm">
                                    @csrf
                                    <fieldset class="form-fieldset">
                                        <div class="col-md">
                                            <h3 class="card-title">Profile</h3>
                                            <div class="form-label">Fullname</div>
                                            <input type="text" class="form-control" name="fullname"
                                                value="{{ Auth::user()->fullname }}" required>
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">Address</div>
                                            <textarea class="form-control" name="address" rows="4" placeholder="Address..">{{ Auth::user()->address }}</textarea>
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">State</div>
                                            <input class="form-control" name="state" placeholder="State..." value="{{ Auth::user()->state }}">
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">Province</div>
                                            <input class="form-control" name="region" placeholder="Province..." value="{{ Auth::user()->region }}">
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">City</div>
                                            <input class="form-control" name="city" placeholder="City..." value="{{ Auth::user()->city }}">
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">Zip Code</div>
                                            <input type="number" class="form-control" name="postal_code" placeholder="Zip Code..." value="{{ Auth::user()->postal_code }}">
                                        </div>
                                        
                                        <div class="col-md mt-3">
                                            <div class="form-label">Profession</div>
                                            <select class="form-select" name="profession" required>
                                                <option value="{{ Auth::user()->profession }}">
                                                    {{ Auth::user()->profession }}</option>
                                                <option value="developer">Developer</option>
                                                <option value="consultant">Consultant</option>
                                                <option value="marketer">Marketer</option>
                                                <option value="photographer">Photographer</option>
                                                <option value="videographer">Videographer</option>
                                                <option value="designer">Designer</option>
                                                <option value="law">Law</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">Experience Level</div>
                                            <select class="form-select" name="experience_level" required>
                                                <option value="{{ Auth::user()->experience_level }}">
                                                    @if (Auth::user()->experience_level == 0)
                                                        Beginner (0-3 years)
                                                    @elseif (Auth::user()->experience_level == 1)
                                                        Intermediate (4-6 years)
                                                    @elseif (Auth::user()->experience_level == 2)
                                                        Expert (6+ years)
                                                    @endif
                                                </option>
                                                <option value="0">Beginner (0-3 years)</option>
                                                <option value="1">Intermediate (4-6 years)</option>
                                                <option value="2">Expert (6+ years)</option>
                                            </select>
                                        </div>
                                        <div class="col-md mt-3">
                                            <div class="form-label">Organization</div>
                                            <div class="mb-3">
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio" name="organization" value="I work solo" 
                                                        {{ Auth::user()->organization == 'I work solo' ? 'checked' : '' }}>
                                                    <span class="form-check-label">I work solo</span>
                                                </label>
                                                <label class="form-check">
                                                    <input class="form-check-input" type="radio" name="organization" value="I work team"
                                                        {{ Auth::user()->organization == 'I work team' ? 'checked' : '' }}>
                                                    <span class="form-check-label">I work on team</span>
                                                </label>
                                            </div>
                                            <div class="col-md mt-3">
                                                <div class="form-label">Email</div>
                                                <p class="card-subtitle">This contact will be shown to others publicly, so
                                                    choose it carefully.</p>
                                                <input type="email" class="form-control" name="email"
                                                    value="{{ Auth::user()->email }}" />
                                            </div>
                                            {{-- add button --}}
                                            <div class="col-md mt-3">
                                                <button type="submit" class="btn btn-primary"
                                                    id="saveButtonFormProfiles">Save</button>

                                            </div>
                                </form>
                            </div>
                            </fieldset>
                            <h3 class="card-title mt-4">Password</h3>
                            <p class="card-subtitle">You can set a permanent password if you don't want to use temporary
                                login codes.</p>
                            <div>
                                <a href="{{ route('workspace.settings.changepassword') }}" class="btn">
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        document.getElementById('actual-btn').addEventListener('change', function() {
            document.getElementById('profileForm').submit(); // Menyubmit formulir saat gambar dipilih
        });
        $(document).ready(function() {
            $('#actual-btn').change(function() {
                // ajax
                var formData = new FormData($('#profileForm')[0]);
                e.preventDefault();
                $.ajax({
                    url: '{{ route('workspace.settings.upload') }}',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(formData);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // $('#profileForm').on('submit', function(e){
            //     // ajax
            //     e.preventDefault();
            //     var formData = new FormData($('#profileForm')[0]);
            //     $.ajax({
            //         url: '{{ route('workspace.settings.update') }}',
            //         type: 'post',
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response){
            //             console.log(formData);
            //         },
            //         error: function(error) {
            //             console.log(error);
            //         }
            //     });
            // });
        });

        function updatePreview() {
            var input = document.getElementById('actual-btn');
            var preview = document.getElementById('previewAvatar');
            var maxSizeInBytes = 1048576; // 1MB

            while (preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            if (input.files && input.files[0]) {
                var reader = new FileReader();
                var fileSize = input.files[0].size;

                if (fileSize <= maxSizeInBytes) {
                    reader.onload = function(e) {
                        var img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '100%'; // Atur lebar maksimum gambar
                        img.style.maxHeight = '100%'; // Atur tinggi maksimum gambar
                        img.style.display = 'block'; // Menampilkan gambar sebagai blok
                        preview.appendChild(img);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    alert('Ukuran file melebihi batas maksimum (1MB). Silakan unggah gambar yang lebih kecil.');
                    input.value = ''; // Kosongkan input file untuk mencegah pengunggahan gambar yang melebihi batas
                }
            }
        }

        function deleteAvatar() {
            var preview = document.getElementById('previewAvatar');

            // Menghapus semua elemen anak dari elemen previewAvatar
            while (preview.firstChild) {
                preview.removeChild(preview.firstChild);
            }

            // Mengatur path gambar profil ke gambar default
            var defaultProfilePath = '/photo-profile/defaultProfile.png'; // Ganti dengan path default profile Anda
            preview.innerHTML = '<img src="' + defaultProfilePath +
                '" style="max-width: 100%; max-height: 100%; display: block;">';

            // Mengosongkan nilai input file
            document.getElementById('actual-btn').value = '';

            // Mengirimkan formulir delete secara otomatis
            document.getElementById('deleteForm').submit();
        }
    </script>
@endsection
