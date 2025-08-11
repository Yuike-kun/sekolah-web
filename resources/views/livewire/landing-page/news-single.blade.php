<div>
    <section class="service blog-single">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 mb-4">
                    <div class="common-title text-center">
                        <span>APA KABAR AZHAR CENTER</span>
                        <h3>{{ $berita->heading }}</h3>
                    </div>
                </div>
                <div class="col-lg-9 col-12">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $berita->image) }}" class="img-fluid rounded mb-3"
                                style="width: 100%; height: 15rem; object-fit: cover" />
                            <div class="d-flex justify-content-between">
                                <h4>{{ $berita->heading }} </h4>
                                <small>{{ $berita->created_at->translatedFormat('l, d F Y') }}</small>
                            </div>
                            {!! $berita->body !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Berita Lainnya</h4>
                            <hr>
                            @forelse ($other as $other_news)
                                <a href="{{ route('berita-detail', $other_news->id) }}">
                                    <span class="fs-5 fw-bold">
                                        {{ $other_news->heading }}
                                    </span>
                                    <br>
                                    <small>{{ $other_news->created_at->translatedFormat('l, d F Y') }}</small>
                                </a>
                                <hr>
                            @empty
                                <div class="d-flex">
                                    <h5 class="m-auto text-muted p-5"><i class="fa-solid fa-folder-open"></i> Tidak ada
                                        berita lainnya</h5>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
