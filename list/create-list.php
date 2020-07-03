<?php
session_start();
require_once('../config/database.php');

if (isset($_POST['add'])) {
  $title=$_POST['title'] ?? '';
  $description=$_POST['description'] ?? '';
  $session_user = htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
  
  setlocale(LC_TIME, 'ita', 'it_IT');
  $date=utf8_encode(strftime('%d&nbsp;%b<br>%Y'));

  $query='
       INSERT INTO lists
       VALUES(0, :username, :title, :description, 0, :date);
  ';

  $check= $pdo->prepare($query);
  $check->bindParam(':username',$session_user,PDO::PARAM_STR);
  $check->bindParam(':title',$title,PDO::PARAM_STR);
  $check->bindParam(':description',$description,PDO::PARAM_STR);
  $check->bindParam(':date',$date,PDO::PARAM_STR);
  $check->execute();
  header('Location:../dashboard.php');

}

 ?>
