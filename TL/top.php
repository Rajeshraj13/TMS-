<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags, Bootstrap CSS, and other CSS links -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Adjustments for scrolling form */
        body {
            padding-top: 56px; /* Adjust based on your header height */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .update-profile {
            max-height: 600px; /* Set a maximum height for scrolling */
            overflow-y: auto; /* Enable vertical scrolling */
            padding: 15px;
        }

        /* Other styles as needed */
    </style>
</head>
<body id="page-top">

    <div id="wrapper">
        <!-- Sidebar and other elements -->
    </div>

    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Topbar content -->
                <?php
            if (isset($_SESSION['success_message'])) {
            echo '<div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">';
            echo $_SESSION['success_message'];
            echo '<button type="button" class="close" aria-label="Close">';
            echo '<span aria-hidden="true">&times;</span>';
            echo '</button>';
            echo '</div>';
            unset($_SESSION['success_message']); 
            }
      ?>
            </nav>

            <div class="container mt-5">
                <div class="update-profile card p-4 shadow-sm">
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
                                    <label for="emp">Emp Id</label>
                                    <input type="number" class="form-control" id="emp_id" name="emp_id"
                                        value="<?php echo isset($row['emp_id']) ? $row['emp_id'] : ''; ?>" required>
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
                                    <label for="password">Password</label>
                                    <input type="text" class="form-control" id="password" name="password"
                                        value="<?php echo isset($row['password']) ? $row['password'] : ''; ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="tel">Contact</label>
                                    <input type="tel" class="form-control" id="contact" name="phone"
                                        value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="blood-group">Blood Group</label>
                                    <select class="form-control" id="blood_group" name="blood_group" required>
                                        <option value="">Select a blood group</option>
                                        <option value="A+" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='A+' ) ? 'selected' : '' ; ?>>A+</option>
                                        <option value="A-" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='A-' ) ? 'selected' : '' ; ?>>A-</option>
                                        <option value="B+" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='B+' ) ? 'selected' : '' ; ?>>B+</option>
                                        <option value="B-" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='B-' ) ? 'selected' : '' ; ?>>B-</option>
                                        <option value="AB+" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='AB+' ) ? 'selected' : '' ; ?>>AB+</option>
                                        <option value="AB-" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='AB-' ) ? 'selected' : '' ; ?>>AB-</option>
                                        <option value="O+" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='O+' ) ? 'selected' : '' ; ?>>O+</option>
                                        <option value="O-" <?php echo (isset($row['blood_group']) &&
                                            $row['blood_group']=='O-' ) ? 'selected' : '' ; ?>>O-</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="experience">Experience</label>
                                    <input type="text" class="form-control" id="experience" name="experience"
                                        value="<?php echo isset($row['experience']) ? $row['experience'] : ''; ?>"
                                        required>
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
                            <a href="manage_admin.php" class="btn btn-danger">Go Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript and other scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(function () {
            $('body').scrollspy({ target: '#navbar-example' });
        });
    </script>
</body>
</html>
