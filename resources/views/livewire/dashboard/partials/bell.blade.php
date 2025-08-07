<div class="top-navbar-right ms-auto mt-3">
    <ul wire:poll>
        <li class="nav-item dropdown dropdown-large">
            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret">
                <div class="notifications">
                    @if ($verification > 0)
                        <span class="notify-badge">{{ $verification }}</span>
                    @endif
                    <i class="bi bi-bell-fill icon-inform"></i>
                </div>
            </a>
        </li>
    </ul>
</div>
