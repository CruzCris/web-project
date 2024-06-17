<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista de Admin</title>
    <link rel="stylesheet" href="styles.css">
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
    <canvas id="productos"></canvas>
    <canvas id="categorias"></canvas>
    <canvas id="stock"></canvas>
    <canvas id="ingresosGlobales"></canvas>
    <canvas id="ingresosProductos"></canvas>
    <script>
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('productos').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.map(item => item.titulo), // eje X
                        datasets: [{
                            label: '5 productos más vendidos',
                            data: data.map(item => item.cantidadVendida), // eje Y
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
</body>
</html>