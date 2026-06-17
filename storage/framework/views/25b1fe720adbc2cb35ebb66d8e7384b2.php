

<?php $__env->startSection('title', 'Activities'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Activities Management</h1>
            <p class="text-gray-600 mt-1">Manage all tourist activities</p>
        </div>
        <a href="<?php echo e(route('admin.activities.create')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg flex items-center gap-2 transition shadow-md">
            <i class="fas fa-plus"></i> Add New Activity
        </a>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Total Activities</p>
                    <h3 class="text-3xl font-bold text-gray-900"><?php echo e($activities->total()); ?></h3>
                </div>
                <div class="bg-blue-100 rounded-full p-3">
                    <i class="fas fa-hiking text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Active</p>
                    <h3 class="text-3xl font-bold text-green-600"><?php echo e($activities->where('is_active', true)->count()); ?></h3>
                </div>
                <div class="bg-green-100 rounded-full p-3">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Popular</p>
                    <h3 class="text-3xl font-bold text-yellow-600"><?php echo e($activities->where('is_popular', true)->count()); ?></h3>
                </div>
                <div class="bg-yellow-100 rounded-full p-3">
                    <i class="fas fa-star text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-600 text-sm">Inactive</p>
                    <h3 class="text-3xl font-bold text-gray-600"><?php echo e($activities->where('is_active', false)->count()); ?></h3>
                </div>
                <div class="bg-gray-100 rounded-full p-3">
                    <i class="fas fa-eye-slash text-gray-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg shadow-md p-5 mb-6">
        <form method="GET" action="<?php echo e(route('admin.activities.index')); ?>">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <input type="text" name="search" 
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" 
                           placeholder="Search activities..." 
                           value="<?php echo e(request('search')); ?>">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">All Categories</option>
                        <?php $__currentLoopData = \App\Models\ActivityCategory::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>" <?php echo e(request('category_id') == $category->id ? 'selected' : ''); ?>>
                                <?php echo e($category->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
                    <select name="destination_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">All Destinations</option>
                        <?php $__currentLoopData = \App\Models\Destination::orderBy('name')->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $destination): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($destination->id); ?>" <?php echo e(request('destination_id') == $destination->id ? 'selected' : ''); ?>>
                                <?php echo e($destination->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">All Status</option>
                        <option value="active" <?php echo e(request('status') == 'active' ? 'selected' : ''); ?>>Active</option>
                        <option value="inactive" <?php echo e(request('status') == 'inactive' ? 'selected' : ''); ?>>Inactive</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition flex-1">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="<?php echo e(route('admin.activities.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition">
                        <i class="fas fa-redo"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <!-- Activities Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-5">
            <?php if(session('success')): ?>
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded">
                    <p class="flex items-center gap-2">
                        <i class="fas fa-check-circle"></i>
                        <?php echo e(session('success')); ?>

                    </p>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                    <p class="flex items-center gap-2">
                        <i class="fas fa-exclamation-circle"></i>
                        <?php echo e(session('error')); ?>

                    </p>
                </div>
            <?php endif; ?>

            <!-- Bulk Actions Bar -->
            <div class="mb-4 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox" id="select-all" class="rounded border-gray-300 text-green-600 focus:ring-green-500 mr-2">
                        <span class="text-sm text-gray-700">Select All</span>
                    </label>
                    <span class="text-sm text-gray-500" id="selected-count">0 selected</span>
                </div>
                <button type="button" id="bulk-delete-btn" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg hidden transition">
                    <i class="fas fa-trash mr-1"></i> Delete Selected
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left w-12">
                                <span class="sr-only">Select</span>
                            </th>
                            <th class="px-6 py-3 text-left w-16">
                                <span class="text-xs font-semibold text-gray-700 uppercase">Icon</span>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Category
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Destination
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Details
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Images
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <input type="checkbox" class="select-item rounded border-gray-300 text-green-600 focus:ring-green-500" value="<?php echo e($activity->id); ?>">
                            </td>
                            <td class="px-6 py-4">
                                <?php if($activity->icon): ?>
                                    <img src="<?php echo e(asset('storage/' . $activity->icon)); ?>" alt="<?php echo e($activity->name); ?>" class="w-12 h-12 object-cover rounded-lg shadow">
                                <?php elseif($activity->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $activity->image)); ?>" alt="<?php echo e($activity->name); ?>" class="w-12 h-12 object-cover rounded-lg shadow">
                                <?php else: ?>
                                    <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-hiking text-gray-400"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div>
                                        <div class="text-sm font-semibold text-gray-900"><?php echo e($activity->name); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo e($activity->slug); ?></div>
                                        <?php if($activity->duration): ?>
                                        <div class="text-xs text-blue-600 mt-1">
                                            <i class="far fa-clock"></i> <?php echo e($activity->duration); ?>

                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($activity->category): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                        <?php if($activity->category->icon): ?>
                                        <i class="<?php echo e($activity->category->icon); ?> mr-1"></i>
                                        <?php endif; ?>
                                        <?php echo e($activity->category->name); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400 text-sm">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php if($activity->destination): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        <?php echo e($activity->destination->name); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="text-gray-400 text-sm">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    <?php if($activity->difficulty_level): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium
                                        <?php echo e($activity->difficulty_level == 'easy' ? 'bg-green-100 text-green-800' : ''); ?>

                                        <?php echo e($activity->difficulty_level == 'moderate' ? 'bg-blue-100 text-blue-800' : ''); ?>

                                        <?php echo e($activity->difficulty_level == 'challenging' ? 'bg-orange-100 text-orange-800' : ''); ?>

                                        <?php echo e($activity->difficulty_level == 'extreme' ? 'bg-red-100 text-red-800' : ''); ?>">
                                        <?php echo e(ucfirst($activity->difficulty_level)); ?>

                                    </span>
                                    <?php endif; ?>
                                    <?php if($activity->price_from): ?>
                                    <div class="text-xs text-gray-600">
                                        <i class="fas fa-dollar-sign"></i> <?php echo e($activity->currency); ?> <?php echo e(number_format($activity->price_from, 0)); ?>

                                        <?php if($activity->price_to): ?> - <?php echo e(number_format($activity->price_to, 0)); ?> <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php if($activity->min_age): ?>
                                    <div class="text-xs text-gray-600">
                                        <i class="fas fa-child"></i> Min age: <?php echo e($activity->min_age); ?>

                                    </div>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-1">
                                    <?php if($activity->featured_image): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-image mr-1"></i> Featured
                                    </span>
                                    <?php endif; ?>
                                    <?php if($activity->images->count() > 0): ?>
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                        <i class="fas fa-images mr-1"></i> <?php echo e($activity->images->count()); ?> Gallery
                                    </span>
                                    <?php endif; ?>
                                    <?php if(!$activity->featured_image && $activity->images->count() == 0): ?>
                                    <span class="text-gray-400 text-xs">No images</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex flex-col items-center gap-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium <?php echo e($activity->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'); ?>">
                                        <i class="fas fa-<?php echo e($activity->is_active ? 'check' : 'times'); ?> mr-1"></i>
                                        <?php echo e($activity->is_active ? 'Active' : 'Inactive'); ?>

                                    </span>
                                    <?php if($activity->is_popular): ?>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-star mr-1"></i> Popular
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- View -->
                                    <a href="<?php echo e(route('activities.show', $activity->slug)); ?>" target="_blank"
                                       class="inline-flex items-center justify-center w-8 h-8 bg-gray-600 hover:bg-gray-700 text-white rounded transition"
                                       title="View on site">
                                        <i class="fas fa-eye text-xs"></i>
                                    </a>
                                    
                                    <!-- Edit -->
                                    <a href="<?php echo e(route('admin.activities.edit', $activity)); ?>" 
                                       class="inline-flex items-center justify-center w-8 h-8 bg-blue-600 hover:bg-blue-700 text-white rounded transition"
                                       title="Edit">
                                        <i class="fas fa-edit text-xs"></i>
                                    </a>
                                    
                                    <!-- Toggle Active -->
                                    <form action="<?php echo e(route('admin.activities.toggle-active', $activity)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 <?php echo e($activity->is_active ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700'); ?> text-white rounded transition" 
                                                title="<?php echo e($activity->is_active ? 'Deactivate' : 'Activate'); ?>">
                                            <i class="fas fa-<?php echo e($activity->is_active ? 'toggle-on' : 'toggle-off'); ?> text-xs"></i>
                                        </button>
                                    </form>
                                    
                                    <!-- Toggle Popular -->
                                    <form action="<?php echo e(route('admin.activities.toggle-popular', $activity)); ?>" method="POST" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 <?php echo e($activity->is_popular ? 'bg-gray-600 hover:bg-gray-700' : 'bg-yellow-500 hover:bg-yellow-600'); ?> text-white rounded transition" 
                                                title="<?php echo e($activity->is_popular ? 'Remove from Popular' : 'Mark as Popular'); ?>">
                                            <i class="fas fa-star text-xs"></i>
                                        </button>
                                    </form>
                                    
                                    <!-- Delete -->
                                    <form action="<?php echo e(route('admin.activities.destroy', $activity)); ?>" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete <?php echo e($activity->name); ?>? This action cannot be undone.')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-600 hover:bg-red-700 text-white rounded transition"
                                                title="Delete">
                                            <i class="fas fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-hiking text-6xl mb-4 text-gray-300"></i>
                                    <p class="text-xl font-medium text-gray-700 mb-2">No activities found</p>
                                    <p class="text-gray-500 mb-4">Get started by creating your first activity</p>
                                    <a href="<?php echo e(route('admin.activities.create')); ?>" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg transition">
                                        <i class="fas fa-plus mr-2"></i> Create Activity
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($activities->hasPages()): ?>
            <div class="mt-6">
                <?php echo e($activities->links()); ?>

            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bulk Delete Modal -->
<div id="bulkDeleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Bulk Delete</h3>
            <p class="text-gray-600 mb-2">Are you sure you want to delete <strong id="delete-count">0</strong> selected activities?</p>
            <p class="text-red-600 text-sm">This action cannot be undone!</p>
        </div>
        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 rounded-b-lg">
            <button type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium" onclick="closeBulkDeleteModal()">
                Cancel
            </button>
            <form id="bulk-delete-form" action="<?php echo e(route('admin.activities.bulk-delete')); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <input type="hidden" name="ids" id="bulk-ids">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                    Delete Activities
                </button>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Select all functionality
const selectAllCheckbox = document.getElementById('select-all');
const itemCheckboxes = document.querySelectorAll('.select-item');
const selectedCount = document.getElementById('selected-count');
const bulkDeleteBtn = document.getElementById('bulk-delete-btn');

selectAllCheckbox.addEventListener('change', function() {
    itemCheckboxes.forEach(cb => cb.checked = this.checked);
    updateSelectedCount();
});

itemCheckboxes.forEach(cb => {
    cb.addEventListener('change', updateSelectedCount);
});

function updateSelectedCount() {
    const selected = Array.from(itemCheckboxes).filter(cb => cb.checked);
    const count = selected.length;
    
    selectedCount.textContent = `${count} selected`;
    
    if (count > 0) {
        bulkDeleteBtn.classList.remove('hidden');
    } else {
        bulkDeleteBtn.classList.add('hidden');
    }
    
    selectAllCheckbox.checked = count === itemCheckboxes.length;
    selectAllCheckbox.indeterminate = count > 0 && count < itemCheckboxes.length;
}

// Bulk delete
bulkDeleteBtn.addEventListener('click', function() {
    const selected = Array.from(itemCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
    
    if (selected.length === 0) {
        alert('Please select at least one activity');
        return;
    }
    
    document.getElementById('delete-count').textContent = selected.length;
    document.getElementById('bulk-ids').value = JSON.stringify(selected);
    document.getElementById('bulkDeleteModal').classList.remove('hidden');
});

function closeBulkDeleteModal() {
    document.getElementById('bulkDeleteModal').classList.add('hidden');
}

// Close modal on outside click
document.getElementById('bulkDeleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeBulkDeleteModal();
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\admin\activities\index.blade.php ENDPATH**/ ?>