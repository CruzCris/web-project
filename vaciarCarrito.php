<?php

    if(isset($_POST['idCliente'])){
        $idCliente = $_POST['idCliente'];

        require_once "database.php";

        $query = "DELETE FROM carrito WHERE idCliente = ? AND idVenta IS NULL";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'i', $idCliente);
        
        if(mysqli_stmt_execute($stmt)){
            echo "Carrito vaciado exitosamente";
        }else{
            echo "Error al vaciar el carrito";
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }

?>