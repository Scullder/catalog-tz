export function addToCart(productId) {
    const quantity = parseInt(document.getElementById(`quantity-${productId}`).textContent);
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    fetch('/cart/update/' + productId, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            quantity: quantity
        })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount(data.cartCount);
                updateCard(productId, true)
                updateCartPrices(productId, data)
            }
        })
        .catch(error => console.error('Error:', error));
}

export function removeFromCart(productId) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    fetch('/cart/remove/' + productId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount(data.cartCount);
                updateCard(productId, false)
                updateCartPrices(productId, data)
            }
        })
        .catch(error => console.error('Error:', error));
}

export function updateCard(productId, inCart) {
    const productElement = document.querySelector(`[data-product-id="${productId}"]`);

    if (inCart) {
        const addBtn = productElement.querySelector('.add-to-cart-btn');
        if (addBtn) {
            addBtn.outerHTML = `
                <button onclick="Cart.removeFromCart(${productId})"
                        class="ml-4 bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 remove-from-cart-btn">
                    Удалить
                </button>
            `;
        }
    } else {
        const removeBtn = productElement.querySelector('.remove-from-cart-btn');
        if (removeBtn) {
            removeBtn.outerHTML = `
                <button onclick="Cart.addToCart(${productId})"
                        class="ml-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 add-to-cart-btn">
                    В корзину
                </button>
            `;
        }
    }
}

export function changeQuantity(productId, change) {
    const quantityElement = document.getElementById(`quantity-${productId}`);
    let quantity = parseInt(quantityElement.textContent) + change;

    if (quantity < 1) {
        quantity = 1;
    }

    quantityElement.textContent = quantity;

    addToCart(productId)
}

export function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    if (cartCountElement) {
        cartCountElement.textContent = count;
    }
}

export function updateCartPrices(productId, data) {
    const productRow = document.querySelector(`[data-product-id="${productId}"]`);

    if (!data.product) {
        productRow.remove();
    }

    if (productRow && data.product) {
        const totalCell = productRow.querySelector('td:nth-child(4)');
        if (totalCell) {
            totalCell.textContent = data.product.product_total_label;
        } 
    }

    const subtotalElement = document.querySelector('#cart-subtotal');
    const totalElement = document.querySelector('#cart-total');

    if (subtotalElement) {
        subtotalElement.textContent = data.total;
    }

    if (totalElement) {
        totalElement.textContent = data.total;
    } 
}
