let cart = [];

// Function to add items to the cart
function addToCart(button) {
    const productElement = button.parentElement;
    const name = productElement.getAttribute("data-name");
    const price = parseFloat(productElement.getAttribute("data-price"));

    const product = {
        name: name,
        price: price
    };

    // Send AJAX request to add the product to the cart
    fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            'add_to_cart': true,
            'product_name': name,
            'product_price': price
        })
    })
    .then(response => response.json())
    .then(data => {
        cart = data.cart;
        updateCart();
    });
}


// Function to update the cart display
function updateCart() {
    const cartItemsElement = document.getElementById("cart-items");
    const totalElement = document.getElementById("total");

    cartItemsElement.innerHTML = "";

    let total = 0;

    cart.forEach((product, index) => {
        // Ensure price is a number before using toFixed
        const price = parseFloat(product.price) || 0;  // Ensure valid number

        const li = document.createElement("li");
        li.innerHTML = `${product.name} - $${price.toFixed(2)} 
            <button onclick="removeFromCart(${index})">Remove</button>`;
        cartItemsElement.appendChild(li);
        total += price;
    });

    totalElement.textContent = total.toFixed(2);
}

// Function to remove items from the cart
function removeFromCart(index) {
    fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({
            'remove_from_cart': true,
            'index': index
        })
    })
    .then(response => response.json())
    .then(data => {
        cart = data.cart;
        updateCart();
    });
}

// Function to place the order
// Function to place the order
// Function to place the order
// Function to place the order
// Function to place the order
function placeOrder() {
    if (cart.length === 0) {
        alert("Your cart is empty! Please add items to your cart before placing an order.");
        return;
    }

    fetch('cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ 'place_order': true })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.total) {
            document.getElementById("total").textContent = '$' + data.total;
        }

        // Clear the cart on the frontend as well
        cart = [];
        updateCart();  // Update the cart display after clearing
    })
    .catch(error => console.log('Error placing order:', error));
}


// Initialize cart
let total = [];

// Function to add items to the cart
function addToCart(item) {
    cart.push(item);
    updateCart();
}

// Update the cart display
function updateCart() {
    const cartItemsContainer = document.getElementById("cart-items");
    cartItemsContainer.innerHTML = "";
    cart.forEach(item => {
        const cartItemElement = document.createElement("li");
        cartItemElement.innerHTML = `
            <span class="item-name">${item.name}</span> 
            <span class="item-quantity">x${item.quantity}</span> 
            <span class="item-price">₱${item.price * item.quantity}</span>
            <button class="remove-item" onclick="removeFromCart(${item.id})">Remove</button>
        `;
        cartItemsContainer.appendChild(cartItemElement);
    });
}

// Function to remove item from cart
function removeFromCart(itemId) {
    cart = cart.filter(item => item.id !== itemId);
    updateCart();
}

// Event listeners for "Add to Cart" buttons
document.querySelectorAll(".add-to-cart").forEach(button => {
    button.addEventListener("click", (event) => {
        const id = event.target.dataset.id;
        const name = event.target.dataset.name;
        const price = event.target.dataset.price;

        const item = { id, name, price, quantity: 1 };
        addToCart(item);
    });
});

// Event listener for Place Order button
document.getElementById("place-order").addEventListener("click", () => {
    alert("Order placed successfully!");
    cart = []; // Clear cart after order
    updateCart();
});
