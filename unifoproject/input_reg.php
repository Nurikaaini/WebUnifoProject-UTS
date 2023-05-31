<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

if(isset($_POST['order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = ''. $_POST['street'] .' '. $_POST['city'] .' '. $_POST['state'] .' '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $placed_on = date('d-M-Y');

   $reg_univ_total = 0;
   $reg_univ_univ[] = '';

   $reg_univ_query = $conn->prepare("SELECT * FROM `reg_univ` WHERE user_id = ?");
   $reg_univ_query->execute([$user_id]);
   if($reg_univ_query->rowCount() > 0){
      while($reg_univ_item = $reg_univ_query->fetch(PDO::FETCH_ASSOC)){
         $reg_univ_univ[] = $reg_univ_item['name'].' ( '.$reg_univ_item['quantity'].' )';
         $sub_total = ($reg_univ_item['price'] * $reg_univ_item['quantity']);
         $reg_univ_total += $sub_total;
      };
   };

   $total_univ = implode(', ',$reg_univ_univ );

   $order_query = $conn->prepare("SELECT * FROM `reg` WHERE name = ? AND number = ? AND email = ? AND method = ? AND address = ? AND total_univ = ? AND total_price = ?");
   $order_query->execute([$name, $number, $email, $method, $address, $total_univ, $reg_univ_total]);

   if($reg_univ_total == 0){
      $message[] = 'your register is empty';
   }elseif($order_query->rowCount() > 0){
      $message[] = 'order placed already!';
   }else{
      $insert_order = $conn->prepare("INSERT INTO `reg`(user_id, name, number, email, method, address, total_univ, total_price, placed_on) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_univ, $reg_univ_total, $placed_on]);
      $delete_reg_univ = $conn->prepare("DELETE FROM `reg_univ` WHERE user_id = ?");
      $delete_reg_univ->execute([$user_id]);
      $message[] = 'order placed successfully!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>input_reg</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="display-orders">

   <?php
      $reg_univ_grand_total = 0;
      $select_reg_univ_items = $conn->prepare("SELECT * FROM `reg_univ` WHERE user_id = ?");
      $select_reg_univ_items->execute([$user_id]);
      if($select_reg_univ_items->rowCount() > 0){
         while($fetch_reg_univ_items = $select_reg_univ_items->fetch(PDO::FETCH_ASSOC)){
            $reg_univ_total_price = ($fetch_reg_univ_items['price'] * $fetch_reg_univ_items['quantity']);
            $reg_univ_grand_total += $reg_univ_total_price;
   ?>
   <p> <?= $fetch_reg_univ_items['name']; ?></p>
   <?php
    }
   }else{
      echo '<p class="empty">your register is empty!</p>';
   }
   ?>
   <div class="grand-total"><span><?= $reg_univ_grand_total; ?></span></div>
</section>

<section class="input_reg-orders">

   <form action="" method="POST">

      <h3>Input Data</h3>

      <div class="flex">
         <div class="inputBox">
            <span>Nama Lengkap :</span>
            <input type="text" name="name" placeholder="Masukkan nama lengkap" class="box" required>
         </div>
         <div class="inputBox">
            <span>No. Telp. :</span>
            <input type="number" name="number" placeholder="Masukkan nomor telpon" class="box" required>
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" placeholder="Masukkan email pribadi" class="box" required>
         </div>
         <div class="inputBox">
            <span>Jenis Kelamin :</span>
            <select name="method" class="box" required>
               <option value="Laki - Laki">Laki - Laki</option>
               <option value="Perempuan">Perempuan</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Alamat :</span>
            <input type="text" name="street" placeholder="Masukkan alamat lengkap" class="box" required>
         </div>
         <div class="inputBox">
            <span>Kecamatan :</span>
            <input type="text" name="city" placeholder="Masukkan nama kecamatan" class="box" required>
         </div>
         <div class="inputBox">
            <span>Kabupaten :</span>
            <input type="text" name="state" placeholder="Masukkan nama kabupaten" class="box" required>
         </div>
         <div class="inputBox">
            <span>Provinsi :</span>
            <input type="text" name="country" placeholder="Masukkan nama provinsi" class="box" required>
         </div>
         <div class="inputBox">
            <span>Kode Pos :</span>
            <input type="number" min="0" name="pin_code" placeholder="Masukkan kode pos daerah " class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn <?= ($reg_univ_grand_total > 0)?'' : 'disabled'; ?>" value="place order">

   </form>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>