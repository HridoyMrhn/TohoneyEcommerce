@extends('backend.master')

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
                                <th scope="col">Email</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">Status</th>
                                <th scope="col">File</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contacts as $data)
                            <tr>
                                <td>{{ $contacts->firstItem() + $loop->index }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->subject }}</td>
                                <td>{{ $data->msg }}</td>
                                <td>
                                    @if ($data->status == 'unseen')
                                        <a href="{{ route('contact.seen', $data->id) }}"><span class="badge badge-danger">{{ $data->status }}</span>
                                        </a>
                                    @elseif ($data->status == 'seen')
                                        <a href="{{ route('contact.unseen', $data->id) }}"><span class="badge badge-success">{{ $data->status }}</span>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                    @if ($data->files)
                                        <a href="{{ asset('uploads/contact/'.$data->files) }}" target="_blank`" class="btn btn-primary"><i class="fa fa-file"></i></a>
                                        <a href="{{ route('contact.download', $data->id) }}"class="btn btn-success"><i class="fa fa-download"></i></a>
                                    @endif
                                        <a href="#deleteModal{{ $data->id }}" data-toggle="modal" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </div>
                                </td>
                            </tr>

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
                                        <form action="{{ route('contact.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                               <h3 class="text-center text-danger">Are You Sure Delete This Contact!?</h3>
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
                    {{ $contacts->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
