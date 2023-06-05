<?php

@include 'config-login.php';

session_start();
$user_name = $_SESSION['user_name'];

if(!isset($_SESSION['user_name'])){
   header('location:Login Page.php');
};

if(isset($_GET['logout'])){
   unset($user_name);
   session_destroy();
   header('location:Login Page.php');
};

?>

<?php

@include 'config.php';

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

 $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_name'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($conn,"INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_name', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart succesfully';
   }

}

?>

<?php

@include 'config.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:Shopping Cart Page.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:Shopping Cart Page.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_name'") or die('query failed');
   header('location:Shopping Cart Page.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RELX NOVELTY | Shopping Cart</title>
    <link rel = "shortcut icon" href="" type="image/X-UA-Compatible">

       
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <style>
        *{
            box-sizing: border-box;
            font-family: 'poppins',sans-serif;
            text-transform: none;
        }

        body{
            background-color: #8A9EA0;
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


        main{
            padding: 114px;
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
            font-size: 100%;
            letter-spacing: 1px;
            font-family: optima, sans-serif;
          }

          .paragraph-text{
            font-size: 24px;
            font-family: optima, sans-serif;
          }

          .container{
            max-width: 6900px;
            width: 100%;
            height: 100%;
            background-color: #DFDBD0;
            padding: 25px 30px;
            border-radius: 1px;
            margin-top: 2rem;
            }


            .container .content{
            font-size: 25px;
            font-weight: 500;
            position: relative;
            font-family: optima, sans-serif;
            }

            
a:hover { text-decoration: none; }
a:active { text-decoration: none; }

@media (max-width: 1300px)
{
  .container {
    width: 100%;
    height: 100%;
}


@media (max-width:1300px){

   .shopping-cart{
      overflow-x: scroll;
   }

   .shopping-cart table{
      width: 120rem;
   }

   .shopping-cart .heading{
      text-align: left;
   }

   .shopping-cart .checkout-btn{
      text-align: left;
   }

}



    </style>

</head>
<body>

           <?php
           @include 'config-login.php';
      $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_name'") or die('query failed');
      if(mysqli_num_rows($select_user) > 0){
         $fetch_user = mysqli_fetch_assoc($select_user);
      };
   ?>

   <div class="">
    <nav class="navbar">
    <div class="content">
      <div class="logo">
        <a href="Home Page.php">Relx Novelty</a>
      </div>
      <ul class="menu-list">
        <div class="icon cancel-btn">
          <i class="fas fa-times"></i>
        </div>
        <li><a href="Home Page.php"><span class='glyphicon glyphicon-home'></span>Home</a></li>
        <li><a href="Products Page.php"><span class='glyphicon glyphicon-shopping-cart'></span>Products</a></li>
        <li><a href="Shopping Cart Page.php"><span class='fa fa-cart-plus'></span>Cart</a></li>
        <li><a href="About Us Page.php"> <span class="glyphicon glyphicon-user"></span>About</a></li>
        <li><a href="Shopping Cart Page.php?logout=<?php echo $user_name; ?>" onclick="return confirm('Are you sure you want to signout?');"><span class="glyphicon glyphicon-off"></span>Signout</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

      <?php
      @include 'config.php';
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

   </div>


    <main>

    
        <justify>

            <div class="container">
            <!---<div class="front-title">
                <b>SHOPPING CART<b>
            </div>--->


<section class="shopping-cart">

   <table>

      <thead>
         <th>IMAGE</th>
         <th>NAME</th>
         <th>PRICE</th>
         <th>QUANTITY</th>
         <th>TOTAL PRICE</th>
         <th>ACTION</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_name'") or die('query failed');
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>&#8369;<?php echo number_format($fetch_cart['price']); ?></td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="UPDATE" name="update_update_btn">
               </form>   
            </td>
            <td>&#8369;<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></td>
            <td><a href="Shopping Cart Page.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i>REMOVE</a></td>
         </tr>

         <?php
           $grand_total = $grand_total + $sub_total;  
            };
         };
         ?>

         <tr class="table-bottom">
            <td><a href="Products Page.php" class="option-btn" style="margin-top: 0;">CONTINUE SHOPPING</a></td>
            <td colspan="3">AMOUNT PAYABLE</td>
            <td>&#8369;<?php echo $grand_total; ?></td>
            <td><a href="Shopping Cart Page.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> DELETE ALL </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="Checkout Page.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">CHECKOUT</a>
   </div>

</section>

</div>
   
        </justify>

    </main>

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

<script src="js/script.js"></script>

</body>

</html>