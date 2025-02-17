<?php

namespace App\Http\Controllers;

use App\Models\CompanyJob;
use Illuminate\Http\Request;

class FrontJobController extends Controller
{
    //
    public function index() {
        $jobs = CompanyJob::with(['category', 'company'])
        ->latest()
        ->paginate(8);

        return view('front.jobs', compact('jobs'));
    }
}
