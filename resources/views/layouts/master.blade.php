<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<!-- Head -->
@include('template.head')
<!-- /.Head -->

<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  @include('template.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('template.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @include('template.content')
  <!-- /.content-wrapper -->

  <!-- footer -->
  @include('template.footer')
  <!-- /.footer -->
</div>
<!-- ./wrapper -->



<!-- script -->
@include('template.script')
<!-- /.script -->


</body>
</html>
