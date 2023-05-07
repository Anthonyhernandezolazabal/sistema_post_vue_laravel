<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('sections.head')
    <body class="hold-transition sidebar-mini">
        <div class="wrapper" id="app">
            @yield('content')
        </div>
    @include('sections.script')
    </body>
</html>
