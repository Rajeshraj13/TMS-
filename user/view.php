<?php
session_start();

include "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>User Dashboard</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="page-top bg-info">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_user.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index_user.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTask"
                    aria-expanded="true" aria-controls="collapseTask">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapseTask" class="collapse" aria-labelledby="headingTask" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="view.php">View</a>
                    </div>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span>
                </a>
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
                              $email = $_SESSION['email']; 
                              $sql = "SELECT name FROM add_user WHERE email = '$email'";
                              $query = mysqli_query($conn, $sql);
                              if ($query) {
                              $result = mysqli_fetch_assoc($query);
                              if ($result) {
                              $userName = $result['name'];
                              } else {
                              $userName = 'Guest';
                              echo "No rows found.";
                              }
                              } else {
                              $userName = 'Guest';
                              echo "Database query failed: " . mysqli_error($conn);
                              }
                              ?>


                            <!-- fetch user-image    -->
                            <?php 
                            include "../connection.php";
                            if (!isset($_SESSION["email"])) {
                            
                            header("Location: login.php");
                            exit();
                            }
                            // Fetch user details including image path
                            $email = $_SESSION["email"];
                            $sql = "SELECT * FROM `reg-information` WHERE `email` = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            if ($result->num_rows == 1) {
                            $row = $result->fetch_assoc();
                            // Assuming the column name for the image path is 'imageUpload'
                            $userImage = $row["imageUpload"];
                            } else {
                            // Handle the case where user details are not found
                            echo "User details not found.";
                            exit();
                            }
                            $stmt->close();
                         ?>


                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo htmlspecialchars($userName); ?>
                                </span>
                                <?php if (!empty($userImage)) { ?>
                                <img src="../admin/admin/images/<?php echo $userImage; ?>" alt="User Image"
                                    class="img-profile" style='border-radius:50%; width:40px; height:40px;'>
                                <?php } else { ?>
                                <p>No image found for the user.</p>
                                <?php } ?>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profileModal">
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
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">' . $msg . '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                    }
                ?>

                    <h3 class="mt-4 text-danger">Your Task</h3>

                    <?php if (isset($_SESSION['message'])): ?>

                    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?> alert-dismissible fade show"
                        role="alert">
                        <?php echo $_SESSION['message']; ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                    </div>
                    <?php
                    unset($_SESSION['message']);
                    unset($_SESSION['msg_type']);
                 ?>
                    <?php endif;
                 ?>

                    <div class="table-responsive">
                        <div class="table-scroll">
                            <table class="table table-bordered text-dark" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th scope="col">Task</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                        <th scope="col">Assigned Date</th>
                                        <th scope="col">Completed Date</th>
                                        <th scope="col">Task Status</th>
                                        <th scope="col">Task Assigned By</th>
                                        <th scope="col">Upload PDF</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    <!-- Task Update Query -->

                                    <?php
                                        include "../connection.php";
                                        $email = $_SESSION['email']; // Correct 'email' to 'Email'
                                        $sql = "SELECT id, assignment, assignment_status, task, assignment_start_date, completion_date, taskassign FROM add_user WHERE email = '$email'";
                                        $result = $conn->query($sql);
                                        if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['assignment'] . "</td>";
                                        echo "<td>";
                                        if ($row['assignment_status']) {
                                        echo '<a href="?id=' . $row['id'] . '" class="btn btn-success">Complete</a>';
                                        } else {
                                        echo '<a href="?id=' . $row['id'] . '" class="btn btn-danger">Pending</a>';
                                        }
                                        echo "</td>";
                                        echo "<td><a href='edit.php?id=" . $row['id'] . "'><i class='fa-regular fa-pen-to-square me-3'></i></a></td>";
                                        // echo "<td>" . $row['task'] . "</td>";
                                        echo "<td>" . $row['assignment_start_date'] . "</td>";
                                        echo "<td>" . $row['completion_date'] . "</td>"; 
                                        echo "<td>" . $row['task'] . "</td>";// Remove the extra space after 'completion_date'
                                        echo "<td>" . $row['taskassign'] . "</td>";// Remove the extra space after 'completion_date'
                                        echo "<td>
                                        <form action='upload.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-group'>
                                        <label for='uploaderName'>Name:</label>
                                        <input type='text' name='uploaderName' class='form-control' required></br>
                                        <input type='file' name='pdfFile' class='form-control-file' required>
                                        </div>
                                        <input type='hidden' name='taskId' value='" . $row['id'] . "'>
                                        <button type='submit' class='btn btn-primary'>Upload</button>
                                        </form>
                                        </td>";


                                        echo "</tr>";
                                        }
                                        } else {
                                        echo "<tr><td colspan='6'>No records found</td></tr>";
                                        }
                                    ?>

                                </tbody>
                        </div>
                    </div>

                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>

                    </table>

                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ready to Logout?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Select "Logout" below if you are ready to end your
                                    current session.</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="../index1.php">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog"
                        aria-labelledby="profileModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <h4>Profile:</h4>

                                    <?php
                                        include "../connection.php";
                                        // Check if the user is logged in
                                        if(isset($_SESSION['email'])) {
                                        $email = $_SESSION['email']; 
                                        
                                        // SQL query to fetch user information
                                        $sql = "SELECT * FROM `reg-information` WHERE email = '$email'";
                                        $query = mysqli_query($conn, $sql);
                                        
                                        if ($query) {
                                        $result = mysqli_fetch_assoc($query);
                                        if ($result) {
                                        $userName = $result['name'];
                                        $password = $result['email'];
                                        $phone = $result['phone'];
                                        } else {
                                        $userName = 'Guest'; 
                                        echo "No rows found.";
                                        }
                                        } else {
                                        $userName = 'Guest'; 
                                        echo "Database query failed: " . mysqli_error($conn);
                                        }
                                        } else {
                                        // If user is not logged in, set default values
                                        $userName = 'Guest';
                                        $password = '';
                                        $phone = '';
                                        }
                                     ?>

                                    <p>UserName:
                                        <?php echo htmlspecialchars($userName); ?>
                                    </p>
                                    <p>Email:
                                        <?php echo htmlspecialchars($password); ?>
                                    </p>
                                    <p>Phone:
                                        <?php echo htmlspecialchars($phone); ?>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-danger" type="button" data-dismiss="modal">Close</button>
                                </div>
                            </div>
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
</body>

</html>