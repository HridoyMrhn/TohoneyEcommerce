@include('backend.partilas.header')
@section('title') Order Show Page || {{ title() }} @endsection
@include('backend.partilas.topbar')
@include('backend.components.title')

 <!-- page title area start -->
 <div class="page-title-area">
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="breadcrumbs-area clearfix">
                <h4 class="page-title pull-left">@yield('page_title')</h4>
                <ul class="breadcrumbs pull-left">
                    <li><a href="{{ route('index') }}">Home</a></li>
                    <li><span>@yield('page_title')</span></li>
                </ul>
            </div>
        </div>

        <div class="col-sm-6 clearfix">
            <div class="user-profile pull-right">
                @if (isset(Auth::user()->image))
                    <img class="avatar user-thumb" src="{{ asset('uploads/user/'.Auth::user()->image) }}" alt="{{ auth()->user()->name }}">
                @else
                    <img class="avatar user-thumb" src="{{ asset('uploads/user/default.png') }}" alt="avatar">
                @endif
                <h4 class="user-name dropdown-toggle" data-toggle="dropdown">
                    @auth
                        {{ auth()->user()->name }}
                    @else
                        Hi, Guest
                    @endauth
                    <i class="fa fa-angle-down"></i>
                </h4>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Log Out </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page title area end -->

    <div class="main-content-inner">
        <div class="main-content-inner">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-area">
                                <div class="invoice-head">
                                    <div class="row">
                                        <div class="iv-left col-6">
                                            <span>INVOICE</span>
                                        </div>
                                        <div class="iv-right col-6 text-md-right">
                                            <span>{{ $order_details->invoice_id }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <div class="invoice-address">
                                            <h3>invoiced to</h3>
                                            <h5>{{ $order_details->billingAddress->billing_name }}</h5>
                                            <p>{{ $order_details->billingAddress->billing_email }}</p>
                                            <p>{{ $order_details->billingAddress->billing_number }}</p>
                                            <p>{{ $order_details->billingAddress->billing_address }}</p>
                                            <p>
                                                {{ $order_details->billingAddress->billing_postal_code }},
                                                {{ $order_details->billingAddress->billingCity->name }},
                                                {{ $order_details->billingAddress->billingCountry->name }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-md-right">
                                        <ul class="invoice-date">
                                            <li>Invoice Date : {{ $order_details->created_at->format('d-m-Y') }}</li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- <div class="row align-items-center mt-3">
                                    <div class="col-md-6">
                                        <div class="invoice-address">
                                            <table class="table text-center table-bordered table-responsive-lg">
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <td></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Email</th>
                                                    <td>{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Number</th>
                                                    <td>{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Country</th>
                                                    <td>{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">City</th>
                                                    <td>{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Post Code</th>
                                                    <td>{{  }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Address</th>
                                                    <td>{{  }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="invoice-table table-responsive mt-5">
                                    <table class="table table-bordered table-hover text-right">
                                        <thead>
                                            <tr class="text-capitalize">
                                                <th class="text-center" style="width: 5%;">No</th>
                                                <th class="text-left" style="width: 45%; min-width: 130px;">Product Name</th>
                                                <th>Quantity</th>
                                                <th style="min-width: 100px">Unit Cost</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($order_details->orderDetails as $data)
                                            <tr>
                                                <td class="text-center">{{ $loop->index + 1}}</td>
                                                <td class="text-left">{{ $data->orderProducts->name }}</td>
                                                <td>{{ $data->product_quantity }}</td>
                                                <td>{{ $data->orderProducts->price }}</td>
                                                <td>{{ $data->orderProducts->price * $data->product_quantity }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4">Total balance :</td>
                                                <td>{{ $order_details->subtotal }} ৳</td>
                                            </tr>
                                            <tr>
                                            @if ($order_details->discount_amount)
                                                <td colspan="4">Discount (<span class="text-success font-weight-bold">{{ $order_details->cupon_name }}</span>) :</td>
                                                <td>{{ $order_details->discount_amount }} ৳</td>
                                            @else
                                                <td colspan="4">Discount  :</td>
                                                <td>0:00 ৳</td>
                                            @endif
                                            </tr>
                                            <tr>
                                                <td colspan="4">Total balance :</td>
                                                <td>{{ $order_details->total }} ৳</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="invoice-buttons text-right">
                                <a href="{{ route('invoice.download', $order_details->id) }}" class="invoice-btn">Print invoice</a>
                                <a href="#" class="invoice-btn">send invoice</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.partilas.footer')
