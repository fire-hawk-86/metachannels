<?php $__env->startSection('navbar'); ?>
  <li><a href="<?php echo e(url('meta/new')); ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> New</a></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2>All Metachannels</h2>
        </div>
      
        <?php $__currentLoopData = $metachannels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metachannel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a href="<?php echo e(url('meta').'/'.$metachannel->id); ?>">
              <?php if($metachannel->videos()->isNotEmpty()): ?>
                <img src="https://img.youtube.com/vi/<?php echo e($metachannel->videos()->first()->ytid); ?>/mqdefault.jpg" alt="">
              <?php else: ?>
                <img src="http://via.placeholder.com/320x180" alt="">
              <?php endif; ?>
              <h3><?php echo e($metachannel->name); ?></h3>
            </a>
            <p>
              Channels:

              <?php $__currentLoopData = $metachannel->channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="https://www.youtube.com/channel/<?php echo e($channel->ytid); ?>"><?php echo e($channel->name); ?></a><?php echo e($loop->remaining ? ', ' : ''); ?>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </p>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>