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
<body>
  
