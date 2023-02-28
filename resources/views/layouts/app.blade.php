<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Статистика КП с 283 пакета</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>

<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-3 border-bottom">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li>
                <a href="{{ route('rating-table') }}" class="nav-link px-2 link-secondary">
                    <span class="fs-6">Рейтинг</span>
                </a>
            </li>
            <li>
                <a href="{{ route('package-list') }}" class="nav-link px-2 link-dark">
                    <span class="fs-6">Пакеты</span>
                </a>
            </li>
        </ul>

        <form class="col-12 col-lg-auto mb-lg-0 me-lg-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Команда..." aria-label="Команда..." aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="button" id="button-addon2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </button>
            </div>
        </form>
    </header>
</div>
<div class="container mb-3">
    @yield('content')
</div>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}" ></script>
</body>
</html>
