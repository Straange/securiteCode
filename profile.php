
<body>
  <title>Profil</title>

  <?php
	function connectBdd(){
		return new PDO('mysql:host=localhost;dbname=secur;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}

  session_start();

  if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
      $userId = $_SESSION['userid'];
      $bdd = connectBdd();

      $res = $bdd->query("SELECT * FROM users WHERE id = $userId LIMIT 1");

      while($row = $res->fetch()){
        $mail = $row['mail'];
        $role = $row['roleId'];
      }

      $res = $bdd->query("SELECT * FROM roles WHERE id = $role LIMIT 1");
      while($row = $res->fetch()){
        $nomrole = $row['nom'];
      }
  }
  else header('Location: home.php');
  ?>

	<?php include 'ressource.php' ?>

  <div class="content">
    <div style="text-align:right">
  <form method="POST" action="profile.php">
    <button type="submit" name="deconnexion" class="btnlogout"><i class='fas fa-sign-out-alt'></i>Se déconnecter</button>
  </form>
</div>

  <?php
  if(isset($_POST['deconnexion']))
  {
     clearsessionuser();
  }
  function clearsessionuser()
  {
    unset($_SESSION["userid"]);
    header('Location: home.php');
  }
  ?>

  <div class="divPrincipale" style="padding-top:5vh">
  <div class="divTitle container" style="text-align:center">
  <p class="title" style="font-family: fakeserif; font-size:15vh; color:white">Votre profil</p>
  </div>
  <div class="container divFormulaire" style="text-align:center">

  <span style="color:white; font-weight:bold; font-size: 18px">Mail : </span><input class="input" type="text" name="email" placeholder="<?php echo $mail ?>" disabled><br><br>

  <span style="color:white; font-weight:bold; font-size: 18px">Rôle : </span><input class="input" type="text" name="mdp" placeholder="<?php echo $nomrole ?>" disabled><br><br>

  <div class="divFormulaire">
      <a href="listeusers.php">Voir les utilisateurs avec le même rôle</a>
  </div>
</div>
  </div>
  </div>
  	<?php include 'footer.php' ?>
</body>
