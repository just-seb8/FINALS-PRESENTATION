<?php
// Start the PHP session if needed
session_start();

// Page title
$title = "Snack Selection";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Snack Selections</title>
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

        /* Grid container for snack options */
        .snack-grid {
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

        .snack-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative;
            width: 100%; /* Ensures cards don't exceed the container width */
            box-sizing: border-box; /* Prevents overflow */
        }

        .snack-card img {
            width: 100%; /* Image will fit the card */
            height: auto;
            border-radius: 8px;
            transition: transform 0.3s ease;
            cursor: pointer;
            object-fit: cover; /* Ensures images maintain their aspect ratio */
        }

        /* This class will be toggled to zoom the image */
        .snack-card img.clicked {
            transform: scale(1.6); /* Reduced scale to avoid it zooming too far */
            z-index: 999;  /* Ensure it's on top of other content */
            position: relative;
        }

        .snack-card h3 {
            font-size: 1.2em;
            margin: 10px 0;
            color: #000;
        }

        .snack-card p {
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
            align-items: flex-end;
            overflow: hidden;
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
            width: 100%;
            max-height: none;
            overflow: hidden;
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
            width: 100%;
            max-width: calc(100% - 40px);
        }

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
            color: #c9302c;
        }

        .cart ul {
            max-height: 280px;
            overflow-y: auto;
            padding-right: 5px;
        }

        .cart ul li img {
            width: 40px;
            height: 40px;
            border-radius: 5px;
            object-fit: cover;
            margin-right: 10px;
        }

        .cart ul li .item-details {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #place-order {
            background-color: #6c4f37;
            color: white;
            padding: 10px;
            font-size: 14px;
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

        <!-- Snack Selection Section -->
        <div class="content">
            <h1>Snack Selection</h1>
            <div class="snack-grid">
                <div class="snack-card">
                    <img src="pic/chi.webp" alt="Chips" class="zoomable" data-id="1" data-name="Chips" data-price="50" data-img="pic/chi.webp">
                    <h3>Chips</h3>
                    <p>Classic crispy snack perfect for munching.</p>
                    <p class="price">₱50.00</p>
                    <button class="add-to-cart" data-id="1" data-name="Chips" data-price="50" data-img="pic/chi.webp">Add to Cart</button>
                </div>
                <div class="snack-card">
                    <img src="pic/coo.webp" alt="Cookies" class="zoomable" data-id="2" data-name="Cookies" data-price="100" data-img="pic/coo.webp">
                    <h3>Cookies</h3>
                    <p>Delicious chocolate chip cookies.</p>
                    <p class="price">₱100.00</p>
                    <button class="add-to-cart" data-id="2" data-name="Cookies" data-price="100" data-img="pic/coo.webp">Add to Cart</button>
                </div>
                <div class="snack-card">
                    <img src="pic/mix.webp" alt="Mixed Nuts" class="zoomable" data-id="3" data-name="Mixed Nuts" data-price="120" data-img="pic/mix.webp">
                    <h3>Mixed Nuts</h3>
                    <p>Crunchy and healthy mixed nuts for snacking.</p>
                    <p class="price">₱120.00</p>
                    <button class="add-to-cart" data-id="3" data-name="Mixed Nuts" data-price="120" data-img="pic/mix.webp">Add to Cart</button>
                </div>
                <!-- Additional Snack Options -->
                <div class="snack-card">
                    <img src="pic/pre.webp" alt="Pretzels" class="zoomable" data-id="4" data-name="Pretzels" data-price="90" data-img="pic/pre.webp">
                    <h3>Pretzels</h3>
                    <p>Soft and salty, perfect for snacking.</p>
                    <p class="price">₱90.00</p>
                    <button class="add-to-cart" data-id="4" data-name="Pretzels" data-price="90" data-img="pic/pre.webp">Add to Cart</button>
                </div>
                <div class="snack-card">
                    <img src="pic/can.webp" alt="Candy" class="zoomable" data-id="5" data-name="Candy" data-price="75" data-img="pic/can.webp">
                    <h3>Candy</h3>
                    <p>Sugary treats to satisfy your sweet tooth.</p>
                    <p class="price">₱75.00</p>
                    <button class="add-to-cart" data-id="5" data-name="Candy" data-price="75" data-img="pic/can.webp">Add to Cart</button>
                </div>
                <div class="snack-card">
                    <img src="pic/fru.webp" alt="Fruit Bar" class="zoomable" data-id="6" data-name="Fruit Bar" data-price="60" data-img="pic/fru.webp">
                    <h3>Fruit Bar</h3>
                    <p>A healthy, sweet snack made from real fruits.</p>
                    <p class="price">₱60.00</p>
                    <button class="add-to-cart" data-id="6" data-name="Fruit Bar" data-price="60" data-img="pic/fru.webp">Add to Cart</button>
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
        <footer class="footer">
            <p>&copy;© 2024 Like Coffees - All rights reserved</p>
        </footer>
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
                window.location.href = 'order.php';
            }
        });
    </script>
</body>
</html>
