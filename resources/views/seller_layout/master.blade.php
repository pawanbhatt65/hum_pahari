<!DOCTYPE html>
<html lang="en">

@include('seller_layout.head')

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        @include('seller_layout.navbar')

        @include('seller_layout.sidebar')

        @yield('contents')

        @include('seller_layout.footer')


    </div>
    <!-- ./wrapper -->

    @include('seller_layout.script')

    @yield('scripts')

    @include('sweetalert::alert')
</body>

</html>
