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
        $applications = JobApplication::with('job')->orderBy('updated_at')->paginate(20);
        return view('front.applications.index', [
            'applications' => $applications,
        ]);
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
