<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="reviews">

   <h1 class="title">About Us</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/logo.png" alt="">
         <p>UNIFO atau University Information merupakan sebuah situs web yang menyediakan informasi pendaftaran PTN dan PTS</p>
         <div class="stars">
            <i class="fas fa-star"></i>
         </div>
         <h3>UNIFO</h3>
      </div>
   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>