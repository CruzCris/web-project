<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
}
if(isset($_SESSION["idCliente"])) {
    $idCliente = $_SESSION["idCliente"];
    $_SESSION["idCliente"] = $idCliente;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda en Línea</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script defer src="script.js"></script>
</head>
<body>
    <header>
        <h1>Tienda en Línea</h1>
        <nav>
            <a href="carrito.php" class="btn btn-primary">Mi Carrito</a>
            <a href="logout.php" class="btn btn-warning">Cerrar Sesión</a>
        </nav>
    </header>
    <main id="product-list">
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close-button">&times;</span>
                <p id="modal-text"></p>
            </div>
        </div>
        <!-- Los productos se cargarán aquí dinámicamente -->
    </main>
    <script>
    var idCliente = "<?php echo $_SESSION['idCliente']; ?>";
    </script>
</body>
</html>
