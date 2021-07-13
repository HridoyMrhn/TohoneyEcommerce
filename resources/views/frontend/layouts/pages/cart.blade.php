@extends('frontend.master')
@section('cart')
active
@endsection

@section('page_header')
Shopping Cart
@endsection

@section('page_name')
Shopping Cart
@endsection
@section('content')

<div class="cart-area ptb-100">
    <div class="container">
        @if (session('cart_status'))
        <div class="alert alert-primary alert-dismissile fade show col-6 m-auto mb-5 text-center"
            role="alert">
            <b class="text-bold">{{ session('cart_status') }}</b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <div class="row mt-5">
            @if ($cupon_error != '')
            <div class="alert alert-warning alert-dismissile fade show col-6 m-auto mb-5 text-center"
                role="alert">
                <b class="text-bold">{{ $cupon_error }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            @if ($discount_amonut)
            <div class="alert alert-success alert-dismissile fade show col-6 m-auto mb-5 text-center"
                role="alert">
                <b class="text-bold">{{ $discount_amonut }}% Dicount! <br> if You Use This Cupon: {{ $cupon_name }}</b>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
            <div class="col-12 mt-3">
                <form action="{{ route('cart.update') }}" method="post">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $sub_total_price = 0;
                            $product_quantity = 0;
                            @endphp
                            @forelse (cart_items() as $data)
                            {{-- {{ $data->relationCartWithProduct }} --}}
                            <tr class="{{ ($data->relationCartWithProduct->product_quantity < $data->product_quantity) ? 'bg-warning':''  }}">
                                <td class="images"><img src="{{ asset('uploads/product/'.$data->relationCartWithProduct->product_image) }}" alt=""></td>
                                <td class="product">
                                    <a href="{{ route('product.details',  $data->relationCartWithProduct->product_slug) }}">{{ $data->relationCartWithProduct->product_name }}</a>

                                    @if ($data->relationCartWithProduct->product_quantity < $data->product_quantity)
                                        @php
                                            $product_quantity = 1
                                        @endphp
                                        <b class="text-danger d-block">Our Collection has {{ $data->relationCartWithProduct->product_quantity }}, Please reduce</b>
                                    @endif
                                </td>
                                <td class="ptice">{{ $data->relationCartWithProduct->product_price }} ৳
                                </td>
                                <td class="quantity cart-plus-minus">
                                    <input type="text" value="{{ $data->product_quantity }}" name='product_quantity[{{ $data->id }}]'>
                                </td>
                                <td class="total">
                                    {{ $data->product_quantity * $data->relationCartWithProduct->product_price }}৳
                                </td>
                                <td class="remove">
                                    <a href="{{ route('cart.delete', $data->id) }}" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @php
                                $sub_total_price += ($data->product_quantity * $data->relationCartWithProduct->product_price)
                            @endphp
                            @empty
                            <tr>
                                <td colspan="60" class="text-danger font-weight-bold">No Product Avialable Here!</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li><button onclick="$(this).closet('form').submit()" class="btn btn-dark">Update Cart</button></li>
                                    <li><a href="{{ route('shop') }}">Continue Shopping</a></li>
                                </ul>
                                <h3>Cupon</h3>
                                <p>Enter Your Cupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" name="apply_cupon_code" id="apply_cupon_code" value="{{ $cupon_name }}" placeholder="Cupon Code">
                                    <button type="button" id="apply_cupon_btn">Apply Cupon</button>
                                </div>
                                @foreach ($cupons as $data)
                                <div class="btn btn-group btn-group-sm">
                                    <button value="{{ $data->cupon_name }}" type="button" class="btn btn-success btn_add_cupon"><h5 class="d-inline-block">{{ $data->cupon_name }}</h5></button>
                                    <span class="btn btn-dark">You Have to Shopping Mora Than <h5 class="d-inline-block">{{ $data->purchase_amount }}</h5> Taka</span>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Subtotal: </span>{{ $sub_total_price }}৳
                                    </li>
                                    @php
                                        session(['sub_total_price' => $sub_total_price])
                                    @endphp

                                    @if($discount_amonut)
                                    <li><span class="pull-left">Discount ({{ $data->cupon_name }} - {{ $discount_amonut }}%): </span> {{ ($sub_total_price * $discount_amonut) / 100}}৳
                                    </li>
                                    @php
                                        session(['cupon_name' => $cupon_name]);
                                        session(['discount_amonut' => ($sub_total_price * $discount_amonut) / 100])
                                    @endphp
                                    @else
                                    <li><span class="pull-left">Discount (0%): </span> 00৳
                                    </li>
                                    @endif

                                    @if ($discount_amonut)
                                    <li><span class="pull-left"> Total </span>{{ $sub_total_price - (($sub_total_price * $discount_amonut) / 100)}}৳</li>
                                    @php
                                        session(['total_price' => $sub_total_price - (($sub_total_price * $discount_amonut) / 100)])
                                    @endphp
                                    @else
                                    <li><span class="pull-left"> Total </span>{{ $sub_total_price }}৳</li>
                                    @endif
                                </ul>
                                @if ($product_quantity == 0)
                                <a href="{{ route('checkout') }}" class="btn btn-danger btn-sm">Proceed to Checkout</a>
                                @else
                                <b class="btn btn-danger btn-sm">Please Reduce Your Quantity!🤨</b>
                                @endif
                                {{-- @php
                                    session(['sub_total_price' => $sub_total_price]);
                                    // session(['total_price' =>  $sub_total_price - (($sub_total_price * $discount_amonut) / 100)]);
                                @endphp --}}
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#apply_cupon_btn').click(function(){
                var input_cupon = $('#apply_cupon_code').val();
                var cupon_btn_link = "{{ url('cart') }}/"+input_cupon;
                window.location.href = cupon_btn_link ;
            });
            $('.btn_add_cupon').click(function(){
                $('#apply_cupon_code').val($(this).val());
            });
        });
    </script>
@endsection
