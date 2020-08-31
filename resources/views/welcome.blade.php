@extends('layouts.app')

@section('content')

    @if (Auth::check())
        @include('tasks.tasks')
    @else
        <div class="center jumbotron mt-3">
            <div class="text-center">
                <h1>Welcome to the Tasklist!!</h1>
                {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-warning btn-lg']) !!}
            </div>
        </div>
    @endif    
@endsection