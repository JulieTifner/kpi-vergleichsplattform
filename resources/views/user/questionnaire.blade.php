@extends('layouts.app')

@section('content')
    <div class="questionnaire">
        <div class="container mt-5" style="width: 40rem;">
            <div class="card shadow-sm" style="padding: 10px;">
                <div class="d-flex">
                    <h2 class="card-title p-2 flex-grow-1 ">{{ $questionnaire->name }}</h2>
                    <div class="p-3">
                        <span class="badge bg-secondary">{{ $questionnaire->year }}</span>
                        <span class="badge bg-info" style="color:black;">{{ $questionnaire->timespan }}</span>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post" style="width: 37rem;">
                        @csrf
                        @foreach ($questions as $q)
                            <div class="mb-3">
                                <label for="question{{ $q->id }}"> {{ $q->name }}</label>
                                <div class="input-group" style="width: 10rem;">
                                    <input type="text" class="form-control" id="answers{{ $q->id }}"
                                    name="answers[{{ $q->id }}]"
                                    value="{{ $q->answer->first() ? $q->answer->first()->name : '' }}"
                                    aria-describedby="answer-addon{{ $q->id }}">
                                    <span class="input-group-text"
                                    id="answer-addon{{ $q->id }}">{{ $q->type == 1 ? '%' : '0' }}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="p-4 d-flex justify-content-end">
                            <a href="{{ route('questionnaire') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-dark">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection