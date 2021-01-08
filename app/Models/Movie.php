<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function directors() {
        return $this->belongsToMany(Director::class, "movie_directors", "movie_id", "director_id");
    }

    public function writers() {
        return $this->belongsToMany(Writer::class, "movie_writers", "movie_id", "writer_id");
    }

    public function stars() {
        return $this->belongsToMany(Star::class, "movie_stars", "movie_id", "star_id");
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, "movie_genres", "movie_id", "genre_id");
    }

    public function countries() {
        return $this->belongsToMany(Country::class, "movie_countries", "movie_id", "country_id");
    }

    public function languages() {
        return $this->belongsToMany(Language::class, "movie_languages", "movie_id", "language_id");
    }
}
