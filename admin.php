<?php

session_start();

if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== "yes") {
    header("Location: login.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Admin</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" type="text/css" href="graficas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <nav>
            <a href="logout.php" class="btn btn-warning">Cerrar Sesión</a>
        </nav>
    </header>
    <div class="grafica1" style="width: 800px; height: 800px; display: flex; justify-content: center; align-items: center;">
        <canvas id="productos"></canvas>
    </div>
    <div class="grafica2" style="width: 800px; height: 800px; display: flex; justify-content: center; align-items: center;">
        <canvas id="categorias"></canvas>
    </div>
    <div class="grafica3" style="width: 800px; height: 800px; display: flex; justify-content: center; align-items: center;">
        <canvas id="stock"></canvas>
    </div>
    <div class="grafica4" style="width: 800px; height: 800px; display: flex; justify-content: center; align-items: center;">
        <canvas id="ingresosGlobales"></canvas>
    </div>
    <div class="grafica5" style="width: 800px; height: 800px; display: flex; justify-content: center; align-items: center;">
        <canvas id="ingresosPorProducto"></canvas>
    </div>
    <script src="js/graficas.js"></script>
</body>
</html>