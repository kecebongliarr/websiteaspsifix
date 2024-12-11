<?php
session_start();
include 'config.php';

// kalo no customer or cart data exists
if (!isset($_SESSION['customer']) || !isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: keranjang.php');
    exit();
}

$customer = $_SESSION['customer'];
$cart = $_SESSION['cart'];
$totalPrice = 0;
$orderDetails = '';

// hitung total price and order details
foreach ($cart as $productId => $product) {
    $subtotal = $product['price'] * $product['quantity'];
    $totalPrice += $subtotal;
    $orderDetails .= $product['name'] . " (x" . $product['quantity'] . "), ";
}
$orderDetails = rtrim($orderDetails, ', ');

// Handel Konfirmasi Pesanan button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_order'])) {
    // Temporarily store order details in the session
    $_SESSION['order_details'] = [
        'name' => $customer['name'],
        'address' => $customer['address'],
        'phone' => $customer['phone'],
        'details' => $orderDetails,
        'total_price' => $totalPrice,
    ];
    $showConfirmation = true;
}

// Handle Konfirmasi Pembayaran button click
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_proof'])) {
    if (isset($_SESSION['order_details']) && isset($_FILES['payment_proof'])) {
        $order = $_SESSION['order_details'];

        // file upload
        $targetDir = "img/proof/BUKTI PEMBAYARAN_";
        $fileName = basename($_FILES['payment_proof']['name']);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($_FILES['payment_proof']['tmp_name'], $targetFilePath)) {
            // Save order pake payment proof
            $sql = "INSERT INTO orders (nama_pembeli, alamat, nomor_telepon, detail_pesanan, total_harga, payment_proof, date_ordered) 
                    VALUES (?, ?, ?, ?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssds", 
                $order['name'], 
                $order['address'], 
                $order['phone'], 
                $order['details'], 
                $order['total_price'], 
                $targetFilePath
            );

            if ($stmt->execute()) {
                unset($_SESSION['cart'], $_SESSION['order_details']);
                header("Location: index.php");
                exit();
            } else {
                $errorMessage = "Terjadi kesalahan saat menyimpan pesanan.";
            }
        } else {
            $errorMessage = "Gagal mengunggah bukti pembayaran.";
        }
    } else {
        $errorMessage = "Tidak ada pesanan atau file yang diunggah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/checkout.css">
    <title>Checkout - By.pastaa</title>
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

    <div class="checkout spacersection">
        <div class="container">
            <h2 class="bigtitle">Checkout</h2>
            <h3>Detail Pesanan</h3>
            <p><strong>Nama:</strong> <?php echo $customer['name']; ?></p>
            <p><strong>Alamat:</strong> <?php echo $customer['address']; ?></p>
            <p><strong>Nomor Telepon:</strong> <?php echo $customer['phone']; ?></p>

            <h3>Keranjang Belanja</h3>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cart as $productId => $product): ?>
                        <tr>
                            <td><?php echo $product['name']; ?></td>
                            <td>Rp<?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                            <td><?php echo $product['quantity']; ?></td>
                            <td>Rp<?php echo number_format($product['price'] * $product['quantity'], 0, ',', '.'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h3>Total: Rp<?php echo number_format($totalPrice, 0, ',', '.'); ?></h3>

            <?php if (!isset($showConfirmation)): ?>
    <form method="POST">
        <button type="submit" name="confirm_order" class="bigbtn">Konfirmasi Pesanan</button>
    </form>
<?php endif; ?>

<?php if (isset($showConfirmation)): ?>
    <div class="qr-section">
        <img src="img/siaga_peduli.png" alt="QR Code" width="200">
    </div>
    <form method="POST" enctype="multipart/form-data">
        <label for="payment_proof">Unggah Bukti Pembayaran:</label>
        <input type="file" name="payment_proof" id="payment_proof" required>
        <div class="spacercontent"></div>
        <button type="submit" name="upload_proof" class="bigbtn">Konfirmasi Pembayaran</button>
    </form>
<?php endif; ?>
        </div>
    </div>

    <div class="footer spacersection">
        <div class="container">
            <p>&copy; 2024 kejar jam tayang. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
