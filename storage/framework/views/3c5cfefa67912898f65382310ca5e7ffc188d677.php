<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-12 col-sm-8 col-xs-12">
             <div class="top-bar-title padding-bottom"><?php echo e(trans('message.sidebar.purchase_received')); ?></div>
            </div> 
          </div>
        </div>
      </div>

        <div class="box">
           <div class="panel-body">
                <ul class="nav nav-tabs cus" role="tablist">
                    
                    <li >
                      <a href='<?php echo e(url('purchase_receive/list')); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                    </li>
                    
                    <li class="active">
                      <a href="<?php echo e(url('receive/filter')); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                    </li>
                    
               </ul>
              <div class="clearfix" style="margin-top:20px;">
                
            <form class="form-horizontal" action="<?php echo e(url('receive/filter')); ?>" method="GET" id='salesHistoryReport'>
              
              <div class="col-md-3">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?php echo e($from); ?>" required>
                  </div>
              </div>
              <div class="col-md-3">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?php echo e($to); ?>" required>
                  </div>
              </div>

              <div class="col-md-3">
                <label for="exampleInputEmail1"><?php echo e(trans('message.sidebar.supplier')); ?></label>
                <select class="form-control select2" name="supplier" id="supplier">
                <option value="">All</option>
                <?php foreach($suppliers as $data): ?>
                  <option value="<?php echo e($data->supplier_id); ?>" <?= ($data->supplier_id == $supplier) ? 'selected' : ''?> ><?php echo e($data->supp_name); ?></option>
                <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-3">
                <label for="exampleInputEmail1"><?php echo e(trans('message.sidebar.item')); ?></label>
                <select class="form-control select2" name="item" id="item">
                <option value="">All</option>
                <?php foreach($items as $data): ?>
                  <option value="<?php echo e($data->stock_id); ?>" <?= ($data->stock_id == $item) ? 'selected' : ''?>><?php echo e($data->description); ?></option>
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
        

        <!-- Default box -->
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table id="purchaseList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th ><?php echo e(trans('message.table.receive_no')); ?> #</th>
                    <th ><?php echo e(trans('message.table.purchase_no')); ?> #</th>
                    <th><?php echo e(trans('message.table.supp_name')); ?></th>
                    <th><?php echo e(trans('message.table.receive_qty')); ?></th>
                    <th><?php echo e(trans('message.table.receive_date')); ?></th>
                    <th width="5%" class="hideColumn"><?php echo e(trans('message.table.action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($receiveList as $data): ?>
                  <tr>
                    
                    <td><a href="<?php echo e(url('receive/details/'.$data->receive_no)); ?>"><?php echo e(sprintf("%04d",$data->receive_no)); ?></a></td>
                    <td><a href="<?php echo e(url('purchase/view-purchase-details/'.$data->order_no)); ?>"><?php echo e($data->reference); ?></a></td>
                    <td><a href="<?php echo e(url('edit-supplier/'.$data->supplier_id)); ?>"><?php echo e($data->supp_name); ?></a></td>
                    <td><?php echo e($data->receive_qty); ?></td>
                    <td><?php echo e(formatDate($data->receive_date)); ?></td>
                    <td class="hideColumn">
                     <?php if(Helpers::has_permission(Auth::user()->id, 'edit_purchase')): ?>
                        <a  title="edit" class="btn btn-xs btn-primary" href='<?php echo e(url('receive/edit/'.$data->receive_no)); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                    <?php endif; ?>
                     <?php if(Helpers::has_permission(Auth::user()->id, 'delete_purchase')): ?>
                        <form method="POST" action="<?php echo e(url('receive/delete')); ?>" accept-charset="UTF-8" style="display:inline">
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="receive_id" value="<?php echo e($data->receive_no); ?>">
                            <input type="hidden" name="order_no" value="<?php echo e($data->order_no); ?>">
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

   $(".select2").select2();
    
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