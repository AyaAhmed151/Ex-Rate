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
  if (isset($_SESSION['email'])) {
    
    $mail = $_SESSION['email'];
    $da = select('`users`',"`email`='$mail'");
    $newda = $da->fetch(PDO::FETCH_ASSOC);
    $userId = $newda['u_id'];
    $fname = $newda['fname'];
    $lname = $newda['lname'];
    $phone = $newda['phone'];
  } 

  $nameImage = '';
  if(isset($_POST['add_ex'])){
    $model = $_POST['Model'];
    $body = @$_POST['body'];
    $engine = @$_POST['engine'];
    $hp = $_POST['hp'];
    $transmission = @$_POST['transmission'];
    $Engine_size = $_POST['Engine_size'];
    $startdate = $_POST['startdate'];
    $enddate = $_POST['enddate'];
    $steering_system = @$_POST['steering_system'];
    $airbag = $_POST['airbag'];
    $brake_system = $_POST['brake_system'];
    $A_C = $_POST['A_C'];
    $aid_kit = $_POST['aid_kit'];
    $fire = $_POST['fire'];
    $km = $_POST['km'];
    $price = $_POST['price'];

    $type = 'auction';

    for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
      $filetmp = $_FILES["images"]["tmp_name"][$i];
      $filename = $_FILES["images"]["name"][$i];
      $filetype = $_FILES["images"]["type"][$i];
      $filepath = "images/" . $filename;
      if(move_uploaded_file($filetmp, $filepath)){
        if ($i < count($_FILES['images']['name'])-1) {
          $nameImage .= $filename.",";
        } else {
          $nameImage .= $filename;
        }
      }
    }
    
    if (empty($model) || empty($body) || empty($engine) || 
    empty($hp) || empty($transmission) || empty($Engine_size)
     || empty($startdate) || empty($enddate) || empty($steering_system)|| empty($airbag)|| empty($brake_system) || empty($A_C) || empty($aid_kit) || empty($fire) || empty($km) || empty($price)) {
      $sta = "<div class='alert alert-danger'>All fields are required</div>";
    } else {
      $table = "cars";

      $colums = "`user_id`,`model`,`body`,`engine`,
      `hp`,`transmission`,`Engine_size`,`startdate`,`enddate`,`steering_system`,`airbag`,`brake_system`,`A_C`,`aid_kit`,`fire`,`km`,`images`,`price`,`type`";

      $data = "'$userId','$model','$body','$engine',
      '$hp','$transmission','$Engine_size','$startdate','$enddate','$steering_system','$airbag','$brake_system','$A_C','$aid_kit','$fire','$km','$nameImage','$price','$type'";

      if (insert($table,$colums,$data)){
        $sta = "<div class='alert alert-success'>Auction added</div>";
      } else {
        $sta = "<div class='alert alert-danger'>Error</div>";
      }
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
<body id="add">
  

<div class="customt navCustom mt-2 container" >
  <div class="">
    <div class="row">
      <div class="col-12 text-center">
        <a href="<?= url('index.php')?>" class="mr-4">
        <i class="fas fa-home"></i> Home
        </a>
        <a href="<?= url('auction.php')?>" >
          <i class="fas fa-chart-line"></i> Auctions
        </a>
        <a href="<?= url('addauction.php')?>" class="mx-4">
          <i class="fas fa-chart-line"></i> Add auctions
        </a>
        <a href="<?= url('exchange.php')?>"  >
          <i class="fas fa-exchange-alt"></i> Exchanges
        </a>
        <a href="<?= url('addexchange.php')?>" class="mx-4" >
          <i class="fas fa-exchange-alt"></i> Add exchanges
        </a>
        <a href="<?= url('rating.php')?>" >
          <i class="fas fa-percent"></i> Rating 
        </a>
        <a href="<?= url('profile.php')?>" class="mx-4">
          <i class="fas fa-user"></i> Profile 
        </a>
        <a href="<?= url('logout.php')?>" class="">
          <i class="fas fa-sign-out-alt"></i> Logout 
        </a>
      </div>
    </div>
  </div>
</div>



<div class="item-page container">
  <div class="">
    <div class="row">
      <div class="col-12">
        <div class="customt">
          <h6>Add new auction </h6>
        </div>
      </div>
      <div class="col-md-12">
        <div class="custom mt-2">
          <form action="" class="row" method="POST" enctype="multipart/form-data">
            <div class="col-12">
              <?php 
                if (isset($sta)) {
                  echo $sta;
                }
              ?>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Model</label>
                <input type="text" name="Model" class="form-control" id="" required>
              </div>
              <div class="form-group">
                <label for="">Body type</label>
                <select name="body" class="form-control" required>
                  <option value="" selected disabled>Select body type</option>
                  <option value="Sedan">Sedan</option>
                  <option value="Coupe">Coupe</option>
                  <option value="SUV">SUV</option>
                  <option value="Convertible">Convertible</option>
                  <option value="Station">Station Wagon</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Engine type</label>
                <select name="engine" class="form-control" required>
                  <option value="" selected disabled>Select Engine</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Gasoline">Gasoline</option>
                  <option value="Electric">Electric</option>
                  <option value="Hybrid">Hybrid</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">HP</label>
                <input type="number" class="form-control" name="hp" id="" required>
              </div>
              <div class="form-group">
                <label for="">Transmission</label>
                <select name="transmission" class="form-control" required>
                  <option value="" selected disabled>Select Transmission</option>
                  <option value="Automatic">Automatic</option>
                  <option value="Manual">Manual</option>
                  <option value="Steptronic">Steptronic</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Engine size</label>
                <input type="number" class="form-control" name="Engine_size" id="" required>
              </div>
              <div class="form-group">
                <label for="">Start Date</label>
                <input type ="date" name="startdate" 
                class="form-control" id="" required>
              </div>
              <div class="form-group">
                <label for="">End Date</label>
                <input type ="date" name="enddate" 
                class="form-control" id="" required>
                
              </div>
              
              <div class="form-group">
                <label for="">Images</label>
                <input type="file" name="images[]" multiple class="form-control" required>
              </div>
              </div>
              
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Steering system</label>
                <select name="steering_system" class="form-control" required>
                  <option value="" selected disabled>Select steering system</option>
                  <option value="Hydraulic">Hydraulic</option>
                  <option value="Electro-hydraulic">Electro-hydraulic</option>
                  <option value="Electric power">Electric power </option>
                  <option value="none">none</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Airbag</label>
                <select name="airbag" class="form-control" id="" required>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Brake system</label>
                <select name="brake_system" class="form-control" id="" required>
                  <option value="ABS">ABS</option>
                  <option value="EBD">EBD</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">A/C</label>
                <select name="A_C" class="form-control" id="" required>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">First aid kit</label> 
                <select name="aid_kit" class="form-control" id="" required>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Fire extinguisher</label>
                <select name="fire" class="form-control" id="" required>
                  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Expended Km</label>
                <input type="text" name="km" class="form-control" id="" required>
              </div>
              
              <div class="form-group">
                <label for="">Start price</label>
                <input type="number" name="price" required class="form-control">
              </div>
            </div>
            <div class="col-12 mt-3 row">
              <div class="col-12">
                <button type="submit" name="add_ex" class="btn btn-block" style="color:#fff;font-weight:bold;background-color: var(--yellowcolor);">
                  Add Auction
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php 
  include 'footer.php';
?>

