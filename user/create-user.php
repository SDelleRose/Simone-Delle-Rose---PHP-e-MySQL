<?php
require_once('../config/database.php');

$msg='';

if (isset($_POST['register'])) {
  $username=$_POST['username'] ?? '';
  $password=$_POST['password'] ?? '';
  $usernameValid= filter_var($username, FILTER_VALIDATE_REGEXP, ["options" => ["regexp"=>"/^[a-z\d_]{3,20}$/i"]]);
  $pwdLenght =mb_strlen($password);

  if (empty($username) || empty($password)) {
    $msg= '<p class="error"><em>Compila tutti i campi</em></p>';
  } elseif ($usernameValid ===false) {
    $msg = '<p class="error"><em>L\'username non è valido. Sono ammessi solo caratteri alfanumerici e l\'underscore. Lunghezza minina 3 caratteri. Lunghezza massima 20 caratteri</em></p>';
  } elseif ($pwdLenght<8 || $pwdLenght>20) {
    $msg= '<p class="error"><em>Lunghezza minima password 8 caratteri. Lunghezza massima 20 caratteri</em></p>';
  } else {
    $password_hash= password_hash($password, PASSWORD_BCRYPT);
    $query= "
          SELECT id
          FROM users
          WHERE username = :username
    ";
    $check= $pdo->prepare($query);
    $check->bindParam(':username',$username, PDO::PARAM_STR);
    $check->execute();
    $idUser=$check->fetchAll(PDO::FETCH_ASSOC);

     if(count($idUser)>0) {
       $msg='<p class="error"><em>Username già in uso.</em></p>';
     } else {
       $query= "
           INSERT INTO users
           VALUES (0, :username, :password)
       ";
       $check= $pdo->prepare($query);
       $check->bindParam(':username',$username, PDO::PARAM_STR);
       $check->bindParam(':password', $password_hash, PDO::PARAM_STR);
       $check->execute();

       if ($check->rowCount()>0) {
        header('Location: ../login.php');
        exit;

       } else {
         $msg= '<p class="error"><em>Problemi con l\'inserimento dei dati.</em></p>';
       }
     }
  }
}
header('Location: ..\register.php?error='.$msg);
exit;
?>