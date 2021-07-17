@extends('frontend.master')

@section('content')

<div class="checkout-area ptb-100">
    <div class="container">
        <div class="mx-auto text-center col-6">@include('backend.components.status')</div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-8">
                    <div class="checkout-form form-style">
                        <h3>Billing Details</h3>
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <p>Name *</p>
                                <input type="text" name="billing_name" id="billing_name"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input type="email" name="billing_email" id="billing_email"
                                    value="{{ $user->email }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input type="number" name="billing_number" id="billing_number" value="{{ $user->phone_number }}">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select name="billing_country_id" id="country_list_1">
                                    <option value="" selected>Select Country</option>
                                    @foreach ($countries as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <select name="billing_city_id" id="city_list_1">
                                    <option value="" selected>Select Country</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/Zip</p>
                                <input type="number" name="billing_postal_code"
                                    id="billing_postal_code">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Your Address *</p>
                                <input type="text" name="billing_address" id="billing_address">
                            </div>

                            <div class="col-12">
                                <input id="toggle2" type="checkbox" name="shipping_address_status">
                                <label class="fontsize" for="toggle2">Ship to a different address?</label>
                                <div class="row" id="open2">
                                    <h3>Shipping Details</h3>
                                    <div class="col-sm-6 col-12">
                                        <p>Name *</p>
                                        <input type="text" name="shipping_name" id="shipping_name">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Email Address *</p>
                                        <input type="email" name="shipping_email" id="shipping_email">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Phone No. *</p>
                                        <input type="number" name="shipping_number" id="shipping_number">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Country *</p>
                                        <select name="shipping_country_id" id="country_list_2">
                                            <option value="" selected>Select Country</option>
                                            @foreach ($countries as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Town/City *</p>
                                        <select name="shipping_city_id" id="city_list_2">
                                            <option value="" selected>Select Country</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Postcode/ZIP</p>
                                        <input type="number" name="shipping_postal_code"
                                            id="shipping_postal_code">
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <p>Shipping Address *</p>
                                        <input type="text" name="shipping_address" id="shipping_address">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <p>Order Notes </p>
                            <textarea name="shipping_notes" id="shipping_notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="order-area">
                        <h3>Your Order</h3>
                        <ul class="total-cost">
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach (cart_items() as $data)
                                <li>{{ $data->products->name }} <span class="pull-right">
                                        {{ $data->products->price }} X {{ $data->quantity }} =
                                        {{ $data->products->price * $data->quantity}} ৳</span></li>
                                @php
                                    $subtotal += $data->products->price * $data->quantity;
                                    session(['subtotal' => $subtotal]);
                                @endphp
                            @endforeach

                            <li class="font-weight-bold">Subtotal <span
                                    class="pull-right"><strong>{{ $subtotal }} ৳</strong></span></li>
                            <li class="font-weight-bold">Discount ({{ session('cupon_name') }}) <span
                                    class="pull-right">{{ session('discount_amonut') }} ৳</span></li>
                            <li class="font-weight-bold">Discount <span class="pull-right">100 ৳</span>
                            </li>
                            <li>Total<span class="pull-right">{{ $subtotal - session('discount_amonut') + 100 }} ৳</span></li>
                        </ul>

                        <ul class="payment-method">
                            <li>
                                <input id="bank" type="radio" name="payment_gateway" value="Card">
                                <label for="bank">Direct Bank Transfer</label>
                            </li>
                            <li>
                                <input id="toggle1" type="radio" name="payment_gateway" value="M/B">
                                <label for="toggle1">Mobile Banking</label>
                                <div class="create-account">
                                    <label for="transaction_id">Bkash/Rocket/Nagad</label>
                                    <input type="text" name="transaction_id" id="transaction_id"
                                        class="form-control" placeholder="Enter Transection ID">
                                </div>
                            </li>
                        </ul>
                        <button type="submit">Place Order</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function () {
        $('#country_list_1').select2();
        $('#city_list_1').select2();

        $('#country_list_2').select2();
        $('#city_list_2').select2();



        $("#country_list_1").change(function () {
            var country_id_1 = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/checkout/get/city/',
                data: {
                    country_id: country_id_1
                },
                success: function (data) {
                    console.log(data);
                    $('#city_list_1').html(data)
                }
            });
        });


        $('#country_list_2').change(function () {
            var country_id_2 = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/checkout/get/city/',
                data: {
                    country_id: country_id_2
                },
                success: function (data) {
                    $('#city_list_2').html(data);
                }
            });
        });

    });

</script>
@endsection
