@extends('layouts.master')
@section('content')
<section class="font-poppins text-dark">
    <!-- component -->
    <div class="bg-white flex justify-center overflow-hidden items-center h-screen">
        <!-- Left: Image -->
        <div class="w-1/2 h-screen hidden lg:block">
            <img src="{{ asset('assets/backgrounds/Smiley Woman on Floor.png')}}" alt="Placeholder Image"
                class="object-cover w-full h-full">
            <div
                class="absolute bottom-0 flex p-5 flex-col gap-4 max-w-[590px] mx-[30px] mb-[30px] rounded-[20px] outline outline-1 outline-[#E8E4F8] bg-white shadow-[0_8px_30px_0_#0E01400D]">
                <p class="text-base leading-[32px] font-semibold">
                    Berkat Jobank saya bisa bekerja dari rumah dengan santai tanpa harus macet-macetan. Seluruh lokernya
                    juga aman bebas dari penipuan yang sering terjadi saat ini di seluruh dunia.
                </p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-[14px]">
                        <div class="flex shrink-0 size-[60px] rounded-full overflow-hidden">
                            <img src="{{ asset('assets/photos/photo2.png')}}" class="object-cover w-full h-full"
                                alt="profile picture" />
                        </div>
                        <div>
                            <p class="text-base font-semibold">Shayna Angga</p>
                            <p class="text-sm leading-[21px]">Programmer</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-[2px]">
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/Star.svg')}}" alt="star" />
                        </div>
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/Star.svg')}}" alt="star" />
                        </div>
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/Star.svg')}}" alt="star" />
                        </div>
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/Star.svg')}}" alt="star" />
                        </div>
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/Star.svg')}}" alt="star" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Right: Login Form -->
        <div class="lg:p-36 md:p-52 sm:20 p-8 w-full lg:w-1/2">
            <a href="{{ route('front.index') }}" class="flex shrink-0 justify-start w-full h-10 mb-16">
                <img src="{{ asset('assets/logos/Logo-black.svg')}}" class="object-contain" alt="logo" />
            </a>
            <h1 class="text-2xl font-bold mb-4">Sign In</h1>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <!-- Username Input -->
                <div class="flex flex-col gap-2">
                    <label for="email" class="text-base font-semibold">Email Address</label>
                    <div
                        class="flex items-center rounded-full py-3.5 px-6 gap-2.5 ring-1 ring-dark focus-within:ring-2 focus-within:ring-primary transition-all duration-300">
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/sms.svg')}}" alt="email icon" />
                        </div>
                        <input type="email" name="email" id="email"
                            class="w-full focus:ring-0 border-none font-semibold placeholder:font-normal placeholder:text-dark"
                            placeholder="Write your email address" required />
                    </div>
                </div>
                <!-- Password Input -->
                <div class="flex flex-col gap-2 mt-4">
                    <label for="password" class="text-base font-semibold">Password</label>
                    <div
                        class="flex items-center rounded-full py-3.5 px-6 gap-2.5 ring-1 ring-dark focus-within:ring-2 focus-within:ring-primary transition-all duration-300">
                        <div class="flex shrink-0 size-6">
                            <img src="{{ asset('assets/icons/lock.svg')}}" alt="password icon" />
                        </div>
                        <input type="password" name="password" id="password"
                            class="w-full focus:ring-0 border-none font-semibold placeholder:font-normal placeholder:text-dark"
                            placeholder="Write your password" required />
                    </div>
                    <a href="#" class="text-sm leading-5 hover:underline">Forgot Password</a>
                </div>
                <div class="flex flex-col gap-3 mt-6">
                    <button type="submit"
                        class="flex items-center justify-center py-3.5 px-7 bg-primary font-semibold text-white rounded-full hover:shadow-[0px_10px_20px_0px_#FF6B2C66] transition-all duration-300">
                        Sign In to My Account
                    </button>
                    <a href="{{ route('register') }}"
                        class="flex items-center justify-center py-3.5 px-7 font-semibold text-dark hover:bg-primary hover:outline-white transition-colors duration-300 ease-in-out outline outline-1 outline-dark rounded-full">Create
                        New Account</a>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection