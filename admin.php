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
    
    <link rel="stylesheet" type="text/css" href="graficas.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.0/font/bootstrap-icons.css" />
    <style>
        body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
        }
        .table-responsive {
            margin: 5px 0;
        }
        .table-wrapper {
            min-width: 1000px;
            
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
        
       
        table.table td i {
            font-size: 19px;
        }
        table.table .avatar {
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 10px;
        }
        @media (max-width: 600px) {
    .grafica1 {
        /* Ajusta estos valores según necesites */
        width: 50%; /* Reduce el ancho */
        height: auto; /* Mantiene la proporción */
        font-size: 0.8em; /* Reduce el tamaño del texto, si es necesario */
    }
}
       
    </style>
</head>
<body>
    <header>
    <nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand text-light" ><b>Panel Admin</b></a>
                <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"></li>
                        
                    </ul>
                    <form class="d-flex">
                    <a href="logout.php" class="btn btn-outline-danger" type="submit">
                            
                            Cerrar sesión
                            
                           
                            </a>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <div class="container ">
    <div class="table-responsive">
    <div class="table-wrapper ">
    <table class='table table-striped'>
    <tbody>
    <td>
    <div class="grafica1" >
        <canvas id="productos" width="400px" height="300px"></canvas>
    </div> </td>
    <td>
    <div class="grafica2" >
        <canvas id="categorias" width="400px" height="300px"></canvas>
    </div></td>
    <td>
    <div class="grafica3" >
        <canvas id="stock" width="1000px" height="700px"></canvas>
    </div> </td>
    <td>
    <div class="grafica4" >
        <canvas id="stock2" width="1000px" height="700px"></canvas>
    </div> </td>
    <td>
    <div class="grafica5" >
        <canvas id="ingresosGlobales" width="400px" height="300px"></canvas>
    </div> </td>
    <td>
    <div class="grafica6" >
        <canvas id="ingresosPorProducto" width="400px" height="300px"></canvas>
    </div> </td>
    </tbody>
    </table>
    </div>
    </div>
    </div>
    <script src="js/graficas.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>