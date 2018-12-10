<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/morris.js/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <!--link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <script
      src="https://code.jquery.com/jquery-3.1.1.min.js"
      integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
      crossorigin="anonymous">
    </script-->
    <!-- Semantic -->
    <!--link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.min.css') }}">
    <script src="{{ asset('js/semantic.min.js') }}"></script>
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/components/icon.min.css'-->
  </head>
  <body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        @guest
        <a href="/" class="logo">
        @else
        <a href="{{ route('home') }}" class="logo">
        @endguest
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>WRK</b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Workana</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <!-- Header Navbar: style can be found in header.less -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              @guest
              <li><a href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a></li>
              <li><a href="{{ route('register') }}">{{ __('Registrarse') }}</a></li>
              @else
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('storage/profile_pictures/' . Auth::user()->foto_perfil) }}" class="user-image" alt="User Image">
                  <span class="hidden-xs">{{ Auth::user()->nombre . ' ' . Auth::user()->apellido }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="{{ asset('storage/profile_pictures/' . Auth::user()->foto_perfil) }}" class="img-circle" alt="User Image">
                    <p>
                      {{ Auth::user()->nombre . ' ' . Auth::user()->apellido }}
                      <small>Miembro desde {{ Auth::user()->created_at->format('Y-m-d') }}</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="/user/{{Auth::user()->id}}/profile" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">Cerrar sesión
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </div>
                  </li>
                </ul>
              </li>
              @endguest
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            @guest
            @else
            <div class="pull-left image">
              <img src="{{ asset('storage/profile_pictures/' . Auth::user()->foto_perfil) }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->nombre . ' ' . Auth::user()->apellido }}</p>
              <a href="#"><i class="fa fa-circle text-success"></i>En línea</a>
            </div>
            @endguest
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
            <li class="header">NAVEGACIÓN</li>
            <li>
              @guest
              <a href="/">
              @else
              <a href="{{ route('home') }}">
              @endguest
                <i class="fa fa-home"></i> <span>Inicio</span>
              </a>
            </li>
            @auth
            <li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Freelancer</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('search_projects') }}"><i class="fa fa-circle-o"></i> Buscar proyectos</a></li>
                <li><a href="/user/propuestas"><i class="fa fa-circle-o"></i> Mis propuestas</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-archive"></i> <span>Cliente</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('projects.index') }}"><i class="fa fa-circle-o"></i> Mis proyectos</a></li>
                <li><a href="{{ route('projects.create') }}"><i class="fa fa-circle-o"></i> Crear proyecto</a></li>
                <li><a href="{{ route('freelancers') }}"><i class="fa fa-circle-o"></i> Encontrar freelancers</a></li>
              </ul>
            </li>
            @endauth
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Perfil de Usuario
          </h1>
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" width="100%" height="100%" src="{{ asset('storage/profile_pictures/' . $user->foto_perfil) }}" alt="User profile picture">

              <h3 class="profile-username text-center">{{ $user->nombre . ' ' . $user->apellido }}</h3>
              <p class="text-muted text-center">
                @if(Auth::user()->id == $user->id)
                  (<a href="#" data-toggle="modal" data-target="#editfoto">Cambiar foto de perfil</a>)
                @endif
              </p>
              <p class="text-muted text-center">
                  @for($i=1; $i<=round(\App\Http\Controllers\UsersController::get_calif($user->id)); $i++)
                  <i class="fa fa-star" style="color:gold; width: 10px !important; height: 10px !important;"></i>
                  @endfor
                  @for($i=1; $i<=(5 - round(\App\Http\Controllers\UsersController::get_calif($user->id))); $i++)
                  <i class="fa fa-star-o" style="color:gray; width: 10px !important; height: 10px !important;"></i>
                  @endfor
              </p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Proyectos publicados como Cliente</b> <a class="pull-right">{{ $user->projects->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Proyectos terminados como Freelancer</b> <a class="pull-right">{{ $user->projects_done->count() }}</a>
                </li>
                <li class="list-group-item">
                  <b>Calificación</b> <a class="pull-right">{{ \App\Http\Controllers\UsersController::get_calif($user->id) }}/5</a>
                </li>
                <li class="list-group-item">
                  <b>Antigüedad</b> <a class="pull-right">{{$user->created_at->format('M, Y')}}</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Acerca de mí
                @if(Auth::user()->id == $user->id)
                  <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#favoritesModal">
                    <i class="fa fa-pencil"></i>
                  </button>
                @endif
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-muted">
                {{ $user->descripcion }}
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          
          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Contacto
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <p class="text-muted">
                {{$user->email}}
              </p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Calificaciones</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @foreach($user->calificaciones as $calif)
                <!-- /.col -->
                <div class="col-md-12">
                  <!-- Box Comment -->
                  <div class="box box-widget">
                    <div class="box-header with-border">
                      <div class="user-block">
                        <img class="img-circle" src="{{ asset('storage/profile_pictures/' . $calif->find_user($calif->id_user_calificador)->foto_perfil) }}" alt="User Image">
                        <span class="username"><a href="#">{{$calif->find_user($calif->id_user_calificador)->nombre . ' ' . 
                          $calif->find_user($calif->id_user_calificador)->apellido}}</a></span>
                        <span class="description">{{$calif->created_at}}</span>
                      </div>
                      <!-- /.user-block -->
                      <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <!-- post text -->
                      <h4 style="color:gray3">Calificación: {{$calif->calificacion}}/5</h4>
                      <p>{{$calif->comentario}}</p>
                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->
              @endforeach
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
        </section>
      </div>
      <!-- /.content -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.4.0
        </div>
        <strong>Copyright &copy; 2014-2016 <a href="https://adminlte.io">Almsaeed Studio</a>.</strong> All rights
        reserved.
      </footer>
    </div>
    
    @if(Auth::user()->id == $user->id)
      <!-- MODAL -->
      <div class="modal fade" id="editfoto" tabindex="-1" role="dialog" aria-labelledby="editfoto">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" 
                data-dismiss="modal" 
                aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" 
              id="favoritesModalLabel">Editar foto de perfil</h4>
            </div>
            <div class="modal-body">
              <form method="post" action="/user/profile/edit_foto" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Foto de perfil</label>
                  <input type="file" name="picture"></input>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" 
                 class="btn btn-default" 
                 data-dismiss="modal">Cancelar</button>
              <span class="pull-right">
                <button type="submit" class="btn btn-primary" name="submit">
                  Aceptar
                </button>
              </form>
              @include('layouts.errors')
              </span>
            </div>
          </div>
        </div>
      </div>
      <!-- MODAL -->
      <div class="modal fade" id="favoritesModal" tabindex="-1" role="dialog" aria-labelledby="favoritesModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" 
              data-dismiss="modal" 
              aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" 
            id="favoritesModalLabel">Editar descripción</h4>
          </div>
          <div class="modal-body">
            <form method="post" action="/user/profile/edit_desc">
              @csrf
              @method('PUT')
              <div class="form-group">
                <label>Descripción</label>
                <textarea class="form-control" name="descripcion" rows="5" placeholder="Descripción..." style="resize:none;">{{$user->descripcion}}</textarea>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" 
               class="btn btn-default" 
               data-dismiss="modal">Cancelar</button>
            <span class="pull-right">
              <button type="submit" class="btn btn-primary" name="submit">
                Aceptar
              </button>
            </form>
            @include('layouts.errors')
            </span>
          </div>
        </div>
      </div>
    </div>
    @endif
    <!-- jQuery 3 -->
    <script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- Morris.js charts -->
    <script src="{{ asset('adminlte/bower_components/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/morris.js/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('adminlte/dist/js/pages/dashboard.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
  </body>
</html>
