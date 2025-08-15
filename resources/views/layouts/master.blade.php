<!doctype html>
<html lang="en">
@include('layouts.head')

<body>
    @include('sweetalert::alert')

    @include('layouts.navbar')
    @yield('content')

    @include('layouts.footer')
</body>

</html>
