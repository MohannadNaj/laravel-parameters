    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">{{config('app.name')}}</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="{{is_active('navbar','index')}}">
              <a href="{{route('parameters.index')}}">Home</a>
            </li>
            <li class="{{is_active('navbar','all')}}">
              <a href="{{route('parameters.all')}}">All</a>
            </li>
            <li class="{{is_active('navbar','categories')}}">
              <a href="{{route('parameters.categories')}}">Categories</a>
            </li>
            <li class="{{is_active('navbar','logs')}}">
              <a href="{{route('parameters.logs')}}">Logs</a>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="{{is_active('navbar','create') == "active" ? 'black-bg' : ''}}">
              <div class="navbar-btn">
                <a class="btn btn-success" href="{{route('parameters.create')}}">Add</a>
              </div>
            </li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->
