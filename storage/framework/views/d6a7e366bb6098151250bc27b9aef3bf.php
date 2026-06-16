<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Safari Tours - Adventure Awaits'); ?></title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Discover amazing safari adventures in East Africa. Wildlife tours, cultural experiences, and unforgettable journeys await you.'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'safari, tours, wildlife, Africa, adventure, travel, booking'); ?>">
    <link rel="icon" type="image/png" href="<?php echo e(asset('images/browserlogo.jpeg')); ?>">

    
    <?php
        $hasQueryParams = request()->hasAny([
            'page', 'activity', 'category', 'tag', 'filter', 'search', 'sort', 'q'
        ]);
        $baseUrl = url(request()->path());
    ?>

    <?php if($hasQueryParams): ?>
        <meta name="robots" content="noindex, follow">
    <?php else: ?>
        <meta name="robots" content="index, follow">
    <?php endif; ?>

    <link rel="canonical" href="<?php echo $__env->yieldContent('canonical', $baseUrl); ?>" />
    <link rel="alternate" hreflang="en" href="<?php echo $__env->yieldContent('canonical', $baseUrl); ?>" />

    <!-- Open Graph Tags -->
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', 'Safari Tours - Adventure Awaits'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', 'Discover amazing safari adventures in East Africa.'); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('images/safari-og.jpg')); ?>">
    <meta property="og:url" content="<?php echo e($baseUrl); ?>">
    <meta property="og:type" content="website">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', 'Rwanda Budget Safaris'); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description'); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image', asset('images/safari-og.jpg')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo e(asset('build/assets/app-lVDNHE2B.css')); ?>">
    <script type="module" src="<?php echo e(asset('build/assets/app-BLNZwArW.js')); ?>"></script>

    <!-- Additional Styles -->
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Navigation Component -->
    <?php if (isset($component)) { $__componentOriginalcd6dfa97cd4704d24f53bf5968f88fee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcd6dfa97cd4704d24f53bf5968f88fee = $attributes; } ?>
<?php $component = App\View\Components\Navigation::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('navigation'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Navigation::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcd6dfa97cd4704d24f53bf5968f88fee)): ?>
<?php $attributes = $__attributesOriginalcd6dfa97cd4704d24f53bf5968f88fee; ?>
<?php unset($__attributesOriginalcd6dfa97cd4704d24f53bf5968f88fee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcd6dfa97cd4704d24f53bf5968f88fee)): ?>
<?php $component = $__componentOriginalcd6dfa97cd4704d24f53bf5968f88fee; ?>
<?php unset($__componentOriginalcd6dfa97cd4704d24f53bf5968f88fee); ?>
<?php endif; ?>

    <!-- Page Header Section -->
    <?php if (! empty(trim($__env->yieldContent('page-header')))): ?>
        <?php echo $__env->yieldContent('page-header'); ?>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="min-h-screen">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer Component -->
    <?php if (isset($component)) { $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $attributes; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Footer::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $attributes = $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $component = $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>

    <!-- Additional Scripts -->
    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views/layouts/app.blade.php ENDPATH**/ ?>