<?php 
 session_start();
include_once('lib/header.php');
if(!isset($_GET['token']) && !isset($_SESSION['token'])){
    $_SESSION['error1']=" You are not authorized to view this page";
    header("Location: login.php");
}
 ?>
<h1> Resest Password </h1>
<p> Reset password associated with your account: [email] </p>

<form action="processreset.php" method="POST">
<p>
    <?php
         if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo '<span style="color:red">' . $_SESSION['error'] . ' </span>';
           session_destroy();
         }
     ?>
     </p>
     <p>
         <input
         <?php if(isset($_SESSION['token'])){
             echo "value='" . $_SESSION['token'] . "'";
         }else{
            echo "value='" . $_GET['token'] . "'";
        }
        ?> type="hidden" value="<?php echo $_GET['token'] ?>"  name="token"/>
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