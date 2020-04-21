<?php 
 session_start();
 require_once("lib/alert.php");
 require_once("lib/validate.php");
include_once('lib/header.php')


?>
  <header>
    <p> Welcome, Please register, All fields (*) are compulsory</p>
  </header>  
 <form method="POST" action="processregistartion.php">
     <p><?php

           printAlert();
         if(isset($_SESSION['emailerror']) && !empty($_SESSION['emailerror'])){
            echo '<span style="color:red">' . $_SESSION['emailerror'] . ' </span> <br/>';
                if(session_id()){
                session_destroy();
                 }
         } 
         if(isset($_SESSION['nameerror']) && !empty($_SESSION['nameerror'])){
            echo '<span style="color:red">' .$_SESSION['nameerror'] . ' </span> <br/>';  
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
                if(session_set("first_name")){
                    echo "value=" . $_SESSION['first_name'];
                }
         ?>
        type="text" name="first_name" placeholder="First Name" required />
    </p>
    <p> 
        <label> Last Name</label><br/>
        <input 
        <?php
                if(session_set("last_name")){
                    echo "value=" . $_SESSION['last_name'];
                }
         ?>
        type="text" name="last_name" placeholder="Surname"  required/>
    </p>
    <p> 
        <label> Email </label><br/>
        <input
        <?php
                if(isset($_SESSION['email'])){
                    echo "value=" . $_SESSION['email'];
                }
         ?>
        type="text" name="email" placeholder="polarisd@ii.com" required />
    </p>
    <p> 
        <label> Password</label><br/>
        <input  type="password" name="password" placeholder="Password"  required />
    </p>
    <p> 
        <label> Gender</label><br/>
       <select name="gender" required>
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
       <select name="designation" required>
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
        <select name="department">
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
       <button type="submit">Register </button>
    </p>
 </form>

<?php include_once('lib/footer.php')  ?>