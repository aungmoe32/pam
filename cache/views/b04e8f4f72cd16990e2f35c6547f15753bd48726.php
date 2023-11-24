<?php if(isset($errors)): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bg-red-400 p-5">
            <?php echo e($msg); ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH /Users/aungmoemyintthu/Desktop/phpLearn/mvc/resources/views/pages/errors.blade.php ENDPATH**/ ?>