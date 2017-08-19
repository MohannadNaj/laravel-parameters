<!DOCTYPE html>
<html lang="en">
<head>
    @include('parameters::shared.parameters-head')
</head>
<body>
    <div id="app">
      @include('parameters::shared.parameters-navbar')
    	@yield('content')
      <!-- Helpers -->
      <notifications></notifications>
      <modal ref="modal" id="modal"></modal>
      <dropzone-upload ref="dropzone-modal" _target="parameters/addPhoto" _update_target="parameters/updatePhoto"></dropzone-upload>
    </div>
<script src="{{asset('vendor/parameters/js/app.js') . '?v='.Illuminate\Support\Str::random()}}"></script>
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