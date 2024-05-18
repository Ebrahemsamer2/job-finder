<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\JobResource;

use App\Models\Job;
use App\Models\Category;

use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index() {
        $categories = Category::all();
        $jobLocations = Job::select('country', 'city', DB::raw('count(*) as count'))->groupBy('country', 'city')->get();
        return view('front.jobs.index', [
            'categories' => $categories,
            'jobLocations' => $jobLocations
        ]);
    }

    public function show(Job $job) {
        return view('front.jobs.show', [
            'job' => (new JobResource($job))->resolve(),
        ]);
    }

    public function loadJobs(Request $request){
        return Job::loadJobs($request);
    }
}
