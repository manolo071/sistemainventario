<?php $__env->startSection('content'); ?>
  <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-10">
           <div class="top-bar-title padding-bottom">Receive Details</div>
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
                  <button title="Email" type="button" class="btn btn-default btn-flat" data-toggle="modal" data-target="#emailReceived"><?php echo e(trans('message.extra_text.email')); ?></button>
                  <a target="_blank" href="<?php echo e(URL::to('/')); ?>/receive/print/<?php echo e($rewceiveInfo->id); ?>" title="Print" class="btn btn-default btn-flat"><?php echo e(trans('message.extra_text.print')); ?></a>
                  <a target="_blank" href="<?php echo e(URL::to('/')); ?>/receive/pdf/<?php echo e($rewceiveInfo->id); ?>" title="PDF" class="btn btn-default btn-flat"><?php echo e(trans('message.extra_text.pdf')); ?></a>
                   <?php if(Helpers::has_permission(Auth::user()->id, 'edit_purchase')): ?>
                  <a href="<?php echo e(URL::to('/')); ?>/receive/edit/<?php echo e($rewceiveInfo->id); ?>" title="Edit" class="btn btn-default btn-flat"><?php echo e(trans('message.extra_text.edit')); ?></a>
                    <?php endif; ?>
                    <?php if(Helpers::has_permission(Auth::user()->id, 'delete_purchase')): ?>
                  <form method="POST" action="<?php echo e(url("receive/delete")); ?>" accept-charset="UTF-8" style="display:inline">
                      <?php echo csrf_field(); ?>

                      <input type="hidden" name="receive_id" value="<?php echo e($rewceiveInfo->id); ?>">
                      <input type="hidden" name="order_no" value="<?php echo e($rewceiveInfo->order_no); ?>">
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
                  </div>

                <div class="col-md-4">
                  <strong><?php echo e(!empty($rewceiveInfo->supp_name) ? $rewceiveInfo->supp_name : ''); ?></strong>
                  <h5><?php echo e(!empty($rewceiveInfo->address) ? $rewceiveInfo->address : ''); ?></h5>
                  <h5><?php echo e(!empty($rewceiveInfo->city) ? $rewceiveInfo->city : ''); ?><?php echo e(!empty($rewceiveInfo->state) ? ', '.$rewceiveInfo->state : ''); ?></h5>
                  <h5><?php echo e(!empty($rewceiveInfo->country) ? $rewceiveInfo->country : ''); ?><?php echo e(!empty($rewceiveInfo->zipcode) ? ', '.$rewceiveInfo->zipcode : ''); ?></h5>
                </div>

                <div class="col-md-4">
                    <strong><?php echo e(trans('message.table.invoice_no').' # '.$rewceiveInfo->reference); ?></strong>
                     <h5><strong>Receive No : <?php echo e(sprintf("%04d", $rewceiveInfo->id)); ?></strong></h5>
                    <h5><?php echo e(trans('message.extra_text.location')); ?> : <?php echo e($rewceiveInfo->location_name); ?></h5>
                    <h5><?php echo e(trans('message.table.date')); ?> : <?php echo e(formatDate($rewceiveInfo->receive_date)); ?></h5>
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
                      <?php if(count($itemInfo)>0): ?>
                       <?php $subTotal = 0;$units = 0; $tax = 0;$totalTax=0;?>
                        <?php foreach($itemInfo as $result): ?>
                            <tr>
                              <td class="text-center"><?php echo e($result->description); ?></td>
                              <td class="text-center"><?php echo e($result->quantity); ?></td>
                              <td class="text-center"><?php echo e(number_format($result->unit_price,2,'.',',')); ?></td>
                              <td class="text-center"><?php echo e($result->tax_rate); ?></td>
                              <?php
                                $priceAmount = ($result->quantity*$result->unit_price);
                                $subTotal += $priceAmount;
                                $units += $result->quantity;

                                $tax = $priceAmount*$result->tax_rate/100;
                                $totalTax += $tax;

                              ?>
                              <td align="right"><?php echo e(Session::get('currency_symbol').number_format($priceAmount,2,'.',',')); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="tableInfos"><td colspan="4" align="right"><?php echo e(trans('message.table.total_qty')); ?></td><td align="right" colspan="2"><?php echo e($units); ?></td></tr>
                      <tr class="tableInfos"><td colspan="4" align="right"><?php echo e(trans('message.table.sub_total')); ?></td><td align="right" colspan="2"><?php echo e(Session::get('currency_symbol').number_format($subTotal,2,'.',',')); ?></td></tr>
                  <tr class="tableInfos"><td colspan="4" align="right"><?php echo e(trans('message.invoice.totalTax')); ?></td><td align="right" colspan="2"><?php echo e(Session::get('currency_symbol').number_format($totalTax,2,'.',',')); ?></td></tr>

                      <tr class="tableInfos"><td colspan="4" align="right"><strong><?php echo e(trans('message.table.grand_total')); ?></strong></td><td colspan="2" class="text-right"><strong><?php echo e(Session::get('currency_symbol').number_format(($totalTax+$subTotal),2,'.',',')); ?></strong></td></tr>
                      <?php endif; ?>
                      </tbody>
                    </table>
                    </div>
                    <br><br>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
<!---Stat-->
<?php echo $__env->make('layouts.includes.purchase_page_right_option', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!---End-->
    </div>
  </section>
<?php 
  $receive_summery = '';
 ?>
<?php if($itemInfo): ?>
  <?php foreach($itemInfo as $data): ?>
   <?php 
     $receive_summery .= '<div>'.$data->quantity.'x'.' '.$data->description.'</div>';
    ?> 
  <?php endforeach; ?>
<?php endif; ?>

<!--Purchase Received Email Modal start-->
    <div id="emailReceived" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <form id="purchase_form" method="POST" action="<?php echo e(url('receive/email-purchase-info')); ?>">
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
        <input type="hidden" value="<?php echo e($rewceiveInfo->id); ?>" name="receive_no">
        
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title"><?php echo e(trans('message.email.email_invoice_info')); ?></h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="email"><?php echo e(trans('message.email.send_to')); ?>:</label>
              <input type="email" value="<?php echo e($rewceiveInfo->email); ?>" class="form-control" name="email" id="email">
            </div>
            <?php
            $subjectInfo = str_replace('{receive_no}', sprintf("%04d",$rewceiveInfo->id), $emailInfo->subject);
            $subjectInfo = str_replace('{reference}', $rewceiveInfo->reference, $subjectInfo);
            $subjectInfo = str_replace('{company_name}', Session::get('company_name'), $subjectInfo);
            ?>
            <div class="form-group">
              <label for="subject"><?php echo e(trans('message.email.subject')); ?>:</label>
              <input type="text" class="form-control" name="subject" id="subject" value="<?php echo e($subjectInfo); ?>">
            </div>
              <div class="form-groupa">
                  <?php
                  $bodyInfo = str_replace('{supplier_name}', $rewceiveInfo->supp_name, $emailInfo->body);
                  $bodyInfo = str_replace('{reference}', $rewceiveInfo->reference, $bodyInfo);
                  $bodyInfo = str_replace('{receive_no}', sprintf("%04d",$rewceiveInfo->id), $bodyInfo);
              
                  $bodyInfo = str_replace('{billing_street}', $purchData->address, $bodyInfo);
                  $bodyInfo = str_replace('{billing_city}', $purchData->city, $bodyInfo);
                  $bodyInfo = str_replace('{billing_state}', $purchData->state, $bodyInfo);
                  $bodyInfo = str_replace('{billing_zip_code}', $purchData->zipcode, $bodyInfo);
                  $bodyInfo = str_replace('{billing_country}', $purchData->country, $bodyInfo);  

                  $bodyInfo = str_replace('{company_name}', Session::get('company_name'), $bodyInfo);
                  $bodyInfo = str_replace('{received_summery}', $receive_summery, $bodyInfo);                      
                  ?>
                  <textarea id="compose-textarea" name="message" id='message' class="form-control editor" style="height: 200px"><?php echo e($bodyInfo); ?></textarea>
              </div>
              <div class="form-group">
                <div class="checkbox">
                  <label><input type="checkbox" name="purchase_pdf" checked><strong><?php echo e(sprintf("%04d",$purchData->id)); ?></strong></label>
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
  <!--Purchase Received Email Modal end -->
  
    
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