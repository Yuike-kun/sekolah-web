<div>
    <section class="how-it-work">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common-title align-title">
                        <span>PROGRAM</span>
                        <h3>Program Unggulan <br> MTsQ Azhar Center Makassar.</h3>
                    </div>
                </div>

                @foreach ($programs as $item)
                    <div class="col-lg-3">
                        <div class="how-it-work-content wow fadeInUp">
                            <div class="how-it-work-image">
                                <img src="{{ asset('storage/' . $item->image) }}">
                                <div class="how-it-number">
                                    <span>{{ $loop->iteration }}</span>
                                </div>
                            </div>
                            <h5>{{ $item->name }}</h5>
                            <span>{{ $item->Information }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
