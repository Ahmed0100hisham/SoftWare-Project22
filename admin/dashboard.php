<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin();

$totalUsers = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$totalCars = (int)$pdo->query('SELECT COUNT(*) FROM cars')->fetchColumn();
$totalBookings = (int)$pdo->query('SELECT COUNT(*) FROM bookings')->fetchColumn();
$availableCars = (int)$pdo->query("SELECT COUNT(*) FROM cars WHERE availability = 'available'")->fetchColumn();

$recentUsers = $pdo->query('SELECT id, username, email, role, created_at FROM users ORDER BY created_at DESC LIMIT 8')->fetchAll();
$recentBookings = $pdo->query('SELECT b.*, u.username, c.name AS car_name FROM bookings b JOIN users u ON b.user_id = u.id JOIN cars c ON b.car_id = c.id ORDER BY b.created_at DESC LIMIT 8')->fetchAll();
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/all.min.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <title>Admin Dashboard - Furni</title>
    </head>
    <body>
        <?php include '_admin_nav.php'; ?>
        <section class="bg-main py-5">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-3 mb-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h5 class="card-title">Total Users</h5><h2 class="fw-bold mb-0"><?php echo $totalUsers; ?></h2></div></div></div>
                    <div class="col-md-3 mb-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h5 class="card-title">Total Cars</h5><h2 class="fw-bold mb-0"><?php echo $totalCars; ?></h2></div></div></div>
                    <div class="col-md-3 mb-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h5 class="card-title">Bookings</h5><h2 class="fw-bold mb-0"><?php echo $totalBookings; ?></h2></div></div></div>
                    <div class="col-md-3 mb-4"><div class="card shadow border-0 rounded-4"><div class="card-body"><h5 class="card-title">Available Cars</h5><h2 class="fw-bold mb-0"><?php echo $availableCars; ?></h2></div></div></div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-0 rounded-4"><div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3"><h4 class="mb-0">Recent Users</h4><a class="btn btn-sm btn-dark" href="users.php">Manage</a></div>
                            <div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr></thead><tbody>
                            <?php foreach ($recentUsers as $user): ?><tr><td><?php echo (int)$user['id']; ?></td><td><?php echo e($user['username']); ?></td><td><?php echo e($user['email']); ?></td><td><?php echo e($user['role']); ?></td></tr><?php endforeach; ?>
                            </tbody></table></div>
                        </div></div>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="card shadow border-0 rounded-4"><div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3"><h4 class="mb-0">Recent Bookings</h4><a class="btn btn-sm btn-dark" href="bookings.php">Manage</a></div>
                            <div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>User</th><th>Car</th><th>Total</th><th>Status</th></tr></thead><tbody>
                            <?php foreach ($recentBookings as $booking): ?><tr><td><?php echo e($booking['username']); ?></td><td><?php echo e($booking['car_name']); ?></td><td>$<?php echo number_format((float)$booking['total_price'], 2); ?></td><td><?php echo e($booking['status']); ?></td></tr><?php endforeach; ?>
                            </tbody></table></div>
                        </div></div>
                    </div>
                </div>
            </div>
        </section>
        <script src="../js/bootstrap.bundle.min.js"></script>
    </body>
</html>
