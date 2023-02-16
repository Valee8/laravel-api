<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Tag;

class MainController extends Controller
{
    public function home() {

        $genres = Genre::all();

        return view('pages.home', compact('genres'));
    }

    public function movies() {

        $movies = Movie::all();

        return view('pages.movie.home', compact('movies'));
    }

    public function movieDelete(Movie $movie) {

        $movie -> tags() -> sync([]);

        $movie -> delete();

        return redirect() -> route('movie.home');
    }

    public function movieCreate() {

        $tags = Tag::all();

        $genres = Genre::all();

        return view('pages.movie.create', compact('tags', 'genres'));
    }

    public function movieStore(Request $request) {

        $data = $request -> validate([
            'name' => 'required|string|min:3|max:64',
            'year' => 'required|integer|min:1900',
            'cashOut' => 'nullable|integer|min:0',
            'genre_id' => 'required|integer',
            'tags_id' => 'required|array',
        ]);

        $movie = Movie::make($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        $tags = Tag::find($data['tags_id']);
        $movie -> tags() -> attach($tags);

        return redirect() -> route('movie.home');
    }
}
