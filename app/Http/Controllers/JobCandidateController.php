<?php

namespace App\Http\Controllers;

use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobCandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        return view('dashboard.my_applications');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(JobCandidate $jobCandidate)
    {
        //

        return view('admin.job_candidates.show', compact('jobCandidate'));
    }

    public function download_file(JobCandidate $jobCandidate) {
        $user = Auth::user();

        if($jobCandidate->job->company->employer_id != $user->id) {
            abort(403);
        }

        $filePath = $jobCandidate->resume;

        if(!Storage::disk('public')->exists($filePath)) {
            abort(404);
        } 

        return Storage::disk('public')->download($fileSPath);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobCandidate $jobCandidate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JobCandidate $jobCandidate)
    {
        // hired candidates
        $user = Auth::user();

        if($jobCandidate->job->company->employer_id!= $user->id) {
            abort(403);
        }

        DB::transaction(function () use ($jobCandidate) {
            $jobCandidate->update([
                'is_hired' => true,
            ]);
        });

        return view('admin.job_candidates.show', compact('jobCandidate'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobCandidate $jobCandidate)
    {
        //
    } 
}
