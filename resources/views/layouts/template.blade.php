<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>MyTickets</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  {{-- @livewireStyles --}}
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        
        <a class="nav-link" data-toggle="dropdown" href="#">
          <span>{{ Auth::user()->roles->pluck('name')->implode('') }}</span> | <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('showProfile', Auth::user()->id) }}">Manage Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .9">
      <span class="brand-text font-weight-light">Support Tickets</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (Auth::user()->usr_image == null)
            <img src="{{ asset('template/docs/assets/img/noImage.jpg') }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{ asset('/storage/usr_images/'.Auth::user()->usr_image) }}" class="img-circle elevation-2" alt="User Image">
          @endif
          
        </div>
        <div class="info">
          <a href="{{ route('showProfile', Auth::user()->id) }}" class="d-block">{{ Auth::user()->name }}</a>
          <span style="color: gray">{{ Auth::user()->roles->pluck('name')->implode('') }}</span>
        </div>
      </div>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @can('add ticket')
            <li class="nav-item">
              <a href="{{ route('tickets.index') }}" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Ticket Management
                </p>
              </a>
            </li>
          @endcan

          @can('assign ticket')
            <li class="nav-item">
              <a href="{{ route('ticketAssignments.index') }}" class="nav-link">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Ticket Assignments
                </p>
              </a>
            </li>
          @endcan

          @can('accept ticket')
            <li class="nav-item">
              <a href="{{ route('Todos.index') }}" class="nav-link">
                <i class="nav-icon fas fa-list-ol"></i>
                <p>
                  To-Do List
                </p>
              </a>
            </li>
          @endcan
          
          @can('manage headers')
            <li class="nav-header">Master Data</li>
            <li class="nav-item">
              <a href="{{ route('headers.index') }}" class="nav-link">
                <i class="nav-icon fas fa-align-justify"></i>
                <p>
                  Manage Headers
                </p>
              </a>
            </li>
          @endcan
          
          @can('manage priorities')
            <li class="nav-item">
              <a href="{{ route('priorities.index') }}" class="nav-link">
                <i class="nav-icon fas fa-layer-group"></i>
                <p>
                  Manage Priority Levels
                </p>
              </a>
            </li>
          @endcan
          
          @can('manage users')
            <li class="nav-header">Admin Functions</li>
            <li class="nav-item">
              <a href="{{ route('users.index') }}" class="nav-link">
                <i class="nav-icon fas fa-user-lock"></i>
                <p>
                  Manage Users
                </p>
              </a>
            </li>
          @endcan
          
          @can('view sysLog')
            <li class="nav-item">
              <a href="{{ route('activityLog') }}" class="nav-link">
                <i class="nav-icon fas fa-clipboard-list"></i>
                <p>
                  System Logs
                </p>
              </a>
            </li>
          @endcan

          @can('print reports')
          <li class="nav-header">Print Functions</li>
            <li class="nav-item">
              <a href="{{ route('laodView') }}" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>
                  Print Reports
                </p>
              </a>
            </li>
          @endcan
          
          <li class="nav-header">Knowledge Base</li>
          <li class="nav-item">
            <a href="{{ route('knowledgebase') }}" class="nav-link">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Search Archives
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('faqs') }}" class="nav-link">
              <i class="nav-icon fas fa-question-circle"></i>
              <p>
                FAQs
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h5 class="m-0 text-dark">Page name</h5> --}}
          </div><!-- /.col -->
          @yield('breadcrumb')
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          @yield('content')
        </div>
      </div><!--/. container-fluid -->
    </section>
    @yield('row')
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2021 | Kelum Peiris</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.2
    </div>
  </footer>
</div>

<!-- ./wrapper -->
@livewireScripts
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.js') }}"></script>

<!-- OPTIONAL SCRIPTS -->
{{-- <script src="{{ asset('template/dist/js/demo.js') }}"></script> --}}

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
{{-- <script src="{{ asset('template/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('template/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('template/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('template/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script> --}}

<!-- PAGE SCRIPTS -->
{{-- <script src="{{ asset('template/dist/js/pages/dashboard2.js') }}"></script> --}}
<!-- DataTables -->
<script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
@yield('tblScripts')

</body>

</html>
