@extends('backend.master')


@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <h4 class="header-title d-inline">Product List</h4>
                <button type="button" class="btn btn-primary d-inline float-right p-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Product</button>
            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class=" table text-center table-bordered table-responsive-lg">
                        <thead class="text-capitalize">
                            <tr>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Categoey</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">info</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $data)
                            <tr>
                                <td>{{ $products->firstItem() + $loop->index }}</td>
                                <td>{{ $data->name }}</td>
                                <td>
                                    @isset($data->category->name)
                                    {{ $data->category->name }}
                                    @endisset
                                </td>
                                <td>
                                    <img src="{{ asset('uploads/product/'.$data->image) }}" alt="{{ $data->name }}" class="rounded-circle" style="width:50px; heigth:50px; line-height:50px">
                                </td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->quantity }}</td>
                                <td>{{ $data->short_description }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="" data-toggle="modal" class="btn btn-dark"><i class="fa fa-eye"></i></a>
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
                                        <form action="{{ route('product.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="category_id" class="form-label">Select Category</label>
                                                    <select name="category_id" id="category_id" class="form-control">
                                                        <option value="" selected>Selecte Category</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ ($category->id == $data->category_id) ? "selected":""}} >{{ $category->name }}
                                                        </option>
                                                    @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="name" class="form-label">Product Name</label>
                                                    <input type="text" class="form-control" name="name" id="name" value="{{ $data->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="price" class="form-label">Product Price</label>
                                                    <input type="number" class="form-control" name="price"
                                                        id="price" value="{{ $data->price }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity" class="form-label">Product Quantity</label>
                                                    <input type="number" class="form-control" name="quantity" id="quantity" value="{{ $data->quantity }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="quantity_alert" class="form-label">Quantity Alert</label>
                                                    <input type="number" class="form-control" name="quantity_alert"
                                                        id="quantity_alert" value="{{ $data->quantity_alert }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="image" class="form-label">Product image</label>
                                                    <input type="file" class="form-control mb-5" name="image" id="image">
                                                </div>
                                                <div class="form-group">
                                                    <label for="multiple_image" class="form-label">Multiple image</label>
                                                    <input type="file" class="form-control" name="multiple_image[]" id="multiple_image" multiple>
                                                </div>
                                                <div class="form-group">
                                                    <label for="short_description" class="form-label">Short Description</label>
                                                    <textarea class="form-control" name="short_description" id="short_description" rows="3">{{ $data->short_description }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="long_description" class="form-label">Long Description</label>
                                                    <textarea class="form-control" name="long_description" id="long_description" rows="10">{{ $data->long_description }}</textarea>
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
                                        <form action="{{ route('product.destroy', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                               <h3 class="text-center text-danger">Are You Sure Delete This Product!?</h3>
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
                    {{ $products->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Create Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="category_id" class="form-label">Select Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <b class="text-danger">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Product Name">
                        @error('name')
                            <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="number" class="form-control" name="price" id="price" placeholder="Enter Product Price">
                    </div>
                    <div class="form-group">
                        <label for="quantity" class="form-label">Product Quantity</label>
                        <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter Product Quantity">
                        @error('quantity')
                            <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quantity_alert" class="form-label">Quantity Alert</label>
                        <input type="number" class="form-control" name="quantity_alert" id="quantity_alert" placeholder="Quantity Alert">
                        @error('quantity_alert')
                            <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="image" class="form-label">Product image</label>
                        <input type="file" class="form-control" name="image" id="image" onchange="imagePreview(this)">
                        <img class="hidden" id="image_viewer" src="#">
                        @error('image')
                            <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                        <style media="screen">
                            .hidden {display: none;}
                        </style>
                        <script>
                            function imagePreview(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function (e) {
                                        $('#image_viewer').attr('src', e.target.result).width(150).height(150);
                                    };
                                    $('#image_viewer').removeClass('hidden');
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>
                    <div class="form-group">
                        <label for="multiple_image" class="form-label">Multiple image</label>
                        <input type="file" class="form-control" name="multiple_image[]" id="multiple_image" multiple>
                        @error('multiple_image')
                            <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="short_description" class="form-label">Short Description</label>
                        <textarea class="form-control" name="short_description" id="short_description" placeholder="Short Description" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_description" class="form-label">Long Description</label>
                        <textarea class="form-control" name="long_description" id="long_description" placeholder="Details Here" rows="5"></textarea>
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
