<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';
$search = cleanInput($_GET['search'] ?? '');
$category = cleanInput($_GET['category'] ?? '');
$availability = cleanInput($_GET['availability'] ?? '');
$min_price = $_GET['min_price'] ?? '';
$max_price = $_GET['max_price'] ?? '';
$params=[]; $where=[];
if($search!==''){ $where[]='(name LIKE :search OR description LIKE :search)'; $params['search']="%$search%"; }
if($category!==''){ $where[]='category = :category'; $params['category']=$category; }
if($availability!==''){ $where[]='availability = :availability'; $params['availability']=$availability; }
if($min_price!=='' && is_numeric($min_price)){ $where[]='price_per_day >= :min_price'; $params['min_price']=$min_price; }
if($max_price!=='' && is_numeric($max_price)){ $where[]='price_per_day <= :max_price'; $params['max_price']=$max_price; }
$sql='SELECT * FROM cars'.($where?' WHERE '.implode(' AND ',$where):'').' ORDER BY created_at DESC';
$stmt=$pdo->prepare($sql); $stmt->execute($params); $cars=$stmt->fetchAll();
$categories=$pdo->query('SELECT DISTINCT category FROM cars ORDER BY category')->fetchAll();
?>
<html>
    <head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Shop - Furni Modern Car Rental</title></head>
    <body>
        <?php renderSiteNav('shop'); ?>
        <section class="bg-sec1 py-5"><div class="container py-5"><div class="row"><div class="col-md-6"><h1 class="display-4 fw-bold">Our Premium Fleet</h1><p class="lead">Discover our collection of high-performance luxury vehicles ready for your next adventure. From sleek Ferrari models to elegant sedans, we have the perfect car for every occasion.</p></div></div></div></section>
        <section class="bg-main py-5"><div class="container">
            <div class="row mb-5"><div class="col-12 text-center"><h2 class="fw-bold">Featured Vehicles</h2><p class="text-muted">Browse our selection of premium cars available for rent</p></div></div>
            <form method="GET" class="card border-0 shadow-sm rounded-4 mb-5"><div class="card-body"><div class="row g-3"><div class="col-md-3"><input class="form-control" type="text" name="search" placeholder="Search cars" value="<?php echo e($search); ?>"></div><div class="col-md-2"><select class="form-select" name="category"><option value="">Category</option><?php foreach($categories as $cat): ?><option value="<?php echo e($cat['category']); ?>" <?php echo $category===$cat['category']?'selected':''; ?>><?php echo e($cat['category']); ?></option><?php endforeach; ?></select></div><div class="col-md-2"><input class="form-control" type="number" name="min_price" placeholder="Min price" value="<?php echo e($min_price); ?>"></div><div class="col-md-2"><input class="form-control" type="number" name="max_price" placeholder="Max price" value="<?php echo e($max_price); ?>"></div><div class="col-md-2"><select class="form-select" name="availability"><option value="">Availability</option><option value="available" <?php echo $availability==='available'?'selected':''; ?>>Available</option><option value="unavailable" <?php echo $availability==='unavailable'?'selected':''; ?>>Unavailable</option></select></div><div class="col-md-1"><button class="btn btn-dark w-100" type="submit">Go</button></div></div></div></form>
            <div class="row">
                <?php if(!$cars): ?><div class="col-12"><div class="alert alert-info">No cars found.</div></div><?php endif; ?>
                <?php foreach($cars as $car): ?><div class="col-md-4 mb-4 product-hover"><div class="product-item"><img class="w-100 img-hover" src="./<?php echo e($car['image'] ?: 'img/sport-car-transparent-background-3d-rendering-illustration_494250-46557.avif'); ?>" alt="<?php echo e($car['name']); ?>"><div class="p-3"><h4 class="fw-bold mt-3"><?php echo e($car['name']); ?></h4><p><?php echo e($car['description']); ?></p><p><span class="badge bg-secondary"><?php echo e($car['category']); ?></span> <span class="badge <?php echo $car['availability']==='available'?'bg-success':'bg-danger'; ?>"><?php echo e($car['availability']); ?></span></p><div class="d-flex justify-content-between align-items-center"><p class="fw-bold fs-5 mb-0">$<?php echo number_format((float)$car['price_per_day'],2); ?>/day</p><?php if($car['availability']==='available'): ?><button class="btn btn-dark rounded-pill px-4"><a class="text-decoration-none text-white" href="book.php?car_id=<?php echo (int)$car['id']; ?>">Rent Now</a></button><?php else: ?><button class="btn btn-secondary rounded-pill px-4" disabled>Unavailable</button><?php endif; ?></div></div></div></div><?php endforeach; ?>
            </div>
        </div></section>
        <script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html>
