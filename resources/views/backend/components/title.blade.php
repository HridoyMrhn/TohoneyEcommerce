@if(Route::is('dashbaord'))
    @section('page_title') Dashbaord @endsection

@elseif (Route::is('category.*'))
    @section('page_title') Category @endsection

@elseif (Route::is('product.*'))
    @section('page_title') Product @endsection

@elseif (Route::is('testimonial.*'))
    @section('page_title') Testimonial @endsection

@elseif (Route::is('faq.*'))
    @section('page_title') FAQ @endsection

@elseif (Route::is('banner.*'))
    @section('page_title') Banner @endsection

@elseif (Route::is('cupon.*'))
    @section('page_title') Cupon @endsection

@elseif (Route::is('contact.*'))
    @section('page_title') Contact @endsection

@elseif (Route::is('order.*'))
    @section('page_title') Order @endsection

@elseif (Route::is('invoice.show'))
    @section('page_title') Invoice @endsection
@endif
