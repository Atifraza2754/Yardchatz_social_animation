@include('frontend.layout.header')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Bundle JS (for modal functionality) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/css/setting.css') }}">
<style>
        body {
        background-image: url(assets/img/setting2.png);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        min-height: 80vh;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    
    @media (max-width: 768px) and (orientation: landscape) {
        .card-body {
            max-height: 80vh !important;
            overflow-y: auto;
        }
    }

</style>

<div class="container my-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Settings Card -->
    <div class="card shadow-lg" style="min-height: 600px;">
        <!-- Scroll wrapper for small landscape screens -->
        <div class="card-body py-5 px-4 overflow-auto" style="max-height: 90vh;">
            <h2 class="card-title text-center text-success fw-bold mb-5">Settings</h2>

            <div class="row g-4">
                <div class="col-md-6">
                    <button type="button" class="btn btn-success w-100 py-4 fs-5 d-flex align-items-center justify-content-start gap-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-person-circle fs-3"></i>
                        <span>Edit Profile</span>
                    </button>
                </div>
                <div class="col-md-6">
                    <button 
                        id="privacyBtn" 
                        class="btn btn-success w-100 py-4 fs-5 d-flex align-items-center justify-content-start gap-3"
                        data-bs-toggle="modal" 
                        data-bs-target="#privacyModal">
                        <i class="bi bi-shield-lock fs-3"></i>
                        <span>Privacy</span>
                    </button>

                </div>
                <div class="col-md-6">
                    <button type="button"  data-bs-toggle="modal" data-bs-target="#changePasswordModal" id="changePasswordBtn" class="btn btn-success w-100 py-4 fs-5 d-flex align-items-center justify-content-start gap-3">
                        <i class="bi bi-key fs-3"></i>
                        <span>Change Password</span>
                    </button>
                </div>
                <div class="col-md-6">
                    <button id="setRingtoneBtn" data-bs-toggle="modal" data-bs-target="#setRingtoneModal" class="btn btn-success w-100 py-4 fs-5 d-flex align-items-center justify-content-start gap-3">
                       <i class="bi bi-music-note-beamed me-1"></i> Set Ringtone
                    </button>
                    
                </div>
                <div class="col-md-6">
                    <button id="FindPhoneBtn"  data-bs-toggle="modal" data-bs-target="#findPhoneModal" class="btn btn-success w-100 py-4 fs-5 d-flex align-items-center justify-content-start gap-3">
                        <i class="bi bi-phone fs-3"></i>
                        <span>Find Phone</span>
                    </button>
                </div>
                <div class="col-md-6">
                    <button id="logoutBtn"  data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-danger w-100 py-4 fs-5 d-flex align-items-center justify-content-start gap-3">
                        <i class="bi bi-box-arrow-right fs-3"></i>
                        <span>Logout</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Edit Profile Modal (Bootstrap-based) -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <div class="modal-body">
        <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
          @csrf

          <!-- Username -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
          </div>

          <!-- Name and Email side by side -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="name" class="form-label">Name</label>
              <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="col-md-6">
              <label for="email" class="form-label">Email</label>
              <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
          </div>

                    <div class="row mb-3">
            <div class="col-md-6">
              <label for="workplace" class="form-label">Workplace</label>
              <input type="text" id="workplace" name="workplace" class="form-control" value="{{ old('school', $user->workplace) }}" required>
            </div>
            <div class="col-md-6">
              <label for="workplace" class="form-label">School</label>
              <input type="text" id="school" name="school" class="form-control" value="{{ old('school', $user->school) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="Pensacola" class="form-label">Pensacola</label>
              <input type="text" id="Pensacola" name="Pensacola" class="form-control" value="{{ old('Pensacola', $user->Pensacola) }}" required>
            </div>
            <div class="col-md-6">
              <label for="dob" class="form-label">Date of Birth</label>
              <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}" required>
            </div>
          </div>
    
          <div class="row mb-3">
            <div class="col-md-6">
              <label for="loves" class="form-label">Loves</label>
              <input type="text" id="loves" name="loves" class="form-control" value="{{ old('loves', $user->loves) }}" required>
            </div>
            <div class="col-md-6">
              <label for="home_town" class="form-label">Home Town</label>
              <input type="text" id="home_town" name="home_town" class="form-control" value="{{ old('home_town', $user->home_town) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="current_city" class="form-label">Current City</label>
              <input type="text" id="current_city" name="current_city" class="form-control" value="{{ old('current_city', $user->current_city) }}" required>
            </div>
            <div class="col-md-6">
              <label for="favorite_song" class="form-label">Favorite Song</label>
              <input type="text" id="favorite_song" name="favorite_song" class="form-control" value="{{ old('favorite_song', $user->favorite_song) }}" required>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col-md-6">
              <label for="employer" class="form-label">Employer</label>
              <input type="text" id="employer" name="employer" class="form-control" value="{{ old('employer', $user->employer) }}" required>
            </div>
            <div class="col-md-6">
              <label for="job_title" class="form-label">Job Title</label>
              <input type="text" id="job_title" name="job_title" class="form-control" value="{{ old('job_title', $user->job_title) }}" required>
            </div>
          </div>

          <!-- Profile Picture Upload -->
          <div class="row mb-4 align-items-center">
            <div class="col-md-4">
              <label class="form-label">Current Picture</label><br>
              @if($user->profile_picture)
                <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" style="width: 120px; height: 120px;">
              @else
                <img src="{{ asset('assets/img/person.png') }}" alt="Default Avatar" class="img-thumbnail" style="width: 120px; height: 120px;">
              @endif
            </div>
            <div class="col-md-8">
              <label for="profile_picture" class="form-label">Change Picture</label>
              <input type="file" id="profile_picture" name="profile_picture" class="form-control">
            </div>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-success w-100">Update Profile</button>
        </form>
      </div>

    </div>
  </div>
</div>



<!-- Privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
    <div class="modal-content p-4">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="privacyModalLabel">
          <i class="bi bi-shield-lock-fill me-2"></i> Set Privacy
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form id="privacyForm" method="POST" action="">
          @csrf

          <div class="mb-4">
            <label class="form-label fs-6"><i class="bi bi-eye me-2"></i> Who can see me?</label>

            <div class="form-check my-2">
              <input class="form-check-input" type="radio" name="privacy" value="nobody" id="privacyNobody" {{ auth()->user()->privacy_setting == 'nobody' ? 'checked' : '' }}>
              <label class="form-check-label" for="privacyNobody">
                <i class="bi bi-person-x-fill me-1 text-danger"></i> Nobody
              </label>
            </div>

            <div class="form-check my-2">
              <input class="form-check-input" type="radio" name="privacy" value="friends" id="privacyFriends" {{ auth()->user()->privacy_setting == 'friends' ? 'checked' : '' }}>
              <label class="form-check-label" for="privacyFriends">
                <i class="bi bi-people-fill me-1 text-info"></i> Friends
              </label>
            </div>

            <div class="form-check my-2">
              <input class="form-check-input" type="radio" name="privacy" value="everyone" id="privacyEveryone" {{ auth()->user()->privacy_setting == 'everyone' ? 'checked' : '' }}>
              <label class="form-check-label" for="privacyEveryone">
                <i class="bi bi-globe2 me-1 text-success"></i> Everyone
              </label>
            </div>
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-success w-100 py-3 fs-5">
              <i class="bi bi-check-circle me-2"></i> Change Privacy
            </button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>


<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
    <div class="modal-content p-4">

      <!-- Modal Header -->
      <div class="modal-header pb-3">
        <h4 class="modal-title" id="changePasswordModalLabel">
          <i class="bi bi-shield-lock-fill me-2"></i> Update Password
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form method="POST" action="{{ route('password.change') }}">
          @csrf

          <div class="mb-4">
            <label for="currentPassword" class="form-label fs-6">
              <i class="bi bi-lock-fill me-2"></i> Current Password
            </label>
            <input type="password" class="form-control form-control-lg py-3" id="currentPassword" name="current_password" placeholder="Enter current password" required>
          </div>

          <div class="mb-4">
            <label for="newPassword" class="form-label fs-6">
              <i class="bi bi-key-fill me-2"></i> New Password
            </label>
            <input type="password" class="form-control form-control-lg py-3" id="newPassword" name="new_password" placeholder="Enter new password" required>
          </div>

          <div class="mb-4">
            <label for="confirmPassword" class="form-label fs-6">
              <i class="bi bi-check2-square me-2"></i> Confirm Password
            </label>
            <input type="password" class="form-control form-control-lg py-3" id="confirmPassword" name="new_password_confirmation" placeholder="Confirm new password" required>
          </div>

          <button type="submit" class="btn btn-success btn-lg w-100 py-3 fs-5">
            <i class="bi bi-arrow-repeat me-2"></i> Update Password
          </button>
        </form>
      </div>

    </div>
  </div>
</div>


<!-- Set Ringtone Modal -->
<div class="modal fade" id="setRingtoneModal" tabindex="-1" aria-labelledby="setRingtoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg modal-fullscreen-sm-down">
    <div class="modal-content p-4">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="setRingtoneModalLabel">
          <i class="bi bi-music-note-beamed me-2"></i> Set Ringtone
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body">
        <form method="POST" action="{{ route('upload.ringtone') }}" enctype="multipart/form-data">
          @csrf

          <!-- Ringtones Grid -->
          <div class="row g-3 mb-4">
            @php
              $staticRingtones = [
                'ayla.mp3' => 'Ayla',
                'arash-broken-angel.mp3' => 'Broken Angel',
                'ringtone_call_phone.mp3' => 'Call Ringtone',
                'someone-is-calling-you.mp3' => 'Someone calling you',
                'ringtone_titanic.mp3' => 'Titanic Ring',
                'calling_ringtone.mp3' => 'Calling Ringtone',
                'vivo-y12-ringtone.mp3' => 'Vivo Y12 Ringtone',
                'synth_wave.mp3' => 'Synth Wave',
                'pop_melody.mp3' => 'Pop Melody',
                'hiphop_vibe.mp3' => 'Hip Hop Vibe'
              ];
              $userRingtone = auth()->user()->ringtone;
            @endphp

            {{-- Static Ringtones --}}
            @foreach ($staticRingtones as $file => $label)
              <div class="col-6 col-md-4 col-lg-3">
                <div class="form-check border rounded p-3 h-100">
                  <input class="form-check-input" type="radio" name="ringtone" id="ringtone{{ $loop->index }}" value="{{ $file }}" {{ $userRingtone == $file ? 'checked' : '' }}>
                  <label class="form-check-label" for="ringtone{{ $loop->index }}">
                    <i class="bi bi-volume-up-fill me-2 text-success"></i> {{ $label }}
                  </label>
                </div>
              </div>
            @endforeach

            {{-- Dynamic Uploaded Ringtone (if any) --}}
            @if ($userRingtone && !array_key_exists($userRingtone, $staticRingtones))
              <div class="col-6 col-md-4 col-lg-3">
                <div class="form-check border rounded p-3 h-100">
                  <input class="form-check-input" type="radio" name="ringtone" id="customRingtone" value="{{ $userRingtone }}" checked>
                  <label class="form-check-label" for="customRingtone">
                    <i class="bi bi-volume-up-fill me-2 text-primary"></i> Custom Ringtone
                  </label>
                </div>
              </div>
            @endif
          </div>

          <!-- Custom File Upload -->
          <div class="mb-4">
            <label for="uploadRingtone" class="form-label">
              <i class="bi bi-upload me-2"></i> Upload Audio File
            </label>
            <input type="file" class="form-control form-control-lg" name="upload_ringtone" id="uploadRingtone" accept="audio/*" required>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="btn btn-success btn-lg w-100 py-3 fs-5">
            <i class="bi bi-cloud-arrow-up me-2"></i> Upload & Set Ringtone
          </button>
        </form>
      </div>

    </div>
  </div>
</div>


<!-- Find Phone Modal -->
<div class="modal fade" id="findPhoneModal" tabindex="-1" aria-labelledby="findPhoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md modal-fullscreen-sm-down">
    <div class="modal-content p-4">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="findPhoneModalLabel">
          <i class="bi bi-phone-fill me-2"></i> Allow Friends to Find Phone
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body fs-5 text-center py-4">
        Would you like to allow friends to find your phone?
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer justify-content-center gap-3">
        <button type="button" class="btn btn-success px-4 py-2 fs-6" id="allowBtn">
          <i class="bi bi-check-circle-fill me-2"></i> Allow
        </button>
        <button type="button" class="btn btn-danger px-4 py-2 fs-6" id="notAllowBtn">
          <i class="bi bi-x-circle-fill me-2"></i> Not Allow
        </button>
      </div>

    </div>
  </div>
</div>



<!-- Logout Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md modal-fullscreen-sm-down">
    <div class="modal-content p-4">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title" id="logoutModalLabel">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Modal Body -->
      <div class="modal-body fs-5 text-center py-4">
        Are you sure you want to logout?
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer justify-content-center gap-3">
        <button type="button" class="btn btn-secondary px-4 py-2 fs-6" data-bs-dismiss="modal" id="cancelLogout">
          <i class="bi bi-x-circle me-2"></i> Cancel
        </button>
        <button type="button" class="btn btn-danger px-4 py-2 fs-6" onclick="window.location.href='/logout'">
          <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
      </div>

    </div>
  </div>
</div>

<script>
    // Only one checkbox at a time
    const checkboxes = document.querySelectorAll('input[name="privacy"]');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            checkboxes.forEach(box => {
                if (box !== this) box.checked = false;
            });
        });
    });

    // AJAX form submission
    document.getElementById('privacyForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const selected = document.querySelector('input[name="privacy"]:checked');
        if (!selected) {
            alert('Please select a privacy option.');
            return;
        }

        const privacy_setting = selected.value;

        fetch("{{ route('privacy.ajax.update') }}", {
                method: 'POST'
                , headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    , 'Content-Type': 'application/json'
                , }
                , body: JSON.stringify({
                    privacy_setting
                })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
            })
            .catch(err => {
                console.error(err);
                alert('Error updating privacy.');
            });
    });



    //set ringtone
  document.querySelectorAll('input[name="ringtone"]').forEach(r => {
    r.addEventListener('change', function () {
      const selected = this.value;

      fetch("{{ route('set.ringtone') }}", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ ringtone: selected })
      }).then(res => res.json())
        .then(data => console.log("Ringtone updated"));
    });
  });

</script>

<script src="{{ asset('assets/js/settings.js')}}"></script>
@include('frontend.layout.navbar')
@include('frontend.layout.footer')

