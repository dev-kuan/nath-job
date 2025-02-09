@extends('layouts.master')
@section('content')
<section>
    <header class="container max-w-[1130px] mx-auto flex items-center justify-between gap-[50px] mt-[70px]">
        <div class="flex flex-col items-center w-full gap-4">
            <h1 class="font-black text-[36px] leading-[70px] text-white text-center">{{ $category->name }}</h1>
        </div>  
    </header>
    
    <section id="Result" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px] w-fit">
        <div class="categories-container grid grid-cols-3 gap-[30px]">
            @foreach ($jobs as $job)
            <x-job-card :job="$job"></x-job-card>
            @endforeach
        </div> 
    </section>
@endsection
@section('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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