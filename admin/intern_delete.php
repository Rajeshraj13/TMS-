<?php
include "../connection.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $intern_id = $_GET['id'];

    $sql = "DELETE FROM `intern` WHERE `intern_id` = $intern_id";

    if ($conn->query($sql) === TRUE) {
        header("Location: intern_info.php?msg=Record deleted successfully&status=success");
    } else {
        header("Location: intern_info.php?msg=Error deleting record&status=error");
    }
    exit();
} else {
    echo "Invalid intern ID";
}

$conn->close();
?>
