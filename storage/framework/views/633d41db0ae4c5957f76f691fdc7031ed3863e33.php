<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-10">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.sales_orders')); ?></div>
          </div> 
          <div class="col-md-2">
            <?php if(Helpers::has_permission(Auth::user()->id, 'add_order')): ?>
              <a href="<?php echo e(url('order/add')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.form.add_new_order')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
      <div class="box">
        <div class="box-body">

                <ul class="nav nav-tabs cus" role="tablist">
                    
                    <li>
                      <a href='<?php echo e(url("order/list")); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                    </li>
                    
                    <li class="active">
                      <a href="<?php echo e(url("order/filtering")); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                    </li>

               </ul>

          <form class="form-horizontal" action="<?php echo e(url('order/filtering')); ?>" method="GET" id='orderListFilter'>
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


      <div class="box">
            <div class="box-body">
              <div class="table-responsive">
                <table id="orderList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo e(trans('message.table.order')); ?> #</th>
                    <th><?php echo e(trans('message.table.customer_name')); ?></th>
                    <th><?php echo e(trans('message.extra_text.quantity')); ?></th>
                    <th><?php echo e(trans('message.invoice.invoiced')); ?></th>
                    <th><?php echo e(trans('message.invoice.packed')); ?></th>
                    <th><?php echo e(trans('message.invoice.paid')); ?></th>
                    <th><?php echo e(trans('message.table.total')); ?></th>
                    <th><?php echo e(trans('message.table.ord_date')); ?></th>
                    <th width="5%"><?php echo e(trans('message.table.action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($salesData as $data): ?>
                 <?php if($data->ordered_quantity>0): ?>
                  <tr>
                    <td><a href="<?php echo e(URL::to('/')); ?>/order/view-order-details/<?php echo e($data->order_no); ?>"><?php echo e($data->reference); ?></a></td>
                    <td><a href="<?php echo e(URL::to('/')); ?>/customer/edit/<?php echo e($data->debtor_no); ?>"><?php echo e($data->name); ?></a></td>
                    <td><?php echo e($data->ordered_quantity); ?></td>

                    <?php if( $data->invoiced_quantity == 0 ): ?>
                      <td><span class="fa fa-circle-thin"></span></td>
                    <?php elseif(abs($data->ordered_quantity) - abs($data->invoiced_quantity)== 0): ?>
                      <td><span class="fa fa-circle"></span></td>
                    <?php elseif(abs($data->ordered_quantity) - abs($data->invoiced_quantity)>0): ?>
                      <td><span class="glyphicon glyphicon-adjust"></span></td>
                    <?php endif; ?>


                    <?php if( $data->packed_qty == 0 ): ?>
                    <td><span class="fa fa-circle-thin"></span></td>
                    <?php elseif(abs($data->ordered_quantity) - abs($data->packed_qty)== 0): ?>
                    <td><span class="fa fa-circle"></span></td>
                    <?php elseif(abs($data->ordered_quantity) - abs($data->packed_qty)>0): ?>
                    <td><span class="glyphicon glyphicon-adjust"></span></td>
                    <?php endif; ?>

                    <?php if( $data->paid_amount == 0 ): ?>
                      <td><span class="fa fa-circle-thin"></span></td>
                    <?php elseif(abs($data->order_amount) - abs($data->paid_amount) == 0): ?>
                      <td><span class="fa fa-circle"></span></td>
                    <?php elseif(abs($data->order_amount) - abs($data->paid_amount)>0): ?>
                      <td><span class="glyphicon glyphicon-adjust"></span></td>
                    <?php elseif(abs($data->order_amount) - abs($data->paid_amount)<0): ?>
                      <td><span class="fa fa-circle"></span></td>
                    <?php endif; ?>

                    <td><?php echo e(Session::get('currency_symbol').number_format($data->order_amount,2,'.',',')); ?></td>
                    <td><?php echo e(formatDate($data->ord_date)); ?></td>
                    <td>
                    
                    <?php if(Helpers::has_permission(Auth::user()->id, 'edit_order')): ?>
                        <a  title="Edit" class="btn btn-xs btn-primary" href='<?php echo e(url("order/edit/$data->order_no")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                    <?php endif; ?>

                    <?php if(Helpers::has_permission(Auth::user()->id, 'delete_order')): ?>
                        <form method="POST" action="<?php echo e(url("order/delete/$data->order_no")); ?>" accept-charset="UTF-8" style="display:inline">
                            <?php echo csrf_field(); ?>

                            
                            <button title="delete" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.invoice.delete_order')); ?>" data-message="<?php echo e(trans('message.invoice.delete_order_confirm')); ?>">
                                <i class="glyphicon glyphicon-trash"></i> 
                            </button>
                        </form>
                    <?php endif; ?>
                    </td>
                  </tr>
                  <?php endif; ?>
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
    $("#orderList").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 8,
        "orderable": false
        } ],

        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
    
  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>