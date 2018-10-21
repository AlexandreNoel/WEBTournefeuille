<?php
require '../vendor/autoload.php';
session_start();
?>

<html>
<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="./sidebar.css?v=<?=time();?>">
    <link rel="stylesheet" href="./phatadvisor.css?v=<?=time();?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h3><?php echo 'Hello world from Docker! php' . PHP_VERSION; ?></h3>
    <h4><?php if(isset($_SESSION['name'])){echo $_SESSION['name']; } else { echo "not connected";} ?></h4>
    <button style="<?php if(isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = 'view/connect.php';">connect</button>

    <button style="<?php if(isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = 'view/register.php';">register</button>
    <button style="<?php if(!isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = '/disconnect.php';">disconnect</button>
    <button style="<?php if(!isset($_SESSION['name'])){echo "display:none";}else{echo "";} ?>" type="button" onclick="location.href = '/account-user.php';">My account</button>
    <button style="<?php if (!isset($_SESSION['id'])) {
                        echo "display:none";
                    } else {
                        echo "";
                    } ?>" type="button" onclick="location.href = '/favorites-user.php';">My favorites</button>
    <button style="<?php if (!isset($_SESSION['isadmin']) || !$_SESSION['isadmin']) {
        echo "display:none";
    } else {
        echo "";
    } ?>" type="button" onclick="location.href = '/index_user.php';">user list</button>

    <div id="restos">

        <? if (isset($_SESSION['isadmin']) && $_SESSION['isadmin']) :?>
            <button type="button" onclick="location.href = 'view/add-restaurant.php';">add resto</button>
        <? endif?>

        <table class="table table-bordered table-hover table-striped">
            <thead style="font-weight: bold">
            <td>resto name</td>
            <td>resto addr</td>
            <td>resto city</td>
            </thead>
            <?php
            /** @var \User\User $user */
            foreach ($restos as $resto) : ?>
                <tr>
                    <td><?php echo $resto->getName() ?></td>
                    <td><?php echo $resto->getAddress() ?></td>
                    <td><?php echo $resto->getCity() ?></td>

                    <td>
                        <? if (isset($_SESSION['isadmin']) && $_SESSION['isadmin'] && !$resto->isDeleted()) :?>
                            <form action="delete-restaurant.php" method="post">
                                <input type="hidden" name="id_resto" value="<?php echo $resto->getId() ?>">
                                <input type="submit" value="Delete"/>
                            </form>
                        <? endif?>
                        <form action="description-restaurant.php" method="post">
                            <input type="hidden" name="id_resto" value="<?php echo $resto->getId() ?>">
                            <input type="submit" value="description"/>
                        </form>
                        <? if (isset($_SESSION['id']) && $_SESSION['id']) : ?>
                        <form action="add-favorite-restaurant.php" method="post">
                            <input type="hidden" name="id_resto" value="<?php echo $resto->getId() ?>">
                            <input type="submit" value="add favorite"/>
                        </form>
                        <? endif ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div>

</div>
    <div id="header" class="grad row">
        <div class="col-xs-1">
        <button type="button" class="hamburger" data-toggle="offcanvas">
            <span class="hamb-top"></span>
            <span class="hamb-middle"></span>
            <span class="hamb-bottom"></span>
        </button>
        </div>
        <span class="col-xs-3">Phat' Advisor</span>
    </div>
    <div id="wrapper">
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li>
                    <a href="#"><i class="fas fa-home"></i>Home</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-taxi"></i>Services</a>
                </li>
                <li>
                    <a href="#"><i class="fas fa-phone"></i>Contact</a>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <h1>Fancy Toggle Sidebar Navigation</h1>
                        <p>Bacon ipsum dolor sit amet tri-tip shoulder tenderloin shankle. Bresaola tail pancetta ball tip doner meatloaf corned beef. Kevin pastrami tri-tip prosciutto ham hock pork belly bacon pork loin salami pork chop shank corned beef tenderloin meatball cow. Pork bresaola meatloaf tongue, landjaeger tail andouille strip steak tenderloin sausage chicken tri-tip. Pastrami tri-tip kielbasa sausage porchetta pig sirloin boudin rump meatball andouille chuck tenderloin biltong shank </p>
                        <p>Pig meatloaf bresaola, spare ribs venison short loin rump pork loin drumstick jowl meatball brisket. Landjaeger chicken fatback pork loin doner sirloin cow short ribs hamburger shoulder salami pastrami. Pork swine beef ribs t-bone flank filet mignon, ground round tongue. Tri-tip cow turducken shank beef shoulder bresaola tongue flank leberkas ball tip.</p>
                        <p>Filet mignon brisket pancetta fatback short ribs short loin prosciutto jowl turducken biltong kevin pork chop pork beef ribs bresaola. Tongue beef ribs pastrami boudin. Chicken bresaola kielbasa strip steak biltong. Corned beef pork loin cow pig short ribs boudin bacon pork belly chicken andouille. Filet mignon flank turkey tongue. Turkey ball tip kielbasa pastrami flank tri-tip t-bone kevin landjaeger capicola tail fatback pork loin beef jerky.</p>
                        <p>Chicken ham hock shankle, strip steak ground round meatball pork belly jowl pancetta sausage spare ribs. Pork loin cow salami pork belly. Tri-tip pork loin sausage jerky prosciutto t-bone bresaola frankfurter sirloin pork chop ribeye corned beef chuck. Short loin hamburger tenderloin, landjaeger venison porchetta strip steak turducken pancetta beef cow leberkas sausage beef ribs. Shoulder ham jerky kielbasa. Pig doner short loin pork chop. Short ribs frankfurter rump meatloaf.</p>
                        <p>Filet mignon biltong chuck pork belly, corned beef ground round ribeye short loin rump swine. Hamburger drumstick turkey, shank rump biltong pork loin jowl sausage chicken. Rump pork belly fatback ball tip swine doner pig. Salami jerky cow, boudin pork chop sausage tongue andouille turkey.</p>                         
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="./sidebar.js?v=<?=time();?>"></script>
