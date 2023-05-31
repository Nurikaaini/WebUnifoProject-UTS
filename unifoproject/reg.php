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
   <title>list registration</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Status Registrasi</h1>

   <div class="box-container">

   <?php
      $select_reg = $conn->prepare("SELECT * FROM `reg` WHERE user_id = ?");
      $select_reg->execute([$user_id]);
      if($select_reg->rowCount() > 0){
         while($fetch_reg = $select_reg->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> Tanggal Registrasi : <span><?= $fetch_reg['placed_on']; ?></span> </p>
      <p> Nama : <span><?= $fetch_reg['name']; ?></span> </p>
      <p> No. Telp. : <span><?= $fetch_reg['number']; ?></span> </p>
      <p> Email : <span><?= $fetch_reg['email']; ?></span> </p>
      <p> Jenis Kelamin : <span><?= $fetch_reg['method']; ?></span> </p>
      <p> Alamat : <span><?= $fetch_reg['address']; ?></span> </p>
      <p> Universitas : <span><?= $fetch_reg['total_univ']; ?></span> </p>
      <p> Status Registrasi : <span style="color:<?php if($fetch_reg['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_reg['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no transaction placed yet!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>