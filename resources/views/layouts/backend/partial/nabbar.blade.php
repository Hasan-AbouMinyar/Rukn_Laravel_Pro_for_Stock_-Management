<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars fa-xl"></i></a>
      </li>
    </ul>
    <!-- User Info -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="/img/image.png" class="img-circle elevation-2 border border-primary shadow-sm" alt="User Image" style="width:38px; height:38px; object-fit:cover;">
        </a>
        <div class="dropdown-menu dropdown-menu-right border-0 shadow-lg animate__animated animate__fadeIn p-3" aria-labelledby="userDropdown" style="min-width: 240px; border-radius: 1rem; background: #f8fafd; left: auto; right: 0;">
          <div class="d-flex align-items-center mb-2">
            <img src="/img/image.png" class="img-circle elevation-2 border border-primary shadow-sm me-2" alt="User Image" style="width:48px; height:48px; object-fit:cover;">
            <div class="ms-3" style="margin-left:1rem !important;">
              <div class="fw-bold" style="font-size:1.1rem; color:#222;">{{ Auth::user()->name }}</div>
              @php
                $isAdmin = Auth::user()->is_admin == 1;
                $isEmployee = Auth::user()->is_admin == 0;
              @endphp
              @if($isAdmin || $isEmployee)
                <div class="text-muted" style="font-size:0.95rem;">
                  {{ $isAdmin ? 'Admin' : 'Employee' }}
                </div>
              @endif
            </div>
          </div>
          <a href="{{ url('/profile') }}" class="btn btn-sm btn-outline-primary w-100 mb-2">View Profile</a>
          <div class="dropdown-divider my-2"></div>
          <!-- Dark Mode Switch (custom switch style) -->
          <div class="form-group mb-2">
            <div class="custom-control custom-switch d-flex align-items-center justify-content-between">
              <input type="checkbox" class="custom-control-input ms-2" id="darkModeSwitch" style="order:2;">
              <label class="custom-control-label me-2" for="darkModeSwitch" id="darkModeSwitchLabel" style="order:1; cursor:pointer;">Dark Mode</label>
            </div>
          </div>
          <div class="dropdown-divider my-2"></div>
          <a class="dropdown-item d-flex align-items-center py-2 rounded" href="{{ route('logout') }}"
             onclick="event.preventDefault(); document.getElementById('logout-form-navbar').submit();" style="transition: background 0.2s;">
            <i class="fa-solid fa-arrow-right-from-bracket fa-lg me-2" style="color: #707B7C;"></i>
            <span class="fw-semibold text-danger">Logout</span>
          </a>
          <form id="logout-form-navbar" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        </div>
      </li>
    </ul>
  </nav>
  <script>
    function setDarkMode(enabled) {
      const label = document.getElementById('darkModeSwitchLabel');
      const switchInput = document.getElementById('darkModeSwitch');
      if (enabled) {
        document.body.classList.add('dark-mode');
        localStorage.setItem('darkMode', 'on');
        label.textContent = 'Light Mode';
        switchInput.checked = true;
      } else {
        document.body.classList.remove('dark-mode');
        localStorage.setItem('darkMode', 'off');
        label.textContent = 'Dark Mode';
        switchInput.checked = false;
      }
    }
    document.addEventListener('DOMContentLoaded', function() {
      const isDark = localStorage.getItem('darkMode') === 'on';
      setDarkMode(isDark);
      document.getElementById('darkModeSwitch').onchange = function() {
        setDarkMode(this.checked);
      };
    });
  </script>
