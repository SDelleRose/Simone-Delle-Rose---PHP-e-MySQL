<?php
session_start();
require_once('config/database.php');

if (isset($_SESSION['session_id'])){
  $session_user =htmlspecialchars($_SESSION['session_user'], ENT_QUOTES, 'UTF-8');
  $session_id = htmlspecialchars($_SESSION['session_id']);


$query="
         SELECT title, description, id, status, date FROM lists
         WHERE username = :username;
    ";
$list=$pdo->prepare($query);
$list->bindParam(':username',$session_user,PDO::PARAM_STR);
$list->execute();

require_once('todolist.php');


}else {
  header('Location: home.html');
  exit;
}

?>
