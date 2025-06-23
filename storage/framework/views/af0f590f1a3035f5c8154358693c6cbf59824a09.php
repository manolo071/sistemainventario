<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="box">
        <div class="box-body">
          <div class="col-md-7 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action="<?php echo e(url('report/sales-history-report')); ?>" method="GET" id='salesHistoryReport'>
              
              <div class="col-md-4">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?= isset($from) ? $from : '' ?>" required>
                  </div>
              </div>
              <div class="col-md-4">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?= isset($to) ? $to : '' ?>" required>
                  </div>
              </div>

              <div class="col-md-3">
                <label for="exampleInputEmail1"><?php echo e(trans('message.form.customer')); ?></label>
                <select class="form-control select2" name="customer" id="customer" required>
                <option value="all" <?= ($user=='all') ? 'selected' : ''?>>All</option>
                <?php foreach($customerList as $data): ?>
                  <option value="<?php echo e($data->debtor_no); ?>" <?= ($data->debtor_no == $user) ? 'selected' : ''?>><?php echo e($data->name); ?></option>
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
          <div class="col-md-5 col-xs-12">
            <br>
            <div class="btn-group pull-right">
              <a href="#" title="CSV" class="btn btn-default btn-flat" id="csv"><?php echo e(trans('message.extra_text.csv')); ?></a>
              <a href="#" title="PDF" class="btn btn-default btn-flat" id="pdf"><?php echo e(trans('message.extra_text.pdf')); ?></a>
            </div>

          </div>

        </div>
        <br>
      </div><!--Top Box End-->
      <?php
      $tax_total = 0;
      $qty_total = 0;
      $sales_total = 0;
      $cost_total = 0;
      $profit_total = 0;
      ?>
        <?php foreach($itemList as $item): ?>
        <?php
        $qty_total += $item->quantity;
        $sales_total += $item->sale_price_excl_tax;
        $cost_total += $item->purchase_price_incl_tax;
        $tax_total += ($item->sale_price_incl_tax-$item->sale_price_excl_tax);
        $profit_amount = ($item->sale_price_excl_tax-$item->purchase_price_incl_tax);
        $profit_total += $profit_amount;
        ?>
        <?php endforeach; ?>

      <div class="box">
        <div class="box-body">
          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(number_format($qty_total,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.extra_text.quantity')); ?></span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol').number_format($sales_total ,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.sales_value')); ?> </span>
          </div>
          <div class="col-md-3 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol').number_format($cost_total,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.cost')); ?></span>
          </div>

          <div class="col-md-2 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e(number_format($tax_total,2,'.',',')); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.tax')); ?></span>
          </div>

          <div class="col-md-2 col-xs-6 text-center">
              <h3 class="bold">
                <?php if($profit_total<0): ?>
            -<?php echo e(Session::get('currency_symbol').number_format(abs($profit_total),2,'.',',')); ?>

                <?php else: ?>
               <?php echo e(Session::get('currency_symbol').number_format(abs($profit_total),2,'.',',')); ?>

               
                <?php endif; ?>
              </h3>
              <?php if($profit_total<0): ?>
              <span class="text-info"><?php echo e(trans('message.report.profit')); ?></span>
              <?php else: ?>
              <span class="text-info"><?php echo e(trans('message.report.profit')); ?></span>
              <?php endif; ?>
          </div> 
        </div>
      </div>
      
      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="salesList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th class="text-center"><?php echo e(trans('message.report.date')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.table.invoice_no')); ?></th>
                  
                  <th class="text-center"><?php echo e(trans('message.report.customer')); ?></th>                  
                  <th class="text-center"><?php echo e(trans('message.extra_text.quantity')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.sales_value')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.cost')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.tax')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.profit')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                  <th class="text-center"><?php echo e(trans('message.report.profit_margin')); ?>(%)</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $qty = 0;
                  $sales_price = 0;
                  $purchase_price = 0;
                  $tax = 0;
                  $total_profit = 0;
                   
                ?>
                <?php foreach($itemList as $item): ?>
                <?php
                $profit = ($item->sale_price_excl_tax-$item->purchase_price_incl_tax);
                
                if($item->purchase_price_incl_tax<=0){
                  $profit_margin = 100;
                }else{
                $profit_margin = ($profit*100)/$item->purchase_price_incl_tax;
                }

                $qty += $item->quantity;
                $sales_price += $item->sale_price_excl_tax;
                $purchase_price += $item->purchase_price_incl_tax;
                $tax += $item->sale_price_incl_tax-$item->sale_price_excl_tax;
                $total_profit += $profit 
                ?>
                <tr>
                <td class="text-center"><?php echo e(formatDate($item->ord_date)); ?></td>
                  <td class="text-center"><a href="<?php echo e(URL::to('/')); ?>/invoice/view-detail-invoice/<?php echo e($item->order_reference_id.'/'.$item->order_no); ?>"><?php echo e($item->reference); ?></a></td>
                  
                  <td class="text-center"><a href="<?php echo e(URL::to('/')); ?>/customer/edit/<?php echo e($item->debtor_no); ?>"><?php echo e($item->name); ?></a></td>
                  <td class="text-center"><?php echo e($item->quantity); ?></td>
                  <td class="text-center"><?php echo e(number_format(($item->sale_price_excl_tax),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(($item->purchase_price_incl_tax),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(($item->sale_price_incl_tax-$item->sale_price_excl_tax),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(($profit),2,'.',',')); ?></td>
                  <td class="text-center"><?php echo e(number_format(($profit_margin),2,'.',',')); ?></td>
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
    $("#salesList").DataTable({
      "order": [],

      "columnDefs": [ {
        "targets": 8,
        "orderable": false
        } ],

        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
    
  $(".select2").select2({});
    
    $('#from').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: '<?php echo e(Session::get('date_format_type')); ?>'
    });
    //$('#from').datepicker('update', new Date());

    $('#to').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: '<?php echo e(Session::get('date_format_type')); ?>'
    });
    //$('#to').datepicker('update', new Date());

  });

// Item form validation
    $('#salesHistoryReports').validate({
        rules: {
            from: {
                required: true
            },
            to: {
                required: true
            }                  
        }
    });

   $('#pdf').on('click', function(event){
      event.preventDefault();
      var to = $('#to').val();
      var from = $('#from').val();
      var customer = $("#customer").val();
      window.location = SITE_URL+"/report/sales-history-report-pdf?to="+to+"&from="+from+"&customer="+customer;
    });

   $('#csv').on('click', function(event){
      event.preventDefault();
      var to = $('#to').val();
      var from = $('#from').val();
      var customer = $("#customer").val();
      window.location = SITE_URL+"/report/sales-history-report-csv?to="+to+"&from="+from+"&customer="+customer;
    });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>