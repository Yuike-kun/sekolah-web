<div>

    <section class="banner-section">
         <div class="banner-carousel owl-theme owl-carousel">

                @foreach ($items as $item)
                            @if ($item->is_active == true)             
                                <div class="slide-item">
                                            <div class="image-layer" style="background-image:url({{ asset('storage/' . $item->image) }})"></div>
                                        <div class="auto-container">
                                                <div class="row">
                                                    <div class="col-lg-7">
                                                        <div class="banner-wrapper">
                                                            <div class="content-box">
                                                                <h2>{{ $item->heading}}</h2>
                                                                <p>{{{ $item->description }}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                </div>
                            @endif
                @endforeach

         </div>
    </section>

</div>
