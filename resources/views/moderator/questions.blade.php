@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
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
                                                <a href="" class="btn btn-primary btn-sm me-2 edit-button"
                                                    style="color:white; text-decoration: none;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>

                                                <form action="" method="POST" style="display:inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        style="color:white;"
                                                        onclick="return confirm('Are you sure to delete?')">
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

                </div>
            </div>
        </div>
    </div>
@endsection
