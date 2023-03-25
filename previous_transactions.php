<?php
// Start session
session_start();

include 'connect.php';

if($_SESSION['logged_in_user']['role'] !== 'customer') {
  header("Location: unauthorized.php");
  exit;
}



// Retrieve all orders for the current customer
$customer_id = $_SESSION['logged_in_user']['id'];
$query = "SELECT o.order_id, o.product_id, p.name, o.quantity, o.total_cost, o.status, o.order_date 
          FROM orders o 
          JOIN products p ON o.product_id = p.product_id 
          WHERE o.customer_id = $customer_id";
$result = mysqli_query($conn, $query);

// Display all previous transactions in a table
echo "<h2>Previous Transactions</h2>";
if(mysqli_num_rows($result) > 0) {
  echo "<table>";
  echo "<tr><th>Order ID</th><th>Product Name</th><th>Quantity</th><th>Total Cost</th><th>Status</th><th>Order Date</th></tr>";
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['order_id'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['quantity'] . "</td>";
    echo "<td>" . $row['total_cost'] . "</td>";
    echo "<td>" . $row['status'] . "</td>";
    echo "<td>" . $row['order_date'] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "No previous transactions found.";
}

// Close database connection
mysqli_close($conn);
?>
