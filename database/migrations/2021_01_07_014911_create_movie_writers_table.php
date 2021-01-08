<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieWritersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_writers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("specialization", 75)->nullable();
            $table->unsignedBigInteger("movie_id");
            $table->unsignedBigInteger("writer_id");
            $table->unique(["movie_id", "writer_id"]);
            $table->foreign("movie_id")->references("id")->on("movies")->onDelete("cascade");
            $table->foreign("writer_id")->references("id")->on("writers")->onDelete("cascade");
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
        Schema::dropIfExists('movie_writers');
    }
}
