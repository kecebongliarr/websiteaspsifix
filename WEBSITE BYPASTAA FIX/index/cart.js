function addToCart(productId, productName, productPrice) {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'add_to_cart.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            alert('Item added to cart!');
        }
    };
    xhr.send('productId=' + productId + '&productName=' + productName + '&productPrice=' + productPrice);
}
