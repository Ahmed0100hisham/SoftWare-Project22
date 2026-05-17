<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin(); requirePost();
if(!verifyCsrfToken()){ redirectTo('cars.php'); }
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM cars WHERE id = ?');
    $stmt->execute([$id]);
}
redirectTo('cars.php');
?>
