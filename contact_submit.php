<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';

$errors = [];
if (!verifyCsrfToken()) { $errors[] = 'Security check failed. Please try again.'; }
$first = cleanInput($_POST['first_name'] ?? '');
$last = cleanInput($_POST['last_name'] ?? '');
$email = cleanInput($_POST['email'] ?? '');
$phone = cleanInput($_POST['phone'] ?? '');
$subject = cleanInput($_POST['subject'] ?? '');
$message = cleanInput($_POST['message'] ?? '');

if ($first === '') $errors[] = 'First name is required.';
if ($last === '') $errors[] = 'Last name is required.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
if ($subject === '') $errors[] = 'Subject is required.';
if ($message === '') $errors[] = 'Message is required.';

if (!$errors) {
    $stmt = $pdo->prepare('INSERT INTO contact_messages (first_name, last_name, email, phone, subject, message) VALUES (?,?,?,?,?,?)');
    $stmt->execute([$first, $last, $email, $phone, $subject, $message]);
}
?>
<html>
    <head><link rel="stylesheet" href="./css/all.min.css"><link rel="stylesheet" href="./css/bootstrap.min.css"><link rel="stylesheet" href="./css/style.css"><title>Contact Message - Furni</title></head>
    <body>
                <?php renderSiteNav('contact'); ?>
        <section class="bg-main py-5"><div class="container py-5"><div class="row justify-content-center"><div class="col-md-6"><div class="card shadow border-0 rounded-4"><div class="card-body p-5 text-center">
            <?php if ($errors): ?><div class="alert alert-danger text-start"><?php foreach($errors as $error): ?><div><?php echo e($error); ?></div><?php endforeach; ?></div><a class="btn btn-dark rounded-pill px-4" href="contact.php">Back to Contact</a><?php else: ?><div class="alert alert-success">Your message has been saved successfully. We will contact you soon.</div><a class="btn btn-dark rounded-pill px-4" href="index.php">Back Home</a><?php endif; ?>
        </div></div></div></div></div></section><script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html>
