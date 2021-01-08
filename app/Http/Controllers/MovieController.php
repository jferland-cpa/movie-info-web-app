<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movie = Movie::find(1);
        $rating_string = "Rated " . $movie->rating_value . " for " . $movie->rating_description;
        $return_data = [
            "title" => $movie->title,
            "description" => $movie->description,
            "directors" => [],
            "writers" => [],
            "stars" => [],
            "genres" => [],
            "rating" => $rating_string,
            "countries" => [],
            "languages" => [],
            "release_date" => $movie->release_date,
            "runtime" => $movie->runtime
        ];
        foreach ($movie->directors as $director) {
            $return_data["directors"] []= $director->first_name . " " . $director->last_name;
        }
        foreach ($movie->writers as $writer) {
            $return_data["writers"] []= $writer->first_name . " " . $writer->last_name;
        }
        foreach ($movie->stars as $star) {
            $return_data["stars"] []= $star->first_name . " " . $star->last_name;
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
        //return response($return_data);
        $hparray = [];
        foreach ($movie->stars as $star) {
            $hparray []= $star->pivot->role;
        }
        return response($hparray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
