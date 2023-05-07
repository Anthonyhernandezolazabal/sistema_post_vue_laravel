@extends('app')

@section('content')

    <navbar-component></navbar-component>
    <sidebar-component></sidebar-component>

    <div class="content-wrapper">

        <div class="content">
            <router-view></router-view>
        </div>
        {{--  <example-component></example-component>  --}}

    </div>

    <aside class="control-sidebar control-sidebar-dark"></aside>

@endsection

