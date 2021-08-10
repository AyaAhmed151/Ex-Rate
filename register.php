<?php
  include 'header.php';
  if (isset($_SESSION['login'])) {

    header("Location: profile.php");
  } 
?>

<div class="login-form-home">
  <div class="login-form">
    <form action="" class="form-group" method="POST" enctype="multipart/form-data">
      <h2>Registration</h2>
      <p>complete the following form to register</p>

      <?php 
        $errors = [];

        if (isset($_POST['regist'])) {
          $firstname = $_POST['firstname'];
         $lastname = $_POST['lastname'];
         $phone = $_POST['phone'];
         $email = $_POST['email'];
         $password = $_POST['password'];
          $country = $_POST['country'];
          $image = moveimage('image');

          if (empty($firstname)) {array_push($errors,"First name is required");}
          if (empty($lastname)) {array_push($errors,"Last name is required");}
          if (empty($phone)) {array_push($errors,"Phone is required"); }
          if (empty($email)) {array_push($errors,"Email is required");}
          if (empty($password)) {array_push($errors,"Password is required");}
          if (empty($country)) {array_push($errors,"Country is required");}
          if (empty($image)) {array_push($errors,"Profile photo is required");}

          if (count($errors) >=1) {
            foreach ($errors as $error) {
              echo "<div class='alert alert-danger'>$error</div>";
            }
          } else {
            $old = select("`users`","`email`='$email'");
            if ($old->rowCount() < 1) {
              if(insert("`users`","`fname`,`lname`,`phone`,`email`,`u_image`,`password`,`country`,`type`","'$firstname','$lastname','$phone','$email','$image','$password','$country','user'")){
                echo "<div class='alert alert-success'>Done</div>";
                
                $_SESSION['email'] = $email;
                
                $_SESSION['login'] = true;
                header("Refresh:2; url=profile.php");

              } 
              
            } else {
              echo "<div class='alert alert-danger'>User is exist</div>";
            }
          }
        }
      ?>
      <div class="row">
        <div class="col-md-6">
          <label for="">First name</label>
          <input type="text" name="firstname" class="form-control" placeholder='First name'>
          
        </div>
        <div class="col-md-6">
          <label for="">Last name</label>
          <input type="text" name="lastname" class="form-control" placeholder='Last name'>
        </div>
      </div>
      <label for="">Phone</label>
      <input type="number" name="phone" class="form-control" placeholder='Phone'>

      <label for="">Email</label>
      <input type="email" name="email" class="form-control" placeholder='Email'>

      <label for="">Profile photo</label>
      <input type="file" name="image" class="form-control">

      <label for="">Password</label>
      <input type="password" name="password" class="form-control" placeholder='Password'>

      <label for="">Country</label>
      <input type="text" name="country" class="form-control" placeholder='Country'>
      <button type="submit" name="regist" class="btn btn-block btn-primary">Register</button>
      <a href="<?php echo url('Login.php')?>" class="d-block mt-2 text-center">I have account</a>

    </form>
  </div>
</div>

<?php 
  include 'footer.php';
?>