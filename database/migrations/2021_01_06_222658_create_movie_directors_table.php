<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieDirectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_directors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("movie_id");
            $table->unsignedBigInteger("director_id");
            $table->unique(["movie_id", "director_id"]);
            $table->foreign("movie_id")->references("id")->on("movies")->onDelete("cascade");
            $table->foreign("director_id")->references("id")->on("directors")->onDelete("cascade");
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
        Schema::dropIfExists('movie_directors');
    }
}
