$(document).ready(function(){


$.ajax({
    url:"appointentAjax.php",
    method:"POST",
    data:{
        user:"Lolade"
    },success:function(res){
        console.log(res);
    },error(err){
        console.log(err);
    }
    
})

$('#date_of_appointment').datepicker({format:'yyyy-mm-dd',uiLibrary: 'bootstrap4', iconsLibrary: 'fontawesome'});

$('#time_of_appointment').timepicker();
$('#time_of_appointment').on('click',function(){
    $('#time_of_appointment').timepicker('setTime', new Date());
})
$('#bookappointment').on('click',function(e){
    e.preventDefault();
    $('#appointmentContainer').toggle();
})



});