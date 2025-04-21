<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title>@yield('title')</title>
    @include('backend.partials.styles')
</head>


<body data-menu-color="light" data-sidebar="default">
    <div id="app-layout">
        @include('backend.partials.topbar')
        @include('backend.partials.sidebar')

        <div class="content-page">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </div>
    @include('backend.partials.scripts')
</body>

</html>
