<?php $__env->startSection('title',  'Edit '.$metachannel->name.' - '); ?>

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

          <h1><?php echo e('Edit '.$metachannel->name); ?></h1>
          <hr>

          <form method="POST" action="<?php echo e(url('meta/'.$metachannel->id)); ?>">

            <div class="form-group">
              <label name="name">Name:</label>
              <input id="name" name="name" class="form-control" value="<?php echo e($metachannel->name); ?>">
            </div>

            <div class="form-group">
              <label name="description">Description:</label>
              <textarea id="description" name="description" rows="10" class="form-control"><?php echo e($metachannel->description); ?></textarea>
            </div>

            <input type="submit" value="Update Metachannel" class="btn btn-success btn-lg btn-block">
            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
            <?php echo e(method_field('PUT')); ?>


          </form>

        </div>
      </div>﻿

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>