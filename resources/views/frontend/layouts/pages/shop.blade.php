@extends('frontend.master')

@section('content')

<!-- product-area start -->
<div class="product-area pt-100">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="product-menu">
                    <ul class="nav justify-content-center">
                        <li>
                            <a class="active" data-toggle="tab" href="#all">All Product</a>
                        </li>
                        @foreach ($categories as $data)
                            <li>
                                <a data-toggle="tab" href="#category_id_{{ $data->id }}">{{ $data->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="all">
                <ul class="row">
                    @foreach ($products as $data)
                       @include('frontend.layouts.component.product-show')
                    @endforeach
                </ul>
            </div>
            @foreach ($categories as $category)
                <div class="tab-pane" id="category_id_{{ $category->id }}">
                    <ul class="row">
                        @foreach ($category->products as $data)
                            @include('frontend.layouts.component.product-show')
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
</div>
<!-- product-area end -->


@endsection
