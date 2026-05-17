<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin(); requirePost();
if(!verifyCsrfToken()){ flash('booking_admin_success','Security check failed. Please try again.'); redirectTo('bookings.php'); }
$id=(int)($_POST['id']??0); $status=$_POST['status']??'pending'; $admin_notes=cleanInput($_POST['admin_notes'] ?? ''); $status_reason=cleanInput($_POST['status_reason'] ?? '');
if($id && in_array($status,['pending','confirmed','cancelled','completed'],true)){
    $stmt=$pdo->prepare('UPDATE bookings SET status=?, admin_notes=?, status_reason=?, updated_at=NOW() WHERE id=?');
    $stmt->execute([$status,$admin_notes,$status_reason,$id]);
    flash('booking_admin_success','Booking updated successfully.');
}
redirectTo('bookings.php');
?>
