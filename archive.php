<?php

require_once("lib/db.php");

$posts_result = $db->query("select * from posts order by id DESC");

function comments_count($post_id) {
  global $db;

  $post_id_e = $db->real_escape_string($post_id);

  $result = $db->query("select count(*) as count from comments where post_id = '$post_id_e'");
  $row = $result->fetch_assoc();
  return $row["count"];
}

?>
<!doctype html>
<html>
  <head>
    <title>The Blog</title>
  </head>
  <body>
    <header>
    </header>

    <section id="posts">
      <h1>Archive of all posts</h1>
    
      <?php while ($post = $posts_result->fetch_assoc()) { ?>
        <article>
          <header>
            <h1>
            <a href="post.php?id=<?php echo $post["id"] ?>">
                <?php echo $post["title"] ?>
              </a>
            </h1>
          </header>
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

