@extends('layouts.main-layout')

@section('content')
    
    <h1>Update movie: {{ $movie -> name }}</h1>
    
    <form method="POST" action="{{ route('movie.update', $movie) }}">
        @csrf
        <label for="name">Name: </label>
        <input type="text" name="name" value="{{ $movie -> name }}">
        <br>
        <label for="year">Year: </label>
        <input type="text" name="year" value="{{ $movie -> year }}">
        <br>
        <label for="cashOut">Cash Out: </label>
        <input type="number" name="cashOut" value="{{ $movie -> cashOut }}">

        <br>

        <label for="genre">Genre</label>
        <select name="genre_id">
            @foreach ($genres as $genre)
                <option value="{{ $genre -> id }}"
                    @if ($movie -> genre -> id == $genre -> id)
                        selected
                    @endif
                    >{{ $genre -> name }}</option>    
            @endforeach
        </select>

        <br>

        <h3>Tags</h3>

        @foreach ($tags as $tag)
            <input type="checkbox" name="tags_id[]" value="{{ $tag -> id }}"
                @foreach ($movie -> tags as $movieTag)
                    @if ($movieTag -> id == $tag -> id)
                        checked
                    @endif
                @endforeach
            >
            <label for="{{ $tag -> id }}">{{ $tag -> name }}</label> 
            <br>       
        @endforeach

        <input type="submit" value="UPDATE">
    </form>

@endsection