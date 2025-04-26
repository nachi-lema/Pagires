<?php 
//Afficher le nom d'entreprise
function affiche_societe(){
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
            echo'<a href="dashboard.php"><span class="logo-name">'.$row2['societe'].'</span></a>';                     
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

//Avatar Logo societe
function affiche_logo_soc(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{
      $user = $_SESSION['pseudo'];
      $check = "SELECT * FROM admin_tb WHERE pseudo ='$user'";
      $res = $bd ->query($check);

      if ($res ->num_rows > 0) {
        while($row = $res ->fetch_assoc()){
          echo '<img src="'.$row['avatar'].'" class="img-fluid img-thumbnail header-logo" style="border-radius: 50%!important;" />';                     
        }  
      }
      else{
        echo '<img src="assets/img/logo_mankay.png" class="img-fluid img-thumbnail" style="border-radius: 50%!important;" />';
      }
    }
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible" role="alert" id="erreur">'."connexion perdue".'</div>';
  }
  //Logo societe
}

//Afficher le nom d'entreprise
function affiche_societe1(){
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
            echo'<span class="logo-name">'.$row2['societe'].'</span>';                     
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

//Afficher le nom Utilisateur
function affiche_profil1(){
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
                        echo'<span class="logo-name">'.$row2['pseudo'].'</span>';                     
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
//fin Afficher le nom Utilisateur

function liste_user(){
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if (empty($_GET['pseudo'])) {
            if (empty($_GET['ad_mail'])) {
                $admin = $_SESSION['pseudo'];
                $statut = "master";
                $req = "SELECT * FROM  admin_tb WHERE pseudo='$admin' AND statut='$statut'";
                $res = $bd ->query($req);

                if ($res ->num_rows > 0) {
                    $requete = "SELECT * FROM admin_tb WHERE params ='1' ORDER BY id DESC";
                    $resultats = $bd ->query($requete);

                    if ($resultats ->num_rows > 0) {
                        while($row = $resultats ->fetch_assoc()){
                        echo 
                            '<tr>'.
                                '<td class="corp-table">'.$row['code_admin'].'</td>'.
                                '<td class="corp-table">'.$row['societe'].'</td>'.
                                '<td class="corp-table">'.$row['proville'].'</td>'.
                                '<td class="corp-table">'.$row['pseudo'].'</td>'.
                                '<td class="corp-table">'.$row['admin_mail'].'</td>'.
                                '<td class="corp-table">'.$row['telephone'].'</td>'.
                                '<td class="corp-table">'.$row['date_crea'].'</td>'.
                                '<td class="corp-table">'.$row['droit'].'</td>'.
                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="admin.php?code_admin='.$row['code_admin'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
                            '</tr>';
                        }
                    }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucune information trouvée'.'</div>';
                    }
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.
                            'violation d\'accès administratif.'.'</div>';
                }
            }
            else{
                $admin = $_SESSION['pseudo'];
                $statut = "master";
                $req = "SELECT * FROM  admin_tb WHERE pseudo='$admin' AND statut='$statut'";
                $res = $bd ->query($req);

                if ($res ->num_rows > 0) {
                    $ad_mail=$_GET['ad_mail'];
                    $requete = "SELECT * FROM admin_tb WHERE admin_mail LIKE '%$ad_mail%' AND  params ='1' ORDER BY id DESC";
                    $resultats = $bd ->query($requete);

                    if ($resultats ->num_rows > 0) {
                        while($row = $resultats ->fetch_assoc()){
                        echo 
                            '<tr>'.
                                '<td class="corp-table">'.$row['code_admin'].'</td>'.
                                '<td class="corp-table">'.$row['societe'].'</td>'.
                                '<td class="corp-table">'.$row['proville'].'</td>'.
                                '<td class="corp-table">'.$row['pseudo'].'</td>'.
                                '<td class="corp-table">'.$row['admin_mail'].'</td>'.
                                '<td class="corp-table">'.$row['telephone'].'</td>'.
                                '<td class="corp-table">'.$row['date_crea'].'</td>'.
                                '<td class="corp-table">'.$row['droit'].'</td>'.
                                '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="admin.php?code_admin='.$row['code_admin'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
                            '</tr>';
                        }
                    }
                    else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucune information trouvée'.'</div>';
                    }
                }
                else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.
                        'violation d\'accès administratif.'.'</div>';
                }
            }
        }
        else{
            $admin = $_SESSION['pseudo'];
            $statut = "master";
            $req = "SELECT * FROM  admin_tb WHERE pseudo='$admin' AND statut='$statut'";
            $res = $bd ->query($req);

            if ($res ->num_rows > 0) {
                $nom_admin=$_GET['pseudo'];
                $requete = "SELECT * FROM admin_tb WHERE pseudo LIKE '%$nom_admin%' AND  params ='1' ORDER BY id DESC";
                $resultats = $bd ->query($requete);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                    echo 
                        '<tr>'.
                            '<td class="corp-table">'.$row['code_admin'].'</td>'.
                            '<td class="corp-table">'.$row['societe'].'</td>'.
                            '<td class="corp-table">'.$row['proville'].'</td>'.
                            '<td class="corp-table">'.$row['pseudo'].'</td>'.
                            '<td class="corp-table">'.$row['admin_mail'].'</td>'.
                            '<td class="corp-table">'.$row['telephone'].'</td>'.
                            '<td class="corp-table">'.$row['date_crea'].'</td>'.
                            '<td class="corp-table">'.$row['droit'].'</td>'.
                            '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="admin.php?code_admin='.$row['code_admin'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
                        '</tr>';
                    }
                }
                else{
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucune information trouvée'.'</div>';
                }
            }
            else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.
                        'violation d\'accès administratif.'.'</div>';
            } 

        }												
    }
    else{
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.
                '<span aria-hidden="true" data-dismiss="alert" aria-label="close" style="color:white!important;float:right!important">'.'&times;'.'</span>'.
                '<strong style="color:white!important;text-align:center!important;margin:0 auto!important;padding:none!important;">'.'Desolé!'.'</strong>'.'&nbsp;'."connexion echouée". 
             '</div>';                   
    }
}

function compteur_admin() {
    if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['code_admin'])) {
                $req = "SELECT * FROM admin_tb WHERE params = 1";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Utilisateurs'.'</h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Utilisateur'.'</h4>';
                }
            }
            else{
                $code_admin = $_GET['code_admin'];
                $req = "SELECT * FROM admin_tb WHERE code_admin = '$code_admin'";
                $resultats = $bd ->query($req);

                if ($resultats ->num_rows > 0) {
                    while($row = $resultats ->fetch_assoc()){
                        echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['pseudo'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
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

function liste_userGlo(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['pseudo'])) {
      if (empty($_GET['ad_mail'])) {
        $admin = $_SESSION['pseudo'];
        $statut = "Actif";
        $req = "SELECT * FROM  admin_tb WHERE pseudo='$admin'";
        $res = $bd ->query($req);

        if ($res ->num_rows > 0) {
          while($row = $res ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];    
          }
          $requete = "SELECT * FROM admin_tb WHERE statut ='Actif'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              echo'<tr>'.
                    '<td class="corp-table">'.$row['code_admin'].'</td>'.
                    '<td class="corp-table">'.$row['pseudo'].'</td>'.
                    '<td class="corp-table">'.$row['admin_mail'].'</td>'.
                    '<td class="corp-table">'.$row['telephone'].'</td>'.
                    '<td class="corp-table">'.$row['date_crea'].'</td>'.
                    '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="user_societe.php?code_admin='.$row['code_admin'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
                  '</tr>';
            }
          }
          else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucune information trouvée'.'</div>';
          }
        }
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'violation d\'accès administratif.'.'</div>';
        }
      }
      else{
        //Filtrage 
      }
    }
    else{
      //Filtrage
    }                                               
  }
  else{
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.
          '<span aria-hidden="true" data-dismiss="alert" aria-label="close" style="color:white!important;float:right!important">'.'&times;'.'</span>'.
          '<strong style="color:white!important;text-align:center!important;margin:0 auto!important;padding:none!important;">'.'Desolé!'.'</strong>'.'&nbsp;'."connexion echouée". 
        '</div>';                   
  }
}

function liste_user2(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['pseudo'])) {
      if (empty($_GET['societe'])) {
        $admin = $_SESSION['pseudo'];
        $statut = "Actif";
        $req = "SELECT * FROM admin_tb WHERE pseudo='$admin'";
        $res = $bd ->query($req);

        if ($res ->num_rows > 0) {
          while($row = $res ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $requete = "SELECT * FROM admin_tb WHERE societe='$societe' except(SELECT * FROM admin_tb where statut='master')";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              echo'<tr>'.
                    '<td class="corp-table">'.$row['societe'].'</td>'.
                    '<td class="corp-table">'.$row['pseudo'].'</td>'.
                    '<td class="corp-table">'.$row['admin_mail'].'</td>'.
                    '<td class="corp-table">'.$row['telephone'].'</td>'.
                    '<td class="corp-table">'.$row['date_crea'].'</td>'.
                    '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="user_societe.php?code_admin='.$row['code_admin'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
                  '</tr>';
            }
          }
          else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucune information trouvée'.'</div>';
          }
        }
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'violation d\'accès administratif.'.'</div>';
        }
      }
      else{
        //Filtrage
        $ESE = $_GET['societe'];
	      $params = 1;
	      $admin = $_SESSION['pseudo'];
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd ->query($requete);

	      if ($resultats ->num_rows > 0) {
	        while($row = $resultats ->fetch_assoc()){
	          $code_admin = $row['code_admin']; 
	        }
	        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	        $res1 = $bd ->query($req1);

	        if ($res1 ->num_rows > 0) {
	          $req2 = "SELECT * FROM admin_tb WHERE societe LIKE '%$ESE%' AND statut ='Actif'";
		        $res2 = $bd ->query($req2);

		        if ($res2 ->num_rows > 0) {
		          while($row = $res2 ->fetch_assoc()){
		            echo'<tr>'.
			                '<td class="corp-table">'.$row['societe'].'</td>'.
                      '<td class="corp-table">'.$row['pseudo'].'</td>'.
                      '<td class="corp-table">'.$row['admin_mail'].'</td>'.
                      '<td class="corp-table">'.$row['telephone'].'</td>'.
                      '<td class="corp-table">'.$row['date_crea'].'</td>'.
                      '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="user_societe.php?code_admin='.$row['code_admin'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
      //Fin-filtra
      }
    }
    else{
      //Filtrage
      //Fin-filtrage
    }
  }
  else{
    echo'<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.
          '<span aria-hidden="true" data-dismiss="alert" aria-label="close" style="color:white!important;float:right!important">'.'&times;'.'</span>'.
          '<strong style="color:white!important;text-align:center!important;margin:0 auto!important;padding:none!important;">'.'Desolé!'.'</strong>'.'&nbsp;'."connexion echouée". 
        '</div>';
  }
}



function compteur_user() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{// fin base de données
      if (empty($_GET['code_admin'])) {
        $req = "SELECT * FROM admin_tb WHERE statut ='actif'";
        $resultats = $bd ->query($req);

        if ($resultats ->num_rows > 0) {
          while ($row = $resultats ->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM admin_tb WHERE societe='$societe'";
          $resultats = $bd->query($req);

          $nbr = mysqli_num_rows($resultats);
          if ($nbr > 1) {
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-users"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Utilisateurs'.'</h4>';
          }
          else{
            echo '<h4 class="compteur_admin">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Utilisateur'.'</h4>';
          }
        }
        else {
          # code...
        }
      }
      else{
        $code_admin = $_GET['code_admin'];
        $req = "SELECT * FROM admin_tb WHERE code_admin = '$code_admin'";
        $resultats = $bd ->query($req);

        if ($resultats ->num_rows > 0) {
          while($row = $resultats ->fetch_assoc()){
            echo '<h4 class="compteur_admin">'.'<span style="font-weight:bold!important">'.'<i class="fa fa-user"></i>'.'&nbsp;'.$row['pseudo'].'&nbsp;'.'</span>'.'est'.'&nbsp;'.'selectionné.'.'</h4>'; 
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

function update_admin(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['code_admin'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $code_admin= $_GET['code_admin'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req = "SELECT * FROM admin_tb WHERE code_admin ='$code_admin'";
        $resul = $bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100 p-2">'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">'.
                    '<label>'.'<i class="fa fa-user">'.'</i>'.'&nbsp;'.'Pseudo :'.'</label>'.
                    '<input type="text" name="pseudo" id="name_input3" class="form-control" value="'.$row['pseudo'].'" tabindex="10" maxlength="100" required onkeypress="verifierCaracteres3(event); return false;">'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">'.
                    '<label>'.'<i class="fa fa-envelope">'.'</i>'.'&nbsp;'.'Adresse mail :'.'</label>'.
                    '<input type="ad_mail" name="ad_mail" id="name_input4" class="form-control" value="'.$row['admin_mail'].'" placeholder="xxxxxxx@gmail.com" tabindex="110" maxlength="50" required onkeypress="verifierCaracteres3(event); return false;">'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">'.
                    '<label>'.'<i class="fa fa-unlock">'.'</i>'.'&nbsp;'.'Créer mot de passe :'.'</label>'.
                    '<input type="text" name="mot-pass" placeholder="15 caracteres maximum" class="form-control" tabindex="120" maxlength="15" required>'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">'.
                    '<label>'.'<i class="fa fa-unlock">'.'</i>'.'&nbsp;'.'Confirmer mot de passe :'.'</label>'.
                    '<input type="text" name="conf-mot-pass" placeholder="15 caracteres maximum" class="form-control" tabindex="130" maxlength="15" required>'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
                    '<label>'.'<i class="fa fa-phone">'.'</i>'.'&nbsp;'.'Telephone:'.'</label>'.
                    '<input type="tel" name="telephone" value="'.$row['telephone'].'" placeholder="+243XXXXXXXXX" maxlength="15" class="form-control" tabindex="160" required>'.
                  '</fieldset>'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
                    '<button type="submit" class="btn btn-warning mt-4" style="width:100%!important;display:block!important;background-color:dodgerblue;border:none!important;margin-top: 10px!important"  name="cmd_edituser" tabindex="170">'.'Modifier'.'</button>'.
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

//Affichage listes barème journalier
function liste_baremsal(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['nom_agent'])) {
      if (empty($_GET['service'])) {
        if (empty($_GET['departem'])) {
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
          $resultats = $bd ->query($requete);
          $jrs = 26;

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              $code_admin = $row['code_admin'];  
              $societe = $row['societe'];   
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd ->query($req1);

            if ($res1 ->num_rows > 0) {
              $req2 = "SELECT * FROM perbaremsal_tb WHERE societe = '$societe' ORDER BY id ASC";
              $res2 = $bd ->query($req2);

              if ($res2 ->num_rows > 0) {
                while($row = $res2 ->fetch_assoc()){
                  $Logem = $row['logmt'];
                  $C_log = number_format($Logem/$jrs,2);
                    
                  echo'<tr>'.
                        '<td>'.$row['id'].'</td>'.
                        '<td>'.$row['societe'].'</td>'.
                        '<td>'.$row['categ'].'</td>'.
                        '<td>'.$row['classe'].'</td>'.
                        '<td>'.$row['description'].'</td>'.
                        '<td>'.$row['tension'].'</td>'.
                        '<td>'.$row['salJourn'].'</td>'.
                        '<td>'.$C_log.'</td>'.
                        '<td>'.$row['tranp'].'</td>'.
                        '<td>'.$row['alFam'].'</td>'.
                        '<td>'.$row['indiv'].'</td>'.
                        '<td>'.$row['primanc_fix'].'</td>'.
                        '<td>'.$row['primres_fix'].'</td>'.
                        '<td>'.$row['primperf_fix'].'</td>'.
                        '<td>'.$row['date_crea'].'</td>'.
                        '<td style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="baremsal.php?ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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
//Fin Affichage listes de barème salarial

//Update Bareme salarial
function update_baremsalarial(){
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
        $req = "SELECT * FROM perbaremsal_tb WHERE id ='$Idpers'";
        $resul = $bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="classe">Classification :</label>
                    <select name="classe" id="classe" class="form-control" required tabindex="100">
                      <option value="'.$row['classe'].'">'.$row['classe'].'</option>
                    </select>
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="service">Categorie :</label>
                    <select name="categ" id="categ" class="form-control" required tabindex="100">
                      <option value="'.$row['categ'].'">'.$row['categ'].'</option>
                    </select>
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="fonction">Description :</label>
                    <select name="descript" id="descript" class="form-control" required tabindex="100">
                      <option value="'.$row['description'].'">'.$row['description'].'</option>
                    </select>
                  </fieldset>
                </div><br>
                <div class="row w-100">
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="tension">Tension : </label>
                    <input type="number" class="form-control" name="tension" value="'.$row['tension'].'">
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="saljourn">Salaire journalier :</label>
                    <input type="text" name="saljourn" class="form-control" value="'.$row['salJourn'].'">
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="tranp">Transport journalier :</label>
                    <input type="number" class="form-control" name="tranp" value="'.$row['tranp'].'">
                  </fieldset>
                </div><br>
                <div class="row w-100">
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="alFam">Taux_alfam :</label>
                    <input type="text" class="form-control" name="alFam" value="'.$row['alFam'].'">
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="indiv">Indem_jrn :</label>
                    <input type="text" name="indiv" class="form-control" value="'.$row['indiv'].'">
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="primanc_fix">Prime_ancienette :</label>
                    <input type="number" class="form-control" name="primanc_fix" value="'.$row['primanc_fix'].'">
                  </fieldset>
                </div><br>
                <div class="row w-100">
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="primres_fix">Prime_responsabilite :</label>
                    <input type="number" class="form-control" name="primres_fix" value="'.$row['primres_fix'].'">
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="primperf_fix">Prime_performance :</label>
                    <input type="number" name="primperf_fix" class="form-control" value="'.$row['primperf_fix'].'">
                  </fieldset>
                  <fieldset class="col-lg-4 col-md-4 col-sm-12">
                    <label class="control-label" for="direct">Direction :</label>
                    <select name="direct" id="direct" class="form-control">
                      <option value="'.$row['direction'].'">'.$row['direction'].'</option>
                      <option value="ADM">ADM</option>
                      <option value="OPS">OPS</option>
                      <option value="TECH">TECH</option>
                    </select>
                    <input type="hidden" name="taux_fisc" value="'.$row['taux_fisc'].'" class="form-control" required>
                  </fieldset>
                </div><br>
                <div class="row w-100">
                  <div class="col-sm-2 col-md-2"></div>
                  <div class="col-sm-6 col-md-6">
                    <button type="submit" name="Mj_barem" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Enregistrer</button>
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
//Fin Update Bareme salarial

//Compteur Barème salarial
function compteur_perbarem(){
  if (isset($_SESSION['pseudo'])) {
        include("connexion.php");
        if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{// fin base de données
            if (empty($_GET['compte'])) {
                $req = "SELECT * FROM perbaremsal_tb WHERE customer = '".$_SESSION['pseudo']."'";
                $resultats = $bd ->query($req);

                $nbr = mysqli_num_rows($resultats);
                if ($nbr > 1) {
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Barème salarials'.'</h4>';
                }
                else{
                    echo '<h4 class="compteur_admin">'.'<i class="fas fa-coins"></i>'.'&nbsp;'.$nbr.'&nbsp;'.'Barème salarial'.'</h4>';
                }
            }
            else{
                $comptes_beremj = $_GET['compte'];
                $req = "SELECT * FROM perbaremsal_tb WHERE compte ='$comptes_beremj'";
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
//Fin Compteur Barème salarial

//Afficher la liste de taux de change
function listingtaux() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats =$bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM tauxjr_tb WHERE societe ='$societe' AND statut ='en cours' ";
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
//FIN Afficher la liste de taux de change

//Afficher la liste Taux de change
function tauxchange(){
  if (isset($_SESSION['pseudo'])) {
		include("connexion.php");        
		if (empty($_GET['nom_eleve'])) {
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
	        $req2 = "SELECT * FROM tauxjr_tb WHERE societe ='$societe' ORDER BY id DESC";
	        $res2 = $bd ->query($req2);

	        if ($res2 ->num_rows > 0) {
	          while($row = $res2 ->fetch_assoc()){
	            echo'<tr>'.
			              '<td class="corp-table">'.$row['id'].'</td>'.
			              '<td class="corp-table">'.$row['date_crea'].'</td>'.
			              '<td class="corp-table">'.$row['devise'].'</td>'.
			              '<td class="corp-table">'.$row['taux'].'</td>'.
			              '<td class="corp-table">'.$row['statut'].'</td>'.
			              '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="tauxjr.php?ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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

	  }
  }
  else{

  }
}
//FIN Afficher la liste Taux de change

//Update Information Taux
function Inactive_taux(){
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
        $req ="SELECT * FROM tauxjr_tb WHERE id ='$ID_pers'";
        $resul =$bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
                    '<label class="control-label" for="nom_personnel">Nom complet : </label>'.
                    '<select class="form-control" name="maj_taux">'.
				              '<option value="'.$row['statut'].'">'.$row['statut'].'</option>'.
				              '<option value="Désactiver">Désactiver</option>'.
				              '<option value="en cours">en cours</option>'.
				            '</select>'.
                  '</fieldset>'.
                '</div><br>'.
                '<div class="row w-100">'.
				          '<div class="col-sm-12 col-md-12">'.
				            '<button type="submit" name="cmd_MajTaux" class="btn btn-warning mt-2 col-sm-12" tabindex="190">Accepter</button>'.
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
//Fin Update Information Taux

//fonction d'attire la liste personnel à la BDD
function liste_month(){
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
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM annee_tab";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	          echo '<option value="'.$row['mois_fr'].'">'.$row['mois_fr'].'</option>';
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

//Afficher la liste Periode de paye
function Listing_PeriodePaye(){
  if (isset($_SESSION['pseudo'])) {
		include("connexion.php");        
		if (empty($_GET['nom_eleve'])) {
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
	        $req2 = "SELECT * FROM periodepaye_tb WHERE societe ='$societe' ORDER BY id DESC";
	        $res2 = $bd ->query($req2);

	        if ($res2 ->num_rows > 0) {
	          while($row = $res2 ->fetch_assoc()){
	            echo'<tr>'.
			              '<td class="corp-table">'.$row['id'].'</td>'.
			              '<td class="corp-table">'.$row['jour'].'</td>'.
			              '<td class="corp-table">'.$row['mois'].'</td>'.
			              '<td class="corp-table">'.$row['annee'].'</td>'.
			              '<td class="corp-table">'.$row['statut'].'</td>'.
			              '<td class="corp-table">'.$row['date_crea'].'</td>'.
			              '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">'.'<a href="periodpay.php?ID='.$row['id'].'" class="selecteur" title="Cliquez pour selectionner" style="color:white">'.'select'.'</a>'.'</td>'.
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

	  }
  }
  else{

  }
}
//FIN Afficher la liste Periode de paye

//Afficher la liste de taux de change
function listingppeye() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats =$bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM periodepaye_tb WHERE societe ='$societe' AND statut ='en cours'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['jour'].'-'.$row['mois'].'-'.$row['annee'].'">'.$row['jour'].'-'.$row['mois'].'-'.$row['annee'].'</option>';
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
//FIN Afficher la liste de taux de change

//Afficher la liste de mois encours....
function listppeye_mois() {
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete ="SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats =$bd ->query($requete);

	  if ($resultats ->num_rows > 0) {
	    while($row = $resultats ->fetch_assoc()){
	      $code_admin = $row['code_admin'];
	      $societe = $row['societe'];     
	    }
	    $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
	    $res1 = $bd ->query($req1);

	    if ($res1 ->num_rows > 0) {
	      $req2 = "SELECT * FROM periodepaye_tb WHERE societe ='$societe' AND statut ='en cours'";
	      $res2 = $bd ->query($req2);

	      if ($res2 ->num_rows > 0) {
	        while($row = $res2 ->fetch_assoc()){
	        	echo '<option value="'.$row['mois'].'">'.$row['mois'].'</option>';
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
//FIN Afficher la liste de mois encours....

//Update Information Periode
function Desactiver_perd(){
  if (isset($_SESSION['pseudo'])){
    if (empty($_GET['ID'])) {
      echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
            '<strong>'.'Desolé!'.'</strong>'.'&nbsp;'.'Aucun parametre trouvé'.
            '<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.                            
          '</div>';
    }
    else{
      $ID_period= $_GET['ID'];
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $req ="SELECT * FROM periodepaye_tb WHERE id ='$ID_period'";
        $resul =$bd ->query($req);

        if ($resul ->num_rows > 0) {
          while ($row = $resul ->fetch_assoc()) {
            echo'<div class="row w-100">'.
                  '<fieldset class="col-lg-12 col-md-12 col-sm-12">'.
                    '<label class="control-label" for="nom_personnel">Nom complet : </label>'.
                    '<select class="form-control" name="maj_periodIA">'.
				              '<option value="'.$row['statut'].'">'.$row['statut'].'</option>'.
				              '<option value="Desactiver">Desactiver</option>'.
				              '<option value="en cours">en cours</option>'.
				            '</select>'.
                  '</fieldset>'.
                '</div><br>'.
                '<div class="row w-100">'.
				          '<div class="col-sm-12 col-md-12">'.
				            '<button type="submit" name="cmd_MajPeriod" class="btn btn-warning mt-2 col-sm-12" tabindex="190">Accepter</button>'.
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
//Fin Update Information Periode


?>