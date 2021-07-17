@extends('backend.master')

@section('title') FAQ Page || {{ title() }} @endsection

@section('content')

<div class="mx-auto mt-5 text-center col-6">@include('backend.components.status')
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header">
                <h4 class="header-title d-inline">FAQ Page</h4>
                <button type="button" class="btn btn-primary d-inline float-right p-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add FAQ</button>
            </div>
            <div class="card-body p-0">
                <div class="data-tables datatable-dark">
                    <table class=" table text-center table-bordered table-responsive-lg">
                        <thead class="text-capitalize">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Questiion</th>
                                <th scope="col">Answer</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($faqs as $data)
                            <tr>
                                <td>{{ $faqs->firstItem() + $loop->index }}</td>
                                <td>{{ $data->question }}</td>
                                <td>{{ Str::limit($data->answer, 100, '...') }}</td>
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
                                            <h5 class="modal-title">Edit FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('faq.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="question" class="form-label">Question</label>
                                                    <input type="text" class="form-control" name="question" id="question" placeholder="FAQ Qustion" value="{{ $data->question }}">
                                                    @error('question')
                                                    <b class="text-danger font-weight-bold">{{ $message }}</b>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="answer" class="form-label">Answer</label>
                                                    <textarea name="answer" id="answer" class="form-control" rows="10" placeholder="FAQ Answer">{{ $data->answer }}</textarea>
                                                    @error('answer')
                                                    <b class="text-danger font-weight-bold">{{ $message }}</b>
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
                                            <h5 class="modal-title" id="exampleModalLabel">Delete FAQ</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('faq.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                               <h3 class="text-center text-danger">Are You Sure Delete This FAQ!?</h3>
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
                    {{ $faqs->links() }}
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
                <h5 class="modal-title" id="exampleModalLabel">Create FAQ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('faq.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" name="question"
                            id="question" placeholder="FAQ Qustion">
                        @error('question')
                        <b class="text-danger font-weight-bold">{{ $message }}</b>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea name="answer" id="answer" class="form-control" rows="10" placeholder="FAQ Answer"></textarea>
                        @error('answer')
                        <b class="text-danger font-weight-bold">{{ $message }}</b>
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
