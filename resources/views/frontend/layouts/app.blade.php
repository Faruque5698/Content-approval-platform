<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @include('frontend.partials.styles')
</head>
<body>

@include('frontend.partials.navbar')

@yield('content')

@include('frontend.partials.footer')

@include('frontend.partials.scripts')
{!! Toastr::message() !!}

</body>
</html>
