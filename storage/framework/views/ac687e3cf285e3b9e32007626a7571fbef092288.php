<?php $__env->startSection('content'); ?>
  <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-10">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.purchase')); ?></div>
          </div> 
          <div class="col-md-2">
            <?php if(Helpers::has_permission(Auth::user()->id, 'add_purchase')): ?>
              <a href="<?php echo e(url('purchase/add')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.extra_text.new_purchase')); ?></a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
          <div class="box box-default">
          <div class="box-body">
                <div class="btn-group pull-right">
                  <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailPurchase"><?php echo e(trans('message.extra_text.email')); ?></button>

                  <a target="_blank" href="<?php echo e(URL::to('/')); ?>/purchase/print/<?php echo e($purchData->order_no); ?>" title="Print" class="btn btn-default btn-flat"><?php echo e(trans('message.extra_text.print')); ?></a>
                  <a target="_blank" href="<?php echo e(URL::to('/')); ?>/purchase/pdf/<?php echo e($purchData->order_no); ?>" title="PDF" class="btn btn-default btn-flat"><?php echo e(trans('message.extra_text.pdf')); ?></a>
                   <?php if(Helpers::has_permission(Auth::user()->id, 'edit_purchase')): ?>
                  <a href="<?php echo e(URL::to('/')); ?>/purchase/edit/<?php echo e($purchData->order_no); ?>" title="Edit" class="btn btn-default btn-flat"><?php echo e(trans('message.extra_text.edit')); ?></a>
                    <?php endif; ?>
                    <?php if(Helpers::has_permission(Auth::user()->id, 'delete_purchase')): ?>
                  <form method="POST" action="<?php echo e(url("purchase/delete/$purchData->order_no")); ?>" accept-charset="UTF-8" style="display:inline">
                      <?php echo csrf_field(); ?>

                      <button class="btn btn-default btn-flat delete-btn" title="<?php echo e(trans('message.table.delete')); ?>" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.invoice.delete_purchase')); ?>" data-message="<?php echo e(trans('message.invoice.delete_purchase_confirm')); ?>">
                         <?php echo e(trans('message.extra_text.delete')); ?>

                      </button>
                  </form>
                    <?php endif; ?>
                </div>
          </div>

            <div class="box-body">
              <div class="row">
                
                  <div class="col-md-4">
                    <strong><?php echo e(Session::get('company_name')); ?></strong>
                    <h5 class=""><?php echo e(Session::get('company_street')); ?></h5>
                    <h5 class=""><?php echo e(Session::get('company_city')); ?>, <?php echo e(Session::get('company_state')); ?></h5>
                    <h5 class=""><?php echo e(Session::get('company_country_id')); ?>, <?php echo e(Session::get('company_zipCode')); ?></h5>
                    <h5 class=""><?php echo e(Session::get('vat_no')); ?></h5>

                  </div>

                <div class="col-md-4">
                  <strong><?php echo e(!empty($purchData->supp_name) ? $purchData->supp_name : ''); ?></strong>
                  <h5><?php echo e(!empty($purchData->address) ? $purchData->address : ''); ?></h5>
                  <h5><?php echo e(!empty($purchData->city) ? $purchData->city : ''); ?><?php echo e(!empty($purchData->state) ? ', '.$purchData->state : ''); ?></h5>
                  <h5><?php echo e(!empty($purchData->country) ? $purchData->country : ''); ?><?php echo e(!empty($purchData->zipcode) ? ', '.$purchData->zipcode : ''); ?></h5>
                </div>

                <div class="col-md-4">
                    <strong><?php echo e(trans('message.table.invoice_no').' # '.$purchData->reference); ?></strong>
                    <h5><?php echo e(trans('message.extra_text.location')); ?> : <?php echo e($purchData->location_name); ?></h5>
                    <h5><?php echo e(trans('message.table.date')); ?> : <?php echo e(formatDate($purchData->ord_date)); ?></h5>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="box-body no-padding">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="salesInvoice">
                      <tbody>
                      <tr class="tbl_header_color dynamicRows">
                        <th width="30%" class="text-center"><?php echo e(trans('message.table.description')); ?></th>
                        <th width="10%" class="text-center"><?php echo e(trans('message.table.quantity')); ?></th>
                        <th width="10%" class="text-center"><?php echo e(trans('message.table.rate')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                        <th width="10%" class="text-center"><?php echo e(trans('message.table.tax')); ?>(%)</th>
                        <th width="10%" class="text-right"><?php echo e(trans('message.table.amount')); ?></th>
                      </tr>
                      <?php
                       $itemsInformation = '';
                      ?>
                      <?php if(count($invoiceItems)>0): ?>
                       <?php $subTotal = 0;$units = 0;?>
                        <?php foreach($invoiceItems as $result): ?>
                            <tr>
                              <td class="text-center"><?php echo e($result->description); ?></td>
                              <td class="text-center"><?php echo e($result->quantity_received); ?></td>
                              <td class="text-center"><?php echo e(number_format($result->unit_price,2,'.',',')); ?></td>
                              <td class="text-center"><?php echo e($result->tax_rate); ?></td>
                              <?php
                                $priceAmount = ($result->quantity_received*$result->unit_price);
                                $subTotal += $priceAmount;
                                $units += $result->quantity_received;
                                $itemsInformation .= '<div>'.$result->quantity_received.'x'.' '.$result->description.'</div>';
                              ?>
                              <td align="right"><?php echo e(Session::get('currency_symbol').number_format($priceAmount,2,'.',',')); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="tableInfos"><td colspan="4" align="right"><?php echo e(trans('message.table.total_qty')); ?></td><td align="right" colspan="2"><?php echo e($units); ?></td></tr>
                      <tr class="tableInfos"><td colspan="4" align="right"><?php echo e(trans('message.table.sub_total')); ?></td><td align="right" colspan="2"><?php echo e(Session::get('currency_symbol').number_format($subTotal,2,'.',',')); ?></td></tr>
                      <?php foreach($taxType as $rate=>$tax_amount): ?>
                      <?php if($rate != 0): ?>
                      <tr><td colspan="4" align="right">Plus Tax(<?php echo e($rate); ?>%)</td><td colspan="2" class="text-right"><?php echo e(Session::get('currency_symbol').number_format($tax_amount,2,'.',',')); ?></td></tr>
                      <?php endif; ?>
                      <?php endforeach; ?>
                      <tr class="tableInfos"><td colspan="4" align="right"><strong><?php echo e(trans('message.table.grand_total')); ?></strong></td><td colspan="2" class="text-right"><strong><?php echo e(Session::get('currency_symbol').number_format($purchData->total,2,'.',',')); ?></strong></td></tr>
                      <?php endif; ?>
                      </tbody>
                    </table>
                    </div>
                    <br>
                    <strong><?php echo e(trans('message.table.note')); ?> : </strong>
                    <br>
                    <?php echo e($purchData->comments); ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <?php echo $__env->make('layouts.includes.purchase_page_right_option', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>   
    </div>
  </section>
  




 <!--Purchase Email Modal start-->
    <div id="emailPurchase" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <form id="purchase_form" method="POST" action="<?php echo e(url('purchase/email-purchase-info')); ?>">
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
        <input type="hidden" value="<?php echo e($purchData->order_no); ?>" name="order_no">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(trans('message.email.email_invoice_info')); ?></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email"><?php echo e(trans('message.email.send_to')); ?>:</label>
              <input type="email" value="<?php echo e($purchData->email); ?>" class="form-control" name="email" id="email">
            </div>
            <?php
            $subjectInfo = str_replace('{reference}', $purchData->reference, $emailInfo->subject);
            $subjectInfo = str_replace('{company_name}', Session::get('company_name'), $subjectInfo);
            ?>
            <div class="form-group">
              <label for="subject"><?php echo e(trans('message.email.subject')); ?>:</label>
              <input type="text" class="form-control" name="subject" id="subject" value="<?php echo e($subjectInfo); ?>">
            </div>
              <div class="form-groupa">
                  <?php
                  $bodyInfo = str_replace('{supplier_name}', $purchData->supp_name, $emailInfo->body);
                  $bodyInfo = str_replace('{reference}', $purchData->reference, $bodyInfo);
                  $bodyInfo = str_replace('{total_amount}', $purchData->total, $bodyInfo);

              
                  $bodyInfo = str_replace('{billing_street}', $purchData->address, $bodyInfo);
                  $bodyInfo = str_replace('{billing_city}', $purchData->city, $bodyInfo);
                  $bodyInfo = str_replace('{billing_state}', $purchData->state, $bodyInfo);
                  $bodyInfo = str_replace('{billing_zip_code}', $purchData->zipcode, $bodyInfo);
                  $bodyInfo = str_replace('{billing_country}', $purchData->country, $bodyInfo);  

                  $bodyInfo = str_replace('{company_name}', Session::get('company_name'), $bodyInfo);
                  $bodyInfo = str_replace('{purchase_summery}', $itemsInformation, $bodyInfo);                      
                  ?>
                  <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px"><?php echo e($bodyInfo); ?></textarea>
              </div>
              <div class="form-group">
                <div class="checkbox">
                  <label><input type="checkbox" name="purchase_pdf" checked><strong><?php echo e($purchData->reference); ?></strong></label>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><?php echo e(trans('message.email.close')); ?></button><button type="submit" class="btn btn-primary btn-sm"><?php echo e(trans('message.email.send')); ?></button>
          </div>
        </div>
        </form>
      </div>
    </div>
  <!--Purchase Email Modal end -->
  <?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script type="text/javascript">
  $(function () {
        $(".editor").wysihtml5();
      });
  $('#purchase_form').validate({
        rules: {
            email: {
                required: true
            },
            subject:{
               required: true,
            },
            message:{
               required: true,
            }                   
        }
    }); 
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>