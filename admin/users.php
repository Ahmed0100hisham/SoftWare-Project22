<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin();
$search=cleanInput($_GET['search']??'');
$params=[]; $where='';
if($search!==''){ $where='WHERE username LIKE :search OR email LIKE :search OR role LIKE :search'; $params['search']="%$search%"; }
$stmt=$pdo->prepare("SELECT id, username, email, role, created_at FROM users $where ORDER BY created_at DESC"); $stmt->execute($params); $users=$stmt->fetchAll();
?>
<html><head><link rel="stylesheet" href="../css/all.min.css"><link rel="stylesheet" href="../css/bootstrap.min.css"><link rel="stylesheet" href="../css/style.css"><title>Manage Users - Furni</title></head><body><?php include '_admin_nav.php'; ?>
<section class="bg-main py-5"><div class="container py-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h3 class="mb-4">Manage Users</h3><form class="row g-3 mb-4" method="GET"><div class="col-md-10"><input class="form-control" name="search" placeholder="Search users" value="<?php echo e($search); ?>"></div><div class="col-md-2"><button class="btn btn-dark w-100">Search</button></div></form>
<div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Created At</th><th>Action</th></tr></thead><tbody><?php foreach($users as $user): ?><tr><td><?php echo (int)$user['id']; ?></td><td><?php echo e($user['username']); ?></td><td><?php echo e($user['email']); ?></td><td><?php echo e($user['role']); ?></td><td><?php echo e($user['created_at']); ?></td><td><?php if((int)$user['id'] !== (int)$_SESSION['user_id']): ?><form method="POST" action="delete_user.php" class="d-inline" onsubmit="return confirm('Delete this user?');"><?php echo csrfField(); ?><input type="hidden" name="id" value="<?php echo (int)$user['id']; ?>"><button class="btn btn-sm btn-danger">Delete</button></form><?php else: ?><span class="badge bg-secondary">Current Admin</span><?php endif; ?></td></tr><?php endforeach; ?></tbody></table></div>
</div></div></div></section><script src="../js/bootstrap.bundle.min.js"></script></body></html>
