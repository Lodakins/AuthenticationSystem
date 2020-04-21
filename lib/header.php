<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Authentication System</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="css/swal.css" />

</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
     <h5 class="my-0 mr-md-auto font-weight-normal">  <a href="index.php">  SNH </a></h5>
      <nav class="my-2 my-md-0 mr-md-3">
        <?php if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){?>
        <a class="p-2 text-dark" href="login.php">Login</a>
        <a class="p-2 text-dark" href="register.php">Register</a>
        <a class="p-2 text-dark" href="forgotpassword.php">Forgot Password</a>
        <?php }else{ ?>
        <a class="p-2 text-dark" href="resetpassword.php">Reset Password</a>
        <a class="btn btn-outline-primary" href="logout.php">Logout</a>
        <?php }?>
      </nav>     
</div>
