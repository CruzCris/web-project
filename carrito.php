<?php
session_start();
if(isset($_SESSION["idCliente"])) {
    $idCliente = $_SESSION["idCliente"];
    //echo "ID del cliente: " . $idCliente;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito de Compras</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .icon-button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }
        .icon-button .icon {
            width: 24px;
            height: 24px;
        }
        .icon-button .icon:hover {
            stroke: #e74c3c; /* Color al pasar el cursor */
        }
    </style>
</head>
<body>
    <header>
        <h1>Mi Carrito de Compras</h1>
        <nav>
            <a href="index.php" class="btn btn-primary">Inicio</a>
            <a href="logout.php" class="btn btn-warning">Cerrar Sesión</a>
        </nav>
    </header>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <p id="modal-text"></p>
        </div>
    </div>

    <?php
    require_once "database.php";

    //Obtenemos el valor actual del monedero del cliente
    $query = "SELECT monedero FROM cliente WHERE idCliente = '$idCliente'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $monedero = $row['monedero'];
        echo "<p>Mi Monedero: $" . $monedero . "</p>";
    }

    // Obtenemos los productos del carrito del cliente
    $query = "SELECT p.titulo, c.cantidad, p.idProducto, p.precio, p.descuento FROM carrito c JOIN producto p on c.idProducto=p.idProducto WHERE c.idCliente = '$idCliente' AND c.idVenta IS NULL";
    $result = mysqli_query($conn, $query);

    // Revisamos que existan datos en el carrito
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>Cantidad</th><th>Producto</th><th>Precio</th><th>Descuento</th></tr>";

        // Mostramos los productos del carrito en una tabla
        while ($row = mysqli_fetch_assoc($result)) {
            //$idProducto = $row['idProducto'];
            echo "<tr>";
            echo "<td>" . $row['cantidad'] . "</td>";
            echo "<td>" . $row['titulo'] . "</td>";
            echo "<td>" . $row['precio'] . "</td>";
            echo "<td>" . $row['descuento'] . "%</td>";
            echo "<td><button class='icon-button' id='delete-" . $row['idProducto'] . "'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-trash' width='24' height='24' viewBox='0 0 24 24' stroke-width='1.5' stroke='#2c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                        <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                        <path d='M4 7l16 0' />
                        <path d='M10 11l0 6' />
                        <path d='M14 11l0 6' />
                        <path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' />
                        <path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' />
                    </svg></button></td>";
            echo "</tr>";
        }

        echo "</table>";

        // Obtenemos el total a pagar
        $query = "SELECT c.idCliente, SUM(c.cantidad * p.precio * (1 - p.descuento / 100)) AS total
        FROM carrito c
        JOIN producto p ON c.idProducto = p.idProducto
        WHERE c.idCliente = '$idCliente'
        GROUP BY c.idCliente;";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $total = $row['total'];
            $total = number_format($total, 3);
            echo "Total: $" . $total;
        } else {
            //echo "No se encontraron resultados";
        }

        echo "<form method='POST' action='compra.php'>";
        echo "<input type='hidden' name='idCliente' value='$idCliente'>";
        echo "<button type='submit'>Comprar</button>";
        echo "</form>";
        //echo "<button>Comprar</button>";
    } else {
        echo "Carrito de compras vacío. Agrega productos desde la página de inicio!";
    }

    // Cerramos la conexión a la bd
    mysqli_close($conn);
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        $(".icon-button").click(function(){
            var idCliente = "<?php echo $idCliente; ?>";
            var id = this.id.split("-")[1]; // Obtiene el idProducto del id del botón
            var button = this; // Guarda la referencia al botón que fue clickeado

            $.ajax({
                url: 'deleteProduct.php',
                type: 'post',
                data: {idProducto: id, idCliente: idCliente},
                success: function(response) {
                    //console.log(response);
                    if(response == "Producto eliminado del carrito") {
                        // Elimina la fila de la tabla
                        $(button).closest('tr').remove();

                        // Muestra un mensaje al usuario
                        // Obtener el modal y el texto del modal
                        let modal = document.getElementById('modal');
                        let modalText = document.getElementById('modal-text');

                        // Establecer el texto del modal
                        modalText.textContent = "Producto eliminado del carrito";

                        // Mostrar el modal
                        modal.style.display = "block";

                        // Obtener el botón de cerrar
                        let closeButton = document.querySelector('.close-button');

                        // Cerrar el modal cuando se hace clic en el botón de cerrar
                        closeButton.onclick = function() {
                            modal.style.display = "none";
                        }

                        // Cerrar el modal después de un tiempo
                        setTimeout(() => {
                            modal.style.display = "none";
                        }, 2000);
                    } else {
                        alert(response);
                    }
                }
            });
        });
    });
    </script>
</body>
</html>