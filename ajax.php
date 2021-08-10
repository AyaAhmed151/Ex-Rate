<?php 
  include "backend.php";

  if (isset($_POST['user_id'])) {
    $us = $_POST['user_id'];
    $ca = $_POST['car_id'];
    $ds = $_POST['des'];

    $table = "ex_with";
    $col = "`user_id`,`car_id`,`description`";
    $data = "'$us','$ca','$ds'";
    
    if(insert($table,$col,$data)){
      $ar = array(
        "status"    => '1',
        "msg"       => 'Request has been sent'
      );
      echo json_encode($ar);

    } 
  }

  if (isset($_POST['user_id_rate'])) {
    $us = $_POST['user_id_rate'];
    $ca = $_POST['car_id_rate'];
    $ds = $_POST['des'];

    $table = "rating_comment";
    $col = "`user_id`,`rate_id`,`rc_text`";
    $data = "'$us','$ca','$ds'";
    
    if(insert($table,$col,$data)){
      $ar = array(
        "status"    => '1',
        "msg"       => 'Comment has been Added'
      );
      echo json_encode($ar);

    } 
  }

  if (isset($_POST['table'])) {
    if ($_POST['table'] == "cars") {
      $id = $_POST['id'];
      if (delete("cars","$id")) {
        $ar = array(
          "status"    => '1',
          "msg"       => 'Delete successfully'
        );
        echo json_encode($ar);
      } 
    } elseif ($_POST['table'] == "rate") {
      $id = $_POST['id'];
      $sql = "DELETE FROM `rating` WHERE `r_id`='$id'";
      $stmt = conn()->query($sql);
      if ($stmt) {
        
        $ar = array(
          "status"    => '1',
          "msg"       => 'Delete successfully'
        );
        echo json_encode($ar);
      }
    } elseif ($_POST['table'] == "comment") {
      $id = str_replace('d_','',$_POST['id']) ;
      $sql = "DELETE FROM `rating_comment` WHERE `rc_id`='$id'";
      $stmt = conn()->query($sql);
      if ($stmt) {
        
        $ar = array(
          "status"    => '1',
          "msg"       => 'Delete successfully'
        );
        echo json_encode($ar);
      }
    }
    
  }

  
?>