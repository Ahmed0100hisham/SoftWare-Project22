<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';
requireLogin();
$errors=[]; $success=flash('profile_success');
$stmt=$pdo->prepare('SELECT id, username, email, role, created_at FROM users WHERE id=? LIMIT 1');
$stmt->execute([$_SESSION['user_id']]);
$user=$stmt->fetch();
if(!$user){ redirectTo('logout.php'); }
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $username=cleanInput($_POST['username'] ?? '');
    $email=cleanInput($_POST['email'] ?? '');
    if($username==='' || !preg_match('/^[A-Za-z0-9_]{3,50}$/',$username)){ $errors[]='Username must be 3-50 characters and contain only letters, numbers, and underscores.'; }
    if($email==='' || !filter_var($email,FILTER_VALIDATE_EMAIL)){ $errors[]='Please enter a valid email address.'; }
    if(!$errors){
        $check=$pdo->prepare('SELECT id FROM users WHERE (username=? OR email=?) AND id<>? LIMIT 1');
        $check->execute([$username,$email,$_SESSION['user_id']]);
        if($check->fetch()){ $errors[]='Username or email is already used.'; }
    }
    if(!$errors){
        $upd=$pdo->prepare('UPDATE users SET username=?, email=? WHERE id=?');
        $upd->execute([$username,$email,$_SESSION['user_id']]);
        $_SESSION['username']=$username; $_SESSION['email']=$email;
        flash('profile_success','Profile updated successfully.');
        redirectTo('profile.php');
    }
}
$stmt=$pdo->prepare('SELECT b.*, c.name AS car_name FROM bookings b JOIN cars c ON b.car_id=c.id WHERE b.user_id=? ORDER BY b.created_at DESC LIMIT 10');
$stmt->execute([$_SESSION['user_id']]); $bookings=$stmt->fetchAll();
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>My Account - Furni</title></head><body><?php renderSiteNav('account'); ?>
<section class="bg-main py-5"><div class="container py-4"><div class="row g-4"><div class="col-lg-5"><div class="card shadow border-0 rounded-4"><div class="card-body p-4"><h3 class="mb-4">My Account</h3><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $er): ?><div><?php echo e($er); ?></div><?php endforeach; ?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?></div><?php endif; ?><form method="POST"><?php echo csrfField(); ?><div class="mb-3"><label class="form-label">Username</label><input class="form-control" name="username" value="<?php echo e($_POST['username'] ?? $user['username']); ?>" required></div><div class="mb-3"><label class="form-label">Email</label><input class="form-control" type="email" name="email" value="<?php echo e($_POST['email'] ?? $user['email']); ?>" required></div><div class="mb-3"><label class="form-label">Role</label><input class="form-control" value="<?php echo e($user['role']); ?>" disabled></div><div class="mb-3"><label class="form-label">Created At</label><input class="form-control" value="<?php echo e($user['created_at']); ?>" disabled></div><button class="btn btn-dark rounded-pill px-4">Save Changes</button> <a class="btn btn-outline-dark rounded-pill px-4" href="change_password.php">Change Password</a></form></div></div></div><div class="col-lg-7"><div class="card shadow border-0 rounded-4"><div class="card-body p-4"><h3 class="mb-4">Recent Bookings</h3><div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>Car</th><th>Pickup</th><th>Return</th><th>Total</th><th>Status</th></tr></thead><tbody><?php foreach($bookings as $b): ?><tr><td><?php echo e($b['car_name']); ?></td><td><?php echo e($b['pickup_date']); ?></td><td><?php echo e($b['return_date']); ?></td><td>$<?php echo number_format((float)$b['total_price'],2); ?></td><td><?php echo e($b['status']); ?></td></tr><?php endforeach; ?><?php if(!$bookings): ?><tr><td colspan="5" class="text-center">No bookings yet.</td></tr><?php endif; ?></tbody></table></div><a href="my_bookings.php" class="btn btn-dark rounded-pill px-4">View All Bookings</a></div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
