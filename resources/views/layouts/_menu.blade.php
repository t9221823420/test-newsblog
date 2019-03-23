<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 23.03.2019
 * Time: 11:48
 */
?>


<ul>
    <li><a href="{{ route('news.index') }}">Admin</a></li><br />
    <li><a href="/">Все новости</a></li><br />

    @foreach ( $categories as $model )
        <li><a href="{{ route( 'byCategory', [$model->id]) }}">{{ $model->title }}</a></li>
    @endforeach
</ul>
