<!DOCTYPE html>
<html lang="en">
<head>
    @include('parameters.shared.parameters-head')
</head>
<body>
	@include('parameters.shared.parameters-navbar')
    
    @yield('content')

@stack('modals')
{{-- <img src="{{asset('images/loading.gif')}}" class="loading" style="display: none; position: fixed; left: 0; bottom: 0;"> --}}
<!-- Scripts -->
<script src="{{asset('vendor/parameters/js/jquery.min.js')}}"></script>
<script src="{{asset('vendor/parameters/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
    @stack('js_footer')
    $(document).ready(function () {
      $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
      });
    });
</script>
@stack('doc_end')
</body>
</html>