<?php
require_once './config/db.php'; require_once './includes/auth.php'; require_once './includes/site_nav.php';
$errors=[]; $success=''; $reset_link='';
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $email=cleanInput($_POST['email'] ?? '');
    if($email==='' || !filter_var($email,FILTER_VALIDATE_EMAIL)){ $errors[]='Please enter a valid email address.'; }
    if(!$errors){
        $stmt=$pdo->prepare('SELECT id FROM users WHERE email=? LIMIT 1'); $stmt->execute([$email]); $user=$stmt->fetch();
        if($user){
            $token=bin2hex(random_bytes(32)); $hash=hash('sha256',$token); $expires=date('Y-m-d H:i:s', time()+3600);
            $upd=$pdo->prepare('UPDATE users SET reset_token=?, reset_expires=? WHERE id=?'); $upd->execute([$hash,$expires,$user['id']]);
            $reset_link='reset_password.php?token='.$token;
        }
        $success='If this email exists, a password reset link has been generated. For local testing, use the link shown below.';
    }
}
?>
<html><head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Forgot Password - Furni</title></head><body><?php renderSiteNav('login'); ?><section class="bg-main py-5"><div class="container py-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card shadow border-0 rounded-4"><div class="card-body p-5"><h2 class="text-center mb-4">Forgot Password</h2><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $e): ?><div><?php echo e($e); ?></div><?php endforeach; ?></div><?php endif; ?><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?><?php if($reset_link): ?><br><a href="<?php echo e($reset_link); ?>">Open Reset Link</a><?php endif; ?></div><?php endif; ?><form method="POST"><?php echo csrfField(); ?><div class="mb-3"><label class="form-label">Email Address</label><input type="email" name="email" class="form-control" value="<?php echo e($_POST['email'] ?? ''); ?>" required></div><button class="btn btn-dark w-100 rounded-5">Generate Reset Link</button></form><p class="text-center mt-3 mb-0"><a href="login.php">Back to Login</a></p></div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script></body></html>
