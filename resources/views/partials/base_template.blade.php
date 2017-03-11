<!DOCTYPE html>
<html lang="en" xmlns:og="http://ogp.me/ns#">
<head>
    <title>@yield('title', 'Homepage') - xxx.kocal.fr - A fucking website made by an incredible retarded student.</title>

    <meta charset="utf-8">
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <![endif]-->

    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url()->full() }}">
    <meta property="og:title" content="xxx.kocal.fr » @yield('title', 'Homepage')">
    <meta property="og:description" content="@yield('description')">

    @stack('metadata')

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('stylesheets')

    {!! Analytics::render() !!}
</head>
<body>

@include('partials.navbar')

<div class="container">
    @yield('body')
</div>

<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
