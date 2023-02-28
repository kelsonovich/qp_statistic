@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{ $game->getPackageTitle() }}</h1>

    <table class="table table-sm table-hover table-bordered">
        <thead>
        <tr>
            <th>Место</th>
            <th>Команда</th>
            @foreach(range(1, $roundCount) as $numberRound)
                <th>Раунд {{ $numberRound }}</th>
            @endforeach
            <th>Итого</th>
        </tr>
        </thead>
        <tbody>
        @foreach($results as $key => $result)
            <tr>
                <td>{{ ($key + 1) }}</td>
                <td>
                    <a href="{{ route('team-detail', [$result->team_id]) }}">
                        {{ $result->team->title }}
                    </a>
                </td>
                @foreach(range(1, $roundCount) as $numberRound)
                    <td>{{ $result['round_' . $numberRound] }}</td>
                @endforeach
                <td>{{ $result->total }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


