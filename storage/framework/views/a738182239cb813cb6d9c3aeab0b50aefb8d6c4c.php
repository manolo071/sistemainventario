<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-body">
          <div class="col-md-6 col-sm-8 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action="<?php echo e(url('report/inventory-stock-on-hand')); ?>" method="get">
              
              <div class="col-md-5 col-sm-5 col-xs-12">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.product_type')); ?></label>
                    <select class="form-control select2" name="type" id="category">
                      <option value="all"><?php echo e(trans('message.report.all_type')); ?></option>
                      <?php foreach($categoryList as $category): ?>
                      <option value="<?php echo e($category->category_id); ?>" <?=isset($category->category_id) && $category->category_id == $type ? 'selected':""?>><?php echo e($category->description); ?></option>
                      <?php endforeach; ?>
                    </select>
              </div>
              <div class="col-md-5 col-sm-5 col-xs-12">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.location')); ?></label>
                    <select class="form-control select2" name="location" id="location">
                      <option value="all"><?php echo e(trans('message.report.all_location')); ?></option>
                      <?php foreach($locationList as $location): ?>
                      <option value="<?php echo e($location->loc_code); ?>" <?=isset($location->loc_code) && $location->loc_code == $location_id ? 'selected':""?>><?php echo e($location->location_name); ?></option>
                      <?php endforeach; ?>
                    </select>
              </div>
              <div class="col-md-2 col-sm-2 col-xs-12">
                <label for="pwd">&nbsp;</label>
                <button type="submit" name="btn" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.filter')); ?></button>
              </div>
            </form>
          </div>
          </div>
          <div class="col-md-6 col-sm-4 col-xs-12">
            <br>
            <div class="btn-group pull-right">
              <a target="_blank" href="#" title="CSV" class="btn btn-default btn-flat" id="csv"><?php echo e(trans('message.extra_text.csv')); ?></a>
              <a target="_blank" href="#" title="PDF" class="btn btn-default btn-flat" id="pdf"><?php echo e(trans('message.extra_text.pdf')); ?></a>
            </div>
          </div>

        </div>
        <br>
      </div><!--Top Box End-->

      <div class="box">
        <div class="box-body">
          <div class="col-md-3 col-xs-6 border-right">
              <h3 class="bold"><?php echo e($qtyOnHand); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.on_hand_qty')); ?></span>
          </div>
          <div class="col-md-3 col-xs-6 border-right">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol').number_format($costValueQtyOnHand,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.on_hand_cost_value')); ?></span>
          </div>
          <div class="col-md-3 col-xs-6 border-right">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol').number_format($retailValueOnHand ,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.on_hand_retail_value')); ?> </span>
          </div>
          <div class="col-md-3 col-xs-6">
              <h3 class="bold">
              <?php if( $profitValueOnHand<0 ): ?>
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
      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="itemList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center"><?php echo e(trans('message.report.product')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.stock_id')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.in_stock')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.mac')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.retail_price')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.in_value')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.retail_value')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.profit_value')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.profit_margin')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($itemList as $item): ?>
                <?php
                  $mac = 0;
                  $profit_margin = 0;
                  if($item->received_qty !=0){
                   $mac = $item->cost_amount/$item->received_qty;
                  }
                  $in_value = $item->available_qty*$mac;
                  $retail_value = $item->available_qty*$item->retail_price;
                  $profit_value = ($retail_value-$in_value);
                  if($in_value !=0){
                  $profit_margin = ($profit_value*100/$in_value); 
                  }
                ?>
                <tr>
                  <td class="text-center"><?php echo e($item->description); ?></td>
                  <td class="text-center"><?php echo e($item->stock_id); ?></td>
                  <td class="text-center"><?php echo e($item->available_qty); ?></td>
                  <td class="text-center"><?php echo e(number_format($mac,2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format($item->retail_price,2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(abs($in_value),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(abs($retail_value),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(abs($profit_value),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format($profit_margin,2,'.',',')); ?>%</td>
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
  $(".select2").select2({});
    $("#itemList").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 6,
        "orderable": true
        } ],
        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
   
    // Create pdf
   $('#pdf').on('click', function(event){
      event.preventDefault();
      var category = $('#category').val();
      var location = $('#location').val();
      var token = $("#token").val();
      window.location.href = SITE_URL+"/report/inventory-stock-on-hand-pdf?type="+category+"&location="+location;
    });

   $('#csv').on('click', function(event){
      event.preventDefault();
      var category = $('#category').val();
      var location = $('#location').val();
      var token = $("#token").val();
      window.location.href = SITE_URL+"/report/inventory-stock-on-hand-csv?type="+category+"&location="+location;
    });

  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>