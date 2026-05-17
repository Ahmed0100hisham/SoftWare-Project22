<?php
require_once './config/db.php'; require_once './includes/auth.php'; require_once './includes/site_nav.php'; requireLogin();
$id=(int)($_GET['id'] ?? $_POST['id'] ?? 0); $errors=[]; $success='';
$stmt=$pdo->prepare('SELECT b.*, c.name AS car_name, c.price_per_day FROM bookings b JOIN cars c ON b.car_id=c.id WHERE b.id=? AND b.user_id=? LIMIT 1');
$stmt->execute([$id,$_SESSION['user_id']]); $booking=$stmt->fetch();
if(!$booking){ redirectTo('my_bookings.php'); }
if(!in_array($booking['status'],['pending','confirmed'],true)){ flash('booking_success','This booking cannot be edited.'); redirectTo('my_bookings.php'); }
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $pickup=$_POST['pickup_date'] ?? ''; $return=$_POST['return_date'] ?? ''; $today=date('Y-m-d');
    if(!$pickup || !$return){ $errors[]='Pickup and return dates are required.'; }
    elseif($pickup < $today){ $errors[]='Pickup date cannot be in the past.'; }
    elseif($return <= $pickup){ $errors[]='Return date must be after pickup date.'; }
    if(!$errors){
        $stmt=$pdo->prepare("SELECT COUNT(*) FROM bookings WHERE car_id=? AND id<>? AND status IN ('pending','confirmed') AND NOT (return_date <= ? OR pickup_date >= ?)");
        $stmt->execute([$booking['car_id'],$booking['id'],$pickup,$return]);
        if((int)$stmt->fetchColumn()>0){ $errors[]='This car is already booked for the selected dates.'; }
    }
    if(!$errors){
        $days=(new DateTime($pickup))->diff(new DateTime($return))->days; $total=$days*(float)$booking['price_per_day'];
        $stmt=$pdo->prepare('UPDATE bookings SET pickup_date=?, return_date=?, total_days=?, total_price=?, user_note=?, updated_at=NOW() WHERE id=? AND user_id=?');
        $stmt->execute([$pickup,$return,$days,$total,cleanInput($_POST['user_note'] ?? ''),$booking['id'],$_SESSION['user_id']]);
        flash('booking_success','Booking updated successfully.'); redirectTo('my_bookings.php');
    }
}
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Edit Booking - Furni</title></head><body><?php renderSiteNav('account'); ?><section class="bg-main py-5"><div class="container py-5"><div class="row justify-content-center"><div class="col-lg-7"><div class="card shadow border-0 rounded-4"><div class="card-body p-5"><h2 class="mb-4">Edit Booking: <?php echo e($booking['car_name']); ?></h2><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $er): ?><div><?php echo e($er); ?></div><?php endforeach; ?></div><?php endif; ?><form method="POST"><?php echo csrfField(); ?><input type="hidden" name="id" value="<?php echo (int)$booking['id']; ?>"><div class="mb-3"><label class="form-label">Pickup Date</label><input class="form-control" type="date" name="pickup_date" value="<?php echo e($_POST['pickup_date'] ?? $booking['pickup_date']); ?>" required></div><div class="mb-3"><label class="form-label">Return Date</label><input class="form-control" type="date" name="return_date" value="<?php echo e($_POST['return_date'] ?? $booking['return_date']); ?>" required></div><div class="mb-3"><label class="form-label">Note</label><textarea class="form-control" name="user_note" rows="3"><?php echo e($_POST['user_note'] ?? $booking['user_note'] ?? ''); ?></textarea></div><button class="btn btn-dark rounded-pill px-4">Save Changes</button> <a class="btn btn-outline-dark rounded-pill px-4" href="my_bookings.php">Back</a></form></div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
