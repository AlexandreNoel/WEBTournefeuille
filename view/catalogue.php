
<!DOCTYPE html>
<html>

<!-- HEADER !-->
<?php require_once(__DIR__ . '/partials/header.php'); ?>

<body>

    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbar.php'); ?>

    <!-- CONTENU !-->
    <div class="content-container">
        <div class="container">
            <section class="content">

                <div class="col-md-8  col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h1>Catégories</h1>
                            <div class="pull-right">
                                <div class="btn-group">
                                <?php foreach ($categories as $category){ ?>
                                    <button type="button" class="btn btn-success btn-filter" data-target="<?php echo $category["libelle"];?>"><?php echo $category["libelle"];?></button>

                                 <?php }?>
                                <button type="button" class="btn btn-default btn-filter" data-target="all">Tous</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-container">

                            <table class="table table-filter" style="width: 90%;">
                                <tbody>
                                <!-- Début Article !-->
                                <?php foreach ($productslist as $category => $values):?>
                                <?php foreach($values as $product): ?>
                                                <?php if (!is_null($product)):?>
                                    <tr data-status="<?php echo $category?>" >

                                        <td>
                                            <div class="media">

                                                <? switch ($category) {
                                                    case 'Boisson':
                                                        ?><img src="../assets/images/soda.jpg" class="media-photo" /><?
                                                        break;
                                                    case 'Friandise':
                                                        ?><img src="../assets/images/friandise.jpg" class="media-photo" /><?
                                                        break;
                                                    case 'Snack':
                                                        ?><img src="../assets/images/pizza.jpg" class="media-photo" /><?
                                                        break;
                                                    case 'Boissons Chaudes':
                                                        ?><img src="../assets/images/boisson_chaude.jpg" class="media-photo" /><?
                                                        break;
                                                    default:
                                                        ?><img src="../assets/images/cross.png" class="media-photo" /><?
                                                        break;
                                                    }
                                                ?>
                                        </td>
                                        <td>
                                            <div class="media-body">
                                                <span class="media-meta pull-right"></span>
                                                <h4 class="title">
                                                <?php echo $product->getName()?>
                                                </h4>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="pull-right pagado"><?php echo $product->getPrice()?> €</span>
                                            <p class="summary">
                                        </td>
                                    </tr>

                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php endforeach; ?>
                                        <!-- fin Article !-->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                </div>
            </section>
    </div>

</div>

    <script>
    $(document).ready(function () {

    $('.star').on('click', function () {
      $(this).toggleClass('star-checked');
    });

    $('.ckbox label').on('click', function () {
      $(this).parents('tr').toggleClass('selected');
    });

    $('.btn-filter').on('click', function () {
      var $target = $(this).data('target');
      if ($target != 'all') {
        $('.table tr').css('display', 'none');
        $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
      } else {
        $('.table tr').css('display', 'none').fadeIn('slow');
      }
    });

    });
    </script>
</body>
</html>