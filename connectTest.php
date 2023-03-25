
  <?php
  $servername = "conocidosrv07";
  $username = "shohannldbuser";
  $password = "q6N5ct76$";
  $dbname = "id00247_shohandb";
  $port = 3306;

  $conn = mysqli_connect($servername, $username, $password, $dbname, $port);

  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";
  echo "<br><br>";
/*
$Uname = $_POST['Username'];
$Email = $_POST['Email'];
$Pass = $_POST['Password'];
*/
$Uname = 'fad';
$Email = 'fsg';
$Pass = 'dfdf';

  $sql = "INSERT INTO reg (Username, Email, password) VALUES ('$Uname','$Email','$Pass')";



  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
