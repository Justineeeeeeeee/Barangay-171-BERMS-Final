<?php
session_start();
include("../connect.php");

if(isset($_POST['adminSignIn'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if($result->num_rows > 0){

$row = $result->fetch_assoc();

$_SESSION['admin_email'] = $row['email'];
$_SESSION['admin_name'] = $row['firstName'];

header("Location: admindashboard.php");
exit();

}else{

echo "Incorrect Admin Email or Password";

}

}
?>
