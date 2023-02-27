<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Статистика КП с 283 пакета</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
</head>

<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a class="p-2 text-dark" href="{{  route('rating-table')  }}">Главная</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">

    </nav>
</div>

<div class="container">
    @yield('content')
</div>
<script type="text/javascript" src="{{ asset('js/bootstrap.js') }}" ></script>
</body>
</html>
