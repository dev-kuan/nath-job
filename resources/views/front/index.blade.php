@extends('layouts.master')
@section('content')
<section class="font-poppins text-dark pb-[100px] overflow-x-hidden max-w-full mx-auto lg:max-w-screen-xl">
    {{-- navigation --}}

    <section class="px-4 pt-16 mx-auto sm:max-w-full md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
        <div class="flex flex-col items-center justify-center w-full mb-10 lg:flex-row lg:justify-between">
            <div class="lg:mb-0 lg:max-w-xl lg:pr-5">
                <div class="flex items-center py-2 pl-4 pr-6 bg-white rounded-full gap-x-2 badge w-fit">
                    <div class="flex shrink-0">
                        <img src="{{asset('assets/icons/crown-orange.svg')}}" alt="icon">
                    </div>
                    <p class="text-sm font-semibold leading-5 text-dark">Helped 5 Million People Worldwide
                        Grow
                        Career</p>
                </div>
                <div class="flex flex-col gap-4 py-2 mt-3">
                    <h1 class="font-black text-5xl desktop:text-6xl leading-[70px] text-white">We Help You<br>Get Dream Job</h1>
                    <p class="text-lg leading-8 text-white text-wrap">Must trusted platform to build new career and get an
                        happy job better than befooore</p>
                </div>
                <form method="GET" action="{{ route('front.search') }}"
                    class="flex items-center pl-6 transition-all duration-300 bg-white rounded-full h-fit focus-within:ring-2 focus-within:ring-primary">
                    @csrf
                    <div class="flex items-center w-full mr-6 gap-[10px]">
                        <div class="flex shrink-0">
                            <img src="{{asset('assets/icons/search-normal.svg')}}" alt="icon">
                        </div>
                        <input name="keyword" type="text" autocomplete="off"
                            class="w-full font-semibold border-none appearance-none focus:outline-none focus:ring-0 placeholder:font-normal placeholder:text-dark focus:border-none"
                            placeholder="Quick search your dream job..."/>
                    </div>
                    <button type="submit"
                        class="rounded-full py-5 px-[30px] bg-primary font-semibold text-white text-nowrap hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Explore
                        Now</button>
                </form>
            </div>
            <div class="w-full p-0 lg:w-1/2">
                <img src="{{asset('assets/backgrounds/hero illustration v2.png')}}" class="object-contain" alt="banner">
            </div>
        </div>
    </section>
    <section id="Categories" class="px-4 pt-16 mx-auto sm:max-w-full md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
        <h2 class="text-2xl font-bold leading-7 text-center md:text-left text-primary desktop:text-dark lg:text-white">Browse by <br> Job Categories</h2>
        <div class="categories-container grid grid-cols-2 md:grid-cols-3 desktop:grid-cols-4 gap-[30px] py-4">
            @forelse ($categories as $category)
            <a href="{{ route('front.category', $category->slug) }}" class="card">
                <div
                    class="flex flex-col rounded-[20px] border border-[#E8E4F8] p-5 gap-[30px] bg-white shadow-[0_8px_30px_0_#0E01400D] hover:ring-2 hover:ring-primary transition-all duration-300">
                    <div class="flex w-16 h-16 shrink-0">
                        <img src="{{asset('assets/icons/Web Development 1-2.png')}}" class="object-contain" alt="icon">
                    </div>
                    <div class="flex flex-wrap items-center justify-between gap-2">
                        <div class="flex flex-col">
                            <p class="font-bold capitalize text-lg leading-[27px]">{{ $category->name }}</p>
                            <p class="font-medium">{{ $category->jobs->count() }} Jobs</p>
                        </div>
                        <img src="{{asset('assets/icons/arrow-circle-right.svg')}}" alt="icon">
                    </div>
                </div>
            </a>
            @empty
            @endforelse
        </div>
    </section>
    <section id="Latest" class="px-4 pt-16 mx-auto sm:max-w-full md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
        <h2 class="container max-w-full mx-auto text-2xl font-bold leading-8">Latest Jobs <br> Get Them Now
        </h2>
        <div class="main-carousel *:!overflow-visible">
            @forelse ($jobs as $job )
            <x-job-card :job="$job"/>
            @empty
            <p>Belum ada Data job terbaru</p>
            @endforelse
        </div>
    </section>

</section>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- JavaScript -->
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

<script src="{{ asset('js/carousel.js') }}"></script>
@endsection