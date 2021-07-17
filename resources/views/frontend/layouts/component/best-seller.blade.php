<div class="product-area product-area-2">
    <div class="fluid-container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Best Sells</h2>
                    <img src="assets/images/section-title.png" alt="">
                </div>
            </div>
        </div>
        <ul class="row">
            <li>
                @foreach ($best_products as $data)
                    @include('frontend.layouts.component.product-show')
                @endforeach
            </li>
        </ul>
    </div>
</div>
