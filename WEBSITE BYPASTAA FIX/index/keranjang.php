<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['customer'] = [
        'name' => $_POST['name'],
        'address' => $_POST['address'],
        'phone' => $_POST['phone']
    ];
    header('Location: checkout.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/keranjang.css">
    <title>Keranjang - By.pastaa</title>
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
                        <li><a href="product.php">Product</a></li>
                        <li><a href="about.php">About</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="cart spacersection">
        <div class="container">
            <h2 class="bigtitle">Keranjang Belanja</h2>
            
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                echo '<table id="cart-table">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>';
                
                $totalPrice = 0;
                foreach ($_SESSION['cart'] as $productId => $product) {
                    $subtotal = $product['price'] * $product['quantity'];
                    $totalPrice += $subtotal;
                    echo "<tr>";
                    echo "<td>{$product['name']}</td>";
                    echo "<td>Rp" . number_format($product['price'], 0, ',', '.') . "</td>";
                
                    
                    echo "<td>
                            <button class='quantity-btn' onclick='updateQuantity($productId, \"decrease\")'>-</button>
                            <input type='number' id='quantity-$productId' value='{$product['quantity']}' min='1' onchange='updateQuantity($productId, \"manual\")' />
                            <button class='quantity-btn' onclick='updateQuantity($productId, \"increase\")'>+</button>
                          </td>";
                
                    
                    echo "<td id='subtotal-$productId'>Rp" . number_format($subtotal, 0, ',', '.') . "</td>";
                
                    echo "<td><a href='remove_from_cart.php?productId={$productId}'>Hapus</a></td>";
                    echo "</tr>";
                }

                echo '</tbody></table>';
                echo "<h3>Total: Rp<span id='total-price'>" . number_format($totalPrice, 0, ',', '.') . "</span></h3>";
            } else {
                echo "<p>Keranjang Anda kosong. Silakan tambahkan produk ke dalam keranjang.</p>";
            }
            ?>
            
            <form id="customerForm" action="keranjang.php" method="POST">
                <label for="name">Nama</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" required>
                <label for="address">Alamat</label>
                <textarea id="address" name="address" placeholder="Masukkan alamat Anda" required></textarea>
                <label for="phone">Nomor Telepon</label>
                <input type="text" id="phone" name="phone" placeholder="Masukkan nomor telepon" required>
                <button type="submit" class="bigbtn">Checkout</button>
            </form>
        </div>
    </div>

    <div class="footer spacersection">
        <div class="container">
            <p>&copy; 2024 kejar jam tayang. All rights reserved.</p>
        </div>
    </div>

    <script>
        function updateQuantity(productId, action) {
    var quantityInput = document.getElementById('quantity-' + productId);
    var currentQuantity = parseInt(quantityInput.value);

    if (action === 'increase') {
        currentQuantity += 1;
    } else if (action === 'decrease' && currentQuantity > 1) {
        currentQuantity -= 1;
    } else if (action === 'manual' && currentQuantity < 1) {
        currentQuantity = 1;
    }

    
    quantityInput.value = currentQuantity;

    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            
            var response = JSON.parse(xhr.responseText);

            
            document.getElementById('total-price').textContent = 'Rp' + response.totalPriceFormatted;

            
            var subtotalCell = document.getElementById('subtotal-' + productId);
            if (subtotalCell) {
                subtotalCell.textContent = 'Rp' + response.productSubtotalFormatted;
            }
        }
    };
    xhr.send('productId=' + productId + '&quantity=' + currentQuantity);
}


    </script>
</body>
</html>
