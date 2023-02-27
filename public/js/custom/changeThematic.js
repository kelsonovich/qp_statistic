document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('div[data-type="thematic"]').addEventListener('click', function (event) {
        if (event.target.type === 'button') {
            let value = event.target.getAttribute('data-value');

            let url = new URL(window.location.href);

            url.searchParams.set('thematic', value);

            window.location.href = url.toString();
        }
    });
});
