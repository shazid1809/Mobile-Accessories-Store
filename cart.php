<?php
session_start();

include 'includes/config.php';  

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$db = new DB();
$pdo = $db->connect();

function addToCart($product_id, $quantity) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = :id');
    $stmt->execute([':id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        $product['quantity'] = $quantity;
        $_SESSION['cart'][$product_id] = $product;
    }
}

function removeFromCart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'], $_POST['quantity'])) {
    $product_id = intval($_POST['product_id']);
    $quantity = intval($_POST['quantity']);

    addToCart($product_id, $quantity);

    header('Location: cart.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_product_id'])) {
    $remove_product_id = intval($_POST['remove_product_id']);

    removeFromCart($remove_product_id);

    header('Location: cart.php');
    exit;
}

include 'includes/header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>


<div class="hero">
        <div class="container">
            <h1 class="hero-title">Discover the <br>Best Mobile Accessories</h1>
            <p class="hero-subtitle">Explore Our Curated Selection of Mobile Accessories for <br>Unmatched Performance and Style.





</p>
        </div>
    </div>
<body>
    <div class="container mt-4" style="padding-top: 60px; padding-bottom: 60px;">
        <h1 class="text-center mb-4">Your Shopping Cart</h1>

        <?php if (!empty($_SESSION['cart'])): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $product_id => $item) {
                        $item_total = $item['price'] * $item['quantity'];
                        $total_price += $item_total;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td>
                            <td>$<?php echo htmlspecialchars(number_format($item['price'], 2)); ?></td>
                            <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                            <td>$<?php echo htmlspecialchars(number_format($item_total, 2)); ?></td>
                            <td>
                                <form action="cart.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="remove_product_id" value="<?php echo htmlspecialchars($product_id); ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

            <div class="text-right mb-4">
                <h3>Total: $<?php echo htmlspecialchars(number_format($total_price, 2)); ?></h3>
                <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
            </div>
        <?php else: ?>
            <p class="text-center">Your cart is empty.</p>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include 'includes/footer.php';
?>
