<?php
if (!function_exists('renderSiteNav')) {
    function renderSiteNav($active = '') {
        $home = 'index.php';
        ?>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand fw-bold" href="<?php echo $home; ?>">Furni</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav w-75 justify-content-between ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link <?php echo $active==='home'?'active':''; ?>" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo $active==='shop'?'active':''; ?>" href="shop.php">Shop</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="services.html">Services</a></li>
                        <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                        <li class="nav-item"><a class="nav-link <?php echo $active==='contact'?'active':''; ?>" href="contact.php">Contact Us</a></li>
                        <?php if (isLoggedIn()): ?>
                            <li class="nav-item"><a class="nav-link <?php echo $active==='account'?'active':''; ?>" href="profile.php">Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link <?php echo $active==='login'?'active':''; ?>" href="login.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link <?php echo $active==='register'?'active':''; ?>" href="register.php">Register</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
    }
}
?>
