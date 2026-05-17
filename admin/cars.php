<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin();

$search = cleanInput($_GET['search'] ?? '');
$category = cleanInput($_GET['category'] ?? '');
$availability = cleanInput($_GET['availability'] ?? '');
$params = [];
$where = [];
if ($search !== '') { $where[] = '(name LIKE :search OR description LIKE :search)'; $params['search'] = "%$search%"; }
if ($category !== '') { $where[] = 'category = :category'; $params['category'] = $category; }
if ($availability !== '') { $where[] = 'availability = :availability'; $params['availability'] = $availability; }
$sql = 'SELECT * FROM cars' . ($where ? ' WHERE ' . implode(' AND ', $where) : '') . ' ORDER BY created_at DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$cars = $stmt->fetchAll();
$categories = $pdo->query('SELECT DISTINCT category FROM cars ORDER BY category')->fetchAll();
?>
<html><head><link rel="stylesheet" href="../css/all.min.css"><link rel="stylesheet" href="../css/bootstrap.min.css"><link rel="stylesheet" href="../css/style.css"><title>Manage Cars - Furni</title></head><body>
<?php include '_admin_nav.php'; ?>
<section class="bg-main py-5"><div class="container py-4">
    <div class="card shadow border-0 rounded-4"><div class="card-body">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4"><h3 class="mb-2">Manage Cars</h3><a class="btn btn-dark rounded-pill px-4" href="car_form.php">Add Car</a></div>
        <form class="row g-3 mb-4" method="GET">
            <div class="col-md-4"><input class="form-control" type="text" name="search" placeholder="Search cars" value="<?php echo e($search); ?>"></div>
            <div class="col-md-3"><select class="form-select" name="category"><option value="">All Categories</option><?php foreach ($categories as $cat): ?><option value="<?php echo e($cat['category']); ?>" <?php echo $category===$cat['category']?'selected':''; ?>><?php echo e($cat['category']); ?></option><?php endforeach; ?></select></div>
            <div class="col-md-3"><select class="form-select" name="availability"><option value="">All Status</option><option value="available" <?php echo $availability==='available'?'selected':''; ?>>Available</option><option value="unavailable" <?php echo $availability==='unavailable'?'selected':''; ?>>Unavailable</option></select></div>
            <div class="col-md-2"><button class="btn btn-dark w-100" type="submit">Filter</button></div>
        </form>
        <div class="table-responsive"><table class="table table-striped align-middle"><thead class="table-dark"><tr><th>Image</th><th>Name</th><th>Category</th><th>Price/Day</th><th>Status</th><th>Actions</th></tr></thead><tbody>
        <?php foreach ($cars as $car): ?><tr>
            <td><?php if ($car['image']): ?><img src="../<?php echo e($car['image']); ?>" style="width:80px;height:55px;object-fit:contain" alt=""><?php else: ?><span class="text-muted">No image</span><?php endif; ?></td>
            <td><?php echo e($car['name']); ?></td><td><?php echo e($car['category']); ?></td><td>$<?php echo number_format((float)$car['price_per_day'],2); ?></td><td><?php echo e($car['availability']); ?></td>
            <td><a class="btn btn-sm btn-warning" href="car_form.php?id=<?php echo (int)$car['id']; ?>">Edit</a> <form method="POST" action="delete_car.php" class="d-inline" onsubmit="return confirm('Delete this car?');"><?php echo csrfField(); ?><input type="hidden" name="id" value="<?php echo (int)$car['id']; ?>"><button class="btn btn-sm btn-danger">Delete</button></form></td>
        </tr><?php endforeach; ?>
        </tbody></table></div>
    </div></div>
</div></section><script src="../js/bootstrap.bundle.min.js"></script></body></html>
