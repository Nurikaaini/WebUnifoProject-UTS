<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>University Information</span>
         <h3>Let's Find Your Future University</h3>
         <p>UNIFO atau University Information merupakan sebuah situs web yang menyediakan informasi pendaftaran PTN dan PTS </p>
         <a href="about.php" class="btn">About us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">University Category</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pts.png" alt="">
         <h3>PTS</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=PTS" class="btn">PTS</a>
      </div>

      <div class="box">
         <img src="images//ptn.png" alt="">
         <h3>PTN</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=PTN" class="btn">PTN</a>
      </div>

   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>