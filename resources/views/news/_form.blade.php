<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 22.03.2019
 * Time: 22:57
 */
?>
@extends( 'crud._form', [ 'resourceId' => $resourceId, 'action' => $action , 'method' => $method ?? 'post' ])

@section('fields')

    <div>Foo</div>

@endsection
