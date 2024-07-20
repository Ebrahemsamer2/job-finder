<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\JobApplication;
use App\Models\Job;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $applications = JobApplication::with('job')->where('user_id', auth()->user()->id)->orderBy('updated_at')->paginate(20);
        return view('front.applications.index', [
            'applications' => $applications,
        ]);
    }
    
    public function loadEmployerJobApplications(Job $job)
    {   
        $applications = $job->applicants()->withPivot('status')->paginate(20);
        return view('front.applications.jobapplications', [
            'applications' => $applications,
            'job' => $job,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        if($user->user_type === User::EMPLOYER) {
            return response()->json([
                'success' => 0,
                'message' => 'Only employees can apply for jobs.'
            ]);
        }
        $job = Job::where('slug', $request->input('slug'))->first();
        
        if($user->applications->contains($job)) {
            return response()->json([
                'success' => 0,
                'message' => 'You already applied for this job'
            ]);
        }

        $user->applications()->attach($job);

        return response()->json([
            'success' => 1,
            'message' => 'You are successfully applied for this job'
        ]);
    }
}
