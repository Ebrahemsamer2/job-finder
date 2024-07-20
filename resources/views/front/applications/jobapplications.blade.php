@extends('front.layouts.app')

@section('main')
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/about.jpg') }}">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>{{ $job->title }} applications</h2>
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
                                
                                        @foreach($applications as $applicant)

                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                            <div class="single-job-items mb-30">

                                                <div class="job-items">
                                                    <div class="company-img">
                                                        <a href="#"><img width='100' src="{{ $applicant->getAvatar() }}" alt=""></a>
                                                    </div>
                                                    <div class="job-tittle">
                                                        <a href="#">
                                                            <h4>{{ $applicant->name }}</h4>
                                                        </a>
                                                        <ul>
                                                            <li><a href="#" class="font-weight-bold main-blue-color" target="_blank">View Application</a></li>
                                                            <li><a href="#" class="font-weight-bold main-blue-color">Quick View</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="items-link items-link2 f-right">
                                                    <span class="font-weight-bold {{ $applicant->pivot->status < 0 ? 'text-danger' : ''}} {{ $applicant->pivot->status > 0 ? 'text-success' : ''}}">{{ $applicant->pivot->getStatus() }}</span>
                                                    <span>{{ $applicant->pivot->created_at ?  $applicant->pivot->created_at->diffForHumans() : 'Unkown' }}</span>
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