@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h2>Questionnaires</h2>
            <div class="questionnaires">
                <div class="table-container">
                    <table class="table table-responsive-md">
                        <thead class="thead">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Timespan</th>
                                <th scope="col">Year</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questionnaires as $q)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $q->name }}</td>
                                    <td>{{ $q->timespan }}</td>
                                    <td>{{ $q->year }}</td>

                                    <td style="width: 100px;">
                                        <div class="d-flex" role="group">

                                            <a href=""
                                                class="btn btn-dark btn-sm me-2"
                                                style="background-color: #f86e38; border:none;">Answer</a>

                                            <a href=""
                                                class="btn btn-dark btn-sm me-2"
                                                style="background-color: #3168ff; border: none;">Compare</a>

                                            <form action="" method="POST"
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

                    <button type="button" class="btn btn-dark" style="color:white;" data-bs-toggle="modal"
                        data-bs-target="#createModal">Create</button>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection