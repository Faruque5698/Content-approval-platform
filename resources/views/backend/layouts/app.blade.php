<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Dashboard - SB Admin</title>
    @include('backend.partials.styles')
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">

@include('backend.partials.navbar')

<div id="layoutSidenav">
    @include('backend.partials.sidenavbar')
    <div id="layoutSidenav_content">

        @yield('content')

        @include('backend.partials.footer')

        @include('backend.partials.scripts')

    </div>
</div>

</body>
</html>
