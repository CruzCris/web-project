fetch('data.php')
            .then(response => response.json())
            .then(data => {
                const top5 = document.getElementById('productos').getContext('2d');
                new Chart(top5, {
                    type: 'bar',
                    data: {
                        labels: data.data1.map(item => item.titulo), // eje X
                        datasets: [{
                            label: 'Ventas Relizadas',
                            data: data.data1.map(item => item.cantidadVendida), // eje Y
                            backgroundColor: 'rgba(104, 149, 140, 0.8)',
                            borderColor: 'rgba(104, 149, 140, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                                labels: {
                                    font: {
                                        
                                    }
                                }
                            },
                            title: {
                                display: true,
                                text: 'Top 5 Productos Más Vendidos',
                                font:{
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Helvetica Neue'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Ventas Realizadas',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Productos',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
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
                            label: 'Ventas Realizadas',
                            data: data.data2.map(item => item.cantidad), // eje Y
                            backgroundColor: 'rgba(134, 67, 25, 0.8)',
                            borderColor: 'rgba(134, 67, 25, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Top 5 Categorias Más Vendidas',
                                font:{
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Helvetica Neue'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Ventas Realizadas',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Categorias',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
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
                            label: 'Productos en Stock 1-50',
                            data: data.data3.map(item => item.stock), // eje Y
                            backgroundColor: 'rgba(209, 220, 15, 0.8)',
                            borderColor: 'rgba(209, 220, 15, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Stock Actual de la Tienda',
                                font:{
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Helvetica Neue'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Stock',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Productos',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            }
                        }
                    }
                });
                const stock2 = document.getElementById('stock2').getContext('2d');
                new Chart(stock2, {
                    type: 'bar',
                    data: {
                        labels: data.data4.map(item => item.titulo), // eje X
                        datasets: [{
                            label: 'Productos en Stock 51-100',
                            data: data.data4.map(item => item.stock), // eje Y
                            backgroundColor: 'rgba(209, 220, 15, 0.8)',
                            borderColor: 'rgba(209, 220, 15, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Stock Actual de la Tienda',
                                font:{
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Helvetica Neue'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Stock',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Productos',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            }
                        }
                    }
                });
                const ingresosGlobales = document.getElementById('ingresosGlobales').getContext('2d');
                new Chart(ingresosGlobales, {
                    type: 'bar',
                    data: {
                        labels: data.data5.map(item => item.cantidad), // eje X
                        datasets: [{
                            label: 'Ventas Totales',
                            data: data.data5.map(item => item.total), // eje Y
                            backgroundColor: 'rgba(8, 8, 74, 0.8)',
                            borderColor: 'rgba(8, 8, 74, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Ingresos Globales',
                                font:{
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Helvetica Neue'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Ingresos Totales',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Cantidad Total de Productos Vendidos',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            }
                        }
                    }
                });
                const ingresosPorProducto = document.getElementById('ingresosPorProducto').getContext('2d');
                new Chart(ingresosPorProducto, {
                    type: 'bar',
                    data: {
                        labels: data.data6.map(item => item.titulo), // eje X
                        datasets: [{
                            label: 'Ventas Totales',
                            data: data.data6.map(item => item.total), // eje Y
                            backgroundColor: 'rgba(74, 8, 72, 0.8)',
                            borderColor: 'rgba(74, 8, 72, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Ingresos Totales Por Producto',
                                font:{
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Helvetica Neue'
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Ingresos',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            },
                            x: {
                                beginAtZero: true,
                                title: {
                                    display: true,
                                    text: 'Productos',
                                    color: 'black',
                                    font: {
                                        size: 12,
                                        weight: 'bold',
                                        family: 'Times New Roman'
                                    }
                                }
                            }
                        }
                    }
                });
            });