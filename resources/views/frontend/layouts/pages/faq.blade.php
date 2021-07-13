@extends('frontend.master')
@section('contact')
faq
@endsection

@section('page_header')
FAQ
@endsection

@section('page_name')
Faq
@endsection
@section('content')

<div class="about-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="about-wrap text-center"><h3>FAQ</h3></div>
                <div class="accordion" id="accordionExample">
                @foreach ($faqs as $data)
                    <div class="card border-0">
                        <div class="card-header border-0 p-0 my-3">
                            <button class="btn btn-link text-left py-3 w-100 text-white"
                                type="button" data-toggle="collapse" data-target="#faq1"
                                aria-expanded="true" aria-controls="faq1">{{ $data->faq_question }}</button>
                        </div>

                        <div id="faq1" class="collapse show" aria-labelledby="faq1"
                            data-parent="#accordionExample">
                            <div class="card-body">{{ $data->faq_answer }}</div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
