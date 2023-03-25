<?php

session_start();

include 'connect.php';

include 'header.php';

if (isset($_GET['token'])) {

  $passwordResetToken = $_REQUEST['token'];
  $sql = "SELECT * FROM users WHERE token='$passwordResetToken'";
  $result = mysqli_query($conn, $sql);

  $_SESSION['logged_in_user'] = mysqli_fetch_assoc($result);
  $userEmail = $_SESSION['logged_in_user']['email'];

}
?>

<body>
  <center>
    <h2>Fuel Ditribution Password Reset</h2>
  </center>


  <?php if (isset($_GET['token']) && mysqli_num_rows($result) > 0) : ?>

    <div align="center">
      <!-- registration form -->
      <form method="post" action="change-password.php?token=<?= $passwordResetToken ?>">
        <table>
          <tr>
            <td>
              <fieldset>
                <legend><b>Reset Password:</b></legend>
                <table>
                  <tr>
                    <td><label for="new_password">New Password:</label></td>
                    <td><input type="password" id="new_password" name="new_password"></td>
                  </tr>
                  <tr>
                    <td><label for="confirm_password">Confirm Password:</label></td>
                    <td><input type="password" id="confirm_password" name="confirm_password"></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td><input type="submit" name="submit" value="Submit"></td>
                  </tr>
                </table>
              </fieldset>


              <!-- display errors (if any) -->
              <?php if (isset($_SESSION['errors'])) : ?>
                <?php foreach ($_SESSION['errors'] as $error) : ?>
                  <p><?php echo $error; ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
              <?php endif; ?>


            </td>
          </tr>
        </table>
      </form>
    </div>

  <?php endif; ?>



  <?php

  if (isset($_POST['submit'])) {

    $password = $_REQUEST['new_password'];
    $confirm_password = $_REQUEST['confirm_password'];

    
    $errors = array();

    if (empty($password)) {
      $errors[] = "Password is required.";
    }
    if (strlen($password) < 6) {
      $errors[] = "Password must be at least 6 characters long.";
    }
    if ($password !== $confirm_password) {
      $errors[] = "Password and confirm password must match.";
    }


    if (empty($errors)) {

      echo "submitted, no error";

      $stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
      $stmt->bind_param("ss", $passworddata, $emaildata);

      $emaildata = $userEmail;
      $passworddata = $password;



      if ($stmt->execute()) {

        $messages[] = "Password Updated! You can now Login";
        $_SESSION['messages'] = $messages;
        header("Location: login.php");
        exit;
      }
      else
      {
        echo "not executed";
      }
    }


    $_SESSION['errors'] = $errors;
    header("Location: change-password.php?token=$passwordResetToken");


  }

  ?>

  <?php


  include 'footer.php';

  ?>