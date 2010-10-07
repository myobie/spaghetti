<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

$users_result = $db->query("select * from users order by email ASC");

?>
<!doctype html>
<html>
  <head>
    <title>Users - Admin - The Blog</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="posts.php">Manage posts</a></li>
          <li><a href="new_post.php">Create a new post</a></li>
          <li><a href="comments.php">Manage comments</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <section id="create_user">
      <h1>Create a new user</h1>
      <form action="create_user.php" method="post">
        <?php $_SESSION["token"] = $token = md5(date(DATE_ATOM)) ?>
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <p>
          <label for="user_name">Name:</label>
          <input type="text" name="user[name]" id="user_name">
        </p>
        <p>
          <label for="user_email">Email:</label>
          <input type="text" name="user[email]" id="user_email">
        </p>
        <p>
          <label for="user_password">Password:</label>
          <input type="text" name="user[password]" id="user_password">
        </p>
        <p>
          <label for="user_password_confirmation">Password confirmation:</label>
          <input type="text" name="user[password_confirmation]" id="user_password_confirmation">
        </p>
        <p>
          <button type="submit">Create user</button>
        </p>
      </form>
    </section>

    <section id="users">
      <h1>Users</h1>
    
      <ul>
        <?php while ($user = $users_result->fetch_assoc()) { ?>
          <li>
            <a href="edit_user.php?id=<?php echo $user["id"] ?>">
              <?php echo $user["email"] ?>
            </a>
          </li>
        <?php } ?>
      </ul>
    </section>

  </body>
</html>


