<div>
    <section class="service blog-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="common-title text-center">
                        <span>APA KABAR AZHAR CENTER</span>
                        <h3>BERITA</h3>
                    </div>
                </div>
                @foreach ($berita as $item)
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="service-container blog-container wow fadeInUp">
                            <div class="service-content-wrapper">
                                <div class="service-content-wrapper-overlay wow"></div>
                                <div class="service-image blog-image">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="img">
                                </div>
                            </div>
                            <div class="service-info">
                                <span>{{ $item->created_at->translatedFormat('l, d F Y') }}</span>
                                <h5>{{ $item->heading }}</h5>
                                <a href="{{ route('berita-detail', $item->id) }}">Lihat Berita <i
                                        class="fa-solid fa-arrow-right-long"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
