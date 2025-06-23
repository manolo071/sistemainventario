<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-9 col-sm-8 col-xs-12">
             <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.purchases')); ?></div>
            </div> 
            <div class="col-md-3 col-sm-4 col-xs-12">
              <?php if(Helpers::has_permission(Auth::user()->id, 'add_purchase')): ?>
                <a href="<?php echo e(url('purchase/add')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.extra_text.new_purchase')); ?></a>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>

        <div class="box">
           <div class="panel-body">
                <ul class="nav nav-tabs cus" role="tablist">
                    
                    <li  class="active">
                      <a href='<?php echo e(url("purchase/list")); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                    </li>
                    
                    <li>
                      <a href="<?php echo e(url("purchase/filtering")); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                    </li>

               </ul>
              <div class="clearfix"></div>
           </div>
        </div> 
        

        <!-- Default box -->
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="purchaseList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%"><?php echo e(trans('message.table.invoice')); ?> #</th>
                    <th><?php echo e(trans('message.table.supp_name')); ?></th>
                    <th><?php echo e(trans('message.table.order_qty')); ?></th>
                    <th><?php echo e(trans('message.table.receive_qty')); ?></th>
                    <th><?php echo e(trans('message.invoice.total')); ?></th>
                    <th><?php echo e(trans('message.table.ord_date')); ?></th>
                    <th width="5%" class="hideColumn"><?php echo e(trans('message.table.action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($purchData as $data): ?>
                  <tr>
                    <td><a href="<?php echo e(URL::to('/')); ?>/purchase/view-purchase-details/<?php echo e($data->order_no); ?>" ><?php echo e($data->reference); ?></a></td>
                    <td><a href="<?php echo e(url("edit-supplier/$data->supplier_id")); ?>"><?php echo e($data->supp_name); ?></a></td>
                    <td><?php echo e($data->total_qty); ?></td>
                    <td><?php echo e($data->received_total); ?></td>
                    <td><?php echo e(Session::get('currency_symbol').number_format($data->total,2,'.',',')); ?></td>
                    
                    <td><?php echo e(formatDate($data->ord_date)); ?></td>
                    <td class="hideColumn">
                     <?php if(Helpers::has_permission(Auth::user()->id, 'edit_purchase')): ?>
                        <a  title="edit" class="btn btn-xs btn-primary" href='<?php echo e(url("purchase/edit/$data->order_no")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                    <?php endif; ?>
                     <?php if(Helpers::has_permission(Auth::user()->id, 'delete_purchase')): ?>
                        <form method="POST" action="<?php echo e(url("purchase/delete/$data->order_no")); ?>" accept-charset="UTF-8" style="display:inline">
                            <?php echo csrf_field(); ?>

                            <button title="delete" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.table.delete_invoice_header')); ?>" data-message="<?php echo e(trans('message.table.delete_invoice')); ?>">
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
    $("#purchaseList").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 4,
        "orderable": false
        } ],

        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
  });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>