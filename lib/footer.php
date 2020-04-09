<footer>
    <a href="index.php"> Home </a>
    <?php 
        if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){?>
            <a href="login.php"> Login </a>
            <a href="register.php"> Register </a>
             <!-- <a href="forgotpassword.php"> Forgot Password </a>  -->
       <?php }else{ ?>
        <a href="logout.php"> Logout </a>
        <!-- <a href="resetpassword.php"> Reset Password </a> -->
       <?php } ?>

   
</footer>
</body>
</html>