<?php

require_once("lib/db.php");

$post_id = $_GET["id"];
$post_result = $db->query("select * from posts where id = '$post_id'");
$post = $post_result->fetch_assoc();

function comments_result($post_id) {
  global $db;

  return $db->query("select * from comments where post_id = '$post_id'");
}

?>
<!doctype html>
<html>
  <head>
  <title><?php echo $post["title"] ?> - The Blog</title>
  </head>
  <body>
    <header>
      <nav>
        <ul>
          <li><a href="index.php">Recent Posts</a></li>
          <li><a href="archive.php">Archive</a></li>
        </ul>
      </nav>
    </header>

    <section id="posts">
        <article>
          <header>
            <h1>
              <?php echo $post["title"] ?>
            </h1>
          </header>
          <?php echo $post["body_rendered"] ?>
          <footer>
            <h1>Comments</h1>
            <?php 
              $comments_result = comments_result($post["id"]);
              while ($comment = $comments_result->fetch_assoc()) { 
            ?>
              <article>
                <h1><?php echo $comment["name"] ?> said:</h1>
                <?php echo $comment["body_rendered"] ?>
              </article>
            <?php } ?>

            <form action="add_comment.php" method="post">
              <h1>Add a comment</h1>
              <input type="hidden" name="comment[post_id]" value="<?php echo $post["id"] ?>">
              <p>
                <label for="comment_name">Name:</label>
                <input type="text" name="comment[name]" id="comment_name">
              </p>
              <p>
                <label for="comment_email">Email:</label>
                <input type="text" name="comment[email]" id="comment_email">
              </p>
              <p>
                <label for="comment_body">Message:</label>
                <textarea name="comment[body]" id="comment_body" rows="12" cols="40"></textarea>
              </p>
              <p>
                <button type="submit">Add comment</button>
              </p>
            </form>

          </footer>
        </article>
    </section>

  </body>
</html>

