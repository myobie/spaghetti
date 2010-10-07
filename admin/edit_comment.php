<?php

require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

$id = $db->real_escape_string($_GET["id"]);
$comment_result = $db->query("select * from comments where id = '$id'");
$comment = $comment_result->fetch_assoc();

?>
<!doctype html>
<html>
  <head>
  <title>Editing <?php echo $comment["name"] ?> - <?php echo $comment["email"] ?> - Post: <?php echo $comment["post_id"] ?> - Admin - The Blog</title>
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

    <section id="edit_comment">
      <form action="update_comment.php" method="post">
        <?php $_SESSION["token"] = $token = md5(date(DATE_ATOM)) ?>
        <input type="hidden" name="token" value="<?php echo $token ?>">

        <h1>Editing <?php echo $comment["name"] ?> - <?php echo $comment["email"] ?> - Post: <?php echo $comment["post_id"] ?></h1>
        <?php if (isset($_GET["updated"])) { ?>
          <p>Updated successfully.</p>
        <?php } ?>
        <input type="hidden" name="comment[id]" value="<?php echo $comment["id"] ?>">
        <input type="hidden" name="comment[post_id]" value="<?php echo $comment["post_id"] ?>">
        <p>
          <label for="comment_name">Name:</label>
          <input type="text" name="comment[name]" id="comment_name" value="<?php echo $comment["name"] ?>">
        </p>
        <p>
          <label for="comment_email">Email:</label>
          <input type="text" name="comment[email]" id="comment_email" value="<?php echo $comment["email"] ?>">
        </p>
        <p>
          <label for="comment_body">Message:</label>
          <textarea name="comment[body]" id="comment_body" rows="12" cols="40"><?php echo $comment["body"] ?></textarea>
        </p>
        <p>
          <button type="submit">Update comment</button>
        </p>
      </form>
    </section>
    <hr>
    <section id="delete_comment">
      <form action="delete_comment.php" method="post" id="delete_form">
        <?php $_SESSION["token"] = $token = md5(date(DATE_ATOM)) ?>
        <input type="hidden" name="token" value="<?php echo $token ?>">
        <input type="hidden" name="id" value="<?php echo $comment["id"] ?>">
        <button type="submit">Delete this comment</button>
      </form>

      <script>
        document.getElementById("delete_form").onsubmit = function() {
          var answer = confirm("Are you sure you want to delete this comment? There is no undo.");
          if (!answer) { return false; }
        };
      </script>
    </section>

  </body>
</html>



