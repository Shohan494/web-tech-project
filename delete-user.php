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
  header("Location: users-management.php");
  exit;
}

$id = $_GET['id'];

// delete user from database
$sql = "DELETE FROM users WHERE id = '$id'";

if(mysqli_query($conn, $sql)) {
  header("Location: users-management.php");
  exit;
} else {
  $error = "Error deleting user: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
<!DOCTYPE html>
<html>
<head>
  <title>Delete User</title>
</head>
<body>
<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>

<?php

include 'footer.php';

?>