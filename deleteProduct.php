<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['idProducto']) && isset($_POST['idCliente'])) {
        $idProducto = $_POST['idProducto'];
        $idCliente = $_POST['idCliente'];

        //echo "ID del producto: " . $idProducto . "<br>";
        //echo "ID del cliente: " . $idCliente . "<br>";

        require_once "database.php";

        $sql = "SELECT cantidad FROM carrito WHERE idProducto = '$idProducto' AND idCliente = '$idCliente'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            $row = mysqli_fetch_assoc($result);
            $cantidad = $row['cantidad'];
            //echo "Cantidad de productos en el carrito: " . $cantidad;

            $sql = "SELECT stock FROM producto WHERE idProducto = '$idProducto'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $stock = $row['stock'];
            //echo "Stock del producto: " . $stock;

            $sql = "DELETE FROM carrito WHERE idProducto = '$idProducto' AND idCliente = '$idCliente'";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                echo "Producto eliminado del carrito";

                $stock = $stock + $cantidad;
                $sql = "UPDATE producto SET stock = '$stock' WHERE idProducto = '$idProducto'";
                $result = mysqli_query($conn, $sql);
            } else {
                echo "Error al eliminar el producto del carrito";
            }
        } else {
            echo "No se encontró el producto en el carrito";
        }

        mysqli_close($conn);
    }
}
?>