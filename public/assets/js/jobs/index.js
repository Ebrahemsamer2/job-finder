let jobs = {
    init: () => {
        jobs.loadJobs();
    },

    loadJobs: () => {
        let filters = jobs.getFilters();
        $.ajax({
            url: '/load_jobs',
            type: 'GET',
            data: filters,
            success: (response) => {
                jobs.populateJobs(response);
            },
            error: (err) => {
                console.log(err);
            }
        })
    },

    populateJobs: (response) => {
        let jobs = response.jobs;
        let count = response.count;
        if(!count) {
            return;
        }

        let html = ``;
        for(let index in jobs) {
            let job = jobs[index];
            html += `
                <div class="single-job-items mb-30">
                    <div class="job-items">
                        <div class="company-img">
                            <a href="#"><img width='100' src="${job.user.avatar}" alt=""></a>
                        </div>
                        <div class="job-tittle job-tittle2">
                            <a href="#">
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
        $(".featured-job-area .jobs-items-container").append(html);
        $(".count-job > span").text(count +" jobs found");
    },

    getFilters: () => {
        return {
            offset: 0,
            limit: 10
        };
    },
};

$(document).on("ready", () => {
    jobs.init();
});