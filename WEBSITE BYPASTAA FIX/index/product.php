<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/product.css">
    <title>Product | By.pastaa</title>
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
                        <li><a href="index.php">Home</a></li>
                        <li><a href="keranjang.php">Keranjang</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="product spacersection">
        <div class="container">
            <h2 class="bigtitle">Menu Kami</h2>
            <p>Silakan pilih menu favorit Anda:</p>
            <div class="d-flex f-wrap jc-spacebetween">
                <div class="product-item">
                    <img src="img/pasta_aglio.jpg" alt="Pasta Aglio" class="img-responsive">
                    <h3>Pasta Aglio</h3>
                    <p>Harga: Rp25.000 (Regular) | Rp38.000 (Large)</p>
                    <button onclick="addToCart(1, 'Pasta Aglio', 25000)">Tambah Regular</button>
                    <button onclick="addToCart(1, 'Pasta Aglio', 38000)">Tambah Large</button>
                </div>
                <div class="product-item">
                    <img src="img/pasta_alfredo.jpg" alt="Pasta Alfredo" class="img-responsive">
                    <h3>Pasta Alfredo</h3>
                    <p>Harga: Rp28.000 (Regular) | Rp40.000 (Large)</p>
                    <button onclick="addToCart(2, 'Pasta Alfredo', 28000)">Tambah Regular</button>
                    <button onclick="addToCart(2, 'Pasta Alfredo', 40000)">Tambah Large</button>
                </div>
                <div class="product-item">
                    <img src="img/hot_chicken_fries.jpg" alt="By Hot Chicken Fries" class="img-responsive">
                    <h3>By Hot Chicken Fries</h3>
                    <p>Harga: Rp35.000</p>
                    <button onclick="addToCart(3, 'By Hot Chicken Fries', 35000)">Tambah</button>
                </div>
                <div class="product-item">
                    <img src="img/hot_chicken.jpg" alt="Hot Chicken" class="img-responsive">
                    <h3>Hot Chicken</h3>
                    <p>Harga: Rp20.000</p>
                    <button onclick="addToCart(4, 'Hot Chicken', 20000)">Tambah</button>
                </div>
                <div class="product-item">
                    <img src="img/mineral_water.png" alt="Mineral Water" class="img-responsive">
                    <h3>Mineral Water</h3>
                    <p>Harga: Rp5.000</p>
                    <button onclick="addToCart(5, 'Mineral Water', 5000)">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div class="footer spacersection">
        <div class="container">
            <p>&copy; 2024 kejar jam tayang. All rights reserved.</p>
        </div>
    </div>
    <script src="cart.js"></script>
</body>
</html>
