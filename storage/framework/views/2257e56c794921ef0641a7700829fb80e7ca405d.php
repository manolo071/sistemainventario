<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.supplier_single')); ?></div>
          </div> 
        </div>
      </div>
    </div>

        <div class="box">
           <div class="panel-body">
                <ul class="nav nav-tabs cus" role="tablist">
                    <li class="active">
                      <a href="<?php echo e(url("edit-supplier/$supplierData->supplier_id")); ?>" ><?php echo e(trans('message.sidebar.profile')); ?></a>
                    </li>
                    <li>
                      <a href="<?php echo e(url("supplier/orders/$supplierData->supplier_id")); ?>" ><?php echo e(trans('message.extra_text.purchase_orders')); ?></a>
                    </li>
               </ul>
              <div class="clearfix"></div>
           </div>
        </div>

      <!-- Default box -->
        
        <div class="box">
          <div class="box-body">
              <h4 class="text-info text-center"><?php echo e(trans('message.table.update_suppiler')); ?></h4>
                <!-- form start -->
              <form action='<?php echo e(url("update-supplier/$supplierData->supplier_id")); ?>' method="post" id="myform1" class="form-horizontal">
              <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
              <div class="box-body">
              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.table.supp_name')); ?></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="<?php echo e(trans('message.form.full_name')); ?>" class="form-control valdation_check" id="fname" name="supp_name" value="<?php echo e($supplierData->supp_name); ?>">
                    <span id="val_fname" style="color: red"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.email')); ?></label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="Supplier Short Name" class="form-control valdation_check" id="lname" name="email" value="<?php echo e($supplierData->email); ?>" readonly>
                    <span id="val_lname" style="color: red"></span>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.table.phone')); ?></label>

                  <div class="col-sm-6">
                    <input type="text" placeholder="<?php echo e(trans('message.table.phone')); ?>" class="form-control valdation_check" id="name" name="contact" value="<?php echo e($supplierData->contact); ?>">
                    <span id="val_name" style="color: red"></span>
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.extra_text.street')); ?></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="<?php echo e(trans('message.extra_text.street')); ?>" class="form-control valdation_check" id="address" name="address" value="<?php echo e($supplierData->address); ?>">
                  </div>
                </div>

            
                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.extra_text.city')); ?></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="<?php echo e(trans('message.extra_text.city')); ?>" class="form-control" id="city" name="city" value="<?php echo e($supplierData->city); ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.extra_text.state')); ?></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="<?php echo e(trans('message.extra_text.state')); ?>" class="form-control" id="state" name="state" value="<?php echo e($supplierData->state); ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.extra_text.zipcode')); ?></label>
                  <div class="col-sm-6">
                    <input type="text" placeholder="<?php echo e(trans('message.extra_text.zipcode')); ?>" class="form-control" id="zipcode" name="zipcode" value="<?php echo e($supplierData->zipcode); ?>">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.extra_text.country')); ?></label>
                  <div class="col-sm-6">
                        <select class="form-control select2" name="country" id="country">
                        <option value=""><?php echo e(trans('message.form.select_one')); ?></option>
                        <?php foreach($countries as $data): ?>
                          <option value="<?php echo e($data->code); ?>" <?= ($data->code == $supplierData->country) ? 'selected' : ''?>><?php echo e($data->country); ?></option>
                        <?php endforeach; ?>
                        </select>
                  </div>
                </div> 
                
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="inputEmail3"><?php echo e(trans('message.form.status')); ?></label>

                  <div class="col-sm-6">
                    <select class="form-control valdation_select" name="inactive" >
                      
                      <option value="0" <?=isset($supplierData->inactive) && $supplierData->inactive ==  0? 'selected':""?> >Active</option>
                      <option value="1"  <?=isset($supplierData->inactive) && $supplierData->inactive == 1 ? 'selected':""?> >Inactive</option>
                    </select>
            <?php if(Helpers::has_permission(Auth::user()->id, 'edit_supplier')): ?>
              <div>
                <br>
                <a href="<?php echo e(url('supplier')); ?>" class="btn btn-info btn-flat"><?php echo e(trans('message.form.cancel')); ?></a>
                <button class="btn btn-primary pull-right btn-flat" type="submit"><?php echo e(trans('message.form.submit')); ?></button>
              </div>
              <?php endif; ?>

                  </div>
                </div>

              </div>
              </div>
              </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </form>

          </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
    $(".select2").select2();
    $('#myform1').validate({
        rules: {
            supp_name: {
                required: true
            },
            email: {
                required: true
            },
            address:{
              required : true
            }, 
            city: {
                required: true
            },
            state: {
                required: true
            },

            country :{
              required : true
            }                               
        }
    });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>