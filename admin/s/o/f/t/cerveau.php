<?php

//partie creation du compte de personnel
function new_pers()
{ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_pers'])) {
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $d_id = date("d-m-y");
        $h_id = date("h:i:s");
        $dat = $d_id . " " . $h_id;
        $conc_id = md5($dat);
        $code_user = substr($conc_id, 0, 8);
        $bloc4 = 4211;
        $deban = substr($d_id, 6, 8);
        $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
        $departemnt = $bd->real_escape_string($_POST['departemnt']);
        $service = $bd->real_escape_string($_POST['service']);
        $fonction_pers = $bd->real_escape_string($_POST['fonction_pers']);
        $etat_civil = $bd->real_escape_string($_POST['etat_civil']);
        $sexe = $bd->real_escape_string($_POST['sexe']);
        $date_debut = $bd->real_escape_string($_POST['date_debut']);
        $telephone = $bd->real_escape_string($_POST['telephone_pers']);
        $telephone_pers = '+243' . $telephone;
        $email_pers = $bd->real_escape_string($_POST['email_pers']);
        $solde1_cdf = $bd->real_escape_string($_POST['solde1_cdf']);
        $solde1_usd = $bd->real_escape_string($_POST['solde1_usd']);
        $statut_pers = $bd->real_escape_string($_POST['statut_pers']);
        $proville = 'H.KAT-LSHI';
        $societe  = 'CSB';
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params = 1;
        $admin = $_SESSION['pseudo'];

        if (!filter_var($email_pers, FILTER_VALIDATE_EMAIL)) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "le format e-mail non autorisé." . '</div>';
        } else {
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows > 0) {
            while ($row = $resultats->fetch_assoc()) {
              $code_admin = $row['code_admin'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {

              //Enregistrement de personnel
              $req2 = "SELECT * FROM compta_pers WHERE statut ='Actif' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  $id = $row['id'];
                }
                $n = $id++;
                $num_compte = $bloc4 . '-' . $deban . '-' . $n;

                $req3 = "SELECT * FROM compta_pers WHERE nom_complet ='$nom_personnel' AND statut ='$statut_pers'";
                $res3 = $bd->query($req3);

                if ($res3->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Cet personnel existe déjà." . '</div>';
                } else {
                  $req4 = "INSERT INTO compta_pers(compte, nom_complet, fonction, date_debut, telephone, email, solde1_cdf, solde1_usd, statut, customer, ip_user) VALUES ('" . $num_compte . "','" . $nom_personnel . "','" . $fonction_pers . "','" . $date_debut . "','" . $telephone_pers . "','" . $email_pers . "','" . $solde1_cdf . "','" . $solde1_usd . "', '" . $statut_pers . "','" . $admin . "', '" . $ip_user . "')";

                  $res4 = $bd->query($req4);

                  if ($res4 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau personnel pris en charge.' . '</div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Enregistrement non pris en charge.." . '</div>';
                  }
                }
              } else {
                $num_compte1 = $bloc4 . '-' . $deban . '-' . '0';
                $req5 = "SELECT * FROM compta_pers WHERE nom_complet ='$nom_personnel' AND statut ='actif'";
                $res5 = $bd->query($req5);

                if ($res5->num_rows > 0) {
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Cet personnel existe déjà." . '</div>';
                } else {
                  $req6 = "INSERT INTO compta_pers(compte, nom_complet, fonction, date_debut, telephone, email, solde1_cdf, solde1_usd, statut, customer, ip_user) VALUES ('" . $num_compte1 . "','" . $nom_personnel . "', '" . $fonction_pers . "','" . $date_debut . "','" . $telephone_pers . "','" . $email_pers . "','" . $solde1_cdf . "', '" . $solde1_usd . "', '" . $statut_pers . "', '" . $admin . "', '" . $ip_user . "')";

                  $res6 = $bd->query($req6);

                  if ($res6 == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">' . 'Nouveau personnel pris en charge.' . '</div>';
                  } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Enregistrement non pris en charge." . '</div>';
                  }
                }
              }
              //Enregistrement compte personnel
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
// Mise à jour personnel
function edit_personnel()
{ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_editpersonnel'])) {
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun parametre trouvé' . '</div>';
      } else {
        $compte_personnel = $_GET['compte'];
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
          $nom_personnel = $bd->real_escape_string($_POST['nom_personnel']);
          $fonction_pers = $bd->real_escape_string($_POST['fonction_pers']);
          $date_debut = $bd->real_escape_string($_POST['date_debut']);
          $telephone = $bd->real_escape_string($_POST['telephone_pers']);
          $email_pers = $bd->real_escape_string($_POST['email_pers']);
          $solde1_cdf = $bd->real_escape_string($_POST['solde1_cdf']);
          $solde1_usd = $bd->real_escape_string($_POST['solde1_usd']);
          $statut_pers = $bd->real_escape_string($_POST['statut_pers']);
          $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params = 1;
          $droit = 0;
          $statut = "master";

          if (!filter_var($email_pers, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
              "Le format e-mail non autorisé." . '</div>';
          } else {
            $requete = "SELECT * FROM  admin_tb WHERE statut='$statut' AND pseudo='" . $_SESSION['pseudo'] . "'";
            $resultats = $bd->query($requete);

            if ($resultats->num_rows < 0) {
              while ($row = $resultats->fetch_assoc()) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . 'Aucun droit d\'administration' . '</div>';
              }
            } else { // code admin

              $sql = "UPDATE compta_pers SET nom_complet ='$nom_personnel', fonction ='$fonction_pers', date_debut ='$date_debut', telephone ='$telephone', email ='$email_pers', solde1_cdf ='$solde1_cdf', solde1_usd ='$solde1_usd', date_edit ='$dat', customer ='$customer', ip_user='$ip_user' WHERE compte ='$compte_personnel' AND statut ='$statut_pers'";
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
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} // fin fonction
//fin mise à jour pers agent

//Enregistremrnt de donne dans la table OD
function new_nivellement()
{ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_ODNiv'])) {
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
        $admin = $_SESSION['pseudo'];
        $compteDebit = $bd->real_escape_string($_POST['compteDebit']);
        $compteCredit =  $bd->real_escape_string($_POST['compteCredit']);
        $nature_op = "entree";
        $devise =  $bd->real_escape_string($_POST['devise']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $date_doc =  $bd->real_escape_string($_POST['date_doc']);
        $montant = $bd->real_escape_string($_POST['montant']);
        $libelle = $bd->real_escape_string($_POST['libelle']);
        $nature = "Sortie";
        $OP_CDF = "CDF";
        $OP_USD = "USD";
        $statut = "en cours";
        $params = 1;
        $ref_doc = $code_ref . substr($admin, 0, 3);
        $ref_docs = $code_ref . substr($admin, 0, 5);
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) { // verification du compte administratif
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) { // verification de droit administratif
            $req3 = "SELECT * FROM finance_tb WHERE statut ='fin'";
            $res3 = $bd->query($req3);

            if ($res3->num_rows > 0) {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Situation financière de élève déjà en cloturée" . '</div>';
            } else { // Insertion de la situation financiere
              if ($nature_op == "entree") {
                $requete = "SELECT * FROM comptes_tresor WHERE ref_doc = '$ref_doc' AND statut ='en cours'";
                $resultat = $bd->query($requete);

                if ($resultat->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                } else {
                  if ($devise == 'USD') {
                    //Convertir monnaie
                    //$convert =$montant/$taux;
                    $req4 = "INSERT INTO comptes_tresor(ref_doc, compte_debit, nom_complet, compte_credit, libelle, devise, taux, montant, debits_usd, date_doc, 
                                            statut, date_crea, date_extract, customer, ip_user)
                                VALUES ('".$ref_docs."', '".$compteDebit."', '".$compteDebit."', '".$compteCredit."', '".$libelle."',
                                          '".$devise."','".$taux."','".$montant."','".$montant."', '".$date_doc."', '".$statut."', '".$dat."', 
                                          '".$d_id."', '".$admin."','".$ip_user."')";

                    $req4x1 = "INSERT INTO comptes_tresor(ref_doc, compte_debit, nom_complet, compte_credit, libelle, devise, taux, montant, credits_usd, date_doc, 
                                           statut, date_crea, date_extract, customer, ip_user)
                              VALUES ('".$ref_doc."', '".$compteCredit."', '".$compteCredit."', '".$compteDebit."', '".$libelle."',
                                        '".$devise."','".$taux."','".$montant."','".$montant."', '".$date_doc."', '".$statut."', '".$dat."', 
                                        '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";

                    $res4 = $bd->query($req4);
                    $res4x1 = $bd->query($req4x1);

                    if ($res4 == true && $res4x1 == true) {
                      $autre ="SELECT * FROM compta_autres WHERE descriptions='$compteDebit'";
                      $sort = $bd->query($autre);

                      if ($sort ->num_rows > 0) {
                        while ($row = $sort ->fetch_assoc()) {
                          $ReportUSD = $row['solde1_usd'];
                          $CreditUSD = $row['credit2_usd'];
                          $DebitUSD  = $row['debit2_usd'];
                          $TotauxUSD = $row['Totaux_debit_usd'];
                        }
                        //Equation 1
                        $deb_usd = $DebitUSD + $montant;
                        $Solde_USD = ($deb_usd + $ReportUSD) - $CreditUSD;
                        //Equation 2
                        $Total_debit_USD = $TotauxUSD + $montant;

                        $resul ="UPDATE compta_autres SET debit2_usd='$deb_usd', solde2_usd='$Solde_USD', Totaux_debit_usd='$Total_debit_USD' WHERE descriptions='$compteDebit'";
                        $req =$bd->query($resul);

                        /*SELECT `id`, `cat`, `clas`, `groupe`, `compte`, `description`, `descriptions`, `solde1_cdf`, `solde1_usd`, `credit1_usd`, `credit1_cdf`, `debit1_usd`, `debit1_cdf`, 
                    `taux`, `solde2_cdf`, `solde2_usd`, `credit2_usd`, `credit2_cdf`, `debit2_usd`, `debit2_cdf`, `Totaux_debit_usd`, `Totaux_credit_usd`, `date_crea`, `date_edit`, 
                    `statut`, `customer`, `ip_user` FROM `compta_autres` WHERE 1*/

                        if ($req == true) {
                          $autre2="SELECT * FROM compta_autres WHERE descriptions='$compteCredit'";
                          $sort2 = $bd->query($autre2);

                          if ($sort2 ->num_rows > 0) {
                            while ($row = $sort2 ->fetch_assoc()) {
                              $ReportUSD = $row['solde1_usd'];
                              $CreditUSD = $row['credit2_usd'];
                              $DebitUSD  = $row['debit2_usd'];
                              $TotauxCUSD = $row['Totaux_credit_usd'];
                            }
                            //Equation 1
                            $cred_usd = $CreditUSD + $montant;
                            $Solde_USD = ($DebitUSD + $ReportUSD) - $cred_usd;
                            //Equation 2
                            $Total_cred_USD = $TotauxCUSD + $montant;

                            $resul = "UPDATE compta_autres SET credit2_usd='$cred_usd', solde2_usd='$Solde_USD', Totaux_credit_usd='$Total_cred_USD' WHERE descriptions='$compteCredit'";
                            $req = $bd->query($resul);

                            if ($req == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Nivellement pris en charge USD" . '</div>';
                            } else {
                              echo "Echec...";
                            }
                          }
                          else {
                            echo"Echec d\'enregistrement";
                          }
                        }
                      }
                      else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                      }
                    } else {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Nivellement non pris en charge" . '</div>';
                    }
                  }
                  // Fin dollars 
                  else {
                    //Convertir monnaie
                    $convertMonn = $montant * $taux;
                    $devises = "CDF";

                    $req5 = "INSERT INTO comptes_tresor(ref_doc, compte_debit, nom_complet, compte_credit, libelle, devise, taux, montant, debits_cdf, date_doc, 
                                        statut, date_crea, date_extract, customer, ip_user)
                            VALUES ('" . $ref_doc . "', '" . $compteDebit . "', '" . $compteDebit . "', '" . $compteCredit . "','" . $libelle . "',
                                      '" . $devise . "', '" . $taux . "','" . $convertMonn . "','" . $convertMonn . "', '" . $date_doc . "', '" . $statut . "', '" . $dat . "', 
                                      '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";

                    $req5x1 = "INSERT INTO comptes_tresor(ref_doc, compte_debit, nom_complet, compte_credit, libelle, devise, taux, montant, credits_usd, date_doc, 
                                              statut, date_crea, date_extract, customer, ip_user)
                          VALUES ('" . $ref_doc . "', '" . $compteCredit . "', '" . $compteCredit . "', '" . $compteDebit . "', '" . $libelle . "',
                                    '" . $devises . "','" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', '" . $statut . "', '" . $dat . "', 
                                    '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";

                    $res5 = $bd->query($req5);
                    $res5x1 = $bd->query($req5x1);

                    if ($res5 == true && $res5x1 == true) {
                      $autre = "SELECT * FROM compta_autres WHERE descriptions='$compteDebit'";
                      $sort = $bd->query($autre);

                      if ($sort->num_rows > 0) {
                        while ($row = $sort->fetch_assoc()) {
                          $ReportCDF = $row['solde1_cdf'];
                          $CreditCDF = $row['credit2_cdf'];
                          $DebitCDF  = $row['debit2_cdf'];
                          $TotauxUSD = $row['Totaux_debit_usd'];
                        }
                        //Equation 1
                        $deb_cdf = $DebitCDF + $montant;
                        $Solde_CDF = ($deb_cdf + $ReportCDF) - $CreditCDF;
                        //Equation 2
                        $convertir = $montant / $taux;
                        $Total_debit_CDF = $TotauxUSD + $convertir;

                        $resul = "UPDATE compta_autres SET debit2_cdf='$deb_cdf', solde2_cdf='$Solde_CDF', Totaux_debit_usd='$Total_debit_CDF' WHERE descriptions='$compteDebit'";
                        $req = $bd->query($resul);

                        if ($req == true) {
                          $autre = "SELECT * FROM compta_autres WHERE descriptions='$compteCredit'";
                          $sort = $bd->query($autre);

                          if ($sort->num_rows > 0) {
                            while ($row = $sort->fetch_assoc()) {
                              $ReportCDF = $row['solde1_cdf'];
                              $CreditCDF = $row['credit2_cdf'];
                              $DebitCDF  = $row['debit2_cdf'];
                              $TotauxCUSD = $row['Totaux_credit_usd'];
                            }
                            //Equation 1
                            $cred_cdf = $CreditCDF + $montant;
                            $Solde_CDF = ($DebitCDF + $ReportCDF) - $cred_cdf;
                            //Equation 2
                            $convertir = $montant / $taux;
                            $Total_debit_CDF = $TotauxCUSD + $convertir;

                            $resul = "UPDATE compta_autres SET credit2_cdf='$cred_cdf', solde2_cdf='$Solde_CDF', Totaux_credit_usd='$Total_debit_CDF' WHERE descriptions='$compteCredit'";
                            $req = $bd->query($resul);

                            if ($req == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Nivellement pris en charge CDF".'</div>';
                            }
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Le Referencement incorrect".'</div>';
                          }
                        }
                      } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Le Referencement incorrect" . '</div>';
                      }
                    } else {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Nivellement non pris en charge" . '</div>';
                    }
                  }
                }
              } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Non pris en charge" . '</div>';
              }
            } // Insertion de la situation financiere

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

//Enregistremrnt de donne dans la table OD
function new_OD()
{ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_OD'])) {
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
        $admin = $_SESSION['pseudo'];
        $compte_debit = $bd->real_escape_string($_POST['compte_debit']);
        $compte_credit =  $bd->real_escape_string($_POST['compte_credit']);
        $nature_op = "entree";
        $devise =  $bd->real_escape_string($_POST['devise']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $date_doc =  $bd->real_escape_string($_POST['date_doc']);
        $montant = $bd->real_escape_string($_POST['montant']);
        $libelle = $bd->real_escape_string($_POST['libelle']);
        $CompteDEBIT = $bd->real_escape_string($_POST['CompteDEBIT']);
        $statut = "en cours";
        $params = 1;
        $ref_doc = $code_ref . substr($admin, 0, 3);
        $ip_user = $bd->real_escape_string($_SERVER['REMOTE_ADDR']);

        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params' ";
        $resultats = $bd->query($requete);

        if ($resultats->num_rows > 0) { // verification du compte administratif
          while ($row = $resultats->fetch_assoc()) {
            $code_admin = $row['code_admin'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params = '$params' ";
          $res1 = $bd->query($req1);

          if ($res1->num_rows > 0) { // verification de droit administratif
            $req2 = "SELECT * FROM combo_od WHERE nom_complet ='$compte_debit' AND statut ='Actif'";
            $res2 = $bd->query($req2);

            if ($res2->num_rows > 0) { // verification du compte de l'eleve
              while ($row = $res2->fetch_assoc()) {
                $compte_el = $row['compte'];
                $groupe = $row['groupe'];
                $nom_debit = $row['nom_complet'];
              }
              $req2x = "SELECT * FROM combo_od WHERE nom_complet ='$compte_credit' AND statut ='Actif'";
              $res2x = $bd->query($req2x);

              if ($res2x ->num_rows > 0) {
                while ($row = $res2x->fetch_assoc()) {
                  $compteCREDIT = $row['compte'];
                  $groupe = $row['groupe'];
                  $nom_credit = $row['nom_complet'];
                }
                $req3 = "SELECT * FROM finance_tb WHERE compte ='$compte_el' AND statut ='fin'";
                $res3 = $bd->query($req3);

                if ($res3->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Situation financière de élève déjà en cloturée" . '</div>';
                } else { // Insertion de la situation financiere
                  if ($nature_op == "entree") {
                    $requete = "SELECT * FROM compte_od WHERE ref_doc ='$ref_doc' AND statut ='en cours'";
                    $resultat = $bd->query($requete);

                    if ($resultat->num_rows > 0) {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                    } else {
                      if ($devise == 'USD') {
                        $req4 = "INSERT INTO compte_od(ref_doc, compte_debit, nom_debit, compte_credit, nom_complet, nat_op, tarification, libelle, devise, taux, montant, 
                                                      debits_usd, date_doc, statut, date_crea, date_extract, customer, ip_user) 
                                                VALUES ('" . $ref_doc . "', '" . $compte_el . "', '" . $nom_debit . "', '" . $compteCREDIT . "', '" . $nom_credit . "','" . $nature_op . "', 
                                                        '" . $libelle . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', '" . $statut . "', 
                                                        '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $res4 = $bd->query($req4);
                        if ($res4 == true) {
                          $req4x2 = "INSERT INTO compte_od_tb(ref_doc, compte_credit, nom_credit, compte_debit, nat_op, libelle, devise, montant, credits_usd, date_doc, date_crea, statut) 
                                              VALUES ('".$ref_doc."','".$compteCREDIT."','".$nom_credit."','".$nom_debit."','".$nature_op."', '".$libelle."','".$devise."',
                                                          '".$montant."','".$montant."','".$date_doc ."', '".$d_id."','".$statut."')";
                          $res4x2 = $bd->query($req4x2);

                          if ($CompteDEBIT == 'autres') {
                            $coq = "INSERT INTO comptes_autres(ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, debits_usd,
                                                              date_doc, statut, date_crea, date_extract, customer, ip_user)
                                      VALUES('" . $ref_doc . "','" . $compte_el . "','" . $nom_debit . "','" . $compte_el . "','" . $nature_op . "','" . $libelle . "','" . $devise . "', 
                                              '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', '" . $statut . "', '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                            $soq = $bd->query($coq);
                            if ($soq == true && $res4 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD non pris en charge" . '</div>';
                            }
                          } elseif ($CompteDEBIT == 'tiers') {
                            $coq1 = "INSERT INTO comptes_tiers(ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, tarification, libelle, devise, taux, 
                                                                montant, debits_usd, date_doc, statut, date_crea, date_extract, customer, ip_user) 
                                      VALUES('" . $ref_doc . "','" . $compte_el . "','" . $nom_debit . "','" . $compte_el . "','" . $nature_op . "','" . $nom_debit . "','" . $libelle . "',
                                                '" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "','" . $statut . "', '" . $dat . "','" . $d_id . "', 
                                                        '" . $admin . "','" . $ip_user . "')";
                            $soq1 = $bd->query($coq1);
                            if ($soq1 == true && $res4 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD non pris en charge" . '</div>';
                            }
                          } elseif ($CompteDEBIT == 'personnel') {
                            $coq2 = "INSERT INTO comptes_pers(ref_doc, compte_debit,nom_complet,compte_credit, nature_operation, libelle, devise, taux, montant, debits_usd, date_doc, statut, date_crea, date_extract, customer, ip_user) 
                                    VALUES('" . $ref_doc . "','" . $compte_el . "','" . $nom_debit . "','" . $compte_el . "','" . $nature_op . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "','" . $statut . "', '" . $dat . "','" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                            $soq2 = $bd->query($coq2);
                            if ($soq2 == true && $res4 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD non pris en charge" . '</div>';
                            }
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais non pris en charge" . '</div>';
                          }
                        } else {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais non pris en charge" . '</div>';
                        }
                      } else {
                        $req5 = "INSERT INTO compte_od(ref_doc, compte_debit, nom_debit, compte_credit, nom_complet, nat_op, tarification, libelle, devise, taux, montant, debits_cdf, 
                                                          date_doc, statut, date_crea, date_extract, customer, ip_user) 
                                    VALUES ('" . $ref_doc . "', '" . $compte_debit . "', '" . $nom_debit . "', '" . $compteCREDIT . "', '" . $nom_credit . "','" . $nature_op . "', 
                                            '" . $libelle . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', 
                                            '" . $statut . "', '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                        $res5 = $bd->query($req5);
                        /**SELECT `id`, `ref_doc`, `compte_credit`, `nom_credit`, `compte_debit`, `nat_op`, `libelle`, `devise`, `taux`, `montant`, `debits_usd`, `credits_usd`, `debits_cdf`,
                         *  `credits_cdf`, `date_doc`, `date_crea`, `date_extract`, `statut`, `customer` FROM `compte_od_tb` WHERE 1 */
                        if ($res5 == true) {
                          $req5x2 = "INSERT INTO compte_od_tb(ref_doc, compte_credit, nom_credit, compte_debit, nat_op, libelle, devise, montant, credits_cdf, date_doc, date_crea, statut) 
                                            VALUES ('".$ref_doc."','".$compteCREDIT."','".$nom_credit."', '".$nom_debit."','".$nature_op."', '".$libelle."','".$devise."',
                                                      '".$montant."','".$montant."','".$date_doc."', '".$d_id."','".$statut."')";
                          $res5x2 = $bd->query($req5x2);

                          if ($CompteDEBIT == 'autres') {
                            $coq = "INSERT INTO comptes_autres(ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, libelle, devise, taux, montant, debits_cdf, date_doc, 
                                                                  statut, date_crea, date_extract, customer, ip_user) 
                                            VALUES('" . $ref_doc . "','" . $compte_el . "','" . $nom_debit . "','" . $compte_el . "','" . $nature_op . "','" . $libelle . "','" . $devise . "', 
                                                        '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', '" . $statut . "', '" . $dat . "', '" . $d_id . "', 
                                                          '" . $admin . "','" . $ip_user . "')";
                            $soq = $bd->query($coq);
                            if ($soq == true && $res5 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD non pris en charge" . '</div>';
                            }
                          } elseif ($CompteDEBIT == 'tiers') {
                            $coq1 = "INSERT INTO comptes_tiers(ref_doc, compte_debit, nom_complet, compte_credit, nature_operation, tarification, libelle, devise, taux, montant, debits_cdf, date_doc, statut, date_crea, date_extract, customer, ip_user) 
                                      VALUES('" . $ref_doc . "','" . $compte_el . "','" . $nom_debit . "','" . $compte_el . "','" . $nature_op . "','" . $nom_debit . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "','" . $statut . "', '" . $dat . "','" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                            $soq1 = $bd->query($coq1);
                            if ($soq1 == true && $res5 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD non pris en charge" . '</div>';
                            }
                          } elseif ($CompteDEBIT == 'personnel') {
                            $coq2 = "INSERT INTO comptes_pers(ref_doc, compte_debit,nom_complet,compte_credit, nature_operation, libelle, devise, taux, montant, debits_cdf, date_doc, statut, date_crea, date_extract, customer, ip_user) 
                                    VALUES('" . $ref_doc . "','" . $compte_el . "','" . $nom_debit . "','" . $compte_el . "','" . $nature_op . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "','" . $statut . "', '" . $dat . "','" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                            $soq2 = $bd->query($coq2);
                            if ($soq2 == true && $res5 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Opération_OD non pris en charge" . '</div>';
                            }
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais non pris en charge" . '</div>';
                          }
                        } else {
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais non pris en charge" . '</div>';
                        }
                      }
                    }
                  } else {
                    if ($nature_op == "sortie") {
                      $requete = "SELECT * FROM compte_od WHERE ref_doc = '$ref_doc' AND statut ='en cours'";
                      $resultat = $bd->query($requete);

                      if ($resultat->num_rows > 0) {
                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Il y a eu conflit de Reference Document" . '</div>';
                      } else {
                        if ($devise == 'USD') {
                          $req6 = "INSERT INTO compte_od(ref_doc, compte_debit, nom_debit, compte_credit, nom_complet, nat_op, tarification, libelle, devise, taux, montant, credits_usd, date_doc, statut, date_crea, date_extract, customer, ip_user) VALUES ('" . $ref_doc . "', '" . $compte_debit . "', '" . $nom_debit . "', '" . $compte_credit . "', '" . $compte_credit . "','" . $nature_op . "', '" . $libelle . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', '" . $statut . "', '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";
                          $res6 = $bd->query($req6);

                          if ($res6 ==  true) {
                            $req6x2 = "INSERT INTO compte_od_tb(ref_doc, compte_debit, nom_credit, nat_op, libelle, devise, montant, debits_usd, date_crea, statut) VALUES ('" . $ref_doc . "','" . $compte_debit . "', '" . $nom_debit . "','" . $nature_op . "', '" . $libelle . "','" . $devise . "','" . $montant . "','" . $montant . "', '" . $d_ida . "','" . $statut . "')";
                            $res6x2 = $bd->query($req6x2);

                            if ($res6x2 ==  true && $res6 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais scolaire pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais non pris en charge" . '</div>';
                            }
                          } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Mouvement de credit non effectué" . '</div>';
                          }
                        } else {
                          $req7 = "INSERT INTO compte_od(ref_doc, compte_debit, nom_debit, compte_credit, nom_complet, nat_op, tarification, libelle, devise, taux, montant, credits_cdf, date_doc, statut, date_crea, date_extract, customer, ip_user) VALUES ('" . $ref_doc . "', '" . $compte_debit . "', '" . $nom_debit . "', '" . $compte_credit . "', '" . $compte_credit . "','" . $nature_op . "', '" . $libelle . "','" . $libelle . "','" . $devise . "', '" . $taux . "','" . $montant . "','" . $montant . "', '" . $date_doc . "', '" . $statut . "', '" . $dat . "', '" . $d_id . "', '" . $admin . "','" . $ip_user . "')";

                          $res7 = $bd->query($req7);

                          if ($res7 == true) {
                            $req7x2 = "INSERT INTO compte_od_tb(ref_doc, compte_debit, nom_credit, nat_op, libelle, devise, montant, debits_cdf, date_crea, statut) VALUES ('" . $ref_doc . "','" . $compte_debit . "', '" . $nom_debit . "','" . $nature_op . "', '" . $libelle . "','" . $devise . "','" . $montant . "','" . $montant . "', '" . $d_ida . "','" . $statut . "')";
                            $res7x2 = $bd->query($req7x2);

                            if ($res7x2 ==  true && $res7 ==  true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">' . "Paiement frais scolaire pris en charge" . '</div>';
                            } else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "paiement frais non pris en charge" . '</div>';
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
              }
              else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . " Compte OD est inactif ou déjà cloturé" . '</div>';
              }
            } // verification du compte de l'eleve
            else {
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . " Compte OD est inactif ou déjà cloturé" . '</div>';
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
