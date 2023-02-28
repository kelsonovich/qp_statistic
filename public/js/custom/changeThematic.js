document.addEventListener("DOMContentLoaded", function () {
    document.querySelector('div[data-type="thematic"]').addEventListener('click', function (event) {
        if (event.target.type === 'button') {
            let value = event.target.getAttribute('data-value');

            let url = new URL(window.location.href);

            if (url.pathname === '/') {
                window.location.href = window.location.href + value;
            }

            let pathname = url.pathname.split('/');

            if (pathname.length >= 2) {
                pathname[pathname.length - 1] = value;
            }

            window.location.href = pathname.join('/');
        }
    });
});
