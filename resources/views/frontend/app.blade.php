<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    @include('frontend.partials.styles')
</head>

<body>
    <div class="container">
        @yield('content')
    </div>
</body>

</html>
