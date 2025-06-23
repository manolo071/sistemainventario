<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.payments')); ?></div>
          </div> 
        </div>
      </div>
    </div>
      <div class="box">
        <div class="box-body">
                <ul class="nav nav-tabs cus" role="tablist">
                <li class="active">
                 <a href='<?php echo e(url("payment/list")); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                 </li>
                 <li>
                 <a href="<?php echo e(url("payment/filtering")); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                 </li>
               </ul>
        </div>
      </div>
      <!--Filtering Box End-->
      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table id="paymentList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo e(trans('message.invoice.payment_no')); ?></th>
                    <th><?php echo e(trans('message.table.order_no')); ?></th>
                    <th><?php echo e(trans('message.invoice.invoice_no')); ?></th>
                    <th><?php echo e(trans('message.invoice.customer_name')); ?></th>
                    <th><?php echo e(trans('message.extra_text.payment_method')); ?></th>
                    <th><?php echo e(trans('message.invoice.amount')); ?></th>
                    <th><?php echo e(trans('message.invoice.payment_date')); ?></th>
                    <th><?php echo e(trans('message.invoice.action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($paymentList as $data): ?>
                  <tr>
                    <td><a href="<?php echo e(url("payment/view-receipt/$data->id")); ?>"><?php echo e(sprintf("%04d", $data->id)); ?></a></td>
                    <td><a href="<?php echo e(url("order/view-order-details/$data->order_id")); ?>"><?php echo e($data->order_reference); ?></a></td>
                    <td><a href="<?php echo e(url("invoice/view-detail-invoice/$data->order_id/$data->invoice_id")); ?>"><?php echo e($data->invoice_reference); ?></a></td>
                    <td><a href="<?php echo e(url("customer/edit/$data->customer_id")); ?>"><?php echo e($data->name); ?></a></td>
                    <td><?php echo e($data->pay_type); ?></td>
                    <td><?php echo e(Session::get('currency_symbol').number_format($data->amount,2,'.',',')); ?></td>
                    <td><?php echo e(formatDate($data->payment_date)); ?></td>
                    <td>
                   <?php if(Helpers::has_permission(Auth::user()->id, 'edit_payment')): ?>
                        <a  title="View" class="btn btn-xs btn-primary" href='<?php echo e(url("payment/view-receipt/$data->id")); ?>'><span class="fa fa-eye"></span></a> &nbsp;
                    <?php endif; ?>
                    <?php if(Helpers::has_permission(Auth::user()->id, 'delete_payment')): ?>
                        <form method="POST" action="<?php echo e(url("payment/delete")); ?>" accept-charset="UTF-8" style="display:inline">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="id" value="<?php echo e($data->id); ?>">
                            <button title="delete" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.invoice.delete_payment_header')); ?>" data-message="<?php echo e(trans('message.invoice.delete_payment')); ?>">
                                <i class="glyphicon glyphicon-trash"></i> 
                            </button>
                        </form>
                    <?php endif; ?>
                    </td>
                  </tr>
                 <?php endforeach; ?>
                  </tfoot>
                </table>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>

<?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">

  $(function () {
    $("#paymentList").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 6,
        "orderable": false
        } ],

        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
    
  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>