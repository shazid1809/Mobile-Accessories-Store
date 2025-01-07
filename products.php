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
    <title>Our Products</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css"> 
</head>
<body>

<div class="hero">
        <div class="container">
            <h1 class="hero-title">Explore Our Premium <br>Mobile Accessories</h1>
            <p class="hero-subtitle">Explore top-quality accessories crafted for your <br>mobile device.




</p>
        </div>
    </div>

<div class="container mt-4">
    <h1 class="text-left mb-4">Our Products</h1>
    
    <form method="GET" action="products.php" class="mb-4">
        <div class="form-row align-items-center">
            <div class="col-auto">
                <input type="text" name="search" class="form-control mb-2" placeholder="Search" value="<?php echo htmlspecialchars($search); ?>">
            </div>
            <div class="col-auto">
                <select name="category" class="form-control mb-2">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['id']); ?>" 
                            <?php echo ($category_id == $cat['id'] ? 'selected' : ''); ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-auto">
                <input type="submit" class="btn btn-primary mb-2" value="Filter">
            </div>
        </div>
    </form>
    
    <div class="row">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="<?php echo htmlspecialchars($item['image']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($item['name']); ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                            <p class="card-text"><strong>$<?php echo htmlspecialchars($item['price']); ?></strong></p>
                            <div class="btn-center">
                                <a href="product.php?id=<?php echo htmlspecialchars($item['id']); ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <p class="text-center">No products found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php include 'includes/footer.php'; ?>
