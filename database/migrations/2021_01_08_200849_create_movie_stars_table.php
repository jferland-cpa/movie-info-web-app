<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieStarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_stars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("role", 75);
            $table->unsignedBigInteger("movie_id");
            $table->unsignedBigInteger("star_id");
            $table->unique(["movie_id", "star_id"]);
            $table->foreign("movie_id")->references("id")->on("movies")->onDelete("cascade");
            $table->foreign("star_id")->references("id")->on("stars")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_stars');
    }
}
