<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

      <div class="box box-default">
        <div class="box-body">
          <div class="row">
            <div class="col-md-8">
             <div class="top-bar-title padding-bottom"><?php echo e(trans('message.table.item')); ?></div>
            </div> 
            <?php if(Helpers::has_permission(Auth::user()->id, 'add_item')): ?>
            <div class="col-md-2 top-left-btn">
                <a href="<?php echo e(URL::to('itemimport')); ?>" class="btn btn-block btn-default btn-flat btn-border-purple"><span class="fa fa-upload"> &nbsp;</span><?php echo e(trans('message.extra_text.import_new_item')); ?></a>
            </div>

            <div class="col-md-2 top-right-btn">
                <a href="<?php echo e(url('create-item/item')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.extra_text.add_new_item')); ?></a>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Top Box-->
      <div class="box">
        <div class="box-body">
          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e($itemData); ?></h3>
              <span class="text-info bold"><?php echo e(trans('message.table.item')); ?></span>
          </div>
          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(!empty($itemQuantity->total_item) ? $itemQuantity->total_item : 0); ?></h3>
              <span class="text-info bold"><?php echo e(trans('message.extra_text.quantity')); ?></span>
          </div>


          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol').number_format($costValueQtyOnHand,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.on_hand_cost_value')); ?></span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol').number_format($retailValueOnHand ,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.on_hand_retail_value')); ?> </span>
          </div>
          <div class="col-md-2 col-xs-6 text-center">
              <h3 class="bold">
                <?php if($profitValueOnHand<0): ?>
                -<?php echo e(Session::get('currency_symbol').number_format(abs($profitValueOnHand),2,'.',',')); ?>

                <?php else: ?>
                 <?php echo e(Session::get('currency_symbol').number_format(abs($profitValueOnHand),2,'.',',')); ?>

                <?php endif; ?>
              </h3>
              <span class="text-info"><?php echo e(trans('message.report.on_hand_profit_value')); ?></span>
          </div>


        </div>
        <br>
      </div><!--Top Box End-->


      <div class="box">
            <div class="box-header">
              <a href="<?php echo e(URL::to('itemdownloadcsv/csv')); ?>"><button class="btn btn-default btn-flat btn-border-info"><span class="fa fa-download"> &nbsp;</span><?php echo e(trans('message.table.download_csv')); ?></button></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <?php echo $dataTable->table(); ?>

            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<?php echo $dataTable->scripts(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>