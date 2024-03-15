@extends('layouts.app')

@section('content')
    <div class="container mt-5 p-5" style="width: 40rem;">
        <div class="card shadow-sm p-4">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <h1>Edit Question</h1>
            <div class="card-body" style="width: 30rem;">
                <form id="update" action="{{ route('update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="question">Question</label>
                        <textarea class="form-control w-100" id="questionTitle" name="name">{{ $question->name }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type">
                                    <option value="0" {{ $question->type == 0 ? 'selected' : '' }}>Number</option>
                                    <option value="1" {{ $question->type == 1 ? 'selected' : '' }}>Percent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_active" class="d-block">Activate</label>
                                <input type="checkbox" id="is_active" name="is_active"
                                    {{ $question->is_active ? 'checked' : '' }}>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('question') }}" class="btn btn-secondary me-3">Cancel</a>
                        <button type="submit" class="btn btn-dark">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
