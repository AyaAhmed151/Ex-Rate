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
  if (!isset($_SESSION['login'])) {

    header("Location: login.php");
  } 

  include "innerNav.php";
    
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
          <h6>Personal information</h6>
        </div>
        <div class="custom mt-2">
          <?php 
            $mail = $_GET['id'];
            $da = select('`users`',"`u_id`='$mail'");
            $newda = $da->fetch(PDO::FETCH_ASSOC);
            $userId = $newda['u_id'];
          ?>
          <div class="text-center">
            <img style="width: 200px;height: 200px;border-radius:50%" src="<?= url('images/'.$newda['u_image']??'1610300017.png')?>" alt="">
          </div>
          <h6 class="mt-4">Name:  <p class="d-inline-block"><?= $newda['fname'] .' '. $newda['lname']?></p></h6>
          <h6 class="">Phone:     <p class="d-inline-block"><?= $newda['phone']?></p></h6>
          <h6 class="">Email:     <p class="d-inline-block"><?= $newda['email']?></p></h6>
          <h6 class="">Country:   <p class="d-inline-block"><?= $newda['country']?></p></h6>
          
        </div>
      </div>

      <div class="col-md-8">
        <div class="customt mb-2">
          <h6><span class="text-danger" style="font-weight: bold;font-size:inherit;padding:0"><?= $newda['fname'] .' '. $newda['lname']?></span>'s cars</h6>
        </div>
        <?php
          
          $new = select("cars","`user_id`='$userId'");
          if ($new->rowCount() < 1) {
            echo "<div class='alert alert-danger'>Now data to show</div>";
          } else {
            
            while ($item = $new->fetch(PDO::FETCH_ASSOC)) {
             $ur_Id = $item['user_id'];
             $cr_id = $item['id'];
        ?>
        <div class="custom mb-4 cars" id="<?= $item['id']?>">
          <div class="row">
            <div class="col-md-12">
              <img style="width: 50px;height: 50px;border-radius:50%;overflow:hidden" src="<?= url('images/'.$newda['u_image'])?>" alt="">
              <a href="#" class="h6 ml-3"> <?= $newda['fname'] .' '. $newda['lname']?></a>
              <b>.</b>
                <?= $newda['phone']?>
            </div>
            
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
              <br>
              <?php 
                if (is_null($item['price'])) {
                  
                  echo "<b>Exchange with:</b>".$item['ex_with']."";
                } else {
                  echo "<b>Start price::</b>".$item['price']."";

                }
              ?>
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
            
            
            <div class="col-12 mt-4 border-top pt-3">
                <form action="" method="POST" id="ex_with">
                  <div class="row">
                    <div class="col-1 mx-auto">
                      <img style="width: 40px;height: 40px;border-radius:50%;" src="<?= url('images/'.$IMAGE)?>" alt="">
                    </div>
                    <div class="col-11">
                      <input type="hidden" name="user_id" value="<?= $userId?>">
                      <input type="hidden" name="car_id" value="<?= $item['id']?>">
                      <input name="des" type="text" class="te form-control rounded-pill" placeholder="Write message to exchange with:">
                      <button type="submit" style="position: absolute; left: -9999px" name="add_ex" class="mt-3 btn btn-block btn-primary" >
                      Send to exchange
                      </button>
                      
                    </div>
                  </div>
                </form>
            </div>
            


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

