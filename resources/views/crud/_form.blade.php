<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 22.03.2019
 * Time: 23:05
 */
?>
<div class="form">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form method="{{ $method ?? 'post' }}" action="{{ route( "$resourceId.$action") }}">

            @yield('fields')

        </form>

</div>

