<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

$id = $db->real_escape_string($_GET["id"]);
$user_result = $db->query("select * from users where id = '$id'");
$user = $user_result->fetch_assoc();

?>
<!doctype html>
<html>
  <head>
  <title>Editing <?php echo $user["email"] ?> - Admin - The Blog</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="users.php">Manage users</a></li>
          <li><a href="posts.php">Manage posts</a></li>
          <li><a href="new_post.php">Create a new post</a></li>
          <li><a href="comments.php">Manage comments</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <section id="edit_user">
      <form action="update_user.php" method="post">
        <?php $_SESSION["token"] = md5(date(DATE_ATOM)) ?>
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <h1>Editing <?php echo $user["email"] ?></h1>
        <?php if (isset($_GET["updated"])) { ?>
          <p>Updated successfully.</p>
        <?php } ?>
        <input type="hidden" name="user[id]" value="<?php echo $user["id"] ?>">
        <p>
          <label for="user_name">Name:</label>
          <input type="text" name="user[name]" id="user_name" value="<?php echo $user["name"] ?>">
        </p>
        <p>
          <label for="user_email">Email:</label>
          <input type="text" name="user[email]" id="user_email" value="<?php echo $user["email"] ?>">
        </p>
        <p>
          <button type="submit">Update user</button>
        </p>
      </form>
    </section>
    <hr>
    <section id="edit_user_password">
      <form action="update_user_password.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <h1>Change <?php echo $user["email"] ?>'s password</h1>
        <?php if (isset($_GET["updated_password"])) { ?>
          <p>Updated successfully.</p>
        <?php } ?>
        <?php if (isset($_GET["password_error"])) { ?>
          <p>Your passwords didn't match.</p>
        <?php } ?>
        <input type="hidden" name="user[id]" value="<?php echo $user["id"] ?>">
        <p>
          <label for="user_password">Password:</label>
          <input type="text" name="user[password]" id="user_password">
        </p>
        <p>
          <label for="user_password_confirmation">Password confirmation:</label>
          <input type="text" name="user[password_confirmation]" id="user_password_confirmation">
        </p>
        <p>
          <button type="submit">Update user's password</button>
        </p>
      </form>
    </section>
    <hr>
    <section id="delete_user">
      <form action="delete_user.php" method="post" id="delete_form">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <input type="hidden" name="id" value="<?php echo $user["id"] ?>">
        <button type="submit">Delete this user</button>
      </form>

      <script>
        document.getElementById("delete_form").onsubmit = function() {
          var answer = confirm("Are you sure you want to delete this user? There is no undo.");
          if (!answer) { return false; }
        };
      </script>
    </section>

  </body>
</html>




