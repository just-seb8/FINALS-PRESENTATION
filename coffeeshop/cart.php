<?php
session_start();

// Check if the cart exists
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<p>Your cart is empty.</p>";
} else {
    echo "<h1>Your Cart</h1>";
    echo "<table>";
    echo "<tr><th>Item</th><th>Price</th><th>Quantity</th><th>Total</th></tr>";

    $total = 0;
    foreach ($_SESSION['cart'] as $cart_item) {
        $item_total = $cart_item['price'] * $cart_item['quantity'];
        $total += $item_total;

        echo "<tr>";
        echo "<td>" . $cart_item['name'] . "</td>";
        echo "<td>₱" . number_format($cart_item['price'], 2) . "</td>";
        echo "<td>" . $cart_item['quantity'] . "</td>";
        echo "<td>₱" . number_format($item_total, 2) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<p>Total: ₱" . number_format($total, 2) . "</p>";
    echo "<a href='checkout.php'>Proceed to Checkout</a>";
}
?>
