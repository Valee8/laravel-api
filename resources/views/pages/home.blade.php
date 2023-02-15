@extends('layouts.main-layout')

@section('content')

    <h1>
        Genres
    </h1>

    @foreach ($genres as $genre)
        <h2>{{ $genre -> name }}</h2>
        
        <ul>
            @foreach ($genre -> movies as $movie)
                <li>
                    Name: {{ $movie -> name }} - Year: {{ $movie -> year }} - Cash Out: {{ $movie -> cashOut }}&dollar;
                </li>
            @endforeach
        </ul>
    @endforeach
    
@endsection