@extends('frontend.master')

@section('content')

    <div class="cart-area py-5">
        <div class="container">
            <div class="mx-auto text-center col-6">
                @include('backend.components.status')

                @if ($discount_amonut)
                    <div class="alert alert-success alert-dismissile fade show" role="alert">
                        <b class="text-bold">{{ $discount_amonut }}% Dicount! <br> if You Use This Cupon: {{ $cupon_name }}</b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif ($cupon_error)
                    <div class="alert alert-warning alert-dismissile fade show" role="alert">
                        <b class="text-bold">{{ $cupon_error }}</b>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="row mt-5">
                <div class="col-12">
                    <form action="{{ route('cart.update') }}" method="POST">
                        @csrf
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="">No</th>
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
                                    $product_quantity = 0;
                                    $subtotal = 0;
                                @endphp
                            @forelse (cart_items() as $data)
                                <tr class="{{ $data->products->quantity < $data->quantity ? 'bg bg-warning text-center':'' }}">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td class="images">
                                        <img src="{{ asset('uploads/product/'.$data->products->image) }}" alt="">
                                    </td>
                                    <td class="product">
                                        <a href="{{ route('product.details', $data->products->slug) }}">{{ $data->products->name }}</a>
                                        <br>
                                        @if ($data->products->quantity < $data->quantity)
                                            <b class="text-danger d-block">Our Collection has {{ $data->products->quantity }}, Please reduce</b>
                                            @php
                                                $product_quantity = 1;
                                            @endphp
                                        @endif
                                    </td>
                                    <td class="ptice">{{ $data->products->price }} ৳</td>
                                    <td class="quantity cart-plus-minus">
                                        <input type="text" min="1" name="quantity[{{ $data->id }}]" value="{{ $data->quantity }}">
                                    </td>
                                    <td class="total">
                                        {{ $data->products->price * $data->quantity }} ৳
                                        @php
                                            $subtotal += $data->products->price * $data->quantity;
                                            session(['subtotal' => $subtotal]);
                                        @endphp
                                    </td>
                                    <td class="remove">
                                        <a href="{{ route('cart.destroy', $data->id) }}" class="btn btn-sm btn-danger rounded-circle"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="50">
                                        <h3 class="text-danger text-center font-weight-bold">No Data Avilable Here!</h3>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li><button type="submit">Update Cart</button></li>
                                        <li><a href="{{ route('shop') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap mb-3">
                                        <input type="text" name="apply_cupon_code" id="apply_cupon_code" value="{{ $cupon_name }}" placeholder="Cupon Code">
                                        <button type="button" id="apply_cupon_btn">Apply Cupon</button>
                                    </div>
                                    @foreach ($cupons as $data)
                                    <div class="btn btn-group btn-group-sm p-1">
                                        <button value="{{ $data->name }}" type="button" class="btn btn-success btn_add_cupon"><h5 class="d-inline-block">{{ $data->name }}</h5></button>
                                        <span class="btn btn-dark">You Have to Shopping Mora Than <h5 class="d-inline-block">{{ $data->purchase_amount }}</h5> Taka</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                    @if ($discount_amonut)
                                        <li><span class="pull-left">Subtotal </span>{{ $subtotal }} ৳</li>
                                        <li><span class="pull-left">Discount({{ $discount_amonut }}%) </span>{{ ($subtotal * $discount_amonut) / 100 }} ৳</li>
                                        <li><span class="pull-left">Delivary Charge </span>100 ৳</li>
                                        <li><span class="pull-left"> Total </span> {{ $subtotal - (($subtotal * $discount_amonut) / 100) + 100 }} ৳</li>
                                        @php
                                            session(['discount_amonut' => ($subtotal * $discount_amonut) / 100]);
                                            session(['cupon_name' => $cupon_name]);
                                        @endphp
                                    @else
                                        <li><span class="pull-left">Subtotal </span>{{ $subtotal }} ৳</li>
                                        <li><span class="pull-left">Discount (0%): </span> 00৳
                                        </li>
                                        <li><span class="pull-left">Delivary Charge </span>100 ৳</li>
                                        <li><span class="pull-left"> Total </span> {{ $subtotal + 100 }} ৳</li>
                                    @endif
                                    </ul>

                                    <!-- For Checkout Button -->
                                    @if ($product_quantity == 1)
                                        <b class="btn btn-danger btn-sm">Please Reduce Your Quantity!🤨</b>
                                    @else
                                        <a href="{{ route('checkout.index') }}" class="btn btn-danger btn-sm">Proceed to Checkout</a>
                                    @endif
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
