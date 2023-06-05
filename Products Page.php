<?php

@include 'config-login.php';

session_start();
$user_name = $_SESSION['user_name'];

if(!isset($_SESSION['user_name']))/*if hindi set ung user_name variable, user is not logged in and redirect to login page.*/{
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

if(isset($_POST['add_to_cart']))/*check if button is clicked, retrives product info. check if there is the same product in user.*/
{

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

 $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_name'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
   }else{
      $insert_product = mysqli_query($conn,"INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_name', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
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
    <title>RELX NOVELTY | Products</title>
    <link rel = "shortcut icon" href="" type="image/X-UA-Compatible">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.css">


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

        nav img {
            width: 70%;
            display: block;
            margin bottom: 35px;
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
            padding: 125px;
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
            font-size: 100px;
            font-weight: 1000;
            letter-spacing: 1px;
            font-family: trebuchet ms, sans-serif;
            color: black;

          }

          .paragraph-text{
            font-size: 24px;
            font-family: trebuchet ms, sans-serif;
          }

          .products .box-container{
            display: grid;
            grid-template-columns: repeat(auto-fit, 35rem);
            gap:2.5rem;
            justify-content: center;
            padding: 25px;
          }

          .products .box-container .box{
            text-align: center;
            padding:2rem;
            box-shadow: var(--box-shadow);
            border:var(--border);
            border-radius: .5rem;
            background-color: #DFDBD0;
            height: 100%;
          }


a:hover { text-decoration: none; }
a:active { text-decoration: none; }


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
        <li><a href="Products Page.php?logout=<?php echo $user_name; ?>" onclick="return confirm('Are you sure you want to signout?');"><span class="glyphicon glyphicon-off"></span>Signout</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

    <main>

    
        <justify>
            <div class="container">

<section class="products">

   <h1 class="heading">FEATURED PRODUCTS</h1>

   <div class="box-container">

      <?php
      @include 'config.php';
      $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if(mysqli_num_rows($select_products) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_product['name']; ?></h3>
            <div class="price">&#8369;<?php echo $fetch_product['price']; ?></div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

        </justify>

        </div>
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