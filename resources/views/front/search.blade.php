@extends('layouts.master');
@section('content')
<header class="container max-w-[1130px] mx-auto flex items-center justify-between gap-[50px] mt-[70px]">
    <div class="flex flex-col items-center w-full gap-[30px]">
        <h1 class="font-black text-[36px] leading-[50px] text-white text-center">Explore 10,000 <br>Most Popular Jobs
        </h1>
        <form method="GET" action="{{ route('front.search') }}"
            class="w-[579px] flex items-center bg-white rounded-full pl-6 h-fit focus-within:ring-2 focus-within:ring-[#FF6B2C] transition-all duration-300">
            @csrf
            <div class="flex items-center w-full mr-6 gap-[10px]">
                <div class="flex shrink-0">
                    <img src="{{ asset('assets/icons/search-normal.svg')}}" alt="icon">
                </div>
                <input name="keyword" type="text" autocomplete="off"
                    class="focus:outline-none focus:ring-0 appearance-none w-full border-none font-semibold placeholder:font-normal placeholder:text-[#0E0140] focus:border-none"
                    placeholder="Quick search your dream job...">
            </div>
            <button type="submit"
                class="rounded-full py-5 px-[30px] bg-[#FF6B2C] font-semibold text-white text-nowrap hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Explore
                Now</button>
        </form>
    </div>
</header>
<section id="Result" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px] w-fit">
    <h2 class="font-bold text-2xl leading-[36px] text-white capitalize">Search Result: {{ ucfirst($keyword) }}</h2>
    <div class="categories-container grid grid-cols-3 gap-[30px]">
        @forelse ( $jobs as $job )
        <x-job-card :job="$job"></x-job-card>
        @empty
        <p class="text-white capitalize text-lg">Tidak ditemukan data</p>
        @endforelse
    </div>
    {{ $jobs->links() }}
    <div id="Pagination" class="flex items-center justify-center gap-[14px] mt-10">
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#7521FF]">1</button>
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">2</button>
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">3</button>
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">4</button>
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">5</button>
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">6</button>
        <button
            class="w-[38px] h-[38px] flex shrink-0 rounded-full justify-center items-center text-white font-semibold hover:bg-[#7521FF] transition-all duration-300 bg-[#0E0140]">7</button>
    </div>
</section>
@endsection