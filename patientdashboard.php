<?php 
 session_start();
 require_once("lib/alert.php");
 require_once("lib/validate.php");
 require_once('lib/transactions.php');
 if(!isset($_SESSION['loggedin']) && empty($_SESSION['loggedin'])){
     header("Location:login.php");
 }
include_once('lib/header.php') 
 
 ?>

<p> <?php  printValidationStatus();  ?> </p>
<p> <?php  printAlert1();  ?> </p>
<p> <?php printAlert();   ?> </p>
<h2> Dashboard </h2>
<p class="mb-3"><strong> For any appointment, there is charge of #3000, you make payment after booking an appointment, unless you will not be attended to.<strong></p>
<p> 
    <ul>
    <li> <button type="button" id="showPayment" class="bg">Pay Bill</button></li>
    <li> <a href="#" id="bookappointment"><button class="btn btn-primary"> Book Appointment</button> </a></li>
    <li> <a href="#transactions" ><button type="button" id="showPayment" class="bg1"> View Transactions</button></a> </li>
    </ul>    
 </p>
<p> Welcome, <?php echo $_SESSION['fullname'];   ?> You are logged in as (<?php echo $_SESSION['role']; ?>) and your ID is <?php  echo $_SESSION['loggedin'];?></p>
<p><span class="label">User Level Access:</span>  <?php  echo  $_SESSION['role']   ?></p> </p>
<p><span class="label">Departmemt:</span>  <?php  echo  $_SESSION['department'];   ?></p>
<p><span class="label">Date of Registration: </span>  <?php  echo  $_SESSION['dob'];   ?></p> </p>
<p><span class="label">Date of Last Login:</span>   <?php echo  $_SESSION['lastlogin'];   ?></p> </p>
<!-- onClick="payWithRave()" -->



 <div id="paymentContainer" class="hide mb-3"> 
 <h3 class="text-center"> MAKE PAYMENT  </h3>
 <section class="container mb-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="row">
                    <div class="col-md-12">
                    <input type="hidden" id="email" value="<?php echo  $_SESSION['email'] ?>" />
                    <label> Department </label>
                    <select id="department" class="form-control" required>
                        <option>--SELECT--</option>
                        <option value="laboratory"> Laboratory</option>
                        <option value="pharmacy"> Pharmacy</option>
                        <option value="child"> Child Care</option>
                        <option value="icu"> Intensive Care Unit</option>
                    </select>
                </div>
                <div class="col-md-12 mt-2">
                    <button type="button" id="paymenButton" class="btn btn-primary form-control">Pay Bill</button>
                </div>
            </div>
        </div>       
    </div>
 </section>
 </div>

<div id="appointmentContainer" class="hide mb-3"> 
 <h3 class="text-center"> BOOK APPOINTMENT </h3>
 <section class="container">
        <form action="processappointment.php" method="POST" class="row formContainer">
        <p class="col-md-12">
         <input type="hidden" name="email" value=<?php echo $_SESSION['email'] ?> />
     </p>
    <p class="col-md-6">
        <label> Date of Appointment</label> <br/>
        <input <?php 
            if(isset($_SESSION["date_of_appointment"])){
                echo 'value='.$_SESSION["date_of_appointment"]; 
            }
            ?>
        type="text" name="date_of_appointment" placeholder="date_of_appointment" id="date_of_appointment" class="form-control" required>
    </p>
    <p class="col-md-6">
        <label> Time of Appointment</label> <br/>
        <input  <?php 
            if(isset($_SESSION["time_of_appointment"])){
                echo 'value='.$_SESSION["time_of_appointment"]; 
            }
            ?>
             type="text" name="time_of_appointment" placeholder="time_of_appointment" id="time_of_appointment" class="form-control" required>
    </p>
    <p class="col-md-6">
        <label> Nature of Appointment</label> <br/>
        <input  <?php 
            if(isset($_SESSION["nature_of_appointment"])){
                echo 'value='.$_SESSION["nature_of_appointment"]; 
            }
            ?>
         type="text" name="nature_of_appointment" placeholder="nature_of_appointment" class="form-control" required>
    </p>
    
    <p class="col-md-6">
    <label> Department </label><br/>
        <select name="depart" class="form-control" required>
            <option>--SELECT--</option>
            <option 
            <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "laboratory"){
                echo "selected "; 
            }
            ?> value="laboratory"> Laboratory</option>
            <option <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "icu"){
                echo "selected "; 
            }
            ?>value="icu"> Intensive Care Unit</option>
            <option <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "pharmacy"){
                echo "selected "; 
            }
            ?>value="pharmacy"> Pharmacy</option>
            <option <?php 
            if(isset($_SESSION["depart"]) &&  $_SESSION["depart"]== "child"){
                echo "selected "; 
            }
            ?>value="child"> Child Care</option>
        </select>
    </p>
    <p class="col-md-12">
        <label> Initial Complaint</label> <br/>
        <textarea cols="20" rows="7" name="initcomplaint" id="para1" class="form-control" placeholder="initial_complaint" required>
        <?php 
            if(isset($_SESSION["initcomplaint"])){
                echo $_SESSION["initcomplaint"]; 
            }
            ?>
        </textarea>
    </p>
    <p class="col-md-4 mx-auto">
        <button  type="submit" class="btn  btn-primary btn-lg btn-block"> Submit </button>
    </p>
 </form>
</div>
</section>
</div>


<h3 class="text-center mb-3" id="transactions"> ALL TRANSACTIONS</h3>
 <section class="container-fluid">
    <div class="row">
        <div class="col-md-11 mx-auto">
<?php 
    $email=$_SESSION['email'];
    printTransaction($email);
?>
</div>
    </div>
</section>
 






<?php include_once('lib/footer.php')  ?>
<script src="js/patient.js"></script>
<script type="text/javascript" src="https://ravesandboxapi.flutterwave.com/flwv3-pug/getpaidx/api/flwpbf-inline.js"></script>
<script>

    let button = document.querySelector('#paymenButton');
    button.addEventListener('click',function(e){
        e.preventDefault();
        let email= document.querySelector('#email').value;
        let department = document.querySelector('#department').value;
        if(email==="" || department===""){
            alert("Fields cannot be empty");
            return;
        }else{
            $.ajax({
                url:"checkAppointment.php",
                method:"POST",
                data:{
                    dept:department,
                    email:email
                },
                success:function(res){
                    if(res==="true"){
                        payWithRave()
                    }else{
                        console.log("here in false ooo");
                        location.reload();
                    }


                },error:function(err){
                        console.log("Error ooooooo");
                }
            })
        }
    });
    
    function generateRandomText(){
        let txref = "txref_";
        for ($i = 0; $i < 7; $i++) {
            txref += Math.round(Math.random() * 10);
        }
        return txref;
    }

    function payWithRave() {
        const API_publicKey = "FLWPUBK-b234fe6f65db7ac3cad8687028818f95-X";
        let ref=generateRandomText();
        let email= document.querySelector('#email').value;
        let department = document.querySelector('#department').value;
        var x = getpaidSetup({
            PBFPubKey: API_publicKey,
            customer_email: email,
            amount:3000,
            customer_phone: "234099940409",
            currency: "NGN",
            payment_options: "card",
            txref: ref,
            meta: [{
                metaname: "flightID",
                metavalue: "AP1234"
            }],
            onclose: function() {},
            callback: function(response) {
                x.close();
                console.log(response);
                var txref = response.tx.txRef; // collect flwRef returned and pass to a server page to complete status check.
                if (
                    response.tx.chargeResponseCode == "00" ||
                    response.tx.chargeResponseCode == "0"
                ) {
                    if(txref===ref){    
                     window.location.href="processtransaction.php?txref="+txref+"&date="+response.tx.updatedAt+"&amount="
                                     +response.tx.amount+"&type="+response.tx.paymentType+"&status="+response.tx.status+"&department="+department;
                    }else{
                        window.location.href="processerror.php?txref="+txref+"&date="+response.tx.updatedAt+"&amount="
                                     +response.tx.amount+"&type="+response.tx.paymentType+"&status="+response.tx.status+"&department="+department;
                    }
                } else {
                    window.location.href="processtransaction.php?txref="+txref+"&date="+response.tx.updatedAt+"&amount="
                                    +response.tx.amount+"&type="+response.tx.paymentType+"&status="+response.tx.status+"&department="+department;
                }

                 // use this to close the modal immediately after payment.
            }
        });
    }
</script>
</body>
</html>
