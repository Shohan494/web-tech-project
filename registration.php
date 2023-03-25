<?php

session_start(); // start session to store error messages

include 'connect.php';

include 'header.php';


// check if form is submitted
if (isset($_POST['submit'])) {

  // get form inputs
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // basic form validation
  $errors = array();
  $messages = array();

  if (empty($username)) {
    $errors[] = "Username is required.";
  }
  if (empty($email)) {
    $errors[] = "Email is required.";
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email is invalid.";
  }
  if (empty($password)) {
    $errors[] = "Password is required.";
  }
  if (strlen($password) < 6) {
    $errors[] = "Password must be at least 6 characters long.";
  }
  if ($password !== $confirm_password) {
    $errors[] = "Password and confirm password must match.";
  }

  // if there are no errors
  if (empty($errors)) {

    $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $usernamedata, $emaildata, $passworddata, $roledata);

    // set parameters and execute
    $usernamedata = $username;
    $emaildata = $email;
    $passworddata = $password;
    $roledata = "customer";


    if ($stmt->execute()) {

      $messages[] = "Registration Suceess! You can now Login";

      $_SESSION['messages'] = $messages;

      header("Location: login.php");
      exit;
    } else {
      $errors[] = "Error adding user: " . mysqli_error($conn);
    }
  }

  // store errors in session
  $_SESSION['errors'] = $errors;

  // redirect back to form
  header("Location: registration.php");
  exit;
}

?>

<!-- display errors (if any) -->
<?php if (isset($_SESSION['errors'])) : ?>
  <?php foreach ($_SESSION['errors'] as $error) : ?>
    <p><?php echo $error; ?></p>
  <?php endforeach; ?>
  <?php unset($_SESSION['errors']); ?>
<?php endif; ?>


<body>
  <center>
    <h2>Fuel Ditribution Customer Registration</h2>
  </center>


  <div align="center">
    <!-- registration form -->
    <form method="POST" action="registration.php">
      <table>
        <tr>
          <td>
            <fieldset>
              <legend><b>Registration:</b></legend>
              <table>
                <tr>
                  <td><label for="username">Username:</label></td>
                  <td><input type="text" id="username" name="username"></td>
                </tr>
                <tr>
                  <td><label for="email">Email:</label></td>
                  <td><input type="email" id="email" name="email"></td>
                </tr>
                <tr>
                  <td><label for="password">Password:</label></td>
                  <td><input type="password" id="password" name="password"></td>
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
          </td>
        </tr>
      </table>
    </form>


  </div>

  <?php

  include 'footer.php';

  ?>