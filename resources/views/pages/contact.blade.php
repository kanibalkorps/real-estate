@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="mt-5 mb-4">Contact Our Team</h1>
                @if(!auth()->check())
                    <a class="text-center text-light bg-primary rounded px-3 py-2" href="{{ route("login") }}">Login to send emails</a>
                @else
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Dear admins..."></textarea>
                        </div>
                        <input value="Send" type="submit" class="btn btn-primary"/>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection
