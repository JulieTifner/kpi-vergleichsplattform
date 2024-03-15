@extends('layouts.app')

@section('content')
    <!-- Modal Create Question -->
    <div class="modal" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Question</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="{{ route('store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question">Question</label>
                            <textarea type="text" class="form-control w-100" id="title" name="name"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select class="form-control" id="type" name="type">
                                        <option value="1">Percent</option>
                                        <option value="0">Number</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="activate" class="d-block">Activate</label>
                                    <input type="checkbox" id="activate" name="is_active" checked>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-dark" form="form">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create Question End-->

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" id="success-message" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h2>Questions</h2>
                <div class="questions">
                    <div class="table-container">
                        <table class="table table-responsive-md">
                            <thead class="thead">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $q)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration }}</td>
                                        <td>{{ $q->name }}</td>
                                        @if ($q->type == 0)
                                            <td>0</td>
                                        @else
                                            <td>%</td>
                                        @endif
                                        @if ($q->is_active == 1)
                                            <td><span class="badge badge-success">Active</span></td>
                                        @else
                                            <td><span class="badge badge-secondary">Inactive</span></td>
                                        @endif
                                        <td style="width: 100px;">
                                            <div class="d-flex justify-content-center" role="group">
                                                <a href="{{ route('edit', $q->id) }}"
                                                    class="btn btn-primary btn-sm me-2 edit-button"
                                                    style="color:white; text-decoration: none;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                                <form action="{{ route('delete', $q->id) }}" method="POST"
                                                    style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        style="color:white;" onclick="return confirm('Are you sure to delete?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-success" style="color:white;" data-bs-toggle="modal"
                            data-bs-target="#createModal">Create</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
