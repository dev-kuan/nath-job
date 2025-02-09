<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Candidate Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                <div class="flex flex-row justify-between item-card gap-y-10 md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($jobCandidate->job->thumbnail) }}" alt=""
                            class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $jobCandidate->job->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $jobCandidate->job->category->name }}</p>
                        </div>

                    </div>
                    <div class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Salary</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{ number_format($jobCandidate->job->salary) }}/mo
                        </h3>
                    </div>
                    <div class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Type</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $jobCandidate->job->type }}
                        </h3>
                    </div>
                </div>

                <hr class="my-5">

                <h3 class="text-xl font-bold text-indigo-950">My Profile</h3>

                <div class="flex flex-row items-center justify-between">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($jobCandidate->profile->avatar)}}" alt=""
                            class="rounded-full object-cover w-[70px] h-[70px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $jobCandidate->profile->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $jobCandidate->profile->occupation }} - {{
                                $jobCandidate->profile->experience }} yrs exp</p>
                        </div>
                    </div>
                    @if ($jobCandidate->is_hired)
                    <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                        HIRED
                    </span>
                    @elseif (!$jobCandidate->is_hired && $jobCandidate->job->is_open)
                    <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                        WAITING
                    </span>
                    @elseif (!$jobCandidate->is_hired)
                    <span class="px-3 py-2 text-sm font-bold text-white bg-red-500 rounded-full w-fit">
                        REJECTED
                    </span>
                    @endif
                </div>

                <div class="flex flex-col gap-y-3">
                    <h3 class="mt-5 text-xl font-bold text-indigo-950">Message</h3>
                    <p>
                        {{ $jobCandidate->message }}
                    </p>
                </div>

                @if ($jobCandidate->candidate_id == Auth::id() && $jobCandidate->is_hired &&
                !$jobCandidate->job->is_open)
                <hr class="my-5">
                <h3 class="text-xl font-bold text-indigo-950">Congrats! Anda terpilih bekerja</h3>
                <p>
                    Anda akan segera mendapatkan instruksi selanjutnya dari perusahaan asdasd terkait workflow
                    pekerjaan. Silahkan periksa email Anda dengan berkala. Have a great career!
                </p>
                @elseif ($jobCandidate->candidate_id == Auth::id() && !$jobCandidate->is_hired &&
                !$jobCandidate->job->is_open)
                <hr class="my-5">
                <h3 class="text-xl font-bold text-indigo-950">Sorry! Anda belum beruntung</h3>
                <p>
                    Silahkan mencoba apply pada pekerjaan lainnya yang tersedia!
                </p>
                <p>
                    <a href="{{route('front.index')}}" class="px-10 py-3 font-bold text-white bg-indigo-700 rounded-full">
                        Explore Jobs</a>
                </p>
                @endif


            </div>
        </div>
    </div>
</x-app-layout>