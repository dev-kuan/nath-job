{{-- @props(['sortOptions', 'route']) --}}

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
    <form id="sort-form" action="{{ route($route)}}" method="GET" class="p-1 space-y-1 text-sm text-gray-700"
        aria-labelledby="dropdownRadioBgHoverButton">
        @foreach (request()->query as $key => $value )
        @if ($key !== 'sortBy')
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
        @endforeach
        <ul>
            @foreach ($sortOptions as $opt )
            <li class="py-1">
                <div class="flex items-center rounded-sm hover:bg-gray-100">
                    <input {{ request('sortBy')==$opt['value'] ? 'checked' : '' }} id="sort-{{ $loop->index }}"
                        type="radio" value="{{ $opt['value'] }}" name="sortBy"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2">
                    <label for="sort-{{ $loop->index }}" class="w-full text-sm font-medium rounded-sm ms-2 text-dark">{{
                        $opt['label']}}</label>
                </div>
            </li>
            @endforeach
            <div class="flex justify-start items-start gap-2 w-full pb-2 mt-4">
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