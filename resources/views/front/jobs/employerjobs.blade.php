@extends('front.layouts.app')

@section('main')
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Your jobs</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero Area End -->
        <!-- Job List Area Start -->
        <div class="job-listing-area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="jobs-items-container mb-30">
                                <div class="container">
                                    <div class="row">
                                
                                        @foreach($jobs as $job)

                                        <div class="col-12">
                                            <div class="single-job-items mb-30">

                                                <div class="job-items">
                                                    <div class="company-img">
                                                        <a href="jobs/{{$job->slug}}"><img width='100' src="{{ $job->user->getAvatar() }}" alt=""></a>
                                                    </div>
                                                    <div class="job-tittle job-tittle2">
                                                        <a href="jobs/{{$job->slug}}">
                                                            <h4>{{ $job->title }}</h4>
                                                        </a>
                                                        <ul>
                                                            <li>{{ $job->user->name }}</li>
                                                            <li><i class="fas fa-map-marker-alt"></i>{{ $job->city }}, {{ $job->country }}</li>
                                                            <li>${{ $job->salary_range_from }} - ${{ $job->salary_range_to }}</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="items-link items-link2 f-right">
                                                    <a href="#" class="font-weight-bold">{{ $job->job_type }}</a>
                                                    <span>{{ $job->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Featured_job_end -->

                        @if($jobs->count())
                        <div class='jobs-pagination'>
                        {{ $jobs->links() }}
                        </div>
                        @endif
                    </div>
                    

                </div>
            </div>
        </div>
        <!-- Job List Area End -->
@endsection