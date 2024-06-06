@extends('front.layouts.app')

@section('main')
        <!-- Hero Area Start-->
        <div class="slider-area ">
        <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{ asset('assets/img/hero/about.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>{{ $job['title'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Hero Area End -->
        <!-- job post company Start -->
        <div class="job-post-company pt-120 pb-120">
            <div class="container">
                <div class="row justify-content-between">
                    <!-- Left Content -->
                    <div class="col-xl-7 col-lg-8">
                        <!-- job single -->
                        <div class="single-job-items mb-50">
                            <div class="job-items">
                                <div class="company-img company-img-details">
                                    <a href="#"><img width="100" src="{{ asset($job['user']['avatar']) }}" alt=""></a>
                                </div>
                                <div class="job-tittle">
                                    <a href="#">
                                        <h4>{{ $job['title'] }}</h4>
                                    </a>
                                    <ul>
                                        <li>{{ $job['user']['name'] }}</li>
                                        <li><i class="fas fa-map-marker-alt"></i>{{ $job['city'] }}, {{ $job['country'] }}</li>
                                        <li>${{ $job['salary_range_from'] }} - ${{ $job['salary_range_to'] }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                          <!-- job single End -->
                       
                        <div class="job-post-details">
                            <div class="post-details1 mb-50">
                                <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Job Description</h4>
                                </div>
                                <p>{{ $job['description'] }}</p>
                            </div>
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Required Knowledge, Skills, and Abilities</h4>
                                </div>
                               <ul>
                                @foreach($job['skills'] as $skill)
                                   <li>{{ $skill }}</li>
                                @endforeach
                               </ul>
                            </div>
                            <div class="post-details2  mb-50">
                                 <!-- Small Section Tittle -->
                                <div class="small-section-tittle">
                                    <h4>Education + Experience</h4>
                                </div>
                               <ul>
                                @foreach($job['requirements'] as $requirement)
                                    <li>{{ $requirement }}</li>
                                @endforeach
                               </ul>
                            </div>
                        </div>

                    </div>
                    <!-- Right Content -->
                    <div class="col-xl-4 col-lg-4">
                        <div class="post-details3  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Job Overview</h4>
                           </div>
                          <ul>
                              <li>Posted date : <span>{{ $job['created_at'] }}</span></li>
                              <li>Location : <span>{{ $job['city'] }}, {{ $job['country'] }}</span></li>
                              <li>Vacancy : <span>{{ $job['open_positions'] }}</span></li>
                              <li>Job nature : <span>{{ $job['job_type'] }}</span></li>
                              <li>Salary :  <span>${{ $job['salary_range_from'] }} - ${{ $job['salary_range_to'] }} monthly</span></li>
                          </ul>
                          
                        <div class="apply-btn2">
                            @auth
                                @if(auth()->user()->applications->contains($job['id']))
                                    <p class="text-success font-weight-bold">You are successfully applied for this job</p>
                                @else
                                    @if( auth()->user()->user_type == 'employee' )
                                        <a id="apply-now" href="#" class="btn">Apply Now</a>
                                    @else 
                                        <p class="text-danger text-bold">Only employees can apply for jobs.</p>
                                    @endif
                                @endif
                            @endauth 
                            @guest
                                <p class="text-danger text-bold">You need to <a class="text-primary" href="{{ route('login') }}">Login</a> to apply.</p>
                            @endguest 
                        </div>
                        
                         
                       </div>
                        <div class="post-details4  mb-50">
                            <!-- Small Section Tittle -->
                           <div class="small-section-tittle">
                               <h4>Company Information</h4>
                           </div>
                              <span>{{ $job['user']['name'] }}</span>
                              <p>{{ $job['user']['summery'] }}</p>
                            <ul>
                                <li>Name: <span>{{ $job['user']['name'] }} </span></li>
                                <li>Web : <span> {{ $job['user']['web'] }}</span></li>
                                <li>Email: <span>{{ $job['user']['email'] }}</span></li>
                            </ul>
                       </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- job post company End -->

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/jobs/job-manager.js') }}"></script>
    <script>
        job.slug = "<?php echo $job['slug']; ?>";
    </script>
@endsection