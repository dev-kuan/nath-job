@php
    
    $menus = [
        ['label' => 'Home', 'href' => 'front.index'],
        ['label' => 'Jobs', 'href' => 'front.jobs'],
        ['label' => 'Companies', 'href' => 'front.companies'],
        ['label' => 'About', 'href' => 'front.about'],
        ['label' => 'Contact', 'href' => 'front.contact']
    ];
    // active menu
    $activeMenu = 'font-semibold text-primary';
    $inactiveMenu = 'md:text-white text-dark hover:text-primary';
@endphp

<nav class="my-4 font-poppins">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <a href="{{ route('front.index') }}" class="flex items-center space-x-1 rtl:space-x-reverse">
                <img src="{{asset('logo.svg')}}" class="w-full" alt="Logo" />
                <span class="self-center text-2xl font-bold text-primary whitespace-nowrap">JOBTHAN</span>
            </a>
            <div class="relative flex items-center gap-3 space-x-3 md:order-2 md:space-x-0 rtl:space-x-reverse">
                @guest
                <a href="{{ route('login') }}"
                    class="text-white hidden md:flex hover:shadow-[0_10px_20px_0_#FF6B2C66]focus:ring-4 focus:outline-none focus:ring-blue-300 border hover:bg-white hover:text-dark duration-300 transition-colors ease-in-out border-white font-semibold rounded-full text-base py-3 px-5 text-center">Sign In</a>
                <a href="{{ route('register') }}" class="text-white hidden md:flex hover:shadow-[0_10px_20px_0_#FF6B2C66] bg-primary hover:bg-primary/75 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-full text-base py-3 px-5 text-center duration-300 transition-colors ease-in-out">Sign Up</a>
                @endguest
                @auth
                <button type="button"
                    class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300"
                    id="user-menu" aria-expanded="false" data-dropdown-toggle="user-dropdown"
                    data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="object-cover w-10 h-10 rounded-full" src="{{ Storage::url(Auth::user()->avatar) }}"
                        alt="user photo">
                </button>
                <!-- Dropdown menu -->
                <div class="absolute z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-sm right-1/2 top-1/2"
                    id="user-dropdown">
                    <div class="px-4 py-3">
                        <span class="block text-sm text-gray-900 dark:text-white">{{Auth::user()->name}}</span>
                        <span
                            class="block text-sm text-gray-500 truncate dark:text-gray-400">{{Auth::user()->email}}</span>
                    </div>
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                        </li>
                        <li>
                            <form method="post" action="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                @csrf
                                <button type="submit">Sign out </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
                <button id="btn-menu" data-collapse-toggle="navMenu" type="button"
                    class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-300 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    aria-controls="navMenu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
    
            </div>
            <div class="items-center justify-between hidden w-full desktop:flex desktop:w-auto desktop:order-1" id="navMenu">
                <ul
                    class="flex flex-col p-4 mt-4 font-medium border border-gray-100 rounded-lg md:p-0 bg-gray-50 desktop:space-x-8 rtl:space-x-reverse desktop:flex-row desktop:mt-0 desktop:border-0 desktop:bg-transparent">
                    @foreach ($menus as $menu )
                    <li>
                        <a href="{{ route($menu['href']) }}"
                            class="{{ request()->routeIs($menu['href']) ? $activeMenu : $inactiveMenu}} block py-2 px-3 md:p-0 transition-all duration-200"
                            aria-current="page">{{ $menu['label'] }}</a>
                    </li>
                    @endforeach
                    @guest
                    <li class="mt-4 md:hidden">
                        <a href="#" class="block w-full px-5 py-3 text-base font-semibold text-center text-white rounded-full bg-primary hover:bg-primary/75">
                            Sign In
                        </a>
                    </li>
                    <li class="mt-2 md:hidden">
                        <a href="#" class="block w-full px-5 py-3 text-base font-semibold text-center text-white border border-white rounded-full hover:shadow-lg">
                            Sign Up
                        </a>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>