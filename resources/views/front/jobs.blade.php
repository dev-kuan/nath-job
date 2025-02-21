@extends('layouts.master')
@section('content')
<section class="max-w-full mx-auto lg:max-w-screen-xl">
<div class="max-w-xl mx-auto mb-10 text-center md:mb-6 lg:max-w-2xl">
    <div>
        <h2 class="inline-block p-2 mb-4 text-xs font-bold tracking-wider text-center text-white uppercase rounded-full shadow-lg bg-primary font-poppins">
            JOBTHAN
        </h2>
    </div>
    <h2 class="max-w-lg mb-2 text-3xl font-bold leading-none tracking-tight text-white font-poppins sm:text-4xl md:mx-auto">
        Search, Apply, Get Hired. With JobThan.
    </h2>
    <p class="text-base font-medium text-white md:text-lg"> Don’t miss your next career opportunity. Find and apply for jobs that match your passion today!</p>
</div>

{{-- grid header --}}
<div class="relative z-20 my-2">
    <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-x-4 md:space-y-0">
        {{-- search --}}
        <div class="w-full md:w-80">
            <form class="flex items-center" action="{{ route('front.jobs') }}" method="GET">
                @csrf
                @if (request('type'))
                <input type="hidden" name="type" value="{{ request('type') }}">
                @endif
                @if (request('level'))
                <input type="hidden" name="skill_level" value="{{ request('level') }}">
                @endif
                <label for="keyword" class="sr-only">Search</label>
                <div class="relative w-full group">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-graydark dark:text-light" fill="currentColor"
                            viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <input type="text" id="keyword"
                        class="block w-full px-2 py-3 pl-10 text-sm bg-white border border-gray-300 rounded-2xl text-dark focus:border-light focus:ring-primary dark:bg-graydark dark:text-light dark:placeholder-graylight"
                        placeholder="Quick search your dream job..." name="search">
                </div>
            </form>
        </div>
        {{-- filter --}}
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
            <div class="relative flex items-center max-w-lg space-x-3">
                <button id="sort-btn" data-dropdown-target="sortDropdown" type="button"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium bg-white border border-gray-200 dropdown-btn rounded-xl text-dark hover:bg-gray-100 hover:text-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary md:w-auto">
                    <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
                    </svg>
                    Sort
                    <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <div id="sortDropdown" class="absolute left-0 z-10 hidden p-4 mt-2 bg-white shadow dropdown top-full w-max rounded-2xl">
                    <form action="{{ route('front.jobs') }}" method="GET" class="p-1 space-y-1 text-sm text-gray-700" aria-labelledby="dropdownRadioBgHoverButton">
                        @foreach (request()->query as $key => $value )
                            @if ($key !== 'sortBy')
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach
                        <ul>
                        @foreach ($sortOptions as $opt )
                        <li class="py-1">
                            <div class="flex items-center rounded-sm hover:bg-gray-100">
                                <input {{ request('sortBy') == $opt['value'] ? 'checked' : '' }} id="sort-{{ $loop->index }}" type="radio" value="{{ $opt['value'] }}" name="sortBy"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="sort-{{ $loop->index }}"
                                    class="w-full text-sm font-medium rounded-sm ms-2 text-dark">{{ $opt['label']}}</label>
                            </div>
                        </li>
                        @endforeach
                        <div class="flex justify-center w-full pb-4 mt-6 space-x-4 md:px-4">
                            <button aria-label="reset" onclick="resetFilters()" type="reset"
                                class="w-full px-5 py-2 text-sm font-medium bg-white border border-gray-200 rounded-lg text-graydark hover:bg-gray-100 hover:text-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:bg-graydark dark:text-graylight dark:hover:bg-grayhover">
                                Reset
                            </button>
                            <button aria-label="apply" type="submit"
                                class="w-full px-5 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-primary-300 bg-primary hover:bg-primarydark focus:outline-none focus:ring-4 dark:bg-primary dark:hover:bg-primarydark dark:focus:ring-primarydark">
                                Apply
                            </button>
                        </div>
                        </ul>
                    </form>
                </div>
                <button id="filter-btn" data-dropdown-target="filterDropdown"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium bg-white border border-gray-200 dropdown-btn rounded-xl text-dark hover:bg-gray-100 hover:text-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primary md:w-auto"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        class="w-4 h-4 mr-2" viewbox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="filterDropdown" class="absolute right-0 z-10 hidden p-4 mt-2 bg-white shadow dropdown top-full w-max rounded-2xl">
                    <form id="filter-form" action="{{ route('front.jobs') }}" method="GET" class="font-inter">
                        @csrf
                        <div>
                            <div class="types">
                                <h6 class="mb-3 text-sm font-medium text-graydark dark:text-graylight">
                                    Job Type
                                </h6>
                                <select id="type" name="type"
                                    class="block w-full rounded-xl border border-gray-300 bg-light p-2.5 text-sm capitalize text-graydark focus:border-primary focus:ring-primary dark:bg-graydark dark:text-graylight">
                                    <option value="">All Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type['value'] }}" {{ request('type')==$type['value'] ? 'selected': '' }}>
                                            {{ $type['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="my-4 type">
                            <h6 class="mb-3 text-sm font-medium text-graydark dark:text-graylight">
                                Job Level
                            </h6>
                            <select id="level" name="level"
                                class="block w-full rounded-xl border border-gray-300 bg-light p-2.5 text-sm capitalize text-graydark focus:border-primary focus:ring-primary dark:bg-graydark dark:text-graylight">
                                <option value="">All Level</option>
                                @foreach ($skillLevel as $level)
                                <option value="{{ $level['value'] }}" {{ request('level')==$level['value'] ? 'selected' : '' }}>
                                    {{ $level['label'] }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex justify-center w-full pb-4 mt-6 space-x-4 md:px-4">
                            <button aria-label="reset" onclick="resetFilters()" type="reset"
                                class="w-full px-5 py-2 text-sm font-medium bg-white border border-gray-200 rounded-lg text-graydark hover:bg-gray-100 hover:text-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:bg-graydark dark:text-graylight dark:hover:bg-grayhover">
                                Reset
                            </button>
                            <button aria-label="apply" type="submit"
                                class="w-full px-5 py-2 text-sm font-medium text-center text-white rounded-lg focus:ring-primary-300 bg-primary hover:bg-primarydark focus:outline-none focus:ring-4 dark:bg-primary dark:hover:bg-primarydark dark:focus:ring-primarydark">
                                Apply
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- grid content --}}
<div class="grid grid-cols-1 gap-6 mx-2 my-4 sm:grid-cols-2 md:gap-x-4 md:gap-y-8 md:grid-cols-3 xl:grid-cols-4">
    @forelse ($jobs as $job)
    <x-job-card :job="$job" />
    @empty
    <p class="text-lg text-white capitalize">Tidak ditemukan data</p>
    @endforelse
</div>
<div id="pagination" class="px-4 my-10">
    {{ $jobs->appends(request()->query())->links() }}
</div>
</section>
@endsection
@section('scripts')
<script src="{{ asset('js/dropdown.js') }}"></script>
<script>

    function resetFilters() {
        document.getElementById('type').value = "";
        document.getElementById('level').value = "";

        const selects = document.querySelectorAll('select');
        selects.forEach(select => {
            select.classList.add('animate-pulse');
            setTimeout(() => {
                select.classList.remove('animate-pulse');
            }, 500);
        });

        const buttons = document.querySelectorAll('button');
        buttons.forEach(btn => btn.disabled = true);

        document.getElementById('filter-form').submit();
    }
    function resetSort() {
        document.getElementById('type').value = "";
        document.getElementById('level').value = "";

        const selects = document.querySelectorAll('select');
        selects.forEach(select => {
            select.classList.add('animate-pulse');
            setTimeout(() => {
                select.classList.remove('animate-pulse');
            }, 500);
        });

        const buttons = document.querySelectorAll('button');
        buttons.forEach(btn => btn.disabled = true);

        document.getElementById('filter-form').submit();
    }

</script>
@endsection