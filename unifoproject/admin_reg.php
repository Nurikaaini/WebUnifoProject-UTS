<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_reg = $conn->prepare("UPDATE `reg` SET payment_status = ? WHERE id = ?");
   $update_reg->execute([$update_payment, $order_id]);
   $message[] = 'status has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_reg = $conn->prepare("DELETE FROM `reg` WHERE id = ?");
   $delete_reg->execute([$delete_id]);
   header('location:admin_reg.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>reg</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed registration</h1>

   <div class="box-container">

      <?php
         $select_reg = $conn->prepare("SELECT * FROM `reg`");
         $select_reg->execute();
         if($select_reg->rowCount() > 0){
            while($fetch_reg = $select_reg->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <p> user id : <span><?= $fetch_reg['user_id']; ?></span> </p>
         <p> Tanggal Registrasi : <span><?= $fetch_reg['placed_on']; ?></span> </p>
         <p> Nama : <span><?= $fetch_reg['name']; ?></span> </p>
         <p> Email : <span><?= $fetch_reg['email']; ?></span> </p>
         <p> No. Telp. : <span><?= $fetch_reg['number']; ?></span> </p>
         <p> Alamat : <span><?= $fetch_reg['address']; ?></span> </p>
         <p> Universitas : <span><?= $fetch_reg['total_univ']; ?></span> </p>
         <p> Jenis Kelamin : <span><?= $fetch_reg['method']; ?></span> </p>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_reg['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $fetch_reg['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="update">
               <a href="admin_reg.php?delete=<?= $fetch_reg['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no registration placed yet!</p>';
      }
      ?>

   </div>

</section>












<script src="js/script.js"></script>

</body>
</html>