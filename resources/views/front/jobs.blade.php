@extends('layouts.master')
@section('content')
@php
    $types = [
        ['label' => 'Full time', 'value' => 'full-time'],
        ['label' => 'Part time', 'value' => 'part-time'],
        ['label' => 'Remote', 'value' => 'remote'],
        ['label' => 'Contract', 'value' => 'contract'],
];

    $skillLevel = [
        ['label' => 'Entry level', 'value' => 'entry-level'],
        ['label' => 'Mid level', 'value' => 'mid-level'],
        ['label' => 'Senior level', 'value' => 'senior-level'],
];

    $locations = [
        ['label' => 'Jakarta', 'value' => 'jakarta'],
        ['label' => 'Bandung', 'value' => 'bandung'],
        ['label' => 'Surabaya', 'value' => 'surabaya'],
        ['label' => 'Bali', 'value' => 'bali'],
        ['label' => 'Kupang', 'value' => 'kupang'],
];
?>
@endphp
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
                        placeholder="Quick search your dream job..." name="keyword">
                </div>
            </form>
        </div>
        {{-- filter --}}
        <div
            class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:items-center md:space-x-3 md:space-y-0">
            <div class="relative flex items-center max-w-lg space-x-3">
                <button id="filter-btn" data-dropdown-target="filterDropdown"
                    class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium bg-white border border-gray-200 dropdown-btn rounded-xl text-graydark hover:bg-gray-100 hover:text-primary focus:z-10 focus:outline-none focus:ring-2 focus:ring-primaryhover dark:bg-graydark dark:text-graylight md:w-auto"
                    type="button">
                    <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        class="w-4 h-4 mr-2 text-primarygray dark:text-graylight" viewbox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                            clip-rule="evenodd" />
                    </svg>
                    Filter
                    <svg class="-mr-1 ml-1.5 h-5 w-5" fill="currentColor" viewbox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="filterDropdown" class="absolute right-0 z-10 hidden p-4 mt-2 bg-white shadow dropdown top-full w-max rounded-2xl dark:bg-graydark">
                    <form action="{{ route('front.jobs') }}" method="GET" class="font-inter">
                        @csrf
                        <div>
                            <div class="types">
                                <h6 class="mb-3 text-sm font-medium text-graydark dark:text-graylight">
                                    Job Type
                                </h6>
                                <select id="types-select" name="type"
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
                            <select name="skill-level"
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
                            <button aria-label="reset" type="reset"
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

@endsection
@section('scripts')
<script src="{{ asset('js/dropdown.js') }}"></script>
@endsection