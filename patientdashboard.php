<?php 
 session_start();
 require_once("lib/alert.php");
 if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){
     header("Location:login.php");
 }
include_once('lib/header.php') 
 
 ?>
<p> <?php printAlert1();   ?> </p>
<h2> Dashboard </h2>
<p> Welcome, <?php echo $_SESSION['fullname'];   ?> You are logged in as (<?php echo $_SESSION['role']; ?>) and your ID is <?php  echo $_SESSION['loggedin'];?></p>
<p> User Level Access: <?php  echo  $_SESSION['role']   ?></p> </p>
<p> Departmemt: <?php  echo  $_SESSION['department'];   ?></p>
<p> Date of Registration:  <?php  echo  $_SESSION['dob'];   ?></p> </p>
<p> Date of Last Login:  <?php echo  $_SESSION['lastlogin'];   ?></p> </p>
<p> <a href="#"> PayBill</a> </p>
<p> <a href="#" id="bookappointment"> Book Appointment </a> </p>
<div id="appointmentContainer" class="hide"> 
 <h1> BOOK APPOINTMENT </h1>
 <form action="processappointment.php" method="POST">
 <p>
         <input type="hidden" name="name" value=<?php echo  $_SESSION['fullname'] ?> />
     </p>
     <p>
         <input type="hidden" name="email" value=<?php echo $_SESSION['email'] ?> />
     </p>
    <p>
        <label> Date of Appointment</label> <br/>
        <input <?php 
            if(isset($_SESSION["date_of_appointment"])){
                echo 'value='.$_SESSION["date_of_appointment"]; 
            }
            ?>
        type="text" name="date_of_appointment" placeholder="date_of_appointment" id="date_of_appointment" required>
    </p>
    <p>
        <label> Time of Appointment</label> <br/>
        <input  <?php 
            if(isset($_SESSION["time_of_appointment"])){
                echo 'value='.$_SESSION["time_of_appointment"]; 
            }
            ?>
             type="text" name="time_of_appointment" placeholder="time_of_appointment" id="time_of_appointment" required>
    </p>
    <p>
        <label> Nature of Appointment</label> <br/>
        <input  <?php 
            if(isset($_SESSION["nature_of_appointment"])){
                echo 'value='.$_SESSION["nature_of_appointment"]; 
            }
            ?>
         type="text" name="nature_of_appointment" placeholder="nature_of_appointment" required>
    </p>
    <p>
        <label> Initial Complaint</label> <br/>
        <input  <?php 
            if(isset($_SESSION["initcomplaint"])){
                echo 'value='.$_SESSION["initcomplaint"]; 
            }
            ?>
        type="text" name="initcomplaint" placeholder="initial_complaint" required>
    </p>
    <p>
        <label> Department </label><br/>
        <select name="department" required>
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
        <button  type="submit"> Submit </button>
    </p>
 </form>
 </div>

<?php include_once('lib/footer.php')  ?>
<script src="js/patient.js"></script>
</body>
</html>
