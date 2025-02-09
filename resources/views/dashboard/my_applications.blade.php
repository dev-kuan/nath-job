<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Manage Job Applications') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="flex flex-col p-10 overflow-hidden bg-white shadow-sm sm:rounded-lg gap-y-5">

                @forelse($my_applications as $application)
                <div class="flex flex-row items-center justify-between item-card">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{Storage::url($application->job->thumbnail)}}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-xl font-bold text-indigo-950">
                                {{ $application->job->name }}
                            </h3>
                        <p class="text-sm text-slate-500">
                           {{ $application->job->category->name }}
                        </p>
                        </div>
                    </div> 
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Salary</p>
                        <h3 class="text-xl font-bold text-indigo-950">
                            Rp {{ number_format($application->job->salary) }}/mo
                        </h3>
                    </div>
                    <div  class="flex-col hidden md:flex">
                        <p class="text-sm text-slate-500">Status</p>
                            @if ($application->is_hired)
                            <span class="px-3 py-2 text-sm font-bold text-white bg-green-500 rounded-full w-fit">
                                HIRED
                            </span>
                            @elseif (!$application->is_hired && $application->job->is_open)
                            <span class="px-3 py-2 text-sm font-bold text-white bg-orange-500 rounded-full w-fit">
                                WAITING
                            </span> 
                            @elseif (!$application->is_hired)
                            <span class="px-3 py-2 text-sm font-bold text-white bg-red-500 rounded-full w-fit">
                                REJECTED
                            </span>
                            @endif
                    </div>
                    <div class="flex-row items-center hidden md:flex gap-x-3">
                        <a href="{{ route('dashboard.my.applications.details', $application)}}" class="px-6 py-4 font-bold text-white bg-indigo-700 rounded-full">
                            View Details
                        </a>
                    </div>
                </div>
                @empty
                <p>
                    <a href="{{ route('front.index')}}" class="px-10 py-3 text-white bg-indigo-500">
                    Explore Jobs</a>
                </p>
                @endforelse
                
            </div>
        </div>
    </div>
</x-app-layout>
