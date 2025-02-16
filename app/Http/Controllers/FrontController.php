<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApplyJobRequest;

class FrontController extends Controller
{
    // home page
    public function index() {
        $categories = Category::all();
        $jobs = CompanyJob::with(['category', 'company'])
        ->latest()
        ->take(6)
        ->get();
        return view('front.index', compact('jobs', 'categories'));
    }

    public function jobs() {
        return view('front.jobs');
    }

    public function about() {
        return view('front.about');
    }

    public function contact() {
        return view('front.contact');
    }

    public function companies() {
        return view('front.companies');
    }

    // detail job
    public function detail (CompanyJob $companyJob){
        $jobs = CompanyJob::with(['category', 'company'])
        ->where('id', '!=', $companyJob->id)
        ->InRandomOrder()
        ->take(4)
        ->get();

        return view('front.detail', compact('companyJob', 'jobs'));
    }

    // category job
    public function category(Category $category) {
        $jobs = CompanyJob::with(['category', 'company'])
        ->where('category_id', $category->id)
        ->latest()
        ->paginate(10);

        return view('front.category', compact('jobs', 'category'));
    }

    // apply job
    public function apply(CompanyJob $companyJob){

        return view('front.apply', compact('companyJob'));
    }

    public function apply_store(StoreApplyJobRequest $request, CompanyJob $companyJob) {

        $user = Auth::user();

        $hasApplied = JobCandidate::where('company_job_id', $companyJob->id)->where('candidate_id', $user->id)->first();

        if($hasApplied) {
            return redirect()->back()->withErrors(['applied' => 'Failed! Anda sudah melamar pekerjaan ini']);
        }

        DB::transaction(function() use ($request, $user, $companyJob) {
            $validated = $request->validated();

            if($request->hasFile('resume')) {
                $resumePath = $request->file('resume')->store('resumes/' . date('Y/m/d'), 'public');
                $validated['resume'] = $resumePath;
            }

            $validated['candidate_id'] = $user->id;
            $validated['is_hired'] = false;
            $validated['company_job_id'] = $companyJob->id;
            JobCandidate::create($validated);
        });

        return redirect()->route('front.apply.success');
    }

    public function success_apply() {

        return view('front.success_apply');
        
    }

    public function search(Request $request) {
        $request->validate([
            'keyword' => ['required', 'string', 'max:255'],
        ]);

        $keyword = $request->keyword;

        $jobs = CompanyJob::with(['category', 'company'])
        ->where('name', 'LIKE', "%{$keyword}%")
        ->orWhere('type', 'LIKE', "%{$keyword}%")
        ->orWhere('location', 'LIKE', "%{$keyword}%")
        ->orWhereHas('company', function($query) use ($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword.'%');
        })->paginate(6);


        return view('front.search', compact('jobs', 'keyword'));
    }

    // cek role user auth for apply
    // if user role = employer then return message "anda tidak bisa melamar karna anda seorang employer"
    // if user role = candidate then run for function apply_store

    public function checkRole() {
        $user = Auth::user();

        if($user->role == 'employer') {
            return redirect()->back()->withErrors(['error' => 'Anda tidak bisa melamar karna anda seorang employer']);
        } else {
            return true;
        }
    }

}
