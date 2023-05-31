<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->execute([$p_name, $user_id]);

   $check_reg_univ_numbers = $conn->prepare("SELECT * FROM `reg_univ` WHERE name = ? AND user_id = ?");
   $check_reg_univ_numbers->execute([$p_name, $user_id]);

   if($check_wishlist_numbers->rowCount() > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_reg_univ_numbers->rowCount() > 0){
      $message[] = 'already added to register!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->execute([$user_id, $pid, $p_name, $p_price, $p_image]);
      $message[] = 'added to wishlist!';
   }

}

if(isset($_POST['add_to_reg_univ'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_reg_univ_numbers = $conn->prepare("SELECT * FROM `reg_univ` WHERE name = ? AND user_id = ?");
   $check_reg_univ_numbers->execute([$p_name, $user_id]);

   if($check_reg_univ_numbers->rowCount() > 0){
      $message[] = 'already added to register!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->execute([$p_name, $user_id]);

      if($check_wishlist_numbers->rowCount() > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->execute([$p_name, $user_id]);
      }

      $insert_reg_univ = $conn->prepare("INSERT INTO `reg_univ`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_reg_univ->execute([$user_id, $pid, $p_name, $p_price, $p_qty, $p_image]);
      $message[] = 'added to register!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="univ">

   <h1 class="title">university categories</h1>

   <div class="box-container">

   <?php
      $category_name = $_GET['category'];
      $select_univ = $conn->prepare("SELECT * FROM `univ` WHERE category = ?");
      $select_univ->execute([$category_name]);
      if($select_univ->rowCount() > 0){
         while($fetch_univ = $select_univ->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" class="box" method="POST">
      <a href="view_page.php?pid=<?= $fetch_univ['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_univ['image']; ?>" alt="">
      <div class="name"><?= $fetch_univ['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_univ['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_univ['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_univ['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_univ['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="add to register" class="btn" name="add_to_reg_univ">
   </form>
   <?php
         }
      }else{
         echo '<p class="empty">no university available!</p>';
      }
   ?>

   </div>

</section>


<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>