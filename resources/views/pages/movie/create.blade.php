@extends('layouts.main-layout')

@section('content')

    <h1>
        Create
    </h1>

    <form method="POST" action="{{ route('movie.store')}}">
        @csrf
        <label for="name">Name: </label>
        <input type="text" name="name">
        <br>
        <label for="year">Year: </label>
        <input type="text" name="year">
        <br>
        <label for="cashOut">Cash Out: </label>
        <input type="number" name="cashOut">
        <br>
        <label for="genre">Genres: </label>
        <select name="genre_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre -> id }}">{{ $genre -> name }}</option>
            @endforeach
        </select> 
        <br>
        <h3>
            Tags
        </h3> 
        @foreach ($tags as $tag)
            <input type="checkbox" name="tags_id[]" value="{{ $tag -> id }}">
            <label for="{{ $tag -> id }}">{{ $tag -> name }}</label>
            <br>
        @endforeach
        <input type="submit" value="CREATE">
    </form>
    
@endsection