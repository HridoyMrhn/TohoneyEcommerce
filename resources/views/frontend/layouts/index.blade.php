@extends('frontend.master-home')

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

@include('frontend.layouts.component.slider')
@include('frontend.layouts.component.featured')

<!-- start count-down-section -->
<div class="count-down-area count-down-area-sub">
    <section class="count-down-section section-padding parallax" data-speed="7">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-12 text-center">
                    <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                </div>
                <div class="col-12 col-lg-12 text-center">
                    <div class="count-down-clock text-center">
                        <div id="clock">
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
</div>
<!-- end count-down-section -->

@include('frontend.layouts.component.best-seller')
@include('frontend.layouts.component.product')
@include('frontend.layouts.component.testimonial')
@endsection
