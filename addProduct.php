<?php
    // Comprueba si se ha enviado el parámetro productStock
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(isset($_POST['idCliente']) && isset($_POST['productId'])){
            $idCliente = $_POST['idCliente'];
            $productId = $_POST['productId'];
            //echo "ID del cliente: " . $idCliente . "<br>";
            //echo "ID del producto: " . $productId . "<br>";

            // Conecta a la base de datos
            require_once "database.php";

            // Obtiene el stock del producto
            $sql = "SELECT stock FROM producto WHERE idProducto = '$productId'";
            $result = mysqli_query($conn,$sql);
            $rowCount = mysqli_num_rows($result);
            // Buscamos en la bd el producto con dicho ID
            if($rowCount>0){
                // Si existe el producto, obtenemos el stock
                $row = mysqli_fetch_assoc($result);
                $stock = $row['stock'];
                //echo "Stock del producto: " . $stock;
                if($stock>0){
                    // Si hay stock disponible

                    // Verificamos si ya existe el producto en el carrito del cliente
                    $sql = "SELECT * FROM carrito WHERE idProducto = '$productId' AND idVenta IS NULL AND idCliente = '$idCliente'";
                    $result = mysqli_query($conn,$sql);
                    $rowCount = mysqli_num_rows($result);
                    if($rowCount>0){
                        // Ya existe el producto en el carrito
                        
                        // Obtenemos la cantidad de productos en el carrito
                        $sql = "SELECT cantidad FROM carrito WHERE idProducto = '$productId' AND idVenta IS NULL AND idCliente = '$idCliente'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($result);
                        $cantidad = $row['cantidad'];
                        //echo "Cantidad de productos en el carrito: " . $cantidad;

                        // Actualizamos la cantidad de productos en el carrito
                        $cantidad = $cantidad + 1;
                        $sql = "UPDATE carrito SET cantidad = '$cantidad' WHERE idProducto = '$productId' AND idCliente = '$idCliente' AND idVenta IS NULL";
                        $result = mysqli_query($conn,$sql);
                        //echo "Producto añadido al carrito";

                        // Actualizamos el stock del producto
                        $stock = $stock - 1;
                        $sql = "UPDATE producto SET stock = '$stock' WHERE idProducto = '$productId'";
                        $result = mysqli_query($conn,$sql);
                        //echo "Stock del producto actualizado a " . $stock;

                        // Muestra una alerta al cliente para saber que su producto ya fue agregado al carrito
                        //echo "<script>alert('Producto agregado al carrito');</script>";

                        die("Producto agregado al carrito");
                    }else{
                        // No existe el producto en el carrito
                        $sql = "INSERT INTO carrito (idCliente,idProducto,cantidad) VALUES ('$idCliente','$productId',1)";
                        $result = mysqli_query($conn,$sql);
                        //echo "Producto añadido al carrito";

                        // Actualizamos el stock del producto
                        $stock = $stock - 1;
                        $sql = "UPDATE producto SET stock = '$stock' WHERE idProducto = '$productId'";
                        $result = mysqli_query($conn,$sql);
                        //echo "Stock del producto actualizado a " . $stock;

                        // Muestra una alerta al cliente para saber que su producto ya fue agregado al carrito
                        //echo "<script>alert('Producto agregado al carrito');</script>";

                        die("Producto agregado al carrito");
                    }
                } else if ($stock == 0){
                    // Fuera de stock
                    //echo "No hay stock disponible";
                    die("No hay stock");
                }
            } else {
                // No existe el producto con dicho ID
                //echo "No se ha encontrado el producto";
            }
        } else {
            //echo "No se han enviado los parámetros idCliente y productId";
            die();
        }
    }
        

            
?>