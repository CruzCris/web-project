<?php

$mysqli = new mysqli('localhost', 'root', 'cruzcrisx', 'tienda');

if ($mysqli->connect_error) {
    die('Error de Conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$result1 = $mysqli->query("SELECT producto.titulo, SUM(carrito.cantidad) as cantidadVendida
FROM venta
JOIN carrito ON venta.idVenta = carrito.idVenta 
JOIN producto ON carrito.idProducto = producto.idProducto
WHERE venta.idVenta IS NOT NULL
GROUP BY carrito.idProducto
ORDER BY cantidadVendida DESC
LIMIT 5");

$data1 = array();
foreach($result1 as $row){
    $data1[] = $row;
}

$result2 = $mysqli->query("SELECT ca.categoria, SUM(c.cantidad) AS cantidad
FROM carrito c
JOIN producto p ON c.idProducto = p.idProducto JOIN categoria ca ON p.idCategoria = ca.idCategoria
WHERE c.idVenta IS NOT NULL
GROUP BY ca.categoria
ORDER BY cantidad DESC
LIMIT 5");

$data2 = array();
foreach($result2 as $row){
    $data2[] = $row;
}

$result3 = $mysqli->query("SELECT titulo, stock FROM producto LIMIT 50");

$data3 = array();
foreach($result3 as $row){
    $data3[] = $row;
}

$result4 = $mysqli->query("SELECT titulo, stock FROM producto LIMIT 50 OFFSET 50");

$data4 = array();
foreach($result4 as $row){
    $data4[] = $row;
}

$result5 = $mysqli->query("SELECT SUM(c.cantidad) AS cantidad, SUM(c.cantidad * p.precio * (1 - p.descuento / 100)) AS total
FROM carrito c
JOIN producto p ON c.idProducto = p.idProducto
WHERE c.idVenta IS NOT NULL");

$data5 = array();
foreach($result5 as $row){
    $data5[] = $row;
}

$result6 = $mysqli->query("SELECT p.titulo, SUM(c.cantidad * p.precio * (1 - p.descuento / 100)) AS total
FROM carrito c
JOIN producto p ON c.idProducto = p.idProducto
WHERE c.idVenta IS NOT NULL
GROUP BY p.idProducto");

$data6 = array();
foreach($result6 as $row){
    $data6[] = $row;
}

// Devolver los datos en formato JSON
//echo json_encode($data);
echo json_encode(array('data1' => $data1, 'data2' => $data2,'data3' => $data3, 'data4' => $data4, 'data5' => $data5, 'data6' => $data6));

?>