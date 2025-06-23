      <div class="col-md-4">
        <div class="box box-default">
          <div class="box-header text-center">
              <h5 class="text-left text-info"><b>Order No # <?php echo e($purchData->reference); ?></b></h5>
          </div>
        </div>
        <!--Start-->
        <div class="box box-default">
          <div class="box-header text-center">
            <strong>Receive Information</strong>
          </div>
           <?php if(!empty($receiveData)): ?>
          <div class="box-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="33%" class="text-center">Receive No</th>
                  <th width="33%" class="text-center"><?php echo e(trans('message.table.date')); ?></th>
                  <th width="33%" class="text-center">Quantity</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($receiveData as $receive): ?>
                <tr>
                  <td align="center"><a href='<?php echo e(url("receive/details/$receive->id")); ?>'><?php echo e(sprintf("%04d", $receive->id)); ?></td>
                  <td align="center"><?php echo e(formatDate($receive->receive_date)); ?></td>
                  <td align="center"><?php echo e($receive->qty); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php endif; ?>
           
            <?php if(($orderItemQty->ord_qty - $orderItemQty->recv_qty)>0): ?>
            <div class="box-body">
              <div class="row">
                <div class="col-md-6 btn-block-left-padding">
                  <a href="<?php echo e(URL::to('/')); ?>/receive/manual/<?php echo e($purchData->order_no); ?>" title="<?php echo e(trans('message.invoice.manually_received')); ?>" class="btn btn-success btn-flat btn-block "><?php echo e(trans('message.invoice.receive_manually')); ?></a>
                </div>
                <div class="col-md-6 btn-block-right-padding">
                  <a href="<?php echo e(URL::to('/')); ?>/receive/all/<?php echo e($purchData->order_no); ?>" title="<?php echo e(trans('message.invoice.all_received')); ?>" class="btn bg-orange btn-flat btn-block"><?php echo e(trans('message.invoice.receive_all')); ?></a>
                </div>
              </div>
            </div>
            <?php endif; ?>

        </div> 
        <!--END-->
      </div> 