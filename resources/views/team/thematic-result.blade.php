
<table class="table table-sm table-hover table-bordered">
    <thead>
    <tr>
        <th>Категория игр</th>
        <th>Средний балл</th>
        <th>Игр</th>
        <th>Побед</th>
        <th>Всего баллов</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="5">
                <a href="{{ route('team-detail', [$team->id]) }}">
                    Все игры
                </a>
            </td>
        </tr>
        @foreach($rating as $key => $result)
            <tr>
                <td>
                    <a href="{{ route('team-detail', [$team->id, $result->thematic->id]) }}">
                        {{ $result->thematic->title }}
                    </a>
                </td>
                <td>{{ $result->average }}</td>
                <td>{{ $result->games }}</td>
                <td>{{ $result->wins }}</td>
                <td>{{ $result->points }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
