@extends('backend.master')
@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <h4 class="header-title d-inline">Info List</h4>
                <button type="button" class="btn btn-primary d-inline float-right p-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Info</button>
            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class=" table text-center table-bordered table-responsive-lg">
                        <tbody>
                            @forelse ($info as $data)
                            <tr>
                                <th>Logo</th>
                                <td>
                                    <img src="{{ asset('uploads/logo/'.$data->logo) }}" alt="{{ $data->name }}" class="rounded-circle" style="width:150px; heigth:150px;">
                                </td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $data->email }}</td>
                            </tr>
                            <tr>
                                <th>Number</th>
                                <td>{{ $data->number }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $data->address }}</td>
                            </tr>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('info.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Company Name" value="{{ $data->name }}">
                                                    @error('name')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Company Email" value="{{ $data->email }}">
                                                    @error('email')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="number">Number:</label>
                                                    <input type="number" class="form-control" name="number" id="number" placeholder="Enter Company Number" value="{{ $data->number }}">
                                                    @error('number')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address:</label>
                                                    <input type="text" class="form-control" name="address" id="address" placeholder="Enter Company Address"
                                                        value="{{ $data->address }}">
                                                    @error('address')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="logo">Image:</label>
                                                    <input type="file" accept="image/*" class="form-control" name="logo" id="logo">
                                                    @error('logo')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal-->
                            {{-- <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete '{{ $data->name }}'</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('info.destroy', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                               <h3 class="text-center text-danger">Are You Sure Delete This Categery!?</h3>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div> --}}


                            @empty
                            <tr>
                                <td colspan="50">
                                    <h3 class="text-danger text-center font-weight-bold">No Data Avilable Here!</h3>
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

<!-- Create Modal-->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('info.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name"
                            id="name" placeholder="Enter Company Name"
                            value="{{ old('name') }}">
                        @error('name')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email"
                            id="email" placeholder="Enter Company Email"
                            value="{{ old('email') }}">
                        @error('email')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="number">Number:</label>
                        <input type="number" class="form-control" name="number"
                            id="number" placeholder="Enter Company Number"
                            value="{{ old('number') }}">
                        @error('number')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" class="form-control" name="address"
                            id="address" placeholder="Enter Company Address"
                            value="{{ old('address') }}">
                        @error('address')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="logo">Image:</label>
                        <input type="file" accept="image/*" class="form-control" name="logo" id="logo">
                        @error('logo')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
