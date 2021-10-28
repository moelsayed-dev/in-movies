@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16 font-semibold">
        <div class="popular-tv-shows">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">Popular TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                @foreach ($popularTvShows as $tvshow)
                    <x-tv-card :tvshow="$tvshow" :genres="$genres" />
                @endforeach
            </div>
        </div>

        <div class="top-rated-tv-shows py-24">
            <h2 class="uppercase tracking-wider text-yellow-600 text-lg font-semibold">Top Rated TV Shows</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                @foreach ($topRatedTvShows as $tvshow)
                    <x-tv-card :tvshow="$tvshow" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
