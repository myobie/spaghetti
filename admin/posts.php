<?php

error_reporting(-1);
ini_set("display_errors", 1);
require_once("../lib/db.php");
require_once("../lib/admin_helpers.php");

require_login();

$posts_result = $db->query("select * from posts order by id DESC");

?>
<!doctype html>
<html>
  <head>
    <title>All Posts - Admin - The Blog</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="users.php">Manage users</a></li>
          <li><a href="new_post.php">Create a new post</a></li>
          <li><a href="comments.php">Manage comments</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <section id="posts">
      <h1>All posts</h1>
    
      <?php while ($post = $posts_result->fetch_assoc()) { ?>
        <article>
          <header>
            <h1>
              <a href="edit_post.php?id=<?php echo $post["id"] ?>">
                <?php echo $post["title"] ?>
              </a>
              (#<?php echo $post["id"] ?>)
            </h1>
          </header>
          <?php echo $post["body_rendered"] ?>
        </article>
      <?php } ?>
    </section>

  </body>
</html>

