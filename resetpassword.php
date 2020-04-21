<?php 
 session_start();
include_once('lib/header.php');
require_once("lib/user.php");
require_once("lib/alert.php");
if(!is_user_loggedin() && !is_token_set()){
    setAlert("error"," You are not authorized to view that page");
    redirect("login.php");
    die();
}
 ?>
<h1> Resest Password </h1>
<p> Reset password associated with your account: [email] </p>

<form action="processreset.php" method="POST">
<p>
    <?php
        error();
     ?>
     </p>
     <p>
         <?php if(!is_user_loggedin()){  ?>
         <input
         <?php if(is_token_set_in_session()){
             echo "value='" . $_SESSION['token'] . "'";
         }else{
            echo "value='" . $_GET['token'] . "'";
        }
        ?> type="hidden"  name="token"/>
        <?php } ?>
     </p>
        <p> 
        <label> Email </label><br/>
        <input
        <?php
                if(isset($_SESSION['email'])){
                    echo "value='" . $_SESSION['email'] . "'";
                }
         ?>
        type="text" name="email" placeholder="polarisd@ii.com"  />
        </p>
        <p> 
        <label> Enter New Password</label><br/>
        <input  type="password" name="password" placeholder="Password"  />
         </p>
         <p>
        <button type="submit"> Reset Password </button>
        </p>
</form>





<?php include_once('lib/footer.php'); ?>