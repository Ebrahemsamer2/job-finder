@extends('front.layouts.app')

@section('main')
        <!-- Hero Area Start-->
        <div class="slider-area ">
            <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="assets/img/hero/about.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="hero-cap text-center">
                                <h2>Get your job</h2>
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
                    <!-- Left content -->
                    <div class="col-xl-3 col-lg-3 col-md-4">
                        <div class="row">
                            <div class="col-12">
                                    <div class="small-section-tittle2 mb-45">
                                    <div class="ion"> <svg 
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="20px" height="12px">
                                    <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                        d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                    </svg>
                                    </div>
                                    <h4>Filter Jobs</h4>
                                </div>
                            </div>
                        </div>
                        <!-- Job Category Listing start -->
                        <div class="job-category-listing mb-50">
                            <!-- single one -->
                            <div class="single-listing">
                               <div class="small-section-tittle2">
                                     <h4>Job Category</h4>
                               </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="category">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Job Type</h4>
                                    </div>
                                    <label class="container">Full Time
                                        <input value="Full Time" name='job_type' type="checkbox" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Part Time
                                        <input value="Part Time" name='job_type' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Remotly
                                        <input value="Remotly" name='job_type' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Freelance
                                        <input value="Freelance" name='job_type' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single two -->
                            <div class="single-listing">
                               <div class="small-section-tittle2">
                                     <h4>Job Location</h4>
                               </div>
                                <!-- Select job items start -->
                                <div class="select-job-items2">
                                    <select name="job_location">
                                        <option value="">Anywhere</option>
                                        @foreach($jobLocations as $jobLocation)
                                        <option value="{{ $jobLocation->country }} - {{ $jobLocation->city }}">{{ $jobLocation->country }} - {{ $jobLocation->city }} <span class='float-right'>( {{ $jobLocation->count }} )</span></option>
                                        @endforeach
                                    </select>
                                </div>
                                <!--  Select job items End-->
                                <!-- select-Categories start -->
                                <div class="select-Categories pt-80 pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Experience</h4>
                                    </div>
                                    <label class="container">1-2 Years
                                        <input name='experience' value='1-2' type="checkbox" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">2-3 Years
                                        <input name='experience' value='2-3' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">3-6 Years
                                        <input name='experience' value='3-6' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">6-10
                                        <input name='experience' value='6-10' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">10-20
                                        <input name='experience' value='10-20' type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <!-- single three -->
                            <div class="single-listing">
                                <!-- select-Categories start -->
                                <div class="select-Categories pb-50">
                                    <div class="small-section-tittle2">
                                        <h4>Posted Within</h4>
                                    </div>
                                    <label class="container">Any
                                        <input value="any" name="posted-within" type="radio" checked="checked active">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Today
                                        <input value="today" name="posted-within" type="radio" >
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 2 days
                                        <input value="last_2_days" name="posted-within" type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 3 days
                                        <input value="last_3_days" name="posted-within" type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 5 days
                                        <input value="last_5_days" name="posted-within" type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Last 10 days
                                        <input value="last_10_days" name="posted-within" type="radio">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <!-- select-Categories End -->
                            </div>
                            <div class="single-listing">
                                <!-- Range Slider Start -->
                                <aside class="left_widgets p_filter_widgets price_rangs_aside sidebar_box_shadow">
                                    <div class="small-section-tittle2">
                                        <h4>Salary Range</h4>
                                    </div>
                                    <div class="widgets_inner">
                                        <div class="range_item">
                                            <!-- <div id="slider-range"></div> -->
                                            <input type="text" class="salary-range-slider" value="" />
                                            <div class="d-flex align-items-center">
                                                <div class="price_text">
                                                    <p>Salary :</p>
                                                </div>
                                                <div class="price_value d-flex justify-content-center">
                                                    <input type="text" class="salary-from" id="amount" readonly />
                                                    <span>to</span>
                                                    <input type="text" class="salary-to" id="amount" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </aside>
                              <!-- Range Slider End -->
                            </div>
                        </div>
                        <!-- Job Category Listing End -->
                    </div>
                    <!-- Right content -->
                    <div class="col-xl-9 col-lg-9 col-md-8">
                        <!-- Featured_job_start -->
                        <section class="featured-job-area">
                            <div class="container">
                                <!-- Count of Job list Start -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="count-job mb-35">
                                            <span></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- Count of Job list End -->

                                <div class="jobs-items-container mb-30">

                                </div>
                                
                            </div>
                        </section>
                        <!-- Featured_job_end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Job List Area End -->
@endsection

@section('scripts')
    <script src="assets/js/jobs/index.js"></script>
@endsection