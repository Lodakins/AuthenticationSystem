<?php 
 session_start();
 require_once("lib/alert.php");
 if(isset($_SESSION['loggedin']) && !empty($_SESSION['loggedin'])){
  header("Location:dashboard.php");
}
include_once('lib/header.php') 
 ?>
  <header>
    <p> Welcome, Please register, All fields (*) are compulsory</p>
  </header>  
 <form method="POST" action="processlogin.php">
     <p><?php
       error1();
       error();
        message();
         ?>
     </p>
     <p> 
        <label> Email </label><br/>
        <input
        <?php
                if(isset($_SESSION['email'])){
                    echo "value=" . $_SESSION['email'];
                }
         ?>
        type="text" name="email" placeholder="polarisd@ii.com"  />
    </p>
    <p> 
        <label> Password</label><br/>
        <input  type="password" name="password" placeholder="Password"  />
    </p>
    <p> 
       <button type="submit">Login </button>
    </p>
     </form>

<?php include_once('lib/footer.php')  ?>