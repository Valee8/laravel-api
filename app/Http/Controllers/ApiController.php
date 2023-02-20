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

    public function movieStore(Request $request) {

        $data = $request -> validate([
            'name' => 'required|string|min:3|max:64',
            'year' => 'required|integer|min:1900',
            'cashOut' => 'nullable|integer|min:0',
            'genre_id' => 'required|integer|min:1',
            'tags_id' => 'nullable|array',
        ]);

        $movie = Movie::make($data);
        $genre = Genre::find($data['genre_id']);

        $movie -> genre() -> associate($genre);
        $movie -> save();

        $tags = Tag::find($data['tags_id']);
        $movie -> tags() -> attach($tags);

        return response() -> json([
            'success' => true,
            'response' => $movie,
            'data' => $request -> all()
        ]);
    }
}
