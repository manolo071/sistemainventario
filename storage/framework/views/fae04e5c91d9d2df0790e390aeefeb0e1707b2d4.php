<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <!--Default box -->
        <?php echo $__env->make('layouts.includes.user_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <h3><?php echo e($user->real_name); ?></h3> 
        
         <div class="box">
            <!-- /.box-header -->
            <div class="box-body">       
          <div class="col-md-12 col-xs-12">
              <div class="row">
            <form class="form-horizontal" action='<?php echo e(url("user/user-transfer-list/$user_id")); ?>' method="GET" id='salesHistoryReport'>
              
              <div class="col-md-2">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?= isset($from) ? $from : '' ?>" required>
                  </div>
              </div>
              
              <div class="col-md-2">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?= isset($to) ? $to : '' ?>" required>
                  </div>
              </div>

              <div class="col-md-2">
                <label for="exampleInputEmail1"><?php echo e(trans('message.form.source')); ?></label>
                <select class="form-control select2" name="source" id="source" required>
                <option value="all" <?= ($source=='all') ? 'selected' : ''?>>All</option>
                <?php foreach($locationList as $data): ?>
                  <option value="<?php echo e($data->loc_code); ?>" <?= ($data->loc_code == $source) ? 'selected' : ''?>><?php echo e($data->location_name); ?></option>
                <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-2">
                <label for="exampleInputEmail1"><?php echo e(trans('message.form.destination')); ?></label>
                <select class="form-control select2" name="destination" id="destination" required>
                <option value="all" <?= ($destination=='all') ? 'selected' : ''?>>All</option>
                <?php foreach($locationList as $data): ?>
                  <option value="<?php echo e($data->loc_code); ?>" <?= ($data->loc_code == $destination) ? 'selected' : ''?>><?php echo e($data->location_name); ?></option>
                <?php endforeach; ?>
                </select>
              </div>

              <div class="col-md-1">
                <label for="btn">&nbsp;</label>
                <button type="submit" name="btn" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.filter')); ?></button>
              </div>
            </form>
          </div>
          </div>
          </div>
      </div> 

        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <div class="table-responsive">
              <table id="itemList" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th width="15%"><?php echo e(trans('message.table.transfer_no')); ?></th>
                    <th><?php echo e(trans('message.form.source')); ?></th>
                    <th><?php echo e(trans('message.form.destination')); ?></th>
                    
                    <th><?php echo e(trans('message.form.qty')); ?></th>
                    <th><?php echo e(trans('message.form.date')); ?></th>
                    <th width="3%"><?php echo e(trans('message.table.action')); ?></th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($list as $data): ?>
                  <tr>
                    <td align="center"><a href="<?php echo e(url('transfer/view-details/'.$data->id)); ?>"><?php echo e(sprintf("%04d", $data->id)); ?></a></td>
                    <td><?php echo e(getDestinatin($data->source)); ?></td>
                    <td><?php echo e(getDestinatin($data->destination)); ?></td>
                    
                    <td><?php echo e($data->qty); ?></td>
                    <td><?php echo e(formatDate($data->transfer_date)); ?></td>
                    <td>
                      <a title="edit" class="btn btn-xs btn-primary" href='<?php echo e(url("transfer/view-details/$data->id")); ?>'><span class="fa fa-eye"></span></a>
                      <form method="POST" action="<?php echo e(url("transfer/delete/$data->id")); ?>" accept-charset="UTF-8" style="display:inline">
                          <?php echo csrf_field(); ?>

                          <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.extra_text.delete_transfer')); ?>" data-message="<?php echo e(trans('message.extra_text.delete_transfer_confirm')); ?>">
                             <i class="fa fa-remove" aria-hidden="true"></i>
                          </button>
                      </form>
                    </td>
                  </tr>
                 <?php endforeach; ?>
                  </tfoot>
                 </table>            
            </div>
            
            </div>
            <!-- /.box-body -->
          </div>
        <!-- /.box-footer-->
    <?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
    $(function () {
    $("#itemList").DataTable({
    "order": [],
    "columnDefs": [ {
      "targets": 4,
      "orderable": false
      } ],

      "language": '<?php echo e(Session::get('dflt_lang')); ?>',
      "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
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


    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>