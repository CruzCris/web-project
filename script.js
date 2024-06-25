document.addEventListener('DOMContentLoaded', () => {
    fetch('https://dummyjson.com/products?limit=100')
        .then(response => response.json())
        .then(data => {
            const products = data.products;
            const productList = document.getElementById('product-list');
            products.forEach(product => {
                const productCard = document.createElement('div');
                
                productCard.innerHTML = `
                 <div class="card h-100">
                            
                            <!-- Product image-->
                            <img class="card-img-top" src="${product.thumbnail}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">${product.title}</h5>
                                    <!-- Product price-->
                                    
                                    $${product.price}
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" onclick="addToCart(${product.id})">Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                
                `;
                productList.appendChild(productCard);
            });
        });
});

document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function() {
        var productId = this.dataset.productId;
        var idCliente = "<?php echo $_SESSION['idCliente']; ?>";

        fetch('addProduct.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `idCliente=${idCliente}&productId=${productId}`,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    });
});

function addToCart(productId) {
    // Lógica para agregar el producto al carrito
    
    fetch('addProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `productId=${productId}&idCliente=${idCliente}`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        if(data.trim() == "Producto agregado al carrito"){
            //alert("Producto agregado al carrito");
            // Obtener el modal y el texto del modal
            let modal = document.getElementById('modal');
            let modalText = document.getElementById('modal-text');
            Swal.fire({
                title: '¡Éxito!',
                text: 'Producto agregado al carrito',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            // Establecer el texto del modal
            modalText.textContent = "Producto agregado al carrito";

            // Mostrar el modal
            modal.style.display = "block";

            // Obtener el botón de cerrar
            let closeButton = document.querySelector('.close-button');

            // Cerrar el modal cuando se hace clic en el botón de cerrar
            closeButton.onclick = function() {
                modal.style.display = "none";
            }

            // Cerrar el modal después de un tiempo
            setTimeout(() => {
                modal.style.display = "none";
            }, 2000);
        }else if(data.trim() == "No hay stock"){
            Swal.fire({
                title: '¡Error!',
                text: 'No hay stock disponible para este producto.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            //alert("No hay stock disponible");
            // Obtener el modal y el texto del modal
            let modal = document.getElementById('modal');
            let modalText = document.getElementById('modal-text');

            // Establecer el texto del modal
            modalText.textContent = "Producto no disponible";

            // Mostrar el modal
            modal.style.display = "block";

            // Obtener el botón de cerrar
            let closeButton = document.querySelector('.close-button');

            // Cerrar el modal cuando se hace clic en el botón de cerrar
            closeButton.onclick = function() {
                modal.style.display = "none";
            }

            // Cerrar el modal después de un tiempo
            setTimeout(() => {
                modal.style.display = "none";
            }, 2000);
        }
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}

function removeFromCart(productId) {
    // Lógica para remover el producto del carrito
    fetch('removeProduct.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `productId=${productId}`,
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
}