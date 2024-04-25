<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job;

class JobController extends Controller
{
    public function index() {
        return view('front.jobs');
    }

    public function loadJobs(Request $request){
        return Job::loadJobs($request);
    }
}
