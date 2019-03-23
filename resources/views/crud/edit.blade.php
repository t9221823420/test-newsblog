<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 22.03.2019
 * Time: 22:57
 */
?>
@extends('layouts.app')

@section('content')

    <h2>
        {{ $title }}
    </h2>

    {!! form($form) !!}

@endsection