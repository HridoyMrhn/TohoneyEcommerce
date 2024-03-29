<li class="col-xl-3 col-lg-4 col-sm-6 col-12 list-unstyled">
    <div class="product-wrap">
        <div class="product-img">
            <span>Sale</span>
            <img src="{{ asset('uploads/product/'.$data->image) }}" alt="{{ $data->name }}" style="width: 250px; height:250px">
            <div class="product-icon flex-style">
                <ul>
                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="product-content">
            <h3><a href="{{ route('product.details', $data->slug) }}">{{ $data->name }}</a></h3>
            <p class="pull-left">${{ $data->price }}</p>
            <ul class="pull-right pr-2 d-flex">
            @if (total_rating($data->id) == 0)
                No Review Yet!
            @else
                @for ($i = 0; $i < total_rating($data->id); $i++)
                    <li><i class="fa fa-star"></i></li>
                @endfor
            @endif
            </ul>
        </div>
    </div>
</li>
