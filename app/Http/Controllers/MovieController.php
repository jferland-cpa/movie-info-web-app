<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Carbon;
use App\Models\Director;
use App\Models\Writer;
use App\Models\Star;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Language;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::find(27);
        $return_data = [
            "title" => $movie->title,
            "description" => $movie->description,
            "directors" => [],
            "writers" => [],
            "stars" => [],
            "genres" => [],
            "rating_value" => $movie->rating_value,
            "rating_description" => $movie->rating_description,
            "countries" => [],
            "languages" => [],
            "release_date" => $movie->release_date,
            "runtime" => $movie->runtime
        ];

        foreach ($movie->directors as $director) {
            $return_data["directors"] []= [
                "first_name" => $director->first_name, 
                "last_name" => $director->last_name
            ];
        }

        foreach ($movie->writers as $writer) {
            $return_data["writers"] []= [
                "first_name" => $writer->first_name, 
                "last_name" => $writer->last_name, 
                "specialization" => $writer->pivot->specialization
            ];
        }

        foreach ($movie->stars as $star) {
            $return_data["stars"] []= [
                "first_name" => $star->first_name,
                "last_name" => $star->last_name,
                "role" => $star->pivot->role
            ];
        }

        foreach ($movie->genres as $genre) {
            $return_data["genres"] []= $genre->name;
        }

        foreach ($movie->countries as $country) {
            $return_data["countries"] []= $country->name;
        }

        foreach ($movie->languages as $language) {
            $return_data["languages"] []= $language->name;
        }

        return response($return_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_movie = new Movie;
        $new_movie->title = $request->title;
        $new_movie->description = $request->description;
        $new_movie->rating_value = $request->rating_value;
        $new_movie->rating_description = $request->rating_description;
        $new_movie->release_date = $request->release_date;
        $new_movie->runtime = $request->runtime;
        $new_movie->save();

        foreach ($request->directors as $director) {
            $existing_director = Director::where([
                "first_name" => $director["first_name"],
                "last_name" => $director["last_name"]
            ])->first();

            if ($existing_director) {
                $new_movie->directors()->attach($existing_director->id);
            } else {
                $new_movie->directors()->create([
                    "first_name" => $director["first_name"],
                    "last_name" => $director["last_name"]
                ]);
            }
        }

        foreach ($request->writers as $writer) {
            $existing_writer = Writer::where([
                "first_name" => $writer["first_name"],
                "last_name" => $writer["last_name"]
            ])->first();
            
            if ($existing_writer) {
                if (isset($writer["specialization"])) {
                    $new_movie->writers()->attach($existing_writer->id, [
                        "specialization" => $writer["specialization"]
                    ]);
                } else {
                    $new_movie->writers()->attach($existing_writer->id);
                }
            } else {
                $new_writer = $new_movie->writers()->create([
                    "first_name" => $writer["first_name"],
                    "last_name" => $writer["last_name"]
                ]);

                if (isset($writer["specialization"])) {
                    $new_movie->writers()->updateExistingPivot($new_writer->id, [
                        "specialization" => $writer["specialization"]
                    ]);
                }
            }
        }

        foreach ($request->stars as $star) {
            $existing_star = Star::where([
                "first_name" => $star["first_name"],
                "last_name" => $star["last_name"]
            ])->first();

            if ($existing_star) {
                if ($star["role"]) {
                    $new_movie->stars()->attach($existing_star->id, [
                        "role" => $star["role"]
                    ]);
                } else {
                    $new_movie->stars()->attach($existing_star->id);
                }
            } else {
                $new_star = $new_movie->stars()->create([
                    "first_name" => $star["first_name"],
                    "last_name" => $star["last_name"]
                ]);

                if ($star["role"]) {
                    $new_movie->stars()->updateExistingPivot($new_star->id, [
                        "role" => $star["role"]
                    ]);
                }
            }
        }

        foreach ($request->genres as $genre) {
            $existing_genre = Genre::where("name", $genre)->first();

            if ($existing_genre) {
                $new_movie->genres()->attach($existing_genre->id);
            } else {
                $new_movie->genres()->create([
                    "name" => $genre
                ]);
            }
        }

        foreach ($request->countries as $country) {
            $existing_country = Country::where("name", $country)->first();

            if ($existing_country) {
                $new_movie->countries()->attach($existing_country->id);
            } else {
                $new_movie->countries()->create([
                    "name" => $country
                ]);
            }
        }

        foreach ($request->languages as $language) {
            $existing_language = Language::where("name", $language)->first();

            if ($existing_language) {
                $new_movie->languages()->attach($existing_language->id);
            } else {
                $new_movie->languages()->create([
                    "name" => $country
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
