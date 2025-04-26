<?php

//Affichage liste stocks
function liste_stocks(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
      if (empty($_GET['article'])) {
        if (empty($_GET['categorie'])) {
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
	          	$req2 = "SELECT * FROM appro_stocks WHERE societe='$societe' AND statut ='Actif'";
	          	$res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td class="corp-table">'.$row['id'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['description'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['numero'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['Qte_stock'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['psunit'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pstotal'].'</td>'.
			                  '<td class="corp-table">'.$row['devise'].'</td>'.
			                  '<td class="corp-table">'.$row['date_crea'].'</td>'.
			                  '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_stock.php?ref_article='.$row['ref_article'].'&&Societe='.$row['societe'].'" class="selecteur text-white" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
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
          //filtrage par groupe de categorie
          $categorie = $_GET['categorie'];
	        $params = 1;
	        $admin = $_SESSION['pseudo'];
         	$requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
     			$resultats = $bd ->query($requete);

	     		if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	          	$code_admin = $row['code_admin'];
              $societe = $row['societe'];
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	            $req2 = "SELECT * FROM appro_stocks WHERE categorie LIKE '%$categorie%' AND societe='$societe' AND statut = 'Actif' ORDER BY article ASC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
                          '<td class="corp-table">'.$row['id'].'</td>'.
                          '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
                          '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
                          '<td class="corp-table" style="text-align:left!important">'.$row['description'].'</td>'.
                          '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
                          '<td class="corp-table" style="text-align:center">'.$row['numero'].'</td>'.
                          '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
                          '<td class="corp-table" style="text-align:center">'.$row['Qte_stock'].'</td>'.
                          '<td class="corp-table" style="text-align:center">'.$row['psunit'].'</td>'.
                          '<td class="corp-table" style="text-align:center">'.$row['pstotal'].'</td>'.
                          '<td class="corp-table">'.$row['devise'].'</td>'.
                          '<td class="corp-table">'.$row['date_crea'].'</td>'.
			                    '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="creat_stock.php?ref_article='.$row['ref_article'].'&&Societe='.$row['societe'].'" class="selecteur text-white" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
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
	        //filtrage par groupe de categorie
	    	}
    	}
      else{
        //filtrage par Article
	      
	    	//filtrage par Article
      }
   	}
    else{
      //filtrage par Date
	    
	    //filtrage par Date 
    }
 	}
  else{

  }
}
//Fin Affichage liste stocks

//Mise a jour stock
function update_stock(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['ref_article'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                    '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
                    '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
                '</div>';
    }
    else{
      $compte_artcle= $_GET['ref_article'];
      $id_societe = $_GET['Societe'];
      include("connexion.php");
      if ($bd -> connect_error) {
     		die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req = "SELECT * FROM appro_stocks WHERE ref_article ='$compte_artcle' AND societe='$id_societe'";
        $resul = $bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100 p-2">'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">'.
                    '<label>'.'Ref_article:'.'</label>'.
                    '<input type="text" name="compte_artcle" readonly="auto" class="form-control" value="'.$row['ref_article'].'" tabindex="10" required>'.
                  '</fieldset>'.
                '</div>'.
                '<div class="row w-100 p-2">'.
                  '<fieldset class="col-lg-5 col-md-5 col-sm-12 p-2 mb-2">'.
                    '<label>'.'<i class="">'.'</i>'.'&nbsp;'.'Categorie :'.'</label>'.
                    '<select name="categorie_stock" class="form-control" tabindex="" required>'.
                      '<option>'.$row['categorie'].'</option>'.
                      '<option value="Kitscolaire_maternelle">Kitscolaire_maternelle</option>'.
                      '<option value="Kitscolaire_primaire">Kitscolaire_primaire</option>'.
                      '<option value="Kitscolaire_secondaire">Kitscolaire_secondaire</option>'.
                      '<option value="Kitscolaire_mixte">Kitscolaire_mixte</option>'.
                      '<option value="Produits_alimentaires">Produits_alimentaires</option>'.
                      '<option value="Produits_labo">Produits_labo</option>'.
                      '<option value="Produits_pharmaceutiques">Produits_pharmaceutiques</option>'.
                      '<option value="Autres_fournitures_produits">Autres_fournitures_produits</option>'.
                    '<select>'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-5 col-md-5 col-sm-12 p-2 mb-2">'.
                    '<label>'.'Article :'.'</label>'.
                    '<input type="text" name="article" class="form-control" value="'.$row['article'].'" tabindex="10" required>'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-2 col-md-2 col-sm-12 p-2 mb-2">'.
					         	'<label class="control-label" for="">Numéro : </label>'.
	                	'<input type="text" value="'.$row['numero'].'" class="form-control" name="numero">'.
	                '</fieldset>'.
                '</div>'.
                '<div class="row w-100">'.
                  '<fieldset class="col-lg-3 col-md-3 col-sm-12">'.
                    '<label>'.'<i class="">'.'</i>'.'&nbsp;'.'Unite stock :'.'</label>'.
                    '<input type="text" name="unite" class="form-control" value="'.$row['unite_stock'].'" tabindex="110" maxlength="50" required >'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-3 col-md-3 col-sm-12">'.
					          '<label class="control-label" for="">Qte_stock : </label>'.
	                  '<input type="text" value="'.$row['Qte_stock'].'" class="form-control" name="quantite">'.
	                '</fieldset>'.
	                '<fieldset class="col-lg-3 col-md-3 col-sm-12">'.
					          '<label class="control-label" for="">Prix unitaire : </label>'.
	                  '<input type="text" value="'.$row['psunit'].'" class="form-control" name="punite">'.
	                '</fieldset>'.
                  '<fieldset class="col-lg-3 col-md-3 col-sm-12">'.
					          '<label class="control-label" for="">Index : </label>'.
	                  '<input type="text" value="'.$row['indexa'].'" class="form-control" name="indexa">'.
	                '</fieldset>'.
								'</div>'.
				        '<div class="row w-100">'.
				          '<fieldset class="col-lg-4 col-md-4 col-sm-12 p-2 mb-2">'.
                    '<label>'.'Devise :'.'</label>'.
                    '<select name="devise" class="form-control" tabindex="" required>'.
                      '<option>'.$row['devise'].'</option>'.
                      '<option value="USD">USD</option>'.
                      '<option value="CDF">CDF</option>'.
                    '<select>'.
                  '</fieldset>'. 
                  '<fieldset class="col-lg-4 col-md-4 col-sm-12 p-2 mb-2">'.
                    '<label>'.'Taux :'.'</label>'.
                    '<input type="text" value="'.$row['taux'].'" class="form-control" name="taux">'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-4 col-md-4 col-sm-12 p-2 mb-2">'.
	                  '<label class="control-label" for="email">Date_stock : </label>'.
                   	'<input type="date" value="'.$row['date_stock'].'" class="form-control" name="date_stock"  placeholder="Date stock">'.
                   	'<input type="hidden" name="statut_appro" value="Actif">'.
					      	'</fieldset>'.
               	'</div>'.
	              '<div class="row w-100 p-2">'.
	                '<fieldset class="col-lg-6 col-md-6 col-sm-12">'.
	                  '<button type="reset" class="btn btn-danger col-sm-4 mt-4" tabindex="170">'.'Annuler'.'</button>'.
	                '</fieldset>'.
	                '<fieldset class="col-lg-6 col-md-6 col-sm-12">'.
	                  '<button type="submit" class="btn btn-primary col-sm-4 mt-4" name="cmd_editstock" tabindex="170">'.'Modifier'.'</button>'.
	                '</fieldset>'.
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

//Afficher la liste de groupes classe dansle gombo
function liste_comboclasse(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
        $societe = $row['societe'];
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM combo_tb WHERE societe='$societe' AND statut = 'Actif'";
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
	    else{
	      echo '';
	    }
	  }
	  else{
	    echo '';
	  }
	}
}

//Affichage liste Achats stocks
function liste_achats(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['option_eleve'])) {
      if (empty($_GET['article'])) {
        if (empty($_GET['groupe'])) {
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
	            $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND statut ='Actif'";
	            $res2 = $bd ->query($req2);

	           	if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td class="corp-table">'.$row['id'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pa_total'].'</td>'.
			                  '<td class="corp-table">'.$row['devise'].'</td>'.
			                  '<td class="corp-table">'.$row['nom_fourn'].'</td>'.
			                  '<td class="corp-table">'.$row['tel_fourn'].'</td>'.
			                  '<td class="corp-table">'.$row['date_facture'].'</td>'.
			                  '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="gestn_achat.php?id='.$row['id'].'" class="selecteur text-white" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
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
	        $groupe = $_GET['groupe'];
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
	            $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND groupe LIKE '%$groupe%' AND statut = 'Actif' ORDER BY id DESC";
		          $res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
			                  '<td class="corp-table">'.$row['id'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pa_total'].'</td>'.
			                  '<td class="corp-table">'.$row['devise'].'</td>'.
			                  '<td class="corp-table">'.$row['nom_fourn'].'</td>'.
			                  '<td class="corp-table">'.$row['tel_fourn'].'</td>'.
			                  '<td class="corp-table">'.$row['date_facture'].'</td>'.
			                  '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="gestn_achat.php?ref_article='.$row['ref_article'].'" class="selecteur text-white" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
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
        //filtrage
        $admin = $_SESSION['pseudo'];
        $article = $_GET['article'];
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
	          $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND article LIKE '%$article%' AND statut ='Actif' ORDER BY id DESC";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>'.
			                '<td class="corp-table">'.$row['id'].'</td>'.
			                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['pa_total'].'</td>'.
			                '<td class="corp-table">'.$row['devise'].'</td>'.
			                '<td class="corp-table">'.$row['nom_fourn'].'</td>'.
			                '<td class="corp-table">'.$row['tel_fourn'].'</td>'.
			                '<td class="corp-table">'.$row['date_facture'].'</td>'.
			                '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="gestn_achat.php?ref_article='.$row['ref_article'].'" class="selecteur text-white" title="Cliquez pour selectionner">'.'select'.'</a>'.'</td>'.
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
	       //filtrage 
      }
    }
    else{
      //filtrage
                    	
	    //filtrage
    }
 	}
  else{

  }
}
//Fin_Affichage liste Achats stocks

function affichage_client(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ref_doc'])) {
	      $req = "SELECT * FROM appro_client_tb WHERE";
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
		    $ref_doc = $_GET['ref_doc'];
		    $req = "SELECT * FROM appro_client_tb WHERE ref_doc ='$ref_doc'";
		    $resultats = $bd ->query($req);

		    if ($resultats ->num_rows > 0) {
		      while($row = $resultats ->fetch_assoc()){

		        echo ' '.$row['nom_complet'].' '; 
		      }
		    }
		    else{
		      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		    }
	    }
    }
  }
  else{
    echo'<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}

function afficher_ref_doc(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ref_doc'])) {
	      $req = "SELECT * FROM appro_client_tb WHERE";
	      $resultats = $bd ->query($req);

   		}
	    else{
		    $ref_doc = $_GET['ref_doc'];
		    $req = "SELECT * FROM appro_client_tb WHERE ref_doc = '$ref_doc'";
		    $resultats = $bd ->query($req);

		    if ($resultats ->num_rows > 0) {
		      while($row = $resultats ->fetch_assoc()){

		        echo ' '.$row['ref_doc'].' '; 
		      }
		    }
		    else{
		      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		    }
	    }
    }
  }
  else{
    echo'<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}

function voir_refdoc(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ref_doc'])) {
	      $req = "SELECT * FROM appro_client_tb WHERE";
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
		    $ref_doc = $_GET['ref_doc'];
		    $req = "SELECT * FROM appro_client_tb WHERE ref_doc = '$ref_doc'";
		    $resultats = $bd ->query($req);

		    if ($resultats ->num_rows > 0) {
		      while($row = $resultats ->fetch_assoc()){
		        echo'<option value="'.$row['ref_doc'].'">'.$row['ref_doc'].'</option>';
		      }
		    }
		    else{
		      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		    }
	    }
    }
  }
  else{
    echo'<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}

//Afficher la nature d'achats
function voir_nature(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['nature']) && empty($_GET['ref_doc'])) {
	      $req = "SELECT * FROM appro_client_tb WHERE";
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
		    $status = $_GET['nature'];
        $ref_doc = $_GET['ref_doc'];
		    $req = "SELECT * FROM appro_client_tb WHERE ref_doc ='$ref_doc' AND nature='$status'";
		    $resultats = $bd ->query($req);

		    if ($resultats ->num_rows > 0) {
		      while($row = $resultats ->fetch_assoc()){
		        echo'<option value="'.$row['nature'].'">'.$row['nature'].'</option>';
		      }
		    }
		    else{
		      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		    }
	    }
    }
  }
  else{
    echo'<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}

//Afficher la date doc
function voir_datedoc(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['date_doc'])) {
	      $req = "SELECT * FROM appro_client_tb WHERE";
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
		    $date = $_GET['date_doc'];
		    $req = "SELECT * FROM appro_client_tb WHERE date_crea ='$date'";
		    $resultats = $bd ->query($req);

		    if ($resultats ->num_rows > 0) {
		      while($row = $resultats ->fetch_assoc()){
		        echo'<option value="'.$row['date_crea'].'">'.$row['date_crea'].'</option>';
		      }
		    }
		    else{
		      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		    }
	    }
    }
  }
  else{
    echo'<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}

//Afficher le noms
function voir_noms(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ghfhefg'])) {
	      $req = "SELECT * FROM appro_client_tb WHERE";
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
		    $nomclient = $_GET['ghfhefg'];
		    $req = "SELECT * FROM appro_client_tb WHERE nom_complet ='$nomclient'";
		    $resultats = $bd ->query($req);

		    if ($resultats ->num_rows > 0) {
		      while($row = $resultats ->fetch_assoc()){
		        echo'<option value="'.$row['nom_complet'].'">'.$row['nom_complet'].'</option>';
		      }
		    }
		    else{
		      echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
		    }
	    }
    }
  }
  else{
    echo'<ha class="compteur_admin" style="color:#ee2546!important">'.'Invalide.'.'</h4>';
  }
}

//fonction de calcule du facture
function voir_vente(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ref_doc'])) {
      	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun parametre trouvé".'</div>';           
      }
			else{
		   	$reference = $_GET['ref_doc'];
		   	$req = "SELECT * FROM appro_article_tb WHERE ref_doc ='$reference' AND statut ='en cours'";
		   	$resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $reference = $row['ref_doc'];

	          echo'<tr>'.
	                '<td style="border: 1px solid #000">'.$row['article'].'</td>'.
	                '<td style="border: 1px solid #000;text-align:right">'.$row['Qte'].'</td>'.
	                '<td style="border: 1px solid #000;text-align:right">'.$row['Pv_unite'].'</td>'.
	                '<td style="border: 1px solid #000;text-align:right">'.$row['Pv_total'].'</td>';
	        }
	        echo'<tr><td colspan="4"></td></tr>
	              <tr>
					  			<td align="center" colspan="3">TOTAL A PAYER : </td>';
									$req3 = "SELECT sum(Pv_total) AS total_Pv_total FROM appro_article_tb WHERE ref_doc = '$reference' AND statut = 'en cours'";
                  $res3 = $bd ->query($req3);

                  if ($res3 ->num_rows > 0 ) {
	                  while($row3 = $res3 ->fetch_assoc()){
	                    echo '<td style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row3['total_Pv_total'],2).' USD</strong>'.'</td>';
	                  }
	                }
	                else{

	                }
	        echo'</tr>';
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
//Fin_fonction de calcule du facture

function botton_print(){
	if (isset($_SESSION['pseudo'])) {
		include('connexion.php');
		if ($bd ->connect_error) {
			die('Impossible de se connecter à la BDD:'.$bd->connect_error);
		}
		else{
			if (empty($_GET['ref_doc'])) {
				$req ="SELECT * FROM appro_client_tb WHERE";
				$resultats =$bd->query($req);

			}
			else{
				$reference =$_GET['ref_doc'];
				$req ="SELECT * FROM appro_client_tb WHERE ref_doc ='$reference'";
				$res =$bd->query($req);

				if ($res ->num_rows > 0) {
					while ($row = $res ->fetch_assoc()) {
						$reference = $row['ref_doc'];

						echo'<button type="button" class="btn btn-primary mt-4 col-sm-4 col-md-4" tabindex="170">
                  <a href="../65058HGHHHggrt077prints/recu.php?ref_doc='.$reference.'" target="_blank" class="text-white"> Aperçu</a>
                </button>';
					}
				}
				else{
					echo '<ha class="compteur_admin" style="color:#ee2546!important">'.'<i class="fa fa-file"></i>'.'&nbsp;'.'Invalide.'.'</h4>';
				}
			}
		}
	}
	else{

	}
}

//Afficher les informations du compte selectionner
function vente_compte_header(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      $d_id=date("d-m-y");
      $h_id=date("h:i:s");
      $dat=$d_id." ".$h_id;

      if (empty($_GET['ref_doc'])) {
        echo'<div class="row col-lg-12 col-md-12 col-sm-12">
								<fieldset class="col-lg-6 col-md-6 col-sm-12">
									<h5 class="text-center" style="font-size: 14px">
									<b>M-SERVICES </h5><br>
									<h5 style="font-size: 13px;"><b>NOM : </b> </h5>
									<h5 style="font-size: 13px;">Classe : </h5>
								</fieldset>
								<fieldset class="col-lg-6 col-md-6 col-sm-12">
									<p>Date : </p>
								</fieldset><br><br>
								<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:21px">
									<h5 class="text-center" style="font-size: 14px;text-decoration:underline">
										<b>BON DE LIVRAISON N° </b>
									</h5>
								</div>
						</div><br>';           
      }
      else{
	      $reference = $_GET['ref_doc'];
	      $req = "SELECT * FROM appro_client_tb WHERE ref_doc ='$reference'";
	      $resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          echo'<div class="row w-100 col-lg-12 col-md-12 col-sm-12">
									<fieldset class="col-lg-6 col-md-6 col-sm-12">
										<h5 class="text-left" style="font-size: 14px">
										<b>M-SERVICES</h5>
									</fieldset>
									<fieldset class="col-lg-6 col-md-6 col-sm-12" style="width:300px">
										Date : '.$d_id.'
									</fieldset>
								</div>
								<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:21px">
									<h5 class="text-left" style="font-size: 13px;"><b>NOM : '.$row['nom_complet'].' </b> </h5>
								</div>   
								<div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:21px">
									<h5 class="text-center" style="font-size: 14px;text-decoration:underline">
										<b>BON DE LIVRAISON N° '.$row['id'].'</b>
									</h5>
								</div>';
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

//fonction de calcule du compte elève sur la table {compte_eleve, compta_eleve}
function extrait_vente(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
    	die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['ref_doc'])) {
      	echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun parametre trouvé".'</div>';           
      }
			else{
				$customer = $_SESSION['pseudo'];
		   	$reference = $_GET['ref_doc'];
		   	$req = "SELECT * FROM appro_article_tb WHERE ref_doc ='$reference' AND statut ='en cours'";
		   	$resultats = $bd ->query($req);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $reference =$row['ref_doc'];
	          echo'<tr>'.
	                '<td style="border: 1px solid #000">'.$row['ref_doc'].'</td>'.
	                '<td style="border: 1px solid #000">'.$row['article'].'</td>'.
	                '<td style="border: 1px solid #000">'.$row['unite_vente'].'</td>'.
	                '<td style="border: 1px solid #000;text-align:right">'.$row['Pv_unite'].'</td>'.
	                '<td style="border: 1px solid #000;text-align:right">'.$row['Qte'].'</td>'.
	                '<td style="border: 1px solid #000;text-align:right">'.$row['Pv_total'].'</td>';
	        }
	        echo '<tr><td colspan="6"></td></tr>
	              <tr>
					  			<td align="center" colspan="5">TOTAL A PAYER : </td>';
										$req3 = "SELECT sum(Pv_total) AS total_Pv_total FROM appro_article_tb WHERE ref_doc ='$reference' AND statut = 'en cours'";
                    $res3 = $bd ->query($req3);

                    if ($res3 ->num_rows > 0 ) {
	                  	while($row3 = $res3 ->fetch_assoc()){
	                    	echo '<td style="border: 1px solid #000;text-align:right">'.'<strong>'.number_format($row3['total_Pv_total'],2).' USD</strong>'.'</td>';
	                  	}
	                  }
	                  else{

	                  }
	         	echo'</tr>
	         			<tr><td colspan="6"></td></tr>
	         			<tr>
									<td colspan="2">PREPARE PAR  <br> '.$customer.'</td>
									<td colspan="2">LIVRE PAR <br><br></td>
									<td colspan="2">BENEFICIAIRE <br><br></td>
								</tr>';
	     		
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

//Affichage liste stocks
function impress_stocks(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
      if (empty($_GET['article'])) {
        if (empty($_GET['categorie'])) {
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
         	$resultats = $bd ->query($requete);

	        if ($resultats ->num_rows > 0) {
	          while($row = $resultats ->fetch_assoc()){
	            $code_admin = $row['code_admin'];
              $codsoc = $row['code_soc'];
              $societe = $row['societe'];
	          }
	          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	          $res1 = $bd ->query($req1);

	          if ($res1 ->num_rows > 0) {
	          	$req2 = "SELECT * FROM appro_stocks WHERE societe='$societe' AND statut ='Actif'";
	          	$res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo '<tr>'.
			                  '<td class="corp-table">'.$row['id'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['Qte_stock'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['psunit'].'</td>'.
			                  '<td class="corp-table" >'.$row['date_crea'].'</td>'.
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
	        //filtrage par groupe de categorie
	        $categorie = $_GET['categorie'];
	        $params = 1;
	        $admin = $_SESSION['pseudo'];
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

	          	$req2 = "SELECT * FROM appro_stocks WHERE societe='$societe' AND categorie LIKE '%$categorie%' AND statut = 'Actif' ORDER BY id DESC";
		      		$res2 = $bd ->query($req2);

		        	if ($res2 ->num_rows > 0) {
		          	while($row = $res2 ->fetch_assoc()){
		           		echo'<tr>'.
			                  '<td>'.$row['id'].'</td>'.
			                  '<td style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td style="text-align:center">'.$row['unite_stock'].'</td>'.
			                  '<td style="text-align:center">'.$row['Qte_stock'].'</td>'.
			                  '<td style="text-align:center">'.$row['psunit'].'</td>'.
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
	        //filtrage par groupe de categorie
	    	}    
    	}
      else{
        //filtrage par Article
	      $article = $_GET['article'];
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

	          $req2 = "SELECT * FROM appro_stocks WHERE societe='$societe' AND article LIKE '%$article%' AND statut = 'Actif' ORDER BY id DESC";
		      	$res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		           	echo'<tr>'.
			                '<td>'.$row['id'].'</td>'.
			                '<td style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                '<td style="text-align:left!important">'.$row['categorie'].'</td>'.
			                '<td style="text-align:left!important">'.$row['article'].'</td>'.
			                '<td style="text-align:center">'.$row['unite_stock'].'</td>'.
			                '<td style="text-align:center">'.$row['Qte_stock'].'</td>'.
			                '<td style="text-align:center">'.$row['psunit'].'</td>'.
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
	    	//filtrage par Article
      }
   	}
    else{
      //filtrage par Date
	    $Date_stock = $_GET['Date_stock'];
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

	        $req2 = "SELECT * FROM appro_stocks WHERE societe='$societe' AND date_crea LIKE '%$Date_stock%' AND statut = 'Actif' ORDER BY id DESC";
		     	$res2 = $bd ->query($req2);

		     	if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          echo'<tr>'.
			            	'<td>'.$row['id'].'</td>'.
			            	'<td style="text-align:left!important">'.$row['ref_article'].'</td>'.
			            	'<td style="text-align:left!important">'.$row['categorie'].'</td>'.
			            	'<td style="text-align:left!important">'.$row['article'].'</td>'.
			            	'<td style="text-align:center">'.$row['unite_stock'].'</td>'.
			            	'<td style="text-align:center">'.$row['Qte_stock'].'</td>'.
			            	'<td style="text-align:center">'.$row['psunit'].'</td>'.
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
	    //filtrage par Date 
    }
 	}
  else{

  }
}
//Fin Affichage liste stocks

//Affichage liste d'impression Achats stocks
function impress_achats(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
      if (empty($_GET['article'])) {
        if (empty($_GET['categorie'])) {
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

	            $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND statut ='Actif'";
	            $res2 = $bd ->query($req2);

	            if ($res2 ->num_rows > 0) {
	              while($row = $res2 ->fetch_assoc()){
	                echo'<tr>'.
			                  '<td class="corp-table">'.$row['id'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			                  '<td class="corp-table">'.$row['date_facture'].'</td>'.
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
	        //filtrage eleve par Categorie
	        $categorie = $_GET['categorie'];
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
	            $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND categorie LIKE '%$categorie%' AND statut ='Actif' ORDER BY id DESC";
		          $res2 = $bd ->query($req2);

		        	if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		              echo'<tr>'.
			                  '<td class="corp-table">'.$row['id'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                  '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			                  '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			                  '<td class="corp-table">'.$row['date_facture'].'</td>'.             	
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
	        //filtrage eleve par Categorie
	      }    
      }
      else{
        //filtrage eleve par Article
	      $article = $_GET['article'];
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
	          $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND article LIKE '%$article%' AND statut = 'Actif' ORDER BY id DESC";
		        $res2 = $bd ->query($req2);

		       	if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>'.
			                '<td class="corp-table">'.$row['id'].'</td>'.
			                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			                '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			                '<td class="corp-table">'.$row['date_facture'].'</td>'.
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
	      //filtrage eleve par Article 
      }
    }
    else{
    	//filtrage eleve par Date
	    $Date_stock = $_GET['Date_stock'];
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
	        $req2 = "SELECT * FROM appro_achats WHERE societe='$societe' AND date_facture LIKE '%$Date_stock%' AND statut = 'Actif' ORDER BY id DESC";
		      $res2 = $bd ->query($req2);

		      if ($res2 ->num_rows > 0) {
		        while($row = $res2 ->fetch_assoc()){
		          echo'<tr>'.
			              '<td class="corp-table">'.$row['id'].'</td>'.
			              '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
			              '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
			              '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
			              '<td class="corp-table" style="text-align:center">'.$row['unite_achat'].'</td>'.
			              '<td class="corp-table" style="text-align:center">'.$row['Qte_achat'].'</td>'.
			              '<td class="corp-table" style="text-align:center">'.$row['pa_unite'].'</td>'.
			              '<td class="corp-table">'.$row['date_facture'].'</td>'.             	
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
	    //filtrage eleve par Date
    }
  }
  else{

  }
}
//Fin_Affichage liste d'impression Achats stocks

//Affichage liste Achats stocks
function impress_vente(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
    	if (empty($_GET['article'])) {
	      if (empty($_GET['categorie'])) {
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

		         	$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND statut ='en cours' ORDER BY id DESC";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		             	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_doc'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		      //filtrage par Categorie
		      $categorie = $_GET['categorie'];
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

		          $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND categorie LIKE '%$categorie%' AND statut ='en cours'";
			     		$res2 = $bd ->query($req2);

			        if ($res2 ->num_rows > 0) {
			          while($row = $res2 ->fetch_assoc()){
			          	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_doc'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		       //filtrage par Categorie
		    }    
   		}
	    else{
	      	//filtrage par Article
	     	$admin = $_SESSION['pseudo'];
	     	$article = $_GET['article'];
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
		     		$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND article LIKE '%$article%' AND statut ='en cours'";
			   		$res2 = $bd ->query($req2);

			      if ($res2 ->num_rows > 0) {
			        while($row = $res2 ->fetch_assoc()){
			        	echo'<tr>'.
				             	'<td class="corp-table">'.$row['id'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['ref_doc'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				            	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				            	'<td class="corp-table">'.$row['date_facture'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		     //filtrage par Article
	    }
  	}
  	else {
	  	//filtrage par Date
		  $admin = $_SESSION['pseudo'];
		  $Date_stock = $_GET['Date_stock'];
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
			    $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND date_facture LIKE '%$Date_stock%' AND statut ='en cours'";
				  $res2 = $bd ->query($req2);

				  if ($res2 ->num_rows > 0) {
				    while($row = $res2 ->fetch_assoc()){
				      echo'<tr>'.
					          '<td class="corp-table">'.$row['id'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['ref_doc'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
					         	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
					        	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
					         	'<td class="corp-table">'.$row['date_facture'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
			//filtrage par Date
	  }
  } 
}

//Affichage liste vente cash
function lest_ventecash(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
    	if (empty($_GET['article'])) {
	      if (empty($_GET['categorie'])) {
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

		         	$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND statut ='en cours' AND nature='Cash' ORDER BY id DESC";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		             	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		      //filtrage par Categorie
		      $categorie = $_GET['categorie'];
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

		          $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND categorie LIKE '%$categorie%' AND statut ='en cours' AND nature='Cash'";
			     		$res2 = $bd ->query($req2);

			        if ($res2 ->num_rows > 0) {
			          while($row = $res2 ->fetch_assoc()){
			          	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		       //filtrage par Categorie
		    }    
   		}
	    else{
	      	//filtrage par Article
	     	$admin = $_SESSION['pseudo'];
	     	$article = $_GET['article'];
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
		     		$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND article LIKE '%$article%' AND statut ='en cours' AND nature='Cash'";
			   		$res2 = $bd ->query($req2);

			      if ($res2 ->num_rows > 0) {
			        while($row = $res2 ->fetch_assoc()){
			        	echo'<tr>'.
				             	'<td class="corp-table">'.$row['id'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				            	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				            	'<td class="corp-table">'.$row['date_facture'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		     //filtrage par Article
	    }
  	}
  	else {
	  	//filtrage par Date
		  $admin = $_SESSION['pseudo'];
		  $Date_stock = $_GET['Date_stock'];
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
			    $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND date_facture LIKE '%$Date_stock%' AND statut ='en cours' AND nature='Cash'";
				  $res2 = $bd ->query($req2);

				  if ($res2 ->num_rows > 0) {
				    while($row = $res2 ->fetch_assoc()){
				      echo'<tr>'.
					          '<td class="corp-table">'.$row['id'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
					         	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
					        	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
					         	'<td class="corp-table">'.$row['date_facture'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
			//filtrage par Date
	  }
  } 
}
//Fin liste vente cash

//Affichage liste vente credit
function lest_ventecredit(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
    	if (empty($_GET['article'])) {
	      if (empty($_GET['categorie'])) {
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

		         	$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND statut ='en cours' AND nature='Credit' ORDER BY id DESC";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		             	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		      //filtrage par Categorie
		      $categorie = $_GET['categorie'];
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

		          $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND categorie LIKE '%$categorie%' AND statut ='en cours' AND nature='Credit'";
			     		$res2 = $bd ->query($req2);

			        if ($res2 ->num_rows > 0) {
			          while($row = $res2 ->fetch_assoc()){
			          	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		       //filtrage par Categorie
		    }    
   		}
	    else{
	      	//filtrage par Article
	     	$admin = $_SESSION['pseudo'];
	     	$article = $_GET['article'];
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
		     		$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND article LIKE '%$article%' AND statut ='en cours' AND nature='Credit'";
			   		$res2 = $bd ->query($req2);

			      if ($res2 ->num_rows > 0) {
			        while($row = $res2 ->fetch_assoc()){
			        	echo'<tr>'.
				             	'<td class="corp-table">'.$row['id'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				            	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				            	'<td class="corp-table">'.$row['date_facture'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		     //filtrage par Article
	    }
  	}
  	else {
	  	//filtrage par Date
		  $admin = $_SESSION['pseudo'];
		  $Date_stock = $_GET['Date_stock'];
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
			    $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND date_facture LIKE '%$Date_stock%' AND statut ='en cours' AND nature='Credit'";
				  $res2 = $bd ->query($req2);

				  if ($res2 ->num_rows > 0) {
				    while($row = $res2 ->fetch_assoc()){
				      echo'<tr>'.
					          '<td class="corp-table">'.$row['id'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
					         	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
					        	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
					         	'<td class="corp-table">'.$row['date_facture'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
			//filtrage par Date
	  }
  } 
}
//Fin liste vente credit


//Affichage liste vente livrable
function list_vente_livrable(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
    	if (empty($_GET['article'])) {
	      if (empty($_GET['categorie'])) {
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
		         	$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND statut ='en cours' AND status='livrable' ORDER BY noms DESC";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		             	echo'<tr>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['noms'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
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
		      //filtrage par Categorie
		      $categorie = $_GET['categorie'];
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

		          $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND categorie LIKE '%$categorie%' AND statut ='en cours' AND nature='Cash'";
			     		$res2 = $bd ->query($req2);

			        if ($res2 ->num_rows > 0) {
			          while($row = $res2 ->fetch_assoc()){
			          	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				                '<td class="corp-table">'.$row['date_facture'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		       //filtrage par Categorie
		    }    
   		}
	    else{
	      	//filtrage par Article
	     	$admin = $_SESSION['pseudo'];
	     	$article = $_GET['article'];
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
		     		$req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND article LIKE '%$article%' AND statut ='en cours' AND nature='Cash'";
			   		$res2 = $bd ->query($req2);

			      if ($res2 ->num_rows > 0) {
			        while($row = $res2 ->fetch_assoc()){
			        	echo'<tr>'.
				             	'<td class="corp-table">'.$row['id'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				             	'<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
				            	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
				            	'<td class="corp-table">'.$row['date_facture'].'</td>'.
				            	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
		     //filtrage par Article
	    }
  	}
  	else {
	  	//filtrage par Date
		  $admin = $_SESSION['pseudo'];
		  $Date_stock = $_GET['Date_stock'];
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
			    $req2 = "SELECT * FROM appro_article_tb WHERE societe='$societe' AND date_facture LIKE '%$Date_stock%' AND statut ='en cours' AND nature='Cash'";
				  $res2 = $bd ->query($req2);

				  if ($res2 ->num_rows > 0) {
				    while($row = $res2 ->fetch_assoc()){
				      echo'<tr>'.
					          '<td class="corp-table">'.$row['id'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['nature'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
					          '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.
					         	'<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['unite_vente'].'</td>'.
					        	'<td class="corp-table" style="text-align:center">'.$row['Qte'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_unite'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['Pv_total'].'</td>'.
					         	'<td class="corp-table">'.$row['date_facture'].'</td>'.
					         	'<td class="corp-table" style="text-align:center">'.$row['customer'].'</td>'.
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
			//filtrage par Date
	  }
  } 
}
//Fin liste vente livrable

//Affichage liste Achats stocks
function recapstockfinal(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['Date_stock'])) {
    	if (empty($_GET['article'])) {
	      if (empty($_GET['categorie'])) {
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

		         	$req2 = "SELECT * FROM appro_invent WHERE societe='$societe'";
		         	$res2 = $bd ->query($req2);

		          if ($res2 ->num_rows > 0) {
		            while($row = $res2 ->fetch_assoc()){
		             	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['description'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['qte_stock'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['qte_achat'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['qte_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['stock_fin'].'</td>'.
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
		      //filtrage par Categorie
		      $categorie = $_GET['categorie'];
		      $params = 1;
		      $admin = $_SESSION['pseudo'];
	        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
	        $resultats = $bd ->query($requete);

		     	if ($resultats ->num_rows > 0) {
		        while($row = $resultats ->fetch_assoc()){
		          $code_admin = $row['code_admin'];
              $societe= $row['societe'];
		        }
		        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
		        $res1 = $bd ->query($req1);

		        if ($res1 ->num_rows > 0) {

		          $req2 = "SELECT * FROM appro_invent WHERE societe='$societe' AND categorie LIKE '%$categorie%'";
			     		$res2 = $bd ->query($req2);

			        if ($res2 ->num_rows > 0) {
			          while($row = $res2 ->fetch_assoc()){
			          	echo'<tr>'.
				                '<td class="corp-table">'.$row['id'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				                '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				                '<td class="corp-table" style="text-align:left!important">'.$row['description'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['qte_stock'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['qte_achat'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['qte_vente'].'</td>'.
				                '<td class="corp-table" style="text-align:center">'.$row['stock_fin'].'</td>'.
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
		       //filtrage par Categorie
		    }    
   		}
	    else{
	      	//filtrage par Article
	     	$admin = $_SESSION['pseudo'];
	     	$article = $_GET['article'];
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
		     		$req2 = "SELECT * FROM appro_invent WHERE societe='$societe' AND article LIKE '%$article%'";
			   		$res2 = $bd ->query($req2);

			      if ($res2 ->num_rows > 0) {
			        while($row = $res2 ->fetch_assoc()){
			        	echo'<tr>'.
				             	'<td class="corp-table">'.$row['id'].'</td>'.
				              '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				              '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				              '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				              '<td class="corp-table" style="text-align:left!important">'.$row['description'].'</td>'.
				              '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
				              '<td class="corp-table" style="text-align:center">'.$row['qte_stock'].'</td>'.
				              '<td class="corp-table" style="text-align:center">'.$row['qte_achat'].'</td>'.
				              '<td class="corp-table" style="text-align:center">'.$row['qte_vente'].'</td>'.
				              '<td class="corp-table" style="text-align:center">'.$row['stock_fin'].'</td>'.
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
		     //filtrage par Article
	    }
  	}
  	else {
	  	//filtrage par Date
		  $admin = $_SESSION['pseudo'];
		  $Date_stock = $_GET['Date_stock'];
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
			    $req2 = "SELECT * FROM appro_invent WHERE societe='$societe' AND date_crea LIKE '%$Date_stock%'";
				  $res2 = $bd ->query($req2);

				  if ($res2 ->num_rows > 0) {
				    while($row = $res2 ->fetch_assoc()){
				      echo'<tr>'.
					          '<td class="corp-table">'.$row['id'].'</td>'.
				            '<td class="corp-table" style="text-align:left!important">'.$row['ref_article'].'</td>'.
				            '<td class="corp-table" style="text-align:left!important">'.$row['categorie'].'</td>'.		                        	
				            '<td class="corp-table" style="text-align:left!important">'.$row['article'].'</td>'.
				            '<td class="corp-table" style="text-align:left!important">'.$row['description'].'</td>'.
				            '<td class="corp-table" style="text-align:center">'.$row['unite_stock'].'</td>'.
				            '<td class="corp-table" style="text-align:center">'.$row['qte_stock'].'</td>'.
				            '<td class="corp-table" style="text-align:center">'.$row['qte_achat'].'</td>'.
				            '<td class="corp-table" style="text-align:center">'.$row['qte_vente'].'</td>'.
				            '<td class="corp-table" style="text-align:center">'.$row['stock_fin'].'</td>'.
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
			//filtrage par Date
	  }
  } 
}

