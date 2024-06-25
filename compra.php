<?php

session_start();
if(!isset($_SESSION['idCliente'])){
    header("Location: login.php");
    exit();
}

ob_start();

require_once "librerias/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

style>
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
<div class="container ">
    <div class="table-responsive">
    <div class="table-wrapper ">   
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idCliente = $_POST['idCliente'];
    //echo "ID del cliente: " . $idCliente . "<br>";

    require_once "database.php"; // Asegúrate de que este archivo contiene la conexión a tu base de datos

    // Generamos el ticket de compra
    $randomString = substr(str_shuffle(str_repeat($x='0123456789', ceil(7/strlen($x)) )),1,7);

    //Verificamos que no exista un ticket con el mismo número
    $query = "SELECT * FROM venta WHERE idVenta = '$randomString'";
    $result = mysqli_query($conn, $query);

    while (mysqli_num_rows($result) > 0) {
        $randomString = substr(str_shuffle(str_repeat($x='0123456789', ceil(7/strlen($x)) )),1,7);
        $query = "SELECT * FROM venta WHERE idVenta = '$randomString'";
        $result = mysqli_query($conn, $query);
    }
    echo "<div class='table-title bg-dark'>
					<div class=.row'>
						<div class='col-xs-6 '>
							<h2><b>Ticket de Compra</b></h2>
              <h2><b>Número de Ticket: " . $randomString . "</b></h2>
						</div>
						
					</div>
				</div>";
  

    // Insertamos la venta en la base de datos
    $query = "INSERT INTO venta (idVenta) VALUES ('$randomString')";
    mysqli_query($conn, $query);


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
            echo "</tbody>";
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
            $total = number_format($total, 2);
            echo "Total: $" . $total;

            //Obtenemos el valor actual del monedero del cliente
            $query = "SELECT monedero FROM cliente WHERE idCliente = '$idCliente'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $monedero = $row['monedero'];

                // Verificamos si el cliente tiene suficiente dinero en su monedero
                if ($monedero < $total) {
                    echo "<p>No tienes suficiente dinero en tu monedero para realizar la compra</p>";
                    exit();
                }else{
                    //echo "<p>Mi Monedero A: $" . $monedero . "</p>";
                    echo "<p>Dinero Restante en Monedero: $" . ($monedero - $total) . "</p>";

                    // Actualizamos el monedero del cliente
                    $query = "UPDATE cliente SET monedero = $monedero - $total WHERE idCliente = '$idCliente'";
                    mysqli_query($conn, $query);

                    // Actualizamos el carrito del cliente
                    $query = "UPDATE carrito SET idVenta = '$randomString' WHERE idCliente = '$idCliente' AND idVenta IS NULL";
                    mysqli_query($conn, $query);
                }
                
            }
        } else {
            //echo "No se encontraron resultados";
        }
    } 

    mysqli_close($conn);

    $html = ob_get_clean();
    //echo $html;

    $dompdf = new Dompdf();

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("ticket.pdf", array("Attachment" => false));
}

?>
</div>
        </div>
    </div>
</body>
</html>