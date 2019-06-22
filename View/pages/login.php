<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" type="text/css" href="../css/credentialsPage.css">
    <title>Login</title>
  </head>
  <body>
    <div class="centerBlock">
        <h2>Toyr - Login</h2>
        <hr>
        <form class="centralPanel" onSubmit = "return loginCheck(this)" action="../../Controller/Dispatcher/login.php" method="post">
          <p>Username</p><br>
          <input type="text" name="username" placeholder=""><br>
          <p>Parola</p><br>
          <input type="password" name="password" placeholder=""><br>
          <input type="submit" value="Login">
        </form>
    </div>
    <script type="text/javascript" src="../js/loginCheck.js"></script>
  </body>
</html>
