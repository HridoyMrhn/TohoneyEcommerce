<div class="page-container">
    <!-- sidebar menu area start -->
    <div class="sidebar-menu">
        <div class="main-menu">
            <div class="menu-inner">
                <nav>
                    <ul class="metismenu" id="menu">
                        <li class="{{ Route::is('dashbaord') ? 'active':'' }}">
                            <a href="{{ route('dashbaord') }}" aria-expanded="true"><i class="ti-dashboard"></i><span> dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{ route('index') }}" target="_blank"><i class="ti-dashboard"></i><span> Frontend</span></a>
                        </li>
                        <hr>
                        <li class="{{ Route::is('info.*') ? 'active':'' }}">
                            <a href="{{ route('info.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span> Admin Info</span></a>
                        </li>
                        <li class="{{ Route::is('banner.*') ? 'active':'' }}">
                            <a href="{{ route('banner.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span> Banner</span></a>
                        </li>
                        <li class="{{ Route::is('cupon.*') ? 'active':'' }}">
                            <a href="{{ route('cupon.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span> Cupon</span></a>
                        </li>
                        <li class="{{ Route::is('category.*') ? 'active':'' }}">
                            <a href="{{ route('category.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Category <span class="badge badge-info">{{ total_categories() }}</span></span></a>
                        </li>
                        <li class="{{ Route::is('product.*') ? 'active':'' }}">
                            <a href="{{ route('product.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Product <span class="badge badge-info">{{ total_products() }}</span></span></a>
                        </li>
                        <li class="{{ Route::is('order.*') ? 'active':'' }}">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Orders</span></a>
                            <ul class="collapse">
                                <li class="{{ Route::is('order.index') ? 'active':'' }}">
                                    <a href="{{ route('order.index') }}">All Order <span class="badge badge-info">{{ total_orders() }}</span></a>
                                </li>
                                <li class="{{ Route::is('order.orderPending') ? 'active':'' }}">
                                    <a href="{{ route('order.orderPending') }}">New Order <span class="badge badge-info">{{ total_pending_orders() }}</span></a>
                                </li>
                                <li class="{{ Route::is('order.orderAccept') ? 'active':'' }}">
                                    <a href="{{ route('order.orderAccept') }}">Accepet Order <span class="badge badge-info">{{ total_accept_orders() }}</span></a>
                                </li>
                            </ul>
                        </li>
                        <li class="{{ Route::is('faq.*') ? 'active':'' }}">
                            <a href="{{ route('faq.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span> FAQ</span></a>
                        </li>
                        <li class="{{ Route::is('testimonial.*') ? 'active':'' }}">
                            <a href="{{ route('testimonial.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span> Testimonial</span></a>
                        </li>
                        <li class="{{ Route::is('contact.*') ? 'active':'' }}">
                            <a href="{{ route('contact.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Contact <span class="badge badge-info">{{ total_contacts() }}</span></span></a>
                        </li>
                        <li class="{{ Route::is('newsletter.*') ? 'active':'' }}">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span> Newsletter <span class="badge badge-info">{{ total_newsletter() }}</span></span></a>
                            <ul class="collapse">
                                <li class="{{ Route::is('newsletter.index') ? 'active':'' }}"><a href="{{ route('newsletter.index') }}">All Newsletter</a></li>
                                <li class="{{ Route::is('order.orderPending') ? 'active':'' }}"><a href="{{ route('newsletter.send') }}">Send Newsletter</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-pie-chart"></i><span>Charts</span></a>
                            <ul class="collapse">
                                <li><a href="barchart.html">bar chart</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
