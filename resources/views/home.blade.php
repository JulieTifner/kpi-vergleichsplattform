@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="container">
            <div class="row justify-content-center align-items-center" style="height: 80vh;">
                <div class="col-md-8 text-center">
                    <img src="/assets/imgs/kg_logo.public.jpg" alt="" style="width: 70vh;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::user())
                        <h1>Welcome</h1>
                    @else
                        <div class="home-btns p-4 d-flex justify-content-center">
                            <a href="{{ route('login') }}" class="login btn btn-dark me-2">Login</a>
                            <a href="{{ route('register') }}" class="register btn btn-secondary">Register</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
