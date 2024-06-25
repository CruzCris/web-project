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

    echo "<h1>Ticket de Compra</h1>";
    echo "<p>Fecha de compra: " . date("Y-m-d") . "</p>";
    echo "<p>Número de Ticket: " . $randomString . "</p>";

    // Insertamos la venta en la base de datos
    $query = "INSERT INTO venta (idVenta) VALUES ('$randomString')";
    mysqli_query($conn, $query);


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
            echo "<td>$" . $row['precio'] . "</td>";
            echo "<td>" . $row['descuento'] . "%</td>";
            echo "</tr>";
        }

        echo "</table>";

        // Obtenemos el total a pagar
        $query = "SELECT c.idCliente, SUM(c.cantidad * p.precio * (1 - p.descuento / 100)) AS total
        FROM carrito c
        JOIN producto p ON c.idProducto = p.idProducto
        WHERE c.idCliente = '$idCliente' AND idVenta IS NULL
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
                    $query = "UPDATE carrito SET idVenta = '$randomString' WHERE idCliente = '$idCliente'";
                    mysqli_query($conn, $query);

                    echo "<p>Gracias por tu compra!</p>";
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