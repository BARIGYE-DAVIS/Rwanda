

<?php $__env->startSection('title', 'Contact Us - Get in Touch with Rwanda Budget Safaris'); ?>
<?php $__env->startSection('meta_description', 'Contact Rwanda Budget Safaris for your dream safari adventure. Get expert advice, custom quotes, and personalized service. Call, email, or visit us today!'); ?>
<?php $__env->startSection('meta_keywords', 'contact Rwanda Budget Safaris, safari contact, tour booking contact, East Africa safari contact, Tanzania safari contact, Kenya safari contact, Uganda safari contact, safari inquiry, custom safari quote, tour operator contact, safari expert, travel consultation'); ?>

<?php $__env->startSection('page-header'); ?>
<!-- Contact Page Header -->
<header class="relative bg-green-600 py-16 md:py-24">
    <div class="absolute inset-0 bg-black opacity-30"></div>
    <div class="relative z-10 container mx-auto px-4 text-center text-white">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Contact Us</h1>
            <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto">
                Ready to embark on your dream safari? Our expert team is here to help you plan the perfect African adventure.
            </p>

            <!-- Quick Contact Info -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-12">
                <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fas fa-phone-alt text-green-300 mr-2 text-lg"></i>
                        <span class="font-semibold">Call Us</span>
                    </div>
                    <p class="text-green-200">+256 781282344</p>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fas fa-envelope text-green-300 mr-2 text-lg"></i>
                        <span class="font-semibold">Email Us</span>
                    </div>
                    <p class="text-green-200">info@rwandabudgetsafaris.com</p>
                </div>

                <div class="bg-white/10 backdrop-blur rounded-lg p-4">
                    <div class="flex items-center justify-center mb-2">
                        <i class="fab fa-whatsapp text-green-300 mr-2 text-lg"></i>
                        <span class="font-semibold">WhatsApp</span>
                    </div>
                    <p class="text-green-200">+256 781282344</p>
                </div>
            </div>

            <!-- Breadcrumb -->
            <nav class="mt-8 text-sm">
                <ol class="flex justify-center space-x-2 text-green-200">
                    <li><a href="<?php echo e(route('index')); ?>" class="hover:text-white transition-colors">Home</a></li>
                    <li class="mx-2">/</li>
                    <li class="text-white">Contact</li>
                </ol>
            </nav>
        </div>
    </div>
</header>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<!-- Success Message - At the VERY TOP -->
<?php if(session('success')): ?>
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-start max-w-3xl mx-auto mt-8">
        <i class="fas fa-check-circle text-green-600 mr-2 mt-0.5 text-lg"></i>
        <div>
            <p class="font-medium">Booking Request Sent Successfully!</p>
            <p class="text-sm"><?php echo e(session('success')); ?></p>
        </div>
    </div>
<?php endif; ?>

<?php if(session('error')): ?>
    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg flex items-start max-w-3xl mx-auto mt-8">
        <i class="fas fa-exclamation-circle text-red-600 mr-2 mt-0.5 text-lg"></i>
        <div>
            <p class="font-medium">Oops! Something went wrong.</p>
            <p class="text-sm"><?php echo e(session('error')); ?></p>
        </div>
    </div>
<?php endif; ?>

<!-- Contact Form Section -->
<section class="py-16 bg-gradient-to-r from-green-50 to-blue-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Book Your Safari</h2>
            <p class="text-lg text-gray-600">
                Fill out the form below and we'll get back to you soon with detailed information
                about your safari adventure.
            </p>
        </div>

        <!-- Booking Form -->
        <form action="<?php echo e(route('contact.store')); ?>" method="POST" class="space-y-6" id="contactForm">
            <?php echo csrf_field(); ?>

            <!-- First & Last Name -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-green-600 mr-1"></i>
                        First Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="first_name"
                           name="first_name"
                           value="<?php echo e(old('first_name')); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Enter your first name">
                    <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-user text-green-600 mr-1"></i>
                        Last Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="last_name"
                           name="last_name"
                           value="<?php echo e(old('last_name')); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Enter your last name">
                    <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Email & WhatsApp -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-envelope text-green-600 mr-1"></i>
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="<?php echo e(old('email')); ?>"
                           required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Enter your email address">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="whatsapp_number" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-whatsapp text-green-600 mr-1"></i>
                        WhatsApp Number 
                    </label>
                    <input type="text"
                           id="whatsapp_number"
                           name="whatsapp_number"
                           value="<?php echo e(old('whatsapp_number')); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['whatsapp_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="e.g., +256 781282344">
                    <?php $__errorArgs = ['whatsapp_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Nationality & Destination -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nationality" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-flag text-green-600 mr-1"></i>
                        Nationality <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           id="nationality"
                           name="nationality"
                           value="<?php echo e(old('nationality')); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['nationality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="Enter your nationality">
                    <?php $__errorArgs = ['nationality'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-map-marker-alt text-green-600 mr-1"></i>
                        Destination 
                    </label>
                    <input type="text"
                           id="destination"
                           name="destination"
                           value="<?php echo e(old('destination')); ?>"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['destination'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="e.g., Uganda, Rwanda, Kenya">
                    <?php $__errorArgs = ['destination'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Number of People & Days -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="number_of_people" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-users text-green-600 mr-1"></i>
                        Number of People 
                    </label>
                    <input type="number"
                           id="number_of_people"
                           name="number_of_people"
                           value="<?php echo e(old('number_of_people')); ?>"
                           min="1"
                           max="100"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['number_of_people'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="e.g., 2">
                    <?php $__errorArgs = ['number_of_people'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="number_of_days" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-calendar-alt text-green-600 mr-1"></i>
                        Number of Days 
                    </label>
                    <input type="number"
                           id="number_of_days"
                           name="number_of_days"
                           value="<?php echo e(old('number_of_days')); ?>"
                           min="1"
                           max="365"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['number_of_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                           placeholder="e.g., 7">
                    <?php $__errorArgs = ['number_of_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <!-- Accommodation Type -->
            <div>
                <label for="accommodation_type" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-hotel text-green-600 mr-1"></i>
                    Accommodation Type 
                </label>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer <?php $__errorArgs = ['accommodation_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <input type="checkbox"
                               name="accommodation_type[]"
                               value="budget"
                               <?php if(old('accommodation_type') && in_array('budget', old('accommodation_type'))): ?> checked <?php endif; ?>
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700"><i class="fas fa-coins text-yellow-600 mr-1"></i>Budget</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer <?php $__errorArgs = ['accommodation_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <input type="checkbox"
                               name="accommodation_type[]"
                               value="mid_range"
                               <?php if(old('accommodation_type') && in_array('mid_range', old('accommodation_type'))): ?> checked <?php endif; ?>
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700"><i class="fas fa-star text-blue-600 mr-1"></i>Mid Range</span>
                    </label>
                    <label class="flex items-center p-3 border border-gray-300 rounded-lg hover:bg-gray-50 cursor-pointer <?php $__errorArgs = ['accommodation_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <input type="checkbox"
                               name="accommodation_type[]"
                               value="luxury"
                               <?php if(old('accommodation_type') && in_array('luxury', old('accommodation_type'))): ?> checked <?php endif; ?>
                               class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700"><i class="fas fa-crown text-purple-600 mr-1"></i>Luxury</span>
                    </label>
                </div>
                <?php $__errorArgs = ['accommodation_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php $__errorArgs = ['accommodation_type.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Preferred Travel Date -->
            <div>
                <label for="preferred_travel_date" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-calendar-check text-green-600 mr-1"></i>
                    Preferred Travel Date 
                </label>
                <input type="text"
                       id="preferred_travel_date"
                       name="preferred_travel_date"
                       value="<?php echo e(old('preferred_travel_date')); ?>"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['preferred_travel_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="e.g., June 2025">
                <?php $__errorArgs = ['preferred_travel_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Estimated Budget -->
            <div>
                <label for="estimated_budget" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-dollar-sign text-green-600 mr-1"></i>
                    Estimated Budget Per Person 
                </label>
                <input type="number"
                       id="estimated_budget"
                       name="estimated_budget"
                       value="<?php echo e(old('estimated_budget')); ?>"
                       step="0.01"
                       min="0"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 <?php $__errorArgs = ['estimated_budget'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       placeholder="e.g., 1500">
                <?php $__errorArgs = ['estimated_budget'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Additional Comments -->
            <div>
                <label for="additional_comments" class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-comment-dots text-green-600 mr-1"></i>
                    More information 
                </label>
                <textarea id="additional_comments"
                          name="additional_comments"
                          rows="6"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-150 resize-y <?php $__errorArgs = ['additional_comments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                          placeholder="Tell us about your dream safari, preferred dates, group size, interests, or any specific requirements..."><?php echo e(old('additional_comments')); ?></textarea>
                <p class="mt-1 text-xs text-gray-500"><i class="fas fa-info-circle mr-1"></i>Please provide as much detail as possible to help us serve you better.</p>
                <?php $__errorArgs = ['additional_comments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-sm text-red-600"><i class="fas fa-exclamation-circle mr-1"></i><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit"
                        id="submitBtn"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-105">
                    <i class="fas fa-paper-plane mr-2"></i>
                    <span class="btn-text">Submit Booking Request</span>
                </button>
                <p class="text-sm text-gray-500 mt-3"><i class="fas fa-clock mr-1"></i>We'll respond within 24 hours with detailed information.</p>
            </div>
        </form>
    </div>
</section>

<!-- Contact Information Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Get In Touch</h2>
            <p class="text-lg text-gray-600">
                Multiple ways to reach our safari experts
            </p>
        </div>

        <!-- Contact Method Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Phone -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-phone-alt text-green-600 text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-1">Call Us</h4>
                <p class="text-gray-600 text-sm mb-2">Speak directly with our safari experts</p>
                <a href="tel:+256781282344" class="text-green-600 font-medium hover:text-green-700">
                    +256 781282344
                </a>
                <p class="text-sm text-gray-500 mt-1"><i class="fas fa-clock mr-1"></i>24/7</p>
            </div>

            <!-- Email -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-envelope text-blue-600 text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-1">Email Us</h4>
                <p class="text-gray-600 text-sm mb-2">Send us your detailed safari requirements</p>
                <a href="mailto:info@rwandabudgetsafaris.com" class="text-blue-600 font-medium hover:text-blue-700 break-all">
                    info@rwandabudgetsafaris.com
                </a>
                <p class="text-sm text-gray-500 mt-1"><i class="fas fa-clock mr-1"></i>Response within 24 hours</p>
            </div>

            <!-- WhatsApp -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-1">WhatsApp</h4>
                <p class="text-gray-600 text-sm mb-2">Quick chat for instant responses</p>
                <a href="https://wa.me/256781282344" class="text-green-600 font-medium hover:text-green-700">
                    +256 781282344
                </a>
                <p class="text-sm text-gray-500 mt-1"><i class="fas fa-clock mr-1"></i>Available 24/7</p>
            </div>

            <!-- Office Address -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 text-center">
                <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-map-marker-alt text-orange-600 text-xl"></i>
                </div>
                <h4 class="font-semibold text-gray-900 mb-1">Visit Our Office</h4>
                <p class="text-gray-600 text-sm mb-2">
                    Salaam Road<br>
                    Kampala, Central Uganda<br>
                    East Africa
                </p>
                <p class="text-sm text-gray-500 mt-1"><i class="fas fa-calendar-check mr-1"></i>By appointment only</p>
            </div>
        </div>

        <!-- Social Media + Quick Response Guarantee Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Social Media -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200 flex flex-col">
                <h4 class="font-semibold text-gray-900 mb-4">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-blue-600 hover:bg-blue-700 rounded-full flex items-center justify-center text-white transition-colors">
                        <i class="fab fa-twitter text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-blue-800 hover:bg-blue-900 rounded-full flex items-center justify-center text-white transition-colors">
                        <i class="fab fa-facebook-f text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-pink-600 hover:bg-pink-700 rounded-full flex items-center justify-center text-white transition-colors">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center text-white transition-colors">
                        <i class="fab fa-youtube text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Response Guarantee -->
            <div class="bg-green-50 border border-green-200 rounded-2xl p-6">
                <div class="flex items-start">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4 flex-shrink-0">
                        <i class="fas fa-clock text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-green-800 mb-2">24-Hour Response Guarantee</h4>
                        <p class="text-green-700 text-sm leading-relaxed">
                            We guarantee to respond to all inquiries within 24 hours with detailed information,
                            custom quotes, and expert recommendations for your perfect safari adventure.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Alternative Contact Methods -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Prefer Other Ways to Connect?</h2>
            <p class="text-lg text-gray-600">Choose the method that works best for you</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- WhatsApp -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fab fa-whatsapp text-green-600 text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">WhatsApp Chat</h3>
                <p class="text-gray-600 mb-6">Quick responses and instant communication for urgent inquiries.</p>
                <a href="https://wa.me/256781282344"
                   class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <i class="fab fa-whatsapp mr-2"></i>
                    Start Chat
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Phone Call -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-phone-alt text-blue-600 text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Call Our Experts</h3>
                <p class="text-gray-600 mb-6">Speak directly with our safari specialists for personalized advice.</p>
                <a href="tel:+256781282344"
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-phone-alt mr-2"></i>
                    Call Now
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>

            <!-- Browse Tours -->
            <div class="text-center group">
                <div class="w-20 h-20 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-search text-orange-600 text-4xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Browse Tours First</h3>
                <p class="text-gray-600 mb-6">Explore our safari packages and then contact us with specific questions.</p>
                <a href="<?php echo e(route('tours.index')); ?>"
                   class="inline-flex items-center bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <i class="fas fa-binoculars mr-2"></i>
                    View Tours
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('styles'); ?>
<style>
    .faq-content {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }

    .faq-content.active {
        max-height: 200px;
    }

    .faq-icon.active {
        transform: rotate(180deg);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle Functionality
    document.querySelectorAll('.faq-toggle').forEach(button => {
        button.addEventListener('click', () => {
            const content = button.nextElementSibling;
            const icon = button.querySelector('.faq-icon');

            // Close other open FAQs
            document.querySelectorAll('.faq-content').forEach(otherContent => {
                if (otherContent !== content) {
                    otherContent.classList.remove('active');
                    otherContent.classList.add('hidden');
                    otherContent.previousElementSibling.querySelector('.faq-icon').classList.remove('active');
                }
            });

            // Toggle current FAQ
            content.classList.toggle('hidden');
            content.classList.toggle('active');
            icon.classList.toggle('active');
        });
    });

    // Contact Form Enhancement
    const contactForm = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText = submitBtn.querySelector('.btn-text');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-75');
            btnText.textContent = 'Sending...';

            // Add spinner
            const spinner = document.createElement('i');
            spinner.className = 'fas fa-spinner fa-spin mr-2';
            btnText.parentNode.insertBefore(spinner, btnText);

            // Remove existing icon
            const existingIcon = submitBtn.querySelector('i:not(.fa-spinner)');
            if (existingIcon) {
                existingIcon.remove();
            }
        });
    }

    // Auto-expand message textarea based on content
    const messageTextarea = document.getElementById('additional_comments');
    if (messageTextarea) {
        messageTextarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }

    // Form field enhancements
    const formFields = document.querySelectorAll('input, textarea, select');
    formFields.forEach(field => {
        field.addEventListener('focus', function() {
            this.parentNode.classList.add('focused');
        });

        field.addEventListener('blur', function() {
            this.parentNode.classList.remove('focused');
        });
    });

    // Phone number formatting (basic)
    const phoneField = document.getElementById('whatsapp_number');
    if (phoneField) {
        phoneField.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 10) {
                value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
            }
            e.target.value = value;
        });
    }

    // Smooth scroll to form on error
    const hasErrors = document.querySelector('.border-red-500');
    if (hasErrors) {
        setTimeout(() => {
            hasErrors.scrollIntoView({ behavior: 'smooth', block: 'center' });
            hasErrors.focus();
        }, 100);
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\contact\index.blade.php ENDPATH**/ ?>