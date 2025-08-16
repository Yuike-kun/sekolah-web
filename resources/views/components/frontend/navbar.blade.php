<div>

    <header class="header-three">

        {{-- TOP NAVBAR --}}
        <div class="header-top home-three-header-top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-2 col-lg-2">
                        <div class="logo home-three-logo d-flex">
                            <a class="m-auto" href="{{ route('beranda') }}">
                                <img src="{{ asset('storage/' . App\Models\IdentitiySchool::first()->logo) }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10">
                        <div class="header-top-content-wrapper home-three-header-top-content-wrapper">
                            <ul>
                                <li>
                                    <i class="icon-envelop"></i>
                                    <div class="home-three-header-top-content-wrapper-info">
                                        <span>Email Kami</span>
                                        <a
                                            href="mailto:{{ App\Models\AppIdentitiy::first()->email_school }}">{{ App\Models\AppIdentitiy::first()->email_school }}</a>
                                    </div>
                                </li>
                                <li class="li-content">
                                    <i class="flaticon-map"></i>
                                    <div class="home-three-header-top-content-wrapper-info">
                                        <span>Lokasi Kami</span>
                                        <a href="#">{{ App\Models\IdentitiySchool::first()->location_study }}</a>
                                    </div>
                                </li>
                                <li class="li-content">
                                    <a href="{{ route('ppdb.informasi') }}" class="common-btn header-top-btn">PPDB
                                        ONLINE</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BOTTOM NAVBAR --}}
        <div class="mobile-menu-container">
            <div class="mobile-menu-close"></div>
            <div class="mobile-logo">
                <img src="{{ asset('logo/logo-icon02.png') }}" alt="logo" width="230">
            </div>
            <div id="mobile-menu-wrap"></div>
            <div class="mobile-content">
                <ul>
                    <li><a href="#"><i
                                class="fa-brands fa-whatsapp"></i>{{ App\Models\AppIdentitiy::first()->contact_school }}</a>
                    </li>
                    <li class="li-content">
                        <a href="mailto:info.wrapdiv.com">
                            <i class="fa-regular fa-envelope"></i>{{ App\Models\AppIdentitiy::first()->email_school }}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mobile-info">
                <ul>
                    <li>Social Links :</li>
                    <li><a href="{{ App\Models\AppIdentitiy::first()->facebook_school }}"><i
                                class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="{{ App\Models\AppIdentitiy::first()->instagram_school }}"><i
                                class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="{{ App\Models\AppIdentitiy::first()->twitter_school }}"><i
                                class="fa-brands fa-twitter"></i></a></li>
                    <li><a href="{{ App\Models\AppIdentitiy::first()->youtube_school }}"><i
                                class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>

        <div class="header-menu-bar">
            <div class="main-menu-area header-three-menu-area ">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-7">
                            <div class="menu-bar home-three-menu-bar">
                                <div class="header-navigation-area">
                                    <nav class="main-navigation">
                                        <div class="main-menu-container">
                                            <ul id="main-menu" class="menu">
                                                @foreach (config('navbar') as $item)
                                                    @if (isset($item['show']) && $item['show'])
                                                        @if (!isset($item['sub-menus']))
                                                            <li>
                                                                <a class="{{ Route::is($item['route-name']) || Request::is($item['is-active']) ? 'active' : '' }}"
                                                                    href="{{ route($item['route-name']) }}">
                                                                    {{ $item['title'] }}
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li
                                                                class="menu-item-has-children current-menu-ancestor current-menu-item">
                                                                <a class="{{ Route::is($item['route-name']) || Request::is($item['is-active']) ? 'active' : '' }}"
                                                                    href="{{ route($item['route-name']) }}">
                                                                    {{ $item['title'] }}
                                                                    <i class="fa fa-angle-down ms-1"></i>
                                                                </a>
                                                                <ul class="sub-menu">
                                                                    @foreach ($item['sub-menus'] as $subMenu)
                                                                        <li class="current-menu-item">
                                                                            <a class="{{ Route::is($subMenu['route-name']) || Request::is($subMenu['is-active']) ? 'active' : '' }}"
                                                                                href="{{ route($subMenu['route-name']) }}">{{ $subMenu['title'] }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5">
                            <div class="header-buttons-area">
                                <div class="menu-right-info">
                                    <div class="hrader-top-info home-three-hrader-top-info">
                                        <ul>
                                            <li><a href="{{ App\Models\AppIdentitiy::first()->facebook_school }}"><i class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="{{ App\Models\AppIdentitiy::first()->instagram_school }}"><i class="fa-brands fa-instagram"></i></a></li>
                                            <li><a href="{{ App\Models\AppIdentitiy::first()->twitter_school }}"><i class="fa-brands fa-twitter"></i></a></li>
                                            <li><a href="{{ App\Models\AppIdentitiy::first()->youtube_school }}"><i class="fa-brands fa-youtube"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                <ul class="header-buttons-wrapper wrd-list-style">
                                    <li class="mobile-menu-trigger"><span></span><span></span><span></span></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
