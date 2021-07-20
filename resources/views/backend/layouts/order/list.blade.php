@extends('backend.master')

@section('title') Order Page || {{ title() }} @endsection

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                @if (Route::is('order.index'))
                    <h4 class="header-title d-inline">All Order</h4>
                @elseif (Route::is('order.orderAccept'))
                    <h4 class="header-title d-inline">Accepted Orders</h4>
                @elseif (Route::is('order.orderPending'))
                    <h4 class="header-title d-inline">Pending Orders</h4>
                @endif

            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class="table text-center table-bordered table-responsive-lg">
                        <thead class="text-capitalize">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Date</th>
                                <th scope="col">Cupon</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Discount</th>
                                <th scope="col">Total</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Transaction_id</th>
                                <th scope="col">Status</th>
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
                                <td>{{ $data->payment_gateway }}</td>
                                <td>{{ $data->transaction_id }}</td>
                                <td>
                                    @if ($data->status == 'pending')
                                        <div class="btn btn-group btn-group-sm p-0">
                                            <a href="{{ route('order.accept', $data->id) }}" class="btn btn-info">Pending</a>
                                            <a href="{{ route('order.cancel', $data->id) }}" class="btn btn-danger">Cancel</a>
                                        </div>
                                    @elseif ($data->status == 'accept')
                                        <div class="btn btn-group btn-group-sm p-0">
                                            <span class="btn btn-success">Accept</span>
                                        </div>
                                    @elseif ($data->status == 'cancel')
                                        <div class="btn btn-group-sm p-0">
                                            <span class="btn btn-danger">Cancel</span>
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('invoice.show', $data->id) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('invoice.download', $data->id) }}" class="btn btn-secondary"><i class="fa fa-download"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="50">
                                    <h3 class="text-danger text-center font-weight-bold">No Data Avilable Here!</h3>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
