<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-10">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.invoices')); ?></div>
          </div> 
          <div class="col-md-2">
            <?php if(Helpers::has_permission(Auth::user()->id, 'add_invoice')): ?>
              <a href="<?php echo e(url('sales/add')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.extra_text.new_sales_invoice')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
      <div class="box">
        <div class="box-body">
                <ul class="nav nav-tabs cus" role="tablist">
                <li>
                 <a href='<?php echo e(url("sales/list")); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                 </li>
                 <li class="active">
                 <a href="<?php echo e(url("sales/filtering")); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                 </li>
               </ul>
          <form class="form-horizontal" action="<?php echo e(url('sales/filtering')); ?>" method="GET" id='orderListFilter'>
          <div class="col-md-12">
            <div class="row">

               <div class="col-md-2">
               <div class="form-group" style="margin-right: 5px">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?php echo e($from); ?>" required>
                  </div>
                </div>
               </div> 

               <div class="col-md-2">
               <div class="form-group" style="margin-right: 5px">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?php echo e($to); ?>" required>
                  </div>
                  </div>
               </div> 

               <div class="col-md-2">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1"><?php echo e(trans('message.report.product')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="product" id="product">
                    <option value="">All</option>
                    <?php if(!empty($productList)): ?>
                    <?php foreach($productList as $productItem): ?>

                    <option value="<?php echo e($productItem->stock_id); ?>" <?= ($productItem->stock_id == $item) ? 'selected' : ''?>><?php echo e($productItem->description); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div>
               <div class="col-md-2">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1"><?php echo e(trans('message.form.customer')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="customer" id="customer">
                    <option value="">All</option>
                    <?php if(!empty($customerList)): ?>
                    <?php foreach($customerList as $customerItem): ?>
                    <option value="<?php echo e($customerItem->debtor_no); ?>" <?= ($customerItem->debtor_no == $customer) ? 'selected' : ''?>><?php echo e($customerItem->name); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div>

               <div class="col-md-2">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="location"><?php echo e(trans('message.form.location')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="location" id="location">
                    <option value="">All</option>
                    <?php if(!empty($locationList)): ?>
                    <?php foreach($locationList as $locationItem): ?>
                    <option value="<?php echo e($locationItem->loc_code); ?>" <?= ($locationItem->loc_code == $location) ? 'selected' : ''?>><?php echo e($locationItem->location_name); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div> 

            </div>
           
             <div class="row">
             <div class="col-md-1">
             <div class="form-group">
                <div class="input-group">
                <button type="submit" name="btn" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.filter')); ?></button>
                </div>
              </div>
              </div>
             </div>
          </div>
          </form>

        </div>
        
      </div><!--Filtering Box End-->
      <!-- Default box -->
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
                    <?php if(Helpers::has_permission(Auth::user()->id, 'edit_invoice')): ?>
                        <a  title="edit" class="btn btn-xs btn-primary" href='<?php echo e(url("sales/edit/$data->order_no")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                    <?php endif; ?>
                    <?php if(Helpers::has_permission(Auth::user()->id, 'delete_invoice')): ?>
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
      <!-- /.box -->

    </section>

<?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
    $('.select2').select2({});
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

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>