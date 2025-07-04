<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-default">
         <div class="box-header">
            <h4 class="text-info "><?php echo e(trans('message.extra_text.purchase_no')); ?> # <a href="<?php echo e(url('purchase/view-purchase-details/'.$purchData->order_no)); ?>"><?php echo e($purchData->reference); ?></a></h4>
          </div>

        <!-- /.box-header -->
        <div class="box-body">
        <form action='<?php echo e(url("purchase/update")); ?>' method="POST" id="purchaseEditForm">  
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
        <input type="hidden" value="<?php echo e($purchData->order_no); ?>" name="order_no">
        <div class="row">
            <div class="col-md-3">
              <!-- /.form-group -->
              <div class="form-group">
                <label class="require control-label"><?php echo e(trans('message.form.supplier')); ?></label>
                <select class="form-control valdation_select select2" style="width: 100%;" name="supplier_id" id="cus" disabled>
                <option value=""><?php echo e(trans('message.form.select_one')); ?></option>
                <?php foreach($supplierData as $data): ?>
                  <option value="<?php echo e($data->supplier_id); ?>" <?=isset($data->supplier_id) && $data->supplier_id == $purchData->supplier_id ? 'selected':""?> ><?php echo e($data->supp_name); ?></option>
                <?php endforeach; ?>
                </select>
                <input type="hidden"  name="supplier_id" id="supplier_id">
              </div>
              <!-- /.form-group -->
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                  <label for="exampleInputEmail1" class="require control-label"><?php echo e(trans('message.form.location')); ?></label>
                  <select class="form-control valdation_select" name="into_stock_location" id="loc" disabled>
                    <option value=""><?php echo e(trans('message.form.select_one')); ?></option>
                    <?php foreach($locData as $data): ?>
                      <option value="<?php echo e($data->loc_code); ?>" <?=isset($data->loc_code) && $data->loc_code == $purchData->into_stock_location ? 'selected':""?> ><?php echo e($data->location_name); ?></option>
                    <?php endforeach; ?>
                    </select>
                
                  <input type="hidden"  name="into_stock_location" id="into_stock_location">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label class="require control-label"><?php echo e(trans('message.table.date')); ?>:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control valdation_check" id="datepickers" readonly type="text" name="ord_date" value="<?php echo e($purchData->ord_date); ?>">
                </div>
                <!-- /.input group -->
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.table.reference')); ?></label>
                  <input class="form-control" placeholder="Reference" type="text" name="reference" value="<?php echo e($purchData->reference); ?>" readonly>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.form.add_item')); ?></label>
                  <input class="form-control auto" placeholder="Search Item" id="search">
                  <span id="val_item" style="color: red"></span>
                
                <ul class="ui-autocomplete ui-front ui-menu ui-widget ui-widget-content" id="no_div" tabindex="0" style="display: none; top: 60px; left: 15px; width: 520px;">
                <li>No record found!</li>
                </ul>
                  
              </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
              <div class="box-header text-center">
                <h3 class="box-title"><b><?php echo e(trans('message.form.purchase_invoice_items')); ?></b></h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
               <div class="table-responsive">
                <table class="table table-bordered" id="purchaseInvoice">
                  <tbody>
                    <tr class="tbl_header_color dynamicRows">
                      <th width="10%" class="text-center"><?php echo e(trans('message.table.item_id')); ?></th>
                      <th width="15%" class="text-center"><?php echo e(trans('message.table.description')); ?></th>
                      <th width="10%" class="text-center"><?php echo e(trans('message.table.quantity')); ?></th>
                      <th width="15%" class="text-center"><?php echo e(trans('message.table.rate')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                      <th width="15%" class="text-center"><?php echo e(trans('message.table.tax')); ?>(%)</th>
                      <th width="10%" class="text-center"><?php echo e(trans('message.table.tax')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                      <th width="15%" class="text-center"><?php echo e(trans('message.table.amount')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                      <th width="15%" class="text-center"><?php echo e(trans('message.table.action')); ?></th>
                    </tr>
                    
                  <?php if(!empty($invoiceData)): ?>
                  <?php
                    $taxSum = 0;
                  ?>
                  <?php foreach($invoiceData as $data): ?>
                  <?php
                  $tax = ($data->tax_rate*$data->quantity_received*$data->unit_price/100);
                    $taxSum += $tax
                  ?>
                  <tr id="rowid<?php echo e($data->item_id); ?>">
                    <td align="center"><?php echo e($data->item_code); ?><input type="hidden" name="stock_id[]" value="<?php echo e($data->item_code); ?>"></td>
                    <td align="center"><?php echo e($data->description); ?><input type="hidden" name="description[]" value="<?php echo e($data->description); ?>"></td>
                    <td align="center"><input id="qty_<?php echo e($data->item_id); ?>" min="1" data-id="<?php echo e($data->item_id); ?>" type="text" class="form-control text-center no_units" value="<?php echo e($data->quantity_received); ?>" name="item_quantity[]" data-rate="<?php echo e($data->unit_price); ?>"><input type="hidden" name="item_id[]" value="<?php echo e($data->item_id); ?>"></td>
                    <td align="center"><input min="0"  type="text" class="form-control text-center unitprice" name="unit_price[]" data-id = "<?php echo e($data->item_id); ?>" id="rate_id_<?php echo e($data->item_id); ?>" value="<?php echo e($data->unit_price); ?>"></td>
                    <td align="center">

                    <select class="form-control taxList" name="tax_id[]">
                    <?php foreach($tax_types as $item): ?>
                      <option value="<?php echo e($item->id); ?>" taxrate="<?php echo e($item->tax_rate); ?>" <?= ($item->id == $data->tax_id ? 'selected':'')?>><?php echo e($item->name); ?>(<?php echo e($item->tax_rate); ?>)</option>
                    <?php endforeach; ?>
                    </select>

                    </td>
                    <td align="center" class="taxAmount"><?php echo e($tax); ?></td>
                    <td align="center"><input readonly class="form-control text-center amount" size="4" type="text" value="<?php echo e($data->quantity_received * $data->unit_price); ?>" id="amount_<?php echo e($data->item_id); ?>" name="item_price[]"></td>
                    <td align="center"><button id="<?php echo e($data->item_id); ?>" class="btn btn-xs btn-danger delete_item"><i class="glyphicon glyphicon-trash"></i></button></td>
                  </tr>
                  <?php
                    $stack[] = $data->item_id;
                  ?>
                  <?php endforeach; ?>
                  <tr class="tableInfos"><td colspan="6" align="right"><strong><?php echo e(trans('message.invoice.sub_total')); ?></strong></td><td align="left" colspan="2"><strong id="subTotal"></strong></td></tr>
                  <tr class="tableInfos"><td colspan="6" align="right"><strong><?php echo e(trans('message.invoice.totalTax')); ?></strong></td><td align="left" colspan="2"><strong id="taxTotal"><?php echo e($taxSum); ?></strong></td></tr>
                  <tr class="tableInfos"><td colspan="6" align="right"><strong><?php echo e(trans('message.invoice.grand_total')); ?></strong></td><td align="left" colspan="2"><input type='text' name="total" class="form-control" id = "grandTotal" value="<?php echo e($purchData->total); ?>" readonly></td></tr>
                  <?php endif; ?>
                  </tbody>
                </table>
              </div>
                <br><br>
              </div>
            </div>
              <!-- /.box-body -->
              <div class="col-md-12">
              <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo e(trans('message.table.note')); ?></label>
                    <textarea placeholder="<?php echo e(trans('message.form.item_des')); ?> ..." rows="3" class="form-control" name="comments"><?php echo e($purchData->comments); ?></textarea>
                </div>
                <a href="<?php echo e(url('/purchase/list')); ?>" class="btn btn-info btn-flat"><?php echo e(trans('message.form.cancel')); ?></a>
                <button type="submit" class="btn btn-primary pull-right btn-flat"><?php echo e(trans('message.form.update')); ?></button>
              </div>
              </div>
            </form>
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

$(function() {
    $(document).on('click', function(e) {
        if (e.target.id === 'no_div') {
            $('#no_div').hide();
        } else {
            $('#no_div').hide();
        }

    })
});

var taxOptionList = "<?php echo $tax_type_new; ?>";
    function in_array(search, array)
    {
      for (i = 0; i < array.length; i++)
      {
        if(array[i] ==search )
        {
          return true;
        }
      }
        return false;
    }

    $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
        //Date picker
        $('#datepicker').datepicker({
            autoclose: true,
            todayHighlight: true,
            format: '<?php echo e(Session::get('date_format_type')); ?>'
        });
        $('#datepicker').datepicker('update', new Date());

        $('.ref').val(Math.floor((Math.random() * 100) + 1));
    })

    var stack = [];
    var stack = <?php echo json_encode($stack); ?>;
    var token = $("#token").val();
    $( "#search" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?php echo e(URL::to('purchase/item-search')); ?>",
                dataType: "json",
                type: "POST",
                data: {
                    _token:token,
                    search: request.term
                },
                success: function(data){
                  //Start
                    if(data.status_no == 1){
                    $("#val_item").html();
                     var data = data.items;
                     $('#no_div').css('display','none');
                    response( $.map( data, function( item ) {
                        return {
                            id: item.id,
                            stock_id: item.stock_id,
                            value: item.description,
                            units: item.units,
                            price: item.price,
                            tax_rate: item.tax_rate,
                            tax_id: item.tax_id
                        }
                    }));
                  }else{
                    $('.ui-menu-item').remove();
                    $("#no_div").css('display','block');
                  }
                  //end


                 }
            })
        },

        select: function(event, ui) {
          var e = ui.item;
          if(e.id) {
              if(!in_array(e.id, stack))
              {
                stack.push(e.id);
                var taxAmount = (e.price*e.tax_rate)/100;
                var new_row = '<tr id="rowid'+e.id+'">'+
                          '<td class="text-center">'+ e.stock_id +'<input type="hidden" name="stock_id_new[]" value="'+e.stock_id+'"></td>'+
                          '<td class="text-center">'+ e.value +'<input type="hidden" name="description_new[]" value="'+e.value+'"></td>'+
                          '<td><input class="form-control text-center no_units" min="1" data-id="'+e.id+'" data-rate="'+ e.price +'" type="text" id="qty_'+e.id+'" name="item_quantity_new[]" value="1"><input type="hidden" name="item_id_new[]" value="'+e.id+'"></td>'+
                          '<td class="text-center"><input min="0"  type="text" class="form-control text-center unitprice" name="unit_price_new[]" data-id = "'+e.id+'" id="rate_id_'+e.id+'" value="'+ e.price +'"></td>'+
                          '<td class="text-center">'+taxOptionList+'</td>'+
                          '<td class="text-center taxAmount">'+taxAmount+'</td>'+
                          '<td><input class="form-control text-center amount" type="text" id="amount_'+e.id+'" value="'+e.price+'" name="item_price_new[]" readonly></td>'+
                          '<td class="text-center"><button id="'+e.id+'" class="btn btn-xs btn-danger delete_item"><i class="glyphicon glyphicon-trash"></i></button></td>'+
                          '</tr>';
                
                $(new_row).insertAfter($('table tr.dynamicRows:last'));

                $(function() {
                    $("#rowid"+e.id+' .taxList').val(e.tax_id);
                }); 
                var taxRateValue = parseFloat( $("#rowid"+e.id+' .taxList').find(':selected').attr('taxrate'));
                // Calculate subtotal
                var subTotal = calculateSubTotal();
                $("#subTotal").html(subTotal);

                // Calculate Grand Total
                var taxTotal = calculateTaxTotal();
                 $("#taxTotal").text(taxTotal);
                var grandTotal = (subTotal + taxTotal);
                
                $("#grandTotal").val(grandTotal);


                $('.tableInfo').show();

              } else {
                  $('#qty_'+e.id).val( function(i, oldval) {
                      return ++oldval;
                  });
                
                  var q = $('#qty_'+e.id).val();
                  var r = $("#rate_id_"+e.id).val();

                $('#amount_'+e.id).val( function(i, amount) {
                    var itemPrice = (q * r);
                    return itemPrice;
                });
               var taxRateValue = parseFloat( $("#rowid"+e.id+' .taxList').find(':selected').attr('taxrate'));
               var amountByRow = $('#amount_'+e.id).val(); 
               var taxByRow = amountByRow*taxRateValue/100;
               $("#rowid"+e.id+" .taxAmount").text(taxByRow);               
                var taxTotal = calculateTaxTotal();
                $("#taxTotal").text(taxTotal);

                // Calculate subTotal
                var subTotal = calculateSubTotal();
                $("#subTotal").html(subTotal);
                // Calculate GrandTotal
                var grandTotal = (subTotal + taxTotal);
                $("#grandTotal").val(grandTotal);
              }

            if(stack && stack.length != 0){
               $("#btnSubmit").prop("disabled",false);;
            }              

              $(this).val('');
              $('#val_item').html('');
              return false;
          }
        },
        minLength: 1,
        autoFocus: true
    });


    $(document).on('change keyup blur','.check',function() {
      var row_id = $(this).attr("id").substr(2);
      var disc = $(this).val();
      var amd = $('#a_'+row_id).val();

      if (disc != '' && amd != '') {
        $('#a_'+row_id).val((parseInt(amd)) - (parseInt(disc)));
      } else {
        $('#a_'+row_id).val(parseInt(amd));
      }
      
    });

    $(document).ready(function() {
          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
        });

    $(document).on('keyup', '.no_units', function(ev){
      var id = $(this).attr("data-id");
      var qty = $("#qty_"+id).val();

      if(isNaN(qty)){
          qty = 0;
       }

      var rate = $("#rate_id_"+id).val();
      
      var price = calculatePrice(qty,rate);       

      $("#amount_"+id).val(price);
     
     var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').attr('taxrate'));
     var amountByRow = $('#amount_'+id).val(); 
     var taxByRow = amountByRow*taxRateValue/100;
     $("#rowid"+id+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").html(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").text(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(grandTotal);

    });

     // calculate amount with unit price
    $(document).on('keyup', '.unitprice', function(ev){
     
      var unitprice = parseFloat($(this).val());

      var id = $(this).attr("data-id");

      var qty = $("#qty_"+id).val();
      //console.log(qty);
      var rate = $("#rate_id_"+id).val();
      var price = calculatePrice(qty,rate);
      $("#amount_"+id).val(price);  


     var taxRateValue = parseFloat( $("#rowid"+id+' .taxList').find(':selected').attr('taxrate'));
     var amountByRow = $('#amount_'+id).val(); 
     var taxByRow = amountByRow*taxRateValue/100;
     $("#rowid"+id+" .taxAmount").text(taxByRow);
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").text(taxTotal);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").html(subTotal);

      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(grandTotal);

    });
    

    $(document).on('change', '.taxList', function(ev){
      var taxRateValue = $(this).find(':selected').attr('taxrate');
      var rowId = $(this).closest('tr').prop('id');
      var amountByRow = $("#"+rowId+" .amount").val(); 
      var taxByRow = amountByRow*taxRateValue/100;
      $("#"+rowId+" .taxAmount").text(taxByRow);

      // Calculate subTotal
      var subTotal = calculateSubTotal();
      $("#subTotal").html(subTotal);
      // Calculate taxTotal
      var taxTotal = calculateTaxTotal();
      $("#taxTotal").text(taxTotal);
      // Calculate GrandTotal
      var grandTotal = (subTotal + taxTotal);
      $("#grandTotal").val(grandTotal);

    });

    // Delete item row
    $(document).ready(function(e){
      $('#purchaseInvoice').on('click', '.delete_item', function() {
            var v = $(this).attr("id");
            stack = jQuery.grep(stack, function(value) {
              return value != v;
            });

            if(stack && stack.length == 0){
               $("#btnSubmit").prop("disabled",true);;
            }             

            $(this).closest("tr").remove();
            
           var taxRateValue = parseFloat( $("#rowid"+v+' .taxList').find(':selected').attr('taxrate'));
           var amountByRow = $('#amount_'+v).val(); 
           var taxByRow = amountByRow*taxRateValue/100;
           $("#rowid"+v+" .taxAmount").text(taxByRow);
            var taxTotal = calculateTaxTotal();
            $("#taxTotal").text(taxTotal);

            var subTotal = calculateSubTotal();
            $("#subTotal").html(subTotal);

            // Calculate GrandTotal
            var grandTotal = (subTotal + taxTotal);
            $("#grandTotal").val(grandTotal);           

        });
    });
      
      /**
      * Calcualte Total tax
      *@return  totalTax for row wise
      */
      function calculateTaxTotal (){
          var totalTax = 0;
            $('.taxAmount').each(function() {
                totalTax += parseFloat($(this).text());
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
            subTotal += parseInt($(this).val());
        });
        return subTotal;
      }

      /**
      * Calcualte Total pice by taxtype 
      *@return  subTotal
      */
      function calculateTotalByTaxType (taxtype){
        var sum = 0;
        $('.tax_item_price_'+taxtype).each(function() {
            sum += parseFloat($(this).val());
        });
        return sum;
      }

      /**
      * Calcualte price
      *@return  price
      */
      function calculatePrice (qty,rate){
         var price = (qty*rate);
         return price;
      }   
      // calculate tax 
      function caculateTax(p,t){
       var tax = (p*t)/100;
       return tax;
      }   
      // calculate taxId replacing dot(.) sign with dash(-) sign
      function createTaxId(taxRate){
        var taxInfo = taxRate.toString();
        var taxId = taxInfo.split('.').join('-');
        return taxId;
      }

      $(document).ready(function(){
        var subTotal = calculateSubTotal();
        $("#subTotal").text(subTotal);
      });
      $(document).ready(function(){
        var supplier = $('#cus').find(":selected").val();
        var location = $('#loc').find(":selected").val();
        $('#supplier_id').val(supplier);
        $('#into_stock_location').val(location);

      });

// Item form validation
    $('#purchaseEditForm').validate({
        rules: {
            supplier_id: {
                required: true
            },
            into_stock_location: {
                required: true
            },
            ord_date:{
               required: true
            }                       
        }
    });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>