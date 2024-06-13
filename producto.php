<?php
    if(isset($_GET['productId'])){
        $productId = $_GET['productId'];
        // Ahora puedes usar $productId para obtener los detalles del producto de la base de datos
        echo "<p>Producto con ID: $productId</p>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
</head>
<body>
    <p>Hola Mundo!</p>
</body>
</html>