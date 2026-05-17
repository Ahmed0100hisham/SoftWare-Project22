<?php require_once './includes/auth.php'; require_once './includes/site_nav.php'; ?>
<html>
    <head>
        <link rel="stylesheet" href="./css/all.min.css">
        <link rel="stylesheet" href="./css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/style.css">
        <title>Furni - Modern Car Rental</title>
    </head>
    <body>
        <?php renderSiteNav('home'); ?>

<?php $homeSuccess = flash('success'); if ($homeSuccess): ?><div class="container mt-3"><div class="alert alert-success"><?php echo e($homeSuccess); ?></div></div><?php endif; ?>
        <section id="hero" class="hero bg-sec1">
            <div class="container ">
                <div class="row h-100 align-content-center">
                    <div class="col-md-5 pt-5">
                        <h1 class="">Modern Cars For Rent</h1>
                        <p class="lead">At Furni, we believe every journey deserves the perfect vehicle. Whether you're exploring the city, embarking on a road trip, or need a luxury ride for a special occasion, our fleet offers unmatched quality and reliability.</p>
                        <button class="button border-0 px-4 py-3 fw-bold  rounded-5"><a class="text-black text-decoration-none" href="./shop.php">Shop Now</a></button>
                        <!-- <button class="bg-transparent px-4 py-3 fw-bold text-white border-1 border-light rounded-5">Explore</button> -->
                    </div>
                    <div class="col-md-7 ">
                        <div class="couch ">
                            <img class="w-100" src="./img/thhgevkj1ll0b0nhatvap14tar-d8f4c6474358b52051d0198484bde467.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-main">
            <div class="container pt-5 pb-5">
                <div class="row pb-5">
                    <div class="col-3 mt-5">
                        <h2 class="fs-2 mt-4">Best Cars For You To Rent</h2>
                        <p class="mt-4">A Ferrari isn't just a car—it's a declaration of sophistication, power, and timeless Italian artistry. Every curve, every purr of the engine, and every hand-stitched detail is crafted for those who demand nothing but the extraordinary.</p>
                        <button class="bg-black px-5 py-2 fw-bold text-white border-1 border-light rounded-5 fs-4 mt-3  "><a class="text-white text-decoration-none" href="./shop.php">Shop Now</a></button>
                    </div>
                    <div class="col-md-3 mt-5 product-hover">
                        <div class="product-item">
                            <img class="w-100 img-hover" src="./img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png" alt="">
                            <p class="fw-bold fs-5 text-center mt-4">Ferrari 488 GTB</p>
                            <p class="fw-bold fs-5 text-center">$150.00</p>
                        </div>
                    </div>
                    <div class="col-md-3 mt-5 product-hover">
                        <div class="product-item">
                            <img class="w-100 img-hover" src="./img/2017-ferrari-488-spider-sports-car-international-motor-show-germany-blue-ferrari-488-spider-car-front-69d13e8a4cc380de2a1094458b799d97.png" alt="">
                            <p class="fw-bold fs-5 text-center mt-4">Ferrari Portofino</p>
                            <p class="fw-bold fs-5 text-center">$178.00</p>
                        </div>
                    </div>
                    <div class="col-md-3 mt-5 product-hover">
                        <div class="product-item">
                            <img class="w-100 img-hover"  src="./img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png" alt="">
                            <p class="fw-bold fs-5 text-center mt-4">Ferrari F8 Tributo</p>
                            <p class="fw-bold fs-5 text-center">$243.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg-main">
            <div class="container">
                <div class="row h-100">
                    <div class="col-6 h-100 pt-5">
                        <div class="row h-25 m-2">
                            <div class="col-12 ">
                                <h2 class="title-sec3">Why Choose Us</h2>
                                <p class="text-black-50">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique.</p>
                            </div>
                        </div>
                        <div class="row h-25 m-2">
                            <div class="col-6 ">
                                <i class="fa-solid fa-truck-fast fa-2xl"></i>
                                <h5 class="mt-4 mb-3">Fast & Free Shipping</h5>
                                <p class="text-black-50">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                            <div class="col-6 ">
                                <i class="fa-solid fa-handshake fa-2xl"></i>
                                <h5 class="mt-4 mb-3">Easy to Shop</h5>
                                <p class="text-black-50">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>
                        <div class="row h-25 m-2">
                            <div class="col-6 ">
                                <i class="fa-solid fa-headset fa-2xl"></i>
                                <h5 class="mt-4 mb-3">24/7 Support</h5>
                                <p class="text-black-50">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                            <div class="col-6 ">
                                <i class="fa-solid fa-arrow-right-arrow-left fa-2xl"></i>
                                <h5 class="mt-4 mb-3">Hassle Free Returns</h5>
                                <p class="text-black-50">Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 pt-5 ps-5">
                        <div class="bg-dots-yellow w-100 ps-5">
                            <img class="rounded-4" src="./img/young-couple-choosing-car-car-showroom_1303-22834.avif" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-6 pt-5 me-5">
                        <div class="potos">
                            <div class="poto1-sec4 w-75">
                                <img class="w-100 rounded-4" src="./img/low-angle-man-wearing-sunglasses_23-2150321014.avif" alt="">
                            </div>
                            <div class="poto2-sec4">
                                <img class="w-100 rounded-4" src="./img/istockphoto-843079144-170667a.jpg" alt="">
                            </div>
                            <div class="poto3-sec4">
                                <img class="w-100 rounded-4" src="./img/istockphoto-2153038000-612x612.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-5 ms-5 ps-5">
                        <div class="ps-3">
                            <h2>We Help You choose Modern car Design</h2>
                            <p class=" mt-4">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada</p>
                        </div>
                        <div class="row pt-2">
                            <div class="col-6 list-items">
                                <ul class="list-items">
                                    <li>Donec vitae odio quis nisl dapibus malesuada</li>
                                    <li class="mt-2">Donec vitae odio quis nisl dapibus malesuada</li>
                                </ul>
                            </div>
                            <div class="col-6 list-items">
                                <ul>
                                    <li>Donec vitae odio quis nisl dapibus malesuada</li>
                                    <li class="mt-2">Donec vitae odio quis nisl dapibus malesuada</li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <button class="bg-black px-5 py-2 fw-bold text-white border-1 border-light rounded-5 fs-4 mt-3  "><a class="text-white text-decoration-none" href="./shop.php">Shop Now</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 products-info d-flex">
                        <div class="product-imgs">
                            <img class="w-100" src="./img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png" alt="">
                        </div>
                        <div class="products-info mt-3">
                            <h5>Nordic Chair</h5>
                            <p class="pb-1">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio</p>
                            <p class="text-black">Read More</p>
                        </div>
                    </div>
                    <div class="col-lg-4 products-info d-flex">
                        <div class="product-imgs">
                            <img class="w-100" src="./img/2017-ferrari-488-spider-sports-car-international-motor-show-germany-blue-ferrari-488-spider-car-front-69d13e8a4cc380de2a1094458b799d97.png" alt="">
                        </div>
                        <div class="products-info mt-3">
                            <h5>Kruzo Aero Chair</h5>
                            <p class="pb-1">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio</p>
                            <p class="text-black">Read More</p>
                        </div>
                    </div>
                    <div class="col-lg-4 products-info d-flex">
                        <div class="product-imgs">
                            <img class="w-100" src="./img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png" alt="">
                        </div>
                        <div class="products-info mt-3">
                            <h5>Ergonomic Chair</h5>
                            <p class="pb-1">Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio</p>
                            <p class="text-black">Read More</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section>
            <div class="w-100 mt-5 h-25 d-flex justify-content-lg-center testomonials">
                <h2 class="fs-1">Testimonials</h2>
            </div>
            <div class=" h-50">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="slider">
                                <div class="slider-info m-auto w-50 mb-4">
                                    <p class="text-center">"Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque."</p>
                                </div>
                                <div class="per-info m-auto">
                                    <div class="m-auto w-50">
                                        <img class="w-100 rounded-circle " src="./img/person-1.png" alt="">
                                    </div>
                                    <h6 class="text-center">Maria Jones</h6>
                                    <p class="text-black-50 text-center">CEO, Co-Founder, XYZ Inc.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item active">
                            <div class="slider">
                                <div class="slider-info m-auto w-50 mb-4">
                                    <p class="text-center">"Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque."</p>
                                </div>
                                <div class="per-info m-auto">
                                    <div class="m-auto w-50">
                                        <img class="w-100 rounded-circle " src="./img/360_F_396167959_aAhZiGlJoeXOBHivMvaO0Aloxvhg3eVT.jpg" alt="">
                                    </div>
                                    <h6 class="text-center">Maria Jones</h6>
                                    <p class="text-black-50 text-center">CEO, Co-Founder, XYZ Inc.</p>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item active">
                            <div class="slider">
                                <div class="slider-info m-auto w-50 mb-4">
                                    <p class="text-center">"Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer convallis volutpat dui quis scelerisque."</p>
                                </div>
                                <div class="per-info m-auto">
                                    <div class="m-auto w-50">
                                        <img class="w-100 rounded-circle " src="./img/happy-man-student-with-afro-hairdo-shows-white-teeth-being-good-mood-after-classes_273609-16608.avif" alt="">
                                    </div>
                                    <h6 class="text-center">Maria Jones</h6>
                                    <p class="text-black-50 text-center">CEO, Co-Founder, XYZ Inc.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>

        <section class="py-5 bg-main">
            <div class="container py-4">
                <div class="row mb-5">
                    <div class="col-12">
                        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all"
                                    type="button" role="tab" aria-controls="pills-all" aria-selected="true">ALL</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-luxury-tab" data-bs-toggle="pill" data-bs-target="#pills-luxury"
                                    type="button" role="tab" aria-controls="pills-luxury" aria-selected="false">Luxury Cars</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-tips-tab" data-bs-toggle="pill" data-bs-target="#pills-tips"
                                    type="button" role="tab" aria-controls="pills-tips" aria-selected="false">Rental Tips</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-travel-tab" data-bs-toggle="pill" data-bs-target="#pills-travel"
                                    type="button" role="tab" aria-controls="pills-travel" aria-selected="false">Travel Guides</button>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="tab-content" id="pills-tabContent">
                    <!-- All Posts Tab -->
                    <div class="tab-pane fade show active" id="pills-all" role="tabpanel" aria-labelledby="pills-all-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png" alt="Luxury car maintenance">
                                <h5 class="my-3">Essential Maintenance Tips for Luxury Vehicles</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">David Miller</a></span> <span>on <a class="text-decoration-none text-black" href="#">May 15, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png" alt="Road trip planning">
                                <h5 class="my-3">Planning the Perfect Luxury Road Trip</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Sarah Johnson</a></span> <span>on <a class="text-decoration-none text-black" href="#">May 10, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/thhgevkj1ll0b0nhatvap14tar-d8f4c6474358b52051d0198484bde467.png" alt="First-time renters guide">
                                <h5 class="my-3">First-Time Luxury Car Renter's Guide</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">James Wilson</a></span> <span>on <a class="text-decoration-none text-black" href="#">May 5, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/2017-ferrari-488-spider-sports-car-international-motor-show-germany-blue-ferrari-488-spider-car-front-69d13e8a4cc380de2a1094458b799d97.png" alt="Coastal driving">
                                <h5 class="my-3">Top 10 Coastal Drives for Your Next Vacation</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Emma Roberts</a></span> <span>on <a class="text-decoration-none text-black" href="#">April 28, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png" alt="Ferrari history">
                                <h5 class="my-3">The Fascinating History of Ferrari</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Michael Thompson</a></span> <span>on <a class="text-decoration-none text-black" href="#">April 20, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png" alt="Car photoshoot tips">
                                <h5 class="my-3">How to Take Perfect Photos of Your Luxury Rental</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Jessica Miller</a></span> <span>on <a class="text-decoration-none text-black" href="#">April 15, 2024</a></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Luxury Cars Tab -->
                    <div class="tab-pane fade" id="pills-luxury" role="tabpanel" aria-labelledby="pills-luxury-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png" alt="Ferrari history">
                                <h5 class="my-3">The Fascinating History of Ferrari</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Michael Thompson</a></span> <span>on <a class="text-decoration-none text-black" href="#">April 20, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png" alt="Luxury car maintenance">
                                <h5 class="my-3">Essential Maintenance Tips for Luxury Vehicles</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">David Miller</a></span> <span>on <a class="text-decoration-none text-black" href="#">May 15, 2024</a></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rental Tips Tab -->
                    <div class="tab-pane fade" id="pills-tips" role="tabpanel" aria-labelledby="pills-tips-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/thhgevkj1ll0b0nhatvap14tar-d8f4c6474358b52051d0198484bde467.png" alt="First-time renters guide">
                                <h5 class="my-3">First-Time Luxury Car Renter's Guide</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">James Wilson</a></span> <span>on <a class="text-decoration-none text-black" href="#">May 5, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png" alt="Car photoshoot tips">
                                <h5 class="my-3">How to Take Perfect Photos of Your Luxury Rental</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Jessica Miller</a></span> <span>on <a class="text-decoration-none text-black" href="#">April 15, 2024</a></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Travel Guides Tab -->
                    <div class="tab-pane fade" id="pills-travel" role="tabpanel" aria-labelledby="pills-travel-tab" tabindex="0">
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png" alt="Road trip planning">
                                <h5 class="my-3">Planning the Perfect Luxury Road Trip</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Sarah Johnson</a></span> <span>on <a class="text-decoration-none text-black" href="#">May 10, 2024</a></span>
                            </div>
                            <div class="col-md-4 mb-4">
                                <img class="w-100 rounded-4" src="./img/2017-ferrari-488-spider-sports-car-international-motor-show-germany-blue-ferrari-488-spider-car-front-69d13e8a4cc380de2a1094458b799d97.png" alt="Coastal driving">
                                <h5 class="my-3">Top 10 Coastal Drives for Your Next Vacation</h5>
                                <span>by <a class="text-decoration-none fw-bold text-black" href="#">Emma Roberts</a></span> <span>on <a class="text-decoration-none text-black" href="#">April 28, 2024</a></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="h-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="d-flex">
                                <i class="fa-solid pe-2 fa-envelope fa-2xl mt-3"></i>
                                <h3>Subscribe to Newsletter</h3>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control p-3" placeholder="First name" aria-label="First name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control p-3" placeholder="Last name" aria-label="Last name">
                            </div>
                            <div class="col">
                                <button class="border-0 p-4 rounded-2 mt-1 bg-button-lastsec"><i class="fa-solid fa-paper-plane fa-lg" style="color: #fcfcfc;"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 chair">
                        <img class="w-100" src="./img/thhgevkj1ll0b0nhatvap14tar-d8f4c6474358b52051d0198484bde467.png" alt="">
                    </div>
                </div>
            </div>
        </section>

        <section class="h-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="col-12 text-main">
                            <h2><a class="text-decoration-none h1" href="">Furni</a></h2>
                        </div>
                        <div class="col-12">
                            <p>Donec facilisis quam ut purus rutrum lobortis. Donec vitae odio quis nisl dapibus malesuada. Nullam ac aliquet velit. Aliquam vulputate velit imperdiet dolor tempor tristique. Pellentesque habitant</p>
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
									<li><a class="text-black text-decoration-none" href="#">About us</a></li>
									<li class="my-3"><a class="text-black text-decoration-none" href="#">Services</a></li>
									<li><a class="text-black text-decoration-none" href="#">Blog</a></li>
									<li class="my-3"><a class="text-black text-decoration-none" href="#">Contact us</a></li>
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
									<li><a class="text-black text-decoration-none" href="#">Nordic Chair</a></li>
									<li class="my-3"><a class="text-black text-decoration-none" href="#">Kruzo Aero</a></li>
									<li><a class="text-black text-decoration-none" href="#">Ergonomic Chair</a></li>
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