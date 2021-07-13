
<!-- slider-area start -->
<div class="slider-area">
    <div class="swiper-container">
        <div class="swiper-wrapper">
        @foreach ($banners as $data)
            <div class="swiper-slide">
                <div class="slide-inner" style="background-image: url({{ asset('uploads/banner/'.$data->image) }})">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 col-lg-9 col-12">
                                <div class="slider-content">
                                    <div class="slider-shape">
                                        <h2 data-swiper-parallax="-500">{{ $data->name }}</h2>
                                        <p data-swiper-parallax="-400">{{ $data->info }}</p>
                                        <a href="{{ $data->link }}" data-swiper-parallax="-300">{{ $data->link_name }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- slider-area end -->
