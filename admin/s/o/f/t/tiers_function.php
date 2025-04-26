<?php

function new_tiers(){ // debut creation Compte Tiers
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_tiers'])) {
      include("connexion.php");
      if ($bd->connect_error
      ) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $d_id = date("d-m-y");
        $h_id = date("h:i:s");
        $dat = $d_id . " " . $h_id;
        $conc_id = md5($dat);
        $code_user = substr($conc_id, 0, 8);
        $bloc4 = 4211;
        $deban = substr($d_id, 6, 8);
        $compte_tier = $bd->real_escape_string($_POST['compte_tier']);
        $description_tier = $bd->real_escape_string($_POST['description_tier']);
        $link = $compte_tier.'_'.$description_tier;
        $solde1_cdf = $bd->real_escape_string($_POST['solde1_cdf']);
        $usd = $bd->real_escape_string($_POST['usd']);
        $solde2_cdf = $bd->real_escape_string($_POST['solde2_cdf']);
        $solde2_usd = $bd->real_escape_string($_POST['solde2_usd']);
        $statut_tiers = $bd->real_escape_string($_POST['statut_tiers']);
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params = 1;
        $groupe = 'tiers';
        $rout = 'actif';
        $admin = $_SESSION['pseudo'];

        if (!filter_var($compte_tier)) {
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
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params'";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              //Enregistrement de l'eleve
              $req2 = "SELECT * FROM compta_tiers  WHERE statut ='Actif' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  $id = $row['id'];
                }
                $n = $id + 1;

                $req3 = "SELECT * FROM compta_tiers  WHERE compte ='$compte_tier' AND statut ='$statut_tiers'";
                $res3 = $bd->query($req3);

                if ($res3->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Cet compta_tiers existe déjà." . '</div>';
                } else {
                  $req4 = "INSERT INTO compta_tiers(code_soc, societe, compte, description, groupe, solde1_cdf, usd, solde2_cdf, solde2_usd, date_crea, statut, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$compte_tier."','".$description_tier."','".$link."','".$solde1_cdf."','".$usd."','".$solde2_cdf."','".$solde2_usd."','".$dat."','".$statut_tiers."','".$admin."','".$ip_user."')";
                  
                  $seq = "INSERT INTO combo_od(compte, nom_complet, descriptions, groupe, statut) VALUES ('".$compte_tier."','".$description_tier."','".$link."','".$groupe."','".$rout."')";
                  $res4 = $bd->query($req4);
                  $tel = $bd->query($seq);

                  if ($res4 == true && $tel == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau personnel pris en charge.' . '</div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Enregistrement non pris en charge.." . '</div>';
                  }
                }
              } else {
                $req5 = "SELECT * FROM compta_tiers WHERE compte ='$compte_tier' AND statut ='actif'";
                $res5 = $bd->query($req5);

                if ($res5->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Cet compta_tiers existe déjà." . '</div>';
                } else {
                  $req6 = "INSERT INTO compta_tiers(code_soc, societe, compte, description, groupe, solde1_cdf, usd, solde2_cdf, solde2_usd, date_crea, statut, customer, ip_user) 
                                          VALUES ('".$codesoc."','".$societe."','".$compte_tier."','".$description_tier."','".$link."','".$solde1_cdf."','".$usd."','".$solde2_cdf."','".$solde2_usd."','".$dat."','".$statut_tiers."','".$admin."','".$ip_user."')";
                  $seq = "INSERT INTO combo_od(compte, nom_complet, descriptions, groupe, statut) VALUES ('".$compte_tier."','".$description_tier."','".$link."','".$groupe."','".$rout."')";
                  $res6 = $bd->query($req6);

                  if ($res6 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau compta_tiers pris en charge.' . '</div>';
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
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Votre compte est invalide' . '</div>';
          }
        }
      }
    }
  } else {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
}

// Mise à jour tiers
function edit_tier(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_edittier'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun parametre trouvé' . '</div>';
      } else {
        $compte_tier = $_GET['compte'];
        $codesoc = $_GET['Code'];
        include("connexion.php");
        if ($bd->connect_error) {
          die('Impossible de se connecter à la BD:' .$bd->connect_error);
        } else {
          $d_id = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_id . " " . $h_id;
          $conc_id = md5($dat);
          $code_user = substr($conc_id, 0, 5);
          $customer = $_SESSION['pseudo'];
          $description_tier = $bd->real_escape_string($_POST['description_tier']);
          $solde1_cdf = $bd->real_escape_string($_POST['solde1_cdf']);
          $usd = $bd->real_escape_string($_POST['usd']);
          $solde2_cdf = $bd->real_escape_string($_POST['solde2_cdf']);
          $solde2_usd = $bd->real_escape_string($_POST['solde2_usd']);
          $statut_tiers = $bd->real_escape_string($_POST['statut_tiers']);
          $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params = 1;
          $droit = 0;
          $statut = "master";

          if (!filter_var($description_tier)) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' .
              "Le format e-mail non autorisé." . '</div>';
          } else {
            $requete = "SELECT * FROM admin_tb WHERE statut='$statut' AND pseudo='" . $_SESSION['pseudo'] . "'";
            $resultats = $bd->query($requete);

            if ($resultats->num_rows < 0) {
              while ($row = $resultats->fetch_assoc()) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration' . '</div>';
              }
            } else { // code admin
              $sql = "UPDATE compta_tiers SET description ='$description_tier', solde1_cdf ='$solde1_cdf', usd ='$usd', solde2_cdf ='$solde2_cdf', solde2_usd ='$solde2_usd', date_edit ='$dat', customer ='$customer', ip_user ='$ip_user' WHERE code_soc='$codesoc' AND compte ='$compte_tier' AND statut ='$statut_tiers'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification effectuée.'.'</div>';
                  
              } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification echouée.'.'</div>';
                  
              }
            } // code admin
          } //verification format mail
        } //fin base de données
        $bd->close();
      }
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} // fin fonction
//fin mise à jour Compta tier

//debut de la suppression tiers
function delete_tier(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_delTier'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $compte_tier= $_GET['compte'];
        $codesoc = $_GET['Code'];
        include("connexion.php");
        if ($bd -> connect_error) {
          die('Impossible de se connecter à la BD:'.$bd ->connect_error);
        }
        else{
          $statut = "master";
          $requete = "SELECT * FROM admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows < 0) {
            while($row = $resultats ->fetch_assoc()){
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration vous est donné.'.'</div>'; 
            }
          }
          else{// code admin
            $requete = "SELECT * FROM compta_tiers WHERE compte ='$compte_tier' AND statut ='Actif'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification de l'admin master
              $sql="DELETE FROM compta_tiers WHERE compte ='$compte_tier' AND societe='$codesoc' AND statut ='Actif'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Compte Tier supprimé.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Suppression echouée.'.'</div>'; 
              }
            }
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Compte Tier introuvable'.'</div>'; 
            }
          }// code admin
        }
        $bd->close();
      }    
    }   
  } // fin fonction
  //fin de la suppression tiers
}

//Enregistrement facture tiers
function new_frais_tiers(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_TPaieFrais'])) {
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
        $compte_t = $bd->real_escape_string($_POST['compte_t']);
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

        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) { // verification du compte administratif
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
            $codesoc = $row['code_soc'];
            $societe = $row['societe'];
          }
          $req8 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
          $res8 = $bd->query($req8);

          if ($res8->num_rows > 0) { // verification de droit administratif

            $req9 = "SELECT * FROM compta_tiers WHERE societe ='$societe' AND compte ='$compte_t' AND statut ='Actif'";
            $res9 = $bd->query($req9);

            if ($res9->num_rows > 0) { // verification du compte de l'eleve
              while ($row = $res9->fetch_assoc()) {
                $compte_t = $row['compte'];
                $description_tier = $row['description'];
              }
              $req11 = "SELECT * FROM compta_tiers WHERE societe='$societe' AND compte ='$compte_t' AND statut ='fin'";
              $res11 = $bd->query($req11);

              if ($res11->num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Situation financière de tiers déjà en cloturée" . '</div>';
              } else { // Insertion de la situation financiere 

                if ($nature_operation == "entree") {
                  $requete = "SELECT * FROM comptes_tiers WHERE societe='$societe' AND ref_doc = '$ref_doc' AND statut ='en cours'";
                  $resultat = $bd->query($requete);

                  if ($resultat->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                  } else {
                    if ($devise == 'USD') {
                      $req12 = "INSERT INTO comptes_tiers(code_soc,societe,ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, tarification, libelle, devise, taux, 
                                                          montant, debits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_tier."', '".$compte_t."','" . $nature_operation."',
                                                      '".$description_tier."','".$libelle_frais . "', '" . $devise . "', '" . $taux . "', '" . $montant_frais . "', 
                                                      '".$montant_frais."','".$date_doc."','".$annee_scolaire."','".$statut."','".$dat."', '" . $d_id . "', 
                                                      '" . $admin . "', '" . $ip_user . "')";
                      $req12xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              debits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','". $description_tier."','". $compte_t."',
                                            '" . $nature_operation . "','" . $libelle_frais . "','" . $devise . "', '" . $taux . "',
                                            '" . $montant_frais . "','" . $montant_frais . "', '" . $date_doc . "','" . $annee_scolaire . "', '" . $statut . "', 
                                            '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                      $res12 = $bd->query($req12);
                      $res12xr = $bd->query($req12xr);

                      if ($res12 == true && $res12xr == true) {
                        $seq = "SELECT * FROM compta_tiers WHERE societe='$societe' AND compte ='$compte_t'";
                        $result = $bd->query($seq);

                        if ($result->num_rows > 0) {
                          while ($row1 = $result->fetch_assoc()) {
                            $reportUSD = $row1['usd'];
                            $DebitUSD = $row1['debit2_usd'];
                            $CreditUSD = $row1['credit2_usd'];
                          }
                          $deb_USD = $DebitUSD + $montant_frais;
                          $Sold_USD = ($reportUSD + $deb_USD) - $CreditUSD;
                          $seq1 = "UPDATE compta_tiers SET debit2_usd ='$deb_USD', soldeUSD ='$Sold_USD' WHERE societe='$societe' AND compte ='$compte_t'";
                          $result1 = $bd->query($seq1);

                          if ($result1 == true) {
                            $autre ="SELECT * FROM compta_autres WHERE societe='$societe' AND descriptions='$compte_debit'";
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

                              $resul ="UPDATE compta_autres SET debit2_usd='$deb_usd', solde2_usd='$Solde_USD', Totaux_debit_usd='$Total_debit_USD' WHERE societe='$societe' AND descriptions='$compte_debit'";
                              $req =$bd->query($resul);

                              if ($req == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Paiement compte Tiers pris en charge".'</div>';
                              }
                            }
                            else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                            }
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Tiers non pris en charge" . '</div>';
                          }
                        } else {
                          //Insertion de la partie recouvremant
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Recouvrement invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                          //Insertion de la partie recouvremant
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Tiers non pris en charge" . '</div>';
                      }
                    } else {
                      $req13 = "INSERT INTO comptes_tiers(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, tarification, libelle, devise,
                                                           taux, montant, debits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_tier."','".$compte_t."','".$nature_operation."',
                                                      '".$description_tier . "', '" . $libelle_frais . "', '" . $devise . "', '" . $taux . "','".$montant_frais."', 
                                                      '" . $montant_frais . "', '" . $date_doc . "', '" . $annee_scolaire . "', '" . $statut . "', '" . $dat . "', 
                                                      '" . $d_id . "', '" . $admin . "', '" . $ip_user . "')";
                      $req13xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              debits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_tier."','".$compte_t."',
                                            '".$nature_operation."','".$libelle_frais."','".$devise."', '".$taux."',
                                            '".$montant_frais."','".$montant_frais."', '".$date_doc."','".$annee_scolaire."', '".$statut."', 
                                            '".$dat."', '".$d_id."', '".$admin."','".$ip_user."')";
                      $res13 = $bd->query($req13);
                      $res13xr = $bd->query($req13xr);

                      if ($res13 == true && $res13xr == true) {
                        $seq = "SELECT * FROM compta_tiers WHERE societe='$societe' AND compte ='$compte_t'";
                        $result = $bd->query($seq);

                        if ($result->num_rows > 0) {
                          while ($row1 = $result->fetch_assoc()) {
                            $reportCDF = $row1['solde1_cdf'];
                            $DebitCDF = $row1['debit2_cdf'];
                            $CreditCDF = $row1['credit2_cdf'];
                          }
                          $deb_CDF = $DebitCDF + $montant_frais;
                          $Sold_CDF = ($reportCDF + $deb_CDF) - $CreditCDF;
                          $seq1 = "UPDATE compta_tiers SET debit2_cdf ='$deb_CDF', soldeCDF ='$Sold_CDF' WHERE societe='$societe' AND compte ='$compte_t'";
                          $result1 = $bd->query($seq1);

                          if ($result1 == true) {
                            $autre = "SELECT * FROM compta_autres WHERE societe='$societe' AND descriptions='$compte_debit'";
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
                            //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement compte Tiers pris en charge" . '</div>';
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Tiers non pris en charge" . '</div>';
                          }
                        } else {
                          //Insertion de la partie recouvremant
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Recouvrement invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                          //Insertion de la partie recouvremant
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Tiers non pris en charge" . '</div>';
                      }
                    }
                  }
                } else {

                  if ($nature_operation == "sortie") {
                    $requete = "SELECT * FROM comptes_tiers WHERE societe='$societe' AND ref_doc ='$ref_doc' AND statut ='en cours'";
                    $resultat = $bd->query($requete);

                    if ($resultat->num_rows > 0) {
                      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                    } else {
                      if ($devise == 'USD') {
                        $req14 = "INSERT INTO comptes_tiers(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, tarification, libelle, devise, taux, 
                                                            montant, credits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."','".$ref_doc . "', '" . $compte_debit . "', '" . $description_tier . "', '" . $compte_t . "','" . $nature_operation . "',
                                                      '".$description_tier . "', '" . $libelle_frais . "','" . $devise . "', '" . $taux . "','" . $montant_frais . "',
                                                      '".$montant_frais . "', '" . $date_doc . "','" . $annee_scolaire . "','" . $statut . "', '" . $dat . "', '" . $d_id . "',
                                                       '".$admin . "','" . $ip_user . "')";
                        $req14xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              credits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                                VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_tier."','".$compte_t."',
                                                '".$nature_operation."','".$libelle_frais."','".$devise."', '".$taux."',
                                                '".$montant_frais."','".$montant_frais."', '".$date_doc."','".$annee_scolaire."', '".$statut."', 
                                                '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $res14 = $bd->query($req14);
                        $res14xr = $bd->query($req14xr);

                        if ($res14 == true && $res14xr == true) {
                          $seq = "SELECT * FROM compta_tiers WHERE societe='$societe' AND compte ='$compte_t'";
                          $result = $bd->query($seq);

                          if ($result->num_rows > 0) {
                            while ($row1 = $result->fetch_assoc()) {
                              $reportUSD = $row1['usd'];
                              $DebitUSD = $row1['debit2_usd'];
                              $CreditUSD = $row1['credit2_usd'];
                            }
                            $cred_USD = $CreditUSD + $montant_frais;
                            $Sold_USD = ($reportUSD + $DebitUSD) - $cred_USD;
                            $seq1 = "UPDATE compta_tiers SET credit2_usd ='$cred_USD', soldeUSD ='$Sold_USD' WHERE societe='$societe' AND compte ='$compte_t'";
                            $result1 = $bd->query($seq1);

                            if ($result1 == true) {
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

                                $resul = "UPDATE compta_autres SET credit2_usd='$cred_usd', solde2_usd='$Solde_USD', Totaux_credit_usd='$Total_credit_USD' WHERE societe='$societe' AND descriptions='$compte_debit'";
                                $req = $bd->query($resul);

                                if ($req == true) {
                                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit effectué".'</div>';
                                }
                              } else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                              }
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                            }
                          } else {
                            //Insertion de la partie recouvremant
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Recouvrement invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                            //Insertion de la partie recouvremant
                          }
                        } else {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                        }
                      } else {
                        $req15 = "INSERT INTO comptes_tiers(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, tarification, libelle, devise, taux, 
                                                            montant, credits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                                VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."', '".$description_tier."', '".$compte_t."', '".$nature_operation."',
                                                           '" . $description_tier . "', '" . $libelle_frais . "', '" . $devise . "', '" . $taux . "', '" . $montant_frais . "',
                                                            '" . $montant_frais . "', '" . $date_doc . "','" . $annee_scolaire . "', '" . $statut . "', '" . $dat . "',
                                                            '" . $d_id . "', '" . $admin . "', '" . $ip_user . "')";
                        $req15xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              credits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                                VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_tier."','".$compte_t."',
                                                '".$nature_operation."','".$libelle_frais."','" . $devise . "', '" . $taux . "',
                                                '".$montant_frais."','".$montant_frais . "', '" . $date_doc . "','" . $annee_scolaire . "', '".$statut."', 
                                                '".$dat."', '".$d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $res15 = $bd->query($req15);
                        $res15xr = $bd->query($req15xr);

                        if ($res15 == true && $res15xr == true) {
                          $seq7 = "SELECT * FROM compta_tiers WHERE societe='$societe' AND compte ='$compte_t'";
                          $result5 = $bd->query($seq7);

                          if ($result5->num_rows > 0) {
                            while ($row2 = $result5->fetch_assoc()) {
                              $reportCDF = $row2['solde1_cdf'];
                              $DebitCDF = $row2['debit2_cdf'];
                              $CreditCDF = $row2['credit2_cdf'];
                            }
                            $cred_CDF = $CreditCDF + $montant_frais;
                            $Sold_CDF = ($reportCDF + $DebitCDF) - $cred_CDF;
                            $seq8 = "UPDATE compta_tiers SET credit2_cdf ='$cred_CDF', soldeCDF ='$Sold_CDF' WHERE societe='$societe' AND compte ='$compte_t'";
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
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                            }
                          } else {
                            //Insertion de la partie recouvremant
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Recouvrement invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                            //Insertion de la partie recouvremant
                          }
                          //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit effectué" . '</div>';
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
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . " Compte Tiers est inactif ou déjà cloturé" . '</div>';
            }
          } // verification de droit administratif
          else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration trouvé' . '</div>';
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