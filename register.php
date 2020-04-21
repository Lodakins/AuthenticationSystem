<?php 
 session_start();
 require_once("lib/alert.php");
 require_once("lib/validate.php");
include_once('lib/header.php')


?>
  <header>
    <h3 class="text-center"> Welcome, Please register. All fields are compulsory</h3>
  </header>  
  <section class="container mb-4">
    <div class="row">
        <div class="col-md-6 mx-auto">
 <form method="POST" action="processregistartion.php"  class="formContainer">
     <p><?php

           printAlert();
         if(isset($_SESSION['emailerror']) && !empty($_SESSION['emailerror'])){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            '.  $_SESSION['emailerror'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>';
                if(session_id()){
                 session_destroy();
                 }
         } 
         if(isset($_SESSION['nameerror']) && !empty($_SESSION['nameerror'])){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            '.  $_SESSION['nameerror'] .'
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div>';
                if(session_id()){
                 session_destroy();
                 }
         }
         ?>
     </p>
    <p> 
        <label> First Name</label><br/>
        <input 
         <?php
                if(isset($_SESSION["first_name"])){
                    echo "value=" . $_SESSION['first_name'];
                }
         ?>
        type="text" name="first_name" placeholder="First Name" required class="form-control" />
    </p>
    <p> 
        <label> Last Name</label><br/>
        <input 
        <?php
                if(isset($_SESSION["last_name"])){
                    echo "value=" . $_SESSION['last_name'];
                }
         ?>
        type="text" name="last_name" placeholder="Surname"  class="form-control" required/>
    </p>
    <p> 
        <label> Email </label><br/>
        <input
        <?php
                if(isset($_SESSION['email'])){
                    echo "value=" . $_SESSION['email'];
                }
         ?>
        type="text" name="email" placeholder="polarisd@ii.com"  class="form-control" required />
    </p>
    <p> 
        <label> Password</label><br/>
        <input  type="password" name="password" placeholder="Password" class="form-control" required />
    </p>
    <p> 
        <label> Gender</label><br/>
       <select name="gender" class="form-control" required>
       <option value=""> -- Select a gender---</option>
       
           <option 
           <?php
             if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'male'){
                echo "selected";
            }
       ?>
           value="male"> Male</option>
           <option
           <?php
             if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'female'){
                echo "selected";
            }
             ?>
           value="female"> Female</option>
       </select>
    </p>
    <p> 
        <label> Designation</label><br/>
       <select name="designation" class="form-control" required>
            <option value=""> -- Select Designation-- </option>
           <option
           <?php
             if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'medical_team'){
                echo "selected";
            }
             ?>
           value="medical_team"> Medical Team</option>
           <option 
           <?php
             if(isset($_SESSION['designation']) && $_SESSION['designation'] == 'patient'){
                echo "selected";
            }
             ?>
           value="patient"> Patient </option>
       </select>
    </p>
    <p> 
        <label> Department</label><br/>
        <select name="department" class="form-control" required>
            <option>--SELECT--</option>
            <option 
            <?php 
            if(isset($_SESSION["department"]) &&  $_SESSION["department"]== "laboratory"){
                echo "selected"; 
            }
            ?> value="laboratory"> Laboratory</option>
            <option <?php 
            if(isset($_SESSION["department"]) &&  $_SESSION["department"]== "icu"){
                echo "selected"; 
            }
            ?>value="icu"> Intensive Care Unit</option>
            <option <?php 
            if(isset($_SESSION["department"]) &&  $_SESSION["department"]== "pharmacy"){
                echo "selected"; 
            }
            ?>value="pharmacy"> Pharmacy</option>
            <option <?php 
            if(isset($_SESSION["department"]) &&  $_SESSION["department"]== "child"){
                echo "selected"; 
            }
            ?>value="child"> Child Care</option>
        </select>
    </p>
    <p> 
       <button type="submit" class="btn  btn-primary btn-lg btn-block">Register </button>
    </p>
 </form>
 </div>
    </div>
  </section>  

<?php include_once('lib/footer.php')  ?>