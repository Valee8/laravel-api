@extends('layouts.main-layout')

@section('content')

    <h1>
        Movies
    </h1>

    <h2>
        <a href="{{ route('movie.create')}}">Create new Movie</a>
    </h2>

    <a href="{{ route('home') }}">Back</a>

    <ul>
        @foreach ($movies as $movie)
            <li>
                Name: {{ $movie -> name }} - Year: {{ $movie -> year }} - Cash Out: {{ $movie -> cashOut }}&dollar;
                - <a href="{{ route('movie.delete', $movie )}}">Delete</a>
            </li>
        @endforeach
    </ul>
    
@endsection