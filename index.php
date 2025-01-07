<?php
include 'includes/header.php';
include 'includes/config.php';

$product = new Product($db);
$category = new Category($db); 

$category_id = isset($_GET['category']) ? intval($_GET['category']) : null;
$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

$products = $product->getProducts($category_id, $search);

$categories = $category->getCategories();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobile Accessories Store</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> 

</head>
<body>
<div class="hero">
        <div class="container">
            <h1 class="hero-title">Discover the <br>Best Mobile Accessories</h1>
            <p class="hero-subtitle">Explore Our Curated Selection of Mobile Accessories for <br>Unmatched Performance and Style.
</p>
        </div>
    </div>
    <section class="about-us py-5" id= "about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2>About Us</h2>
                <p>
                    Welcome to our Mobile Accessories Store! We are dedicated to providing the best quality products at competitive prices. Our store offers a wide range of accessories to enhance your mobile experience, from protective cases to cutting-edge chargers. Our mission is to deliver high-quality products that meet your needs and exceed your expectations. Thank you for choosing us as your trusted mobile accessories provider.
                </p>
            </div>
            <div class="col-md-6">
                <img src="assets/images/about.png" class="img-fluid" alt="About Us">
            </div>
        </div>
    </div>
</section>

<section class="featured-products py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-center">Featured Products</h2>
        <div class="row">
            <?php
            $featuredProducts = $product->getFeaturedProductsByCategory();
            if (!empty($featuredProducts)):
                foreach ($featuredProducts as $item): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($item['name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                <p class="card-text"><strong>$<?php echo htmlspecialchars($item['price']); ?></strong></p>
                                <a href="product.php?id=<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
            else: ?>
                <div class="col-12">
                    <p class="text-center">No featured products available.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
   

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'includes/footer.php'; ?>
