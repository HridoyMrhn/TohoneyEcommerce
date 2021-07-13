@extends('frontend.master')
@section('checkout')
active
@endsection

@section('page_header')
Checkout
@endsection

@section('page_name')
Checkout
@endsection
@section('content')
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                    <form action="{{ route('checkout.submit') }}" method="POST">
                        @csrf
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
                                <input type="number" name="billing_number" id="billing_number">
                            </div>
                            <div class="col-sm-6 col-12">
                                {{-- {{ $country }} --}}
                                <p>Country</p>
                                <select id="country_list_1" name="billing_country_id">
                                    <option>Select a Country</option>
                                    @foreach ($country as $data)
                                    <option value="{{ $data->id }}">{{ $data->iso2 }} - {{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <select id="city_list_1" name="billing_city_id">
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input type="number" name="billing_postal_code"
                                    id="billing_postal_code">
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input type="text" name="billing_address" id="billing_address">
                            </div>

                            <div class="col-12">
                                <input id="shipping_address_status" type="checkbox"
                                    name="shipping_address_status">
                                <label class="fontsize" for="shipping_address_status">Ship to a different address?</label>


                                <div class="col-sm-6 col-12">
                                    <p>Name *</p>
                                    <input type="text" name="shipping_name" id="shipping_name" value="{{ $user->name }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Email Address *</p>
                                    <input type="email" name="shipping_email" id="shipping_email"
                                        value="{{ $user->email }}">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Phone No. *</p>
                                    <input type="number" name="shipping_number" id="shipping_number">
                                </div>
                                <div class="col-sm-6 col-12">
                                    <p>Country</p>
                                    <select id="country_list_2" name="shipping_country_id">
                                        {{-- <option selected>Select a country</option> --}}
                                        @foreach ($country as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <br>
                                <div class="col-sm-6 col-12">
                                    <p>Town/City *</p>
                                    <select id="city_list_2" name="shipping_city_id">
                                    </select>
                                </div>
                                <br>
                                <div class="col-12">
                                    <p>Your Address *</p>
                                    <input type="text" name="shipping_address" id="shipping_address">
                                </div>
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="billing_notes" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
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
                        <li>{{ $data->relationCartWithProduct->product_name }} <span class="pull-right">{{ $data->relationCartWithProduct->product_price }}
                                X {{ $data->product_quantity }} =
                                {{ $data->relationCartWithProduct->product_price * $data->product_quantity }}৳</span>
                        </li>
                        @endforeach
                        <li class="font-weight-bold">Subtotal <span
                                class="pull-right"><strong>{{ session('sub_total_price') }}৳</strong></span>
                        </li>
                        <li class="font-weight-bold">Discount <span
                                class="pull-right"><strong>{{ session('cupon_name') }} {{ session('discount_amonut') }}৳</strong></span>
                        </li>
                        <li class="font-weight-bold">Shipping <span class="pull-right">Free</span>
                        </li>
                        <li>Total<span
                                class="pull-right">{{ session('sub_total_price') - session('discount_amonut') }}৳</span>
                        </li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input id="card" name="payment_gatway_name" value="credit_card"type="radio">
                            <label for="card">Credit Card</label>
                        </li>
                        <li>
                            <input id="delivery" name="payment_gatway_name" type="radio"
                                value="cash on delivery">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button>Place Order</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#country_list_1').select2();
            $('#city_list_1').select2();

            $('#country_list_2').select2();
            $('#city_list_2').select2();


            $('#country_list_1').change(function (){
                var country_id = $(this).val();
                // alert(country_id);
            // Ajax Setup
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
            // Ajax Request start
                $.ajax({
                    type: 'POST',
                    url: '/checkout/get/city/ajax/request',
                    data: {country_id: country_id},
                    success: function(data){
                        $('#city_list_1').html(data);
                    }
                });
            });



            $('#country_list_2').change(function(){
                var country_id_2 = $(this).val();
                // alert(country_id_2)
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/checkout/get/city/ajax/request',
                    data : {country_id: country_id_2},
                    success: function(data){
                        // alert(data);
                        $('#city_list_2').html(data);
                    }
                });
            });
        });
    </script>
@endsection
