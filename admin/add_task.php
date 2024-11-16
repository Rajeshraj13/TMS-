<?php
include "../connection.php";

//$ids = []; // Initialize $ids array
$emails = [];
$phones = [];

$sql = "SELECT emp_id, email, Phone FROM `reg-information` ORDER BY emp_id"; // Adjusted query to fetch emp_id
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
     //   $ids[] = $row['emp_id']; // Populate $ids array with emp_id
        $emails[] = $row['email'];
        $phones[] = $row['Phone'];
    }
}
?>



<?php
session_start();

include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
    $name = $_POST['name'];
    $email = $_POST['email'];
    //$phone = $_POST['phone']; 
    $assignment = $_POST['assignment'];
    $task = $_POST['task'];
    $assignment_start_date = $_POST['assignment_start_date'];
    $completion_date = $_POST['completion_date'];
    $taskassign= $_POST['taskassign'];

    {
        $sql = "INSERT INTO `add_user` (name, email,assignment, task, assignment_start_date, completion_date, taskassign) 
                VALUES ('$name','$email','$assignment','$task','$assignment_start_date','$completion_date','$taskassign')"; 
    
        if ($conn->query($sql) === TRUE) {
            // echo "<script type='text/javascript'> alert('Information stored successfully');</script>";
             header("Location: add_task.php?msg=Task added successfully");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();

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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


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

                     // Check whether a variable is empty.
                    //  Session variables are commonly used to store user-specific information, 
                    //  such as user IDs, username
                            if (isset($_SESSION['Email'])) { 
                    // that the 'Email' session variable likely contains the email  currently logged-in user.
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
                            $Name = $row['Name'];
                            } else {
                            $Name = 'Guest';
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
                                    <P>
                                        <!-- convert special characters in a string to their respective HTML entitie -->
                                        <?php echo htmlspecialchars($row["Name"]); ?>
                                    </P>
                                </span>
                                <img class="img-profile rounded-circle" src="images/people.jpeg">
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


                <div class="container">

                    <?php
                        if (isset($_GET["msg"])) {
                        $msg = $_GET["msg"];

                        // Display the alert message
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
                        echo $msg;
                        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                        echo '<span aria-hidden="true">&times;</span>';
                        echo '</button>';
                        echo '</div>';
                        }
                    ?>

                    <div class="row justify-content-center">
                        <div class="col-xl-4">
                            <div class="card login-form mb-0">
                                <div class="card-body pt-4 shadow">
                                    <h4 class="text-center">Task Management System</h4>
                                    <button type="button" class="btn btn-primary btn-block mb-3" data-toggle="modal"
                                        data-target="#addTaskModal">
                                        Add New Task
                                    </button>
                                    <div class="modal  fade" id="addTaskModal" tabindex="-1" role="dialog"
                                        aria-labelledby="addTaskModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body text-left">
                                                    <form method="POST" action="">
                                                        <div class="form-group">
                                                            <label for="name">Name</label>
                                                            <input type="text" class="form-control" id="name"
                                                                name="name" required>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <select class="form-control" id="emailSelect" name="email"
                                                                required>
                                                                <option value=""></option>
                                                                <?php foreach ($emails as $email) : ?>
                                                                <option value="<?php echo $email; ?>">
                                                                    <?php echo $email; ?>
                                                                </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                Please select an email.
                                                            </div>
                                                        </div>

                                                        <!-- <div class="form-group"> -->
                                                        <!-- <label for="emp_id">Emp</label> -->
                                                        <!-- <select class="form-control" id="idSelect" name="emp_id" -->
                                                        <!-- required> -->
                                                        <!-- <option value=""></option> -->
                                                        <!-- <?php foreach ($ids as $emp_id) : ?> -->
                                                        <!-- <option value="<?php echo $emp_id; ?>"> -->
                                                        <!-- <?php echo $emp_id; ?> -->
                                                        <!-- </option> -->
                                                        <!-- <?php endforeach; ?> -->
                                                        <!-- </select> -->
                                                        <!-- <div class="invalid-feedback"> -->
                                                        <!-- Please select an email. -->
                                                        <!-- </div> -->
                                                        <!-- </div> -->
                                                        <div class="form-group">
                                                            <label for="assignment">Assignment</label>
                                                            <textarea class="form-control" id="assignment"
                                                                name="assignment" style="height: 100px"
                                                                required></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="assignmentStartDate">Assign Date</label>
                                                            <input type="date" class="form-control"
                                                                id="assignmentStartDate" name="assignment_start_date"
                                                                required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="completionDate">Deadline</label>
                                                            <input type="date" class="form-control" id="completionDate"
                                                                name="completion_date" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="taskStatus">Task Status</label>
                                                            <select class="form-control" id="taskStatus" name="task"
                                                                required>
                                                                <option value="">Select Task Status</option>
                                                                <option value="Complete">Update</option>
                                                                <!-- <option value="Complete">Complete</option> -->
                                                                <!-- <option value="Pending">Pending</option> -->
                                                                <!-- <option value="Ongoing">Ongoing</option> -->
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="taskassign">Task Assign by</label>
                                                            <select class="form-control" id="taskassign"
                                                                name="taskassign" required>
                                                                <option value="">Assigned By</option>
                                                                <option value="Admin">Admin</option>
                                                                <option value="TL">TL</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit"
                                                            class="btn btn-primary btn-block">Add</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-lg-12 text-center">
                            <img src="../task.png" class="img-fluid" alt="First Animated PNG">
                        </div>
                    </div>
                </div>



                <!-- Scroll to Top Button-->
                <a class="scroll-to-top rounded" href="#page-top">
                    <i class="fas fa-angle-up"></i>
                </a>

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

                <!-- Bootstrap core JavaScript-->
                <script src="vendor/jquery/jquery.min.js"></script>
                <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                <!-- Core plugin JavaScript-->
                <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                <!-- Custom scripts for all pages-->
                <script src="js/sb-admin-2.min.js"></script>

                <!-- Page level plugins -->
                <script src="vendor/datatables/jquery.dataTables.min.js"></script>
                <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

                <!-- Page level custom scripts -->
                <script src="js/demo/datatables-demo.js"></script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
                    crossorigin="anonymous"></script>

</body>

</html>