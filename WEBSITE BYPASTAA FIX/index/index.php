<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
unset($_SESSION['message']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/index.css">
    <title>Home | By.pastaa</title>
</head>
<body>
     <div class="header spacersection">
        <div class="container">
           <div class="nav d-flex ai-center jc-spacebetween">
                <div class="nav-brand">
                    <h1><a href="index.php">By.pastaa</a></h1>
                </div>
                <div class="nav-menu">
                    <ul>
                        <li><a href="product.php">Product</a></li>
                        <li><a href="keranjang.php">Keranjang</a></li>
                        <li><a href="about.php">About</a></li>
                        <li><a href="loginpenjual.php" class="nav-button">Masuk sebagai penjual</a></li>
                    </ul>
                </div>
           </div>  
        </div>
     </div>
     <div class="hero">
        <div class="container">
            <div class="d-flex f-wrap jc-spacebetween ai-center">
                <div class="hero-desc">
                    <h2 class="bigtitle">Ini makanan enak sekali kamu harus cobaa</h2>
                    <div class="spacercontent"></div>
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Excepturi officia quod repellendus dolorum recusandae voluptas, delectus corrupti hic consectetur cupiditate?</p>
                    <div class="spacercontent"></div>
                    <a href="product.php" class="bigbtn">Pesan Sekarang</a>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1447078806655-40579c2520d6?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-responsive">
                </div>
            </div>
        </div>
     </div>
    <div class="category spacersection">
        <div class="container">
            <div class="d-flex spacersection">
                <h2>Our Menu</h2>
            </div>
            <div class="d-flex">
                <div class="category-item">
                    <div class="overlay">
                        <div class="spacercontent"></div>
                        <h2>Pasta Aglio</h2>
                        <div class="spacercontent"></div>
                        <p>Hot crispy chicken with by.pastaa style seasoning, seasonend potatoes and aglio pasta.</p>
                        <div class="spacercontent"></div>
                        <a href="product.php" class="btn-outline">Pesan Sekarang</a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1516100882582-96c3a05fe590?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-responsive">
                </div>
                <div class="category-item">
                    <div class="overlay">
                        <div class="spacercontent"></div>
                        <h2>Pasta Alfredo</h2>
                        <div class="spacercontent"></div>
                        <p>Hot crispy chicken with by.pastaa style seasoning, seasonend potatoes and alfredo pasta.</p>
                        <div class="spacercontent"></div>
                        <a href="product.php" class="btn-outline">Pesan Sekarang</a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1546549032-9571cd6b27df?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-responsive">
                </div>
                <div class="category-item">
                    <div class="overlay">
                        <div class="spacercontent"></div>
                        <h2>By Hot Chicken Fries</h2>
                        <div class="spacercontent"></div>
                        <p>Hot crispy chicken & straight cut fries topped with our simple slow seasoning, cheese sauce. perfect.</p>
                        <div class="spacercontent"></div>
                        <a href="product.php" class="btn-outline">Pesan Sekarang</a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1555939594-58d7cb561ad1?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-responsive">
                </div>
                <div class="category-item">
                    <div class="overlay">
                        <div class="spacercontent"></div>
                        <h2>Hot Chicken</h2>
                        <div class="spacercontent"></div>
                        <p>Only hot crispy chicken with by.pastaa style seasoning</p>
                        <div class="spacercontent"></div>
                        <a href="product.php" class="btn-outline">Pesan Sekarang</a>
                    </div>
                    <img src="https://plus.unsplash.com/premium_photo-1695931841609-33ecafba99f2?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-responsive">
                </div>
                
            </div>
        </div>
    </div>

    <div class="category spacersection">
        <div class="container">
            <div class="d-flex spacersection">
                <h2>Our Beverage</h2>
            </div>
            <div class="d-flex">
                <div class="category-item">
                    <div class="overlay">
                        <div class="spacercontent"></div>
                        <h2>Mineral Water</h2>
                        <div class="spacercontent"></div>
                        <p>Just mineral water, nothing special.</p>
                        <div class="spacercontent"></div>
                        <a href="product.php" class="btn-outline">Pesan Sekarang</a>
                    </div>
                    <img src="https://images.unsplash.com/photo-1638688569176-5b6db19f9d2a?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="" class="img-responsive">
                </div>
            </div>   
        </div>
    </div>
    <div class="footer spacersection">
        <div class="container">
            <p>&copy; 2024 kejar jam tayang. All rights reserved.</p>
        </div>
    </div>
</body>
</html>