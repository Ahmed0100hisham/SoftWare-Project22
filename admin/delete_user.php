<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin(); requirePost();
if(!verifyCsrfToken()){ redirectTo('users.php'); }
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id && $id !== (int)$_SESSION['user_id']) {
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id AND role != :admin_role');
    $stmt->execute(['id' => $id, 'admin_role' => 'admin']);
}
header('Location: users.php');
exit;
?>
