<?php

//Afficher la liste de transaction globals dans le table compte_encodage
function listing_frais(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
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
              $req2 = "SELECT * FROM comptes_encodage WHERE date_extract ='$d_id' AND societe='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">'.$row['id'].'</td>' .
                    '<td class="corp-table">'.$row['ref_doc'].'</td>'.
                    '<td class="corp-table">'.$row['compte_debit'].'</td>' .
                    '<td class="corp-table">'.$row['nom_complet'].'</td>'.
                    '<td class="corp-table">'.$row['nature_operation'].'</td>' .
                    '<td class="corp-table">'.$row['libelle'].'</td>'.
                    '<td class="corp-table">'.$row['montant'].'</td>' .
                    '<td class="corp-table">'.$row['devise'] . '</td>' . 
                    '<td class="corp-table">'.$row['taux'] . '</td>' .
                    '<td class="corp-table">'.$row['date_extract'] . '</td>' .
                    '<td class="corp-table">'.$row['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="encodage.php" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
              $req2 = "SELECT * FROM comptes_encodage WHERE date_extract LIKE '%$date_doc%' AND societe='$societe' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">'.$row['id'].'</td>'.
                    '<td class="corp-table">'.$row['ref_doc'].'</td>'.
                    '<td class="corp-table">'.$row['compte_debit'].'</td>'.
                    '<td class="corp-table">'.$row['nom_complet'].'</td>'.
                    '<td class="corp-table">'.$row['nature_operation'].'</td>'.
                    '<td class="corp-table">'.$row['libelle'].'</td>'.
                    '<td class="corp-table">'.$row['montant'].'</td>'.
                    '<td class="corp-table">'.$row['devise'].'</td>'.
                    '<td class="corp-table">'.$row['taux'].'</td>'.
                    '<td class="corp-table">'.$row['date_extract'].'</td>'.
                    '<td class="corp-table">'.$row['statut'].'</td>'.
                    '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="encodage.php" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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
          $req2 = "SELECT * FROM comptes_encodage WHERE ref_doc LIKE '%$ref_doc%' AND societe='$societe' ORDER BY id DESC";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row = $res2->fetch_assoc()) {
              echo '<tr>' .
                '<td class="corp-table">'.$row['id'].'</td>'.
                '<td class="corp-table">'.$row['ref_doc'].'</td>'.
                '<td class="corp-table">'.$row['compte_debit'].'</td>'.
                '<td class="corp-table">'.$row['nom_complet'].'</td>'.
                '<td class="corp-table">'.$row['nature_operation'].'</td>'.
                '<td class="corp-table">'.$row['libelle'].'</td>'.
                '<td class="corp-table">'.$row['montant'].'</td>'.
                '<td class="corp-table">'.$row['devise'].'</td>'.
                '<td class="corp-table">'.$row['taux'].'</td>'.
                '<td class="corp-table">'.$row['date_extract'].'</td>'.
                '<td class="corp-table">'.$row['statut'].'</td>'.
                '<td class="corp-table" style="background-color:#304c79!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="encodage.php" class="selecteur" title="Cliquez pour selectionner" style="color:white">' . 'select' . '</a>' . '</td>' .
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

//Afficher la liste de transaction globals dans le table compte_encodage
function listing_transactiontoday(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $num_order = $_GET['date'];
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
              $req2 = "SELECT * FROM comptes_encodage WHERE societe='$societe' AND date_extract='$num_order' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo'<tr>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['date_doc'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['compte_credit'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nom_complet'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nature_operation'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['libelle'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['taux'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_usd'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_usd'] . '</td>' . 
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_cdf'] . '</td>' .
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_cdf'] . '</td>' .
                      '</tr>';
                }
                echo '
                    <tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">Totaux</td>';
                      $req3 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract ='$num_order' AND devise ='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract ='$num_order' AND devise ='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(debits_cdf) AS total_debits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract ='$num_order' AND devise ='CDF'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_cdf) AS total_credits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract ='$num_order' AND devise ='CDF'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                echo'</tr>';
                

              }
              else {
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
          
          //filtrage eleve par option
        }
      } 
      else {
        //filtrage eleve par nom
        
      }
    } 
    else {
      //filtrage eleve par classe
      
      //filtrage eleve par classe
    }
  } else {
  }
}

//Afficher la liste de transaction periodique globals dans le table compte_encodage
function listing_transperiod(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $trans_debut = $_GET['date'];
          $trans_fin = $_GET['fin'];
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
              $req2 = "SELECT * FROM comptes_encodage WHERE societe='$societe' AND date_extract BETWEEN '".$trans_debut."' AND '".$trans_fin."' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo'<tr>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['id'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['date_doc'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['ref_doc'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nom_complet'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['compte_credit'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['libelle'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_usd'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_usd'] . '</td>' . 
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_cdf'] . '</td>' .
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_cdf'] . '</td>' .
                      '</tr>';
                }
                echo '
                    <tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">Totaux</td>';
                      $req3 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract BETWEEN '".$trans_debut."' AND '".$trans_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitUSD = $row3['total_debit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract BETWEEN '".$trans_debut."' AND '".$trans_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditUSD = $row3['total_credit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(debits_cdf) AS total_debits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract BETWEEN '".$trans_debut."' AND '".$trans_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitCDF = $row3['total_debits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_cdf) AS total_credits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract BETWEEN '".$trans_debut."' AND '".$trans_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditCDF = $row3['total_credits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                echo'</tr>';
                $solde_USD = $total_debitUSD - $total_creditUSD;
                $solde_CDF = $total_debitCDF - $total_creditCDF;
                echo'<tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">SOLDE</td>
                      <td align="" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;text-align:right">'.number_format($solde_USD,2).'</td>
                      <td align="" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;text-align:right">'.number_format($solde_CDF,2).'</td>';
                echo'</tr>';
                

              }
              else {
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
          
          //filtrage eleve par option
        }
      } 
      else {
        //filtrage eleve par nom
        
      }
    } 
    else {
      //filtrage eleve par classe
      
      //filtrage eleve par classe
    }
  } else {
  }
}
//Fin---Afficher la liste de transaction periodique globals dans le table compte_encodage

//Afficher la liste de Tresorerie quotidienne globals dans le table compte_encodage
function listing_tresorerie(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $date = $_GET['date'];
          $tresor = $_GET['tresor'];
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
              $req2 = "SELECT * FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo'<tr>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['id'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nature_operation'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['compte_credit'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nom_complet'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['libelle'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['taux'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_usd'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_usd'].'</td>'. 
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_cdf'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_cdf'].'</td>'.
                      '</tr>';
                }
                echo '
                    <tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">Totaux</td>';
                      $req3 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitUSD = $row3['total_debit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditUSD = $row3['total_credit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(debits_cdf) AS total_debits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitCDF = $row3['total_debits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_cdf) AS total_credits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditCDF = $row3['total_credits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                echo'</tr>';
                $solde_USD = $total_debitUSD - $total_creditUSD;
                $solde_CDF = $total_debitCDF - $total_creditCDF;
                echo'<tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">SOLDE</td>
                      <td align="" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;text-align:right">'.number_format($solde_USD,2).'</td>
                      <td align="" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;text-align:right">'.number_format($solde_CDF,2).'</td>';
                echo'</tr>';
                

              }
              else {
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
          
          //filtrage eleve par option
        }
      } 
      else {
        //filtrage eleve par nom
        
      }
    } 
    else {
      //filtrage eleve par classe
      
      //filtrage eleve par classe
    }
  } else {
  }
}
//Fin---Afficher la liste de Tresorerie quotidienne globals dans le table compte_encodage

//Afficher la liste de Tresorerie periodique globals dans le table compte_encodage
function listing_tresorerieperiod(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $date_debut = $_GET['debut'];
          $date_fin = $_GET['fin'];
          $tresor = $_GET['tresor'];
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
              $req2 = "SELECT * FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract BETWEEN '".$date_debut."' AND '".$date_fin."' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo'<tr>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['id'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['date_doc'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['ref_doc'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nom_complet'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['compte_credit'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['libelle'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_usd'].'</td>' .
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_usd'] . '</td>' . 
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_cdf'] . '</td>' .
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_cdf'] . '</td>' .
                      '</tr>';
                }
                echo '
                    <tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">Totaux</td>';
                      $req3 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract BETWEEN '".$date_debut."' AND '".$date_fin."' ";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitUSD = $row3['total_debit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract BETWEEN '".$date_debut."' AND '".$date_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditUSD = $row3['total_credit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(debits_cdf) AS total_debits_cdf FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract BETWEEN '".$date_debut."' AND '".$date_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitCDF = $row3['total_debits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_cdf) AS total_credits_cdf FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract BETWEEN '".$date_debut."' AND '".$date_fin."'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditCDF = $row3['total_credits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                echo'</tr>';
                $solde_USD = $total_debitUSD - $total_creditUSD;
                $solde_CDF = $total_debitCDF - $total_creditCDF;
                echo'<tr>
                      <td align="" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">SOLDE</td>
                      <td align="" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;text-align:right">'.number_format($solde_USD,2).'</td>
                      <td align="" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;text-align:right">'.number_format($solde_CDF,2).'</td>';
                echo'</tr>';
                

              }
              else {
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
          
          //filtrage eleve par option
        }
      } 
      else {
        //filtrage eleve par nom
        
      }
    } 
    else {
      //filtrage eleve par classe
      
      //filtrage eleve par classe
    }
  } else {
  }
}
//Fin---Afficher la liste de Tresorerie periodique globals dans le table compte_encodage

//Afficher la liste de Tresorerie solde quotidienne globals dans le table compte_encodage
function listing_tresorSold(){
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $date = $_GET['date'];
          $tresor = $_GET['tresor'];
          $date1 = $_GET['date'];
          $date2 = date_create("$date1");
          date_modify($date2, '-1 day');
          $reste = date_format($date2, 'Y-m-d');
          $date_debut = "2023-07-01";
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
              $req2 = "SELECT * FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor' ORDER BY id DESC";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  echo'<tr>' .
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['id'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nature_operation'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['compte_credit'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['nom_complet'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['libelle'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000">'.$row['taux'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_usd'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_usd'].'</td>'. 
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['debits_cdf'].'</td>'.
                        '<td class="corp-table" style="border: 1px solid #000;text-align: right;">'.$row['credits_cdf'].'</td>'.
                      '</tr>';
                }
                echo '
                    <tr>
                      <td align="center" colspan="6" style="font-size:22px;font-weight:bold">TOTAUX ACTUELS</td>';
                      $req3 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor' AND devise ='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitUSD = $row3['total_debit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor' AND devise ='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditUSD = $row3['total_credit_usd'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credit_usd'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(debits_cdf) AS total_debits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor' AND devise ='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitCDF = $row3['total_debits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_cdf) AS total_credits_cdf FROM comptes_encodage WHERE societe='$societe' AND date_extract='$date' AND compte_debit='$tresor' AND devise ='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditCDF = $row3['total_credits_cdf'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_credits_cdf'],2).'</strong>'.'</td>';
                        }
                      }else{
                      }
                echo'</tr>';
                echo'<tr>
                      <td colspan="6" style="font-size: 21px;text-align:center;"><strong>REPORT INITIAL &nbsp;&nbsp;&nbsp; </strong></td>';
                      $req3 = "SELECT solde1_usd FROM compta_autres WHERE societe='$societe' AND descriptions='$tresor'";
                        $res3 = $bd ->query($req3);

                        if ($res3 ->num_rows > 0 ) {
                          while($row3 = $res3 ->fetch_assoc()){
                            $total_soldUSD = $row3['solde1_usd'];
                            //echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                          }
                        }else{
                        }
                        $req3 = "SELECT solde1_cdf FROM compta_autres WHERE societe='$societe' AND descriptions='$tresor'";
                        $res3 = $bd ->query($req3);

                        if ($res3 ->num_rows > 0 ) {
                          while($row3 = $res3 ->fetch_assoc()){
                            $total_soldCDF = $row3['solde1_cdf'];
                            //echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:16px">'.'<strong>'.number_format($row3['total_debit_usd'],2).'</strong>'.'</td>';
                          }
                        }else{
                        }
                echo'<td colspan="2" style="text-align: center;border: 1px solid #000;font-size: 21px"><strong>'.number_format($total_soldUSD, 2).'</strong></td>
                
                    <td colspan="2" style="text-align: center;border: 1px solid #000;font-size: 21px"><strong>'.number_format($total_soldCDF, 2).'</strong></td>
                    </tr>';
                echo'<tr colspan="5">
                      <td colspan="6" style="font-size: 21px;text-align:center;"><strong>TOTAUX_ENCOURS </strong></td>';
                      $req3 = "SELECT sum(debits_usd) AS total_debitsUSD FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract >= '".$date_debut."' && date_extract <= '".$reste."' AND devise='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitRUSD = $row3['total_debitsUSD'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:18px">'.'<strong>'.number_format($row3['total_debitsUSD'],2).' $</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_usd) AS total_creditUSD FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract >= '".$date_debut."' && date_extract <= '".$reste."' AND devise='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditsRUSD = $row3['total_creditUSD'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:18px">'.'<strong>'.number_format($row3['total_creditUSD'],2).' $</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(debits_cdf) AS total_debitsCDF FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract >= '".$date_debut."' && date_extract <= '".$reste."' AND devise='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_debitRCDF = $row3['total_debitsCDF'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:18px">'.'<strong>'.number_format($row3['total_debitsCDF'],2).' FC</strong>'.'</td>';
                        }
                      }else{
                      }
                      $req3 = "SELECT sum(credits_cdf) AS total_creditsCDF FROM comptes_encodage WHERE societe='$societe' AND compte_debit='$tresor' AND date_extract >= '".$date_debut."' && date_extract <= '".$reste."' AND devise='USD'";
                      $res3 = $bd ->query($req3);

                      if ($res3 ->num_rows > 0 ) {
                        while($row3 = $res3 ->fetch_assoc()){
                          $total_creditRCDF = $row3['total_creditsCDF'];
                          echo '<td style="border: 1px solid #000;text-align:right;font-weight:bold;font-size:18px">'.'<strong>'.number_format($row3['total_creditsCDF'],2).' FC</strong>'.'</td>';
                        }
                      }else{
                      }
                echo'</tr>';
                    $tencorUSD = $total_debitUSD - $total_creditUSD;
                    $tencorCDF = $total_debitCDF - $total_creditCDF;

                    $ReportUSD = $total_debitRUSD - $total_creditsRUSD;
                    $ReportCDF = $total_debitRCDF - $total_creditRCDF;

                    $solde_USD = $ReportUSD+$tencorUSD+$total_soldUSD;
                    $solde_CDF = $ReportCDF+$tencorCDF+$total_soldCDF ;
                echo '<tr>
                      <td align="center" colspan="6" style="border: 1px solid #000;font-size:22px;font-weight:bold">SOLDE_ACTUEL</td>
                      <td align="center" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;">'.number_format($solde_USD,2). '</td>
                      <td align="center" colspan="2" style="border: 1px solid #000;font-size:22px;font-weight:bold;">'.number_format($solde_CDF,2).'</td>';
                echo'</tr>';

              }
              else {
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
          
          //filtrage eleve par option
        }
      } 
      else {
        //filtrage eleve par nom
        
      }
    } 
    else {
      //filtrage eleve par classe
      
      //filtrage eleve par classe
    }
  } else {
  }
}
//Fin---Afficher la liste de Tresorerie solde globals dans le table compte_encodage

//Mise à jours personnel
function update_pers(){
  if (isset($_SESSION['pseudo'])) {
    if (empty($_GET['compte'])) {
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
      '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucun parametre trouvé' .
      '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
      '</div>';
    } else {
      $compte_personnel = $_GET['compte'];
      include("connexion.php");
      if ($bd->connect_error) {
        die('Impossible de se connecter à la BD:' . $bd->connect_error);
      } else {
        $req = "SELECT * FROM compta_pers WHERE compte ='$compte_personnel'";
        $resul = $bd->query($req);

        if ($resul->num_rows > 0) {
          while ($row = $resul->fetch_assoc()) {
            echo '<div class="row w-100 p-2">' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label>' . 'Num compte:' . '</label>' .
            '<input type="text" name="compte_personnel" readonly="auto" class="form-control" value="' . $row['compte'] . '" tabindex="10" required>' .
            '<br>' .
            '<label>' . '<i class="fa fa-user">' . '</i>' . '&nbsp;' . 'Nom du Personnel:' . '</label>' .
            '<input type="text" name="nom_personnel" value="' . $row['nom_complet'] . '" class="form-control" tabindex="110" maxlength="50" required >' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label class="control-label" for="Fonction">Fonction:</label>' .
            '<input type="text" value="' . $row['fonction'] . '" class="form-control" name="fonction_pers" placeholder="Fonction">' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label class="control-label" for="date_debut">Date debut:</label>' .
            '<input type="date" value="' . $row['date_debut'] . '" class="form-control" name="date_debut" placeholder="Date debut">' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label class="control-label" for="Téléphone">Téléphone:</label>' .
            '<input type="text" value="' . $row['telephone'] . '" class="form-control" id="telephone" name="telephone_pers" maxlength="9"  placeholder="8105637000">' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label class="control-label" for="email">Email </label>' .
            '<input type="email" value="' . $row['email'] . '" class="form-control" id="email" name="email_pers"  placeholder="Entrer votre email">' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label class="control-label" for="solde1_cdf">Solde cdf:</label>' .
            '<input type="number" value="' . $row['solde1_cdf'] . '" class="form-control" id="solde1_cdf" name="solde1_cdf"  placeholder="report solde cdf">' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mb-2">' .
            '<label class="control-label" for="solde1_usd">Solde usd:</label>' .
            '<input type="number" value="' . $row['solde1_usd'] . '" class="form-control" id="solde1_usd" name="solde1_usd"  placeholder="report solde usd">' .
            '<input type="hidden" name="statut_pers" value="Actif">' .
            '</fieldset>' .
            '<fieldset class="col-lg-12 col-md-12 col-sm-12">' .
            '<button type="reset"  class="btn btn-warning mt-4 col-lg-6 col-md-6" tabindex="170" style="background-color: #304c79">' . 'Annuler' . '</button>' .
            '<button type="submit" class="btn btn-warning mt-4 col-lg-6 col-md-6" name="cmd_editpersonnel" tabindex="170" style="background-color: #304c79">' . 'Modifier' . '</button>' .
            '</fieldset>' .

            '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' .
          '<strong>' . 'Desolé!' . '</strong>' . '&nbsp;' . 'Aucune information trouvée.' .
          '<span aria-hidden="true" data-dismiss="alert" aria-label="close">' . '&times;' . '</span>' .
          '</div>';
        }
      }
      $bd->close();
    }
  }
}

//fonction de calcule du compte tiers sur la table {compte_tiers, compta_tiers}
function extrait_cpte_tiers_doc()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun parametre trouvé" . '</div>';
      } else {
        $compte_credit = $_GET['compte'];
        $req = "SELECT * FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $devise = $row['devise'];
            echo '<tr>' .
              '<td>' . $row['date_doc'] . '</td>' .
              '<td>' . $row['ref_doc'] . '</td>' .
              '<td>' . $row['id'] . '</td>' .
              '<td style="text-transform:uppercase!important;text-align:left!important">' . $row['tarification'] . ' | ' . $row['libelle'] . '</td>' .
              '<td>' . $row['credits_usd'] . '</td>' .
              '<td>' . $row['debits_usd'] . '</td>' .
              '<td>' . $row['credits_cdf'] . '</td>' .
              '<td>' . $row['debits_cdf'] . '</td>';
          }
          echo '<tr><td colspan="8"></td></tr>
	        <tr>
					  <td align="left" colspan="4">Totaux</td>';

          $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut ='en cours'";
          $res3 = $bd->query($req3);

          if ($res3->num_rows > 0) {
            while ($row3 = $res3->fetch_assoc()) {
              echo '<td>' . '<strong>' . number_format($row3['total_credit_usd'], 2) . '</strong>' . '</td>';
            }
          } else {
          }

          $req2 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row2 = $res2->fetch_assoc()) {
              echo '<td>' . '<strong>' . number_format($row2['total_debit_usd'], 2) . '</strong>' . '</td>';
            }
          } else {
          }

          $req5 = "SELECT sum(credits_cdf) AS total_credit_cdf FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res5 = $bd->query($req5);

          if ($res5->num_rows > 0) {
            while ($row5 = $res5->fetch_assoc()) {
              echo '<td>' . '<strong>' . number_format($row5['total_credit_cdf'], 2) . '</strong>' . '</td>';
            }
          } else {
          }

          $req4 = "SELECT sum(debits_cdf) AS total_debit_cdf FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res4 = $bd->query($req4);

          if ($res2->num_rows > 0) {
            while ($row4 = $res4->fetch_assoc()) {
              echo '<td>' . '<strong>' . number_format($row4['total_debit_cdf'], 2) . '</strong>' . '</td>';
            }
          } else {
          }
          echo '</tr>' .
            '</tr>' .
            '<tr><td colspan="9"></td></tr>';

          $req6 = "SELECT * FROM compta_tiers WHERE compte = '$compte_credit' AND statut = 'Actif'";
          $res6 = $bd->query($req6);

          if ($res6->num_rows > 0) {

            while ($row6 = $res6->fetch_assoc()) {
              echo '<tr>' .
                '<td align="left" colspan="5">REPORT</td>' .
                '<td colspan="2">' . '<strong>' . number_format($row6['usd'], 2) . '&nbsp;' . 'USD' . '</strong>' . '</td>' .
                '<td colspan="2">' . '<strong>' . number_format($row6['solde1_cdf'], 2) . '&nbsp;' . 'CDF' . '</strong>' . '</td>' .
                '</tr>';
              /*'<tr>'.
				            '<td align="center" colspan="5">SOLDE (USD,CDF)</td>'.
				            '<td colspan="2">0</td>'.
				            '<td colspan="2">0</td>'.
				        '</tr>';*/
            }
            // les toteaux
            //USD
            //Debit du compte usd
            $req11 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res11 = $bd->query($req11);

            if ($res3->num_rows > 0) {
              while ($row11 = $res11->fetch_assoc()) {
                $creditsusd = $row11['total_credit_usd'];
              }
            } else {
            }
            //Credit du compte usd
            $req7 = "SELECT sum(debits_usd) AS total_debitusd FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res7 = $bd->query($req7);

            if ($res7->num_rows > 0) {
              while ($row7 = $res7->fetch_assoc()) {
                $tot_deb_usd = $row7['total_debitusd'];
              }

              $req8 = "SELECT * FROM compta_tiers WHERE compte = '$compte_credit' AND statut = 'Actif'";
              $res8 = $bd->query($req8);

              if ($res8->num_rows > 0) {
                while ($row8 = $res8->fetch_assoc()) {
                  $report_usd = $row8['usd'];
                }

                $solde1_usd = $tot_deb_usd - ($report_usd + $creditsusd);
                echo '<tr>' .
                  '<td align="left" colspan="5">SOLDE </td>' .
                  '<td colspan="2">' . '<strong>' . number_format($solde1_usd, 2) . '&nbsp;' . 'USD' . '<strong>' . '</td>';
                /*'<td colspan="2">0</td>'.
				            	'</tr>';*/
              } else {
                echo '0';
              }
            } else {
              echo '0';
            }
            //CDF
            $req12 = "SELECT sum(credits_cdf) AS total_credit_cdf FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res12 = $bd->query($req12);

            if ($res12->num_rows > 0) {
              while ($row12 = $res12->fetch_assoc()) {
                $tot_cred_cdf = $row12['total_credit_cdf'];
              }
            } else {
            }
            //debits cdf
            $req9 = "SELECT sum(debits_cdf) AS total_debitcdf FROM comptes_tiers WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res9 = $bd->query($req9);

            if ($res9->num_rows > 0) {
              while ($row9 = $res9->fetch_assoc()) {
                $tot_deb_cdf = $row9['total_debitcdf'];
              }
              $req10 = "SELECT * FROM compta_tiers WHERE compte = '$compte_credit' AND statut = 'Actif'";
              $res10 = $bd->query($req10);

              if ($res10->num_rows > 0) {
                while ($row10 = $res10->fetch_assoc()) {
                  $report_cdf = $row10['solde1_cdf'];
                }
                $solde1_cdf = $tot_deb_cdf - ($report_cdf + $tot_cred_cdf);

                echo '<td colspan="2">' . '<strong>' . number_format($solde1_cdf, 2) . '&nbsp;' . 'CDF' . '<strong>' . '</td>' .
                  '</tr>';
              } else {
                echo '0';
              }
            } else {
              echo '0';
            }
            // les toteaux
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Compte élève introuvable" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
        }
      }
    }
  } else {
    echo '';
  }
}

//fonction de calcule du compte personnel sur la table {comptes_autre, compta_autre}
function extrait_compte_autre_doc()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      if (empty($_GET['compte'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun parametre trouvé" . '</div>';
      } else {
        $compte_credit = $_GET['compte'];
        $req = "SELECT * FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
        $resultats = $bd->query($req);

        if ($resultats->num_rows > 0) {
          while ($row = $resultats->fetch_assoc()) {
            $devise = $row['devise'];
            echo '<tr>' .
              '<td>' . $row['date_doc'] . '</td>' .
              '<td>' . $row['ref_doc'] . '</td>' .
              '<td>' . $row['id'] . '</td>' .
              '<td>' . $row['libelle'] . '</td>' .
              '<td style="text-align:right">' . $row['credits_usd'] . '</td>' .
              '<td style="text-align:right">' . $row['debits_usd'] . '</td>' .
              '<td style="text-align:right">' . $row['credits_cdf'] . '</td>' .
              '<td style="text-align:right">' . $row['debits_cdf'] . '</td>';
          }
          echo '<tr><td colspan="8"></td></tr>
	        <tr>
					 	<td align="left" colspan="4">Totaux</td>';

          $req3 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res3 = $bd->query($req3);

          if ($res3->num_rows > 0) {
            while ($row3 = $res3->fetch_assoc()) {
              echo '<td style="text-align:right">' . '<strong>' . number_format($row3['total_credit_usd'], 2) . '</strong>' . '</td>';
            }
          } else {
          }
          $req2 = "SELECT sum(debits_usd) AS total_debit_usd FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res2 = $bd->query($req2);

          if ($res2->num_rows > 0) {
            while ($row2 = $res2->fetch_assoc()) {
              echo '<td style="text-align:right">' . '<strong>' . number_format($row2['total_debit_usd'], 2) . '</strong>' . '</td>';
            }
          } else {
          }
          $req5 = "SELECT sum(credits_cdf) AS total_credit_cdf FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res5 = $bd->query($req5);

          if ($res5->num_rows > 0) {
            while ($row5 = $res5->fetch_assoc()) {
              echo '<td style="text-align:right">' . '<strong>' . number_format($row5['total_credit_cdf'], 2) . '</strong>' . '</td>';
            }
          } else {
          }
          $req4 = "SELECT sum(debits_cdf) AS total_debit_cdf FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
          $res4 = $bd->query($req4);

          if ($res2->num_rows > 0) {
            while ($row4 = $res4->fetch_assoc()) {
              echo '<td style="text-align:right">' . '<strong>' . number_format($row4['total_debit_cdf'], 2) . '</strong>' . '</td>';
            }
          } else {
          }
          echo '</tr>' .
            '</tr>' .
            '<tr><td colspan="9"></td></tr>';

          $req6 = "SELECT * FROM compta_autres WHERE compte = '$compte_credit' AND statut = 'Actif'";
          $res6 = $bd->query($req6);

          if ($res6->num_rows > 0) {
            while ($row6 = $res6->fetch_assoc()) {

              echo '<tr>' .
                '<td align="left" colspan="4">REPORT</td>' .
                '<td colspan="2" style="text-align:right">' . '<strong>' . number_format($row6['solde1_usd'], 2) . '&nbsp;' . 'USD' . '</strong>' . '</td>' .
                '<td colspan="2" style="text-align:right">' . '<strong>' . number_format($row6['solde1_cdf'], 2) . '&nbsp;' . 'CDF' . '</strong>' . '</td>' .
                '</tr>';
              /*'<tr>'.
				            '<td align="center" colspan="5">SOLDE (USD,CDF)</td>'.
				            '<td colspan="2">0</td>'.
				            '<td colspan="2">0</td>'.
				          '</tr>';*/
            }
            // les toteaux
            //USD
            //Debit du compte usd
            $req11 = "SELECT sum(credits_usd) AS total_credit_usd FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res11 = $bd->query($req11);

            if ($res3->num_rows > 0) {
              while ($row11 = $res11->fetch_assoc()) {
                $creditsusd = $row11['total_credit_usd'];
              }
            } else {
            }
            //Credit du compte usd
            $req7 = "SELECT sum(debits_usd) AS total_debitusd FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res7 = $bd->query($req7);

            if ($res7->num_rows > 0) {
              while ($row7 = $res7->fetch_assoc()) {
                $tot_deb_usd = $row7['total_debitusd'];
              }

              $req8 = "SELECT * FROM compta_autres WHERE compte = '$compte_credit' AND statut = 'Actif'";
              $res8 = $bd->query($req8);

              if ($res8->num_rows > 0) {
                while ($row8 = $res8->fetch_assoc()) {
                  $report_usd = $row8['solde1_usd'];
                }
                $solde1_usd = $tot_deb_usd - ($report_usd + $creditsusd);
                echo '<tr>' .
                  '<td align="left" colspan="4">SOLDE </td>' .
                  '<td colspan="2" style="text-align:right">' . '<strong>' . number_format($solde1_usd, 2) . '&nbsp;' . 'USD' . '<strong>' . '</td>';
                /*'<td colspan="2">0</td>'.
				            '</tr>';*/
              } else {
                echo '0';
              }
            } else {
              echo '0';
            }
            //CDF
            $req12 = "SELECT sum(credits_cdf) AS total_credit_cdf FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res12 = $bd->query($req12);

            if ($res12->num_rows > 0) {
              while ($row12 = $res12->fetch_assoc()) {
                $tot_cred_cdf = $row12['total_credit_cdf'];
              }
            } else {
            }
            //debits cdf
            $req9 = "SELECT sum(debits_cdf) AS total_debitcdf FROM comptes_autres WHERE compte_credit = '$compte_credit' AND statut = 'en cours'";
            $res9 = $bd->query($req9);

            if ($res9->num_rows > 0) {
              while ($row9 = $res9->fetch_assoc()) {
                $tot_deb_cdf = $row9['total_debitcdf'];
              }

              $req10 = "SELECT * FROM compta_autres WHERE compte = '$compte_credit' AND statut = 'Actif'";
              $res10 = $bd->query($req10);

              if ($res10->num_rows > 0) {
                while ($row10 = $res10->fetch_assoc()) {
                  $report_cdf = $row10['solde1_cdf'];
                }
                $solde1_cdf = $tot_deb_cdf - ($report_cdf + $tot_cred_cdf);

                echo '<td colspan="2" style="text-align:right">' . '<strong>' . number_format($solde1_cdf, 2) . '&nbsp;' . 'CDF' . '<strong>' . '</td>' . '</tr>';
              } else {
                echo '0';
              }
            } else {
              echo '0';
            }
            // les toteaux
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Compte autre introuvable" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
        }
      }
    }
  } else {
    echo '';
  }
}

//Afficher la liste des Operation Divers
function liste_OD()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut_fin = "en cours";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
      $resultats = $bd->query($requete);

      if ($resultats->num_rows > 0) { // verification du compte administratif
        while ($row = $resultats->fetch_assoc()) {
          $code_admin = $row['code_admin'];
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['compte_eleve'])) {
            if (empty($_GET['groupe'])) {

              $req1 = "SELECT * FROM compte_od WHERE statut = 'en cours' ORDER BY id DESC";
              $res1 = $bd->query($req1);

              if ($res1->num_rows > 0) {
                while ($row1 = $res1->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">' . $row1['id'] . '</td>' .
                    '<td class="corp-table">' . $row1['ref_doc'] . '</td>' .
                    '<td class="corp-table">' . $row1['compte_debit'] . '</td>' .
                    '<td class="corp-table">' . $row1['compte_credit'] . '</td>' .
                    '<td class="corp-table">' . $row1['libelle'] . '</td>' .
                    '<td class="corp-table">' . $row1['montant'] . '</td>' .
                    '<td class="corp-table">' . $row1['devise'] . '</td>' .
                    '<td class="corp-table">' . $row1['date_doc'] . '</td>' .
                    '<td class="corp-table">' . $row1['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="compte_OD.php?ref_doc=' . $row1['ref_doc'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            } else {
              $groupe = $_GET['groupe'];
              $req2 = "SELECT * FROM comptes_eleve WHERE groupe LIKE '%$groupe%'";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row2 = $res2->fetch_assoc()) {
                  echo '<tr>' .
                    '<td class="corp-table">' . $row2['id'] . '</td>' .
                    '<td class="corp-table">' . $row2['ref_doc'] . '</td>' .
                    '<td class="corp-table">' . $row2['compte_eleve'] . '</td>' .
                    '<td class="corp-table">' . $row2['libelle'] . '</td>' .
                    '<td class="corp-table">' . $row2['nature_operation'] . '</td>' .
                    '<td class="corp-table">' . $row2['tarification'] . '</td>' .
                    '<td class="corp-table">' . $row2['compte_debit'] . '</td>' .
                    '<td class="corp-table">' . $row2['montant'] . '</td>' .
                    '<td class="corp-table">' . $row2['devise'] . '</td>' .
                    '<td class="corp-table">' . $row2['taux'] . '</td>' .
                    '<td class="corp-table">' . $row2['date_doc'] . '</td>' .
                    '<td class="corp-table">' . $row2['date_crea'] . '</td>' .
                    '<td class="corp-table">' . $row2['anne_scolaire'] . '</td>' .
                    '<td class="corp-table">' . $row2['statut'] . '</td>' .
                    '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_trans?ref_doc=' . $row2['ref_doc'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
                    '<tr>';
                }
              } else {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucunne information trouvée" . '</div>';
              }
            }
          } else {
            $compte_eleve = $_GET['compte_eleve'];
            $req3 = "SELECT * FROM comptes_eleve WHERE compte_eleve LIKE '%$compte_eleve%'";
            $res3 = $bd->query($req3);

            if ($res3->num_rows > 0) {
              while ($row3 = $res3->fetch_assoc()) {
                echo '<tr>' .
                  '<td class="corp-table">' . $row3['id'] . '</td>' .
                  '<td class="corp-table">' . $row3['ref_doc'] . '</td>' .
                  '<td class="corp-table">' . $row3['compte_eleve'] . '</td>' .
                  '<td class="corp-table">' . $row3['libelle'] . '</td>' .
                  '<td class="corp-table">' . $row3['nature_operation'] . '</td>' .
                  '<td class="corp-table">' . $row3['tarification'] . '</td>' .
                  '<td class="corp-table">' . $row3['compte_debit'] . '</td>' .
                  '<td class="corp-table">' . $row3['montant'] . '</td>' .
                  '<td class="corp-table">' . $row3['devise'] . '</td>' .
                  '<td class="corp-table">' . $row3['taux'] . '</td>' .
                  '<td class="corp-table">' . $row3['date_doc'] . '</td>' .
                  '<td class="corp-table">' . $row3['date_crea'] . '</td>' .
                  '<td class="corp-table">' . $row3['anne_scolaire'] . '</td>' .
                  '<td class="corp-table">' . $row3['statut'] . '</td>' .
                  '<td class="corp-table" style="background-color:#44597b!important;text-align:center!important;border:0px solid #ddd!important;box-shadow:0 1px 4px rgba(0,0,0,0.6);">' . '<a href="maj-encodage_trans.php?ref_doc=' . $row3['ref_doc'] . '" class="selecteur text-white" title="Cliquez pour selectionner">' . 'select' . '</a>' . '</td>' .
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

//Entête du balance de compte par classe
function balanceparclasse()
{
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
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['Classe'])) {
            echo '';
          } else { // recherche par classe 
            $parclasse = $_GET['Classe'];

            echo $parclasse;
          } // recherche par classe
        } else {
          echo '';
        } // verification de droit administratif
      } else {
        echo '';
      } // verification du compte administratif
    }
  } else {
    echo '';
  }
} //fin fonction impression compta_autres

//Afficher les elements Compta_autres par classe
function Etat_compta_autres()
{
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
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['Classe'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'un parametre." . '</div>';
          } else { // recherche par classe
            $parclasse = $_GET['Classe'];

            $req2 = "SELECT * FROM compta_autres WHERE clas ='$parclasse' ORDER BY description ASC";
            $sql2 = $bd->query($req2);

            if ($sql2->num_rows > 0) {
              while ($row2 = $sql2->fetch_assoc()) {
                $num_compte        = $row2['compte'];
                $description       = $row2['description'];
                $Report_cdf        = $row2['solde1_cdf'];
                $Totaux_debit_cdf  = $row2['debit2_cdf'];
                $Totaux_credit_cdf = $row2['credit2_cdf'];
                $Report_usd        = $row2['solde1_usd'];
                $Totaux_debit_usd  = $row2['debit2_usd'];
                $Totaux_credit_usd = $row2['credit2_usd'];
                $Solde_CDF         = $row2['solde2_cdf'];
                $Solde_USD         = $row2['solde2_usd'];

                echo '<tr>' .
                  '<th style="border: 1px solid #000;font-weight: bold;">' . $num_compte . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">' . $description . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Report_cdf . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Totaux_debit_cdf . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Totaux_credit_cdf . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Solde_CDF . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Report_usd . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Totaux_debit_usd . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Totaux_credit_usd . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . $Solde_USD . '</th>' .
                  '</tr>';
              }
            } else { //
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée." . '</div>';
            }
          } // recherche par classe
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
} //fin fonction impression Compta_autres par classe

function liste_balancegroupe()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    $admin = $_SESSION['pseudo'];
    $params = 1;
    $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
    $resultats = $bd->query($requete);

    if ($resultats->num_rows > 0) {
      while ($row = $resultats->fetch_assoc()
      ) {
        $code_admin = $row['code_admin'];
      }
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {
        $req2 = "SELECT * FROM balancepargroupe_tb";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="' . $row['groupe'] . '">' . $row['classes'] . '</option>';
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

//impression compta_autres entête par groupe
function balancepargroupe()
{
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
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance = '$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['Groupe'])) {
            echo '';
          } else { // recherche par classe 
            $parGroupe = $_GET['Groupe'];

            echo $parGroupe;
          } // recherche par classe
        } else {
          echo '';
        } // verification de droit administratif
      } else {
        echo '';
      } // verification du compte administratif
    }
  } else {
    echo '';
  }
} //fin fonction impression compta_autres entête par groupe

//impression Compta_autres par Groupe
function Etat_compta_autres_Groupe()
{
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
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['Groupe'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'un parametre." . '</div>';
          } else { // recherche par classe
            $pargroupe = $_GET['Groupe'];

            $req2 = "SELECT * FROM compta_autres WHERE groupe ='$pargroupe' ORDER BY description ASC";
            $sql2 = $bd->query($req2);

            if ($sql2->num_rows > 0) {
              while ($row2 = $sql2->fetch_assoc()) {
                $num_compte        = $row2['compte'];
                $description       = $row2['description'];
                $Report_cdf        = $row2['solde1_cdf'];
                $Totaux_debit_cdf  = $row2['debit2_cdf'];
                $Totaux_credit_cdf = $row2['credit2_cdf'];
                $Report_usd        = $row2['solde1_usd'];
                $Totaux_debit_usd  = $row2['debit2_usd'];
                $Totaux_credit_usd = $row2['credit2_usd'];
                $Taux              = $row2['taux'];
                $Solde_CDF         = $row2['solde2_cdf'];
                $Solde_USD         = $row2['solde2_usd'];

                echo '<tr>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">' . $num_compte . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">' . $description . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Report_cdf, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Totaux_debit_cdf, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Totaux_credit_cdf, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Solde_CDF, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Report_usd, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Totaux_debit_usd, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Totaux_credit_usd, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">' . number_format($Solde_USD, 2) . '</th>' .
                  '</tr>';
              }
            } else { //
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée." . '</div>';
            }
          } // recherche par classe
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
} //fin fonction impression Compta_autres par Groupe

//impression Compta_autres Global par classe
function Etat_compta_autres_Global()
{
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
        }
        $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res1 = $bd->query($req1);

        if ($res1->num_rows > 0) { // verification de droit administratif
          if (empty($_GET['Groupe'])) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Violation d'un parametre." . '</div>';
          } else { // recherche par classe
            $pargroupe = $_GET['Groupe'];

            $req2 = "SELECT * FROM compta_autres WHERE groupe ='$pargroupe' ORDER BY description ASC";
            $sql2 = $bd->query($req2);

            if ($sql2->num_rows > 0) {
              while ($row2 = $sql2->fetch_assoc()) {
                $num_compte        = $row2['compte'];
                $description       = $row2['description'];
                $Report_cdf        = $row2['solde1_cdf'];
                $Report_usd        = $row2['solde1_usd'];
                $Taux              = $row2['taux'];
                $Total_debit_usd  = $row2['Totaux_debit_usd'];
                $Total_credit_usd = $row2['Totaux_credit_usd'];

                //Equation
                $Report = ($Report_cdf) + $Report_usd;
                $Solde_USD = $Report + $Total_debit_usd - $Total_credit_usd;

                echo '<tr>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">'.$num_compte . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">'.$description . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Report, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Total_credit_usd, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Total_debit_usd, 2) . '</th>' .
                  '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Solde_USD, 2) . '</th>' .
                  '</tr>';
              }
            } else { //
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée." . '</div>';
            }
          } // recherche par classe
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
} //fin fonction impression Compta_autres Global par classe

//Afficher le Rapport global Campta_autre
function Etat_rapport_global_compta_autre()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if ($bd->connect_error) {
      die('Impossible de se connecter à la BD:' . $bd->connect_error);
    } else { // fin base de données
      $admin = $_SESSION['pseudo'];
      $params = 1;
      $statut = "actif";
      $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
      $result = $bd->query($requete);

      if ($result->num_rows > 0) { // verification du compte administratif
        while ($row = $result->fetch_assoc()) {
          $code_admin = $row['code_admin'];
        }
        $req = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
        $res = $bd->query($req);

        if ($res->num_rows > 0) {
          $get = "SELECT * FROM compta_autres WHERE clas =6 AND statut ='$statut'";
          $ser = $bd->query($get);

          if ($ser->num_rows > 0) {
            while ($row1 = $ser->fetch_assoc()) {
              $ID = $row1['id'];
              $Description = $row1['description'];
              $Solde_USD   = $row1['solde1_usd'];
              $Solde_CDF   = $row1['solde1_cdf'];
              $Debit_USD   = $row1['Totaux_debit_usd'];
              $Credit_USD  = $row1['Totaux_credit_usd'];
              $Taux        = $row1['taux'];
            }
            //Calcule de toutes compte debit classe 7
            $get1 = "SELECT sum(Totaux_debit_usd) AS Total_debit_usd FROM compta_autres WHERE clas =7 AND statut ='$statut'";
            $ser1 = $bd->query($get1);

            if ($ser1->num_rows > 0) {
              while ($row2 = $ser1->fetch_assoc()) {
                $Total_Debit = number_format($row2['Total_debit_usd'], 2);
                $Total_Debit1 = $row2['Total_debit_usd'];
              }
            }
            $get2 = "SELECT sum(Totaux_credit_usd) AS Total_credit_usd FROM compta_autres WHERE clas =7 AND statut ='$statut'";
            $ser2 = $bd->query($get2);

            if ($ser2->num_rows > 0) {
              while ($row3 = $ser2->fetch_assoc()) {
                $Total_Credit = number_format($row3['Total_credit_usd'], 2);
                $Total_Credit1 = $row3['Total_credit_usd'];
              }
            }
            $get3 = "SELECT sum(solde1_usd) AS Solde_glob_USD FROM compta_autres WHERE clas =7 AND statut ='$statut'";
            $ser3 = $bd->query($get3);

            if ($ser3->num_rows > 0) {
              while ($row4 = $ser3->fetch_assoc()) {
                $Sold_USD = $row4['Solde_glob_USD'];
              }
            }
            $get4 = "SELECT sum(solde1_cdf) AS Solde_glob_CDF FROM compta_autres WHERE clas =7 AND statut ='$statut'";
            $ser4 = $bd->query($get4);

            if ($ser4->num_rows > 0) {
              while ($row5 = $ser4->fetch_assoc()) {
                $Sold_CDF = $row5['Solde_glob_CDF'];
              }
            }

            //Calcule de toutes compte debit classe 6
            $get1 = "SELECT sum(Totaux_debit_usd) AS Total_debit_usd2 FROM compta_autres WHERE clas =6 AND statut ='$statut'";
            $ser1 = $bd->query($get1);

            if ($ser1->num_rows > 0) {
              while ($row2 = $ser1->fetch_assoc()) {
                $Total_Debit2 = number_format($row2['Total_debit_usd2'], 2);
                $Total_Debit3 = $row2['Total_debit_usd2'];
              }
            }
            $get2 = "SELECT sum(Totaux_credit_usd) AS Total_credit_usd2 FROM compta_autres WHERE clas =6 AND statut ='$statut'";
            $ser2 = $bd->query($get2);

            if ($ser2->num_rows > 0) {
              while ($row3 = $ser2->fetch_assoc()) {
                $Total_Credit2 = number_format($row3['Total_credit_usd2'], 2);
                $Total_Credit3 = $row3['Total_credit_usd2'];
              }
            }
            $get3 = "SELECT sum(solde1_usd) AS Solde_glob_USD2 FROM compta_autres WHERE clas =6 AND statut ='$statut'";
            $ser3 = $bd->query($get3);

            if ($ser3->num_rows > 0) {
              while ($row4 = $ser3->fetch_assoc()) {
                $Sold_USD2 = $row4['Solde_glob_USD2'];
              }
            }
            $get4 = "SELECT sum(solde1_cdf) AS Solde_glob_CDF2 FROM compta_autres WHERE clas =6 AND statut ='$statut'";
            $ser4 = $bd->query($get4);

            if ($ser4->num_rows > 0) {
              while ($row5 = $ser4->fetch_assoc()) {
                $Sold_CDF2 = $row5['Solde_glob_CDF2'];
              }
            }
            //Equation2 Total des entrées
            $Raport_glob_cpte7 = ($Sold_CDF / $Taux) + $Sold_USD;
            $Sold_glob_USD = $Raport_glob_cpte7 + $Total_Debit1 - $Total_Credit1;

            //Equation3 Total des sorties
            $Raport_glob_cpte6 = ($Sold_CDF2 / $Taux) + $Sold_USD2;
            $Sold_glob_USD2 = $Raport_glob_cpte6 + $Total_Debit3 - $Total_Credit3;

            //Equation3
            $Solde_clas76 = $Sold_glob_USD - $Sold_glob_USD2;

            //Affichager du coût global classe 7 et 6
            //Toute le Total des entrées
            echo '<tr>' .
              '<td class="corp-table">1</td>' .
              '<td class="corp-table">Total des entrées</td>' .
              '<td class="corp-table text-right">' . number_format($Raport_glob_cpte7, 2) . '</td>' .
              '<td class="corp-table text-right">' . $Total_Debit . '</td>' .
              '<td class="corp-table text-right">' . $Total_Credit . '</td>' .
              '<td class="corp-table text-right">' . number_format($Sold_glob_USD, 2) . '</td>' .
              '</tr>';
            //Toute le Total des sorties
            echo '<tr>' .
              '<td class="corp-table">2</td>' .
              '<td class="corp-table">Total des sorties</td>' .
              '<td class="corp-table text-right">' . number_format($Raport_glob_cpte6, 2) . '</td>' .
              '<td class="corp-table text-right">' . $Total_Debit2 . '</td>' .
              '<td class="corp-table text-right">' . $Total_Credit2 . '</td>' .
              '<td class="corp-table text-right">' . number_format($Sold_glob_USD2, 2) . '</td>' .
              '</tr>';
            //Le solde des entées et sortie
            echo '<tr><td colspan="6"></td></tr>';
            echo '<tr>' .
              '<td class="corp-table">3</td>' .
              '<td class="corp-table" colspan="4" style="font-weight:bold;font-size:20px;">Solde </td>' .
              '<td class="corp-table text-center" style="font-weight:bold;font-size:20px;background:#c9c6ca">' . number_format($Solde_clas76, 2) . '</td>' .
              '</tr>';
          } else {
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucune information trouvée" . '</div>';
          }
        } else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">' . "Aucun droit d'administration trouvé" . '</div>';
        }
      } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Votre compte est invalide." . '</div>';
      } // verification du compte administratif
    }
  } else {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">' . "Connexion perdue." . '</div>';
  }
} //fin fonction impression Rapport global Campta_autre

//fonction d'attire la liste des personnels à la BDD
function liste_perAgentActif()
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
      $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params = '$params' ";
      $res1 = $bd->query($req1);

      if ($res1->num_rows > 0) {
        $req2 = "SELECT * FROM peragent_tb WHERE statut ='Actif' ORDER BY nom_complet ASC ";
        $res2 = $bd->query($req2);

        if ($res2->num_rows > 0) {
          while ($row = $res2->fetch_assoc()) {
            echo '<option value="'.$row['nom_complet'].'">'.$row['nom_complet'].'</option>';
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

//Afficher la liste de transaction globals dans le table compta_autre
function balance_detailsAll()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows > 0) {
            while ($row = $resultats->fetch_assoc()) {
              $code_admin = $row['code_admin'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              $req2 = "SELECT * FROM compta_autres";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  $num_compte        = $row['compte'];
                  $description       = $row['description'];
                  $Report_cdf        = $row['solde1_cdf'];
                  $Totaux_debit_cdf  = $row['debit2_cdf'];
                  $Totaux_credit_cdf = $row['credit2_cdf'];
                  $Report_usd        = $row['solde1_usd'];
                  $Totaux_debit_usd  = $row['debit2_usd'];
                  $Totaux_credit_usd = $row['credit2_usd'];
                  $Solde_CDF         = $row['solde2_cdf'];
                  $Solde_USD         = $row['solde2_usd'];

                  echo'<tr>' .
                        '<th style="border: 1px solid #000;font-weight: bold;">'.$num_compte.'</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">' . $description . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Report_cdf . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Totaux_credit_cdf . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Totaux_debit_cdf . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Solde_CDF . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Report_usd . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Totaux_credit_usd . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Totaux_debit_usd . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.$Solde_USD . '</th>' .
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
          
          //filtrage eleve par option
        }
      } else {
        //filtrage eleve par nom

      }
    } else {
      //filtrage eleve par classe
      
      //filtrage eleve par classe
    }
  } else {
  }
}

//Afficher la liste de transaction globals Dollars et franc dans le table compta_autre
function balglobal_detailsAll()
{
  if (isset($_SESSION['pseudo'])) {
    include("connexion.php");
    if (empty($_GET['ref_doc'])) {
      if (empty($_GET['nom_eleve'])) {
        if (empty($_GET['date_doc'])) {
          $d_id = date("y-m-d");
          $d_ida = date("d-m-y");
          $h_id = date("h:i:s");
          $dat = $d_ida . " " . $h_id;
          $admin = $_SESSION['pseudo'];
          $params = 1;
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd->query($requete);

          if ($resultats->num_rows > 0) {
            while ($row = $resultats->fetch_assoc()) {
              $code_admin = $row['code_admin'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd->query($req1);

            if ($res1->num_rows > 0) {
              $req2 = "SELECT * FROM compta_autres";
              $res2 = $bd->query($req2);

              if ($res2->num_rows > 0) {
                while ($row = $res2->fetch_assoc()) {
                  $num_compte        = $row['compte'];
                  $description       = $row['description'];
                  $Report_cdf        = $row['solde1_cdf'];
                  $Report_usd        = $row['solde1_usd'];
                  $Taux              = $row['taux'];
                  $Total_debit_usd   = $row['Totaux_debit_usd'];
                  $Total_credit_usd  = $row['Totaux_credit_usd'];

                  //Equation
                  $Report = ($Report_cdf) + $Report_usd;
                  $Solde_USD = $Report + $Total_debit_usd - $Total_credit_usd;

                  echo'<tr>'.
                        '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">'.$num_compte . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-transform: uppercase;">'.$description . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Report, 2) . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Total_credit_usd, 2) . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Total_debit_usd, 2) . '</th>' .
                        '<th style="border: 1px solid #000;font-weight: bold;text-align: right">'.number_format($Solde_USD, 2) . '</th>' .
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

          //filtrage eleve par option
        }
      } else {
        //filtrage eleve par nom

      }
    } else {
      //filtrage eleve par classe

      //filtrage eleve par classe
    }
  } else {
  }
}