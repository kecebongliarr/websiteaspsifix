<?php
session_start();
include 'config.php';

// Fetch orders dari MySQL database
$sql = "SELECT * FROM orders ORDER BY no DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/penjual.css">
    <title>Pesanan Masuk - By.pastaa</title>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .payment-proof-image {
            max-width: 100%;
            height: auto;
        }

        .view-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }

        .view-button:hover {
            background-color: #45a049;
        }

        .checklist-image {
            width: 70px; 
            height: auto;
        }

        .delete-button {
            background-color: #f44336;
            color: white;
            padding: 8px 16px;
            border: none;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #e53935;
        }
    </style>
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
                        <li><a href="index.php" class="nav-button">Laman pembeli</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="seller spacersection">
        <div class="container">
            <h2 class="bigtitle">Pesanan Masuk</h2>
            <table id="seller">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pembeli</th>
                        <th>Alamat</th>
                        <th>Nomor Telepon</th>
                        <th>Detail Pesanan</th>
                        <th>Total Harga</th>
                        <th>Tanggal Pesanan</th>
                        <th>Bukti Pembayaran</th>
                        <th>Status Pesanan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['no']}</td>";
                            echo "<td>{$row['nama_pembeli']}</td>";
                            echo "<td>{$row['alamat']}</td>";
                            echo "<td>{$row['nomor_telepon']}</td>";
                            echo "<td>{$row['detail_pesanan']}</td>";
                            echo "<td>Rp" . number_format($row['total_harga'], 0, ',', '.') . "</td>";
                            echo "<td>{$row['date_ordered']}</td>";
                            echo "<td>";
                            if ($row['payment_proof']) {
                                echo "<button class='view-button' onclick='openModal(\"{$row['payment_proof']}\")'>Lihat Bukti Pembayaran</button>";
                            } else {
                                echo "No payment proof";
                            }
                            echo "</td>";

                            
                            if ($row['status'] == 'processed') {
                                echo "<td><img src='img/checklist.png' class='checklist-image'></td>";
                            } else {
                                echo "<td><button class='process-order-btn' onclick='processOrder(this)'>Proses Pesanan</button></td>";
                            }

                            
                            echo "<td><button class='delete-button' onclick='deleteOrder(this)'>Hapus</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='10'>Tidak ada pesanan masuk.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div id="paymentProofModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <img id="paymentProofImage" src="" alt="Payment Proof" class="payment-proof-image">
        </div>
    </div>

    <div class="footer spacersection">
        <div class="container">
            <p>&copy; 2024 kejar jam tayang. All rights reserved.</p>
        </div>
    </div>

    <script>
        
        function openModal(imageSrc) {
            document.getElementById("paymentProofImage").src = imageSrc;
            document.getElementById("paymentProofModal").style.display = "flex";
        }

        
        function closeModal() {
            document.getElementById("paymentProofModal").style.display = "none";
        }

        
        window.onclick = function(event) {
            if (event.target == document.getElementById("paymentProofModal")) {
                closeModal();
            }
        }

        
        function processOrder(button) {
            var td = button.closest("td");
            var orderId = button.closest("tr").querySelector("td").innerText;  

            // Update order status di database via AJAX
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_order_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    
                    if (xhr.responseText == 'success') {
                        
                        var checklistImage = document.createElement("img");
                        checklistImage.src = "img/checklist.png";
                        checklistImage.classList.add("checklist-image");

                        td.innerHTML = ""; 
                        td.appendChild(checklistImage); 
                    } else {
                        alert("Failed to process order.");
                    }
                }
            };
            xhr.send("order_id=" + orderId); 
        }

        // Delete order
        function deleteOrder(button) {
            var orderId = button.closest("tr").querySelector("td").innerText;  

            if (confirm("Apakah Anda yakin ingin menghapus pesanan ini?")) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "delete_order.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        
                        if (xhr.responseText == 'success') {
                            button.closest("tr").remove();
                        } else {
                            alert("Gagal menghapus pesanan.");
                        }
                    }
                };
                xhr.send("order_id=" + orderId); 
            }
        }
        
    function renderOrders(orders) {
        const tableBody = document.getElementById("seller").getElementsByTagName("tbody")[0];
        tableBody.innerHTML = ''; 

        orders.forEach(order => {
            const row = document.createElement("tr");

            row.innerHTML = `
                <td>${order.no}</td>
                <td>${order.nama_pembeli}</td>
                <td>${order.alamat}</td>
                <td>${order.nomor_telepon}</td>
                <td>${order.detail_pesanan}</td>
                <td>Rp${parseInt(order.total_harga).toLocaleString()}</td>
                <td>${order.date_ordered}</td>
                <td>
                    ${order.payment_proof ? 
                        `<button class='view-button' onclick='openModal("${order.payment_proof}")'>Lihat Bukti Pembayaran</button>` : 
                        'No payment proof'}
                </td>
                <td>
                    ${order.status === 'processed' ? 
                        `<img src='img/checklist.png' class='checklist-image'>` : 
                        `<button class='process-order-btn' onclick='processOrder(this)'>Proses Pesanan</button>`}
                </td>
                <td><button class='delete-button' onclick='deleteOrder(this)'>Hapus</button></td>
            `;
            
            tableBody.appendChild(row);
        });
    }

    // Fetch orders sama update table
    function fetchOrders() {
        fetch('get_orders.php')  
            .then(response => response.json())
            .then(data => renderOrders(data))
            .catch(error => console.error('Error fetching orders:', error));
    }

    // buat refersh = fetchOrders tiap 10 seconds untuk update table
    setInterval(fetchOrders, 10000); 

    
    fetchOrders();
    </script>
</body>

</html>
