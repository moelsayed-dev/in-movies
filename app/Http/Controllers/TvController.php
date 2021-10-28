<?php

namespace App\Http\Controllers;

use App\ViewModels\TvViewModel;
use App\ViewModels\TvShowViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    public function index()
    {
        $popularTvShows = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/popular')
        ->json()['results'];

        $topRatedTvShows = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/top_rated')
        ->json()['results'];

        $genres = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/genre/tv/list')
        ->json()['genres'];



        $viewModel = new TvViewModel($popularTvShows, $topRatedTvShows, $genres);

        return view('tv/index', $viewModel);
    }

    public function show($id)
    {
        $tvshow = Http::withToken(config('services.tmdb.token'))
        ->get('https://api.themoviedb.org/3/tv/' . $id . '?append_to_response=credits,videos,images')
        ->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv/show', $viewModel);
    }
}
