<?php
require_once '../config/db.php';
require_once '../includes/auth.php';
requireAdmin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];
$car = ['name'=>'','category'=>'','price_per_day'=>'','image'=>'','description'=>'','availability'=>'available'];
if ($id) {
    $stmt = $pdo->prepare('SELECT * FROM cars WHERE id = ?');
    $stmt->execute([$id]);
    $car = $stmt->fetch();
    if (!$car) { redirectTo('cars.php'); }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken()) { $errors[] = 'Security check failed. Please try again.'; }
    $name = cleanInput($_POST['name'] ?? '');
    $category = cleanInput($_POST['category'] ?? '');
    $price = (float)($_POST['price_per_day'] ?? 0);
    $description = cleanInput($_POST['description'] ?? '');
    $availability = in_array($_POST['availability'] ?? '', ['available','unavailable'], true) ? $_POST['availability'] : 'available';
    $imagePath = $car['image'] ?? '';
    if ($name === '') $errors[] = 'Car name is required.';
    if ($category === '') $errors[] = 'Category is required.';
    if ($price <= 0) $errors[] = 'Price per day must be greater than zero.';
    if (!empty($_FILES['image']['name'])) {
        $allowed = ['image/jpeg'=>'jpg','image/png'=>'png','image/webp'=>'webp','image/avif'=>'avif'];
        $type = mime_content_type($_FILES['image']['tmp_name']);
        if (!isset($allowed[$type])) { $errors[] = 'Only JPG, PNG, WEBP, and AVIF images are allowed.'; }
        elseif ($_FILES['image']['size'] > 2 * 1024 * 1024) { $errors[] = 'Image size must be less than 2MB.'; }
        else {
            $fileName = 'car_' . time() . '_' . rand(1000,9999) . '.' . $allowed[$type];
            $target = '../uploads/cars/' . $fileName;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) { $imagePath = 'uploads/cars/' . $fileName; }
            else { $errors[] = 'Image upload failed.'; }
        }
    }
    if (!$errors) {
        if ($id) {
            $stmt = $pdo->prepare('UPDATE cars SET name=?, category=?, price_per_day=?, image=?, description=?, availability=? WHERE id=?');
            $stmt->execute([$name,$category,$price,$imagePath,$description,$availability,$id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO cars (name, category, price_per_day, image, description, availability) VALUES (?,?,?,?,?,?)');
            $stmt->execute([$name,$category,$price,$imagePath,$description,$availability]);
        }
        redirectTo('cars.php');
    }
    $car = compact('name','category','description','availability'); $car['price_per_day']=$price; $car['image']=$imagePath;
}
?>
<html><head><link rel="stylesheet" href="../css/all.min.css"><link rel="stylesheet" href="../css/bootstrap.min.css"><link rel="stylesheet" href="../css/style.css"><title><?php echo $id?'Edit':'Add'; ?> Car - Furni</title></head><body><?php include '_admin_nav.php'; ?>
<section class="bg-main py-5"><div class="container py-4"><div class="row justify-content-center"><div class="col-lg-8"><div class="card shadow border-0 rounded-4"><div class="card-body p-5">
<h3 class="mb-4"><?php echo $id?'Edit':'Add'; ?> Car</h3><?php if($errors): ?><div class="alert alert-danger"><?php foreach($errors as $error): ?><div><?php echo e($error); ?></div><?php endforeach; ?></div><?php endif; ?>
<form method="POST" enctype="multipart/form-data">
<?php echo csrfField(); ?>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label">Car Name</label><input class="form-control" name="name" value="<?php echo e($car['name']); ?>" required></div><div class="col-md-6 mb-3"><label class="form-label">Category</label><input class="form-control" name="category" value="<?php echo e($car['category']); ?>" required></div></div>
<div class="row"><div class="col-md-6 mb-3"><label class="form-label">Price Per Day</label><input class="form-control" type="number" step="0.01" min="1" name="price_per_day" value="<?php echo e($car['price_per_day']); ?>" required></div><div class="col-md-6 mb-3"><label class="form-label">Availability</label><select class="form-select" name="availability"><option value="available" <?php echo $car['availability']==='available'?'selected':''; ?>>Available</option><option value="unavailable" <?php echo $car['availability']==='unavailable'?'selected':''; ?>>Unavailable</option></select></div></div>
<div class="mb-3"><label class="form-label">Car Image</label><input class="form-control" type="file" name="image" accept="image/*"><?php if(!empty($car['image'])): ?><img class="mt-3" src="../<?php echo e($car['image']); ?>" style="width:160px;height:100px;object-fit:contain" alt="Current image"><?php endif; ?></div>
<div class="mb-3"><label class="form-label">Description</label><textarea class="form-control" name="description" rows="4"><?php echo e($car['description']); ?></textarea></div>
<button class="btn btn-dark rounded-pill px-4" type="submit">Save Car</button> <a class="btn btn-secondary rounded-pill px-4" href="cars.php">Cancel</a>
</form></div></div></div></div></div></section><script src="../js/bootstrap.bundle.min.js"></script></body></html>
