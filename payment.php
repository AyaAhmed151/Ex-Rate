<?php
include 'header.php';

if (isset($_SESSION['email'])) {
  $mail = $_SESSION['email'];
  $da = select('`users`', "`email`='$mail'");
  $newda = $da->fetch(PDO::FETCH_ASSOC);
  $userId = $newda['u_id'];
  $fname = $newda['fname'];
  $lname = $newda['lname'];
  $phone = $newda['phone'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ex Rate</title>
  <link href="images/logo2.png" rel="icon" width="100%">


  <link rel="stylesheet" href="<?php echo url('vendor/css/bootstrap.css')?>">
  <link rel="stylesheet" href="<?php echo url('vendor/css/font-awesome-all.css')?>">
  <link rel="stylesheet" href="<?php echo url('vendor/css/owl.css')?>">
  <link rel="stylesheet" href="<?php echo url('vendor/css/owltheme.css')?>">
  <link rel="stylesheet" href="<?php echo url('vendor/css/snackbar.min.css')?>">
  <link rel="stylesheet" href="css/index.css?v=<?php echo time();?>">
</head>
<body id="all">
<div class="customt navCustom mt-2 container">
  <div class="">
    <div class="row">
      <div class="col-12 text-center">
        <a href="<?= url('index.php') ?>" class="mr-4">
          <i class="fas fa-home"></i> Home
        </a>
        <a href="<?= url('auction.php') ?>">
          <i class="fas fa-chart-line"></i> Auctions
        </a>
        <a href="<?= url('exchange.php') ?>" class="mx-4">
          <i class="fas fa-exchange-alt"></i> Exchanges
        </a>
        <a href="<?= url('rating.php') ?>">
          <i class="fas fa-percent"></i> Rating
        </a>
      </div>
    </div>
  </div>
</div>

<?php 
  $sta = '';
  if (isset($_POST['pa'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $card = $_POST['card'];
    $expiredate = $_POST['expiredate'];
    $cvs = $_POST['cvs'];
    
    $table = "cars" ;
    $col = "`payment` = 150";
    $id = "$id";

    if (empty($id) || empty($firstname)|| empty($lastname)|| empty($phone)|| empty($name)|| empty($card) || empty($expiredate) || empty($cvs)) {
      $sta = "<div class='alert alert-danger'>All fields are required</div>";
    } else {
      if (update($table,$col,$id)) {
        $sta = "<div class='alert alert-success'>Payment successfully</div>";
        header("Refresh:2; url=profile.php");
      }
    }
  }
?>
<div class="item-page">
  <div class="container">
    
      <div class="row">
        
        <div class="col-md-8 col-12">
          <div class="card">
            <div class="card-header">
            User information
            </div>
            <div class="card-body">
              <h5 class="card-title">Complete the form</h5>
              <form action="" method="post">
                <div class="row">
                  <div class="col-12">
                    <?php if(isset($sta)){echo $sta;} ?>
                  </div>
                  <div class="col-md-6">
                    <label for="">First name</label>
                    <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
                    <input type="text" name="firstname" placeholder="firstname" required class="form-control" value="<?= $fname ?>">
                  </div>
                  <div class="col-md-6">
                    <label for="">Last name</label>
                    <input type="text" name="lastname" placeholder="lastname" required class="form-control" value="<?= $lname ?>">
                  </div>
                </div>
                <label for="">Phone</label>
                <input type="text" name="phone" placeholder="Phone" value="<?= $phone ?>" required class="form-control">
                <label for="">Name on card</label>
                <input type="text" name="name" placeholder="Name on card" required class="form-control">
                <label for="">Card number</label>
                <input type="number" name="card" placeholder="Card number" required class="form-control">
                <div class="row">
                  <div class="col-md-8">
                    <label for="">Expire date</label>
                    <input type="date" name="expiredate" required class="form-control">
                  </div>
                  <div class="col-md-4">
                    <label for="">CVS</label>
                    <input type="number" name="cvs" placeholder="CVS" required class="form-control">
                  </div>
                </div>
                <button type="submit" name="pa" class="mt-3 btn-primary btn btn-block">Complete payment</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            Payment details
          </div>
          <div class="card-body">
            <h5 class="card-title">Order summary</h5>
            <div class="dropdown-divider"></div>
            <div class="card-text row">
              <div class="col-6">Boost as Ads</div>
              <div class="col-6 text-right">140 $</div>
            </div>
            <div class="card-text row">
              <div class="col-6">Fees</div>
              <div class="col-6 text-right">10 $</div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row">
              <div class="col-6"><b>total:</b></div>
              <div class="col-6 text-right">150 $</div>
            </div>
          </div>
        </div>
        </div>
      
    </div>
  </div>
</div>

<?php
include 'footer.php';
?>