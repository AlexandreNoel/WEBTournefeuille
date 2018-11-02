
<!DOCTYPE html>
<html>

  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/images/favicon.ico">
    <title>Le Bar D - Console</title>
    <!-- Ressources -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <!-- Font Awesome JS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/bard_main.css">
    <link rel="stylesheet" href="css/form-style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
    <!-- NAVBAR !-->
    <?php require_once(__DIR__ . '/partials/navbar.php'); ?>

<!-- CONTENU !-->
<div class="content-container">
<div class="container">



		<section class="content">
			<h1>Catégories</h1>
			<div class="col-md-8  col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
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
														?><img src="../assets/images/soda.jpg" class="media-photo"><?
														break;
													case 'Friandise':
														?><img src="../assets/images/friandise.jpg" class="media-photo"><?
														break;
													case 'Snack':
														?><img src="../assets/images/pizza.jpg" class="media-photo"><?
														break;
													case 'Boissons Chaudes':
														?><img src="../assets/images/boisson_chaude.jpg" class="media-photo"><?
														break;
													default:
														?><img src="../assets/images/cross.png" class="media-photo"><?
       													break;
													}
												?></td><td>



												
													
												<div class="media-body">
													<span class="media-meta pull-right"></span>
													<h4 class="title">
													<?php echo $product->getName()?> 
													</td><td>
														<span class="pull-right pagado"><?php echo $product->getPrice()?> €</span>
													</h4>
													<p class="summary">

													
												
												</div>
											</div>
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