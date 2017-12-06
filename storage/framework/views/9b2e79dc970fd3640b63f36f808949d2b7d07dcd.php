<?php $__env->startSection('title', 'Create New Metachannel - '); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">

      <?php if($errors->any()): ?>
          <div class="alert alert-danger">
              <ul>
                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <li><?php echo e($error); ?></li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
          </div>
      <?php endif; ?>

      <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <h1>Create New Metachannel</h1>
          <hr>

          <form method="POST" action="<?php echo e(url('meta')); ?>">

            <div class="form-group">
              <label name="name">Name:</label>
              <input id="name" name="name" class="form-control" value="<?php echo e(old('name')); ?>">
            </div>

            <div class="form-group">
              <label name="description">Description:</label>
              <textarea id="description" name="description" rows="10" class="form-control"><?php echo e(old('description')); ?></textarea>
            </div>

            <div id="channels" class="form-group">
              <label name="channels">Channels:</label>
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="<?php echo e(old('name')); ?>">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="<?php echo e(old('name')); ?>">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="<?php echo e(old('name')); ?>">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="<?php echo e(old('name')); ?>">
              <input name="channels[]" class="form-control" placeholder="https://www.youtube.com/user/example" value="<?php echo e(old('name')); ?>">
            </div>

            <input type="submit" value="Create Metachannel" class="btn btn-success btn-lg btn-block">
            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">

          </form>

        </div>
      </div>﻿

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>