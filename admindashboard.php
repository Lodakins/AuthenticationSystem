<?php 
 session_start();
 if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){
     header("Location: login.php");
 }
 require_once("lib/user.php");
include_once('lib/header.php') 
 ?>


<h2> Dashboard </h2>
<p> Welcome, <?php echo $_SESSION['fullname'];   ?> You are logged in as (<?php echo $_SESSION['role']; ?>) and your ID is <?php  echo $_SESSION['loggedin'];?></p>
<p> User Level Access: <?php  echo  $_SESSION['role']   ?></p> </p>
<p> Departmemt: <?php  echo  $_SESSION['department'];   ?></p>
<p> Date of Registration:  <?php  echo  $_SESSION['dob'];   ?></p> </p>
<p> Date of Last Login:  <?php echo  $_SESSION['lastlogin'];   ?></p> </p>
<p> <a href="register.php"><button class="btn btn-primary"> Add User</button></a> </p>

<h3 class="text-center mb-3"> ALL USER</h3>
<section class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
<?php 
    viewAllUsers();
?>
</div>
    </div>
</section>

<?php include_once('lib/footer.php')  ?>