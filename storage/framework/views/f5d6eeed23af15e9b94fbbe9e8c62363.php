

<?php $__env->startSection('title', 'Booking Request #' . $contact->id . ' - Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid px-4 py-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <nav class="flex mb-3" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="<?php echo e(route('admin.contacts.index')); ?>" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                                <i class="fas fa-home mr-2"></i>
                                Booking Requests
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Booking #<?php echo e($contact->id); ?></span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Booking Request Details</h1>
                <p class="text-gray-600">View and manage this booking request</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="<?php echo e(route('admin.contacts.index')); ?>" 
                   class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <!-- Status Alert -->
    <?php if(session('success')): ?>
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg flex items-start">
            <i class="fas fa-check-circle text-green-600 mr-2 mt-0.5"></i>
            <div>
                <p class="font-medium">Success!</p>
                <p class="text-sm"><?php echo e(session('success')); ?></p>
            </div>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Booking Content -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Booking Details</h3>
                    <div class="flex items-center space-x-2">
                        <?php
                            $statusColors = [
                                'pending' => 'yellow',
                                'processing' => 'blue',
                                'quoted' => 'purple',
                                'confirmed' => 'green',
                                'cancelled' => 'red'
                            ];
                            $statusIcons = [
                                'pending' => 'fa-clock',
                                'processing' => 'fa-spinner',
                                'quoted' => 'fa-file-invoice',
                                'confirmed' => 'fa-check-circle',
                                'cancelled' => 'fa-times-circle'
                            ];
                        ?>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-<?php echo e($statusColors[$contact->status] ?? 'gray'); ?>-100 text-<?php echo e($statusColors[$contact->status] ?? 'gray'); ?>-800">
                            <i class="fas <?php echo e($statusIcons[$contact->status] ?? 'fa-circle'); ?> mr-1"></i>
                            <?php echo e(ucfirst($contact->status)); ?>

                        </span>
                    </div>
                </div>
                <div class="px-6 py-6">
                    <!-- Personal Information -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-user mr-2 text-green-600"></i>Personal Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Full Name</label>
                                <p class="text-sm font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php echo e($contact->first_name); ?> <?php echo e($contact->last_name); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Email Address</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <i class="fas fa-envelope mr-2 text-gray-400"></i><?php echo e($contact->email); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">WhatsApp Number</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php if($contact->whatsapp_number): ?>
                                        <i class="fab fa-whatsapp mr-2 text-green-600"></i><?php echo e($contact->whatsapp_number); ?>

                                    <?php else: ?>
                                        <span class="text-gray-400 italic">Not provided</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Nationality</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php if($contact->nationality): ?>
                                        <i class="fas fa-flag mr-2 text-gray-400"></i><?php echo e($contact->nationality); ?>

                                    <?php else: ?>
                                        <span class="text-gray-400 italic">Not provided</span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Trip Details -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-plane mr-2 text-green-600"></i>Trip Details</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Destination</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php echo e($contact->destination ?? 'Not specified'); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Number of People</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php echo e($contact->number_of_people ?? 'Not specified'); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Number of Days</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php echo e($contact->number_of_days ?? 'Not specified'); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Accommodation Type</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <?php echo e($contact->accommodation_list ?? 'Not specified'); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Preferred Travel Date</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <i class="fas fa-calendar-alt mr-2 text-gray-400"></i>
                                    <?php echo e($contact->preferred_travel_date ?? 'Not specified'); ?>

                                </p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Estimated Budget</label>
                                <p class="text-sm text-gray-900 bg-gray-50 p-3 rounded-lg border">
                                    <i class="fas fa-dollar-sign mr-2 text-gray-400"></i>
                                    <?php echo e($contact->formatted_budget ?? 'Not specified'); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Comments -->
                    <?php if($contact->additional_comments): ?>
                    <div>
                        <h4 class="text-sm font-semibold text-gray-700 mb-3"><i class="fas fa-comment-dots mr-2 text-green-600"></i>Additional Comments</h4>
                        <div class="bg-gray-50 p-4 rounded-lg border">
                            <div class="prose max-w-none text-gray-800 leading-relaxed whitespace-pre-wrap"><?php echo e($contact->additional_comments); ?></div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Response Section -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
                </div>
                <div class="px-6 py-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Email Response -->
                        <a href="mailto:<?php echo e($contact->email); ?>?subject=Re: Safari Booking Request&body=Dear <?php echo e($contact->first_name); ?>,%0D%0A%0D%0AThank you for your booking request for <?php echo e($contact->destination ?? 'a safari'); ?>.%0D%0A%0D%0A" 
                           class="block p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all duration-200 group">
                            <div class="flex items-center mb-3">
                                <i class="fas fa-envelope text-gray-400 group-hover:text-green-600 text-2xl mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-green-800">Reply via Email</h4>
                            </div>
                            <p class="text-sm text-gray-600 group-hover:text-green-700">
                                Open your email client with a pre-filled response to <?php echo e($contact->email); ?>

                            </p>
                        </a>

                        <!-- WhatsApp Response -->
                        <?php if($contact->whatsapp_number): ?>
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $contact->whatsapp_number)); ?>?text=Hello <?php echo e($contact->first_name); ?>, thank you for your booking request..." 
                           target="_blank"
                           class="block p-4 border-2 border-gray-200 rounded-lg hover:border-green-500 hover:bg-green-50 transition-all duration-200 group">
                            <div class="flex items-center mb-3">
                                <i class="fab fa-whatsapp text-gray-400 group-hover:text-green-600 text-2xl mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-900 group-hover:text-green-800">WhatsApp <?php echo e($contact->first_name); ?></h4>
                            </div>
                            <p class="text-sm text-gray-600 group-hover:text-green-700">
                                Send a WhatsApp message to <?php echo e($contact->whatsapp_number); ?>

                            </p>
                        </a>
                        <?php else: ?>
                        <div class="p-4 border-2 border-gray-100 rounded-lg bg-gray-50">
                            <div class="flex items-center mb-3">
                                <i class="fab fa-whatsapp text-gray-300 text-2xl mr-3"></i>
                                <h4 class="text-lg font-semibold text-gray-400">No WhatsApp Number</h4>
                            </div>
                            <p class="text-sm text-gray-400">Contact did not provide a WhatsApp number</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Contact Information -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <!-- Avatar & Name -->
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12">
                            <div class="h-12 w-12 rounded-full bg-<?php echo e($contact->status === 'pending' ? 'blue' : 'gray'); ?>-100 flex items-center justify-center">
                                <i class="fas fa-user text-<?php echo e($contact->status === 'pending' ? 'blue' : 'gray'); ?>-600 text-xl"></i>
                            </div>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900"><?php echo e($contact->first_name); ?> <?php echo e($contact->last_name); ?></h4>
                            <p class="text-sm text-gray-500">Booking #<?php echo e($contact->id); ?></p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex items-start">
                        <i class="fas fa-envelope text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Email</p>
                            <a href="mailto:<?php echo e($contact->email); ?>" class="text-sm text-blue-600 hover:text-blue-800 break-all">
                                <?php echo e($contact->email); ?>

                            </a>
                        </div>
                    </div>

                    <!-- Nationality -->
                    <div class="flex items-start">
                        <i class="fas fa-flag text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Nationality</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->nationality ?? 'Not provided'); ?></p>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="flex items-start">
                        <i class="fab fa-whatsapp text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">WhatsApp</p>
                            <?php if($contact->whatsapp_number): ?>
                                <a href="tel:<?php echo e($contact->whatsapp_number); ?>" class="text-sm text-blue-600 hover:text-blue-800">
                                    <?php echo e($contact->whatsapp_number); ?>

                                </a>
                            <?php else: ?>
                                <p class="text-sm text-gray-400 italic">Not provided</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Details -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Booking Details</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <!-- Destination -->
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Destination</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->destination ?? 'Not specified'); ?></p>
                        </div>
                    </div>

                    <!-- Travelers -->
                    <div class="flex items-start">
                        <i class="fas fa-users text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Travelers</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->number_of_people ?? 'Not specified'); ?></p>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="flex items-start">
                        <i class="fas fa-calendar-alt text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Duration</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->number_of_days ?? 'Not specified'); ?> days</p>
                        </div>
                    </div>

                    <!-- Accommodation -->
                    <div class="flex items-start">
                        <i class="fas fa-hotel text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Accommodation</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->accommodation_list ?? 'Not specified'); ?></p>
                        </div>
                    </div>

                    <!-- Budget -->
                    <div class="flex items-start">
                        <i class="fas fa-dollar-sign text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Budget</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->formatted_budget ?? 'Not specified'); ?></p>
                        </div>
                    </div>

                    <!-- Date Received -->
                    <div class="flex items-start">
                        <i class="fas fa-clock text-gray-400 mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Date Received</p>
                            <p class="text-sm text-gray-600"><?php echo e($contact->created_at->format('F d, Y')); ?></p>
                            <p class="text-xs text-gray-500"><?php echo e($contact->created_at->format('H:i A')); ?> (<?php echo e($contact->created_at->diffForHumans()); ?>)</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white shadow rounded-lg">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Actions</h3>
                </div>
                <div class="px-6 py-4 space-y-3">
                    <!-- Update Status -->
                    <form action="<?php echo e(route('admin.contacts.status', $contact->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="mb-3">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Update Status</label>
                            <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                                <option value="pending" <?php echo e($contact->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="processing" <?php echo e($contact->status === 'processing' ? 'selected' : ''); ?>>Processing</option>
                                <option value="quoted" <?php echo e($contact->status === 'quoted' ? 'selected' : ''); ?>>Quoted</option>
                                <option value="confirmed" <?php echo e($contact->status === 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                <option value="cancelled" <?php echo e($contact->status === 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            <i class="fas fa-sync-alt mr-2"></i>
                            Update Status
                        </button>
                    </form>

                    <!-- Delete Booking -->
                    <form action="<?php echo e(route('admin.contacts.destroy', $contact->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking request? This action cannot be undone.')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="w-full flex items-center justify-center px-4 py-2 border border-red-300 rounded-md shadow-sm bg-white text-sm font-medium text-red-700 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            <i class="fas fa-trash mr-2"></i>
                            Delete Booking
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    .prose {
        max-width: none;
    }
    
    .prose p {
        margin-bottom: 1rem;
    }
    
    .prose p:last-child {
        margin-bottom: 0;
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\admin\contacts\show.blade.php ENDPATH**/ ?>