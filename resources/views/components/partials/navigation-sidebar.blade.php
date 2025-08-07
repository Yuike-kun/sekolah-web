<div>
    @if(isset($item['show']) && $item['show'] && in_array(auth()->user()->role, $item['permission']))
        @if(!isset($item['sub-menus']))
            <li class="{{ isset($item['sub-menus']) ? 'dropdown' : '' }} {{ Route::is($item['route-name']) || Request::is($item['is-active']) ? 'mm-active' : '' }}">
                <a href="{{ route($item['route-name']) }}">
                <div class="parent-icon"><i class="fa-solid fa-{{ $item['icon'] }}"></i>
                </div>
                <div class="menu-title">{{ $item['title'] }}</div>
                </a>
            </li>
        @else
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="fa-solid fa-{{ $item['icon'] }}"></i></div>
                    <div class="menu-title">{{ $item['title'] }}</div>
                </a>
                <ul class="submenu-group">
                    @foreach ($item['sub-menus'] as $subMenu)
                        @if(in_array(auth()->user()->role, $subMenu['permission']))
                            <li class="submenu">
                                <a class="submenu-link" href="{{ route($subMenu['route-name']) }}">{{ $subMenu['title'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        @endif
    @endif
</div>
