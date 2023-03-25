<?php

session_start(); // start session to store error messages

$current_password = $_SESSION['logged_in_user']['password'];
$current_user_id = $_SESSION['logged_in_user']['id'];


// check if form is submitted
if(isset($_POST['change_password'])) {

  // get form inputs
  $old_password = $_POST['old_password'];
  $new_password = $_POST['new_password'];
  $confirm_password = $_POST['confirm_password'];

  // basic password validation
  $errors = array();
  if(empty($old_password)) {
    $errors[] = "Old password is required.";
  }
  if(empty($new_password)) {
    $errors[] = "New password is required.";
  }
  if(strlen($new_password) < 8) {
    $errors[] = "New password must be at least 8 characters long.";
  }
  if($new_password !== $confirm_password) {
    $errors[] = "New password and confirm password must match.";
  }

  // if there are no errors
  if(empty($errors)) {
    if($old_password !== $current_password) {
      $errors[] = "Old password is incorrect.";
    } else {
    

    $sql = "UPDATE users SET password='$new_password' WHERE id='$current_user_id'";
    if(mysqli_query($conn, $sql)) {
        header("Location: users-management.php");
        exit;
    } else {
        $error = "Error updating user: " . mysqli_error($conn);
    }        

        
      $_SESSION['message'] = "Password changed successfully.";
      header("Location: dashboard.php");
      exit;
    }
  }

  $_SESSION['errors'] = $errors;

  header("Location: dashboard.php");
  exit;
}

?>

<?php if(isset($_SESSION['errors'])): ?>
  <?php foreach($_SESSION['errors'] as $error): ?>
    <p><?php echo $error; ?></p>
  <?php endforeach; ?>
  <?php unset($_SESSION['errors']); ?>
<?php endif; ?>