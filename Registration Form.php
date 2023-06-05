<?php

@include 'config-login.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];
   $number = $_POST['number'];
   $address = $_POST['address'];
   $code = $_POST['code'];
   $birthdate = $_POST['birthdate'];
   $gender = $_POST['gender'];
   $username = $_POST['username'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0)/*checks if there's a user with the same email and password exists in the database.*/
   {

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, email, password, user_type, number, address, code, birthdate, gender, username) VALUES('$name','$email','$pass','$user_type','$number','$address','$code','$birthdate','$gender','$username')";
         mysqli_query($conn, $insert);
         header('location:Login Page.php');
      }
   }

};

/*if data is successfully inserted in the database, redirects the user to Login Page.php*/

?>

<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <div class="title"><justify><h2>Create an account</h2></justify></div>
    <div class="content">
      <form action="" method="post">
              <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
        <div class="user-details">
          <div class="input-box">
            <span class="details"></span>
            <input type="text" name="name" placeholder="Enter your full name" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input type="text" name="username" placeholder="Enter your username" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input type="email" name="email" placeholder="Enter your email" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input type="number" name="number" placeholder="Enter your number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="11" required>
          </div>
            <div class="input-box">
            <span class="details"></span>
            <input type="text" name="address" placeholder="Enter your address" required>
          </div>
            <div class="input-box">
            <span class="details"></span>
            <input type="number" name="code" placeholder="Enter your zip code" maxlength="8" minlength="5" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input type="password" name="password" placeholder="Enter your password" maxlength="15" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title ="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
          </div>
          <div class="input-box">
            <span class="details"></span>
            <input type="password" name="cpassword" placeholder="Confirm your password" maxlength="15" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
             
            title ="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
          </div>

          <div class="input-box">
            <input type="date" name="birthdate" placeholder="Enter birth date" 
            min="1923-01-01" max="2005-12-31" required />
          </div>

          <div class="input-box">
          <select name="user_type">
          <option value="user">User</option>
          <option value="admin">Admin</option>
          </select>
          </div>
          
        </div>

        <div class="gender-details">
          <input type="radio" name="gender" value="Male" id="dot-1">
          <input type="radio" name="gender" value="Female" id="dot-2">
          <input type="radio" name="gender" value="N/A" id="dot-3">
          <span class="gender-title"></span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender" >Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          <label for="dot-3">
            <span class="dot three"></span>
            <span class="gender">Prefer not to say</span>
            </label>
          </div>
        </div>

        <div class="button">
          <input type="submit" name="submit" value="SIGN UP">
        </div>
      </form>

    </div>
  </div>

</body>
</html>