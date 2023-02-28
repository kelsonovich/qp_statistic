
<table class="table table-sm table-hover table-bordered">
    <thead>
    <tr>
        <th>Игр</th>
        <th>Всего баллов</th>
        <th>Средний балл</th>
        <th>Побед</th>
        <th>Процент побед</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($rating as $key => $value)
                <td>{{ $value }}</td>
            @endforeach
        </tr>
    </tbody>
</table>
