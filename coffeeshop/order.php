<?php
session_start();


// Database connection
$host = 'localhost';
$dbname = 'coffee_shop';
$username = 'root';  // Change if different
$password = '';      // Change if different

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="style3.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .order-container {
            background: white;
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #6c4f37;
        }
        .order-details {
            text-align: left;
            margin-top: 20px;
        }
        .order-item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .item-name {
            font-weight: bold;
        }
        .item-quantity, .item-price {
            color: #6c4f37;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            margin-top: 20px;
        }
        .back-home {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6c4f37;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .back-home:hover {
            background-color: #4e3622;
        }
        .form-container {
            margin-top: 30px;
            text-align: left;
        }
        .form-container input, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            padding: 10px 20px;
            background-color: #6c4f37;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-container button:hover {
            background-color: #4e3622;
        }
    </style>
</head>
<body>

<div class="order-container">
        <h1>Order Confirmation</h1>
        <div class="order-details" id="order-details"></div>
        <div class="total" id="total"></div>

        <!-- Customer Information Form -->
        <div class="form-container">
            <h3>Enter Your Information</h3>
            <form id="order-form" method="POST" action="order_confirmation.php">
                <label for="name">Full Name</label>
                <input type="text" id="name" name="name" required placeholder="Enter your full name">

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required placeholder="Enter your email">

                <label for="address">Shipping Address</label>
                <textarea id="address" name="address" rows="3" required placeholder="Enter your shipping address"></textarea>

                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" required placeholder="Enter your phone number">

                <!-- Hidden Field for Cart Data -->
                <input type="hidden" id="cartData" name="cartItems">

                <button type="submit">Proceed to Checkout</button>
            </form>
        </div>

        <a href="index.html" class="back-home">Back to Home</a>
    </div>

    <script>
        // Retrieve cart data from sessionStorage
        const cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

        // Display cart items
        const orderDetailsContainer = document.getElementById('order-details');
        const totalContainer = document.getElementById('total');

        let totalAmount = 0;
        cartItems.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.classList.add('order-item');
            itemElement.innerHTML = `
                <div class="item-name">${item.name} x${item.quantity}</div>
                <div class="item-price">₱${item.price * item.quantity}</div>
            `;
            orderDetailsContainer.appendChild(itemElement);

            totalAmount += item.price * item.quantity;
        });

        // Display total amount
        totalContainer.textContent = `Total: ₱${totalAmount}`;

        // Clear sessionStorage after displaying
        sessionStorage.removeItem('cartItems');

        // Handle form submission
        const orderForm = document.getElementById('order-form');
        orderForm.addEventListener('submit', (e) => {
            e.preventDefault();

            // Capture the form data
            const customerData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                address: document.getElementById('address').value,
                phone: document.getElementById('phone').value
            };

            // Set cart data in hidden input
            document.getElementById('cartData').value = JSON.stringify(cartItems);

            // Submit the form (this will send cart items and customer data to 'order_confirmation.php')
            orderForm.submit();  // Proceed to 'order_confirmation.php'
        });
    </script>
</body>
</html>
