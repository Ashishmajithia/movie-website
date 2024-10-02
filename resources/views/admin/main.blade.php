<!DOCTYPE html>
<html lang="en">

<head>
  @include('layout.header')
</head>


<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">


    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      @include('layout.navbar')
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      @include('layout.sidebar')
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      @yield('content')

    </div>

    @include('layout.footer')
  </div>
  @include('layout.scripts')


</body>
</html>