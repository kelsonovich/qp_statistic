@extends('layouts.app')

@section('content')
    @include('ui.thematic-filter')
    <table class="table table-sm table-hover table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Команда</th>
            <th>Средний балл</th>
            <th>Игр</th>
            <th>Побед</th>
            <th>Процент побед</th>
            <th>Всего баллов</th>
        </tr>
        </thead>
        <tbody>
        @foreach($teams as $key => $team)
            <tr>
                <td>{{ ($key + 1) }}</td>
                <td>
                    <a href="{{ route('team-detail', [$team->team_id, $thematic]) }}" class="">
                        {{ $team->team->title }}
                    </a>
                </td>
                <td>{{ $team->average }}</td>
                <td>{{ $team->games }}</td>
                <td>{{ $team->wins }}</td>
                <td>{{ 100 * round($team->wins / $team->games, 4) }}</td>
                <td>{{ $team->points }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
