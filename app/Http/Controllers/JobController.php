<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Job;
use App\Models\Category;

use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index() {
        $categories = Category::all();
        $jobLocations = Job::select('country', 'city', DB::raw('count(*) as count'))->groupBy('country', 'city')->get();
        return view('front.jobs', [
            'categories' => $categories,
            'jobLocations' => $jobLocations
        ]);
    }

    public function loadJobs(Request $request){
        return Job::loadJobs($request);
    }
}
