<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo e(trans('message.header.company_setting')); ?></h3>
  </div>
  <div class="box-body no-padding" style="display: block;">
    <ul class="nav nav-pills nav-stacked">
     
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'sys_company' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("company/setting")); ?>"><?php echo e(trans('message.table.company_setting')); ?></a></li>
     

      <?php if(Helpers::has_permission(Auth::user()->id,'manage_team_member')): ?>
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'users' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("users")); ?>"><?php echo e(trans('message.extra_text.team_member')); ?></a></li>
      <?php endif; ?>
      
      <?php if(Helpers::has_permission(Auth::user()->id, 'manage_role')): ?>
        <li <?php echo e(isset($list_menu) &&  $list_menu == 'role' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("role/list")); ?>"><?php echo e(trans('message.extra_text.user_role')); ?></a></li>
      <?php endif; ?>

      <?php if(Helpers::has_permission(Auth::user()->id, 'manage_location')): ?>
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'location' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("location")); ?>"><?php echo e(trans('message.extra_text.locations')); ?></a></li>
      <?php endif; ?>
      
    </ul>
  </div>
  <!-- /.box-body -->
</div>