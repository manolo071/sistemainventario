<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <?php echo $__env->make('layouts.includes.finance_menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <!-- /.col -->
        <div class="col-md-9">

          <div class="box box-default">
            <div class="box-body">
              <div class="row">
                <div class="col-md-9">
                 <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.taxes')); ?></div>
                </div> 
                <div class="col-md-3">
                  <?php if(Helpers::has_permission(Auth::user()->id, 'add_tax')): ?>
                    <a href="#" data-toggle="modal" data-target="#add-tax" class="btn btn-block btn-default btn-flat btn-border-orange"><span class="fa fa-plus"> &nbsp;</span><?php echo e(trans('message.table.add_new')); ?></a>
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
                  <th><?php echo e(trans('message.table.tax_rate')); ?> (%)</th>
                  <th><?php echo e(trans('message.table.default')); ?></th>
                  <th width="5%"><?php echo e(trans('message.table.action')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($taxData as $data): ?>
                <tr>
                  <td><a href="javascript:void(0)" class="edit_tax" id="<?php echo e($data->id); ?>"><?php echo e($data->name); ?></a></td>
                  <td><?php echo e($data->tax_rate); ?></td>
                  <td><?php echo e($data->defaults == 1 ? 'Yes' : 'No'); ?></td>
                  <td>
                      <?php if(Helpers::has_permission(Auth::user()->id, 'edit_tax')): ?>
                      <a title="<?php echo e(trans('message.form.edit')); ?>" class="btn btn-xs btn-primary edit_tax" id="<?php echo e($data->id); ?>"><span class="fa fa-edit"></span></a> &nbsp;
                      <?php endif; ?>
                      <?php if(Helpers::has_permission(Auth::user()->id, 'delete_tax')): ?>
                      <?php if(!in_array($data->id,[1,2,3])): ?>
                      <form method="POST" action="<?php echo e(url("delete-tax/$data->id")); ?>" accept-charset="UTF-8" style="display:inline">
                          <?php echo csrf_field(); ?>

                          <button title="<?php echo e(trans('message.form.Delete')); ?>" class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.table.delete_unit_header')); ?>" data-message="<?php echo e(trans('message.table.delete_unit')); ?>">
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
            <!-- /.box-body -->
          </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<div id="add-tax" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo e(trans('message.table.add_new')); ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action='<?php echo e(url("save-tax")); ?>' method="post" id="addTex">
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token-rm">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.name')); ?></label>

            <div class="col-sm-6">
              <input type="text" class="form-control" name="name">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.table.tax_rate')); ?> (%)</label>

            <div class="col-sm-6">
              <input type="number" class="form-control" name="tax_rate">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.table.default')); ?></label>

            <div class="col-sm-6">
                <select class="form-control" name="defaults" >
                    <option value="0" >No</option>
                    <option value="1" >Yes</option>
                </select>
            </div>
          </div>

          
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


<div id="edit-tax" class="modal fade" role="dialog" style="display: none;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title"><?php echo e(trans('message.table.update_tax')); ?></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action='<?php echo e(url("update-tax")); ?>' method="post" id="editTex">
        <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token-rm">
          
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.form.name')); ?></label>

            <div class="col-sm-6">
              <input type="text" placeholder="Name" class="form-control" name="name" id="tax_nm">
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.table.tax_rate')); ?> (%)</label>

            <div class="col-sm-6">
              <input type="number" class="form-control" name="tax_rate" id="tax_rate">
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-3 control-label require" for="inputEmail3"><?php echo e(trans('message.table.default')); ?></label>

            <div class="col-sm-6">
                <select class="form-control" name="defaults" id="defaults">
                    <option value="0" >No</option>
                    <option value="1" >Yes</option>
                </select>
            </div>
          </div>
          <input type="hidden" name="tax_id" id="tax_id">

          <?php if(Helpers::has_permission(Auth::user()->id, 'edit_tax')): ?>
          <div class="form-group">
            <label for="btn_save" class="col-sm-3 control-label"></label>
            <div class="col-sm-6">
              <button type="button" class="btn btn-info btn-flat" data-dismiss="modal"><?php echo e(trans('message.form.close')); ?></button>
              <button type="submit" class="btn btn-primary btn-flat"><?php echo e(trans('message.form.update')); ?></button>
            </div>
          </div>
          <?php endif; ?>
          
        </form>
      </div>
    </div>

  </div>
</div>

    </section>
    <?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
      $(function () {
        $("#example1").DataTable({
          "columnDefs": [ {
            "targets": 3,
            "orderable": false
            } ],
            
            "language": '<?php echo e(Session::get('dflt_lang')); ?>',
            "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
        });
        
      });

      $('.edit_tax').on('click', function() {
        var id = $(this).attr("id");

        $.ajax({
            url: '<?php echo e(URL::to('edit-tax')); ?>',
            data:{                  // data that will be sent
                id:id
            },
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
              
                $('#tax_nm').val(data.name);
                $('#tax_rate').val(data.tax_rate);
                $('#tax_id').val(data.id);
                $('#defaults').val(data.defaults);

                $('#edit-tax').modal();
            }
        });

    });

      $('#addTex').validate({
        rules: {
            name: {
                required: true
            },
            tax_rate: {
                required: true
            }                     
        }
    });

      $('#editTex').validate({
        rules: {
            name: {
                required: true
            },
            tax_rate: {
                required: true
            }                     
        }
    });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>