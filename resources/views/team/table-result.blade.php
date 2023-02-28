
<table class="table table-sm table-hover table-bordered">
    <thead>
    <tr>
        <th>#</th>
        <th>Игра</th>
        <th>Место</th>
        <th>Баллов</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($results as $key => $result)
        <tr
            @if ($result->place == 1)
                class="table-success"
            @endif
        >
            <td>{{ ($key + 1) }}</td>
            <td>
                <a href="{{ route('game-detail', [$result->game->id]) }}">
                    {{ $result->game->title }}
                    @if ($result->game->package > 0)
                        #{{ $result->game->package }}
                    @endif
                </a>
            </td>
            <td>{{ $result->place }}</td>
            <td>{{ $result->total }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
