<?php

session_start();

include 'connect.php';

// check if user is authorized to access this page (e.g. check user role)
if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

// retrieve user data from database
// you would replace this with your own database code
$user_id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $role = $_POST['role'];

  if(empty($name) || empty($email) || empty($role)) {
    $error = "Please fill in all fields.";
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Invalid email address.";
  } else {
    $sql = "UPDATE users SET username='$name', email='$email', role='$role'";
    if(!empty($password)) {
      $sql .= ", password='$password'";
    }
    $sql .= " WHERE id='$user_id'";
    if(mysqli_query($conn, $sql)) {
      header("Location: users-management.php");
      exit;
    } else {
      $error = "Error updating user: " . mysqli_error($conn);
    }
  }
}

?>

<h1>Edit User</h1>

<?php if(isset($error)): ?>
  <p><?php echo $error; ?></p>
<?php endif; ?>

<form method="post">
  <label>
    Name:
    <input type="text" name="name" value="<?php echo $user['username']; ?>" required>
  </label>
  <label>
    Email:
    <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
  </label>
  <label>
    Password:
    <input type="password" name="password">
    <span>Leave blank to keep the existing password.</span>
  </label>
  <label>
    Role:
    <select name="role" required>
      <option value="">Select Role</option>
      <option value="admin" <?php if($user['role'] === 'admin'): ?>selected<?php endif; ?>>Admin</option>
      <option value="salesman" <?php if($user['role'] === 'salesman'): ?>selected<?php endif; ?>>Salesman</option>
      <option value="customer" <?php if($user['role'] === 'customer'): ?>selected<?php endif; ?>>Customer</option>
    </select>
  </label>
  <button type="submit">Update User</button>
</form>


<?php

include 'footer.php';

?>