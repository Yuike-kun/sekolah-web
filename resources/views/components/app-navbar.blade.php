<div>
    <header class="top-header">
        <nav class="navbar navbar-expand gap-3">
            <div class="toggle-icon fs-3 d-flex text-start d-lg-none">
                <i class="bi bi-list m-auto"></i>
            </div>
            @if (auth()->user()->role == 'admin')
                <livewire:dashboard.partials.bell />
            @endif
            <div class="dropdown dropdown-user-setting {{ auth()->user()->role == 'user' ? 'ms-auto' : '' }}">
                <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown">
                    <div class="user-setting d-flex align-items-center gap-3">
                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="user-img"
                                alt="gambar-sambutan">
                        @else
                            <img src="{{ asset('images/not-image-user.gif') }}" class="user-img" alt="gambar-sambutan">
                        @endif
                        <div class="d-none d-sm-block">
                            <p class="user-name mb-0">{{ auth()->user()->name }}</p>
                            <small class="mb-0 dropdown-user-designation">{{ auth()->user()->role }}</small>
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('setting.user-profil.index') }}">
                            <div class="d-flex align-items-center">
                                <div class=""><i class="fa-solid fa-user"></i></i></div>
                                <div class="ms-3"><span>Profile</span></div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <div class=""><i class="fa-solid fa-lock"></i></div>
                                    <div class="ms-3"><span>Logout</span></div>
                                </div>
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
</div>
