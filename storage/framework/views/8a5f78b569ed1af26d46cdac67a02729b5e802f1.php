<?php $__env->startSection('content'); ?>
    <!-- Main content -->
 
    <section class="content">
      <div class="box">
        <div class="box-body">
          <div class="col-md-9 col-xs-12">
          <form class="form-horizontal" action="<?php echo e(url('report/purchase-report')); ?>" method="GET" id='purchaseReport'>
            <div class="row">
               <div class="col-md-3">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1"><?php echo e(trans('message.report.product')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="product" id="product">
                    <option value="all">All</option>
                    <?php if(!empty($itemList)): ?>
                    <?php foreach($itemList as $productItem): ?>
                    <option value="<?php echo e($productItem->stock_id); ?>" <?= ($productItem->stock_id == $item) ? 'selected' : ''?>><?php echo e($productItem->description); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div>
               <div class="col-md-3">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1"><?php echo e(trans('message.form.supplier')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="supplier" id="supplier">
                    <option value="all">All</option>
                    <?php if(!empty($supplierList)): ?>
                    <?php foreach($supplierList as $supplierItem): ?>
                    <option value="<?php echo e($supplierItem->supplier_id); ?>" <?= ($supplierItem->supplier_id == $supplier) ? 'selected' : ''?>><?php echo e($supplierItem->supp_name); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div>

               <div class="col-md-3">
                 <div class="form-group">
                  <label for="location"><?php echo e(trans('message.form.location')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="location" id="location">
                    <option value="all">All</option>
                    <?php if(!empty($locationList)): ?>
                    <?php foreach($locationList as $locationItem): ?>
                    <option value="<?php echo e($locationItem->loc_code); ?>" <?= ($locationItem->loc_code == $location) ? 'selected' : ''?>><?php echo e($locationItem->location_name); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div>               
            </div>
            <div class="row">
              <div class="col-md-3">
              <div class="form-group" style="margin-right: 5px">
                <label for="exampleInputEmail1"><?php echo e(trans('message.purchase_report.search_type')); ?></label>
                <div class="input-group">
                <select class="form-control select2" name="searchType" id="searchType" required>
                <option value="daily" <?= ($searchType=='daily') ? 'selected' : ''?>>Daily</option>
                <option value="monthly" <?= ($searchType=='monthly') ? 'selected' : ''?>>Monthly</option>
                <option value="yearly" <?= ($searchType=='yearly') ? 'selected' : ''?>>Yearly</option>
                <option value="custom" <?= ($searchType=='custom') ? 'selected' : ''?>>Custom</option>
                </select>
                </div>
              </div>   
              </div>           

              <div class="col-md-3 dateField" style="display: none;">
              <div class="form-group" style="margin-right: 5px">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?= isset($from) ? $from : '' ?>">
                  </div>
              </div>
              </div>
              
              <div class="col-md-3 dateField" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?= isset($to) ? $to : '' ?>">
                  </div>
              </div>
              </div>

              <div class="col-md-3 yearField" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.purchase_report.year')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="year" id="year" style="width:'100%' ">
                  <option value="all" <?= ($year=='all') ? 'selected' : ''?>>All</option>
                  <?php if(!empty($yearList)): ?>
                  <?php foreach($yearList as $res): ?>
                  <option value="<?php echo e($res->year); ?>" <?= ($res->year == $year) ? 'selected' : '' ?>><?php echo e($res->year); ?></option>
                  <?php endforeach; ?>
                  <?php endif; ?>
                  </select>
                  </div>
              </div>
              </div>

              <?php
              $monthList = array(
                '01'=>'January',
                '02'=>'February',
                '03'=>'March',
                '04'=>'April',
                '05'=>'May',
                '06'=>'June',
                '07'=>'July',
                '08'=>'August',
                '09'=>'September',
                '10'=>'October',
                '11'=>'November',
                '12'=>'December'
                );
              ?>

              <div class="col-md-3 monthField" style="display: none;">
              <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.purchase_report.month')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="month" id="month" style="width:'100%' ">
                    <option value="all" <?= ($month == 'all') ? 'selected' : '' ?>>All</option>
                    <?php foreach($monthList as $key=>$val): ?>
                    <option value="<?php echo e($key); ?>" <?= ($month == $key) ? 'selected' : '' ?>><?php echo e($val); ?></option>
                    <?php endforeach; ?>
                  </select>
                  </div>
                  </div>
              </div>
             </div>
             <div class="row">
             <div class="col-md-1">
             <div class="form-group">
                <div class="input-group">
                <button type="submit" name="btn" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.filter')); ?></button>
                </div>
              </div>
              </div>
             </div>

          </form>
          </div>
          <div class="col-md-3 col-xs-12">
            <br>
            <div class="btn-group pull-right">
              <a href="#" title="CSV" class="btn btn-default btn-flat" id="csv"><?php echo e(trans('message.extra_text.csv')); ?></a>
              <a href="#" title="PDF" class="btn btn-default btn-flat" id="pdf"><?php echo e(trans('message.extra_text.pdf')); ?></a>
            </div>
          </div>
        </div>
        <br>
      </div><!--Top Box End-->
      
      <div class="box">
        <div class="box-body">
          <div class="col-md-4 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e($order); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.no_of_orders')); ?></span>
          </div>
          <div class="col-md-4 col-xs-6 border-right text-center">
              <h3 class="bold"><?php echo e($qty); ?></h3>
              <span class="text-info"><?php echo e(trans('message.purchase_report.purchase_volume')); ?> </span>
          </div>
          <div class="col-md-4 col-xs-6 text-center">
              <h3 class="bold"><?php echo e(Session::get('currency_symbol')); ?><?php echo e($cost); ?></h3>
              <span class="text-info"><?php echo e(trans('message.report.cost')); ?></span>
          </div>
        </div>
      </div>
      
      <div class="box">
            <div class="box-body">

          <div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>

            </div>
      </div>

      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            
            <?php if($searchType=='daily' || $searchType=='custom'): ?>
              <table id="reportList" class="table table-bordered table-striped">
                <thead>
                <tr>  
                  <th class="text-center"><?php echo e(trans('message.report.date')); ?></th>       
                  <th class="text-center"><?php echo e(trans('message.report.no_of_orders')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.purchase_report.purchase_volume')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.cost')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                </tr>
                </thead>
                <tbody>
             <?php foreach($list as $result): ?>
                <tr>
                <td class="text-center"><a href="<?php echo e(url('report/purchase_report_datewise').'/'.strtotime($result->ord_date)); ?>"><?php echo e(formatDate($result->ord_date)); ?></a></td>
                <td class="text-center"><?php echo e($result->order_total); ?></td>
                <td class="text-center"><?php echo e($result->qty); ?></td>
                <td class="text-center"><?php echo e($result->cost); ?></td>
                </tr>
             <?php endforeach; ?>
                </tfoot>
              </table>

              <?php elseif($searchType=='monthly'): ?>
              <table id="reportList" class="table table-bordered table-striped">
                <thead>
                <tr>  
                  <th class="text-center"><?php echo e(trans('message.purchase_report.month')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.no_of_orders')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.purchase_report.purchase_volume')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.cost')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach($list as $result): ?>
                    <tr>
                    <td class="text-center"><a class="monthClass" href="#" data-month="<?php echo e(date('m',strtotime($result->ord_date))); ?>" data-year="<?php echo e(date('Y',strtotime($result->ord_date))); ?>"><?php echo e(date('F-Y',strtotime($result->ord_date))); ?></a></td>
                    <td class="text-center"><?php echo e($result->order_total); ?></td>
                    <td class="text-center"><?php echo e($result->qty); ?></td>
                    <td class="text-center"><?php echo e($result->cost); ?></td>
                    </tr>
                 <?php endforeach; ?>
                </tfoot>
              </table>

              <?php elseif($searchType == 'yearly' && $year =='all'): ?>
              <table id="reportList" class="table table-bordered table-striped">
                <thead>
                <tr>  
                  <th class="text-center"><?php echo e(trans('message.purchase_report.year')); ?></th>       
                  <th class="text-center"><?php echo e(trans('message.report.no_of_orders')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.purchase_report.purchase_volume')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.cost')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach($list as $result): ?>
                    <tr>
                    <td class="text-center"><a class="yearClass" href="#" data-year="<?php echo e(date('Y',strtotime($result->ord_date))); ?>"><?php echo e(date('Y',strtotime($result->ord_date))); ?></a></td>
                    <td class="text-center"><?php echo e($result->order_total); ?></td>
                    <td class="text-center"><?php echo e($result->qty); ?></td>
                    <td class="text-center"><?php echo e($result->cost); ?></td>
                    </tr>
                 <?php endforeach; ?>
                </tfoot>
              </table>
              <?php elseif($searchType == 'yearly' && $year !='all' && $month == 'all'): ?>
              <table id="reportList" class="table table-bordered table-striped">
                <thead>
                <tr>  
                  <th class="text-center"><?php echo e(trans('message.purchase_report.month')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.no_of_orders')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.purchase_report.purchase_volume')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.cost')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach($list as $result): ?>
                    <tr>
                    <td class="text-center"><a class="monthClass" href="#" data-month="<?php echo e(date('m',strtotime($result->ord_date))); ?>" data-year="<?php echo e(date('Y',strtotime($result->ord_date))); ?>"><?php echo e(date('F-Y',strtotime($result->ord_date))); ?></a></td>
                    <td class="text-center"><?php echo e($result->order_total); ?></td>
                    <td class="text-center"><?php echo e($result->qty); ?></td>
                    <td class="text-center"><?php echo e($result->cost); ?></td>
                    </tr>
                 <?php endforeach; ?>
                </tfoot>
              </table>

              <?php elseif($searchType == 'yearly' && $year !='all' && $month != 'all'): ?>
              <table id="reportList" class="table table-bordered table-striped">
                <thead>
                <tr>  
                  <th class="text-center"><?php echo e(trans('message.form.date')); ?></th>       
                  <th class="text-center"><?php echo e(trans('message.report.no_of_orders')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.purchase_report.purchase_volume')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.report.cost')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                </tr>
                </thead>
                <tbody>
                 <?php foreach($list as $result): ?>
                    <tr>
                    <td class="text-center"><a href="<?php echo e(url('report/purchase_report_datewise').'/'.strtotime($result->ord_date)); ?>"><?php echo e(formatDate($result->ord_date)); ?></a></td>
                    <td class="text-center"><?php echo e($result->order_total); ?></td>
                    <td class="text-center"><?php echo e($result->qty); ?></td>
                    <td class="text-center"><?php echo e($result->cost); ?></td>
                    </tr>
                 <?php endforeach; ?>
                </tfoot>
              </table>

              <?php endif; ?>

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
    $("#reportList").DataTable({
      "order": [],

      "columnDefs": [ {
        "targets": 2,
        "orderable": true
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
    

    $('#to').datepicker({
        autoclose: true,
        todayHighlight: true,
        format: '<?php echo e(Session::get('date_format_type')); ?>'
    });
    
    
    $(document).ready(function(){

      $('.dateField').hide();
      $('.yearField').hide();
      $('.monthField').hide();

      var type = $('#searchType').val();
      var year = $('#year').val();
      var month = $('#month').val();

      if(type == 'custom'){
        
        $('.dateField').show();
        $('.yearField').hide();
        $('.monthField').hide();
       
      }else if(type == 'yearly'){
        $('.yearField').show();
        $('.dateField').hide();
          if(year != 'all'){
            $('.monthField').show();
          }
      
        }

    });


    $("#searchType").on('change', function(){
      var type = $(this).val();
      if(type=='custom'){

        $('.dateField').show();
        $('.yearField').hide();
        $(".monthField").hide();

          $('#purchaseReport').validate({
              rules: {
                  from: {
                      required: true
                  },
                  to: {
                      required: true
                  }                     
              }
          });

      }else if( type != 'custom' && type == 'yearly' ){
        $('.dateField').hide();
        $('.yearField').show();
        $('#year option:selected').removeAttr('selected');
        $('#year').val('all').change();

        }else if(type != 'custom' && type != 'yearly'){
          $('.dateField').hide();
           $('.yearField').hide();
           $(".monthField").hide();
        }
    });

    // Month list showing
    $("#year").on('change', function(){
      var year = $(this).val();
      $('#month').val('all').change();
      if(year != 'all'){
        $(".monthField").show();
      }else{
        $(".monthField").hide();
      }
    });

  });

  // Search By yearly.By clicked on year and Month
  $(document).ready(function(){

    $( '#reportList' ).on( 'click', 'a.yearClass', function () {
      var year = $(this).attr('data-year');
      var product = $('#product').val();
      var supplier = $('#supplier').val();
      var location = $('#location').val();

      window.location = SITE_URL+"/report/purchase-report?searchType=yearly&from=&to=&year="+year+"&month=all&product="+product+"&supplier="+supplier+"&location="+location+"&btn=";
     });

    $( '#reportList' ).on( 'click', 'a.monthClass', function () {
      var month = $(this).attr('data-month');
      var year = $(this).attr('data-year');

      var product = $('#product').val();
      var supplier = $('#supplier').val();
      var location = $('#location').val();

   window.location = SITE_URL+"/report/purchase-report?searchType=yearly&from=&to=&year="+year+"&month="+month+"&product="+product+"&supplier="+supplier+"&location="+location+"&btn=";

     });
  });

// bar Chart Start
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: '<?php echo e(trans('message.purchase_report.purchase_report')); ?>'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category',
        labels: {
            rotation: -45,
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Cost'
        }
    },
    legend: {
        enabled: false
    },
    tooltip: {
        pointFormat: 'Cost: <b>{point.y:.2f}</b>'
    },
    series: [{
        name: 'Cost',
        data: jQuery.parseJSON('<?php echo $graph; ?>'),
        
        dataLabels: {
            enabled: false,
            rotation: -90,
            color: '#FFFFFF',
            align: 'right',
            format: '{point.y:.1f}', // one decimal
            y: 10, // 10 pixels down from the top
            style: {
                fontSize: '13px',
                fontFamily: 'Verdana, sans-serif'
            }
        }
    }]
});
// bar Chart End

   $('#pdf').on('click', function(event){
      event.preventDefault();
      var product = $('#product').val();
      var supplier = $('#supplier').val();
      var location = $('#location').val();

      var to = $('#to').val();
      var from = $('#from').val();
      var searchType = $("#searchType").val();

      if( searchType == 'custom' ){
        window.location = SITE_URL+"/report/purchase-report-pdf?to="+to+"&from="+from+"&type="+searchType+"&product="+product+"&supplier="+supplier+"&location="+location;
      }else if(searchType !='yearly'){
        window.location = SITE_URL+"/report/purchase-report-pdf?type="+searchType+"&product="+product+"&supplier="+supplier+"&location="+location;
      }else if(searchType =='yearly'){
      var year = $("#year").val();
      var month = $("#month").val();
        window.location = SITE_URL+"/report/purchase-report-pdf?type="+searchType+'&year='+year+'&month='+month+"&product="+product+"&supplier="+supplier+"&location="+location;
      }

    });

   $('#csv').on('click', function(event){

      event.preventDefault();
      var product = $('#product').val();
      var supplier = $('#supplier').val();
      var location = $('#location').val();

      var to = $('#to').val();
      var from = $('#from').val();
      var searchType = $("#searchType").val();

      if( searchType == 'custom' ){
        window.location = SITE_URL+"/report/purchase-report-csv?to="+to+"&from="+from+"&type="+searchType+"&product="+product+"&supplier="+supplier+"&location="+location;
      }else if(searchType !='yearly'){
        window.location = SITE_URL+"/report/purchase-report-csv?type="+searchType+"&product="+product+"&supplier="+supplier+"&location="+location;
      }else if(searchType =='yearly'){
      var year = $("#year").val();
      var month = $("#month").val();
        window.location = SITE_URL+"/report/purchase-report-csv?type="+searchType+'&year='+year+'&month='+month+"&product="+product+"&supplier="+supplier+"&location="+location;
      }
    });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>