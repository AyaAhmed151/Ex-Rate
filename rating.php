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

  if (isset($_POST['add_rate'])) {
    $title = $_POST['title'];

    $file = moveimage('file');
    $n = $FNAME.' '.$LNAME;
    $col = "`user_id`,`name`,`image`,`profile`,`title`";
    $data = "'$USERID','$n','$file','$IMAGE','$title'";

    if (insert("rating",$col,$data)) {
      $sta = "<div class='alert alert-success'>successfully</div>";
      // header("Refresh:2; url=rating.php");
    } else {
      $sta = "<div class='alert alert-danger'>Error</div>";
    }
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
          <h6>Add car for rating</h6>
        </div>
        <div class="custom mt-2">
          <?php 
            if (isset($_SESSION['email'])) {
              ?>
              <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-12">
                      <?php if(isset($sta)){
                        echo $sta;
                        }?>
                    </div>
                    <div class="col-12 know">
                      <label for="">Your inquiry ?</label>
                      <input name="title" type="text" class="te form-control" placeholder="Your inquiry ?">
                      <label for="">Add image</label>
                      <input name="file" type="file" class="te form-control" >
                      
                      <button type="submit" name="add_rate" class="mt-3 btn btn-block btn-primary" >
                      Send to Rating
                      </button>
                      
                    </div>
                  </div>
                </form>
            <?php
            } else {
              ?>
              must be loged in to add inquiry
              <a href="<?= url('login.php')?>">
                <button class="btn btn-primary btn-block">
                  Login
                </button>
              </a>
              <?php
            }
          ?>
        </div>
      </div>

      <div class="col-md-8">
        <div class="customt mb-2">
          <h6>Your exchanges cars and auctions</h6>
        </div>

        <?php

          $new = selectall("`rating` ORDER BY `rating`.`r_id` DESC");
          if ($new->rowCount() < 1) {
            echo "<div class='alert alert-danger'>No data to show</div>";
          } else {
            
            while ($item = $new->fetch(PDO::FETCH_ASSOC)) {
              $cr_id = $item['r_id'];
        ?>
        <div class="custom mb-4 cars" id="<?= $item['r_id']?>">
          <div class="row">
            <div class="col-md-8">
              <img style="width: 50px;height: 50px;border-radius:50%;overflow:hidden;margin-top:-27px" src="<?= url('images/'.$item['profile'])?>" alt="">
            
              <div class="d-inline-block">
              <a href="<?= url('preview.php?id='. $item['user_id'])?>" class="h6 ml-3"> <?= $item['name']?></a>
              
                  <br>
                  <div style="margin-left:15px;font-size:17px;color:#f1c40f" class="d-inline-block">
                    <?php
                    
                    $rate = "SELECT AVG(ratestar) AS m FROm rate WHERE `item_id`=$cr_id";
                    $stmti = conn()->query($rate);
                    $n = intval($stmti->fetch(PDO::FETCH_ASSOC)['m']);
                    $test = 5 - $n;
                    for ($i = 0; $i < $n; $i++) {
                      ?>
                      <i class="fas fa-star"></i>
                    <?php
                    }
                    for ($i = 0; $i < $test; $i++) {
                      ?>
                      <i class="far fa-star"></i>
                    <?php
                    }
                    $rate = "SELECT COUNT(ratestar) AS m FROm rate WHERE `item_id`=$cr_id";
                    $stmti = conn()->query($rate);
                    $n = intval($stmti->fetch(PDO::FETCH_ASSOC)['m']);
                    ?>

                  </div>
                  <span style="color:#000;padding:0;font-size: 12px;">(<?= $n?>)</span>
                    </div>
            </div>

            <div class="col-md-4 text-right">
            <?php 
              if ($item['user_id'] == $USERID ) {
            ?>
              <a href="javascript:;" data-id="<?= $item['r_id']?>" class="ddrate">
                <button class="btn btn-danger"><i class="far fa-trash-alt"></i></button>
              </a>
            <?php 
              }
              ?>
              
            </div>
            <div class="col-md-12 mt-4 txt" >
              <p><?= $item['title']?></p>

              <a href="<?= url('images/'.$item['image'])?>" target="_blank">
                <img src="<?= url('images/'.$item['image'])?>" width="80%" class="d-block mx-auto" alt="">
              </a>
            </div>
            
            <div class="col-6 ">
            <?php 
            
            if (isset($_SESSION['email'])) {
              
                  $mo = select("rate","`item_id`=$cr_id AND `user_id`=$USERID");
                  if ($mo->rowCount() == 0) {
                   
                ?>
                <div class="div">
                  <b>Your rate: </b>  
                  <form method="POST" class="d-inline-block">
                    <?php 
                    
                      if (isset($_POST['star'])) {
                        $num = $_POST['star'];
                        if (insert("rate","`user_id`,`item_id`,`ratestar`","'$USERID','$cr_id','$num'")) {
                          header('Location: '.$_SERVER['REQUEST_URI']);
                        }
                      }
                    ?>
                    <select name="star" id="" onchange="submit()">
                      <option value="" disabled selected>0</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </form>
                  star
                </div>
                <?php } }?>
            </div>
            <p class="seeMore col-6 text-right">
              See all comments <i class="fas fa-sort-down"></i>
            </p>
            <div class="col-12 border-top classComment">
              
                <?php
                 $sql = "SELECT * FROM rating_comment,users,rating WHERE `rating_comment`.`user_id`=`users`.`u_id` AND `rating_comment`.`rate_id`=$cr_id GROUP BY `rating_comment`.`rc_id`";
                  $stmt = conn()->query($sql);
                  while($d = $stmt->fetch(PDO::FETCH_ASSOC)){
                 ?>

                <div class="row mt-2" id="d_<?= $d['rc_id']?>">
                  <div class="col-1 mx-auto">
                    <a href="<?= url('preview.php?id='.$d['u_id'])?>">
                      <img style="width: 40px;height: 40px;border-radius:50%;" src="<?= url('images/'.$d['u_image'])?>" alt="">
                    </a>
                  </div>
                  <div class="col-11 border rounded py-1">
                    <div class="row">
                      <div class="col-11">
                        <?= $d['rc_text']?>
                      </div>
                      <div class="col-1 text-right">
                        <?php
                          if ($d['u_id'] == $USERID) { 
                            ?>
                            <a href="javascript:;" data-id="d_<?= $d['rc_id']?>" class="text-danger ddcoment ">
                              <i class="far fa-trash-alt"></i>
                            </a>
                            <?php
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }?>
            </div>
            <?php 
              if ($USERID !=='') {
                
            ?>
            <div class="col-12 pt-2 mt-2 border-top">
              <form action="" method="POST" class="comment_m__Q">
                  <div class="row">
                    <div class="col-1 mx-auto">
                      <img style="width: 40px;height: 40px;border-radius:50%;" src="<?= url('images/'.$IMAGE)?>" alt="">
                    </div>
                    <div class="col-11">
                      <input type="hidden" name="user_id_rate" value="<?= $USERID?>">
                      <input type="hidden" name="car_id_rate" value="<?= $item['r_id']?>">
                      <input name="des" type="text" class="rounded-pill te form-control" placeholder="Write a comment...">
                    
                      <button type="submit" style="position: absolute; left: -9999px"  name="add_ex" class="btn btn-primary">
                      <i class="fas fa-paper-plane"></i>
                      </button>
                    </div>
                  </div>
                </form>
            </div>
            <?php }?>
          
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

