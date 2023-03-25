<?php
// Start the session
session_start();

// Check if the user is logged in and is an owner/manager
if (!$_SESSION['logged_in_user']['role'] == 'admin') {
    header("Location: login.php");
    exit();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include the database connection
    include('connect.php');

    // Get the form data
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];

    // Prepare the INSERT query
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $product_name, $product_description, $product_price);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect to the products list page
        header("Location: products.php");
        exit();
    } else {
        // Display an error message
        $error_msg = "Failed to add product. Please try again later.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product - Fuel Distribution Management System</title>
</head>
<body>
    <h1>Add Product</h1>

    <?php if (isset($error_msg)) { ?>
        <p style="color: red;"><?php echo $error_msg; ?></p>
    <?php } ?>

    <form method="post">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" required></textarea><br><br>

        <label for="product_price">Product Price:</label>
        <input type="number" step="0.01" min="0" id="product_price" name="product_price" required><br><br>

        <input type="submit" value="Add Product">
    </form>
    <?php

include 'footer.php';

?>