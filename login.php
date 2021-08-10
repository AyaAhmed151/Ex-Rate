<?php
  include 'header.php';
  if (isset($_SESSION['login'])) {
    header("Refresh:2; url=gifts.php");
  } 
?>
<div class="login-form-home">
  <div class="login-form">
    <form action="" class="form-group" method="POST">
      <h2>Login</h2> 
      <p>complete the following form to gain benefits</p>
      <?php 

      if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        if (empty($email) ||  empty($pass)) {
          echo "<div class='alert alert-danger'>email or password is wrong</div>";
        } else {
          $old = select("`users`","`email`='$email' AND `password`='$pass' AND `type`='user'");
          if ($old->rowCount() < 1) {
            echo "<div class='alert alert-danger'>email or password is wrong</div>";
          } else {
            $data = $old->fetch(PDO::FETCH_ASSOC);
            $_SESSION['email'] = $data['email'];
            $_SESSION['login'] = true;
            echo "<div class='alert alert-success'>Login successfully</div>";
            header("Refresh:2; url=profile.php");
          }
        }
      }

      ?>
      <label for="">Email</label>
      <input type="email" name="email" class="form-control" placeholder='Email'>
      <label for="" class="mt-3">Password</label>
      <input type="password" name="password" class="form-control" placeholder='Password'>
      
      <button type="submit" name="login" class="btn btn-block btn-primary">Login</button>
      <a href="<?php echo url('register.php')?>" class="d-block mt-2 text-center">Create account</a>

    </form>
  </div>
</div>