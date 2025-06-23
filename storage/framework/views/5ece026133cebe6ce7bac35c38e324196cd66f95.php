<?php echo $__env->make('emails.livery.html-header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?=$content?>
<?php echo $__env->make('emails.livery.html-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
