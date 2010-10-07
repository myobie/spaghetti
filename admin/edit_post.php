<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

$id = $db->real_escape_string($_GET["id"]);
$post_result = $db->query("select * from posts where id = '$id'");
$post = $post_result->fetch_assoc();

?>
<!doctype html>
<html>
  <head>
    <title>Editing <?php echo $post["title"] ?> (#<?php echo $post["id"] ?>) - Admin - The Blog</title>
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

    <section id="edit_post">
      <form action="update_post.php" method="post">
        <?php $_SESSION["token"] = md5(date(DATE_ATOM)."--".mt_rand(1,9999)."--secret") ?>
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <h1>Editing <?php echo $post["title"] ?> (#<?php echo $post["id"] ?>)</h1>
        <?php if (isset($_GET["updated"])) { ?>
          <p>Updated successfully.</p>
        <?php } ?>
        <input type="hidden" name="post[id]" value="<?php echo $post["id"] ?>">
        <input type="hidden" name="post[user_id]" value="<?php echo $post["user_id"] ?>">
        <p>
          <label for="post_title">title:</label>
          <input type="text" name="post[title]" id="post_title" value="<?php echo $post["title"] ?>">
        </p>
        <p>
          <label for="post_body">Message:</label>
          <textarea name="post[body]" id="post_body" rows="12" cols="40"><?php echo $post["body"] ?></textarea>
        </p>
        <p>
          <button type="submit">Update post</button>
        </p>
      </form>
    </section>
    <hr>
    <section id="delete_post">
      <form action="delete_post.php" method="post" id="delete_form">
        <input type="hidden" name="token" value="<?php echo $_SESSION["token"] ?>">
        <input type="hidden" name="id" value="<?php echo $post["id"] ?>">
        <button type="submit">Delete this post</button>
      </form>

      <script>
        document.getElementById("delete_form").onsubmit = function() {
          var answer = confirm("Are you sure you want to delete this post? There is no undo.");
          if (!answer) { return false; }
        };
      </script>
    </section>

  </body>
</html>


