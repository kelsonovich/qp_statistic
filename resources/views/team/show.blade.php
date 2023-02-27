@extends('layouts.app')

@section('content')
    <h1>{{ $team->title }}</h1>

    @include('team.thematic-result')
    @include('team.table-result')
@endsection
