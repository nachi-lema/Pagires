<?php 


function compteur_elevesfin(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
                $req = "SELECT * FROM finance_tb WHERE statut = 'en cours'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i class="fa fa-biefcase"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Compte Elèves'.'</h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fa fa-biefcase"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Compte Elève'.'</h4>';
                }
            }
            else{
	            $compte_eleve = $_GET['compte'];
	            $req = "SELECT * FROM compta_eleve WHERE compte = '$compte_eleve' AND statut='Actif'";
	            $resultats = $bd ->query($req);

	            if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                	echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-biefcase"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	                }
	            }
	            else{
	            	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-biefcase"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	            }
           	}
        }
   	}
   	else{
     	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
   	}
}

function etatfin_eleves(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
        	$admin = $_SESSION['pseudo'];
        	$params = 1;
        	$statut_fin = "en cours";
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification du compte administratif
                while($row = $resultats ->fetch_assoc()){
                    $code_admin = $row['code_admin'];     
                }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {// verification de droit administratif
	               	if (empty($_GET['compte'])) {

	                	$req2 = "SELECT * FROM finance_tb WHERE statut ='$statut_fin'";
	                   	$res2 = $bd ->query($req2);

	                    if ($res2 ->num_rows > 0) {
	                       	while($row2 = $res2 ->fetch_assoc()){

	                            echo '<tr>'.
	                                    '<td class="corp-table">'.$row2['compte'].'</td>'.
	                                    '<td class="corp-table">'.$row2['debit_usd_1'].'</td>'.
	                                    '<td class="corp-table">'.$row2['credit_usd_1'].'</td>'.
	                                    '<td class="corp-table">'.$row2['debit_usd_2'].'</td>'.
	                                    '<td class="corp-table">'.$row2['credit_usd_2'].'</td>'.
	                                    '<td class="corp-table">'.$row2['debit_cdf_1'].'</td>'.
	                                    '<td class="corp-table">'.$row2['credit_cdf_1'].'</td>'.
	                                    '<td class="corp-table">'.$row2['debit_cdf_2'].'</td>'.
	                                    '<td class="corp-table">'.$row2['credit_cdf_2'].'</td>'.
	                                    '<td class="corp-table">'.$row2['statut'].'</td>'.
	                                    '<td class="corp-table" style="background-color:orange!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="list_finance.php?compte='.$row2['compte'].'" class="selecteur" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
	                                '<tr>';
	                        }
	                  	}
	                    else{
	                    	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>'; 
	                    }
					}
					else{
						$compte = $_GET['compte'];
						$req2 = "SELECT * FROM finance_tb WHERE compte LIKE '%$compte%' AND statut='en cours'";
	                 	$res2 = $bd ->query($req2);

	                    if ($res2 ->num_rows > 0) {
	                       	while($row2 = $res2 ->fetch_assoc()){

	                            echo '<tr>'.
	                                   	'<td class="corp-table">'.$row2['compte'].'</td>'.
	                                   	'<td class="corp-table">'.$row2['debit_usd_1'].'</td>'.
	                                   	'<td class="corp-table">'.$row2['credit_usd_1'].'</td>'.
	                                   	'<td class="corp-table">'.$row2['debit_usd_2'].'</td>'.
	                                   	'<td class="corp-table">'.$row2['credit_usd_2'].'</td>'.
	                                   	'<td class="corp-table">'.$row2['debit_cdf_1'].'</td>'.
	                                   	'<td class="corp-table">'.$row2['credit_cdf_1'].'</td>'.
	                                    '<td class="corp-table">'.$row2['debit_cdf_2'].'</td>'.
	                                    '<td class="corp-table">'.$row2['credit_cdf_2'].'</td>'.
	                                    '<td class="corp-table">'.$row2['statut'].'</td>'.
	                                    '<td class="corp-table" style="background-color:orange!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="list_finance.php?compte='.$row2['compte'].'" class="selecteur" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
	                                '<tr>';
	                        }
	                    }
	                    else{
	                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>'; 
	                    }
					}   
	           	}
	            else{
	            	// verification de droit administratif
	            	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Violation d'acces administratif".'</div>';
	            }
            }
            else{
                // verification du compte administratif
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
            }
	    }
	}
	else{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
	}
}

//Afficher le taux
function liste_taux2(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $code_admin = $row['code_admin'];
        $codesoc = $row['code_soc'];
        $societe = $row['societe'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {
        $req2 = "SELECT * FROM taux_tb WHERE societe='$societe' AND statut ='en cours'";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="'.$row['taux'].'">'.$row['taux'].'</option>';
          }
        } else {
          echo '';
        }
      } else {
        echo '';
      }
    } else {
      echo '';
    }
  }
}

//Afficher anscola
function liste_anscola2(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $code_admin = $row['code_admin'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {
        $req2 = "SELECT * FROM anscola WHERE statut ='Actif'";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="' . $row['annee'] . '">' . $row['annee'] . '</option>';
          }
        } else {
          echo '';
        }
      } else {
        echo '';
      }
    } else {
      echo '';
    }
  }
}


function liste_tarification(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        $admin = $_SESSION['pseudo'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

	    if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];     
	        }
	        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	        $res1 = $bd ->query($req1);

	        if ($res1 ->num_rows > 0) {

	        $req2 = "SELECT * FROM tarification_tb WHERE statut = 'Actif'";
	        $res2 = $bd ->query($req2);

	          	if ($res2 ->num_rows > 0) {
	                while($row = $res2 ->fetch_assoc()){
	                    echo '<option value="'.$row['description'].'">'.$row['description'].'</option>';
	                }
	           	}
	            else{
	                echo '';
	            }

	       	}
	       	else{
	            echo '';
	        }
	    }
	    else{
	        echo '';
	    }
	}
}

//Afficher Le compte Tresor Caisse
function liste_compteDebit(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
        $codesoc = $row['code_soc'];
        $societe = $row['societe'];
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {

	      $req2 = "SELECT * FROM compta_tresor WHERE societe='$societe' AND statut ='Actif' AND reference ='CAISSE'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	          echo '<option value="'.$row['descriptions'].'">'.$row['descriptions'].'</option>';
	        }
	      }
	      else{
	        echo '';
	      }
	    }
	    else{
	      echo '';
	    }
	  }
	  else{
	    echo '';
	  }
	}
}

//Afficher Le compte Tresor Banque
function liste_compteDebitBank(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $code_admin = $row['code_admin'];
        $codesoc = $row['code_soc'];
        $societe = $row['societe'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {

        $req2 = "SELECT * FROM compta_tresor WHERE societe='$societe' AND statut ='Actif' AND reference ='BANK'";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="'.$row['descriptions'].'">' . $row['descriptions'] . '</option>';
          }
        } else {
          echo '';
        }
      } else {
        echo '';
      }
    } else {
      echo '';
    }
  }
}

//Afficher Le compte_Tresor Nivellement
function liste_compteDebitNivel()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()) {
        $code_admin = $row['code_admin'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {

        $req2 = "SELECT * FROM compta_tresor WHERE statut ='Actif'";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="'.$row['descriptions'].'">'.$row['descriptions'].'</option>';
          }
        } else {
          echo '';
        }
      } else {
        echo '';
      }
    } else {
      echo '';
    }
  }
}


function liste_taux(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM taux_monnaie WHERE statut = 'actif'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	                while($row = $res2 ->fetch_assoc()){
	                	echo '<option value="'.$row['taux'].'">'.$row['taux'].'</option>';
	                }
	      }
	      else{
	                echo '';
	      }
	       	}
	        else{
	            echo '';
	        }
	    }
	    else{
	       	echo '';
	    }
	}
}


//Afficher la liste de paie dans le table compte elève
function liste_paeifrais(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['ref_doc'])) {
            if (empty($_GET['nom_eleve'])) {
                if (empty($_GET['date_doc'])) {
                    $admin = $_SESSION['pseudo'];
                    $params = 1;
                    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                    $resultats = $bd ->query($requete);

	                if ($resultats ->num_rows > 0) {
	                    while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];     
	                   	}
	                    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                    $res1 = $bd ->query($req1);

	                    if ($res1 ->num_rows > 0) {

	                        $req2 = "SELECT * FROM comptes_eleve ORDER BY id DESC";
	                        $res2 = $bd ->query($req2);

	                        if ($res2 ->num_rows > 0) {
	                           	while($row = $res2 ->fetch_assoc()){
	                              	echo'<tr>'.
			                                '<td class="corp-table">'.$row['id'].'</td>'.
		                                    '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                                    '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                                    '<td class="corp-table">'.$row['tarification'].'</td>'.
		                                    '<td class="corp-table">'.$row['libelle'].'</td>'.
		                                    '<td class="corp-table">'.$row['montant'].'</td>'.
		                                    '<td class="corp-table">'.$row['devise'].'</td>'.
		                                    '<td class="corp-table">'.$row['taux'].'</td>'.
		                                    '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                                   	'<td class="corp-table">'.$row['statut'].'</td>'.
		                                   	'<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="maj-encodage.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                                	'</tr>';
	                            }
	                        }
	                        else{
	                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune information trouvée".'</div>';
	                        }
	                   	}
	                    else{
	                       	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	                  	}
	               	}
	               	else{
	                   	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	               	}
	         	}
	           	else{
	               	//filtrage eleve par option
	               	$date_doc = $_GET['date_doc'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];     
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM comptes_eleve WHERE date_extract LIKE '%$date_doc%' ORDER BY id DESC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                               	'<td class="corp-table">'.$row['id'].'</td>'.
		                                    '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                                    '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                                    '<td class="corp-table">'.$row['tarification'].'</td>'.
		                                    '<td class="corp-table">'.$row['libelle'].'</td>'.
		                                    '<td class="corp-table">'.$row['montant'].'</td>'.
		                                    '<td class="corp-table">'.$row['devise'].'</td>'.
		                                    '<td class="corp-table">'.$row['taux'].'</td>'.
		                                    '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                                   	'<td class="corp-table">'.$row['statut'].'</td>'.
		                                   	'<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="maj-encodage.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                                	'</tr>';
		                       	}
		                  	}
		                   	else{
		                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
		                  	}
	                    }
	                  	else{
	                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	                   	}
	               	}
	              	else{
	                 	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	              	}
	                //filtrage eleve par option
	           	}    
          	}
          	else{
                //filtrage eleve par nom
               	$admin = $_SESSION['pseudo'];
               	$nom_eleve = $_GET['nom_eleve'];
               	$params = 1;
               	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];     
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM comptes_eleve WHERE nom_complet LIKE '%$nom_eleve%' ORDER BY id DESC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                            '<td class="corp-table">'.$row['id'].'</td>'.
		                                '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                                '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                                '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                                '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                                '<td class="corp-table">'.$row['tarification'].'</td>'.
		                                '<td class="corp-table">'.$row['libelle'].'</td>'.
		                                '<td class="corp-table">'.$row['montant'].'</td>'.
		                                '<td class="corp-table">'.$row['devise'].'</td>'.
		                                '<td class="corp-table">'.$row['taux'].'</td>'.
		                                '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                                '<td class="corp-table">'.$row['statut'].'</td>'.
		                                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="maj-encodage.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                           		'</tr>';
		                   	}
		              	}
		              	else{
		                  	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
		            	}
	                }
	              	else{
	                  	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	              	}
	         	}
	            else{
	              	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	         	}
	            //filtrage eleve par nom
            }
        }
       	else{
       		//filtrage eleve par classe
       		$admin = $_SESSION['pseudo'];
            $ref_doc = $_GET['ref_doc'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];     
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM comptes_eleve WHERE ref_doc LIKE '%$ref_doc%' ORDER BY id DESC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td class="corp-table">'.$row['id'].'</td>'.
		                            '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                            '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                            '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                            '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                            '<td class="corp-table">'.$row['tarification'].'</td>'.
		                            '<td class="corp-table">'.$row['libelle'].'</td>'.
		                            '<td class="corp-table">'.$row['montant'].'</td>'.
		                            '<td class="corp-table">'.$row['devise'].'</td>'.
		                            '<td class="corp-table">'.$row['taux'].'</td>'.
		                            '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                            '<td class="corp-table">'.$row['statut'].'</td>'.
		                            '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="maj-encodage.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                        	'</tr>';
		               	}
		           	}
		            else{
		                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
		           	}
	           	}
	           	else{
	                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	           	}
	       	}
	      	else{
	           	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	       	}
	        //filtrage eleve par classe
        }
    }
    else{

    }
}

function controle_operation(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
        	$admin = $_SESSION['pseudo'];
        	$params = 1;
        	$statut_fin = "en cours";
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification du compte administratif
                while($row = $resultats ->fetch_assoc()){
                   	$code_admin = $row['code_admin'];     
                }
	          	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	          	$res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {// verification de droit administratif

	                if (empty($_GET['ref_doc'])) {
	                    echo '<li><a href="javascript:void(0)">Valider</a></li>';
			      	}
			        else{
			            $reference = $_GET['ref_doc'];

			            $req2 = "SELECT * FROM comptes_eleve WHERE ref_doc = '$reference'";
			            $res2 = $bd ->query($req2);

	                    if ($res2 ->num_rows > 0) {
	                        echo '<li><a href="javascript:void(0)" onclick="opnenValidePaie()">Valider</a></li>';
	                    }
	                    else{
	                        echo '<li><a href="javascript:void(0)">Valider</a></li>';
	                    }
			        }
	            }
	            else{// verification de droit administratif
	                echo '<li><a href="javascript:void(0)">Invalide</a></li>';
	           	}
	        }
	        else{// verification du compte administratif
	           	echo '<li><a href="javascript:void(0)">Invalide</a></li>';
	        }
	    }//fin de base de données
	}
	else{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
	}
}

function controle_operation2(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
        	$admin = $_SESSION['pseudo'];
        	$params = 1;
        	$statut_fin = "en cours";
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      		$resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification du compte administratif
                while($row = $resultats ->fetch_assoc()){
                    $code_admin = $row['code_admin'];     
                }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {// verification de droit administratif

	                if (empty($_GET['ref_doc'])) {
	                   	echo '<li><a href="javascript:void(0)">Annuler</a></li>';
			      	}
			      	else{
			            $reference = $_GET['ref_doc'];

			            $req2 = "SELECT * FROM comptes_eleve WHERE ref_doc = '$reference'";
			            $res2 = $bd ->query($req2);

	                    if ($res2 ->num_rows > 0) {
	                       	echo '<li><a href="javascript:void(0)" onclick="opnenCanceledPaie()">Annuler</a></li>';
	                    }
	                    else{
	                    	echo '<li><a href="javascript:void(0)">Annuler</a></li>';
	                    }
			      	}
	          	}
	          	else{// verification de droit administratif
	              	echo '<li><a href="javascript:void(0)">Invalide</a></li>';
	          	}
	      	}
	        else{// verification du compte administratif
	        	echo '<li><a href="javascript:void(0)">Invalide</a></li>';
	        }
	    }//fin de base de données
	}
	else{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
	}
}

///TRANSACTION PAR RUBRIQUE
function liste_Transaction_par_rubrique(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
        	$admin = $_SESSION['pseudo'];
        	$params = 1;
        	$statut_fin = "en cours";
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

          	if ($resultats ->num_rows > 0) {// verification du compte administratif
                while($row = $resultats ->fetch_assoc()){
                    $code_admin = $row['code_admin'];     
                }
	           	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	           	$res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {// verification de droit administratif
	                if (empty($_GET['date_doc'])) {
	                    if (empty($_GET['compte_eleve'])) {
			                if (empty($_GET['tarification'])) {

			                	$req1 = "SELECT * FROM comptes_eleve WHERE statut='en cours' ORDER BY id DESC";
		                        $res1 = $bd ->query($req1);

		                        if ($res1 ->num_rows > 0) {
		                            while($row1 = $res1 ->fetch_assoc()){
		                                echo '';
		                            }
		                        }
		                        else{
		                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>'; 
		                        }
			               	}
			                else{
			                    $tarification = $_GET['tarification'];
			                    $req2 = "SELECT * FROM comptes_eleve WHERE tarification LIKE '%$tarification%' AND statut='en cours'";
		                       	$res2 = $bd ->query($req2);

		                        if ($res2 ->num_rows > 0) {
		                            while($row2 = $res2 ->fetch_assoc()){

		                                echo '<tr>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['id'].'</td>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['compte_eleve'].'</td>'.
		                                     	'<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important;border: 1px solid #000">'.$row2['nom_complet'].'</td>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['tarification'].'</td>'.
		                                     	'<td class="corp-table" style="text-align:left!important;border: 1px solid #000">'.$row2['libelle'].'</td>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['montant'].'</td>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['devise'].'</td>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['date_doc'].'</td>'.
		                                     	'<td class="corp-table" style="border: 1px solid #000">'.$row2['anne_scolaire'].'</td>'.
		                                    '<tr>';
		                            }
		                       	}
		                        else{
		                        	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>'; 
		                        }
			                }
			            }
			            else{
			                $compte_eleve = $_GET['compte_eleve'];
			                $req3 = "SELECT * FROM comptes_eleve WHERE compte_eleve LIKE '%$compte_eleve%' AND statut='en cours'";
		                   	$res3 = $bd ->query($req3);

		                    if ($res3 ->num_rows > 0) {
		                        while($row3 = $res3 ->fetch_assoc()){

		                            echo '';
		                       	}
		                    }
		                    else{
		                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>'; 
		                    }	
			            }
	                }
	                else{
	                    $date_doc = $_GET['date_doc'];
	                    $req4 = "SELECT * FROM comptes_eleve WHERE date_doc LIKE '%$date_doc%' AND statut='en cours'";
		                $res4 = $bd ->query($req4);

		                if ($res4 ->num_rows > 0) {
		                    while($row4 = $res4 ->fetch_assoc()){

		                        echo '';
		                    }
		                }
		                else{
		                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>'; 
		                }
	                }
	            }
	            else{// verification de droit administratif
	                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Violation de droit administratif.".'</div>'; 
	            }
	        }
	        else{// verification du compte administratif
	            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide.".'</div>'; 
	        }
	    }//fin de base de données
	}
	else{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
	}
}
//FIN PAR RUBRIQUES

function compteur_finance(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
       	else{// fin base de données
            if (empty($_GET['ref_doc'])) {
	            $req = "SELECT * FROM comptes_eleve";
	            $resultats = $bd ->query($req);

	            $nbr = mysqli_num_rows($resultats);
	            if ($nbr > 1) {
	               echo '<h4 class="compteur_admin">'.'<i class="fa fa-file"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transactions Elèves'.'</h4>';
	            }
	            else{
	                echo '<h4 class="compteur_admin">'.'<i class="fa fa-file"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Transaction Elève'.'</h4>';
	            }                    
        	}
	        else{
		        $ref_doc = $_GET['ref_doc'];
		        $req = "SELECT * FROM comptes_eleve WHERE ref_doc = '$ref_doc'";
		        $resultats = $bd ->query($req);

		       	if ($resultats ->num_rows > 0) {
		            while($row = $resultats ->fetch_assoc()){
		                echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
		            }
		        }
		        else{
		            echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		        }
	        }
    	}
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}

//Pour extrait compte
function compteur_extrait(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
       	else{// fin base de données
            if (empty($_GET['compte'])) {
	            $req = "SELECT * FROM compta_eleve WHERE statut = 'en cours'";
	            $resultats = $bd ->query($req);

	            $nbr = mysqli_num_rows($resultats);
	            if ($nbr > 1) {
	               echo '';
	            }
	            else{
	                echo '';
	            }                    
        	}
	        else{
		        $compte = $_GET['compte'];
		        $req = "SELECT * FROM compta_eleve WHERE compte = '$compte'";
		        $resultats = $bd ->query($req);

		       	if ($resultats ->num_rows > 0) {
		            while($row = $resultats ->fetch_assoc()){
		                echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
		            }
		        }
		        else{
		            echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		        }
	        }
    	}
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}


//Afficher le bouiton d'extrait compte eleve
function extrait_compte(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
            	echo '';          
            }
            else{
	            $compte = $_GET['compte'];
	            $req = "SELECT * FROM compta_eleve WHERE compte = '$compte'";
	            $resultats = $bd ->query($req);

	            if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                	$num_compte = $row['compte'];

	                  	echo '<li><a class="btn btn-primary" href="extrait_eleve.php?compte='.$num_compte.'" target="_blank" style="background-color: #44597b">'.'Extrait de compte'.'</a>'.'</li>'; 
	                }
	            }
	            else{
	                echo '';
	            }
            }
        }
    }
   	else{
        echo '';
 	}
}

//Afficher le bouton d'impression d'un recu
function link_reciPaie(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
        	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['ref_doc'])) {
            	echo '';          
            }
            else{
	           	$ref_doc = $_GET['ref_doc'];
	           	$req = "SELECT * FROM comptes_eleve WHERE ref_doc = '$ref_doc'";
	           	$resultats = $bd ->query($req);

	            if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                    $num_reference= $row['ref_doc'];
	                    echo '<li><a href="recu_eleve.php?ref_doc='.$num_reference.'" target="_blank">Reçu de paiement</a></li>'; 
	                }
	           	}
	          	else{
	                echo '';
	          	}
            }
        }
    }
    else{
       	echo '';
    }
}

//fonction de calcule du compte elève sur la table {compte_eleve, compta_eleve}
function extrait_compte_doc(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
        	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
               	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun parametre trouvé".'</div>';           
            }
            else{
	            $compte_eleve = $_GET['compte'];
	            $req = "SELECT * FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
	            $resultats = $bd ->query($req);

	            if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                    $devise = $row['devise'];
	                    echo '<tr>'.
	                            '<td style="border: 1px solid #000">'.$row['date_doc'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['ref_doc'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['id'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['tarification'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['libelle'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['credits_usd'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['debits_usd'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['credits_cdf'].'</td>'.
	                            '<td style="border: 1px solid #000">'.$row['debits_cdf'].'</td>';
	                }
	                echo '<tr><td colspan="9"></td></tr>
	                    <tr>
					        <td align="center" colspan="5">Totaux</td>';
	                              
	                        $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                            $res3 = $bd ->query($req3);

                            if ($res3 ->num_rows > 0 ) {
	                            while($row3 = $res3 ->fetch_assoc()){
	                            	echo '<td style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row3['total_credit_usd'],2).'</strong>'.'</td>';
	                            }
	                        }
	                        else{

	                        }

	                       	$req2 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                          	$res2 = $bd ->query($req2);

	                        if ($res2 ->num_rows > 0) {
	                            while($row2 = $res2 ->fetch_assoc()){
					            	echo '<td style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row2['total_debit_usd'],2).'</strong>'.'</td>';
	                            }
	                        }
	                        else{

	                        }

	                        $req5 = "SELECT sum(credits_cdf) AS total_credit_cdf FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                            $res5 = $bd ->query($req5);

                            if ($res5 ->num_rows > 0 ) {
	                            while($row5 = $res5 ->fetch_assoc()){
	                            	echo '<td style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row5['total_credit_cdf'],2).'</strong>'.'</td>';
	                            }
	                        }
	                        else{

	                        }

	                      	$req4 = "SELECT sum(debits_cdf) AS total_debit_cdf FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                         	$res4 = $bd ->query($req4);

	                       	if ($res2 ->num_rows > 0) {
	                            while($row4 = $res4 ->fetch_assoc()){
					            	echo '<td style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row4['total_debit_cdf'],2).'</strong>'.'</td>';
	                            }
	                       	}
	                        else{

	                        }

	                        echo  '</tr>'.
				                '</tr>'.
				                '<tr><td colspan="9"></td></tr>';

				            $req6 = "SELECT * FROM compta_eleve WHERE compte = '$compte_eleve' AND statut = 'Actif'";
				            $res6 = $bd ->query($req6);

				            if ($res6 ->num_rows > 0) {
				                while($row6 = $res6 ->fetch_assoc()){
				                   	echo '<tr>'.
				                            '<td align="center" colspan="5">REPORT</td>'.
				                            '<td colspan="2" style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row6['solde_usd'],2).'&nbsp;'.'USD'.'</strong>'.'</td>'.
				                            '<td colspan="2" style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row6['solde_cdf'],2).'&nbsp;'.'CDF'.'</strong>'.'</td>'.
				                        '</tr>'.
				                        '<tr>'.
				                            '<td align="center" colspan="5">Debit Annuel </td>'.
				                            '<td colspan="2" style="border: 1px solid #000;text-align:right">'.number_format($row6['debit_an_usd'],2).'&nbsp;'.'USD'.'</td>'.
				                            '<td colspan="2" style="border: 1px solid #000;text-align:right">'.number_format($row6['debit_an_cdf'],2).'&nbsp;'.'CDF'.'</td>'.
				                        '</tr>';
				                }
				                // les toteaux
				                //USD
				                //Debit du compte usd
				                $req11 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                                $res11 = $bd ->query($req11);

                                if ($res3 ->num_rows > 0 ) {
	                                while($row11 = $res11 ->fetch_assoc()){
	                                	$creditsusd = $row11['total_credit_usd'];
	                                }
	                            }
	                            else{

	                            }
	                              //Credit du compte usd
				                $req7 = "SELECT sum(debits_usd) AS total_debitusd FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                                $res7 = $bd ->query($req7);

                                if ($res7 ->num_rows > 0) {
                                  	while($row7 = $res7 ->fetch_assoc()){
                                  		$tot_deb_usd = $row7['total_debitusd'];
                                  	}
                                  	$req8 = "SELECT * FROM compta_eleve WHERE compte = '$compte_eleve' AND statut = 'Actif'";
	                                $res8 = $bd ->query($req8);

	                                if ($res8 ->num_rows > 0) {
	                                  	while($row8 = $res8 ->fetch_assoc()){
	                                  		$deban_usd = $row8['debit_an_usd'];
	                                  		$report_usd = $row8['solde_usd'];
	                                  	}

	                                  	$solde_usd = $tot_deb_usd - $report_usd - $deban_usd - $creditsusd;
	                                  	echo '<tr>'.
				                                '<td align="center" colspan="5">SOLDE </td>'.
				                                '<td colspan="2" style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($solde_usd,2).'&nbsp;'.'USD'.'<strong>'.'</td>';
				                                    /*'<td colspan="2">0</td>'.
				                                '</tr>';*/
	                                }
	                                else{
	                                	echo '0';
	                                }
                                }
                                else{
                                	echo '0';
                                }
                                //CDF
                                $req12 = "SELECT sum(credits_cdf) AS total_credit_cdf FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                                $res12 = $bd ->query($req12);

                                if ($res12 ->num_rows > 0 ) {
	                                while($row12 = $res12 ->fetch_assoc()){
	                                	$tot_cred_cdf = $row12['total_credit_cdf'];
	                                }
	                           	}
	                            else{

	                            }
	                               //debits cdf
                                $req9 = "SELECT sum(debits_cdf) AS total_debitcdf FROM comptes_eleve WHERE compte_eleve = '$compte_eleve' AND statut = 'en cours'";
                                $res9 = $bd ->query($req9);

                                if ($res9 ->num_rows > 0) {
                                  	while($row9 = $res9 ->fetch_assoc()){
                                  		$tot_deb_cdf = $row9['total_debitcdf'];
                                  	}

                                 	$req10 = "SELECT * FROM compta_eleve WHERE compte = '$compte_eleve' AND statut = 'Actif'";
	                                $res10 = $bd ->query($req10);

	                                if ($res10 ->num_rows > 0) {
	                                  	while($row10 = $res10 ->fetch_assoc()){
	                                  		$deban_cdf = $row10['debit_an_cdf'];
	                                  		$report_cdf = $row10['solde_cdf'];
	                                  	}

	                                  	$solde_cdf = $tot_deb_cdf - $report_cdf - $deban_cdf - $tot_cred_cdf;
	                                  			
	                                  	echo '<td colspan="2" style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($solde_cdf,2).'&nbsp;'.'CDF'.'<strong>'.'</td>'.'</tr>';
	                                }
	                                else{
	                                  	echo '0';
	                                }
                                }
                                else{
                                	echo '0';
                                }
                                // les toteaux
				            }
				            else{
				            	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Compte élève introuvable".'</div>';
				            }
	            }
	            else{
	                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>';
	            }
            }
       	}
    }
    else{
        echo '';
    }
}

//Afficher les informations du compte selectionner
function extrait_compte_header(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
        	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
            	echo '<div class="row w-100">
				      	<fieldset class="col-lg-12 col-md-12 col-sm-12">
				            <h5 class="" style="font-size: 14px">
				                <b>EXTRAIT-COMPTE_Eleves | NOMS | No_COMPTE | CLASSE</b>
				            </h5>
				      	</fieldset>
				     </div><br>';           
            }
            else{
	            $compte_eleve = $_GET['compte'];
	            $req = "SELECT * FROM compta_eleve WHERE compte = '$compte_eleve' AND statut = 'Actif'";
	            $resultats = $bd ->query($req);

	           	if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                    echo '<div class="row w-100">
				              	<fieldset class="col-lg-12 col-md-12 col-sm-12">
				                    <h5 class="" style="font-size: 14px">
				                        <b>EXTRAIT-COMPTE_Eleves | '.$row['nom_complet'].' | '.$row['compte'].' | '.$row['groupe'].'</b>
				                    </h5>
				              	</fieldset>
				             </div><br>';
	                              			 
	            	}
	            }
	            else{
	                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>';
	            }
            }
        }
    }
    else{
        echo '';
    }
}


//recu_eleve
function reci_paie(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
        	$admin = $_SESSION['pseudo'];
        	$params = 1;
        	$statut_fin = "en cours";
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification du compte administratif
                while($row = $resultats ->fetch_assoc()){
                    $code_admin = $row['code_admin'];     
                }
	           	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	           	$res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {// verification de droit administratif

	                if (empty($_GET['ref_doc'])) {
	                   	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
	                }
	                else{
	                    $ref_doc = $_GET['ref_doc'];
	                    $req = "SELECT * FROM comptes_encodage WHERE ref_doc = '$ref_doc' AND statut = '$statut_fin'";
						$resultats = $bd ->query($req);

						if ($resultats ->num_rows > 0) {
							while($row = $resultats ->fetch_assoc()){
							    $ref_doc = $row['ref_doc'];
							    $num_ordre = $row['id'];
							    $compte_eleve = $row['compte_eleve'];
							    $montant = $row['montant'];
							    $devise = $row['devise'];
							    $motif = $row['libelle'];
							    $customer = $row['customer'];
							    $date_doc = $row['date_crea'];
							}

							//recuperation information eleve
							$req2 = "SELECT * FROM compta_eleve WHERE compte = '$compte_eleve' AND statut = 'Actif'";
							$res2 = $bd ->query($req2);

							if ($res2 ->num_rows > 0) {

								while($row2 = $res2 ->fetch_assoc()){
									$nom_complet = $row2['nom_complet'];
									$section = $row2['section'];
									$classe_eleve = $row2['classe'];
								}

								//Impression reci eleve
								echo '<table class="table">
										<tr class="boder-0">
											<td width="35%" class="boder-0 align-bottom">
											    <div class="row w-60" style="margin-left: px">
											     	<fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-100">
											     	</fieldset>
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
											            <label class="float-left w-auto whitespace-nowrap">REF:</label>
											        </fieldset>
											        <fieldset class="col-lg-3 col-md-3 col-sm-12 d-flex w-max-100">
											            <p class="col-md-auto border-bottom border-dark w-40">'.$ref_doc.'<b></b></p>
											        </fieldset>
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
											            <label class="float-left w-auto whitespace-nowrap">N°:</label>
											        </fieldset>
											        <fieldset class="col-lg-3 col-md-3 col-sm-12 d-flex w-max-100">
											            <p class="col-md-auto border-bottom border-dark w-50">'.$num_ordre.'<b></b></p>
											        </fieldset>
											    </div><br>
											    <div class="row w-100">
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
											            <label class="float-left w-auto whitespace-nowrap">NOM:</label>
											        </fieldset>
											        <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-100">
											            <p class="col-md-auto border-bottom border-dark" style="width: 70%">'.$nom_complet.'<b></b></p>
											        </fieldset>
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
											            <label class="float-left w-auto whitespace-nowrap">COMPTE:</label>
											        </fieldset>
											        <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-100">
											            <p class="col-md-auto border-bottom border-dark" style="width: 70%">'.$compte_eleve.'<b></b></p>
											        </fieldset>
											    </div><br>
											   	<div class="row w-100">
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
											           	<label class="float-left w-auto whitespace-nowrap">SECTION:</label>
											        </fieldset>
											        <fieldset class="col-lg-5 col-md-5 col-sm-12 d-flex w-max-100">
											           	<p class="col-md-auto border-bottom border-dark" style="width: 80%">'.$section.'<b></b></p>
											        </fieldset>
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-80">
											           	<label class="float-left w-auto whitespace-nowrap">MONTANT:</label>
											        </fieldset>
											        <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
											           	<p class="col-md-auto border-bottom border-dark" style="width: 75%">'.number_format($montant,2).'<b>  '.$devise.'</b></p>
											        </fieldset>
											   	</div><br>
											    <div class="row w-100">
											        <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-100">
											        	<label class="float-left w-auto whitespace-nowrap">Motif:</label>
											        </fieldset>
											        <fieldset class="col-lg-10 col-md-10 col-sm-12 d-flex w-max-100">
											        	<p class="col-md-auto border-bottom border-dark w-100">'.$motif.'<b></b></p>
											        </fieldset>
											    </div>
											</td>
										</tr>
									</table>
									<table class="table table-stripped px-4">
										<tbody>
											<tr>
												<td>
											        <div class="row w-100">
											            <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
											            </fieldset>
											            <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
											                <label class="float-left w-auto whitespace-nowrap">PREPARE PAR</label>
											            </fieldset>
											            <fieldset class="col-lg-6 col-md-4 col-sm-12 d-flex w-max-80">
											                <label class="float-left w-auto whitespace-nowrap" style="font-size: 13px">
											                    PAYE A / RECU PAR / VERSE PAR
											            	</label>
											            </fieldset>
											        </div>
											        <div class="row w-100">
											        	<fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-80">
											            	<label class="float-left w-auto whitespace-nowrap">Noms:</label>
											        	</fieldset>
											        	<fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
											            	<p class="col-md-auto border-bottom border-dark"  style="width: 85%">'.$customer.'<b></b></p>
											        	</fieldset>
											        	<fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
											            	<p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b>.</b></p>
											        	</fieldset>
											        </div>
											        <div class="row w-100">
											            <fieldset class="col-lg-1 col-md-1 col-sm-12 d-flex w-max-80">
											            	<label class="float-left w-auto whitespace-nowrap">DATE:</label>
											            </fieldset>
											            <fieldset class="col-lg-4 col-md-4 col-sm-12 d-flex w-max-80">
											                <p class="col-md-auto border-bottom border-dark"  style="width: 85%">'.$date_doc.'<b></b></p>
											            </fieldset>
											            <fieldset class="col-lg-6 col-md-6 col-sm-12 d-flex w-max-80">
											                <p class="col-md-auto border-bottom border-dark"  style="width: 85%"><b>.</b></p>
											            </fieldset>
											        </div><br>
											        <div class="row w-100">
											            <fieldset class="col-lg-2 col-md-2 col-sm-12 d-flex w-max-80">
											                <label class="float-left w-auto whitespace-nowrap">SIGNATURE</label>
											            </fieldset>
											        </div>
												</td>
											</tr>
										</tbody>
									</table>';   	
									//Impression reci eleve

								}
								else{
									echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Compte élève introuvable.".'</div>';
								}
						   	}
						    else{
						    	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée".'</div>';
						    }
					  	}
	               	}
	                else{
	                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Violation d'accès".'</div>';
	                }
	           	}
	            else{
	            	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	            }
	        }
		}
		else{
			echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue".'</div>';
		}
	}


function liste_de_groupe(){
    if (isset($_SESSION['pseudo'])) {
       	include("connexion.php");
        $admin = $_SESSION['pseudo'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

	    if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	        	$code_admin = $row['code_admin'];     
	    	}
	        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	        $res1 = $bd ->query($req1);

	        if ($res1 ->num_rows > 0) {

	            $req2 = "SELECT * FROM compta_eleve WHERE statut = 'Actif'";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	                while($row = $res2 ->fetch_assoc()){
	                    echo '<option value="'.$row['groupe'].'">'.$row['groupe'].'</option>';
	                }
	            }
	            else{
	                echo '';
	            }
	       	}
	    }
	}
}

function releve_eleves(){
	if (isset($_SESSION['pseudo'])) {
		if (empty($_GET['classe_eleve'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune classe selectionnée".'</div>';  
       	}
		else{
            include ("connexion.php");
            $groupe = $_GET['classe_eleve'];
            $statut = 'en cours';

 			$req = "SELECT * FROM  releve_eleve WHERE classe_eleve = '$groupe' AND statut = '$statut'";
 			$sql = $bd ->query($req);

   			if ($sql ->num_rows > 0) {
            	echo '<div class="row w-100 d-flex justify-content-end mb-2">
            			<div class="col-lg-12 col-md-12 col-sm-12">';
                while ($row = $sql->fetch_assoc()) {
                    $classe = $row['classe_eleve'];
                }
                $req2 = "SELECT * FROM  compta_eleve WHERE groupe = '$classe' AND statut = 'Actif'";
                $sql2 = $bd ->query($req2);

                if ($sql2 ->num_rows > 0) {
                    while($row2 = $sql2 ->fetch_assoc()){
                    	$debit_ann_usd = $row2['debit_an_usd'];
	                    $debit_ann_cdf = $row2['debit_an_cdf'];
	                    $debit_ann_usdA = $row2['debit_an_usd'];
	                    $debit_ann_cdfA = $row2['debit_an_cdf'];
	                    $solde_usd = $row2['solde_usd'];
	                    $solde_cdf = $row2['solde_cdf'];
	                    $solde_usdA = $row2['solde_usd'];
	                    $solde_cdfA = $row2['solde_cdf'];

                        //debut en tete
                        $nom_complet = $row2['nom_complet'];
                        echo '<table class="table table-striped" style="font-family: arial;text-align: center;">
                                <h5 class="" style="font-size: 13px;padding:20px">
						            <b>EXTRAIT-COMPTE_Eleves | '.$nom_complet.' | '.$row2['compte'].' | '.$row2['groupe'].'</b>
						        </h5>
					            <thead>
					                <tr>
					                    <th class="tete-table">Date</th>
					                    <th class="tete-table">Description</th>
					                    <th class="tete-table">Debit_USD</th>
					                    <th class="tete-table">Credit_USD</th>
					                    <th class="tete-table">Debit_CDF</th>
					                    <th class="tete-table">Credit_CDF</th>
					                </tr>
					            </thead>';

					            $req3 = "SELECT * FROM  releve_eleve WHERE nom_eleve = '$nom_complet' AND statut = '$statut'";
                       			$sql3 = $bd ->query($req3);

                               	if ($sql3 ->num_rows > 0) {
                                	echo '<tbody>';
                                	while ($row3 = $sql3->fetch_assoc()) {
	                                    				  
	                                   	echo '<tr>'.
	                                    		'<td>'.$row3['date_crea'].'</td>'.
	                                    		'<td>'.$row3['description'].'</td>'.
	                                    		'<td>'.number_format($row3['credit_USD'],2).'</td>'.
	                                    		'<td>'.number_format($row3['debit_USD'],2).'</td>'.
	                                    		'<td>'.number_format($row3['credit_CDF'],2).'</td>'.
	                                    		'<td>'.number_format($row3['debit_CDF'],2).'</td>'.
	                                   		'</tr>';
	                                }

	                                $req4 = "SELECT sum(debit_USD) AS total_debit_usd FROM releve_eleve WHERE nom_eleve = '$nom_complet' AND statut = '$statut'";
				                    $res4 = $bd ->query($req4);

				                    if ($res4 ->num_rows > 0 ) {
					                    while($row4 = $res4 ->fetch_assoc()){
					                        $tot_deb_usd = $row4['total_debit_usd'];
					                        $tot_deb_usdA = number_format($row4['total_debit_usd'],2);
					                    }
					                }
					                            $req5 = "SELECT sum(credit_USD) AS total_credit_usd FROM releve_eleve WHERE nom_eleve = '$nom_complet' AND statut = '$statut'";
				                                $res5 = $bd ->query($req5);

				                                if ($res5 ->num_rows > 0 ) {
					                                while($row5 = $res5 ->fetch_assoc()){

					                                  	$tot_cred_usd = $row5['total_credit_usd'];
					                                  	$tot_cred_usdA = number_format($row5['total_credit_usd'],2);
					                                }
					                           	}

	                                    		$req6 = "SELECT sum(debit_CDF) AS total_debit_cdf FROM releve_eleve WHERE nom_eleve = '$nom_complet' AND statut = '$statut'";
				                               	$res6 = $bd ->query($req6);

				                                if ($res6 ->num_rows > 0 ) {
					                                while($row6 = $res6 ->fetch_assoc()){

					                                  	$tot_deb_cdf = $row6['total_debit_cdf'];
					                                  	$tot_deb_cdfA = number_format($row6['total_debit_cdf'],2);
					                                }
					                            }

					                            $req7 = "SELECT sum(credit_CDF) AS total_credit_cdf FROM releve_eleve WHERE nom_eleve = '$nom_complet' AND statut = '$statut'";
				                                $res7 = $bd ->query($req7);

				                                if ($res7 ->num_rows > 0 ) {
					                                while($row7 = $res7 ->fetch_assoc()){

					                                  	$tot_cred_cdf = $row7['total_credit_cdf'];
					                                  	$tot_cred_cdfA = number_format($row7['total_credit_cdf'],2);
					                                }
					                           	}

					                            $global_usd = $debit_ann_usd + $solde_usd - $tot_deb_usd - $tot_cred_usd;
					                            $global_cdf = $debit_ann_cdf + $solde_cdf - $tot_deb_cdf - $tot_cred_cdf;

	                                    		echo '<tr>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">TOTAUX</td>'.
								                        '<td style="font-weight:bold!important">'.$tot_cred_usdA.'$'.'</td>'.
								                        '<td style="font-weight:bold!important">'.$tot_deb_usdA.'$'.'</td>'.
								                        '<td style="font-weight:bold!important">'.$tot_cred_cdfA.'fc'.'</td>'.
								                        '<td style="font-weight:bold!important">'.$tot_deb_cdfA.'fc'.'</td>'.
								                    '</tr>'.
								                    '<tr>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">REPPORT</td>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">'.number_format($solde_usd,2).'$'.'</td>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">'.number_format($solde_cdf,2).'fc'.'</td>'.
								                    '</tr>'.
								                    '<tr>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">DEBIT ANNUEL</td>'.
								                        '<td style="font-weight:bold!important;background-color:#ddd!important" colspan="2">'.number_format($debit_ann_usdA,2).'$'.'</td>'.
								                        '<td style="font-weight:bold!important;background-color:#ddd!important" colspan="2">'.number_format($debit_ann_cdfA,2).'fc'.'</td>'.
								                    '</tr>'.
								                    '<tr>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">SOLDE</td>'.
								                        '<td align="center colspan="2" style="font-weight:bold!important">'.number_format($global_usd,2).'$'.'</td>'.
								                        '<td align="center" colspan="2" style="font-weight:bold!important">'.number_format($global_cdf,2).'fc'.'</td>'.
								                    '</tr>';
	                                    		echo'</tbody>';

                                			}
                                			else{
                                				echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune information trouvée".'</div>';
                                			}     	
	                                    			
	                                   echo '</table>';
			                    }
						         //fin en tete
           					}    	
            				echo '</div>
                				</div>';
       		}
        	else{
            	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune information trouvée".'</div>'; 
        	}
    	}
	}
	else{
		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue".'</div>'; 
	}
}


//Afficher la liste de paie dans le table compte elève
function liste_paeifrais_guichet(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['ref_doc'])) {
            if (empty($_GET['nom_eleve'])) {
                if (empty($_GET['date_doc'])) {
                    $admin = $_SESSION['pseudo'];
                    $params = 1;
                    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                    $resultats = $bd ->query($requete);

	                if ($resultats ->num_rows > 0) {
	                    while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];     
	                   	}
	                    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                    $res1 = $bd ->query($req1);

	                    if ($res1 ->num_rows > 0) {

	                        $req2 = "SELECT * FROM comptes_eleve ORDER BY id DESC";
	                        $res2 = $bd ->query($req2);

	                        if ($res2 ->num_rows > 0) {
	                           	while($row = $res2 ->fetch_assoc()){
	                              	echo'<tr>'.
			                                '<td class="corp-table">'.$row['id'].'</td>'.
		                                    '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                                    '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                                    '<td class="corp-table">'.$row['tarification'].'</td>'.
		                                    '<td class="corp-table">'.$row['libelle'].'</td>'.
		                                    '<td class="corp-table">'.$row['montant'].'</td>'.
		                                    '<td class="corp-table">'.$row['devise'].'</td>'.
		                                    '<td class="corp-table">'.$row['taux'].'</td>'.
		                                    '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                                   	'<td class="corp-table">'.$row['statut'].'</td>'.
		                                   	'<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="guichet?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                                	'</tr>';
	                            }
	                        }
	                        else{
	                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune information trouvée".'</div>';
	                        }
	                   	}
	                    else{
	                       	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	                  	}
	               	}
	               	else{
	                   	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	               	}
	         	}
	           	else{
	               	//filtrage eleve par option
	               	$date_doc = $_GET['date_doc'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];     
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM comptes_eleve WHERE date_extract LIKE '%$date_doc%' ORDER BY id DESC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                               	'<td class="corp-table">'.$row['id'].'</td>'.
		                                    '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                                    '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                                    '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                                    '<td class="corp-table">'.$row['tarification'].'</td>'.
		                                    '<td class="corp-table">'.$row['libelle'].'</td>'.
		                                    '<td class="corp-table">'.$row['montant'].'</td>'.
		                                    '<td class="corp-table">'.$row['devise'].'</td>'.
		                                    '<td class="corp-table">'.$row['taux'].'</td>'.
		                                    '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                                   	'<td class="corp-table">'.$row['statut'].'</td>'.
		                                   	'<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="guichet.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                                	'</tr>';
		                       	}
		                  	}
		                   	else{
		                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
		                  	}
	                    }
	                  	else{
	                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	                   	}
	               	}
	              	else{
	                 	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	              	}
	                //filtrage eleve par option
	           	}    
          	}
          	else{
                //filtrage eleve par nom
               	$admin = $_SESSION['pseudo'];
               	$nom_eleve = $_GET['nom_eleve'];
               	$params = 1;
               	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];     
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM comptes_eleve WHERE nom_complet LIKE '%$nom_eleve%' ORDER BY id DESC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                            '<td class="corp-table">'.$row['id'].'</td>'.
		                                '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                                '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                                '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                                '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                                '<td class="corp-table">'.$row['tarification'].'</td>'.
		                                '<td class="corp-table">'.$row['libelle'].'</td>'.
		                                '<td class="corp-table">'.$row['montant'].'</td>'.
		                                '<td class="corp-table">'.$row['devise'].'</td>'.
		                                '<td class="corp-table">'.$row['taux'].'</td>'.
		                                '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                                '<td class="corp-table">'.$row['statut'].'</td>'.
		                                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="guichet.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                           		'</tr>';
		                   	}
		              	}
		              	else{
		                  	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
		            	}
	                }
	              	else{
	                  	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	              	}
	         	}
	            else{
	              	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	         	}
	            //filtrage eleve par nom
            }
        }
       	else{
       		//filtrage eleve par classe
       		$admin = $_SESSION['pseudo'];
            $ref_doc = $_GET['ref_doc'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];     
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM comptes_eleve WHERE ref_doc LIKE '%$ref_doc%' ORDER BY id DESC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td class="corp-table">'.$row['id'].'</td>'.
		                            '<td class="corp-table">'.$row['ref_doc'].'</td>'.
		                            '<td class="corp-table">'.$row['compte_debit'].'</td>'.
		                            '<td class="corp-table">'.$row['compte_eleve'].'</td>'.
		                            '<td class="corp-table">'.$row['nature_operation'].'</td>'.
		                            '<td class="corp-table">'.$row['tarification'].'</td>'.
		                            '<td class="corp-table">'.$row['libelle'].'</td>'.
		                            '<td class="corp-table">'.$row['montant'].'</td>'.
		                            '<td class="corp-table">'.$row['devise'].'</td>'.
		                            '<td class="corp-table">'.$row['taux'].'</td>'.
		                            '<td class="corp-table">'.$row['date_extract'].'</td>'.
		                            '<td class="corp-table">'.$row['statut'].'</td>'.
		                            '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="guichet.php?ref_doc='.$row['ref_doc'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                        	'</tr>';
		               	}
		           	}
		            else{
		                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
		           	}
	           	}
	           	else{
	                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
	           	}
	       	}
	      	else{
	           	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
	       	}
	        //filtrage eleve par classe
        }
    }
    else{

    }
}

?>





