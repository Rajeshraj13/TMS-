<?php
include "../connection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM add_user WHERE id = ?";

//prepare the sql query for exeution by 
//creating a prepared statement object ($stmt) using the prepare() method of the database connection
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            header("Location: tables.php?msg=Record deleted successfully");
            exit();
        } else {
            header("Location: tables.php?msg=Error deleting record");
            exit();
        }
    }

    $stmt->close();
}

$conn->close();
?>