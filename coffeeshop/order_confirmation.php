<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'coffee_shop';
$username = 'root'; // Change if different
$password = '';     // Change if different

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$orderConfirmation = ''; // To store the confirmation message
$orderId = 0;
$totalAmount = 0;

// Check if form is submitted and data is available
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the customer data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $address = $_POST['address'] ?? '';
    $phone = $_POST['phone'] ?? '';

    // Validate input
    if (empty($name) || empty($email) || empty($address) || empty($phone)) {
        die("All customer fields are required.");
    }

    // Get the cart items (it's a JSON string, so we need to decode it)
    $cartItems = isset($_POST['cartItems']) ? json_decode($_POST['cartItems'], true) : [];

    if (!is_array($cartItems) || empty($cartItems)) {
        die("Invalid cart items.");
    }

    // Insert customer order data into the database
    $stmt = $conn->prepare("INSERT INTO orders (name, email, address, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $address, $phone);
    $stmt->execute();
    $orderId = $stmt->insert_id; // Get the ID of the inserted order
    $stmt->close();

    // Calculate total amount and insert each item in the cart into the order_items table
    $stmt = $conn->prepare("INSERT INTO order_items (order_id, item_name, quantity, price) VALUES (?, ?, ?, ?)");
    foreach ($cartItems as $item) {
        if (!isset($item['name'], $item['quantity'], $item['price'])) {
            die("Invalid cart item structure.");
        }

        $totalAmount += $item['price'] * $item['quantity'];
        $stmt->bind_param("isid", $orderId, $item['name'], $item['quantity'], $item['price']);
        $stmt->execute();
    }

    $stmt->close();

    // Update total amount in the orders table
    $stmt = $conn->prepare("UPDATE orders SET total_amount = ? WHERE order_id = ?");
    $stmt->bind_param("di", $totalAmount, $orderId);
    $stmt->execute();
    $stmt->close();

    // Close the connection
    $conn->close();

    // Prepare the confirmation message
    $orderConfirmation = "
        <h1>Order Confirmation</h1>
        <p>Thank you, " . htmlspecialchars($name) . "! Your order has been placed successfully.</p>
        <p>Order ID: " . $orderId . "</p>
        <p>Total Amount: ₱" . number_format($totalAmount, 2) . "</p>
        <p>We will send a confirmation email to: " . htmlspecialchars($email) . ".</p>
        <a href='index.php'>Back to Home</a>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - Like Coffees</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
        }

        /* Container */
        .container {
            width: 80%;
            margin: 0 auto;
            max-width: 1200px;
        }

        /* Navbar */
        .navbar {
            background-color: #2c3e50;
            color: white;
            padding: 15px 0;
            text-align: center;
            margin-bottom: 30px;
        }

        .navbar .logo {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .navbar .menu {
            margin-top: 10px;
        }

        .navbar .menu ul {
            list-style: none;
            padding: 0;
        }

        .navbar .menu ul li {
            display: inline;
            margin-right: 20px;
        }

        .navbar .menu ul li a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            text-transform: uppercase;
        }

        .navbar .menu ul li a:hover {
            color: #f39c12;
        }

        /* Content */
        .content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 30px;
        }

        /* Order Confirmation */
        .order-confirmation {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            padding: 20px;
            background-color: #ecf0f1;
            border: 2px solid #bdc3c7;
            border-radius: 8px;
            max-width: 600px;
            margin: 0 auto;
        }

        .order-confirmation a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            background-color: #f39c12;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }

        .order-confirmation a:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
   
        
        <div class="content">
            <!-- Display the order confirmation message if exists -->
            <?php if (!empty($orderConfirmation)): ?>
                <div class="order-confirmation">
                    <?php echo $orderConfirmation; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
