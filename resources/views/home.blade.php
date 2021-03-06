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

    <style>
        .title{
            font-weight: bold;
            font-size: 2em;
        }

        .created_at{
            font-style: italic;
            font-size: 0.8em;
        }

        .text{
            font-size: 1.5em;
            font-family: serif;
        }

        .news{
            margin-bottom: 10px;
        }

    </style>

    <h2>
        @if( $category )
            Категория : {{ $category->title }}
        @else
            Все новости
        @endif
    </h2>

@foreach ($news as $model )
    <div class="news">
        <div class="title"><a href="{{ route('byNews', [$model->id]) }}" >{{ $model->title }}</a></div>
        <div class="created_at">{{ $model->created_at }} / {{ $model->Category->title }}</div>
        <div class="text"><sub>{{ $model->text }}</sub></div>
    </div>
    <br />
@endforeach

@endsection
