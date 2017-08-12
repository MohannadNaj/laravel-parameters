<!DOCTYPE html>
<html lang="en">
<head>
    @include('parameters::shared.parameters-head')
</head>
<body>
    <div id="app">
      @include('parameters::shared.parameters-navbar')
    	@yield('content')
      <notifications></notifications>
      <modal ref="modal" id="modal"></modal>
    </div>
<script src="{{asset('vendor/parameters/js/app.js') . '?v='.Illuminate\Support\Str::random()}}"></script>
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