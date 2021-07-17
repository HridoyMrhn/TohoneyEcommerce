@extends('frontend.master')

@section('content')

<div class="product-area">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    @if (Route::is('search'))
                        <h2>
                            Searched Products -
                            {!! $search != '' ?  "Name: <strong>$search</strong> ":'' !!}
                        </h2>
                    @else
                        <h2>{{ $categories->name }}</h2>
                    @endif
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        {{-- @dd($categories->products) --}}
        <ul class="row">
            <li>
                @foreach ($catProducts as $data)
                    @include('frontend.layouts.component.product-show')
                @endforeach
            </li>
            <li class="col-12 text-center">
                {{ $catProducts->withQueryString()->links() }}
            </li>
        </ul>
    </div>
</div>


@endsection
