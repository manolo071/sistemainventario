<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
    
      <div class="row">
        <div class="col-md-3">
      <?php echo $__env->make('layouts.includes.company_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                 <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.team_member')); ?></div>
                </div> 
                <div class="col-md-3">
                  <?php if(Helpers::has_permission(Auth::user()->id, 'add_team_member')): ?>
                    <a href="<?php echo e(url('create-user')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.extra_text.add_new_user')); ?></a>
                  <?php endif; ?>
                  
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
                  
                  <th width="15%"><?php echo e(trans('message.table.action')); ?></th>
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
                  <?php if(!in_array($data->id,[1])): ?>
                      
                      <?php if(Helpers::has_permission(Auth::user()->id, 'edit_team_member')): ?>
                      <a title="<?php echo e(trans('message.form.edit')); ?>" class="btn btn-xs btn-primary" href='<?php echo e(url("edit-user/$data->id")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                      <?php endif; ?>

                    <?php if(Helpers::has_permission(Auth::user()->id, 'delete_team_member')): ?> 
                      <form method="POST" action="<?php echo e(url("delete-user/$data->id")); ?>" accept-charset="UTF-8" style="display:inline">
                          <?php echo csrf_field(); ?>

                          <button title="<?php echo e(trans('message.form.Delete')); ?>" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.table.delete_user_header')); ?>" data-message="<?php echo e(trans('message.table.delete_user')); ?>">
                              <i class="glyphicon glyphicon-trash"></i> 
                          </button>
                      </form>
                    <?php endif; ?>
                
                  <?php endif; ?>
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