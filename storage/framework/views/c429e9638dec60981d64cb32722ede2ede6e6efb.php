<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <!--Default box -->
        <?php echo $__env->make('layouts.includes.user_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h3><?php echo e($user->real_name); ?></h3> 
        
         <div class="box">
            <!-- /.box-header -->
            <div class="box-body">       
          <div class="col-md-12 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action='<?php echo e(url("user/user-payment-list/$user_id")); ?>' method="GET" id='salesHistoryReport'>
              <div class="col-md-2">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?= isset($from) ? $from : '' ?>" required>
                  </div>
              </div>
              
              <div class="col-md-2">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?= isset($to) ? $to : '' ?>" required>
                  </div>
              </div>

              <div class="col-md-2">
                <label for="exampleInputEmail1"><?php echo e(trans('message.form.customer')); ?></label>
                <select class="form-control select2" name="customer" id="customer" required>
                <option value="all" <?= ($customer=='all') ? 'selected' : ''?>>All</option>
                <?php foreach($customerList as $data): ?>
                  <option value="<?php echo e($data->debtor_no); ?>" <?= ($data->debtor_no == $customer) ? 'selected' : ''?>><?php echo e($data->name); ?></option>
                <?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-1">
                <label for="btn">&nbsp;</label>
                <button type="submit" name="btn" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.filter')); ?></button>
              </div>
            </form>
          </div>
          </div>
          </div>
      </div> 


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
                    <?php if(!empty(Session::get('payment_edit'))): ?>
                        <a  title="View" class="btn btn-xs btn-primary" href='<?php echo e(url("payment/view-receipt/$data->id")); ?>'><span class="fa fa-eye"></span></a> &nbsp;
                    <?php endif; ?>
                    <?php if(!empty(Session::get('payment_delete'))): ?>
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
        <!-- /.box-footer-->
    <?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>
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

  $(".select2").select2({});
    
    $('#from').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: '<?php echo e(Session::get('date_format_type')); ?>'
    });
   

    $('#to').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: '<?php echo e(Session::get('date_format_type')); ?>'
    });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>