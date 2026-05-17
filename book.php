<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';
requireLogin();
$car_id=(int)($_GET['car_id'] ?? $_POST['car_id'] ?? 0);
$stmt=$pdo->prepare("SELECT * FROM cars WHERE id=? AND availability='available'"); $stmt->execute([$car_id]); $car=$stmt->fetch();
if(!$car){ redirectTo('shop.php'); }
$errors=[]; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $pickup=$_POST['pickup_date'] ?? '';
    $return=$_POST['return_date'] ?? '';
    $today=date('Y-m-d');
    if(!$pickup || !$return){ $errors[]='Pickup and return dates are required.'; }
    elseif($pickup < $today){ $errors[]='Pickup date cannot be in the past.'; }
    elseif($return <= $pickup){ $errors[]='Return date must be after pickup date.'; }
    $conflict=false;
    if(!$errors){
        $stmt=$pdo->prepare("SELECT COUNT(*) FROM bookings WHERE car_id=? AND status IN ('pending','confirmed') AND NOT (return_date <= ? OR pickup_date >= ?)");
        $stmt->execute([$car_id,$pickup,$return]);
        $conflict=((int)$stmt->fetchColumn())>0;
        if($conflict) $errors[]='This car is already booked for the selected dates.';
    }
    if(!$errors){
        $days=(new DateTime($pickup))->diff(new DateTime($return))->days;
        $total=$days*(float)$car['price_per_day'];
        $stmt=$pdo->prepare('INSERT INTO bookings (user_id, car_id, pickup_date, return_date, total_days, total_price, user_note) VALUES (?,?,?,?,?,?,?)');
        $stmt->execute([$_SESSION['user_id'],$car_id,$pickup,$return,$days,$total,cleanInput($_POST['user_note'] ?? '')]);
        $success='Booking submitted successfully.';
    }
}
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Book Car - Furni</title></head><body>
<?php renderSiteNav('shop'); ?>
<section class="bg-main py-5"><div class="container py-5"><div class="row justify-content-center"><div class="col-lg-8"><div class="card shadow border-0 rounded-4"><div class="card-body p-5"><h2 class="mb-4">Book <?php echo e($car['name']); ?></h2><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $er): ?><div><?php echo e($er); ?></div><?php endforeach; ?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?> <a href="my_bookings.php">View booking history</a></div><?php endif; ?><div class="row"><div class="col-md-5"><img class="img-fluid" src="./<?php echo e($car['image']); ?>" alt="<?php echo e($car['name']); ?>"></div><div class="col-md-7"><p><?php echo e($car['description']); ?></p><p class="fw-bold fs-5">$<?php echo number_format((float)$car['price_per_day'],2); ?>/day</p><form method="POST"><?php echo csrfField(); ?><input type="hidden" name="car_id" value="<?php echo (int)$car['id']; ?>"><div class="mb-3"><label class="form-label">Pickup Date</label><input class="form-control" type="date" name="pickup_date" required></div><div class="mb-3"><label class="form-label">Return Date</label><input class="form-control" type="date" name="return_date" required></div><div class="mb-3"><label class="form-label">Note (optional)</label><textarea class="form-control" name="user_note" rows="2"></textarea></div><button class="btn btn-dark rounded-pill px-4" type="submit">Confirm Booking</button></form></div></div></div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
