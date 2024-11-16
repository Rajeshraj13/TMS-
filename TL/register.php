<!-- 


<?php
session_start();
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Phone = $_POST['Phone'];

    
    if (empty($Name) || empty($Email) || empty($Password) || empty($Phone)) {
        echo "<script type='text/javascript'> alert('All fields are required');</script>";
    } else {
       
        $stmt = $conn->prepare("INSERT INTO admin_registration (Name, Email, Password, Phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $Email, $Password, $Phone);

       
        if ($stmt->execute()) {
            // echo "<script type='text/javascript'> alert('Information stored successfully');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
