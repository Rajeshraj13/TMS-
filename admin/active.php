
<?php
session_start();
include '../connection.php';
$id = $_GET['id'];
$status = $_GET['status'];
$updateQuery = "UPDATE add_user SET status=$status WHERE id=$id";
mysqli_query($conn, $updateQuery);
header('');
exit; 

?>


