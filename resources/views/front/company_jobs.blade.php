@extends('layouts.master')
@section('content')
<section class="max-w-full mx-auto lg:max-w-screen-xl">
    <header class="container max-w-[1130px] mx-auto flex items-center justify-between gap-[50px] mt-[70px]">
        <div class="flex flex-col items-center w-full gap-4">
            <h1 class="font-black text-3xl leading-[70px] text-white capitalize text-center">{{ $company->name }}
            </h1>
        </div>
    </header>

    <section id="Result" class="">
        <p class="text-white text-lg font-semibold px-5">Open Positions : {{ $isOpen }}</->
        <div class="categories-container grid grid-cols-1 gap-6 mx-2 my-4 sm:grid-cols-2 md:gap-x-4 md:gap-y-8 md:grid-cols-3 xl:grid-cols-4">
            @forelse ($jobs as $job)
            <x-job-card :job="$job"></x-job-card>
            @empty
            <div
                class="card first-of-type:pl-[calc((100%-1130px)/2)] last-of-type:pr-[calc((100%-1130px)/2)] px-[15px] py-[2px]">
                <div
                    class="relative flex flex-col items-center justify-center w-56 h-64 gap-2 overflow-hidden text-gray-800 bg-gray-200 rounded-2xl">
                    <div class="flex flex-col items-center justify-center text-center font-poppins">
                        <p class="text-xl font-semibold">Belum Ada Data Terbaru</p>
                    </div>
                </div>
                @endforelse
            </div>
    </section>
    @endsection
    @section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- JavaScript -->
    <script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

    <script>
        $('.main-carousel').flickity({
            // options
            cellAlign: 'left',
            contain: true,
            prevNextButtons: false,
            pageDots: false
        });
    </script>
    @endsection