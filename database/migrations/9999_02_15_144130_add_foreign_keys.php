<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            
            $table -> foreignId('genre_id')
                   -> constrained();

        });

        Schema::table('tag_movie', function (Blueprint $table) {

            $table -> foreignId('tag_id')
                   -> constrained();

            $table -> foreignId('movie_id')
                   -> constrained();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('movies', function (Blueprint $table) {
            
            $table -> dropForeign('movies_genre_id_foreign');

        });

        Schema::table('tag_movie', function (Blueprint $table) {

            $table -> dropForeign('tag_movie_tag_id_foreign');

            $table -> dropForeign('tag_movie_movie_id_foreign');
        
        });
    }
};
