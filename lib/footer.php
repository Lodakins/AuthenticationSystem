<footer>
    <a href="index.php"> Home </a>
    <?php 
        if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){?>
            <a href="login.php"> Login </a>
            <a href="register.php"> Register </a>
             <a href="forgotpassword.php"> Forgot Password </a>  
       <?php }else{ ?>
        <a href="logout.php"> Logout </a>
        <a href="resetpassword.php"> Reset Password </a>
       <?php } ?>

       <script src="js/jquery-3.3.1.js"></script>
   <script src="js/bootstrap.min.js"></script>
   <script src="js/datepicker.js"></script>
   <script src="js/jquery.timepicker.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/swal2.js"></script>
</footer>
