<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-9 col-sm-8 col-xs-12">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.sidebar.stock-move-list')); ?></div>
          </div> 
          <div class="col-md-3 col-sm-4 col-xs-12">
             <?php if(Helpers::has_permission(Auth::user()->id, 'add_transfer')): ?>
              <a href="<?php echo e(url('transfer/create')); ?>" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.extra_text.new_transfer')); ?></a>
              <?php endif; ?>
          </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <!-- Default box -->
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
                     
                      <?php if(Helpers::has_permission(Auth::user()->id, 'delete_transfer')): ?>
                      <form method="POST" action="<?php echo e(url("transfer/delete/$data->id")); ?>" accept-charset="UTF-8" style="display:inline">
                          <?php echo csrf_field(); ?>

                          <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.extra_text.delete_transfer')); ?>" data-message="<?php echo e(trans('message.extra_text.delete_transfer_confirm')); ?>">
                             <i class="fa fa-remove" aria-hidden="true"></i>
                          </button>
                      </form>
                      <?php endif; ?>
                    </td>
                  </tr>
                 <?php endforeach; ?>
                  </tfoot>
                 </table>
            </div>
          </div>
              <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    
    </section>

<?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>