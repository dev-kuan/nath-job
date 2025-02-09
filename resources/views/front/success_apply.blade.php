@extends('layouts.master')

@section('content')
<section class="font-poppins text-[#0E0140] pb-[100px] overflow-x-hidden bg-[#0E0140] min-h-screen flex flex-col">
    <div class="flex items-center justify-center flex-1">
        <div id="Success" class="flex flex-col items-center justify-center gap-[30px] my-auto">
            <div class="flex shrink-0 w-[330px] h-[330px]">
                <img src="{{ asset('/assets/backgrounds/success illustration.png') }}" class="object-contain" alt="cover image">
            </div>
            <div class="flex flex-col gap-[14px] text-center max-w-[389px]">
                <p class="font-semibold text-[32px] leading-[48px] text-white">Well, Great Work!</p>
                <p class="leading-[26px] text-white">We have received your application and the recruiter will review in
                    a couple business days</p>
            </div>
            <div class="flex items-center justify-center gap-4">
                    <a href="{{ route('front.index') }}"
                        class="rounded-full p-[14px_24px] bg-gray-50 font-semibold text-[#0E0140] hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Explore
                        Other Jobs</a>
                    @auth    
                    <a href="{{ route('dashboard.my.applications') }}"
                        class="rounded-full p-[14px_24px] bg-[#FF6B2C] font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Check My Application Status</a>
                    @endauth
            </div>
        </div>
    </div>
</section>
@endsection