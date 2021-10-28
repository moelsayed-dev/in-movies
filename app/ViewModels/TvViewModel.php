<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTvShows;
    public $topRatedTvShows;
    public $genres;

    public function __construct($popularTvShows, $topRatedTvShows, $genres)
    {
        $this->popularTvShows = $popularTvShows;
        $this->topRatedTvShows = $topRatedTvShows;
        $this->genres = $genres;
    }

    public function popularTvShows()
    {
        return $this->formatShows($this->popularTvShows);
    }

    public function topRatedTvShows()
    {
        return $this->formatShows($this->topRatedTvShows);
    }

    public function genres()
    {
        return collect($this->genres)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatShows($shows)
    {
        /* return collect($shows)->map(function($show) {
            return $show;
        })->dump(); */
        return collect($shows)->map(function ($show) {
            $formattedGenres = collect($show['genre_ids'])->mapWithKeys(function ($value) {
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => "https://image.tmdb.org/t/p/w500" . $show['poster_path'],
                'vote_average' => $show['vote_average'] * 10 . '%',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M d, Y'),
                'genres' => $formattedGenres
            ])->only([
                'poster_path', 'name', 'id', 'genre_ids', 'vote_average', 'overview', 'first_air_date', 'genres'
            ]);
        })->take(18);
    }
}
