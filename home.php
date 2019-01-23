
<body>
  <title>Accueil</title>

  <?php include 'ressource.php' ?>

  <?php
  session_start();

  if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
		header('Location: profile.php');

	};
	?>

<div class="content">
	<div class="divPrincipale" style="padding-top:26vh">
		<div class="divTitle container" style="text-align:center">
			<p class="title" style="font-family: fakeserif; font-size:15vh; color:white">Website</p>
		</div>
		<div class="container divFormulaire" style="text-align:center">
			  <a href="signin.php">S'inscrire</a>
				<a href="login.php">S'authentifier</a>
		</div>
	</div>
</div>

<?php include 'footer.php' ?>

</body>
