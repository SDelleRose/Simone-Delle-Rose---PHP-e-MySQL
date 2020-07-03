<?php
session_start();
require_once('../config/database.php');

if (isset($_POST['status1'])) {
  $query='
      UPDATE lists
      SET status=0
      WHERE id=:id
  ';
$id=$_POST['id'];

  $check=$pdo->prepare($query);
  $check->bindParam(':id',$id,PDO::PARAM_STR);
  $check->execute();
};
if (isset($_POST['status0'])) {
  $query='
      UPDATE lists
      SET status=1
      WHERE id=:id
  ';
$id=$_POST['id'];

  $check=$pdo->prepare($query);
  $check->bindParam(':id',$id,PDO::PARAM_STR);
  $check->execute();
};

header('Location: ../dashboard.php');
exit;


 ?>
