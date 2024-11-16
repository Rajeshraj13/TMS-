<?php
include "../connection.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) { 
    $emp_id = $_GET['id']; 

    $sql = "DELETE FROM `reg-information` WHERE `emp_id` = $emp_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: manage_admin.php?msg=Record deleted successfully");
    } else {
        header("Location: manage_admin.php?msg=Error deleting record");
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "Invalid emp_id";
}

$conn->close();
?>
