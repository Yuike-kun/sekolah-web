<div>
    <section class="service blog-single">
        <div class="container">
            <div class="row">
             @if (isset($profil->history))
                <div class="col-xl-8 col-lg-8">
                    <div class="single-service-container wow fadeInUp">
                        <div class="service-content-wrapper">
                            <div class="blog-single-image">
                        @if(isset( $profil->image_06))
                                <img src="{{ asset('storage/' . $profil->image_06) }}">
                        @else
                                <img src="{{ asset('backend/assets/images/NoImage.png') }}">
                        @endif
                            </div>
                            <div class="blog-single-image-info">
                                <ul>
                                    <li><i class="fa-regular fa-calendar mx-2"></i>{{ Carbon\Carbon::now()->format('d-m-Y') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="blog-single-wrapper">
                        <h4>Sejarah Singkat</h4>
                         <p>{!! $profil->history !!}</p>
                    </div>
                    <div class="d-flex gap-3">
                        <div class="btn-shared-wa"><i class="fa-brands fa-whatsapp fs-3 me-2"></i>WhatsApp</div>
                        <div class="btn-shared-fb"><i class="fa-brands fa-facebook-f fs-3 me-2"></i>Facebook</div>
                        <div class="btn-shared-tw"><i class="fa-brands fa-twitter fs-3 me-2"></i>Twitter</div>
                    </div>
                </div>

                <livewire:landing-page.partials.blog-single />

                @else
                <div class="d-flex">
                   <h5 class="m-auto text-muted p-5"><i class="fa-solid fa-folder-open"></i> Tidak Ada Sejarah</h5>
                </div>
                @endif
            </div>
        </div>
    </section>
</div>
