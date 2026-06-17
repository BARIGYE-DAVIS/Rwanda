

<?php $__env->startSection('title', 'Edit Activity Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Category: <?php echo e($activityCategory->name); ?></h1>
            <p class="text-gray-600 mt-1">Update category information and settings</p>
        </div>
        <a href="<?php echo e(route('admin.activity-categories.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to Categories
        </a>
    </div>

    <!-- Success Message -->
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span><?php echo e(session('success')); ?></span>
            </div>
        </div>
    <?php endif; ?>

    <!-- Error Messages -->
    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <p class="font-bold mb-2">Please fix the following errors:</p>
            <ul class="list-disc list-inside">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <!-- Edit Form -->
    <form action="<?php echo e(route('admin.activity-categories.update', $activityCategory)); ?>" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="p-6 space-y-6">
            
            <!-- Basic Information Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Basic Information</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Category Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Category Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('name', $activityCategory->name)); ?>" 
                               placeholder="e.g., Wildlife & Nature">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-gray-500 text-xs mt-1">The display name of the category</p>
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            URL Slug
                        </label>
                        <input type="text" name="slug" id="slug"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               value="<?php echo e(old('slug', $activityCategory->slug)); ?>" 
                               placeholder="wildlife-nature">
                        <?php $__errorArgs = ['slug'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-gray-500 text-xs mt-1">Leave empty to auto-generate from name</p>
                    </div>

                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            Sort Order
                        </label>
                        <input type="number" name="sort_order" id="sort_order" min="0"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                               value="<?php echo e(old('sort_order', $activityCategory->sort_order)); ?>">
                        <p class="text-gray-500 text-xs mt-1">Lower numbers appear first (0 = highest priority)</p>
                    </div>

                    <!-- Activities Count -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Associated Activities
                        </label>
                        <div class="px-4 py-2 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-blue-800 font-semibold">
                                <i class="fas fa-hiking mr-2"></i>
                                <?php echo e($activityCategory->activities->count()); ?> Activities
                            </p>
                        </div>
                        <?php if($activityCategory->activities->count() > 0): ?>
                        <p class="text-gray-500 text-xs mt-1">
                            <a href="<?php echo e(route('admin.activities.index', ['category' => $activityCategory->id])); ?>" 
                               class="text-blue-600 hover:underline">
                                View activities in this category
                            </a>
                        </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Description Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Description</h2>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Category Description
                    </label>
                    <textarea name="description" id="description" rows="5"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                              placeholder="Brief description of this activity category..."><?php echo e(old('description', $activityCategory->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="text-gray-500 text-xs mt-1">Explain what types of activities belong to this category</p>
                </div>
            </div>

            <!-- Icon & Image Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Visual Elements</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Icon Class -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            Icon Class (Font Awesome)
                        </label>
                        <div class="flex gap-2">
                            <input type="text" name="icon" id="icon"
                                   class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   value="<?php echo e(old('icon', $activityCategory->icon)); ?>" 
                                   placeholder="fas fa-hiking">
                            <div id="icon-preview" class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600 text-2xl">
                                <?php if($activityCategory->icon): ?>
                                    <i class="<?php echo e($activityCategory->icon); ?>"></i>
                                <?php else: ?>
                                    <i class="fas fa-question"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $__errorArgs = ['icon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-gray-500 text-xs mt-1">
                            Font Awesome icon class 
                            <a href="https://fontawesome.com/icons" target="_blank" class="text-blue-600 hover:underline">
                                (Browse icons)
                            </a>
                        </p>
                        
                        <!-- Common Icons Quick Select -->
                        <div class="mt-3">
                            <p class="text-xs text-gray-600 mb-2">Quick select:</p>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-hiking' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-hiking">
                                    <i class="fas fa-hiking mr-1"></i> Hiking
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-binoculars' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-binoculars">
                                    <i class="fas fa-binoculars mr-1"></i> Wildlife
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-water' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-water">
                                    <i class="fas fa-water mr-1"></i> Water
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-mountain' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-mountain">
                                    <i class="fas fa-mountain mr-1"></i> Mountain
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-camera' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-camera">
                                    <i class="fas fa-camera mr-1"></i> Photo
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-users' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-users">
                                    <i class="fas fa-users mr-1"></i> Cultural
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-campground' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-campground">
                                    <i class="fas fa-campground mr-1"></i> Camping
                                </button>
                                <button type="button" class="icon-btn px-3 py-2 bg-gray-100 hover:bg-green-100 rounded border text-sm <?php echo e(old('icon', $activityCategory->icon) == 'fas fa-horse' ? 'bg-green-200 border-green-500' : ''); ?>" data-icon="fas fa-horse">
                                    <i class="fas fa-horse mr-1"></i> Safari
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Category Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Category Image
                        </label>
                        
                        <!-- Current Image -->
                        <?php if($activityCategory->image): ?>
                        <div class="mb-3">
                            <p class="text-xs text-gray-600 mb-2">Current Image:</p>
                            <div class="relative inline-block">
                                <img src="<?php echo e(asset('storage/' . $activityCategory->image)); ?>" 
                                     alt="<?php echo e($activityCategory->name); ?>"
                                     class="rounded-lg border-2 border-gray-300 shadow-md"
                                     style="max-width: 300px; max-height: 200px; object-fit: cover;">
                                <div class="absolute top-2 left-2 bg-blue-500 text-white px-2 py-1 rounded text-xs font-bold">
                                    Current
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <input type="file" name="image" id="image" accept="image/*"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-gray-500 text-xs mt-1">
                            <?php echo e($activityCategory->image ? 'Upload new image to replace current' : 'Recommended: 800x600px, Max: 2MB (JPG, PNG, WebP)'); ?>

                        </p>
                        
                        <!-- New Image Preview -->
                        <div id="image-preview" class="mt-3"></div>
                    </div>
                </div>
            </div>

            <!-- Status Section -->
            <div>
                <h2 class="text-xl font-semibold text-gray-800 mb-4 pb-2 border-b">Status Settings</h2>
                
                <div>
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                               class="w-5 h-5 rounded border-gray-300 text-green-600 focus:ring-green-500"
                               <?php echo e(old('is_active', $activityCategory->is_active) ? 'checked' : ''); ?>>
                        <div>
                            <span class="text-sm font-medium text-gray-700">Active Category</span>
                            <p class="text-xs text-gray-500">When active, this category will be visible on the website</p>
                        </div>
                    </label>

                    <?php if(!$activityCategory->is_active): ?>
                    <div class="mt-3 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
                        <p class="text-sm text-yellow-800">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            This category is currently inactive and won't appear on the website
                        </p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Form Actions -->
        <div class="border-t bg-gray-50 px-6 py-4 flex justify-between items-center rounded-b-lg">
            <div class="flex gap-3">
                <a href="<?php echo e(route('admin.activity-categories.index')); ?>" class="text-gray-600 hover:text-gray-800 font-medium">
                    <i class="fas fa-times mr-1"></i> Cancel
                </a>
                <button type="button" class="text-red-600 hover:text-red-800 font-medium" onclick="document.getElementById('deleteModal').classList.remove('hidden')">
                    <i class="fas fa-trash mr-1"></i> Delete Category
                </button>
            </div>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center shadow-md">
                <i class="fas fa-save mr-2"></i> Update Category
            </button>
        </div>
    </form>

    <!-- Category Statistics -->
    <div class="mt-6 bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Category Statistics</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-blue-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Activities</p>
                        <p class="text-2xl font-bold text-blue-600"><?php echo e($activityCategory->activities->count()); ?></p>
                    </div>
                    <i class="fas fa-hiking text-blue-600 text-3xl"></i>
                </div>
            </div>

            <div class="bg-green-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Active Activities</p>
                        <p class="text-2xl font-bold text-green-600"><?php echo e($activityCategory->activities->where('is_active', true)->count()); ?></p>
                    </div>
                    <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                </div>
            </div>

            <div class="bg-purple-50 rounded-lg p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Popular Activities</p>
                        <p class="text-2xl font-bold text-purple-600"><?php echo e($activityCategory->activities->where('is_popular', true)->count()); ?></p>
                    </div>
                    <i class="fas fa-star text-purple-600 text-3xl"></i>
                </div>
            </div>
        </div>

        <?php if($activityCategory->activities->count() > 0): ?>
        <div class="mt-4">
            <p class="text-sm text-gray-600 mb-2 font-medium">Recent Activities:</p>
            <div class="space-y-2">
                <?php $__currentLoopData = $activityCategory->activities->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center justify-between bg-gray-50 rounded-lg p-3">
                    <div class="flex items-center gap-3">
                        <?php if($activity->icon): ?>
                        <img src="<?php echo e(asset('storage/' . $activity->icon)); ?>" class="w-10 h-10 rounded object-cover">
                        <?php else: ?>
                        <div class="w-10 h-10 bg-gray-200 rounded flex items-center justify-center">
                            <i class="fas fa-hiking text-gray-400"></i>
                        </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-medium text-gray-800"><?php echo e($activity->name); ?></p>
                            <p class="text-xs text-gray-500">
                                <?php if($activity->is_active): ?>
                                <span class="text-green-600"><i class="fas fa-check-circle"></i> Active</span>
                                <?php else: ?>
                                <span class="text-gray-500"><i class="fas fa-times-circle"></i> Inactive</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                    <a href="<?php echo e(route('admin.activities.edit', $activity)); ?>" class="text-blue-600 hover:text-blue-800 text-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Confirm Delete</h3>
            <p class="text-gray-600 mb-2">Are you sure you want to delete <strong><?php echo e($activityCategory->name); ?></strong>?</p>
            
            <?php if($activityCategory->activities->count() > 0): ?>
            <div class="bg-red-50 border border-red-200 rounded-lg p-3 my-4">
                <p class="text-red-700 text-sm">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    <strong>Warning:</strong> This category has <?php echo e($activityCategory->activities->count()); ?> associated activities. 
                    They will be uncategorized after deletion.
                </p>
            </div>
            <?php endif; ?>
            
            <p class="text-red-600 text-sm font-medium">This action cannot be undone!</p>
        </div>
        <div class="bg-gray-50 px-6 py-4 flex justify-end gap-3 rounded-b-lg">
            <button type="button" class="px-4 py-2 text-gray-600 hover:text-gray-800 font-medium" 
                    onclick="document.getElementById('deleteModal').classList.add('hidden')">
                Cancel
            </button>
            <form action="<?php echo e(route('admin.activity-categories.destroy', $activityCategory)); ?>" method="POST" class="inline">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium">
                    Delete Category
                </button>
            </form>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Auto-generate slug from name (only if user hasn't manually edited)
document.getElementById('name').addEventListener('input', function() {
    const slugField = document.getElementById('slug');
    if (!slugField.dataset.manualEdit) {
        let slug = this.value.toLowerCase()
            .replace(/[^\w\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim();
        slugField.value = slug;
    }
});

// Mark slug as manually edited if user types in it
document.getElementById('slug').addEventListener('input', function() {
    this.dataset.manualEdit = 'true';
});

// Icon preview
document.getElementById('icon').addEventListener('input', function() {
    const iconClass = this.value.trim();
    const preview = document.getElementById('icon-preview');
    
    if (iconClass) {
        preview.innerHTML = `<i class="${iconClass}"></i>`;
    } else {
        preview.innerHTML = '<i class="fas fa-question"></i>';
    }
});

// Quick icon select buttons
document.querySelectorAll('.icon-btn').forEach(button => {
    button.addEventListener('click', function() {
        const iconClass = this.dataset.icon;
        const iconInput = document.getElementById('icon');
        const preview = document.getElementById('icon-preview');
        
        iconInput.value = iconClass;
        preview.innerHTML = `<i class="${iconClass}"></i>`;
        
        // Highlight selected button
        document.querySelectorAll('.icon-btn').forEach(btn => {
            btn.classList.remove('bg-green-200', 'border-green-500');
            btn.classList.add('bg-gray-100');
        });
        this.classList.remove('bg-gray-100');
        this.classList.add('bg-green-200', 'border-green-500');
    });
});

// Image preview
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    
    if (file) {
        // Check file size (2MB = 2097152 bytes)
        if (file.size > 2097152) {
            preview.innerHTML = `
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <p class="text-sm"><i class="fas fa-exclamation-triangle mr-2"></i>File size exceeds 2MB. Please choose a smaller image.</p>
                </div>
            `;
            this.value = '';
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.innerHTML = `
                <div>
                    <p class="text-xs text-gray-600 mb-2">New Image Preview:</p>
                    <div class="relative inline-block">
                        <img src="${e.target.result}" class="rounded-lg shadow-md border border-gray-300" 
                             style="max-width: 300px; max-height: 200px; object-fit: cover;">
                        <div class="absolute top-2 right-2 bg-green-500 text-white px-2 py-1 rounded text-xs font-bold">
                            <i class="fas fa-check mr-1"></i> New
                        </div>
                    </div>
                </div>
            `;
        }
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '';
    }
});

// Close modal on outside click
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        this.classList.add('hidden');
    }
});

// Form validation before submit
document.querySelector('form').addEventListener('submit', function(e) {
    const name = document.getElementById('name').value.trim();
    
    if (!name) {
        e.preventDefault();
        alert('Please enter a category name');
        document.getElementById('name').focus();
        return false;
    }
});
</script>
<?php $__env->stopPush(); ?>

<style>
.icon-btn {
    transition: all 0.2s ease;
}

.icon-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

#icon-preview {
    transition: all 0.3s ease;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\admin\activity-categories\edit.blade.php ENDPATH**/ ?>