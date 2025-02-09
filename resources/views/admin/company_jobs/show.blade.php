<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Project Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">
                 

                <div class="flex flex-row justify-between item-card gap-y-10 md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($companyJob->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">{{ $companyJob->name }}</h3>
                            <p class="text-sm text-slate-500">{{ $companyJob->category->name }}</p>
                        </div>
                    </div>
                    <div class="flex flex-row items-center gap-x-3">
                        @if ($companyJob->is_open)
                        <form action="{{ route('admin.company_jobs.close', $companyJob) }}" method="post">
                            @csrf
                            @method('PUT')
                            <?php
                            $user = Auth::user();
                            ?>
                            <input type="hidden" name="cur" value="{{ $user->id }}">
                            <button type="submit" class="px-6 py-4 font-bold text-white bg-red-500 rounded-full">
                                Close Job
                            </button>

                        </form>
                        <p class="px-6 py-4 font-bold text-white bg-green-500 rounded-full">
                            Now Hiring
                        </p>
                        @endif
                        @if (!$companyJob->is_open)
                        <p class="px-6 py-4 font-bold text-white bg-red-500 rounded-full">
                            Applications Closed
                        </p>
                        @elseif ($companyJob->is_open)
                        @endif
                        <a href="{{ route('admin.company_jobs.edit', $companyJob) }}" class="px-6 py-4 font-bold text-white bg-indigo-500 rounded-full">
                            Edit Job
                        </a>
                        <a href="" class="px-6 py-4 font-bold text-white bg-orange-500 rounded-full">
                            Preview
                        </a>
                    </div>

                    
                </div>

                <hr class="my-5">
                <div class="flex flex-row justify-between">
                    <div>
                        <p class="text-sm text-slate-500">Salary</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{ number_format($companyJob->salary, 0, ',', '.') }} /mo
                        </h3>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Job Type</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $companyJob->type }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Location</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $companyJob->location }}
                        </h3>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Level</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            {{ $companyJob->skill_level }}
                        </h3>
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-indigo-950">
                        About
                    </h3>
                    <p class="text-sm text-slate-500">{{ $companyJob->about }}</p>
                </div>
                
                <div class="flex flex-row gap-x-10">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-indigo-950">
                            Responsibilities
                        </h3>
                        <ul class="flex flex-col gap-y-3">
                            @foreach ($companyJob->responsibilities as $responsibility )
                            <li class="text-base text-slate-500">{{ $responsibility->name}}</li>
                            @endforeach
 
                        </ul>
                    </div>
    
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-indigo-950">
                            Qualifications
                        </h3>
                        <ul class="flex flex-col gap-y-3">
                            @foreach ($companyJob->qualifications as $qualification )
                                <li class="text-base text-slate-500">{{ $qualification->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <hr class="my-5">

                <h3 class="text-xl font-bold text-indigo-950">Candidates</h3>
                @forelse ($companyJob->candidates as $candidate)
                    <div class="flex flex-row items-center justify-between">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($candidate->profile->avatar) }}" alt="" class="rounded-full object-cover w-[70px] h-[70px]">
                            <div class="flex flex-col">
                                <h3 class="text-xl font-bold text-indigo-950">
                                    {{ $candidate->name }}
                                </h3>
                                <p class="text-sm text-slate-500">
                                    {{ $candidate->profile->occupation }} - {{ $candidate->profile->experience }} yrs exp
                                </p>
                            </div>
                        </div>
                        @if ($candidate->is_hired)
                        <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                            HIRED
                        </span>
                        
                        @elseif (!$candidate->is_hired && $companyJob->is_open)
                        <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                            WAITING
                        </span>
                        
                        @elseif (!$candidate->is_hired && !$companyJob->is_open)
                        <span class="px-3 py-2 text-sm font-bold text-white bg-red-500 rounded-full w-fit">
                            REJECTED
                        </span>
                        @endif


                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('admin.job_candidates.show', $candidate) }}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                                Details
                            </a>
                        </div>
                    </div>
                @empty
                <x-data-not-found message="Belum ada candidate yang tertarik pada projek ini"></x-data-not-found>
                @endforelse
                
            </div>
        </div>
    </div>
</x-app-layout>
