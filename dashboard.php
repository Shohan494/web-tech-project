<?php

session_start();

include 'connect.php';

$user_email = $_SESSION['logged_in_user']['username'];

// if role admin
// customer, salesman crud

$user_role = $_SESSION['logged_in_user']['role'];

$sql = "SELECT * FROM users WHERE username='$user_email'";

$result = mysqli_query($conn, $sql);

$user_details = (mysqli_fetch_assoc($result));

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<ul>
  <li><a href="dashboard.php">Dashboard</a></li>
  
  <?php if($user_role == 'admin'): ?>
    <li><a href="users-management.php">Users Management</a></li>
    <li><a href="products-management.php">Products Management</a></li>

    <?php elseif($user_role == 'customer'): ?>

  <a href='previous_transactions.php'>See previous transactions and order details</a><br>
  <a href='current_order_status.php'>View the status of your current order</a><br>
  <a href='contact_sales_team.php'>Contact the sales team with questions or concerns</a><br>
  <a href='update_payment_method.php'>Update your payment method and other information</a><br>
  <a href='transaction_statistics.php'>View your transaction statistics</a><br>
  <a href='new_order_request.php'>Request a new order</a><br>

  <?php endif; ?>
  
  <li><a href="logout.php">Logout</a></li>
</ul>

<fieldset>
    <legend>Profile Update:</legend>
<form method="post" action="profile-update.php">

          <div class="form-group">
          <div class="row"> 
            <div class="col-3">
                <label>Email</label>
            </div>
             <div class="col">
                <input type="text" name="email" value="<?php echo $user_details['email'];?>" class="form-control">
            </div>
          </div>
      </div>
      <div class="form-group">
 <div class="row"> 
            <div class="col-3">
                <label>Username</label>
            </div>
             <div class="col">
                <input type="text" name="username" value="<?php echo $user_details['username'];?>" class="form-control">
            </div>
          </div>
      </div>
           <div class="row">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <br>
<button  class="btn btn-success" name="update_profile">Save Profile</button>
            </div>
           </div>
       </form>  
</fieldset>

<br>

<fieldset>
    <legend>Password Change:</legend>

<!-- display errors (if any) -->
<?php if(isset($_SESSION['message'])): ?>
  <p><?php echo $_SESSION['message']; ?></p>
  <?php unset($_SESSION['message']); ?>
<?php endif; ?>
    

<form method="POST" action="password_change.php">
  <label for="old_password">Old Password:</label>
  <input type="password" id="old_password" name="old_password" required><br>

  <label for="new_password">New Password:</label>
  <input type="password" id="new_password" name="new_password" required><br>

  <label for="confirm_password">Confirm Password:</label>
  <input type="password" id="confirm_password" name="confirm_password" required><br>

  <br>

  <input type="submit" name="change_password" value="Change Password">
</form>

</fieldset>







<?php

include 'footer.php';

?>