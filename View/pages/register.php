<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/credentialsPage.css">
    <title>Register</title>
  </head>
  <body>
    <div class="centerBlock">
        <h2>Toyr - Register</h2>
        <hr>
        <form class="centralPanel" action="../../Controller/Dispatcher/register.php" method="post">
          <p>Nume</p><br>
          <input type="text" name="lastname" placeholder=""><br>
          <p>Prenume</p><br>
          <input type="text" name="firstname" placeholder=""><br>
          <p>Username</p><br>
          <input type="text" name="username" placeholder=""><br>
          <p>Parola</p><br>
          <input type="password" name="password" placeholder=""><br>
          <p>Repetați parola</p><br>
          <input type="password" name="repeat-password" placeholder=""><br>
          <p>Adresa de e-mail</p><br>
          <input type="text" name="email" placeholder=""><br>
          <input type="submit" value="Register">
        </form>
    </div>
  </body>
</html>
