<?php

//fonction d'attire la liste personnel à la BDD
function liste_societe(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd ->query($requete);

	   if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	      	$code_admin = $row['code_admin']; 
	      	$societe = $row['societe'];    
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	         $req2 = "SELECT * FROM nom_societe_tb WHERE societe = '$societe' AND statut ='Actif' ";
	         $res2 = $bd ->query($req2);

	         if ($res2 ->num_rows > 0) {
	            while($row = $res2 ->fetch_assoc()){
	             	echo '<option value="'.$row['societe'].'">'.$row['societe'].'</option>';
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

//fonction d'attire la liste personnel à la BDD
function liste_agentActif(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin']; 
	      $societe = $row['societe'];    
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' ORDER BY nom_complet ASC ";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	          echo '<option value="'.$row['nom_complet'].'">'.$row['nom_complet'].'</option>';
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

//fonction d'attire la liste personnel à la BDD
function liste_serviceActif(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd ->query($requete);

	   if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin']; 
	            $societe = $row['societe'];    
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	         $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' AND statut ='Actif' ORDER BY service ASC ";
	         $res2 = $bd ->query($req2);

	         if ($res2 ->num_rows > 0) {
	            while($row = $res2 ->fetch_assoc()){
	               echo '<option value="'.$row['service'].'">'.$row['service'].'</option>';
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


//fonction d'attire la liste des Agents à la BDD
function liste_levesActif(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe    = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      if (empty($_GET['departement'])) {
	        echo ' ';
	      }
	      else{
		      $departement = $_GET['departement'];
		      $req2 = "SELECT * FROM peragent_tb WHERE societe ='$societe' AND departement ='$departement' AND statut ='Actif' ORDER BY nom_complet ASC";
			    $res2 = $bd ->query($req2);

			    if ($res2 ->num_rows > 0) {
			      while($row = $res2 ->fetch_assoc()){
			        echo '<option value="'.$row['nom_complet'].'">'.$row['nom_complet'].'</option>';
			      }
			    }
			    else{
			      echo '';
			    }
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

//fonction d'attire la liste personnel à la BDD
function liste_proville(){
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
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM province ORDER BY province ASC ";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['province'].'">'.$row['province'].'</option>';
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

//Compteur des Departements
function compteur_depart(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['compte']) && empty($_GET['ID'])) {
        $admin =$_SESSION['pseudo'];
        $params = 1;
        $req1 ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $sql1 =$bd->query($req1);

        if ($sql1 ->num_rows > 0) {
          while ($row = $sql1 ->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM departmnt_tb WHERE societe ='$societe'";
          $resultats = $bd ->query($req);
          $nbr = mysqli_num_rows($resultats);

          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Departements'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Departement'.'</h4>';
          }

        }
        else {
          # code...
        }
      }
      
    }
  }
 	else{
  	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
	}
}
//Fin Compteur des Departements

//Compteur des Congés
function compteur_conge(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['compte']) && empty($_GET['ID'])) {
        $admin =$_SESSION['pseudo'];
        $params = 1;
        $req1 ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $sql1 =$bd->query($req1);

        if ($sql1 ->num_rows > 0) {
          while ($row = $sql1 ->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM perconge WHERE societe ='$societe' AND statut ='Actif'";
          $resultats = $bd ->query($req);
          $nbr = mysqli_num_rows($resultats);

          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Congé approuvé'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Congé approuvé'.'</h4>';
          }

        }
        
      }
      else{
	      
      }
    }
  }
 	else{
  	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
	}
}
//Fin Compteur des Congés

//Compteur des Agents
function compteur_Agents(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['compte']) && empty($_GET['ID'])) {
        $req = "SELECT * FROM peragent_tb WHERE customer ='".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($req);
        $nbr = mysqli_num_rows($resultats);

        if ($nbr > 1) {
        	echo '<h4 class="compteur_admin">'.'<i></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Agents'.'</h4>';
        }
        else{
        	echo '<h4 class="compteur_admin">'.'<i></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Agent'.'</h4>';
        }
      }
      else{
	      $compte_agent = $_GET['compte'];
        $Idpers= $_GET['ID'];
	      $req = "SELECT * FROM peragent_tb WHERE compte = '$compte_agent' AND id='$Idpers'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	        	echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	        }
	      }
	      else{
	      	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	      }
      }
    }
  }
 	else{
  	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
	}
}
//Fin Compteur des Agents

//Affichage listes agents dans pers_agent
function liste_pers_agents(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['service'])) {
        if (empty($_GET['departem'])) {
					$admin = $_SESSION['pseudo'];
					$params = 1;
					$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
					$resultats = $bd ->query($requete);

	  			if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	      			$code_admin = $row['code_admin'];
	      			$societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' AND statut ='Actif' OR statut ='Inactif' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	         		if ($res2 ->num_rows > 0) {
	           		while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['direction'].'</td>'.
	                      '<td>'.$row['departement'].'</td>'.
	                      '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['nbre_enfant'].'</td>'.
			                  '<td>'.$row['contrat'].'</td>'.
			                  '<td>'.$row['classification'].'</td>'.
			                  '<td>'.$row['categ'].'</td>'.
			                  '<td>'.$row['Classe'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td>'.$row['statut'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        $departem = $_GET['departem'];
	        $params = 1;
	        $admin = $_SESSION['pseudo'];
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin']; 
	            $societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM peragent_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['direction'].'</td>'.
	                      '<td>'.$row['departement'].'</td>'.
	                      '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
                        '<td>'.$row['nbre_enfant'].'</td>'.
			                  '<td>'.$row['contrat'].'</td>'.
			                  '<td>'.$row['classification'].'</td>'.
			                  '<td>'.$row['categ'].'</td>'.
                        '<td>'.$row['Classe'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td>'.$row['statut'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
        $service = $_GET['service'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $code_admin = $row['code_admin'];   
	          $societe = $row['societe'];    
	        }
	        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        $res1 = $bd ->query($req1);

	        if ($res1 ->num_rows > 0) {
	          $req2 = "SELECT * FROM peragent_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		      	$res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>'.
			                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                '<td>'.$row['compte'].'</td>'.
			                '<td>'.$row['direction'].'</td>'.
	                    '<td>'.$row['departement'].'</td>'.
	                    '<td>'.$row['service'].'</td>'.
			                '<td>'.$row['fonction'].'</td>'.
                      '<td>'.$row['nbre_enfant'].'</td>'.
			                '<td>'.$row['contrat'].'</td>'.
			                '<td>'.$row['classification'].'</td>'.
			                '<td>'.$row['categ'].'</td>'.
                      '<td>'.$row['Classe'].'</td>'.
			                '<td>'.$row['date_crea'].'</td>'.
			                '<td>'.$row['statut'].'</td>'.
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
      $nom_agent = $_GET['nom_agent'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd ->query($requete);

	    if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	        $code_admin = $row['code_admin'];   
	        $societe = $row['societe'];  
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	        $req2 = "SELECT * FROM peragent_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          echo'<tr>'.
			              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			              '<td>'.$row['compte'].'</td>'.
			              '<td>'.$row['direction'].'</td>'.
	                  '<td>'.$row['departement'].'</td>'.
	                  '<td>'.$row['service'].'</td>'.
			              '<td>'.$row['fonction'].'</td>'.
                    '<td>'.$row['nbre_enfant'].'</td>'.
			              '<td>'.$row['contrat'].'</td>'.
			              '<td>'.$row['classification'].'</td>'.
			              '<td>'.$row['categ'].'</td>'.
                    '<td>'.$row['Classe'].'</td>'.
			              '<td>'.$row['date_crea'].'</td>'.
			              '<td>'.$row['statut'].'</td>'.
			              '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
//Fin Affichage listes agents dans pers_agent

//Affichage listes 2 agents dans pers_agent
function liste_pers_agents2(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['departem'])) {
            if (empty($_GET['service'])) {
                if (empty($_GET['nom_agent'])) {
                    $admin = $_SESSION['pseudo'];
                    $params = 1;
                    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                    $resultats = $bd ->query($requete);

	                if ($resultats ->num_rows > 0) {
	                    while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];
	                        $societe = $row['societe'];    
	                   	}
	                    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                    $res1 = $bd ->query($req1);

	                    if ($res1 ->num_rows > 0) {

	                        $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' ORDER BY nom_complet ASC";
	                        $res2 = $bd ->query($req2);

	                        if ($res2 ->num_rows > 0) {
	                           	while($row = $res2 ->fetch_assoc()){
	                              	echo'<tr>'.
			                                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                                '<td>'.$row['compte'].'</td>'.
	                              			'<td>'.$row['departement'].'</td>'.
	                              			'<td>'.$row['service'].'</td>'.
			                                '<td>'.$row['etat_civil'].'</td>'.
			                                '<td>'.$row['nbre_enfant'].'</td>'.
			                                '<td>'.$row['sexe'].'</td>'.
			                                '<td>'.$row['nationalite'].'</td>'.
			                                '<td>'.$row['telephone'].'</td>'.
			                                '<td>'.$row['email'].'</td>'.
			                                '<td>'.$row['pays'].'</td>'.
			                                '<td>'.$row['date_crea'].'</td>'.
			                                '<td>'.$row['statut'].'</td>'.
			                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent1.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	               	$departem = $_GET['nom_agent'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin']; 
	                        $societe = $row['societe'];    
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM peragent_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                                '<td>'.$row['compte'].'</td>'.
	                              			'<td>'.$row['departement'].'</td>'.
	                              			'<td>'.$row['service'].'</td>'.
			                                '<td>'.$row['etat_civil'].'</td>'.
			                                '<td>'.$row['nbre_enfant'].'</td>'.
			                                '<td>'.$row['sexe'].'</td>'.
			                                '<td>'.$row['nationalite'].'</td>'.
			                                '<td>'.$row['telephone'].'</td>'.
			                                '<td>'.$row['email'].'</td>'.
			                                '<td>'.$row['pays'].'</td>'.
			                                '<td>'.$row['date_crea'].'</td>'.
			                                '<td>'.$row['statut'].'</td>'.
			                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent1.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
               	
	            //filtrage eleve par nom
            }
        }
       	else{
       		//filtrage eleve par classe
       		
	        //filtrage eleve par classe
        }
    }
    else{

    }
}
//Fin Affichage listes 2 agents dans pers_agent

//Affichage listes 3 agents dans pers_agent
function liste_pers_agents3(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['departem'])) {
            if (empty($_GET['service'])) {
                if (empty($_GET['nom_agent'])) {
                    $admin = $_SESSION['pseudo'];
                    $params = 1;
                    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                    $resultats = $bd ->query($requete);

	                if ($resultats ->num_rows > 0) {
	                    while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];
	                        $societe = $row['societe'];    
	                   	}
	                    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                    $res1 = $bd ->query($req1);

	                    if ($res1 ->num_rows > 0) {

	                        $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' ORDER BY nom_complet ASC";
	                        $res2 = $bd ->query($req2);

	                        if ($res2 ->num_rows > 0) {
	                           	while($row = $res2 ->fetch_assoc()){
	                              	echo'<tr>'.
			                                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                                '<td>'.$row['compte'].'</td>'.
	                              			'<td>'.$row['departement'].'</td>'.
	                              			'<td>'.$row['service'].'</td>'.
	                              			'<td>'.$row['fonction'].'</td>'.
			                                '<td>'.$row['matricule'].'</td>'.
			                                '<td>'.$row['no_cnss'].'</td>'.
			                                '<td>'.$row['banque'].'</td>'.
			                                '<td>'.$row['no_banque'].'</td>'.
			                                '<td>'.$row['date_crea'].'</td>'.
			                                '<td>'.$row['statut'].'</td>'.
			                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	               	$departem = $_GET['nom_agent'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin']; 
	                        $societe = $row['societe'];    
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM peragent_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                                '<td>'.$row['compte'].'</td>'.
	                              			'<td>'.$row['departement'].'</td>'.
	                              			'<td>'.$row['service'].'</td>'.
	                              			'<td>'.$row['fonction'].'</td>'.
			                                '<td>'.$row['matricule'].'</td>'.
			                                '<td>'.$row['no_cnss'].'</td>'.
			                                '<td>'.$row['banque'].'</td>'.
			                                '<td>'.$row['no_banque'].'</td>'.
			                                '<td>'.$row['date_crea'].'</td>'.
			                                '<td>'.$row['statut'].'</td>'.
			                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
               	
	            //filtrage eleve par nom
            }
        }
       	else{
       		//filtrage eleve par classe
       		
	        //filtrage eleve par classe
        }
    }
    else{

    }
}
//Fin Affichage listes 3 agents dans pers_agent

//Affichage listes 4 agents dans pers_agent
function liste_pers_agents4(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['departem'])) {
            if (empty($_GET['service'])) {
                if (empty($_GET['nom_agent'])) {
                    $admin = $_SESSION['pseudo'];
                    $params = 1;
                    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                    $resultats = $bd ->query($requete);

	                if ($resultats ->num_rows > 0) {
	                    while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin'];
	                        $societe = $row['societe'];    
	                   	}
	                    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                    $res1 = $bd ->query($req1);

	                    if ($res1 ->num_rows > 0) {

	                        $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' ORDER BY nom_complet ASC";
	                        $res2 = $bd ->query($req2);

	                        if ($res2 ->num_rows > 0) {
	                           	while($row = $res2 ->fetch_assoc()){
	                              	echo'<tr>'.
			                                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                                '<td>'.$row['compte'].'</td>'.
	                              			'<td>'.$row['departement'].'</td>'.
	                              			'<td>'.$row['service'].'</td>'.
			                                '<td>'.$row['fonction'].'</td>'.
			                                '<td>'.$row['date_debut'].'</td>'.
			                                '<td>'.$row['date_fin'].'</td>'.
			                                '<td>'.$row['motif'].'</td>'.
			                                '<td>'.$row['declaration'].'</td>'.
			                                '<td>'.$row['statut'].'</td>'.
			                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	               	$departem = $_GET['nom_agent'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin']; 
	                        $societe = $row['societe'];    
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM peragent_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                                '<td>'.$row['compte'].'</td>'.
	                              			'<td>'.$row['departement'].'</td>'.
	                              			'<td>'.$row['service'].'</td>'.
			                                '<td>'.$row['fonction'].'</td>'.
			                                '<td>'.$row['date_debut'].'</td>'.
			                                '<td>'.$row['date_fin'].'</td>'.
			                                '<td>'.$row['motif'].'</td>'.
			                                '<td>'.$row['declaration'].'</td>'.
			                                '<td>'.$row['statut'].'</td>'.
			                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_agent.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
               	
	            //filtrage eleve par nom
            }
        }
       	else{
       		//filtrage eleve par classe
       		
	        //filtrage eleve par classe
        }
    }
    else{

    }
}
//Fin Affichage listes 4 agents dans pers_agent

//Affichage listes agents dans pers_agent
function liste_print_staff(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Classe'])) {
    	if (empty($_GET['categorie'])) {
	    	if (empty($_GET['classif'])) {
		      if (empty($_GET['contrat'])) {
		        if (empty($_GET['direction'])) {
							$admin = $_SESSION['pseudo'];
							$params = 1;
							$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
							$resultats = $bd ->query($requete);

			  			if ($resultats ->num_rows > 0) {
			          while($row = $resultats ->fetch_assoc()){
			      			$code_admin = $row['code_admin'];
			      			$societe = $row['societe'];    
			          }
			          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
			          $res1 = $bd ->query($req1);

			          if ($res1 ->num_rows > 0) {
			            $req2 = "SELECT * FROM peragent_tb WHERE societe = '$societe' ORDER BY nom_complet ASC";
			            $res2 = $bd ->query($req2);

			         		if ($res2 ->num_rows > 0) {
			           		while($row = $res2 ->fetch_assoc()){
			                echo'<tr>'.
			                			'<td>'.$row['id'].'</td>'.
			                			'<td>'.$row['proville'].'</td>'.
			                			'<td>'.$row['departement'].'</td>'.
			                			'<td>'.$row['service'].'</td>'.
			                			'<td>'.$row['compte'].'</td>'.
					                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
					                  '<td>'.$row['fonction'].'</td>'.
					                  '<td>'.$row['contrat'].'</td>'.
					                  '<td>'.$row['classification'].'</td>'.
					                  '<td>'.$row['categ'].'</td>'.
					                  '<td>'.$row['Classe'].'</td>'.
					                  '<td>'.$row['categorie'].'</td>'.
					                  '<td>'.$row['date_naissance'].'</td>'.
					                  '<td>'.$row['date_debut'].'</td>'.
					                  '<td>'.$row['matricule'].'</td>'.
					                  '<td>'.$row['no_cnss'].'</td>'.
					                  '<td>'.$row['date_fin'].'</td>'.
					                  '<td>'.$row['motif'].'</td>'.
					                  '<td>'.$row['declaration'].'</td>'.
					                  '<td>'.$row['statut'].'</td>'.
					                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="print_staff.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
			        $direction = $_GET['direction'];
			        $params = 1;
			        $admin = $_SESSION['pseudo'];
		          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
		          $resultats = $bd ->query($requete);

			        if ($resultats ->num_rows > 0) {
			          while($row = $resultats ->fetch_assoc()){
			            $code_admin = $row['code_admin']; 
			            $societe = $row['societe'];    
			          }
			          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
			          $res1 = $bd ->query($req1);

			          if ($res1 ->num_rows > 0) {
			            $req2 = "SELECT * FROM peragent_tb WHERE direction LIKE '%$direction%' AND societe = '$societe' ORDER BY nom_complet ASC";
				          $res2 = $bd ->query($req2);

				          if ($res2 ->num_rows > 0) {
				            while($row = $res2 ->fetch_assoc()){
				              echo'<tr>'.
					                  '<td>'.$row['id'].'</td>'.
			                			'<td>'.$row['proville'].'</td>'.
			                			'<td>'.$row['departement'].'</td>'.
			                			'<td>'.$row['service'].'</td>'.
			                			'<td>'.$row['compte'].'</td>'.
					                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
					                  '<td>'.$row['fonction'].'</td>'.
					                  '<td>'.$row['contrat'].'</td>'.
					                  '<td>'.$row['classification'].'</td>'.
					                  '<td>'.$row['categ'].'</td>'.
					                  '<td>'.$row['Classe'].'</td>'.
					                  '<td>'.$row['categorie'].'</td>'.
					                  '<td>'.$row['date_naissance'].'</td>'.
					                  '<td>'.$row['date_debut'].'</td>'.
					                  '<td>'.$row['matricule'].'</td>'.
					                  '<td>'.$row['no_cnss'].'</td>'.
					                  '<td>'.$row['date_fin'].'</td>'.
					                  '<td>'.$row['motif'].'</td>'.
					                  '<td>'.$row['declaration'].'</td>'.
					                  '<td>'.$row['statut'].'</td>'.
					                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="print_staff.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
		        $contrat = $_GET['contrat'];
		        $params = 1;
		        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
		        $resultats = $bd ->query($requete);

			      if ($resultats ->num_rows > 0) {
			        while($row = $resultats ->fetch_assoc()){
			          $code_admin = $row['code_admin'];   
			          $societe = $row['societe'];    
			        }
			        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
			        $res1 = $bd ->query($req1);

			        if ($res1 ->num_rows > 0) {
			          $req2 = "SELECT * FROM peragent_tb WHERE contrat LIKE '%$contrat%' AND societe = '$societe' ORDER BY nom_complet ASC";
				      	$res2 = $bd ->query($req2);

				        if ($res2 ->num_rows > 0) {
				          while($row = $res2 ->fetch_assoc()){
				            echo'<tr>'.
					                '<td>'.$row['id'].'</td>'.
			                		'<td>'.$row['proville'].'</td>'.
			                		'<td>'.$row['departement'].'</td>'.
			                		'<td>'.$row['service'].'</td>'.
			                		'<td>'.$row['compte'].'</td>'.
					                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
					                '<td>'.$row['fonction'].'</td>'.
					                '<td>'.$row['contrat'].'</td>'.
					                '<td>'.$row['classification'].'</td>'.
					                '<td>'.$row['categ'].'</td>'.
					                '<td>'.$row['Classe'].'</td>'.
					                '<td>'.$row['categorie'].'</td>'.
					                '<td>'.$row['date_naissance'].'</td>'.
					                '<td>'.$row['date_debut'].'</td>'.
					                '<td>'.$row['matricule'].'</td>'.
					                '<td>'.$row['no_cnss'].'</td>'.
					                '<td>'.$row['date_fin'].'</td>'.
					                '<td>'.$row['motif'].'</td>'.
					                '<td>'.$row['declaration'].'</td>'.
					                '<td>'.$row['statut'].'</td>'.
					                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="print_staff.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
		      $classif = $_GET['classif'];
		      $params = 1;
		      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
		      $resultats = $bd ->query($requete);

			    if ($resultats ->num_rows > 0) {
			      while($row = $resultats ->fetch_assoc()){
			        $code_admin = $row['code_admin'];   
			        $societe = $row['societe'];  
			      }
			      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
			      $res1 = $bd ->query($req1);

			      if ($res1 ->num_rows > 0) {
			        $req2 = "SELECT * FROM peragent_tb WHERE classification LIKE '%$classif%' AND societe = '$societe' ORDER BY nom_complet ASC";
				      $res2 = $bd ->query($req2);

				      if ($res2 ->num_rows > 0) {
				        while($row = $res2 ->fetch_assoc()){
				          echo'<tr>'.
					              '<td>'.$row['id'].'</td>'.
			                	'<td>'.$row['proville'].'</td>'.
			                	'<td>'.$row['departement'].'</td>'.
			                	'<td>'.$row['service'].'</td>'.
			                	'<td>'.$row['compte'].'</td>'.
					              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
					              '<td>'.$row['fonction'].'</td>'.
					              '<td>'.$row['contrat'].'</td>'.
					              '<td>'.$row['classification'].'</td>'.
					              '<td>'.$row['categ'].'</td>'.
					              '<td>'.$row['Classe'].'</td>'.
					              '<td>'.$row['categorie'].'</td>'.
					              '<td>'.$row['date_naissance'].'</td>'.
					              '<td>'.$row['date_debut'].'</td>'.
					              '<td>'.$row['matricule'].'</td>'.
					              '<td>'.$row['no_cnss'].'</td>'.
					              '<td>'.$row['date_fin'].'</td>'.
					              '<td>'.$row['motif'].'</td>'.
					              '<td>'.$row['declaration'].'</td>'.
					              '<td>'.$row['statut'].'</td>'.
					              '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="print_staff.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	    	//filtrage eleve par classe
		   	$admin = $_SESSION['pseudo'];
		    $categorie = $_GET['categorie'];
		    $params = 1;
		    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
		    $resultats = $bd ->query($requete);

			  if ($resultats ->num_rows > 0) {
			    while($row = $resultats ->fetch_assoc()){
			      $code_admin = $row['code_admin'];   
			      $societe = $row['societe'];  
			    }
			    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
			    $res1 = $bd ->query($req1);

			    if ($res1 ->num_rows > 0) {
			      $req2 = "SELECT * FROM peragent_tb WHERE categorie LIKE '%$categorie%' AND societe = '$societe' ORDER BY nom_complet ASC";
				    $res2 = $bd ->query($req2);

				    if ($res2 ->num_rows > 0) {
				      while($row = $res2 ->fetch_assoc()){
				        echo'<tr>'.
					            '<td>'.$row['id'].'</td>'.
			               	'<td>'.$row['proville'].'</td>'.
			               	'<td>'.$row['departement'].'</td>'.
			               	'<td>'.$row['service'].'</td>'.
			               	'<td>'.$row['compte'].'</td>'.
					            '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
					            '<td>'.$row['fonction'].'</td>'.
					            '<td>'.$row['contrat'].'</td>'.
					            '<td>'.$row['classification'].'</td>'.
					            '<td>'.$row['categ'].'</td>'.
					            '<td>'.$row['Classe'].'</td>'.
					            '<td>'.$row['categorie'].'</td>'.
					            '<td>'.$row['date_naissance'].'</td>'.
					            '<td>'.$row['date_debut'].'</td>'.
					            '<td>'.$row['matricule'].'</td>'.
					            '<td>'.$row['no_cnss'].'</td>'.
					            '<td>'.$row['date_fin'].'</td>'.
					            '<td>'.$row['motif'].'</td>'.
					            '<td>'.$row['declaration'].'</td>'.
					            '<td>'.$row['statut'].'</td>'.
					            '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="print_staff.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
    	//filtrage eleve par classe
		  $admin = $_SESSION['pseudo'];
		  $Classe = $_GET['Classe'];
		  $params = 1;
		  $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
		  $resultats = $bd ->query($requete);

			if ($resultats ->num_rows > 0) {
			  while($row = $resultats ->fetch_assoc()){
			    $code_admin = $row['code_admin'];   
			    $societe = $row['societe'];  
			  }
			  $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
			  $res1 = $bd ->query($req1);

			  if ($res1 ->num_rows > 0) {
			    $req2 = "SELECT * FROM peragent_tb WHERE Classe LIKE '%$Classe%' AND societe = '$societe' ORDER BY nom_complet ASC";
				  $res2 = $bd ->query($req2);

				  if ($res2 ->num_rows > 0) {
				    while($row = $res2 ->fetch_assoc()){
				      echo'<tr>'.
					          '<td>'.$row['id'].'</td>'.
			              '<td>'.$row['proville'].'</td>'.
			              '<td>'.$row['departement'].'</td>'.
			              '<td>'.$row['service'].'</td>'.
			              '<td>'.$row['compte'].'</td>'.
					          '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
					          '<td>'.$row['fonction'].'</td>'.
					          '<td>'.$row['contrat'].'</td>'.
					          '<td>'.$row['classification'].'</td>'.
					          '<td>'.$row['categ'].'</td>'.
					          '<td>'.$row['Classe'].'</td>'.
					          '<td>'.$row['categorie'].'</td>'.
					          '<td>'.$row['date_naissance'].'</td>'.
					          '<td>'.$row['date_debut'].'</td>'.
					          '<td>'.$row['matricule'].'</td>'.
					          '<td>'.$row['no_cnss'].'</td>'.
					          '<td>'.$row['date_fin'].'</td>'.
					          '<td>'.$row['motif'].'</td>'.
					          '<td>'.$row['declaration'].'</td>'.
					          '<td>'.$row['statut'].'</td>'.
					          '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="print_staff.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
//Fin Affichage listes agents dans pers_agent

//Update Information Agent
function update_agent(){
  if (isset($_SESSION['pseudo'])){
    if (empty($_GET['compte'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $compte_pers= $_GET['compte'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req = "SELECT * FROM peragent_tb WHERE compte ='$compte_pers'";
        $resul = $bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="departemnt">Departement :</label>'.
					          '<select name="departemnt" class="form-control" required tabindex="100">'.
					            '<option value="'.$row['departement'].'">'.$row['departement'].'</option>'.
					            '<option value="Administration scolaire">Administration Scolaire</option>'.
					            '<option value="Administration Centrale">Administration Centrale</option>'.
					            '<option value="Intendance Generale">Intendance Generale</option>'.
					          '</select>'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="service">Service :</label>'.
				            '<select name="service" class="form-control" required tabindex="100">'.
				              '<option value="'.$row['service'].'">'.$row['service'].'</option>'.
				              '<option value="Informatique">Informatique</option>'.
				              '<option value="Secretariat">Secretariat</option>'.
				              '<option value="Administration">Administration</option>'.
				              '<option value="Comptabilite">Comptabilite</option>'.
				              '<option value="Direction scolaire">Direction scolaire</option>'.
				              '<option value="Enseignement">Enseignement</option>'.
				              '<option value="Intendance">Intendance</option>'.
				              '<option value="Protocole et charroie">Protocole et charroie</option> '.
				              '<option value="Hygiene scolaire et Sante">Hygiene scolaire et Sante</option>'.
				              '<option value="Securite">Securite</option>'.
				            '</select>'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="fonction">Fonction :</label>'.
				            '<select name="fonction" id="fonction" class="form-control" required tabindex="100">'.
				              '<option value="'.$row['fonction'].'">'.$row['fonction'].'</option>'.
				              '<option value="Manager Informatique">Manager Informatique</option>'.
				              '<option value="Secrétaire">Secrétaire</option>'.
				              '<option value="Administrateur">Administrateur</option>'.
				              '<option value="Comptable">Comptable</option>'.
				              '<option value="Caissière">Caissière</option>'.
				              '<option value="Préfet des études">Préfet des études</option>'.
				              '<option value="Directeur des études">Directeur des études</option>'.
				              '<option value="Directrice d\'école primaire">'."Directrice d'école primaire".'</option>'.
				              '<option value="Directeur adjoint EP">Directeur adjoint EP</option>'.
				              '<option value="Surnuméraire">Surnuméraire</option>'.
				              '<option value="Directrice d\'école maternelle">'."Directrice d'école maternelle".'</option>'.
				              '<option value="Directrice Adjointe EM">Directrice Adjointe EM</option>'.
				              '<option value="Institutrice">Institutrice</option>'.
				              '<option value="Enseignant">Enseignant</option>'.
				              '<option value="Directrice des études">Directrice des études</option>'.
				              '<option value="Instituteur">Instituteur</option>'.
				              '<option value="Ménagère">Ménagère</option>'.
				              '<option value="Cantinière">Cantinière</option>'.
				              '<option value="Maintenancier">Maintenancier</option>'.
				              '<option value="Chargé d\'entretien">'."Chargé d'entretien".'</option>'.
				              '<option value="Chauffeur">Chauffeur</option>'.
				              '<option value="Infirmière">Infirmière</option>'.
				              '<option value="Cantinière">Cantinière</option>'.
				              '<option value="Agent de sécurité">Agent de sécurité</option>'.
				              '<option value="Ménager">Ménager</option>'.
				            '</select>'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="nom_personnel">Nom complet : </label>'.
				            '<input type="text" class="form-control" name="nom_personnel" value="'.$row['nom_complet'].'" readonly required="required" placeholder="Nom complet...">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="classe">Classe : </label>'.
				            '<input type="text" class="form-control" name="classe" value="'.$row['Classe'].'" readonly placeholder="">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="etat_civil">Etat Civil:</label>'.
				            '<select class="form-control" name="etat_civil">'.
				              '<option value="'.$row['etat_civil'].'">'.$row['etat_civil'].'</option>'.
				              '<option value="Celibataire">Célibataire</option>'.
				              '<option value="Divorce">Divorcé</option>'.
				              '<option value="Marie">Marié</option>'.
				              '<option value="Veuf">Veuf</option>'.
				            '</select>'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="date_naissa">Date_naissance :</label>'.
				            '<input type="text" class="form-control" name="date_naissa" value="'.$row['date_naissance'].'" placeholder="Date de Naissance...">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="telephone">Téléphone :</label>'.
				            '<input type="text" class="form-control" name="telephone_agent" value="'.$row['telephone'].'" maxlength="9" placeholder="Téléphone...">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="sexe">Genre : </label>'.
				            '<select class="form-control" name="sexe">'.
				              '<option value="'.$row['sexe'].'">'.$row['sexe'].'</option>'.
				              '<option value="F">F</option>'.
				              '<option value="M">M</option>'.
				            '</select>'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="nbr_enfant">'."Nombre_enfants : ".'</label>'.
				            '<input type="number" class="form-control" name="nbr_enfant" value="'.$row['nbre_enfant'].'" placeholder="Nombre enfant...">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="mail">Adresse-Email :</label>'.
				            '<input type="email" class="form-control" name="mail" value="'.$row['email'].'" placeholder="Adresse-Email...">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="matricule">Matricule :</label>'.
				            '<input type="text" name="matricule" class="form-control" value="'.$row['matricule'].'" placeholder="N° Matricule..." required>'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="date_debut">Date_début :</label>'.
				            '<input type="text" name="date_debut" class="form-control" value="'.$row['date_debut'].'" tabindex="160" placeholder="05-12-2022">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="cnss">N° CNSS:</label>'.
				            '<input type="text" class="form-control" name="n_cnss" value="'.$row['no_cnss'].'" placeholder="N° CNSS...">'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="n_compte">Numero_compte_bancaire :</label>'.
				            '<input type="text" name="n_compte" class="form-control" value="'.$row['no_banque'].'" placeholder="Numero Compte...">'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="contrat">Type de contrat : </label>'.
				            '<select class="form-control" name="contrat">'.
				              '<option value="'.$row['contrat'].'">'.$row['contrat'].'</option>'.
					            '<option value="Journalier">Journalier</option>'.
					            '<option value="CDD">CDD</option>'.
					            '<option value="CDI">CDI</option>'.
					            '<option value="ESSAI">ESSAI</option>'.
				            '</select>'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="classif">Statut : </label>'.
				            '<select class="form-control" name="classif">'.
					            '<option value="'.$row['classification'].'">'.$row['classification'].'</option>'.
					            '<option value="Local">Local</option>'.
					            '<option value="Expat">Expat</option>'.
					          '</select>'.
				          '</fieldset>'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				            '<label class="control-label" for="date_fin">Date_fin:</label>'.
				            '<input type="date" name="date_fin" class="form-control">'.
				            '<input type="hidden" name="statut_agent" value="Actif">'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
				            '<label class="control-label" for="motif">Motif :</label>'.
				            '<input type="text" name="motif" class="form-control" value="'.$row['motif'].'" tabindex="160" placeholder="Motif...">'.
				          '</fieldset>'.
				        '</div><br>'.
				        '<div class="row w-100">'.
				          '<div class="col-sm-2 col-md-2"></div>'.
				          '<div class="col-sm-6 col-md-6">'.
				            '<button type="submit" name="cmd_edit_agent" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Modifier</button>'.
				          '</div>'.
				          '<div class="col-sm-4 col-md-4">'.
				            '<button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>'.
				          '</div>'.
				        '</div>';
	        }
	      }
	      else{
	        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
	              '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
	              '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
	            '</div>';
	      }
	    }
	    $bd->close(); 
	  } 
	}
}
//Fin Update Information Agent

//Desactiver Information Personnel
function Desactiver_pers(){
  if (isset($_SESSION['pseudo'])){
    if (empty($_GET['compte']) && empty($_GET['ID'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $Num_pers= $_GET['compte'];
      $ID_pers= $_GET['ID'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req ="SELECT * FROM peragent_tb WHERE compte ='$Num_pers' AND id ='$ID_pers'";
        $resul =$bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
                    '<label class="control-label" for="nom_personnel">Nom complet : </label>'.
                    '<select class="form-control" name="Desactivation_pers">'.
				              '<option value="'.$row['statut'].'">'.$row['statut'].'</option>'.
				              '<option value="Desactiver">Desactiver</option>'.
				              '<option value="Actif">Actif</option>'.
				            '</select>'.
                  '</fieldset>'.
                '</div><br>'.
                '<div class="row w-100">'.
				          '<div class="col-sm-12 col-md-12">'.
				            '<button type="submit" name="cmd_Desact" class="btn btn-warning mt-2 col-sm-12" tabindex="190">Accepter</button>'.
				          '</div>'.
				        '</div>';
          }
        }
        else{
          echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
                '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
              '</div>';
        }
      }
      $bd->close(); 
    } 
  }
}
//Fin Desactiver Information Personnel

//Affichage listes barème journalier
function liste_baremjnl(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	            	$code_admin = $row['code_admin']; 
	            	$societe = $row['societe'];    
	            }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         	if ($res1 ->num_rows > 0) {

	            	$req2 = "SELECT * FROM perbasesal_tb WHERE societe = '$societe' ORDER BY id ASC";
	            	$res2 = $bd ->query($req2);

	                if ($res2 ->num_rows > 0) {
	                    while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                            	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
	                            	'<td>'.$row['compte'].'</td>'.
	                            	'<td>'.$row['fonction'].'</td>'.
	                            	'<td>'.$row['Classe'].'</td>'.
			                        '<td>'.$row['salbase_J'].'</td>'.
			                        '<td>'.$row['sal_hor'].'</td>'.
			                        '<td>'.$row['transp_J'].'</td>'.
			                        '<td>'.$row['Lgmt'].'</td>'.
			                        '<td>'.$row['primperf'].'</td>'.
			                        '<td>'.$row['statut'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="baremjnl.php?compte='.$row['compte'].'" class="selecteur edit_baremjnl" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	     	$nom_agent = $_GET['nom_agent'];
	     	$params = 1;
	     	$admin = $_SESSION['pseudo'];
      		$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
         	$resultats = $bd ->query($requete);

	     	if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	            	$code_admin = $row['code_admin'];  
	            	$societe = $row['societe'];   
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {

	             	$req2 = "SELECT * FROM perbasesal_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		           	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               	while($row = $res2 ->fetch_assoc()){
		                    echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
	                            	'<td>'.$row['compte'].'</td>'.
	                            	'<td>'.$row['fonction'].'</td>'.
	                            	'<td>'.$row['Classe'].'</td>'.
			                        '<td>'.$row['salbase_J'].'</td>'.
			                        '<td>'.$row['sal_hor'].'</td>'.
			                        '<td>'.$row['transp_J'].'</td>'.
			                        '<td>'.$row['Lgmt'].'</td>'.
			                        '<td>'.$row['primperf'].'</td>'.
			                        '<td>'.$row['statut'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="baremjnl.php?compte='.$row['compte'].'" class="selecteur edit_baremjnl" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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

    }
}
//Fin Affichage listes de barème journalier

//Afficher la liste des departements
function liste_societe2() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM nom_societe_tb";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['societe'].'">'.$row['societe'].'</option>';
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

//Afficher la liste des departements
function liste_Depart() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM departmnt_tb WHERE societe ='$societe'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['departement'].'">'.$row['departement'].'</option>';
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


//Afficher la liste des services
function liste_Service() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM service_tb WHERE societe ='$societe'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['service'].'">'.$row['service'].'</option>';
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

//Afficher la liste des fonction
function liste_fonction() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM fonction_tb WHERE societe ='$societe'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['fonction'].'">'.$row['fonction'].'</option>';
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



//Afficher la liste de groupes classe dans le gombo
function liste_Classe() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM classe_tb WHERE statut ='Actif'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['classe'].'">'.$row['classe'].'</option>';
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

//Compteur des Agents
function compteur_baremjnl(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
       	}
       	else{// fin base de données
            if (empty($_GET['compte'])) {
              	$req = "SELECT * FROM perbasesal_tb WHERE customer = '".$_SESSION['pseudo']."'";
              	$resultats = $bd ->query($req);

             	$nbr = mysqli_num_rows($resultats);
               	if ($nbr > 1) {
                  	echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Barème Journaliers'.'</h4>';
               	}
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Barème Journalier'.'</h4>';
               	}
            }
            else{
	            $comptes_beremj = $_GET['compte'];
	            $req = "SELECT * FROM perbasesal_tb WHERE compte ='$comptes_beremj'";
	            $resultats = $bd ->query($req);

	            if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                    echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	                }
	            }
	            else{
	                echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	           	}
           	}
       	}
  	}
   	else{
       	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
	}
}
//Fin Compteur des Agents


//Update Information Barème journalier
function update_baremjnl(){
    if (isset($_SESSION['pseudo'])){
        if (empty($_GET['compte'])) {

            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                    '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
                    '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
                '</div>';
        }
        else{
            $num_compte= $_GET['compte'];
            include("connexion.php");
            if ($bd -> connect_error) {
                die('Impossible de se connecter à la BD:'.$bd ->connect_error);
            }
            else{
                $req = "SELECT * FROM perssalam_tb WHERE compte ='$num_compte'";
                $resul = $bd ->query($req);

                if ($resul ->num_rows > 0) {
                    while ($row = $resul ->fetch_assoc()) {
                        echo '<div class="row w-100">'.
				                '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                  	'<label class="control-label" for="nom_personnel">Nom Complet :</label>'.
					                '<input type="text" name="nom_personnel" value="'.$row['nom_complet'].'" readonly class="form-control">'.
				            	'</fieldset>'.
				            '</div><br>'.
				            '<div class="row w-100">'.
				                '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                  	'<label class="control-label" for="primanc">Prime Ancienette :</label>'.
					                '<input type="text" name="primanc" class="form-control" placeholder="Prime Ancienette...">'.
				            	'</fieldset>'.
				            	'<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                  	'<label class="control-label" for="primperf">Prime Performance :</label>'.
					                '<input type="text" name="primperf" class="form-control" placeholder="Prime Performance...">'.
				            	'</fieldset>'.
				            	'<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                  	'<label class="control-label" for="primres">Prime Responsabilite :</label>'.
					                '<input type="text" name="primres" class="form-control" placeholder="Prime Responsabilite...">'.
				            	'</fieldset>'.
				            '</div><br><br>'.
				            '<div class="row w-100">'.
				                '<div class="col-sm-2 col-md-2"></div>'.
				                '<div class="col-sm-6 col-md-6">'.
				                	'<button type="submit" name="cmd_baremej" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Modifier</button>'.
				                '</div>'.
				                '<div class="col-sm-4 col-md-4">'.
				                	'<button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>'.
				                '</div>'.
				          	'</div>';
	                }
	           	}
	           	else{
	                echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
	                            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
	                            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
	                    '</div>';
	            }
	        }
	        $bd->close(); 
	    } 
	}
}
//Fin Update Information Barème salarial

//Affichage listes barème journalier
function liste_pers_depend(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['nom_depent'])) {
        	$admin = $_SESSION['pseudo'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	            	$code_admin = $row['code_admin']; 
	            	$societe = $row['societe'];
	            }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         	if ($res1 ->num_rows > 0) {

	            	$req2 = "SELECT * FROM perenfant_tb WHERE societe = '$societe' ORDER BY id ASC";
	            	$res2 = $bd ->query($req2);

	                if ($res2 ->num_rows > 0) {
	                    while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                        		'<td>'.$row['id'].'</td>'.
	                        		'<td>'.$row['codeparent'].'</td>'.
	                            	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_parent'].'</td>'.
	                            	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_dependant'].'</td>'.
	                            	'<td>'.$row['sexe'].'</td>'.
	                            	'<td>'.$row['date_nais'].'</td>'.
			                        '<td>'.$row['affiliation'].'</td>'.
			                        '<td>'.$row['statut'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_depent.php?id='.$row['id'].'" class="selecteur edit_baremjnl" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	     	$nom_depent = $_GET['nom_depent'];
	     	$params = 1;
	     	$admin = $_SESSION['pseudo'];
      		$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
         	$resultats = $bd ->query($requete);

	     	if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	            	$code_admin = $row['code_admin'];   
	            	$societe = $row['societe'];  
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {

	             	$req2 = "SELECT * FROM perenfant_tb WHERE nom_parent LIKE '%$nom_depent%' AND societe = '$societe' ORDER BY nom_parent ASC";
		           	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               	while($row = $res2 ->fetch_assoc()){
		                    echo'<tr>'.
			                        '<td>'.$row['id'].'</td>'.
	                        		'<td>'.$row['codeparent'].'</td>'.
	                            	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_parent'].'</td>'.
	                            	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_dependant'].'</td>'.
	                            	'<td>'.$row['sexe'].'</td>'.
	                            	'<td>'.$row['date_nais'].'</td>'.
			                        '<td>'.$row['affiliation'].'</td>'.
			                        '<td>'.$row['statut'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_depent.php?id='.$row['id'].'" class="selecteur edit_baremjnl" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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

    }
}
//Fin Affichage listes de barème journalier

//Compteur depend
function compteur_depent(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
       	}
       	else{// fin base de données
            if (empty($_GET['id'])) {
              	$req = "SELECT * FROM perenfant_tb WHERE customer = '".$_SESSION['pseudo']."'";
              	$resultats = $bd ->query($req);

             	$nbr = mysqli_num_rows($resultats);
               	if ($nbr > 1) {
                  	echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Dependants'.'</h4>';
               	}
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Dependant'.'</h4>';
               	}
            }
            else{
	            $nom_depent = $_GET['id'];
	            $req = "SELECT * FROM perenfant_tb WHERE id = '$nom_depent'";
	            $resultats = $bd ->query($req);

	            if ($resultats ->num_rows > 0) {
	                while($row = $resultats ->fetch_assoc()){
	                    echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['id'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	                }
	            }
	            else{
	                echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	           	}
           	}
       	}
  	}
   	else{
       	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
	}
}
//Fin Compteur depend

//Update Information Dependant
function update_depend(){
    if (isset($_SESSION['pseudo'])){
        if (empty($_GET['id'])) {

            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                    '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
                    '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
                '</div>';
        }
        else{
            $compte_pers = $_GET['id'];
            include("connexion.php");
            if ($bd -> connect_error) {
                die('Impossible de se connecter à la BD:'.$bd ->connect_error);
            }
            else{
                $req = "SELECT * FROM perenfant_tb WHERE id ='$compte_pers'";
                $resul = $bd ->query($req);

                if ($resul ->num_rows > 0) {
                    while ($row = $resul ->fetch_assoc()) {
                        echo '<div class="row w-100">'.
				                '<fieldset class="col-lg-6 col-md-6 col-sm-12">'.
				                 	'<label class="control-label" for="nom_personnel">Nom du Parent : </label>'.
				                  	'<input type="text" class="form-control" readonly name="nom_personnel" value="'.$row['nom_parent'].'" required placeholder="Nom complet...">'.
				                '</fieldset>'.
				                '<fieldset class="col-lg-6 col-md-6 col-sm-12">'.
				                  	'<label class="control-label" for="date_naissa">Nom de l\'enfant :</label>'.
				                  	'<input type="text" class="form-control" name="nom_depent" value="'.$row['nom_dependant'].'" required placeholder="Nom de l\'enfant...">'.
				                '</fieldset>'.
				              '</div><br>'.
				              '<div class="row w-100">'.
				                '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                  	'<label class="control-label" for="date_naissa">Date de Naissance :</label>'.
				                  	'<input type="date" class="form-control" name="date_naissa" value="'.$row['date_nais'].'" required placeholder="Date de Naissance...">'.
				                '</fieldset>'.
				                '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                  	'<label class="control-label" for="sexe">Genre :</label>'.
				                  	'<select class="form-control" name="sexe">'.	
				                      	'<option>'.$row['sexe'].'</option>'.
				                    	'<option value="F">F</option>'.
				                    	'<option value="M">M</option>'.
				                  	'</select>'.
				                '</fieldset>'.
				                '<fieldset class="col-lg-4 col-md-4 col-sm-12">'.
				                 	'<label class="control-label" for="affiliation">Affiliation : </label>'.
				                 	'<select class="form-control" name="affiliation">'.
				                    	'<option>'.$row['affiliation'].'</option>'.
				                    	'<option value="Conjoint">Conjoint</option>'.
				                    	'<option value="Père">Père</option>'.
				                    	'<option value="Mere">Mere</option>'.
				                    	'<option value="Adoptif">Adoptif</option>'.
				                  	'</select>'.
				                  	'<input type="hidden" name="statut_depend" value="Actif" class="form-control">'.
				                '</fieldset>'.
				            '</div><br>'.
				            '<div class="row w-100">'.
				                '<div class="col-sm-2 col-md-2"></div>'.
				                '<div class="col-sm-6 col-md-6">'.
				                	'<button type="submit" name="cmd_edit_depend" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Modifier</button>'.
				                '</div>'.
				                '<div class="col-sm-4 col-md-4">'.
				                	'<button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>'.
				                '</div>'.
				          	'</div>';
	                    }
	                }
	                else{
	                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
	                            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
	                            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
	                        '</div>';
	                }
	        }
	        $bd->close(); 
	    } 
	}
}
//Fin Update Information Dependant

//Affichage listes agents dans pointage mensuel
function liste_perpoint(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['periode'])) {
      if (empty($_GET['nom_agent'])) {
        if (empty($_GET['departem'])) {
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];
	            $societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM persalemens1_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                      '<td>'.$row['jpres'].'</td>'.
	                      '<td>'.$row['jrMal'].'</td>'.
			                  '<td>'.$row['jcirc'].'</td>'.
			                  '<td>'.$row['jcan'].'</td>'.
			                  '<td>'.$row['jtot1'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="perpoint.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        //filtrage eleve par codepaie
	        $departem = $_GET['departem'];
	        $params = 1;
	        $admin = $_SESSION['pseudo'];
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];
	            $societe = $row['societe'];
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM persalemens1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                      '<td>'.$row['jpres'].'</td>'.
	                      '<td>'.$row['jrMal'].'</td>'.
			                  '<td>'.$row['jcirc'].'</td>'.
			                  '<td>'.$row['jcan'].'</td>'.
			                  '<td>'.$row['jtot1'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="perpoint.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        //filtrage eleve par codepaie
	      }
      }
      else{
        //filtrage eleve par nom_agent
        $admin = $_SESSION['pseudo'];
        $nom_agent = $_GET['nom_agent'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $code_admin = $row['code_admin'];
	          $societe = $row['societe'];
	        }
	        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        $res1 = $bd ->query($req1);

	        if ($res1 ->num_rows > 0) {
	          $req2 = "SELECT * FROM persalemens1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe ='$societe' ORDER BY nom_complet ASC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>'.
			                '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                '<td>'.$row['site'].'</td>'.
			                '<td>'.$row['departement'].'</td>'.
			                '<td>'.$row['fonction'].'</td>'.
			                '<td>'.$row['num_compte'].'</td>'.
	                    '<td>'.$row['jpres'].'</td>'.
	                    '<td>'.$row['jrMal'].'</td>'.
			                '<td>'.$row['jcirc'].'</td>'.
			                '<td>'.$row['jcan'].'</td>'.
			                '<td>'.$row['jtot1'].'</td>'.
			                '<td>'.$row['menspay'].'</td>'.
			                '<td>'.$row['anpay'].'</td>'.
			                '<td>'.$row['date_crea'].'</td>'.
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="perpoint.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	      //filtrage eleve par nom_agent
      }
    }
    else{
      //filtrage eleve par periode
      $admin = $_SESSION['pseudo'];
      $periode = $_GET['periode'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

	    if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	        $code_admin = $row['code_admin'];
	        $societe = $row['societe'];
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	        $req2 = "SELECT * FROM persalemens1_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          echo'<tr>'.
			              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			              '<td>'.$row['site'].'</td>'.
			              '<td>'.$row['departement'].'</td>'.
			              '<td>'.$row['fonction'].'</td>'.
			              '<td>'.$row['num_compte'].'</td>'.
	                  '<td>'.$row['jpres'].'</td>'.
	                  '<td>'.$row['jrMal'].'</td>'.
			              '<td>'.$row['jcirc'].'</td>'.
			              '<td>'.$row['jcan'].'</td>'.
			              '<td>'.$row['jtot1'].'</td>'.
			              '<td>'.$row['menspay'].'</td>'.
			              '<td>'.$row['anpay'].'</td>'.
			              '<td>'.$row['date_crea'].'</td>'.
			              '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="perpoint.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	    //filtrage eleve par periode
    }
   }
   else{

   }
}
//Fin Affichage listes pointage mensuel

//Affichage listes agents dans Pers classe
function liste_persclasse(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['periode'])) {
      if (empty($_GET['nom_agent'])) {
        if (empty($_GET['fonction'])) {
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];
	            $societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM perbasesal_tb WHERE societe ='$societe' AND statut = 'Actif' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
	                      '<td>'.$row['contrat'].'</td>'.
	                      '<td>'.$row['classification'].'</td>'.
			                  '<td>'.$row['categ'].'</td>'.
			                  '<td>'.$row['Classe'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td>'.$row['statut'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_classe.php?Compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        //filtrage agent par codepaie
	        $departem = $_GET['departem'];
	        $params = 1;
	        $admin = $_SESSION['pseudo'];
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin']; 
	            $societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM perbasesal_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['site'].'</td>'.
                              '<td>'.$row['fonction'].'</td>'.
                              '<td>'.$row['compte'].'</td>'.
                              '<td>'.$row['contrat'].'</td>'.
                              '<td>'.$row['classification'].'</td>'.
                              '<td>'.$row['categ'].'</td>'.
                              '<td>'.$row['Classe'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
			                        '<td>'.$row['statut'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_classe.php?codepaie='.$row['codepaie'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        //filtrage agent par codepaie
	      }    
      }
      else{
        //filtrage agent par nom_agent
        $admin = $_SESSION['pseudo'];
        $nom_agent = $_GET['nom_agent'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $code_admin = $row['code_admin'];   
	          $societe = $row['societe'];    
	        }
	        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	        $res1 = $bd ->query($req1);

	        if ($res1 ->num_rows > 0) {
	          $req2 = "SELECT * FROM perbasesal_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['site'].'</td>'.
                           '<td>'.$row['fonction'].'</td>'.
                           '<td>'.$row['compte'].'</td>'.
                           '<td>'.$row['contrat'].'</td>'.
                           '<td>'.$row['classification'].'</td>'.
                           '<td>'.$row['categ'].'</td>'.
                           '<td>'.$row['Classe'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
			                     '<td>'.$row['statut'].'</td>'.
			                     '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_classe.php?codepaie='.$row['codepaie'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	      //filtrage agent par nom_agent
      }
    }
    else{
  	  //filtrage agent par periode
  	  $admin = $_SESSION['pseudo'];
      $periode = $_GET['periode'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

	    if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	        $code_admin = $row['code_admin'];   
	        $societe = $row['societe'];  
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	        $req2 = "SELECT * FROM perbasesal_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
	                      '<td>'.$row['contrat'].'</td>'.
	                      '<td>'.$row['classification'].'</td>'.
			                  '<td>'.$row['categ'].'</td>'.
			                  '<td>'.$row['Classe'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td>'.$row['statut'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_classe.php?codepaie='.$row['codepaie'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	      //filtrage agent par periode
    }
  }
  else{

  }
}
//Fin Affichage listes Pers classe

//Affichage listes agents dans Pers salbase
function liste_pers_salbase(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens1_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                              '<td>'.$row['salbasej'].'</td>'.
	                              '<td>'.$row['lgmt'].'</td>'.
			                        '<td>'.$row['alfa'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_salbase.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage agent par codepaie
	            $departem = $_GET['departem'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['salbasej'].'</td>'.
	                             	'<td>'.$row['lgmt'].'</td>'.
			                        '<td>'.$row['alfa'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_salbase.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	             //filtrage agent par codepaie
	         }    
        	}
        	else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {
	              	$req2 = "SELECT * FROM persalemens1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['salbasej'].'</td>'.
	                           '<td>'.$row['lgmt'].'</td>'.
			                     '<td>'.$row['alfa'].'</td>'.
			                     '<td>'.$row['transj'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
			                     '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_salbase.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
      else{
       	//filtrage agent par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	         $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens1_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                     	'<td>'.$row['salbasej'].'</td>'.
	                     	'<td>'.$row['lgmt'].'</td>'.
			                  '<td>'.$row['alfa'].'</td>'.
			                  '<td>'.$row['transj'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_salbase.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Pers salbase

//Affichage listes agents dans base_ind-primes
function liste_base_ind_primes(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens1_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                    	while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['indiv'].'</td>'.
	                             	'<td>'.$row['primanc'].'</td>'.
			                        '<td>'.$row['primres'].'</td>'.
			                        '<td>'.$row['primperf'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_baseind.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage agent par codepaie
	            $departem = $_GET['departem'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	               	$code_admin = $row['code_admin']; 
	               	$societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                	$req2 = "SELECT * FROM persalemens1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['indiv'].'</td>'.
	                             	'<td>'.$row['primanc'].'</td>'.
			                        '<td>'.$row['primres'].'</td>'.
			                        '<td>'.$row['primperf'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_baseind.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage agent par codepaie
	         }    
        	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['indiv'].'</td>'.
	                           '<td>'.$row['primanc'].'</td>'.
			                     '<td>'.$row['primres'].'</td>'.
			                     '<td>'.$row['primperf'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
			                     '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_baseind.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
      else{
       	//filtrage agent par periode
       	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
         $params = 1;
         $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
         $resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens1_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         $res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                     	'<td>'.$row['indiv'].'</td>'.
	                     	'<td>'.$row['primanc'].'</td>'.
			                  '<td>'.$row['primres'].'</td>'.
			                  '<td>'.$row['primperf'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="pers_baseind.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes base_ind-primes

//Affichage listes agents dans Pers_sal-brut
function liste_Pers_salbrut(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['periode'])) {
      if (empty($_GET['nom_agent'])) {
        if (empty($_GET['departem'])) {
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];
	            $societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM persalemens1_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                      '<td>'.$row['taux'].'</td>'.
	                      '<td>'.$row['salbase'].'</td>'.
			                  '<td>'.$row['salmal'].'</td>'.
			                  '<td>'.$row['salcirc'].'</td>'.
			                  '<td>'.$row['salconge'].'</td>'.
			                  '<td>'.$row['totsalb'].'</td>'.
			                  '<td>'.$row['logmt'].'</td>'.
			                  '<td>'.$row['transp'].'</td>'.
			                  '<td>'.$row['alfam'].'</td>'.
			                  '<td>'.$row['brutot1'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	        //filtrage agent par codepaie
	        $departem = $_GET['departem'];
	        $params = 1;
	        $admin = $_SESSION['pseudo'];
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin']; 
	            $societe = $row['societe'];    
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM persalemens1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                      '<td>'.$row['taux'].'</td>'.
	                      '<td>'.$row['salbase'].'</td>'.
			                  '<td>'.$row['salmal'].'</td>'.
			                  '<td>'.$row['salcirc'].'</td>'.
			                  '<td>'.$row['salconge'].'</td>'.
			                  '<td>'.$row['totsalb'].'</td>'.
			                  '<td>'.$row['logmt'].'</td>'.
			                  '<td>'.$row['transp'].'</td>'.
			                  '<td>'.$row['alfam'].'</td>'.
			                  '<td>'.$row['brutot1'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	        //filtrage agent par codepaie
	      }    
      }
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	           	while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['site'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['taux'].'</td>'.
	                           '<td>'.$row['salbase'].'</td>'.
			                     '<td>'.$row['salmal'].'</td>'.
			                     '<td>'.$row['salcirc'].'</td>'.
			                     '<td>'.$row['salconge'].'</td>'.
			                     '<td>'.$row['totsalb'].'</td>'.
			                     '<td>'.$row['logmt'].'</td>'.
			                     '<td>'.$row['transp'].'</td>'.
			                     '<td>'.$row['alfam'].'</td>'.
			                     '<td>'.$row['brutot1'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
     	}
      else{
       	//filtrage agent par periode
       	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
       	$params = 1;
       	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      	$resultats = $bd ->query($requete);

	    	if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens1_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		       	if ($res2 ->num_rows > 0) {
		          	while($row = $res2 ->fetch_assoc()){
		             	echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                     	'<td>'.$row['taux'].'</td>'.
	                     	'<td>'.$row['salbase'].'</td>'.
			                  '<td>'.$row['salmal'].'</td>'.
			                  '<td>'.$row['salcirc'].'</td>'.
			                  '<td>'.$row['salconge'].'</td>'.
			                  '<td>'.$row['totsalb'].'</td>'.
			                  '<td>'.$row['logmt'].'</td>'.
			                  '<td>'.$row['transp'].'</td>'.
			                  '<td>'.$row['alfam'].'</td>'.
			                  '<td>'.$row['brutot1'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	      //filtrage agent par periode
     	}
    }
   else{

   }
}
//Fin Affichage listes Pers_sal-brut

//Affichage listes agents dans Pers_ind-primes
function liste_Pers_indprimes(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens1_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['site'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['inddiv'].'</td>'.
	                             	'<td>'.$row['primantot'].'</td>'.
			                        '<td>'.$row['primperftot'].'</td>'.
			                        '<td>'.$row['primrestot'].'</td>'.
			                        '<td>'.$row['primtot'].'</td>'.
			                        '<td>'.$row['regular'].'</td>'.
			                        '<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	           	//filtrage agent par codepaie
	           	$departem = $_GET['departem'];
	           	$params = 1;
	           	$admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	            		$req2 = "SELECT * FROM persalemens1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          		$res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['site'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['inddiv'].'</td>'.
	                             	'<td>'.$row['primantot'].'</td>'.
			                        '<td>'.$row['primperftot'].'</td>'.
			                        '<td>'.$row['primrestot'].'</td>'.
			                        '<td>'.$row['primtot'].'</td>'.
			                        '<td>'.$row['regular'].'</td>'.
			                        '<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
         }
        else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	          	}
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	           	$res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['site'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['inddiv'].'</td>'.
	                           '<td>'.$row['primantot'].'</td>'.
			                     '<td>'.$row['primperftot'].'</td>'.
			                     '<td>'.$row['primrestot'].'</td>'.
			                     '<td>'.$row['primtot'].'</td>'.
			                     '<td>'.$row['regular'].'</td>'.
			                     '<td>'.$row['brutot2'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
     	}
     	else{
       	//filtrage agent par periode
       	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens1_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         $res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['site'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                     	'<td>'.$row['inddiv'].'</td>'.
	                     	'<td>'.$row['primantot'].'</td>'.
			                  '<td>'.$row['primperftot'].'</td>'.
			                  '<td>'.$row['primrestot'].'</td>'.
			                  '<td>'.$row['primtot'].'</td>'.
			                  '<td>'.$row['regular'].'</td>'.
			                  '<td>'.$row['brutot2'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	       //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Pers_ind-primes

//Affichage listes agents dans Pers_brut-total
function liste_Pers_bruttotal(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens2_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['nbre_enfant'].'</td>'.
			                        '<td>'.$row['tot_brut'].'</td>'.
			                        '<td>'.$row['totsalb2'].'</td>'.
			                        '<td>'.$row['taux'].'</td>'.
			                        '<td>'.$row['baseImp_usd'].'</td>'.
			                        '<td>'.$row['baseImp_cdf'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	            $departem = $_GET['departem'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
              	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	             		$req2 = "SELECT * FROM persalemens2_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		           		$res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                       	'<td>'.$row['proville'].'</td>'.
			                       	'<td>'.$row['departement'].'</td>'.
			                      	'<td>'.$row['fonction'].'</td>'.
			                       	'<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['nbre_enfant'].'</td>'.
			                        '<td>'.$row['tot_brut'].'</td>'.
			                        '<td>'.$row['totsalb2'].'</td>'.
			                        '<td>'.$row['taux'].'</td>'.
			                        '<td>'.$row['baseImp_usd'].'</td>'.
			                        '<td>'.$row['baseImp_cdf'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	           	//filtrage agent par codepaie
	         }    
        	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	           	while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens2_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['classif'].'</td>'.
	                           '<td>'.$row['categ'].'</td>'.
			                     '<td>'.$row['classe'].'</td>'.
			                     '<td>'.$row['nbre_enfant'].'</td>'.
			                     '<td>'.$row['tot_brut'].'</td>'.
			                     '<td>'.$row['totsalb2'].'</td>'.
			                     '<td>'.$row['taux'].'</td>'.
			                     '<td>'.$row['baseImp_usd'].'</td>'.
			                     '<td>'.$row['baseImp_cdf'].'</td>'.
			                		'<td>'.$row['menspay'].'</td>'.
			                		'<td>'.$row['anpay'].'</td>'.
			                		'<td>'.$row['date_crea'].'</td>'.
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
	         //filtrage agent par nom_agent
       	}
     	}
      else{
   		//filtrage agent par periode
   		$admin = $_SESSION['pseudo'];
      	$periode = $_GET['periode'];
     		$params = 1;
     		$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
     		$resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens2_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			               	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			              		'<td>'.$row['proville'].'</td>'.
			              		'<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                     	'<td>'.$row['classif'].'</td>'.
	                     	'<td>'.$row['categ'].'</td>'.
			                  '<td>'.$row['classe'].'</td>'.
			                  '<td>'.$row['nbre_enfant'].'</td>'.
			                  '<td>'.$row['tot_brut'].'</td>'.
			                  '<td>'.$row['totsalb2'].'</td>'.
			                  '<td>'.$row['taux'].'</td>'.
			                  '<td>'.$row['baseImp_usd'].'</td>'.
			                  '<td>'.$row['baseImp_cdf'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Pers_brut-total

//Affichage listes agents dans Quote-part-ouvriere
function liste_Pers_QPO(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	              	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	              	$res1 = $bd ->query($req1);

	              	if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens2_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                     	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     	'<td>'.$row['proville'].'</td>'.
			                     	'<td>'.$row['departement'].'</td>'.
			                     	'<td>'.$row['fonction'].'</td>'.
			                     	'<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['cnss_QPO'].'</td>'.
			                        '<td>'.$row['iprtot_cdf'].'</td>'.
			                        '<td>'.$row['iprtot_usd'].'</td>'.
			                        '<td>'.$row['tot_advanc'].'</td>'.
			                        '<td>'.$row['tot_reten'].'</td>'.
			                        '<td>'.$row['qpo_tot'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	            $departem = $_GET['departem'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens2_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                              '<td>'.$row['classif'].'</td>'.
	                              '<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['cnss_QPO'].'</td>'.
			                        '<td>'.$row['iprtot_cdf'].'</td>'.
			                        '<td>'.$row['iprtot_usd'].'</td>'.
			                        '<td>'.$row['tot_advanc'].'</td>'.
			                        '<td>'.$row['tot_reten'].'</td>'.
			                        '<td>'.$row['qpo_tot'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
         }
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens2_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['classif'].'</td>'.
	                           '<td>'.$row['categ'].'</td>'.
			                     '<td>'.$row['classe'].'</td>'.
			                     '<td>'.$row['cnss_QPO'].'</td>'.
			                     '<td>'.$row['iprtot_cdf'].'</td>'.
			                     '<td>'.$row['iprtot_usd'].'</td>'.
			                     '<td>'.$row['tot_advanc'].'</td>'.
			                     '<td>'.$row['tot_reten'].'</td>'.
			                     '<td>'.$row['qpo_tot'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par nom_agent
         }
      }
      else{
       	//filtrage agent par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	         $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens2_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                        '<td>'.$row['classif'].'</td>'.
	                        '<td>'.$row['categ'].'</td>'.
			                  '<td>'.$row['classe'].'</td>'.
			                  '<td>'.$row['cnss_QPO'].'</td>'.
			                  '<td>'.$row['iprtot_cdf'].'</td>'.
			                  '<td>'.$row['iprtot_usd'].'</td>'.
			                  '<td>'.$row['tot_advanc'].'</td>'.
			                  '<td>'.$row['tot_reten'].'</td>'.
			                  '<td>'.$row['qpo_tot'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Quote-part-ouvriere

//Affichage listes agents dans Quote-part-patronal
function liste_Pers_QPP(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens2_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['qpp_tot'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	           	//filtrage agent par codepaie
	           	$departem = $_GET['departem'];
	           	$params = 1;
	           	$admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                	$req2 = "SELECT * FROM persalemens2_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['qpp_tot'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
         }
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	           	while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens2_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		           	$res2 = $bd ->query($req2);

		           	if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['classif'].'</td>'.
	                           '<td>'.$row['categ'].'</td>'.
			                     '<td>'.$row['classe'].'</td>'.
			                     '<td>'.$row['cnss_QPP'].'</td>'.
			                     '<td>'.$row['inpp_QPP'].'</td>'.
			                     '<td>'.$row['onem_QPP'].'</td>'.
			                     '<td>'.$row['ier_QPP'].'</td>'.
			                     '<td>'.$row['qpp_tot'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        	}
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM persalemens2_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                           		'<td>'.$row['classif'].'</td>'.
	                           		'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['qpp_tot'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	        //filtrage agent par periode
        	}
   	}
    	else{

    	}
}
//Fin Affichage listes Quote-part-patronal

//Affichage listes agents dans Net a payer
function liste_Netpay(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM persalemens2_tb WHERE societe ='$societe' AND statut = 'en cours' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['netp_usd'].'</td>'.
			                        '<td>'.$row['netp_cdf'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	            $departem = $_GET['departem'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                	$req2 = "SELECT * FROM persalemens2_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
			                        '<td>'.$row['num_compte'].'</td>'.
	                             	'<td>'.$row['classif'].'</td>'.
	                             	'<td>'.$row['categ'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['netp_usd'].'</td>'.
			                        '<td>'.$row['netp_cdf'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
         }
        	else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	           	}
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM persalemens2_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
			                     '<td>'.$row['num_compte'].'</td>'.
	                           '<td>'.$row['classif'].'</td>'.
	                           '<td>'.$row['categ'].'</td>'.
			                     '<td>'.$row['classe'].'</td>'.
			                     '<td>'.$row['netp_usd'].'</td>'.
			                     '<td>'.$row['netp_cdf'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td>'.$row['date_crea'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
      else{
       	//filtrage agent par periode
       	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
         $params = 1;
         $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
         $resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	         $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM persalemens2_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         $res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                        '<td>'.$row['classif'].'</td>'.
	                        '<td>'.$row['categ'].'</td>'.
			                  '<td>'.$row['classe'].'</td>'.
			                  '<td>'.$row['netp_usd'].'</td>'.
			                  '<td>'.$row['netp_cdf'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td>'.$row['date_crea'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Net a payer

//Affichage listes agents dans Base complementaire
function liste_basecpmt(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departement'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['indiv'].'</td>'.
			                        '<td>'.$row['primes'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	            $service = $_GET['departement'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                 	$req2 = "SELECT * FROM percompf1_tb WHERE departement LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                              '<td>'.$row['contrat'].'</td>'.
	                              '<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['indiv'].'</td>'.
			                        '<td>'.$row['primes'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['classe'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	             //filtrage agent par codepaie
	      	}    
       	}
      	else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	           	while($row = $resultats ->fetch_assoc()){
	            	$code_admin = $row['code_admin'];   
	            	$societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM percompf1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['service'].'</td>'.
			                     '<td>'.$row['compte'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
	                           '<td>'.$row['contrat'].'</td>'.
	                           '<td>'.$row['date_debut'].'</td>'.
			                     '<td>'.$row['saljrn'].'</td>'.
			                     '<td>'.$row['transj'].'</td>'.
			                     '<td>'.$row['indiv'].'</td>'.
			                     '<td>'.$row['primes'].'</td>'.
			                     '<td>'.$row['date_sortie'].'</td>'.
			                     '<td>'.$row['motif'].'</td>'.
			                     '<td>'.$row['classe'].'</td>'.
			                     '<td>'.$row['tauxch'].'</td>'.
			                     '<td>'.$row['mois'].'</td>'.
			                     '<td>'.$row['annee'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
      else{
      	//filtrage agent par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM percompf1_tb WHERE mois LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
	                     	'<td>'.$row['contrat'].'</td>'.
	                     	'<td>'.$row['date_debut'].'</td>'.
			                  '<td>'.$row['saljrn'].'</td>'.
			                  '<td>'.$row['transj'].'</td>'.
			                  '<td>'.$row['indiv'].'</td>'.
			                  '<td>'.$row['primes'].'</td>'.
			                 	'<td>'.$row['date_sortie'].'</td>'.
			                  '<td>'.$row['motif'].'</td>'.
			                  '<td>'.$row['classe'].'</td>'.
			                  '<td>'.$row['tauxch'].'</td>'.
			                  '<td>'.$row['mois'].'</td>'.
			                  '<td>'.$row['annee'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Base complementaire

//Affichage listes agents dans Jour preavis
function liste_jrpreav(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['jrprestes'].'</td>'.
	                             	'<td>'.$row['Jrcona'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['ancien'].'</td>'.
			                        '<td>'.$row['totjpreav'].'</td>'.
			                        '<td>'.$row['Jrpreav_tot'].'</td>'.
			                        '<td>'.$row['jrcopreav'].'</td>'.
			                        '<td>'.$row['jrcocomp'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	            $service = $_GET['service'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['jrprestes'].'</td>'.
	                             	'<td>'.$row['Jrcona'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['ancien'].'</td>'.
			                        '<td>'.$row['totjpreav'].'</td>'.
			                        '<td>'.$row['Jrpreav_tot'].'</td>'.
			                        '<td>'.$row['jrcopreav'].'</td>'.
			                        '<td>'.$row['jrcocomp'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
         }
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	        	if ($resultats ->num_rows > 0) {
	          	while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	           	}
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM percompf1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['service'].'</td>'.
			                     '<td>'.$row['compte'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
	                           '<td>'.$row['jrprestes'].'</td>'.
	                           '<td>'.$row['Jrcona'].'</td>'.
			                     '<td>'.$row['primdiv'].'</td>'.
			                     '<td>'.$row['retenues'].'</td>'.
			                     '<td>'.$row['ancien'].'</td>'.
			                     '<td>'.$row['totjpreav'].'</td>'.
			                     '<td>'.$row['Jrpreav_tot'].'</td>'.
			                     '<td>'.$row['jrcopreav'].'</td>'.
			                     '<td>'.$row['jrcocomp'].'</td>'.
			                     '<td>'.$row['saljrn'].'</td>'.
			                     '<td>'.$row['mois'].'</td>'.
			                     '<td>'.$row['annee'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
    	}
      else{
      	//filtrage agent par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	    	if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	         	$code_admin = $row['code_admin'];   
	         	$societe = $row['societe'];  
	         }
	         $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	       	if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM percompf1_tb WHERE mois LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		        	if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
	                        '<td>'.$row['jrprestes'].'</td>'.
	                        '<td>'.$row['Jrcona'].'</td>'.
			                  '<td>'.$row['primdiv'].'</td>'.
			                  '<td>'.$row['retenues'].'</td>'.
			                 	'<td>'.$row['ancien'].'</td>'.
			                  '<td>'.$row['totjpreav'].'</td>'.
			                  '<td>'.$row['Jrpreav_tot'].'</td>'.
			                  '<td>'.$row['jrcopreav'].'</td>'.
			                  '<td>'.$row['jrcocomp'].'</td>'.
			                  '<td>'.$row['saljrn'].'</td>'.
			                  '<td>'.$row['mois'].'</td>'.
			                  '<td>'.$row['annee'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Jour preavis

//Affichage listes agents dans Brut complementaire
function liste_brutcpmt(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                              '<td>'.$row['prestJrn'].'</td>'.
			                        '<td>'.$row['prestransp'].'</td>'.
			                        '<td>'.$row['indprim'].'</td>'.
			                        '<td>'.$row['prestot'].'</td>'.
			                        '<td>'.$row['preavsal'].'</td>'.
			                        '<td>'.$row['preaconge'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['preavitot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	            $service = $_GET['service'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	           	if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['prestJrn'].'</td>'.
			                        '<td>'.$row['prestransp'].'</td>'.
			                        '<td>'.$row['indprim'].'</td>'.
			                        '<td>'.$row['prestot'].'</td>'.
			                        '<td>'.$row['preavsal'].'</td>'.
			                        '<td>'.$row['preaconge'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['preavitot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	             //filtrage agent par codepaie
	         }    
        	}
        	else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	       	if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM percompf1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['service'].'</td>'.
			                     '<td>'.$row['compte'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
	                      		'<td>'.$row['prestJrn'].'</td>'.
			                     '<td>'.$row['prestransp'].'</td>'.
			                     '<td>'.$row['indprim'].'</td>'.
			                     '<td>'.$row['prestot'].'</td>'.
			                     '<td>'.$row['preavsal'].'</td>'.
			                     '<td>'.$row['preaconge'].'</td>'.
			                     '<td>'.$row['indlog'].'</td>'.
			                     '<td>'.$row['preavitot'].'</td>'.
			                     '<td>'.$row['mois'].'</td>'.
			                     '<td>'.$row['annee'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
   	else{
      	//filtrage agent par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	    	if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	        	if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM percompf1_tb WHERE mois LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		        	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		              	echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
	                      	'<td>'.$row['prestJrn'].'</td>'.
			                  '<td>'.$row['prestransp'].'</td>'.
			                  '<td>'.$row['indprim'].'</td>'.
			                  '<td>'.$row['prestot'].'</td>'.
			                  '<td>'.$row['preavsal'].'</td>'.
			                  '<td>'.$row['preaconge'].'</td>'.
			                  '<td>'.$row['indlog'].'</td>'.
			                  '<td>'.$row['preavitot'].'</td>'.
			                  '<td>'.$row['mois'].'</td>'.
			                  '<td>'.$row['annee'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Brut complementaire

//Affichage listes agents dans Indeminite prime
function liste_idemnprime(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['indcona'].'</td>'.
	                             	'<td>'.$row['indcocomp'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['brutot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	            $service = $_GET['service'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
            	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	           	if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf1_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['indcona'].'</td>'.
	                             	'<td>'.$row['indcocomp'].'</td>'.
			                      	'<td>'.$row['indlog'].'</td>'.
			                      	'<td>'.$row['primdiv'].'</td>'.
			                      	'<td>'.$row['brutot'].'</td>'.
			                      	'<td>'.$row['mois'].'</td>'.
			                      	'<td>'.$row['annee'].'</td>'.
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
	             //filtrage agent par codepaie
	         }    
        	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	           	while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	           	if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM percompf1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['service'].'</td>'.
			                     '<td>'.$row['compte'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
	                           '<td>'.$row['indcona'].'</td>'.
	                           '<td>'.$row['indcocomp'].'</td>'.
			                     '<td>'.$row['indlog'].'</td>'.
			                     '<td>'.$row['primdiv'].'</td>'.
			                     '<td>'.$row['brutot'].'</td>'.
			                     '<td>'.$row['mois'].'</td>'.
			                     '<td>'.$row['annee'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
      else{
      	//filtrage agent par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	    	if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	         	$code_admin = $row['code_admin'];   
	         	$societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	         	$req2 = "SELECT * FROM percompf1_tb WHERE mois LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		       	$res2 = $bd ->query($req2);

		       	if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
	                        '<td>'.$row['indcona'].'</td>'.
	                        '<td>'.$row['indcocomp'].'</td>'.
			                  '<td>'.$row['indlog'].'</td>'.
			                  '<td>'.$row['primdiv'].'</td>'.
			                  '<td>'.$row['brutot'].'</td>'.
			                  '<td>'.$row['mois'].'</td>'.
			                  '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Indeminite prime

//Affichage listes agents dans Netpay_complementaire
function liste_netpaycmpt1(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompf2_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['cnss_qpo'].'</td>'.
			                        '<td>'.$row['ipr_qpo'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['totretenues'].'</td>'.
			                        '<td>'.$row['cnss_qpp'].'</td>'.
			                        '<td>'.$row['inpp_qpp'].'</td>'.
			                        '<td>'.$row['onem_qpp'].'</td>'.
			                        '<td>'.$row['ier_qpp'].'</td>'.
			                        '<td>'.$row['tot_qpp'].'</td>'.
			                        '<td>'.$row['tot_qpo'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	            $service = $_GET['service'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                 	$req2 = "SELECT * FROM percompf2_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['proville'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['cnss_qpo'].'</td>'.
			                        '<td>'.$row['ipr_qpo'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['totretenues'].'</td>'.
			                        '<td>'.$row['cnss_qpp'].'</td>'.
			                        '<td>'.$row['inpp_qpp'].'</td>'.
			                        '<td>'.$row['onem_qpp'].'</td>'.
			                        '<td>'.$row['ier_qpp'].'</td>'.
			                        '<td>'.$row['tot_qpp'].'</td>'.
			                        '<td>'.$row['tot_qpo'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	             //filtrage agent par codepaie
	         }    
      	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM percompf2_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		            $res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                	echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                     '<td>'.$row['proville'].'</td>'.
			                     '<td>'.$row['departement'].'</td>'.
			                     '<td>'.$row['compte'].'</td>'.
			                     '<td>'.$row['fonction'].'</td>'.
	                           '<td>'.$row['contrat'].'</td>'.
	                           '<td>'.$row['brutot2'].'</td>'.
			                     '<td>'.$row['cnss_qpo'].'</td>'.
			                     '<td>'.$row['ipr_qpo'].'</td>'.
			                     '<td>'.$row['retenues'].'</td>'.
			                     '<td>'.$row['totretenues'].'</td>'.
			                     '<td>'.$row['cnss_qpp'].'</td>'.
			                     '<td>'.$row['inpp_qpp'].'</td>'.
			                     '<td>'.$row['onem_qpp'].'</td>'.
			                     '<td>'.$row['ier_qpp'].'</td>'.
			                     '<td>'.$row['tot_qpp'].'</td>'.
			                     '<td>'.$row['tot_qpo'].'</td>'.
			                     '<td>'.$row['net_pay_usd'].'</td>'.
			                     '<td>'.$row['mois'].'</td>'.
			                  	'<td>'.$row['annee'].'</td>'.
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
	         //filtrage agent par nom_agent
         }
      }
     	else{
  			//filtrage agent par periode
  			$admin = $_SESSION['pseudo'];
     		$periode = $_GET['periode'];
    		$params = 1;
    		$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
    		$resultats = $bd ->query($requete);

	    	if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	         $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	       	if ($res1 ->num_rows > 0) {
	         	$req2 = "SELECT * FROM percompf2_tb WHERE mois LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		       	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['proville'].'</td>'.
			                  '<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
	                        '<td>'.$row['contrat'].'</td>'.
	                        '<td>'.$row['brutot2'].'</td>'.
			                  '<td>'.$row['cnss_qpo'].'</td>'.
			                  '<td>'.$row['ipr_qpo'].'</td>'.
			                  '<td>'.$row['retenues'].'</td>'.
			                  '<td>'.$row['totretenues'].'</td>'.
			                  '<td>'.$row['cnss_qpp'].'</td>'.
			                  '<td>'.$row['inpp_qpp'].'</td>'.
			                  '<td>'.$row['onem_qpp'].'</td>'.
			                  '<td>'.$row['ier_qpp'].'</td>'.
			                  '<td>'.$row['tot_qpp'].'</td>'.
			                  '<td>'.$row['tot_qpo'].'</td>'.
			                  '<td>'.$row['net_pay_usd'].'</td>'.
			                  '<td>'.$row['mois'].'</td>'.
			                	'<td>'.$row['annee'].'</td>'.
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
	      //filtrage agent par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Netpay_complementaire

//Affichage listes Decompte_totaux-brut
function liste_decpte_tbrut(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	               	if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['prestJrn'].'</td>'.
			                        '<td>'.$row['prestransp'].'</td>'.
			                        '<td>'.$row['indprim'].'</td>'.
			                        '<td>'.$row['prestot'].'</td>'.
			                        '<td>'.$row['preavsal'].'</td>'.
			                        '<td>'.$row['preaconge'].'</td>'.
			                        '<td>'.$row['preavitot'].'</td>'.
			                        '<td>'.$row['indcona'].'</td>'.
			                        '<td>'.$row['indcocomp'].'</td>'.
			                        '<td>'.$row['indcotot'].'</td>'.
			                        '<td>'.$row['gratis'].'</td>'.
			                        '<td>'.$row['annuite'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['indfin'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	         	//filtrage agent par codepaie
	         	$service = $_GET['service'];
	         	$params = 1;
	         	$admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	            	while($row = $resultats ->fetch_assoc()){
	               	$code_admin = $row['code_admin']; 
	               	$societe = $row['societe'];    
	            	}
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['prestJrn'].'</td>'.
			                        '<td>'.$row['prestransp'].'</td>'.
			                        '<td>'.$row['indprim'].'</td>'.
			                        '<td>'.$row['prestot'].'</td>'.
			                        '<td>'.$row['preavsal'].'</td>'.
			                        '<td>'.$row['preaconge'].'</td>'.
			                        '<td>'.$row['preavitot'].'</td>'.
			                        '<td>'.$row['indcona'].'</td>'.
			                        '<td>'.$row['indcocomp'].'</td>'.
			                        '<td>'.$row['indcotot'].'</td>'.
			                        '<td>'.$row['gratis'].'</td>'.
			                        '<td>'.$row['annuite'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['indfin'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
       	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM tab_payfinrecap WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['prestJrn'].'</td>'.
			                        '<td>'.$row['prestransp'].'</td>'.
			                        '<td>'.$row['indprim'].'</td>'.
			                        '<td>'.$row['prestot'].'</td>'.
			                        '<td>'.$row['preavsal'].'</td>'.
			                        '<td>'.$row['preaconge'].'</td>'.
			                        '<td>'.$row['preavitot'].'</td>'.
			                        '<td>'.$row['indcona'].'</td>'.
			                        '<td>'.$row['indcocomp'].'</td>'.
			                        '<td>'.$row['indcotot'].'</td>'.
			                        '<td>'.$row['gratis'].'</td>'.
			                        '<td>'.$row['annuite'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['indfin'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM tab_payfinrecap WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['prestJrn'].'</td>'.
			                        '<td>'.$row['prestransp'].'</td>'.
			                        '<td>'.$row['indprim'].'</td>'.
			                        '<td>'.$row['prestot'].'</td>'.
			                        '<td>'.$row['preavsal'].'</td>'.
			                        '<td>'.$row['preaconge'].'</td>'.
			                        '<td>'.$row['preavitot'].'</td>'.
			                        '<td>'.$row['indcona'].'</td>'.
			                        '<td>'.$row['indcocomp'].'</td>'.
			                        '<td>'.$row['indcotot'].'</td>'.
			                        '<td>'.$row['gratis'].'</td>'.
			                        '<td>'.$row['annuite'].'</td>'.
			                        '<td>'.$row['indlog'].'</td>'.
			                        '<td>'.$row['indfin'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage listes Decompte_totaux-brut

//Affichage listes Decompte_fiscalite
function liste_decpte_fiscal(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	               	if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['brutimpo2'].'</td>'.
			                        '<td>'.$row['cnss_QPO'].'</td>'.
			                        '<td>'.$row['ipr_QPO'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['totretenues'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPO'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	         	//filtrage agent par codepaie
	         	$service = $_GET['service'];
	         	$params = 1;
	         	$admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	            	while($row = $resultats ->fetch_assoc()){
	               	$code_admin = $row['code_admin']; 
	               	$societe = $row['societe'];    
	            	}
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['brutimpo2'].'</td>'.
			                        '<td>'.$row['cnss_QPO'].'</td>'.
			                        '<td>'.$row['ipr_QPO'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['totretenues'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPO'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
       	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM tab_payfinrecap WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['brutimpo2'].'</td>'.
			                        '<td>'.$row['cnss_QPO'].'</td>'.
			                        '<td>'.$row['ipr_QPO'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['totretenues'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPO'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM tab_payfinrecap WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['brutot2'].'</td>'.
			                        '<td>'.$row['brutimpo2'].'</td>'.
			                        '<td>'.$row['cnss_QPO'].'</td>'.
			                        '<td>'.$row['ipr_QPO'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['totretenues'].'</td>'.
			                        '<td>'.$row['cnss_QPP'].'</td>'.
			                        '<td>'.$row['inpp_QPP'].'</td>'.
			                        '<td>'.$row['onem_QPP'].'</td>'.
			                        '<td>'.$row['ier_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPP'].'</td>'.
			                        '<td>'.$row['tot_QPO'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage listes Decompte_fiscalite

//Affichage listes Decompte_base salarial
function liste_decpte_bsalarl(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	               	if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                        		'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['indiv'].'</td>'.
			                        '<td>'.$row['primes'].'</td>'.
			                        '<td>'.$row['classe2'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrprestes'].'</td>'.
			                        '<td>'.$row['Jrcona'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['njcona'].'</td>'.
			                        '<td>'.$row['ancien'].'</td>'.
			                        '<td>'.$row['aprest'].'</td>'.
			                        '<td>'.$row['mprest'].'</td>'.
			                        '<td>'.$row['salanc'].'</td>'.
			                        '<td>'.$row['jrpreav_tot'].'</td>'.
			                        '<td>'.$row['jrcopreav'].'</td>'.
			                        '<td>'.$row['jrcocomp'].'</td>'.
			                        '<td>'.$row['jrtot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	         	//filtrage agent par codepaie
	         	$service = $_GET['service'];
	         	$params = 1;
	         	$admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	            	while($row = $resultats ->fetch_assoc()){
	               	$code_admin = $row['code_admin']; 
	               	$societe = $row['societe'];    
	            	}
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['indiv'].'</td>'.
			                        '<td>'.$row['primes'].'</td>'.
			                        '<td>'.$row['classe2'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrprestes'].'</td>'.
			                        '<td>'.$row['Jrcona'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['njcona'].'</td>'.
			                        '<td>'.$row['ancien'].'</td>'.
			                        '<td>'.$row['aprest'].'</td>'.
			                        '<td>'.$row['mprest'].'</td>'.
			                        '<td>'.$row['salanc'].'</td>'.
			                        '<td>'.$row['jrpreav_tot'].'</td>'.
			                        '<td>'.$row['jrcopreav'].'</td>'.
			                        '<td>'.$row['jrcocomp'].'</td>'.
			                        '<td>'.$row['jrtot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
       	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM tab_payfinrecap WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['indiv'].'</td>'.
			                        '<td>'.$row['primes'].'</td>'.
			                        '<td>'.$row['classe2'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrprestes'].'</td>'.
			                        '<td>'.$row['Jrcona'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['njcona'].'</td>'.
			                        '<td>'.$row['ancien'].'</td>'.
			                        '<td>'.$row['aprest'].'</td>'.
			                        '<td>'.$row['mprest'].'</td>'.
			                        '<td>'.$row['salanc'].'</td>'.
			                        '<td>'.$row['jrpreav_tot'].'</td>'.
			                        '<td>'.$row['jrcopreav'].'</td>'.
			                        '<td>'.$row['jrcocomp'].'</td>'.
			                        '<td>'.$row['jrtot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM tab_payfinrecap WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['indiv'].'</td>'.
			                        '<td>'.$row['primes'].'</td>'.
			                        '<td>'.$row['classe2'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrprestes'].'</td>'.
			                        '<td>'.$row['Jrcona'].'</td>'.
			                        '<td>'.$row['primdiv'].'</td>'.
			                        '<td>'.$row['retenues'].'</td>'.
			                        '<td>'.$row['njcona'].'</td>'.
			                        '<td>'.$row['ancien'].'</td>'.
			                        '<td>'.$row['aprest'].'</td>'.
			                        '<td>'.$row['mprest'].'</td>'.
			                        '<td>'.$row['salanc'].'</td>'.
			                        '<td>'.$row['jrpreav_tot'].'</td>'.
			                        '<td>'.$row['jrcopreav'].'</td>'.
			                        '<td>'.$row['jrcocomp'].'</td>'.
			                        '<td>'.$row['jrtot'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage listes Decompte_base salarial

//Affichage Print_listing-decompte
function Printlist_dcpt(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	               	if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                        		'<td>'.$row['id'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	         	//filtrage agent par codepaie
	         	$service = $_GET['service'];
	         	$params = 1;
	         	$admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	            	while($row = $resultats ->fetch_assoc()){
	               	$code_admin = $row['code_admin']; 
	               	$societe = $row['societe'];    
	            	}
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM tab_payfinrecap WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td>'.$row['id'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par codepaie
	         }    
       	}
         else{
            //filtrage agent par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM tab_payfinrecap WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                        '<td>'.$row['id'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM tab_payfinrecap WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['id'].'</td>'.
			                        '<td>'.$row['departement'].'</td>'.
			                        '<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['contrat'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['date_sortie'].'</td>'.
			                        '<td>'.$row['motif'].'</td>'.
			                        '<td>'.$row['net_pay_usd'].'</td>'.
			                        '<td>'.$row['date_crea'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage Print_listing-decompte

//Affichage listes agents dans HS-Base_complementaire
function liste_basesuppl(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
        	if (empty($_GET['nom_agent'])) {
           	if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	               	$code_admin = $row['code_admin'];
	               	$societe = $row['societe'];    
	            	}
	             	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	             	$res1 = $bd ->query($req1);

	              	if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompsup_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                            	'<td>'.$row['departement'].'</td>'.
	                            	'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['tprim'].'</td>'.
			                        '<td>'.$row['tnuit'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrpreste'].'</td>'.
			                        '<td>'.$row['hrpreste'].'</td>'.
			                        '<td>'.$row['jrnuit'].'</td>'.
			                        '<td>'.$row['jrprim'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par codepaie
	            $service = $_GET['service'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin']; 
	                        $societe = $row['societe'];    
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM percompsup_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
				                            	'<td>'.$row['departement'].'</td>'.
				                            	'<td>'.$row['service'].'</td>'.
						                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
						                        '<td>'.$row['compte'].'</td>'.
						                        '<td>'.$row['fonction'].'</td>'.
				                             	'<td>'.$row['date_debut'].'</td>'.
						                        '<td>'.$row['saljrn'].'</td>'.
						                        '<td>'.$row['transj'].'</td>'.
						                        '<td>'.$row['periode1'].'</td>'.
						                        '<td>'.$row['periode2'].'</td>'.
						                        '<td>'.$row['tprim'].'</td>'.
						                        '<td>'.$row['tnuit'].'</td>'.
						                        '<td>'.$row['tauxch'].'</td>'.
						                        '<td>'.$row['jrpreste'].'</td>'.
						                        '<td>'.$row['hrpreste'].'</td>'.
						                        '<td>'.$row['jrnuit'].'</td>'.
						                        '<td>'.$row['jrprim'].'</td>'.
						                        '<td>'.$row['mois'].'</td>'.
						                        '<td>'.$row['annee'].'</td>'.
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
	                //filtrage agent par codepaie
	           	}    
          	}
          	else{
                //filtrage agent par nom_agent
               	$admin = $_SESSION['pseudo'];
               	$nom_agent = $_GET['nom_agent'];
               	$params = 1;
               	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM percompsup_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                           '<td>'.$row['departement'].'</td>'.
	                            	'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['tprim'].'</td>'.
			                        '<td>'.$row['tnuit'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrpreste'].'</td>'.
			                        '<td>'.$row['hrpreste'].'</td>'.
			                        '<td>'.$row['jrnuit'].'</td>'.
			                        '<td>'.$row['jrprim'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM percompsup_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
	                            	'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['saljrn'].'</td>'.
			                        '<td>'.$row['transj'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['tprim'].'</td>'.
			                        '<td>'.$row['tnuit'].'</td>'.
			                        '<td>'.$row['tauxch'].'</td>'.
			                        '<td>'.$row['jrpreste'].'</td>'.
			                        '<td>'.$row['hrpreste'].'</td>'.
			                        '<td>'.$row['jrnuit'].'</td>'.
			                        '<td>'.$row['jrprim'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage listes HS-Base_complementaire

//Affichage listes agents dans HS-Net_complementaire
function liste_netpsuppl(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompsup_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                        		'<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	               	//filtrage agent par codepaie
	               	$service = $_GET['service'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin']; 
	                        $societe = $row['societe'];    
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM percompsup_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                                '<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	                //filtrage agent par codepaie
	           	}    
          	}
          	else{
                //filtrage agent par nom_agent
               	$admin = $_SESSION['pseudo'];
               	$nom_agent = $_GET['nom_agent'];
               	$params = 1;
               	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM percompsup_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                            '<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM percompsup_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
			                        '<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage listes HS-Net a payer complementaire

//Affichage listes agents dans Impression_listing-paie
function liste_print_listpaie(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM percompsup_tb WHERE societe ='$societe' AND statut = 'fin' ORDER BY nom_complet ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                        		'<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
	                             	'<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.			                        
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	               	//filtrage agent par codepaie
	               	$service = $_GET['service'];
	               	$params = 1;
	               	$admin = $_SESSION['pseudo'];
                	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                   	$resultats = $bd ->query($requete);

	               	if ($resultats ->num_rows > 0) {
	                   	while($row = $resultats ->fetch_assoc()){
	                        $code_admin = $row['code_admin']; 
	                        $societe = $row['societe'];    
	                   	}
	                  	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                  	$res1 = $bd ->query($req1);

	                   	if ($res1 ->num_rows > 0) {

	                     	$req2 = "SELECT * FROM percompsup_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		                   	$res2 = $bd ->query($req2);

		                    if ($res2 ->num_rows > 0) {
		                        while($row = $res2 ->fetch_assoc()){
		                         	echo'<tr>'.
			                              '<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
	                             	'<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.			                        
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	                //filtrage agent par codepaie
	           	}    
          	}
          	else{
                //filtrage agent par nom_agent
               	$admin = $_SESSION['pseudo'];
               	$nom_agent = $_GET['nom_agent'];
               	$params = 1;
               	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
                $resultats = $bd ->query($requete);

	          	if ($resultats ->num_rows > 0) {
	             	while($row = $resultats ->fetch_assoc()){
	                    $code_admin = $row['code_admin'];   
	                    $societe = $row['societe'];    
	              	}
	                $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	                $res1 = $bd ->query($req1);

	             	if ($res1 ->num_rows > 0) {
	                    $req2 = "SELECT * FROM percompsup_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                           '<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
	                             	'<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.			                        
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	            //filtrage agent par nom_agent
            }
        }
       	else{
       		//filtrage agent par periode
       		$admin = $_SESSION['pseudo'];
            $periode = $_GET['periode'];
          	$params = 1;
          	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	            while($row = $resultats ->fetch_assoc()){
	                $code_admin = $row['code_admin'];   
	                $societe = $row['societe'];  
	           	}
	         	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	         	$res1 = $bd ->query($req1);

	          	if ($res1 ->num_rows > 0) {
	          		$req2 = "SELECT * FROM percompsup_tb WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['departement'].'</td>'.
	                        		'<td>'.$row['service'].'</td>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['fonction'].'</td>'.
	                             	'<td>'.$row['date_debut'].'</td>'.
	                             	'<td>'.$row['periode1'].'</td>'.
			                        '<td>'.$row['periode2'].'</td>'.
			                        '<td>'.$row['saljourn'].'</td>'.
			                        '<td>'.$row['salhs'].'</td>'.
			                        '<td>'.$row['salnuit'].'</td>'.
			                        '<td>'.$row['salprim'].'</td>'.
			                        '<td>'.$row['transp'].'</td>'.
			                        '<td>'.$row['logmt'].'</td>'.
			                        '<td>'.$row['saltot'].'</td>'.
			                        '<td>'.$row['advances'].'</td>'.
			                        '<td>'.$row['netpay_usd'].'</td>'.			                        
			                        '<td>'.$row['mois'].'</td>'.
			                        '<td>'.$row['annee'].'</td>'.
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
	        //filtrage agent par periode
        }
    }
    else{

    }
}
//Fin Affichage listes Impression_listing-paie

//Compteur Perpoint
function compteur_perClas(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['Compte']) && empty($_GET['ID'])) {
        $req = "SELECT * FROM perbasesal_tb WHERE customer = '".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($req);

        $nbr = mysqli_num_rows($resultats);
        if ($nbr > 1) {
          echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Classification'.'</h4>';
        }
        else{
          echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Classification'.'</h4>';
        }
      }
      else{
        $comptes = $_GET['Compte'];
        $ID_pers = $_GET['ID'];
        $req = "SELECT * FROM perbasesal_tb WHERE compte ='$comptes' AND id ='$ID_pers'";
        $resultats = $bd ->query($req);

        if ($resultats ->num_rows > 0) {
          while($row = $resultats ->fetch_assoc()){
            echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
          }
        }
        else{
          echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
        }
      }
    }
  }
  else{
    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}
//Fin Compteur Perpoint

//Compteur Persbrut
function compteur_persbrut(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['codepaie'])) {
                $req = "SELECT * FROM persalemens2_tb WHERE customer = '".$_SESSION['pseudo']."'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Brut Totals'.'</h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Brut Total'.'</h4>';
                }
            }
            else{
                $comptes_perpoint = $_GET['codepaie'];
                $req = "SELECT * FROM persalemens2_tb WHERE codepaie ='$comptes_perpoint'";
                $resultats = $bd ->query($req);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                        echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
                    }
                }
                else{
                    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
                }
            }
        }
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}
//Fin Compteur Persbrut

//Compteur Base complementaire
function compteur_besecpmt(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
         die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{// fin base de données
         if (empty($_GET['codepaie'])) {
            $req = "SELECT * FROM percompf1_tb WHERE customer = '".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($req);

            $nbr = mysqli_num_rows($resultats);
            if ($nbr > 1) {
               echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Base-decomptes'.'</h4>';
            }
            else{
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Base-decompte'.'</h4>';
            }
       	}
         else{
            $comptes_perpoint = $_GET['codepaie'];
            $req = "SELECT * FROM percompf1_tb WHERE codepaie ='$comptes_perpoint'";
            $resultats = $bd ->query($req);

            if ($resultats ->num_rows > 0) {
               while($row = $resultats ->fetch_assoc()){
                  echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
               }
            }
            else{
               echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
            }
        	}
     	}
   }
   else{
      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
   }
}
//Fin Compteur Base complementaire

//Compteur Base supplementaire
function compteur_besesppmt(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['codepaie'])) {
                $req = "SELECT * FROM percompsup_tb WHERE customer = '".$_SESSION['pseudo']."'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Base supplementaires'.'</h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Base supplementaire'.'</h4>';
                }
            }
            else{
                $comptes_perpoint = $_GET['codepaie'];
                $req = "SELECT * FROM percompsup_tb WHERE codepaie ='$comptes_perpoint'";
                $resultats = $bd ->query($req);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                        echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
                    }
                }
                else{
                    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
                }
            }
        }
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}
//Fin Compteur Base supplementaire

//Affichage listes agents dans Peradvances
function liste_peradvances(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
            if (empty($_GET['departem'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM peradvances WHERE societe ='$societe' AND statut = 'en cours' ORDER BY noms ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                              '<td>'.$row['departement'].'</td>'.
	                              '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['taux'].'</td>'.
	                             	'<td>'.$row['reference'].'</td>'.
	                             	'<td>'.$row['description'].'</td>'.
			                        '<td>'.$row['montant_cdf'].'</td>'.
			                        '<td>'.$row['montant_$'].'</td>'.
			                        '<td>'.$row['montant_usd'].'</td>'.
			                        '<td>'.$row['tauxret'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="peradvances.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage eleve par codepaie
	            $departem = $_GET['departem'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                	$req2 = "SELECT * FROM peradvances WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY noms ASC";
		              	$res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                              '<td>'.$row['departement'].'</td>'.
	                              '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['taux'].'</td>'.
	                              '<td>'.$row['reference'].'</td>'.
	                              '<td>'.$row['description'].'</td>'.
			                        '<td>'.$row['montant_cdf'].'</td>'.
			                        '<td>'.$row['montant_$'].'</td>'.
			                        '<td>'.$row['montant_usd'].'</td>'.
			                        '<td>'.$row['tauxret'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="peradvances.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage eleve par codepaie
	         }    
         }
         else{
            //filtrage eleve par nom_agent
            $admin = $_SESSION['pseudo'];
            $nom_agent = $_GET['nom_agent'];
            $params = 1;
            $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
            $resultats = $bd ->query($requete);

	         if ($resultats ->num_rows > 0) {
	           	while($row = $resultats ->fetch_assoc()){
	               $code_admin = $row['code_admin'];   
	               $societe = $row['societe'];    
	            }
	            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	            $res1 = $bd ->query($req1);

	            if ($res1 ->num_rows > 0) {
	               $req2 = "SELECT * FROM peradvances WHERE noms LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY noms ASC";
		          	$res2 = $bd ->query($req2);

		            if ($res2 ->num_rows > 0) {
		               while($row = $res2 ->fetch_assoc()){
		                  echo'<tr>'.
			                     '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                           '<td>'.$row['departement'].'</td>'.
	                           '<td>'.$row['service'].'</td>'.
			                     '<td>'.$row['compte'].'</td>'.
			                     '<td>'.$row['taux'].'</td>'.
	                           '<td>'.$row['reference'].'</td>'.
	                           '<td>'.$row['description'].'</td>'.
			                     '<td>'.$row['montant_cdf'].'</td>'.
			                     '<td>'.$row['montant_$'].'</td>'.
			                     '<td>'.$row['montant_usd'].'</td>'.
			                     '<td>'.$row['tauxret'].'</td>'.
			                     '<td>'.$row['menspay'].'</td>'.
			                     '<td>'.$row['anpay'].'</td>'.
			                     '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="peradvances.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	          //filtrage eleve par nom_agent
         }
     	}
      else{
      	//filtrage eleve par periode
      	$admin = $_SESSION['pseudo'];
         $periode = $_GET['periode'];
        	$params = 1;
        	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        	$resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	         while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];   
	            $societe = $row['societe'];  
	         }
	        	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	        	$res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM peradvances WHERE menspay LIKE '%$periode%' AND societe = '$societe' ORDER BY noms ASC";
		        	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                        '<td>'.$row['departement'].'</td>'.
	                        '<td>'.$row['service'].'</td>'.
			                  '<td>'.$row['compte'].'</td>'.
			                  '<td>'.$row['taux'].'</td>'.
	                        '<td>'.$row['reference'].'</td>'.
	                      	'<td>'.$row['description'].'</td>'.
			                 	'<td>'.$row['montant_cdf'].'</td>'.
			                 	'<td>'.$row['montant_$'].'</td>'.
			                	'<td>'.$row['montant_usd'].'</td>'.
			                 	'<td>'.$row['tauxret'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="peradvances.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	      //filtrage eleve par periode
      }
  	}
   else{

   }
}
//Fin Affichage listes Peradvances

//Affichage listes agents dans Regularisation
function liste_regulal(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if (empty($_GET['periode'])) {
         if (empty($_GET['nom_agent'])) {
           	if (empty($_GET['service'])) {
               $admin = $_SESSION['pseudo'];
               $params = 1;
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin'];
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                  $req2 = "SELECT * FROM peradvances WHERE societe ='$societe' AND statut = 'en cours' ORDER BY noms ASC";
	                  $res2 = $bd ->query($req2);

	                  if ($res2 ->num_rows > 0) {
	                     while($row = $res2 ->fetch_assoc()){
	                        echo'<tr>'.
	                             	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                             	'<td>'.$row['departement'].'</td>'.
	                             	'<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['retenue_usd'].'</td>'.
	                             	'<td>'.$row['regul_cdf'].'</td>'.
	                             	'<td>'.$row['regul_$'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="regulars.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage eleve par codepaie
	            $service = $_GET['service'];
	            $params = 1;
	            $admin = $_SESSION['pseudo'];
               $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
               $resultats = $bd ->query($requete);

	            if ($resultats ->num_rows > 0) {
	               while($row = $resultats ->fetch_assoc()){
	                  $code_admin = $row['code_admin']; 
	                  $societe = $row['societe'];    
	               }
	               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	               $res1 = $bd ->query($req1);

	               if ($res1 ->num_rows > 0) {
	                 	$req2 = "SELECT * FROM peradvances WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY noms ASC";
		               $res2 = $bd ->query($req2);

		               if ($res2 ->num_rows > 0) {
		                  while($row = $res2 ->fetch_assoc()){
		                     echo'<tr>'.
			                        '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                              '<td>'.$row['departement'].'</td>'.
	                              '<td>'.$row['service'].'</td>'.
			                        '<td>'.$row['compte'].'</td>'.
			                        '<td>'.$row['retenue_usd'].'</td>'.
	                             	'<td>'.$row['regul_cdf'].'</td>'.
	                             	'<td>'.$row['regul_$'].'</td>'.
			                        '<td>'.$row['menspay'].'</td>'.
			                        '<td>'.$row['anpay'].'</td>'.
			                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="regulars.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            //filtrage eleve par codepaie
	         }    
         }
         else{
           	//filtrage eleve par nom_agent
               	
	        	//filtrage eleve par nom_agent
         }
     	}
      else{
       	//filtrage eleve par periode
	      $periode = $_GET['periode'];
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
	           	$req2 = "SELECT * FROM peradvances WHERE menspay LIKE '%$periode%' ORDER BY noms ASC";
		       	$res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			               	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['noms'].'</td>'.
	                   		'<td>'.$row['departement'].'</td>'.
	                   		'<td>'.$row['service'].'</td>'.
			               	'<td>'.$row['compte'].'</td>'.
			               	'<td>'.$row['retenue_usd'].'</td>'.
	                     	'<td>'.$row['regul_cdf'].'</td>'.
	                        '<td>'.$row['regul_$'].'</td>'.
			                  '<td>'.$row['menspay'].'</td>'.
			                  '<td>'.$row['anpay'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="regulars.php?Codepaie='.$row['Codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	      //filtrage eleve par periode
      }
   }
   else{

   }
}
//Fin Affichage listes Regularisation

//Compteur Barème salarial
function compteur_Advance(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['Codepaie'])) {
                $req = "SELECT * FROM peradvances WHERE customer ='".$_SESSION['pseudo']."'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Avances-Prets'.'</h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Avances-Prets'.'</h4>';
                }
            }
            else{
                $comptes_beremj = $_GET['Codepaie'];
                $req = "SELECT * FROM peradvances WHERE Codepaie ='$comptes_beremj'";
                $resultats = $bd ->query($req);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                        echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$row['noms'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
                    }
                }
                else{
                    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
                }
            }
        }
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}
//Fin Compteur Barème salarial

//Affichage listing congé
function listing_conge() {
  if(isset($_SESSION['pseudo'])){
    include('connexion.php');
    if (empty($_GET['departem'])) {
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND $params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats ->num_rows > 0) {
        while ($row = $resultats ->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req ="SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
        $res = $bd->query($req);

        if ($res ->num_rows > 0) {
          $req1 ="SELECT * FROM perconge WHERE societe = '$societe' ORDER BY id ASC";
          $res1 =$bd->query($req1);

          if ($res1 ->num_rows > 0) {
            while ($row1 = $res1 ->fetch_assoc()) {
              echo'<tr>'.
                    '<td>'.$row1['id'].'</td>'.
                    '<td>'.$row1['societe'].'</td>'.
                    '<td>'.$row1['site'].'</td>'.
                    '<td>'.$row1['direction'].'</td>'.
                    '<td>'.$row1['departement'].'</td>'.
                    '<td>'.$row1['noms'].'</td>'.
                    '<td>'.$row1['fonction'].'</td>'.
                    '<td>'.$row1['date_debut'].'</td>'.
                    '<td>'.$row1['categorie'].'</td>'.
                    '<td>'.$row1['nature'].'</td>'.
                    '<td>'.$row1['jr_ouvr'].'</td>'.
                    '<td>'.$row1['date_depart'].'</td>'.
                    '<td>'.$row1['date_retour'].'</td>'.
                    '<td>'.$row1['jr_conge'].'</td>'.
                    '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="congestaff.php?ID='.$row1['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
                  '</tr>';
            }
          }
          else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune information trouvée".'</div>';
          }
        }
        else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
        }
      }
      else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
      }
    }
    else {
     //filtrage eleve par option
                    
      //filtrage eleve par option
    }
  }
  else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
  }
}
//Fin Affichage listing congé


//Affichage listes agents dans pers_agent
function liste_persagents_Maj(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['departem'])) {
			$admin = $_SESSION['pseudo'];
			$params = 1;
			$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
			$resultats = $bd ->query($requete);
      $status = "Actif";

	  	if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	        $code_admin = $row['code_admin'];
	        $societe = $row['societe'];    
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	        $req2 = "SELECT * FROM peragent_tb WHERE societe ='$societe' AND statut ='Actif' OR statut ='Inactif' ORDER BY nom_complet ASC";
	        $res2 = $bd ->query($req2);

	        if ($res2 ->num_rows > 0) {
	          while($row = $res2 ->fetch_assoc()){
	            echo'<tr>'.
			              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			              '<td>'.$row['compte'].'</td>'.
			              '<td>'.$row['direction'].'</td>'.
	                  '<td>'.$row['departement'].'</td>'.
	                  '<td>'.$row['service'].'</td>'.
			              '<td>'.$row['fonction'].'</td>'.
			              '<td>'.$row['contrat'].'</td>'.
			              '<td>'.$row['classification'].'</td>'.
			              '<td>'.$row['categ'].'</td>'.
			              '<td>'.$row['Classe'].'</td>'.
			              '<td>'.$row['date_crea'].'</td>'.
			              '<td>'.$row['statut'].'</td>'.
			              '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="maj-pers.php?compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	    $departem = $_GET['departem'];
	    $params = 1;
	    $admin = $_SESSION['pseudo'];
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
      $resultats = $bd ->query($requete);

	    if ($resultats ->num_rows > 0) {
	      while($row = $resultats ->fetch_assoc()){
	        $code_admin = $row['code_admin']; 
	        $societe = $row['societe'];    
	      }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {
	        $req2 = "SELECT * FROM peragent_tb WHERE departement LIKE '%$departem%' AND societe ='$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          echo'<tr>'.
			              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			              '<td>'.$row['compte'].'</td>'.
			              '<td>'.$row['direction'].'</td>'.
	                  '<td>'.$row['departement'].'</td>'.
	                  '<td>'.$row['service'].'</td>'.
			              '<td>'.$row['fonction'].'</td>'.
			              '<td>'.$row['contrat'].'</td>'.
			              '<td>'.$row['classification'].'</td>'.
			              '<td>'.$row['categ'].'</td>'.
                    '<td>'.$row['Classe'].'</td>'.
			              '<td>'.$row['date_crea'].'</td>'.
			              '<td>'.$row['statut'].'</td>'.
			              '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="maj-pers.php?compte='.$row['compte'].'&&ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
  else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
  }
}
//Fin Affichage listes agents dans pers_agent

//Update Information Agent
function update_agentMaj_Inactive(){
  if (isset($_SESSION['pseudo'])){
    if (empty($_GET['ID'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $ID_pers= $_GET['ID'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req = "SELECT * FROM peragent_tb WHERE id ='$ID_pers'";
        $resul = $bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
                    '<label class="control-label" for="nom_personnel">Nom complet : </label>'.
                    '<select class="form-control" name="maj_pers">'.
				              '<option value="'.$row['statut'].'">'.$row['statut'].'</option>'.
				              '<option value="Inactif">Inactif</option>'.
				              '<option value="Actif">Actif</option>'.
				            '</select>'.
                  '</fieldset>'.
                '</div><br>'.
                '<div class="row w-100">'.
				          '<div class="col-sm-12 col-md-12">'.
				            '<button type="submit" name="cmd_Majagent" class="btn btn-warning mt-2 col-sm-12" tabindex="190">Accepter</button>'.
				          '</div>'.
				        '</div>';
          }
        }
        else{
          echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
                '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
              '</div>';
        }
      }
      $bd->close(); 
    } 
  }
}
//Fin Update Information Agent

//fonction d'attire la liste personnel à la BDD
function liste_CenterActif(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin']; 
	      $societe = $row['societe'];    
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM tab_center WHERE societe ='$societe' ORDER BY id ASC";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	          echo '<option value="'.$row['etablissement'].'">'.$row['etablissement'].'</option>';
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

//Affichage liste de soins de personnel
function listing_soinspers() {
  if (isset($_SESSION['pseudo'])) {
    include('connexion.php');
    if (empty($_GET['departem'])) {
      $admin = $_SESSION['pseudo'];
      $params = 1;
      
      $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats =$bd->query($requete);

      if ($resultats ->num_rows > 0) {
        while ($row = $resultats ->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $requet ="SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
        $resul =$bd ->query($requet);

        if ($resul ->num_rows > 0) {
          $req ="SELECT * FROM tab_persoins WHERE demandeur ='$societe' ORDER BY id ASC";
          $res =$bd->query($req);

          if ($res ->num_rows > 0) {
            while ($row1 = $res ->fetch_assoc()) {
              echo'<tr>'.
                    '<td>'.$row1['id'].'</td>'.
                    '<td>'.$row1['demandeur'].'</td>'.
                    '<td>'.$row1['site'].'</td>'.
                    '<td>'.$row1['direction'].'</td>'.
                    '<td>'.$row1['departement'].'</td>'.
			              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row1['agent'].'</td>'.
                    '<td>'.$row1['fonction'].'</td>'.
                    '<td>'.$row1['destinataire_noms'].'</td>'.
                    '<td>'.$row1['destinataire_tel'].'</td>'.
                    '<td>'.$row1['traitement'].'</td>'.
                    '<td>'.$row1['beneficiare_noms'].'</td>'.
                    '<td>'.$row1['beneficiaire_qualite'].'</td>'.
                    '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="persoins.php?Ref='.$row1['ref'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
	                '</tr>';
            }
          }
          else {
            # code...
          }
        }
        else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';
        }
      }
      else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
      }
    }
    else {
      //filtrage eleve par option
                    
      //filtrage eleve par option
    }
  }
  else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
  }
}
//Fin-Affichage liste de soins de personnel

//Compteur bon de soins
function compteur_persoins(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['Ref'])) {
        $req = "SELECT * FROM tab_persoins WHERE prepare_par ='".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($req);
        $nbr = mysqli_num_rows($resultats);

        if ($nbr > 1) {
        	echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Agents'.'</h4>';
        }
        else{
        	echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Agent'.'</h4>';
        }
      }
      else{
	      $compte_soins = $_GET['Ref'];
	      $req = "SELECT * FROM tab_persoins WHERE ref ='$compte_soins'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	        	echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['agent'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	        }
	      }
	      else{
	      	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	      }
      }
    }
  }
 	else{
  	echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
	}
}
//Fin Compteur bon de soins

//bon de soins
function bondesoin(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

      if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];     
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd ->query($req1);

        if ($res1 ->num_rows > 0) {// verification de droit administratif
          if (empty($_GET['ref_doc'])) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
          }
          else{
            $reference = $_GET['ref_doc'];
            $requet = "SELECT * FROM tab_persoins WHERE ref ='$reference'";
            $result = $bd ->query($requet);

            if ($result ->num_rows > 0) {
              while($row = $result ->fetch_assoc()){
                $reference = $row['ref'];
                $Traitemnt = $row['traitement'];
                $Societe   = $row['demandeur'];
                $Hopital   = $row['destinataire_noms'];
                $Adresse   = $row['destinataire_adresse'];
                $Nomagent  = $row['agent'];
                $Beneficier= $row['beneficiare_noms'];
                $Qualite   = $row['beneficiaire_qualite'];
                $date      = $row['date_crea'];
                $customer  = $row['prepare_par'];
              }
              echo'<table>
                    <thead>
				            </thead>
                    <tbody style="color:black">
                      <tr>
                        <td colspan="3">&nbsp;</td>
				                <td class="corp-table" style="font-size:16px">Traitement </td>
				                <td class="corp-table" style="font-size:16px"><strong>: '.$Traitemnt.'</strong></td>
				                <td style="width:100px"></td>
				                <td class="corp-table" style="font-size:16px">Ref </td>
				                <td class="corp-table" style="font-size:16px"><strong>: '.$reference.'</strong></td>
				              </tr>
                      <tr style="height:20px"></tr>
                      <tr>
				                <td class="corp-table" colspan="3" style="font-size:16px;width:200px"><b>Expéditeur / Societé</b></td>
				                <td class="corp-table" colspan="3" style="font-size:16px"><strong>: '.$Societe.' </strong></td>
				              </tr>
                      <tr style="height:15px"></tr>
                      <tr>
				                <td class="corp-table" colspan="3" style="font-size:16px;"><b>Destinataire </b></td>
				                <td class="corp-table" colspan="3" style="font-size:16px"><strong>: '.$Hopital.' </strong></td>
				              </tr>
                      <tr>
				                <td class="corp-table" colspan="2" style="font-size:16px;">&nbsp</td>
				                <td class="corp-table" colspan="4" style="font-size:16px"><strong>'.$Adresse.' </strong></td>
				              </tr>
                      <tr style="height:15px"></tr>
                      <tr>
				                <td class="corp-table" colspan="3" style="font-size:16px;"><strong>Noms de l\'agent</strong></td>
				                <td class="corp-table" colspan="3" style="font-size:16px"><strong>: '.$Nomagent.' </strong></td>
				              </tr>
                      <tr style="height:20px"></tr>
                      <tr><td class="corp-table" colspan="6"><p style="font-size:18px"><b>Bénéficiaire des soins de santé / Malade</b></p></td></tr>
                      <tr>
				                <td class="corp-table" colspan="4" style="font-size:16px"><strong>Noms : </strong>'.$Beneficier.'</td>
                        <td style="width:100px"></td>
				                <td class="corp-table" colspan="2" style="font-size:16px"><strong><strong>Qualité : </strong>'.$Qualite.'</td>
				              </tr>
                      <tr style="height:20px"></tr>
                      <tr>
				                <td class="corp-table" colspan="6">
                          <p style="font-size: larger;">
                            <b>NB : </b><span>Ce billet d\'envoi n\'est valable qu\'une (1) seule fois</span><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>Ce billet d\'envoi est individuel et non transmissible</span>
                          </p>
                        </td>
				              </tr>
                      <tr style="height:20px"></tr>
                      <tr>
                        <td colspan="2"></td>
				                <td class="corp-table" colspan="4">
                          <p style="font-size: large;text-align:center">
                            <strong>Fait à Kinshasa, le '.$date.'</strong><br>
                            <strong>Signature + cachet</strong><br> '.$customer.'
                          </p>
                        </td>
				              </tr>
                    </tbody>
                  </table>';
            }
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Violation d'accès".'</div>';
            }
          }
        }
      }
      else{
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
      }
    }
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
  }
}

//Modification de classe bareme
function Modification_de_class(){
  if (isset($_SESSION['pseudo'])){
    if (empty($_GET['Compte']) && empty($_GET['ID'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $Num_pers= $_GET['Compte'];
      $ID_pers= $_GET['ID'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req ="SELECT * FROM perbasesal_tb WHERE compte ='$Num_pers' AND id ='$ID_pers'";
        $resul =$bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">
                  <fieldset class="col-lg-12 col-md-12 col-sm-12">
                    <label class="control-label mt-2" for="nomagent"><strong>Noms Agent </strong></label>
                    <input type="text" name="nomagent" id="nomagent" value="'.$row['nom_complet'].'" readonly class="form-control">
                  </fieldset>
                </div>
                <div class="row w-100 mt-4">
                  <fieldset class="col-lg-2 col-md-2 col-sm-12">
                    <label class="control-label mt-2" for="direct"><strong>Direction :</strong></label>
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <select name="direct" class="form-control" required tabindex="100">
                      <option value="'.$row['direct'].'">'.$row['direct'].'</option>
                      <option value="ADM">ADM</option>
                      <option value="OPS">OPS</option>
                      <option value="TECH">TECH</option>
                    </select>
                  </fieldset>
                  <fieldset class="col-lg-2 col-md-2 col-sm-12">
                    <label class="control-label mt-2" for="classe"><strong>Classe :</strong></label>
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <select name="classe" id="classe" class="form-control" required tabindex="100">
                      <option value="'.$row['Classe'].'">'.$row['Classe']. '</option>
                      <option value="Mo1">Mo1</option>
                      <option value="Mo2">Mo2</option>
                      <option value="Ms1">Ms1</option>
                      <option value="Ts1">Ts1</option>
                      <option value="Ts2">Ts2</option>
                      <option value="Ts3">Ts3</option>
                      <option value="Tq1">Tq1</option>
                      <option value="Tq2">Tq2</option>
                      <option value="Th1">Th1</option>
                      <option value="Mt1">Mt1</option>
                      <option value="Mt2">Mt2</option>
                      <option value="Mt3">Mt3</option>
                      <option value="Mt4">Mt4</option>
                      <option value="Cc1">Cc1</option>
                      <option value="Cc2">Cc2</option>
                      <option value="Cc3">Cc3</option>
                      <option value="Cc3">Cc3</option>
                    </select>
                  </fieldset>
                </div>
                <div class="row w-100 mt-4">
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="primres_fix">Prime_responsabilite :</label>
                    <input type="number" class="form-control" name="primres_fix" value="'.$row['primres'].'" required>
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="primperf_fix">Prime_performance :</label>
                    <input type="number" name="primperf_fix" value="'.$row['primperf'].'" class="form-control" required>
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="primanc_fix">Prime_ancienette :</label>
                    <input type="text" name="primanc_fix" value="'.$row['primanc'].'" class="form-control" required>
                  </fieldset>
                </div><br>
                <div class="row w-100 mt-4">
                  <div class="col-sm-2 col-md-2"></div>
                  <div class="col-sm-6 col-md-6">
                    <button type="submit" name="cmd_ClasseUP" class="btn btn-success mt-2 col-sm-6" tabindex="190">Modifier</button>
                  </div>
                  <div class="col-sm-4 col-md-4">
                    <button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>
                  </div>
                </div>';
          }
        }
        else{
          echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
                '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
              '</div>';
        }
      }
      $bd->close(); 
    } 
  }
}
//Fin Modification de classe bareme

//Impression fiche de paie en groupe par departement___
function releve_agent(){
	if (isset($_SESSION['pseudo'])) {
		if (empty($_GET['depart']) && empty($_GET['periode'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucune departement selectionnée".'</div>';  
    }
		else{
      include ("connexion.php");
      $department = $_GET['depart'];
      $PeriodEnco = $_GET['periode'];
      $statut = 'en cours';
      $d_id=date("d-m-y");
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

      if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $requet = "SELECT * FROM peragent_tb WHERE societe ='$societe' AND departement = '$department' AND statut ='Actif'";
        $result = $bd ->query($requet);

        if ($result ->num_rows > 0) {
          while($row = $result ->fetch_assoc()){
            $nom_complet = $row['nom_complet'];
            $num_compte  = $row['compte'];
            $matricule   = $row['matricule'];
            $numero_cnss = $row['no_cnss'];
            $fonction    = $row['fonction'];
            $departmnt   = $row['departement'];
            $categ       = $row['categorie'];
            $locat       = $row['site'];
            $societe     = $row['societe'];

            echo'<div class="col-8" style="border:1px solid #000;">
                  <h6 style="padding: 0px;font-size:16px">'.$societe.'</h6>
                  <p style="text-align: left;font-weight: bold;padding-left:100px;font-size:23px">BULLETIN DE PAIE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size:14px">PERIODE : </span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <span style="font-size:14px"> '.$d_id.' </span>
                  </p>

                  <div class="row">
                    <table>
                      <thead>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody style="color:black">
                        <tr style="border-top:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
                          <td class="corp-table" style="font-size:16px"> </td>
                          <td class="corp-table" style="font-size:16px"></td>
                          <td>&nbsp;</td>
                          <td class="corp-table" style="font-size:16px">'.$locat.' </td>
                          <td class="corp-table" style="font-size:16px"> '.$departmnt.'</td>
                        </tr>
                        <tr style="border-right:2px solid #000;border-left:2px solid #000">
                          <td class="corp-table" style="font-size:16px">NOMS </td>
                          <td class="corp-table" style="font-size:16px">: '.$nom_complet.'</td>
                          <td>&nbsp;</td>
                          <td class="corp-table" style="font-size:16px">MATRICULE </td>
                          <td class="corp-table" style="font-size:16px">: '.$matricule.'</td>
                        </tr>
                        <tr style="border-bottom:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
                          <td class="corp-table" style="font-size:16px">FONCTION </td>
                          <td class="corp-table" style="font-size:16px">: '.$fonction.'</td>
                        </tr>
                        <tr>
                          <td class="corp-table" colspan="4" style="padding:10px"> </td>
                        </tr>';
                      $req = "SELECT * FROM tab_payfiche WHERE departement = '$department' AND menspay ='$PeriodEnco' AND nom_complet ='$nom_complet' AND societe ='$societe' AND statut ='$statut'";
                      $sql = $bd ->query($req);
                        
                      if ($sql ->num_rows > 0) {
                        echo'<div class="row w-100 d-flex justify-content-end mb-2">
                              <div class="col-lg-12 col-md-12 col-sm-12">';
                                while ($row = $sql->fetch_assoc()) {
                                  $depart      = $row['departement'];
                                  $period      = $row['menspay'];
                                  $anpay       = $row['anpay'];
                                  $salbase     = $row['salbase'];
                                  $salmal      = $row['salmal'];
                                  $salcirc     = $row['salcirc'];
                                  $salconge    = $row['salconge'];
                                  $logmt       = $row['logmt'];
                                  $transp      = $row['transp'];
                                  $alfam       = $row['alfam'];
                                  $primtot     = $row['primtot'];
                                  $indiv       = $row['inddiv'];
                                  $brutot2     = $row['brutot2'];
                                  $periode     = $row['menspay'];
                                  $taux        = $row['taux'];
                                  $jourpres    = $row['jpres'];
                                  $jourmal     = $row['jrmal'];
                                  $jrcirco     = $row['jcirc'];
                                  $jrconge     = $row['jcan'];
                                  $taux        = $row['taux'];
                                  $salbasej    = $row['salbasej'];
                                  $transj      = $row['transj'];
                                  $regular     = $row['regular'];
                                  $tot_reten = $row['tot_reten'];
                                  $ipttot = $row['iprtot_usd'];
                                  $cnss = $row['cnss_QPO'];
                                  $advance = $row['tot_advanc'];
                                  $Netapayer= $row['netp_usd'];
                                }
                                //Calcul jour
                                $Jrmalcir   = $jourmal+$jrcirco;
                                $Trmalcir   = $salmal+$salcirc;
                                $TrmalcirFC = $Trmalcir * $taux;
                                $Tjrmalcir = $TrmalcirFC/$Jrmalcir;
                        
                                //Convertir le monnaie
                                $salaireb   = $salbase * $taux;
                                $salaireM   = $salmal * $taux;
                                $salaireCir = $salcirc * $taux;
                                $salaireCo  = $salconge * $taux;
                                $Allogmnt   = $logmt * $taux;
                                $Transport  = $transp * $taux;
                                $Allocat    = $alfam * $taux;
                                $Primes     = $primtot * $taux;
                                $Indemnites = $indiv * $taux;
                                $TotalB     = $brutot2 * $taux;
                                $salbasejFC = $salbasej * $taux;
                                $Ttransj    = $transj * $taux;
                        
                                $Tauxjrcon = $salconge/$jrconge;
                                $salcongFC = $Tauxjrcon * $taux;
                                $TregularFC = $regular * $taux;
                        
                                //Convertir le monnaie
                                $CNSS          = $cnss * $taux;
                                $Avances_prets = $advance * $taux;
                                $ipttotCDF     = $ipttot * $taux;
                                $Retenue       = $tot_reten * $taux;
                        
                                //Totaux
                                $Totalbrut = $salaireb + $TrmalcirFC + $salaireCo + $Transport + $Allogmnt + $TregularFC;
                                $rang3 = $CNSS+$ipttotCDF+$Avances_prets;
                                $Netpaye = $Totalbrut - $rang3;
                        
                                $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_complet' AND societe ='$societe' AND statut ='Actif'";
                                $sql2 = $bd ->query($req2);
                        
                                if ($sql2 ->num_rows > 0) {
                                  while($row2 = $sql2 ->fetch_assoc()){

                                    //debut en tete
                                    $nom_complet = $row2['nom_complet'];
                                    echo'
                                                            <tr style="border:2px solid #000">
                                                            <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000">Libelle </td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:center;border-left:2px solid #000">Taux</td>
                                                            <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000;border-right:2px solid #000;text-align:center;">Jour</td>
                                                            <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right;border-right:2px solid #000;text-align:center;">Montant</td>
                                                          </tr>
                                                          <tr style="border-right:2px solid #000;border-left:2px solid #000">
                                                            <td style="font-weight:bold;text-align:center">A PAYER</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Salaire journalier &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000">'.number_format($salbasejFC,2).'</td>
                        
                                                            <td class="corp-table" style="font-size:16px;bold;border-left:2px solid #000;border-right:2px solid #000;text-align:center">'.$jourpres.'</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.$salaireb.'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Salaire Jours_maladie-circonstance &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000">'.$Tjrmalcir.'</td>
                        
                                                            <td class="corp-table" style="font-size:16px;bold;border-left:2px solid #000;border-right:2px solid #000;text-align:center">'.$Jrmalcir.'</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.$TrmalcirFC.'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Salaire Jours ferié &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000">0</td>
                                                            <td class="corp-table" style="font-size:16px;bold;border-left:2px solid #000;border-right:2px solid #000;text-align:center">0</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Salaire congé annuel &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000;border-right:2px solid #000">'.number_format($salcongFC,2).'</td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;text-align:center;border-right:2px solid #000">'.$jrconge.'</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.$salaireCo.'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Indemnités_transport &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000;border-right:2px solid #000">'.$Ttransj.'</td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;text-align:center;border-right:2px solid #000">'.$jourpres.'</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.$Transport.'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Indemnités_logement &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;text-align:center;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($Allogmnt,2).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Anciennete &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Primes &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">0</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Regularisation &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($TregularFC,2).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" colspan="4" style="font-size:16px;border:2px solid #000;font-weight:900">Total brut &nbsp;&nbsp;&nbsp;&nbsp;</td>				                        
                                                            <td class="corp-table" style="font-size:19px;text-align:right;border:2px solid #000;font-weight:bold">'.number_format($Totalbrut,2).'</td>
                                                          </tr>
                        
                                                          <tr style="border-right:2px solid #000;border-left:2px solid #000">
                                                            <td style="font-weight:bold;text-align:center">A RETENIR</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                            <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Cnss &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($CNSS,2).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">IPR &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($ipttotCDF,2).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Prêt &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
                                                            <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($Avances_prets,2).'</td>
                                                          </tr>
                                                          <tr>
                                                            <td class="corp-table" colspan="4" style="font-size:16px;border:2px solid #000;font-weight:900">Total retenues &nbsp;&nbsp;&nbsp;&nbsp;</td>				                        
                                                            <td class="corp-table" style="font-size:19px;text-align:right;border:2px solid #000;font-weight:bold">'.number_format($rang3,2).'</td>
                                                          </tr>
                        
                                                          <tr style="border:2px solid #000">
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;font-weight:bold;padding:11px">NET A PAYER_CDF </td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td>&nbsp;&nbsp;</td>
                                                            <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($Netpaye,2).'</td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                    </div><br>
                                                  </div>';
                        
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
        else {
          echo 'Aucune information trouvée';
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
//Impression fiche de paie en groupe par departement___

//Compteur perConge
function compteur_perconge(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ID'])) {
        $admin = $_SESSION['pseudo'];
        $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params =1";
        $res = $bd->query($requete);

        if ($res ->num_rows > 0) {
          while ($row = $res ->fetch_assoc()) {
            $nom_soc = $row['societe'];
            $codAdmin = $row['code_admin'];
          }
          $req = "SELECT * FROM perconge WHERE societe ='$nom_soc' AND codeSoc ='$codAdmin'";
          $resultats = $bd ->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class=""></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Congés'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class=""></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Congé'.'</h4>';
          }
        }
        else{

        }
      }
      else{
        $Idpers = $_GET['ID'];
	      $req = "SELECT * FROM perconge WHERE id ='$Idpers'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['noms'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
	        }
	      }
	      else{
	        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
	      }
      }
    }
  }
  else{
    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}
//End Compteur perConge

//Update PerCongé
function update_conge(){
  if (isset($_SESSION['pseudo'])){
    if (empty($_GET['ID'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $Idpers= $_GET['ID'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req = "SELECT * FROM perconge WHERE id ='$Idpers'";
        $resul = $bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">
                <fieldset class="col-lg-3 col-md-2 col-sm-12">
                  <label class="control-label mt-2" for="nomagent"><strong> Noms </strong></label>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <input type="text" name="nomagent" class="form-control" readonly value="'.$row['noms'].'">
                </fieldset>
                <fieldset class="col-lg-2 col-md-2 col-sm-12">
                  <label class="control-label mt-2" for="fonction"><strong>Fonction </strong></label>
                </fieldset>
                <fieldset class="col-lg-3 col-md-4 col-sm-12">
                  <input type="text" name="fonction" readonly class="form-control" value="'.$row['fonction'].'">
                </fieldset>
              </div>
              <div class="row w-100 mt-4">
                <fieldset class="col-lg-3 col-md-2 col-sm-12">
                  <label class="control-label mt-2" for="depart"><strong>Departement </strong></label>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <input type="text" name="depart" readonly class="form-control" value="'.$row['departement'].'">
                </fieldset>
                <fieldset class="col-lg-2 col-md-2 col-sm-12">
                  <label class="control-label mt-2" readonly for="datedebut"><strong>Date de début </strong></label>
                </fieldset>
                <fieldset class="col-lg-3 col-md-4 col-sm-12">
                  <input type="text" name="datedebut" readonly class="form-control" value="'.$row['date_debut'].'">
                </fieldset> 
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-3 col-md-3 col-sm-12">
                  <label class="control-label mt-2" for="dateprevu"><strong>Date_prévues Du </strong></label>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <input type="text" class="form-control" name="dateprevu" value="'.$row['date_depart'].'">
                </fieldset>
                <fieldset class="col-lg-2 col-md-1 col-sm-12">
                  <label class="control-label mt-2" for="datefin"><strong>Au </strong></label>
                </fieldset>
                <fieldset class="col-lg-3 col-md-4 col-sm-12">
                  <input type="text" class="form-control" name="datefin" value="'.$row['estimation_retour'].'">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-3 col-md-4 col-sm-12">
                  <label class="control-label mt-2" for="jourfer"><strong>Jours fériés </strong></label>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <input type="number" class="form-control" name="jourfer" value="'.$row['jrferie'].'">
                </fieldset>
                <fieldset class="col-lg-2 col-md-4 col-sm-12">
                  <label class="control-label mt-2" for="jrouvr"><strong>Jr_ouvr </strong></label>
                </fieldset>
                <fieldset class="col-lg-3 col-md-4 col-sm-12">
                  <select name="jrouvr" id="jrouvr" class="form-control">
                    <option value="'.$row['jr_ouvr'].'">'.$row['jr_ouvr'].'</option>
                    <option value="18">18</option>
                    <option value="21">21</option>
                    <option value="26">26</option>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-3 col-md-4 col-sm-12">
                  <label class="control-label mt-2" for="typeconge"><strong>Types de congé </strong></label>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <select name="typeconge" id="typeconge" class="form-control" required>
                    <option value="'.$row['categorie'].'">'.$row['categorie'].'</option>
                    <option value="Congé_annuel">Congé annuel</option>
                    <option value="Congé_circonstance">Congé de circonstance payé</option>
                    <option value="Congé_maladie">Congé_maladie</option>
                    <option value="Congé_non-payé">Congé_non-payé</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-2 col-md-2 col-sm-12">
                  <label class="control-label mt-2" for="natureconge"><strong>Nbre_dimanche</strong></label>
                </fieldset>
                <fieldset class="col-lg-3 col-md-3 col-sm-12">
                  <input type="text" class="form-control" name="dimnch" value="'.$row['dimanche'].'">
                </fieldset>
                <fieldset class="col-lg-3 col-md-4 col-sm-12 mt-4">
                  <label class="control-label mt-2" for="natureconge"><strong>Nature</strong></label>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12 mt-4">
                  <input type="text" name="natureconge" class="form-control" value="'.$row['nature'].'">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <div class="col-sm-2 col-md-2"></div>
                <div class="col-sm-6 col-md-6">
                  <button type="submit" name="cmd_Upconge" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Modifier</button>
                </div>
                <div class="col-sm-4 col-md-4">
                  <button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>
                </div>
              </div>';
	        }
	      }
	      else{
	        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
	              '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucune information trouvée.'.
	              '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.
	            '</div>';
	      }
	    }
	    $bd->close(); 
	  } 
	}
}
//Fin Update PerCongé

function liste_perso(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_personnel'])) {
      if (empty($_GET['fonction_pers'])) {
        $admin = $_SESSION['pseudo'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {
            $req2 = "SELECT * FROM compta_pers WHERE statut ='Actif' AND societe='$societe' ORDER BY nom_complet ASC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['nom_complet'] . '</td>' .
                  '<td class="corp-table">' . $row['compte'] . '</td>' .
                  '<td class="corp-table" style="text-align:left!important">' . $row['fonction'] . '</td>' .
                  '<td class="corp-table">' . $row['telephone'] . '</td>' .
                  '<td class="corp-table">' . $row['email'] . '</td>' .
                  '<td class="corp-table">' . $row['date_debut'] . '</td>' .
                  '<td class="corp-table">' . $row['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_pers.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                  '</tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
        }
      } else {
        //filtrage eleve par option
        $fonction_pers = $_GET['fonction_pers'];
        $params = 1;
        $admin = $_SESSION['pseudo'];
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {
            $req2 = "SELECT * FROM compta_pers WHERE fonction LIKE '%$fonction_pers%' AND statut ='Actif' AND societe='$societe' ORDER BY nom_complet ASC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['nom_complet'] . '</td>' .
                  '<td class="corp-table">' . $row['compte'] . '</td>' .
                  '<td class="corp-table">' . $row['fonction'] . '</td>' .
                  '<td class="corp-table">' . $row['telephone'] . '</td>' .
                  '<td class="corp-table">' . $row['email'] . '</td>' .
                  '<td class="corp-table">' . $row['date_debut'] . '</td>' .
                  '<td class="corp-table">' . $row['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_pers.php?statut=' . $row['statut'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                  '</tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
        }
        //filtrage eleve par option
      }
    } else {
      //filtrage eleve par classe
      $admin = $_SESSION['pseudo'];
      $nom_personnel = $_GET['nom_personnel'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) {
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) {
          $req2 = "SELECT * FROM compta_pers WHERE nom_complet LIKE '%$nom_personnel%' AND statut = 'Actif' AND societe='$societe' ORDER BY nom_complet ASC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row['nom_complet'] . '</td>' .
                '<td class="corp-table">' . $row['compte'] . '</td>' .
                '<td class="corp-table">' . $row['fonction'] . '</td>' .
                '<td class="corp-table">' . $row['telephone'] . '</td>' .
                '<td class="corp-table">' . $row['email'] . '</td>' .
                '<td class="corp-table">' . $row['date_debut'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="list_pers.php?compte=' . $row['compte'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                '</tr>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
      }
      //filtrage eleve par classe
    }
  } else {
  }
}

//fonction d'attire la liste des personnels à la BDD
function liste_personnelActif(){
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
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {
        $req2 = "SELECT * FROM compta_pers WHERE societe='$societe' AND statut ='Actif' ORDER BY nom_complet ASC ";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="' . $row['compte'] . '">' . $row['nom_complet'] . '</option>';
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

//Afficher la liste de paie dans le table compte personnel
function liste_paeifrais_pers(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_pers'])) {
        if (empty($_GET['date_doc'])) {
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
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              $req2 = "SELECT * FROM comptes_pers WHERE societe ='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">' . $row['id'] . '</td>' .
                    '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                    '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                    '<td class="corp-table">' . $row['compte_credit'] . '</td>' .
                    '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                    '<td class="corp-table">' . $row['libelle'] . '</td>' .
                    '<td class="corp-table">' . $row['montant'] . '</td>' .
                    '<td class="corp-table">' . $row['devise'] . '</td>' .
                    '<td class="corp-table">' . $row['taux'] . '</td>' .
                    '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                    '<td class="corp-table">' . $row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_pers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                    '</tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée" . '</div>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
          }
        } else {
          //filtrage eleve par option
          $date_doc = $_GET['date_doc'];
          $params = 1;
          $admin = $_SESSION['pseudo'];
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows > 0) {
            while ($row = $resultats->fetch_assoc()) {
              $code_admin = $row['code_admin'];
              $societe = $row['societe'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              $req2 = "SELECT * FROM comptes_pers WHERE date_extract LIKE '%$date_doc%' AND societe='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">' . $row['id'] . '</td>' .
                    '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                    '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                    '<td class="corp-table">' . $row['compte_credit'] . '</td>' .
                    '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                    '<td class="corp-table">' . $row['libelle'] . '</td>' .
                    '<td class="corp-table">' . $row['montant'] . '</td>' .
                    '<td class="corp-table">' . $row['devise'] . '</td>' .
                    '<td class="corp-table">' . $row['taux'] . '</td>' .
                    '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                    '<td class="corp-table">' . $row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_pers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                    '</tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
          }
          //filtrage eleve par option
        }
      } else {
        //filtrage eleve par nom
        $admin = $_SESSION['pseudo'];
        $nom_pers = $_GET['nom_pers'];
        $params = 1;
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) {
            $req2 = "SELECT * FROM comptes_pers WHERE nom_complet LIKE '%$nom_pers%' AND societe='$societe' ORDER BY id DESC";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) {
              while ($row = $res2->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row['id'] . '</td>' .
                  '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                  '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                  '<td class="corp-table">' . $row['compte_credit'] . '</td>' .
                  '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                  '<td class="corp-table">' . $row['libelle'] . '</td>' .
                  '<td class="corp-table">' . $row['montant'] . '</td>' .
                  '<td class="corp-table">' . $row['devise'] . '</td>' .
                  '<td class="corp-table">' . $row['taux'] . '</td>' .
                  '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                  '<td class="corp-table">' . $row['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_pers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                  '</tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
        }
        //filtrage eleve par nom
      }
    } else {
      //filtrage eleve par classe
      $admin = $_SESSION['pseudo'];
      $ref_doc = $_GET['ref_doc'];
      $params = 1;
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) {
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) {
          $req2 = "SELECT * FROM comptes_pers WHERE ref_doc LIKE '%$ref_doc%' AND societe='$societe' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">' . $row['id'] . '</td>' .
                '<td class="corp-table">' . $row['ref_doc'] . '</td>' .
                '<td class="corp-table">' . $row['compte_debit'] . '</td>' .
                '<td class="corp-table">' . $row['compte_credit'] . '</td>' .
                '<td class="corp-table">' . $row['nature_operation'] . '</td>' .
                '<td class="corp-table">' . $row['libelle'] . '</td>' .
                '<td class="corp-table">' . $row['montant'] . '</td>' .
                '<td class="corp-table">' . $row['devise'] . '</td>' .
                '<td class="corp-table">' . $row['taux'] . '</td>' .
                '<td class="corp-table">' . $row['date_extract'] . '</td>' .
                '<td class="corp-table">' . $row['statut'] . '</td>' .
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_pers.php?ref_doc=' . $row['ref_doc'] . '" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
                '</tr>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
        }
      } else {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
      }
      //filtrage eleve par classe
    }
  } else {
  }
}

//Afficher la liste Compte Autre
function liste_extrait_person(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $codesoc = $row['code_soc'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['compte_pers'])) {
            if (empty($_GET['nom_complet'])) {
              $req1 = "SELECT * FROM compta_pers WHERE statut='Actif' AND societe='$societe' ORDER BY nom_complet ASC";
              $res1 = $bd->query($req1);

              if ($res1->num_rows > 0) {
                while ($row1 = $res1->fetch_assoc()) {

                  echo'<tr>'.
                        '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">'.$row1['nom_complet'].'</td>'.
                        '<td class="corp-table">'.$row1['compte'].'</td>'.
                        '<td class="corp-table">'.$row1['statut'].'</td>'.
                        '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="liste_compte_pers.php?compte='.$row1['compte'].'&&noms='.$row1['nom_complet'].'" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                      '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            } else {
              $nom_complet = $_GET['nom_complet'];
              $req2 = "SELECT * FROM compta_pers WHERE nom_complet LIKE '%$nom_complet%' AND societe='$societe' AND statut='Actif'";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_assoc()) {

                  echo'<tr>'.
                        '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">' . $row1['nom_complet'] . '</td>' .
                        '<td class="corp-table">' . $row1['compte'] . '</td>' .
                        '<td class="corp-table">' . $row1['statut'] . '</td>' .
                        '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_pers.php?compte=' . $row1['compte'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                      '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            }
          } else {
            $comptes_person = $_GET['comptes_person'];
            $req3 = "SELECT * FROM compta_pers WHERE compte LIKE '%$comptes_person%' AND societe='$societe' AND statut='Actif'";
            $res3 = $bd->query($req3);

            if ($res3->num_rows > 0) {
              while ($row3 = $res3->fetch_assoc()) {

                echo'<tr>'.
                      '<td class="corp-table" style="text-transform:uppercase!important;text-align:left!important">'.$row1['nom_complet'].'</td>' .
                      '<td class="corp-table">'.$row1['compte'].'</td>' .
                      '<td class="corp-table">'.$row1['statut'].'</td>' .
                      '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="liste_compte_pers.php?compte=' . $row1['compte'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
              }
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
            }
          }
        } else { // verification de droit administratif
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Violation de droit administratif." . '</div>';
        }
      } else { // verification du compte administratif
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      }
    } //fin de base de données
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
}

//Afficher le bouiton d'extrait compte eleve
function extrait_compte_personl(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])&&empty($_GET['noms'])) {
        echo '';
      } else {
        $compte = $_GET['compte'];
        $nomcomplet = $_GET['noms'];
        $req = "SELECT * FROM compta_pers WHERE compte ='$compte' AND nom_complet='$nomcomplet'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $num_compte = $row['compte'];
            $nom_compte = $row['nom_complet'];

            echo '<a href="../78954RPOTYHUYG/extrait_pers.php?compte='.$num_compte.'&&noms='.$nom_compte.'" class="btn btn-warning" target="_blank">'.'Extrait de compte'.'</a>';
          }
        } else {
          echo '';
        }
      }
    }
  } else {
    echo '';
  }
}

//Afficher le recouvrement personnel_USD
function Etat_recvremntpersousd(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          
            //$mois_frais = $_GET['mois_frais'];

            $req2 = "SELECT * FROM compta_pers WHERE societe='$societe' ORDER BY nom_complet ASC";
            $sql2 = $bd->query($req2);

            if ($sql2->num_rows > 0) {
              while ($row2 = $sql2->fetch_assoc()) {
                $nom_perso = $row2['nom_complet'];
                $compte_perso = $row2['compte'];
                $fonction = $row2['fonction'];
                $debitUSD = $row2['debit_usd'];
                $CreditUSD = $row2['Credit_usd'];
                $soldeUSD = $row2['solde1_usd'];

                //Calculer du solde
                $Sglobal = ($soldeUSD + $debitUSD) - $CreditUSD;

                echo '<tr>' .
                  '<td style="text-transform:uppercase!important;border: 1px solid #000;text-align:left!important">'.$nom_perso.'</td>' .
                  '<td style="border: 1px solid #000">'.$compte_perso.'</td>' .
                  '<td style="border: 1px solid #000">'.$fonction.'</td>' .
                  '<td style="text-align:right;border: 1px solid #000">'. $soldeUSD.'</td>' .
                  '<td style="text-align:right;border: 1px solid #000">'.$CreditUSD.'</td>' .
                  '<td style="text-align:right;border: 1px solid #000">' . $debitUSD . '</td>' .
                  '<td style="text-align:right;border: 1px solid #000">'.$Sglobal.'</td>' .
                  '</tr>';
              }
            } else { //
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée." . '</div>';
            }
          
        } 
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'accès." . '</div>';
        } // verification de droit administratif
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      } // verification du compte administratif
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} //fin fonction impression recouvrement

//Afficher le recouvrement personnel_CDF
function Etat_recvremntpersoCDF(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif

          //$mois_frais = $_GET['mois_frais'];

          $req2 = "SELECT * FROM compta_pers WHERE societe='$societe' ORDER BY nom_complet ASC";
          $sql2 = $bd->query($req2);

          if ($sql2->num_rows > 0) {
            while ($row2 = $sql2->fetch_assoc()) {
              $nom_perso = $row2['nom_complet'];
              $compte_perso = $row2['compte'];
              $fonction = $row2['fonction'];
              $debitCDF = $row2['debit_cdf'];
              $CreditCDF = $row2['Credit_cdf'];
              $soldeCDF = $row2['solde1_cdf'];

              //Calculer du solde
              $SglobalCDF = ($soldeCDF + $debitCDF) - $CreditCDF;

              echo'<tr>' .
                '<td style="text-transform:uppercase!important;border: 1px solid #000;text-align:left!important">'.$nom_perso.'</td>'.
                '<td style="border: 1px solid #000">'.$compte_perso.'</td>'.
                '<td style="border: 1px solid #000">'.$fonction.'</td>'.
                '<td style="text-align:right;border: 1px solid #000">'.$soldeCDF.'</td>'.
                '<td style="text-align:right;border: 1px solid #000">'.$CreditCDF.'</td>'.
                '<td style="text-align:right;border: 1px solid #000">'.$debitCDF.'</td>'.
                '<td style="text-align:right;border: 1px solid #000">'.$SglobalCDF.'</td>'.
                '</tr>';
            }
          } else { //
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée." . '</div>';
          }
        } else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'accès." . '</div>';
        } // verification de droit administratif
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      } // verification du compte administratif
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} //fin fonction impression recouvrement