<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-6 col-sm-3 col-xs-12">
             <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.supplier')); ?></div>
            </div>
			<div class="col-md-6 col-sm-9 col-xs-12">
				<div class="col-md-6 col-sm-6 col-xs-12 top-cusTom-btn">
				  <?php if(Helpers::has_permission(Auth::user()->id, 'add_supplier')): ?>
					<a href="<?php echo e(URL::to('supplierimport')); ?>" class="btn btn-block btn-default btn-flat btn-border-purple"><span class="fa fa-upload"> &nbsp;</span><?php echo e(trans('message.extra_text.import_new_supplier')); ?></a>
					<?php endif; ?>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12 top_BTN">
				   <?php if(Helpers::has_permission(Auth::user()->id, 'add_supplier')): ?>
					<a href="<?php echo e(url('create-supplier')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.table.add_new_supplier')); ?></a>
					<?php endif; ?>
				</div>
			</div>
          </div>
        </div>
      </div>

    <!-- Top Box-->
      <div class="box">
        <div class="box-body">
          <div class="col-md-2 col-xs-6 border-right">
              <h3 class="bold"><?php echo e($supplierCount); ?></h3>
              <span class="bold"><?php echo e(trans('message.extra_text.total_supplier')); ?></span>
          </div>
          <div class="col-md-2 col-xs-6 border-right">
              <h3 class="bold"><?php echo e($supplierActive); ?></h3>
              <span><?php echo e(trans('message.extra_text.active_supplier')); ?></span>
          </div>
          <div class="col-md-2 col-xs-6">
              <h3 class="bold"><?php echo e($supplierInActive); ?></h3>
              <span><?php echo e(trans('message.extra_text.inactive_supplier')); ?></span>
          </div>
        </div>
        <br>
      </div><!--Top Box End-->

      <!-- Default box -->
      <div class="box">
      
            <div class="box-header">
              <a href="<?php echo e(URL::to('supplierdownloadCsv/csv')); ?>"><button class="btn btn-default btn-flat btn-border-info"> <span class="fa fa-download"></span> <?php echo e(trans('message.table.download_csv')); ?></button></a>
            </div>
      
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo e(trans('message.table.supp_name')); ?></th>
                  <th><?php echo e(trans('message.form.email')); ?></th>
                  <th><?php echo e(trans('message.table.phone')); ?></th>
                  <th><?php echo e(trans('message.extra_text.address')); ?></th>
                  <th><?php echo e(trans('message.form.status')); ?></th>
                  
                </tr>
                </thead>
                <tbody>
                <?php foreach($supplierData as $data): ?>
                <tr>
                <?php if(Helpers::has_permission(Auth::user()->id, 'edit_supplier')): ?>
                  <td><a href='<?php echo e(url("edit-supplier/$data->supplier_id")); ?>'><?php echo e($data->supp_name); ?></a></td>
                <?php else: ?>
                  <td><?php echo e($data->supp_name); ?></td>
                <?php endif; ?>
                  <td><?php echo e($data->email); ?></td>
                  <td><?php echo e($data->contact); ?></td>
                  <td><?php echo e(!empty($data->address) ? $data->address :''); ?><?php echo e(!empty($data->city) ? ', '.$data->city:''); ?><?php echo e(!empty($data->state) ? ', '.$data->state:''); ?><?php echo e(!empty($data->country) ? ', '.$data->country:''); ?><?php echo e(!empty($data->zipcode) ? ', '.$data->zipcode:''); ?></td>
                  <td>
                  <?php if($data->inactive == 0): ?>
                    <span class='label label-success'><?php echo e(trans('message.table.active')); ?></span>
                  <?php else: ?>
                    <span class='label label-danger'><?php echo e(trans('message.table.inactive')); ?></span>
                  <?php endif; ?>
                  </td>
                </tr>
               <?php endforeach; ?>
                </tfoot>
              </table>
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
    $("#example1").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 4,
        "orderable": false
        } ],

        "language": '<?php echo e(Session::get('language')); ?>'
    });
    
  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>