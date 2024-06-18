fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const top5 = document.getElementById('productos').getContext('2d');
                new Chart(top5, {
                    type: 'bar',
                    data: {
                        labels: data.data1.map(item => item.titulo), // eje X
                        datasets: [{
                            label: 'Top 5 productos más vendidos',
                            data: data.data1.map(item => item.cantidadVendida), // eje Y
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
                const stock = document.getElementById('stock').getContext('2d');
                new Chart(stock, {
                    type: 'bar',
                    data: {
                        labels: data.data3.map(item => item.titulo), // eje X
                        datasets: [{
                            label: 'Stock de productos',
                            data: data.data3.map(item => item.stock), // eje Y
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
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
                const ingresosGlobales = document.getElementById('ingresosGlobales').getContext('2d');
                new Chart(ingresosGlobales, {
                    type: 'bar',
                    data: {
                        labels: data.data4.map(item => item.cantidad), // eje X
                        datasets: [{
                            label: 'Ingresos Globales',
                            data: data.data4.map(item => item.total), // eje Y
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
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