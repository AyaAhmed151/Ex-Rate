<?php 
  require('backend.php');

  $USERID = '';
  if (isset($_SESSION['email'])) {
    $mail = $_SESSION['email'];
    $da = select('`users`',"`email`='$mail'");
    $newda = $da->fetch(PDO::FETCH_ASSOC);
    $USERID = $newda['u_id'];
    $FNAME = $newda['fname'];
    $LNAME = $newda['lname'];
    $PHONE = $newda['phone'];
    $IMAGE = $newda['u_image'];
  } 
  include "innerNav.php";
  $userId = '';
  if (isset($_SESSION['email'])) {
    
    $mail = $_SESSION['email'];
    $da = select('`users`',"`email`='$mail'");
    $newda = $da->fetch(PDO::FETCH_ASSOC);
    $userId = $newda['u_id'];
    $userimg = $newda['u_image'];
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


<div class="item-page container">
  <div class="">
    <div class="row">
      <div class="col-md-4">
        <div class="customt">
          <h6>Sort by items:</h6>
        </div>
        <div class="custom mt-2">
        <a href="<?= url('auction.php?sort=A_C')?>">A/C</a>
          <br>
          <a href="<?= url('auction.php?sort=engine_size')?>">Engine size</a>
          <br>
          <a href="<?= url('auction.php?sort=hp')?>">HP</a>
          <br>
          <a href="<?= url('auction.php?sort=km')?>">Km</a>
          <br>
          <a href="<?= url('auction.php?sort=price')?>">Price</a>
        </div>
      </div>
      <div class="col-md-8">
        <div class="customt mb-2">
          <h6>Available cars for auctions:</h6>
        </div>
        <?php
           if (isset($_GET['sort'])) {
            $sort = $_GET['sort'];
            
            $new = select("cars","`type`='auction' ORDER BY `cars`.`$sort` DESC");
          } else {
            $new = select("cars","`type`='auction' ORDER BY `cars`.`id` DESC");
          }

          if ($new->rowCount() < 1) {
            echo "<div class='alert alert-danger'>No cars available for auction</div>";
          } else {
            
            while ($item = $new->fetch(PDO::FETCH_ASSOC)) {
              $us_id = $item['user_id'];
              $user = select("users","`u_id`='$us_id'");
              $u = $user->fetch(PDO::FETCH_ASSOC)
        ?>
        <div class="custom mb-4 cars">
          <div class="row">
            <div class="<?= ($userId==$us_id)?'col-8':'col-12'?>">
              <img style="width: 50px;height: 50px;border-radius:50%;overflow:hidden" src="<?= url('images/'.$u['u_image'])?>" alt="">
              <a href="<?= url('preview.php?id='.$u['u_id'])?>" class="h6 ml-3"> <?= $u['fname'].' '.$u['lname']?></a>
              <b>.</b>
               <?= $u['phone']?> 
            </div>
            <?php 
              if ($userId==$us_id and is_null($item['payment'])) {
            ?>
            <div class="col-4 text-right">
              <a href="<?=url('payment.php?id='.$item['id'])?>">
                <button class="btn btn-primary"> Boost as Ads</button>
              </a>
            </div>
            <?php 
              }
            ?>
            <div class="col-md-6 mt-4">
              <b>Model:</b> <?= $item['model']?>
              <br><b>Body type:</b> <?= $item['body']?>
              <br><b>Engine type:</b> <?= $item['engine']?>
              <br><b>HP:</b> <?= $item['hp']?>
              <br><b>Transmission:</b> <?= $item['transmission']?>
              <br><b>Engine size:</b> <?= $item['engine_size']?>
              <br><b>Start Date:</b> <?= $item['startdate']?>
              <br><b>End Date:</b> <?= $item['enddate']?>
              <br><b>Steering system:</b> <?= $item['steering_system']?>
              <br><b>Airbag:</b> <?= $item['airbag']?>
              
            </div>
            <div class="col-md-6 mt-4">
              <b>Brake system:</b> <?= $item['brake_system']?>
              <br><b>A/C:</b> <?= $item['A_C']?>
              <br><b>First aid kit:</b> <?= $item['aid_kit']?>
              <br><b>Fire extinguisher:</b> <?= $item['fire']?>
              <br><b>Expended Km:</b> <?= $item['km']?>
              <br><b>Start price:</b> <?= $item['price']?>
              <br><b>Images: </b>
              <?php 

                $img = explode(',',$item['images']);
              ?>
              <div class="d">
                <div class="">
                  <?php 
                    foreach ($img as $im){
                      ?>
                      <a href="<?= url('images/'.$im)?>" target="_blank">
                       <img width="49%" src="<?= url('images/'.$im)?>" alt=""> 
                      </a>
                      <?php
                    }
                  ?>
                </div>
              </div>
            </div>
            <?php
            if ( $userId != $item['user_id'] && $userId !=='') {
              ?>
            
            <div class="col-12 mt-2">
                <form action="" method="POST" id="ex_with">
                  <div class="row">
                    <div class="col-1 mx-auto">
                      <img style="width: 40px;height: 40px;border-radius:50%;" src="<?= url('images/'.$userimg)?>" alt="">
                    </div>
                    <div class="col-11">
                      <input type="hidden" name="user_id" value="<?= $userId?>">
                      <input type="hidden" name="car_id" value="<?= $item['id']?>">
                      <input name="des" type="text" class="rounded-pill te form-control" placeholder="Write message to buy :">
                    
                      <button type="submit" style="position: absolute; left: -9999px"  name="add_ex" class="btn btn-primary">
                      <i class="fas fa-paper-plane"></i>
                      </button>
                    </div>
                  </div>
                </form>
            </div>
              <?php }
            ?>
          </div>
        </div>
        <?php 
          }
        }
        ?>
      </div>
    </div>
  </div>
</div>

<?php 
  include 'footer.php';
?>

