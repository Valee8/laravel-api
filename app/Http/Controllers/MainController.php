<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Genre;

class MainController extends Controller
{
    public function home() {

        $movies = Movie::all();
        $genres = Genre::all();

        return view('pages.home', compact('movies', 'genres'));
    }
}
