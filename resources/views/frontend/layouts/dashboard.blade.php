@extends('frontend.master-home')
@section('title')
Ecommerce
@endsection

@section('content')

<div class="container">
    <div class="card card-body mt-4">
        <div class="row pb-4">
            <div class="col-lg-3">
                <img src="{{ asset('uploads/user/'.$user->image) }}" class="img img-fluid" style="width:220px; height:220px; line-height:220">
            </div>
            <div class="col-lg-7">
                <h3 class="user-name">{{ $user->name }}</h3>
                <p>
                    <i class="fa fa-envelope"></i> <a
                        href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                </p>
                <p>
                    <i class="fa fa-phone"></i> {{ $user->phone_number }}
                </p>
                <p class="user-location">
                    <i class="fa fa-map"></i> {{ $user->address }}
                </p>
                <p class="font-weight-bold mt-2">About me </p>
                <p class="border p-3">{{ $user->about }}</p>

            </div>
            <div class="col-lg-2">
                <div class="float-right">
                    <a href="#editModal" data-toggle="modal" class="btn btn-success d-inline-block"><i class="fa fa-edit"></i> Edit Profile</a>
                    <div class="mt-2"></div>
                    <a href="#passwordModal" data-toggle="modal" class="btn btn-success d-inline-block"><i class="fa fa-edit"></i> Change Password</a>
                </div>
            </div>
        </div>

        <div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
        </div>

        <div class="border-top mt-3">
            <div class="uploaded-trees">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 p-0 m-0">
                            <div class="card">
                                <div class="card-header">
                                    <h3>Your Order</h3>
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
                                        {{-- <tbody>
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
                                            @empty
                                            <tr>
                                                <td colspan="50">
                                                    <h3 class="text-danger text-center font-weight-bold">No Data
                                                        Avilable Here!</h3>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody> --}}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Your Profile
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-5">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Name: </label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control" @error('phone_number') is-invalid @enderror value="{{ $user->phone_number }}">
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $user->address }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="image">image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="about">About You</label>
                                <textarea name="about" id="about" rows="5" class="form-control">{{$user->about }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Password Edit Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Your Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <div class="modal-body p-5">
                    <div class="form-group">
                        <label for="old_password">Old Password:</label>
                        <input id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="password" autofocus>
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">New Password:</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="password" autofocus>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



@endsection
