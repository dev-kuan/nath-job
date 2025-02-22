@extends('layouts.master')
@section('content')
<section class="container relative max-w-full mx-auto lg:max-w-screen-xl">
    <article id="Details"
        class="container relative max-w-[900px] mx-auto flex flex-col rounded-[20px] bg-white border border-[#E8E4F8] p-[30px] gap-10 shadow-[0_8px_30px_0_#0E01400D] mt-[70px]">
        <div id="Cover" class="relative w-full">
            <div class="w-full aspect-[840/300] bg-[#D9D9D9] rounded-[20px] overflow-hidden">
                <img src="{{ Storage::url($companyJob->thumbnail) }}" class="object-cover w-full h-full"
                    alt="cover image">
            </div>
            <div
                class="absolute transform translate-y-1/2 bottom-0 left-5 w-[120px] h-[120px] p-5 flex shrink-0 items-center justify-center bg-white rounded-[20px] border border-[#E8E4F8] shadow-[0_8px_30px_0_#0E01400D]">
                <img src="{{ Storage::url($companyJob->company->logo) }}"
                    class="object-contain w-full h-full rounded-lg" alt="Logo {{ $companyJob->company->name }}">
            </div>
            <div class="absolute bottom-0 transform translate-y-1/2 right-5">
                @if ($companyJob->is_open)
                <p id="HiringBadge" class="rounded-full p-[8px_20px] bg-primary font-bold text-white w-fit">WE’RE
                    HIRING!</p>
                @else
                <p id="ClosedBadge" class="rounded-full p-[8px_20px] bg-[#FF2C39] font-bold text-white w-fit">CLOSED</p>
                @endif
            </div>
        </div>
        <div id="Title" class="flex flex-col mt-[90px] gap-[10px]">
            <h1 class="font-bold text-[32px] leading-[48px]">{{ $companyJob->name }}</h1>
            <p>{{ $companyJob->category->name }} • Posted at {{ $companyJob->created_at->format('d M, Y') }}</p>
        </div>
        <div id="Feature" class="flex flex-wrap items-center gap-6">
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-6 h-6 desktop:w-8 desktop:desktop:h-8">
                    <img src="{{ asset('assets/icons/note-favorite-orange.svg')}}" alt="icon">
                </div>
                <p class="font-semibold desktop:text-lg text-base capitalize leading-[27px]">{{ $companyJob->type }}</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-6 h-6 desktop:w-8 desktop:h-8">
                    <img src="{{ asset('assets/icons/personalcard-yellow.svg')}}" alt="icon">
                </div>
                <p class="font-semibold desktop:text-lg text-base capitalize leading-[27px]">{{ $companyJob->skill_level }}</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-6 h-6 desktop:w-8 desktop:h-8">
                    <img src="{{ asset('assets/icons/moneys-cyan.svg')}}" alt="icon">
                </div>
                <p class="font-semibold desktop:text-lg text-base leading-[27px]">Rp {{ number_format($companyJob->salary, '0', ',', '.')
                    }}/mo</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-6 h-6 desktop:w-8 desktop:h-8">
                    <img src="{{ asset('assets/icons/location-purple.svg')}}" alt="icon">
                </div>
                <p class="font-semibold desktop:text-lg text-base leading-[27px]">{{ $companyJob->location }}</p>
            </div>
        </div>
        <div id="Overview" class="flex flex-col gap-[10px]">
            <h2 class="font-semibold text-lg desktop:text-xl leading-[30px]">Overview</h2>
            <p class="text-base desktop:text-lg leading-[34px]">{{ $companyJob->about }}</p>
        </div>
        <div id="Responsibilities" class="flex flex-col gap-[10px]">
            <h2 class="font-semibold text-lg desktop:text-xl leading-[30px]">Responsibilities</h2>
            <div class="flex flex-col gap-5">
                @foreach ($companyJob->responsibilities as $responsibility)
                <div class="flex items-center gap-2">
                    <div class="flex shrink-0">
                        <img src="{{ asset('assets/icons/tick-circle.svg')}}" alt="tick icon">
                    </div>
                    <p>{{ $responsibility->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div id="Qualifications" class="flex flex-col gap-[10px]">
            <h2 class="font-semibold text-lg desktop:text-xl leading-[30px]">Qualifications</h2>
            <div class="flex flex-col gap-5">
                @foreach ($companyJob->qualifications as $qualification)
                <div class="flex items-center gap-2">
                    <div class="flex shrink-0">
                        <img src="{{ asset('assets/icons/tick-circle.svg')}}" alt="tick icon">
                    </div>
                    <p>{{ $qualification->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div id="Company" class="flex flex-col gap-[10px]">
            <h2 class="font-semibold text-lg desktop:text-xl leading-[30px]">Company</h2>
            <div class="flex flex-col gap-5">
                <div class="flex items-center gap-5">
                    <div class="company-logo w-[70px] flex shrink-0">
                        <img src="{{ Storage::url($companyJob->company->logo) }}" class="object-contain" alt="icon">
                    </div>
                    <div class="flex flex-col gap-[2px]">
                        <div class="CompanyName font-semibold flex items-center gap-[2px]">
                            <p class="font-semibold">{{ $companyJob->company->name }}</p>
                            <div class="flex w-6 h-6 shrink-0">
                                <img src="{{ asset('assets/icons/verify.svg')}}" alt="verified">
                            </div>
                        </div>
                        <p class="text-sm leading-[21px]">{{ $companyJob->company->jobs->count() }} Jobs</p>
                    </div>
                </div>
                <p class="leading-[28px]">{{$companyJob->company->about}}</p>
            </div>
        </div>
        <hr class="border-[#E8E4F8]">
        <div id="CTA" class="flex desktop:flex-nowrap flex-wrap gap-y-4 items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="flex w-6 h-6 shrink-0">
                    <img src="{{ asset('assets/icons/security-user.svg')}}" alt="icon">
                </div>
                <p class="font-semibold">We use Angga to secure your data 100%</p>
            </div>
            <div class="flex items-center gap-3">
                <a href=""
                class="rounded-full border border-[#0E0140] p-[14px_24px] font-semibold text-[#0E0140]">Bookmark</a>
                @if ($companyJob->is_open)
                <a href="{{ route('front.apply', $companyJob) }}"
                    class="rounded-full p-[14px_24px] bg-primary font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Apply
                    Now</a>
                    @else
                <button
                        class="rounded-full p-[14px_24px] bg-primary opacity-55 font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Closed</button>
                @endif
            </div>
        </div>
    </article>
    <section id="Latest" class="relative overflow-hidden flex flex-col gap-[30px] mt-24">
        <h2 class="container max-w-4xl desktop:px-0 px-3 text-left mx-auto font-bold text-2xl leading-[36px]">Other Jobs You <br> Might
            Interested</h2>
        <div class="main-carousel *:!overflow-visible">
            @forelse ($jobs as $job )
            <x-job-card :job="$job"></x-job-card>
            @empty
            <div class="card first-of-type:pl-[calc((100%-1130px)/2)] last-of-type:pr-[calc((100%-1130px)/2)] px-[15px] py-[2px]">
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

    <script src="{{ asset('js/carousel.js') }}"></script>
    @endsection