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
  
  $title = array(
    "Toyota agency",
    "BMW agency",
    "Mini agency",
    "El-wakel agency",
    "Al-safwa agency",
    "El-taybe agency",
    "Car fix agency",
    "ULC auto care",
    "Kayan agency",
    "AUM agency"
  );

  $text = array(
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
    "Maintenance and repair service for all electrical and automatic cars problems - all models and classes",
  );

  $image = array(
    "2016-636117057747639046-763_main.jpg",
    "لاصة.png",
    "min.jpeg",
    "مرسيدس-SLR.jpg",
    "مركز-صيانة-سيارات.jpg",
    "carsflat.png",
    "259681_Large_20140815103430_11.jpg",
    "1461375057_652273_191_557741_.jpg",
    "big_img_94720666a020b9b2acc7186890f3a1ce.jpg",
    "38710dc44e5b0.jpg",
  );
  $mobile = array(
    "01125236654",
    "01255365471",
    "01125447758",
    "01253369874",
    "01025436365",
    "01524475886",
    "01125447758",
    "01253369874",
    "01125236654",
    "01025436365",
  );

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
<body id="main">

<div class="item-page container">
  <div class="row">
      <div class="col-md-12">
        <div class="customt">
          <h6>Maintenance center</h6>
        </div>
      </div>
  </div>

      <div class="row ">
        <?php 
          for ($i=0; $i < COUNT($title); $i++) { 
        ?>
        <div class="col-md-4 mt-2">
          <div class="custom card">
            <img src="<?= url('images/'.$image[$i])?> " class="card-img-top" >
            <div class="card-body half-body">
              <h5 class="card-title"><?= $title[$i]?></h5>
              <p class="card-text"><?= $text[$i]?></p>
              <p class="card-phone mt-2"><?= $mobile[$i]?></p>
            </div>
          </div>
        </div>
        <?php }?>
      </div>
      
</div>

<?php 
  include 'footer.php';
?>

