<?php

//Creation Autre compte
function new_autres(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_autrs'])) {
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
        $compte_autre = $bd->real_escape_string($_POST['compte_autre']);
        $description_autre = $bd->real_escape_string($_POST['description_autre']);
        $link = $compte_autre.'_'.$description_autre;
        $solde1_cdf = $bd->real_escape_string($_POST['solde1_cdf']);
        $solde1_usd = $bd->real_escape_string($_POST['solde1_usd']);
        $solde2_cdf = $bd->real_escape_string($_POST['solde2_cdf']);
        $solde2_usd = $bd->real_escape_string($_POST['solde2_usd']);
        $statut_autre = $bd->real_escape_string($_POST['statut_autre']);
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params = 1;
        $groupe = 'autres';
        $rout = 'actif';
        $admin = $_SESSION['pseudo'];

        if (!filter_var($compte_autre)) {
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
              //Enregistrement
              $req2 = "SELECT * FROM compta_autres WHERE statut ='Actif' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  $id = $row['id'];
                }
                $req3 = "SELECT * FROM compta_autres WHERE compte ='$compte_autre' AND statut ='$statut_autre'";
                $res3 = $bd->query($req3);

                if ($res3->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet compte existe déjà.".'</div>';
                } 
                else {
                  $req4 = "INSERT INTO compta_autres(code_soc, societe, compte, description, descriptions, solde1_cdf, solde1_usd, solde2_cdf, solde2_usd, date_crea, statut, customer, ip_user) 
                                      VALUES ('".$codesoc."','".$societe."','".$compte_autre."', '".$description_autre."', '".$link."', '".$solde1_cdf."', '".$solde1_usd."', '".$solde2_cdf."', '".$solde2_usd."', '".$dat."', '".$statut_autre."', '".$admin."', '".$ip_user."')";
                  $seq = "INSERT INTO combo_od(compte, nom_complet, descriptions, groupe, statut) VALUES ('".$compte_autre."','".$description_autre."','".$link."','".$groupe."','".$rout."')";
                  $res4 = $bd->query($req4);
                  $tel = $bd->query($seq);

                  if ($res4 == true && $tel == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau compta_tresor pris en charge.' . '</div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Enregistrement non pris en charge.." . '</div>';
                  }
                }
              } else {
                $req5 = "SELECT * FROM compta_autres WHERE compte ='$compte_autre' AND statut ='actif'";
                $res5 = $bd->query($req5);

                if ($res5->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Cet compta_autres existe déjà." . '</div>';
                } else {

                  $req6 = "INSERT INTO compta_autres(code_soc, societe, compte, description, descriptions, solde1_cdf, solde1_usd, solde2_cdf, solde2_usd, date_crea, statut, customer, ip_user) 
                                              VALUES ('".$codesoc."','".$societe."', '".$compte_autre."', '".$description_autre."', '".$link."', '".$solde1_cdf."', '".$solde1_usd."', '".$solde2_usd."', '".$solde2_usd."', '".$dat."', '".$statut_autre."', '".$admin."', '".$ip_user."')";
                  $seq = "INSERT INTO combo_od(compte, nom_complet, descriptions, groupe, statut) VALUES ('".$compte_autre."','".$description_autre."','".$link."','".$groupe."','".$rout."')";
                  $res6 = $bd->query($req6);

                  if ($res6 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau compta_autres pris en charge.' . '</div>';
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
//Fin Creation Autre compte

// Mise à jour autres
function edit_autre(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_editautre'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun parametre trouvé' . '</div>';
      } else {
        $compte_autre = $_GET['compte'];
        $codesoc = $_GET['Code'];
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
          $description_autre = $bd->real_escape_string($_POST['description_autre']);
          $solde1_cdf = $bd->real_escape_string($_POST['solde1_cdf']);
          $solde1_usd = $bd->real_escape_string($_POST['solde1_usd']);
          $solde2_cdf = $bd->real_escape_string($_POST['solde2_cdf']);
          $solde2_usd = $bd->real_escape_string($_POST['solde2_usd']);
          $statut_autre = $bd->real_escape_string($_POST['statut_autre']);
          $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params = 1;
          $droit = 0;
          $statut = "master";

          if (!filter_var($description_autre)) {
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

              $sql = "UPDATE compta_autres SET description ='$description_autre', solde1_cdf ='$solde1_cdf', solde1_usd ='$solde1_usd', solde2_cdf ='$solde2_cdf', solde2_usd ='$solde2_usd', date_edit ='$dat', customer ='$customer', ip_user='$ip_user' WHERE code_soc='$codesoc' AND compte ='$compte_autre' AND statut ='$statut_autre'";
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
//fin mise à jour autre

//debut de la suppression autres compte
function delete_autres(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_delautres'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      } else {
        $compte_autre = $_GET['compte'];
        $codesoc = $_GET['Code'];
        include("connexion.php");
        if ($bd->connect_error) {
          die('Impossible de se connecter à la BD:' . $bd->connect_error);
        } else {
          $statut = "master";
          $requete = "SELECT * FROM admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows < 0) {
            while ($row = $resultats->fetch_assoc()) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration vous est donné.'.'</div>';
            }
          } else { // code admin
            $requete = "SELECT * FROM compta_autres WHERE compte ='$compte_autre' AND statut ='Actif'";
            $resultats = $bd->query($requete);

            if ($resultats->num_rows > 0) { // verification de l'admin master
              $sql = "DELETE FROM compta_autres WHERE compte ='$compte_autre' AND statut ='Actif' AND code_soc='$codesoc'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Compte autre supprimé.' . '</div>';
              } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Suppression echouée.' . '</div>';
              }
            } else {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . 'Compte autre introuvable' . '</div>';
            }
          } // code admin
        }
        $bd->close();
      }
    }
  } // fin fonction
  //fin de la suppression Autre compte
}

//Enregistrement facture autre
function new_frais_autre(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_AuPaieFrais'])) {
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
        $compte_autre = $bd->real_escape_string($_POST['compte_autre']);
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
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) { // verification de droit administratif

            $req2 = "SELECT * FROM compta_autres WHERE societe='$societe' AND compte ='$compte_autre' AND statut ='Actif'";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) { // verification du compte de l'eleve
              while ($row = $res2->fetch_assoc()) {
                $compte_au = $row['compte'];
                $description_au = $row['description'];
              }

              $req3 = "SELECT * FROM compta_autres WHERE societe='$societe' AND compte ='$compte_au' AND statut ='fin'";
              $res3 = $bd->query($req3);

              if ($res3->num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Situation financière de tiers déjà en cloturée" . '</div>';
              } else { // Insertion de la situation financiere

                if ($nature_operation == "entree") {
                  $requete = "SELECT * FROM comptes_autres WHERE societe='$societe' AND ref_doc = '$ref_doc' AND statut ='en cours'";
                  $resultat = $bd->query($requete);

                  if ($resultat->num_rows > 0) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                  } else {
                    if ($devise == 'USD') {
                      $req4 = "INSERT INTO comptes_autres(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, 
                                                          debits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."', '".$description_au."', '".$compte_au."','".$nature_operation."',
                                                 '".$libelle_frais."','".$devise."', '".$taux."','".$montant_frais."','".$montant_frais."', 
                                                 '".$date_doc."','".$annee_scolaire."','".$statut."', '".$dat."', '".$d_id."', '".$admin."','".$ip_user."')";
                      $req4xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              debits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."','".$description_au."', '".$compte_au."',
                                            '".$nature_operation."','".$libelle_frais."','".$devise."', '".$taux."',
                                            '".$montant_frais."','".$montant_frais."', '".$date_doc."','".$annee_scolaire."', '".$statut."', 
                                            '".$dat."', '".$d_id."', '".$admin."','".$ip_user."')";
                      $res4 = $bd->query($req4);
                      $res4xr = $bd->query($req4xr);

                      if ($res4 == true && $res4xr == true) {
                        $req4x = "SELECT * FROM compta_autres WHERE societe='$societe' AND compte ='$compte_au'";
                        $res4x = $bd->query($req4x);

                        if ($res4x->num_rows > 0) {
                          while ($row1 = $res4x->fetch_assoc()) {
                            $solde1_usd    = $row1['solde1_usd'];
                            $credit2_usd   = $row1['credit2_usd'];
                            $debit2_usd    = $row1['debit2_usd'];
                            $Totaux_debit  = $row1['Totaux_debit_usd'];
                          }
                          //Equation 1
                          $deb_usd = $debit2_usd + $montant_frais;
                          $deb_usd1 = $deb_usd + $solde1_usd;
                          $Solde_USD = $deb_usd1 - $credit2_usd;

                          //Equation 2
                          $Total_debit_USD = $Totaux_debit + $montant_frais;

                          $req4x1 = "UPDATE compta_autres SET debit2_usd ='$deb_usd', solde2_usd ='$Solde_USD', Totaux_debit_usd ='$Total_debit_USD' WHERE societe='$societe' AND compte ='$compte_au'";
                          $res4x1 = $bd->query($req4x1);

                          if ($res4x1 == true && $res4x == true) {
                            $autre = "SELECT * FROM compta_autres WHERE societe='$societe' AND descriptions='$compte_debit'";
                            $sort = $bd->query($autre);

                            if ($sort->num_rows > 0) {
                              while ($row = $sort->fetch_assoc()) {
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

                              $resul = "UPDATE compta_autres SET debit2_usd='$deb_usd', solde2_usd='$Solde_USD', Totaux_debit_usd='$Total_debit_USD' WHERE societe='$societe' AND descriptions='$compte_debit'";
                              $req = $bd->query($resul);

                              if ($req == true) {
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement compte Autre non pris en charge" . '</div>';
                              }
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                            }
                            //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement compte Autre pris en charge" . '</div>';
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Autre non pris en charge" . '</div>';
                          }
                        } else {
                          //Insertion de la partie compta_autres
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "compte_autre invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                          //Insertion de la partie compta_autres
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Autre non pris en charge" . '</div>';
                      }
                    } else {
                      $req5 = "INSERT INTO comptes_autres(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, 
                                                          debits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_au."', '".$compte_au."', '".$nature_operation."',
                                                    '".$libelle_frais."', '".$devise."', '".$taux."', '".$montant_frais."', '".$montant_frais."','".$date_doc."',
                                                  '".$annee_scolaire."','".$statut."', '".$dat."', '".$d_id."', '".$admin."','".$ip_user."')";

                      $req5xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              debits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."','".$description_au."', '".$compte_au."',
                                            '".$nature_operation . "','" . $libelle_frais . "','" . $devise . "', '" . $taux . "',
                                            '".$montant_frais . "','" . $montant_frais . "', '" . $date_doc . "','" . $annee_scolaire . "', '" . $statut . "', 
                                            '".$dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                      $res5 = $bd->query($req5);
                      $res5xr = $bd->query($req5xr);

                      if ($res5 == true && $res5xr == true) {
                        $req5x = "SELECT * FROM compta_autres WHERE societe='$societe' AND compte ='$compte_au'";
                        $res5x = $bd->query($req5x);

                        if ($res5x->num_rows > 0) {
                          while ($row5x = $res5x->fetch_assoc()) {
                            $solde1_cdf    = $row5x['solde1_cdf'];
                            $credit2_cdf   = $row5x['credit2_cdf'];
                            $debit2_cdf    = $row5x['debit2_cdf'];
                            $Taux          = $row5x['taux'];
                            $Totaux_debit2 = $row5x['Totaux_debit_usd'];
                          }
                          //Equation 1
                          $deb_cdf = $debit2_cdf + $montant_frais;
                          $deb_cdf1 = $deb_cdf + $solde1_cdf;
                          $Solde_CDF = $deb_cdf1 - $credit2_cdf;

                          //Equation 2
                          $convertir = $montant_frais / $Taux;
                          $Total_debit_CDF = $Totaux_debit2 + $convertir;

                          $req5x1 = "UPDATE compta_autres SET debit2_cdf ='$deb_cdf', solde2_cdf ='$Solde_CDF', Totaux_debit_usd ='$Total_debit_CDF' WHERE societe='$societe' AND compte ='$compte_au'";
                          $res5x1 = $bd->query($req5x1);

                          if ($res5x1 == true && $res5x == true) {
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
                                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement compte Autre pris en charge" . '</div>';
                              }
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                            }
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Autre non pris en charge" . '</div>';
                          }
                        } else {
                          //Insertion de la partie compta_autres
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "compte_autre invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                          //Insertion de la partie compta_autres
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement compte Autre non pris en charge" . '</div>';
                      }
                    }
                  }
                } else {
                  if ($nature_operation == "sortie") {
                    $requete = "SELECT * FROM comptes_autres WHERE societe='$societe' AND ref_doc = '$ref_doc' AND statut ='en cours'";
                    $resultat = $bd->query($requete);

                    if ($resultat->num_rows > 0) {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                    } else {
                      if ($devise == 'USD') {
                        $req6 = "INSERT INTO comptes_autres(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, 
                                                            credits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_au."', '".$compte_au."', '".$nature_operation."', 
                                                    '".$libelle_frais."','".$devise."','" .$taux."','".$montant_frais."','".$montant_frais."', '".$date_doc."',
                                                    '".$annee_scolaire."','".$statut."', '".$dat."', '".$d_id."', '".$admin."','".$ip_user."')";
                        $req6xr = "INSERT INTO comptes_encodage(code_soc,societe, ef_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              credits_usd, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."','".$description_au."', '".$compte_au."',
                                            '".$nature_operation . "','" . $libelle_frais . "','" . $devise . "', '" . $taux . "',
                                            '".$montant_frais . "','" . $montant_frais . "', '" . $date_doc . "','" . $annee_scolaire . "', '" . $statut . "', 
                                            '".$dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $res6 = $bd->query($req6);
                        $res6xr = $bd->query($req6xr);

                        if ($res6 == true && $res6xr == true) {
                          $req6x = "SELECT * FROM compta_autres WHERE societe='$societe' AND compte ='$compte_au'";
                          $res6x = $bd->query($req6x);

                          if ($res6x->num_rows > 0) {
                            while ($row6x = $res6x->fetch_assoc()) {
                              $solde1_usd    = $row6x['solde1_usd'];
                              $credit2_usd   = $row6x['credit2_usd'];
                              $debit2_usd    = $row6x['debit2_usd'];
                              $Totaux_credit = $row6x['Totaux_credit_usd'];
                            }
                            //Equation 1
                            $cred_usd = $credit2_usd + $montant_frais;
                            $cred_usd2 = $debit2_usd + $solde1_usd;
                            $Solde_USD2 = $cred_usd2 - $cred_usd;

                            //Equation 2
                            $Total_credit_USD = $Totaux_credit + $montant_frais;

                            $req6x1 = "UPDATE compta_autres SET credit2_usd ='$cred_usd', solde2_usd ='$Solde_USD2', Totaux_credit_usd ='$Total_credit_USD' WHERE societe='$societe' AND compte ='$compte_au'";
                            $res6x1 = $bd->query($req6x1);

                            if ($res6x1 == true) {
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
                                  echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit effectué" . '</div>';
                                }
                              } else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                              }
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                            }
                          } else {
                            //Insertion de la partie compta_autres
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "compte_autre invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                            //Insertion de la partie compta_autres
                          }
                        } else {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                        }
                      } else {
                        $req7 = "INSERT INTO comptes_autres(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, 
                                                            credits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                                  VALUES ('".$codesoc."','".$societe."','".$ref_doc."','".$compte_debit."','".$description_au."','".$compte_au."', 
                                                  '" . $nature_operation ."','".$libelle_frais."','".$devise."','".$taux."','".$montant_frais . "','" . $montant_frais . "', 
                                                  '" . $date_doc . "', '" . $annee_scolaire . "','" . $statut . "', '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $req7xr = "INSERT INTO comptes_encodage(code_soc,societe, ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant,
                                                              credits_cdf, date_doc, anne_scolaire, statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES ('".$codesoc."','".$societe."','".$ref_doc."', '".$compte_debit."','".$description_au."', '".$compte_au."',
                                            '".$nature_operation . "','" . $libelle_frais . "','" . $devise . "', '" . $taux . "',
                                            '".$montant_frais."','".$montant_frais."', '".$date_doc."','".$annee_scolaire."', '".$statut."', 
                                            '".$dat."', '".$d_id."', '".$admin."','".$ip_user."')";
                        $res7 = $bd->query($req7);
                        $resxr7 = $bd->query($req7xr);

                        if ($res7 == true && $resxr7 == true) {
                          $req7x = "SELECT * FROM compta_autres WHERE societe='$societe' AND compte ='$compte_au'";
                          $res7x = $bd->query($req7x);

                          if ($res7x->num_rows > 0) {
                            while ($row7x = $res7x->fetch_assoc()) {
                              $solde1_cdf     = $row7x['solde1_cdf'];
                              $credit2_cdf    = $row7x['credit2_cdf'];
                              $debit2_cdf     = $row7x['debit2_cdf'];
                              $Taux           = $row7x['taux'];
                              $Totaux_credit2 = $row7x['Totaux_credit_usd'];
                            }
                            //Equation 1
                            $cred_cdf = $credit2_cdf + $montant_frais;
                            $cred_cdf2 = $debit2_cdf + $solde1_cdf;
                            $Solde_CDF2 = $cred_cdf2 - $cred_cdf;

                            //Equation 2
                            $convertir = $montant_frais / $Taux;
                            $Total_credit_CDF = $Totaux_credit2 + $convertir;

                            $req7x1 = "UPDATE compta_autres SET credit2_cdf ='$cred_cdf', solde2_cdf ='$Solde_CDF2', Totaux_credit_usd ='$Total_credit_CDF' WHERE societe='$societe' AND compte ='$compte_au'";
                            $res7x1 = $bd->query($req7x1);

                            if ($res7x1 == true) {
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
                            //Insertion de la partie compta_autres
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "compte_autre invalide" . '&nbsp;' . '<a href="encodage.php">' . 'Cliquez ici pour l\'inserer svp!' . '</a>' . '</div>';
                            //Insertion de la partie compta_autres
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
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . " Compte Autre est inactif ou déjà cloturé" . '</div>';
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