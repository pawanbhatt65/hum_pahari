<!DOCTYPE html>
<html lang="en">
@include('backend.layouts.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('backend.layouts.navbar')

        @include('backend.layouts.sidebar')

        @yield('contents')

        @include('backend.layouts.footer')
    </div>
    <!-- ./wrapper -->

    @include('backend.layouts.script')

    @yield('scripts')

    @include('sweetalert::alert')
</body>

</html>
