    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{asset('vendor/parameters/css/app.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
            'images_dir' => 'storage',
            'base_url' => url('/') . '/',
            'parametersColumns' =>  array_fill_keys($parametersColumns, null ), // $parametersColumns from Service Provider
            'parametersTypes'=> Parameter\ParametersManager::$supportedTypes,
            'auth_user_id' => auth()->id(),
        ] ); ?>;
    </script>
    
    <style type="text/css">
body {
  padding-top: 70px;
}
footer {
  padding: 30px 0;
}

.black-bg {
  background: #000000;
}

.no-padding-bottom {
  padding-bottom: 0px;
}
.no-margin {
  margin: 0px !important;
}
    </style>