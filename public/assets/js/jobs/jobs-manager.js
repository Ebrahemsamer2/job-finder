let jobs = {

    filters: {
        offset: 0,
        limit: 10,
        job_types: [],
        experiences: [],
        posted_within: [],
        salary_from: 500,
        salary_to: 10000,
    },

    loadedJobs: [],

    init: () => {
        jobs.loadJobs();
        jobs.applyActions();
    },

    loadJobs: () => {
        let filters = jobs.getFilters();
        $.ajax({
            url: '/load_jobs',
            type: 'GET',
            async: false,
            data: filters,
            success: (response) => {
                jobs.populateJobs(response);
            },
            error: (err) => {
                console.log(err);
            }
        })
    },

    initiateSalarySlider: () => {
        let $range = $(".salary-range-slider"),
        $salaryFrom = $(".salary-from"),
        $salaryTo = $(".salary-to"),
        instance,
        min = 500,
        max = 20000,
        from = 10,
        to = 100;

        $range.ionRangeSlider({
            type: "double",
            min: min,
            max: max,
            from: 0,
            to: 10000,
            onStart: (data) => {
                $salaryFrom.prop("value", data.from);
                $salaryTo.prop("value", data.to); 
            },
            onChange: (data) => {
                jobs.filters.offset = 0;
                $salaryFrom.prop("value", data.from);
                $salaryTo.prop("value", data.to); 
            },
            onFinish: (data) => {
                jobs.filters.salary_from = data.from;
                jobs.filters.salary_to = data.to;
                jobs.loadJobs();
            },
            step: 1,
            prettify_enabled: true,
            prettify_separator: ".",
            values_separator: " - ",
            force_edges: true
        });
        instance = $range.data("ionRangeSlider");
    },

    applyActions: () => {

        jobs.initiateSalarySlider();

        $("select[name='category']").on("change", (e) => {
            jobs.filters.offset = 0;
            jobs.filters.category = $(e.target).val();
            jobs.loadJobs();
        });
        $("select[name='job_location']").on("change", (e) => {
            jobs.filters.offset = 0;
            jobs.filters.location = $(e.target).val();
            jobs.loadJobs();
        });
        $("input[name='job_type']").on("change", (e) => {
            jobs.filters.offset = 0;
            jobs.filters.job_types.push($(e.target).val());
            jobs.loadJobs();
        });  
        $("input[name='experience']").on("change", (e) => {
            jobs.filters.offset = 0;
            jobs.filters.experiences.push($(e.target).val());
            jobs.loadJobs();
        });

        $("input[name='posted-within']").on("change", (e) => {
            jobs.filters.offset = 0;
            jobs.filters.posted_within = $(e.target).val();
            jobs.loadJobs();
        });

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= $(document).height() - 800) {
                if(jobs.loadedJobs.length > 0) {
                    jobs.filters.offset += 10;
                    jobs.loadJobs();
                }
            }
        });
    },

    populateJobs: (response) => {
        let offset = jobs.filters.offset;
        let jobsResponse = response.jobs;
        jobs.loadedJobs = response.jobs;
        let count = response.count;
        if(!count) {
            jobs.loadedJobs = [];
            $(".featured-job-area .jobs-items-container").html("There are not jobs available.");
            $(".count-job > span").text("0 jobs found");
            return;
        }

        let html = ``;
        for(let index in jobsResponse) {
            let job = jobsResponse[index];
            html += `
                <div class="single-job-items mb-30">
                    <div class="job-items">
                        <div class="company-img">
                            <a href="jobs/${job.slug}"><img width='100' src="${job.user.avatar}" alt=""></a>
                        </div>
                        <div class="job-tittle job-tittle2">
                            <a href="jobs/${job.slug}">
                                <h4>${job.title}</h4>
                            </a>
                            <ul>
                                <li>${job.user.name}</li>
                                <li><i class="fas fa-map-marker-alt"></i>${job.city}, ${job.country}</li>
                                <li>$${job.salary_range_from} - $${job.salary_range_to}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="items-link items-link2 f-right">
                        <a href="job_details.html">${job.job_type}</a>
                        <span>${job.created_at}</span>
                    </div>
                </div>
            `;
        }
        if(offset === 0) {
            $(".featured-job-area .jobs-items-container").html(html);
        } else {
            $(".featured-job-area .jobs-items-container").append(html);
        }
        $(".count-job > span").text(count +" jobs found");
    },

    getFilters: () => { 
        return jobs.filters;
    },
};

$(document).on("ready", () => {
    jobs.init();
});