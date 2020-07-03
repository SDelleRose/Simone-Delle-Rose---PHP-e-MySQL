<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>registrati</title>
    <link rel="stylesheet" href="style.css?ts=<?=time()?>&quot">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
  </head>
  <body class='page'>

    <div style="height:100vh; display: table-cell; vertical-align: middle; width: 100vw;">
      <div class="box">
        <h3>registrati</h3>
        <?php  $msg= $_GET['error'] ?? ''; echo $msg; ?>
        <form action='user/create-user.php' method='post'>
          <p>Username</p>
          <input class="add-credentials" type="username" name="username" id="username" maxlength="20" minlength="3" required/>

          <p>Password</p>
          <input class="add-credentials" type="password" id="password" name="password" placeholder="Minimo 8 caratteri" maxlength="20" minlength="8" required/>
          <button type="submit" name="register">registrati</button>
        </form>
        <a href="home.html">Torna alla home</a>

      </div>

    </div>

  </body>
</html>

