<?php

require_once("../config.php");

$u = getUserFromCookie();

if ($u == null)
{
    header("Location: /login");
    die();
}

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>
        Derniers tweets
    </title>
    <meta charset="utf-8" />
    <link rel="stylesheet" type="text/css" href="assets/styles/feed.css" />
    <script src="/assets/js/general.js"><</script>
    <script src="/assets/js/post.js"><</script>
</head>
<body>
<?php require "menu.php"; ?>
<div class="column-wrapper">
    <h1>
        - Derniers Tweets -
    </h1>

    <?php
    $limit = 50;
    $people = $u->getSubscriptions();
    $posts = Post::findPosts($people, $limit);
        ?>
    <div class="post-feed">
        <?php
        foreach ($posts as $post){
            if ($post->getRepostID() == null)
                affichePost($post);
            else
                afficheRepost($post);
        }
        ?>
    </div>
</div>
</body>
</html>