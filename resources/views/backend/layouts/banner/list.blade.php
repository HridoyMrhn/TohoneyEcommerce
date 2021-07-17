@extends('backend.master')

@section('title') Banner Page || {{ title() }} @endsection

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <h4 class="header-title d-inline">All Banner</h4>
                <button type="button" class="btn btn-primary d-inline float-right p-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add Banner</button>
            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class=" table text-center table-bordered table-responsive-lg">
                        <thead class="text-capitalize">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Link</th>
                                <th scope="col">Link Name</th>
                                <th scope="col">image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $data)
                            <tr>
                                <td>{{ $banners->firstItem() + $loop->index }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->link }}</td>
                                <td>{{ $data->link_name }}</td>
                                <td>
                                    <img src="{{ asset('uploads/banner/'.$data->image) }}" alt="{{ $data->name }}" class="rounded-circle" style="width:50px; heigth:50px;">
                                </td>
                                <td>{{ Str::limit($data->info, 40, '...') }}</td>
                                <td>
                                    @if ($data->status == 'active')
                                        <a href="{{ route('banner.deactive', $data->id) }}"><span class="badge badge-success">{{ $data->status }}</span></a>
                                    @elseif ($data->status == 'deactive')
                                    <a href="{{ route('banner.active', $data->id) }}"><span class="badge badge-danger">{{ $data->status }}</span></a>
                                    @endif
                                </td>
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
                                        <form action="{{ route('banner.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name" class="col-form-label">Banner Name:</label>
                                                    <input type="text" name="name" id="name" class="form-control" value="{{ $data->name }}" placeholder="Enter Banner Name">
                                                </div>
                                                <div class="form-group">
                                                    <label for="link" class="col-form-label">Banner Link:</label>
                                                    <input type="text" name="link" id="link" class="form-control" value="{{ $data->link }}" placeholder="Enter Banner Link">
                                                </div>
                                                <div class="form-group">
                                                    <label for="link_name" class="col-form-label">Banner Link Name:</label>
                                                    <input type="text" name="link_name" id="link_name" class="form-control" value="{{ $data->link_name }}" placeholder="Enter Banner Link">
                                                </div>
                                                <div class="form-group">
                                                    <label for="image" class="col-form-label">Banner image:</label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="info" class="col-form-label">Banner info:</label>
                                                    <textarea name="info" id="info" rows="5" placeholder="Entr Banner Details" class="form-control">value="{{ $data->info }}"</textarea>
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
                                        <form action="{{ route('banner.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                               <h3 class="text-center text-danger">Are You Sure Delete This Banner!?</h3>
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
                    {{ $banners->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Create Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Banner Name:</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Banner Name">
                    </div>
                    <div class="form-group">
                        <label for="link" class="col-form-label">Banner Link:</label>
                        <input type="text" name="link" id="link" class="form-control" placeholder="Enter Banner Link">
                    </div>
                    <div class="form-group">
                        <label for="link_name" class="col-form-label">Banner Link Name:</label>
                        <input type="text" name="link_name" id="link_name" class="form-control" placeholder="Enter Banner Link">
                    </div>
                    <div class="form-group">
                        <label for="image" class="col-form-label">Banner image:</label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="info" class="col-form-label">Banner info:</label>
                        <textarea name="info" id="info" rows="5" placeholder="Entr Banner Details" class="form-control"></textarea>
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
