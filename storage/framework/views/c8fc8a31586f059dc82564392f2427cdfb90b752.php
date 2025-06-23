<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <!-- Top Box-->
      <div class="box">
        <div class="box-body">
          <strong><?php echo e($itemInfo->description); ?></strong>
        </div>
      </div><!--Top Box End-->
      <!-- Default box -->
      <div class="box">

          <!-- Custom Tabs -->
          <div class="nav-tabs-custom" id="tabs">
            <ul class="nav nav-tabs">
              
              <li class="<?= ($tab=='item-info') ? 'active' :'' ?>"><a href="#tab_1" data-toggle="tab" aria-expanded="false"><?php echo e(trans('message.table.general_settings')); ?></a></li>
              <li class="<?= ($tab=='sales-info') ? 'active' :'' ?>"><a href="#tab_2" data-toggle="tab" aria-expanded="false"><?php echo e(trans('message.table.sales_pricing')); ?></a></li>
              <li class="<?= ($tab=='purchase-info') ? 'active' :'' ?>"><a href="#tab_3" data-toggle="tab" aria-expanded="true"><?php echo e(trans('message.table.purchase_pricing')); ?></a></li>
              <li class="<?= ($tab=='transaction-info') ? 'active' :'' ?>"><a href="#tab_4" data-toggle="tab" aria-expanded="false"><?php echo e(trans('message.table.transctions')); ?></a></li>
              <li class="<?= ($tab=='status-info') ? 'active' :'' ?>"><a href="#tab_5" data-toggle="tab" aria-expanded="true"><?php echo e(trans('message.table.status')); ?></a></li>
            
            </ul>
            <div class="tab-content">
              <div class="tab-pane <?= ($tab=='item-info') ? 'active' :'' ?>" id="tab_1">
                <div class="row">
                <div class="col-md-6">
                  <h4 class="text-info text-center"><?php echo e(trans('message.table.item_info')); ?></h4>
                  <form action="<?php echo e(url('update-item-info')); ?>" method="post" id="itemEditForm" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
                    <input type="hidden" value="<?php echo e($itemInfo->id); ?>" name="id">
                    <div class="box-body">
                      <div class="form-group">
                        <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.item_id')); ?></label>
                        <div class="col-sm-9">
                          <input type="text" placeholder="<?php echo e(trans('message.form.item_id')); ?>" class="form-control" name="stock_id" value="<?php echo e($itemInfo->stock_id); ?>" readonly="true">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.item_name')); ?></label>

                        <div class="col-sm-9">
                          <input type="text" class="form-control" name="description" value="<?php echo e($itemInfo->description); ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.category')); ?></label>
                        <div class="col-sm-9">
                          <select class="form-control select2" name="category_id">
                         
                          <?php foreach($categoryData as $data): ?>
                            <option value="<?php echo e($data->category_id); ?>" <?= ($data->category_id==$itemInfo->category_id)?'selected':''?>><?php echo e($data->description); ?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.unit')); ?></label>
                        <div class="col-sm-9">
                          <select class="form-control select2" name="units">
                          <?php foreach($unitData as $data): ?>
                            <option value="<?php echo e($data->name); ?>" <?= ($data->name==$itemInfo->units)?'selected':''?>><?php echo e($data->name); ?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>                      
                      
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.item_tax_type')); ?></label>
                        <div class="col-sm-9">
                          <select class="form-control select2" name="tax_type_id">
                        
                          <?php foreach($taxTypes as $taxType): ?>
                            <option value="<?php echo e($taxType->id); ?>" <?= ($taxType->id==$itemInfo->tax_type_id)?'selected':''?>><?php echo e($taxType->name); ?></option>
                          <?php endforeach; ?>
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.item_des')); ?></label>

                        <div class="col-sm-9">
                          <textarea placeholder="<?php echo e(trans('message.form.item_des')); ?> ..." rows="3" class="form-control" name="long_description"><?php echo e($itemInfo->long_description); ?></textarea>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.status')); ?></label>

                        <div class="col-sm-9">
                          <select class="form-control valdation_select" name="inactive" >
                            
                            <option value="0" <?=isset($itemInfo->inactive) && $itemInfo->inactive ==  0? 'selected':""?> >Active</option>
                            <option value="1"  <?=isset($itemInfo->inactive) && $itemInfo->inactive == 1 ? 'selected':""?> >Inactive</option>
                          
                          </select>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.picture')); ?></label>
                        <div class="col-sm-9">
                          <input type="file" class="form-control input-file-field" name="item_image">
                          <br>
                          <?php if(!empty($itemInfo->item_image)): ?>
                          <img src='<?php echo e(url("public/uploads/itemPic/$itemInfo->item_image")); ?>' alt="Item Image" width="80" height="80">
                          <?php else: ?>
                          <img src='<?php echo e(url("public/uploads/default_product.jpg")); ?>' alt="Item Image" width="80" height="80">
                          <?php endif; ?>
                         <input type="hidden" name="pic" value="<?php echo e($itemInfo->item_image ? $itemInfo->item_image : 'NULL'); ?>">
                            
                        </div>
                      </div>
                      
                    </div>
                    <!-- /.box-body -->
                    
                    <div class="box-footer">
                      <a href="<?php echo e(url('item')); ?>" class="btn btn-info btn-flat"><?php echo e(trans('message.form.cancel')); ?></a>
                      <button class="btn btn-primary pull-right btn-flat" type="submit"><?php echo e(trans('message.form.submit')); ?></button>
                    </div>
                    
                    <!-- /.box-footer -->
                  </form>
              </div>
              </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?= ($tab=='sales-info') ? 'active' :'' ?>" id="tab_2">
                <div class="row">
                <div class="col-md-6">
                  <h4 class="text-info text-center"></h4>
                <div class="box-body">
                 
                  <button data-toggle="modal" data-target="#add-type" type="button" class="btn btn-default add_br btn-flat btn-border-orange" style="margin-bottom: 10px;"><?php echo e(trans('message.table.add_new')); ?></button>
                 
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th><?php echo e(trans('message.table.sale_type')); ?></th>
                      <th><?php echo e(trans('message.table.price')); ?>(<?php echo e(Session::get('currency_symbol')); ?>)</th>
                      <th width="15%" class="text-center"><?php echo e(trans('message.table.action')); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                      $type = [1,2];
                    ?>
                 <?php foreach($salePriceData as $value): ?>
                    <tr>
                      <td><?php echo e($salesTypeName[$value->sales_type_id]); ?></td>
                      <td><?php echo e($value->price); ?></td>
                      <td class="text-center">
                        
                          <button class="btn btn-xs btn-primary edit_type" id="<?php echo e($value->id); ?>" type="button">
                              <i class="glyphicon glyphicon-edit"></i> 
                          </button>&nbsp;
                       
                          <?php if(! in_array($value->sales_type_id, $type)): ?>
                          <form method="POST" action="<?php echo e(url("delete-sale-price/$value->id/$itemInfo->id")); ?>" accept-charset="UTF-8" style="display:inline">
                              <?php echo csrf_field(); ?>

                              <button title="<?php echo e(trans('message.form.Delete')); ?>" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.table.delete_item_header')); ?>" data-message="<?php echo e(trans('message.table.delete_item')); ?>">
                                  <i class="glyphicon glyphicon-trash"></i> 
                              </button> &nbsp;
                          </form>
                          <?php endif; ?>

                         
                      </td>
                    </tr>
                   <?php endforeach; ?>

                    </tfoot>
                  </table>

                </div>


<div id="add-type" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo e(trans('message.table.add_new')); ?></h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(url('add-sale-price')); ?>" method="post" id="salesInfoForm" class="form-horizontal">
            <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
            <input type="hidden" value="<?php echo e($salesInfo->stock_id); ?>" name="stock_id">
            <input type="hidden" value="USD" name="curr_abrev" id="curr_abrev">
            <input type="hidden" value="<?php echo e($itemInfo->id); ?>" name="item_id">

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.sales_type')); ?></label>

            <div class="col-sm-6">
              <select class="form-control" name="sales_type_id">
              <option value=""><?php echo e(trans('message.form.select_one')); ?></option>
              <?php foreach($saleTypes as $saleType): ?>
                <option value="<?php echo e($saleType->id); ?>"><?php echo e($saleType->sales_type); ?></option>
              <?php endforeach; ?>
              </select>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.price')); ?></label>

            <div class="col-sm-6">
              <input type="text" class="form-control" name="price" placeholder="<?php echo e(trans('message.form.price')); ?>">
            </div>
          </div>
          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <button type="button" class="btn btn-info btn-flat" data-dismiss="modal"><?php echo e(trans('message.form.close')); ?></button>
              <button type="submit" class="btn btn-primary pull-right btn-flat"><?php echo e(trans('message.form.submit')); ?></button>
            </div>
          </div>
        </form>
      </div>

    </div>

  </div>
</div>

<!-- edit modal sales type -->
<div id="edit-type-modal" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo e(trans('message.table.edit')); ?></h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo e(url('update-sale-price')); ?>" method="post" id="editType" class="form-horizontal">
            <?php echo csrf_field(); ?>


          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.sales_type')); ?></label>

            <div class="col-sm-6">
              <input type="text" id="sales_type_id" class="form-control" readonly>
            </div>
          </div>
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.price')); ?></label>

            <div class="col-sm-6">
              <input type="text" id="price" class="form-control" name="price" placeholder="<?php echo e(trans('message.form.price')); ?>">
            </div>
          </div>
          
          <input type="hidden" name="id" id="type_id">
          <input type="hidden" value="<?php echo e($itemInfo->id); ?>" name="item_id">

          
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              
              <button type="button" class="btn btn-info btn-flat" data-dismiss="modal"><?php echo e(trans('message.form.close')); ?></button>
              <button type="submit" class="btn btn-primary btn-flat"><?php echo e(trans('message.form.submit')); ?></button>
              
            </div>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>
              </div>
              </div>

              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane <?= ($tab=='purchase-info') ? 'active' :'' ?>" id="tab_3">
                <div class="row">
                <div class="col-md-6">
                  <h4 class="text-info text-center"></h4>
                  <form action="<?php echo e(url('update-purchase-price')); ?>" method="post" id="purchaseInfoForm" class="form-horizontal">
                    <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
                    <input type="hidden" value="<?php echo e($itemInfo->stock_id); ?>" name="stock_id">
                    <input type="hidden" value="<?php echo e($itemInfo->id); ?>" name="item_id">
                    <div class="box-body">
                                     
                    <div class="form-group">
                      <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.price')); ?> <span class="text-danger"> *</label>
                      <div class="col-sm-9">
                        <input type="text" placeholder="<?php echo e(trans('message.form.price')); ?>" class="form-control" name="price" value="<?php echo e(isset($purchaseInfo->price) ? $purchaseInfo->price : 0); ?>">
                      </div>
                    </div>
                                                            
                  </div>
                  <!-- /.box-body -->
                 
                  <div class="box-footer">
                    <a href="<?php echo e(url('item')); ?>" class="btn btn-primary btn-flat"><?php echo e(trans('message.form.cancel')); ?></a>
                    <button class="btn btn-info pull-right btn-flat" type="submit"><?php echo e(trans('message.form.submit')); ?></button>
                  </div>
                 
                  <!-- /.box-footer -->
                </form>
              </div>
              </div>

              </div>
             
              <div style="min-height:200px" class="tab-pane <?= ($tab=='transaction-info') ? 'active' :'' ?>" id="tab_4">
                <?php if(count($transations)>0): ?>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-center"><?php echo e(trans('message.table.transaction_type')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.table.transaction_date')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.table.location')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.table.qty_in')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.table.qty_out')); ?></th>
                      <th class="text-center"><?php echo e(trans('message.table.qty_on_hand')); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sum = 0;
                    $StockIn = 0;
                    $StockOut = 0;
                    ?>
                    <?php foreach($transations as $result): ?>
                    <tr>
                      <td align="center">
                        
                        <?php if($result->trans_type == PURCHINVOICE): ?>
                          <a href="<?php echo e(URL::to('/purchase/view-purchase-details/'.$result->transaction_reference_id)); ?>">Purchase</a>
                        <?php elseif($result->trans_type == SALESINVOICE): ?>
                          <a href="<?php echo e(URL::to('/invoice/view-detail-invoice/'.$result->order_no.'/'.$result->transaction_reference_id)); ?>">Sale</a>
                        <?php elseif($result->trans_type == STOCKMOVEIN): ?>
                          <a href="<?php echo e(URL::to('/transfer/view-details/'.$result->transaction_reference_id)); ?>">Transfer</a>
                        <?php elseif($result->trans_type == STOCKMOVEOUT): ?>
                          <a href="<?php echo e(URL::to('/transfer/view-details/'.$result->transaction_reference_id)); ?>">Transfer</a>
                        <?php endif; ?>

                      </td>
                      <td align="center"><?php echo e(formatDate($result->tran_date)); ?></td>
                      <td align="center"><?php echo e($result->location_name); ?></td>
                      <td align="center">
                        <?php if($result->qty >0 ): ?>
                          <?php echo e($result->qty); ?>

                          <?php
                          $StockIn +=$result->qty;
                          ?>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                      </td>
                      <td align="center">
                        <?php if($result->qty <0 ): ?>
                          <?php echo e(str_ireplace('-','',$result->qty)); ?>

                          <?php
                          $StockOut +=$result->qty;
                          ?>
                        <?php else: ?>
                        -
                        <?php endif; ?>
                      </td>
                      <td align="center"><?php echo e($sum += $result->qty); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <tr><td colspan="3" align="right"><?php echo e(trans('message.table.total')); ?></td><td align="center"><?php echo e($StockIn); ?></td><td align="center"><?php echo e(str_ireplace('-','',$StockOut)); ?></td><td align="center"><?php echo e($StockIn+$StockOut); ?></td></tr>
                  </tbody>
                </table>
                <?php else: ?>
                <br>
                <?php echo e(trans('message.table.no_transaction')); ?>

                <?php endif; ?>

              </div>

          <!-- /.tab-pane status -->
              <div class="tab-pane <?= ($tab=='status-info') ? 'active' :'' ?>" id="tab_5">
              <div class="row">
                <div class="col-md-6">
                  <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th><?php echo e(trans('message.table.location')); ?></th>
                          <th><?php echo e(trans('message.table.qty_available')); ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(!empty($locData)): ?>
                        <?php
                          $sum = 0;
                        ?>
                        <?php foreach($locData as $data): ?>
                        <tr>
                          <td><?php echo e($data->location_name); ?></td>
                          <td><?php echo e(getItemQtyByLocationName($data->loc_code,$salesInfo->stock_id)); ?></td>
                        </tr>
                        <?php
                          $sum += getItemQtyByLocationName($data->loc_code,$salesInfo->stock_id); 
                        ?>
                       <?php endforeach; ?>
                       <?php endif; ?>
                       <tr><td align="right"><?php echo e(trans('message.invoice.total')); ?></td><td><?php echo e($sum); ?></td></tr>
                        </tfoot>
                      </table>
                    </div>
                    </div>
                    </div>
              </div>
              
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- nav-tabs-custom -->
        
          </div>
        <div class="clearfix"></div>
        <!-- /.box-footer-->
      
      <!-- /.box -->

    </section>

    <?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
$(document).ready(function () {
// Item form validation
    $('#itemEditForm').validate({
        rules: {
            stock_id: {
                required: true
            },
            description: {
                required: true
            },
            category_id:{
               required: true
            },
            tax_type_id:{
               required: true
            }, 
            units:{
               required: true
            }                        
        }
    });
    // Sales form validation
    $('#salesInfoForm').validate({
        rules: {
            sales_type_id: {
                required: true
            },
            price: {
                required: true
            }                        
        }
    });

    // Purchse form validation
    $('#purchaseInfoForm').validate({
        rules: {
            supplier_id: {
                required: true
            },
            price: {
                required: true
            },
            suppliers_uom: {
                required: true
            }                                     
        }
    });

    $(".select2").select2({
       width: '100%'
    });


    $('.edit_type').on('click', function() {
      
        var id = $(this).attr("id");

        $.ajax({
            url: '<?php echo e(URL::to('edit-sale-price')); ?>',
            data:{  // data that will be sent
                id:id
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
              
                $('#sales_type_id').val(data.sales_type_id);
                $('#price').val(data.price);
                $('#type_id').val(data.id);

                $('#edit-type-modal').modal();
            }
        });

    });

});

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>