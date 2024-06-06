let NotificationManager = {
    showMessage: (message, status) => {
        let status_class = status == 1 ? 'success':'fail';
        let html = `
            <p class='notification ${status_class}'>${message}</p>
        `;
        $(".notification").remove();
        $("body").append(html);

        setTimeout(() => {
            $(".notification").remove();
        }, 5000);
    },
};