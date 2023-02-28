@extends('layouts.app')

@section('content')
    <h1>{{ $team->title }}</h1>

    @include('ui.thematic-filter')
    @include('team.thematic-result')
    @include('team.table-result')
@endsection
