<?php
require_once './config/db.php';
require_once './includes/auth.php';
require_once './includes/site_nav.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verifyCsrfToken()) { $errors[] = 'Security check failed. Please try again.'; }
    $login = cleanInput($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($login === '') {
        $errors[] = 'Email or username is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = :login OR username = :login LIMIT 1');
        $stmt->execute(['login' => $login]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header('Location: admin/dashboard.php');
            } else {
                flash('success', 'Logged in successfully.');
                header('Location: index.php');
            }
            exit;
        } else {
            $errors[] = 'Invalid email/username or password.';
        }
    }
}
?>
<html>
    <head>
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <title>Login - Furni</title>
    </head>
    <body>
        <?php renderSiteNav('login'); ?>
        <section class="bg-main py-5">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card shadow border-0 rounded-4">
                            <div class="card-body p-5">
                                <h2 class="text-center mb-4">Login</h2>
                                <?php if (!empty($errors)): ?>
                                    <div class="alert alert-danger"><?php foreach ($errors as $error): ?><div><?php echo $error; ?></div><?php endforeach; ?></div>
                                <?php endif; ?>
                                <form method="POST" action="login.php" novalidate>
                                    <?php echo csrfField(); ?>
                                    <div class="mb-3">
                                        <label class="form-label">Email or Username</label>
                                        <input type="text" name="login" class="form-control" value="<?php echo htmlspecialchars($_POST['login'] ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                    <button type="submit" class="btn btn-dark w-100 rounded-5">Login</button>
                                </form>
                                <p class="text-center mt-3 mb-1">No account? <a href="register.php">Register</a></p>
                                <p class="text-center mb-0"><a href="forgot_password.php">Forgot password?</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html>
