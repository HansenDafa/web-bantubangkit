<?php

include 'layout/header.php';
include 'config/session.php';

if(isset($_POST['submit'])){

   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);

   $select = " SELECT * FROM user_form WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'admin'){
         $_SESSION['admin_name'] = $row['name'];
         echo "<script>
            Swal.fire({
               icon: 'success',
               title: 'Login Successful',
               text: 'Welcome, Admin!',
               confirmButtonText: 'Proceed'
            }).then((result) => {
               if (result.isConfirmed) {
                  window.location.href = 'admin_page.php';
               }
            });
         </script>";

      } elseif($row['user_type'] == 'user'){
         $_SESSION['user_name'] = $row['name'];
         echo "<script>
            Swal.fire({
               icon: 'success',
               title: 'Login Successful',
               text: 'Welcome, User!',
               confirmButtonText: 'Proceed'
            }).then((result) => {
               if (result.isConfirmed) {
                  window.location.href = 'user_page.php';
               }
            });
         </script>";
      }
     
   } else {
      echo "<script>
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Incorrect email or password!',
         });
      </script>";
   }

};
?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BantuBangkit: Login</title>

</head>
<body>



<div class="form-container" style="flex-direction: column ;">

   <form action="" method="post">
      <h3>login now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="email" name="email" required placeholder="enter your email" require>
      <input type="password" name="password" required placeholder="enter your password" require>
      <input type="submit" name="submit" value="login now" class="form-btn">
      <p>don't have an account? <a href="register_form.php">Register now</a></p>

      

   </form>

   <a style="margin-top: 3rem; border: none;" href="index.php" type="button" class="btn btn-secondary">Back</a>


</div>







</body>
</html>