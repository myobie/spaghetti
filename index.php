<!doctype html>
<?php

error_reporting(-1);
ini_set("display_errors", 1);
require_once("lib/db.php");

$posts_result = $db->query("select * from posts limit 3");

function comments_count($post_id) {
  global $db;

  $result = $db->query("select count(*) as count from comments where post_id = '$post_id'");
  $row = $result->fetch_assoc();
  return $row["count"];
}

?>
<html>
  <head>
    <title>The Blog</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="archive.php">Archive</a></li>
        </ul>
      </nav>
    </header>

    <section id="posts">
      <h1>Recent blog posts</h1>
    
      <?php while ($post = $posts_result->fetch_assoc()) { ?>
        <article>
          <header>
            <h1>
            <a href="post.php?id=<?php echo $post["id"] ?>">
                <?php echo $post["title"] ?>
              </a>
            </h1>
          </header>
          <?php echo $post["body_rendered"] ?>
          <footer>
            <p>
              <?php echo comments_count($post["id"]); ?> comments
            </p>
          </footer>
        </article>
      <?php } ?>
    </section>

  </body>
</html>
