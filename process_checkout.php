<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/config.php';
require 'includes/fpdf186/fpdf.php'; 

$cart_items = $_SESSION['cart'] ?? [];

$total_amount = 0;
foreach ($cart_items as $item) {
    $total_amount += $item['price'] * $item['quantity'];
}

$invoice_dir = __DIR__ . '/invoices';
if (!is_dir($invoice_dir)) {
    mkdir($invoice_dir, 0777, true); 
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

$pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';
$pdf->Cell(0, 10, 'Customer Name: ' . $user_name, 0, 1);
$pdf->Cell(0, 10, 'Order Date: ' . date('Y-m-d'), 0, 1);
$pdf->Ln(10);

$pdf->Cell(60, 10, 'Product', 1);
$pdf->Cell(40, 10, 'Price', 1);
$pdf->Cell(30, 10, 'Quantity', 1);
$pdf->Cell(40, 10, 'Total', 1);
$pdf->Ln();

foreach ($cart_items as $item) {
    $pdf->Cell(60, 10, $item['name'], 1);
    $pdf->Cell(40, 10, '$' . $item['price'], 1);
    $pdf->Cell(30, 10, $item['quantity'], 1);
    $pdf->Cell(40, 10, '$' . ($item['price'] * $item['quantity']), 1);
    $pdf->Ln();
}

$pdf->Ln(10);
$pdf->Cell(130, 10, 'Grand Total', 1);
$pdf->Cell(40, 10, '$' . number_format($total_amount, 2), 1);
$pdf->Ln(20);

$invoice_file = 'invoices/invoice_' . time() . '.pdf';
$file_path = __DIR__ . '/' . $invoice_file; 

$pdf->Output('F', $file_path); 

header("Location: thank_you.php?invoice=$invoice_file");
exit();
?>
