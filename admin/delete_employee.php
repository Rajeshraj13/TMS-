<?php
include "../connection.php";

// Validate input
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $emp_id = $_GET['id'];

    // Prepare the SQL statement
    $sql = "DELETE FROM `reg-information` WHERE `emp_id` = ?";

    // Prepare statement and bind parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $emp_id);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Redirect with success message
            header("Location: manage_admin.php?msg=Record deleted successfully&status=success");
            exit();
        } else {
            // Redirect with message: Record not found
            header("Location: manage_admin.php?msg=Record not found for deletion&status=error");
            exit();
        }
    } else {
        // Redirect with MySQL error message
        header("Location: manage_admin.php?msg=Error deleting record: " . $conn->error . "&status=error");
        exit();
    }
} else {
    // Invalid input
    echo "Invalid emp_id";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

