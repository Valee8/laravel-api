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
}
