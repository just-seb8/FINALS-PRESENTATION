
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>like coffee</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=Irish+Grover&family=Lexend:wght@100..900&family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Sixtyfour+Convergence&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>like coffee?</h1>
        <nav>
            <ul>
                <li><a href="Index.html">Home</a></li>
                <li><a href="#coffee">Coffee</a></li>
                <li><a href="#milktea">Milk Tea</a></li>
                <li><a href="#snacks">Snacks</a></li>
                <li><a href="#food">Food</a></li>
                <li><a href="logout.php">logout</a></li>
            </ul>
        </nav>
    </header>

    <section id="products">
        <!-- Coffee Section -->
        <h2 id="coffee">Coffee</h2>
        <div class="product" data-category="coffee" data-name="Caramel Macchiato" data-price="80.00">
            <h3>Caramel Macchiato</h3>
            <p>P80.00</p>
            <img src="images/caramel_macchiato.jpg" alt="Caramel Macchiato" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
        <div class="product" data-category="coffee" data-name="Espresso" data-price="70.00">
            <h3>Espresso</h3>
            <p>P70.00</p>
            <img src="1.jpg" alt="Espresso" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>

        <!-- Milk Tea Section -->
        <h2 id="milktea">Milk Tea</h2>
        <div class="product" data-category="milktea" data-name="Classic Milk Tea" data-price="50.00">
            <h3>Classic Milk Tea</h3>
            <p>P50.00</p>
            <img src="images/classic_milk_tea.jpg" alt="Classic Milk Tea" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
        <div class="product" data-category="milktea" data-name="Taro Milk Tea" data-price="50.00">
            <h3>Taro Milk Tea</h3>
            <p>P50.00</p>
            <img src="images/taro_milk_tea.jpg" alt="Taro Milk Tea" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>

        <!-- Snacks Section -->
        <h2 id="snacks">Snacks</h2>
        <div class="product" data-category="snacks" data-name="Croissant" data-price="100.00">
            <h3>Croissant</h3>
            <p>P100.00</p>
            <img src="images/croissant.jpg" alt="Croissant" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
        <div class="product" data-category="snacks" data-name="Chocolate Muffin" data-price="90.00">
            <h3>Chocolate Muffin</h3>
            <p>P90.00</p>
            <img src="images/chocolate_muffin.jpg" alt="Chocolate Muffin" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>

        <!-- Food Section -->
        <h2 id="food">Food</h2>
        <div class="product" data-category="food" data-name="Grilled Cheese Sandwich" data-price="70.00">
            <h3>Grilled Cheese Sandwich</h3>
            <p>P70.00</p>
            <img src="images/grilled_cheese.jpg" alt="Grilled Cheese Sandwich" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
        <div class="product" data-category="food" data-name="Pasta" data-price="120.00">
            <h3>Pasta</h3>
            <p>P120.00</p>
            <img src="images/pasta.jpg" alt="Pasta" width="100">
            <button onclick="addToCart(this)">Add to Cart</button>
        </div>
    </section>

    <aside id="cart">
        <h2>Your Cart</h2>
        <ul id="cart-items"></ul>
        <p>Total: P<span id="total">0.00</span></p>
        <button onclick="placeOrder()">Place Order</button>
    </aside>

    <script src="script.js"></script>
</body>
</html>
