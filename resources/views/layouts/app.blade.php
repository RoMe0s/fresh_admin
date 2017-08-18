<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! FrontMeta::render() !!}

    @section('styles')
        @include('partials.styles')
    @show
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
        @include('partials.header')

        @yield('content')

        @include('partials.footer')

@section('scripts')
    @include('partials.scripts')
@show
<!-- Scripts -->
<script src="{!! asset('js/app.js') !!}"></script>
@include('partials.messages')
</body>
</html>
