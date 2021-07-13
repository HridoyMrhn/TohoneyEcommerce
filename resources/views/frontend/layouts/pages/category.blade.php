@extends('frontend.master')

@section('content')

<div class="product-area">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>{{ $categories->name }}</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        {{-- @dd($categories->products) --}}
        <ul class="row">
        @foreach ($categories->products as $data)
            @include('frontend.layouts.component.product-show')
        @endforeach

            <li class="col-12 text-center">
                {{-- {{ $categories->links() }} --}}
            </li>
        </ul>
    </div>
</div>


@endsection
