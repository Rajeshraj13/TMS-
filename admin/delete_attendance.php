<?php
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id = $_POST['emp_id'];
    $attendance_date = $_POST['attendance_date'];

    $sql = "DELETE FROM attendance WHERE emp_id = ? AND attendance_date = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $emp_id, $attendance_date);

    if ($stmt->execute()) 
        header("Location: view_atten.php?message=Record+deleted+successfully&alert=success"); // Redirect with success message
        exit();
    } else {
        header("Location: view_atten.php?message=Error+deleting+record&alert=danger"); // Redirect with error message
        exit();
    }

    $stmt->close();
    $conn->close();

?>
