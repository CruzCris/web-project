<?php
session_start();
/*if(!isset($_SESSION['from_index'])){
    header("Location: login.php");
    exit();
}
if(isset($_SESSION["idCliente"])) {
    $idCliente = $_SESSION["idCliente"];
    //echo "ID del cliente: " . $idCliente;
}*/
if(!isset($_SESSION['idCliente'])){
    header("Location: login.php");
    exit();
}
$idCliente = $_SESSION["idCliente"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Carrito de Compras</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
        }
        .table-responsive {
            margin: 30px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            background: #fff;
            padding: 20px 25px;
            border-radius: 3px;
            box-shadow: 0 1px 1px rgba(0,0,0,.05);
        }
        .table-title {        
            padding-bottom: 15px;
            background: #435d7d;
            color: #fff;
            padding: 16px 30px;
            margin: -20px -25px 10px;
            border-radius: 3px 3px 0 0;
        }
        .table-title h2 {
            margin: 5px 0 0;
            font-size: 24px;
        }
        .table-title .btn-group {
            float: right;
        }
        .table-title .btn {
            color: #fff;
            float: right;
            font-size: 13px;
            border: none;
            min-width: 50px;
            border-radius: 2px;
            border: none;
            outline: none !important;
            margin-left: 10px;
        }
        .table-title .btn i {
            float: left;
            font-size: 21px;
            margin-right: 5px;
        }
        .table-title .btn span {
            float: left;
            margin-top: 2px;
        }
        table.table tr th, table.table tr td {
            border-color: #e9e9e9;
            padding: 12px 15px;
            vertical-align: middle;
        }
        table.table tr th:first-child {
            width: 60px;
        }
        table.table tr th:last-child {
            width: 100px;
        }
        table.table-striped tbody tr:nth-of-type(odd) {
            background-color: #fcfcfc;
        }
        table.table-striped.table-hover tbody tr:hover {
            background: #f5f5f5;
        }
        table.table th i {
            font-size: 13px;
            margin: 0 5px;
            cursor: pointer;
        }	
        table.table td:last-child i {
            opacity: 0.9;
            font-size: 22px;
            margin: 0 5px;
        }
        table.table td a {
            font-weight: bold;
            color: #566787;
            display: inline-block;
            text-decoration: none;
            outline: none !important;
        }
        table.table td a:hover {
            color: #2196F3;
        }
        table.table td a.edit {
            color: #FFC107;
        }
        table.table td a.delete {
            color: #F44336;
        }
        table.table td i {
            font-size: 19px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }
        
        .hint-text {
            float: left;
            margin-top: 10px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand " href="index.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active text-danger" aria-current="page" href="logout.php">Cerrar sesión</a></li>
                        
                    </ul>
                    <form class="d-flex">
                </div>
            </div>
        </nav>
    </header>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close-button">&times;</span>
            <p id="modal-text"></p>
        </div>
    </div>
    <div class="container ">
    <div class="table-responsive">
    <div class="table-wrapper ">

    <?php
    require_once "database.php";

    //Obtenemos el valor actual del monedero del cliente
    $query = "SELECT monedero FROM cliente WHERE idCliente = '$idCliente'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $monedero = $row['monedero'];
        echo "<div class='table-title bg-dark'>
					<div class=.row'>
						<div class='col-xs-6 '>
							<h2><b>Mi monedero</b></h2>
              <h2><b>$". $monedero ."</b></h2>
						</div>
						<div class='col-xs-6'>
							<a href='#' class='btn btn-danger' id='vaciarCarritoBtn'><i class='material-icons'>&#xE15C;</i> <span>Vaciar carrito</span></a>						
						</div>
					</div>
				</div>";
    }

    // Obtenemos los productos del carrito del cliente
    $query = "SELECT p.titulo, c.cantidad, p.idProducto, p.precio, p.descuento FROM carrito c JOIN producto p on c.idProducto=p.idProducto WHERE c.idCliente = '$idCliente' AND c.idVenta IS NULL";
    $result = mysqli_query($conn, $query);

    // Revisamos que existan datos en el carrito
    if (mysqli_num_rows($result) > 0) {
        echo "<table class='table table-striped table-hover'>";
        echo "<tr><thead><th>Cantidad</th><th>Producto</th><th>Precio</th><th>Descuento</th></thead></tr>";

        // Mostramos los productos del carrito en una tabla
        while ($row = mysqli_fetch_assoc($result)) {
            //$idProducto = $row['idProducto'];
            echo "<tbody>";
            echo "<td>" . $row['cantidad'] . "</td>";
            echo "<td>" . $row['titulo'] . "</td>";
            echo "<td>$" . $row['precio'] . "</td>";
            echo "<td>" . $row['descuento'] . "%</td>";
            echo "<td><button class='icon-button' id='delete-" . $row['idProducto'] . "'><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-trash' width='24' height='24' viewBox='0 0 24 24' stroke-width='1.5' stroke='#2c3e50' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                        <path stroke='none' d='M0 0h24v24H0z' fill='none'/>
                        <path d='M4 7l16 0' />
                        <path d='M10 11l0 6' />
                        <path d='M14 11l0 6' />
                        <path d='M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12' />
                        <path d='M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3' />
                    </svg></button></td>";
            echo "</tbody>";
        }

        echo "</table>";

        // Obtenemos el total a pagar
        $query = "SELECT c.idCliente, SUM(c.cantidad * p.precio * (1 - p.descuento / 100)) AS total
        FROM carrito c
        JOIN producto p ON c.idProducto = p.idProducto
        WHERE c.idCliente = '$idCliente' AND idVenta IS NULL
        GROUP BY c.idCliente";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $total = $row['total'];
            $total = number_format($total, 2);
            echo "<div class='clearfix'>";
            //echo "<p id='total'>Total: $" . $total . "</p>";
        } else {
            //echo "No se encontraron resultados";
        }

        //echo "<form method='POST' action='compra.php' target='_blank'>";
        echo "<form method='POST' action='compra.php'>";
        echo "<input type='hidden' name='idCliente' value='$idCliente'>";
        echo "<button class='btn btn-success hint-text' id='comprarBtn' type='submit'>Comprar</button>";
        echo "</form>";
        //echo "<button id='vaciarCarritoBtn' type='button'>Vaciar carrito</button>";
    } else {
        echo "<b>Carrito de compras vacío. Agrega productos desde la página de inicio!</b>";
        echo "<b id='vacio'></b>";
    }

    // Cerramos la conexión a la bd
    mysqli_close($conn);
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    
    // Eliminar un producto del carrito
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

        // Vaciar carrito
        $("#vaciarCarritoBtn").click(function(){
            var idCliente = "<?php echo $idCliente; ?>";
            //console.log(idCliente);
            $.ajax({
                url: 'vaciarCarrito.php',
                type: 'post',
                data: {idCliente: idCliente},
                success: function(response){
                    if(response == "Carrito vaciado exitosamente"){
                        // Eliminamos la tabla
                        $("table").remove();
                        $("#total").remove();
                        $("#vaciarCarritoBtn").remove();
                        $("#comprarBtn").remove();

                        //  echo "<p id='vacio'>Carrito de compras vacío. Agrega productos desde la página de inicio!</p>";

                        let modal = document.getElementById('modal');
                        let modalText = document.getElementById('modal-text');

                        modalText.textContent = "Carrito vaciado exitosamente";

                        modal.style.display = "block";

                        let closeButton = document.querySelector('.close-button');

                        closeButton.onclick = function() {
                            modal.style.display = "none";
                        }

                        setTimeout(() => {
                            modal.style.display = "none";
                        }, 2000);

                        // Actualizamos la pagina
                        location.reload();
                    }else{
                        alert(response);
                    }
                }
            })
        })
    });
    </script>
</body>
</html>