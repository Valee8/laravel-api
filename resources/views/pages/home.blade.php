@extends('layouts.main-layout')

@section('content')

    <h1>
        Genres
    </h1>

    <h2>
        <a href="{{ route('movie.home')}}">Movies List</a>
    </h2>

    @foreach ($genres as $genre)
        <h2>{{ $genre -> name }}</h2>
        
        <ul>
            @foreach ($genre -> movies as $movie)
                <li>
                    Name: {{ $movie -> name }}
                </li>
            @endforeach
        </ul>
    @endforeach
    
@endsection