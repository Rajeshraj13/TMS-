<!-- <?php
// session_start();
// include "../connection.php";
// 
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $attendance_data = $_POST['status'];
    // $attendance_date = date('Y-m-d');
// 
    // foreach ($attendance_data as $emp_id => $status) {
        // $sql = "INSERT INTO attendance (emp_id, attendance_date, status) VALUES (?, ?, ?)";
        // if ($stmt = $conn->prepare($sql)) {
            // $stmt->bind_param("iss", $emp_id, $attendance_date, $status);
            // $stmt->execute();
            // $stmt->close();
        // } else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
        // }
    // }
// 
   // header("Location: atten.php?msg=Attendance recorded successfully");
    //exit();
// 
        // header("Location: atten.php?alert=success&message=Attendance%20has%20been%20successfully%20recorded.");
        // exit();
// 
        // }
// 
// $conn->close();
// ?>
 -->

<?php
include "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendance_date = $_POST['attendance_date'];

    // Check if attendance already exists for the selected date
    $check_sql = "SELECT COUNT(*) as count FROM attendance WHERE attendance_date = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $attendance_date);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row['count'] > 0) {
        
        $message = "Attendance for $attendance_date has already been taken.";
        $alert = "danger";
        header("Location: atten.php?message=" .htmlspecialchars($message) . "&alert=$alert");
        exit();
    }

    // Insert attendance for each employee
    foreach ($_POST['status'] as $emp_id => $status) {
        $insert_sql = "INSERT INTO attendance (emp_id, attendance_date, status) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("iss", $emp_id, $attendance_date, $status);
        $stmt->execute();
        $stmt->close();
    }

    // Redirect with success message
    $message = "Attendance for $attendance_date has been successfully recorded.";
    $alert = "success";
    header("Location: atten.php?alert=success&message=Attendance%20has%20been%20successfully%20recorded.");
    exit();
}
?>
