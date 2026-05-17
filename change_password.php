<?php
require_once './config/db.php'; require_once './includes/auth.php'; require_once './includes/site_nav.php'; requireLogin();
$errors=[]; $success='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $current=$_POST['current_password'] ?? ''; $new=$_POST['new_password'] ?? ''; $confirm=$_POST['confirm_password'] ?? '';
    if($current==='' || $new==='' || $confirm===''){ $errors[]='All password fields are required.'; }
    if($new!=='' && strlen($new)<6){ $errors[]='New password must be at least 6 characters.'; }
    if($new!==$confirm){ $errors[]='New passwords do not match.'; }
    if(!$errors){ $stmt=$pdo->prepare('SELECT password FROM users WHERE id=?'); $stmt->execute([$_SESSION['user_id']]); $u=$stmt->fetch(); if(!$u || !password_verify($current,$u['password'])){ $errors[]='Current password is incorrect.'; } }
    if(!$errors){ $stmt=$pdo->prepare('UPDATE users SET password=? WHERE id=?'); $stmt->execute([password_hash($new,PASSWORD_DEFAULT),$_SESSION['user_id']]); $success='Password changed successfully.'; }
}
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Change Password - Furni</title></head><body><?php renderSiteNav('account'); ?><section class="bg-main py-5"><div class="container py-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card shadow border-0 rounded-4"><div class="card-body p-5"><h2 class="text-center mb-4">Change Password</h2><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e): ?><div><?php echo e($e); ?></div><?php endforeach; ?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?></div><?php endif; ?><form method="POST"><?php echo csrfField(); ?><div class="mb-3"><label class="form-label">Current Password</label><input type="password" name="current_password" class="form-control" required></div><div class="mb-3"><label class="form-label">New Password</label><input type="password" name="new_password" class="form-control" required></div><div class="mb-3"><label class="form-label">Confirm New Password</label><input type="password" name="confirm_password" class="form-control" required></div><button class="btn btn-dark w-100 rounded-5">Update Password</button></form></div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
