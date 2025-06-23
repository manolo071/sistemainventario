<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

    <div class="box box-default">
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
           <div class="top-bar-title padding-bottom"><?php echo e(trans('message.extra_text.shipments')); ?></div>
          </div> 
        </div>
      </div>
    </div>
      <div class="box">
        <div class="box-body">
                <ul class="nav nav-tabs cus" role="tablist">
                <li>
                 <a href='<?php echo e(url("shipment/list")); ?>' ><?php echo e(trans('message.extra_text.all')); ?></a>
                 </li>
                 <li class="active">
                 <a href="<?php echo e(url("shipment/filtering")); ?>" ><?php echo e(trans('message.extra_text.filter')); ?></a>
                 </li>
               </ul>
          <form class="form-horizontal" action="<?php echo e(url('shipment/filtering')); ?>" method="GET" id='orderListFilter'>
          <div class="col-md-12">
            <div class="row">

               <div class="col-md-2">
               <div class="form-group" style="margin-right: 5px">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.from')); ?></label>
                  <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input class="form-control" id="from" type="text" name="from" value="<?php echo e($from); ?>" required>
                  </div>
                </div>
               </div> 

               <div class="col-md-2">
               <div class="form-group" style="margin-right: 5px">
                  <label for="exampleInputEmail1"><?php echo e(trans('message.report.to')); ?></label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input class="form-control" id="to" type="text" name="to" value="<?php echo e($to); ?>" required>
                  </div>
                  </div>
               </div> 
               <div class="col-md-2">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1"><?php echo e(trans('message.form.customer')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="customer" id="customer">
                    <option value="">All</option>
                    <?php if(!empty($customerList)): ?>
                    <?php foreach($customerList as $customerItem): ?>
                    <option value="<?php echo e($customerItem->debtor_no); ?>" <?= ($customerItem->debtor_no == $customer) ? 'selected' : ''?>><?php echo e($customerItem->name); ?></option>
                    <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                  </div>
                </div>
               </div>
               <?php
               //d($status,1);
               ?>
               <div class="col-md-2">
                 <div class="form-group" style="margin-right: 5px">
                  <label for="sel1"><?php echo e(trans('message.invoice.status')); ?></label>
                  <div class="input-group">
                  <select class="form-control select2" name="status" id="status">
                    <option value="all">All</option>
                    <?php foreach($statuses as $index=>$statusItem): ?>
                    <option value="<?php echo e($index); ?>" <?= ($index == $status) ? 'selected' : ''?>><?php echo e($statusItem); ?></option>
                    <?php endforeach; ?>
                  </select>
                  </div>
                </div>
               </div>
            </div>
           
             <div class="row">
             <div class="col-md-1">
             <div class="form-group">
                <div class="input-group">
                <button type="submit" name="btn" class="btn btn-primary btn-flat"><?php echo e(trans('message.extra_text.filter')); ?></button>
                </div>
              </div>
              </div>
             </div>
          </div>
          </form>
        </div>
      </div><!--Filtering Box End-->


      <!-- Default box -->
      <div class="box">
            <!-- /.box-header -->
            <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token" id="token">
            <div class="box-body">
              <table id="shipmentList" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="5%" class="text-center"><?php echo e(trans('message.invoice.shipment_no')); ?></th>
                  <th width="10%" class="text-center"><?php echo e(trans('message.invoice.order_no')); ?></th>
                  <th><?php echo e(trans('message.invoice.customer_name')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.extra_text.quantity')); ?></th>
                  <th class="text-center"><?php echo e(trans('message.invoice.status')); ?></th>
                  <th width="15%" class="text-center"><?php echo e(trans('message.invoice.packed_date')); ?></th>
                  <th width="13%" align="center"><?php echo e(trans('message.invoice.action')); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($shipmentList as $key=>$data): ?>
                <tr>
                  <td align="center"><a href="<?php echo e(url('shipment/view-details/'.$data->order_id.'/'.$data->shipment_id)); ?>"><?php echo e(sprintf("%04d", $data->shipment_id)); ?></a></td>
                  <td align="center"><a href="<?php echo e(URL::to('/')); ?>/order/view-order-details/<?php echo e($data->order_id); ?>"><?php echo e($data->reference); ?></a></td>
                  <td><a href="<?php echo e(url("customer/edit/$data->debtor_no")); ?>"><?php echo e($data->name); ?></a></td>
                  <td class="text-center"><?php echo e($data->total_shipment); ?></td>
                  <?php
                    if($data->status == 0){
                      $status = trans('message.invoice.shipment_packed');
                      $label = 'warning';
                    }else{
                      $status = trans('message.invoice.shipment_delivered');
                      $label = 'success';
                    }
                  ?>
                  <td class="text-center"><span class="label label-<?php echo e($label); ?>" id="colId-<?php echo e($data->shipment_id); ?>"><?php echo e($status); ?></span></td>
                  <td class="text-center"><?php echo e(formatDate($data->packed_date)); ?></td>
                  <td>
                  <?php if(Helpers::has_permission(Auth::user()->id, 'edit_shipment')): ?>
                    <?php if($data->status == 0): ?>
                    <a class="btn btn-xs btn-info shipment_status" data-id="<?php echo e($data->shipment_id); ?>"><span class="fa fa-truck"></span></a> &nbsp;
                    <?php endif; ?>
                    <a class="btn btn-xs btn-primary" href='<?php echo e(url("shipment/edit/$data->shipment_id")); ?>'><span class="fa fa-edit"></span></a> &nbsp;
                  <?php endif; ?>
                  <?php if(Helpers::has_permission(Auth::user()->id, 'delete_shipment')): ?>
                    <form method="POST" action="<?php echo e(url("shipment/delete/$data->shipment_id")); ?>" accept-charset="UTF-8" style="display:inline">
                        <?php echo csrf_field(); ?>

                        <button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('message.invoice.delete_shipment')); ?>" data-message="<?php echo e(trans('message.invoice.delete_shipment_confirm')); ?>">
                            <i class="glyphicon glyphicon-trash"></i> 
                        </button>
                    </form>
                  <?php endif; ?>
                  </td>
                </tr>
               <?php endforeach; ?>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
      <!-- /.box -->

    </section>

<?php echo $__env->make('layouts.includes.message_boxes', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script type="text/javascript">
    $('.select2').select2({});
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

  $(function () {
    $("#shipmentList").DataTable({
      "order": [],
      "columnDefs": [ {
        "targets": 5,
        "orderable": true
        } ],

        "language": '<?php echo e(Session::get('dflt_lang')); ?>',
        "pageLength": '<?php echo e(Session::get('row_per_page')); ?>'
    });
    
  });

  $(document).ready(function(){
      $('.shipment_status').on('click',function(event){
      event.preventDefault();
       var id = $(this).attr('data-id');
       var token = $("#token").val();
      
       $.ajax({
        method:"POST",
        url   :SITE_URL+"/shipment/status-change",
        data  :{"id":id,"_token":token}
       }).done(function(result){
        var status = result.status_no;
        if(status==1){
          $("#colId-"+id).html("Delivered");
          $("#colId-"+id).removeClass("label-warning");
          $("#colId-"+id).addClass("label-success");
        }
       });
    });
  });

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>