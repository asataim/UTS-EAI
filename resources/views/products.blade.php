<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Pakaian</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <div id="produk"></div>

    <script>
    fetch('http://localhost:8000/api/produk')
        .then(response => response.json())
        .then(data => {
            let html = '';
            data.forEach(product => {
                html += `<div>
                           <p>${product.nama} - ${product.harga}</p>
                           <button onclick="addToCart(${product.id})">Tambah ke Keranjang</button>
                         </div>`;
            });
            document.getElementById('produk').innerHTML = html;
        });

    function addToCart(productId) {
        fetch('http://localhost:8000/api/keranjang', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                user_id: 'U123',
                product_id: productId,
                quantity: 1
            })
        });
    }
    </script>
</body>
</html>
