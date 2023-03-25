
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

