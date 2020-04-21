<?php 
 session_start();
 require_once("lib/alert.php");
 require_once("lib/user.php");
 loggedin();
include_once('lib/header.php') 
 ?>
  <header>
    <p class="text-center"> Welcome, Please register, All fields (*) are compulsory</p>
  </header>
  <section class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
        <form method="POST" action="processlogin.php" class="formContainer">
            <p><?php
                printAlert();
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
                type="text" name="email" placeholder="polarisd@ii.com" class="form-control" />
            </p>
            <p> 
                <label> Password</label><br/>
                <input  type="password" name="password" placeholder="Password" class="form-control"  />
            </p>
            <p> 
            <button type="submit" class="btn  btn-primary btn-lg btn-block">Login </button>
            </p>
         </form>
        </div>
    </div>
  </section>  


<?php include_once('lib/footer.php')  ?>