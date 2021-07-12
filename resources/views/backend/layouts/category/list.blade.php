@extends('backend.master')

@section('page_title')
Role
@endsection

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <h4 class="header-title d-inline">Category List</h4>
                <button type="button" class="btn btn-primary d-inline float-right p-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Category</button>
            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class=" table text-center table-bordered table-responsive-lg">
                        <thead class="text-capitalize">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Parent category</th>
                                <th scope="col">image</th>
                                <th scope="col">Created by</th>
                                <th scope="col">info</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $data)
                            <tr>
                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @isset($data->subcategory->name)
                                    {{ $data->subcategory->name }}
                                    @endisset
                                </td>
                                <td>
                                    <img src="{{ asset('uploads/category/'.$data->image) }}" alt="{{ $data->name }}" class="rounded-circle" style="width:50px; heigth:50px;">
                                </td>
                                <td>
                                    @isset($data->user->name)
                                    {{ $data->user->name }}
                                    @endisset
                                </td>
                                <td>{{ $data->description }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="#editModal{{ $data->id }}" data-toggle="modal" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                        <a href="#deleteModal{{ $data->id }}" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>

                            <!-- Edit Modal-->
                            <div class="modal fade" id="editModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit {{ $data->name }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Name:</label>
                                                    <input type="name" class="form-control" name="name" id="name" placeholder="Enter category Name" value="{{ $data->name }}">
                                                    @error('name')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="parent_id">Pareent Category:</label>
                                                    <select name="parent_id" id="parent_id" class="form-control">
                                                        <option value="" selected>Choose Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $data->parent_id == $category->id ? 'selected':'' }}>{{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="image">Image:</label>
                                                    <input type="file" accept="image/*" class="form-control" name="image" id="image">
                                                    @error('image')
                                                        <b class="text-danger">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description:</label>
                                                    <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter category Description">{{ $data->description }}</textarea>
                                                    @error('description')
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
                            <div class="modal fade" id="deleteModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete '{{ $data->name }}'</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('category.destroy', $data->id) }}" method="POST" enctype="multipart/form-data">
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
                            </div>


                            @empty
                            <tr>
                                <td colspan="50">
                                    <h3 class="text-danger text-center font-weight-bold">No Data Avilable Here!</h3>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="name" class="form-control" name="name"
                            id="name" placeholder="Enter category Name"
                            value="{{ old('name') }}">
                        @error('name')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Pareent Category:</label>
                        <select name="parent_id" id="parent_id" class="form-control">
                            <option value="" selected>Choose Category</option>
                            @foreach ($categories as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">Image:</label>
                        <input type="file" accept="image/*" class="form-control" name="image" id="image">
                        @error('image')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <textarea name="description" id="description" class="form-control"
                            rows="5"
                            placeholder="Enter category Description">{{ old('description') }}</textarea>
                        @error('description')
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
