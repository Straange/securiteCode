
<body>
  <title>Inscription</title>

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
				<p class="title" style="font-family: fakeserif; font-size:15vh; color:white">S'inscrire</p>
			</div>
			<form method="POST" action="signin.php">
			<div class="container divFormulaire" style="text-align:center">

				<input class="input" type="text" name="email" placeholder="Entrez un mail.."><br><br>

				<input class="input" type="password" name="mdp" placeholder="Entrez un mot de passe.."><br><br>

				<select class="input" name="role">
				 <option value="1">Employé</option>
				 <option value="2">Employeur</option>
				</select><br><br><br><br>

				<input type="submit" name="signin" value="S'inscrire" class="buttonConfirm">

			</div>
		</form>
		</div>
	</div>

	<?php include 'footer.php' ?>

</body>


<?php
	  if(isset($_POST['signin']))
	  {
	     sign();
	  }

	function sign()
	{
		if(isset($_POST['email']))
	  $mail=$_POST['email'];
	  else      $mail="";

	    if(isset($_POST['mdp']))
	    $mdp=$_POST['mdp'];
	    else      $mdp="";

	    if(isset($_POST['role']))
	    $role=$_POST['role'];
	    else      $role="";

	  if(empty($mail) || empty($mdp) || empty($mdp))
	    {
						echo "<script>alert(\"Veuillez renseigner tous les champs.\")</script>";
	    }
	    else
	    {
	      if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
	          echo "<script>alert(\"Le mail n'est pas valide.\")</script>";
	          exit();
	      }
	      $bdd = connectBdd();

        $hashed_mdp = password_hash($mdp, PASSWORD_DEFAULT);

	      $req = "INSERT INTO users(id, mail, password, roleid) VALUES('','$mail','$hashed_mdp','$role')";
	      $res = $bdd->query($req);

	      session_start();
	      $_SESSION["userid"]=$bdd->lastInsertId();

	      header('Location: profile.php');
	    }
	}
	function connectBdd(){
		return new PDO('mysql:host=localhost;dbname=secur;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
?>
