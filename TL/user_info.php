<!-- 

<?php
session_start();
include "../connection.php"; // Ensure the correct path to your connection file
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $emp_id = $_POST["emp_id"];
   $name = $_POST["name"];
   $email = $_POST["email"];
   $contact = $_POST["phone"];
   $address = $_POST["address"];
   $role = $_POST["role"];
    $blood_group = $_POST["blood_group"];
   $experience = $_POST["experience"]; // Corrected variable name
   $dob = $_POST["dob"];

   $sql = "INSERT INTO `reg-information1` (emp_id, name, email, phone, address, role, `blood-group`, experience, dob) 
           VALUES ('$emp_id', '$name', '$email', '$contact', '$address', '$role', '$blood_group', '$experience', '$dob')";
   if ($conn->query($sql) === TRUE) {
       echo "New record inserted successfully";
   } else {
       echo "Error: " . $sql . "<br>" . $conn->error;
   }
}
?>



