@extends('backend.master')

@section('title') Testimonial Page || {{ title() }} @endsection

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <h4 class="header-title d-inline">All Testimonial</h4>
                <button type="button" class="btn btn-primary d-inline float-right p-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Testimonial</button>
            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class=" table text-center table-bordered table-responsive-lg">
                        <thead class="text-capitalize">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Author</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Image</th>
                                <th scope="col">info</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>



                            @forelse ($testimonials as $data)
                            <tr>
                                <td>{{ $testimonials->firstItem() + $loop->index }}</td>
                                <td>{{ $data->author_name }}</td>
                                <td>{{ $data->author_designation }}</td>
                                <td>
                                    <img src="{{ asset('uploads/testimonial/'.$data->author_image) }}" alt="{{ $data->author_name }}" class="rounded-circle" style="width:50px; heigth:50px;">
                                </td>
                                <td>{{ $data->author_quote }}</td>
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
                                        <form action="{{ route('testimonial.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="author_name" class="form-label">Testimonial Author Name</label>
                                                    <input type="text" class="form-control" name="author_name" id="author_name" value="{{ $data->author_name }}" placeholder="Enter Testimonial Author Name">
                                                    @error('author_name')
                                                    <b class="text-danger font-weight-bold">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="author_designation" class="form-label">Author Designation</label>
                                                    <input type="text" class="form-control" name="author_designation" id="author_designation" value="{{ $data->author_designation }}" placeholder="Author Designation">
                                                    @error('author_designation')
                                                    <b class="text-danger font-weight-bold">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="author_image" class="form-label">Testimonial image</label>
                                                    <input type="file" class="form-control" name="author_image" id="author_image" accept="image">
                                                </div>
                                                <div class="form-group">
                                                    <label for="author_quote" class="form-label">Testimonial Quote</label>
                                                    <textarea name="author_quote" id="author_quote" class="form-control"  rows="5" placeholder="Testimonial Quiote Here">{{ $data->author_quote }}</textarea>
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
                                        <form action="{{ route('testimonial.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                               <h3 class="text-center text-danger">Are You Sure Delete This Testimonial!?</h3>
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
                    {{ $testimonials->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Create testimonial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('testimonial.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="author_name" class="form-label">Testimonial Author Name</label>
                        <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Enter Testimonial Author Name">
                        @error('author_name')
                        <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author_designation" class="form-label">Author Designation</label>
                        <input type="text" class="form-control" name="author_designation" id="author_designation"
                            placeholder="Author Designation">
                        @error('author_designation')
                        <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="author_image" class="form-label">Testimonial image</label>
                        <input type="file" class="form-control" name="author_image" id="author_image" accept="image">
                    </div>
                    <div class="form-group">
                        <label for="author_quote" class="form-label">Testimonial Quote</label>
                        <textarea name="author_quote" id="author_quote" class="form-control"  rows="5" placeholder="Testimonial Quiote Here"></textarea>
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
