@include('backend.dashboard.components.head')

<body>
    <div id="wrapper">
        @include('backend.dashboard.components.sidebar')

        <div id="page-wrapper" class="white-bg dashbard-1">

            <div class="row  border-bottom white-bg dashboard-header">
                @include('backend.dashboard.components.navbar')
            </div>
            <div class="row">
                <div class="col-lg-12">
                    @yield('layout-backend')
                </div>
            </div>

        </div>
    </div>
    @include('backend.dashboard.components.script')
</body>

</html>
