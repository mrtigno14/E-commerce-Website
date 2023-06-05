<?php

@include 'config-login.php'; /*includes contents*/

error_reporting(E_ERROR | E_PARSE); /*only display fatal errors*/

session_start();

if(isset($_POST['submit'])) /*checks if the 'submit' button was clicked and the form was submitted.*/
{

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']); /*hashes the password*/
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select); 

   if(mysqli_num_rows($result) > 0) /*gets the input data and stores it in $result variable*/
   {

      $row = mysqli_fetch_array($result); /*checks user type*/

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         header('location:admin.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         header('location:Home Page.php');
      }
     
   }
   else
   {
      $error[] = 'Incorrect email or password!';
   }
};

?>

<?php
    if(isset($error))/*code inside the condition will be executed*/
    {
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
?>


<script>///show password function//
$(document).ready(function() {
/// Checkbox change event ///
$("#ckb").change(function(){
var ckb_status = $("#ckb").prop('checked');
 if(ckb_status){$('#password').prop('type', 'text');}// if checked
 else{$('#password').prop('type', 'password');} // if not checked 
});
///End of checkbox change event//
});
</script>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="index.css">
  <title>Login Page</title>
</head>
<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2>RELX NOVELTY</h2>

                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" name="email" required>
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" id="password" maxlength="15" minlength="0" required>
                        <label for="">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox" id='ckb' onclick=my_change()>&nbsp;&nbsp;Show Password</label> 

                    <script>
                        function my_change() {
                            var t = document.getElementById("password");
                            if (t.type === "password") 
                            {
                                t.type = "text";
                            } else 
                            {
                                t.type = "password";
                            }
                        }
                    </script>

                    </div>
                    <button input type="submit" name="submit">Log in</button>
                    <div class="register">
                        <p>Don't have an account? <a href="Age Verification.php">&nbsp;Register&nbsp;</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>