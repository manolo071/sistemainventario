<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo e(Session::get('company_name')); ?> | <?php echo e(ucfirst(trans("message.sidebar.$menu"))); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta name="_token" content="<?php echo csrf_token(); ?>"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bootstrap/css/bootstrap.min.css')); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bootstrap/css/font-awesome.min.css')); ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(asset('public/bootstrap/css/ionicons.min.css')); ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/datatables/dataTables.bootstrap.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/datatables/jquery.dataTables.css')); ?>">

  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/select2/select2.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/AdminLTE.min.css')); ?>">
  <!--<link rel="stylesheet" href="<?php echo e(asset('public/dist/css/custom.css')); ?>">-->
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/skins/_all-skins.min.css')); ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/datepicker/datepicker3.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/jquery-ui.min.css')); ?>" type="text/css" /> 
  <link rel="stylesheet" href="<?php echo e(asset('public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')); ?>" type="text/css" />
  <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/custom.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('public/dist/css/bootstrap-confirm-delete.css')); ?>">

  <script type="text/javascript">
    var SITE_URL = "<?php echo e(URL::to('/')); ?>";
  </script>
  <link rel='shortcut icon' href="<?php echo e(URL::to('/')); ?>/favicon.ico" type='image/x-icon'/ >
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php echo $__env->make('layouts.includes.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- Left side column. contains the logo and sidebar -->

  <?php echo $__env->make('layouts.includes.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $__env->make('layouts.includes.notifications', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
   <?php /* <?php echo $__env->make('layouts.includes.breadcrumb', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> */ ?>
    
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php echo $__env->make('layouts.includes.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <!-- Control Sidebar -->
  <?php echo $__env->make('layouts.includes.sidebar_right', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<?php echo $__env->make('layouts.includes.script', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('js'); ?>
</body>
</html>