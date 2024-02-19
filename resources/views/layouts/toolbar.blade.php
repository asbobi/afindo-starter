<div class="header">
    <style>
        .logo-section {
            display: flex;
            align-items: center;
            /* Add spacing between logo and text */
        }

        .logo-section img {
            align-items: center;
            margin-right: 10px;
            /* Add spacing between logo and text */
        }

        .text-section {
            flex: 1;
            padding-top: 7px;
        }
    </style>
    <div class="header-left" style="margin-left: 10px;">
        <a href="{{ route('home') }}" class="logo">
            <div style="display: flex;">
                <div class="logo-section">
                    <img src="{{ asset('assets/img/afindo.png') }}" width="40" alt="Logo">
                </div>
                <div class="text-section">
                    <h5>KMZWA8AWAA</h5>
                </div>
            </div>
        </a>
        <a href="{{ route('home') }}" class="logo logo-small" style="margin-left: 10px;">
            <img src="{{ asset('assets/img/afindo.png') }}" alt="Logo" width="30" height="30">
        </a>
    </div>
    <div class="menu-toggle">
      <a href="javascript:void(0);" id="toggle_btn">
        <i class="fas fa-bars"></i>
      </a>
    </div>

    <ul class="nav user-menu">
        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                    <img class="rounded-circle" src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" width="31"
                        alt="Soeng Souy">
                    <div class="user-text">
                        <h6>{{ auth()->user()->NamaLengkap }}</h6>
                        <p class="text-muted mb-0">
                            {{ (int) auth()->user()->IsAdmin === 1 ? 'Administrator' : 'Petugas' }}</p>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <div class="avatar avatar-sm">
                        <img src="{{ asset('assets/img/profiles/avatar-01.jpg') }}" alt="User Image"
                            class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                        <h6>{{ auth()->user()->NamaLengkap }}</h6>
                        <p class="text-muted mb-0">
                            {{ (int) auth()->user()->IsAdmin === 1 ? 'Administrator' : 'Petugas' }}</p>
                    </div>
                </div>
                <a class="dropdown-item" href="{{ url('ubah-password') }}">Ubah Password</a>
                <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
            </div>
        </li>
    </ul>
</div>
