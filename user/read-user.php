<?php
  session_start();
  require_once('../config/database.php');
  

  if (isset($_POST['login'])) {
    $username= $_POST['username'] ?? '';
    $password= $_POST['password'] ?? '';

    if(empty($username) || empty($password)) {
      $msg='<p class="error"><em>Inserisci username e password.</em></p>';
    } else {
      $query= "
          SELECT username, password
          FROM users
          WHERE username=:username
      ";
      $check=$pdo->prepare($query);
      $check->bindParam(':username',$username,PDO::PARAM_STR);
      $check->execute();

      $user=$check->fetch(PDO::FETCH_ASSOC);

      if (!$user || password_verify($password, $user['password']) === false){
        $msg= '<p class="error"><em>Credenziali utente errate.</em></p>';
      } else {
        session_regenerate_id();
        $_SESSION['session_id']=session_id();
        $_SESSION['session_user']=$user['username'];

        header('Location: ..\dashboard.php');
        exit;
      }
    }
   
  }
  header('Location: ..\login.php?error='.$msg);
  exit;

  ?>