<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <?php echo $__env->make('layouts.includes.mail_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                <?php if($tempId == 1): ?>
                
                <?php echo e(trans('message.email.compose_payment')); ?>

                <?php elseif($tempId == 2): ?>
                
                <?php echo e(trans('message.email.compose_shipment')); ?>

                <?php elseif($tempId == 3): ?>
                <?php echo e(trans('message.email.compose_purchase')); ?>

                
                <?php elseif($tempId == 4): ?>
                <?php echo e(trans('message.email.compose_sale')); ?>

                
                <?php elseif($tempId == 5): ?>
                <?php echo e(trans('message.email.compose_order')); ?>

                
                <?php elseif($tempId == 6): ?>
                <?php echo e(trans('message.email.compose_packing')); ?>

             
                <?php elseif($tempId == 7): ?>
                <?php echo e(trans('message.email.compose_purch_receive')); ?>

                <?php endif; ?>
              </h3>
            </div>
          <form action='<?php echo e(url("customer-invoice-temp/$tempId")); ?>' method="post" id="myform">
          <?php echo csrf_field(); ?>

            <!-- /.box-header -->
            <div class="box-body">
            	
              <div class="form-group">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                  <input class="form-control" name="en[subject]" type="text" value="<?php echo e($temp_Data[0]->subject); ?>">
                </div>
              
              <div class="form-group">
                    <textarea id="compose-textarea" name="en[body]" class="form-control editor" style="height: 300px">
                      <?php echo e($temp_Data[0]->body); ?>

                    </textarea>
              </div>


              <div class="box-group" id="accordion">
                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                <div class="panel box box-primary">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                        <?php echo e(trans('message.email.arabic')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">

                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="ar[subject]" type="text" value="<?php echo e($temp_Data[1]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="ar[body]" class="form-control editor" style="height: 300px">
                              <?php echo e($temp_Data[1]->body); ?>

                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                        <?php echo e(trans('message.email.chinese')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="ch[subject]" type="text" value="<?php echo e($temp_Data[2]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="ch[body]" class="form-control editor" style="height: 300px">
                              <?php echo e($temp_Data[2]->body); ?>

                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                        <?php echo e(trans('message.email.french')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="fr[subject]" type="text" value="<?php echo e($temp_Data[3]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="fr[body]" class="form-control editor" style="height: 300px">
                            <?php echo e($temp_Data[3]->body); ?>


                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="collapsed" aria-expanded="false">
                        <?php echo e(trans('message.email.portuguese')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseFour" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="po[subject]" type="text" value="<?php echo e($temp_Data[4]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="po[body]" class="form-control editor" style="height: 300px">
                            <?php echo e($temp_Data[4]->body); ?>


                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="collapsed" aria-expanded="false">
                        <?php echo e(trans('message.email.russain')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseFive" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="rh[subject]" type="text" value="<?php echo e($temp_Data[5]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="rh[body]" class="form-control editor" style="height: 300px">
                            <?php echo e($temp_Data[5]->body); ?>


                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="collapsed" aria-expanded="false">
                        <?php echo e(trans('message.email.spanish')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseSix" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="sp[subject]" type="text" value="<?php echo e($temp_Data[6]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="sp[body]" class="form-control editor" style="height: 300px">
                            <?php echo e($temp_Data[6]->body); ?>

  
                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="panel box box-success">
                  <div class="box-header with-border">
                    <h4 class="box-title">
                      <a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="collapsed" aria-expanded="false">
                        <?php echo e(trans('message.email.turkish')); ?>

                      </a>
                    </h4>
                  </div>
                  <div id="collapseSeven" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                    <div class="box-body">
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1"><?php echo e(trans('message.email.subject')); ?></label>
                      <input class="form-control" name="tu[subject]" type="text" value="<?php echo e($temp_Data[7]->subject); ?>">
                    </div>

                      <div class="form-groupa">
                            <textarea id="compose-textarea" name="tu[body]" class="form-control editor" style="height: 300px">
                            <?php echo e($temp_Data[7]->body); ?>

                            </textarea>
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              
            </div>
            
            <!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.update')); ?></button>
              </div>
              
            </div>
            </form>
            <!-- /.box-footer -->
          </div>

          
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
    	$(function () {
		    //Add text editor
		    $(".editor").wysihtml5();
		  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>