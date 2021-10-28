<div class="relative mt-3 md:mt-0" x-data="{isOpen: true}" @click.away="isOpen = false">
    <input
        wire:model.debounce.500ms="search"
        type="text"
        class="bg-gray-800 rounded w-72 h-10 pl-8 focus:outline-none focus:ring-2 ring-gray-700"
        placeholder="Search (press '/' to search)"
        x-ref="search"
        @keydown.window = "
            if(event.keyCode === 191) {
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus="isOpen = true"
        @keydown="isOpen = true"
        @keydown.escape.window="isOpen = false"
    >
    <div class="absolute top-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 text-gray-500 mt-3 ml-2" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mt-5 font-bold mr-5"></div>
    @if (strlen($search) > 1)
        <div
            class="z-50 absolute bg-gray-800 rounded w-72 mt-4 text-sm"
            x-show="isOpen"
            x-transition
        >
            @if ($searchResults->count() > 0)
                <ul>
                    @foreach ($searchResults as $result)
                        <li class="border-b border-gray-700">
                            <a href="{{ route('movies.show', $result['id']) }}" class="flex items-center hover:bg-gray-700 p-3 overflow-hidden">
                                @if ($result['poster_path'])
                                    <img src="{{ "https://image.tmdb.org/t/p/w92" . $result['poster_path'] }}" class="w-10" alt="{{ $result['title'] }}">
                                @else
                                    <img src="https://via.placeholder.com/150x200?Text=Movie" alt="poster" class="w-10">
                                @endif
                                <span class="ml-4">{{ $result['title'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="block p-3 pl-8 overflow-hidden">No results found for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>
