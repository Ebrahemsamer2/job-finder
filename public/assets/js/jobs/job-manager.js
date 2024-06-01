let job = {
    slug: '',
    init:() => {
        job.applyActions();
    },
    applyActions: () => {
        $("#apply-now").on('click', (e) => {
            e.preventDefault();
            let token = $("meta[name='token']").attr('content');
            let slug = job.slug;
            let data = {};
            data.token = token;
            data.slug = slug;
            $.ajax({
                url: '/apply',
                type: 'POST',
                headers: {
                    'X-CSRF-Token': token,
                  },
                async: false,
                data: data,
                success: (response) => {
                    let message = response.message;
                    if(response.success) {
                        let html = `
                            <p class="text-success font-weight-bold">${message}</p>
                        `;
                        $(".apply-btn2").html(html);
                    }
                },
                error: (err) => {
                    console.log(err);
                }
            })
        });
    },
};


$(document).on("ready", () => {
    job.init();
});