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
                            backgroundColor: 'rgba(104, 149, 140, 0.8)',
                            borderColor: 'rgba(104, 149, 140, 1)',
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
                const categorias = document.getElementById('categorias').getContext('2d');
                new Chart(categorias, {
                    type: 'bar',
                    data: {
                        labels: data.data2.map(item => item.categoria), // eje X
                        datasets: [{
                            label: 'Top 5 categorias más vendidas',
                            data: data.data2.map(item => item.cantidad), // eje Y
                            backgroundColor: 'rgba(134, 67, 25, 0.8)',
                            borderColor: 'rgba(134, 67, 25, 1)',
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
                            backgroundColor: 'rgba(209, 220, 15, 0.8)',
                            borderColor: 'rgba(209, 220, 15, 1)',
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
                            backgroundColor: 'rgba(8, 8, 74, 0.8)',
                            borderColor: 'rgba(8, 8, 74, 1)',
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
                const ingresosPorProducto = document.getElementById('ingresosPorProducto').getContext('2d');
                new Chart(ingresosPorProducto, {
                    type: 'bar',
                    data: {
                        labels: data.data5.map(item => item.titulo), // eje X
                        datasets: [{
                            label: 'Ingresos por Producto',
                            data: data.data5.map(item => item.total), // eje Y
                            backgroundColor: 'rgba(74, 8, 72, 0.8)',
                            borderColor: 'rgba(74, 8, 72, 1)',
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