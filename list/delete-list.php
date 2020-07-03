<?php

session_start();
require_once('../config/database.php');

if (isset($_POST['delete'])) {
  $query='
      DELETE FROM lists
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
