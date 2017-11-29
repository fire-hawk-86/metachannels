<?php $__env->startSection('content'); ?>
    <div class="container">
      <h2>Metachannel: <?php echo e($metachannel->name); ?></h2>
      <p>Channels:

        <?php $__currentLoopData = $metachannel->channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="https://www.youtube.com/channel/<?php echo e($channel->ytid); ?>"><?php echo e($channel->name); ?></a>,
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </p>

      <?php $__currentLoopData = $videos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2">
          <a href="https://www.youtube.com/watch?v=<?php echo e($video->ytid); ?>">
            <img src="https://img.youtube.com/vi/<?php echo e($video->ytid); ?>/default.jpg" alt="">
            <h3><?php echo e($video->name); ?></h3>
          </a>
          <p>uploaded: <?php echo e($video->uploaded_at); ?></p>
          <p><?php echo e($video->description); ?></p>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>