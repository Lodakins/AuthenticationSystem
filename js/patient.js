$(document).ready(function(){
    
$('#date_of_appointment').datepicker({format:'yyyy-mm-dd',uiLibrary: 'bootstrap4', iconsLibrary: 'fontawesome'});

$('#time_of_appointment').timepicker();
$('#time_of_appointment').on('click',function(){
$('#time_of_appointment').timepicker('setTime', new Date());
})
$('#bookappointment').on('click',function(e){
    e.preventDefault();
    $('#appointmentContainer').show();
    $('#paymentContainer').hide();

})

$('#showPayment').on('click',function(e){
    e.preventDefault();
    $('#appointmentContainer').hide();
    $('#paymentContainer').show();
})

function generateRandomText(){
    let txref = "txref_";
    for ($i = 0; $i < 7; $i++) {
        txref += Math.random(0, 6);
    }
    return txref;
  }


});