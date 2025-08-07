<footer>
    <div class="footer-container wow fadeInUp">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="footer-middle">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-6">
                                <div class="footer-content">
                                    <div class="footer-content-inner">
                                        <div class="footer-logo">
                                            <img src="{{ asset('logo/logo-icon02.png') }}" alt="logo">
                                        </div>
                                        <p>MTsQ AZHAR CENTER MAKASSAR</p>
                                        <div>
                                            <iframe
                                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.565116820652!2d119.47791067394368!3d-5.173424294804004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee30998f9decb%3A0xa5a2933e934145c7!2sJl.%20Sipil%20Raya%2C%20Bangkala%2C%20Kec.%20Manggala%2C%20Kota%20Makassar%2C%20Sulawesi%20Selatan%2090235!5e0!3m2!1sid!2sid!4v1695097779757!5m2!1sid!2sid"
                                                width="320" height="150" style="border:0;" allowfullscreen=""
                                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                        </div>
                                        <div class="address">
                                            <div class="address-icon">
                                                <i class="flaticon-map"></i>
                                            </div>
                                            <div class="address-info">
                                                Jl. Sipil Raya No. 12-13, Kelurahan Biring Romang, Kecamatan Manggala,
                                                Kota Makassar.
                                            </div>
                                        </div>
                                        <div class="address">
                                            <div class="address-icon">
                                                <i class="fa-brands fa-whatsapp"></i>
                                            </div>
                                            <div class="address-info">
                                                <span>WhatsApp</span>
                                                <a href="tel:1800-222-155">+62 812-3450-4649</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
                                <div class="footer-content htr-footer-content">
                                    <div class="footer-content-inner">
                                        <h5>{{ config('footer.title') }}</h5>
                                        <ul>
                                            @foreach (config('footer.sub-menu') as $item)
                                                <li><a href="{{ route($item['route-name']) }}">{{ $item['title'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
                                <div class="footer-content htr-footer-content">
                                    <div class="footer-content-inner">
                                        <h5 class="mb-2">Video</h5>
                                        <div class="d-flex flex-col">
                                            <iframe width="320" height="150"
                                                src="https://www.youtube.com/embed/rsIRrpt-TY4?si=APER0z66V_yXJMQu"
                                                title="YouTube video player" frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>

                                <div class="footer-content htr-footer-content mt-2">
                                    <div class="footer-content-inner">

                                        <div class="footer-content-inner footer-content-inner-last-child">
                                            <div class="footer-desc-content">
                                                <h5>Galeri</h5>
                                            </div>

                                            <div class="footer-gallery d-flex">
                                                <a href="{{ asset('images/foto01.JPG') }}"
                                                    class="footer-gallery-link lightbox-image" data-fancybox="gallery">
                                                    <div class="footer-gallery-item">
                                                        <img src="{{ asset('images/foto01.JPG') }}" alt="image">
                                                        <div class="footer-gallery-overlay">
                                                            <div class="footer-gallery-overlay-plus">+</div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="{{ asset('images/foto02.JPG') }}"
                                                    class="footer-gallery-link lightbox-image" data-fancybox="gallery">
                                                    <div class="footer-gallery-item">
                                                        <img src="{{ asset('images/foto02.JPG') }}" alt="image">
                                                        <div class="footer-gallery-overlay">
                                                            <div class="footer-gallery-overlay-plus">+</div>
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="{{ asset('images/foto03.png') }}"
                                                    class="footer-gallery-link lightbox-image" data-fancybox="gallery">
                                                    <div class="footer-gallery-item">
                                                        <img src="{{ asset('images/foto03.png') }}" alt="image">
                                                        <div class="footer-gallery-overlay">
                                                            <div class="footer-gallery-overlay-plus">+</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="footer-bottom-wrapper">
                        <div class="footer-copyright">
                            <p>Copyrights © 2023 Ryoogen Media</p>
                        </div>
                        <div class="footer-media">
                            <ul>
                                <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
