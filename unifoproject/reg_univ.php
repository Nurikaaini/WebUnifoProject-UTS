<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:index.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_reg_univ_item = $conn->prepare("DELETE FROM `reg_univ` WHERE id = ?");
   $delete_reg_univ_item->execute([$delete_id]);
   header('location:reg_univ.php');
}

if(isset($_GET['delete_all'])){
   $delete_reg_univ_item = $conn->prepare("DELETE FROM `reg_univ` WHERE user_id = ?");
   $delete_reg_univ_item->execute([$user_id]);
   header('location:reg_univ.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-reg_univ">

   <h1 class="title">added</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_reg_univ = $conn->prepare("SELECT * FROM `reg_univ` WHERE user_id = ?");
      $select_reg_univ->execute([$user_id]);
      if($select_reg_univ->rowCount() > 0){
         while($fetch_reg_univ = $select_reg_univ->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="reg_univ.php?delete=<?= $fetch_reg_univ['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from list registration?');"></a>
      <a href="view_page.php?pid=<?= $fetch_reg_univ['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_reg_univ['image']; ?>" alt="">
      <div class="name"><?= $fetch_reg_univ['name']; ?></div>
      <div class="price"><?= $fetch_reg_univ['price']; ?></div>
      <input type="hidden" name="reg_univ_id" value="<?= $fetch_reg_univ['id']; ?>">
      <div class="sub-total"><span><?= $sub_total = ($fetch_reg_univ['price'] * $fetch_reg_univ['quantity']); ?></span> </div>
   </form>
   <?php
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your list registration is empty</p>';
   }
   ?>
   </div>

   <div class="reg_univ-total">
      <p><span><?= $grand_total; ?></span></p>
      <a href="university.php" class="option-btn">continue finding</a>
      <a href="reg_univ.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
      <a href="input_reg.php" class="btn <?= ($grand_total > 0)?'':'disabled'; ?>">proceed to input registration</a>
   </div>

</section>








<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>