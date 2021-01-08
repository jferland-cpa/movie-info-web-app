<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_languages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger("movie_id");
            $table->unsignedBigInteger("language_id");
            $table->unique(["movie_id", "language_id"]);
            $table->foreign("movie_id")->references("id")->on("movies")->onDelete("cascade");
            $table->foreign("language_id")->references("id")->on("languages")->onDelete("cascade");
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
        Schema::dropIfExists('movie_languages');
    }
}
