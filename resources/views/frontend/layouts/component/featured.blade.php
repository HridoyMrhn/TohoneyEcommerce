<div class="featured-area featured-area2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="featured-active2 owl-carousel next-prev-style">
                    @foreach ($categories as $data)
                        <div class="featured-wrap">
                            <div class="featured-img">
                                <img src="{{ asset('uploads/category/'.$data->image) }}" alt="{{ $data->name }}">
                                <div class="featured-content">
                                    <a href="{{ route('product.category', $data->slug) }}">{{ $data->name }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
