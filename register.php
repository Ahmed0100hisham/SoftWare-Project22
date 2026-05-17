<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken()) { $errors[] = 'Security check failed. Please try again.'; }
    $username = cleanInput($_POST['username'] ?? '');
    $email = cleanInput($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($username === '') {
        $errors[] = 'Username is required.';
    } elseif (!preg_match('/^[A-Za-z0-9_]{3,50}$/', $username)) {
        $errors[] = 'Username must be 3-50 characters and contain only letters, numbers, and underscores.';
    }

    if ($email === '') {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($password === '') {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 6) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if ($confirm_password === '') {
        $errors[] = 'Confirm password is required.';
    } elseif ($password !== $confirm_password) {
        $errors[] = 'Passwords do not match.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1');
        $stmt->execute(['username' => $username, 'email' => $email]);

        if ($stmt->fetch()) {
            $errors[] = 'Username or email already exists.';
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)');
            $stmt->execute([
                'username' => $username,
                'email' => $email,
                'password' => $hashed_password,
                'role' => 'user'
            ]);
            $success = 'Registration successful. You can now login.';
        }
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <title>Register - Furni</title>
    </head>
    <body>
        <?php renderSiteNav('register'); ?>

        <section class="bg-main py-5">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow border-0 rounded-4">
                            <div class="card-body p-5">
                                <h2 class="text-center mb-4">Create Account</h2>
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger"><?php foreach ($errors as $error): ?><div><?php echo $error; ?></div><?php endforeach; ?></div>
                                <?php endif; ?>
                                <?php if ($success): ?>
                                    <div class="alert alert-success"><?php echo $success; ?></div>
                                <?php endif; ?>
                                <form method="POST" action="register.php" novalidate>
                                    <?php echo csrfField(); ?>
                                    <div class="mb-3">
                                        <label class="form-label">Username</label>
                                        <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($_POST['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 rounded-5">Register</button>
                                </form>
                                <p class="text-center mt-3 mb-0">Already have an account? <a href="login.php">Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html>
