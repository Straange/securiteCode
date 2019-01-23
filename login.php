
<body>
  <title>Connexion</title>

	<?php
	  session_start();

	  if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
			header('Location: profile.php');
		};
		?>

	<?php include 'ressource.php' ?>


	<div class="content">
		<div class="btnCorner">
			<i class="fas fa-home"></i> <a href="home.php">Accueil</a>
		</div>

		<div class="divPrincipale" style="padding-top:5vh">
			<div class="divTitle container" style="text-align:center">
				<p class="title" style="font-family: fakeserif; font-size:15vh; color:white">Se connecter</p>
			</div>

			<form method="POST" action="login.php">
			<div class="container divFormulaire" style="text-align:center">

				<input class="input" type="text" name="email" placeholder="Entrez votre mail.."><br><br>

				<input class="input" type="password" name="mdp" placeholder="Entrez votre mot de passe.."><br><br>

				</select><br><br><br><br>

				<div class="form-group">
					<input type="submit" name="login" value="Se connecter" class="buttonConfirm">
				</div>

			</div>
		</form>
		</div>
	</div>


		<?php include 'footer.php' ?>
	  <?php
		function connectBdd(){
			return new PDO('mysql:host=localhost;dbname=secur;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}

	  if(isset($_POST['login']))
	  {
	     login();
	  }
		function login(){
	      $bdd = connectBdd();

				$mail = $_POST['email'];
				$mdp = $_POST['mdp'];

	      $res = $bdd->query("SELECT * FROM users WHERE mail = '$mail'");

				if($res->rowCount() > 0)
				{
		      while($row = $res->fetch()){
		        $id = $row['id'];
						$hashed_password = $row['password'];
		      }

					if(password_verify($mdp, $hashed_password)) {
				      $_SESSION["userid"]=$id;
							header('Location: profile.php');
					} else
							echo "<script>alert(\"Mot de passe incorrect.\")</script>";

				}
				else {
			      if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			          echo "<script>alert(\"Utilisateur introuvable.\")</script>";
			          exit();
			      }
				}
		}
		?>
</body>
