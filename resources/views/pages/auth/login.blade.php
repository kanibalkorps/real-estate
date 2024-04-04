@extends('layouts.default')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card wow fadeIn">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login-user') }}">
                            @CSRF
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password">
                            </div>

                            @if(session()->has("error"))
                                <p class="text-danger">{{ session("error") }}</p>
                            @endif


                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                            <p class="d-inline">Don't have an account?</p><span><a href="{{ route("register") }}" class="text-primary d-inline"> Sign up</a></span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
