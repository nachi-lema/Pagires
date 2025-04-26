<?php  

//Affichage listes fiche paie
function liste_fichpay(){
  	if (isset($_SESSION['pseudo'])) {
    	include("connexion.php");
    	if (empty($_GET['nom_agent'])) {
      	if (empty($_GET['periode'])) {
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
	            		$req2 = "SELECT * FROM persalemens1_tb WHERE societe = '$societe' AND statut ='en cours' ORDER BY nom_complet ASC";
	            		$res2 = $bd ->query($req2);

	            		if ($res2 ->num_rows > 0) {
	              			while($row = $res2 ->fetch_assoc()){
	                			echo'<tr>'.
                              '<td>'.$row['id'].'</td>'.
                              '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  		  '<td>'.$row['num_compte'].'</td>'.
	                    				'<td>'.$row['departement'].'</td>'.
			                  		  '<td>'.$row['fonction'].'</td>'.
			                  		  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="fichpay.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	            		$req2 = "SELECT * FROM persalemens1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          		$res2 = $bd ->query($req2);

		          		if ($res2 ->num_rows > 0) {
		           			while($row = $res2 ->fetch_assoc()){
		              			echo'<tr>'.
			                			'<td>'.$row['id'].'</td>'.
			                  		'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  		'<td>'.$row['num_compte'].'</td>'.
	                    				'<td>'.$row['departement'].'</td>'.
			                  		'<td>'.$row['fonction'].'</td>'.
			                  		'<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="fichpay.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
            //filtrage Agent par periode
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
			                     '<td>'.$row['id'].'</td>'.
			                  	'<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  	'<td>'.$row['num_compte'].'</td>'.
	                    			'<td>'.$row['departement'].'</td>'.
			                  	'<td>'.$row['fonction'].'</td>'.
			                  	'<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="fichpay.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	         //filtrage Agent par periode
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
	          	$req2 = "SELECT * FROM persalemens1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         $res2 = $bd ->query($req2);

		         if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		               echo'<tr>'.
			                  '<td>'.$row['id'].'</td>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                    		'<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="fichpay.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
//Fin Affichage listes fiche paie

//Compteur Fiche paie
function compteur_fichpay(){
   if (isset($_SESSION['pseudo'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
         die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{// fin base de données
         if (empty($_GET['codepaie'])) {
            $req = "SELECT * FROM persalemens1_tb WHERE customer = '".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($req);
            $nbr = mysqli_num_rows($resultats);
            
            if ($nbr > 1) {
               echo '<h4 class="compteur_admin">'.'<i class=""></i>'.'&nbsp;'.''.'</h4>';
            }
            else{
               echo '<h4 class="compteur_admin">'.'<i class=""></i>'.'&nbsp;'.''.'</h4>';
            }
         }
         else{
            $comptes_agent = $_GET['codepaie'];
            $req = "SELECT * FROM persalemens1_tb WHERE statut ='en cours' AND codepaie ='$comptes_agent'";
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
//Fin Compteur Fiche paie

//Afficher le bouton d'impression d'un recu
function link_codepaie(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['codepaie'])) {
        echo '';
      }
      else{
	      $codepaie = $_GET['codepaie'];
	      $req = "SELECT * FROM persalemens1_tb WHERE statut ='en cours' AND codepaie = '$codepaie'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $num_reference= $row['codepaie'];
	          echo '<a href="fichepaie.php?codepaie='.$num_reference.'" target="_blank" class="btn btn-success"><i class=""></i> Fiche de paie</a>'; 
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

//Fiche de paie
function fichepaie(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $d_id=date("d-m-y");
      $h_id=date("h:i:s");
      $dat=$d_id." ".$h_id;
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $resultats = $bd ->query($requete);

      if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
	        if (empty($_GET['codepaie'])) {
	          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
	        }
	        else{
	          $ref_codepaie = $_GET['codepaie'];
	          $req = "SELECT * FROM persalemens1_tb WHERE societe = '$societe' AND codepaie = '$ref_codepaie' AND statut = '$statut_fin'";
						$resultats = $bd ->query($req);

						if ($resultats ->num_rows > 0) {
							while($row = $resultats ->fetch_assoc()){
								$ref_codepaie = $row['codepaie'];
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
							  $nom_complet = $row['nom_complet'];
							  $num_compte  = $row['num_compte'];
							  $taux        = $row['taux'];
							  $jourpres    = $row['jpres'];
							  $jourmal     = $row['jrMal'];
							  $jrcirco     = $row['jcirc'];
							  $jrconge     = $row['jcan'];
							  $salbasej    = $row['salbasej'];
							  $transj      = $row['transj'];
							  $annee       = $row['anpay'];
                $regular = $row['regular'];
                $nbrEnft = $row['nbre_enfant'];
							}
              //Calcul jour
              $SalmalT  = $jourmal*$salbasej*0.67;
              $SalcircT = $jrcirco* $salbasej*0.67;

              $TnbrEnft = $alfam* $nbrEnft;
              $TnbrEnftCDF = $TnbrEnft*$taux;

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

              // $Tauxjrcon = $salconge/$jrconge;
              // $salcongFC = $Tauxjrcon * $taux;
              $TregularFC = $regular * $taux;

							//recuperation information eleve
							$req2 = "SELECT * FROM persalemens2_tb WHERE societe = '$societe' AND codepaie = '$ref_codepaie' AND statut ='en cours'";
							$res2 = $bd ->query($req2);

							if ($res2 ->num_rows > 0) {
								while ($row2 = $res2 ->fetch_assoc()) {
									$tot_reten = $row2['tot_reten'];
									$baseimpos = $row2['baseImp_cdf'];
									$ipttot = $row2['iprtot_cdf'];
									$cnss = $row2['cnss_QPO'];
									$advance = $row2['tot_advanc'];
									$Netapayer= $row2['netp_cdf'];
								}
								//Convertir le monnaie
								$CNSS          = $cnss * $taux;
								$Avances_prets = $advance * $taux;
								$Retenue       = $tot_reten * $taux;
                

								$req2x = "SELECT * FROM peragent_tb WHERE societe = '$societe' AND compte ='$num_compte' AND statut='Actif'";
								$res2x = $bd ->query($req2x);

								if ($res2x ->num_rows > 0) {
									while ($row2x = $res2x ->fetch_assoc()) {
										$num_compte  = $row2x['compte'];
										$matricule   = $row2x['matricule'];
										$numero_cnss = $row2x['no_cnss'];
										$fonction    = $row2x['fonction'];
										$departmnt   = $row2x['departement'];
										$categ       = $row2x['categorie'];
										//$locat       = $row2x['site'];
									}
									//Totaux
                  $Totalbrut = $salaireb + $Transport + $Allogmnt + $TregularFC + $SalmalT + $SalcircT;
									//$rang1 = $salaireb+$salaireM+$salaireCir+$salaireCo;
									//$rang2 = $Allogmnt+$Transport+$Allocat;
									$rang3 = $CNSS+$ipttot+$Avances_prets;
                  $Netpaye = $Totalbrut - $rang3;


									echo'<div class="col-12">
			                  <h6 style="padding: 0px;font-size:16px">'.$societe.'</h6>
			                  <p style="text-align: left;font-weight: bold;padding-left:100px;font-size:19px">BULLETIN DE PAIE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                  	<span style="font-size:14px">PERIODE : '.$periode.' - '.$annee.'</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                  </p>

			                  <div class="row">
				                  <table class="table table-bordered">
				                    <thead>
				                      <th></th>
				                      <th></th>
				                      <th></th>
				                      <th></th>
				                    </thead>
				                    <tbody style="color:black">
				                      <tr style="border-right:2px solid #000;border-left:2px solid #000;border-top:2px solid #000">
				                        <td class="corp-table" style="font-size:14px">NOMS </td>
				                        <td class="corp-table" colspan="2" style="font-size:14px">: '.$nom_complet.'</td>
				                      </tr>
				                      <tr style="border-bottom:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
				                        <td class="corp-table" style="font-size:14px">FONCTION </td>
				                        <td class="corp-table" colspan="2" style="font-size:14px">: '.$fonction. ' &nbsp&nbsp&nbsp</td>
                                <td class="corp-table" colspan="2" style="font-size:14px">MATRICULE : ' . $matricule . '</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" colspan="4" style="padding:10px"> </td>
				                      </tr>
				                      <tr style="border:2px solid #000">
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000">Libelle </td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000;border-right:2px solid #000;text-align:center;">Jour</td>
                                <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:center;border-left:2px solid #000;border-right:2px solid #000">Taux</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right;border-right:2px solid #000;text-align:center;">Montant</td>
				                      </tr>
                              <tr style="border-right:2px solid #000;border-left:2px solid #000">
                                <td style="font-weight:bold;text-align:left">A PAYER</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
                                <td style="border-right:2px solid #000;border-left:2px solid #000">&nbsp;&nbsp;</td>
                                <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                                <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
                              </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Salaire journalier &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
                                <td class="corp-table" style="font-size:14px;bold;border-left:2px solid #000;border-right:2px solid #000;text-align:right">' . $jourpres . '</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000;">'.number_format($salbasejFC,2).'</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.$salaireb. '</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Salaire Jours_maladie &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:14px;bold;border-left:2px solid #000;border-right:2px solid #000;text-align:right">'.$jourmal. '</td>
                                <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000;">'.$salmal.'</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.$SalmalT. '</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Salaire Jours_circonstance &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:14px;bold;border-left:2px solid #000;text-align:right">'.$jrcirco.'</td>
                                <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000;">'.$salcirc.'</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.$SalcircT. '</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Allocations familiales &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000">'.$nbrEnft.'</td>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000;text-align:right;border-right:2px solid #000">'.number_format($Allocat,2).'</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.$TnbrEnftCDF. '</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Indem.ancienneté &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000">0</td>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000;text-align:right;border-right:2px solid #000">0</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">0</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Indemnités_logement &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000;text-align:center;border-right:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.number_format($Allogmnt,2). '</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Indemnités_transport &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
                                <td class="corp-table" style="font-size:14px;border-left:2px solid #000;text-align:right;border-right:2px solid #000">' . $jourpres . '</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000;border-right:2px solid #000">'.$Ttransj.'</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.$Transport. '</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000">Regularisation &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:14px;border-left:2px solid #000;border-right:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:14px;text-align:right;border-right:2px solid #000">'.number_format($TregularFC,2).'</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" colspan="6" style="font-size:14px;border:2px solid #000;font-weight:900">Total brut &nbsp;&nbsp;&nbsp;&nbsp;</td>				                        
				                        <td class="corp-table" style="font-size:15px;text-align:right;border:2px solid #000;font-weight:bold">'.number_format($Totalbrut,2). '</td>
				                      </tr>

                              <tr style="border-right:2px solid #000;border-left:2px solid #000">
                                <td colspan="7" style="font-weight:bold;text-align:center; border: 2px #000 solid;">A RETENIR</td>
                              </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">IPR &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($ipttot,2). '</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Cnss &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">' . number_format($CNSS, 2) . '</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Autres retenues &nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000;border-right:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($Avances_prets,2).'</td>
				                      </tr>
                              <tr>
				                        <td class="corp-table" colspan="6" style="font-size:16px;border:2px solid #000;font-weight:900">Total retenues &nbsp;&nbsp;&nbsp;&nbsp;</td>				                        
				                        <td class="corp-table" style="font-size:17px;text-align:right;border:2px solid #000;font-weight:bold">'.number_format($rang3,2). '</td>
				                      </tr>

				                      <tr style="border:2px solid #000">
				                        <td class="corp-table" colspan="3" style="font-size:16px;font-weight:bold;padding:11px">NET A PAYER_CDF </td>
                                <td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td><td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:17px;font-weight:bold;text-align:right">'.number_format($Netpaye,2).'</td>
				                      </tr>
				                    </tbody>
				                 	</table>
			                  </div><br>
			                </div>';
								}
								else{
									//verifier le parampetre agent
								}								
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
//Fin fiche de paie

//Fiche de paie
function fichepaie2(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      $admin = $_SESSION['pseudo'];
      $d_id=date("d-m-y");
      $h_id=date("h:i:s");
      $dat=$d_id." ".$h_id;
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      $resultats = $bd ->query($requete);

      if ($resultats ->num_rows > 0) {// verification du compte administratif
        while($row = $resultats ->fetch_assoc()){
          $code_admin = $row['code_admin'];
          $societe = $row['societe'];    
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
	        if (empty($_GET['codepaie'])) {
	          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
	        }
	        else{
	          $ref_codepaie = $_GET['codepaie'];
	          $req = "SELECT * FROM persalemens1_tb WHERE societe = '$societe' AND codepaie = '$ref_codepaie' AND statut = '$statut_fin'";
						$resultats = $bd ->query($req);

						if ($resultats ->num_rows > 0) {
							while($row = $resultats ->fetch_assoc()){
								$ref_codepaie = $row['codepaie'];
							  $salbase = $row['salbase'];
							  $salmal = $row['salmal'];
							  $salcirc = $row['salcirc'];
							  $salconge = $row['salconge'];
							  $logmt = $row['logmt'];
							  $transp = $row['transp'];
							  $alfam = $row['alfam'];
							  $primtot = $row['primtot'];
							  $indiv = $row['inddiv'];
							  $brutot2 = $row['brutot2'];
							  $periode = $row['menspay'];
							  $nom_complet = $row['nom_complet'];
							  $num_compte = $row['num_compte'];
							  $taux = $row['taux'];
							  $jourpres = $row['jpres'];
							  $jourmal = $row['jrMal'];
							  $jrcirco = $row['jcirc'];
							  $jrconge = $row['jcan'];
							  $taux = $row['taux'];
							  $salbasej = $row['salbasej'];
							  $transj = $row['transj'];
							  $annee = $row['anpay'];
							}
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

							//recuperation information Agent
							$req2 = "SELECT * FROM persalemens2_tb WHERE societe = '$societe' AND codepaie = '$ref_codepaie' AND statut = 'en cours'";
							$res2 = $bd ->query($req2);

							if ($res2 ->num_rows > 0) {
								while ($row2 = $res2 ->fetch_assoc()) {
									$tot_reten = $row2['tot_reten'];
									$baseimpos = $row2['baseImp_cdf'];
									$ipttot = $row2['iprtot_cdf'];
									$cnss = $row2['cnss_QPO'];
									$advance = $row2['tot_advanc'];
									$Netapayer= $row2['netp_cdf'];
								}
								//Convertir le monnaie
								$CNSS          = $cnss * $taux;
								$Avances_prets = $advance * $taux;
								$Retenue       = $tot_reten * $taux;

								$req2x = "SELECT * FROM peragent_tb WHERE societe = '$societe' AND compte ='$num_compte' AND statut='Actif'";
								$res2x = $bd ->query($req2x);

								if ($res2x ->num_rows > 0) {
									while ($row2x = $res2x ->fetch_assoc()) {
										$num_compte = $row2x['compte'];
										$matricule = $row2x['matricule'];
										$numero_cnss = $row2x['no_cnss'];
										$fonction = $row2x['fonction'];
										$departmnt = $row2x['departement'];
										$categ = $row2x['categorie'];
									}
									//Totaux
									$priminddiv = $Indemnites+$Primes;

									$rang1 = $salaireb+$salaireM+$salaireCir+$salaireCo;
									$rang2 = $Allogmnt+$Transport+$Allocat+$priminddiv;
									$rang3 = $CNSS+$ipttot+$Avances_prets;

									echo'<div class="col-12">
			                  <h6 style="padding: 0px;font-size:16px">'.$societe.'</h6>
			                  <p style="text-align: left;font-weight: bold;padding-left:100px;font-size:23px">BULLETIN DE PAIE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                  	<span style="font-size:14px">PERIODE : '.$periode.' - '.$annee.'</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                  	<span style="font-size:14px"> '.$d_id.' </span>
			                  </p>

			                  <div class="row">
				                  <table>
				                    <thead>
				                      <th></th>
				                      <th></th>
				                      <th></th>
				                      <th></th>
				                      <th></th>
				                    </thead>
				                    <tbody>
				                      <tr style="border-top:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
				                        <td class="corp-table" style="font-size:16px">NOMS </td>
				                        <td class="corp-table" style="font-size:16px">: '.$nom_complet.'</td>
				                        <td>&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">MATRICULE </td>
				                        <td class="corp-table" style="font-size:16px">: '.$matricule.'</td>
				                        <td>&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">CATEG </td>
				                        <td class="corp-table" style="font-size:16px">: '.$categ.'</td>
				                      </tr>
				                      <tr style="border-bottom:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
				                        <td class="corp-table" style="font-size:16px">FONCTION </td>
				                        <td class="corp-table" style="font-size:16px">: '.$fonction.'</td>
				                        <td>&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">DEPARTEMENT </td>
				                        <td class="corp-table" style="font-size:16px">: '.$departmnt.'</td>
				                        <td>&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">CNSS No </td>
				                        <td class="corp-table" style="font-size:16px">: '.$numero_cnss.'</td>
				                      </tr>
				                      <tr style="border-top:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
				                        <td class="corp-table" style="font-size:16px">Jr-prest : '.$jourpres.'</td>
				                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">Jrs-Mal : '.$jourmal.'</td>
				                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">Jrs-Circ : '.$jrcirco.'</td>
				                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">Jrs-cong : '.$jrconge.'</td>
				                      </tr>
				                      <tr style="border-bottom:2px solid #000;border-right:2px solid #000;border-left:2px solid #000">
				                        <td class="corp-table" style="font-size:16px">Sal-journ : '.$salbasej.'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">Transp journ : '.$transj.'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px">USD/CDF </td>
				                      </tr>
				                      <tr style="border:2px solid #000">
				                        <td class="corp-table" style="font-size:16px">A PAYER </td>
				                        <td class="corp-table" style="font-size:16px"></td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px"></td>
				                        <td class="corp-table" style="font-size:16px"></td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">A RETENIR</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000">Libelle </td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">Montant</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000">Libelle</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">Montant</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000">Libelle</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right;border-right:2px solid #000">Montant</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Salaire de base &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($salaireb,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Indem.logement &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($Allogmnt,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Cnss &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($CNSS,2).'</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Sal.maladie &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($salaireM,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Indem.transport &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($Transport,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Impot &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($ipttot,2).'</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Sal.circonstance &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($salaireCir,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Alfam &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($Allocat,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Avances/prêts &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000">'.number_format($Avances_prets,2).'</td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Sal.jrs feries &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right"></td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Primes &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($priminddiv,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16x;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000"></td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Sal.conge &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right">'.number_format($salaireCo,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right"></td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000"></td>
				                      </tr>
				                      <tr>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000">Anciennete &nbsp;&nbsp;&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;text-align:right"></td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right"></td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;text-align:right;border-right:2px solid #000"></td>
				                      </tr>
				                      <tr style="border:2px solid #000">
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;">Totaux </td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($rang1,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($rang2,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000"></td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($rang3,2).'</td>
				                      </tr>
				                      <tr style="border:2px solid #000">
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;">Brut total </td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($TotalB,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;border-left:2px solid #000;">Base imposable</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($baseimpos,2).'</td>
				                        <td style="border-right:2px solid #000">&nbsp;&nbsp;</td>
				                      </tr>
				                      <tr style="border:2px solid #000">
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;">Salaire net </td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;text-align:right">'.number_format($Netapayer,2).'</td>
				                        <td>&nbsp;&nbsp;</td>
				                        <td class="corp-table" style="font-size:16px;font-weight:bold;">'.$nom_complet.'  </td>
				                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				                      </tr>
				                    </tbody>
				                 	</table>
			                  </div><br>
			                </div>';
								}
								else{
									//verifier le parampetre agent
								}								
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
//Fin fiche de paie

//fonction d'attire la liste personnel à la BDD
function liste_annee(){
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
	      $req2 = "SELECT * FROM annee_tab WHERE statut ='Actif'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	          echo '<option value="'.$row['mois_fr'].'-'.$row['annee'].'">'.$row['mois_fr'].'</option>';
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

//impression recaptot
function classe_recaptot(){
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
	         $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	         $res1 = $bd ->query($req1);

	         if ($res1 ->num_rows > 0) {// verification de droit administratif
	            if (empty($_GET['periode'])) {
		            echo '';
		         }	
	            else{// recherche par classe eleve
	               $periode = $_GET['periode'];
	               echo $periode;
	            }// recherche par classe eleve
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
}//fin fonction recapto

//Afficher le nom d'entreprise
function affiche_societe_recapto(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{
      $compte = $_SESSION['pseudo'];
      $check = "SELECT * FROM admin_tb WHERE pseudo ='$compte'";
      $res = $bd ->query($check);

      if ($res ->num_rows > 0) {
        while($row = $res ->fetch_assoc()){
          $nom_user = $row['pseudo'];
          $societe = $row['societe'];                    
        }
        //Affichage des contenus
        $check2 = "SELECT * FROM admin_tb WHERE societe ='$societe' AND pseudo ='$nom_user'";
        $res2 = $bd ->query($check2);

        if ($res2 ->num_rows > 0) {
          while($row2 = $res2 ->fetch_assoc()){
            echo'<b>'.$row2['societe'].'</b>';                     
          }  
        }
        else{
                    
        }
        //fin affichage des contenus eleve   
      }
      else{
        echo '<h2 class="title-suspens">'.'?'.'</h2>'.'<strong>'.'Compte invalide'.'</strong>';
      }
    }
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="erreur">'."connexion perdue".'</div>';
  }
}
//fin Afficher le nom d'entreprise

//impression recapitulative
function Etat_recoptot(){
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
          $societe    = $row['societe'];   
        }
	      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	      $res1 = $bd ->query($req1);

	      if ($res1 ->num_rows > 0) {// verification de droit administratif
	        if (empty($_GET['periode'])) {
		        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Violation d'un parametre.".'</div>';
		      }	
	        else{// recherche par classe eleve
	          $periode = $_GET['periode'];

	          $req2 = "SELECT * FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
	          $sql2 = $bd ->query($req2);

	          if ($sql2 ->num_rows > 0) {
	            while($row2 = $sql2 ->fetch_assoc()){
			          $salbase     = $row2['salbase'];
			          $taux        = $row2['taux'];
			          $salmal      = $row2['salmal'];
			          $salcirc     = $row2['salcirc'];
			          $salconge    = $row2['salconge'];
			          $logmt       = $row2['logmt'];
			          $transp      = $row2['transp'];
			          $alfam       = $row2['alfam'];
			          $inddiv      = $row2['inddiv'];
			          $primtot     = $row2['primtot'];
			          $brutot2     = $row2['brutot2'];
			          $baseImp_usd = $row2['baseImp_usd'];
			          $cnss_QPO	   = $row2['cnss_QPO'];
			          $iprtot_usd  = $row2['iprtot_usd'];
			          $tot_reten   = $row2['tot_reten'];
			          $netp_usd    = $row2['netp_usd'];
			          $tot_advanc  = $row2['tot_advanc'];
			          $ier_QPP     = $row2['ier_QPP'];
			          $cnss_QPP    = $row2['cnss_QPP'];
			          $inpp_QPP    = $row2['inpp_QPP'];
			          $onem_QPP    = $row2['onem_QPP'];
			          $qpp_tot     = $row2['qpp_tot'];
			          $fisctot     = $row2['fisctot'];
			          $staffnet    = $row2['staffnet'];
	            }
	            $req4 = "SELECT sum(salbase) AS total_salbase_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      $res4 = $bd ->query($req4);

				      if ($res4 ->num_rows > 0 ) {
					      while($row = $res4 ->fetch_assoc()){
					      	$tot_salbase = $row['total_salbase_usd'];
					      	$tot_salbase1 = number_format($row['total_salbase_usd'],2);
					      }
					      $tot_salbase_cdf = $tot_salbase * $taux;
					   	}
					   	$req4x = "SELECT sum(salmal) AS total_salmal_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      $res4x = $bd ->query($req4x);

				      	if ($res4x ->num_rows > 0 ) {
					      	while($row = $res4x ->fetch_assoc()){
					      		$tot_salmal = $row['total_salmal_usd'];
					      		$tot_salmal1 = number_format($row['total_salmal_usd'],2);
					      	}
					      	$tot_salmal_cdf = $tot_salmal * $taux;
					   	}
					   	$req4x1 = "SELECT sum(salcirc) AS total_salcirc_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x1 = $bd ->query($req4x1);

				      	if ($res4x1 ->num_rows > 0 ) {
					      	while($row = $res4x1 ->fetch_assoc()){
					      		$tot_salcirc = $row['total_salcirc_usd'];
					      		$tot_salcirc1 = number_format($row['total_salcirc_usd'],2);
					      	}
					      	$tot_salcirc_cdf = $tot_salcirc * $taux;
					   	}
					   	$req4x2 = "SELECT sum(salconge) AS total_salconge_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x2 = $bd ->query($req4x2);

				      	if ($res4x2 ->num_rows > 0 ) {
					      	while($row = $res4x2 ->fetch_assoc()){
					      		$tot_salconge = $row['total_salconge_usd'];
					      		$tot_salconge1 = number_format($row['total_salconge_usd'],2);
					      	}
					      	$tot_salconge_cdf = $tot_salconge * $taux;
					   	}
					   	$req4x3 = "SELECT sum(logmt) AS total_logmt_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x3 = $bd ->query($req4x3);

				      	if ($res4x3 ->num_rows > 0 ) {
					      	while($row = $res4x3 ->fetch_assoc()){
					      		$tot_logmt = $row['total_logmt_usd'];
					      		$tot_logmt1 = number_format($row['total_logmt_usd'],2);
					      	}
					      	$tot_logmt_cdf = $tot_logmt * $taux;
					   	}
					   	$req4x4 = "SELECT sum(transp) AS total_transp_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x4 = $bd ->query($req4x4);

				      	if ($res4x4 ->num_rows > 0 ) {
					      	while($row = $res4x4 ->fetch_assoc()){
					      		$tot_transp = $row['total_transp_usd'];
					      		$tot_transp1 = number_format($row['total_transp_usd'],2);
					      	}
					      	$tot_transp_cdf = $tot_transp * $taux;
					   	}
					   	$req4x5 = "SELECT sum(alfam) AS total_alfam_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x5 = $bd ->query($req4x5);

				      	if ($res4x5 ->num_rows > 0 ) {
					      	while($row = $res4x5 ->fetch_assoc()){
					      		$tot_alfam = $row['total_alfam_usd'];
					      		$tot_alfam1 = number_format($row['total_alfam_usd'],2);
					      	}
					      	$tot_alfam_cdf = $tot_alfam * $taux;
					   	}
					   	$req4x6 = "SELECT sum(inddiv) AS total_inddiv_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x6 = $bd ->query($req4x6);

				      	if ($res4x6 ->num_rows > 0 ) {
					      	while($row = $res4x6 ->fetch_assoc()){
					      		$tot_inddiv = $row['total_inddiv_usd'];
					      		$tot_inddiv1 = number_format($row['total_inddiv_usd'],2);
					      	}
					      	$tot_inddiv_cdf = $tot_inddiv * $taux;
					   	}
					   	$req4x7 = "SELECT sum(primtot) AS total_primtot_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x7 = $bd ->query($req4x7);

				      	if ($res4x7 ->num_rows > 0 ) {
					      	while($row = $res4x7 ->fetch_assoc()){
					      		$tot_primtot = $row['total_primtot_usd'];
					      		$tot_primtot1 = number_format($row['total_primtot_usd'],2);
					      	}
					      	$tot_primtot_cdf = $tot_primtot * $taux;
					   	}
					   	$req4x8 = "SELECT sum(brutot2) AS total_brutot2_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x8 = $bd ->query($req4x8);

				      	if ($res4x8 ->num_rows > 0 ) {
					      	while($row = $res4x8 ->fetch_assoc()){
					      		$tot_brutot2 = $row['total_brutot2_usd'];
					      		$tot_brutot21 = number_format($row['total_brutot2_usd'],2);
					      	}
					      	$tot_brutot2_cdf = $tot_brutot2 * $taux;
					   	}
					   	$req4x9 = "SELECT sum(baseImp_usd) AS total_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x9 = $bd ->query($req4x9);

				      	if ($res4x9 ->num_rows > 0 ) {
					      	while($row = $res4x9 ->fetch_assoc()){
					      		$tot_baseImp_usd = $row['total_baseImp_usd'];
					      		$tot_baseImp_usd1 = number_format($row['total_baseImp_usd'],2);
					      	}
					      	$tot_baseImp_cdf = $tot_baseImp_usd * $taux;
					   	}
					   	$req4x10 = "SELECT sum(cnss_QPO) AS total_cnss_QPO_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x10 = $bd ->query($req4x10);

				      	if ($res4x10 ->num_rows > 0 ) {
					      	while($row = $res4x10 ->fetch_assoc()){
					      		$tot_cnss_QPO_usd = $row['total_cnss_QPO_usd'];
					      		$tot_cnss_QPO_usd1 = number_format($row['total_cnss_QPO_usd'],2);
					      	}
					      	$tot_cnss_QPO_cdf = $tot_cnss_QPO_usd * $taux;
					   	}
					   	$req4x11 = "SELECT sum(iprtot_usd) AS total_iprtot_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x11 = $bd ->query($req4x11);

				      	if ($res4x11 ->num_rows > 0 ) {
					      	while($row = $res4x11 ->fetch_assoc()){
					      		$tot_iprtot_usd = $row['total_iprtot_usd'];
					      		$tot_iprtot_usd1 = number_format($row['total_iprtot_usd'],2);
					      	}
					      	$tot_iprtot_cdf = $tot_iprtot_usd * $taux;
					   	}
					   	$req4x12 = "SELECT sum(tot_reten) AS tot_reten_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x12 = $bd ->query($req4x12);

				      	if ($res4x12 ->num_rows > 0 ) {
					      	while($row = $res4x12 ->fetch_assoc()){
					      		$tot_reten_usd = $row['tot_reten_usd'];
					      		$tot_reten_usd1 = number_format($row['tot_reten_usd'],2);
					      	}
					      	$tot_reten_cdf = $tot_reten_usd * $taux;
					   	}
					   	$req4x13 = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x13 = $bd ->query($req4x13);

				      	if ($res4x13 ->num_rows > 0 ) {
					      	while($row = $res4x13 ->fetch_assoc()){
					      		$tot_netp_usd = $row['tot_netp_usd'];
					      		$tot_netp_usd1 = number_format($row['tot_netp_usd'],2);
					      	}
					      	$tot_netp_cdf = $tot_netp_usd * $taux;
					   	}
					   	$req4x14 = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x14 = $bd ->query($req4x14);

				      	if ($res4x14 ->num_rows > 0 ) {
					      	while($row = $res4x14 ->fetch_assoc()){
					      		$tot_advanc_usd = $row['tot_advanc_usd'];
					      		$tot_advanc_usd1 = number_format($row['tot_advanc_usd'],2);
					      	}
					      	$tot_advanc_cdf = $tot_advanc_usd * $taux;
					   	}
					   	$req4x15 = "SELECT sum(ier_QPP) AS tot_ier_QPP_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x15 = $bd ->query($req4x15);

				      	if ($res4x15 ->num_rows > 0 ) {
					      	while($row = $res4x15 ->fetch_assoc()){
					      		$tot_ier_QPP_usd = $row['tot_ier_QPP_usd'];
					      		$tot_ier_QPP_usd1 = number_format($row['tot_ier_QPP_usd'],2);
					      	}
					      	$tot_ier_QPP_cdf = $tot_ier_QPP_usd * $taux;
					   	}
					   	$req4x16 = "SELECT sum(cnss_QPP) AS tot_cnss_QPP_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x16 = $bd ->query($req4x16);

				      	if ($res4x16 ->num_rows > 0 ) {
					      	while($row = $res4x16 ->fetch_assoc()){
					      		$tot_cnss_QPP_usd = $row['tot_cnss_QPP_usd'];
					      		$tot_cnss_QPP_usd1 = number_format($row['tot_cnss_QPP_usd'],2);
					      	}
					      	$tot_cnss_QPP_cdf = $tot_cnss_QPP_usd * $taux;
					   	}
					   	$req4x17 = "SELECT sum(inpp_QPP) AS tot_inpp_QPP_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x17 = $bd ->query($req4x17);

				      	if ($res4x17 ->num_rows > 0 ) {
					      	while($row = $res4x17 ->fetch_assoc()){
					      		$tot_inpp_QPP_usd = $row['tot_inpp_QPP_usd'];
					      		$tot_inpp_QPP_usd1 = number_format($row['tot_inpp_QPP_usd'],2);
					      	}
					      	$tot_inpp_QPP_cdf = $tot_inpp_QPP_usd * $taux;
					   	}
					   	$req4x18 = "SELECT sum(onem_QPP) AS tot_onem_QPP_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x18 = $bd ->query($req4x18);

				      if ($res4x18 ->num_rows > 0 ) {
					      while($row = $res4x18 ->fetch_assoc()){
					      	$tot_onem_QPP_usd = $row['tot_onem_QPP_usd'];
					      	$tot_onem_QPP_usd1 = number_format($row['tot_onem_QPP_usd'],2);
					      }
					      $tot_onem_QPP_cdf = $tot_onem_QPP_usd * $taux;
					   	}
					   	$req4x19 = "SELECT sum(qpp_tot) AS tot_qpp_tot_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x19 = $bd ->query($req4x19);

				      	if ($res4x19 ->num_rows > 0 ) {
					      	while($row = $res4x19 ->fetch_assoc()){
					      		$tot_qpp_tot_usd = $row['tot_qpp_tot_usd'];
					      		$tot_qpp_tot_usd1 = number_format($row['tot_qpp_tot_usd'],2);
					      	}
					      	$tot_qpp_tot_cdf = $tot_qpp_tot_usd * $taux;
					   	}
					   	$req4x20 = "SELECT sum(fisctot) AS tot_fisctot_usd FROM tab_payfiche WHERE societe ='$societe' AND mensan = '$periode' AND statut ='en cours'";
				      	$res4x20 = $bd ->query($req4x20);

				      	if ($res4x20 ->num_rows > 0 ) {
					      	while($row = $res4x20 ->fetch_assoc()){
					      		$tot_fisctot_usd = $row['tot_fisctot_usd'];
					      		$tot_fisctot_usd1 = number_format($row['tot_fisctot_usd'],2);
					      	}
					      	$tot_fisctot_cdf = $tot_fisctot_usd * $taux;
					   	}

              $TotChargepers = $tot_netp_usd + $tot_fisctot_usd;
              $TotChargepersCDF = $TotChargepers * $taux;

	            		echo'<tr>
                      		<td style="border: 1px solid #000;">1</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Salaire de base</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_salbase1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_salbase_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">2</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Salaire Maladie</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_salmal1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_salmal_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">3</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Salaire Circonstance</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_salcirc1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_salcirc_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">4</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Salaire conge</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_salconge1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_salconge_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">5</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Logement</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_logmt1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_logmt_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">6</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Transport</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_transp1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_transp_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">7</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Allocations familiales</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_alfam1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_alfam_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">8</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Indemnités diverses</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_inddiv1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_inddiv_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">9</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Primes</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_primtot1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_primtot_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr style="background-color: #dfc650;font-weight:bold;font-size:17px">
                      		<td style="border: 1px solid #dfc650;">10</td>
                      		<td style="border: 1px solid #dfc650;text-align:left!important">Total brut-</td>
                      		<td style="text-align:right;border: 1px solid #dfc650">'.$tot_brutot21.'</td>
                      		<td style="border: 1px solid #dfc650">USD</td>
                      		<td style="text-align:right;border: 1px solid #dfc650">'.number_format($tot_brutot2_cdf,2).'</td>
                      		<td style="border: 1px solid #dfc650">CDF</td>
                      		<td style="text-align:right;border: 1px solid #dfc650"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">11</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Base imposable</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_baseImp_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_baseImp_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">12</td>
                      		<td colspan="6" style="border: 1px solid #000;text-align:left!important;font-weight:bold">Retenues_Quote-Part-Ouvriere</td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">13</td>
                      		<td style="border: 1px solid #000;text-align:left!important">CNSS_Quote-part ouvrière</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_cnss_QPO_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_cnss_QPO_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">14</td>
                      		<td style="border: 1px solid #000;text-align:left!important">IPR_Impot profesionnel sur les remunerations</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_iprtot_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_iprtot_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">15</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Avances-prets</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_advanc_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_advanc_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr style="background-color: #dfc650;font-weight:bold;font-size:17px">
                      		<td style="border: 1px solid #dfc650;">16</td>
                      		<td style="border: 1px solid #dfc650;text-align:left!important">Total_retenues _ Quote-part ouvrière</td>
                      		<td style="text-align:right;border: 1px solid #dfc650">'.$tot_reten_usd1.'</td>
                      		<td style="border: 1px solid #dfc650">USD</td>
                      		<td style="text-align:right;border: 1px solid #dfc650">'.number_format($tot_reten_cdf,2).'</td>
                      		<td style="border: 1px solid #dfc650">CDF</td>
                      		<td style="text-align:right;border: 1px solid #dfc650"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">17</td>
                      		<td colspan="6" style="border: 1px solid #000;text-align:left!important;font-weight:bold">Quote-Part-Patronale</td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">18</td>
                      		<td style="border: 1px solid #000;text-align:left!important">IER_Impot-exceptionnel-sur-remunerations</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_ier_QPP_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_ier_QPP_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">19</td>
                      		<td style="border: 1px solid #000;text-align:left!important">CNSS_Quote-part patronale</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_cnss_QPP_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_cnss_QPP_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">20</td>
                      		<td style="border: 1px solid #000;text-align:left!important">INPP_Quote-part patronale</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_inpp_QPP_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_inpp_QPP_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">21</td>
                      		<td style="border: 1px solid #000;text-align:left!important">ONEM_Quote-part patronale</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_onem_QPP_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_onem_QPP_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr style="background-color: #dfc650;font-weight:bold;font-size:17px">
                      		<td style="border: 1px solid #dfc650;">22</td>
                      		<td style="border: 1px solid #dfc650;text-align:left!important">Total_Quote-part patronale</td>
                      		<td style="text-align:right;border: 1px solid #dfc650">'.$tot_qpp_tot_usd1.'</td>
                      		<td style="border: 1px solid #dfc650">USD</td>
                      		<td style="text-align:right;border: 1px solid #dfc650">'.number_format($tot_qpp_tot_cdf,2).'</td>
                      		<td style="border: 1px solid #dfc650">CDF</td>
                      		<td style="text-align:right;border: 1px solid #dfc650"></td>
                    		</tr>
                    		<tr>
                      		<td style="border: 1px solid #000;">23</td>
                      		<td colspan="6" style="border: 1px solid #000;text-align:left!important;font-weight:bold">NET-A-PAYER</td>
                    		</tr>
                    		<tr style="background-color: #dfc650;font-weight:bold;font-size:17px">
                      		<td style="border: 1px solid #000;">24</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Total fiscalités à payer</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$tot_fisctot_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_fisctot_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr style="background-color: #dfc650;font-weight:bold;font-size:17px">
                      		<td style="border: 1px solid #000;">25</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Salaire net à payer</td>
                      		<td style="text-align:right;border: 1px solid #000">'. $tot_netp_usd1.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($tot_netp_cdf,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>
                    		<tr style="background-color: #dfc650;font-weight:bold;font-size:17px">
                      		<td style="border: 1px solid #000;">26</td>
                      		<td style="border: 1px solid #000;text-align:left!important">Total charges du personnel à payer</td>
                      		<td style="text-align:right;border: 1px solid #000">'.$TotChargepers.'</td>
                      		<td style="border: 1px solid #000">USD</td>
                      		<td style="text-align:right;border: 1px solid #000">'.number_format($TotChargepersCDF,2).'</td>
                      		<td style="border: 1px solid #000">CDF</td>
                      		<td style="text-align:right;border: 1px solid #000"></td>
                    		</tr>';
	          		}
	          		else{//
		          		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Aucune information trouvée.".'</div>';
	          		}
	        		}// recherche par classe eleve
	      	}
	      	else{
	        		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Violation d'accès.".'</div>'; 
	      	}// verification de droit administratif
	   	}
	    	else{
	      	echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide.".'</div>';
	    	}// verification du compte administratif
	  	}
	}
	else{
		echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>';
	}
}//fin fonction impression recapitulative

//Affichage Listing-pay-net 
function listing_pay_net(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['departem'])) {
        if (empty($_GET['periode'])) {
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>
	                			<td>'.$row['id'].'</td>
	                			<td>'.$row['site'].'</td>
			                  <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                    	<td>'.$row['departement'].'</td>
			                  <td>'.$row['fonction'].'</td>
			                  <td>'.$row['num_compte'].'</td>
			                  <td>'.$row['brutot2'].'</td>
			                  <td>'.$row['qpo_tot'].'</td>
			                  <td>'.$row['tot_advanc'].'</td>
			                  <td>'.$row['tot_reten'].'</td>
			                  <td>'.$row['netp_usd'].'</td>
			                  <td></td>
	                    </tr>';
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
	        //filtrage par periode
	        $periode = $_GET['periode'];
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE menspay LIKE '%$periode%' AND societe ='$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		              echo'<tr>
			                	<td>'.$row['id'].'</td>
			                  <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                    	<td>'.$row['departement'].'</td>
			                  <td>'.$row['fonction'].'</td>
			                  <td>'.$row['num_compte'].'</td>
			                  <td>'.$row['brutot2'].'</td>
			                  <td>'.$row['qpo_tot'].'</td>
			                  <td>'.$row['tot_advanc'].'</td>
			                  <td>'.$row['tot_reten'].'</td>
			                  <td>'.$row['netp_usd'].'</td>
			                  <td></td>
	                    </tr>';
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
	        //filtrage par periode
	      }    
      }
      else{
        //filtrage par departement
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
	          $req2 = "SELECT * FROM tab_payfiche WHERE departement LIKE '%$departem%' AND societe ='$societe' ORDER BY nom_complet ASC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>
			                <td>'.$row['id'].'</td>
			                <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                   	<td>'.$row['departement'].'</td>
			                <td>'.$row['fonction'].'</td>
			                <td>'.$row['num_compte'].'</td>
			                <td>'.$row['brutot2'].'</td>
			                <td>'.$row['qpo_tot'].'</td>
			                <td>'.$row['tot_advanc'].'</td>
			                <td>'.$row['tot_reten'].'</td>
			                <td>'.$row['netp_usd'].'</td>
			               	<td></td>
	                  </tr>';
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
	     	//filtrage par departement
      }
    }
    else{
      //filtrage par Agent
      $nom_agent =$_GET['nom_agent'];
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
	        $req2 = "SELECT * FROM tab_payfiche WHERE nom_complet LIKE '%$nom_agent%' AND societe ='$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

					if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          echo'<tr>
			              <td>'.$row['id'].'</td>
			              <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                  <td>'.$row['departement'].'</td>
			              <td>'.$row['fonction'].'</td>
			              <td>'.$row['num_compte'].'</td>
			              <td>'.$row['brutot2'].'</td>
			              <td>'.$row['qpo_tot'].'</td>
			              <td>'.$row['tot_advanc'].'</td>
			              <td>'.$row['tot_reten'].'</td>
			              <td>'.$row['netp_usd'].'</td>
			              <td></td>
	                </tr>';
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
	    //filtrage par Agent 
    }
  }
  else{

  }
}
//Fin Affichage Listing-pay-net 

//Affichage Listing-pay-net somme global des chaque colonnes
function listing_pay_net1(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['departem'])) {
        if (empty($_GET['periode'])) {
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

	            $req2 = "SELECT * FROM tab_payfiche WHERE societe = '$societe' AND statut ='en cours' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	              	$brutot2 = $row['brutot2'];
	              	$qpo_tot = $row['qpo_tot'];
	              	$tot_advanc = $row['tot_advanc'];
	              	$tot_reten  = $row['tot_reten'];
	              	$netp_usd   = $row['netp_usd'];
	              }
	              $req4a = "SELECT sum(brutot2) AS total_brutot2_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
						    $res4a = $bd ->query($req4a);

						    if ($res4a ->num_rows > 0 ) {
							    while($row = $res4a ->fetch_assoc()){
							    	$tot_brutot2 = $row['total_brutot2_usd'];
							    	$tot_brutot21 = number_format($row['total_brutot2_usd'],2);
							    }
							  }
							  $req4b = "SELECT sum(qpo_tot) AS total_qpo_tot_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
						    $res4b = $bd ->query($req4b);

						    if ($res4b ->num_rows > 0 ) {
							    while($row = $res4b ->fetch_assoc()){
							    	$tot_qpo_tot = $row['total_qpo_tot_usd'];
							    	$tot_qpo_tot1 = number_format($row['total_qpo_tot_usd'],2);
							    }
							  }
							  $req4c = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
						    $res4c = $bd ->query($req4c);

						    if ($res4c ->num_rows > 0 ) {
							    while($row = $res4c ->fetch_assoc()){
							    	$tot__advanc = $row['tot_advanc_usd'];
							    	$tot_advanc1 = number_format($row['tot_advanc_usd'],2);
							    }
							  }
							  $req4d = "SELECT sum(tot_reten) AS tot_reten_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
						    $res4d = $bd ->query($req4d);

						    if ($res4d ->num_rows > 0 ) {
							    while($row = $res4d ->fetch_assoc()){
							    	$tot_reten = $row['tot_reten_usd'];
							    	$tot_reten1 = number_format($row['tot_reten_usd'],2);
							    }
							  }
							  $req4d = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
						    $res4d = $bd ->query($req4d);

						    if ($res4d ->num_rows > 0 ) {
							    while($row = $res4d ->fetch_assoc()){
							    	$tot_netp_usd = $row['tot_netp_usd'];
							    	$tot_netp_usd1 = number_format($row['tot_netp_usd'],2);
							    }
							  }

	              echo'<tr>
	                		<td colspan="6" style="text-align:center;font-weight:bold!important;font-size:22px;text-transform:uppercase">Total</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_brutot21.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_qpo_tot1.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_advanc1.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_reten1.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_netp_usd1.'</td>
	                  </tr>';
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
	        //filtrage par periode
	        $periode = $_GET['periode'];
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

	            $req2 = "SELECT * FROM tab_payfiche WHERE menspay LIKE '%$periode%' AND societe ='$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		              $brutot2 = $row['brutot2'];
	              	$qpo_tot = $row['qpo_tot'];
	              	$tot_advanc = $row['tot_advanc'];
	              	$tot_reten  = $row['tot_reten'];
	              	$netp_usd   = $row['netp_usd'];
		            }
		            $req4a = "SELECT sum(brutot2) AS total_brutot2_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
						    $res4a = $bd ->query($req4a);

						    if ($res4a ->num_rows > 0 ) {
							    while($row = $res4a ->fetch_assoc()){
							    	$tot_brutot2 = $row['total_brutot2_usd'];
							    	$tot_brutot21 = number_format($row['total_brutot2_usd'],2);
							    }
							  }
							  $req4b = "SELECT sum(qpo_tot) AS total_qpo_tot_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
						    $res4b = $bd ->query($req4b);

						    if ($res4b ->num_rows > 0 ) {
							    while($row = $res4b ->fetch_assoc()){
							    	$tot_qpo_tot = $row['total_qpo_tot_usd'];
							    	$tot_qpo_tot1 = number_format($row['total_qpo_tot_usd'],2);
							    }
							  }
							  $req4c = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
						    $res4c = $bd ->query($req4c);

						    if ($res4c ->num_rows > 0 ) {
							    while($row = $res4c ->fetch_assoc()){
							    	$tot__advanc = $row['tot_advanc_usd'];
							    	$tot_advanc1 = number_format($row['tot_advanc_usd'],2);
							    }
							  }
							  $req4d = "SELECT sum(tot_reten) AS tot_reten_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
						    $res4d = $bd ->query($req4d);

						    if ($res4d ->num_rows > 0 ) {
							    while($row = $res4d ->fetch_assoc()){
							    	$tot_reten = $row['tot_reten_usd'];
							    	$tot_reten1 = number_format($row['tot_reten_usd'],2);
							    }
							  }
							  $req4d = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
						    $res4d = $bd ->query($req4d);

						    if ($res4d ->num_rows > 0 ) {
							    while($row = $res4d ->fetch_assoc()){
							    	$tot_netp_usd = $row['tot_netp_usd'];
							    	$tot_netp_usd1 = number_format($row['tot_netp_usd'],2);
							    }
							  }

	              echo'<tr>
	                		<td colspan="5" style="text-align:center;font-weight:bold!important;font-size:22px;text-transform:uppercase">Total</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_brutot21.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_qpo_tot1.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_advanc1.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_reten1.'</td>
			                <td style="font-weight:bold;font-size:16px">'.$tot_netp_usd1.'</td>
	                  </tr>';
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
	        //filtrage par periode
	      }    
      }
      else{
     		//filtrage par departement
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
	          $req2 = "SELECT * FROM tab_payfiche WHERE departement LIKE '%$departem%' AND societe ='$societe' ORDER BY nom_complet ASC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		             $brutot2 = $row['brutot2'];
	              $qpo_tot = $row['qpo_tot'];
	              $tot_advanc = $row['tot_advanc'];
	              $tot_reten  = $row['tot_reten'];
	              $netp_usd   = $row['netp_usd'];
		          }
		          $req4a = "SELECT sum(brutot2) AS total_brutot2_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
						  $res4a = $bd ->query($req4a);

						  if ($res4a ->num_rows > 0 ) {
							  while($row = $res4a ->fetch_assoc()){
							    $tot_brutot2 = $row['total_brutot2_usd'];
							    $tot_brutot21 = number_format($row['total_brutot2_usd'],2);
							  }
							}
							$req4b = "SELECT sum(qpo_tot) AS total_qpo_tot_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
						  $res4b = $bd ->query($req4b);

						  if ($res4b ->num_rows > 0 ) {
							  while($row = $res4b ->fetch_assoc()){
							    $tot_qpo_tot = $row['total_qpo_tot_usd'];
							    $tot_qpo_tot1 = number_format($row['total_qpo_tot_usd'],2);
							  }
							}
							$req4c = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
						  $res4c = $bd ->query($req4c);

						  if ($res4c ->num_rows > 0 ) {
							  while($row = $res4c ->fetch_assoc()){
							  	$tot__advanc = $row['tot_advanc_usd'];
							  	$tot_advanc1 = number_format($row['tot_advanc_usd'],2);
							  }
							}
							$req4d = "SELECT sum(tot_reten) AS tot_reten_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
						  $res4d = $bd ->query($req4d);

						  if ($res4d ->num_rows > 0 ) {
							  while($row = $res4d ->fetch_assoc()){
							    $tot_reten = $row['tot_reten_usd'];
							    $tot_reten1 = number_format($row['tot_reten_usd'],2);
							  }
							}
							$req4d = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
						  $res4d = $bd ->query($req4d);

						  if ($res4d ->num_rows > 0 ) {
							  while($row = $res4d ->fetch_assoc()){
							    $tot_netp_usd = $row['tot_netp_usd'];
							    $tot_netp_usd1 = number_format($row['tot_netp_usd'],2);
							  }
							}

	            echo'<tr>
	                	<td colspan="5" style="text-align:center;font-weight:bold!important;font-size:22px;text-transform:uppercase">Total</td>
			              <td style="font-weight:bold;font-size:16px">'.$tot_brutot21.'</td>
			              <td style="font-weight:bold;font-size:16px">'.$tot_qpo_tot1.'</td>
			              <td style="font-weight:bold;font-size:16px">'.$tot_advanc1.'</td>
			              <td style="font-weight:bold;font-size:16px">'.$tot_reten1.'</td>
			              <td style="font-weight:bold;font-size:16px">'.$tot_netp_usd1.'</td>
	                </tr>';
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
	     //filtrage par departement
      }
    }
    else{
      //filtrage par Agent
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
	        $req2 = "SELECT * FROM tab_payfiche WHERE nom_complet LIKE '%$nom_agent%' AND societe ='$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          $brutot2 = $row['brutot2'];
	            $qpo_tot = $row['qpo_tot'];
	            $tot_advanc = $row['tot_advanc'];
	            $tot_reten  = $row['tot_reten'];
	            $netp_usd   = $row['netp_usd'];
		        }
		        $req4a = "SELECT sum(brutot2) AS total_brutot2_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
						$res4a = $bd ->query($req4a);

						if ($res4a ->num_rows > 0 ) {
							while($row = $res4a ->fetch_assoc()){
							  $tot_brutot2 = $row['total_brutot2_usd'];
							  $tot_brutot21 = number_format($row['total_brutot2_usd'],2);
						 	}
						}
						$req4b = "SELECT sum(qpo_tot) AS total_qpo_tot_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
						$res4b = $bd ->query($req4b);

						if ($res4b ->num_rows > 0 ) {
							while($row = $res4b ->fetch_assoc()){
							  $tot_qpo_tot = $row['total_qpo_tot_usd'];
							  $tot_qpo_tot1 = number_format($row['total_qpo_tot_usd'],2);
							}
						}
						$req4c = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
						$res4c = $bd ->query($req4c);

						if ($res4c ->num_rows > 0 ) {
							while($row = $res4c ->fetch_assoc()){
							  $tot__advanc = $row['tot_advanc_usd'];
							  $tot_advanc1 = number_format($row['tot_advanc_usd'],2);
							}
						}
						$req4d = "SELECT sum(tot_reten) AS tot_reten_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
						$res4d = $bd ->query($req4d);

						if ($res4d ->num_rows > 0 ) {
							while($row = $res4d ->fetch_assoc()){
							  $tot_reten = $row['tot_reten_usd'];
							  $tot_reten1 = number_format($row['tot_reten_usd'],2);
							}
						}
						$req4d = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
						$res4d = $bd ->query($req4d);

						if ($res4d ->num_rows > 0 ) {
							while($row = $res4d ->fetch_assoc()){
							  $tot_netp_usd = $row['tot_netp_usd'];
							  $tot_netp_usd1 = number_format($row['tot_netp_usd'],2);
							}
						}

	          echo'<tr>
	               	<td colspan="5" style="text-align:center;font-weight:bold!important;font-size:22px;text-transform:uppercase">Total</td>
			            <td style="font-weight:bold;font-size:16px">'.$tot_brutot21.'</td>
			            <td style="font-weight:bold;font-size:16px">'.$tot_qpo_tot1.'</td>
			            <td style="font-weight:bold;font-size:16px">'.$tot_advanc1.'</td>
			            <td style="font-weight:bold;font-size:16px">'.$tot_reten1.'</td>
			            <td style="font-weight:bold;font-size:16px">'.$tot_netp_usd1.'</td>
	              </tr>';
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
	    //filtrage par Agent
    }
  }
  else{

  }
}
//Fin Affichage Listing-pay-net somme global des chaque colonne

//Affichage Recap_fiscalites_ 
function Recap_fiscalites(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['departem'])) {
        if (empty($_GET['periode'])) {
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
	    				$req2 = "SELECT * FROM tab_payfiche WHERE societe = '$societe' AND statut ='en cours' ORDER BY nom_complet ASC";
	    				$res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	            		$id          = $row['id'];
	            		$nom_complet = $row['nom_complet'];
	             		$baseImp_usd = $row['baseImp_usd'];
	             		$cnss_QPO    = $row['cnss_QPO'];
	             		$cnss_QPP    = $row['cnss_QPP'];
	             		$cnss_tot    = $row['cnss_tot'];
	             		$iprtot_usd  = $row['iprtot_usd'];
	             		$ier_QPP     = $row['ier_QPP'];
	             		$inpp_QPP    = $row['inpp_QPP'];
	             		$onem_QPP    = $row['onem_QPP'];
	             		$fisctot     = $row['fisctot'];
	             		$taux        = $row['taux'];

	                $baseImp_cdf = $baseImp_usd * $taux;
	                $cnss_QPO_cdf = $cnss_QPO * $taux;
	                $cnss_QPP_cdf = $cnss_QPP * $taux;
	                $cnss_tot_cdf = $cnss_tot * $taux;
	                $iprtot_cdf = $iprtot_usd * $taux;
	                $ier_QPP_cdf = $ier_QPP * $taux;
	                $inpp_QPP_cdf = $inpp_QPP * $taux;
	                $onem_QPP_cdf = $onem_QPP * $taux;
	                $fisctot_cdf = $fisctot * $taux;

	               	//Affichage liste
		              echo'<tr>
		                		<td>'.$id.'</td>
				                <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
		                    <td>'.number_format($baseImp_cdf,2).'</td>
				                <td>'.number_format($cnss_QPO_cdf,2).'</td>
				                <td>'.number_format($cnss_QPP_cdf,2).'</td>
				                <td>'.number_format($cnss_tot_cdf,2).'</td>
				                <td>'.number_format($iprtot_cdf,2).'</td>
				                <td>'.number_format($ier_QPP_cdf,2).'</td>
				                <td>'.number_format($inpp_QPP_cdf,2).'</td>
				                <td>'.number_format($onem_QPP_cdf,2).'</td>
				                <td>'.number_format($fisctot_cdf,2).'</td>
				                <td></td>
		                  </tr>';
	             	}
	             	$req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3 = $bd ->query($req3);

	             	if ($res3 ->num_rows > 0) {
	             		while ($row = $res3->fetch_assoc()) {
	             			$tot_baseimpot = $row['tot_baseImp_usd'];
	             			$tot_baseimpot_cdf = $tot_baseimpot * $taux;
	             		}
	             	}
	             	$req3a = "SELECT sum(cnss_QPO) AS tot_cnss_QPO FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3a = $bd ->query($req3a);

	             	if ($res3a ->num_rows > 0) {
	             		while ($row = $res3a->fetch_assoc()) {
	             			$tot_cnss_QPO_usd = $row['tot_cnss_QPO'];
	             			$tot_cnss_QPO_cdf = $tot_cnss_QPO_usd * $taux;
	             		}
	             	}
	             	$req3b = "SELECT sum(cnss_QPP) AS tot_cnss_QPP FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3b = $bd ->query($req3b);

	             	if ($res3b ->num_rows > 0) {
	             		while ($row = $res3b->fetch_assoc()) {
	             			$tot_cnss_QPP_usd = $row['tot_cnss_QPP'];
	             			$tot_cnss_QPP_cdf = $tot_cnss_QPP_usd * $taux;
	             		}
	             	}
	             	$req3c = "SELECT sum(cnss_tot) AS tot_cnss_tot FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3c = $bd ->query($req3c);

	             	if ($res3c ->num_rows > 0) {
	             		while ($row = $res3c->fetch_assoc()) {
	             			$tot_cnss = $row['tot_cnss_tot'];
	             			$tot_cnss_cdf = $tot_cnss * $taux;
	             		}
	             	}
	             	$req3d = "SELECT sum(iprtot_usd) AS tot_iprtot_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3d = $bd->query($req3d);

	             	if ($res3d ->num_rows > 0) {
	             		while ($row = $res3d->fetch_assoc()) {
	             			$tot_iprtot = $row['tot_iprtot_usd'];
	             			$tot_iprtot_cdf = $tot_iprtot * $taux;
	             		}
	             	}
	             	$req3e = "SELECT sum(ier_QPP) AS tot_ier_QPP FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3e = $bd ->query($req3e);

	             	if ($res3e ->num_rows > 0) {
	             		while ($row = $res3e->fetch_assoc()) {
	             			$tot_ier_QPP_usd = $row['tot_ier_QPP'];
	             			$tot_ier_QPP_cdf = $tot_ier_QPP_usd * $taux;
	             		}
	             	}
	             	$req3f = "SELECT sum(inpp_QPP) AS tot_inpp_QPP FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3f = $bd->query($req3f);

	             	if ($res3f ->num_rows > 0) {
	             		while ($row = $res3f->fetch_assoc()) {
	             			$tot_inpp = $row['tot_inpp_QPP'];
	             			$tot_inpp_cdf = $tot_inpp * $taux;
	             		}
	             	}
	             	$req3g = "SELECT sum(onem_QPP) AS tot_onem_QPP FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3g = $bd ->query($req3g);

	             	if ($res3g ->num_rows > 0) {
	             		if ($row = $res3g ->fetch_assoc()) {
	             			$tot_onem = $row['tot_onem_QPP'];
	             			$tot_onem_cdf = $tot_onem * $taux;
	             		}
	             	}
	             	$req3h = "SELECT sum(fisctot) AS tot_fisctot FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3h = $bd->query($req3h);

	             	if ($res3h ->num_rows > 0) {
	             		while ($row = $res3h ->fetch_assoc()) {
	             			$tot_fisctot_usd = $row['tot_fisctot'];
	             			$tot_fisctot_cdf = $tot_fisctot_usd * $taux;
	             		}
	             	}

	             	echo'<tr>
	             				<td colspan="2" style="font-weight:bold;font-size:18px">Total</td>
	             				<td style="font-weight:bold">'.number_format($tot_baseimpot_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_cnss_QPO_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_cnss_QPP_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_cnss_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_iprtot_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_ier_QPP_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_inpp_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_onem_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_fisctot_cdf,2).'</td>
	             	     	</tr>';
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
	        //filtrage par periode
	        $periode = $_GET['periode'];
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE menspay LIKE '%$periode%' AND societe ='$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		             	$id          = $row['id'];
	              	$nom_complet = $row['nom_complet'];
	                $baseImp_usd = $row['baseImp_usd'];
	                $cnss_QPO    = $row['cnss_QPO'];
	                $cnss_QPP    = $row['cnss_QPP'];
	               	$cnss_tot    = $row['cnss_tot'];
	                $iprtot_usd  = $row['iprtot_usd'];
	                $ier_QPP     = $row['ier_QPP'];
	                $inpp_QPP    = $row['inpp_QPP'];
	                $onem_QPP    = $row['onem_QPP'];
	                $fisctot     = $row['fisctot'];
	                $taux        = $row['taux'];

	                $baseImp_cdf = $baseImp_usd * $taux;
	                $cnss_QPO_cdf = $cnss_QPO * $taux;
	                $cnss_QPP_cdf = $cnss_QPP * $taux;
	                $cnss_tot_cdf = $cnss_tot * $taux;
	                $iprtot_cdf = $iprtot_usd * $taux;
	                $ier_QPP_cdf = $ier_QPP * $taux;
	                $inpp_QPP_cdf = $inpp_QPP * $taux;
	                $onem_QPP_cdf = $onem_QPP * $taux;
	                $fisctot_cdf = $fisctot * $taux;

	                //Affichage liste
		              echo'<tr>
		                		<td>'.$id.'</td>
				                <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
		                   	<td>'.number_format($baseImp_cdf,2).'</td>
				                <td>'.number_format($cnss_QPO_cdf,2).'</td>
				                <td>'.number_format($cnss_QPP_cdf,2).'</td>
				                <td>'.number_format($cnss_tot_cdf,2).'</td>
				                <td>'.number_format($iprtot_cdf,2).'</td>
				                <td>'.number_format($ier_QPP_cdf,2).'</td>
				                <td>'.number_format($inpp_QPP_cdf,2).'</td>
				                <td>'.number_format($onem_QPP_cdf,2).'</td>
				                <td>'.number_format($fisctot_cdf,2).'</td>
				                <td></td>
		                  </tr>';
	             	}
	             	$req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3 = $bd ->query($req3);

	             	if ($res3 ->num_rows > 0) {
	             		while ($row = $res3->fetch_assoc()) {
	             			$tot_baseimpot = $row['tot_baseImp_usd'];
	             			$tot_baseimpot_cdf = $tot_baseimpot * $taux;
	             		}
	             	}
	             	$req3a = "SELECT sum(cnss_QPO) AS tot_cnss_QPO FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3a = $bd ->query($req3a);

	             	if ($res3a ->num_rows > 0) {
	             		while ($row = $res3a->fetch_assoc()) {
	             			$tot_cnss_QPO_usd = $row['tot_cnss_QPO'];
	             			$tot_cnss_QPO_cdf = $tot_cnss_QPO_usd * $taux;
	             		}
	             	}
	             	$req3b = "SELECT sum(cnss_QPP) AS tot_cnss_QPP FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3b = $bd ->query($req3b);

	             	if ($res3b ->num_rows > 0) {
	             		while ($row = $res3b->fetch_assoc()) {
	             			$tot_cnss_QPP_usd = $row['tot_cnss_QPP'];
	             			$tot_cnss_QPP_cdf = $tot_cnss_QPP_usd * $taux;
	             		}
	             	}
	             	$req3c = "SELECT sum(cnss_tot) AS tot_cnss_tot FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3c = $bd ->query($req3c);

	             	if ($res3c ->num_rows > 0) {
	             		while ($row = $res3c->fetch_assoc()) {
	             			$tot_cnss = $row['tot_cnss_tot'];
	             			$tot_cnss_cdf = $tot_cnss * $taux;
	             		}
	             	}
	             	$req3d = "SELECT sum(iprtot_usd) AS tot_iprtot_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3d = $bd->query($req3d);

	             	if ($res3d ->num_rows > 0) {
	             		while ($row = $res3d->fetch_assoc()) {
	             			$tot_iprtot = $row['tot_iprtot_usd'];
	             			$tot_iprtot_cdf = $tot_iprtot * $taux;
	             		}
	             	}
	             	$req3e = "SELECT sum(ier_QPP) AS tot_ier_QPP FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3e = $bd ->query($req3e);

	             	if ($res3e ->num_rows > 0) {
	             		while ($row = $res3e->fetch_assoc()) {
	             			$tot_ier_QPP_usd = $row['tot_ier_QPP'];
	             			$tot_ier_QPP_cdf = $tot_ier_QPP_usd * $taux;
	             		}
	             	}
	             	$req3f = "SELECT sum(inpp_QPP) AS tot_inpp_QPP FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3f = $bd->query($req3f);

	             	if ($res3f ->num_rows > 0) {
	             		while ($row = $res3f->fetch_assoc()) {
	             			$tot_inpp = $row['tot_inpp_QPP'];
	             			$tot_inpp_cdf = $tot_inpp * $taux;
	             		}
	             	}
	             	$req3g = "SELECT sum(onem_QPP) AS tot_onem_QPP FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3g = $bd ->query($req3g);

	             	if ($res3g ->num_rows > 0) {
	             		if ($row = $res3g ->fetch_assoc()) {
	             			$tot_onem = $row['tot_onem_QPP'];
	             			$tot_onem_cdf = $tot_onem * $taux;
	             		}
	             	}
	             	$req3h = "SELECT sum(fisctot) AS tot_fisctot FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3h = $bd->query($req3h);

	             	if ($res3h ->num_rows > 0) {
	             		while ($row = $res3h ->fetch_assoc()) {
	             			$tot_fisctot_usd = $row['tot_fisctot'];
	             			$tot_fisctot_cdf = $tot_fisctot_usd * $taux;
	             		}
	             	}

	             	echo'<tr>
	             				<td colspan="2" style="font-weight:bold;font-size:18px">Total</td>
	             				<td style="font-weight:bold">'.number_format($tot_baseimpot_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_cnss_QPO_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_cnss_QPP_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_cnss_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_iprtot_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_ier_QPP_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_inpp_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_onem_cdf,2).'</td>
	             				<td style="font-weight:bold">'.number_format($tot_fisctot_cdf,2).'</td>
	             	    </tr>';
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
	        //filtrage par periode
	      }    
      }
      else{
        //filtrage par departement
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
	       		$req2 = "SELECT * FROM tab_payfiche WHERE departement LIKE '%$departem%' AND societe ='$societe' ORDER BY nom_complet ASC";
		     		$res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            $id          = $row['id'];
	             	$nom_complet = $row['nom_complet'];
	              $baseImp_usd = $row['baseImp_usd'];
	              $cnss_QPO    = $row['cnss_QPO'];
	              $cnss_QPP    = $row['cnss_QPP'];
	              $cnss_tot    = $row['cnss_tot'];
	              $iprtot_usd  = $row['iprtot_usd'];
	              $ier_QPP     = $row['ier_QPP'];
	              $inpp_QPP    = $row['inpp_QPP'];
	              $onem_QPP    = $row['onem_QPP'];
	              $fisctot     = $row['fisctot'];
	              $taux        = $row['taux'];

	              $baseImp_cdf = $baseImp_usd * $taux;
	              $cnss_QPO_cdf = $cnss_QPO * $taux;
	              $cnss_QPP_cdf = $cnss_QPP * $taux;
	              $cnss_tot_cdf = $cnss_tot * $taux;
	              $iprtot_cdf = $iprtot_usd * $taux;
	              $ier_QPP_cdf = $ier_QPP * $taux;
	              $inpp_QPP_cdf = $inpp_QPP * $taux;
	              $onem_QPP_cdf = $onem_QPP * $taux;
	              $fisctot_cdf = $fisctot * $taux;

	              //Affichage liste
		            echo'<tr>
		                	<td>'.$id.'</td>
				              <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
		                  <td>'.number_format($baseImp_cdf,2).'</td>
				              <td>'.number_format($cnss_QPO_cdf,2).'</td>
				              <td>'.number_format($cnss_QPP_cdf,2).'</td>
				              <td>'.number_format($cnss_tot_cdf,2).'</td>
				              <td>'.number_format($iprtot_cdf,2).'</td>
				              <td>'.number_format($ier_QPP_cdf,2).'</td>
				              <td>'.number_format($inpp_QPP_cdf,2).'</td>
				              <td>'.number_format($onem_QPP_cdf,2).'</td>
				              <td>'.number_format($fisctot_cdf,2).'</td>
				              <td></td>
		                </tr>';
	            }
	            $req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd ->query($req3);

	            if ($res3 ->num_rows > 0) {
	             	while ($row = $res3->fetch_assoc()) {
	             		$tot_baseimpot = $row['tot_baseImp_usd'];
	             		$tot_baseimpot_cdf = $tot_baseimpot * $taux;
	             	}
	            }
	            $req3a = "SELECT sum(cnss_QPO) AS tot_cnss_QPO FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3a = $bd ->query($req3a);

	            if ($res3a ->num_rows > 0) {
	             	while ($row = $res3a->fetch_assoc()) {
	             		$tot_cnss_QPO_usd = $row['tot_cnss_QPO'];
	             		$tot_cnss_QPO_cdf = $tot_cnss_QPO_usd * $taux;
	             	}
	            }
	            $req3b = "SELECT sum(cnss_QPP) AS tot_cnss_QPP FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3b = $bd ->query($req3b);

	            if ($res3b ->num_rows > 0) {
	             	while ($row = $res3b->fetch_assoc()) {
	             		$tot_cnss_QPP_usd = $row['tot_cnss_QPP'];
	             		$tot_cnss_QPP_cdf = $tot_cnss_QPP_usd * $taux;
	             	}
	            }
	            $req3c = "SELECT sum(cnss_tot) AS tot_cnss_tot FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3c = $bd ->query($req3c);

	            if ($res3c ->num_rows > 0) {
	             	while ($row = $res3c->fetch_assoc()) {
	             		$tot_cnss = $row['tot_cnss_tot'];
	             		$tot_cnss_cdf = $tot_cnss * $taux;
	             	}
	            }
	            $req3d = "SELECT sum(iprtot_usd) AS tot_iprtot_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3d = $bd->query($req3d);

	            if ($res3d ->num_rows > 0) {
	             	while ($row = $res3d->fetch_assoc()) {
	             		$tot_iprtot = $row['tot_iprtot_usd'];
	             		$tot_iprtot_cdf = $tot_iprtot * $taux;
	             	}
	            }
	            $req3e = "SELECT sum(ier_QPP) AS tot_ier_QPP FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3e = $bd ->query($req3e);

	            if ($res3e ->num_rows > 0) {
	             	while ($row = $res3e->fetch_assoc()) {
	             		$tot_ier_QPP_usd = $row['tot_ier_QPP'];
	             		$tot_ier_QPP_cdf = $tot_ier_QPP_usd * $taux;
	             	}
	            }
	            $req3f = "SELECT sum(inpp_QPP) AS tot_inpp_QPP FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3f = $bd->query($req3f);

	            if ($res3f ->num_rows > 0) {
	             	while ($row = $res3f->fetch_assoc()) {
	             		$tot_inpp = $row['tot_inpp_QPP'];
	             		$tot_inpp_cdf = $tot_inpp * $taux;
	             	}
	            }
	            $req3g = "SELECT sum(onem_QPP) AS tot_onem_QPP FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3g = $bd ->query($req3g);

	            if ($res3g ->num_rows > 0) {
	             	while ($row = $res3g ->fetch_assoc()) {
	             		$tot_onem = $row['tot_onem_QPP'];
	             		$tot_onem_cdf = $tot_onem * $taux;
	             	}
	            }
	            $req3h = "SELECT sum(fisctot) AS tot_fisctot FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3h = $bd->query($req3h);

	            if ($res3h ->num_rows > 0) {
	             	while ($row = $res3h ->fetch_assoc()) {
	             		$tot_fisctot_usd = $row['tot_fisctot'];
	             		$tot_fisctot_cdf = $tot_fisctot_usd * $taux;
	             	}
	            }

	            echo'<tr>
	             			<td colspan="2" style="font-weight:bold;font-size:18px">Total</td>
	             			<td style="font-weight:bold">'.number_format($tot_baseimpot_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_cnss_QPO_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_cnss_QPP_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_cnss_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_iprtot_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_ier_QPP_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_inpp_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_onem_cdf,2).'</td>
	             			<td style="font-weight:bold">'.number_format($tot_fisctot_cdf,2).'</td>
	             	  </tr>';
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
	      //filtrage   	
      }
   	}
    else{
      //filtrage 
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
	       	$req2 = "SELECT * FROM tab_payfiche WHERE nom_complet LIKE '%$nom_agent%' AND societe ='$societe' ORDER BY nom_complet ASC";
		     	$res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          $id          = $row['id'];
	            $nom_complet = $row['nom_complet'];
	            $baseImp_usd = $row['baseImp_usd'];
	            $cnss_QPO    = $row['cnss_QPO'];
	            $cnss_QPP    = $row['cnss_QPP'];
	            $cnss_tot    = $row['cnss_tot'];
	            $iprtot_usd  = $row['iprtot_usd'];
	            $ier_QPP     = $row['ier_QPP'];
	            $inpp_QPP    = $row['inpp_QPP'];
	            $onem_QPP    = $row['onem_QPP'];
	            $fisctot     = $row['fisctot'];
	            $taux        = $row['taux'];

	            $baseImp_cdf = $baseImp_usd * $taux;
	            $cnss_QPO_cdf = $cnss_QPO * $taux;
	            $cnss_QPP_cdf = $cnss_QPP * $taux;
	            $cnss_tot_cdf = $cnss_tot * $taux;
	            $iprtot_cdf = $iprtot_usd * $taux;
	            $ier_QPP_cdf = $ier_QPP * $taux;
	            $inpp_QPP_cdf = $inpp_QPP * $taux;
	            $onem_QPP_cdf = $onem_QPP * $taux;
	            $fisctot_cdf = $fisctot * $taux;

	            //Affichage liste
		          echo'<tr>
		               	<td>'.$id.'</td>
				            <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
		                <td>'.number_format($baseImp_cdf,2).'</td>
				            <td>'.number_format($cnss_QPO_cdf,2).'</td>
				            <td>'.number_format($cnss_QPP_cdf,2).'</td>
				            <td>'.number_format($cnss_tot_cdf,2).'</td>
				            <td>'.number_format($iprtot_cdf,2).'</td>
				            <td>'.number_format($ier_QPP_cdf,2).'</td>
				            <td>'.number_format($inpp_QPP_cdf,2).'</td>
				            <td>'.number_format($onem_QPP_cdf,2).'</td>
				            <td>'.number_format($fisctot_cdf,2).'</td>
				            <td></td>
		              </tr>';
	          }
	          $req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd ->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3->fetch_assoc()) {
	            	$tot_baseimpot = $row['tot_baseImp_usd'];
	            	$tot_baseimpot_cdf = $tot_baseimpot * $taux;
	            }
	          }
	          $req3a = "SELECT sum(cnss_QPO) AS tot_cnss_QPO FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3a = $bd ->query($req3a);

	          if ($res3a ->num_rows > 0) {
	            while ($row = $res3a->fetch_assoc()) {
	            	$tot_cnss_QPO_usd = $row['tot_cnss_QPO'];
	            	$tot_cnss_QPO_cdf = $tot_cnss_QPO_usd * $taux;
	            }
	          }
	          $req3b = "SELECT sum(cnss_QPP) AS tot_cnss_QPP FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3b = $bd ->query($req3b);

	          if ($res3b ->num_rows > 0) {
	            while ($row = $res3b->fetch_assoc()) {
	            	$tot_cnss_QPP_usd = $row['tot_cnss_QPP'];
	            	$tot_cnss_QPP_cdf = $tot_cnss_QPP_usd * $taux;
	            }
	          }
	          $req3c = "SELECT sum(cnss_tot) AS tot_cnss_tot FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3c = $bd ->query($req3c);

	          if ($res3c ->num_rows > 0) {
	            while ($row = $res3c->fetch_assoc()) {
	            	$tot_cnss = $row['tot_cnss_tot'];
	            	$tot_cnss_cdf = $tot_cnss * $taux;
	            }
	          }
	          $req3d = "SELECT sum(iprtot_usd) AS tot_iprtot_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3d = $bd->query($req3d);

	          if ($res3d ->num_rows > 0) {
	            while ($row = $res3d->fetch_assoc()) {
	             	$tot_iprtot = $row['tot_iprtot_usd'];
	             	$tot_iprtot_cdf = $tot_iprtot * $taux;
	            }
	          }
	          $req3e = "SELECT sum(ier_QPP) AS tot_ier_QPP FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3e = $bd ->query($req3e);

	         	if ($res3e ->num_rows > 0) {
	           	while ($row = $res3e->fetch_assoc()) {
	             	$tot_ier_QPP_usd = $row['tot_ier_QPP'];
	             	$tot_ier_QPP_cdf = $tot_ier_QPP_usd * $taux;
	           	}
	         	}
	          $req3f = "SELECT sum(inpp_QPP) AS tot_inpp_QPP FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3f = $bd->query($req3f);

	          if ($res3f ->num_rows > 0) {
	            while ($row = $res3f->fetch_assoc()) {
	             	$tot_inpp = $row['tot_inpp_QPP'];
	             	$tot_inpp_cdf = $tot_inpp * $taux;
	            }
	          }
	          $req3g = "SELECT sum(onem_QPP) AS tot_onem_QPP FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3g = $bd ->query($req3g);

	          if ($res3g ->num_rows > 0) {
	            while ($row = $res3g ->fetch_assoc()) {
	             	$tot_onem = $row['tot_onem_QPP'];
	             	$tot_onem_cdf = $tot_onem * $taux;
	           	}
	          }
	          $req3h = "SELECT sum(fisctot) AS tot_fisctot FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3h = $bd->query($req3h);

	          if ($res3h ->num_rows > 0) {
	            while ($row = $res3h ->fetch_assoc()) {
	             	$tot_fisctot_usd = $row['tot_fisctot'];
	             	$tot_fisctot_cdf = $tot_fisctot_usd * $taux;
	            }
	          }

	          echo'<tr>
	             		<td colspan="2" style="font-weight:bold;font-size:18px">Total</td>
	             		<td style="font-weight:bold">'.number_format($tot_baseimpot_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_cnss_QPO_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_cnss_QPP_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_cnss_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_iprtot_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_ier_QPP_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_inpp_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_onem_cdf,2).'</td>
	             		<td style="font-weight:bold">'.number_format($tot_fisctot_cdf,2).'</td>
	             	</tr>';
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
	    //filtrage 
    }
  }
  else{

  }
}
//Fin Affichage Recap_fiscalites_

//Affichage Listing-paie-comptes
function listing_paie_comptes(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['departem'])) {
        if (empty($_GET['periode'])) {
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE societe = '$societe' AND statut ='en cours' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	              	$netp_usd = $row['netp_usd'];

	                echo'<tr>
	                			<td>'.$row['id'].'</td>
			                  <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                    	<td>'.$row['banque'].'</td>
			                  <td>'.$row['no_banque'].'</td>
			                  <td style="text-align:right!important">'.$row['netp_usd'].'</td>
			                  <td></td>
	                    </tr>';
	              }
	              $req2 ="SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res2 = $bd->query($req2);

	              if ($res2 ->num_rows > 0) {
	              	while ($row = $res2->fetch_assoc()) {
	              		$netp_usd = $row['tot_netp_usd'];
	              	}
	              }

	              echo'<tr>
	              			<td colspan="4" style="font-weight:bold;font-size:17px">TOTAL</td>
	              			<td style="font-weight:bold;font-size:15px;text-align:right!important">'.number_format($netp_usd,2).'</td>
	                  </tr>';
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
	        //filtrage par periode
	        $periode = $_GET['periode'];
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE menspay LIKE '%$periode%' AND societe ='$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		              echo'<tr>
	                			<td>'.$row['id'].'</td>
			                  <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                    	<td>'.$row['banque'].'</td>
			                  <td>'.$row['no_banque'].'</td>
			                  <td style="text-align:right!important">'.$row['netp_usd'].'</td>
			                  <td></td>
	                    </tr>';
	              }
	              $req2 ="SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res2 = $bd->query($req2);

	              if ($res2 ->num_rows > 0) {
	              	while ($row = $res2->fetch_assoc()) {
	              		$netp_usd = $row['tot_netp_usd'];
	              	}
	              }

	              echo'<tr>
	              			<td colspan="4" style="font-weight:bold;font-size:17px">TOTAL</td>
	              			<td style="font-weight:bold;font-size:15px;text-align:right!important">'.number_format($netp_usd,2).'</td>
	              		</tr>';
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
	        //filtrage par periode
	     	}    
      }
      else{
        //filtrage par departement
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
	          $req2 = "SELECT * FROM tab_payfiche WHERE departement LIKE '%$departem%' AND societe ='$societe' ORDER BY nom_complet ASC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>
	                		<td>'.$row['id'].'</td>
			                <td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	                   	<td>'.$row['banque'].'</td>
			                <td>'.$row['no_banque'].'</td>
			                <td style="text-align:right!important">'.$row['netp_usd'].'</td>
			                <td></td>
	                  </tr>';
	            }
	            $req2 ="SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res2 = $bd->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while ($row = $res2->fetch_assoc()) {
	             		$netp_usd = $row['tot_netp_usd'];
	              }
	            }

	            echo'<tr>
	              		<td colspan="4" style="font-weight:bold;font-size:17px">TOTAL</td>
	              		<td style="font-weight:bold;font-size:15px;text-align:right!important">'.number_format($netp_usd,2).'</td>
	              	</tr>';
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
	      //filtrage par departement
     	}
    }
    else{
      //filtrage par agent
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
	      	$req2 = "SELECT * FROM tab_payfiche WHERE nom_complet LIKE '%$nom_agent%' AND societe ='$societe' ORDER BY nom_complet ASC";
		    	$res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		         	echo'<tr>
	             			<td>'.$row['id'].'</td>
			            	<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>
	               		<td>'.$row['banque'].'</td>
			            	<td>'.$row['no_banque'].'</td>
			            	<td style="text-align:right!important">'.$row['netp_usd'].'</td>
			            	<td></td>
	                </tr>';
	          }
	          $req2 ="SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res2 = $bd->query($req2);

	          if ($res2 ->num_rows > 0) {
	            while ($row = $res2->fetch_assoc()) {
	            	$netp_usd = $row['tot_netp_usd'];
	            }
	          }

	          echo'<tr>
	              	<td colspan="4" style="font-weight:bold;font-size:17px">TOTAL</td>
	              	<td style="font-weight:bold;font-size:15px;text-align:right!important">'.number_format($netp_usd,2).'</td>
	             	</tr>';
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
	    //filtrage par agent
    }
  }
  else{

  }
}
//Fin Affichage Listing-paie-comptes

//Affichage Listing-paie-comptes
function fiscanex(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['departem'])) {
        if (empty($_GET['periode'])) {
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE societe = '$societe' AND statut ='en cours' ORDER BY nom_complet ASC";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	              	$id          = $row['id'];
	              	$nom_complet = $row['nom_complet'];
	              	$totsalb2    = $row['totsalb2'];
	              	$logmt       = $row['logmt'];
	              	$transp      = $row['transp'];
	              	$alfam       = $row['alfam'];
	              	$primtot     = $row['primtot'];
	              	$brutot2     = $row['brutot2'];
	              	$baseImp_usd = $row['baseImp_usd'];
	              	$qpo_tot     = $row['qpo_tot'];
	              	$tot_advanc  = $row['tot_advanc'];
	              	$netp_usd    = $row['netp_usd'];

	                echo'<tr>
	                			<td>'.$id.'</td>
			                  <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
	                    	<td>'.number_format($totsalb2,2).'</td>
			                  <td>'.number_format($logmt,2).'</td>
			                  <td>'.number_format($transp,2).'</td>
			                  <td>'.number_format($alfam,2).'</td>
			                  <td>'.number_format($primtot,2).'</td>
			                  <td>'.number_format($brutot2,2).'</td>
			                  <td>'.number_format($baseImp_usd,2).'</td>
			                  <td>'.number_format($qpo_tot,2).'</td>
			                  <td>'.number_format($tot_advanc,2).'</td>
			                  <td>'.number_format($netp_usd,2).'</td>
			                  <td></td>
	                    </tr>';
	              }
	              $req3 = "SELECT sum(totsalb2) AS totsalb2_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$totsalb2 = $row['totsalb2_usd'];
	              	}
	              }
	              $req3 = "SELECT sum(logmt) AS tot_logmt FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	             	if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$logmt = $row['tot_logmt'];
	              	}
	             	}
	             	$req3 = "SELECT sum(transp) AS tot_transp FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	             	$res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	             		while ($row = $res3 ->fetch_assoc()) {
	             			$transp = $row['tot_transp'];
	             		}
	              }
	              $req3 = "SELECT sum(alfam) AS tot_alfam FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$alfam = $row['tot_alfam'];
	              	}
	              }
	              $req3 = "SELECT sum(primtot) AS tot_primtot FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$primtot = $row['tot_primtot'];
	              	}
	              }
	              $req3 = "SELECT sum(brutot2) AS tot_brutot2 FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$brutot2 = $row['tot_brutot2'];
	              	}
	              }
	              $req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$baseImp_usd = $row['tot_baseImp_usd'];
	              	}
	              }
	              $req3 = "SELECT sum(qpo_tot) AS tot_qpo_tot FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0 ) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$qpo_tot = $row['tot_qpo_tot'];
	              	}
	              }
	              $req3 = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$tot_advanc = $row['tot_advanc_usd'];
	              	}
	              }
	              $req3 = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND statut ='en cours'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$netp_usd = $row['tot_netp_usd'];
	              	}
	              }
	              
	              echo'<tr>
	              			<td colspan="2" style="font-weight:bold;font-size:17px">TOTAL</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($totsalb2,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($logmt,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($transp,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($alfam,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($primtot,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($brutot2,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($baseImp_usd,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($qpo_tot,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($tot_advanc,2).'</td>
	              			<td style="font-weight:bold;font-size:15px;">'.number_format($netp_usd,2).'</td>
	                  </tr>';
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
	        //filtrage par periode
	        $periode = $_GET['periode'];
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
	            $req2 = "SELECT * FROM tab_payfiche WHERE menspay LIKE '%$periode%' AND societe ='$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		              $id          = $row['id'];
	              	$nom_complet = $row['nom_complet'];
	              	$totsalb2    = $row['totsalb2'];
	              	$logmt       = $row['logmt'];
	              	$transp      = $row['transp'];
	              	$alfam       = $row['alfam'];
	              	$primtot     = $row['primtot'];
	              	$brutot2     = $row['brutot2'];
	              	$baseImp_usd = $row['baseImp_usd'];
	              	$qpo_tot     = $row['qpo_tot'];
	              	$tot_advanc  = $row['tot_advanc'];
	              	$netp_usd    = $row['netp_usd'];

	               	echo'<tr>
	                			<td>'.$id.'</td>
			                  <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
	                    	<td>'.number_format($totsalb2,2).'</td>
			                  <td>'.number_format($logmt,2).'</td>
			                  <td>'.number_format($transp,2).'</td>
			                  <td>'.number_format($alfam,2).'</td>
			                  <td>'.number_format($primtot,2).'</td>
			                  <td>'.number_format($brutot2,2).'</td>
			                  <td>'.number_format($baseImp_usd,2).'</td>
			                  <td>'.number_format($qpo_tot,2).'</td>
			                  <td>'.number_format($tot_advanc,2).'</td>
			                  <td>'.number_format($netp_usd,2).'</td>
			                  <td></td>
	                    </tr>';
	              }
	              $req3 = "SELECT sum(totsalb2) AS totsalb2_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$totsalb2 = $row['totsalb2_usd'];
	              	}
	              }
	              $req3 = "SELECT sum(logmt) AS tot_logmt FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$logmt = $row['tot_logmt'];
	              	}
	              }
	              $req3 = "SELECT sum(transp) AS tot_transp FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	             		while ($row = $res3 ->fetch_assoc()) {
	             			$transp = $row['tot_transp'];
	             		}
	              }
	              $req3 = "SELECT sum(alfam) AS tot_alfam FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$alfam = $row['tot_alfam'];
	              	}
	              }
	              $req3 = "SELECT sum(primtot) AS tot_primtot FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$primtot = $row['tot_primtot'];
	              	}
	              }
	              $req3 = "SELECT sum(brutot2) AS tot_brutot2 FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	             	$res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$brutot2 = $row['tot_brutot2'];
	              	}
	              }
	              $req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$baseImp_usd = $row['tot_baseImp_usd'];
	              	}
	              }
	              $req3 = "SELECT sum(qpo_tot) AS tot_qpo_tot FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0 ) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$qpo_tot = $row['tot_qpo_tot'];
	              	}
	              }
	              $req3 = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$tot_advanc = $row['tot_advanc_usd'];
	              	}
	              }
	              $req3 = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND menspay ='$periode'";
	              $res3 = $bd->query($req3);

	              if ($res3 ->num_rows > 0) {
	              	while ($row = $res3 ->fetch_assoc()) {
	              		$netp_usd = $row['tot_netp_usd'];
	              	}
	              }
	              
	              echo'<tr>
		              		<td colspan="2" style="font-weight:bold;font-size:17px">TOTAL</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($totsalb2,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($logmt,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($transp,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($alfam,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($primtot,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($brutot2,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($baseImp_usd,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($qpo_tot,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($tot_advanc,2).'</td>
		              		<td style="font-weight:bold;font-size:15px;">'.number_format($netp_usd,2).'</td>
	                  </tr>';
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
	       	//filtrage par periode
	      }    
      }
      else{
        //filtrage par departement
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
	          $req2 = "SELECT * FROM tab_payfiche WHERE departement LIKE '%$departem%' AND societe ='$societe' ORDER BY nom_complet ASC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            $id          = $row['id'];
	              $nom_complet = $row['nom_complet'];
	              $totsalb2    = $row['totsalb2'];
	              $logmt       = $row['logmt'];
	              $transp      = $row['transp'];
	              $alfam       = $row['alfam'];
	              $primtot     = $row['primtot'];
	              $brutot2     = $row['brutot2'];
	              $baseImp_usd = $row['baseImp_usd'];
	              $qpo_tot     = $row['qpo_tot'];
	              $tot_advanc  = $row['tot_advanc'];
	              $netp_usd    = $row['netp_usd'];

	              echo'<tr>
	                		<td>'.$id.'</td>
			                <td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
	                   	<td>'.number_format($totsalb2,2).'</td>
			                <td>'.number_format($logmt,2).'</td>
			               	<td>'.number_format($transp,2).'</td>
			                <td>'.number_format($alfam,2).'</td>
			                <td>'.number_format($primtot,2).'</td>
			                <td>'.number_format($brutot2,2).'</td>
			                <td>'.number_format($baseImp_usd,2).'</td>
			                <td>'.number_format($qpo_tot,2).'</td>
			                <td>'.number_format($tot_advanc,2).'</td>
			                <td>'.number_format($netp_usd,2).'</td>
			                <td></td>
	                  </tr>';
	            }
	            $req3 = "SELECT sum(totsalb2) AS totsalb2_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'"; 
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	             	while ($row = $res3 ->fetch_assoc()) {
	             		$totsalb2 = $row['totsalb2_usd'];
	             	}
	            }
	            $req3 = "SELECT sum(logmt) AS tot_logmt FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$logmt = $row['tot_logmt'];
	              }
	            }
	            $req3 = "SELECT sum(transp) AS tot_transp FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	             	while ($row = $res3 ->fetch_assoc()) {
	             		$transp = $row['tot_transp'];
	             	}
	            }
	            $req3 = "SELECT sum(alfam) AS tot_alfam FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$alfam = $row['tot_alfam'];
	              }
	            }
	            $req3 = "SELECT sum(primtot) AS tot_primtot FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$primtot = $row['tot_primtot'];
	              }
	            }
	            $req3 = "SELECT sum(brutot2) AS tot_brutot2 FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$brutot2 = $row['tot_brutot2'];
	              }
	            }
	            $req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$baseImp_usd = $row['tot_baseImp_usd'];
	              }
	            }
	            $req3 = "SELECT sum(qpo_tot) AS tot_qpo_tot FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0 ) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$qpo_tot = $row['tot_qpo_tot'];
	              }
	            }
	            $req3 = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$tot_advanc = $row['tot_advanc_usd'];
	              }
	            }
	            $req3 = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND departement ='$departem'";
	            $res3 = $bd->query($req3);

	            if ($res3 ->num_rows > 0) {
	              while ($row = $res3 ->fetch_assoc()) {
	              	$netp_usd = $row['tot_netp_usd'];
	              }
	            }
	              
	            echo'<tr>
		              	<td colspan="2" style="font-weight:bold;font-size:17px">TOTAL</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($totsalb2,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($logmt,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($transp,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($alfam,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($primtot,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($brutot2,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($baseImp_usd,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($qpo_tot,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($tot_advanc,2).'</td>
		              	<td style="font-weight:bold;font-size:15px;">'.number_format($netp_usd,2).'</td>
	                </tr>';
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
	      //filtrage par departement
      }
    }
    else{
     	//filtrage par Agent
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
	        $req2 = "SELECT * FROM tab_payfiche WHERE nom_complet LIKE '%$nom_agent%' AND societe ='$societe' ORDER BY nom_complet ASC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          $id          = $row['id'];
	            $nom_complet = $row['nom_complet'];
	            $totsalb2    = $row['totsalb2'];
	            $logmt       = $row['logmt'];
	            $transp      = $row['transp'];
	            $alfam       = $row['alfam'];
	            $primtot     = $row['primtot'];
	            $brutot2     = $row['brutot2'];
	            $baseImp_usd = $row['baseImp_usd'];
	            $qpo_tot     = $row['qpo_tot'];
	            $tot_advanc  = $row['tot_advanc'];
	            $netp_usd    = $row['netp_usd'];

	            echo'<tr>
	                	<td>'.$id.'</td>
			            	<td style="text-transform:uppercase!important;text-align:left!important">'.$nom_complet.'</td>
	                	<td>'.number_format($totsalb2,2).'</td>
			            	<td>'.number_format($logmt,2).'</td>
			            	<td>'.number_format($transp,2).'</td>
			            	<td>'.number_format($alfam,2).'</td>
			            	<td>'.number_format($primtot,2).'</td>
			            	<td>'.number_format($brutot2,2).'</td>
			            	<td>'.number_format($baseImp_usd,2).'</td>
			            	<td>'.number_format($qpo_tot,2).'</td>
			            	<td>'.number_format($tot_advanc,2).'</td>
			            	<td>'.number_format($netp_usd,2).'</td>
			            	<td></td>
	              	</tr>';
	          }
	          $req3 = "SELECT sum(totsalb2) AS totsalb2_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'"; 
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	             	$totsalb2 = $row['totsalb2_usd'];
	           	}
	          }
	          $req3 = "SELECT sum(logmt) AS tot_logmt FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	            	$logmt = $row['tot_logmt'];
	            }
	          }
	          $req3 = "SELECT sum(transp) AS tot_transp FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	             	$transp = $row['tot_transp'];
	            }
	          }
	          $req3 = "SELECT sum(alfam) AS tot_alfam FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $alfam = $row['tot_alfam'];
	            }
	          }
	          $req3 = "SELECT sum(primtot) AS tot_primtot FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $primtot = $row['tot_primtot'];
	            }
	          }
	          $req3 = "SELECT sum(brutot2) AS tot_brutot2 FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $brutot2 = $row['tot_brutot2'];
	            }
	          }
	          $req3 = "SELECT sum(baseImp_usd) AS tot_baseImp_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $baseImp_usd = $row['tot_baseImp_usd'];
	            }
	          }
	          $req3 = "SELECT sum(qpo_tot) AS tot_qpo_tot FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0 ) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $qpo_tot = $row['tot_qpo_tot'];
	            }
	          }
	          $req3 = "SELECT sum(tot_advanc) AS tot_advanc_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $tot_advanc = $row['tot_advanc_usd'];
	            }
	          }
	          $req3 = "SELECT sum(netp_usd) AS tot_netp_usd FROM tab_payfiche WHERE societe ='$societe' AND nom_complet ='$nom_agent'";
	          $res3 = $bd->query($req3);

	          if ($res3 ->num_rows > 0) {
	            while ($row = $res3 ->fetch_assoc()) {
	              $netp_usd = $row['tot_netp_usd'];
	            }
	          }
	              
	          echo'<tr>
		              <td colspan="2" style="font-weight:bold;font-size:17px">TOTAL</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($totsalb2,2).'</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($logmt,2).'</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($transp,2).'</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($alfam,2).'</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($primtot,2).'</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($brutot2,2).'</td>
		              <td style="font-weight:bold;font-size:15px;">'.number_format($baseImp_usd,2).'</td>
		             	<td style="font-weight:bold;font-size:15px;">'.number_format($qpo_tot,2).'</td>
		             	<td style="font-weight:bold;font-size:15px;">'.number_format($tot_advanc,2).'</td>
		             	<td style="font-weight:bold;font-size:15px;">'.number_format($netp_usd,2).'</td>
	              </tr>';
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
	      //filtrage par Agent	
    }
  }
  else{

  }
}
//Fin Affichage Listing-paie-comptes

//Affichage listes decompte impression fichie de paie
function liste_impresspaie(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['service'])) {
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

	            $req2 = "SELECT * FROM percompsup_tb WHERE societe = '$societe' AND statut ='fin' ORDER BY nom_complet ASC";
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
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="impssn_fichpaie.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        $departem = $_GET['departement'];
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

	            $req2 = "SELECT * FROM percompsup_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
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
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="impssn_fichpaie.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	                    $req2 = "SELECT * FROM percompsup_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
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
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="impssn_fichpaie.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	          		$req2 = "SELECT * FROM percompsup_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
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
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="impssn_fichpaie.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
//Fin Affichage listes fiche paie

//Compteur Base complementaire
function compteur_impressfipaie(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
                $req = "SELECT * FROM percompsup_tb WHERE customer = '".$_SESSION['pseudo']."'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i></i></h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i></i></h4>';
                }
            }
            else{
                $comptes_perpoint = $_GET['compte'];
                $req = "SELECT * FROM percompsup_tb WHERE compte ='$comptes_perpoint'";
                $resultats = $bd ->query($req);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                        echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
                    }
                }
                else{
                    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
                }
            }
        }
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}
//Fin Compteur Base complementaire

//Afficher le bouton fiche de paie decompte
function link_decpaie(){
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
	      $codepaie = $_GET['compte'];
	      $req = "SELECT * FROM percompsup_tb WHERE statut ='fin' AND compte = '$codepaie'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $num_reference= $row['compte'];
	          echo '<a href="decptpayfiche.php?compte='.$num_reference.'" target="_blank" class="btn btn-success" style="background-color:#045712"><i class=""></i> Fiche de paie</a>'; 
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
//Fin Afficher le bouton fiche de paie decompte

//Fiche de paie decompte
function decptfichepaie(){
  	if (isset($_SESSION['pseudo'])) {
    	include("connexion.php");
    	if ($bd -> connect_error) {
      	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    	}
    	else{// fin base de données
      	$admin = $_SESSION['pseudo'];
      	$params = 1;
      	$statut_fin = "fin";
      	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      	$resultats = $bd ->query($requete);

     		if ($resultats ->num_rows > 0) {// verification du compte administratif
        		while($row = $resultats ->fetch_assoc()){
          		$code_admin = $row['code_admin'];
          		$societe = $row['societe'];    
        		}
	      	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	      	$res1 = $bd ->query($req1);

	      	if ($res1 ->num_rows > 0) {// verification de droit administratif
	        		if (empty($_GET['compte'])) {
	          		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
	        		}
	        		else{
	          		$ref_compte = $_GET['compte'];
	          		$req = "SELECT * FROM percompsup_tb WHERE societe = '$societe' AND compte = '$ref_compte' AND statut = '$statut_fin'";
						$resultats = $bd ->query($req);

						if ($resultats ->num_rows > 0) {
							while($row = $resultats ->fetch_assoc()){
								$nom_complet = $row['nom_complet'];
								$fonction    = $row['fonction'];
								$depart      = $row['departement'];
								$jrpreste    = $row['jrpreste'];
								$tauxch      = $row['tauxch'];
								$hrprestee   = $row['hrpreste'];
								$saljrn      = $row['saljrn'];
								$saljourn    = $row['saljourn'];
								$netpay_usd  = $row['netpay_usd'];
								$salhs       = $row['salhs'];
								$tnuit       = $row['tnuit'];
								$tprim       = $row['tprim'];
							}
							//Convertir le monnaie
							$saljournCDF = $saljourn*$tauxch;
							$netpay_CDF  = $netpay_usd*$tauxch;
							$salhs_CDF   = $salhs*$tauxch;
							$tnuit_CDF   = $tnuit*$tauxch;
							$tprim_CDF   = $tprim*$tauxch;

							$ver = "SELECT * FROM percompf1_tb WHERE societe ='$societe' AND compte ='$ref_compte' AND statut ='fin'";
							$var = $bd ->query($ver);

							if ($var ->num_rows > 0) {
								while ($row = $var ->fetch_assoc()) {
									$classe = $row['classe'];
									$date   = $row['date_debut'];
								}
								//recuperation information eleve
								echo '<div class="col-12">
	                            <h6 style="padding: 5px">Nom de la societe : '.$societe.'</h6>
	                            <p style="text-align: center;font-weight: bold;text-decoration: underline;">FICHE PAIE  COMPLEMENTAIRE </p>
	                            <div class="row" style="padding: 9px">
	                              <table>
	                                <thead>
	                                </thead>
	                                <tbody>
	                                  <tr>
	                                    <td class="corp-table">Noms </td>
	                                    <td class="corp-table">: '.$nom_complet.'</td>
	                                  </tr>
	                                  <tr>
	                                    <td class="corp-table">Fonction </td>
	                                    <td class="corp-table">: '.$fonction.'</td>
	                                  </tr>
	                                  <tr>
	                                    <td class="corp-table">Classification </td>
	                                    <td class="corp-table">: '.$classe.'</td>
	                                  </tr>
	                                  <tr>
	                                    <td class="corp-table">Departement </td>
	                                    <td class="corp-table">: '.$depart.'</td>
	                                  </tr>
	                                  <tr>
	                                    <td class="corp-table">Date d\'entrée </td>
	                                    <td class="corp-table">: '.$date.'</td>
	                                  </tr>
	                                </tbody>
	                              </table>
	                            </div><br>
	                            <div class="row w-100" style="padding: 9px">
	                              <div class="">
	                                <table class="table1" id="table-r">
	                                  <thead>
	                                    <tr>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Prestation</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Jours</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Taux</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Total</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center;">Devise</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Journalier</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">'.$jrpreste.'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($saljournCDF,2).'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Heures_supplem</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">'.$hrprestee.'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($salhs_CDF,2).'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;">Prime_nuit</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($tnuit_CDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;">Autres_primes</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($tprim_CDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;">NET A PAYER</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($netpay_CDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                  </tbody>
	                                </table>
	                              </div>
	                            </div>
	                            <p style="padding: 2px">Direction Ressources Humaines, </p>
	                            <p>Pour acquis, </p>
	                          </div>';
							}
							else {
								echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucunne information trouvée sur decompte".'</div>';
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
//Fin fiche de paie decompte

//Affichage listes decompte impression fichie de paie 1
function liste_payfiche(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['service'])) {
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

	            $req2 = "SELECT * FROM percompf1_tb WHERE societe = '$societe' AND statut ='fin' ORDER BY nom_complet ASC";
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
			                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="payfiche.php?compte='.$row['compte'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	        $departem = $_GET['departement'];
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

	            $req2 = "SELECT * FROM percompf1_tb WHERE departement LIKE '%$departem%' AND societe = '$societe' ORDER BY nom_complet ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		           	while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
			                	'<td>'.$row['id'].'</td>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                    	'<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="payfiche.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	                    $req2 = "SELECT * FROM percompf1_tb WHERE service LIKE '%$service%' AND societe = '$societe' ORDER BY nom_complet ASC";
		              	$res2 = $bd ->query($req2);

		                if ($res2 ->num_rows > 0) {
		                  	while($row = $res2 ->fetch_assoc()){
		                    	echo'<tr>'.
			                            '<td>'.$row['id'].'</td>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                    	'<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="payfiche.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
	          		$req2 = "SELECT * FROM percompf1_tb WHERE nom_complet LIKE '%$nom_agent%' AND societe = '$societe' ORDER BY nom_complet ASC";
		         	$res2 = $bd ->query($req2);

		          	if ($res2 ->num_rows > 0) {
		             	while($row = $res2 ->fetch_assoc()){
		                   	echo'<tr>'.
			                        '<td>'.$row['id'].'</td>'.
			                  '<td style="text-transform:uppercase!important;text-align:left!important">'.$row['nom_complet'].'</td>'.
			                  '<td>'.$row['num_compte'].'</td>'.
	                    	'<td>'.$row['departement'].'</td>'.
			                  '<td>'.$row['fonction'].'</td>'.
			                  '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="payfiche.php?codepaie='.$row['codepaie'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
//Fin Affichage listes fiche paie decompte 1

//Compteur Base complementaire
function compteur_payfiche(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
                $req = "SELECT * FROM percompf1_tb WHERE customer = '".$_SESSION['pseudo']."'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i></i></h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i></i></h4>';
                }
            }
            else{
                $comptes_perpoint = $_GET['compte'];
                $req = "SELECT * FROM percompf1_tb WHERE compte ='$comptes_perpoint'";
                $resultats = $bd ->query($req);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                        echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['nom_complet'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
                    }
                }
                else{
                    echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fas fa-user"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
                }
            }
        }
    }
    else{
        echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
    }
}
//Fin Compteur Base complementaire

//Afficher le bouton fiche de paie decompte
function link_payfiche(){
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
	      $codepaie = $_GET['compte'];
	      $req = "SELECT * FROM percompf1_tb WHERE statut ='fin' AND compte = '$codepaie'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $num_reference= $row['compte'];
	          echo '<a href="payfichedecpt.php?compte='.$num_reference.'" target="_blank" class="btn btn-success" style="background-color:#045712"><i class=""></i> Fiche de paie decompte</a>'; 
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
//Fin Afficher le bouton fiche de paie decompte

//Fiche de paie
function fichepaie1(){
  	if (isset($_SESSION['pseudo'])) {
    	include("connexion.php");
    	if ($bd -> connect_error) {
      	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
   	}
    	else{// fin base de données
      	$admin = $_SESSION['pseudo'];
      	$params = 1;
      	$statut_fin = "fin";
      	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
      	$resultats = $bd ->query($requete);

      	if ($resultats ->num_rows > 0) {// verification du compte administratif
        		while($row = $resultats ->fetch_assoc()){
          		$code_admin = $row['code_admin'];
          		$societe = $row['societe'];    
        		}
	      	$req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
	      	$res1 = $bd ->query($req1);

	      	if ($res1 ->num_rows > 0) {// verification de droit administratif
	        		if (empty($_GET['compte'])) {
	          		echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Parametre introuvable".'</div>';
	        		}
	        		else{
		          	$num_compte = $_GET['compte'];
		          	$req = "SELECT * FROM percompf1_tb WHERE societe ='$societe' AND compte ='$num_compte' AND statut ='$statut_fin'";
						$resultats = $bd ->query($req);

						if ($resultats ->num_rows > 0) {
							while($row = $resultats ->fetch_assoc()){
								$nom      = $row['nom_complet'];
								$fonction = $row['fonction'];
								$classe   = $row['classe'];
								$depart   = $row['departement'];
								$date_d   = $row['date_debut'];
								$date_s   = $row['date_sortie'];
								$ancien   = $row['ancien'];
								$motif    = $row['motif'];
								$jrprestes = $row['jrprestes'];
								$saljrn    = $row['saljrn'];
								$Jrcona    = $row['Jrcona'];
								$transj    = $row['transj'];
								$prestJrn   = $row['prestJrn'];
								$indprim    = $row['indprim'];
								$tauxch     = $row['tauxch'];
								$totjpreav  = $row['totjpreav'];
								$jrcocomp   = $row['jrcocomp'];
								$salanc     = $row['salanc'];
								$jrcopreav  = $row['jrcopreav'];
								$prestransp = $row['prestransp'];
								$prestot    = $row['prestot'];
								$preavsal   = $row['preavsal'];
								$jrcopreav  = $row['jrcopreav'];
								$preaconge  = $row['preaconge'];
								$njcona     = $row['njcona'];
								$preavitot  = $row['preavitot'];
								$indcona    = $row['indcona'];
								$indcocomp  = $row['indcocomp'];
								$Indcotot   = $row['Indcotot'];
								$gratis     = $row['gratis'];
								$Jrtot      = $row['Jrtot'];
								$annuite    = $row['annuite'];
								$indlog     = $row['indlog'];
								$jrfin      = $row['jrfin'];
								$indfin     = $row['indfin'];
								$primdiv    = $row['primdiv'];
								$inddivtot  = $row['inddivtot'];
								$brutot     = $row['brutot'];
								$brutimpo   = $row['brutimpo'];
							}
							//Convertir le monnaie en CDf
							$prestJrnCDF = $prestJrn * $tauxch;
							$logement    = $saljrn * 0.3;
							$PrestranspCDF = $prestransp * $tauxch;
							$IndprimCDf = $indprim * $tauxch;
							$PrestotCDF = $prestot * $tauxch;
							$PreavsalCDF = $preavsal * $tauxch;
							$PreacongeCDf = $preaconge * $tauxch;
							$PreavitotCDF =  $preavitot * $tauxch;
							$IndconaCDF = $indcona * $tauxch;
							$IndcocompCDF = $indcocomp * $tauxch;
							$IndcototCDF = $Indcotot * $tauxch;
							$GratisCDF = $gratis * $tauxch;
							$IndlogCDF = $indlog * $tauxch;
							$indfinCDF = $indfin * $tauxch;
							$primdivCDF = $primdiv * $tauxch;
							$inddivtotCDF = $inddivtot * $tauxch;
							$brutotCDF = $brutot * $tauxch;
							$brutimpoCDF = $brutimpo * $tauxch;
							

							//recuperation information eleve
							$req2 = "SELECT * FROM percompf2_tb WHERE societe ='$societe' AND compte ='$num_compte' AND statut ='fin'";
							$res2 = $bd ->query($req2);

							if ($res2 ->num_rows > 0) {
								while ($row2 = $res2 ->fetch_assoc()) {
									$cnss_qpo = $row2['cnss_qpo'];
									$ipr_qpo  = $row2['ipr_qpo'];
									$retenues = $row2['retenues'];
									$totretenues = $row2['totretenues'];
									$net_pay_usd = $row2['net_pay_usd'];
								}
								//Convertir le monnaie en CDf
								$cnss_CDF = $cnss_qpo * $tauxch;
								$IPR_CDF  = $ipr_qpo * $tauxch;
								$retenuesCDF = $retenues * $tauxch;
								$totretenuesCDF = $totretenues * $tauxch;
								$net_pay_CDF = $net_pay_usd * $tauxch;
								
								echo '<div class="col-12" style="width: 100%">
	                            	<h6 style="padding: 5px">Nom de la societe : '.$societe.'</h6>
	                            	<p style="text-align: center;font-weight: bold;text-decoration: underline;">DECOMPTE FINAL </p>
	                            	<div class="row" style="padding: 9px">
	                              	<table>
		                                	<thead>
		                                  	<th></th>
		                                  	<th></th>
		                                  	<th></th>
		                                  	<th></th>
		                                  	<th></th>
		                                	</thead>
	                                	<tbody>
	                                 <div class="">
	                                    <tr>
	                                      <td class="corp-table">Noms </td>
	                                      <td class="corp-table">: '.$nom.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Fonction </td>
	                                      <td class="corp-table">: '.$fonction.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Classification </td>
	                                      <td class="corp-table">: '.$classe.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Departement </td>
	                                      <td class="corp-table">: '.$depart.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Date d\'entrée </td>
	                                      <td class="corp-table">: '.$date_d.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Date de sortie </td>
	                                      <td class="corp-table">: '.$date_s.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Ancienneté </td>
	                                      <td class="corp-table">: '.$ancien.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Motif </td>
	                                      <td class="corp-table">: '.$motif.'</td>
	                                    </tr>
	                                  </div>
	                                </tbody>
	                                <tbody style="border-top: 2px solid #000;">
	                                  <div class="">
	                                    <tr><td></td></tr>
	                                    <tr>
	                                      <td class="corp-table">Jours prestés </td>
	                                      <td class="corp-table">: '.$jrprestes.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Taux journalier</td>
	                                      <td class="corp-table">: '.$saljrn.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Jours de préavis </td>
	                                      <td class="corp-table">: '.$totjpreav.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td lass="corp-table">Taux de logement journalier</td>
	                                      <td class="corp-table">: '.$logement.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Jours de congé annuel </td>
	                                      <td class="corp-table">: '.$Jrcona.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Taux de transport journalier</td>
	                                      <td class="corp-table">: '.$transj.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Jours de congé compensatoire </td>
	                                      <td class="corp-table">: '.$jrcocomp.'</td>
	                                      <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	                                      <td class="corp-table">Taux d\'anciennete / jour</td>
	                                      <td class="corp-table">: '.$salanc.'</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table">Jours de congé sur préavis </td>
	                                      <td class="corp-table">: '.$jrcopreav.'</td>
	                                    </tr>
	                                  </div>
	                                </tbody>
	                              </table>
	                            </div><br>
	                            <div class="row w-100" style="padding: 9px">
	                              <div class="">
	                                <table class="table1" id="table-r" style="width: 750px">
	                                  <thead>
	                                    <tr>
	                                      <th class="tete-table line"></th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Jours</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Taux</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center">Total</th>
	                                      <th class="tete-table th" style="border: 1px solid #000;text-align:center;">Devise</th>
	                                    </tr>
	                                  </thead>
	                                  <tbody>
	                                    <tr>
	                                      <td colspan="5" class="corp-table line" style="border: 1px solid #000;">Prestations</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Salaire journalier</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">'.$jrprestes.'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($prestJrnCDF,2).'</td>
	                                      <td class="corp-table" style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Indemnités de transport </td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$jrprestes.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$transj.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($PrestranspCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;">Indemnites primes</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($IndprimCDf,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: center;padding: 2px;font-size: 17px">Total</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($PrestotCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="5" class="corp-table line" style="border: 1px solid #000;">Préavis</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Salaire jours de préavis</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$totjpreav.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($PreavsalCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Salaire jours de congé sur préavis</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$jrcopreav.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.$PreacongeCDf.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: center;padding: 2px;font-size: 17px">Total</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($PreavitotCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="5" class="corp-table line" style="border: 1px solid #000;">Indemnités de congé</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Salaire jours de congé annuel</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$njcona.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($IndconaCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Indemnités compensatoire de congé</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$jrcocomp.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($IndcocompCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: center;padding: 2px;font-size: 17px">Total</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($IndcototCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="5" class="corp-table line" style="border: 1px solid #000;">Indemnites diverses</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;">Gratification</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($GratisCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Annuité</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$Jrtot.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$salanc.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.$annuite.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Indemnités de logement</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$Jrtot.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($IndlogCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td class="corp-table line" style="border: 1px solid #000;">Indemnites de fin de service</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$jrfin.'</td>
	                                      <td style="border: 1px solid #000;text-align:center">'.$saljrn.'</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($indfinCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;">Autres primes</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($primdivCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: center;padding: 2px;font-size: 17px">Total</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($inddivtotCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">Total brut</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($brutotCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">Brut imposable</td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($brutimpoCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">CNSS </td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($cnss_CDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">IPR </td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($IPR_CDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">Autres retenues </td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($retenuesCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">Total retenues </td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($totretenuesCDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                    <tr>
	                                      <td colspan="3" class="corp-table line" style="border: 1px solid #000;font-weight: bold;text-align: left;padding: 2px;font-size: 14px">NET A PAYER </td>
	                                      <td style="border: 1px solid #000;text-align:right;font-weight:bold">'.number_format($net_pay_CDF,2).'</td>
	                                      <td style="border: 1px solid #000;text-align:center">CDF</td>
	                                    </tr>
	                                  </tbody>
	                                </table>
	                              </div>
	                            </div>
	                            <p style="">Direction Ressources Humaines, </p>
	                            <span>Pour acquis,</span>
	                          </div>';
								
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
//Fin fiche de paie




?>