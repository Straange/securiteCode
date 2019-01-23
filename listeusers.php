
	  <?php
		function connectBdd(){
			return new PDO('mysql:host=localhost;dbname=secur;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		}

		session_start();

	  if(isset($_SESSION['userid']) && !empty($_SESSION['userid'])) {
				$userId = $_SESSION['userid'];
	      $bdd = connectBdd();

	      $resu = $bdd->query("SELECT * FROM users WHERE id = $userId LIMIT 1");

	      while($row = $resu->fetch()){
	        $roleid = $row['roleId'];
	      }

				$res = $bdd->query("SELECT * FROM users WHERE roleId = $roleid");

		};
		?>



    <body>
		  <title>Utilisateurs</title>

			<?php include 'ressource.php' ?>

			  <div class="content">
					<div class="btnCorner">
						<i class="fas fa-user"></i> <a href="profile.php">Profil</a>
					</div>
    	<div class="divPrincipale">
    		<div class="divTitle container" style="text-align:center">
    			<span class="title" style="font-family: fakeserif; font-size:15vh; color:white">Utilisateurs</span>
	    			<span class="title" style="font-family: fakeserif; font-size:5vh; color:white"> ( ayant le même rôle que vous )</span>
    		</div>
        <div class="container">
          <div class="row">
              <?php

              while($row = $res->fetch()){
                ?> <div class="col-sm-4"><div class="divCustom"><b>Utilisateur n°<?php echo $row['id'];if($row['id'] == $userId){echo ' <span style="color:#398ac3">(Vous)';}?></b><i><br>
									<?php echo $row['mail'];

								?></i></div></div><?php
              }

              ?>
        </div>
        </div>
    	</div>
		</div>
    </body>
