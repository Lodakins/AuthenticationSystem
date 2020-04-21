<?php session_start();
require_once("lib/alert.php");
require_once('lib/user.php');
loggedin();


include_once('lib/header.php')  ?>
  <header>
    <h3 class="text-center"> WELCOME TO SNG HOSPITAL </h3>
  </header>  
<section class="container mt-1">
  <div class="row">
    <div class="col-md-12"> 
    <p> Welcome to sng hospital, where you can treat Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut iusto, repudiandae hic voluptatem commodi praesentium. Vero tenetur corporis, blanditiis enim quidem dolores sapiente, voluptatum natus expedita repudiandae, minus quaerat temporibus!</p>
    </div>
  </div>
</section>
<?php include_once('lib/footer.php')  ?>