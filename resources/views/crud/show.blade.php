<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 23.03.2019
 * Time: 19:39
 */
?>
@extends('layouts.app')

@section('content')

    <h2>
        {{ $title }}
    </h2>

    <form action="{{ route( $model::resourceId() . '.destroy',[$model->id]) }}" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <button class="btn btn-danger">Delete User</button>
    </form>

@foreach ($model->getAttributes() as $attrName => $value)
    <div class="row">
        <div class="col-md-2">{{ $attrName }}</div>
        <div class="col-md-10">{{ $value }}</div>
    </div>
@endforeach

@endsection
