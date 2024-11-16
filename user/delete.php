<?php
include "../connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the record
    $sql = "DELETE FROM add_user WHERE id = ?";

    // Prepare statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $id);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to the tables page with success message
            header("Location: view.php?msg=Record deleted successfully");
            exit();
        } else {
            // Redirect to the tables page with error message
            header("Location: view.php?msg=Error deleting record");
            exit();
        }
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
