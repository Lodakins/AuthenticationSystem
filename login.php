<?php 
 session_start();
include_once('lib/header.php') 
 ?>
  <header>
    <p> Welcome, Please register, All fields (*) are compulsory</p>
  </header>  
 <form method="POST" action="processlogin.php">
     <p><?php
         if(isset($_SESSION['message']) && !empty($_SESSION['message'])){
            echo '<span style="color:green">' . $_SESSION['message'] . ' </span>';
           
           session_destroy();
         }
         if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
            echo '<span style="color:red">' . $_SESSION['error'] . ' </span>';
           
           session_destroy();
         }
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