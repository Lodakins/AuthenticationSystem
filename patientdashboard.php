<?php 
 session_start();
 require_once("lib/alert.php");
 require_once("lib/validate.php");
 if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){
     header("Location:login.php");
 }
include_once('lib/header.php') 
 
 ?>

<p> <?php  printValidationStatus();  ?> </p>
<p> <?php  printAlert1();  ?> </p>
<p> <?php printAlert();   ?> </p>
<h2> Dashboard </h2>
<p> Welcome, <?php echo $_SESSION['fullname'];   ?> You are logged in as (<?php echo $_SESSION['role']; ?>) and your ID is <?php  echo $_SESSION['loggedin'];?></p>
<p> User Level Access: <?php  echo  $_SESSION['role']   ?></p> </p>
<p> Departmemt: <?php  echo  $_SESSION['department'];   ?></p>
<p> Date of Registration:  <?php  echo  $_SESSION['dob'];   ?></p> </p>
<p> Date of Last Login:  <?php echo  $_SESSION['lastlogin'];   ?></p> </p>
<p><strong> For any appointment, there is charge of #3000, you make payment after booking an appointment, unless you will not be attended to.<strong></p>
<p> 
   
    <ul>
    <li> <button type="button" id="showPayment">Pay Bill</button></li>
        <li> <a href="#" id="bookappointment"><button class="btn btn-primary"> Book Appointment</button> </a></li>
    </ul>    
 </p>

 <div id="paymentContainer" class="hide mb-3"> 
 <h3 class="text-center"> PAY  </h3>
 <section class="container">
    <div class="row">
    <input type="hidden" id="email" value="<?php echo  $_SESSION['email'] ?>" />
        <p>
        <select id="department" class="form-control" required>
            <option>--SELECT--</option>
            <option value="laboratory"> Laboratory</option>
            <option value="pharmacy"> Pharmacy</option>
            <option value="child"> Child Care</option>
            <option value="icu"> Intensive Care Unit</option>
        </select>
        
        </p>
        <p>
        <button type="button" id="showPayment"onClick="payWithRave()">Pay Bill</button>
        </p>
    </div>
 </section>
 </div>

<div id="appointmentContainer" class="hide mb-3"> 
 <h3 class="text-center"> BOOK APPOINTMENT </h3>
 <section class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">
            <form action="processappointment.php" method="POST" class="formContainer">
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
        type="text" name="date_of_appointment" placeholder="date_of_appointment" id="date_of_appointment" class="form-control" required>
    </p>
    <p>
        <label> Time of Appointment</label> <br/>
        <input  <?php 
            if(isset($_SESSION["time_of_appointment"])){
                echo 'value='.$_SESSION["time_of_appointment"]; 
            }
            ?>
             type="text" name="time_of_appointment" placeholder="time_of_appointment" id="time_of_appointment" class="form-control" required>
    </p>
    <p>
        <label> Nature of Appointment</label> <br/>
        <input  <?php 
            if(isset($_SESSION["nature_of_appointment"])){
                echo 'value='.$_SESSION["nature_of_appointment"]; 
            }
            ?>
         type="text" name="nature_of_appointment" placeholder="nature_of_appointment" class="form-control" required>
    </p>
    <p>
        <label> Initial Complaint</label> <br/>
        <textarea cols="35" rows="12" name="initcomplaint" id="para1" class="form-control" placeholder="initial_complaint" required>
        <?php 
            if(isset($_SESSION["initcomplaint"])){
                echo $_SESSION["initcomplaint"]; 
            }
            ?>
        </textarea>
    </p>
    <p>
    <label> Department </label><br/>
        <select name="depart" class="form-control" required>
            <option>--SELECT--</option>
            <option 
            <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "laboratory"){
                echo "selected"; 
            }
            ?> value="laboratory"> Laboratory</option>
            <option <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "icu"){
                echo "selected"; 
            }
            ?>value="icu"> Intensive Care Unit</option>
            <option <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "pharmacy"){
                echo "selected"; 
            }
            ?>value="pharmacy"> Pharmacy</option>
            <option <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "child"){
                echo "selected"; 
            }
            ?>value="child"> Child Care</option>
        </select>
    </p>
    <p>
        <button  type="submit" class="btn  btn-primary btn-lg btn-block"> Submit </button>
    </p>
 </form>
 </div>

<?php include_once('lib/footer.php')  ?>
<script src="js/patient.js"></script>
<script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script>
    const API_publicKey = "FLWPUBK-b234fe6f65db7ac3cad8687028818f95-X";
    function generateRandomText(){
    let txref = "txref_";
    for ($i = 0; $i < 7; $i++) {
        txref += Math.round(Math.random() * 10);
    }
    return txref;
  }
    function payWithRave() {
        let email= document.querySelector('#email').value;
        let department = document.querySelector('#department').value;
        let ref=generateRandomText();
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: email,
            amount: 3000,
            customer_phone: "234099940409",
            currency: "NGN",
            payment_options: "card,account",
            txref: ref,
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                var txref = response.tx.txRef; // collect flwRef returned and pass to a server page to complete status check.
                console.log(txref);
                console.log(ref);
                console.log(department);
                console.log(email);
                console.log("This is the response returned after a charge", response);
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    console.log("Here ooo");
                    if(txref===ref){
                        console.log("Here ooo  1");
                     window.location.href="processtransaction.php?txref="+txref+"&date="+response.tx.updatedAt+"&amount="
                                     +response.tx.amount+"&type="+response.tx.paymentType+"&status="+response.tx.status+"&department="+department;
                    }else{
                        Console.log("Error txref is nnull")
                    }
                } else {
                    console.log("Invalid Transcation");
                    // redirect to a failure page.
                    // window.location.href="processtransaction.php?txref="+txref+"&date="+response.tx.updatedAt+"&amount="
                    //                 +response.tx.amount+"&type="+response.tx.paymentType+"&status="+response.tx.status+"&department="+department;
                }

                x.close(); // use this to close the modal immediately after payment.
            }
        });
    }
</script>
</body>
</html>
