@extends('layouts.app')

@section('content')
    <!-- Modal Create Question -->
    <div class="modal" id="createModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Questionnaire</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form" action="{{ route('questionnaire.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group">
                                <label for="question" class="required">Title</label>
                                <input type="text" class="form-control w-100" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="type" class="required">Year (YYYY)</label>
                                <input type="text" class="form-control w-100" value="<?php echo date('Y'); ?>" id="Title"
                                    name="year" required>
                            </div>
                            <div class="form-group">
                                <label for="type">Quartal / Semester</label>
                                <select class="form-control" id="timespan" name="timespan">
                                    <option value="Null">Null</option>
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="Q1">Q1</option>
                                    <option value="Q2">Q2</option>
                                    <option value="Q3">Q3</option>
                                    <option value="Q4">Q4</option>

                                </select>

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

                                                <a href="{{ route('questionnaire.show', $q->id) }}" class="btn btn-dark btn-sm me-2"
                                                    style="background-color: #f86e38; border:none;">Answer</a>

                                                <a href="{{ route('statistics', $q->id) }}" class="btn btn-dark btn-sm me-2"
                                                    style="background-color: #3168ff; border: none;">Compare</a>

                                                <form action="{{ route('questionnaire.delete', $q->id) }}" method="POST"
                                                    style="display:inline;">
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
                    <div class="d-flex justify-content-end">

                        <button type="button" class="btn btn-dark" style="color:white;" data-bs-toggle="modal"
                            data-bs-target="#createModal">Create</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
