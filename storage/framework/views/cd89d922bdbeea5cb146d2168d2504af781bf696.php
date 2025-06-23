<!-- Profile Image -->
<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><?php echo e(trans('message.header.finance_setting')); ?></h3>
  </div>
  <div class="box-body no-padding" style="display: block;">
    <ul class="nav nav-pills nav-stacked">

      <li <?php echo e(isset($list_menu) &&  $list_menu == 'tax' ? 'class=active' : ''); ?> ><a href="<?php echo e(URL::to("tax")); ?>"><?php echo e(trans('message.extra_text.taxes')); ?></a></li>

       <?php if(Helpers::has_permission(Auth::user()->id, 'manage_sales_type')): ?>
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'sales-type' ? 'class=active' : ''); ?> ><a href="<?php echo e(URL::to("sales-type")); ?>"><?php echo e(trans('message.extra_text.sales_types')); ?></a></li>
      <?php endif; ?>

       <?php if(Helpers::has_permission(Auth::user()->id, 'manage_currency')): ?>
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'currency' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("currency")); ?>"><?php echo e(trans('message.extra_text.currencies')); ?></a></li>
      <?php endif; ?>

      <?php if(Helpers::has_permission(Auth::user()->id, 'manage_payment_term')): ?>
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'payment_term' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("payment/terms")); ?>"><?php echo e(trans('message.extra_text.payment_terms')); ?></a></li>
      <?php endif; ?>

      <?php if(Helpers::has_permission(Auth::user()->id, 'manage_payment_method')): ?>
      <li <?php echo e(isset($list_menu) &&  $list_menu == 'payment_method' ? 'class=active' : ''); ?>><a href="<?php echo e(URL::to("payment/method")); ?>"><?php echo e(trans('message.extra_text.payment_methods')); ?></a></li>
      <?php endif; ?>

    </ul>
  </div>
  <!-- /.box-body -->
</div>