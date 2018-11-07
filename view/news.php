<!DOCTYPE html>
<html>

<head>
    <!-- HEADER !-->
    <?php require_once(__DIR__ . '/partials/header.php'); ?>
</head>

<body class="main-body">

    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbar.php'); ?>

    <!-- CONTENU !-->
    <div class="content-container">
        <!-- Affichage d'une news !-->
        <?php if($allNews===false): ?>
            <div class="cover-news py-5 bg-image-full" style="background-image: url('<?php echo $newsCover ?>');">
                <div class="title-news">
                    <span class="badge badge-light "><h6><?php echo $news->getTitle();?></h6></span><br>
                    <span class="badge badge-dark"><?php echo $news->getDateCreation()->format('d-m-Y');?></span>
                    <p></p>
                </div>
            </div>
            <div id="news" class="content-news">
                <?php echo $news->getContenu(); ?>
            </div>
        <?php else: ?>
        <!-- Affichage de toutes les news !-->

            <style>
                * {
                    box-sizing: border-box;
                }
                .cards {
                    display: flex;
                    flex-wrap: wrap;
                    align-items: stretch;
                }
                .card {
                    width: 200px;
                    margin: 10px;
                    border: 1px solid #ccc;
                    box-shadow: 2px 2px 6px 0px  rgba(0,0,0,0.3);
                }
                .card img {
                    max-width: 100%;
                }
                .card .text {
                    padding: 0 20px 20px;
                }
                .card .text > button {
                    background: gray;
                    border: 0;
                    color: white;
                    padding: 10px;
                    width: 100%;
                }
                .card:nth-child(1) {
                    width: 420px;
                }
            </style>
            <main class="cards">
                <?php foreach ($news as $aNews): ?>
                <article class="card">
                    <img src="<?php echo $aNews->getImage();?>" alt="Photo news">
                    <div class="text">
                        <h3><?php echo $aNews->getTitle(); ?></h3>
                    </div>
                    <a href="/news?id=<?php echo $aNews->getId();?>"><button class="btn btn-primary rounded"> Voir </button></a>
                </article>
                <?php endforeach; ?>
            </main>
        <?php endif;?>

    </div>
    <script>
        $(document).ready(function () {

        });
    </script>
</body>
</html>
