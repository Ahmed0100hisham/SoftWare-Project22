<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin();
$success=flash('admin_message_success'); $errors=[];
if($_SERVER['REQUEST_METHOD']==='POST'){
    if(!verifyCsrfToken()){ $errors[]='Security check failed. Please try again.'; }
    $id=(int)($_POST['id'] ?? 0); $action=$_POST['action'] ?? '';
    if(!$errors && $id){
        if($action==='delete'){
            $stmt=$pdo->prepare('DELETE FROM contact_messages WHERE id=?'); $stmt->execute([$id]); flash('admin_message_success','Message deleted successfully.'); redirectTo('messages.php');
        } elseif($action==='mark_read'){
            $stmt=$pdo->prepare("UPDATE contact_messages SET status='read' WHERE id=?"); $stmt->execute([$id]); flash('admin_message_success','Message marked as read.'); redirectTo('messages.php');
        } elseif($action==='reply'){
            $reply=cleanInput($_POST['admin_reply'] ?? '');
            $stmt=$pdo->prepare("UPDATE contact_messages SET admin_reply=?, status='replied' WHERE id=?"); $stmt->execute([$reply,$id]); flash('admin_message_success','Reply note saved.'); redirectTo('messages.php');
        }
    }
}
$status=cleanInput($_GET['status'] ?? ''); $search=cleanInput($_GET['search'] ?? ''); $params=[]; $where=[];
if($status!==''){ $where[]='status=?'; $params[]=$status; }
if($search!==''){ $where[]='(first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR subject LIKE ?)'; array_push($params,"%$search%","%$search%","%$search%","%$search%"); }
$sql='SELECT * FROM contact_messages'.($where?' WHERE '.implode(' AND ',$where):'').' ORDER BY created_at DESC';
$stmt=$pdo->prepare($sql); $stmt->execute($params); $messages=$stmt->fetchAll();
?>
<html><head><link rel="stylesheet" href="../css/all.min.css"><link rel="stylesheet" href="../css/bootstrap.min.css"><link rel="stylesheet" href="../css/style.css"><title>Contact Messages - Furni</title></head><body><?php include '_admin_nav.php'; ?>
<section class="bg-main py-5"><div class="container py-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h3 class="mb-4">Contact Messages</h3><?php if($success): ?><div class="alert alert-success"><?php echo e($success); ?></div><?php endif; ?><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $er): ?><div><?php echo e($er); ?></div><?php endforeach; ?></div><?php endif; ?><form class="row g-3 mb-4" method="GET"><div class="col-md-5"><input class="form-control" name="search" placeholder="Search messages" value="<?php echo e($search); ?>"></div><div class="col-md-4"><select class="form-select" name="status"><option value="">All Status</option><?php foreach(['new','read','replied'] as $s): ?><option value="<?php echo $s; ?>" <?php echo $status===$s?'selected':''; ?>><?php echo ucfirst($s); ?></option><?php endforeach; ?></select></div><div class="col-md-3"><button class="btn btn-dark w-100">Filter</button></div></form><div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th>Status</th><th>Reply Note</th><th>Date</th><th>Actions</th></tr></thead><tbody><?php foreach($messages as $m): ?><tr><td><?php echo e($m['first_name'].' '.$m['last_name']); ?></td><td><?php echo e($m['email']); ?></td><td><?php echo e($m['phone']); ?></td><td><?php echo e($m['subject']); ?></td><td style="min-width:220px"><?php echo e($m['message']); ?></td><td><?php echo e($m['status'] ?? 'new'); ?></td><td style="min-width:220px"><form method="POST" class="d-flex gap-2"><?php echo csrfField(); ?><input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>"><input type="hidden" name="action" value="reply"><input class="form-control form-control-sm" name="admin_reply" value="<?php echo e($m['admin_reply'] ?? ''); ?>" placeholder="Admin reply note"><button class="btn btn-sm btn-dark">Save</button></form></td><td><?php echo e($m['created_at']); ?></td><td><form method="POST" class="d-inline"><?php echo csrfField(); ?><input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>"><input type="hidden" name="action" value="mark_read"><button class="btn btn-sm btn-outline-dark">Read</button></form><form method="POST" class="d-inline" onsubmit="return confirm('Delete this message?');"><?php echo csrfField(); ?><input type="hidden" name="id" value="<?php echo (int)$m['id']; ?>"><input type="hidden" name="action" value="delete"><button class="btn btn-sm btn-danger">Delete</button></form></td></tr><?php endforeach; ?><?php if(!$messages): ?><tr><td colspan="9" class="text-center">No messages found.</td></tr><?php endif; ?></tbody></table></div></div></div></div></section><script src="../js/bootstrap.bundle.min.js"></script></body></html>
