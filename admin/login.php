<?php

require_once("../lib/db.php");
@session_start();

?>
<!doctype html>
<html>
  <head>
    <title>Login - The Blog</title>
  </head>
  <body>

    <section id="login">
      <form action="create_login.php" method="post">
        <?php $_SESSION["token"] = md5(date(DATE_ATOM)."--".mt_rand(1,9999)."--secret") ?>
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <h1>Login</h1>
        <?php if (isset($login_error)) { ?>
          <p>Sorry, there was an error with your email and/or password. Try again.</p>
        <?php } ?>
        <p>
          <label for="email">Email:</label>
          <input type="text" name="email" id="email" value="<?php 
            if (isset($_POST["email"])) { echo $_POST["email"]; } 
          ?>">
        </p>
        <p>
          <label for="password">Password:</label>
          <input type="text" name="password" id="password">
        </p>
        <p>
          <button type="submit">Login</button>
        </p>
      </form>
    </section>

  </body>
</html>

