<?php

session_start();

include 'connect.php';

// check if user is authorized to access this page (e.g. check user role)
if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

// check if ID parameter is present in URL
if(!isset($_GET['id'])) {
  header("Location: products-management.php");
  exit;
}

$id = $_GET['id'];

// delete user from database
$sql = "DELETE FROM products WHERE product_id = '$id'";

if(mysqli_query($conn, $sql)) {
  header("Location: products-management.php");
  exit;
} else {
  $error = "Error deleting product: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete Product</title>
</head>
<body>
<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>
<?php

include 'footer.php';

?>