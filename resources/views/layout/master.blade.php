<!DOCTYPE html>
<html lang="en">
<head>
    @include('layout.header')
</head>
<body>

    <div class="container">
        @yield('content')
    </div>

    @include('layout.scripts')
</body>
</html>
