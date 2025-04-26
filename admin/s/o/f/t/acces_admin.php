<?php

//Acces Admin User
function acces_droitAdmin(){
 	if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
   	else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

     	if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_user ='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
          echo '<li class="dropdown"><a class="nav-link" href="user_societe.php" style="font-size: 14px"><i class="fas fa-user-lock"></i>Administrateur</a></li>';
	      }
	      else{
	        echo ''; 
	      }// verification de droit administratif
	    }
	    else{
	    	echo '';
	    }// verification du compte administratif
		}
	}
	else{
		echo '';
	}
}
//Acces Admin User

//Acces Gestion_stocks
function acces_droitGeststocks(){
 	if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
   	else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

     	if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND stock='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
          echo'<li class="dropdown">
                <a href="creat_stock.php" class="nav-link" style="font-size: 14px"><i class="fa fa-shopping-bag"></i><span>Gestion_stock_initial</span></a>
              </li>';
	      }
	      else{
	        echo ''; 
	      }// verification de droit administratif
	    }
	    else{
	    	echo '';
	    }// verification du compte administratif
		}
	}
	else{
		echo '';
	}
}
//Acces Admin User

//Acces _Gestion_stocks_achats
function acces_droitGestachats(){
 	if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
   	else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

     	if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND stach='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
          echo'<li class="dropdown">
                <a href="gestn_achat.php" class="nav-link" style="font-size: 14px"><i class="fa fa-shopping-bag"></i><span>Gestion_achats</span></a>
              </li>';
	      }
	      else{
	        echo ''; 
	      }// verification de droit administratif
	    }
	    else{
	    	echo '';
	    }// verification du compte administratif
		}
	}
	else{
		echo '';
	}
}
//Acces _Gestion_stocks_achats

//Acces _Gestion_stocks_ventes
function acces_droitGestvente(){
 	if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
   	else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

     	if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND stvte='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
          echo '<li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown" style="font-size: 14px"><i class="fa fa-shopping-bag"></i><span>Gestion_ventes</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="facture_autre.php">Facturation_tiers</a></li>
                  <li><a class="nav-link" href="livrable.php">Livrable</a></li>
                  <li><a class="nav-link" href="#">Facturation_eleve</a></li>
                  <li><a class="nav-link" href="listevente_cash.php">Listing_ventes_cash</a></li>
                  <li><a class="nav-link" href="listevente_credit.php">Listing_ventes_credit</a></li>
                  <li><a class="nav-link" href="listevente_livrable.php">Listing_ventes_livrable</a></li>
                  <li><a class="nav-link" href="#">Listing_ventes_gestionnaire</a></li>
                </ul>
              </li>';
	      }
	      else{
	        echo ''; 
	      }// verification de droit administratif
	    }
	    else{
	    	echo '';
	    }// verification du compte administratif
		}
	}
	else{
		echo '';
	}
}
//Acces _Gestion_stocks_ventes

//Acces _Gestion_stocks_impressions
function acces_droitGestprint(){
 	if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
   	else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

     	if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND stprt='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
          echo'<li class="dropdown">
                <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-print"></i> Impressions_stocks</a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="recap_stock.php">Listing_stock-inital</a></li>
                  <li><a class="nav-link" href="recap_achats.php">Listing_stock-entrées</a></li>
                  <li><a class="nav-link" href="recap_vente.php">Listing_stock-sorties</a></li>
                  <li><a class="nav-link" href="recapstockfinal.php">Listing_global</a></li>
                </ul>
              </li>';
	      }
	      else{
	        echo ''; 
	      }// verification de droit administratif
	    }
	    else{
	    	echo '';
	    }// verification du compte administratif
		}
	}
	else{
		echo '';
	}
}
//Acces _Gestion_stocks_impressions

//Acces _Gestion_stocks_initial
function acces_droitGestinvet(){
 	if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
   	else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

     	if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND stinit='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
          echo'<li class="dropdown">
                <a class="menu-toggle nav-link has-dropdown" href="#" style="font-size: 14px"><i class="fa fa-wallet"></i> Inventaires_stocks</a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="#">Inventaire_actuel</a></li>
                  <li><a class="nav-link" href="#">Inventaire_periodique</a></li>
                </ul>
              </li>';
	      }
	      else{
	        echo ''; 
	      }// verification de droit administratif
	    }
	    else{
	    	echo '';
	    }// verification du compte administratif
		}
	}
	else{
		echo '';
	}
}
//Acces _Gestion_stocks_initial