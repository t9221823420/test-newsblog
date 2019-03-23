<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 22.03.2019
 * Time: 22:50
 */

?>
@extends('layouts.app')

@section('content')

    <h2>
        {{ $title }}
    </h2>

    <a href='{{ route( "$resourceId.create" ) }}' class="btn btn-primary">Create</a>

    {!! $grid !!}

@endsection
