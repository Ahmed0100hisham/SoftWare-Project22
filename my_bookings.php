<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';
requireLogin();
$errors=[]; $success=flash('booking_success');
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $action=$_POST['action'] ?? ''; $booking_id=(int)($_POST['booking_id'] ?? 0);
    if(!$errors && $action==='cancel' && $booking_id){
        $stmt=$pdo->prepare("UPDATE bookings SET status='cancelled', user_note='Cancelled by customer', updated_at=NOW() WHERE id=? AND user_id=? AND status IN ('pending','confirmed')");
        $stmt->execute([$booking_id,$_SESSION['user_id']]);
        flash('booking_success', $stmt->rowCount() ? 'Booking cancelled successfully.' : 'Booking could not be cancelled.');
        redirectTo('my_bookings.php');
    }
}
$stmt=$pdo->prepare('SELECT b.*, c.name AS car_name, c.image FROM bookings b JOIN cars c ON b.car_id=c.id WHERE b.user_id=? ORDER BY b.created_at DESC');
$stmt->execute([$_SESSION['user_id']]); $bookings=$stmt->fetchAll();
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>My Bookings - Furni</title></head><body><?php renderSiteNav('account'); ?><section class="bg-main py-5"><div class="container py-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h3 class="mb-4">Booking History</h3><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $er): ?><div><?php echo e($er); ?></div><?php endforeach; ?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?></div><?php endif; ?><div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>Car</th><th>Pickup</th><th>Return</th><th>Days</th><th>Total</th><th>Status</th><th>Actions</th></tr></thead><tbody><?php foreach($bookings as $b): ?><tr><td><?php echo e($b['car_name']); ?></td><td><?php echo e($b['pickup_date']); ?></td><td><?php echo e($b['return_date']); ?></td><td><?php echo (int)$b['total_days']; ?></td><td>$<?php echo number_format((float)$b['total_price'],2); ?></td><td><?php echo e($b['status']); ?></td><td><?php if(in_array($b['status'],['pending','confirmed'],true)): ?><a class="btn btn-sm btn-outline-dark" href="edit_booking.php?id=<?php echo (int)$b['id']; ?>">Edit</a><form method="POST" class="d-inline" onsubmit="return confirm('Cancel this booking?');"><?php echo csrfField(); ?><input type="hidden" name="booking_id" value="<?php echo (int)$b['id']; ?>"><input type="hidden" name="action" value="cancel"><button class="btn btn-sm btn-danger">Cancel</button></form><?php else: ?><span class="text-muted">No actions</span><?php endif; ?></td></tr><?php endforeach; ?><?php if(!$bookings): ?><tr><td colspan="7" class="text-center">No bookings yet.</td></tr><?php endif; ?></tbody></table></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
