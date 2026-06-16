<?php
    $tourCategories = \App\Models\ActivityCategory::where('is_active', true)->get();
    $tours          = \App\Models\Tour::with('itineraries')->where('status', 'published')->get();

    // Destinations: Uganda and Rwanda pinned to the top, everything else keeps its normal order after them
    $countryPriority = ['uganda' => 0, 'rwanda' => 1];
    $destinations = \App\Models\Destination::where('is_active', true)->with('country')->get()
        ->sortBy(function ($dest) use ($countryPriority) {
            $countryName = strtolower(optional($dest->country)->name ?? '');
            return $countryPriority[$countryName] ?? 2;
        })->values();

    // Activities: gorilla trekking first, chimpanzee/chimp tracking second, everything else after
    $activityPriority = ['gorilla', 'chimpanzee', 'chimp'];
    $activities = \App\Models\Activity::where('is_active', true)->with(['category', 'destination'])->get()
        ->sortBy(function ($activity) use ($activityPriority) {
            $name = strtolower($activity->name);
            foreach ($activityPriority as $i => $keyword) {
                if (str_contains($name, $keyword)) {
                    return $i;
                }
            }
            return count($activityPriority);
        })->values();
?>

<header class="fixed top-0 inset-x-0 z-50">

    
    <div class="bg-green-800 text-white text-xs lg:text-sm">
        <div class="container mx-auto px-4 lg:px-8 h-10 flex items-center justify-center lg:justify-between gap-x-6 gap-y-1 overflow-x-auto whitespace-nowrap">

            
            <div class="flex items-center gap-x-6 shrink-0">
                <a href="tel:+256781282344" class="flex items-center gap-1.5 text-green-100 hover:text-white transition-colors">
                    <i class="fas fa-phone text-green-300 text-[11px]"></i>
                    +256 781 282 344
                </a>
                <span class="text-green-600">|</span>
                <a href="https://wa.me/256781282344" target="_blank" rel="noopener" class="flex items-center gap-1.5 text-green-100 hover:text-white transition-colors">
                    <i class="fab fa-whatsapp text-green-300 text-sm"></i>
                    +256 781 282 344
                </a>
            </div>

            
            <span class="hidden lg:inline text-green-600">|</span>
            <div class="hidden lg:flex items-center gap-x-6">
                <a href="mailto:info@nextgensafaris.com" class="flex items-center gap-1.5 text-green-100 hover:text-white transition-colors">
                    <i class="fas fa-envelope text-green-300 text-[11px]"></i>
                    info@nextgensafaris.com
                </a>
                <span class="text-green-600">|</span>
                <a href="mailto:reservations@nextgensafaris.com" class="flex items-center gap-1.5 text-green-100 hover:text-white transition-colors">
                    <i class="fas fa-envelope text-green-300 text-[11px]"></i>
                    reservations@nextgensafaris.com
                </a>
                <span class="text-green-600">|</span>
                <a href="mailto:info@rwandabudgetsafaris.com" class="flex items-center gap-1.5 text-green-100 hover:text-white transition-colors">
                    <i class="fas fa-envelope text-green-300 text-[11px]"></i>
                    info@rwandabudgetsafaris.com
                </a>
            </div>
        </div>
    </div>

    <nav class="bg-white shadow-lg">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">

                
                <a href="<?php echo e(route('index')); ?>" class="flex items-center gap-3 shrink-0">
                    <img class="h-14 lg:h-16 w-auto object-contain" src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="Rwanda Budget Safaris">
                    <div class="flex flex-col leading-tight">
                        <span class="text-lg lg:text-xl font-bold text-green-700">Uganda & Rwanda Budget Safaris</span>
                        <span class="text-xs font-medium text-gray-500 -mt-0.5">NextGen Safaris</span>
                    </div>
                </a>

                
                <div class="hidden lg:flex items-center gap-1">

                    <a href="<?php echo e(route('index')); ?>"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-colors
                              <?php echo e(request()->routeIs('index') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                        Home
                    </a>

                    
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-md transition-colors
                                       <?php echo e(request()->routeIs('tours.*') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                            Tours
                            <svg class="h-3.5 w-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute left-0 top-full mt-1 w-80 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 translate-y-2 transition-all duration-200 z-50">
                            <div class="p-4 max-h-[75vh] overflow-y-auto">
                                <?php if($tourCategories->count() > 0): ?>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">By Category</p>
                                <div class="space-y-1 mb-4">
                                    <?php $__currentLoopData = $tourCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $catTours = $tours->where('category_id', $category->id); ?>
                                        <?php if($catTours->count() > 0): ?>
                                        <div class="px-3 py-2 hover:bg-green-50 rounded-lg">
                                            <p class="text-sm font-semibold text-gray-800 mb-1">
                                                <i class="<?php echo e($category->icon); ?> mr-1.5 text-green-600"></i><?php echo e($category->name); ?>

                                            </p>
                                            <div class="ml-5 space-y-0.5">
                                                <?php $__currentLoopData = $catTours->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <a href="<?php echo e(route('tours.show', $tour->slug)); ?>" class="block text-xs text-gray-600 hover:text-green-700 py-0.5">→ <?php echo e($tour->title); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php endif; ?>
                                <?php if($tours->count() > 0): ?>
                                <div class="border-t pt-3">
                                    <a href="<?php echo e(route('tours.index')); ?>" class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2 hover:text-green-600">All Tours</a>
                                    <div class="space-y-1">
                                        <?php $__currentLoopData = $tours->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('tours.show', $tour->slug)); ?>" class="block px-3 py-1.5 text-sm text-gray-700 hover:bg-green-50 hover:text-green-700 rounded-lg transition-colors">
                                            <p class="font-medium truncate"><?php echo e($tour->title); ?></p>
                                            <p class="text-xs text-gray-400"><?php echo e($tour->itineraries->count()); ?> Days Safari<?php echo e($tour->destination ? ' in '.$tour->destination : ''); ?></p>
                                        </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                    <?php if($tours->count() > 8): ?>
                                    <a href="<?php echo e(route('tours.index')); ?>" class="block mt-2 text-center text-xs text-green-600 hover:text-green-700 font-medium">View All <?php echo e($tours->count()); ?> Tours →</a>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <p class="text-center text-gray-400 py-4 text-sm">No tours available yet</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-md transition-colors
                                       <?php echo e(request()->routeIs('destinations.*') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                            Destinations
                            <svg class="h-3.5 w-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute left-0 top-full mt-1 w-80 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 translate-y-2 transition-all duration-200 z-50">
                            <div class="p-4">
                                <?php if($destinations->count() > 0): ?>
                                <a href="<?php echo e(route('destinations.index')); ?>" class="block text-center text-sm font-medium text-green-600 hover:text-green-700 mb-3">
                                    View All <?php echo e($destinations->count()); ?> Destinations →
                                </a>
                                <div class="grid grid-cols-2 gap-2 max-h-72 overflow-y-auto">
                                    <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('destinations.show', $dest->slug)); ?>" class="group/d bg-gray-50 hover:bg-green-50 rounded-lg p-2 transition-colors">
                                        <?php if($dest->image): ?>
                                        <img src="<?php echo e(asset('storage/'.$dest->image)); ?>" alt="<?php echo e($dest->name); ?>" class="w-full h-16 object-cover rounded mb-1.5">
                                        <?php else: ?>
                                        <div class="w-full h-16 bg-gradient-to-br from-green-400 to-blue-500 rounded mb-1.5 flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-white text-xl"></i>
                                        </div>
                                        <?php endif; ?>
                                        <p class="text-xs font-semibold text-gray-800 group-hover/d:text-green-700 truncate"><?php echo e($dest->name); ?></p>
                                        <p class="text-xs text-gray-400"><?php echo e($dest->country->flag_icon ?? ''); ?> <?php echo e($dest->country->name); ?></p>
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php else: ?>
                                <p class="text-center text-gray-400 py-4 text-sm">No destinations available yet</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="relative group">
                        <button class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-md transition-colors
                                       <?php echo e(request()->routeIs('activities.*') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                            Activities
                            <svg class="h-3.5 w-3.5 transition-transform duration-200 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute left-0 top-full mt-1 w-80 bg-white rounded-xl shadow-xl border border-gray-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 translate-y-2 transition-all duration-200 z-50">
                            <div class="p-4">
                                <?php if($activities->count() > 0): ?>
                                <a href="<?php echo e(route('activities.index')); ?>" class="block text-center text-sm font-medium text-green-600 hover:text-green-700 mb-3">
                                    View All <?php echo e($activities->count()); ?> Activities →
                                </a>
                                <div class="space-y-1.5 max-h-72 overflow-y-auto">
                                    <?php $__currentLoopData = $activities->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('activities.show', $activity->slug)); ?>" class="group/a flex items-center gap-2.5 p-2 bg-gray-50 hover:bg-green-50 rounded-lg transition-colors">
                                        <?php if($activity->image): ?>
                                        <img src="<?php echo e(asset('storage/'.$activity->image)); ?>" alt="<?php echo e($activity->name); ?>" class="w-12 h-12 object-cover rounded shrink-0">
                                        <?php elseif($activity->icon): ?>
                                        <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-blue-500 rounded shrink-0 flex items-center justify-center">
                                            <i class="<?php echo e($activity->icon); ?> text-white"></i>
                                        </div>
                                        <?php else: ?>
                                        <div class="w-12 h-12 bg-gray-200 rounded shrink-0 flex items-center justify-center">
                                            <i class="fas fa-hiking text-gray-400"></i>
                                        </div>
                                        <?php endif; ?>
                                        <div class="min-w-0">
                                            <p class="text-sm font-semibold text-gray-800 group-hover/a:text-green-700 truncate transition-colors"><?php echo e($activity->name); ?></p>
                                            <?php if($activity->category): ?>
                                            <p class="text-xs text-purple-600 truncate"><i class="<?php echo e($activity->category->icon); ?> mr-1"></i><?php echo e($activity->category->name); ?></p>
                                            <?php endif; ?>
                                            <?php if($activity->destination): ?>
                                            <p class="text-xs text-gray-400 truncate"><i class="fas fa-map-marker-alt mr-1"></i><?php echo e($activity->destination->name); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($activities->count() > 8): ?>
                                    <a href="<?php echo e(route('activities.index')); ?>" class="block text-center text-xs text-green-600 hover:text-green-700 font-medium py-1 border-t">+<?php echo e($activities->count() - 8); ?> more activities</a>
                                    <?php endif; ?>
                                </div>
                                <?php else: ?>
                                <p class="text-center text-gray-400 py-4 text-sm">No activities available yet</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <a href="<?php echo e(route('gallery.index')); ?>"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-colors
                              <?php echo e(request()->routeIs('gallery.index') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                        Gallery
                    </a>

                    <a href="<?php echo e(route('blogs.index')); ?>"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-colors
                              <?php echo e(request()->routeIs('blogs.*') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                        Blog
                    </a>

                    <a href="<?php echo e(route('accommodations.index')); ?>"
                       class="px-3 py-2 text-sm font-medium rounded-md transition-colors
                              <?php echo e(request()->routeIs('accommodations.*') ? 'text-green-700 bg-green-50' : 'text-gray-700 hover:text-green-700 hover:bg-gray-50'); ?>">
                        <i class="fas fa-bed text-green-600"></i>
                    </a>

                    <a href="<?php echo e(route('contact')); ?>"
                       class="px-3 py-2 text-sm bg-red-500 font-medium rounded-md transition-colors
                              <?php echo e(request()->routeIs('contact') ? 'text-white  bg-red-500' : 'text-white hover:text-green-700 hover:bg-gray-50'); ?>">
                        Request a Quote
                    </a>

                    <a href="<?php echo e(route('custom-tour-requests.create')); ?>"
                       class="ml-2 bg-green-600 hover:bg-green-700 hidden text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors whitespace-nowrap">
                        <i class="fas fa-map-marked-alt mr-1.5"></i>Plan Custom Tour
                    </a>
                </div>

                
                <button id="mobile-toggle"
                        class="lg:hidden flex flex-col justify-center items-center w-9 h-9 gap-1.5  hover:bg-gray-100 transition-colors focus:outline-none"
                        aria-label="Toggle menu" aria-expanded="false">
                    <span class="ham-line block w-6 h-0.5 bg-gray-800 transition-all duration-300"></span>
                    <span class="ham-line block w-6 h-0.5 bg-gray-800 transition-all duration-300"></span>
                    <span class="ham-line block w-6 h-0.5 bg-gray-800 transition-all duration-300"></span>
                </button>
            </div>

            
            <div id="mobile-menu"
                 class="lg:hidden hidden border-t border-gray-100 bg-white">
                <div class="py-3 space-y-0.5 max-h-[80vh] overflow-y-auto">

                    <a href="<?php echo e(route('index')); ?>"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg mx-2 transition-colors
                              <?php echo e(request()->routeIs('index') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                        <i class="fas fa-home mr-2"></i> Home
                    </a>

                    
                    <div class="mx-2">
                        <button class="mobile-accordion w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-colors
                                       <?php echo e(request()->routeIs('tours.*') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                            <span><i class="fas fa-binoculars mr-2"></i> Tours</span>
                            <svg class="accordion-icon h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="accordion-panel hidden pl-4 pr-2 pb-2 space-y-0.5">
                            <a href="<?php echo e(route('tours.index')); ?>" class="block px-4 py-2 text-sm text-green-600 font-medium hover:bg-green-50 rounded-lg">View All Tours →</a>
                            <?php $__currentLoopData = $tours->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('tours.show', $tour->slug)); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 rounded-lg transition-colors">
                                <?php echo e($tour->title); ?>

                                <span class="block text-xs text-gray-400"><?php echo e($tour->itineraries->count()); ?> Days</span>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <div class="mx-2">
                        <button class="mobile-accordion w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-colors
                                       <?php echo e(request()->routeIs('destinations.*') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                            <span><i class="fas fa-map-marked-alt mr-2"></i>Destinations</span>
                            <svg class="accordion-icon h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="accordion-panel hidden pl-4 pr-2 pb-2 space-y-0.5">
                            <a href="<?php echo e(route('destinations.index')); ?>" class="block px-4 py-2 text-sm text-green-600 font-medium hover:bg-green-50 rounded-lg">View All Destinations →</a>
                            <?php $__currentLoopData = $destinations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('destinations.show', $dest->slug)); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 rounded-lg transition-colors">
                                <?php echo e($dest->country->flag_icon ?? ''); ?> <?php echo e($dest->name); ?>

                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    
                    <div class="mx-2">
                        <button class="mobile-accordion w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-lg transition-colors
                                       <?php echo e(request()->routeIs('activities.*') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                            <span><i class="fas fa-running mr-2"></i>Activities</span>
                            <svg class="accordion-icon h-4 w-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="accordion-panel hidden pl-4 pr-2 pb-2 space-y-0.5">
                            <a href="<?php echo e(route('activities.index')); ?>" class="block px-4 py-2 text-sm text-green-600 font-medium hover:bg-green-50 rounded-lg">View All Activities →</a>
                            <?php $__currentLoopData = $activities->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('activities.show', $activity->slug)); ?>" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 rounded-lg transition-colors">
                                <?php echo e($activity->name); ?>

                                <?php if($activity->destination): ?><span class="block text-xs text-gray-400"><?php echo e($activity->destination->name); ?></span><?php endif; ?>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <a href="<?php echo e(route('gallery.index')); ?>"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg mx-2 transition-colors
                              <?php echo e(request()->routeIs('gallery.index') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                        <i class="fas fa-images"></i> Gallery
                    </a>

                    <a href="<?php echo e(route('blogs.index')); ?>"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg mx-2 transition-colors
                              <?php echo e(request()->routeIs('blogs.*') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                        <i class="fas fa-blog"></i> Blog
                    </a>

                    <a href="<?php echo e(route('accommodations.index')); ?>"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg mx-2 transition-colors
                              <?php echo e(request()->routeIs('accommodations.*') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                        <i class="fas fa-bed"></i> Stays
                    </a>

                    <a href="<?php echo e(route('contact')); ?>"
                       class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-lg mx-2 transition-colors
                              <?php echo e(request()->routeIs('contact') ? 'bg-green-50 text-green-700 border-l-4 border-green-600' : 'text-gray-700 hover:bg-gray-50 hover:text-green-700'); ?>">
                        <i class="fas fa-phone"></i> Contact
                    </a>

                    <div class="px-2 pt-2 pb-1">
                        <a href="<?php echo e(route('custom-tour-requests.create')); ?>"
                           class="flex items-center justify-center  hidden gap-2 w-full bg-green-600 hover:bg-green-700 text-white px-4 py-3 rounded-lg text-sm font-semibold transition-colors">
                            <i class="fas fa-map-marked-alt"></i> Plan Custom Tour
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </nav>

</header>


<div class="h-[104px] lg:h-[120px]" aria-hidden="true"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── Hamburger toggle ─────────────────────────────────────────
    const toggle     = document.getElementById('mobile-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const lines      = toggle.querySelectorAll('.ham-line');

    toggle.addEventListener('click', function () {
        const open = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', !open);
        mobileMenu.classList.toggle('hidden');

        // Animate to X
        if (!open) {
            lines[0].style.cssText = 'transform:translateY(8px) rotate(45deg)';
            lines[1].style.cssText = 'opacity:0';
            lines[2].style.cssText = 'transform:translateY(-8px) rotate(-45deg)';
        } else {
            lines[0].style.cssText = '';
            lines[1].style.cssText = '';
            lines[2].style.cssText = '';
        }
    });

    // ── Mobile accordions ────────────────────────────────────────
    document.querySelectorAll('.mobile-accordion').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const panel = btn.nextElementSibling;
            const icon  = btn.querySelector('.accordion-icon');
            const open  = !panel.classList.contains('hidden');

            // Close all others
            document.querySelectorAll('.accordion-panel').forEach(p => p.classList.add('hidden'));
            document.querySelectorAll('.accordion-icon').forEach(i => i.style.transform = '');

            if (!open) {
                panel.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            }
        });
    });

    // ── Close mobile menu on resize to desktop ───────────────────
    window.addEventListener('resize', function () {
        if (window.innerWidth >= 1024) {
            mobileMenu.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            lines[0].style.cssText = '';
            lines[1].style.cssText = '';
            lines[2].style.cssText = '';
        }
    });
});
</script><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views/components/navigation.blade.php ENDPATH**/ ?>