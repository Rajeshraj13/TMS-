<?php
include "../connection.php";
$row = [];

if (isset($_GET['id'])) {
    $intern_id = $_GET['id']; // Correct variable name

    $sql = "SELECT * FROM `intern` WHERE `intern_id`='$intern_id'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "User not found.";
        exit;
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $intern_id = $_POST['intern_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact']; 
    $address = $_POST['address']; 
    $role = $_POST['role'];
    $blood_group = $_POST['blood_group'];
    $college = $_POST['college']; // Correct variable name
    $dob= $_POST['dob'];

    $sql = "UPDATE `intern` SET `intern_id`='$intern_id', `name`='$name', `email`='$email', `contact`='$contact', `address`='$address', `role`='$role', `blood_group`='$blood_group', `college`='$college', `dob`='$dob' WHERE `intern_id`='$intern_id'";
   // $sql = "UPDATE `intern` SET `intern_id`='$intern_id', `name`='$name', `email`='$email', `contact`='$contact', `address`='$address', `role`='$role',`blood_group`=`$blood_group`, `college`='$college', `dob`='$dob' WHERE `intern_id`='$intern_id'"; // Corrected column name
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>alert('Information updated successfully');</script>";
        header("Location: intern_info.php");
        
        exit;
    } else {
        echo "Error updating information: " . mysqli_error($conn);
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
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .form-title {
            margin-bottom: 30px;
            font-size: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            width: 100%;
            max-width: 400px;
            /* Adjust max-width as needed */
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .input-field,
        .select-field {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        .input-field:focus,
        .select-field:focus {
            border-color: #6c63ff;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 400px;
            /* Adjust max-width as needed */
        }

        .button {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #6c63ff;
            color: #fff;
        }

        .cancel-button {
            background-color: #dc3545;
            color: #fff;
        }

        .submit-button {
            background-color: #28a745;
            color: #fff;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="sidebar-brand-text mx-3">EMS Admin</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTasks"
                    aria-expanded="true" aria-controls="collapseTasks">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Task</span>
                </a>
                <div id="collapseTasks" class="collapse" aria-labelledby="headingTasks" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="add_task.php">Add Task</a>
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
                            $sql = " SELECT * FROM `admin_registration`";
                            $query=mysqli_query($conn,$sql);
                            $result = mysqli_fetch_assoc($query);
                            ?>

                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $result['Name']; ?>
                                </span>
                                <img class="img-profile rounded-circle" src="images/people.jpeg">
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



                <h2 class="font-italic text-center">Edit Information</h2>
                <hr>
                <?php
  if (isset($_SESSION['success_message'])) {
      echo '<div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">';
      echo $_SESSION['success_message'];
      echo '<button type="button" class="close" aria-label="Close" onclick="redirectToPage(\'manage_admin.php\')">';
      echo '<span aria-hidden="true">&times;</span>';
      echo '</button>';
      echo '</div>';
      unset($_SESSION['success_message']); 
  }
  
   ?>
                <div class="container mt-5">
                    <div class="update-profile card p-4 shadow-sm">
                        <!-- <form action="" method="post" enctype="multipart/form-data"> -->
                        <form class="" method="POST" action="">
                            <?php if (!empty($row['imageUpload'])): ?>
                            <div style="text-align: center;">
                                <img src="admin/images/<?php echo htmlspecialchars($row['imageUpload']); ?>"
                                    class="img-fluid rounded mb-3"
                                    style="width: 130px; height: 130px; object-fit: cover;">
                                <h4 class="font-italic">Profile</h4>
                                <hr>
                            </div>
                            <?php else: ?>
                            <p style="text-align: center;">No image available</p>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="intern">Intern Id</label>
                                        <input type="number" class="form-control" id="intern_id" name="intern_id"
                                            value="<?php echo isset($row['intern_id']) ? $row['intern_id'] : ''; ?>"
                                            required>


                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="<?php echo isset($row['name']) ? $row['name'] : ''; ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="username" name="email"
                                            value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
                                        <!-- <label for="update_image">Update Your Pic:</label> -->
                                        <!-- <input type="file" name="update_image" id="update_image" accept="" -->
                                        <!-- class="form-control-file"> -->
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="">Select a role</option>
                                            <option value="frontend_developer" <?php echo isset($row['role']) &&
                                                $row['role']=='frontend_developer' ? 'selected' : '' ; ?>>Frontend
                                                Developer
                                            </option>
                                            <option value="backend_developer" <?php echo isset($row['role']) &&
                                                $row['role']=='backend_developer' ? 'selected' : '' ; ?>>Backend
                                                Developer
                                            </option>
                                            <option value="designer" <?php echo isset($row['role']) &&
                                                $row['role']=='designer' ? 'selected' : '' ; ?>>Designer</option>
                                            <option value="digital_marketing" <?php echo isset($row['role']) &&
                                                $row['role']=='digital_marketing' ? 'selected' : '' ; ?>>Digital
                                                Marketing
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dob">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob"
                                            value="<?php echo isset($row['dob']) ? $row['dob'] : ''; ?>" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="old_pass" value="">
                                    <div class="form-group">

                                        <label for="college">College</label>
                                        <input type="text" class="form-control" id="college" name="college"
                                            value="<?php echo isset($row['college']) ? $row['college'] : ''; ?>"
                                            required>


                                    </div>
                                    <div class="form-group">
                                        <label for="tel">Contact</label>
                                        <input type="tel" class="form-control" id="contact" name="contact"
                                            value="<?php echo isset($row['contact']) ? $row['contact'] : ''; ?>"
                                            required>


                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="blood_group">Blood Group</label>
                                        <select class="form-control" id="blood_group" name="blood_group" required>
                                            <option value="">Select a blood group</option>
                                            <option value="A+" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='A+' ? 'selected' : '' ; ?>>A+</option>
                                            <option value="A-" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='A-' ? 'selected' : '' ; ?>>A-</option>
                                            <option value="B+" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='B+' ? 'selected' : '' ; ?>>B+</option>
                                            <option value="B-" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='B-' ? 'selected' : '' ; ?>>B-</option>
                                            <option value="AB+" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='AB+' ? 'selected' : '' ; ?>>AB+</option>
                                            <option value="AB-" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='AB-' ? 'selected' : '' ; ?>>AB-</option>
                                            <option value="O+" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='O+' ? 'selected' : '' ; ?>>O+</option>
                                            <option value="O-" <?php echo isset($row['blood_group']) &&
                                                $row['blood_group']=='O-' ? 'selected' : '' ; ?>>O-</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="update_image">Update Your Pic:</label>
                                        <input type="file" name="update_image" id="update_image" accept=""
                                            class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" value="Update Profile" name="update_profile"
                                    class="btn btn-primary">
                                <a href="intern_info.php" class="btn btn-danger">Go Back</a>
                            </div>
                        </form>
                    </div>
                </div>


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
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
</body>

</html>