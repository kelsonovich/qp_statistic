@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Сыгранные пакеты</h1>

    <table class="table table-sm table-hover table-bordered">
        <thead>
        <tr>
            <th>Пакет</th>
            <th>Сыграно игр</th>
        </tr>
        </thead>
        <tbody>
        @foreach($games as $game)
            <tr>
                <td>
                    <a href="{{ route('package-detail', [$game['link']]) }}">
                        {{ $game['name'] }}
                    </a>
                </td>
                <td>{{ count($game['ids']) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection


