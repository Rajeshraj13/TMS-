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

    <title>TL Dashboard</title>
    <script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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

    .table-scroll {
        max-height: 450px;
        overflow-y: auto;
    }
</style>

</head>

<body id="page-top">

    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_tl.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index_tl.php">
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

                        <li class="nav-item dropdown no-arrow">
                            <!-- Dropdown - User Information -->
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                </span>
                                <img class="img-profile rounded-circle" src="images/images.jpeg">
                            </a>


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


                <div id="attendance-sheet" data-spy="scroll" data-target="#navbar-example" data-offset="100">
                    <div class="container">
                        <!-- <h2 class="h3 mt-4 mb-2 text-gray-800">Monthly Attendance Sheet</h2> -->
                        <!-- <button onclick="exportToExcel()" class="btn btn-success mt-3">Export to Excel</button> -->
                        <div class="d-flex justify-content-between align-items-center m-3">
                            <h1 class="h3 mb-0 text-dark">Monthly Attendance Sheet</h1>
                            <button onclick="exportToExcel()" class="btn btn-success mt-3">Export to Excel</button>
                        </div>


                        <div class="card shadow mt-5 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div class="table-scroll">
                                            <table class="table table-bordered" id="attendanceTable" width="100%"
                                                cellspacing="0">

                                                <h4 class="mb-5">Attendance Month: <u>
                                                        <?php echo strtoupper(date("F")); ?>
                                                    </u></h4>

                                                <?php 

                                                      include "../connection.php";
                                                      $totalDaysInMonth = date('t');
                                                      $firstDayOfMonth = date('Y-m-01');
                                                      
                                                      // Fetch employees
                                                      $sql = "SELECT emp_id, name FROM `reg-information`";
                                                      $employeesResult = $conn->query($sql);
                                                      
                                                      if ($employeesResult->num_rows > 0) {
                                                          // Start table header
                                                          echo "<thead><tr><th rowspan='2'>Names</th>";
                                                          for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                                                              echo "<th>$j</th>";
                                                          }
                                                          echo "<th rowspan='2'>Reset</th></tr><tr>";
                                                          for ($j = 0; $j < $totalDaysInMonth; $j++) {
                                                              echo "<th>" . date("D", strtotime("+$j days", strtotime($firstDayOfMonth))) . "</th>";
                                                          }
                                                          echo "</tr></thead><tbody>";
                                                      
                                                          // Attendance data retrieval and display
                                                          while ($employee = $employeesResult->fetch_assoc()) {
                                                              echo "<tr><td>" . $employee['name'] . "</td>";
                                                      
                                                              for ($j = 1; $j <= $totalDaysInMonth; $j++) {
                                                                  $dateOfAttendance = date("Y-m-$j");
                                                                  $stmt = $conn->prepare("SELECT id, status FROM attendance WHERE emp_id = ? AND attendance_date = ?");
                                                                  $stmt->bind_param("is", $employee['emp_id'], $dateOfAttendance);
                                                                  $stmt->execute();
                                                                  $stmt->store_result();
                                                      
                                                                  if ($stmt->num_rows > 0) {
                                                                      $stmt->bind_result($attendanceId, $attendanceStatus);
                                                                      $stmt->fetch();
                                                      
                                                                      // Determine cell color based on attendance status
                                                                      $color = "";
                                                                      switch ($attendanceStatus) {
                                                                          case "Present":
                                                                              $color = "green";
                                                                              break;
                                                                          case "Absent":
                                                                              $color = "red";
                                                                              break;
                                                                          case "Leave":
                                                                              $color = "brown";
                                                                              break;
                                                                          default:
                                                                              $color = "";
                                                                              break;
                                                                      }
                                                                      echo "<td style='background-color: $color; color:white'>$attendanceStatus</td>";
                                                                  } else {
                                                                      echo "<td></td>";
                                                                  }
                                                                  $stmt->close();
                                                              }
                                                      
                                                              // Reset button form
                                                              echo "<td><form method='POST' action='view_atten.php'><input type='hidden' name='emp_id' value='" . $employee['emp_id'] . "' /><button 
                                                             type='submit' name='reset' class='btn btn-warning btn-sm'>Reset</button></form></td></tr>";
                                                          }
                                                      
                                                          echo "</tbody>";
                                                      } else {
                                                          // No records found message
                                                          echo "<tr><td colspan='" . ($totalDaysInMonth + 2) . "' class='text-center'>No records found</td></tr>";
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
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>


                    <script>
                        function exportToExcel() {
                            var wb = XLSX.utils.book_new();
                            var ws_data = [];
                            var table = document.getElementById('attendanceTable');
                            var rows = table.rows;

                            for (var i = 0; i < rows.length; i++) {
                                var row = [], cols = rows[i].cells;
                                for (var j = 0; j < cols.length; j++) {
                                    if (cols[j].style.backgroundColor) {
                                        var status = cols[j].innerText;
                                        row.push(status);
                                    } else {
                                        row.push(cols[j].innerText);
                                    }
                                }
                                ws_data.push(row);
                            }

                            var ws = XLSX.utils.aoa_to_sheet(ws_data);
                            XLSX.utils.book_append_sheet(wb, ws, "Sheet1");
                            XLSX.writeFile(wb, 'attendance.xlsx');
                        }
                    </script>



</body>

</html>