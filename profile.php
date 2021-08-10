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

</body>
</html>
<div class="item-page container">
  <div class="">
    <div class="row">
      <div class="col-md-4">
        <div class="customt">
          <h6>Personal information</h6>
        </div>
        <div class="custom mt-2">
          <?php 
            $mail = $_SESSION['email'];
            $da = select('`users`',"`email`='$mail'");
            $newda = $da->fetch(PDO::FETCH_ASSOC);
            $userId = $newda['u_id'];
            
          ?>
          <div class="text-center">
            <img style="width: 200px;height: 200px;border-radius:50%" src="<?= url('images/'.$newda['u_image']??'1610300017.png')?>" alt="">
          </div>
          <h6 class="mt-4">Name: <p class="d-inline-block"><?= $newda['fname'] .' '. $newda['lname']?></p></h6>
          <h6 class="">Phone: <p class="d-inline-block"><?= $newda['phone']?></p></h6>
          <h6 class="">Email: <p class="d-inline-block"><?= $newda['email']?></p></h6>
          <h6 class="">Country: <p class="d-inline-block"><?= $newda['country']?></p></h6>
          <h6 class="">Password: <p class="d-inline-block"><?= $newda['password']?></p></h6>
        </div>
      </div>

      <div class="col-md-8">
        <div class="customt mb-2">
          <h6>My Exchanges cars and Auctions</h6>
        </div>
        <?php
          
          $new = select("cars","`user_id`='$userId'");
          if ($new->rowCount() < 1) {
            echo "<div class='alert alert-danger'>No data to show</div>";
          } else {
            
            while ($item = $new->fetch(PDO::FETCH_ASSOC)) {
             $ur_Id = $item['user_id'];
             $cr_id = $item['id'];
        ?>
        <div class="custom mb-4 cars" id="<?= $item['id']?>">
          <div class="row">
            <div class="col-md-8">
              <img style="width: 50px;height: 50px;border-radius:50%;overflow:hidden" src="<?= url('images/'.$newda['u_image'])?>" alt="">
              <a href="#" class="h6 ml-3"> <?= $newda['fname'] .' '. $newda['lname']?></a>
              <b>.</b>
                <?= $newda['phone']?>
            </div>
            
            <div class="col-md-4 text-right">
            <?php 
              if ( is_null($item['payment']) ) {
            ?>
              <a href="<?=url('payment.php?id='.$item['id'])?>">
                <button class="btn btn-primary"> Boost as Ads</button>
              </a>
            <?php 
              }
              ?>
              <a href="javascript:;" data-id="<?= $item['id']?>" class="ddpost">
                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
              </a>
            </div>
            <div class="col-md-6 mt-4">
              <b>Model:</b> <?= $item['model']?>
              <br><b>Body type:</b> <?= $item['body']?>
              <br><b>Engine type:</b> <?= $item['engine']?>
              <br><b>HP:</b> <?= $item['hp']?>
              <br><b>Transmission:</b> <?= $item['transmission']?>
              <br><b>Engine size:</b> <?= $item['engine_size']?>
              <br><b>Start Date:</b> <?= $item['startdate']?>
              <br><b>End date:</b> <?= $item['enddate']?>
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
                  echo "<b>Start price:</b>".$item['price']."";

                }
              ?>
              <br><b>Image: </b>
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
            
            <div class="col-12 border-top mt-3 pt-2">
                <?php
                 $sql = "SELECT * FROM ex_with,users,cars WHERE `ex_with`.`user_id`=`users`.`u_id` AND `ex_with`.`car_id`=$cr_id GROUP BY `ex_with`.`id`";
                  $stmt = conn()->query($sql);
                  while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
                 ?>

                <div class="row mt-2">
                  <div class="col-1 mx-auto">
                    <a href="<?= url('preview.php?id='.$d['u_id'])?>">
                      <img style="width: 40px;height: 40px;border-radius:50%;" src="<?= url('images/'.$d['u_image'])?>" alt="">
                    </a>
                  </div>
                  <div class="col-11 border rounded py-1">
                   <?= $d['description']?>
                  </div>
                </div>
                <?php }?>
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

