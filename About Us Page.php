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

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RELX NOVELTY | About Us</title>
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
            padding: 150px;
            color: black;
        }

        .button{
           height: 45px;
           width: 100%;
           margin: 35px 0;
           text-align: center;
         }

         button {
           height: 125%;
           width: 23vw;
           border-radius: 50px;
           border: none;
           color: black;
           font-size: 1vw;
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
            font-size: 38px;
            font-weight: 700;
            letter-spacing: 1px;
            font-family: optima, sans-serif;
            color: black;
          }

          .paragraph-text{
            padding: 30px 0;
            font-size: 25px;
            font-family: optima, sans-serif;
            text-align: justify;
          }

          .site-logo{

          }

          a:hover { text-decoration: none; }
          a:active { text-decoration: none; }

          .responsive-width {
            font-size: 1.5vw;
        }
		
@media (max-width: 1200px)
{
  .responsive-width {
    width: 30%;
    height: 125%;
}
  main{
margin-left:0px;
}

}

@media (max-width: 1200px)
{
  .responsive-width {
    width: 33%;
    height: 125%;
}

}

@media (max-width: 1100px)
{
  .responsive-width {
    width: 40%;
    height: 125%;
}

}

@media (max-width: 1000px)
{
  .responsive-width {
    width: 42%;
    height: 125%;
}

}

@media (max-width: 950px)
{
  .responsive-width {
    width: 50%;
    height: 125%;
}

}

@media (max-width: 900px)
{
  .responsive-width {
    width: 55%;
    height: 125%;
}
}

@media (max-width: 800px)
{
  .responsive-width {
    width: 65%;
    height: 125%;
}
}



@media (max-width: 700px)
{
  .responsive-width {
    width: 75%;
    height: 125%;
}
}


@media (max-width: 600px)
{
  .responsive-width {
    width: 85%;
    height: 125%;
}
}

    </style>

</head>
<body>
    <?php
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
        <li><a href="About Us Page.php?logout=<?php echo $user_name; ?>" onclick="return confirm('Are you sure you want to signout?');"><span class="glyphicon glyphicon-off"></span>Signout</a></li>
      </ul>
      <div class="icon menu-btn">
        <i class="fas fa-bars"></i>
      </div>
    </div>
  </nav>

    <main>

        <center>
          <br>
        <div class="site-logo">
        <img src="images/logo.png" alt="logo">
        </div>
        </center>

        <div class="front-title" p align="center">
        RELX NOVELTY
        </div>
        
        <div class="about">RELX Novelty is a partnership business that was established for more than a year now. Offers different brands, types, flavors, designs, and varieties of disposable vapes. Each device ranges from 1500 puffs up to 8000! From ABAR, SK, BOX ABAR, CHILLAX, AEROGIN, FLAVA, AE BAR MAX, vape pods, and RELX disposable vapes.
        </div>
        
        <div class="button">
            <button type="button" class="responsive-width"><a href="Products Page.php">SHOP NOW</a></button>
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

</body>
</html>