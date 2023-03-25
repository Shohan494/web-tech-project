<?php

session_start();

include 'connect.php';

if($_SESSION['logged_in_user']['role'] !== 'admin') {
  header("Location: unauthorized.php");
  exit;
}

$user_id = $_SESSION['logged_in_user']['id'];


if(isset($_POST['update_profile'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];



    $sql = "UPDATE users SET email='$email', username='$username' WHERE id='$user_id'";

    if(mysqli_query($conn, $sql)) {
        header("Location: users-management.php");
        exit;
      } else {
        $error = "Error updating user: " . mysqli_error($conn);
      }



}
