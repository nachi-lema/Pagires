<?php 

//Année encours...
function ann_scolaire(){
  if (isset($_SESSION['pseudo'])) {
    $d_id=date("d-m-y");
    $date = substr($d_id, 6 ,8);
    $date_fin = '20'.$date;

    echo $date_fin;
  }
  else{
    echo 'invalide';
  }
}

//Debut Zone Personnel Agent
function new_creat_agent(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_agent'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $deban = substr($d_id, 6, 8);
        $admin = $_SESSION['pseudo'];
        $direct = $bd->real_escape_string($_POST['direct']);
        $departemnt = $bd->real_escape_string($_POST['departemnt']);
        $service =  $bd->real_escape_string($_POST['service']);
        $fonction = $bd->real_escape_string($_POST['fonction']);
        $nom_personnel =  $bd->real_escape_string($_POST['nom_personnel']);
        $etat_civil = $bd->real_escape_string($_POST['etat_civil']);
        $date_naissa = $bd->real_escape_string($_POST['date_naissa']);
        $telephone = $bd->real_escape_string($_POST['telephone_agent']);
        $telephone_agent = '+243'.$telephone;
        $sexe =  $bd->real_escape_string($_POST['sexe']);
        $nbr_enfant = $bd->real_escape_string($_POST['nbr_enfant']);
        $mail =  $bd->real_escape_string($_POST['mail']);
        $matricule = $bd->real_escape_string($_POST['matricule']);
        $date_debut = $bd->real_escape_string($_POST['date_debut']);
        $n_cnss = $bd->real_escape_string($_POST['n_cnss']);
        $n_compte = $bd->real_escape_string($_POST['n_compte']);
        $classe = $bd->real_escape_string($_POST['classe']);
        $contrat =$bd->real_escape_string($_POST['contrat']);
        $classif =$bd->real_escape_string($_POST['classif']);
        $proville = $bd->real_escape_string($_POST['proville']);
        $statut_agent = $bd->real_escape_string($_POST['statut_agent']);
        $nationalite = "Congolais";
        $banque = "Rawbank";
        $pays = "RDC";
        $params = 1;
        $groupe = 'personnel';
        $rout = 'actif';
        $a = "2";
        $b = "3";
        $compteAgent = "42";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            //$proville =$row['proville'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription ='$params' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif
            $req2 = "SELECT * FROM peragent_tb WHERE statut ='Actif'";
            $res2 = $bd ->query($req2);

            if ($res2 ->num_rows > 0) {
              while($row = $res2 ->fetch_assoc()){
                $id = $row['id'];
              }
              $n = $id ++;
              $num_compte = $compteAgent.'-'.$deban.'-'.'00'.$n;
              $descripts = $num_compte.'_'.$nom_personnel;

              $req3 = "SELECT * FROM perbaremsal_tb WHERE direction ='$direct' AND classe ='$classe' AND societe ='$societe'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                while ($row = $res3 ->fetch_assoc()) {
                  $classe      = $row['classe'];
                  $categ       = $row['categ'];
                  $primanc_fix = $row['primanc_fix'];
                  $primres_fix = $row['primres_fix'];
                  $primperf_fix  = $row['primperf_fix'];
                  $indiv       = $row['indiv'];
                  $description = $row['description'];
                  $salJourn = $row['salJourn'];
                  $tranp = $row['tranp'];
                  $alFam = $row['alFam'];
                }
                $salm = ($salJourn*2)/3;
                $salm_m =substr($salm,0 ,4);
                $salaire_horair = ($salJourn/8);
                $sal_hor =substr($salaire_horair,0 ,4);
                $logement = (($salJourn*26)*30/100);
                $lgmnt =substr($logement,0 ,6);

                $req3x = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND statut ='statut_agent'";
                $res3x = $bd ->query($req3x);
                if ($res3x ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Agent existe déjà".'</div>';
                }
                else{// Insertion de la situation financiere
                  //$req4 = "INSERT INTO peragent_tb(direction,compte, nom_complet) VALUES('".$direct."','".$num_compte."','".$nom_personnel."')";
                  $req4 = "INSERT INTO peragent_tb(pays, proville, societe, codeSoc, direction, departement, service, compte, nom_complet, fonction, contrat, classification, categ, Classe, 
                                                     categorie, date_naissance, etat_civil, nbre_enfant, sexe, nationalite, telephone, email, date_debut, matricule, no_cnss, banque,
                                                     no_banque, date_crea, statut, customer, ip_user) 
                                           VALUES ('".$pays."','".$proville."', '".$societe."','".$code_admin."', '".$direct."', '".$departemnt."','".$service."','".$num_compte."',
                                                     '".$nom_personnel."','".$fonction."', '".$contrat."', '".$classif."','".$categ."', '".$classe."', '".$description."', '".$date_naissa."',
                                                     '".$etat_civil."','".$nbr_enfant."', '".$sexe."', '".$nationalite."', '".$telephone_agent."', '".$mail."', '".$date_debut."', '".$matricule."',
                                                     '".$n_cnss."','".$banque."','".$n_compte."', '".$dat."', '".$statut_agent."','".$admin."', '".$ip_user."')";  
                  $req5 = "INSERT INTO perbasesal_tb(pays, proville, code_societe, societe, compte, nom_complet, fonction, contrat, classification, categ, Classe, categorie, salbase_J, sal_m, sal_circ,
                                                        sal_hor, Lgmt, alfam_tx, transp_J, t_CA, Ind_div, primanc, primperf, primres, date_crea, statut, customer, ip_user) 
                                             VALUES ('".$pays."', '".$proville."','".$code_admin."', '".$societe."', '".$num_compte."', '".$nom_personnel."', '".$fonction."','".$contrat."','".$classif."',
                                                      '".$categ."', '".$classe."', '".$description."', '".$salJourn."', '".$salm_m."', '".$salm_m."', '".$sal_hor."', '".$lgmnt."', '".$alFam."', 
                                                      '".$tranp."', '".$salJourn."','".$indiv."','".$primanc_fix."', '".$primperf_fix."', '".$primres_fix."', '".$dat."', '".$statut_agent."', '".$admin."', '".$ip_user."')";
                  $req4x = "INSERT INTO compta_pers(compte, nom_complet, fonction, date_debut, telephone, email, statut, customer, ip_user) 
                                        VALUES ('".$num_compte."','".$nom_personnel."','".$fonction."','".$date_debut."','".$telephone_agent."','".$mail."',
                                                '".$statut_agent."','".$admin."','".$ip_user."')";
                  $seq = "INSERT INTO combo_od(compte, nom_complet, descriptions, groupe, statut) VALUES ('".$num_compte."','".$nom_personnel."','".$descripts."','".$groupe."','".$rout."')";
                  $res4 = $bd ->query($req4);
                  $res5 = $bd->query($req5);
                  $res4x = $bd->query($req4x);
                  $guet = $bd->query($seq);
  
                  if ($res4 == true && $res5 == true && $res4x == true && $guet == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Nouvelle Agent prise en charge.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouvelle Agent non prise en charge.".'</div>'; 
                  }
                }// Insertion de la situation financiere
              }
              else{// Insertion de la situation financiere
                echo"Enregistrement echoue";
              }// Insertion de la situation financiere

            }// verification du compte de l'eleve
            else{
              $num_compte1 = $compteAgent.'-'.$deban.'-'.'00';

              $req5x = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND statut ='Actif'";
              $res5x = $bd->query($req5x);

              if ($res5x->num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet Agent existe déjà.".'</div>';
              }
              else {
                //$req4s = "INSERT INTO peragent_tb(direction, compte, nom_complet) VALUES('".$direct."','".$num_compte1."','".$nom_personnel."')";
                $req4s = "INSERT INTO peragent_tb(pays, proville, societe, codeSoc, direction, departement, service, compte, nom_complet, fonction, contrat, classification, categ, Classe, 
                                                   categorie, date_naissance, etat_civil, nbre_enfant, sexe, nationalite, telephone, email, date_debut, matricule, no_cnss, banque, no_banque, 
                                                   date_crea, statut, customer, ip_user) 
                                         VALUES ('".$pays."','".$proville."', '".$societe."','".$code_admin."', '".$direct."', '".$departemnt."','".$service."','".$num_compte1."','".$nom_personnel."',
                                                   '".$fonction."', '".$contrat."', '".$classif."','".$categ."', '".$classe."', '".$description."', '".$date_naissa."','".$etat_civil."',
                                                   '".$nbr_enfant."', '".$sexe."', '".$nationalite."', '".$telephone_agent."', '".$mail."', '".$date_debut."', '".$matricule."','".$n_cnss."',
                                                   '".$banque."','".$n_compte."', '".$dat."', '".$statut_agent."','".$admin."', '".$ip_user."')";

                $req5s = "INSERT INTO perbasesal_tb(pays, proville, code_societe, societe, compte, nom_complet, fonction, contrat, classification, categ, Classe, categorie, salbase_J, sal_m, sal_circ,
                                                      sal_hor, Lgmt, alfam_tx, transp_J, t_CA, Ind_div, primanc, primperf, primres, date_crea, statut, customer, ip_user) 
                                           VALUES ('".$pays."', '".$proville."','".$code_admin."', '".$societe."', '".$num_compte1."', '".$nom_personnel."', '".$fonction."','".$contrat."','".$classif."',
                                                   '".$categ."', '".$classe."', '".$description."', '".$salJourn."', '".$salm_m."', '".$salm_m."', '".$sal_hor."', '".$lgmnt."', '".$alFam."', '".$tranp."',
                                                    '".$salJourn."', '".$indiv."','".$primanc_fix."', '".$primperf_fix."', '".$primres_fix."', '".$dat."', '".$statut_agent."', '".$admin."', '".$ip_user."')";
                $req4x1 = "INSERT INTO compta_pers(compte, nom_complet, fonction, date_debut, telephone, email, statut, customer, ip_user) 
                                         VALUES ('".$num_compte1."','".$nom_personnel."','".$fonction."','".$date_debut."','".$telephone_agent."','".$mail."',
                                                 '".$statut_agent."','".$admin."','".$ip_user."')";
                $seq1 = "INSERT INTO combo_od(compte, nom_complet, descriptions, groupe, statut) VALUES ('".$num_compte1."','".$nom_personnel."','".$descripts."','".$groupe."','".$rout."')";

                $res4s = $bd->query($req4s);
                $res5s = $bd->query($req5s);
                $res4x1 = $bd->query($req4x1);
                $guet1 = $bd->query($seq1);

                if ($res4s == true && $res5s == true && $res4x1 == true && $guet1 == true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouvelle Agent prise en charge.' . '</div>';
                } else {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Nouvelle Agent non prise en charge." . '</div>';
                }
              }

              //echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Agent est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}

// Mise à jour Pers Agent
function edit_pers_agent(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_edit_agent'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $compte_pers = $_GET['compte'];
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
          $departemnt = $bd->real_escape_string($_POST['departemnt']);
          $service =  $bd->real_escape_string($_POST['service']);
          $fonction = $bd->real_escape_string($_POST['fonction']);
          $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
          $classe = $bd->real_escape_string($_POST['classe']);
          $etat_civil = $bd->real_escape_string($_POST['etat_civil']);
          $date_naissa = $bd->real_escape_string($_POST['date_naissa']);
          $telephone_agent = $bd->real_escape_string($_POST['telephone_agent']);
          $sexe =  $bd->real_escape_string($_POST['sexe']);
          $nbr_enfant = $bd->real_escape_string($_POST['nbr_enfant']);
          $mail =  $bd->real_escape_string($_POST['mail']);
          $matricule = $bd->real_escape_string($_POST['matricule']);
          $date_debut = $bd->real_escape_string($_POST['date_debut']);
          $n_cnss = $bd->real_escape_string($_POST['n_cnss']);
          $n_compte = $bd->real_escape_string($_POST['n_compte']);
          $motif = $bd->real_escape_string($_POST['motif']);
          //$declaration = $bd->real_escape_string($_POST['declaration']);
          $date_fin = $bd->real_escape_string($_POST['date_fin']);
          $contrat = $bd->real_escape_string($_POST['contrat']);
          $classif = $bd->real_escape_string($_POST['classif']);
          $statut_agent = $bd->real_escape_string($_POST['statut_agent']);
          $societe = "CSB";
          $nationalite = "Congolais";
          $banque = "Rawbank";
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
          $statut="master";
                      
          if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                  "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            $requete = "SELECT * FROM  admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows < 0) {
              while($row = $resultats ->fetch_assoc()){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
              }
            }
            else{// code admin
              $sql = "UPDATE peragent_tb SET departement ='$departemnt', service ='$service', nom_complet ='$nom_personnel', fonction ='$fonction', contrat ='$contrat', classification ='$classif', Classe ='$classe', date_naissance ='$date_naissa', etat_civil ='$etat_civil', nbre_enfant ='$nbr_enfant', sexe ='$sexe', nationalite ='$nationalite', telephone ='$telephone_agent', email ='$mail', date_debut ='$date_debut', matricule ='$matricule', no_cnss ='$n_cnss', banque ='$banque', no_banque ='$n_compte', date_fin ='$date_fin', motif ='$motif', date_edit ='$dat', customer ='$customer', ip_user ='$ip_user' WHERE compte ='$compte_pers' AND statut ='$statut_agent'";

              $sql1 ="UPDATE perbasesal_tb SET nom_complet ='$nom_personnel', fonction ='$fonction', contrat ='$contrat', classification ='$classif', Classe ='$classe', date_edit ='$dat' WHERE compte ='$compte_pers' AND statut ='$statut_agent'";

              $sav = $bd->query($sql);
              $sav1 = $bd->query($sql1);

              if ($sav == true && $sav1 == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification Agent effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification Agent echouée.'.'</div>'; 
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
//fin mise à jour Pers Agent

//Desactivation personnel
function Desactivation_pers(){
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_Desact'])) {
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
          $Desactivation_pers = $bd->real_escape_string($_POST['Desactivation_pers']);
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
                      
          if (!filter_var($Desactivation_pers)) {
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
              $sql ="UPDATE peragent_tb SET statut ='$Desactivation_pers', customer ='$customer' WHERE id ='$ID_pers'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Desactivation Agent à été effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification Agent echouée.'.'</div>'; 
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
//fin Desactivation personnel

//Debut Zone Création dependant
function new_creat_depent(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_depent'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $admin = $_SESSION['pseudo'];
        $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
        $nom_depent =  $bd->real_escape_string($_POST['nom_depent']);
        $date_naissa = $bd->real_escape_string($_POST['date_naissa']);
        $sexe =  $bd->real_escape_string($_POST['sexe']);
        $affiliation = $bd->real_escape_string($_POST['affiliation']);
        $statut_depend = $bd->real_escape_string($_POST['statut_depend']);
        $societe = "CSB";
        $nationalite = "Congolais";
        $banque = "Rawbank";
        $params = 1;
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            $proville = $row['proville'];     
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif

            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND statut ='Actif' ORDER BY id ASC";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte personnel
              while($row = $res2 ->fetch_assoc()){
                $id = $row['id'];
                $compte_pers = $row['compte'];
                $nom_personnel = $row['nom_complet'];
              }
              $n = $id ++;
              $codenfant = $compte_pers.'-'.$n;

              $req3 = "SELECT * FROM perenfant_tb WHERE statut ='En cours'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                while($row = $res2 ->fetch_assoc()){
                  $id = $row['id'];
                }
              }
              else{// Insertion de la situation financiere
                $req4 = "INSERT INTO perenfant_tb(proville, code_societe, societe, codeparent, nom_parent, nom_dependant, sexe, date_nais, affiliation, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."',  '".$societe."', '".$compte_pers."', '".$nom_personnel."', '".$nom_depent."','".$sexe."', '".$date_naissa."', '".$affiliation."', '".$dat."', '".$statut_depend."', '".$admin."', '".$ip_user."')";
                
                $res4 = $bd ->query($req4);

                if ($res4 == true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Nouveau dependant prise en charge.'.'</div>';
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouveau dependant non prise en charge.".'</div>'; 
                }
              }// Insertion de la situation financiere

            }// verification du compte de l'eleve
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Agent est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}

// Mise à jour Dependant
function edit_dependant(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_edit_depend'])) {
      if (empty($_GET['id'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $compte_pers = $_GET['id'];
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
          $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
          $nom_depent =  $bd->real_escape_string($_POST['nom_depent']);
          $date_naissa = $bd->real_escape_string($_POST['date_naissa']);
          $sexe =  $bd->real_escape_string($_POST['sexe']);
          $affiliation = $bd->real_escape_string($_POST['affiliation']);
          $statut_depend = $bd->real_escape_string($_POST['statut_depend']);
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
          $statut="master";
                      
          if (!filter_var($nom_depent)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                  "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            $requete = "SELECT * FROM  admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows < 0) {
              while($row = $resultats ->fetch_assoc()){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
              }
            }
            else{// code admin

              $sql = "UPDATE perenfant_tb SET nom_parent ='$nom_personnel', nom_dependant ='$nom_depent', sexe ='$sexe', date_nais ='$date_naissa', affiliation ='$affiliation', date_edit ='$dat', customer ='$customer', ip_user='$ip_user' WHERE id ='$compte_pers' AND statut ='$statut_depend'";

              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification Dependant effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification Dependant echouée.'.'</div>'; 
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
//fin mise à jour Dependant

//Debut Zone Création Perpoint
function new_creat_perpoint(){ // debut creation perpoint
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_point'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("y-m-d");
        $d_ida=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_ida." ".$h_id;
        $deban = substr($d_ida,6 ,8);
        $annee = '20'.$deban;
        $conc_id=md5($dat);
        $code_ref=substr($conc_id,0 ,5);
        $admin = $_SESSION['pseudo'];
        $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
        $periode =  $bd->real_escape_string($_POST['periode']);
        $mois = $bd->real_escape_string($_POST['mois']);
        $jpres = $bd->real_escape_string($_POST['jpres']);
        $jrmal =  $bd->real_escape_string($_POST['jrmal']);
        $jcirc = $bd->real_escape_string($_POST['jcirc']);
        $jcan = $bd->real_escape_string($_POST['jcan']);
        //$jrep = $bd->real_escape_string($_POST['jrep']);
        //$hsj = $bd->real_escape_string($_POST['hsj']);
        //$hsn = $bd->real_escape_string($_POST['hsn']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $mensan = $mois.'-'.$annee;
        $Jtot1 = $jpres + $jrmal + $jcirc + $jcan;
        $statut = "en cours"; 
        $stauts = "Actif";
        $params = 1;
        $Codepaie = $code_ref.substr($admin,0 ,3);
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
                
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];  
            $societe = $row['societe'];
            $proville = $row['proville'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) { // verification de droit administratif
            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND statut ='Actif'";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) { // verification du compte Agent
              while($row = $res2 ->fetch_assoc()){
                $id            = $row['id'];
                $compte_pers   = $row['compte'];
                $nom_personnel = $row['nom_complet'];
                $pays          = $row['pays'];
                $departemnt    = $row['departement'];
                $service       = $row['service'];
                $fonction      = $row['fonction'];
                $contrat       = $row['contrat'];
                $classif       = $row['classification'];
                $classe        = $row['Classe'];
                $categ         = $row['categ'];
                $nbrenft       = $row['nbre_enfant'];
                $sexe          = $row['sexe'];
                $matricule     = $row['matricule'];
                $no_cnss       = $row['no_cnss'];
                $banque        = $row['banque'];
                $no_banque     = $row['no_banque'];
              }
              $req3 = "SELECT * FROM perbaremsal_tb WHERE classe ='$classe' AND societe ='$societe' AND statut ='Actif'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                while ($row = $res3 ->fetch_assoc()) {
                  $salbasej = $row['salJourn'];
                  $logemnt = $row['logmt'];
                  $alfa = $row['alFam'];
                  $transj = $row['tranp'];
                  $Indiv = $row['indiv'];
                  $primanc = $row['primanc_fix'];
                  $primres = $row['primres_fix'];
                  $primperf = $row['primperf_fix'];
                }

                $Salbase = $salbasej * $jpres;
                $Salmal  = (($salbasej*$jrmal)*2)/3;
                $Salmal1 =substr($Salmal,0, 4);
                $Salcirc = (($salbasej*$jcirc)*2)/3;
                $Salconge = $salbasej*$jcan;
                $Totsalb = $Salbase+$Salmal+$Salcirc+$Salconge;
                $Totsalb1 =substr($Totsalb,0, 6);
                $Logmt = ($salbasej*26)*30/100;
                $Logmt1 = substr($Logmt,0, 6);
                $Transp = $transj*$jpres;
                $Alfam = $alfa*$nbrenft;
                $Alfam1 = substr($Alfam,0, 4);
                $Brutot1 = $Totsalb+$Logmt+$Transp+$Alfam;
                $Brutot11 = substr($Brutot1,0, 8);
                $Inddiv = (($jpres+$jcan)*$Indiv)+(((($jrmal+$jcirc)*$Indiv)*2)/3);
                $Inddiv1 = substr($Inddiv,0, 6);
                $Primantot = (($jpres+$jcan)*$primanc)+(((($jrmal+$jcirc)*$primanc)*2)/3);
                $Primantot1 = substr($Primantot,0, 6);
                $Primperftot = (($jpres+$jcan)*$primperf)+(((($jrmal+$jcirc)*$primperf)*2)/3);
                $Primperftot1 = substr($Primperftot,0, 6);
                $Primrestot = (($jpres+$jcan)*$primres)+(((($jrmal+$jcirc)*$primres)*2)/3);
                $Primrestot1 = substr($Primrestot,0, 6);
                $Primtot = $Inddiv+$Primantot+$Primperftot+$Primrestot;
                $Primtot1 = substr($Primtot,0, 6);
                $Brutot2 = $Brutot1+$Primtot;
                $Brutot22 = substr($Brutot2,0, 7);

                $Cnss_QPO = $Totsalb*5/100;
                $Cnss_QPO1 = substr($Cnss_QPO,0, 7);
                $BaseImp_usd = $Totsalb-$Cnss_QPO;
                $BaseImp_usd1 = substr($BaseImp_usd,0, 8);
                $BaseImp_cdf = $BaseImp_usd*$taux;

                $req4 = "SELECT * FROM persalemens1_tb WHERE codepaie = '$Codepaie'";
                $res4 = $bd ->query($req4);

                if ($res4 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Situation financière de agent déjà en cloturée".'</div>'; 
                }
                else{ // Insertion de la situation financiere agent

                  if ($resultats ->num_rows > 0) {
                    $requete = "SELECT * FROM persalemens1_tb WHERE codepaie = '$Codepaie' ";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                      $req5 ="INSERT INTO persalemens1_tb(code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, salbasej, lgmt, alfa, transj, indiv, primanc, primres, primperf, jpres, jrMal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primantot, primperftot, primrestot, primtot, brutot2, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$code_admin."', '".$societe."', '".$Codepaie."','".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."', '".$jpres."', '".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."', '".$Primantot1."', '".$Primperftot1."', '".$Primrestot."', '".$Primtot1."','".$Brutot22."','".$mois."', '".$annee."','".$periode."','".$dat."', '".$statut."', '".$admin."', '".$ip_user."')";                 
                      $res5 = $bd ->query($req5);
                                                                 
                      if ($res5 == true) {
                        $req5x = "SELECT * FROM persalemens2_tb WHERE statut ='en cours'";
                        $res5x = $bd ->query($req5x);

                        if ($BaseImp_cdf > 0 AND $BaseImp_cdf <= 162000) {
                          $req4a = "SELECT * FROM persalemens2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res4a = $bd ->query($req4a); 

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM persalemens2_tb WHERE id ='0' AND ier_qpp ='$classif'";
                            $resultat = $bd ->query($requete);
                            
                            $IER_QPP = ($BaseImp_usd*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $Pal1 = $BaseImp_cdf*3/100;
                            $Iprtot_usd = $Pal1 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Inpp_QPP = $Totsalb*2/100;
                            $Onem_QPP = $Totsalb*0.2/100;
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);

                            $req5x1 ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal1, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."','".$Pal1."','".$Pal1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."', '".$IER_QPP1."', '".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."', '".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $req8x1 ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$IER_QPP1."', '".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $res5x1 = $bd ->query($req5x1);
                            $res8x1 = $bd ->query($req8x1);

                            if ($res5x1 == true && $res8x1 == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 1 pris en charge".'</div>';
                            }
                          }
                          else{
                            //Sans condition
                            $Pal1 = $BaseImp_cdf*3/100;
                            $Iprtot_usd = $Pal1 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Inpp_QPP = $Totsalb*2/100;
                            $Onem_QPP = $Totsalb*0.2/100;
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);

                            $req5x1 ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal1, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."','".$Pal1."','".$Pal1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."', '".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$dat."','".$periode."','".$statut."','".$admin."','".$ip_user."')";

                            $req8x1 ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $res5x1 = $bd ->query($req5x1);
                            $res8x1 = $bd ->query($req8x1);

                            if ($res5x1 == true && $res8x1 == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 1 pris en charge".'</div>';
                            }
                          }
                        }
                        elseif ($BaseImp_cdf > 16201 AND $BaseImp_cdf <= 1800000) {
                          $req4b = "SELECT * FROM persalemens2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res4b = $bd ->query($req4b); 

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM persalemens2_tb WHERE id ='0' AND ier_qpp ='$classif'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($BaseImp_usd*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $Pal2 = (162000*3/100)+(($BaseImp_cdf-162001)*15/100);
                            $Iprtot_usd = $Pal2 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Inpp_QPP = $Totsalb*2/100;
                            $Onem_QPP = $Totsalb*0.2/100;
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);
                                      
                            if ($resultat ->num_rows > 0) {
                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit".'</div>'; 
                            }
                            else{
                              $req5 ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal2, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."', '".$Pal2."','".$Pal2."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$IER_QPP1."', '".$QPP_tot."', '".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."', '".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                              $req8x2 ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$IER_QPP1."','".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                                                                                  
                              $res5 = $bd ->query($req5);
                              $res8x2 = $bd ->query($req8x2);

                              if ($res5 == true && $res8x2 == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages pris en charge".'</div>'; 
                              }
                              else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 2 pris en charge".'</div>';  
                              }
                            }
                          }
                          else{
                            //Sans condition
                            $Pal2 = (162000*3/100)+(($BaseImp_cdf-162001)*15/100);
                            $Iprtot_usd = $Pal2 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Inpp_QPP = $Totsalb*2/100;
                            $Onem_QPP = $Totsalb*0.2/100;
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);
                                      
                            if ($resultat ->num_rows > 0) {
                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit".'</div>'; 
                            }
                            else{
                              $req5x ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal2, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."', '".$Pal2."','".$Pal2."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."', '".$QPP_tot."', '".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."', '".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                              $req8x2x ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                                                                                  
                              $res5x = $bd ->query($req5x);
                              $res8x2x = $bd ->query($req8x2x);

                              if ($res5x == true && $res8x2x == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages pris en charge".'</div>'; 
                              }
                              else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 2 pris en charge".'</div>';  
                              }
                            }
                          }

                        }
                        elseif ($BaseImp_cdf > 1800000 AND $BaseImp_cdf <= 3600000) {
                          $req4c = "SELECT * FROM persalemens2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif' ";
                          $res4c = $bd ->query($req4c); 

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM persalemens2_tb WHERE id='0' AND ier_qpp ='$classif'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($BaseImp_usd*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8); 
                            $Pal3 = (162000*3/100)+((1800000-162001)*15/100)+(($BaseImp_cdf-1800001)*30/100);
                            $Iprtot_usd = $Pal3 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Inpp_QPP = $Totsalb*2/100;
                            $Onem_QPP = $Totsalb*0.2/100;
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);

                            if ($resultat ->num_rows > 0) {
                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                            }
                            else{
                              $req6 ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal3, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."', '".$Pal3."','".$Pal3."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$IER_QPP1.", '".$QPP_tot."', '".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."', '".$admin."', '".$ip_user."')";

                              $req8x3 ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$IER_QPP1."','".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                                                                                  
                              $res6 = $bd ->query($req6);
                              $res8x3 = $bd->query($req8x3);

                              if ($res6 == true && $req8x3 == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages prise en charge".'</div>'; 
                              }
                              else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 3 pris en charge".'</div>';  
                              }
                            }
                          }
                          else{
                            //Sans condition
                            $Pal3 = (162000*3/100)+((1800000-162001)*15/100)+(($BaseImp_cdf-1800001)*30/100);
                            $Iprtot_usd = $Pal3 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Inpp_QPP = $Totsalb*2/100;
                            $Onem_QPP = $Totsalb*0.2/100;
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);

                            if ($resultat ->num_rows > 0) {
                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                            }
                            else{
                              $req6x ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal3, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."', '".$Pal3."','".$Pal3."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."', '".$QPP_tot."', '".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."', '".$admin."', '".$ip_user."')";

                              $req8x3x ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP."','".$Inpp_QPP."','".$Onem_QPP."','".$QPP_tot."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                                                                                  
                              $res6x = $bd ->query($req6x);
                              $res8x3x = $bd->query($req8x3x);

                              if ($res6x == true && $res8x3x == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages prise en charge".'</div>'; 
                              }
                              else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 3 pris en charge".'</div>';  
                              }
                            }
                          }                          
                        }
                        elseif ($BaseImp_cdf > 3600001) {
                          $req4d = "SELECT * FROM persalemens2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif' ";
                          $res4d = $bd ->query($req4d);                          

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM persalemens2_tb WHERE id='0' AND ier_qpp ='$classif' ";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($BaseImp_usd*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8); 
                            $Pal4 = (162000*3/100)+((1800000-162001)*15/100)+((3600000-1800001)*30/100)+(($BaseImp_cdf-3600001)*30/100);
                            $Iprtot_usd = $Pal4 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 7);
                            $Inpp_QPP = $Totsalb*2/100;
                            $Inpp_QPP1 =substr($Inpp_QPP,0, 7);
                            $Onem_QPP = $Totsalb*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPP_tot1 = substr($QPP_tot,0, 8);
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);

                            if ($resultat ->num_rows > 0) {
                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                            }
                            else{
                              $req7 ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal4, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."', '".$Pal4."','".$Pal4."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP1."','".$Inpp_QPP1."','".$Onem_QPP1."','".$IER_QPP1."','".$QPP_tot1."', '".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."', '".$admin."', '".$ip_user."')";

                              $req8x4 ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP1."','".$Inpp_QPP1."','".$Onem_QPP1."','".$IER_QPP1."', '".$QPP_tot1."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                                                                                  
                              $res7 = $bd ->query($req7);
                              $res8x4 = $bd ->query($req8x4);

                              if ($res7 == true && $res8x4) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages prise en charge".'</div>'; 
                              }
                              else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 4 pris en charge".'</div>';  
                              }
                            }

                          }
                          else{
                            //Sans condition
                            $Pal4 = (162000*3/100)+((1800000-162001)*15/100)+((3600000-1800001)*30/100)+(($BaseImp_cdf-3600001)*30/100);
                            $Iprtot_usd = $Pal4 / $taux;
                            $Iprtot_usd1 = substr($Iprtot_usd,0, 4);
                            $Tot_reten = $Cnss_QPO+$Iprtot_usd;
                            $Tot_reten1 = substr($Tot_reten,0, 5);
                            $NetP_usd = $Brutot2-$Tot_reten;
                            $NetP_usd1 = substr($NetP_usd,0, 7);
                            $NetP_cdf = $NetP_usd*$taux;
                            $Cnss_QPP = $Totsalb*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 7);
                            $Inpp_QPP = $Totsalb*2/100;
                            $Inpp_QPP1 =substr($Inpp_QPP,0, 7);
                            $Onem_QPP = $Totsalb*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $QPP_tot = $Cnss_QPP+$Inpp_QPP+$Onem_QPP;
                            $QPP_tot1 = substr($QPP_tot,0, 8);
                            $QPO_tot = $Cnss_QPO+$Iprtot_usd;
                            $CNSS_tot = $Cnss_QPO+$Cnss_QPP;
                            $Fisctot  = $QPP_tot+$QPO_tot;
                            $Fisctot1 = substr($Fisctot,0, 8);
                            $Staffnet = $NetP_usd+$QPP_tot+$QPO_tot;
                            $Staffnet1 = substr($Staffnet,0, 8);

                            if ($resultat ->num_rows > 0) {
                              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                            }
                            else{
                              $req7x ="INSERT INTO persalemens2_tb(proville, code_soc, societe, codepaie, mensan, nom_complet, departement, fonction, num_compte, contrat, classif, categ, classe, nbre_enfant, tot_brut, totsalb2, taux, cnss_QPO, baseImp_usd, baseImp_cdf, iprpal4, iprtot_cdf, iprtot_usd, tot_reten, netp_usd, netp_usd_ARR, netp_cdf, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, Staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."', '".$mensan."', '".$nom_personnel."','".$departemnt."','".$fonction."','".$compte_pers."','".$contrat."','".$classif."','".$categ."','".$classe."','".$nbrenft."','".$Brutot22."','".$Totsalb1."', '".$taux."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$BaseImp_cdf."', '".$Pal4."','".$Pal4."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$NetP_usd."','".$NetP_cdf."','".$Cnss_QPP1."','".$Inpp_QPP1."','".$Onem_QPP1."', '".$QPP_tot1."', '".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."', '".$admin."', '".$ip_user."')";

                              $req8x4x ="INSERT INTO tab_payfiche(nom_complet, departement, service, fonction, societe, categ, classe, enfts, sexe, banque, no_banque, matricule, num_compte, no_cnss, mensan, salbasej, lgmt, alfa, transj, Indiv, primanc, primres, primperf, jpres, jrmal, jcirc, jcan, jtot1, taux, salbase, salmal, salcirc, salconge, totsalb, logmt, transp, alfam, brutot1, inddiv, primtot, brutot2, totsalb2, cnss_QPO, baseImp_usd, iprtot_usd, tot_reten, netp_usd, cnss_QPP, inpp_QPP, onem_QPP, qpp_tot, qpo_tot, cnss_tot, fisctot, staffnet, menspay, anpay, periode, date_crea, statut, customer, ip_user) VALUES ('".$nom_personnel."','".$departemnt."','".$service."', '".$fonction."','".$societe."','".$categ."','".$classe."','".$nbrenft."','".$sexe."','".$banque."','".$no_banque."','".$matricule."','".$compte_pers."','".$no_cnss."','".$mensan."', '".$salbasej."','".$logemnt."','".$alfa."','".$transj."','".$Indiv."','".$primanc."','".$primres."','".$primperf."','".$jpres."','".$jrmal."', '".$jcirc."', '".$jcan."','".$Jtot1."','".$taux."','".$Salbase."','".$Salmal1."','".$Salcirc."','".$Salconge."','".$Totsalb1."','".$Logmt1."','".$Transp."','".$Alfam1."', '".$Brutot11."', '".$Inddiv1."','".$Primtot1."','".$Brutot22."','".$Totsalb1."','".$Cnss_QPO1."','".$BaseImp_usd1."','".$Iprtot_usd1."','".$Tot_reten1."','".$NetP_usd1."','".$Cnss_QPP1."','".$Inpp_QPP1."','".$Onem_QPP1."', '".$QPP_tot1."','".$QPO_tot."','".$CNSS_tot."','".$Fisctot1."','".$Staffnet1."','".$mois."','".$annee."','".$periode."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                                                                                  
                              $res7x = $bd ->query($req7x);
                              $res8x4x = $bd ->query($req8x4x);

                              if ($res7x == true && $res8x4x) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Pointages prise en charge".'</div>'; 
                              }
                              else{
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Pointages non 4 pris en charge".'</div>';  
                              }
                            }
                            
                          }
                        }
                        else{
                          //Insertion de la partie bareme
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Barème invalide".'&nbsp;'.'<a href="#">'.'Cliquez ici pour l\'inserer svp!'.'</a>'.'</div>';
                          //Insertion de la partie bareme
                        }
                      }
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge".'</div>';  
                      }
                    }
                  }
                  else{
                     echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Code paie".'</div>';                  
                  }
                }// Insertion de la situation financiere
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Baremsal est inactif ou déjà cloturé".'</div>'; 
              }
            }// verification du compte de l'eleve
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Agent est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}
//fin Zone Création Perpoint

//Debut Zone Création Advance
function new_creat_advance(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_advance'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $deban = substr($d_id,6 ,8);
        $annee = '20'.$deban;
        $dat=$d_id." ".$h_id;
        $conc_id=md5($dat);
        $code_ref=substr($conc_id,0 ,5);
        $admin = $_SESSION['pseudo'];
        $mois = $bd->real_escape_string($_POST['mois']);
        $nom_personnel =  $bd->real_escape_string($_POST['nom_personnel']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $ref_doc =  $bd->real_escape_string($_POST['ref_doc']);
        $descript = $bd->real_escape_string($_POST['descript']);
        $montant_cdf = $bd->real_escape_string($_POST['montant_cdf']);
        $montant_usd = $bd->real_escape_string($_POST['montant_usd']);
        $pourcentage = $bd->real_escape_string($_POST['pourcentage']);
        $regul_cdf = $bd->real_escape_string($_POST['regul_cdf']);
        $regul_usd = $bd->real_escape_string($_POST['regul_usd']);
        $montant = ($montant_cdf / $taux) + $montant_usd;
        $Retenue_usd = $montant*$pourcentage/100;
        $Regul = ($regul_cdf / $taux) + $regul_usd;
        $retenu = substr($Retenue_usd,0, 5);
        $statut = "en cours"; 
        $params = 1;
        $Codepaie = $code_ref.substr($admin,0 ,3);
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            $proville = $row['proville'];     
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif

            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND societe ='$societe' ORDER BY id ASC";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte personnel
              while($row = $res2 ->fetch_assoc()){
                $id = $row['id'];
                $compte_pers = $row['compte'];
                $nom_personnel = $row['nom_complet'];
                $service = $row['service'];
                $departemnt = $row['departement'];
              }

              $req3 = "SELECT * FROM peradvances WHERE reference ='$ref_doc' AND statut ='en cours'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
              }
              else{// Insertion de la situation financiere
                $req4 = "INSERT INTO peradvances(proville, code_societe, societe, Codepaie, departement, noms, compte, service, taux, reference, description, montant_cdf, montant_$, montant_usd, tauxret, retenue_usd, regul_cdf, regul_$, regul_usd, menspay, anpay, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$code_admin."', '".$societe."', '".$Codepaie."','".$departemnt."', '".$nom_personnel."','".$compte_pers."', '".$service."','".$taux."','".$ref_doc."', '".$descript."', '".$montant_cdf."', '".$montant_usd."', '".$montant."','".$pourcentage."','".$retenu."','".$regul_cdf."','".$regul_usd."', '".$Regul."', '".$mois."', '".$annee."', '".$dat."', '".$statut."', '".$admin."', '".$ip_user."')";
                
                $res4 = $bd ->query($req4);

                if ($res4 == true) {
                  $req4x = "SELECT * FROM persalemens1_tb WHERE nom_complet ='$nom_personnel' AND statut ='en cours'";
                  $res4x = $bd ->query($req4x);

                  if ($res4x ->num_rows > 0) {
                    while($row4x = $res4x ->fetch_assoc()){
                      $brutot = $row4x['brutot2'];
                    }
                    $solde_usd = $brutot + $Regul;
                    $solde_usd1 = substr($solde_usd,0, 7);

                    $req5x = "SELECT * FROM persalemens2_tb WHERE nom_complet ='$nom_personnel' AND statut ='en cours' ";
                    $res5x = $bd ->query($req5x);

                    if ($res5x ->num_rows > 0) {
                      while ($row5x = $res5x ->fetch_assoc()) {
                        $Tot_reten = $row5x['tot_reten'];
                      }
                      $solde = $Tot_reten+$Regul;
                      $solde1 = substr($solde,0, 6);


                      $req4x1 ="UPDATE persalemens1_tb SET regular ='$Regul', brutot2 ='$solde_usd1', date_edit ='$dat' WHERE nom_complet ='$nom_personnel' AND statut ='en cours' ";
                      $res4x1 = $bd ->query($req4x1); 

                      $req5x1 ="UPDATE persalemens2_tb SET tot_advanc ='$Regul', tot_reten ='$solde1', date_edit ='$dat' WHERE nom_complet ='$nom_personnel' AND statut ='en cours' ";
                      $res5x1 = $bd ->query($req5x1);    

                      $req5x2 ="UPDATE tab_payfiche SET regular ='$Regul', tot_advanc ='$Regul', tot_reten ='$solde1', date_edit ='$dat' WHERE nom_complet ='$nom_personnel' AND statut ='en cours' ";
                      $res5x2 = $bd ->query($req5x2);   

                      if ($res4x1 ==  true && $res5x2 == true){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Avance-Pret et/ou regularisation pris en charge".'</div>';
                      } 
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Avance-Pret et/ou regularisation non pris en charge".'</div>';
                      }
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Avance-Pret et/ou regularisation prise en charge.".'</div>'; 
                    }
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Avance-Pret et/ou regularisation non prise en charge.".'</div>'; 
                  }
                  
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Avance-Pret et/ou regularisation non prise en charge.".'</div>'; 
                }
              }// Insertion de la situation financiere

            }// verification du compte de l'eleve
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Agent est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
        }
      }
    }//fin base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}
//fin Debut Zone Création Advance

//Paie_complementaire
function new_creat_decompte(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_decomp'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("y-m-d");
        $d_ida=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_ida." ".$h_id;
        $mois=date("F");
        $conc_id=md5($dat);
        $code_ref=substr($conc_id,0 ,5);
        $deban = substr($d_ida,6 ,8);
        $deban2 = $deban + 1;
        $annee_scolaire = $deban.'-'.$deban2;
        $admin = $_SESSION['pseudo'];
        $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
        $date_s =  $bd->real_escape_string($_POST['date_sortie']);
        $motif = $bd->real_escape_string($_POST['motif']);
        $classeres =  $bd->real_escape_string($_POST['classeres']);
        $taux =  $bd->real_escape_string($_POST['taux']);
        $jrprestes = $bd->real_escape_string($_POST['jrprestes']);
        $jrconge =  $bd->real_escape_string($_POST['jrconge']);
        $primdiv = $bd->real_escape_string($_POST['primdiv']);
        $retenues = $bd->real_escape_string($_POST['retenues']);
        $jrfin = $bd->real_escape_string($_POST['jrfin']);
        $annee = $bd->real_escape_string($_POST['annee']);
        $mois = $bd->real_escape_string($_POST['mois']);
        $statut = "fin";
        $status = "Désactiver";
        $params = 1;
        $ref_doc = $code_ref.substr($admin,0 ,3);
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
                
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe']; 
            $proville = $row['proville'];   
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif

            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND statut ='Actif'";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte de l'eleve
              while($row = $res2 ->fetch_assoc()){
                $id          = $row['id'];
                $compte_pers = $row['compte'];
                $nom_personnel = $row['nom_complet'];
                $depart      = $row['departement'];
                $service     = $row['service'];
                $fonction    = $row['fonction'];
                $contrat     = $row['contrat'];
                $date        = $row['date_debut'];
                $classe      = $row['Classe'];
                $classif     = $row['classification'];
              }
              $req2x = "SELECT * FROM perbaremsal_tb WHERE classe ='$classe' AND societe ='$societe' AND statut ='Actif'";
              $res2x = $bd->query($req2x);

              if ($res2x ->num_rows > 0) {
                while ($row = $res2x ->fetch_assoc()) {
                  $salairej = $row['salJourn'];
                  $transp   = $row['tranp'];
                  $indiv    = $row['indiv'];
                  $primres  = $row['primres_fix'];
                  $primperf = $row['primperf_fix'];
                  $primanc  = $row['primanc_fix'];
                }
                $tot = $primanc+$primperf+$primres;
                $diff = date_diff(date_create($date_s),date_create($date));
                $Years = $diff->y;
                $Mois = $diff->m;                
                $calcudate = $Years.','.$Mois;
                
                $req3 = "SELECT * FROM percompf1_tb WHERE nom_complet ='$nom_personnel' AND statut ='fin'";
                $res3 = $bd ->query($req3);

                if ($res3 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Situation financière agent déjà en cloturée".'</div>'; 
                }
                else{// Insertion de la situation financiere
                  if ($motif == "demission") {
                    $requete = "SELECT * FROM percompf1_tb WHERE codepaie = '$ref_doc' AND statut ='fin'";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                      if ($classeres == 'classifie') {
                        $Njcona = 18;
                        $Salanc = ($salairej*3/100)*$Years;
                        $classif1 = ((14*7)*$Years);
                        $Jrpreavd = $classif1/2;
                        $Jrcopreav = ($Njcona*$Jrpreavd)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Jrpreavd;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Jrpreavd*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*$jrfin;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req4 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, jrfin, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavclas, totjpreav, jrpreavd, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$jrfin."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$classif1."','".$Jrpreavd."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";                 
                        $res4 = $bd ->query($req4);

                        if ($res4 == true) {
                          $req4x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res4x = $bd ->query($req4x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4x1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req4x1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            
                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x1 = $bd ->query($req4x1);
                            $res4x1a = $bd ->query($req4x1a);

                            if ($res4x1 == true && $res4x1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non1 pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4x2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req4x1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x2 = $bd ->query($req4x2);
                            $res4x1b = $bd -> query($req4x1b);

                            if ($res4x2 == true && $res4x1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais classifie non pris en charge".'</div>';  
                        }
                      }//fin classifie
                      elseif ($classeres == 'maitrise') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $maitrise = ((14*7)*$Years);
                        $Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$Jrpreavd)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Jrpreavd;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Jrpreavd*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req5 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavmaitr, totjpreav, jrpreavd, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$maitrise."','".$Jrpreavd."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";     

                        /*INSERT INTO `percompf1_tb`(`id`, `proville`, `societe`, `code_societe`, `codepaie`, `departement`, `service`, `nom_complet`, `compte`, `fonction`, `contrat`, `date_debut`, `saljrn`, `transj`, `indiv`, `primes`, `date_sortie`, `motif`, `classe`, `tauxch`, `jrprestes`, `Jrcona`, `primdiv`, `retenues`, `njcona`, `ancien`, `aprest`, `mprest`, `salanc`, `preavclas`, `preavmaitr`, `preacadr`, `totjpreav`, `jrpreav1`, `jrpreavs`, `jrpreavd`, `jrpreavr`, `Jrpreav_tot`, `jrcopreav`, `jrcocomp`, `Jrtot`, `prestJrn`, `prestransp`, `indprim`, `prestot`, `preavsal`, `preaconge`, `preavitot`, `indcona`, `indcocomp`, `Indcotot`, `gratis`, `annuite`, `indlog`, `indfin`, `inddivtot`, `brutot`, `brutimpo`, `mois`, `annee`, `date_crea`, `date_edit`, `statut`, `customer`, `ip_user`)*/             
                        $res5 = $bd ->query($req5);
                                                                 
                        if ($res5 == true) {
                          $req5x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res5x = $bd ->query($req5x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req5x1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req5x1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res5x1 = $bd ->query($req5x1);
                            $res5x1a = $bd->query($req5x1a);

                            if ($res5x1 ==  true && $res5x1a == true && $resul ==true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req5x2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req5x2b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res5x2 = $bd ->query($req5x2);
                            $res5x2b = $bd ->query($req5x2b);

                            if ($res5x2 == true && $res5x2b && $resul ==true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais Maitrisse non pris en charge".'</div>';  
                        }
                      }//fin Maitrisse
                      elseif ($classeres == 'cadre') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $cadre = ((78*16)*$Years);
                        $Jrpreavd = $cadre/2;
                        $Jrcopreav = ($Njcona*$Jrpreavd)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Jrpreavd;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Jrpreavd*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req6 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preacadr, totjpreav, jrpreavd, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$cadre."','".$cadre."','".$Jrpreavd."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";  

                        $res6 = $bd ->query($req6);
                                                                 
                        if ($res6 == true) {
                          $req6x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res6x = $bd ->query($req6x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req6x1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req6x1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res6x1 = $bd ->query($req6x1);
                            $res6x1a = $bd ->query($req6x1a);

                            if ($res6x1 == true && $res6x1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req6x2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req6x1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavd."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res6x2 = $bd ->query($req6x2);
                            $res6x1b = $bd ->query($req6x1b);

                            if ($res6x2 == true && $res6x1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais cadre non pris en charge".'</div>';  
                        }
                      }//fin Cadre
                      else{
                        echo "echouée";
                      }
                    }
                  }//fIN Demission
                  elseif($motif == "licenciement-1") {
                    $requete = "SELECT * FROM percompf1_tb WHERE codepaie = '$ref_doc' AND statut ='fin'";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                      if ($classeres == 'classifie') {
                        $Njcona = 18;
                        $Salanc = ($salairej*3/100)*$Years;
                        $classif1 = ((14*7)*$Years);
                        //$Jrpreavd = $classif1/2;
                        $Jrcopreav = ($Njcona*$classif1)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$classif1;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $classif1*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req4a ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavclas, totjpreav, jrpreav1, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$classif1."','".$classif1."','".$classif1."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";                 
                        $res4a = $bd ->query($req4a);
                                                             
                        if ($res4a == true) {
                          $req4ax = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res4ax = $bd ->query($req4ax);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req4ax1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req4ax1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4ax1 = $bd ->query($req4ax1);
                            $res4ax1a = $bd ->query($req4ax1a);

                            if ($res4ax1 == true && $res4ax1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4ax2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req4ax1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4ax2 = $bd ->query($req4ax2);
                            $res4ax1b = $bd ->query($req4ax1b);

                            if ($res4ax2 == true && $res4ax1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais 2 non pris en charge".'</div>';  
                        }
                      }//fin classifie
                      elseif ($classeres == 'maitrise') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $maitrise = ((26*9)*$Years);
                        //$Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$maitrise)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$maitrise;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $maitrise*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req5a ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavmaitr, totjpreav, jrpreav1, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$maitrise."','".$maitrise."','".$maitrise."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";                   
                        $res5a = $bd ->query($req5a);
                                                                 
                        if ($res5a == true) {
                          $req5ax = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res5ax = $bd ->query($req5ax);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req5ax1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req5ax1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res5ax1 = $bd ->query($req5ax1);
                            $res5ax1a = $bd ->query($req5ax1a);

                            if ($res5ax1 == true && $res5ax1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req5ax2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req5ax1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res5ax2 = $bd ->query($req5ax2);
                            $res5ax1b = $bd ->query($req5ax1b);

                            if ($res5ax2 == true && $res5ax1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais 2 non pris en charge".'</div>';  
                        }
                      }//fin Maitrisse
                      elseif ($classeres == 'cadre') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $Cadre = ((78*16)*$Years);
                        //$Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$Cadre)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Cadre;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Cadre*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req6a = "INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preacadr, totjpreav, jrpreav1, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Cadre."','".$Cadre."','".$Cadre."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";                  
                        $res6a = $bd ->query($req6a);
                  
                        if ($res6a == true) {
                          $req6ax = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res6ax = $bd ->query($req6ax);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req6ax1 = "INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req6ax1a = "INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res6ax1 = $bd ->query($req6ax1);
                            $res6ax1a = $bd ->query($req6ax1a);

                            if ($res6ax1 == true && $res6ax1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req6ax2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req6ax1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res6ax2 = $bd ->query($req6ax2);
                            $res6ax1b = $bd ->query($req6ax1b);

                            if ($res6ax2 == true && $res6ax1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais licenciement-1 cadre non pris en charge".'</div>';  
                        }
                      }//fin Cadre
                      else{
                        echo "echouée";
                      }
                    }
                  }//Fin licenciement-1
                  elseif ($motif == "licenciement-2") {
                    $requete = "SELECT * FROM percompf1_tb WHERE codepaie = '$ref_doc' AND statut ='fin'";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                      if ($classeres == 'classifie') {
                        $Njcona = 18;
                        $Salanc = ($salairej*3/100)*$Years;
                        $classif1 = ((14*7)*$Years);
                        $Jrpreavs = 0;
                        //$Jrpreavd = $classif1/2;
                        $Jrcopreav = ($Njcona*$Jrpreavs)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Jrpreavs;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Jrpreavs*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req4a ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavclas, totjpreav, jrpreavs, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$classif1."','".$Jrpreavs."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";                 
                        $res4a = $bd ->query($req4a);
                                                             
                        if ($res4a == true) {
                          $req4ax = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif' ";
                          $res4ax = $bd ->query($req4ax);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req4ax1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req4ax1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4ax1 = $bd ->query($req4ax1);
                            $res4ax1a = $bd ->query($req4ax1a);

                            if ($res4ax1 == true && $res4ax1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4ax2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req4ax1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4ax2 = $bd ->query($req4ax2);
                            $res4ax1b = $bd ->query($req4ax1b);

                            if ($res4ax2 == true && $res4ax1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais 2 non pris en charge".'</div>';  
                        }
                      }//fin classifie
                      elseif ($classeres == 'maitrise') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $maitrise = ((26*9)*$Years);
                        $Jrpreavs = 0;
                        //$Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$Jrpreavs)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Jrpreavs;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Jrpreavs*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req8 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavmaitr, totjpreav, jrpreavs, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$maitrise."','".$Jrpreavs."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";               
                        $res8 = $bd ->query($req8);
                                                                 
                        if ($res8 == true) {
                          $req8x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif' ";
                          $res8x = $bd ->query($req8x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req8ax1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8ax1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res8ax1 = $bd ->query($req8ax1);
                            $res8ax1a = $bd ->query($req8ax1a);

                            if ($res8ax1 == true && $res8ax1a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req8ax2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8ax1b ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res8ax2 = $bd ->query($req8ax2);
                            $res8ax1b = $bd ->query($req8ax1b);

                            if ($res8ax2 == true && $res8ax1b == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais 2 non pris en charge".'</div>';  
                        }
                      }//fin Maitrisse
                      elseif ($classeres == 'cadre') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $Cadre = ((78*16)*$Years);
                        $Jrpreavs = 0;
                        //$Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$Jrpreavs)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Jrpreavs;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Jrpreavs*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req8a ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preacadr, totjpreav, jrpreavs, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Cadre."','".$Jrpreavs."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                        $res8a = $bd ->query($req8a);
                                                                 
                        if ($res8a == true) {
                          $req8ax = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res8ax = $bd ->query($req8ax);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req8bx1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8bx1a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res8bx1 = $bd ->query($req8bx1);
                            $res8bx1a = $bd ->query($req8bx1a);

                            if ($res8bx1 == true && $res8bx1a = true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req8bx2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8bx2a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Jrpreavs."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res8bx2 = $bd ->query($req8bx2);
                            $res8bx2a = $bd ->query($req8bx2a);

                            if ($res8bx2 == true && $res8bx2a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais 2 non pris en charge".'</div>';  
                        }
                      }//fin Cadre
                      else{
                        echo "echouée";
                      }
                    }
                  }//Fin licenciement-2
                  elseif ($motif == "retraite") {
                    $requete = "SELECT * FROM percompf1_tb WHERE codepaie = '$ref_doc' AND statut ='fin'";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                      if ($classeres == 'classifie') {
                        $Njcona = 18;
                        $Salanc = ($salairej*3/100)*$Years;
                        $classif1 = ((14*7)*$Years);
                        //$Jrpreavd = $classif1/2;
                        $Jrcopreav = ($Njcona*$classif1)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$classif1;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $classif1*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req4 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavclas, totjpreav, jrpreavr, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$classif1."','".$classif1."','".$classif1."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                        $res4 = $bd ->query($req4);

                        if ($res4 == true) {
                          $req4x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif' ";
                          $res4x = $bd ->query($req4x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req4x1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8bx2a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x1 = $bd ->query($req4x1);
                            $res8bx2a = $bd ->query($req8bx2a);

                            if ($res4x1 == true && $res8bx2a = true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement Retrait classifier non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4x2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8cx2a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$classif1."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x2 = $bd ->query($req4x2);
                            $res8cx2a = $bd ->query($req8cx2a);

                            if ($res4x2 == true && $res8cx2a = true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais 2 non pris en charge".'</div>';  
                        }
                      }//fin classifie
                      elseif ($classeres == 'maitrise') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $maitrise = ((26*9)*$Years);
                        //$Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$maitrise)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$maitrise;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $maitrise*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req4 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preavmaitr, totjpreav, jrpreavr, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$maitrise."','".$maitrise."','".$maitrise."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";                  
                        $res4 = $bd ->query($req4);

                        if ($res4 == true) {
                          $req4x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif' ";
                          $res4x = $bd ->query($req4x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req4x1 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8bx2a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x1 = $bd ->query($req4x1);
                            $res8bx2a = $bd ->query($req8bx2a);

                            if ($res4x1 == true && $res8bx2a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4x2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8cx2a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$maitrise."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x2 = $bd ->query($req4x2);
                            $res8cx2a = $bd ->query($req8cx2a);

                            if ($res4x2 == true && $res8cx2a = true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement Retrait maitrisse 2 non pris en charge".'</div>';  
                        }
                      }//fin Maitrisse
                      elseif ($classeres == 'cadre') {
                        $Njcona = 26;
                        $Salanc = ($salairej*3/100)*$Years;
                        $Cadre = ((78*16)*$Years);
                        //$Jrpreavd = $maitrise/2;
                        $Jrcopreav = ($Njcona*$Cadre)*312;
                        $Jrcopreav1 = substr($Jrcopreav,0, 5);
                        $Jrcocomp = ($Njcona*$Mois)/12;
                        $Jrcocomp1 = substr($Jrcocomp,0, 3);
                        $Jrtot = $jrprestes+$jrconge+$Jrcopreav+$Jrcocomp+$Cadre;
                        $PrestJrn = $salairej*$jrprestes;
                        $Prestransp = $transp*$jrprestes;
                        $Indprim = ($indiv+$tot)*$jrprestes;
                        $Prestot = $PrestJrn+$Prestransp+$Indprim;
                        $Preavsal = $Cadre*$salairej;
                        $Preaconge = $salairej*$Jrcopreav;
                        $Preavitot = $Preavsal+$Preaconge;
                        $Indcona = $salairej*$jrconge;
                        $Indcocomp = $salairej*$Jrcocomp;
                        $Indcotot = $Indcona+$Indcocomp;
                        $Gratis = ($salairej*($Mois*26))/12;
                        $annuite = $Salanc*$Jrtot;
                        $Indlog = ($Jrtot*$salairej)*30/100;
                        $Indfin = $salairej*26;
                        $inddivtot = $primdiv+$Gratis+$annuite+$Indlog+$Indfin;
                        $Brutot = $Prestot+$Preavitot+$Indcotot+$inddivtot;
                        $Brutimpo = $primdiv+$PrestJrn+$Indprim+$Preavitot+$Indcotot+$Gratis+$annuite+$Indfin;

                        $req4 ="INSERT INTO percompf1_tb(proville, societe, code_societe, codepaie, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe, tauxch, jrprestes, Jrcona, primdiv, retenues, njcona, ancien, aprest, mprest, salanc, preacadr, totjpreav, jrpreavr, Jrpreav_tot, jrcopreav, jrcocomp, Jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, Indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot, brutimpo, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$ref_doc."','".$depart."','".$service."', '".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$retenues."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Cadre."','".$Cadre."','".$Cadre."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";  
                        $res4 = $bd ->query($req4);

                        if ($res4 == true) {
                          $req41x = "SELECT * FROM percompf2_tb WHERE nom_complet ='$nom_personnel' AND ier_qpp ='$classif'";
                          $res41x = $bd ->query($req41x);

                          if ($classif == 'Expat') {
                            $requete = "SELECT * FROM percompf2_tb WHERE id ='0'";
                            $resultat = $bd ->query($requete);

                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);
                           
                            $req4x11 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, ier_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8bx2aa ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, ier_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$IER_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x11 = $bd ->query($req4x11);
                            $res8bx2aa = $bd ->query($req8bx2aa);

                            if ($res4x11 == true && $res8bx2aa == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                          else{
                            $IER_QPP = ($Brutot*25/100);
                            $IER_QPP1 = substr($IER_QPP,0, 8);
                            $CNSS_QPO = $Brutot*5/100;
                            $CNSS_QPO1 = substr($CNSS_QPO,0, 8);
                            $IPR_QPO = ($Brutot-$CNSS_QPO)*10/100;
                            $IPR_QPO1 = substr($IPR_QPO,0, 8);
                            $Totretenues = $CNSS_QPO+$IPR_QPO+$retenues;
                            $Totretenues1 = substr($Totretenues,0, 8);
                            $Cnss_QPP = $Brutot*13/100;
                            $Cnss_QPP1 = substr($Cnss_QPP,0, 8);
                            $Inpp_QPP = $Brutot*2/100;
                            $Onem_QPP = $Brutot*0.2/100;
                            $Onem_QPP1 = substr($Onem_QPP,0, 6);
                            $Tot_QPP = $Cnss_QPP+$Inpp_QPP+$Onem_QPP+$IER_QPP;
                            $Tot_QPP2 = substr($Tot_QPP,0, 9);
                            $Tot_QPO = $CNSS_QPO+$IPR_QPO;
                            $Tot_QPO1 = substr($Tot_QPO,0, 8);
                            $Net_pay_usd = $Brutot-$Totretenues;
                            $Net_pay_usd1 = substr($Net_pay_usd,0, 9);

                            $req4x2 ="INSERT INTO percompf2_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, contrat, brutot2, brutimpo2, cnss_qpo, ipr_qpo, retenues, totretenues, cnss_qpp, inpp_qpp, onem_qpp, tot_qpp, tot_qpo, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."','".$societe."','".$code_admin."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";
                            $req8cx2a ="INSERT INTO tab_payfinrecap(societe, codesoc, proville, departement, service, nom_complet, compte, fonction, contrat, date_debut, saljrn, transj, indiv, primes, date_sortie, motif, classe2, tauxch, jrprestes, Jrcona, primdiv, njcona, ancien, aprest, mprest, salanc, jrpreav_tot, jrcopreav, jrcocomp, jrtot, prestJrn, prestransp, indprim, prestot, preavsal, preaconge, preavitot, indcona, indcocomp, indcotot, gratis, annuite, indlog, indfin, inddivtot, brutot2, brutimpo2, cnss_QPO, ipr_QPO, retenues, totretenues, cnss_QPP, inpp_QPP, onem_QPP, tot_QPP, tot_QPO, net_pay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$societe."','".$code_admin."','".$proville."','".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$contrat."','".$date."','".$salairej."','".$transp."','".$indiv."','".$tot."','".$date_s."','".$motif."','".$classeres."','".$taux."','".$jrprestes."','".$jrconge."','".$primdiv."','".$Njcona."','".$calcudate."','".$Years."','".$Mois."','".$Salanc."','".$Cadre."','".$Jrcopreav1."','".$Jrcocomp1."','".$Jrtot."','".$PrestJrn."','".$Prestransp."','".$Indprim."','".$Prestot."','".$Preavsal."','".$Preaconge."','".$Preavitot."','".$Indcona."','".$Indcocomp."','".$Indcotot."','".$Gratis."','".$annuite."','".$Indlog."','".$Indfin."','".$inddivtot."','".$Brutot."','".$Brutimpo."','".$CNSS_QPO1."','".$IPR_QPO1."','".$retenues."','".$Totretenues1."','".$Cnss_QPP1."','".$Inpp_QPP."','".$Onem_QPP1."','".$Tot_QPP2."','".$Tot_QPO1."','".$Net_pay_usd1."','".$mois."','".$annee."','".$dat."','".$statut."','".$admin."','".$ip_user."')";

                            $slq ="UPDATE peragent_tb SET motif ='$motif', statut ='$status', customer ='$admin', date_fin ='$date_s' WHERE compte ='$compte_pers' AND codeSoc ='$code_admin'";
                            $resul = $bd->query($slq);

                            $res4x2 = $bd ->query($req4x2);
                            $res8cx2a = $bd ->query($req8cx2a);

                            if ($res4x2 == true && $res8cx2a == true && $resul == true){
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement frais scolaire pris en charge".'</div>';
                            }
                            else{
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement frais non pris en charge".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."paiement Retraite cadre 2 non pris en charge".'</div>';  
                        }
                      }//fin Cadre
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Enregistrement Retraite non prise en charge".'</div>';;
                      }
                    }
                  }//Retraite
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement Non pris en charge".'</div>';;
                  }
                }// Insertion de la situation financiere
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte bareme est inactif ou déjà cloturé".'</div>';
              }// verification du salaire d'un agent

            }// verification du compte de l'eleve
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte élève est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}//fin Paie_complementaire

//Debut Zone Heure supplementaire
function new_heuresupplemnt(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_heursup'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $admin = $_SESSION['pseudo'];
        $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
        $periode1 = $bd->real_escape_string($_POST['periode1']);
        $periode2 =  $bd->real_escape_string($_POST['periode2']);
        $tprime = $bd->real_escape_string($_POST['tprime']);
        $tnuit =  $bd->real_escape_string($_POST['tnuit']);
        $jrpreste = $bd->real_escape_string($_POST['jrpreste']);
        $jrnuit = $bd->real_escape_string($_POST['jrnuit']);
        $jrprime = $bd->real_escape_string($_POST['jrprime']);
        $heurprest = $bd->real_escape_string($_POST['heurprest']);
        $avancepret = $bd->real_escape_string($_POST['avancepret']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $annee = $bd-> real_escape_string($_POST['annee']);
        $mois = $bd->real_escape_string($_POST['mois']);
        $statut = "fin";
        $params = 1;
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
            $proville =$row['proville'];   
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif

            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nom_personnel' AND statut ='Actif' ORDER BY id ASC";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte personnel
              while($row = $res2 ->fetch_assoc()){
                $compte_pers = $row['compte'];
                $nom_personnel = $row['nom_complet'];
                $depart      = $row['departement'];
                $service     = $row['service'];
                $fonction    = $row['fonction'];
                $contrat     = $row['contrat'];
                $date        = $row['date_debut'];
                $classe      = $row['Classe'];
              }

              $req3 = "SELECT * FROM perbaremsal_tb WHERE classe ='$classe' AND societe ='$societe' AND statut ='Actif'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                while ($row = $res3 ->fetch_assoc()) {
                  $classe      = $row['classe'];
                  $saljr = $row['salJourn'];
                  $tranp = $row['tranp'];
                }
                $req3x = "SELECT * FROM percompsup_tb WHERE nom_complet ='$nom_personnel' AND statut ='$statut'";
                $res3x = $bd ->query($req3x);
                if ($res3x ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Agent existe déjà".'</div>';
                }
              
                else{// Insertion de la situation financiere
                    $Saljourn = $saljr*$jrpreste;
                    $Salhs    = ($saljr/8)*$heurprest;
                    $Salnuit  = $tnuit*$jrnuit;
                    $Salprim  = $tprime*$jrprime;
                    $Transp   = $tranp*$jrpreste;
                    $Logmt    = $Saljourn*0.3;
                    $Saltot   = $Saljourn+$Salhs+$Salnuit+$Salprim+$Transp+$Logmt;
                    $Netpay_usd = $Saltot-$avancepret;

                    $req4 = "INSERT INTO percompsup_tb(proville, societe, code_soc, departement, service, nom_complet, compte, fonction, date_debut, saljrn, transj, periode1, periode2, tprim, tnuit, tauxch, jrpreste, hrpreste, jrnuit, jrprim, advances, saljourn, salhs, salnuit, salprim, transp, logmt, saltot, netpay_usd, mois, annee, date_crea, statut, customer, ip_user) VALUES ('".$proville."', '".$societe."','".$code_admin."', '".$depart."','".$service."','".$nom_personnel."','".$compte_pers."','".$fonction."','".$date."','".$saljr."','".$tranp."', '".$periode1."','".$periode2."','".$tprime."','".$tnuit."','".$taux."','".$jrpreste."','".$heurprest."','".$jrnuit."','".$jrprime."','".$avancepret."','".$Saljourn."','".$Salhs."','".$Salnuit."','".$Salprim."','".$Transp."','".$Logmt."','".$Saltot."','".$Netpay_usd."','".$mois."','".$annee."','".$dat."', '".$statut."','".$admin."', '".$ip_user."')";
                    $res4 = $bd ->query($req4);

                    if ($res4 == true) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement decompte pris en charge".'</div>';
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Paiement decompte non pris en charge".'</div>';
                    }
                 
                  /*INSERT INTO `percompsup_tb`(`id`, `proville`, `societe`, `code_soc`, `departement`, `service`, `nom_complet`, `compte`, `fonction`, `date_debut`, `saljrn`, `transj`, `periode1`, `periode2`, `tprim`, `tnuit`, `tauxch`, `jrpreste`, `hrpreste`, `jrnuit`, `jrprim`, `advances`, `saljourn`, `salhs`, `salnuit`, `salprim`, `transp`, `logmt`, `saltot`, `netpay_usd`, `mois`, `annee`, `date_crea`, `date_edit`, `statut`, `customer`, `ip_user`) */

                }// Insertion de la situation financiere
              }
            }// verification du compte de l'eleve
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Element est inactif ou déjà cloturé".'</div>';  
            }
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
          }
        }// verification du compte administratif
        else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}//Fin function heure supplementaire

//Debut Zone d'Enregistrement Conge Personnel
function new_conge(){ // debut 
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_conge'])) {
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
        $nomagent = $bd->real_escape_string($_POST['nomagent']);
        $fonction = $bd->real_escape_string($_POST['fonction']);
        $depart = $bd->real_escape_string($_POST['depart']);
        $datedebut = $bd->real_escape_string($_POST['datedebut']);
        $dateprevu = $bd->real_escape_string($_POST['dateprevu']);
        $datefin = $bd->real_escape_string($_POST['datefin']);
        $jourfer = $bd->real_escape_string($_POST['jourfer']);
        $jrouvr = $bd->real_escape_string($_POST['jrouvr']);
        $typeconge = $bd->real_escape_string($_POST['typeconge']);
        $natureconge = $bd->real_escape_string($_POST['natureconge']);
        $dimnch = $bd->real_escape_string($_POST['dimnch']);
        $dimanche = 3;
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
            $proville = $row['proville'];    
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif
            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nomagent' AND statut ='Actif'";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte personnel
              while($row = $res2 ->fetch_assoc()){
                $localiser = $row['site'];
                $direction = $row['direction'];
              }
              $Tot_Jrep = $dimnch+$jourfer;
              $Tot_jr = $Tot_Jrep+$jrouvr;

              $to_date = strtotime("$dateprevu");
              $from_date = strtotime("$datefin");
              $day_diff = $from_date-$to_date;
              $Jr_conge = floor($day_diff/(60*60*24))-$Tot_Jrep;
              $Diff = $Jr_conge-$jrouvr;

              //$date1 = date('Y-m-d');
              $date = new DateTime($dateprevu);
              $m = $Tot_jr+1;
              $jr =+$m.' day';
              $date->modify($jr);
              //echo $date->format('Y-m-d');
              $Date_retour = $date->format('Y-m-d');
              
              $req3 = "SELECT * FROM perconge WHERE statut ='desactiver'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Cet Utilisateur existe déjà...".'</div>'; 
              }
              else{// Insertion de la situation financiere
                $req4 = "INSERT INTO perconge(codeSoc, societe, site, direction, departement, noms, fonction, date_debut, categorie, nature, jr_ouvr, date_depart, estimation_retour, dimanche, jrferie, tot_Jrep, tot_jr, jr_conge, diff, date_retour, statut, date_crea, customer, ip_user) 
                                VALUES ('".$code_admin."','".$societe."','".$localiser."','".$direction."','".$depart."','".$nomagent."','".$fonction."','".$datedebut."','".$typeconge."','".$natureconge."','".$jrouvr."','".$dateprevu."','".$datefin."','".$dimnch."','".$jourfer."','".$Tot_Jrep."','".$Tot_jr."','".$Jr_conge."','".$Diff."','".$Date_retour."','".$statut."','".$dat."','".$admin."','".$ip_user."')";
                $res4 = $bd ->query($req4);

                if ($res4 == true) {
                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Demande de congé à été accepter.'.'</div>';
                }
                else{
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Demande de congé a refuse.".'</div>'; 
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
//Fin Zone d'Enregistrement Conge Personnel

//Debut Zone Update Conge Personnel
function UpdatePers_conge(){ // debut 
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_Upconge'])) {
      if (empty($_GET['ID'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
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
          $conc_id=md5($dat);
          $code_user=substr($conc_id,0 ,5);
          $nomagent = $bd->real_escape_string($_POST['nomagent']);
          $fonction = $bd->real_escape_string($_POST['fonction']);
          $depart = $bd->real_escape_string($_POST['depart']);
          $datedebut = $bd->real_escape_string($_POST['datedebut']);
          $dateprevu = $bd->real_escape_string($_POST['dateprevu']);
          $datefin = $bd->real_escape_string($_POST['datefin']);
          $jourfer = $bd->real_escape_string($_POST['jourfer']);
          $jrouvr = $bd->real_escape_string($_POST['jrouvr']);
          $typeconge = $bd->real_escape_string($_POST['typeconge']);
          $natureconge = $bd->real_escape_string($_POST['natureconge']);
          $dimnch = $bd->real_escape_string($_POST['dimnch']);
          $params = 1;
          $statut ="Actif";
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
                  
          $requete = "SELECT * FROM admin_tb WHERE droit=1 AND pseudo='".$_SESSION['pseudo']."'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows < 0) {// verification du compte administratif
            while($row = $resultats ->fetch_assoc()){
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
            }
          }// verification du compte administratif
          else{
            $Tot_Jrep = $dimnch+$jourfer;
            $Tot_jr = $Tot_Jrep+$jrouvr;

            $to_date = strtotime("$dateprevu");
            $from_date = strtotime("$datefin");
            $day_diff = $from_date-$to_date;
            $Jr_conge = floor($day_diff/(60*60*24))-$Tot_Jrep;
            $Diff = $Jr_conge-$jrouvr;

            //$date1 = date('Y-m-d');
            $date = new DateTime($dateprevu);
            $m = $Tot_jr+1;
            $jr =+$m.' day';
            $date->modify($jr);
            //echo $date->format('Y-m-d');
            $Date_retour = $date->format('Y-m-d');
            
            $req ="UPDATE perconge SET departement ='$depart', noms ='$nomagent', fonction ='$fonction', date_debut ='$datedebut', categorie ='$typeconge', nature ='$natureconge', jr_ouvr ='$jrouvr', date_depart ='$dateprevu', estimation_retour ='$datefin',
                                       dimanche ='$dimnch', jrferie ='$jourfer', tot_Jrep ='$Tot_Jrep', tot_jr ='$Tot_jr', jr_conge ='$Jr_conge', diff ='$Diff', date_retour ='$Date_retour', date_edit ='$dat', customer ='$admin' WHERE id ='$ID_pers'";
            $res = $bd->query($req);
            if ($res == true) {
              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Demande de congé à été Modifier avec succès.'.'</div>';
            }
            else {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="mess">'.'Demande de congé à été Modifier avec succès.'.'</div>';
            }
          }
        }
        $bd->close();
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}
//Fin Zone Update Conge Personnel

// Maj Pers Agent Activer ou Inactiver
function Maj_persagent(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_Majagent'])) {
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
          $maj_pers = $bd->real_escape_string($_POST['maj_pers']);
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
                      
          if (!filter_var($maj_pers)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                  "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            $requete = "SELECT * FROM  admin_tb WHERE params='$params' AND pseudo='".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows < 0) {
              while($row = $resultats ->fetch_assoc()){
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
              }
            }
            else{// code admin
              $sql ="UPDATE peragent_tb SET statut ='$maj_pers', customer ='$customer' WHERE id ='$ID_pers'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification à été effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification Agent echouée.'.'</div>'; 
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
//fin mise à jour Pers Agent

//Debut Zone Conge Personnel
function new_persoins(){ // debut 
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_soins'])) {
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
        $code_user=substr($conc_id,0 ,3);
        $nomdestin = $bd->real_escape_string($_POST['nomdestin']);
        $traitemnt = $bd->real_escape_string($_POST['traitemnt']);
        $nomagent = $bd->real_escape_string($_POST['nomagent']);
        $depart = $bd->real_escape_string($_POST['depart']);
        $nombenfic = $bd->real_escape_string($_POST['nombenfic']);
        $bqualite = $bd->real_escape_string($_POST['bqualite']);
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
            $proville = $row['proville'];    
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif
            $req2 = "SELECT * FROM peragent_tb WHERE nom_complet ='$nomagent' AND statut ='Actif'";
            $res2 = $bd ->query($req2); 

            if ($res2 ->num_rows > 0) {// verification du compte personnel
              while($row = $res2 ->fetch_assoc()){
                $localiser = $row['site'];
                $direction = $row['direction'];
                $depart = $row['departement'];
                $fonction = $row['fonction'];
              }
              $req3 ="SELECT * FROM tab_center";
              $res3 = $bd->query($req3);

              if ($res3 ->num_rows > 0) {
                while ($row1 = $res3 ->fetch_assoc()) {
                  $codeH     = $row1['code_esc'];
                  $Hopital   = $row1['etablissement'];
                  $telephone = $row1['tel_esc'];
                  $adresse   = $row1['adresse'];
                }
                $req4 ="SELECT * FROM tab_persoins";
                $res4 =$bd->query($req4);

                if ($res4 ->num_rows < 0) {
                  while ($row2 = $res4 ->fetch_assoc()) {
                    $id = $row2['id'];
                  }
                  $n = $id ++;
                }
                else {
                  $numCompte = $societe.'-'.$code_user;
                  $requet ="INSERT INTO tab_persoins(ref, site, direction, departement, fonction, traitement, demandeur, ref_dem, destinataire_noms, destinataire_adresse, destinataire_tel, agent, beneficiare_noms, beneficiaire_qualite, prepare_par, ip_user) 
                                                      VALUES ('".$numCompte."','".$localiser."','".$direction."','".$depart."','".$fonction."','".$traitemnt."','".$societe."','".$code_admin."','".$nomdestin."','".$adresse."','".$telephone."','".$nomagent."','".$nombenfic."','".$bqualite."','".$admin."','".$ip_user."')";
                  $result = $bd->query($requet);

                  if ($result == true) {
                      echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess" style="font-size:17px">'.' Billet d\'envoi  à été accepter.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Billet d'envoi a refuse.".'</div>'; 
                  }
                }
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Hospitalier est inactif ou déjà cloturé".'</div>';
              }
            }// verification du compte agent
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Utilisateur est inactif ou déjà cloturé1".'</div>';  
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


//Debut Zone Personnel Agent
function Update_classe   (){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_ClasseUP'])) {
      include("connexion.php");
      if (empty($_GET['Compte']) && empty($_GET['ID'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $comptpers = $_GET['Compte'];
        $ID_pers = $_GET['ID'];
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $d_id=date("d-m-y");
          $h_id=date("h:i:s");
          $dat=$d_id." ".$h_id;
          $admin = $_SESSION['pseudo'];
          $nomagent = $bd->real_escape_string($_POST['nomagent']);
          $direct = $bd->real_escape_string($_POST['direct']);
          $classe =  $bd->real_escape_string($_POST['classe']);
          $primres_fix = $bd->real_escape_string($_POST['primres_fix']);
          $primperf_fix = $bd->real_escape_string($_POST['primperf_fix']);
          $primanc_fix = $bd->real_escape_string($_POST['primanc_fix']);
          $params = 1;
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {// verification du compte administratif
            while($row = $resultats ->fetch_assoc()){
              $code_admin = $row['code_admin'];
              $societe = $row['societe'];
              $proville =$row['proville'];   
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
            $res1 = $bd ->query($req1);

            if ($res1 ->num_rows > 0) {// verification de droit administratif
              $req3 = "SELECT * FROM perbaremsal_tb WHERE direction ='$direct' AND classe ='$classe' AND societe ='$societe'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                while ($row = $res3 ->fetch_assoc()) {
                  $classe      = $row['classe'];
                  $categ       = $row['categ'];
                  $indiv       = $row['indiv'];
                  $description = $row['description'];
                  $salJourn = $row['salJourn'];
                  $tranp = $row['tranp'];
                  $alFam = $row['alFam'];
                }
                $salm = ($salJourn*2)/3;
                $salm_m =substr($salm,0 ,4);
                $salaire_horair = ($salJourn/8);
                //$sal_hor =substr($salaire_horair,0 ,4);
                $logement = (($salJourn*26)*30/100);
                //$lgmnt =substr($logement,0 ,6);

                $req3x = "SELECT * FROM peragent_tb WHERE statut ='en coure'";
                $res3x = $bd ->query($req3x);
                
                if ($res3x ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Agent existe déjà".'</div>';
                }
                else{// Insertion de la situation financiere
                  $req4 ="UPDATE peragent_tb SET direction ='$direct', categ ='$categ', Classe ='$classe' WHERE compte ='$comptpers' AND id ='$ID_pers'";

                  $req5 ="UPDATE perbasesal_tb SET nom_complet ='$nomagent', direct ='$direct', categ ='$categ', Classe ='$classe', salbase_J ='$salJourn', sal_m ='$salm_m', sal_circ ='$salm_m', sal_hor ='$salaire_horair', Lgmt ='$logement', alfam_tx ='$alFam', transp_J ='$tranp', t_CA ='$salJourn', 
                  Ind_div ='$indiv', primanc ='$primanc_fix', primperf ='$primperf_fix', primres ='$primres_fix', date_edit ='$dat', customer ='$admin', ip_user ='$ip_user' WHERE compte ='$comptpers' AND id ='$ID_pers' ";

                  $res4 = $bd ->query($req4);
                  $res5 = $bd->query($req5);

                  if ($res4 == true && $res5 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Nouvelle mise à jour Classe prise en charge.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nouvelle mise à jour Classe non prise en charge.".'</div>'; 
                  }
                }// Insertion de la situation financiere

              }// verification du compte agent
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'." Compte Agent est inactif ou déjà cloturé".'</div>';  
              }
            }// verification de droit administratif
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
            }
          }// verification du compte administratif
          else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Votre compte est invalide".'</div>';
          }
        }
      }
    }//fin  base de données
  }
  else{
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}

//Enregistrement facture personnel
function new_frais_perso(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_PPaieFrais'])) {
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $d_id = date("y-m-d");
        $d_ida = date("d-m-y");
        $h_id = date("h:i:s");
        $dat = $d_ida . " " . $h_id;
        $conc_id = md5($dat);
        $code_ref = substr($conc_id, 0, 5);
        $deban = substr($d_ida, 6, 8);
        $deban2 = $deban + 1;
        //$annee_scolaire = $deban.'-'.$deban2;
        $admin = $_SESSION['pseudo'];
        $compte_pers = $bd->real_escape_string($_POST['compte_pers']);
        $nature_operation =  $bd->real_escape_string($_POST['nature_operation']);
        $compte_debit = $bd->real_escape_string($_POST['compte_debit']);
        $devise =  $bd->real_escape_string($_POST['devise']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $date_doc =  $bd->real_escape_string($_POST['date_doc']);
        $montant_frais = $bd->real_escape_string($_POST['montant_frais']);
        $libelle_frais = $bd->real_escape_string($_POST['libelle_frais']);
        //$ref_doc = $bd->real_escape_string($_POST['ref_doc']);
        $annee_scolaire = $bd->real_escape_string($_POST['annee_scolaire']);
        $statut = "en cours";
        $params = 1;
        $ref_doc = $code_ref . substr($admin, 0, 3);
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);

        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) { // verification du compte administratif
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $codesoc = $row['code_soc'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) { // verification de droit administratif

            $req2 = "SELECT * FROM compta_pers WHERE compte ='$compte_pers' AND societe='$societe' AND statut ='Actif'";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) { // verification du compte de l'eleve
              while ($row = $res2->fetch_assoc()) {
                $compte_pers = $row['compte'];
                $noms = $row['nom_complet'];
              }

              $req3 = "SELECT * FROM finance_pers WHERE compte ='$compte_pers' AND statut ='fin'";
              $res3 = $bd->query($req3);

              if ($res3->num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Situation financière de personnel déjà en cloturée" . '</div>';
              } else { // Insertion de la situation financiere

                if ($nature_operation == "entree") {
                  $requete = "SELECT * FROM comptes_pers WHERE ref_doc = '$ref_doc' AND societe='$societe' AND statut ='en cours'";
                  $resultat = $bd->query($requete);

                  if ($resultat->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                  } else {
                    if ($devise == 'USD') {
                      $req4 = "INSERT INTO comptes_pers(code_soc, societe, ref_doc, compte_debit,nom_complet,compte_credit, nature_operation, libelle, devise, taux, montant, debits_usd, 
                                                        date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$noms."','".$compte_pers."','".$nature_operation."','".$libelle_frais."',
                                                    '".$devise."','".$taux."','".$montant_frais."','".$montant_frais."','".$date_doc."','".$annee_scolaire."',
                                                    '" . $statut . "','".$dat."','".$d_id."','".$admin."','".$ip_user."')";
                      $req4xr = "INSERT INTO comptes_encodage(code_soc, societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              debits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$noms."','".$compte_pers. "','".$nature_operation ."','".$libelle_frais."',
                                                    '".$devise."','".$taux."','".$montant_frais."','".$montant_frais."','".$date_doc."',
                                                    '".$annee_scolaire."','".$statut."', '" .$dat ."','".$d_id."','".$admin ."','" .$ip_user ."')";
                      $res4 = $bd->query($req4);
                      $res4xr = $bd->query($req4xr);

                      if ($res4 == true && $res4xr == true) {
                        $seq = "SELECT * FROM compta_pers WHERE compte ='$compte_pers' AND societe='$societe'";
                        $result = $bd->query($seq);

                        if ($result ->num_rows > 0) {
                          while ($row1 = $result ->fetch_assoc()) {
                            $reportUSD = $row1['solde1_usd'];
                            $DebitUSD = $row1['debit_usd'];
                            $CreditUSD = $row1['Credit_usd'];
                          }
                          $deb_USD = $DebitUSD + $montant_frais;
                          $Sold_USD = ($reportUSD + $CreditUSD) - $deb_USD;
                          $seq1 = "UPDATE compta_pers SET debit_usd ='$deb_USD', soldeUSD ='$Sold_USD' WHERE compte ='$compte_pers' AND societe='$societe'";
                          $result1 = $bd->query($seq1);

                          if ($result1 == true) {
                            $autre ="SELECT * FROM compta_autres WHERE descriptions='$compte_debit' AND societe='$societe'";
                            $sort = $bd->query($autre);

                            if ($sort ->num_rows > 0) {
                              while ($row = $sort ->fetch_assoc()) {
                                $ReportUSD = $row['solde1_usd'];
                                $CreditUSD = $row['credit2_usd'];
                                $DebitUSD  = $row['debit2_usd'];
                                $TotauxUSD = $row['Totaux_debit_usd'];
                              }
                              //Equation 1
                              $deb_usd = $DebitUSD + $montant_frais;
                              $Solde_USD = ($deb_usd + $ReportUSD) - $CreditUSD;
                              //Equation 2
                              $Total_debit_USD = $TotauxUSD + $montant_frais;

                              $resul ="UPDATE compta_autres SET debit2_usd='$deb_usd', solde2_usd='$Solde_USD', Totaux_debit_usd='$Total_debit_USD' WHERE descriptions='$compte_debit' AND societe='$societe'";
                              $req =$bd->query($resul);

                              if ($req == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais Personnel pris en charge" . '</div>';
                              }
                            }
                            else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                            }
                          }
                          else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais Personnel non pris en charge" . '</div>';
                          }
                        }
                        else {
                          //Insertion de la partie recouvremant
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Recouvrement invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                          //Insertion de la partie recouvremant
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais Personnel non pris en charge" . '</div>';
                      }
                    } else {
                      $req5 = "INSERT INTO comptes_pers(code_soc, societe, ref_doc, compte_debit,nom_complet,compte_credit, nature_operation, libelle, devise, taux, montant, debits_cdf, 
                                                      date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."','".$noms."','".$compte_pers."','".$nature_operation."',
                                                      '".$libelle_frais . "','".$devise."', '".$taux."','".$montant_frais."','".$montant_frais."', 
                                                      '".$date_doc."','".$annee_scolaire."','".$statut."', '".$dat."', '".$d_id."', '".$admin."',
                                                      '".$ip_user."')";
                      $req5xr = "INSERT INTO comptes_encodage(code_soc, societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              debits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$noms."','".$compte_pers. "','".$nature_operation ."','".$libelle_frais."',
                                                    '".$devise."','".$taux."','".$montant_frais."','".$montant_frais."','".$date_doc."',
                                                    '".$annee_scolaire."','".$statut."', '" .$dat ."','".$d_id."','".$admin ."','" .$ip_user ."')";
                      $res5 = $bd->query($req5);
                      $res5xr = $bd->query($req5xr);

                      if ($res5 == true && $res5xr == true) {
                        $seq5 = "SELECT * FROM compta_pers WHERE compte ='$compte_pers' AND societe='$societe'";
                        $result2 = $bd->query($seq5);

                        if ($result2 ->num_rows > 0) {
                          while ($row2 = $result2 ->fetch_assoc()) {
                            $reportCDF = $row2['solde1_cdf'];
                            $DebitCDF = $row2['debit_cdf'];
                            $CreditCDF = $row2['Credit_cdf'];
                          }
                          $deb_CDF = $DebitCDF + $montant_frais;
                          $Sold_CDF = ($reportCDF + $CreditCDF) - $deb_CDF;
                          $seq2 = "UPDATE compta_pers SET debit_cdf ='$deb_CDF', soldeCDF ='$Sold_CDF' WHERE compte ='$compte_pers' AND societe='$societe'";
                          $result3 = $bd->query($seq2);

                          if ($result3 == true) {
                            $autre = "SELECT * FROM compta_autres WHERE descriptions='$compte_debit' AND societe='$societe'";
                            $sort = $bd->query($autre);

                            if ($sort->num_rows > 0) {
                              while ($row = $sort->fetch_assoc()) {
                                $ReportCDF = $row['solde1_cdf'];
                                $CreditCDF = $row['credit2_cdf'];
                                $DebitCDF  = $row['debit2_cdf'];
                                $TotauxUSD = $row['Totaux_debit_usd'];
                              }
                              //Equation 1
                              $deb_cdf = $DebitCDF + $montant_frais;
                              $Solde_CDF = ($deb_cdf + $ReportCDF) - $CreditCDF;
                              //Equation 2
                              $convertir = $montant_frais / $taux;
                              $Total_debit_CDF = $TotauxUSD + $convertir; 

                              $resul = "UPDATE compta_autres SET debit2_cdf='$deb_cdf', solde2_cdf='$Solde_CDF', Totaux_debit_usd='$Total_debit_CDF' WHERE societe='$societe' AND descriptions='$compte_debit'";
                              $req = $bd->query($resul);

                              if ($req == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais Personnel pris en charge" . '</div>';
                              }
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                            }
                            //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais Personnel pris en charge" . '</div>';
                          }
                          else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais Personnel non pris en charge" . '</div>';
                          }
                        }
                        else {
                          //Insertion de la partie recouvremant
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Recouvrement invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                          //Insertion de la partie recouvremant
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais Personnel non pris en charge" . '</div>';
                      }
                    }
                  }
                } else {

                  if ($nature_operation == "sortie") {
                    $requete = "SELECT * FROM comptes_pers WHERE ref_doc ='$ref_doc' AND statut ='en cours' AND societe='$societe'";
                    $resultat = $bd->query($requete);

                    if ($resultat->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                    } else {
                      if ($devise == 'USD') {
                        $req6 = "INSERT INTO comptes_pers(code_soc, societe, ref_doc, compte_debit,nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, credits_usd, 
                                                          date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."', '".$noms."','".$compte_pers."','".$nature_operation."',
                                                      '".$libelle_frais."','".$devise."', '".$taux."','".$montant_frais."','".$montant_frais."', 
                                                      '".$date_doc."','".$annee_scolaire."','".$statut."', '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $req6xr = "INSERT INTO comptes_encodage(code_soc, societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              credits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$noms."','".$compte_pers."','".$nature_operation."','".$libelle_frais . "',
                                                    '".$devise."','".$taux . "','" . $montant_frais."','".$montant_frais."','".$date_doc."',
                                                    '".$annee_scolaire."','".$statut."', '".$dat."','".$d_id . "','".$admin."','".$ip_user."')";
                        $res6 = $bd->query($req6);
                        $res6xr = $bd->query($req6xr);

                        if ($res6 == true && $res6xr == true) {
                          $seq6 = "SELECT * FROM compta_pers WHERE compte ='$compte_pers' AND societe='$societe'";
                          $result4 = $bd->query($seq6);

                          if ($result4->num_rows > 0) {
                            while ($row2 = $result4->fetch_assoc()) {
                              $reportUSD = $row2['solde1_usd'];
                              $DebitUSD = $row2['debit_usd'];
                              $CreditUSD = $row2['Credit_usd'];
                            }
                            $cred_USD = $CreditUSD + $montant_frais;
                            $Sold_USD = ($reportUSD + $cred_USD) - $DebitUSD;
                            $seq7 = "UPDATE compta_pers SET Credit_usd ='$cred_USD', soldeUSD ='$Sold_USD' WHERE societe='$societe' AND compte ='$compte_pers'";
                            $result5 = $bd->query($seq7);

                            if ($result5 == true) {
                              $autre = "SELECT * FROM compta_autres WHERE societe='$societe' AND descriptions='$compte_debit'";
                              $sort = $bd->query($autre);

                              if ($sort->num_rows > 0) {
                                while ($row = $sort->fetch_assoc()) {
                                  $ReportUSD = $row['solde1_usd'];
                                  $CreditUSD = $row['credit2_usd'];
                                  $DebitUSD  = $row['debit2_usd'];
                                  $TotauxCUSD = $row['Totaux_credit_usd'];
                                }
                                //Equation 1
                                $cred_usd = $CreditUSD + $montant_frais;
                                $Solde_USD = ($DebitUSD + $ReportUSD) - $cred_usd;
                                //Equation 2
                                $Total_credit_USD = $TotauxCUSD + $montant_frais;

                                $resul = "UPDATE compta_autres SET credit2_usd='$cred_usd', solde2_usd='$Solde_USD', Totaux_credit_usd='$Total_credit_USD' WHERE societe ='$societe' AND descriptions='$compte_debit'";
                                $req = $bd->query($resul);

                                if ($req == true) {
                                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit effectué".'</div>';
                                }
                              } else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                              }
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit non effectué".'</div>';
                            }
                          } else {
                            //Insertion de la partie recouvremant
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Recouvrement invalide".'&nbsp;'.'<a href="encodage.php">'.'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                            //Insertion de la partie recouvremant
                          }
                        } else {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit non effectué".'</div>';
                        }
                      } else {
                        $req7 = "INSERT INTO comptes_pers(code_soc, societe, ref_doc, compte_debit,nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, credits_cdf, 
                                                          date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."', '".$noms."','".$compte_pers."','".$nature_operation."',
                                                      '".$libelle_frais."','".$devise."', '".$taux."','".$montant_frais."','".$montant_frais."', 
                                                      '".$date_doc."','".$annee_scolaire."','".$statut."', '".$dat."','".$d_id."','".$admin."',
                                                      '".$ip_user."')";
                        $req7xr = "INSERT INTO comptes_encodage(code_soc, societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              credits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$noms."','".$compte_pers."','".$nature_operation."','".$libelle_frais."',
                                                    '".$devise."','".$taux."','".$montant_frais."','".$montant_frais."','" .$date_doc."',
                                                    '".$annee_scolaire."','".$statut."', '".$dat."','".$d_id."','".$admin."','".$ip_user."')";
                        $res7 = $bd->query($req7);
                        $res7xr = $bd->query($req7xr);

                        if ($res7 == true && $res7xr == true) {
                          $seq7 = "SELECT * FROM compta_pers WHERE societe='$societe' AND compte ='$compte_pers'";
                          $result5 = $bd->query($seq7);

                          if ($result5 ->num_rows > 0) {
                            while ($row2 = $result5->fetch_assoc()) {
                              $reportCDF = $row2['solde1_cdf'];
                              $DebitCDF = $row2['debit_cdf'];
                              $CreditCDF = $row2['Credit_cdf'];
                            }
                            $cred_CDF = $CreditCDF + $montant_frais;
                            $Sold_CDF = ($reportCDF + $cred_CDF) - $DebitCDF;
                            $seq8 = "UPDATE compta_pers SET Credit_cdf ='$cred_CDF', soldeCDF ='$Sold_CDF' WHERE societe='$societe' AND compte ='$compte_pers'";
                            $result8 = $bd->query($seq8);

                            if ($result8 == true) {
                              $autre = "SELECT * FROM compta_autres WHERE societe='$societe' AND descriptions='$compte_debit'";
                              $sort = $bd->query($autre);

                              if ($sort->num_rows > 0) {
                                while ($row = $sort->fetch_assoc()) {
                                  $ReportCDF = $row['solde1_cdf'];
                                  $CreditCDF = $row['credit2_cdf'];
                                  $DebitCDF  = $row['debit2_cdf'];
                                  $TotauxCCDF = $row['Totaux_credit_usd'];
                                }
                                //Equation 1
                                $cred_cdf = $CreditCDF + $montant_frais;
                                $Solde_CDF = ($DebitCDF + $ReportCDF) - $cred_cdf;
                                //Equation 2
                                $Total_credit_CDF = $TotauxCCDF + $montant_frais;

                                $resul = "UPDATE compta_autres SET credit2_cdf='$cred_cdf', solde2_cdf='$Solde_CDF', Totaux_credit_usd='$Total_credit_CDF' WHERE societe='$societe' AND descriptions='$compte_debit'";
                                $req = $bd->query($resul);

                                if ($req == true) {
                                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit effectué" . '</div>';
                                }
                              } else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                              }
                              //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit effectué".'</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit non effectué".'</div>';
                            }
                          } else {
                            //Insertion de la partie recouvremant
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Recouvrement invalide".'&nbsp;'.'<a href="encodage.php">'.'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                            //Insertion de la partie recouvremant
                          }
                        } else {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                        }
                      }
                    }
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Nature d'operation invalide" . '</div>';
                  }
                }
              } // Insertion de la situation financiere

            } // verification du compte de l'eleve
            else {
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . " Compte Personnel est inactif ou déjà cloturé" . '</div>';
            }
          } // verification de droit administratif
          else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration trouvé' . '</div>';
          }
        } // verification du compte administratif
        else {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide" . '</div>';
        }
      }
    } //fin  base de données
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
}


?>