@if (session()->has('s_status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong class="text-dark">{{ session()->get('s_status') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif (session()->has('b_status'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong class="text-dark">{{ session()->get('b_status') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

@elseif ($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    @foreach ($errors->all() as $data)
        <li class="text-danger font-weight-bold">{{ $data }}</li>
    @endforeach
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
