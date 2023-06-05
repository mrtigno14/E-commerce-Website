<?php

@include 'config-login.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:Login Page.php');
}

?>

<?php

@include 'config.php';

if(isset($_POST['add_product'])){
   $p_name = $_POST['p_name'];
   $p_price = $_POST['p_price'];
   $p_image = $_FILES['p_image']['name'];
   $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $insert_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES('$p_name', '$p_price', '$p_image')") or die('query failed'); /*insert to product table*/

   if($insert_query){
      move_uploaded_file($p_image_tmp_name, $p_image_folder);
      
   }else{
      
   }
};


if(isset($_GET['delete']))/*executes a delete query to remove a product*/{
   $delete_id = $_GET['delete'];
   $delete_query = mysqli_query($conn, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
   if($delete_query){
      header('location:admin.php');
      
   }else{
      header('location:admin.php');
      
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_image = $_FILES['update_p_image']['name'];
   $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $update_query = mysqli_query($conn, "UPDATE `products` SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");

   if($update_query){
      move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
      
      header('location:admin.php');
   }else{
      
      header('location:admin.php');
   }

}

?>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RELX NOVELTY | Admin Panel</title>
    <link rel = "shortcut icon" href="" type="image/X-UA-Compatible">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">


    <style>
        *{
            box-sizing: border-box;
            font-family: 'poppins',sans-serif;
        }

        body{
            background-color: #8A9EA0;
            margin: 0;
        }
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #f1f1f1;
}
::-webkit-scrollbar-thumb {
    background: #888;
}
::selection{
  background: rgb(0,123,255,0.3);
}
.content{
  max-width: 1250px;
  margin: auto;
  padding: 0 30px;
}
.navbar{
  position: fixed;
  width: 100%;
  z-index: 2;
  padding: 25px 0;
  transition: all 0.3s ease;
}
.navbar.sticky{
  background: #DFDBD0;
  padding: 10px 0;
  box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.1);
}
.navbar .content{
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.navbar .logo a{
  color: black;
  font-size: 30px;
  font-weight: 600;
  text-decoration: none;
}
.navbar .menu-list{
  display: inline-flex;
}
.menu-list li{
  list-style: none;
}
.menu-list li a{
  color: black;
  font-size: 18px;
  font-weight: 500;
  margin-left: 25px;
  text-decoration: none;
  transition: all 0.3s ease;
}
.menu-list li a:hover{
  color: red;
}
.about{
  padding: 30px 0;
  font-size: 25px;
  text-align: justify;
}
.about .title{
  font-size: 38px;
  font-weight: 700;
}
.about p{
  padding-top: 20px;
  text-align: justify;
}
.icon{
  color: black;
  font-size: 20px;
  cursor: pointer;
  display: none;
}
.menu-list .cancel-btn{
  position: absolute;
  right: 30px;
  top: 20px;
}
@media (max-width: 1230px) {
  .content{
    padding: 0 60px;
  }
}
@media (max-width: 1100px) {
  .content{
    padding: 0 40px;
  }
}
@media (max-width: 900px) {
  .content{
    padding: 0 30px;
  }
}
@media (max-width: 1230px) {
  body.disabled{
    overflow: hidden;
  }
  .icon{
    display: block;
  }
  .icon.hide{
    display: none;
  }
  .navbar .menu-list{
    position: fixed;
    height: 100vh;
    width: 100%;
    max-width: 400px;
    left: -100%;
    top: 0px;
    display: block;
    padding: 40px 0;
    text-align: center;
    background: #DFDBD0;
    transition: all 0.3s ease;
  }
  .navbar.show .menu-list{
    left: 0%;
  }
  .navbar .menu-list li{
    margin-top: 45px;
  }
  .navbar .menu-list li a{
    font-size: 23px;
    margin-left: -100%;
    transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
  }
  .navbar.show .menu-list li a{
    margin-left: 0px;
  }
}
@media (max-width: 380px) {
  .navbar .logo a{
    font-size: 27px;
  }
}

        nav {
            background: #DFDBD0;
            padding: 10px 0;
            box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.1);
        }

        nav a {
            display: inline-block;
            text-decoration: none;
            padding: 5px 15px;
            font-size: 0.5cm;
            color: black;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.1cm;
        }

        nav a:hover {
            color: red;
        }

        main{
            padding: 100px;
            color: black;

        }

        .button{
           height: 45px;
           width: 100%;
           margin: 35px 0;
           text-align: center;
         }
         .button input{
           height: 100%;
           width: 33%;
           border-radius: 23px;
           border: none;
           color: black;
           font-size: 18px;
           font-weight: 600;
           letter-spacing: 1px;
           cursor: pointer;
           transition: all 0.3s ease;
           background: whitesmoke;
         }
         .button input:hover{
          /* transform: scale(0.99); */
          background: red;
          }

          .front-title{
            font-size: 80px;
            font-weight: 669;
            letter-spacing: 1px;
            font-family: optima, sans-serif;
            color: black;
          }

          .paragraph-text{
            font-size: 35px;
            font-family: optima, sans-serif;
          }

    </style>
</head>
<body>
    <nav class="navbar">
    <div class="content">
      <div class="logo">
        <a href="Home Page.php">Relx Novelty</a>
      </div>
      <ul class="menu-list">
        <div class="icon cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <li><a href="admin.php"><span class="glyphicon glyphicon-plus"></span>Add Products</a></li>
        <li><a href="admin-viewproducts.php"><span class="glyphicon glyphicon-shopping-cart"></span>Products</a></li>
        <li><a href="Login Page.php"><span class="glyphicon glyphicon-off"></span>Signout</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

    <main>

    
        <justify>
        <div class="container">

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add a new product</h3>
   <input type="text" name="p_name" placeholder="Enter the product name" class="box" required>
   <input type="number" name="p_price" min="0" placeholder="Enter the product price" class="box" required>
   <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" name="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>product image</th>
         <th>product name</th>
         <th>product price</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['name']; ?></td>
            <td>&#8369;<?php echo $row['price']; ?></td>
            <td>
               <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are you sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>

      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the product" name="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>


        </justify>

        </div>
    </main>

<script>
    const closeBtn = document.querySelector('#close-edit');

    closeBtn.addEventListener('click',()=>{
        document.querySelector('.edit-form-container').style.display = 'none'
    })
</script>


<script>
    const body = document.querySelector("body");
    const navbar = document.querySelector(".navbar");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    menuBtn.onclick = ()=>{
      navbar.classList.add("show");
      menuBtn.classList.add("hide");
      body.classList.add("disabled");
    }
    cancelBtn.onclick = ()=>{
      body.classList.remove("disabled");
      navbar.classList.remove("show");
      menuBtn.classList.remove("hide");
    }
    window.onscroll = ()=>{
      this.scrollY > 20 ? navbar.classList.add("sticky") : navbar.classList.remove("sticky");
    }
</script>


</body>
</html>