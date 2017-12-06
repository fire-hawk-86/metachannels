<?php $__env->startSection('title', $metachannel->name . ' - '); ?>

<?php $__env->startSection('navbar'); ?>
  <li><a href="<?php echo e(url('meta/'.$metachannel->id.'/edit')); ?>"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit</a></li>
  <li><a href="<?php echo e(url('meta/'.$metachannel->id.'/update')); ?>"><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> Update</a></li>
  <li><a onclick="document.getElementById('delete-form').submit();" href="#"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete</a></li>
  <li>
    <form id="delete-form" method="POST" action="<?php echo e(url('meta') .'/'. $metachannel->id); ?>">
      <?php echo e(method_field('DELETE')); ?>

      <?php echo e(csrf_field()); ?>

    </form>
  </li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">

      <div class="row">
        <div class="col-sm-12"> 
          <h2><?php echo e($metachannel->name); ?>

            <small>(
              <?php $__currentLoopData = $metachannel->channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="https://www.youtube.com/channel/<?php echo e($channel->ytid); ?>" target="_blank"><?php echo e($channel->name); ?></a><?php echo e($loop->remaining ? ', ' : ''); ?>

              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            )</small>
          </h2>
          <p class="m30"><?php echo e($metachannel->description); ?></p>
        </div>
      </div>

      <div class="row">
        <?php $__currentLoopData = $metachannel->videos(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $video): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="fixed-height col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <a href="https://www.youtube.com/watch?v=<?php echo e($video->ytid); ?>" target="_blank">
              <img src="https://img.youtube.com/vi/<?php echo e($video->ytid); ?>/mqdefault.jpg" alt="">
              <h3><?php echo e($video->name); ?></h3>
            </a>
            <p><?php echo e($video->uploaded_at->format('d. F Y')); ?> (<a href="https://www.youtube.com/channel/<?php echo e($video->channel->ytid); ?>" target="_blank"><?php echo e($video->channel->name); ?></a>)</p>
            <p><?php echo e($video->description); ?></p>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>