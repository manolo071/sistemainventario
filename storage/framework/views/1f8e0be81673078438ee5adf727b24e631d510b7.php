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
            <form class="form-horizontal" action='<?php echo e(url("user/purchase-list/$user_id")); ?>' method="GET" id='salesHistoryReport'>
              
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
                <label for="exampleInputEmail1"><?php echo e(trans('message.form.supplier')); ?></label>
                <select class="form-control select2" name="supplier" id="supplier" required>
                <option value="all" <?= ($supplier=='all') ? 'selected' : ''?>>All</option>
                <?php foreach($supplierList as $data): ?>
                  <option value="<?php echo e($data->supplier_id); ?>" <?= ($data->supplier_id == $supplier) ? 'selected' : ''?>><?php echo e($data->supp_name); ?></option>
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
              <table id="purchaseList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="10%"><?php echo e(trans('message.table.invoice')); ?> #</th>
                    <th><?php echo e(trans('message.table.supp_name')); ?></th>
                    
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
                    
                    <td><?php echo e(Session::get('currency_symbol').number_format($data->total,2,'.',',')); ?></td>
                    
                    <td><?php echo e(formatDate($data->ord_date)); ?></td>
                    <td class="hideColumn">
                    <?php if(!empty(Session::get('purchese_edit'))): ?>
                        <a  title="edit" class="btn btn-xs btn-primary" href='<?php echo e(url("purchase/edit/$data->order_no")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                    <?php endif; ?>
                    <?php if(!empty(Session::get('purchese_delete'))): ?>
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
        <!-- /.box-footer-->
    <?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>
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