@php

$menus = [
['label' => 'Home', 'href' => 'front.index'],
['label' => 'Jobs', 'href' => 'front.jobs'],
['label' => 'Companies', 'href' => 'front.companies'],
['label' => 'About', 'href' => 'front.about'],
['label' => 'Contact', 'href' => 'front.contact']
];

$socials = [
    ['label' => 'Facebook', 'url' => 'https://facebook.com/' , 'icon' => '<svg class="w-6 h-6 text-third dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="currentColor" viewBox="0 0 24 24">
        <path fill-rule="evenodd"
            d="M13.135 6H15V3h-1.865a4.147 4.147 0 0 0-4.142 4.142V9H7v3h2v9.938h3V12h2.021l.592-3H12V6.591A.6.6 0 0 1 12.592 6h.543Z"
            clip-rule="evenodd" />
    </svg>'],
    ['label' => 'X', 'url' => 'https://twitter.com/' , 'icon' => '<svg class="w-6 h-6 text-third dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="currentColor" viewBox="0 0 24 24">
        <path
            d="M13.795 10.533 20.68 2h-3.073l-5.255 6.517L7.69 2H1l7.806 10.91L1.47 22h3.074l5.705-7.07L15.31 22H22l-8.205-11.467Zm-2.38 2.95L9.97 11.464 4.36 3.627h2.31l4.528 6.317 1.443 2.02 6.018 8.409h-2.31l-4.934-6.89Z" />
    </svg>'],
    ['label' => 'Instagram', 'url' => 'https://instagram.com/' , 'icon' => '<svg class="w-6 h-6 text-third dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
        height="24" fill="none" viewBox="0 0 24 24">
        <path fill="currentColor" fill-rule="evenodd"
            d="M3 8a5 5 0 0 1 5-5h8a5 5 0 0 1 5 5v8a5 5 0 0 1-5 5H8a5 5 0 0 1-5-5V8Zm5-3a3 3 0 0 0-3 3v8a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3V8a3 3 0 0 0-3-3H8Zm7.597 2.214a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2h-.01a1 1 0 0 1-1-1ZM12 9a3 3 0 1 0 0 6 3 3 0 0 0 0-6Zm-5 3a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z"
            clip-rule="evenodd" />
    </svg>'],
];

$currentYear = date('Y');

@endphp
<footer class="relative mt-16 bg-dark">
    <svg class="absolute top-0 w-full h-6 -mt-5 sm:-mt-10 sm:h-16 text-dark"
        preserveAspectRatio="none" viewBox="0 0 1440 54">
        <path fill="currentColor"
            d="M0 22L120 16.7C240 11 480 1.00001 720 0.700012C960 1.00001 1200 11 1320 16.7L1440 22V54H1320C1200 54 960 54 720 54C480 54 240 54 120 54H0V22Z">
        </path>
    </svg>
    <div class="px-4 pt-12 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
        <div class="grid gap-16 row-gap-10 mb-8 lg:grid-cols-6 place-content-center place-items-center">
            <div class="text-center lg:text-left md:max-w-md lg:col-span-2 ">
                <a href="/" aria-label="Go home" title="Company" class="inline-flex items-center">
                    <img src="{{ asset('logo.svg') }}" alt="JOBTHAN Logo">
                    <span class="ml-2 text-xl font-bold tracking-wide text-gray-100 uppercase">JOBTHAN</span>
                </a>
                <div class="mt-2 lg:max-w-sm">
                    <p class="text-sm text-white leading-normal">
                        Platform terpercaya untuk mencari pekerjaan terbaik di berbagai industri.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-5 row-gap-8 lg:col-span-4 md:grid-cols-2">
                <div>
                    <p class="font-semibold tracking-wide text-third">
                        Navigation
                    </p>
                    <ul class="mt-2 space-y-2">
                        @foreach ($menus as $menu )
                        <li>
                            <a href="{{ route($menu['href']) }}"
                                class="text-sm text-white transition-colors duration-300 hover:text-primary hover:underline underline-offset-4">{{ $menu['label'] }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <p class="font-semibold tracking-wide text-third">Contact Us</p>
                    <ul class="mt-2 space-y-2">
                        <li>
                            <a href="mailto:"
                                class="text-white transition-colors duration-300 hover:text-white">📧 support@jobportal.com</a>
                        </li>
                        <li>
                            <a href="tel:"
                                class="text-white transition-colors duration-300 hover:text-white">📞 +62 812-3456-7890</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="flex flex-col justify-between pt-5 pb-10 border-t border-deep-purple-accent-200 sm:flex-row">
            <p class="text-sm text-gray-100">
                © Copyright {{ $currentYear }} JOBTHAN. All rights reserved.
            </p>
            <div class="flex items-center mt-4 space-x-4 sm:mt-0">
                @foreach ($socials as $item )
                <a href="{{ $item['url'] }}" class="transition-colors duration-300">
                   <?= $item['icon'] ?>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>