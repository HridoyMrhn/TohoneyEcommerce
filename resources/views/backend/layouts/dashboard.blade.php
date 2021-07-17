@extends('backend.master')

@section('title')
Dashbaord || {{ title() }}
@endsection

@section('content')
    <div class="sales-report-area mt-5 mb-5">
        <div class="row">
            <div class="col-md-4 py-2" onclick="location.href='{{ route('category.index') }}'" style="cursor: pointer">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            {{-- <h4 class="header-title mb-0">Euthorium</h4> --}}
                            <h3>{{ total_categories() }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total Categories</h2>
                        </div>
                    </div>
                    {{-- <canvas id="coin_sales3" height="100"></canvas> --}}
                </div>
            </div>
            <div class="col-md-4 py-2" onclick="location.href='{{ route('product.index') }}'" style="cursor: pointer">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h3>{{ total_products() }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total Products</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2" onclick="location.href='{{ route('order.index') }}'" style="cursor: pointer">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h3>{{ total_order() }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total Order</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2" onclick="location.href='{{ route('contact.index') }}'" style="cursor: pointer">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h3>{{ total_user_msg() }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total User Msg</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2" onclick="location.href='{{ route('banner.index') }}'" style="cursor: pointer">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h3>{{ total_Banner() }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total Banner</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 py-2" onclick="location.href='{{ route('cupon.index') }}'" style="cursor: pointer">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h3>{{ total_cupon() }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total Cupon</h2>
                        </div>
                    </div>
                </div>
            </div>
            {{-- ABC123@# --}}
            {{-- <div class="col-md-4">
                <div class="single-report">
                    <div class="s-report-inner pr--20 pt--30 mb-3">
                        <div class="icon"><i class="fa fa-map-o"></i></div>
                        <div class="s-report-title d-flex justify-content-between">
                            <h3>{{ () }}</h3>
                        </div>
                        <div class="d-flex justify-content-between pb-2">
                            <h2>Total </h2>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
@endsection
