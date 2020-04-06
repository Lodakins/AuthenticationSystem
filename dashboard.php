<?php 
 session_start();
include_once('lib/header.php') 
 ?>

<h2> Logged User Id: <?php  echo $_SESSION['loggedin'];  ?></h2>




<?php include_once('lib/footer.php')  ?>