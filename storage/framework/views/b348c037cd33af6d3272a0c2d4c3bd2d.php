<?php $__env->startSection('title', 'Edit Destination'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Edit Destination</h1>
            <p class="text-gray-600 mt-1">Modify destination details and inline content</p>
        </div>
        <a href="<?php echo e(route('admin.destinations.index')); ?>" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg flex items-center transition">
            <i class="fas fa-arrow-left mr-2"></i> Back to List
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-2"></i>
                <span><?php echo e(session('success')); ?></span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    
    <?php if(session('error')): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 flex items-center justify-between">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <span><?php echo e(session('error')); ?></span>
            </div>
            <button type="button" onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php endif; ?>

    
    <?php if($errors->any()): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <strong>Please fix the following errors:</strong>
            </div>
            <ul class="list-disc list-inside ml-4">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form id="destinationEditForm" action="<?php echo e(route('admin.destinations.update', $destination->id)); ?>" method="POST" enctype="multipart/form-data" class="bg-white shadow-lg rounded-lg">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="border-b border-gray-200">
            <nav class="flex -mb-px overflow-x-auto">
                <button type="button" class="tab-button active px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="basic">Basic Info</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="overview">Overview</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="activities">Activities</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="wildlife">Wildlife</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="geography">Geography</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="practical">Practical Info</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="accommodation">Accommodation</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="extras">Extras</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="images">Images</button>
                <button type="button" class="tab-button px-6 py-3 border-b-2 font-medium text-sm whitespace-nowrap" data-tab="seo">SEO</button>
            </nav>
        </div>

        <div class="p-6">
            <!-- Basic Info -->
            <div id="tab-basic" class="tab-content">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="country_id" class="block text-sm font-medium text-gray-700 mb-2">Country <span class="text-red-500">*</span></label>
                        <select name="country_id" id="country_id" required class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select Country</option>
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($country->id); ?>" <?php echo e(old('country_id', $destination->country_id) == $country->id ? 'selected' : ''); ?>>
                                    <?php echo $country->flag_icon; ?> <?php echo e($country->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Destination Name <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg" value="<?php echo e(old('name', $destination->name)); ?>" placeholder="e.g., Murchison Falls National Park">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL Slug</label>
                        <input type="text" name="slug" id="slug" class="w-full px-4 py-2 border border-gray-300 rounded-lg" value="<?php echo e(old('slug', $destination->slug)); ?>" placeholder="murchison-falls-national-park">
                        <p class="text-gray-500 text-xs mt-1">Leave empty to auto-generate from name</p>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Destination Type</label>
                        <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="">Select Type</option>
                            <?php $__currentLoopData = ['National Park','Wildlife Reserve','Forest Reserve','Game Reserve','Conservation Area','Wildlife Sanctuary','City','Lake','Mountain','Island']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($t); ?>" <?php echo e(old('type', $destination->type) == $t ? 'selected' : ''); ?>><?php echo e($t); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg" value="<?php echo e(old('sort_order', $destination->sort_order)); ?>">
                        <p class="text-gray-500 text-xs mt-1">Lower numbers appear first</p>
                    </div>
                </div>

                <div class="mt-6">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Short Description</label>
                    <textarea name="description" id="description" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Short overview..."><?php echo e(old('description', $destination->description)); ?></textarea>
                </div>

                <div class="mt-6 space-y-3">
                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded border-gray-300 text-green-600" <?php echo e(old('is_active', $destination->is_active) ? 'checked' : ''); ?>>
                        <div><span class="text-sm font-medium text-gray-700">Active</span><p class="text-xs text-gray-500">Visible on site</p></div>
                    </label>

                    <label class="flex items-center space-x-3 cursor-pointer">
                        <input type="checkbox" name="is_popular" value="1" class="w-5 h-5 rounded border-gray-300 text-green-600" <?php echo e(old('is_popular', $destination->is_popular) ? 'checked' : ''); ?>>
                        <div><span class="text-sm font-medium text-gray-700">Mark as Popular</span><p class="text-xs text-gray-500">Feature on homepage</p></div>
                    </label>
                </div>
            </div>

            
            <?php
                $sectionsList = [
                    'overview'      => ['label'=>'Detailed Overview',       'textarea'=>'detailed_overview'],
                    'activities'    => ['label'=>'Activities',              'textarea'=>'what_to_see_do'],
                    'wildlife'      => ['label'=>'Wildlife Highlights',     'textarea'=>'wildlife_highlights'],
                    'geography'     => ['label'=>'Geography & Landscape',   'textarea'=>'geography_landscape'],
                    'practical'     => ['label'=>'Practical Information',   'textarea'=>'practical_information'],
                    'accommodation' => ['label'=>'Accommodation Options',   'textarea'=>'accommodation_options'],
                    'extras'        => ['label'=>'Additional Information',  'textarea'=>'interesting_facts'],
                ];
            ?>

            <?php $__currentLoopData = $sectionsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionKey => $cfg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $textareaId   = $cfg['textarea'];
                    $initialText  = old($textareaId, '');
                    $sectionsContent = $destination->sections_content ?? [];
                    $blockMetadata   = [];

                    if (empty($initialText)) {
                        if (!empty($sectionsContent[$sectionKey]) && is_array($sectionsContent[$sectionKey])) {
                            $parts = [];
                            foreach ($sectionsContent[$sectionKey] as $block) {
                                $type    = $block['type'] ?? 'text';
                                $blockId = $block['id']   ?? 'blk-' . Str::uuid();

                                if ($type === 'heading')    { $parts[] = '# '  . ($block['text'] ?? ''); }
                                elseif ($type === 'subheading') { $parts[] = '## ' . ($block['text'] ?? ''); }
                                elseif ($type === 'text')   { $parts[] = $block['text'] ?? ''; }
                                elseif ($type === 'image')  {
                                    $mediaId = $block['media_id'] ?? null;
                                    $caption = $block['caption']  ?? '';
                                    if ($mediaId) {
                                        $token  = "block-{$blockId}";
                                        $parts[] = "[[image:{$token}|{$caption}]]";
                                        $blockMetadata[$token] = [
                                            'block_id' => $blockId,
                                            'media_id' => $mediaId,
                                            'caption'  => $caption,
                                        ];
                                    }
                                }
                            }
                            $initialText = implode("\n\n", $parts);
                        } else {
                            $initialText = old($textareaId, $destination->{$textareaId} ?? '');
                        }
                    }
                ?>

                <div id="tab-<?php echo e($sectionKey); ?>" class="tab-content <?php echo e($sectionKey !== 'overview' ? 'hidden' : ''); ?>" data-section="<?php echo e($sectionKey); ?>" data-block-metadata="<?php echo e(json_encode($blockMetadata)); ?>">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4"><?php echo e($cfg['label']); ?></h2>

                    <div>
                        <label for="<?php echo e($textareaId); ?>" class="block text-sm font-medium text-gray-700 mb-2"><?php echo e($cfg['label']); ?> Content</label>
                        <textarea name="<?php echo e($textareaId); ?>" id="<?php echo e($textareaId); ?>" rows="12" class="section-textarea w-full px-4 py-2 border border-gray-300 rounded-lg font-mono text-sm" placeholder="Write content..."><?php echo e($initialText); ?></textarea>
                        <p class="text-gray-500 text-xs mt-1">Use headings (# Heading), subheadings (## Subheading), and paragraphs. Click "Add Image" button below to insert images.</p>
                    </div>

                    <div class="mt-4">
                        <div class="flex flex-wrap gap-2 items-center mb-3">
                            <button type="button" class="px-3 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 insert-heading" data-section="<?php echo e($sectionKey); ?>">
                                <i class="fas fa-heading mr-1"></i> Add Heading
                            </button>
                            <button type="button" class="px-3 py-2 bg-indigo-500 text-white rounded-lg hover:bg-indigo-600 insert-subheading" data-section="<?php echo e($sectionKey); ?>">
                                <i class="fas fa-heading mr-1 text-sm"></i> Add Subheading
                            </button>
                            <button type="button" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 insert-image" data-section="<?php echo e($sectionKey); ?>">
                                <i class="fas fa-image mr-1"></i> Add Image
                            </button>
                            <button type="button" class="px-3 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 insert-icon" data-section="<?php echo e($sectionKey); ?>">
                                <i class="fas fa-icons mr-1"></i> Add Icon
                            </button>
                        </div>

                        
                        <div id="section-uploads-<?php echo e($sectionKey); ?>" class="space-y-4 mb-4">
                            <?php if(!empty($sectionsContent[$sectionKey]) && is_array($sectionsContent[$sectionKey])): ?>
                                <?php $__currentLoopData = $sectionsContent[$sectionKey]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $block): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty($block['type']) && $block['type'] === 'image' && !empty($block['media_id'])): ?>
                                        <?php
                                            $img     = \App\Models\DestinationImage::find($block['media_id']);
                                            $url     = $img ? ($img->thumbnail_path ? asset('storage/' . $img->thumbnail_path) : asset('storage/' . $img->storage_path)) : null;
                                            $blockId = $block['id'] ?? 'blk-' . Str::uuid();
                                            $tokenId = "block-{$blockId}";
                                        ?>
                                        <div class="bg-gray-50 border-2 border-gray-200 rounded-lg p-4 existing-upload"
                                             data-block-id="<?php echo e($blockId); ?>"
                                             data-token-id="<?php echo e($tokenId); ?>"
                                             data-media-id="<?php echo e($block['media_id']); ?>">
                                            <div class="flex items-start gap-4">
                                                <div class="w-32 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                                    <?php if($url): ?>
                                                        <img src="<?php echo e($url); ?>" class="w-full h-full object-cover">
                                                    <?php else: ?>
                                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                            <i class="fas fa-image text-3xl"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="flex-1">
                                                    <label class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                                                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg caption-input" value="<?php echo e($block['caption'] ?? ''); ?>" placeholder="Enter caption (optional)">
                                                    <div class="mt-3">
                                                        <label class="block text-sm font-medium text-gray-700 mb-2">Replace Image</label>
                                                        <input type="file" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 replace-upload-file" data-media-id="<?php echo e($block['media_id']); ?>" data-block-id="<?php echo e($blockId); ?>" name="sections[<?php echo e($sectionKey); ?>][uploads][media-<?php echo e($block['media_id']); ?>]">
                                                    </div>
                                                </div>
                                                <button type="button" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm remove-existing-media" data-media-id="<?php echo e($block['media_id']); ?>" data-block-id="<?php echo e($blockId); ?>">
                                                    <i class="fas fa-trash mr-1"></i> Remove
                                                </button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>

                        
                        <input type="hidden" data-contentblock-input name="sections[<?php echo e($sectionKey); ?>][content_blocks]" value="">
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Images tab -->
            <div id="tab-images" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Images & Media</h2>

                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Main Thumbnail Image</label>
                    <input type="file" name="image" id="image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-gray-500 text-xs mt-1">Used in listings. Recommended: 800x600px, Max: 2MB</p>
                    <div id="image-preview" class="mt-3">
                        <?php if($destination->image): ?>
                            <img src="<?php echo e(asset('storage/' . $destination->image)); ?>" class="w-64 h-40 object-cover rounded">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">Featured Header Image</label>
                    <input type="file" name="featured_image" id="featured_image" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-gray-500 text-xs mt-1">Hero/header. Recommended: 1920x1080px, Max: 5MB</p>
                    <div id="featured-preview" class="mt-3">
                        <?php if($destination->featured_image): ?>
                            <img src="<?php echo e(asset('storage/' . $destination->featured_image)); ?>" class="w-96 h-64 object-cover rounded">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                    <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                    <p class="text-gray-500 text-xs mt-1">Multiple images for photo gallery. Max: 2MB each</p>
                    <div id="gallery-preview" class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-4">
                        <?php if(!empty($destination->gallery_images) && is_array($destination->gallery_images)): ?>
                            <?php $__currentLoopData = $destination->gallery_images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="relative"><img src="<?php echo e(asset('storage/' . $g['image'])); ?>" class="w-full h-32 object-cover rounded"></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- ============================================================
                 SEO TAB  –  keyword picker replaces the old free-text input
                 ============================================================ -->
            <div id="tab-seo" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">SEO & Meta Information</h2>
                <div class="space-y-6">

                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="meta_title" id="meta_title" maxlength="60"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                               value="<?php echo e(old('meta_title', $destination->meta_title)); ?>">
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="3" maxlength="160"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg"><?php echo e(old('meta_description', $destination->meta_description)); ?></textarea>
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Meta Keywords</label>
                        <p class="text-xs text-gray-500 mb-3">
                            Tick the keywords you want to use. They will be joined automatically.
                            You can also type extra keywords in the box at the bottom.
                        </p>

                        
                        <div class="relative mb-3">
                            <input type="text" id="kwSearch"
                                   placeholder="Filter keywords…"
                                   class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-400 focus:outline-none">
                            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        </div>

                        
                        <div class="flex gap-3 mb-3">
                            <button type="button" id="kwSelectAll"
                                    class="text-xs px-3 py-1 bg-green-100 text-green-700 border border-green-300 rounded-lg hover:bg-green-200 transition">
                                <i class="fas fa-check-double mr-1"></i> Select all visible
                            </button>
                            <button type="button" id="kwClearAll"
                                    class="text-xs px-3 py-1 bg-red-100 text-red-700 border border-red-300 rounded-lg hover:bg-red-200 transition">
                                <i class="fas fa-times mr-1"></i> Clear all
                            </button>
                            <span id="kwCount" class="text-xs text-gray-500 self-center ml-auto">0 selected</span>
                        </div>

                        
                        <div id="kwGrid"
                             class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2 max-h-72 overflow-y-auto border border-gray-200 rounded-lg p-3 bg-gray-50">

                            <?php
                                /* All 40 built-in keywords */
                                $builtInKeywords = [
                                    'book Uganda wildlife safari',
                                    'Uganda safari tour packages',
                                    'cheap Uganda safari tours',
                                    'Uganda safari deals',
                                    'luxury Uganda safari',
                                    'private Uganda safari tour',
                                    'all inclusive Uganda safari',
                                    'Uganda multi day safari package',
                                    'book Uganda gorilla trekking',
                                    'Uganda gorilla trekking permit',
                                    'Uganda gorilla trek booking',
                                    'cheap Uganda gorilla trekking',
                                    'Uganda gorilla safari package',
                                    'gorilla trek Uganda',
                                    'Chimpanzee Tracking',
                                    'book Uganda chimpanzee tracking',
                                    'Uganda chimpanzee tour',
                                    'Uganda chimpanzee safari',
                                    'chimpanzee trekking Uganda',
                                    'book Uganda birding safari',
                                    'Uganda bird watching tour',
                                    'Uganda birding package',
                                    'Boat/River Safaris',
                                    'book boat safari Uganda',
                                    'Uganda boat cruise deals',
                                    'Uganda river safari package',
                                    'Walking Safaris',
                                    'book walking safari Uganda',
                                    'Uganda walking safari tour',
                                    'Photography Safaris',
                                    'book Uganda photography safari',
                                    'Uganda wildlife photography tour',
                                    'Uganda cultural tour',
                                    'Uganda community safari booking',
                                    'Uganda village tour packages',
                                    'Uganda safari package deals',
                                    'Uganda safari tours booking',
                                    'Uganda safari package',
                                    'Uganda luxury safari deals',
                                    'Uganda cheap safari package',
                                ];

                                /* Keywords already saved on this destination */
                                $savedKeywords = old('meta_keywords', $destination->meta_keywords ?? '');
                                $savedList     = array_map('trim', explode(',', $savedKeywords));
                            ?>

                            <?php $__currentLoopData = $builtInKeywords; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kw): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="kw-item flex items-center gap-2 px-3 py-2 bg-white border border-gray-200 rounded-lg cursor-pointer hover:border-green-400 hover:bg-green-50 transition text-sm select-none"
                                       data-label="<?php echo e(strtolower($kw)); ?>">
                                    <input type="checkbox"
                                           class="kw-checkbox w-4 h-4 rounded border-gray-300 text-green-600 focus:ring-green-400"
                                           value="<?php echo e($kw); ?>"
                                           <?php echo e(in_array($kw, $savedList) ? 'checked' : ''); ?>>
                                    <span><?php echo e($kw); ?></span>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <div class="mt-4">
                            <label for="kwExtra" class="block text-xs font-medium text-gray-600 mb-1">
                                Add extra keywords <span class="font-normal text-gray-400">(comma-separated)</span>
                            </label>
                            <input type="text" id="kwExtra"
                                   placeholder="e.g. Uganda safari 2026, gorilla permit cost"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-green-400 focus:outline-none"
                                   value="">
                        </div>

                        
                        <div class="mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-xs font-medium text-blue-700 mb-1"><i class="fas fa-eye mr-1"></i> Keywords preview:</p>
                            <p id="kwPreview" class="text-xs text-blue-600 break-words italic">None selected yet.</p>
                        </div>

                        
                        <input type="hidden" name="meta_keywords" id="meta_keywords"
                               value="<?php echo e(old('meta_keywords', $destination->meta_keywords)); ?>">
                    </div>
                    

                </div>
            </div>
            

        </div>

        <div class="border-t bg-gray-50 px-6 py-4 flex justify-between items-center rounded-b-lg">
            <a href="<?php echo e(route('admin.destinations.index')); ?>" class="text-gray-600 hover:text-gray-800 font-medium">
                <i class="fas fa-times mr-1"></i> Cancel
            </a>
            <div class="flex gap-3">
                <button type="button" id="saveDraftBtn" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg font-medium">Save Draft</button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition flex items-center shadow-md">
                    <i class="fas fa-save mr-2"></i> Save Changes
                </button>
            </div>
        </div>
    </form>
</div>


<div id="iconPickerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-hidden">
        <div class="bg-gradient-to-r from-purple-600 to-indigo-600 text-white px-6 py-4 flex items-center justify-between">
            <h3 class="text-xl font-bold"><i class="fas fa-icons mr-2"></i> Choose an Icon</h3>
            <button type="button" id="closeIconPicker" class="text-white hover:text-gray-200">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>
        <div class="p-4">
            <input type="text" id="iconSearch" placeholder="Search icons… (e.g., 'star', 'animal', 'tree')"
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-4 focus:ring-2 focus:ring-purple-500">
            <div id="iconGrid" class="grid grid-cols-6 sm:grid-cols-8 md:grid-cols-10 gap-3 overflow-y-auto max-h-[60vh] p-2">
                <!-- Icons injected by JS -->
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ─────────────────────────────────────────────────────────────
       HELPERS
       ───────────────────────────────────────────────────────────── */
    function uuid() {
        return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
            const r = Math.random() * 16 | 0, v = c === 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
        });
    }
    function tempId() { return 'tmp-' + Math.random().toString(36).substr(2, 9); }
    function insertAtCursor(textarea, text) {
        const s = textarea.selectionStart, e = textarea.selectionEnd, v = textarea.value;
        textarea.value = v.slice(0, s) + text + v.slice(e);
        textarea.selectionStart = textarea.selectionEnd = s + text.length;
        textarea.focus();
    }
    function slugify(v) { return v.toLowerCase().replace(/[^\w\s-]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-').trim(); }

    /* ─────────────────────────────────────────────────────────────
       KEYWORD PICKER
       ───────────────────────────────────────────────────────────── */
    const kwCheckboxes = document.querySelectorAll('.kw-checkbox');
    const kwHidden     = document.getElementById('meta_keywords');
    const kwPreview    = document.getElementById('kwPreview');
    const kwCount      = document.getElementById('kwCount');
    const kwExtra      = document.getElementById('kwExtra');

    /* Populate extra box with any saved keywords NOT in the built-in list */
    (function seedExtraBox() {
        if (!kwHidden.value.trim()) return;
        const builtIn  = Array.from(kwCheckboxes).map(c => c.value.trim().toLowerCase());
        const saved    = kwHidden.value.split(',').map(k => k.trim()).filter(Boolean);
        const extra    = saved.filter(k => !builtIn.includes(k.toLowerCase()));
        if (extra.length) kwExtra.value = extra.join(', ');
    })();

    function syncKeywords() {
        const checked = Array.from(kwCheckboxes)
            .filter(c => c.checked)
            .map(c => c.value.trim());

        const extras = kwExtra.value
            .split(',')
            .map(k => k.trim())
            .filter(Boolean);

        const all = [...new Set([...checked, ...extras])];

        kwHidden.value = all.join(', ');
        kwPreview.textContent = all.length ? all.join(', ') : 'None selected yet.';
        kwCount.textContent   = checked.length + ' selected';

        /* Highlight checked labels */
        kwCheckboxes.forEach(cb => {
            cb.closest('label').classList.toggle('border-green-400', cb.checked);
            cb.closest('label').classList.toggle('bg-green-50',      cb.checked);
        });
    }

    kwCheckboxes.forEach(cb => cb.addEventListener('change', syncKeywords));
    kwExtra.addEventListener('input', syncKeywords);

    /* Filter / search */
    document.getElementById('kwSearch').addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.kw-item').forEach(item => {
            item.style.display = item.dataset.label.includes(q) ? '' : 'none';
        });
    });

    /* Select all visible */
    document.getElementById('kwSelectAll').addEventListener('click', function () {
        document.querySelectorAll('.kw-item').forEach(item => {
            if (item.style.display !== 'none') {
                item.querySelector('.kw-checkbox').checked = true;
            }
        });
        syncKeywords();
    });

    /* Clear all */
    document.getElementById('kwClearAll').addEventListener('click', function () {
        kwCheckboxes.forEach(cb => cb.checked = false);
        kwExtra.value = '';
        syncKeywords();
    });

    /* Run once on load to reflect pre-checked boxes */
    syncKeywords();

    /* ─────────────────────────────────────────────────────────────
       SECTION BLOCK METADATA
       ───────────────────────────────────────────────────────────── */
    const sectionBlockMetadata = {};
    document.querySelectorAll('[data-block-metadata]').forEach(tab => {
        const section = tab.dataset.section;
        try { sectionBlockMetadata[section] = JSON.parse(tab.dataset.blockMetadata || '{}'); }
        catch (e) { sectionBlockMetadata[section] = {}; }
    });

    /* ─────────────────────────────────────────────────────────────
       ICON DATABASE
       ───────────────────────────────────────────────────────────── */
    const iconDatabase = [
        { name:'paw',           icon:'fas fa-paw',                 category:'animals',       keywords:'animal pet dog cat' },
        { name:'horse',         icon:'fas fa-horse',               category:'animals',       keywords:'animal wildlife' },
        { name:'dove',          icon:'fas fa-dove',                category:'animals',       keywords:'bird animal' },
        { name:'fish',          icon:'fas fa-fish',                category:'animals',       keywords:'water animal' },
        { name:'frog',          icon:'fas fa-frog',                category:'animals',       keywords:'water animal' },
        { name:'hippo',         icon:'fas fa-hippo',               category:'animals',       keywords:'animal wildlife' },
        { name:'crow',          icon:'fas fa-crow',                category:'animals',       keywords:'bird animal' },
        { name:'spider',        icon:'fas fa-spider',              category:'animals',       keywords:'insect animal' },
        { name:'dragon',        icon:'fas fa-dragon',              category:'animals',       keywords:'animal mythical' },
        { name:'tree',          icon:'fas fa-tree',                category:'nature',        keywords:'forest plant nature' },
        { name:'leaf',          icon:'fas fa-leaf',                category:'nature',        keywords:'plant nature green' },
        { name:'seedling',      icon:'fas fa-seedling',            category:'nature',        keywords:'plant nature grow' },
        { name:'mountain',      icon:'fas fa-mountain',            category:'nature',        keywords:'landscape hill' },
        { name:'water',         icon:'fas fa-water',               category:'nature',        keywords:'river lake ocean' },
        { name:'sun',           icon:'fas fa-sun',                 category:'nature',        keywords:'weather day' },
        { name:'moon',          icon:'fas fa-moon',                category:'nature',        keywords:'weather night' },
        { name:'cloud',         icon:'fas fa-cloud',               category:'nature',        keywords:'weather sky' },
        { name:'snowflake',     icon:'fas fa-snowflake',           category:'nature',        keywords:'weather cold' },
        { name:'fire',          icon:'fas fa-fire',                category:'nature',        keywords:'hot flame' },
        { name:'map-marker',    icon:'fas fa-map-marker-alt',      category:'location',      keywords:'location place pin' },
        { name:'map',           icon:'fas fa-map',                 category:'location',      keywords:'location navigation' },
        { name:'compass',       icon:'fas fa-compass',             category:'location',      keywords:'direction navigation' },
        { name:'globe',         icon:'fas fa-globe-africa',        category:'location',      keywords:'world earth africa' },
        { name:'route',         icon:'fas fa-route',               category:'location',      keywords:'path direction' },
        { name:'plane',         icon:'fas fa-plane',               category:'travel',        keywords:'flight travel airplane' },
        { name:'car',           icon:'fas fa-car',                 category:'travel',        keywords:'vehicle travel' },
        { name:'bus',           icon:'fas fa-bus',                 category:'travel',        keywords:'vehicle travel transport' },
        { name:'suitcase',      icon:'fas fa-suitcase-rolling',    category:'travel',        keywords:'luggage travel' },
        { name:'passport',      icon:'fas fa-passport',            category:'travel',        keywords:'travel document' },
        { name:'hotel',         icon:'fas fa-hotel',               category:'accommodation', keywords:'lodge stay accommodation' },
        { name:'bed',           icon:'fas fa-bed',                 category:'accommodation', keywords:'sleep rest accommodation' },
        { name:'campground',    icon:'fas fa-campground',          category:'accommodation', keywords:'camping tent outdoor' },
        { name:'home',          icon:'fas fa-home',                category:'accommodation', keywords:'house building' },
        { name:'building',      icon:'fas fa-building',            category:'accommodation', keywords:'hotel structure' },
        { name:'binoculars',    icon:'fas fa-binoculars',          category:'activities',    keywords:'safari viewing wildlife' },
        { name:'camera',        icon:'fas fa-camera',              category:'activities',    keywords:'photo photography' },
        { name:'hiking',        icon:'fas fa-hiking',              category:'activities',    keywords:'walking trek' },
        { name:'swimming',      icon:'fas fa-swimming-pool',       category:'activities',    keywords:'pool water' },
        { name:'biking',        icon:'fas fa-biking',              category:'activities',    keywords:'cycling bicycle' },
        { name:'utensils',      icon:'fas fa-utensils',            category:'food',          keywords:'food restaurant dining' },
        { name:'coffee',        icon:'fas fa-coffee',              category:'food',          keywords:'drink cafe' },
        { name:'wine',          icon:'fas fa-wine-glass',          category:'food',          keywords:'drink bar' },
        { name:'apple',         icon:'fas fa-apple-alt',           category:'food',          keywords:'fruit food' },
        { name:'dollar',        icon:'fas fa-dollar-sign',         category:'money',         keywords:'money price cost fee' },
        { name:'money',         icon:'fas fa-money-bill-wave',     category:'money',         keywords:'cash payment' },
        { name:'credit-card',   icon:'fas fa-credit-card',         category:'money',         keywords:'payment card' },
        { name:'coins',         icon:'fas fa-coins',               category:'money',         keywords:'money currency' },
        { name:'medkit',        icon:'fas fa-briefcase-medical',   category:'health',        keywords:'medical health first-aid' },
        { name:'shield',        icon:'fas fa-shield-alt',          category:'safety',        keywords:'protection security safe' },
        { name:'heartbeat',     icon:'fas fa-heartbeat',           category:'health',        keywords:'medical health' },
        { name:'pills',         icon:'fas fa-pills',               category:'health',        keywords:'medicine medication' },
        { name:'phone',         icon:'fas fa-phone',               category:'communication', keywords:'call contact' },
        { name:'envelope',      icon:'fas fa-envelope',            category:'communication', keywords:'email mail message' },
        { name:'wifi',          icon:'fas fa-wifi',                category:'communication', keywords:'internet connection' },
        { name:'mobile',        icon:'fas fa-mobile-alt',          category:'communication', keywords:'cellphone smartphone' },
        { name:'clock',         icon:'fas fa-clock',               category:'time',          keywords:'time hours' },
        { name:'calendar',      icon:'fas fa-calendar-alt',        category:'time',          keywords:'date schedule booking' },
        { name:'calendar-check',icon:'fas fa-calendar-check',      category:'time',          keywords:'booking reservation' },
        { name:'temp-high',     icon:'fas fa-temperature-high',    category:'weather',       keywords:'hot warm' },
        { name:'temp-low',      icon:'fas fa-temperature-low',     category:'weather',       keywords:'cold cool' },
        { name:'umbrella',      icon:'fas fa-umbrella',            category:'weather',       keywords:'rain protection' },
        { name:'star',          icon:'fas fa-star',                category:'general',       keywords:'favorite rating luxury' },
        { name:'heart',         icon:'fas fa-heart',               category:'general',       keywords:'love favorite' },
        { name:'check',         icon:'fas fa-check-circle',        category:'general',       keywords:'correct yes done' },
        { name:'info',          icon:'fas fa-info-circle',         category:'general',       keywords:'information help' },
        { name:'warning',       icon:'fas fa-exclamation-triangle',category:'general',       keywords:'alert danger caution' },
        { name:'ban',           icon:'fas fa-ban',                 category:'general',       keywords:'prohibited forbidden no' },
        { name:'eye',           icon:'fas fa-eye',                 category:'general',       keywords:'view see watch' },
        { name:'users',         icon:'fas fa-users',               category:'general',       keywords:'people group family' },
        { name:'user',          icon:'fas fa-user',                category:'general',       keywords:'person profile' },
        { name:'arrow-right',   icon:'fas fa-arrow-right',         category:'general',       keywords:'direction next' },
        { name:'arrow-left',    icon:'fas fa-arrow-left',          category:'general',       keywords:'direction back' },
        { name:'bookmark',      icon:'fas fa-bookmark',            category:'general',       keywords:'save mark' },
        { name:'gift',          icon:'fas fa-gift',                category:'general',       keywords:'present package' },
    ];

    let currentIconTextarea = null;

    function renderIconGrid(filter) {
        const grid = document.getElementById('iconGrid');
        const list = filter
            ? iconDatabase.filter(i => i.name.includes(filter) || i.keywords.includes(filter) || i.category.includes(filter))
            : iconDatabase;

        grid.innerHTML = list.map(item => `
            <div class="icon-item flex flex-col items-center justify-center p-3 border-2 border-gray-200 rounded-lg hover:border-purple-500 hover:bg-purple-50 cursor-pointer transition" data-icon="${item.icon}" title="${item.name}">
                <i class="${item.icon} text-2xl text-gray-700 mb-1"></i>
                <span class="text-xs text-gray-600 text-center">${item.name}</span>
            </div>`).join('');

        grid.querySelectorAll('.icon-item').forEach(el => {
            el.addEventListener('click', function () { insertIcon(this.dataset.icon); });
        });
    }

    function openIconPicker(textarea) {
        currentIconTextarea = textarea;
        renderIconGrid('');
        document.getElementById('iconPickerModal').classList.remove('hidden');
        document.getElementById('iconSearch').focus();
    }

    document.getElementById('closeIconPicker').addEventListener('click', () => {
        document.getElementById('iconPickerModal').classList.add('hidden');
        currentIconTextarea = null;
    });
    document.getElementById('iconPickerModal').addEventListener('click', function (e) {
        if (e.target === this) { this.classList.add('hidden'); currentIconTextarea = null; }
    });
    document.getElementById('iconSearch').addEventListener('input', function () {
        renderIconGrid(this.value.toLowerCase());
    });

    function insertIcon(iconClass) {
        if (!currentIconTextarea) return;
        insertAtCursor(currentIconTextarea, `[[icon:${iconClass}]] `);
        document.getElementById('iconPickerModal').classList.add('hidden');
        currentIconTextarea = null;
    }

    /* ─────────────────────────────────────────────────────────────
       TABS
       ───────────────────────────────────────────────────────────── */
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.tab-button').forEach(b => {
                b.classList.remove('active', 'border-green-500', 'text-green-600');
                b.classList.add('border-transparent', 'text-gray-500');
            });
            this.classList.add('active', 'border-green-500', 'text-green-600');
            this.classList.remove('border-transparent', 'text-gray-500');
            document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
            const el = document.getElementById('tab-' + this.dataset.tab);
            if (el) el.classList.remove('hidden');
        });
    });

    /* ─────────────────────────────────────────────────────────────
       SLUG AUTO-GENERATE
       ───────────────────────────────────────────────────────────── */
    const nameInput = document.getElementById('name'), slugInput = document.getElementById('slug');
    if (nameInput && slugInput) {
        nameInput.addEventListener('input', () => { if (!slugInput.dataset.manualEdit) slugInput.value = slugify(nameInput.value); });
        slugInput.addEventListener('input', () => slugInput.dataset.manualEdit = 'true');
    }

    /* ─────────────────────────────────────────────────────────────
       SECTION TOOLBAR BUTTONS
       ───────────────────────────────────────────────────────────── */
    document.querySelectorAll('.insert-heading').forEach(btn => btn.addEventListener('click', function () {
        const ta = document.querySelector(`#tab-${this.dataset.section} .section-textarea`);
        insertAtCursor(ta, `\n# Heading Text Here\n\n`);
    }));

    document.querySelectorAll('.insert-subheading').forEach(btn => btn.addEventListener('click', function () {
        const ta = document.querySelector(`#tab-${this.dataset.section} .section-textarea`);
        insertAtCursor(ta, `\n## Subheading Text Here\n\n`);
    }));

    document.querySelectorAll('.insert-icon').forEach(btn => btn.addEventListener('click', function () {
        const ta = document.querySelector(`#tab-${this.dataset.section} .section-textarea`);
        openIconPicker(ta);
    }));

    /* ─────────────────────────────────────────────────────────────
       ADD IMAGE
       ───────────────────────────────────────────────────────────── */
    document.querySelectorAll('.insert-image').forEach(btn => btn.addEventListener('click', function () {
        const section   = this.dataset.section;
        const ta        = document.querySelector(`#tab-${section} .section-textarea`);
        const container = document.getElementById('section-uploads-' + section);
        const tmp       = tempId();
        const token     = `[[image:${tmp}|]]`;

        insertAtCursor(ta, `\n${token}\n\n`);

        const wrapper = document.createElement('div');
        wrapper.className = 'bg-blue-50 border-2 border-blue-300 rounded-lg p-4 new-upload';
        wrapper.dataset.tmpId = tmp;
        wrapper.innerHTML = `
            <div class="flex items-start gap-4">
                <div class="w-32 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                    <img id="upload-preview-${tmp}" src="" class="w-full h-full object-cover" style="display:none">
                    <div id="upload-placeholder-${tmp}" class="w-full h-full flex items-center justify-center text-gray-400">
                        <i class="fas fa-image text-3xl"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Upload Image *</label>
                    <input type="file" accept="image/*" required name="sections[${section}][uploads][${tmp}]"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100 upload-file-input mb-3">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg caption-input" placeholder="Enter caption (optional)">
                </div>
                <button type="button" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm remove-upload">
                    <i class="fas fa-trash mr-1"></i> Remove
                </button>
            </div>`;

        container.appendChild(wrapper);

        wrapper.querySelector('.upload-file-input').addEventListener('change', function () {
            const f = this.files[0];
            if (!f) return;
            if (f.size > 2 * 1024 * 1024) { alert('Image exceeds 2MB'); this.value = ''; return; }
            const reader = new FileReader();
            reader.onload = ev => {
                const img = document.getElementById('upload-preview-' + tmp);
                const ph  = document.getElementById('upload-placeholder-' + tmp);
                img.src = ev.target.result; img.style.display = 'block';
                if (ph) ph.style.display = 'none';
            };
            reader.readAsDataURL(f);
        });

        wrapper.querySelector('.remove-upload').addEventListener('click', function () {
            wrapper.remove();
            ta.value = ta.value.replace(new RegExp(`\\[\\[image:${tmp}(?:\\|[^\\]]*)?\\]\\]`, 'g'), '');
        });

        wrapper.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }));

    /* ─────────────────────────────────────────────────────────────
       REPLACE / REMOVE EXISTING MEDIA
       ───────────────────────────────────────────────────────────── */
    document.querySelectorAll('.replace-upload-file').forEach(input => {
        input.addEventListener('change', function () {
            const wrapper = this.closest('.existing-upload');
            const reader  = new FileReader();
            reader.onload = ev => { const img = wrapper.querySelector('img'); if (img) img.src = ev.target.result; };
            if (this.files[0]) reader.readAsDataURL(this.files[0]);
        });
    });

    document.querySelectorAll('.remove-existing-media').forEach(btn => {
        btn.addEventListener('click', function () {
            const mediaId    = this.dataset.mediaId;
            const blockId    = this.dataset.blockId;
            const wrapper    = this.closest('.existing-upload');
            const sectionTab = this.closest('.tab-content');
            const sectionKey = sectionTab.dataset.section;
            const ta         = sectionTab.querySelector('.section-textarea');
            const tokenId    = wrapper.dataset.tokenId;

            ta.value = ta.value.replace(new RegExp(`\\[\\[image:${tokenId}(?:\\|[^\\]]*)?\\]\\]`, 'g'), '');
            wrapper.remove();

            const delInput = document.createElement('input');
            delInput.type  = 'hidden';
            delInput.name  = `sections[${sectionKey}][delete_media][]`;
            delInput.value = mediaId;
            sectionTab.appendChild(delInput);
        });
    });

    /* ─────────────────────────────────────────────────────────────
       SAVE DRAFT
       ───────────────────────────────────────────────────────────── */
    const saveDraftBtn = document.getElementById('saveDraftBtn');
    saveDraftBtn && saveDraftBtn.addEventListener('click', async function () {
        buildAndAttachSectionContentBlocks();
        const formEl = document.getElementById('destinationEditForm');
        const fd     = new FormData(formEl);
        fd.append('draft', '1');

        saveDraftBtn.disabled = true;
        const orig = saveDraftBtn.innerHTML;
        saveDraftBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving…';

        try {
            const resp = await fetch(formEl.action, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: fd,
            });
            const json = await resp.json().catch(() => null);
            alert(resp.ok && json && json.success ? 'Draft saved successfully.' : 'Failed to save draft.');
        } catch (err) {
            alert('Network error.');
        } finally {
            saveDraftBtn.disabled = false;
            saveDraftBtn.innerHTML = orig;
        }
    });

    /* ─────────────────────────────────────────────────────────────
       BUILD SECTION CONTENT BLOCKS (JSON)
       ───────────────────────────────────────────────────────────── */
    function buildAndAttachSectionContentBlocks() {
        document.querySelectorAll('.tab-content[data-section]').forEach(tab => {
            const sectionKey = tab.dataset.section;
            const ta         = tab.querySelector('.section-textarea');
            if (!ta) return;

            const blocks  = [];
            const text    = ta.value || '';
            const lines   = text.replace(/\r\n/g, '\n').split('\n');
            let   paragraphBuffer = [];

            function flushParagraph() {
                const joined = paragraphBuffer.join('\n').trim();
                if (joined) blocks.push({ id: 'blk-' + uuid(), type: 'text', text: joined });
                paragraphBuffer = [];
            }

            const tokenRe = /\[\[image:(tmp-[a-z0-9]+|block-[a-z0-9\-]+|media-[0-9]+)(?:\|([^\]]*))?\]\]/ig;

            lines.forEach(line => {
                const l = line.trim();
                if (l === '')          { flushParagraph(); return; }
                if (l.startsWith('# '))  { flushParagraph(); blocks.push({ id: 'blk-' + uuid(), type: 'heading',    text: l.slice(2).trim() }); return; }
                if (l.startsWith('## ')) { flushParagraph(); blocks.push({ id: 'blk-' + uuid(), type: 'subheading', text: l.slice(3).trim() }); return; }

                const m = l.match(tokenRe);
                if (m) {
                    flushParagraph();
                    tokenRe.lastIndex = 0;
                    let mm;
                    while ((mm = tokenRe.exec(l)) !== null) {
                        const idToken = mm[1], caption = mm[2] || '';
                        if (idToken.startsWith('tmp-')) {
                            blocks.push({ id: 'blk-' + uuid(), type: 'image', temp_media_id: idToken, caption });
                        } else if (idToken.startsWith('block-')) {
                            const meta = sectionBlockMetadata[sectionKey]?.[idToken];
                            if (meta) {
                                blocks.push({ id: meta.block_id, type: 'image', media_id: meta.media_id, block_id: meta.block_id, caption });
                            } else {
                                blocks.push({ id: idToken.replace('block-', ''), type: 'image', caption });
                            }
                        } else if (idToken.startsWith('media-')) {
                            blocks.push({ id: 'blk-' + uuid(), type: 'image', media_id: parseInt(idToken.replace('media-', ''), 10), caption });
                        }
                    }
                    return;
                }
                paragraphBuffer.push(line);
            });
            flushParagraph();

            const hidden = tab.querySelector('input[data-contentblock-input]');
            if (hidden) hidden.value = JSON.stringify(blocks);
        });
    }

    /* ─────────────────────────────────────────────────────────────
       FORM SUBMIT
       ───────────────────────────────────────────────────────────── */
    document.getElementById('destinationEditForm').addEventListener('submit', function () {
        buildAndAttachSectionContentBlocks();
    });

    /* ─────────────────────────────────────────────────────────────
       INIT
       ───────────────────────────────────────────────────────────── */
    document.querySelector('.tab-button.active')?.click();

    /* Auto-hide flash alerts */
    setTimeout(() => {
        document.querySelectorAll('.bg-green-100, .bg-red-100').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity    = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 5000);
});
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .tab-button.active           { border-color: #10b981; color: #10b981; }
    .tab-button:not(.active)     { border-color: transparent; color: #6b7280; }
    .tab-button:not(.active):hover { color: #374151; border-color: #d1d5db; }

    /* Keyword grid scrollbar */
    #kwGrid::-webkit-scrollbar        { width: 6px; }
    #kwGrid::-webkit-scrollbar-track  { background: #f1f5f9; border-radius: 4px; }
    #kwGrid::-webkit-scrollbar-thumb  { background: #94a3b8; border-radius: 4px; }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\admin\destinations\edit.blade.php ENDPATH**/ ?>