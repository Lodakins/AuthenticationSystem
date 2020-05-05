<?php
require_once("lib/email.php");
function saveAppointment($email,$department,$appointment){
    try{
        $allAppointment = scandir("db/appointment/".$department);
        $countAppointment = count($allAppointment);
        for($counter=0; $counter < $countAppointment; $counter++){ 
            if($allAppointment[$counter] == $email .".json"){
                setAlert1("error","you already have an appointment");
                 redirect("patientdashboard.php");
                 die();
            }
        }
         file_put_contents("db/appointment/".$department."/" . $email . ".json",json_encode($appointment));
         setAlert1("message","Booking of appointment was successfull");
         redirect("patientdashboard.php");
         die(); 
    }catch( Exception $e){
        setAlert1("error","something went wrong");
        redirect("patientdashboard.php");
        die();
    }
   
};


function viewAppointment($department){

    try{
        $allAppointment = scandir("db/appointment/".$department);
        $countAppointment = count($allAppointment);
        if($countAppointment > 2){
            echo '<table class="table table-striped"> <thead class="thead-dark"><tr><th> Patient Name</th><th> Date of Appointment</th><th>
            Time of Appointment</th> <th> Nature of Appointment</th> <th> Initial Complaint</th><th> Payment Status</th>
            </tr></thead><tbody>';
           for($counter=2; $counter <$countAppointment; $counter++){ 
               $file = file_get_contents("db/appointment/".$department."/". $allAppointment[$counter]);
              $appointmentObject = json_decode($file);
              echo "<tr><td>".$appointmentObject->patient_name."</td>
              <td>".$appointmentObject->date_of_appointment."</td>
              <td>".$appointmentObject->time_of_appointment."</td>
              <td>".$appointmentObject->nature_of_appointment."</td>
              <td>".$appointmentObject->initcomplaint."</td>
              <td>".$appointmentObject->payment."</td></tr>";
           }
           echo "</tbody></table>";
        }else{
            echo '<p style="background-color:green;color:white; padding: 20px;"> You have no appointment.. </p>';
        }
       
    }catch( Exception $e){
        setAlert1("error","something went wrong");
        redirect("medicaldashboard.php");
        die();
    }

}

function updateAppointment($email,$department){
    try{
        $allAppointment = scandir("db/appointment/".$department);
        $countAppointment = count($allAppointment);
        for($counter=0; $counter < $countAppointment; $counter++){ 
            if($allAppointment[$counter] == $email .".json"){
                $file = file_get_contents("db/appointment/".$department."/". $allAppointment[$counter]);
                $appointmentObject = json_decode($file);
                $appointmentObject->payment="paid";
                    unlink("db/appointment/".$department."/". $email .".json");
                   file_put_contents("db/appointment/".$department."/" . $email . ".json",json_encode($appointmentObject));
                     $subject="Payment Successfull";
                    $message="Your payment was successfull, you can now visit the department at your appointment time";
                    send_mail($subject,$message,$email);
            }
        }

        }catch( Exception $e){
            setAlert1("error","something went wrong");
            redirect("patientdashboard.php");
            die();
        }
  }

?>