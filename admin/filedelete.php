<!-- <?php
// require_once "../connection.php";
// 
// if(isset($_GET['id']) && !empty($_GET['id'])) {<?php
include "../connection.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $fileId = $_GET['id']; // Get the file ID from the URL parameter

    // Prepare a SQL statement to delete the file from the database
    $sql = "DELETE FROM uploaded_files WHERE id = $fileId";

    // Execute the delete query
    if ($conn->query($sql) === TRUE) {
        // If deletion is successful, redirect back to the page with a success message
        header("Location: view.php?msg=File deleted successfully");
        exit(); // Terminate the script to ensure the redirect happens
    } else {
        // If there's an error during deletion, redirect back with an error message
        header("Location: view.php?msg=Error deleting file");
        exit();
    }
} else {
    // If no valid file ID is provided, redirect back with an error message
    header("Location: view.php?msg=Invalid file ID");
    exit();
}

$conn->close(); // Close the database connection
?>

    // $id = intval($_GET['id']);
// 
//    
    // $sql = "DELETE FROM add_user WHERE id = ?";
    // $stmt = $conn->prepare($sql);
    // $stmt->bind_param("i", $id);
    // $stmt->execute();
    // $stmt->close();
    // header("Location: view.php");
    // exit();
// }
// 
// header("Location: index.php"); // Redirect to homepage
// exit();
// ?>
