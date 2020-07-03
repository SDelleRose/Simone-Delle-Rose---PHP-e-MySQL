  <!DOCTYPE html>
  <html lang="it" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>todolist</title>
      <link rel="stylesheet" href="style.css?ts=<?=time()?>&quot">
      <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0' />
    </head>
    <body>


      <header>
        <div class='logout'><a href="user/exit-user.php">LOGOUT</a></div>
        <div class='title'><p>List<em>me</em></p></div> 
      </header>

      <div class='date-add'>
        <div class='date'> <?php setlocale(LC_TIME, 'ita', 'it_IT'); ?>
          <div class='day1'><p> <?php echo strftime('%d')  ?> </p></div>
          <div class='day2'><p> <?php echo utf8_encode(strftime('%A'))  ?></p></div>
          <p> <?php echo strftime('%B %Y')  ?></p>
        </div>
        <div class='add-link'><a href="#add">Aggiungi nota</a></div>
      </div>



      <div class='lists-container'>
      <?php while ($row=$list->fetch(PDO::FETCH_ASSOC)) { ?>
       <div class='lists'>  
        <div class='status-list'>
          <?php if ($row['status']===1) {   ?>
            <form action="list/update-list.php" method="post">
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <button type="submit" name="status1" class="list-done"></button>
            </form>
           <?php } else { ?>
            <form action="list/update-list.php" method="post">
              <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
              <button type="submit" name="status0" class="list-not-done"></button>
            </form>  
          <?php }; ?>
        </div>

        <div class='date-list'><p><?php echo $row['date'] ?></p></div>
        <div class='info-list'>
          <p class='title-list'><?php echo $row['title'] ?></p>
          <p class='description-list'><?php echo $row['description'] ?></p>
        </div>
           
        <div class='delete-list'>
          <form action="list/delete-list.php" method="post">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <button class='delete' type="submit" name="delete">x</button>
          </form>
        </div>
        <br>
        </div>
    <?php }; ?>
    </div>


    <form class='form-add' id='add' action="list/create-list.php" method="post">
        <input class='add-title' type="text" name="title" maxlength="20" autocomplete='off' placeholder='Aggiungi la tua nota qui..' required>
        <textarea name="description" placeholder='Descrizione opzionale..' maxlength="200" cols="80" rows="8"></textarea>

        <button class='add' type="submit" name="add">+</button>
    </form>

    </body>
  </html>