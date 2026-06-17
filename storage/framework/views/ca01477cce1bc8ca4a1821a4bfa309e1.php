

<?php $__env->startSection('title', $page->title); ?>
<?php $__env->startSection('meta_description', $page->meta_description); ?>
<?php $__env->startSection('meta_keywords', $page->focus_keyword); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gray-50">
    
    <section class="relative py-16 md:py-24 bg-cover bg-center bg-no-repeat"
             style="background-image: url('<?php echo e($page->featured_image ? asset('storage/' . $page->featured_image) : ''); ?>');">
        
        <div class="absolute inset-0 bg-black opacity-50"></div>
        
        <div class="relative z-10 container mx-auto px-4 text-center text-white">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold"><?php echo e($page->title); ?></h1>

                
                <nav class="mt-8 text-sm">
                    <ol class="flex justify-center space-x-2 text-green-200">
                        <li><a href="<?php echo e(route('index')); ?>" class="hover:text-white transition-colors">Home</a></li>
                        <li class="mx-2">/</li>
                        <li class="text-white"><?php echo e($page->title); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">
                
                <div class="p-6 md:p-12">
                    <?php $__empty_1 = true; $__currentLoopData = $page->blocks->sortBy('sort_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if($block->block_type === 'heading'): ?>
                            
                            <?php
                                $headingClasses = [
                                    'h1' => 'text-4xl md:text-5xl font-bold text-gray-900 mb-6',
                                    'h2' => 'text-3xl md:text-4xl font-bold text-gray-800 mb-4 mt-8',
                                    'h3' => 'text-2xl md:text-3xl font-semibold text-gray-800 mb-3 mt-6',
                                    'h4' => 'text-xl md:text-2xl font-semibold text-gray-700 mb-3 mt-5',
                                    'h5' => 'text-lg md:text-xl font-semibold text-gray-700 mb-2 mt-4',
                                    'h6' => 'text-base md:text-lg font-semibold text-gray-600 mb-2 mt-3',
                                ];
                            ?>
                            <<?php echo e($block->heading_level ?? 'h2'); ?> class="<?php echo e($headingClasses[$block->heading_level ?? 'h2']); ?>">
                                <?php echo e($block->content); ?>

                            </<?php echo e($block->heading_level ?? 'h2'); ?>>

                        <?php elseif($block->block_type === 'text'): ?>
                            
                            <div class="text-gray-700 leading-relaxed mb-6 prose prose-green max-w-none text-lg">
                                <?php echo $block->content; ?>

                            </div>

                        <?php elseif($block->block_type === 'list'): ?>
                            
                            <?php
                                $listType = $block->list_type ?? 'ul';
                                $listClasses = 'mb-6 space-y-2 text-gray-700 text-lg';
                            ?>
                            <?php if($listType === 'ul'): ?>
                                <ul class="list-disc list-inside <?php echo e($listClasses); ?> prose prose-green max-w-none">
                                    <?php echo $block->content; ?>

                                </ul>
                            <?php else: ?>
                                <ol class="list-decimal list-inside <?php echo e($listClasses); ?> prose prose-green max-w-none">
                                    <?php echo $block->content; ?>

                                </ol>
                            <?php endif; ?>

                        <?php elseif($block->block_type === 'image'): ?>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                                <?php $__currentLoopData = $block->images->sortBy('sort_order'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 group">
                                        <img src="<?php echo e(asset('storage/' . $image->image_path)); ?>" 
                                             alt="<?php echo e($image->alt_text ?? $page->title); ?>" 
                                             class="w-full h-56 md:h-64 object-cover transition-transform duration-300 group-hover:scale-105">
                                        <?php if($image->alt_text): ?>
                                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-sm p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                                <?php echo e($image->alt_text); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                        <?php elseif($block->block_type === 'links'): ?>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <?php $__currentLoopData = $block->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e($link->linked_page_url); ?>" 
                                       target="_blank" 
                                       rel="noopener noreferrer"
                                       class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200 hover:bg-green-50 hover:border-green-300 transition-all duration-300 group">
                                        <div class="flex-1">
                                            <h4 class="text-base font-semibold text-gray-800 group-hover:text-green-700 transition-colors">
                                                <?php echo e($link->linked_page_title); ?>

                                            </h4>
                                            <p class="text-sm text-gray-500 truncate"><?php echo e($link->linked_page_url); ?></p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-green-600 transition-colors ml-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="text-center py-12 text-gray-500">
                            <p>No content available for this page.</p>
                        </div>
                    <?php endif; ?>

                    
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-small p-8 md:p-10 text-center">
                            <h3 class="text-2xl font-bold text-gray-800 mb-3">Ready to Book Your Safari?</h3>
                            <p class="text-gray-600 text-lg mb-6">Contact us today and let our expert team help you plan the perfect African adventure.</p>
                            <a href="<?php echo e(route('contact')); ?>" 
                               class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-5 py-5 rounded font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                                
                                Request a Quote
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
.prose {
    max-width: none;
}
.prose p {
    margin-bottom: 1.25rem;
    font-size: 1.125rem;
    line-height: 1.8;
}
.prose ul, .prose ol {
    padding-left: 1.5rem;
    margin-bottom: 1.25rem;
}
.prose ul li, .prose ol li {
    margin-bottom: 0.5rem;
    font-size: 1.125rem;
    line-height: 1.8;
}
.prose a {
    color: #16a34a;
    text-decoration: underline;
}
.prose a:hover {
    color: #15803d;
    text-decoration: none;
}
.prose h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
    color: #1f2937;
}
.prose h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #1f2937;
}
.prose h4 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
    color: #374151;
}
.prose blockquote {
    border-left: 4px solid #16a34a;
    padding-left: 1.25rem;
    margin: 1.5rem 0;
    color: #4b5563;
    font-size: 1.125rem;
}
.prose code {
    background: #f3f4f6;
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.875rem;
}
.prose pre {
    background: #1f2937;
    color: #f3f4f6;
    padding: 1.25rem;
    border-radius: 0.5rem;
    overflow-x: auto;
    margin: 1.25rem 0;
}
</style>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\seo_pages\show.blade.php ENDPATH**/ ?>