<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-9 col-sm-9 col-xs-12">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.sales_orders')); ?></div>
          </div> 
          <div class="col-md-3 col-sm-3 col-xs-12">
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
                    
                    <li  class="active">
                      <a href='<?php echo e(url("order/list")); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                    </li>
                    
                    <li>
                      <a href="<?php echo e(url("order/filtering")); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                    </li>

               </ul>
        </div>
      </div>
      <!--Filtering Box End-->


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