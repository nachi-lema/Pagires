<?php
//Check si tous les champs existent et ne sont pas vides
if(!function_exists('not_empty')) {
  function not_empty($fields = []){
    if(count($fields) != 0) {
      foreach($fields as $field) {
        if(empty($_POST[$field]) || trim($_POST[$field]) == "") {
          return false;
        }
      }
      return true;
    }
  }
}

//--------- function pour redirige vers la page index
if(!function_exists('redirect')) {
  function redirect ($page) {
    header('Location: ' .$page);
    exit();
  }
}

//Sanitizer
if(!function_exists('redirect_intent_or')){
  function redirect_intent_or($default_url){
    if($_SESSION['forwarding_url']){
      $url = $_SESSION['forwarding_url'];
      $_SESSION['forwarding_url'] = null;
    } else {
      $url = $default_url;
    }
    
    redirect($url);
  }
}

//Si le formulaire a été soumis
function login_user(){
  include("database.php");
  if(isset($_POST['login_admin'])) {

    //Si tous les champs ont été remplire
    if (not_empty(['pseudo', 'mod_pass'])) {

      extract($_POST);

      $q = $db->prepare("SELECT id, pseudo, code_admin, mot_pass AS hashed_password, admin_mail FROM admin_tb 
                         WHERE (pseudo = :pseudo) AND droit = '1'");

      $q->execute([
        'pseudo' => $pseudo
      ]);

      $user = $q->fetch(PDO::FETCH_OBJ);

      
      if($user && password_verify($mod_pass, $user->hashed_password)){
  
        $ip_user = $_SERVER['REMOTE_ADDR'];
        $_SESSION['user_id'] = $user->id;
        $_SESSION['pseudo'] = $user->pseudo;
        $_SESSION['admin_mail'] = $user->admin_mail;
        $_SESSION['code_admin'] = $user->code_admin;
  
        redirect_intent_or('main/dashboard.php');
         
        //$q = "INSERT INTO auth_tokens(num_compte, name, user_id, ip_user) VALUES ('".$_SESSION['code_admin']."', '".$_SESSION['pseudo']."', '".$_SESSION['user_id']."', '".$ip_user."')";
        //$res1 = $db ->query($q);
      }
      else{
        //echo "Combinaison identifiant/password incorrecte";
        echo '<div class="alert alert-danger alert-dismissible" role="alert" id="erreur">'."Nom d'utilisateur ou mot de passe invalide.".'<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.'</div>';
        //save_input_data();
      }      
    }
    else {
      echo "connexion echoue";
    }
  }
}

//login Administrateur
function login_admin(){
  if(isset($_POST["login_admin"])){
    include("connexion.php");
    if ($bd -> connect_error) {
      die('Impossible de se connecter à la BD:'.$bd ->connect_error);
    }
    else{
      //session_start();
      // on est connecté à  la base
      //recuperation des donnees sur le formulaire
      $d_id=date("d-m-y");
      $h_id=date("h:i:s");
      $dat=$d_id." ".$h_id;
      $pseudo = $bd->real_escape_string($_POST['pseudo']);
      $mop = $bd->real_escape_string(sha1($_POST['mod_pass']));
      $params = 1;
      $decon=0;
      $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']); 

      $check = "SELECT * FROM admin_tb WHERE pseudo ='$pseudo' AND mot_pass='$mop' AND params = 1 AND statut ='master'";
      $res = $bd ->query($check);
      $nbr = mysqli_num_rows($res);

      $res = $bd ->query($check) or die('Erreur'.$check.''.$bd->error());

      if ($res ->num_rows > 0) {
        while($row = $res ->fetch_assoc()){
          $_SESSION['pseudo'] = $row['pseudo'];
          $_SESSION['mop'] = $row['mot_pass'];
          $_SESSION['code_admin'] = $row['code_admin'];
        }
        header("location:/control/dash.php");
      }
      else{
        echo '<div class="alert alert-danger alert-dismissible" role="alert" id="erreur">'."Nom d'utilisateur ou mot de passe invalide.".'<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.'</div>';
      }
    }//fin base de données
    $bd->close();
  }
}
//fin login Administrateur

function new_droit(){ // debut creation 
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_droitAcces'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $code_admin = $_GET['code_admin'];
        $d_user = $bd->real_escape_string($_POST['droit_user']);
        $d_eleve = $bd->real_escape_string($_POST['droit_elev']);
        $d_fin = $bd->real_escape_string($_POST['droit_fin']);
        $statut = "master";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params=1;
                      
        $requete = "SELECT * FROM  admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows < 0) {
          while($row = $resultats ->fetch_assoc()){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration vous est permis'.'</div>'; 
          }
        }
        else{// code admin
          $requete = "SELECT * FROM  d_admin_tb WHERE code_admin='$code_admin'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'.'L\'Admin est déjà dans ses droits.'.'</div>'; 
            }
          }
          else{//verification code admin
            $sql = "INSERT INTO d_admin_tb (code_admin, droit_user,droit_inscription, droit_finance, date_crea, params, customer, ip_user) VALUES ('".$code_admin."', '".$d_user."', '".$d_eleve."', '".$d_fin."', '".$dat."', '".$params."', '".$_SESSION['pseudo']."', '".$ip_user."')";
            $sql2="UPDATE admin_tb SET droit=1 WHERE code_admin='$code_admin'";

            $sav = $bd->query($sql);
            $sav2 = $bd->query($sql2);

            if ($sav == true && $sav2 == true) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Droit(s) d\'administration accordé(s)'.'</div>';
            }
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Opération echouée'.'</div>';
            }
          }//verification code admin
        }// code admin                                                   
      }//fin base de données
      $bd->close();
    }
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Connexion perdue'.'</div>';
  }
} // fin creation 
//fin creation droit admin

//edition droit admin
function edit_droit(){ // debut creation
  if (isset($_SESSION['e_mail'])) {
    if (isset($_POST['cmd_edit_droit'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $admin = $_SESSION['e_mail'];
        $code_admin = $bd->real_escape_string($_POST['code_admin']);
        $organe = $bd->real_escape_string($_POST['organe']);
        $rapport_actu = $bd->real_escape_string($_POST['rapport_actu']);
        $rapport_old = $bd->real_escape_string($_POST['archive']);
        $mouv = $bd->real_escape_string($_POST['mouv']);
        $statut = "master";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params=1;
                      
        $requete = "SELECT * FROM  user_tb WHERE statut='$statut' AND ad_mail='".$_SESSION['e_mail']."'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows < 0) {
          while($row = $resultats ->fetch_assoc()){
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
          }
        }
        else{// code admin
          $requete = "SELECT * FROM  user_tb WHERE code_user='$code_admin'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows < 0) {
            while($row = $resultats ->fetch_assoc()){
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Mauvaise selection.'.'</div>'; 
            }
          }
          else{// modification de droit admin
            $sql="UPDATE droit_admintb SET d_post='$organe', d_rapport='$rapport_actu', d_affec='$mouv', d_archiv='$rapport_old', date_edit='$dat', customer='$admin', ip_user='$ip_user' WHERE code_user='$code_admin'";
            //$sql2="UPDATE user_tb SET droit=0 WHERE code_user='$code_admin'";

            $sav = $bd->query($sql);
            //$sav2 = $bd->query($sql2);

            if ($sav == true) {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="mess">'.'Droit(s) d\'administration modifié(s)'.'</div>';
            }
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Opération echouée'.'</div>'; 
            }
          }// modification de droit admin
        }// code admin                                                   
      }//fin base de données
      $bd->close();
    }
  }   
} // fin creation 
//edition droit admin

//debut creation Admin de l'entraprise
function new_useradmin(){ 
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_adUser'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $conc_id=md5($dat);
        $admin = $_SESSION['pseudo'];
        $code = "MF";
        $code_user=substr($conc_id,0 ,4);
        $code_soc = $code.'_'.$code_user;
        $codet = "2311B";
        $nom_user = $bd->real_escape_string($_POST['pseudo']);
        $ad_mail = $bd->real_escape_string($_POST['ad_mail']);
        $mot_passe =$bd->real_escape_string($_POST['mot_passe']);
        $passhash = $bd->real_escape_string(password_hash($_POST['mot_passe'], PASSWORD_DEFAULT));
        $societe = $bd->real_escape_string($_POST['societe']);
        $proville = $bd->real_escape_string($_POST['proville']);
        $avatar="./assets/img/logo_mankay.png";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $soc =substr($societe,0 ,3);
        $params=1;
        $droit=0;
        $statut ="master";
        $statut1 ="Actif";
                      
        if (!filter_var($ad_mail, FILTER_VALIDATE_EMAIL)) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."le format e-mail non autorisé.".'</div>'; 
        }
        else{
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              $code_admin = $row['code_admin'];     
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params'";
            $res1 = $bd ->query($req1);

            if ($res1 ->num_rows > 0) {
              //Enregistrement de l'eleve
              $req2 = "SELECT * FROM admin_tb WHERE statut ='Actif' ORDER BY id ASC";
              $res2 = $bd ->query($req2); 

              if ($res2 ->num_rows > 0) {
                while($row = $res2 ->fetch_assoc()){
                  $id = $row['id']; 
                }
                $n = $id ++;
                $num_code = $code.'-'.$soc.'-'.$n;
                      
                $req3 = "SELECT * FROM admin_tb WHERE pseudo ='$nom_user' AND statut ='$statut1'";
                $res3 = $bd ->query($req3);

                if ($res3 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet administrateur existe déjà.".'</div>'; 
                }
                else{
                  $sql ="INSERT INTO admin_tb(proville, societe, code_admin, pseudo, avatar, mot_pass, password, admin_mail, params, droit, statut, date_crea, customer, ip_user) VALUES ('".$proville."', '".$societe."', '".$num_code."', '".$nom_user."', '".$avatar."', '".$passhash."', '".$mot_passe."', '".$ad_mail."','".$params."', '".$droit."', '".$statut1."', '".$dat."', '".$_SESSION['pseudo']."','".$ip_user."')";

                  $sql1 ="INSERT INTO nom_societe_tb(proville, societe, code_admin, nom_user, logo, statut, date_crea, customer, ip_user) VALUES ('".$proville."','".$societe."','".$num_code."','".$nom_user."','".$avatar."','".$statut1."','".$dat."','".$_SESSION['pseudo']."','".$ip_user."')";

                  $sav = $bd->query($sql);
                  $sav1 = $bd->query($sql1);

                  if ($sav == true && $sav1 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Administrateur créé.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge.".'</div>'; 
                  }
                }
              }
              else{
                $num_code1 = $code.'-'.$soc.'-'.'0';

                $req3 = "SELECT * FROM admin_tb WHERE pseudo ='$nom_user' AND statut ='Actif'";
                $res3 = $bd ->query($req3);

                if ($res3 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet administrateur existe déjà.".'</div>'; 
                }
                else{
                  $sql2 ="INSERT INTO admin_tb(proville, societe, code_admin, pseudo, avatar, mot_pass, password, admin_mail, params, droit, statut, date_crea, customer, ip_user) VALUES ('".$proville."', '".$societe."', '".$num_code1."', '".$nom_user."', '".$avatar."', '".$passhash."', '".$mot_passe."', '".$ad_mail."','".$params."', '".$droit."', '".$statut1."', '".$dat."', '".$_SESSION['pseudo']."','".$ip_user."')";

                  $sql3 ="INSERT INTO nom_societe_tb(proville, societe, code_admin, nom_user, logo, statut, date_crea, customer, ip_user) VALUES ('".$proville."','".$societe."','".$num_code1."','".$nom_user."','".$avatar."','".$statut1."','".$dat."','".$_SESSION['pseudo']."','".$ip_user."')";

                  $sav2 = $bd->query($sql2);
                  $sav3 = $bd->query($sql3);

                  if ($sav2 == true && $sav3 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Administrateur créé.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge.".'</div>'; 
                  }
                }
              }
              //Enregistrement de l'eleve
            }
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';  
            }
          }
          else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Votre compte est invalide'.'</div>'; 
          }
        }
      }
    }
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}
//Fin creation Admin de l'entraprise

//Debut Zone Personnel Agent
function new_user(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_User'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $admin = $_SESSION['pseudo'];
        $conc_id=md5($dat);
        $code_user=substr($conc_id,0 ,5);
        $nom = $bd->real_escape_string($_POST['pseudo']);
        $ad_mail = $bd->real_escape_string($_POST['ad_mail']);
        $mot_passe =$bd->real_escape_string($_POST['mot_passe']);
        $passhash = $bd->real_escape_string(password_hash($_POST['mot_passe'], PASSWORD_DEFAULT));
        $avatar="assets/images/avatar/maquette/user.png";
        $params = 1;
        $droit=0;
        $statut ="Actif";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
                
        $requete = "SELECT * FROM admin_tb WHERE droit=1 AND pseudo='".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            $codesoc = $row['code_soc'];
          }
          $code =substr($code_admin,0, 6);
          $code_soc = $code.'-'.$code_user;
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif
            $req2 = "SELECT * FROM admin_tb WHERE params = '$params'";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte personnel
              while($row = $res2 ->fetch_assoc()){
                           
              }
              $req3 = "SELECT * FROM admin_tb WHERE pseudo ='$nom'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Cet Utilisateur existe déjà...".'</div>'; 
              }
              else{// Insertion de la situation financiere
                $req4 = "INSERT INTO admin_tb(code_soc, societe, code_admin, pseudo, avatar, mot_pass, password, admin_mail, params, droit, statut, date_crea, customer, ip_user) 
                                      VALUES ('".$codesoc."','".$societe."','".$code_soc."','".$nom."','".$avatar."','".$passhash."','".$mot_passe."','".$ad_mail."','".$params."',
                                                '".$droit."','".$statut."','".$dat."','".$admin."','".$ip_user."')";

                $res4 = $bd ->query($req4);

                if ($res4 == true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Nouvelle Utilisateur prise en charge.'.'</div>';
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouvelle Utilisateur non prise en charge.".'</div>'; 
                }
              }// Insertion de la situation financiere
            }// verification du compte agent
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Utilisateur est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Veuillez vous référer à l'administrateur-systeme".'</div>';
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}

function edit_admin(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_edituser'])) {
      if (empty($_GET['code_admin'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $code_admin= $_GET['code_admin'];
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $d_id=date("d-m-y");
          $h_id=date("h:i:s");
          $dat=$d_id." ".$h_id;
          $conc_id=md5($dat);
          $code_user=substr($conc_id,0 ,5);
          $customer=$_SESSION['pseudo'];
          $nom = $bd->real_escape_string($_POST['pseudo']);
          $ad_mail = $bd->real_escape_string($_POST['ad_mail']);
          $mot_pass = $bd->real_escape_string($_POST['mot-pass']);
          $mot_passe = $bd->real_escape_string($_POST['mot-pass']);
          $conf_pass = $bd->real_escape_string($_POST['conf-mot-pass']);
          $passhash = $bd->real_escape_string(password_hash($_POST['mot-pass'], PASSWORD_DEFAULT));
          $telephone = $bd->real_escape_string($_POST['telephone']);
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
          $statut="master";
                      
          if (!filter_var($ad_mail, FILTER_VALIDATE_EMAIL)) {
            echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                  "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            if ($mot_pass != $conf_pass ) {
              //echo "Les deux mots de passe ne correspondent pas!";
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Incoherence des mots de passe.".'</div>';
            }
            else{//verification du mot de passe
              $requete = "SELECT * FROM admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
              $resultats = $bd ->query($requete);

              if ($resultats ->num_rows < 0) {
                while($row = $resultats ->fetch_assoc()){
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
                }
              }
              else{// code admin
                $sql="UPDATE admin_tb SET pseudo='$nom', mot_pass='$passhash', password='$mot_passe', admin_mail='$ad_mail', telephone='$telephone', date_edit='$dat', customer='$customer', ip_user='$ip_user' WHERE code_admin='$code_admin'";
                $sav = $bd->query($sql);

                if ($sav == true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Administrateur modifié.'.'</div>';
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification echouée.'.'</div>'; 
                }
              }// code admin
            }//verification du mot de passe                                             
          }//verification format mail
        }//fin base de données
          $bd->close();
      }
        }
    }
    else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
    }
} // fin fonction

//fin mise à jour admin

//debut de la suppression admin
function delete_admin(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_delAdmin'])) {
      if (empty($_GET['code_admin'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $code_admin= $_GET['code_admin'];
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $statut = "master";
          $requete = "SELECT * FROM  admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows < 0) {
            while($row = $resultats ->fetch_assoc()){
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration vous est donné.'.'</div>'; 
            }
          }
          else{// code admin
            $requete = "SELECT * FROM admin_tb WHERE code_admin='$code_admin' AND params = 1";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification de l'admin master
              $sql="DELETE FROM admin_tb WHERE code_admin='$code_admin'";
              $sav = $bd->query($sql);

              $sql2="DELETE FROM d_admin_tb WHERE code_admin='$code_admin' WHERE params = 1";
              $sav2 = $bd->query($sql2);

              if ($sav == true && $sav2 == true) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="mess">'.'Suppression echouée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'.'Administrateur supprimé.'.'</div>'; 
              }
            }
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Administrateur introuvable'.'</div>'; 
            }
          }// code admin
        }
        $bd->close();
      }  
    }
    // fin fonction
    //fin de la suppression admin
  }
}

//Creation de bareme salarial
function new_barem() {
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_barem'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $admin = $_SESSION['pseudo'];
        $classe = $bd->real_escape_string($_POST['classe']);
        $categ =  $bd->real_escape_string($_POST['categ']);
        $descript = $bd->real_escape_string($_POST['descript']);
        $tension =  $bd->real_escape_string($_POST['tension']);
        $saljourn = $bd->real_escape_string($_POST['saljourn']);
        $tranp = $bd->real_escape_string($_POST['tranp']);
        $alFam = $bd->real_escape_string($_POST['alFam']);
        $indiv = $bd->real_escape_string($_POST['indiv']);
        $primanc_fix = $bd->real_escape_string($_POST['primanc_fix']);
        $primres_fix = $bd->real_escape_string($_POST['primres_fix']);
        $primperf_fix = $bd->real_escape_string($_POST['primperf_fix']);
        $taux_fisc = $bd->real_escape_string($_POST['taux_fisc']);
        $direct = $bd->real_escape_string($_POST['direct']);
        $logement = ($saljourn*26)*30/100;
        $Salbase_usd = $saljourn*26;
        $Transp_usd = $tranp*26;
        $Indiv_usd = $indiv*26;
        $primes = $primanc_fix + $primres_fix + $primperf_fix;
        $Totalbrut2 = $primes + $logement + $Salbase_usd + $Transp_usd + $Indiv_usd;
        $CNSS = $Salbase_usd*5/100;
        $Brutimpos_cdf = ($Salbase_usd-$CNSS)*$taux_fisc;
        $params = 1;
        $statut = "Actif";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);

        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params='$params'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while ($row = $resultats ->fetch_assoc()) {
            $code_admin = $row['code_admin'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows  > 0) {// verification de droit administratif
            $req2 = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND code_admin ='$code_admin'";
            $res2 = $bd->query($req2);

            if ($res2 ->num_rows > 0) {// verification du compte administrateur
              while ($row = $res2 ->fetch_assoc()) {
                $societe = $row['societe'];
                $code_admin = $row['code_admin'];
                $proville = $row['proville'];
              }
              $req3 = "SELECT * FROM perbaremsal_tb WHERE id =0";
              $res3 = $bd->query($req3);

              if ($Brutimpos_cdf == 162000) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."".'</div>'; 
              }
              else{// Insertion de la situation Barème
                if ($Brutimpos_cdf <= 162000) {
                  $requete = "SELECT * FROM perbaremsal_tb WHERE id ='0'";
                  $resultat = $bd ->query($requete);

                  $Pal1 = $Brutimpos_cdf*3/100;
                  $Iprtot_usd = $Pal1 / $taux_fisc;
                  $Iprtot_code =substr($Iprtot_usd,0, 4);
                  $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);
                  $NetPay_code =substr($NetPay_usd,0, 7);

                  if ($resultat ->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                  }
                  else{
                    $req4 ="INSERT INTO perbaremsal_tb(societe, direction, code_soc, location, categ, classe, description, tension, salJourn, tranp, alFam, indiv, primanc_fix, primres_fix, primperf_fix, primes_fix, taux_fisc, logmt, salbase_usd, transp_usd, indiv_usd, totalbrut1, totalbrut2, cnss, brutimpos_cdf, ipr_pal1, iprtot_cdf, iprtot_usd, netPay_usd, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$direct."','".$code_admin."','".$proville."','".$categ."','".$classe."','".$descript."','".$tension."','".$saljourn."', '".$tranp."','".$alFam."','".$indiv."','".$primanc_fix."','".$primres_fix."','".$primperf_fix."', '".$primes."', '".$taux_fisc."','".$logement."','".$Salbase_usd."','".$Transp_usd."','".$Indiv_usd."','".$Salbase_usd."','".$Totalbrut2."','".$CNSS."','".$Brutimpos_cdf."','".$Pal1."','".$Pal1."','".$Iprtot_code."','".$NetPay_code."','".$d_id."', '".$statut."','".$admin."','".$ip_user."')";
                    $res4 = $bd ->query($req4);

                    if ($res4 == true) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial prise en charge".'</div>'; 
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial non pris en charge".'</div>';  
                    }
                  }
                }
                elseif ($Brutimpos_cdf > 162000 AND $Brutimpos_cdf<=1800000) {
                  $requete = "SELECT * FROM perbaremsal_tb WHERE id ='0'";
                  $resultat = $bd ->query($requete);

                  $Pal2 = (162000*3/100)+(($Brutimpos_cdf-162001)*15/100);
                  $Iprtot_usd = $Pal2 / $taux_fisc;
                  $Iprtot_code =substr($Iprtot_usd,0, 4);
                  $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);
                  $NetPay_code =substr($NetPay_usd,0, 7);

                  if ($resultat ->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit".'</div>'; 
                  }
                  else{
                    $req5 ="INSERT INTO perbaremsal_tb(societe, direction, code_soc, location, categ, classe, description, tension, salJourn, tranp, alFam, indiv, primanc_fix, primres_fix, primperf_fix, primes_fix, taux_fisc, logmt, salbase_usd, transp_usd, indiv_usd, totalbrut1, totalbrut2, cnss, brutimpos_cdf, ipr_pal2, iprtot_cdf, iprtot_usd, netPay_usd, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$direct."','".$code_admin."','".$proville."','".$categ."','".$classe."','".$descript."','".$tension."','".$saljourn."', '".$tranp."','".$alFam."','".$indiv."','".$primanc_fix."','".$primres_fix."','".$primperf_fix."', '".$primes."', '".$taux_fisc."','".$logement."','".$Salbase_usd."','".$Transp_usd."','".$Indiv_usd."','".$Salbase_usd."','".$Totalbrut2."','".$CNSS."','".$Brutimpos_cdf."','".$Pal2."','".$Pal2."','".$Iprtot_code."','".$NetPay_code."','".$d_id."', '".$statut."','".$admin."','".$ip_user."')";
                    $res5 = $bd ->query($req5);

                    if ($res5 == true) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial prise en charge".'</div>'; 
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial non pris en charge".'</div>';  
                    }
                  }
                }
                elseif ($Brutimpos_cdf > 1800000 AND $Brutimpos_cdf <=3600000) {
                  $requete = "SELECT * FROM perbaremsal_tb WHERE id='0'";
                  $resultat = $bd ->query($requete);

                  $Pal3 = (162000*3/100)+((1800000-162001)*15/100)+(($Brutimpos_cdf-1800001)*30/100);
                  $Iprtot_usd = $Pal3 / $taux_fisc;
                  $Iprtot_code =substr($Iprtot_usd,0, 4);
                  $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);
                  $NetPay_code =substr($NetPay_usd,0, 7);

                  if ($resultat ->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                  }
                  else{
                    $req6 ="INSERT INTO perbaremsal_tb(societe, direction, code_soc, location, categ, classe, description, tension, salJourn, tranp, alFam, indiv, primanc_fix, primres_fix, primperf_fix, primes_fix, taux_fisc, logmt, salbase_usd, transp_usd, indiv_usd, totalbrut1, totalbrut2, cnss, brutimpos_cdf, ipr_pal3, iprtot_cdf, iprtot_usd, netPay_usd, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$direct."','".$code_admin."','".$proville."','".$categ."','".$classe."','".$descript."','".$tension."','".$saljourn."', '".$tranp."','".$alFam."','".$indiv."','".$primanc_fix."','".$primres_fix."','".$primperf_fix."', '".$primes."', '".$taux_fisc."','".$logement."','".$Salbase_usd."','".$Transp_usd."','".$Indiv_usd."','".$Salbase_usd."','".$Totalbrut2."','".$CNSS."','".$Brutimpos_cdf."','".$Pal3."','".$Pal3."','".$Iprtot_code."','".$NetPay_code."','".$d_id."', '".$statut."','".$admin."','".$ip_user."')";
                    $res6 = $bd ->query($req6);

                    if ($res6 == true) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial prise en charge".'</div>'; 
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial non pris en charge".'</div>';  
                    }
                  }
                }
                elseif ($Brutimpos_cdf > 3600001) {
                  $requete = "SELECT * FROM perbaremsal_tb WHERE id='0'";
                  $resultat = $bd ->query($requete);

                  $Pal4 = (162000*3/100)+((1800000-162001)*15/100)+((3600000-1800001)*30/100)+(($Brutimpos_cdf-3600001)*30/100);
                  $Iprtot_usd = $Pal4 / $taux_fisc;
                  $Iprtot_code =substr($Iprtot_usd,0, 4);
                  $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);
                  $NetPay_code =substr($NetPay_usd,0, 7);

                  if ($resultat ->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                  }
                  else{
                    $req7 ="INSERT INTO perbaremsal_tb(societe, direction, code_soc, location, categ, classe, description, tension, salJourn, tranp, alFam, indiv, primanc_fix, primres_fix, primperf_fix, primes_fix, taux_fisc, logmt, salbase_usd, transp_usd, indiv_usd, totalbrut1, totalbrut2, cnss, brutimpos_cdf, ipr_pal4, iprtot_cdf, iprtot_usd, netPay_usd, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$direct."','".$code_admin."','".$proville."','".$categ."','".$classe."','".$descript."','".$tension."','".$saljourn."', '".$tranp."','".$alFam."','".$indiv."','".$primanc_fix."','".$primres_fix."','".$primperf_fix."', '".$primes."', '".$taux_fisc."','".$logement."','".$Salbase_usd."','".$Transp_usd."','".$Indiv_usd."','".$Salbase_usd."','".$Totalbrut2."','".$CNSS."','".$Brutimpos_cdf."','".$Pal4."','".$Pal4."','".$Iprtot_code."','".$NetPay_code."','".$d_id."', '".$statut."','".$admin."','".$ip_user."')";
                    $res7 = $bd ->query($req7);

                    if ($res7 == true) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial prise en charge".'</div>'; 
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouveau Barème Salarial non pris en charge".'</div>';  
                    }
                  }
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouvelle Barème Salarial non pris en charge".'</div>';
                }
              }
            }// verification du compte administrateur
            else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'." Compte administrateur est inactif".'</div>';  
            }
          }// verification de droit administratif
          else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }
        else {// verification du compte administratif
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide.".'</div>';
        }
      }
    }//fin base de données
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>';
  }
}
//Fin Creation de bareme salarial

//Mise a jour de bareme salarial
function Maj_barem() {
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['Mj_barem'])) {
      if (empty($_GET['ID'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else {
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $ID_pers = $_GET['ID'];
          $d_id=date("d-m-y");
          $h_id=date("h:i:s");
          $dat=$d_id." ".$h_id;
          $admin = $_SESSION['pseudo'];
          $classe = $bd->real_escape_string($_POST['classe']);
          $categ =  $bd->real_escape_string($_POST['categ']);
          $descript = $bd->real_escape_string($_POST['descript']);
          $tension =  $bd->real_escape_string($_POST['tension']);
          $saljourn = $bd->real_escape_string($_POST['saljourn']);
          $tranp = $bd->real_escape_string($_POST['tranp']);
          $alFam = $bd->real_escape_string($_POST['alFam']);
          $indiv = $bd->real_escape_string($_POST['indiv']);
          $primanc_fix = $bd->real_escape_string($_POST['primanc_fix']);
          $primres_fix = $bd->real_escape_string($_POST['primres_fix']);
          $primperf_fix = $bd->real_escape_string($_POST['primperf_fix']);
          $taux_fisc = $bd->real_escape_string($_POST['taux_fisc']);
          $direct = $bd->real_escape_string($_POST['direct']);
          $logement = ($saljourn*26)*30/100;
          $Salbase_usd = $saljourn*26;
          $Transp_usd = $tranp*26;
          $Indiv_usd = $indiv*26;
          $primes = $primanc_fix + $primres_fix + $primperf_fix;
          $Totalbrut2 = $primes + $logement + $Salbase_usd + $Transp_usd + $Indiv_usd;
          $CNSS = $Salbase_usd*5/100;
          $Brutimpos_cdf = ($Salbase_usd-$CNSS)*$taux_fisc;
          $params = 1;
          $statut = "Actif";
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);

          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params='$params'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {// verification du compte administratif
            while ($row = $resultats ->fetch_assoc()) {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
            }
            $req3 = "SELECT * FROM perbaremsal_tb WHERE id ='0'";
            $res3 = $bd->query($req3);

            if ($Brutimpos_cdf == 162000) {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."".'</div>'; 
            }
            else{// Insertion de la situation Barème
              if ($Brutimpos_cdf <= 162000) {
                $requete = "SELECT * FROM perbaremsal_tb WHERE id ='0'";
                $resultat = $bd ->query($requete);

                $Pal1 = $Brutimpos_cdf*3/100;
                $Iprtot_usd = $Pal1 / $taux_fisc;
                $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);

                if ($resultat ->num_rows > 0) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                }
                else{
                  $req4 ="UPDATE perbaremsal_tb SET direction ='$direct', categ ='$categ', classe ='$classe', description ='$descript', tension ='$tension', salJourn ='$saljourn', tranp ='$tranp', 
                          alFam ='$alFam', indiv ='$indiv', primanc_fix ='$primanc_fix', primres_fix ='$primres_fix', primperf_fix ='$primperf_fix', primes_fix ='$primes', taux_fisc ='$taux_fisc',
                          logmt ='$logement', salbase_usd ='$Salbase_usd', transp_usd ='$Transp_usd', indiv_usd ='$Indiv_usd', totalbrut1 ='$Salbase_usd', totalbrut2 ='$Totalbrut2', cnss ='$CNSS',
                          brutimpos_cdf ='$Brutimpos_cdf', ipr_pal1 ='$Pal1', iprtot_cdf ='$Pal1', iprtot_usd ='$Iprtot_usd', netPay_usd ='$NetPay_usd', date_edit ='$dat', customer ='$admin' WHERE id ='$ID_pers' AND statut ='Actif'";
                  $res4 = $bd ->query($req4);
                  if ($res4 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial prise en charge".'</div>'; 
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial non pris en charge".'</div>';  
                  }
                }
              }
              elseif ($Brutimpos_cdf > 162000 AND $Brutimpos_cdf<=1800000) {
                $requete = "SELECT * FROM perbaremsal_tb WHERE id ='0'";
                $resultat = $bd ->query($requete);

                $Pal2 = (162000*3/100)+(($Brutimpos_cdf-162001)*15/100);
                $Iprtot_usd = $Pal2 / $taux_fisc;
                $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);

                if ($resultat ->num_rows > 0) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit".'</div>'; 
                }
                else{
                  $req5 ="UPDATE perbaremsal_tb SET direction ='$direct', categ ='$categ', classe ='$classe', description ='$descript', tension ='$tension', salJourn ='$saljourn', tranp ='$tranp', 
                          alFam ='$alFam', indiv ='$indiv', primanc_fix ='$primanc_fix', primres_fix ='$primres_fix', primperf_fix ='$primperf_fix', primes_fix ='$primes', taux_fisc ='$taux_fisc',
                          logmt ='$logement', salbase_usd ='$Salbase_usd', transp_usd ='$Transp_usd', indiv_usd ='$Indiv_usd', totalbrut1 ='$Salbase_usd', totalbrut2 ='$Totalbrut2', cnss ='$CNSS',
                          brutimpos_cdf ='$Brutimpos_cdf', ipr_pal2 ='$Pal2', iprtot_cdf ='$Pal2', iprtot_usd ='$Iprtot_usd', netPay_usd ='$NetPay_usd', date_edit ='$dat', customer ='$admin' WHERE id ='$ID_pers' AND statut ='Actif'";
                  $res5 = $bd ->query($req5);

                  if ($res5 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial prise en charge".'</div>'; 
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial non pris en charge".'</div>';  
                  }
                }
              }
              elseif ($Brutimpos_cdf > 1800000 AND $Brutimpos_cdf <=3600000) {
                $requete = "SELECT * FROM perbaremsal_tb WHERE id='0'";
                $resultat = $bd ->query($requete);

                $Pal3 = (162000*3/100)+((1800000-162001)*15/100)+(($Brutimpos_cdf-1800001)*30/100);
                $Iprtot_usd = $Pal3 / $taux_fisc;
                $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);

                if ($resultat ->num_rows > 0) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                }
                else{
                  $req6 ="UPDATE perbaremsal_tb SET direction ='$direct', categ ='$categ', classe ='$classe', description ='$descript', tension ='$tension', salJourn ='$saljourn', tranp ='$tranp', 
                          alFam ='$alFam', indiv ='$indiv', primanc_fix ='$primanc_fix', primres_fix ='$primres_fix', primperf_fix ='$primperf_fix', primes_fix ='$primes', taux_fisc ='$taux_fisc',
                          logmt ='$logement', salbase_usd ='$Salbase_usd', transp_usd ='$Transp_usd', indiv_usd ='$Indiv_usd', totalbrut1 ='$Salbase_usd', totalbrut2 ='$Totalbrut2', cnss ='$CNSS',
                          brutimpos_cdf ='$Brutimpos_cdf', ipr_pal3 ='$Pal3', iprtot_cdf ='$Pal3', iprtot_usd ='$Iprtot_usd', netPay_usd ='$NetPay_usd', date_edit ='$dat', customer ='$admin' WHERE id ='$ID_pers' AND statut ='Actif'";
                  $res6 = $bd ->query($req6);

                  if ($res6 == true) {
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial prise en charge".'</div>'; 
                  }
                  else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial non pris en charge".'</div>';  
                  }
                }
              }
              elseif ($Brutimpos_cdf > 3600001) {
                $requete = "SELECT * FROM perbaremsal_tb WHERE id='0'";
                $resultat = $bd ->query($requete);

                $Pal4 = (162000*3/100)+((1800000-162001)*15/100)+((3600000-1800001)*30/100)+(($Brutimpos_cdf-3600001)*30/100);
                $Iprtot_usd = $Pal4 / 2100;
                $NetPay_usd = (($Totalbrut2-$CNSS)-$Iprtot_usd);

                if ($resultat ->num_rows > 0) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                }
                else{
                  $req7 ="UPDATE perbaremsal_tb SET direction ='$direct', categ ='$categ', classe ='$classe', description ='$descript', tension ='$tension', salJourn ='$saljourn', tranp ='$tranp', 
                          alFam ='$alFam', indiv ='$indiv', primanc_fix ='$primanc_fix', primres_fix ='$primres_fix', primperf_fix ='$primperf_fix', primes_fix ='$primes', taux_fisc ='$taux_fisc',
                          logmt ='$logement', salbase_usd ='$Salbase_usd', transp_usd ='$Transp_usd', indiv_usd ='$Indiv_usd', totalbrut1 ='$Salbase_usd', totalbrut2 ='$Totalbrut2', cnss ='$CNSS',
                          brutimpos_cdf ='$Brutimpos_cdf', ipr_pal4 ='$Pal4', iprtot_cdf ='$Pal4', iprtot_usd ='$Iprtot_usd', netPay_usd ='$NetPay_usd', date_edit ='$dat', customer ='$admin' WHERE id ='$ID_pers' AND statut ='Actif'";
                  $res7 = $bd ->query($req7);

                  if ($res7 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial prise en charge".'</div>'; 
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Modification de Barème Salarial non pris en charge".'</div>';  
                  }
                }
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouvelle Barème Salarial non pris en charge".'</div>';
              }
            }
          }
          else {// verification du compte administratif
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide.".'</div>';
          }
        }
      }
    }//fin base de données
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>';
  }
}


//Debut Zone Creat Entreprise
function new_esc(){ // debut creation participants
   if (isset($_SESSION['pseudo'])) {
      if (isset($_POST['cmd_Esc'])) {
         include("connexion.php");
         if ($bd -> connect_error) {
            die('Impossible de se connecter à la BD:'.$bd ->connect_error);
         }
         else{
            $d_id=date("d-m-y");
            $h_id=date("h:i:s");
            $dat=$d_id." ".$h_id;
            $admin = $_SESSION['pseudo'];
            $conc_id=md5($dat);
            $code_user=substr($conc_id,0 ,5);
            $nomsociete = $bd->real_escape_string($_POST['nomsociete']);
            $lieu_territ = $bd->real_escape_string($_POST['lieu_territ']);
            $ad_post = $bd->real_escape_string($_POST['ad_post']);
            $tel =$bd->real_escape_string($_POST['tel']);
            $date_creat = $bd->real_escape_string($_POST['date_creat']);
            $ad_mail = $bd->real_escape_string($_POST['ad_mail']);
            $formjurid = $bd-> real_escape_string($_POST['formjurid']);
            $activite = $bd->real_escape_string($_POST['activite']);
            $activite_sec = $bd->real_escape_string($_POST['activite_sec']);
            $imm_cnss = $bd->real_escape_string($_POST['imm_cnss']);
            $imm_inpp = $bd->real_escape_string($_POST['imm_inpp']);
            $imm_onem = $bd->real_escape_string($_POST['imm_onem']);
            $nom_etablis = $bd->real_escape_string($_POST['nom_etablis']);
            $nomchef_entrep = $bd->real_escape_string($_POST['nomchef_entrep']);
            $noimpot = $bd->real_escape_string($_POST['noimpot']);
            $norccm = $bd->real_escape_string($_POST['norccm']);
            $no_autre = $bd->real_escape_string($_POST['no_autre']);
            $idnat = $bd->real_escape_string($_POST['idnat']);
            $params = 1;
            $droit=0;
            $statut ="Actif";
            $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
                
            $requete = "SELECT * FROM admin_tb WHERE droit=1 AND params ='$params'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification du compte administratif
               while($row = $resultats ->fetch_assoc()){
                  $code_admin = $row['code_admin'];
               }
               $code =substr($code_admin,0, 6);
               $code_soc = $code.'-'.$code_user;
               $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND params = '$params' ";
               $res1 = $bd ->query($req1);

               if ($res1 ->num_rows > 0) {// verification de droit administratif
                  $req2 = "SELECT * FROM nom_societe_tb WHERE nom_user ='$nomchef_entrep' AND statut ='Actif'";
                  $res2 = $bd ->query($req2); 

                  if ($res2 ->num_rows > 0) {// verification du compte personnel
                     while($row = $res2 ->fetch_assoc()){
                        $nomsociete = $row['societe'];
                        $nomchef_entrep = $row['nom_user'];  
                        $code_admin = $row['code_admin'];
                     }
                     $req3 = "SELECT * FROM tab_mankasoc WHERE nom_chef_Entreprise ='$nomchef_entrep' AND statut ='$statut'";
                     $res3 = $bd ->query($req3);

                     if ($res3 ->num_rows > 0) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Situation Personnel déjà en cours...".'</div>'; 
                     }
                     else{// Insertion de la situation financiere
                        $req4 = "INSERT INTO tab_mankasoc(codeIdent, nom_raison_social, lieu_territorial, adresse_postale, telephone, an_creation, email, forme_jurid, activite_principale, activite_secondaire, immat_CNSS, immat_INPP, immat_ONEM, nom_chef_Etablissmt, nom_chef_Entreprise, id_Nat, no_impot, no_RCCM, no_Autre, date_crea, statut, customer, ip_user) VALUES ('".$code_admin."','".$nomsociete."','".$lieu_territ."','".$ad_post."','".$tel."','".$date_creat."','".$ad_mail."','".$formjurid."','".$activite."','".$activite_sec."','".$imm_cnss."','".$imm_inpp."','".$imm_onem."','".$nom_etablis."','".$nomchef_entrep."','".$idnat."','".$noimpot."','".$norccm."','".$no_autre."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                        /*INSERT INTO `tab_mankasoc`(`id`, `codeIdent`, `nom_raison_social`, `lieu_territorial`, `adresse_postale`, `telephone`, `an_creation`, `email`, `forme_jurid`, `activite_principale`, `activite_secondaire`, `immat_CNSS`, `immat_INPP`, `immat_ONEM`, `nom_chef_Etablissmt`, `nom_chef_Entreprise`, `id_Nat`, `no_impot`, `no_RCCM`, `no_Autre`, `date_crea`, `date_edit`, `statut`, `customer`, `ip_user`)*/

                        /*tab_mankasoc(codeIdent, nom_raison_social, lieu_territorial, adresse_postale, telephone, an_creation, email, forme_jurid, activite_principale, activite_secondaire, immat_CNSS, immat_INPP, immat_ONEM, nom_chef_Etablissmt, nom_chef_Entreprise, id_Nat, no_impot, no_RCCM, no_Autre, date_crea, statut, customer, ip_user) VALUES ('".$code_admin."','".$nomsociete."','".$lieu_territ."','".$ad_post."','".$tel."','".$date_creat."','".$ad_mail."','".$formjurid."','".$activite."','".$activite_sec."','".$imm_cnss."','".$imm_inpp."','".$imm_onem."','".$nom_etablis."','".$nomchef_entrep."','".$idnat."','".$noimpot."','".$norccm."','".$no_autre."','".$dat."','".$statut."','".$admin."','".$ip_user."')*/

                        $res4 = $bd ->query($req4);

                        if ($res4 == true) {
                           echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Prise en charge d\'une nouvelle societe.'.'</div>';
                        }
                        else{
                           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Non prise en charge d\'une nouvelle societe.".'</div>'; 
                        }
                     }// Insertion de la situation financiere
                  }// verification du compte agent
                  else{
                     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte societe est inactif ou déjà cloturé".'</div>';  
                  }
               }// verification de droit administratif
               else{
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
               }
            }// verification du compte administratif
            else{
               echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Veuillez vous référer à l'administrateur-systeme".'</div>';
            }
         }
      }//fin  base de données
   }
   else{
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
   }
}
//Fin Creat Entrepris

function tauchange(){ // debut creation taux de change
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_devise'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $conc_id=md5($dat);
        $code_user=substr($conc_id,0 ,8);
        $devise = $bd->real_escape_string($_POST['devise']);
        $devise = "CDF";
        $taux = $bd->real_escape_string($_POST['taux']);
        $params=1;
        $droit=0;
        $statut = "en cours";
        $status = "actif";

        $requete = "SELECT * FROM admin_tb WHERE params ='$params' AND pseudo='".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            $codesoc = $row['code_soc'];
          }
          $req = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params'";
          $res = $bd ->query($req);

          if ($res ->num_rows > 0) {

            $req1 ="SELECT * FROM tauxjr_tb WHERE statut='$status'";
            $res1 = $bd->query($req1);

            if ($res1 ->num_rows > 0) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Le taux existant".'</div>';
            }
            else{
              $sql="INSERT INTO tauxjr_tb(code_soc, societe, devise, taux, statut) VALUES ('".$codesoc."','".$societe."','".$devise."','".$taux."','".$statut."')";
              $sav = $bd->query($sql);
  
              if ($sav == true) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="mess">'.'Taux de change à été bien crée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Enregistrement echoué.'.'</div>'; 
              }// code admin
            }
          }
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }
        else{// code admin
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
        }// code admin
      }
      $bd->close();
    }  
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."connexion perdue.".'</div>'; 
  }
  
} // fin creation taux de change

// Desactivation Taux de change
function destauxchange(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_desataux'])) {
      if (empty($_GET['ID'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun parametre trouvé' . '</div>';
      } else {
        $compte = $_GET['ID'];
        include("connexion.php");
        if ($bd->connect_error) {
          die('Impossible de se connecter à la BD:' . $bd->connect_error);
        } else {
          $d_id = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_id . " " . $h_id;
          $conc_id = md5($dat);
          $code_user = substr($conc_id, 0, 5);
          $customer = $_SESSION['pseudo'];
          $desactiver = $bd->real_escape_string($_POST['desactiver']);
          $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);

          if (!filter_var($desactiver)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Le format e-mail non autorisé." . '</div>';
          } else {
            $requete = "SELECT * FROM admin_tb WHERE pseudo='" . $_SESSION['pseudo'] . "'";
            $resultats = $bd->query($requete);

            if ($resultats->num_rows < 0) {
              while ($row = $resultats->fetch_assoc()) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration' . '</div>';
              }
            } else { // code admin
              $sql = "UPDATE taux_tb SET statut ='$desactiver', date_edit ='$dat' WHERE id ='$compte'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Desactivation de Taux de charge effectuée" . '</div>';
              } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Desactivation non pris en charge" . '</div>';
              }
            }
            // code admin                                           
          } //verification format mail
        } //fin base de données
        $bd->close();
      }
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} // fin fonction
//fin desactivation le taux de change

// Maj Pers Agent Activer ou Inactiver
function Maj_TauxIA(){
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_MajTaux'])) {
      if (empty($_GET['ID'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $ID_pers = $_GET['ID'];
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $d_id=date("d-m-y");
          $h_id=date("h:i:s");
          $dat=$d_id." ".$h_id;
          $conc_id=md5($dat);
          $code_user=substr($conc_id,0 ,5);
          $customer=$_SESSION['pseudo'];
          $maj_taux = $bd->real_escape_string($_POST['maj_taux']);
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
                      
          if (!filter_var($maj_taux)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                  "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            $requete = "SELECT * FROM admin_tb WHERE params='$params' AND pseudo='".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows < 0) {
              while($row = $resultats ->fetch_assoc()){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
              }
            }
            else{// code admin
              $sql ="UPDATE tauxjr_tb SET statut ='$maj_taux' WHERE id ='$ID_pers'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification à été effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification Taux echouée.'.'</div>'; 
              }
            }// code admin                                           
          }//verification format mail

        }//fin base de données
        $bd->close();
      }
    }
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }   
} // fin fonction
//fin mise à jour Taux Active ou Inactiver

function periodePaye(){ // debut creation Periode
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_paye'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $conc_id=md5($dat);
        $code_user=substr($conc_id,0 ,8);
        $jour = $bd->real_escape_string($_POST['jour']);
        $mois = $bd->real_escape_string($_POST['mois']);
        $annee = $bd->real_escape_string($_POST['annee']);
        $params=1;
        $droit=0;
        $statut = "en cours";
        $status = "Actif";

        $requete = "SELECT * FROM admin_tb WHERE params ='$params' AND pseudo='".$_SESSION['pseudo']."'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params'";
          $res = $bd ->query($req);

          if ($res ->num_rows > 0) {

            $req1 ="SELECT * FROM periodepaye_tb WHERE statut='$status'";
            $res1 = $bd->query($req1);

            if ($res1 ->num_rows > 0) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Le taux existant".'</div>';
            }
            else{
              $sql="INSERT INTO periodepaye_tb(societe, jour, mois, annee, statut) VALUES ('".$societe."','".$jour."','".$mois."','".$annee."','".$statut."')";
              $sav = $bd->query($sql);

              /*INSERT INTO `periodepaye_tb`(`id`, `societe`, `jour`, `mois`, `annee`, `statut`, `date_crea`) */
  
              if ($sav == true) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="mess">'.'Date de payer à été bien crée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Enregistrement echoué.'.'</div>'; 
              }// code admin
            }
          }
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }
        else{// code admin
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
        }// code admin
      }
      $bd->close();
    }  
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."connexion perdue.".'</div>'; 
  }
  
} // fin creation Periode

// Maj Pers Periode Activer ou Desactiver
function Maj_PeriodeIA(){
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_MajPeriod'])) {
      if (empty($_GET['ID'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $ID_periodIA = $_GET['ID'];
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $d_id=date("d-m-y");
          $h_id=date("h:i:s");
          $dat=$d_id." ".$h_id;
          $conc_id=md5($dat);
          $code_user=substr($conc_id,0 ,5);
          $customer=$_SESSION['pseudo'];
          $maj_periodIA = $bd->real_escape_string($_POST['maj_periodIA']);
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
                      
          if (!filter_var($maj_periodIA)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                  "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            $requete = "SELECT * FROM admin_tb WHERE params='$params' AND pseudo='".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows < 0) {
              while($row = $resultats ->fetch_assoc()){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
              }
            }
            else{// code admin
              $sql ="UPDATE periodepaye_tb SET statut ='$maj_periodIA' WHERE id ='$ID_periodIA'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification à été effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification Taux echouée.'.'</div>'; 
              }
            }// code admin                                           
          }//verification format mail

        }//fin base de données
        $bd->close();
      }
    }
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }   
} // fin fonction
//fin mise à jour Periode Active ou Desactiver

//partie creation du compte de tresorerie
function new_tresor(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_tresor'])) {
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $d_id = date("d-m-y");
        $h_id = date("h:i:s");
        $dat = $d_id . " " . $h_id;
        $conc_id = md5($dat);
        $code_user = substr($conc_id, 0, 8);
        $deban = substr($d_id, 6, 8);
        $compte_tresor = $bd->real_escape_string($_POST['compte_tresor']);
        $description_tresor = $bd->real_escape_string($_POST['description_tresor']);
        $reference_tresor = $bd->real_escape_string($_POST['reference_tresor']);
        $scdf = $bd->real_escape_string($_POST['scdf']);
        $solde1_usd = $bd->real_escape_string($_POST['solde1_usd']);
        $cdf = $bd->real_escape_string($_POST['cdf']);
        $solde2_usd = $bd->real_escape_string($_POST['solde2_usd']);
        $statut_tresor = $bd->real_escape_string($_POST['statut_tresor']);
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $groupes = $compte_tresor.'_'.$description_tresor;
        $params = 1;
        $admin = $_SESSION['pseudo'];

        if (!filter_var($compte_tresor)) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "le format e-mail non autorisé." . '</div>';
        } else {
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
              //Enregistrement...
              $req2 = "SELECT * FROM compta_tresor WHERE statut ='Actif' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  $id = $row['id'];
                }
                $n = $id + 1;

                $req3 = "SELECT * FROM compta_tresor WHERE compte ='$compte_tresor' AND statut ='$statut_tresor'";
                $res3 = $bd->query($req3);

                if ($res3->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet compte existe déjà.".'</div>';
                } else {
                  $req4 = "INSERT INTO compta_tresor(code_soc, societe, compte, description, descriptions, reference, scdf, solde1_usd, date_crea, statut, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$compte_tresor."', '".$description_tresor."','". $groupes."','".$reference_tresor. "','".$scdf."', '".$solde1_usd."',
                                                       '".$dat."', '".$statut_tresor."', '".$admin."', '".$ip_user."')";
                  $req4x = "INSERT INTO compta_autres(code_soc, societe, compte, description, descriptions, solde1_cdf, solde1_usd, date_crea, statut, customer, ip_user)
                                            VALUES('".$codesoc."','".$societe."','".$compte_tresor."','".$description_tresor."','". $groupes."','".$scdf."', '".$solde1_usd."','".$dat."', '".$statut_tresor."', '".$admin."', '".$ip_user."')";
                  $res4 = $bd->query($req4);
                  $res4x = $bd->query($req4x);

                  if ($res4 == true && $res4x == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau compta_tresor pris en charge.' . '</div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Enregistrement non pris en charge.." . '</div>';
                  }
                }
              } else {
                $req5 = "SELECT * FROM compta_tresor WHERE compte ='$compte_tresor' AND statut ='actif'";
                $res5 = $bd->query($req5);

                if ($res5->num_rows > 0) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Cet compta_tresor existe déjà." . '</div>';
                } else {

                  $req6 = "INSERT INTO compta_tresor(code_soc, societe, compte, description, descriptions, reference, scdf, solde1_usd, date_crea, statut, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$compte_tresor."', '".$description_tresor."','". $groupes."','".$reference_tresor."', '".$scdf."', '".$solde1_usd."','".$cdf."',
                                                           '".$solde2_usd."', '".$dat."', '".$statut_tresor."', '".$admin."', '".$ip_user."')";

                  $req6x = "INSERT INTO compta_autres(code_soc, societe, compte, description, descriptions, solde1_cdf, solde1_usd, date_crea, statut, customer, ip_user)
                                            VALUES('".$codesoc."','".$societe."','".$compte_tresor."','".$description_tresor."','". $groupes."','".$scdf."', '".$solde1_usd."','".$dat."', '".$statut_tresor."', '".$admin."', '".$ip_user."')";
                  $res6 = $bd->query($req6);
                  $res6x = $bd->query($req6x);

                  if ($res6 == true && $res6x == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau compta_tresor pris en charge.' . '</div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Enregistrement non pris en charge." . '</div>';
                  }
                }
              }
              //Enregistrement de l'eleve
            } else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
            }
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Votre compte est invalide' . '</div>';
          }
        }
      }
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
}

// Mise à jour tresorerie
function edit_tresor(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_edittresor'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun parametre trouvé' . '</div>';
      } else {
        $compte_tresor = $_GET['compte'];
        $Codesoc = $_GET['Code'];
        include("connexion.php");
        if ($bd->connect_error) {
          die('Impossible de se connecter à la BD:' . $bd->connect_error);
        } else {
          $d_id = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_id . " " . $h_id;
          $conc_id = md5($dat);
          $code_user = substr($conc_id, 0, 5);
          $customer = $_SESSION['pseudo'];
          $description_tresor = $bd->real_escape_string($_POST['description_tresor']);
          $reference_tresor = $bd->real_escape_string($_POST['reference_tresor']);
          $scdf = $bd->real_escape_string($_POST['scdf']);
          $solde1_usd = $bd->real_escape_string($_POST['solde1_usd']);
          $cdf = $bd->real_escape_string($_POST['cdf']);
          $solde2_usd = $bd->real_escape_string($_POST['solde2_usd']);
          $statut_tresor = $bd->real_escape_string($_POST['statut_tresor']);
          $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params = 1;
          $droit = 0;
          $statut = "master";

          if (!filter_var($description_tresor)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
              "Le format e-mail non autorisé." . '</div>';
          } else {
            $requete = "SELECT * FROM admin_tb WHERE statut='$statut' AND pseudo='" . $_SESSION['pseudo'] . "'";
            $resultats = $bd->query($requete);

            if ($resultats->num_rows < 0) {
              while ($row = $resultats->fetch_assoc()) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration' . '</div>';
              }
            } else { // code admin

              $sql = "UPDATE compta_tresor SET description ='$description_tresor', reference ='$reference_tresor', scdf ='$scdf', solde1_usd ='$solde1_usd', 2_cdf ='$cdf', solde2_usd ='$solde2_usd', date_edit ='$dat', customer ='$customer', ip_user='$ip_user' WHERE compte ='$compte_tresor' AND statut ='$statut_tresor' AND code_soc='$Codesoc'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Modification effectuée.' .
                  '</div>';
              } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Modification echouée.' .
                  '</div>';
              }
            } // code admin
          } //verification format mail
        } //fin base de données
        $bd->close();
      }
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} // fin fonction
//fin mise à jour Tresorerie


?>