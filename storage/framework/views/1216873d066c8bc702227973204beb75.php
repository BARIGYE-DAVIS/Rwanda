

<?php $__env->startSection('title', 'Tours List'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">All Tours</h1>
    <a href="<?php echo e(route('admin.tours.create')); ?>" class="bg-indigo-600 text-white px-4 py-2 rounded">
        <i class="fas fa-plus"></i> Create New Tour
    </a>
</div>

<?php if(session('success')): ?>
    <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<?php if($tours->count()): ?>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-indigo-100">
                    <th class="px-4 py-2 text-left">Title</th>
                    <th class="px-4 py-2 text-left">Category</th>
                    <th class="px-4 py-2 text-left">Destinations</th>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Created</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="border-b hover:bg-indigo-50">
                        <td class="px-4 py-2"><?php echo e($tour->title); ?></td>
                        <td class="px-4 py-2"><?php echo e($tour->category); ?></td>
                        <td class="px-4 py-2"><?php echo e($tour->destinations); ?></td>
                        <td class="px-4 py-2"><?php echo e($tour->type); ?></td>
                        <td class="px-4 py-2"><?php echo e($tour->created_at->format('Y-m-d')); ?></td>
                        <td class="px-4 py-2 text-center">
                            <a href="<?php echo e(route('admin.tours.edit', $tour->id)); ?>" class="text-indigo-600 hover:underline mr-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="<?php echo e(route('admin.tours.destroy', $tour->id)); ?>" method="POST" class="inline-block" onsubmit="return confirm('Are you sure to delete this tour?');">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="text-red-600 hover:underline" type="submit">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <?php echo e($tours->links()); ?>

    </div>
<?php else: ?>
    <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded">
        No tours found. <a href="<?php echo e(route('admin.tours.create')); ?>" class="underline text-indigo-700">Create your first tour here.</a>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\admin\tours\index.blade.php ENDPATH**/ ?>