<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Erwan Carlini">
		<meta name="description" content="">
		<meta name="copyright" content="Erwan Carlini">
		<meta name="keywords" content="">
		<title>Erwan Carlini - Portfolio</title>
		<link rel="icon" type="" href="">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Parisienne&display=swap" rel="stylesheet">
		<!-- Bootstrap -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		<!-- Fin bootstrap -->
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="stylesheet" type="text/css" href="responsive.css">
		
	</head>

	<body>

		<?php include('header.php'); ?>

		<?php 
			if(isset($_SESSION['FlashValidConnection'])) { 
		?>
				<div class="alert alert-success" role="alert">
					<?php 
						$message = $_SESSION['FlashValidConnection'];
                        unset($_SESSION['FlashValidConnection']);
                        echo $message;
					?>
				</div>
		<?php 
		} 
		?>

		<div class="mainpart">    			
			<div class="logoname">
				<img alt="Logo professionnel" src="images/logodev"/>
			</div>
			
			<div class="catchingwords">
				<div>
					<h1>Erwan Carlini, développeur d'applications PhP</h1>
				</div>
				<div>
					<h4><em>"Permettez vous le luxe d'engager le développeur qui répondra à vos exigeances et réalisez vos rêves professionels les plus majestueux avec le concepteur / développeur d'applications PhP qu'il vous faut, Erwan Carlini."</em></h4>
				</div>
				<div class="socialmedia">
					<h4>Réseaux sociaux :</h4>
					<a href="https://www.linkedin.com/in/erwan-carlini-711a1a134/"><img alt="Logo LinkedIn" src="images/linkedinlogo.png" /></a>
					<a href="https://github.com/ErwanCarl"><img alt="Logo GitHub" src="images/Githublogo.png"/></a>
				</div> 
			</div>			
		</div>

		<div class="cv">
			<div>
				<h4>Curriculum Vitae</h4>
			</div>
			<div>
				<a href="images/CV%20-%20062022.pdf"><img src="images/download_logo.png" /></a>
			</div>
		</div>

		<hr class="homeBar">

		<div class="creation">
			<h2>Créations</h2>
			<div class="global_work">
				<?php 
					foreach ($posts as $post) {
				?>
			
				<div class="work_creation">
					<h4>
						<?php echo htmlspecialchars($post['title']); ?>
					</h4>
					<h4>
						<?php echo htmlspecialchars($post['author']); ?>
						- <?php echo htmlspecialchars($post['creation_date']); ?>
					</h4>

					<a href="index.php?action=post&id=<?= urlencode($post['id']) ?>">Accéder au Blog Post</a>
				</div>

				<?php
					}
				?>		
			</div>		
		</div>

		<hr class="homeBar">

		<div class="form_contact">
			<form action="index.php" method="post">
				<h2>Contact</h2>

				<div class="form_case">
					<label for="name">Prénom / Nom</label>
					<input required type="text" name="name" id="name">
				</div>

				<div class="form_case">
					<label for="email">Email</label>
					<input required type="email" name="email" id="email">
				</div>

				<div class="form_case">
					<label for="message">Message</label>
					<textarea required name="message" id="message" rows="5" cols="50"></textarea>  
				</div>

				<div class="form_case2">						
					<input required type="checkbox" name="rgpd" id="rgpd"> 
					<label for="rgpd">Accord RGPD </label>
				</div>
			
				<div class="form_button">
					<button type="submit">Envoyer</button>
				</div>
			</form>
		</div>
		

        <?php include('footer.php'); ?>

	</body>
</html>
