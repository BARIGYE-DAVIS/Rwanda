<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Booking Request</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; line-height: 1.6; color:#111;">
    <h2 style="margin:0 0 12px;">New Booking Request Received</h2>

    <p style="margin:0 0 10px;">
        <strong>Booking Reference:</strong>
        #<?php echo e($contact->id ?? 'N/A'); ?>

    </p>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">Personal Information</h3>
    <p style="margin:0 0 6px;"><strong>First Name:</strong> <?php echo e($contact->first_name); ?></p>
    <p style="margin:0 0 6px;"><strong>Last Name:</strong> <?php echo e($contact->last_name); ?></p>
    <p style="margin:0 0 6px;"><strong>Full Name:</strong> <?php echo e($contact->first_name); ?> <?php echo e($contact->last_name); ?></p>
    <p style="margin:0 0 6px;"><strong>Email:</strong> <?php echo e($contact->email); ?></p>
    <p style="margin:0 0 6px;"><strong>WhatsApp Number:</strong> <?php echo e($contact->whatsapp_number ?? 'N/A'); ?></p>
    <p style="margin:0 0 6px;"><strong>Nationality:</strong> <?php echo e($contact->nationality ?? 'N/A'); ?></p>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">Trip Details</h3>
    <p style="margin:0 0 6px;"><strong>Destination:</strong> <?php echo e($contact->destination ?? 'N/A'); ?></p>
    <p style="margin:0 0 6px;"><strong>Number of People:</strong> <?php echo e($contact->number_of_people ?? 'N/A'); ?></p>
    <p style="margin:0 0 6px;"><strong>Number of Days:</strong> <?php echo e($contact->number_of_days ?? 'N/A'); ?></p>
    <p style="margin:0 0 6px;"><strong>Accommodation Type:</strong> <?php echo e($contact->accommodation_list ?? 'N/A'); ?></p>
    <p style="margin:0 0 6px;"><strong>Preferred Travel Date:</strong> <?php echo e($contact->preferred_travel_date ?? 'N/A'); ?></p>
    <p style="margin:0 0 6px;"><strong>Estimated Budget:</strong> <?php echo e($contact->formatted_budget ?? 'N/A'); ?></p>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">Additional Comments</h3>
    <div style="background:#f9fafb;border:1px solid #e5e7eb;border-radius:8px;padding:12px;white-space:pre-wrap;">
        <?php echo e($contact->additional_comments ?? 'No additional comments provided.'); ?>

    </div>

    <hr style="border:none;border-top:1px solid #e5e7eb;margin:14px 0;">

    <h3 style="margin:0 0 10px;">System Information</h3>
    <p style="margin:0 0 6px;"><strong>Status:</strong> <?php echo e($contact->status_label ?? 'Pending'); ?></p>
    <p style="margin:0 0 6px;"><strong>Submitted:</strong> <?php echo e($contact->created_at ? $contact->created_at->format('Y-m-d H:i:s') : 'N/A'); ?></p>
    <?php if(isset($contact->ip_address)): ?>
        <p style="margin:0 0 6px;"><strong>IP Address:</strong> <?php echo e($contact->ip_address ?? 'N/A'); ?></p>
    <?php endif; ?>

    <p style="margin-top:16px;color:#6b7280;font-size:12px;">
        Sent from <?php echo e(config('app.name')); ?> booking form.
    </p>

    <p style="margin-top:10px;font-size:12px;">
        <a href="<?php echo e(url('/admin/bookings/' . $contact->id)); ?>" style="color:#059669;text-decoration:underline;">
            View this booking in admin panel
        </a>
    </p>
</body>
</html><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\emails\contact-notification.blade.php ENDPATH**/ ?>