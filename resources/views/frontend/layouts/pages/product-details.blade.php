@extends('frontend.master')

@section('content')

<!-- single-product-area start-->
<div class="single-product-area ptb-100">
    <div class="container">
        <div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="product-single-img">
                    <div class="product-active owl-carousel">
                        <div class="item">
                            <img src="{{ asset('uploads/product/'.$products->image) }}" alt="{{ $products->name }}">
                        </div>
                        @foreach ($products->multipleImage as $data)
                        <div class="item">
                            <img src="{{ asset('uploads/multiple_image/'.$data->multiple_image) }}" alt="{{ $products->name }}" style="width: 500px; height:550px">
                        </div>
                        @endforeach
                    </div>
                    <div class="product-thumbnil-active  owl-carousel">
                    @foreach ($products->multipleImage as $data)
                        <div class="item">
                            <img src="{{ asset('uploads/multiple_image/'.$data->multiple_image) }}" alt="{{ $data->name }}">
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="product-single-content">
                    <h3>{{ $products->name }}</h3>
                    <div class="rating-wrap fix">
                        <span class="pull-left">৳ {{ $products->price }}</span>
                        <ul class="rating pull-right">
                        @if (total_rating($products->id) == 0)
                            No Review Yet!
                        @else
                            @for ($i = 0; $i < total_rating($products->id); $i++)
                                <li><i class="fa fa-star"></i></li>
                            @endfor
                        @endif
                            <li>({{ total_review($products->id) }} Customar Review)</li>
                        </ul>
                    </div>
                    <p>{{ $products->short_description }}</p>
                    <ul class="input-style">
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" value="{{ $products->id }}" name="product_id">
                            <li class="quantity cart-plus-minus">
                                <input type="text" min="1" value="1" name="quantity" id="quantity">
                            </li>
                            <li><button type="submit" class="btn btn-success">Add to Cart</button></li>
                        </form>
                    </ul>
                    <ul class="cetagory">
                        <li>Category:</li>
                        <li><a href="{{ route('product.category', $products->category->slug) }}">{{ $products->category->name }}</a></li>
                    </ul>
                    <ul class="socil-icon">
                        <li>Share :</li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row mt-60">
            <div class="col-12">
                <div class="single-product-menu">
                    <ul class="nav">
                        <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                        <li><a data-toggle="tab" href="#tag">Faq</a></li>
                        <li><a data-toggle="tab" href="#review">Review</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-12">
                <div class="tab-content">
                    <!-- For Description-->
                    <div class="tab-pane active" id="description">
                        <div class="description-wrap">
                            <p>{!! $products->long_description !!}</p>
                        </div>
                    </div>

                    <!-- FAQ-->
                    <div class="tab-pane" id="tag">
                        <div class="faq-wrap" id="accordion">
                            @foreach ($faqs as $data)
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5><button class="{{ $loop->index == 0 ? '':'collapse' }}"  data-toggle="collapse" data-target="#collapse_{{ $data->id }}" aria-expanded="true" aria-controls="collapseOne">{{ $data->question }}</button> </h5>
                                    </div>
                                    <div id="collapse_{{ $data->id }}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">{{ $data->answer }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Review-->

                    <div class="tab-pane" id="review">
                        <div class="review-wrap mb-5">
                            <ul>
                            @foreach ($reviews as $data)
                                <li class="review-items mb-5">
                                    <div class="review-img">
                                        <img src="{{ asset('uploads/user/'.$data->user->image) }}" alt="" class="rounded-circle" style="width:80px; height:80px; line-height:80px">
                                    </div>
                                    <div class="review-content">
                                        <h3>{{ $data->user->name }}</h3>
                                        <span>{{ $data->updated_at->format('F j, Y, g:i a') }}</span>
                                        <p>{{ $data->review }}</p>
                                        <ul class="rating">
                                            @for ($i = 0; $i < $data->rating; $i++)
                                                <li><i class="fa fa-star"></i></li>
                                            @endfor
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                        @auth
                            <div class="add-review">
                            @if ($review_status == 1)
                                <h4>Add A Review </h4>
                                <form action="{{ route('review.submit', $order_id) }}" method="post">
                                    @csrf
                                    <div class="ratting-wrap">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>task</th>
                                                    <th>1 Star</th>
                                                    <th>2 Star</th>
                                                    <th>3 Star</th>
                                                    <th>4 Star</th>
                                                    <th>5 Star</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>How Many Stars?</td>
                                                    <td>
                                                        <input type="radio" name="rating" value="1">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="rating" value="2">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="rating" value="3">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="rating" value="4">
                                                    </td>
                                                    <td>
                                                        <input type="radio" name="rating" value="5">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h4>Your Review:</h4>
                                            <textarea name="review" id="review" rows="5" placeholder="Your Review Here..."></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn-style">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            </div>
                        @else
                            <div class="add-review">
                                <h4>Add A Review</h4>
                                <h3 class="text-center">
                                    <a href="{{ route('login') }}" class="text-danger font-weight-bold">Please Login or Reagistration First!</a>
                                </h3>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- single-product-area end-->


<!-- Related Product area start -->
<div class="featured-product-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title text-left">
                    <h2>Related Product</h2>
                </div>
            </div>
        </div>
        <div class="row">
        @forelse ($related_products as $data)
        @include('frontend.layouts.component.product-show')
        @empty
        <div class="alert alert-success alert-dismissile fade show col-6 m-auto mb-5 text-center" role="alert">
            <h3 class="text-danger text-center font-weight-bold">No Prodcuts Available Here!</h3>
        </div>
        @endforelse
        </div>
    </div>
</div>
<!-- Related Product area end -->

@endsection
