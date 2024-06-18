@extends('front.layouts.app')

@section('main')
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Your job applications</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="jobs-items-container mb-30">
                                <div class="container-fluid">
                                    <div class="row">
                                
                                        @foreach($applications as $application)

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="single-job-items mb-30">

                                                <div class="job-items">
                                                    <div class="company-img">
                                                        <a href="jobs/{{$application->job->slug}}"><img width='100' src="{{ $application->job->user->avatar }}" alt=""></a>
                                                    </div>
                                                    <div class="job-tittle job-tittle2">
                                                        <a href="jobs/{{$application->job->slug}}">
                                                            <h4>{{ $application->job->title }}</h4>
                                                        </a>
                                                        <ul>
                                                            <li>{{ $application->job->user->name }}</li>
                                                            <li><i class="fas fa-map-marker-alt"></i>{{ $application->job->city }}, {{ $application->job->country }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="items-link items-link2 f-right">
                                                    <span class="font-weight-bold {{ $application->status < 0 ? 'text-danger' : ''}} {{ $application->status > 0 ? 'text-success' : ''}}">{{ $application->getStatus() }}</span>
                                                    <span>{{ $application->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Featured_job_end -->

                        @if($applications->count())
                        <div class='applications-pagination'>
                        {{ $applications->links() }}
                        </div>
                        @endif
                    </div>
                    

                </div>
            </div>
        </div>
        <!-- Job List Area End -->
@endsection