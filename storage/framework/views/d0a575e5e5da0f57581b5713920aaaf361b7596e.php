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
            <form class="form-horizontal" action='<?php echo e(url("user/sales-invoice-list/$user_id")); ?>' method="GET" id='salesHistoryReport'>
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

              <div class="col-md-2">
                <label for="exampleInputEmail1"><?php echo e(trans('message.form.location')); ?></label>
                <select class="form-control select2" name="location" id="location" required>
                <option value="all" <?= ($location=='all') ? 'selected' : ''?>>All</option>
                <?php foreach($locationList as $data): ?>
                  <option value="<?php echo e($data->loc_code); ?>" <?= ($data->loc_code == $location) ? 'selected' : ''?>><?php echo e($data->location_name); ?></option>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo e(trans('message.table.invoice')); ?></th>
                    <th><?php echo e(trans('message.table.order_no')); ?></th>
                    <th><?php echo e(trans('message.table.customer_name')); ?></th>
                    <th><?php echo e(trans('message.table.total_price')); ?></th>
                    <th><?php echo e(trans('message.table.paid_amount')); ?></th>
                    <th><?php echo e(trans('message.table.paid_status')); ?></th>
                    <th><?php echo e(trans('message.invoice.invoice_date')); ?></th>
                    <th width="5%"><?php echo e(trans('message.table.action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($salesData as $data): ?>
                  <tr>
                    <td><a href="<?php echo e(URL::to('/')); ?>/invoice/view-detail-invoice/<?php echo e($data->order_reference_id.'/'.$data->order_no); ?>"><?php echo e($data->reference); ?></a></td>
                    <td><a href="<?php echo e(URL::to('/')); ?>/order/view-order-details/<?php echo e($data->order_reference_id); ?>"><?php echo e($data->order_reference); ?></a></td>
                    <td><a href="<?php echo e(url("customer/edit/$data->debtor_no")); ?>"><?php echo e($data->cus_name); ?></a></td>
                    <td><?php echo e(Session::get('currency_symbol').number_format($data->total,2,'.',',')); ?></td>
                    <td><?php echo e(Session::get('currency_symbol').number_format($data->paid_amount,2,'.',',')); ?></td>
  
                    <?php if($data->paid_amount == 0): ?>
                      <td><span class="label label-danger"><?php echo e(trans('message.invoice.unpaid')); ?></span></td>
                    <?php elseif($data->paid_amount > 0 && $data->total > $data->paid_amount ): ?>
                      <td><span class="label label-warning"><?php echo e(trans('message.invoice.partially_paid')); ?></span></td>
                    <?php elseif($data->paid_amount<=$data->paid_amount): ?>
                      <td><span class="label label-success"><?php echo e(trans('message.invoice.paid')); ?></span></td>
                    <?php endif; ?>

                    <td><?php echo e(formatDate($data->ord_date)); ?></td>
                    <td>
                    <?php if(!empty(Session::get('sales_edit'))): ?>
                        <a  title="edit" class="btn btn-xs btn-primary" href='<?php echo e(url("sales/edit/$data->order_no")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                    <?php endif; ?>
                    <?php if(!empty(Session::get('sales_delete'))): ?>
                       <form method="POST" action="<?php echo e(url("invoice/delete/$data->order_no")); ?>" accept-charset="UTF-8" style="display:inline">
                          <?php echo csrf_field(); ?>

                          <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.invoice.delete_invoice')); ?>" data-message="<?php echo e(trans('message.invoice.delete_invoice_confirm')); ?>">
                             <i class="fa fa-remove" aria-hidden="true"></i>
                          </button>
                      </form> 
                      <?php endif; ?>
                    </td>
                  </tr>
                 <?php endforeach; ?>
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
    $("#example1").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 7,
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