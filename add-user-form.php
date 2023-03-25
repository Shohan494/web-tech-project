<?php

session_start();

include 'connect.php';

if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_email = $_SESSION['logged_in_user']['username'];

// if role admin
// customer, salesman crud

$user_role = $_SESSION['logged_in_user']['role'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  if(empty($name) || empty($email) || empty($password) || empty($role)) {
    $error = "Please fill in all fields.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";
  } else {
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$name', '$email', '$password', '$role')";
    if(mysqli_query($conn, $sql)) {
      header("Location: users-management.php");
      exit;
    } else {
      $error = "Error adding user: " . mysqli_error($conn);
    }
    mysqli_close($conn);
  }
}

?>

    <?php
    include 'menu.php';
    ?>

<h1>Add User</h1>

<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
  <label>
    Name:<br>
    <input type="text" name="name">
  </label><br>
  <label>
    Email:<br>
    <input type="email" name="email">
  </label><br>
  <label>
    Password:<br>
    <input type="password" name="password">
  </label><br>
  <label>
    Role:<br>
    <select name="role">
      <option value="">Select Role<option>
      <option value="admin">Admin</option>
      <option value="salesman">Salesman</option>
      <option value="customer">Customer</option>
    </select>
  </label><br><br>
  <button type="submit">Add User</button>
</form>

<?php

include 'footer.php';

?>