<div class="box">
   <div class="panel-body">
        <ul class="nav nav-tabs cus" role="tablist">
            <li  class="<?php echo e(isset($po_status) ? $po_status : ''); ?>">
              <a href='<?php echo e(url("user/purchase-list/$user_id")); ?>' ><?php echo e(trans('message.extra_text.purchase_orders')); ?></a>
            </li>

            <li class="<?php echo e(isset($so_status) ? $so_status : ''); ?>">
              <a href='<?php echo e(url("user/sales-order-list/$user_id")); ?>' ><?php echo e(trans('message.extra_text.sales_order')); ?></a>
            </li>
            
            <li class="<?php echo e(isset($invoice) ? $invoice : ''); ?>">
              <a href='<?php echo e(url("user/sales-invoice-list/$user_id")); ?>' ><?php echo e(trans('message.extra_text.invoices')); ?></a>
            </li>

            <li class="<?php echo e(isset($payment) ? $payment : ''); ?>">
              <a href='<?php echo e(url("user/user-payment-list/$user_id")); ?>' ><?php echo e(trans('message.extra_text.payments')); ?></a>
            </li>
            
            <li class="<?php echo e(isset($transfer) ? $transfer : ''); ?>">
              <a href='<?php echo e(url("user/user-transfer-list/$user_id")); ?>' ><?php echo e(trans('message.sidebar.stock-move-list')); ?></a>
            </li>

       </ul>
      <div class="clearfix"></div>
   </div>
</div> 