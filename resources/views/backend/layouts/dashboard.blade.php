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
                            <h3>{{ total_orders() }}</h3>
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
        </div>

        <div class="row mt-5">
            <div class="col-lg-6 py-2">
                <div class="single-report p-3">
                    <h2 class="text-center">Order Chart</h2>
                    <canvas id="orderChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6 py-2">
                <div class="single-report p-3">
                    <h2 class="text-center">Product Chart</h2>
                    <canvas id="productChart"></canvas>
                </div>
            </div>
            <div class="col-lg-6 py-2">
                <div class="single-report p-3">
                    <h2 class="text-center">Total Sale Chart</h2>
                    <canvas id="totalSale"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // =================== Order Chart
        var ctx = document.getElementById('orderChart').getContext('2d');
        var orderChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Total Order', 'Pending', 'Accept', 'Cancel'],
                datasets: [{
                    label: '# of Votes',
                    data: [{{ total_orders() }}, {{ total_pending_orders() }}, {{ total_accept_orders() }}, {{ total_cancel_orders() }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // =================== Product Chart
        var ctx = document.getElementById('productChart').getContext('2d');
        var productChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Total Product', 'Alert Product'],
                datasets: [{
                    label: '# of Votes',
                    data: [{{ total_products() }}, {{ alert_products() }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        // =================== Total Sale Chart
        var ctx = document.getElementById('totalSale').getContext('2d');
        var totalSale = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['Total Sale'],
                datasets: [{
                    label: '# of Votes',
                    data: [{{ total_sale_amount() }}],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

@endsection
