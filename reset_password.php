<?php
require_once './config/db.php'; require_once './includes/auth.php'; require_once './includes/site_nav.php';
$token=$_GET['token'] ?? $_POST['token'] ?? ''; $errors=[]; $success=''; $valid=false;
if($token){ $hash=hash('sha256',$token); $stmt=$pdo->prepare('SELECT id FROM users WHERE reset_token=? AND reset_expires > NOW() LIMIT 1'); $stmt->execute([$hash]); $resetUser=$stmt->fetch(); $valid=(bool)$resetUser; }
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    if(!$valid){ $errors[]='Invalid or expired reset token.'; }
    $password=$_POST['password'] ?? ''; $confirm=$_POST['confirm_password'] ?? '';
    if(strlen($password)<6){ $errors[]='Password must be at least 6 characters.'; }
    if($password!==$confirm){ $errors[]='Passwords do not match.'; }
    if(!$errors){ $stmt=$pdo->prepare('UPDATE users SET password=?, reset_token=NULL, reset_expires=NULL WHERE id=?'); $stmt->execute([password_hash($password,PASSWORD_DEFAULT),$resetUser['id']]); $success='Password reset successfully. You can now login.'; $valid=false; }
}
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Reset Password - Furni</title></head><body><?php renderSiteNav('login'); ?><section class="bg-main py-5"><div class="container py-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card shadow border-0 rounded-4"><div class="card-body p-5"><h2 class="text-center mb-4">Reset Password</h2><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e): ?><div><?php echo e($e); ?></div><?php endforeach; ?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?> <a href="login.php">Login</a></div><?php endif; ?><?php if($valid): ?><form method="POST"><?php echo csrfField(); ?><input type="hidden" name="token" value="<?php echo e($token); ?>"><div class="mb-3"><label class="form-label">New Password</label><input type="password" name="password" class="form-control" required></div><div class="mb-3"><label class="form-label">Confirm Password</label><input type="password" name="confirm_password" class="form-control" required></div><button class="btn btn-dark w-100 rounded-5">Reset Password</button></form><?php elseif(!$success): ?><div class="alert alert-danger">Invalid or expired reset token.</div><?php endif; ?></div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
