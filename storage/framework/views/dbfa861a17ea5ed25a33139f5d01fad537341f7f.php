<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                 <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.team_member')); ?></div>
                </div> 
              </div>
            </div>
          </div>

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo e(trans('message.form.name')); ?></th>
                  <th><?php echo e(trans('message.table.email')); ?></th>
                  <th><?php echo e(trans('message.header.role')); ?></th>
                  <th><?php echo e(trans('message.table.phone')); ?></th>
                  
                  <th width="1%"><?php echo e(trans('message.table.action')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($userData as $data): ?>
                <tr>
                  <td><?php echo e($data->real_name); ?></td>
                  <td><?php echo e($data->email); ?></td>
                  <td><?php echo e($data->role); ?></td>
                  <td><?php echo e($data->phone); ?></td>
                  <td>
                  <a class="btn btn-xs btn-info" href='<?php echo e(url("user/purchase-list/$data->id")); ?>'><span class="fa fa-eye"></span></a> &nbsp;
                  </td>
                </tr>
               <?php endforeach; ?>
                </tfoot>
              </table>
            </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </div>

    </section>
<?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">

  $(function () {
    $("#example1").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 4,
        "orderable": false
        } ],

        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
    
  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>