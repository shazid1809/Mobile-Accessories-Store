<?php
include 'includes/header.php';
$invoice_file = isset($_GET['invoice']) ? $_GET['invoice'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center mb-4">Thank You!</h1>
        <p class="text-center">Your order has been placed successfully. A PDF invoice has been generated.</p>
        <?php if ($invoice_file): ?>
            <div class="text-center mt-4">
                <a href="<?php echo htmlspecialchars($invoice_file); ?>" class="btn btn-primary" download>Download Invoice</a>
            </div>
        <?php else: ?>
            <div class="text-center mt-4">
                <p>Sorry, there was an issue generating your invoice. Please try again later.</p>
            </div>
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
