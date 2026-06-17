<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['images', 'columns' => 2]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['images', 'columns' => 2]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    // Handle both JSON string and array
    if (is_string($images)) {
        $images = json_decode($images, true);
    }
    $images = is_array($images) ? $images : [];
?>

<?php if(count($images) > 0): ?>
<div class="grid grid-cols-1 md:grid-cols-<?php echo e($columns); ?> gap-4 mb-6">
    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $imageData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $imagePath = is_array($imageData) ? ($imageData['image'] ?? '') : $imageData;
            $section = is_array($imageData) ? ($imageData['section'] ?? '') : '';
            $caption = is_array($imageData) ? ($imageData['caption'] ?? '') : '';
        ?>
        <?php if($imagePath): ?>
        <div class="inline-image-wrapper group">
            <div class="relative overflow-hidden rounded-lg shadow-md cursor-pointer" onclick="openSectionImageModal('<?php echo e(asset('storage/' . $imagePath)); ?>', '<?php echo e(addslashes($caption)); ?>', '<?php echo e(addslashes($section)); ?>')">
                <img src="<?php echo e(asset('storage/' . $imagePath)); ?>" 
                     alt="<?php echo e($caption ?: $section ?: 'Image'); ?>" 
                     class="w-full h-56 object-cover group-hover:scale-110 transition duration-300"
                     loading="lazy">
                
                <!-- Hover overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                    <div class="absolute bottom-0 left-0 right-0 p-3">
                        <i class="fas fa-search-plus text-white text-xl"></i>
                    </div>
                </div>
            </div>
            
            <?php if($section || $caption): ?>
            <div class="mt-2 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg p-3 border border-gray-200">
                <?php if($section): ?>
                <p class="text-sm font-semibold text-gray-800 mb-1">
                    <i class="fas fa-tag text-green-600 mr-1 text-xs"></i><?php echo e($section); ?>

                </p>
                <?php endif; ?>
                <?php if($caption): ?>
                <p class="text-xs text-gray-600 italic leading-relaxed"><?php echo e($caption); ?></p>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\components\section-images.blade.php ENDPATH**/ ?>