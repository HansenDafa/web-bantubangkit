<?php

include 'layout/header.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);

   $select = "SELECT * FROM user_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      echo "<script>
         Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'User already exists!',
         });
      </script>";
   } else {
      if($pass != $cpass){
         echo "<script>
            Swal.fire({
               icon: 'error',
               title: 'Oops...',
               text: 'Passwords do not match!',
           });
         </script>";
      } else {
         $insert = "INSERT INTO user_form(name, email, password) VALUES('$name','$email','$pass')";
         mysqli_query($conn, $insert);
         echo "<script>
            Swal.fire({
               icon: 'success',
               title: 'Registration Successful',
               text: 'You can now login!',
               confirmButtonText: 'Login'
            }).then((result) => {
               if (result.isConfirmed) {
                  window.location.href = 'login_form.php';
               }
            });
         </script>";
      }
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>BantuBangkit: Register</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container" style="flex-direction: column ;" >

   <form action="" method="post">
      <h3>register now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         };
      };
      ?>
      <input type="text" name="name" required placeholder="enter your name">
      <input type="email" name="email" required placeholder="enter your email">
      <input type="password" name="password" required placeholder="enter your password">
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <input type="submit" name="submit" value="register now" class="form-btn">
      <p>already have an account? <a href="login_form.php">login now</a></p>
   </form>

   <a style="margin-top: 3rem; border: none;" href="index.php" type="button" class="btn btn-secondary">Back</a>


</div>

</body>
</html>