@include('backend.partilas.header')
@include('backend.partilas.sidebar')
@include('backend.partilas.topbar')
@include('backend.components.title')
@include('backend.partilas.breadcrumb')
    <div class="main-content-inner">
    @yield('content')
    </div>
</div>
@include('backend.partilas.footer')

