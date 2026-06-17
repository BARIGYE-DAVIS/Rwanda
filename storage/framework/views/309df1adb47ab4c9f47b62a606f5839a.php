<!doctype html>
<html>
<head>
  <meta charset="utf-8" />
  <title>New Subscriber</title>
</head>
<body style="font-family:system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial; color:#111;">
  <div style="max-width:600px;margin:0 auto;padding:20px;">
    <h2 style="color:#0f172a;">New subscriber</h2>
    <p>A new subscriber was added:</p>
    <ul>
      <li><strong>Email:</strong> <?php echo e($subscriber->email); ?></li>
      <li><strong>Subscribed at:</strong> <?php echo e($subscriber->created_at ? $subscriber->created_at->toDayDateTimeString() : 'N/A'); ?></li>
    </ul>
    <p>You can view all subscribers in the admin panel.</p>
  </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\Rwanda\resources\views\emails\new-subscriber-notification.blade.php ENDPATH**/ ?>