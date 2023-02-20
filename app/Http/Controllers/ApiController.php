<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;
use App\Models\Tag;
use App\Models\Genre;


class ApiController extends Controller
{
    public function movieAll() {

        $tags = Tag::all();
        $movies = Movie::all();
        $genres = Genre::all();

        return response() ->json([
            'success' => true,
            'response' => [
                'movies' => $movies,
                'genres' => $genres,
                'tags' => $tags,
            ]
        ]);
    }
}
