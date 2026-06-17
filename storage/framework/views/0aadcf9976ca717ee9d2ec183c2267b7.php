

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Special Tours</h1>
            <p class="mt-1 text-sm text-gray-600">
                Manage special tours, pricing, status, and images.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <a
                href="<?php echo e(route('admin.special-tours.create')); ?>"
                class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                Add Special Tour
            </a>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mt-6 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mt-6 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    
    <div class="mt-6 rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-4 py-4 sm:px-6">
            <div class="flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900">All Special Tours</h2>
                <div class="text-xs text-gray-500">
                    Showing <?php echo e($specialTours->firstItem() ?? 0); ?>–<?php echo e($specialTours->lastItem() ?? 0); ?> of <?php echo e($specialTours->total()); ?>

                </div>
            </div>
        </div>

        <?php if($specialTours->count() === 0): ?>
            <div class="px-4 py-10 sm:px-6">
                <div class="rounded-lg border border-dashed border-gray-300 bg-gray-50 p-8 text-center">
                    <h3 class="text-sm font-semibold text-gray-900">No special tours yet</h3>
                    <p class="mt-1 text-sm text-gray-600">Create your first special tour to show it on the website.</p>
                    <div class="mt-5">
                        <a
                            href="<?php echo e(route('admin.special-tours.create')); ?>"
                            class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        >
                            Add Special Tour
                        </a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 sm:px-6">
                                Tour
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                                Status
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600">
                                Price
                            </th>
                            <th scope="col" class="hidden px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-600 md:table-cell">
                                Created
                            </th>
                            <th scope="col" class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-600 sm:px-6">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 bg-white">
                        <?php $__currentLoopData = $specialTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 sm:px-6">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-gray-900"><?php echo e($tour->title); ?></span>
                                        <span class="mt-0.5 text-xs text-gray-500">/<?php echo e($tour->slug); ?></span>
                                    </div>
                                </td>

                                <td class="px-4 py-4">
                                    <?php if($tour->is_active): ?>
                                        <span class="inline-flex items-center rounded-full bg-green-50 px-2.5 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-200">
                                            Active
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700 ring-1 ring-inset ring-gray-200">
                                            Inactive
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-4 py-4">
                                    <?php if(!is_null($tour->price)): ?>
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo e($tour->currency); ?> <?php echo e(number_format((float) $tour->price, 0)); ?>

                                        </div>
                                        <?php if($tour->price_note): ?>
                                            <div class="text-xs text-gray-500"><?php echo e($tour->price_note); ?></div>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span class="text-sm text-gray-500">—</span>
                                    <?php endif; ?>
                                </td>

                                <td class="hidden px-4 py-4 md:table-cell">
                                    <div class="text-sm text-gray-700">
                                        <?php echo e(optional($tour->created_at)->format('Y-m-d')); ?>

                                    </div>
                                </td>

                                <td class="px-4 py-4 text-right sm:px-6">
                                    <a
                                        href="<?php echo e(route('admin.special-tours.edit', $tour->id)); ?>"
                                        class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                                    >
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <div class="flex items-center justify-between gap-4 border-t border-gray-200 px-4 py-4 sm:px-6">
                <div class="text-xs text-gray-500">
                    Page <?php echo e($specialTours->currentPage()); ?> of <?php echo e($specialTours->lastPage()); ?>

                </div>

                <div>
                    <?php echo e($specialTours->links()); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\admin\special-tours\index.blade.php ENDPATH**/ ?>