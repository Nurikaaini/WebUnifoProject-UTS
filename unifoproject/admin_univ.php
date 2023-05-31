<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:index.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_univ = $conn->prepare("SELECT * FROM `univ` WHERE name = ?");
   $select_univ->execute([$name]);

   if($select_univ->rowCount() > 0){
      $message[] = 'product name already exist!';
   }else{

      $insert_univ = $conn->prepare("INSERT INTO `univ`(name, category, details, price, image) VALUES(?,?,?,?,?)");
      $insert_univ->execute([$name, $category, $details, $price, $image]);

      if($insert_univ){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'new product added!';
         }

      }

   }

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `univ` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   $delete_univ = $conn->prepare("DELETE FROM `univ` WHERE id = ?");
   $delete_univ->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   $delete_reg_univ = $conn->prepare("DELETE FROM `reg_univ` WHERE pid = ?");
   $delete_reg_univ->execute([$delete_id]);
   header('location:admin_univ.php');


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>university</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-univ">

   <h1 class="title">add new product</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="Masukkan Nama Instansi">
         <select name="category" class="box" required>
            <option value="" selected disabled>Pilih Category</option>
               <option value="PTS">PTS</option>
               <option value="PTN">PTN</option>
         </select>
         </div>
         <div class="inputBox">
         <input type="number" min="0" name="price" class="box" required placeholder="Masukkan id">
         <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
         </div>
      </div>
      <textarea name="details" class="box" required placeholder="Masukkan Deskripsi" cols="30" rows="10"></textarea>
      <input type="submit" class="btn" value="add product" name="add_product">
   </form>

</section>

<section class="show-univ">

   <h1 class="title">university added</h1>

   <div class="box-container">

   <?php
      $show_univ = $conn->prepare("SELECT * FROM `univ`");
      $show_univ->execute();
      if($show_univ->rowCount() > 0){
         while($fetch_univ = $show_univ->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box">
      <img src="uploaded_img/<?= $fetch_univ['image']; ?>" alt="">
      <div class="name"><?= $fetch_univ['name']; ?></div>
      <div class="cat"><?= $fetch_univ['category']; ?></div>
      <div class="details"><?= $fetch_univ['details']; ?></div>
      <div class="flex-btn">
         <a href="admin_update_univ.php?update=<?= $fetch_univ['id']; ?>" class="option-btn">update</a>
         <a href="admin_univ.php?delete=<?= $fetch_univ['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">now university added yet!</p>';
   }
   ?>

   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>