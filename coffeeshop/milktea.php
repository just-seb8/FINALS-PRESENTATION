<?php
// Start the PHP session if needed
session_start();

// Page title
$title = "MilkTea Selection";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milk Tea Selections</title>
    <link rel="stylesheet" href="style3.css">
    <script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
    <style>
        body {
    margin: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Full height of the viewport */
}

        h1 {
            text-align: center;
            margin-top: 100px; /* Adjust this value as needed to center it vertically */
            font-size: 2.5em;
        }

        .navbar, .content, .footer-container {
            position: relative; 
            z-index: 1; 
        }

        /* Heading style */
        .section-header {
            text-align: center;
            font-size: 5em;
            color: white;
            margin-top: 40px;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }

        /* Grid container for coffee options */
        /* Grid container for milk tea options */
.coffee-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Responsive grid */
    gap: 20px;
    padding: 40px;
    max-width: 100%; /* Ensure it fits the container */
    margin: 0 auto;
    position: relative;
    z-index: 1;
    box-sizing: border-box; /* Avoids content overflow */
}

.coffee-card {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    position: relative;
    width: 100%; /* Ensures cards don't exceed the container width */
    box-sizing: border-box; /* Prevents overflow */
}

.coffee-card img {
    width: 100%; /* Image will fit the card */
    height: auto;
    border-radius: 8px;
    transition: transform 0.3s ease;
    cursor: pointer;
    object-fit: cover; /* Ensures images maintain their aspect ratio */
}


        /* This class will be toggled to zoom the image */
        .coffee-card img.clicked {
            transform: scale(1.6); /* Reduced scale to avoid it zooming too far */
            z-index: 999;  /* Ensure it's on top of other content */
            position: relative;
        }

        .coffee-card h3 {
            font-size: 1.2em;
            margin: 10px 0;
            color: #000;
        }

        .coffee-card p {
            font-size: 0.9em;
            color: #000000;
        }

        .buy-button {
            display: inline-block; 
            padding: 10px 15px;
            margin-top: 5px;
            font-size: 14px;
            cursor: pointer;
            text-transform: uppercase;
            background-color: #6c4f37;
            color: var(--white);
            border: none;
            border-radius: 15px;
            font-weight: 500;
            border: 1px solid #6c4f37;
            transition: 0.5s;
            text-decoration: none;
        }

        .buy-button:hover {
            background-color: white;
            color: #6c4f37;
        }

        /* Cart Styles */
        .cart {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #fff;
    padding: 30px;
    width: 250px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    font-family: 'Arial', sans-serif;
    z-index: 50;
    font-size: 0.9em;
    border: 1px solid #eee;
    display: flex;
    flex-direction: column;
    align-items: flex-end; /* Align items to the right */
    overflow: hidden; /* Prevent scrolling */
}


        .cart h2 {
            font-size: 1.5em;
            color: #6c4f37;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
        }

            .cart ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 12px;
    width: 100%; /* Ensure it takes full width of the cart container */
    max-height: none; /* Remove height limit */
    overflow: hidden; /* Prevent scrolling */
}

/* Adjust individual cart items for correct alignment */
.cart ul li {
    margin-right: 90px;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.9em;
    color: #333;
    width: 100%; /* Ensure list items take the full width */
    max-width: calc(100% - 40px); /* Prevent it from going beyond the container width */
}
/* Adjust item details and prices */
.cart ul li .item-name {
    font-weight: bold;
    color: #333;
    flex-basis: 50%;
    text-align: left;
}

.cart ul li .item-price,
.cart ul li .item-quantity {
    font-size: 0.9em;
    color: #6c4f37;
    text-align: right;
    flex-basis: 25%;
}

.cart ul li .remove-item {
    background-color: transparent;
    border: none;
    cursor: pointer;
    color: #d9534f;
    font-size: 1em;
    transition: color 0.3s;
    padding: 3px;
    font-weight: bold;
    flex-basis: 20%;
}
        .cart ul li .remove-item:hover {
            color: #c9302c; /* Darker red for hover effect */
        }

        /* Cart Scroll Styling */
        .cart ul {
            max-height: 280px; /* Limit the height of the cart list */
            overflow-y: auto;
            padding-right: 5px; /* Prevent overlap with the scrollbar */
        }

        .cart ul li img {
            width: 40px; /* Image size */
            height: 40px;
            border-radius: 5px;
            object-fit: cover; /* Ensures image aspect ratio is maintained */
            margin-right: 10px;
        }

        .cart ul li .item-details {
            display: flex;
            align-items: center;
            gap: 10px; /* Space between image and text */
        }

        /* Place Order Button */
        #place-order {
            background-color: #6c4f37;
            color: white;
            padding: 10px;
            font-size: 14px; /* Smaller button font */
            text-align: center;
            width: 100%;
            cursor: pointer;
            border: none;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            text-transform: uppercase;
            margin-top: 20px;
            font-weight: bold;
        }

        #place-order:hover {
            background-color: #4e3622;
        }

        #place-order:focus {
            outline: none;
        }
        /* Footer styles */
        
    </style>
</head>
<body>  
    <div class="main">
        <!-- Navbar -->
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">like coffees</h2>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="coffee.php">Coffee</a></li>
                    <li><a href="milktea.php">Milk Tea</a></li>
                    <li><a href="snack.php">Snacks</a></li>
                    <li><a href="food.php">Food</a></li>
                </ul>
            </div>
        </div>

<!-- Milk Tea Selection Section -->
<div class="content">
    <h1>Milk Tea Selection</h1>
    <div class="coffee-grid">
        <div class="coffee-card">
            <img src="pic/roy.webp" alt="Royal Milk Tea" class="zoomable" data-id="1" data-name="Royal Milk Tea" data-price="180" data-img="pic/roy.webp">
            <h3>Royal Milk Tea</h3>
            <p>Luxuriously smooth with a regal blend of black tea and creamy milk.</p>
            <p class="price">₱180.00</p>
            <button class="add-to-cart" data-id="1" data-name="Royal Milk Tea" data-price="180" data-img="pic/roy.webp">Add to Cart</button>
        </div>
        <div class="coffee-card">
            <img src="pic/cbm.webp" alt="Classic Black Milk Tea" class="zoomable" data-id="2" data-name="Classic Black Milk Tea" data-price="160" data-img="pic/cbm.webp">
            <h3>Classic Black Milk Tea</h3>
            <p>Rich and bold, this timeless favorite pairs perfectly with tapioca pearls.</p>
            <p class="price">₱160.00</p>
            <button class="add-to-cart" data-id="2" data-name="Classic Black Milk Tea" data-price="160" data-img="pic/cbm.webp">Add to Cart</button>
        </div>
        <div class="coffee-card">
            <img src="pic/mat.webp" alt="Matcha Milk Tea" class="zoomable" data-id="3" data-name="Matcha Milk Tea" data-price="170" data-img="pic/mat.webp">
            <h3>Matcha Milk Tea</h3>
            <p>Earthy matcha flavor blended with creamy milk for a refreshing treat.</p>
            <p class="price">₱170.00</p>
            <button class="add-to-cart" data-id="3" data-name="Matcha Milk Tea" data-price="170" data-img="pic/mat.webp">Add to Cart</button>
        </div>
        <div class="coffee-card">
            <img src="pic/thai.webp" alt="Thai Milk Tea" class="zoomable" data-id="4" data-name="Thai Milk Tea" data-price="190" data-img="pic/thai.webp">
            <h3>Thai Milk Tea</h3>
            <p>A sweet and spiced blend, with hints of star anise and cardamom.</p>
            <p class="price">₱190.00</p>
            <button class="add-to-cart" data-id="4" data-name="Thai Milk Tea" data-price="190" data-img="pic/thai.webp">Add to Cart</button>
        </div>
        <div class="coffee-card">
            <img src="pic/taro.webp" alt="Taro Milk Tea" class="zoomable" data-id="5" data-name="Taro Milk Tea" data-price="180" data-img="pic/taro.webp">
            <h3>Taro Milk Tea</h3>
            <p>Sweet, nutty flavor with a hint of vanilla, made from real taro.</p>
            <p class="price">₱180.00</p>
            <button class="add-to-cart" data-id="5" data-name="Taro Milk Tea" data-price="180" data-img="pic/taro.webp">Add to Cart</button>
        </div>
        <div class="coffee-card">
            <img src="pic/alm.webp" alt="Almond Milk Tea" class="zoomable" data-id="6" data-name="Almond Milk Tea" data-price="175" data-img="pic/alm.webp">
            <h3>Almond Milk Tea</h3>
            <p>A fragrant blend of almond essence and smooth black tea.</p>
            <p class="price">₱175.00</p>
            <button class="add-to-cart" data-id="6" data-name="Almond Milk Tea" data-price="175" data-img="pic/alm.webp">Add to Cart</button>
        </div>
    </div>
</div>

        <!-- Cart -->
            <div class="cart" id="cart">
                <h2>Cart</h2>
                <ul id="cart-items"></ul>
        <a href="order.php" id="place-order">Place Order</a>
            </div>

        <!-- Footer -->
                <!-- Footer -->
                <footer class="footer">
            <p>&copy;© 2024 Like Coffees - All rights reserved</p>
        </footer>
    </div>
    </div>

    <!-- JavaScript for Cart Functionality -->
    <script>
                document.querySelectorAll('.zoomable').forEach(item => {
            item.addEventListener('click', function() {
                let img = this;
                let clicked = img.classList.contains('clicked');
                if (clicked) {
                    img.classList.remove('clicked');
                } else {
                    img.classList.add('clicked');
                }
            });
        });

        // Cart functionality
    const cart = document.getElementById('cart');
    const cartItemsList = document.getElementById('cart-items');
const placeOrderButton = document.getElementById('place-order');
const addToCartButtons = document.querySelectorAll('.add-to-cart');

let cartItems = [];

// Update the cart display
function updateCart() {
    cartItemsList.innerHTML = ''; // Clear the cart list
    cartItems.forEach((item, index) => {
        const listItem = document.createElement('li');
        listItem.innerHTML = `
            <div class="item-details">
                <img src="${item.img}" alt="${item.name}">
                <span class="item-name">${item.name}</span>
            </div>
            <span class="item-price">₱${item.price}</span>
            <span class="item-quantity">x${item.quantity}</span>
            <button class="remove-item" data-index="${index}">Remove</button>
        `;
        cartItemsList.appendChild(listItem);
    });

    // Handle item removal
    document.querySelectorAll('.remove-item').forEach(button => {
        button.addEventListener('click', function() {
            const itemIndex = this.getAttribute('data-index');
            cartItems.splice(itemIndex, 1); // Remove the item from the array
            updateCart(); // Refresh the cart display
        });
    });
}

// Add item to the cart
addToCartButtons.forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const price = this.getAttribute('data-price');
        const img = this.getAttribute('data-img');
        
        const existingItem = cartItems.find(item => item.id === id);
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cartItems.push({ id, name, price, quantity: 1, img });
        }

        updateCart(); // Refresh the cart display
    });
});
// Add session handling
placeOrderButton.addEventListener('click', function() {
    if (cartItems.length === 0) {
        alert("Your cart is empty!");
    } else {
        // Convert the cart items to JSON and store in sessionStorage
        sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
        // Redirect to the order page
        window.location.href = 'milktea.php';
    }
});

// Handle placing the order
placeOrderButton.addEventListener('click', function() {
    if (cartItems.length === 0) {
        alert("Your cart is empty!");
    } else {
        alert("Order placed successfully!");
        cartItems = []; // Clear the cart
        updateCart(); // Refresh the cart display
    }
});

    </script>   
</body>
</html>
