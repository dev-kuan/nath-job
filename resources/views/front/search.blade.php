@extends('layouts.master')
@section('content')
<section class="px-4 pt-16 mx-auto sm:max-w-full md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
    <header class="container w-full mx-auto flex items-center justify-between gap-[50px] mt-16">
        <div class="flex flex-col items-center w-full gap-[30px]">
            <h1 class="font-black text-[36px] leading-[50px] text-white text-center">Explore 10,000 <br>Most Popular Jobs
            </h1>
            <form method="GET" action="{{ route('front.search') }}"
                class="flex items-center pl-6 transition-all duration-300 bg-white rounded-full md:w-1/2 h-fit focus-within:ring-2 focus-within:ring-primary">
                @csrf
                <div class="flex items-center w-full mr-6 gap-[10px]">
                    <div class="flex shrink-0">
                        <img src="{{ asset('assets/icons/search-normal.svg')}}" alt="icon">
                    </div>
                    <input name="keyword" type="text" autocomplete="off"
                        class="w-full font-semibold border-none appearance-none focus:outline-none focus:ring-0 placeholder:font-normal placeholder:text-sm placeholder:text-dark focus:border-none"
                        placeholder="Quick search your dream job...">
                </div>
                <button type="submit"
                    class="rounded-full py-5 px-[30px] bg-primary font-semibold text-white text-nowrap hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Explore
                    Now</button>
            </form>
        </div>
    </header>
    <div id="Result" class="px-4 pt-16 mx-auto">
        <h2 class="font-bold text-2xl leading-[36px] text-white">Search Result: {{ ucfirst($keyword) }}</h2>
        <div class="grid content-center grid-cols-1 mt-4 mb-6 gap-y-4 md:gap-y-8 gap-x-2 md:grid-cols-2 lg:grid-cols-3">
            @forelse ( $jobs as $job )
            <x-job-card :job="$job" />
            @empty
            <p class="text-lg text-white capitalize">Tidak ditemukan data</p>
            @endforelse
        </div>
        <div id="pagination" class="my-4">
            {{ $jobs->appends(request()->query())->links() }}
        </div>
    </div>

</section>
@endsection