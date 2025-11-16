<!DOCTYPE html>
<html lang="en">

@include('user_layout.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('user_layout.navbar')

        @include('user_layout.sidebar')

        @yield('contents')

        @include('user_layout.footer')


    </div>
    <!-- ./wrapper -->

    @include('user_layout.script')

    @yield('scripts')

    @include('sweetalert::alert')
</body>

</html>
