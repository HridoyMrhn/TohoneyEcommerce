@extends('backend.master')
@section('title')
Ecommerce
@endsection

@section('dashboard')
active
@endsection
@section('content')

    @if (auth()->user()->role == 'user')
    <h1>Yor are login as User</h1>
    @else
    <h1>Yor are login as {{ auth()->user()->role }}</h1>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-lg-12 p-0 m-0">
                <div class="card">
                    <div class="card-header">
                        <h3>Your Orders</h3>
                    </div>
                    <div class="card-body p-1">
                        <table id="datatable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Cupon</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Discount</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col">Acton</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $key => $data)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                    <td>{{ $data->cupon_name }}</td>
                                    <td>{{ $data->subtotal }}</td>
                                    <td>{{ $data->discount_amount }}</td>
                                    <td>{{ $data->total }}</td>
                                    <td>{{ $data->payment_gatway_name }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm" role="group">
                                            <a href="{{ route('invoice.download', $data->id) }}" class="btn btn-secondary">invoice</a>
                                            <a href="{{ route('cupon.edit', $data->id) }}" class="btn btn-secondary">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- <tr>
                                    <td>
                                        @foreach ($data->relationOrderWithDetials as $data)
                                            <p>{{ $data->relationDetailsWithProduct->product_name }}</p>
                                        @endforeach
                                    </td>
                                </tr> --}}
                                @empty
                                <tr>
                                    <td colspan="50">
                                        <h3 class="text-danger text-center font-weight-bold">No Data
                                            Avilable Here!</h3>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
