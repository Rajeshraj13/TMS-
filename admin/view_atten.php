<?php
include "../connection.php";

$names = [];
$sql = "SELECT name FROM `reg-information`";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $names[] = $row['name'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
</head>

<style>
    .form-check-label {
        margin-right: 15px;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .table th {
        text-align: center;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .btn-primary {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .btn-primary:hover {
        background-color: #2e59d9;
        border-color: #2653d4;
    }

    .breadcrumb>li+li:before {
        content: "" !important;
    }

    .breadcrumb {
        padding: 25px;
        font-size: 14px;
        color: #aaa !important;
        letter-spacing: 2px;
        border-radius: 5px !important;
    }


    .first-1 {
        background-color: white !important;
    }


    a {
        text-decoration: none !important;
        color: #aaa !important;
    }

    a:focus,
    a:active {
        outline: none !important;
        box-shadow: none !important;
    }

    img {
        vertical-align: bottom;
        opacity: 0.3;
    }

    .first span {
        color: black;
    }

    .active-1,
    .active-2 {
        font-size: 13px !important;
        padding-bottom: 12px !important;
        padding-top: 12px !important;
        padding-right: 25px !important;
        padding-left: 25px !important;
        border-radius: 200px !important;
        background-color: #F3E5F5 !important;
    }

    #home {
        vertical-align: middle !important;
    }

    @media (max-width: 567px) {
        .breadcrumb {
            font-size: 10px;
        }

        .breadcrumb-item+.breadcrumb-item {
            padding-left: 0;
        }

        img {
            width: 11px;
            height: 11px;
            vertical-align: middle;
        }

        #home {
            vertical-align: middle !important;
            width: 12px;
            height: 10px;
        }

        .active-1,
        .active-2 {
            font-size: 8px !important;
            padding-right: 8px !important;
            padding-left: 8px !important;
            background-color: F3E5F !important;
            width: 100% !important;
        }

        .breadcrumb {
            letter-spacing: 0px !important;
            padding: 26px;
            padding-left: 6px !important;
            padding-right: 6px !important;
        }

        .breadcrumb>* div {
            max-width: 60px;
        }

        li.breadcrumb-item {
            padding: 0 !important;
        }

    }

</style>

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">


            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_task.php">Add Task</a>
                        <a class="collapse-item" href="view.php">View</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <form class="form-inline">
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                    </form>

                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">


                            <?php
                                include "../connection.php";
                                if (isset($_SESSION['Email'])) {
                                $Email = $_SESSION['Email'];
                                
                                $sql = "SELECT Name FROM admin_registration WHERE Email = ?";
                                $stmt = mysqli_prepare($conn, $sql);
                                
                                if ($stmt) {
                                mysqli_stmt_bind_param($stmt, "s", $Email);
                                
                                // Execute the query
                                mysqli_stmt_execute($stmt);
                                
                                // Get the result
                                $result = mysqli_stmt_get_result($stmt);
                                
                                // Fetch the associative array
                                if ($row = mysqli_fetch_assoc($result)) {
                                $Name    = $row['Name'];
                                } else {
                                $Name    = 'Guest';
                                }
                                mysqli_stmt_close($stmt);
                                } else {
                                $Name = 'Guest';
                                echo "Database query failed: " . mysqli_error($conn);
                                }
                                } else {
                                $Name = 'Guest';
                                } 
                            ?>

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo htmlspecialchars($Name); ?>
                                </span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="../index1.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container d-flex justify-content-center">
                    <nav aria-label="breadcrumb " class="first  d-md-flex">
                        <ol class="breadcrumb indigo lighten-6 first-1 shadow-lg mb-5  ">
                            <li class="breadcrumb-item "><a class="black-text active-2" href="atten.php"><img id="home"
                                        src="https://img.icons8.com/ios-filled/50/000000/dog-house.png"
                                        class="mr-md-2 mr-1 mb-1 " width="22" height="19"><span>Take
                                        Attendance</span></a><img class="ml-md-3 ml-1"
                                    src="https://img.icons8.com/metro/50/000000/chevron-right.png " width="20"
                                    height="20"> </li>
                            <li class="breadcrumb-item "><a class="black-text active-2" href=""><span>Current</span></a>
                        </ol>
                    </nav>
                </div>

                <div id="wrapper">
                    <div id="content-wrapper" class="d-flex flex-column">
                        <div id="content">
                            <div class="container mt-5">
                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h4>Employee Attendance Of Month: <u>
                                            <?php echo strtoupper(date("F")); ?>
                                        </u></h4>
                                </div>
                                <form method="post">
                                    <div class="form-group row mb-3">
                                        <div class="form-group col-xl-6">
                                            <label for="name">Name</label>
                                            <select class="form-control" id="name" name="name" required>
                                                <option value="">Select a name</option>

                                                <?php
                                                    include "../connection.php";
                                                    $names = [];
                                                    $nameQuery = "SELECT DISTINCT name FROM `reg-information`";
                                                    $nameResult = mysqli_query($conn, $nameQuery);
                                                    while ($row = mysqli_fetch_assoc($nameResult)) {
                                                    $names[] = $row['name'];
                                                    }
                                                    foreach ($names as $name) : 
                                                ?>

                                                <option value="<?php echo htmlspecialchars($name); ?>">
                                                    <?php echo htmlspecialchars($name); ?>
                                                </option>

                                                <?php endforeach; ?>
                                            </select>

                                        </div>
                                        <div class="col-xl-6 text-left">
                                            <label class="form-control-label">Type<span
                                                    class="text-danger ml-2">*</span></label>
                                            <select required name="type" onchange="typeDropDown(this.value)"
                                                class="form-control mb-3">
                                                <option value="">--Select--</option>
                                                <option value="1">All</option>
                                                <option value="2">By Single Date</option>
                                                <option value="3">By Date Range</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div id="dateInputs"></div>
                                    <div class="form-group row mb-3">
                                        <div class="col text-right">
                                            <button type="submit" name="view" class="btn btn-primary">View
                                                Attendance</button>
                                        </div>
                                    </div>
                                </form>

                                <?php
                                    $displayTable = false;
                                    $condition = "WHERE 1=1";
                                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
                                    $name = $_POST['name'];
                                    $type = $_POST['type'];

                                    if (!empty($name)) {
                                    $condition .= " AND e.name LIKE '%$name%'";
                                    $displayTable = true;
                                    }

                                    if ($type == "2" && isset($_POST['single_date'])) {
                                    $single_date = $_POST['single_date'];
                                    $condition .= " AND a.attendance_date = '$single_date'";
                                    } elseif ($type == "3" && isset($_POST['start_date']) && isset($_POST['end_date'])) {
                                    $start_date = $_POST['start_date'];
                                    $end_date = $_POST['end_date'];
                                    $condition .= " AND a.attendance_date BETWEEN '$start_date' AND '$end_date'";
                                    }
                                    }

                                    if ($displayTable) {
                                    echo '<div class="text-center mb-3">
                                    <button class="btn btn-outline-success" onclick="printTable()">Print Table</button>
                                    <button class="btn btn-outline-success" onclick="exportToExcel()">Export to Excel</button>
                                    </div>';

                                    echo '<div class="card shadow mb-4">
                                    <div class="card-body">
                                    <div class="table-responsive">
                                    <div class="table-scroll">
                                    <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>';

                                    //$sql = "SELECT a.emp_id, e.name, a.attendance_date, a.status 
                                    //FROM attendance a 
                                   // JOIN `reg-information` e ON a.emp_id = e.emp_id 
                                   // $condition";

                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['attendance_date'] . "</td>";
                                    echo "<td>" . $row['status'] . "</td>";
                                    echo "<td class='text-center'>
                                    <form method='POST' action='delete_attendance.php' onsubmit='return confirm(\"Are you sure you want to delete this record?\")'>
                                    <input type='hidden' name='emp_id' value='" . $row['emp_id'] . "'>
                                    <input type='hidden' name='attendance_date' value='" . $row['attendance_date'] . "'>
                                    <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                    </form>
                                    </td>";
                                    echo "</tr>";
                                    }
                                    } else {
                                    echo "<tr><td colspan='4' class='text-center'>No records found</td></tr>";
                                    }

                                    echo '</tbody></table></div></div></div></div>';
                                    }

                                    $conn->close();
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container">
                    <h2 class="h3 mt-4 mb-2 text-gray-800">Monthly Attendance Sheet</h2>
                    <div class="card shadow mt-5 mb-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="table-scroll">
                                        <table class="table table-bordered" width="100%" cellspacing="0">

                                            <?php 
                                                include "../connection.php";
                                                $totalDaysInMonth = date('t'); 
                                                $firstDayOfMonth = date('Y-m-01');
                                                echo "<thead>";
                                                echo "<tr>";
                                                echo "<th rowspan='2'>Names</th>";
                                                for($j = 1; $j <= $totalDaysInMonth; $j++) {
                                                echo "<th>$j</th>";
                                                }
                                                echo "<th rowspan='2'>Reset</th>";
                                                echo "</tr>";
                                                echo "<tr>";
                                                for($j = 0; $j < $totalDaysInMonth; $j++) {
                                                echo "<th>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</th>";
                                                }
                                                echo "</tr>";
                                                echo "</thead>";
                                                echo "<tbody>";
                                                $condition = "WHERE 1=1";
                                                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['view'])) {
                                                $name = $_POST['name'];
                                                $type = $_POST['type'];
                                                if (!empty($name)) {
                                                $condition .= " AND e.name LIKE '%$name%'";
                                                }
                                                if ($type == "2" && isset($_POST['single_date'])) {
                                                $single_date = $_POST['single_date'];
                                                $condition .= " AND a.attendance_date = '$single_date'";
                                                } elseif ($type == "3" && isset($_POST['start_date']) && isset($_POST['end_date'])) {
                                                $start_date = $_POST['start_date'];
                                                $end_date = $_POST['end_date'];
                                                $condition .= " AND a.attendance_date BETWEEN '$start_date' AND '$end_date'";
                                                }
                                                }
                                                $sql = "SELECT emp_id, name FROM `reg-information`";
                                                $employeesResult = $conn->query($sql);
                                                if ($employeesResult->num_rows > 0) {
                                                while($employee = $employeesResult->fetch_assoc()) {
                                                echo "<tr>";
                                                echo "<td>" . $employee['name'] . "</td>";
                                                
                                                for($j = 1; $j <= $totalDaysInMonth; $j++) {
                                                $dateOfAttendance = date("Y-m-$j");
                                                $fetchingAttendance = mysqli_query($conn, "SELECT id, status FROM attendance WHERE emp_id = '". $employee['emp_id'] ."' AND attendance_date = '". $dateOfAttendance ."'");
                                                $isAttendanceAdded = mysqli_num_rows($fetchingAttendance);
                                                if($isAttendanceAdded > 0) {
                                                $attendanceData = mysqli_fetch_assoc($fetchingAttendance);
                                                $color = "";
                                                if($attendanceData['status'] == "Present") {
                                                $color = "green";
                                                } elseif($attendanceData['status'] == "Absent") {
                                                $color = "red";
                                                } elseif($attendanceData['status'] == "Leave") {
                                                $color = "brown";
                                                }
                                                echo "<td style='background-color: $color; color:white'>" . $attendanceData['status'] . "</td>";
                                                } else {
                                                echo "<td></td>";
                                                }
                                                }

                                                // Add the reset button
                                                echo "<td>
                                                <form method='POST' action='view_atten.php'>
                                                <input type='hidden' name='emp_id' value='" . $employee['emp_id'] . "' />
                                                <button type='submit' name='reset' class='btn btn-warning btn-sm'>Reset</button>
                                                </form>
                                                </td>";
                                                echo "</tr>";
                                                }
                                                } else {
                                                echo "<tr><td colspan='" . ($totalDaysInMonth + 2) . "' class='text-center'>No records found</td></tr>"; // Adjusted colspan
                                                }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                    include "../connection.php";

                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset'])) {
                    $emp_id = $_POST['emp_id'];
                    
                    // Reset the attendance records for the employee for the current month
                    $currentMonth = date('Y-m');
                    $sql = "UPDATE attendance SET status = NULL WHERE emp_id = ? AND attendance_date LIKE '$currentMonth%'";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $emp_id);
                    
                    if ($stmt->execute()) {
                    echo "Records reset successfully";
                    } else {
                    echo "Error resetting records: " . $conn->error;
                    }

                    $stmt->close();
                    $conn->close();

                    // Redirect back to the attendance overview page
                    exit();
                    }
                ?>



                <div class="modal fade" id="addadmin" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addUserModalLabel">Add New Admin</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="addUserForm1" method="post" action="">

                                    <div class="form-group">
                                        <label for="username">Name</label>
                                        <input type="username" class="form-control" id="username" name="Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="email" class="form-control" id="Email" name="Email" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="Password"
                                            required>
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Phone</label>
                                        <input type="text" class="form-control" id="Phone" name="Phone" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Add Admin</button>
                                </form>
                            </div>
                        </div>
                    </div>


                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
                    <script src="js/sb-admin-2.min.js"></script>
                    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
                    <script src="js/demo/datatables-demo.js"></script>
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>


                    <script>
                        $(document).ready(function () {
                            $('#example').DataTable();
                        });
                        // Function to print the table using printJS (optional)

                        function printTable() {
                            const table = $('#example').DataTable();
                            const columnsToPrint = ['Emp_id', 'Name', 'Date', 'Status'];

                            // Get data as an array of objects
                            const data = table.rows().data().toArray();

                            // Prepare HTML content for printing
                            let htmlContent = '<h3 style="text-align:center;">Attendance Report</h3>';
                            htmlContent += '<table style="width:100%; border-collapse: collapse; border: 1px solid #ddd; text-align: center;">';

                            // Add table headers
                            htmlContent += '<thead><tr>';
                            columnsToPrint.forEach(col => {
                                htmlContent += `<th style="border: 1px solid #ddd; padding: 8px;">${col}</th>`;
                            });
                            htmlContent += '</tr></thead>';

                            // Add table body with filtered data
                            htmlContent += '<tbody>';
                            data.forEach(row => {
                                htmlContent += '<tr>';
                                columnsToPrint.forEach(col => {
                                    htmlContent += `<td style="border: 1px solid #ddd; padding: 8px;">${row[col]}</td>`;
                                });
                                htmlContent += '</tr>';
                            });
                            htmlContent += '</tbody></table>';

                            // Print using printJS
                            printJS({
                                printable: htmlContent,
                                type: 'html',
                                documentTitle: 'Attendance Report'
                            });
                        }


                        function printTable() {

                            var rows = document.querySelectorAll('#example tbody tr');

                            // Create an array to store the data rows
                            var data = [];

                            rows.forEach(function (row) {
                                var rowData = [];

                                rowData.push(row.cells[0].textContent);
                                rowData.push(row.cells[1].textContent);
                                rowData.push(row.cells[2].textContent);

                                data.push(rowData);
                            });

                            // Print the selected data using printJS
                            printJS({
                                printable: data,
                                type: 'json',  // PrintJS supports JSON input for custom data arrays
                                header: '<h3 style="text-align:center;">Attendance Report</h3>',
                                gridStyle: 'border: 1px solid #ddd; padding: 10px; text-align: center;',
                                style: 'table { width: 100%; border-collapse: collapse; } th, td { border: 1px solid #ddd; padding: 8px; }',
                                documentTitle: 'Attendance Report',
                                properties: ['name', 'date', 'status']  // Specify the column names in the properties array
                            });
                        }


                        function exportToExcel() {
                            const table = $('#example').DataTable();
                            const data = table.rows().data().toArray();
                            const header = ['Name', 'Date', 'Status'];

                            // Map data to include only specified columns
                            const filteredData = data.map(row => {
                                return [
                                    row[0],
                                    row[1],
                                    row[2],

                                ];
                            });

                            // Create a new workbook
                            const wb = XLSX.utils.book_new();
                            // Convert filtered data to worksheet
                            const ws = XLSX.utils.aoa_to_sheet([header, ...filteredData]);
                            // Append worksheet to workbook
                            XLSX.utils.book_append_sheet(wb, ws, 'Attendance Report');
                            // Save workbook as Excel file
                            XLSX.writeFile(wb, 'attendance_report.xlsx');
                        }

                    </script>



                    <script>
                        function typeDropDown(value) {
                            var dateInputs = document.getElementById('dateInputs');
                            dateInputs.innerHTML = '';

                            if (value == '2') {
                                dateInputs.innerHTML = `
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                            <label for="single_date">Date</label>
                            <input type="date" class="form-control" id="single_date" name="single_date" required>
                        </div>
                    </div>
                `;
                            } else if (value == '3') {
                                dateInputs.innerHTML = `
                    <div class="form-group row mb-3">
                        <div class="col-xl-6">
                            <label for="start_date">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-xl-6">
                            <label for="end_date">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>`;
                            }
                        }
                    </script>
</body>

</html>