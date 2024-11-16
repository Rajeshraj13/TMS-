<?php
session_start();
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
    <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3 ">EMS Admin</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Manage Information</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.php">Login</a>
                        <a class="collapse-item" href="manage_admin.php">Employee Information</a>
                        <a class="collapse-item" href="intern_info.php">Intern Information</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addadmin">Add Admin</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#Atten" aria-expanded="true"
                    aria-controls="collapsePagesTask">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="Atten" class="collapse" aria-labelledby="headingPagesTask" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_task.php">Add Task</a>
                        <a class="collapse-item" href="view.php">View</a>
                    </div>
                </div>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="tables.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Tables</span></a>
            </li>


            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapsePagesTask"
                    aria-expanded="true" aria-controls="collapsePagesTask">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Attendance</span>
                </a>
                <div id="collapsePagesTask" class="collapse" aria-labelledby="headingPagesTask"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="atten.php">Take Attendance</a>
                        <a class="collapse-item" href="view_atten.php">View Attendance</a>
                
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
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

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
                                        <?php echo htmlspecialchars($row["Name"]); ?>
                                    </P>
                                </span>
                                <img class="img-profile rounded-circle" src="images.jpeg">
                            </a>



                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>


                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
                    <div class="row">
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-60 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="manage_admin.php">
                                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                    Total Members</div>
                                            </a>


                                            <!-- Update the Admin -->
                                            <?php
                                                $sql = "SELECT COUNT(*) as total FROM `reg-information`";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result && mysqli_num_rows($result) > 0) {
                                                $row = mysqli_fetch_assoc($result);
                                                $total = $row['total'];
                                                echo '<h4 class="mb-0">' . $total . '</h4>';
                                                } else {
                                                echo '<h4 class="mb-0">No Data</h4>';
                                                }
                                             ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-6 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-60 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="tables.php">
                                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                    Tasks
                                                </div>
                                            </a>

                                            <?php
                                        $sql = "SELECT COUNT(*) as total FROM add_user";
                                        $result = mysqli_query($conn, $sql);
                                        if ($result && mysqli_num_rows($result) > 0) {
                                        $row = mysqli_fetch_assoc($result);
                                        $total = $row['total'];
                                        echo '<h4 class="mb-0">' . $total . '</h4>';
                                        } else {
                                        echo '<h4 class="mb-0">No Data</h4>';
                                        }
                                    ?>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <a href="tables.php">
                                                <div
                                                    class="text-xs font-weight-bold text-info text-uppercase mb-1 fs-2">
                                                    Admin Info
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <div class="table-responsive">

                                                    <table class="table table-bordered" id="dataTable" width="100%"
                                                        cellspacing="0">
                                                        <thead>
                                                            <tr>
                                                                <th>ID</th>
                                                                <th>Name</th>
                                                                <th>Email</th>
                                                                <th>Password</th>
                                                                <th>Phone</th>
                                                                <th>Action</th>
                                                                <th>Role</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php 
                                                                $sql= "SELECT `id`, `Name`, `Email`, `Password`, `Phone`, `Role` FROM admin_registration";
                                                                $result = $conn->query($sql);
                                                                if ($result->num_rows > 0) {
                                                                while($row = $result->fetch_assoc()) {
                                                                echo "<tr>";
                                                                echo "<th>" . $row['id'] . "</th>";
                                                                echo "<td>" . $row['Name'] . "</td>";
                                                                echo "<td>" . $row['Email'] . "</td>";
                                                                echo "<td>" . $row['Password'] . "</td>";
                                                                echo "<td>" . $row['Phone'] . "</td>";
                                                                
                                                                 echo "<td>
                                                                 <a href='admin_edit.php?id=" . $row['id'] . "'><i class='bi bi-pencil me-3' style='color:green;'></i></a>
                                                                 <a href='manage_admin.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this user?\")'><i class='fa-solid fa-trash' style='color:red;'></i></a>
                                                                 </td>";
                                                                 echo "<td>" . $row['Role'] . "</td>";
                                                                echo "</tr>";
                                                                
                                                                }
                                                                } else {
                                                                echo "<tr><td colspan='6'>No records found</td></tr>";
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Logout?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../index1.php">Logout</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Add admin -->

    <?php
            // session_start();
            include '../connection.php';

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $Name = $_POST['Name'];
            $Email = $_POST['Email'];
            $Password = $_POST['Password'];
            $Phone = $_POST['Phone'];
            $Role = $_POST['Role'];
            
            
            if (empty($Name) || empty($Email) || empty($Password) || empty($Phone) || empty($Role)   ) {
            } else {
            
            $stmt = $conn->prepare("INSERT INTO admin_registration (Name, Email, Password, Phone, Role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $Name, $Email, $Password, $Phone, $Role);
            
            
            if ($stmt->execute()) {
            echo "<script type='text/javascript'> alert('Information stored successfully');</script>";
            
            
            } else {
            echo "Error: " . $stmt->error;
            }

            $stmt->close();
            }
            }

            // Close the connection
            $conn->close();
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
                    <form id="addUserForm" class="user" method="POST" action="">

                        <div class="form-group">
                            <label for="username">Name</label>
                            <input type="text" class="form-control" id="username" name="Name" required>
                        </div>

                        <div class="form-group">
                            <label for="username">Email</label>
                            <input type="email" class="form-control" id="Email" name="Email" required>
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="Password" required>
                        </div>

                        <div class="form-group">
                            <label for="tel">Phone</label>
                            <input type="tel" class="form-control" id="Phone" name="Phone" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="Role" required>
                                <option value="">Select a role</option>
                                <option value="student">Admin</option>
                                <option value="faculty">TL</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Admin</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <!-- Profile Modal -->

    <div class="modal dark" id="profile" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel" style="color: red;">Admin Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <?php
                include "../connection.php";

                // Check if the user is logged in
                if(isset($_SESSION['Email'])) {
                $email = $_SESSION['Email']; 
                
                // SQL query to fetch user information
                $sql = "SELECT * FROM `admin_registration` WHERE Email = '$Email'";
                $query = mysqli_query($conn, $sql);
                
                if ($query) {
                $result = mysqli_fetch_assoc($query);
                if ($result) {
                $userName = $result['Name'];
                $password = $result['Email'];
                $phone = $result['Phone'];
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
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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



</body>

</html>