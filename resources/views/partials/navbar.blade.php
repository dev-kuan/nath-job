@php
    
    $menus = [
        ['label' => 'Home', 'href' => 'front.index'],
        ['label' => 'Features', 'href' => 'front.features'],
        ['label' => 'Benefits', 'href' => 'front.benefits'],
        ['label' => 'Stories', 'href' => 'front.stories'],
        ['label' => 'About', 'href' => 'front.about'],
        ['label' => 'Contact', 'href' => 'front.contact']
    ];
    // active menu styles
    $activeMenu = 'font-semibold text-[#FF6B2C]';
    $inactiveMenu = 'text-white';
?>
@endphp

<nav class="container max-w-[1130px] font-poppins mx-auto flex items-center justify-between pt-10">
    <a href="{{ route('front.index') }}" class="flex shrink-0">
        <img src="{{asset('assets/logos/Logo.svg')}}" alt="Logo">
    </a>
    <ul class="flex items-center gap-10">
        @foreach ($menus as $menu )
        <li>
            <a href="{{ route($menu['href']) }}"
                class="{{ request()->routeIs($menu['href']) ? $activeMenu : $inactiveMenu }} transition-all duration-300 hover:font-semibold hover:text-[#FF6B2C]">{{ $menu['label'] }}</a>
        </li>      
        @endforeach
    </ul>
    @guest
        
    <div class="flex items-center gap-3">
        <a href="{{ route('login') }}"
        class="rounded-full border border-white p-[14px_24px] font-semibold text-white">Sign
        In</a>
        <a href="{{ route('register') }}"
        class="rounded-full p-[14px_24px] bg-[#FF6B2C] font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Sign
        up</a>
    </div>
    @endguest
    @auth
        <div class="flex items-center gap-4">
            <p class="font-medium text-white username">Hi, {{ Auth::user()->name }}</p>
            <div class="w-[52px] h-[52px] flex shrink-0 rounded-full overflow-hidden">
                <a href="{{ route('dashboard') }}">
                <img src="{{ Storage::url(Auth::user()->avatar) }}" class="object-cover w-full h-full" alt="photo">
                </a>
            </div>
        </div>
    @endauth
</nav>