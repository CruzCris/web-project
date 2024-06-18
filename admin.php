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
    <link rel="stylesheet" href="css/graficas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #myChart {
            width: 200px;  /* Ancho de la gráfica */
            height: 100px; /* Altura de la gráfica */
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header>
        <nav>
            <a href="logout.php" class="btn btn-warning">Cerrar Sesión</a>
        </nav>
    </header>
    <div>
        <canvas id="productos"></canvas>
    </div>
    <div>
        <canvas id="stock"></canvas>
    </div>
    <div>
        <canvas id="ingresosGlobales"></canvas>
    </div>
    
    <script src="js/graficas.js"></script>
</body>
</html>