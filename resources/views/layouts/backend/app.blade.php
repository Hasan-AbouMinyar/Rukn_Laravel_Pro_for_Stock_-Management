<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>RKUN | رُكن</title>

    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="/css/dark-mode.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  @include('layouts.backend.partial.nabbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->

  @include('layouts.backend.partial.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div> --}}
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <router-view></router-view>

          <vue-progress-bar></vue-progress-bar>
          <vue-snotify></vue-snotify>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      ITSE408 TEAM 11
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2025 Rkun | رُكن </strong>

  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@auth
<script>
window.user = @json(auth()->user())
</script>
@endauth
<script src="/js/app.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script>
// تفعيل الوضع الليلي بناءً على localStorage
function setDarkMode(enabled) {
  if (enabled) {
    document.body.classList.add('dark-mode');
    localStorage.setItem('darkMode', 'on');
  } else {
    document.body.classList.remove('dark-mode');
    localStorage.setItem('darkMode', 'off');
  }
}

// عند تحميل الصفحة
window.onload = function() {
  if (localStorage.getItem('darkMode') === 'on') {
    setDarkMode(true);
  }
  document.getElementById('darkModeToggle').onclick = function() {
    const enabled = !document.body.classList.contains('dark-mode');
    setDarkMode(enabled);
  };
};
</script>
</body>
</html>
