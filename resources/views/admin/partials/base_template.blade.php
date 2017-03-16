<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title', 'Homepage') - xxx.kocal.fr - A fucking website made by an incredible retarded
        student.</title>

    <meta charset="utf-8">
    <meta name="description" content="@yield('description')">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <![endif]-->

    <link rel="icon" type="image/png" href="favicon.png">

    @stack('metadata')

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @stack('stylesheets')
</head>
<body>

@include('admin.partials.navbar', [
    'links' => [
        ['route' => 'admin.videos', 'text' => 'Videos']
    ]
])

<div class="container">
    @yield('body')
</div>


<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
@stack('scripts')

</body>
</html>
