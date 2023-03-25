<?php

session_start();

include 'connect.php';

include 'header.php';

?>

<body>
<center><h2>Fuel Ditribution - Forgot Password</h2></center>

<?php if(isset($_SESSION['messages'])): ?>
  <?php foreach($_SESSION['messages'] as $message): ?>
    <center><p><?php echo $message; ?></p></center>
  <?php endforeach; ?>
  <?php unset($_SESSION['messages']); ?>
<?php endif; ?>

	<div align="center">

		<form method="post" action="forgot-password.php">
			<table>
				<tr>
					<td>
						<fieldset>
							<legend><b>Forgot Password Form:</b></legend>
							<table>
								<tr>
									<th>
										<label for="email">Email</label>
									</th>
									<td>:</td>
									<td>
										<input type="email" name="email" id="email">
									</td>
								</tr>

								<tr>
									<th></th>
									<td></td>
									<td align="right">
										<input type="submit" value="Submit">
									</td>
								</tr>
							</table>
						</fieldset>
					</td>
				</tr>
			</table>
		</form>

		<p>For Registration as Customer, Click <a href="registration.php">here</a>.</p>
		<p>Already have account, Login <a href="login.php">here</a>.</p>

		<?php

		if ($_SERVER['REQUEST_METHOD'] == "POST") {

			$email = sanitize($_POST['email']);

			if (empty($email)) {
				echo "Please fill up the email properly";
				echo "<br>";
			}
			else{

				$sql = "SELECT * FROM users WHERE email='$email'";

				$result = mysqli_query($conn, $sql);
	
				if (mysqli_num_rows($result) > 0) {
                    echo "Email does exist! An Email has been sent to your account for password reset link.";

                    $token = bin2hex(random_bytes(32));

                    $sql = "UPDATE users SET token='$token' WHERE email='$email'";

                    $result = mysqli_query($conn, $sql);

                    // do a query and sent an email with token generating a link

                    // will be created a token and then sent to email

                    // check your email

                    echo "<br>";  
				} else {
                    echo "Email doesn't exist!";
                    echo "<br>";                    
				}
			}
		}

		function sanitize($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		?>
	</div>


<?php

include 'footer.php';

?>