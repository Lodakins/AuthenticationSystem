<?php 
 session_start();
include_once('lib/header.php');
 ?>
<h1> Forgot Password </h1>
<p>  Provide the email associated with your password </p>

<form action="processforgot.php" method="POST">
<p><?php
         if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo '<span style="color:red">' . $_SESSION['error'] . ' </span>';
           session_destroy();
         }
         ?>
     </p>
<p> 
        <label> Email </label><br/>
        <input type="text" name="email" placeholder="polarisd@ii.com"  />
    </p>
    <p>
        <button type="submit"> Send Reset Code </button>
    </p>
</form>



<?php include_once('lib/footer.php');

?>