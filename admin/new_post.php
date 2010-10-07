<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

?>
<!doctype html>
<html>
  <head>
    <title>New Post - Admin - The Blog</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="users.php">Manage users</a></li>
          <li><a href="posts.php">Manage posts</a></li>
          <li><a href="comments.php">Manage comments</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <section id="new_post">
      <form action="create_post.php" method="post">
        <?php $_SESSION["token"] = $token = md5(date(DATE_ATOM)."--".mt_rand(1,9999)."--secret") ?>
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <h1>New Post</h1>
        <input type="hidden" name="post[user_id]" value="<?php echo $_SESSION["user_id"] ?>">
        <p>
          <label for="post_title">Title:</label>
          <input type="text" name="post[title]" id="post_title">
        </p>
        <p>
          <label for="post_body">Message:</label>
          <textarea name="post[body]" id="post_body" rows="12" cols="40"></textarea>
        </p>
        <p>
          <button type="submit">Create post</button>
        </p>
      </form>
    </section>

  </body>
</html>



