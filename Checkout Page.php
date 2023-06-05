<?php

@include 'config.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = ($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span>".$total_product."</span>
            <span class='total'> total : Php".$price_total."  </span>
         </div>
         <div class='customer-details'>
            <p> name : <span>".$name."</span> </p>
            <p> number : <span>".$number."</span> </p>
            <p> email : <span>".$email."</span> </p>
            <p> address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p>  payment mode : <span>".$method."</span> </p>
            <p>(*pay when product arrives*)</p>
         </div>
            <a href='Products Page.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RELX NOVELTY | Checkout</title>
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
            position: absolute;

        }

        main{
            margin: 0px;
            padding: 125px;
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
            font-family: optima, sans-serif;
            color: black;
          }

          .paragraph-text{
            font-size: 24px;
            font-family: optima, sans-serif;
          }

          .container{
            max-width: 1000px;
            width: 100%;
            
            background-color: #DFDBD0;
            padding: 25px 30px;
            border-radius: 1px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.15);
            position: relative;
            }

            .container .front-title{
            font-size: 25px;
            font-weight: 500;
            position: relative;
            font-family: optima, sans-serif;
            }

            .container .content{
            font-size: 25px;
            font-weight: 500;
            position: relative;
            font-family: optima, sans-serif;
            }

            .checkout-form form{
            padding:2rem;
            border-radius: .5rem;
            background-color: #DFDBD0;
            }

            a:hover { text-decoration: none; }
            a:active { text-decoration: none; }







    </style>

</head>
<body>

   <div class="flex">
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
        <li><a href="Checkout Page.php?logout=<?php echo $user_name; ?>" onclick="return confirm('Are you sure you want to signout?');"><span class="glyphicon glyphicon-off"></span>Signout</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

      <div id="menu-btn" class="fas fa-bars"></div>

      <?php
      $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
      ?>

   </div>

    <main>


<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> Total Price : &#8369;<?= $grand_total; ?> </span>

   </div>

      <div class="flex">
         <div class="inputBox">
            <span>name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>contact number</span>
            <input type="number" placeholder="enter your phone number" name="number" required>
         </div>
         <div class="inputBox">
            <span>email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="cash on delivery" selected>Cash on Delivery</option>
               <!---<option value="credit cart">credit cart</option>--->
               <!---<option value="paypal">paypal</option>--->
            </select>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. unit no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. makati" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. metro manila" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. philippines" name="country" required>
         </div>
         <div class="inputBox">
            <span>zip code</span>
            <input type="text" placeholder="e.g. 1218" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

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