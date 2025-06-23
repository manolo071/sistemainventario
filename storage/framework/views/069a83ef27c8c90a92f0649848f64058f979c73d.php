<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="row">
        <!--Graph Chart-->
        <?php if(Helpers::has_permission(Auth::user()->id, 'manage_sale_report')): ?>
          <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <div id="row">
                <div class="col-md-1">
                  <div class="row">
                    <div class="col-md-4">
                    <div id="sale">
                    </div>
                    </div>
                    <div class="col-md-8 scp">
                      <?php echo e(trans('message.sidebar.sales')); ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="row">
                    <div class="col-md-4">
                    <div id="cost">
                    </div>
                    </div>
                    <div class="col-md-8 scp">
                      <?php echo e(trans('message.extra_text.cost')); ?>

                    </div>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="row">
                    <div class="col-md-4">
                    <div id="profit">
                    </div>
                    </div>
                    <div class="col-md-8 scp">
                      <?php echo e(trans('message.report.profit')); ?>

                    </div>
                  </div>
                </div>

                <div class="col-md-9">
                  <div class="text-center">
                   <strong>[<?php echo e($startDate); ?>   -To-   <?php echo e($endDate); ?>]</strong>
                  </div>
                </div>
              </div>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height: 246px; width: 1069px;" height="246" width="1069"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!--Graph Chart-->
      </div>
      <!-- /.box -->

      <div class="row">
          <div class="col-md-8">
            <!--- Start sale, revenue and profit-->
            <div class="box box-info">
                <div class="box box-body">
                  <div class="row">
                      <div class="col-md-4 border-right text-center">
                        <h3><?php echo e(number_format($totalSoldQty,1,'.',',')); ?></h3>
                        <strong><?php echo e(trans('message.dashboard.unit_sold')); ?></strong>
                      </div>
                      <div class="col-md-4 border-right text-center">
                        <h3><?php echo e(Session::get('currency_symbol').number_format($revenueTotal,2,'.',',')); ?></h3>
                         <strong><?php echo e(trans('message.dashboard.total_revenue')); ?></strong>
                      </div>
                      <div class="col-md-4 border-right text-center">
                        <h3>
                          <?php if($profitTotal<0): ?>
                          -<?php echo e(Session::get('currency_symbol').number_format(abs($profitTotal),2,'.',',')); ?>

                          <?php else: ?>
                          <?php echo e(Session::get('currency_symbol').number_format($profitTotal,2,'.',',')); ?>

                          <?php endif; ?>
                        </h3>
                         <strong><?php echo e(trans('message.dashboard.total_profit')); ?></strong>
                      </div>
                  </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Start latest invoice -->
           <?php if(Helpers::has_permission(Auth::user()->id, 'manage_invoice')): ?>
            <div class="box box-info">
            <div class="box-header text-center">
              <h5 class="text-info"><b><?php echo e(trans('message.dashboard.latest_invoice')); ?></b></h5>
            </div>
                <div class="box box-body">
                  <?php if(!empty($latestInvoicesList)): ?>
                  <table class="table table-bordered">
                      <thead>
                      <tr>
                      <th class="text-center"><?php echo e(trans('message.invoice.order_no')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.invoice.invoice_no')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.report.customer')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.invoice.amount')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                      <th class="text-center"><?php echo e(trans('message.dashboard.order_date')); ?></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($latestInvoicesList as $item): ?>
                      <tr>
                        <td align="center"><a href="<?php echo e(url("order/view-order-details/$item->order_no")); ?>"><?php echo e($item->order_reference); ?></a></td>
                        <td align="center"><a href="<?php echo e(url("invoice/view-detail-invoice/$item->order_no/$item->invoice_no")); ?>"><?php echo e($item->reference); ?></a></td>
                        <td align="center"><?php echo e($item->name); ?></td>
                        <td align="center"><?php echo e(number_format($item->total,2,'.',',')); ?></td>
                        <td align="center"><?php echo e(formatDate($item->ord_date)); ?></td>
                      </tr>
                      <?php endforeach; ?>
                      </tbody>
                  </table>
                  <?php else: ?>
                  <h5 class="text-center"><?php echo e(trans('message.invoice.no_invoice')); ?></h5>
                  <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>


            <!-- Start latest payment -->
          <?php if(Helpers::has_permission(Auth::user()->id, 'manage_payment')): ?>
            <div class="box box-info">
            <div class="box-header text-center">
              <h5 class="text-info"><b><?php echo e(trans('message.dashboard.latest_payment')); ?></b></h5>
            </div>
                <div class="box box-body">
                  <?php if(!empty($latestPaymentList)): ?>
                  <table class="table table-bordered">
                      <thead>
                      <tr>
                      <th class="text-center"><?php echo e(trans('message.invoice.payment_no')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.invoice.order_no')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.invoice.invoice_no')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.report.customer')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.invoice.amount')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                      <th class="text-center"><?php echo e(trans('message.invoice.payment_date')); ?></th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php foreach($latestPaymentList as $item): ?>
                      <tr>
                        <td align="center"><a href="<?php echo e(url("payment/view-receipt/$item->id")); ?>"><?php echo e(sprintf("%04d", $item->id)); ?></a></td>
                        <td align="center"><a href="<?php echo e(url("order/view-order-details/$item->order_id")); ?>"><?php echo e($item->order_reference); ?></a></td>
                        <td align="center"><a href="<?php echo e(url("invoice/view-detail-invoice/$item->order_id/$item->invoice_id")); ?>"><?php echo e($item->invoice_reference); ?></a></td>
                        <td align="center"><?php echo e($item->name); ?></td>
                        <td align="center"><?php echo e(number_format($item->amount,2,'.',',')); ?></td>
                        <td align="center"><?php echo e(formatDate($item->payment_date)); ?></td>
                      </tr>
                      <?php endforeach; ?>
                      </tbody>
                  </table>
                  <?php else: ?>
                  <h5 class="text-center"><?php echo e(trans('message.invoice.no_payment')); ?></h5>
                  <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>


          </div>
        <?php if(Helpers::has_permission(Auth::user()->id, 'edit_invoice')): ?>

          <div class="col-md-4">
            <div class="box box-info">
            <div class="box-header text-center">
              <h5 class="text-info"><b><?php echo e(trans('message.dashboard.order_to_invoice')); ?></b></h5>
            </div>
                <div class="box box-body">
                  <?php if(!empty($orderToInvoiceList)): ?>
                  <table class="table table-bordered">
                  <thead>
                  <tr>
                  <th class="text-center"><?php echo e(trans('message.invoice.order_no')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.customer')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.dashboard.order_date')); ?></th>

                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($orderToInvoiceList as $item): ?>
                  <?php if($item->ord_qty+$item->inv_qty >0): ?>
                  <tr>
                  <td align="center"><a href="<?php echo e(url("order/view-order-details/$item->order_no")); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;<?php echo e($item->reference); ?></a></td>
                  <td align="center"><?php echo e($item->name); ?></td>
                  <td align="center"><?php echo e(formatDate($item->ord_date)); ?></td>
                  </tr>
                  <?php endif; ?>
                  <?php endforeach; ?>
                  </tbody>
                  </table>
                  <?php else: ?>
                  <h5 class="text-center"><?php echo e(trans('message.dashboard.no_order_to_invoice')); ?></h5>
                  <?php endif; ?>
                </div>
            </div>

          <div class="box box-info">
            <div class="box-header text-center">
              <h5 class="text-info"><b><?php echo e(trans('message.dashboard.order_to_ship')); ?></b></h5>
            </div>
            <div class="box box-body">
                
                  <?php if(!empty($orderToshipmentList)): ?>
                  <table class="table table-bordered">
                  <thead>
                  <tr>
                  <th class="text-center"><?php echo e(trans('message.invoice.order_no')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.customer')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.dashboard.order_date')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($orderToshipmentList as $item): ?>
                  <tr>
                  <td align="center"><a href="<?php echo e(url("order/view-order-details/$item->order_no")); ?>"><i class="fa fa-chevron-right" aria-hidden="true"></i>&nbsp;<?php echo e($item->reference); ?></a></td>
                  <td align="center"><?php echo e($item->name); ?></td>
                  <td align="center"><?php echo e(formatDate($item->ord_date)); ?></td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
                  </table>
                  <?php else: ?>
                  <h5 class="text-center"><?php echo e(trans('message.report.no_order_to_ship')); ?></h5>
                  <?php endif; ?>

            </div>
          </div>
          </div>
          <?php endif; ?>
      </div>


    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
  $(function () {
 'use strict';
    var areaChartData = {
      labels: jQuery.parseJSON('<?php echo $date; ?>'),
      datasets: [
        {
          label: "Sales(<?= Session::get('currency_symbol')?>)",
          fillColor: "rgba(66,155,206, 1)",
          strokeColor: "rgba(66,155,206, 1)",
          pointColor: "rgba(66,155,206, 1)",
          pointStrokeColor: "#429BCE",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(66,155,206, 1)",
          data: <?php echo e($sale); ?>

        },
        {
          label: "Cost(<?= Session::get('currency_symbol')?>)",
          fillColor: "rgba(255,105,84,1)",
          strokeColor: "rgba(255,105,84,1)",
          pointColor: "#F56954",
          pointStrokeColor: "rgba(255,105,84,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(255,105,84,1)",
          data: <?php echo e($cost); ?>

        },
        {
          label: "Profit(<?= Session::get('currency_symbol')?>)",
          fillColor: "rgba(47, 182, 40,0.9)",
          strokeColor: "rgba(47, 182, 40,0.8)",
          pointColor: "#2FB628",
          pointStrokeColor: "rgba(47, 182, 40,1)",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(47, 182, 40,1)",
          data: <?php echo e($profit); ?>

        }        
      ]
    };

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: false,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - Whether the line is curved between points
      bezierCurve: true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension: 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot: false,
      //Number - Radius of each point dot in pixels
      pointDotRadius: 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth: 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius: 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke: true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth: 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true
    };
    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas);
    var lineChartOptions = areaChartOptions;
    lineChartOptions.datasetFill = false;
    lineChart.Line(areaChartData, lineChartOptions);
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>