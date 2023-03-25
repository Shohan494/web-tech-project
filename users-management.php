<?php

session_start();

include 'connect.php';

// check if user is authorized to access this page (e.g. check user role)
if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}


$user_email = $_SESSION['logged_in_user']['username'];

// if role admin
// customer, salesman crud

$user_role = $_SESSION['logged_in_user']['role'];

// retrieve user data from database
// you would replace this with your own database code

$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
$users = array();
if(mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }
}
?>

    <?php
    include 'menu.php';
    ?>

<h1>Users Management</h1>

<a href="add-user-form.php">Add User</a>

<br>

<table border="1">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Role</th>
      <th>Edit User
      </th>
      <th>Delete User</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $user): ?>
      <tr>
        <td><?php echo $user['id']; ?></td>
        <td><?php echo $user['username']; ?></td>
        <td><?php echo $user['email']; ?></td>
        <td><?php echo $user['role']; ?></td>
        <td>
          <button><a href="edit-user.php?id=<?php echo $user['id']; ?>">Edit</a></button>
        </td>
        <td>
        <button><a href="delete-user.php?id=<?php echo $user['id']; ?>">Delete</a></button>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>


<?php

include 'footer.php';

?>