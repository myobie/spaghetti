<?php

error_reporting(-1);
ini_set("display_errors", 1);
require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

$comments_result = $db->query("select * from comments order by id DESC limit 5");

?>
<!doctype html>
<html>
  <head>
    <title>Admin - The Blog</title>
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

    <section id="comments">
      <h1>Recent comments</h1>
    
      <?php while ($comment = $comments_result->fetch_assoc()) { ?>
        <article>
          <header>
            <h1>
              <a href="edit_comment.php?id=<?php echo $comment["id"] ?>">
                <?php echo $comment["name"] ?> - <?php echo $comment["email"] ?> - Post: <?php echo $comment["post_id"] ?>
              </a>
            </h1>
          </header>
          <?php echo $comment["body_rendered"] ?>
        </article>
      <?php } ?>
    </section>

  </body>
</html>

