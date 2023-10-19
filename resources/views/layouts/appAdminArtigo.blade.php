<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blog | Painel Administrativo</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
<!-- TOKEN -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Estilos CSS -->
  <link rel="stylesheet" href="{{asset('admin/css/toggle_Switch.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/estilos.css')}}">

  <!-- include SUMMER NOTE css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
  
<!-- Site wrapper -->
<div class="wrapper">

  <!-- NAVBAR HORIZONTAL -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav py-1 my-2">
      
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link"><h5><b>Artigos</b></h5></a>
          </li>
         
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Autor</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <select class="form-control" id="autor" name="autor">
                        <option value="">Selecione</option>
                        @foreach($autores as $k => $item)
                        <option value="{{$item->id}}" >{{$item->name}}</option>
                        @endforeach
                        
              </select>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Categoria</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <select class="form-control" id="categoria" name="categoria">
                        <option value="">Selecione</option>
                        @foreach($categorias as $k => $item)
                        <option value="{{$item->id}}" >{{$item->name}}</option>
                        @endforeach
                            
              </select>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">Procurar</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <input type="text" class="form-control" size="30" id="procurar" name="procurar" placeholder="Digite aqui">
          </li>
    </ul>
    <ul class="navbar-nav ml-auto">
          <li class="nav-item d-none d-sm-inline-block align-items-end">
              @if(Auth::check())
              <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn btn-outline-primary">Logout</button>
              </form>
              @else
              <a href="{{ route('login') }}">Login</a>
              <a href="{{ route('register') }}">Register</a>
            @endif
        </li>
    </ul>

  </nav>
  

  <!-- CONTAINER VERTICAL-->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('admin/dist/img/blog_pic01.png')}}"  style="opacity: .8">
      <span class="brand-text font-weight-light"><b>Tá ON!</b></span>
    </a>

    <!-- USUARIO -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel m-4 pb-3  d-flex">
          <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
              <p>
                PAINEL
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href= "{{route('admin.usuarios')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuários</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.autores')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Autores</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.categorias')}}"class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.artigos')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Artigos</p>
                </a>
              </li>

            </ul>
          </li>
              
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <section>
        @yield('content')
  </section>

  <!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- SUmmer Note -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<!-- Sweet Alert -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


<<script>


     

</script>

@yield('script')

</body>

</html>
