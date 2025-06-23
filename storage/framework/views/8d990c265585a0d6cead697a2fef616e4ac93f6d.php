<div id="notifications" class="row no-print">
    <div class="col-md-12">
        <?php if($errors->any()): ?>
        <div class="noti-alert pad no-print">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <ul>
                    <?php foreach($errors->all() as $error): ?>
                    <li><?php echo e($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <?php endif; ?>
        <?php if(session('success')): ?>
        <div class="noti-alert pad no-print">
            <div class="alert alert-success alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <ul>
                    <li><?php echo e(session('success')); ?></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>

        <?php if(session('fail')): ?>
        <div class="noti-alert pad no-print">
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                <h4><i class="icon fa fa-check"></i> Operation Fail</h4>
                <ul>
                    <li><?php echo e(session('fail')); ?></li>
                </ul>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

