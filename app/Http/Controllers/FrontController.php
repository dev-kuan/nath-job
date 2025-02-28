<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CompanyJob;
use App\Models\JobCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreApplyJobRequest;
use App\Models\Company;

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

    public function jobs(Request $request) {

        $query = CompanyJob::query();
        
        // filter by job type
        if($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // filter by skill level
        if($request->filled('level')) {
            $query->where('skill_level', $request->level);
        }

        if($request->filled('sortBy')) {
            $query->sortBy($request->sortBy);
        }

        $jobs = $query->filter(request(['search', 'type', 'skill_level', 'category', 'company']))
        ->with(['category', 'company'])
        ->paginate(8)
        ->withQueryString();

        $types = [
            ['label' => 'Full time', 'value' => 'full-time'],
            ['label' => 'Part time', 'value' => 'part-time'],
            ['label' => 'Remote', 'value' => 'remote'],
            ['label' => 'Contract', 'value' => 'contract'],
        ];

        $skillLevel = [
            ['label' => 'Entry level', 'value' => 'entry'],
            ['label' => 'Junior', 'value' => 'junior'],
            ['label' => 'Mid level', 'value' => 'mid'],
            ['label' => 'Senior level', 'value' => 'senior'],
            ['label' => 'Expert level', 'value' => 'expert'],
        ];

        $locations = [
            ['label' => 'Jakarta', 'value' => 'jakarta'],
            ['label' => 'Bandung', 'value' => 'bandung'],
            ['label' => 'Surabaya', 'value' => 'surabaya'],
            ['label' => 'Bali', 'value' => 'bali'],
            ['label' => 'Kupang', 'value' => 'kupang'],
        ];

        $sortOptions = [
            ['label' => 'Latest Post', 'value' => 'latest'],
            ['label' => 'Oldest Post', 'value' => 'oldest'],
            ['label' => 'Highest Salary', 'value' => 'highest_salary'],
            ['label' => 'Lowest Salary', 'value' => 'salary_low'],
            ['label' => 'Name Asc', 'value' => 'name_asc'],
            ['label' => 'Name Desc', 'value' => 'name_desc'],
        ];

        return view('front.jobs', compact('jobs', 'types', 'sortOptions', 'skillLevel', 'locations'));
    }

    public function company_jobs(Company $company)
    {
        $jobs = CompanyJob::with(['category', 'company'])
        ->where('company_id', $company->id)
        ->latest()
        ->paginate(8);

        $isOpen = CompanyJob::where('company_id', $company->id)
        ->where('is_open', true)
        ->count();

        return view('front.company_jobs', compact('jobs', 'company', 'isOpen'));
    }

    public function about() {
        return view('front.about');
    }

    public function contact() {
        return view('front.contact');
    }

    public function companies(Request $request) {
        $query = Company::query();

        if($request->filled('sortBy')) {
            $query->sortBy($request->sortBy);
        };

        if($request->filled('location')) {
            $query->where('location', $request->location);
        };

        $companies = $query->filter(request(['search', 'location']))
        ->with(['jobs'])
        ->paginate(10)
        ->withQueryString();

        $locations = [
            ['label' => 'Jakarta', 'value' => 'jakarta'],
            ['label' => 'Bandung', 'value' => 'bandung'],
            ['label' => 'Surabaya', 'value' => 'surabaya'],
            ['label' => 'Bali', 'value' => 'bali'],
            ['label' => 'Kupang', 'value' => 'kupang'],
        ];

        $sortOptions = [
            ['label' => 'Name Asc', 'value' => 'name_asc'],
            ['label' => 'Name Desc', 'value' => 'name_desc'],
        ];

        return view('front.companies', compact('companies','locations', 'sortOptions' ));
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
