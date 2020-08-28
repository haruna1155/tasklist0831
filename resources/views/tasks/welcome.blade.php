@extends('layouts.app')

@section('content')
        <div class="center jumbotron mt-3">
            <div class="text-center">
                <h1>Welcome to the Tasklist!!</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-warning btn-lg']) !!}
            </div>
        </div>
@endsection