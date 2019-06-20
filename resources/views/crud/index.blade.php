@extends('layouts.app')

@section('content')

    <h2>{{ $title }}</h2>

    <a href='{{ route( "$resourceId.create" ) }}' class="btn btn-primary">Create</a>

    {!! $grid !!}

@endsection
