<!DOCTYPE html>
<html lang="en">
@include('frontend.components.head')

<body>
    @include('frontend.components.header')
    @yield('layout-frontend')
    @include('frontend.components.footer')
    @include('frontend.components.script')
    @include('frontend.components.copyright')
    @include('frontend.components.backToTop')
</body>

</html>
