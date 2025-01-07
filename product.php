<?php
include 'includes/header.php';
include 'includes/config.php';

$dbInstance = new DB();
$db = $dbInstance->connect();

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']);
    
    $product = new Product($db);
    $item = $product->getProductById($product_id);
    
    if (!$item) {
        echo "<p>Product not found.</p>";
        include 'includes/footer.php';
        exit;
    }
} else {
    echo "<p>No product selected.</p>";
    include 'includes/footer.php';
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($item['name']); ?> - Product Details</title>
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
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($item['image']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($item['name']); ?>">
        </div>
        <div class="col-md-6">
            <h1><?php echo htmlspecialchars($item['name']); ?></h1>
            <p><?php echo htmlspecialchars($item['description']); ?></p>
            <p><strong>Price: $<?php echo htmlspecialchars($item['price']); ?></strong></p>
            
            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <div class="form-group">
                    <label for="quantity">Quantity:</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                </div>
                <button type="submit" class="btn btn-success">Add to Cart</button>
            </form>

            <a href="checkout.php" class="btn btn-primary mt-3">Proceed to Checkout</a>
        </div>
    </div>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
include 'includes/footer.php';
?>
