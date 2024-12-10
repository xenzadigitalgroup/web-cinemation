<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    public function index() {
        $baseURL = env('MOVIE_DB_BASE_URL');
        $imageBaseURL = env('MOVIE_DB_IMAGE_BASE_URL');
        $apiKey = env('MOVIE_DB_API_KEY');
        $MAX_BANNER = 3;
        $MAX_MOVIE_ITEM = 10;
        $MAX_TV_SHOWS_ITEM = 10;

        // Hit API Banner
        $bannerResponse = Http::get("{$baseURL}/trending/movie/week", [
            'api_key' => $apiKey,
        ]);

        // Prepare variable
        $bannerArray = [];

        // Chek API respon
        if ($bannerResponse->successful()) {
            // Chek data is null or not
            $resultArray = $bannerResponse->object()->results;

            if(isset($resultArray)) {
                // Looping response data
                foreach ($resultArray as $item) {
                    // Save response data to new variable
                    array_push($bannerArray, $item);

                    // Max 3 items
                    if (count($bannerArray) == $MAX_BANNER) {
                        break;
                    }
                }
            }
        }

        // Hit API Top 10 Movie
        $topMoviesResponse = Http::get("{$baseURL}/movie/top_rated", [
            'api_key' => $apiKey,
        ]);

        // Prepare Variable
        $topMoviesArray = [];

        // Check API Response
        if ($topMoviesResponse->successful()) {
            // Check if data is null or not
            $resultArray = $topMoviesResponse->object()->results;
            if (isset($resultArray)) {
                // Loop through response data
                foreach ($resultArray as $item) {
                    // Add item to topMoviesArray
                    array_push($topMoviesArray, $item);

                    // Max 10 items
                    if (count($topMoviesArray) == $MAX_MOVIE_ITEM) {
                        break;
                    }
                }
            }
        }
        
        return view('home', [
            'baseURL' => $baseURL,
            'imageBaseURL' => $imageBaseURL,
            'apiKey' => $apiKey,
            'banner' => $bannerArray,
            'topMovies' => $topMoviesArray
        ]);
    }
}
