<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sales report</title>
</head>
<style>
 body{ font-family:Arial, Helvetica, sans-serif; color:#121212; line-height:22px;}

.page-break {
    page-break-after: always;
}

 table, tr, td{
    border-bottom: 1px solid #d1d1d1;
    padding: 6px 0px;
}
tr{ height:40px;}


</style>
<body>

  <div style="width:100%; margin:0px auto;">
  <div style="height:130px">
    <div style="width:70%; float:left; font-size:15px; color:#383838; font-weight:400;">
      <div style="font-size:20px;"><strong>Sales Report</strong></div>
      <div>Print date : <?php echo e(formatDate(date('d-m-Y'))); ?></div>
       <?php if($type == 'custom'): ?>
       <div>Date : <?php echo e($date_range); ?></div>
       <?php endif; ?>

       <div>Product : <?php echo e(isset($product) && ($product == 'all') ? 'All' : getItemName($product)); ?></div>
       <div>Customer : <?php echo e(isset($customer) && ($customer == 'all') ? 'All' : getCustomer($customer)); ?></div>
       <div>Location : <?php echo e(isset($location) && ($location == 'all') ? 'All' : getDestinatin($location)); ?></div>
    </div>

    <div style="width:30%; float:left;font-size:15px; color:#383838; font-weight:400;">
    <div><strong><?php echo e(Session::get('company_name')); ?></strong></div>
    <div><?php echo e(Session::get('company_street')); ?></div>
    <div><?php echo e(Session::get('company_city')); ?>, <?php echo e(Session::get('company_state')); ?></div>
    <div><?php echo e(Session::get('company_country_id')); ?>, <?php echo e(Session::get('company_zipCode')); ?></div>
    </div>
  </div>
 <div> 
  
 <table style="width:100%; border-radius:2px; border:2px solid #d1d1d1; border-collapse: collapse;">
 <thead>
 <tr style="background-color:#f0f0f0; border-bottom:1px solid #d1d1d1; text-align:center; font-size:13px; font-weight:bold;">
   <td>
     
     <?php
     if($type == 'custom' || $type == 'daily'){
      echo "Date";
    }else if($type == 'monthly'){
      echo 'Month';
    }elseif( $type == 'yearly'){
      if($year=='all'){
        echo "Year";
      }else if($year !='all' && $month == 'all'){
        echo 'Month';
      }else if($year !='all' && $month != 'all'){
        echo "Date";
      }
    }
     ?>

   </td>
   <td>No Of Invoices</td>
   <td>Sales Volume</td>
   <td>Sales Value(<?php echo e(Session::get('currency_symbol')); ?>)</td>
   <td>Costs Value(<?php echo e(Session::get('currency_symbol')); ?>)</td>
   <td>Profit(<?php echo e(Session::get('currency_symbol')); ?>)</td>
 </tr>
</thead>
    <?php
      $qty = 0;
      $sales = 0;
      $cost = 0;
      $order = 0;
      $profit = 0;
    ?>
  <tbody>
  <?php foreach($itemList as $item): ?>
    <?php
    $order += $item->total_order;
    $qty += $item->qty;
    $sales += round($item->sale_price_excl_tax,2);
    $cost += round($item->purchase_price_incl_tax,2);
    $profit += round($item->sale_price_excl_tax-$item->purchase_price_incl_tax,2);
    ?>

  <tr style="background-color:#fff; text-align:center; font-size:13px; font-weight:normal;">  
  <td>
    
     <?php
     if($type == 'custom' || $type == 'daily'){
      echo date('d-m-Y',strtotime($item->ord_date));
    }else if($type == 'monthly'){
      echo date('F-Y',strtotime($item->ord_date));
    }elseif( $type == 'yearly'){

      if($year=='all'){
       echo date('Y',strtotime($item->ord_date));
      }else if($year !='all' && $month == 'all'){
        echo date('F-Y',strtotime($item->ord_date));
      }else if($year !='all' && $month != 'all'){
        echo date('d-m-Y',strtotime($item->ord_date));
      }

    }
     ?>    

  </td>
  <td><?php echo e($item->total_order); ?></td>
  <td><?php echo e($item->qty); ?></td>
  <td><?php echo e(number_format(($item->sale_price_excl_tax),2,'.',',')); ?></td>
  <td><?php echo e(number_format(($item->purchase_price_incl_tax),2,'.',',')); ?></td>
  <td><?php echo e(number_format(($item->sale_price_excl_tax-$item->purchase_price_incl_tax),2,'.',',')); ?></td>
  </tr>
  <?php endforeach; ?>  
  <tr style="background-color:#f0f0f0; text-align:right; font-size:13px; font-weight:normal;">
    <td colspan="1"><strong>Total</stong></td>
    <td align="center"><strong><?php echo e($order); ?></stong></td>
    <td align="center"><strong><?php echo e($qty); ?></stong></td>
    <td align="center"><strong><?php echo e(number_format(abs($sales),2,'.',',')); ?></stong></td>
    <td align="center"><strong><?php echo e(number_format(abs($cost),2,'.',',')); ?></stong></td>
    <td align="center"><strong><?php echo e(number_format($profit,2,'.',',')); ?></stong></td>            
  </tr>
</tbody>
</table>
  </div>
  </div>
</body>
</html>