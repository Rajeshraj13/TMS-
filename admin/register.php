<!-- 


<?php
session_start();
include '../connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    $Phone = $_POST['Phone'];

    
    if (empty($Name) || empty($Email) || empty($Password) || empty($Phone)) {
        echo "<script type='text/javascript'> alert('All fields are required');</script>";
    } else {
       
        $stmt = $conn->prepare("INSERT INTO admin_registration (Name, Email, Password, Phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $Email, $Password, $Phone);

       
        if ($stmt->execute()) {
            // echo "<script type='text/javascript'> alert('Information stored successfully');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

// Close the connection
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
    <title>SB Admin 2 - Register</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-info">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" action="register.php" method="POST" onsubmit="return validateForm()">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" placeholder="Name" name="Name" required>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" placeholder="Email Address" name="Email" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" placeholder="Password" name="Password" required pattern="[a-zA-Z0-9]{6,12}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control form-control-user" placeholder="Phone Number" name="Phone" required pattern="[0-9]{10}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                                <hr>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="login.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
   
    <script>
    function validateForm() {
        var name = document.forms["userForm"]["Name"].value;
        var email = document.forms["userForm"]["Email"].value;
        var password = document.forms["userForm"]["Password"].value;
        var phone = document.forms["userForm"]["Phone"].value;

        // Regular expressions for validation
        var nameRegex = /^[a-zA-Z\s]+$/;
        var passwordRegex = /^[a-zA-Z0-9]{6}$/;
        var phoneRegex = /^[0-9]{10}$/;

        // Validation for Name
        // if (!name.match(nameRegex)) {
            // alert("Please enter a valid name.");
            // return false;
        // }

        if (name === "" || /[^a-zA-Z ]/.test(name)) {
    nameError.textContent = "Please enter your name properly.";
    isValid = false;
}

        // Validation for Password
        if (!password.match(passwordRegex)) {
            alert("Password must be 6 to 12 characters long and contain only letters and digits.");
            return false;
        }

        // Validation for Phone
        if (!phone.match(phoneRegex)) {
            alert("Phone number must contain 10 digits.");
            return false;
        }

        // If all validations pass, the form will be submitted
        return true;
    }
</script>

   
</body>
</html> -->
