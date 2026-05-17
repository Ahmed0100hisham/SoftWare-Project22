<?php require_once './includes/auth.php'; require_once './includes/site_nav.php'; ?>
<html>
    <head>
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <title>Contact Us - Furni Modern Car Rental</title>
    </head>
    <body>
        <!-- Navbar - Same across all pages -->
        <?php renderSiteNav('contact'); ?>

        <!-- Hero Section -->
        <section class="bg-sec1 py-5">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="display-4 fw-bold">Get In Touch</h1>
                        <p class="lead">We'd love to hear from you. Reach out to our team for any inquiries, reservations, or feedback.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information -->
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="mb-4">
                                    <i class="fa-solid fa-location-dot fa-3x text-main"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Visit Us</h4>
                                <p>123 Luxury Drive<br>Beverly Hills, CA 90210<br>United States</p>
                                <p class="mb-0">Monday - Friday: 9:00 AM - 6:00 PM<br>Saturday: 10:00 AM - 4:00 PM<br>Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="mb-4">
                                    <i class="fa-solid fa-phone fa-3x text-main"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Call Us</h4>
                                <p class="mb-2">Main Office: <a href="tel:+1-800-123-4567" class="text-decoration-none text-dark">+1 (800) 123-4567</a></p>
                                <p class="mb-2">Reservations: <a href="tel:+1-800-123-4568" class="text-decoration-none text-dark">+1 (800) 123-4568</a></p>
                                <p class="mb-2">Customer Support: <a href="tel:+1-800-123-4569" class="text-decoration-none text-dark">+1 (800) 123-4569</a></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-0 shadow-sm">
                            <div class="card-body text-center p-4">
                                <div class="mb-4">
                                    <i class="fa-solid fa-envelope fa-3x text-main"></i>
                                </div>
                                <h4 class="fw-bold mb-3">Email Us</h4>
                                <p class="mb-2">General Inquiries: <a href="mailto:info@furni.com" class="text-decoration-none text-dark">info@furni.com</a></p>
                                <p class="mb-2">Reservations: <a href="mailto:reservations@furni.com" class="text-decoration-none text-dark">reservations@furni.com</a></p>
                                <p class="mb-2">Customer Support: <a href="mailto:support@furni.com" class="text-decoration-none text-dark">support@furni.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form -->
        <section class="py-5 bg-main">
            <div class="container py-5">
                <div class="row mb-5">
                    <div class="col-md-6 mx-auto text-center">
                        <h2 class="fw-bold">Send Us a Message</h2>
                        <p class="text-muted">Fill out the form below and we'll get back to you as soon as possible.</p>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="card border-0 shadow">
                            <div class="card-body p-5">
                                <form method="POST" action="contact_submit.php">
                                    <?php echo csrfField(); ?>
                                    <div class="row mb-4">
                                        <div class="col-md-6 mb-4 mb-md-0">
                                            <label for="firstName" class="form-label">First Name</label>
                                            <input type="text" class="form-control p-3" id="firstName" name="first_name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="lastName" class="form-label">Last Name</label>
                                            <input type="text" class="form-control p-3" id="lastName" name="last_name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-4">
                                        <div class="col-md-6 mb-4 mb-md-0">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control p-3" id="email" name="email" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="tel" class="form-control p-3" id="phone" name="phone">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="subject" class="form-label">Subject</label>
                                        <select class="form-select p-3" id="subject" name="subject" required>
                                            <option selected disabled value="">Choose a subject</option>
                                            <option>Reservation Inquiry</option>
                                            <option>Vehicle Information</option>
                                            <option>Pricing & Packages</option>
                                            <option>Support Request</option>
                                            <option>Feedback</option>
                                            <option>Other</option>
                                        </select>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label for="message" class="form-label">Message</label>
                                        <textarea class="form-control p-3" id="message" name="message" rows="5" required></textarea>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button class="button border-0 px-4 py-3 fw-bold rounded-5" type="submit">Submit Message</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Map Section -->
        <section class="py-5">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="fw-bold">Our Location</h2>
                        <p class="text-muted">Visit our showroom to see our premium fleet in person</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="map-container">
                            <!-- Placeholder for Google Map - in a real implementation you would add the actual Google Maps embed code -->
                            <img src="./img/young-couple-choosing-car-car-showroom_1303-22834.avif" alt="Location Map" class="img-fluid rounded-4 w-100" style="height: 400px; object-fit: cover;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <section class="h-50 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-12 text-main">
                            <h2><a class="text-decoration-none h1" href="">Furni</a></h2>
                        </div>
                        <div class="col-12">
                            <p>At Furni, we offer premium car rental services with a fleet of luxury and sports vehicles. Experience unmatched quality, reliability, and customer service for your journey.</p>
                        </div>
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-6">
                                    <div class="d-flex justify-content-around">
                                        <div class=" h-logo d-flex justify-content-center rounded-circle ">
                                            <a href=""><i class="rounded-circle fa-brands fa-facebook-f"></i></a>
                                        </div>
                                        <div class=" h-logo d-flex justify-content-center rounded-circle">
                                            <a href=""><i class="fa-brands fa-twitter"></i></a>
                                        </div>
                                        <div class=" h-logo d-flex justify-content-center rounded-circle ">
                                            <a class="insta-color" href=""><i class="fa-brands fa-instagram"></i></a>
                                        </div>
                                        <div class=" h-logo d-flex justify-content-center rounded-circle ">
                                            <a href=""><i class="fa-brands fa-linkedin-in"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 ps-5">
                        <div class="row">
                            <div class="col-3 mt-4">
                                <ul class="list-unstyled">
                                    <li><a class="text-black text-decoration-none" href="about.html">About us</a></li>
                                    <li class="my-3"><a class="text-black text-decoration-none" href="services.html">Services</a></li>
                                    <li><a class="text-black text-decoration-none" href="blog.html">Blog</a></li>
                                    <li class="my-3"><a class="text-black text-decoration-none" href="contact.php">Contact us</a></li>
                                </ul>
                            </div>
                            <div class="col-3 mt-4">
                                <ul class="list-unstyled">
                                    <li><a class="text-black text-decoration-none" href="#">Support</a></li>
                                    <li class="my-3"><a class="text-black text-decoration-none" href="#">Knowledge base</a></li>
                                    <li><a class="text-black text-decoration-none" href="#">Live chat</a></li>
                                </ul>
                            </div>
                            <div class="col-3 mt-4">
                                <ul class="list-unstyled">
                                    <li><a class="text-black text-decoration-none" href="#">Jobs</a></li>
                                    <li class="my-3"><a class="text-black text-decoration-none" href="#">Our team</a></li>
                                    <li><a class="text-black text-decoration-none" href="#">Leadership</a></li>
                                    <li class="my-3"><a class="text-black text-decoration-none" href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                            <div class="col-3 mt-4">
                                <ul class="list-unstyled">
                                    <li><a class="text-black text-decoration-none" href="#">Ferrari 488 GTB</a></li>
                                    <li class="my-3"><a class="text-black text-decoration-none" href="#">Ferrari Portofino</a></li>
                                    <li><a class="text-black text-decoration-none" href="#">Ferrari F8 Tributo</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="w-100 line bg-black my-5"></div>
                </div>
            </div>
        </div>
        <section class="h-25">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <p>Copyright ©2024. All Rights Reserved. — Designed with love by Untree.co Distributed By ThemeWagon</p>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <div class="row">
                            <div class="col-2"></div>
                            <div class="col-5">
                                <h6><a class="text-decoration-none text-black" href="">Terms & Conditions</a></h6>
                            </div>
                            <div class="col-5">
                                <h6><a class="text-decoration-none text-black" href="">Privacy Policy</a></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="https://kit.fontawesome.com/915c149c65.js" crossorigin="anonymous"></script>
        <script src="./js/bootstrap.bundle.min.js"></script>
    </body>
</html> 