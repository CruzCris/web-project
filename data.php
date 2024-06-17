<?php

$mysqli = new mysqli('localhost', 'root', 'cruzcrisx', 'tienda');

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT producto.titulo, SUM(carrito.cantidad) as cantidadVendida
FROM venta
JOIN carrito ON venta.idVenta = carrito.idVenta 
JOIN producto ON carrito.idProducto = producto.idProducto
WHERE venta.idVenta IS NOT NULL
GROUP BY carrito.idProducto
ORDER BY cantidadVendida DESC
LIMIT 5");

$data = array();
foreach($result as $row){
    $data[] = $row;
}

// Devolver los datos en formato JSON
echo json_encode($data);

?>