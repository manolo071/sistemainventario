<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
        <form action="<?php echo e(url('receive/manual_store')); ?>" method="POST" id="receiveForm">  
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
          <div class="col-md-8">
            <h4 class="text-info">
              <?php echo e(trans('message.invoice.order_no')); ?> # <?php echo e($oderInfo->reference); ?>

            </h4>
          </div>
          <div class="col-md-4">
              <div class="form-group">
                <label><?php echo e(trans('message.table.date')); ?><span class="text-danger"> *</span></label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="datepicker" type="text" name="receive_date">
                </div>
                <!-- /.input group -->
              </div>
          </div>
          
          <input type="hidden" value="<?php echo e($oderInfo->order_no); ?>" name="order_no" id="order_no">
          <input type="hidden" value="<?php echo e($oderInfo->reference); ?>" name="order_reference" id="order_reference">
          <input type="hidden" value="<?php echo e($oderInfo->into_stock_location); ?>" name="location">
          <input type="hidden" value="<?php echo e($oderInfo->supplier_id); ?>" name="supplier_id">

        <div class="row">
            <div class="col-md-12">
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="table-responsive">
                <table class="table table-bordered" id="salesInvoice">
                  <tbody>
                  <tr class="tbl_header_color dynamicRows">
                    <th width="10%" class="text-center"><?php echo e(trans('message.table.item_id')); ?></th>
                    <th width="30%" class="text-center"><?php echo e(trans('message.table.description')); ?></th>
                    <th width="10%" class="text-center">Ordered Qty</th>
                    <th width="10%" class="text-center">Receive Qty</th>
                    <th width="10%" class="text-center"><?php echo e(trans('message.table.rate')); ?></th>

                    <th width="10%" class="text-center"><?php echo e(trans('message.table.tax')); ?>(%)</th>
                    <th width="10%" class="text-center"><?php echo e(trans('message.table.amount')); ?></th>
                    <th width="10%" class="text-center"><?php echo e(trans('message.table.action')); ?></th>
                  </tr>

                  <?php if(count($itemInfo)>0): ?>
                  <?php
                    $subtotal = 0;
                    $taxtotal = 0;
                  ?>
                    <?php foreach($itemInfo as $k=>$result): ?>
                    
                    <?php
                      $amount = $result->unit_price*($result->quantity_ordered-$result->qty_received);
                      $subtotal += $amount;

                      $taxAmount = $amount*$result->tax_rate/100;
                      $taxtotal +=$taxAmount;
                    ?>
                      <?php if(($result->quantity_ordered-$result->qty_received)>0): ?>
                        <tr class="tblRows" id="rowid<?php echo e($result->item_id); ?>">
                          
                          <td class="text-center"><?php echo e($result->item_code); ?><input type="hidden" name="item_code[]" value="<?php echo e($result->item_code); ?>"></td>

                          <td class="text-center"><?php echo e($result->description); ?><input type="hidden" name="description[]" value="<?php echo e($result->description); ?>"></td>

                        <td class="text-center" id="orderqtyid<?php echo e($result->item_id); ?>"><?php echo e($result->quantity_ordered-$result->qty_received); ?></td>


                          <td><input class="form-control text-center no_units" name="quantity[]" value="<?php echo e($result->quantity_ordered-$result->qty_received); ?>" rowid="<?php echo e($result->item_id); ?>" type="text"></td>

                          <td class="text-center"><input class="form-control text-center" name="unit_price[]" value="<?php echo e($result->unit_price); ?>" type="hidden" id="priceid<?php echo e($result->item_id); ?>"><?php echo e($result->unit_price); ?></td>                          

                          <td class="text-center"><?php echo e($result->tax_rate); ?>

                          
                          <input type="hidden" name="tax_type_id[]" value="<?php echo e($result->tax_type_id); ?>">
                          <input type="hidden" value="<?php echo e($result->tax_rate); ?>" id="taxid<?php echo e($result->item_id); ?>">

                          <input type="hidden" class="taxamount" value="<?php echo e($taxAmount); ?>" id="taxamountid<?php echo e($result->item_id); ?>">

                          </td>

                          <td class="text-center amount" id="amountid<?php echo e($result->item_id); ?>"><?php echo e($amount); ?></td>

                          <td class="text-center"><button id="<?php echo e($result->item_code); ?>" class="btn btn-xs btn-danger delete_item"><i class="glyphicon glyphicon-trash"></i></button></td>
                        </tr>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  <tr class="tableInfo"><td colspan="6" align="right"><strong><?php echo e(trans('message.table.sub_total')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</strong></td><td align="left" colspan="2"><strong id="subTotal"><?php echo e($subtotal); ?></strong></td></tr>
                  
                  <tr class="tableInfo"><td colspan="6" align="right"><strong><?php echo e(trans('message.invoice.totalTax')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</strong></td><td align="left" colspan="2"><strong id="TaxTotal"><?php echo e($taxtotal); ?></strong></td></tr>

                  <tr class="tableInfo"><td colspan="6" align="right"><strong><?php echo e(trans('message.invoice.grand_total')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</strong></td><td align="left" colspan="2"><strong id="grandTotal"><?php echo e($taxtotal+$subtotal); ?></strong></td></tr>

                  <?php endif; ?>
                  </tbody>
                </table>
                </div>
          
              </div>
            </div>
              <!-- /.box-body -->
              <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-flat pull-right" id="btnSubmit"><?php echo e(trans('message.form.submit')); ?></button>
              </div>
        </div>
        </form>
            <!-- /.col -->   
            <!-- /.col -->
      </div>
          <!-- /.row -->
    </div>
        <!-- /.box-body -->
      <!-- /.box -->

    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">

    var token = $("#token").val();
    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        $('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: '<?php echo e(Session::get('date_format_type')); ?>'
        });
        $('#datepicker').datepicker('update', new Date());
    })

     // calculate amount with item quantity
    $(document).on('keyup', '.no_units', function(ev){
      var id = $(this).attr("rowid");
      var qty = parseInt($(this).val());
      var UnitPrice = parseFloat($("#priceid"+id).val());
      var taxRate = parseFloat($("#taxid"+id).val());
      
      if(isNaN(qty)){
          qty = 0;
       }

       var orderedQty = parseInt($("#orderqtyid"+id).html());

        if(orderedQty<qty){
         $("#errMsg").html("");
          $('#btnSubmit').attr('disabled', 'disabled');
          return;
         }else{
          $('#btnSubmit').removeAttr('disabled');
         }

      var taxAmount = (qty*UnitPrice*taxRate/100);
      $("#taxamountid"+id).val(taxAmount);

      var price = calculatePrice(qty,UnitPrice);
      $("#amountid"+id).html(price);

      var subTotal = calculateSubTotal();
      $("#subTotal").html(subTotal);
      var taxTotal = calculateTaxTotal();
      $("#TaxTotal").html(taxTotal);
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").html(grandTotal);

    });

      /**
      * Calcualte Total tax
      *@return  totalTax for row wise
      */
      function calculateTaxTotal (){
          var totalTax = 0;
            $('.taxamount').each(function() {
                totalTax += parseFloat($(this).val());
            });
            return totalTax;
      }
      
      /**
      * Calcualte Sub Total 
      *@return  subTotal
      */
      function calculateSubTotal (){
        var subTotal = 0;
        $('.amount').each(function() {
            subTotal += parseFloat($(this).html());
        });
        return subTotal;
      }


      function calculatePrice (qty,rate){
         var price = (qty*rate);
         return price;
      }   
      // calculate tax 
      function caculateTax(p,t){
       var tax = (p*t)/100;
       return tax;
      }   


      // calculate discont amount
      function calculateDiscountPrice(p,d){
        var discount = [(d*p)/100];
        var result = (p-discount); 
        return result;
      }

// Item form validation
    $('#salesForm').validate({
        rules: {
            debtor_no: {
                required: true
            },
            from_stk_loc: {
                required: true
            },
            ord_date:{
               required: true
            },
            reference:{
              required:true
            },
            payment_id:{
              required:true
            },
            branch_id:{
              required:true
            }                    
        }
    });

    // Delete item row
    $(document).ready(function(e){
      $('#salesInvoice').on('click', '.delete_item', function(event) {
        event.preventDefault();
            $(this).closest("tr").remove();
            var subTotal = calculateSubTotal();
            $("#subTotal").html(subTotal);
            var taxTotal = calculateTaxTotal();
            $("#TaxTotal").html(taxTotal);
            var grandTotal = (subTotal + taxTotal);
            $("#grandTotal").html(grandTotal);

            var rowCount = $('#salesInvoice tr.tblRows').length;
            if(rowCount==0){
              $("#btnSubmit").hide();
            }

        });
    });
    /// Craete Round Figure
    function roundToTwo(num) {    
        return +(Math.round(num + "e+2")  + "e-2");
    }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>