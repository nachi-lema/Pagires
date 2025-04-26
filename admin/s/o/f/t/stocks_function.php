<?php


//Creation de stock initial
function new_stock(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_stock'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("y-m-d");
        $h_id=date("h:i:s");
        $dat=$d_id." ".$h_id;
        $conc_id=md5($dat);
        $code_user=substr($conc_id,0 ,8);
        $bloc4 = 4111;
        $deban = substr($d_id,6 ,8);
        $categorie_stock = $bd->real_escape_string($_POST['categorie_stock']);
        $article = $bd->real_escape_string($_POST['article']);
        $description = $bd->real_escape_string($_POST['description']);
        $numero = $bd->real_escape_string($_POST['numero']);
        $unite = $bd->real_escape_string($_POST['unite']);
        $quantite = $bd->real_escape_string($_POST['quantite']);
        $devise = $bd->real_escape_string($_POST['devise']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $date_stock = $bd->real_escape_string($_POST['date_stock']);
        $punite = $bd->real_escape_string($_POST['punite']);
        $index = $bd->real_escape_string($_POST['index']);
        $conf = $bd->real_escape_string($_POST['conf']);
        $dette_usd = $quantite * $punite;
        $prixvent = $index * $punite;
        $statut_appro = $bd->real_escape_string($_POST['statut_appro']);
        $ref_doc = $bd->real_escape_string($_POST['reference']);
        $code_ref = $ref_doc.'_'.$numero;
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params=1;
        $admin = $_SESSION['pseudo'];
        
        if (!filter_var($date_stock)) {
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."le format e-mail non autorisé.".'</div>'; 
        }
        else{
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params = '$params'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              $code_admin = $row['code_admin'];
              $societe = $row['societe'];
              $codsoc = $row['code_soc'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd ->query($req1);

            if ($res1 ->num_rows > 0) {
              //Enregistrement de creation stock
              $req2 = "SELECT * FROM appro_stocks WHERE statut ='Actif' ORDER BY id ASC";
              $res2 = $bd ->query($req2); 

              if ($res2 ->num_rows > 0) {
                while($row = $res2 ->fetch_assoc()){
                  $id = $row['id']; 
                }
                $n = $id ++;
                $num_compte = $bloc4.'-'.$deban.'-'.$n;

                $req3 = "SELECT * FROM appro_stocks WHERE article ='$article' AND statut ='$statut_appro'";
                $res3 = $bd ->query($req3);

                if ($res3 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet element existe déjà.".'</div>'; 
                }
                else{
                  $req4 = "INSERT INTO appro_stocks(code_soc,societe,ref_article, date_stock, categorie, description, article, numero, conf1, unite_stock, Qte_stock, psunit, pstotal, indexa, facture, 
                                                      devise, taux, groupe, date_crea, statut, customer, ip_user) 
                                      VALUES ('".$codsoc."','".$societe."','". $ref_doc."','".$date_stock."','".$categorie_stock."','".$description."', '".$article."', '".$numero."','".$conf."','".$unite."', 
                                                '".$quantite."', '".$punite."', '".$dette_usd."', '".$index."', '".$prixvent."', '".$devise."', '".$taux."', '".$categorie_stock."', 
                                                '".$d_id."', '".$statut_appro."', '".$admin."', '".$ip_user."')";
                  $req4X = "INSERT INTO appro_invent(code_soc,societe,ref_article, categorie, description, article, unite_stock, qte_stock, stock_fin, pstotal, totstock, date_crea, customer) 
                                            VALUES ('".$codsoc."','".$societe."','". $ref_doc."','".$categorie_stock."','".$description."', '".$article."','".$unite."','".$quantite."','".$quantite."','".$dette_usd."',
                                                      '".$dette_usd."','".$d_id."','".$admin."')";
                  $res4 = $bd ->query($req4);
                  $res4X = $bd->query($req4X);

                  if ($res4 == true && $res4X == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Nouveau stock pris en charge.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge.".'</div>'; 
                  }
                }
              }
              else{
                $num_compte1 = $bloc4.'-'.$deban.'-'.'0';
                $req5 = "SELECT * FROM appro_stocks WHERE article ='$article' AND statut ='actif'";
                $res5 = $bd ->query($req5);

                if ($res5 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet element existe déjà.".'</div>'; 
                }
                else{
                  $req6 = "INSERT INTO appro_stocks(code_soc,societe,ref_article, date_stock, categorie, description, article, numero, conf1, unite_stock, Qte_stock, psunit, pstotal, indexa, facture,
                                                      devise, taux, groupe, date_crea, statut, customer, ip_user) 
                                        VALUES ('".$codsoc."','".$societe."','". $ref_doc."', '".$date_stock."','".$categorie_stock."','".$description."','".$article."','".$numero."', '".$conf."', '".$unite."', 
                                                    '".$quantite."', '".$punite."', '".$dette_usd."', '".$index."', '".$prixvent."', '".$devise."', '".$taux."', '".$categorie_stock."', 
                                                    '".$d_id."','".$statut_appro."','".$admin."','".$ip_user."')";

                  $req6X = "INSERT INTO appro_invent(code_soc,societe,ref_article, categorie, description, article, unite_stock, qte_stock, stock_fin, pstotal, totstock, date_crea, customer) 
                                            VALUES ('".$codsoc."','".$societe."','". $ref_doc."','".$categorie_stock."','".$description."', '".$article."','".$unite."','".$quantite."','".$quantite."','".$dette_usd."',
                                                    '".$dette_usd."','".$d_id."','".$admin."')";
                  $res6 = $bd ->query($req6);
                  $res6X = $bd ->query($req6X);

                  if ($res6 == true && $res6X == true) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Nouveau Stock pris en charge.'.'</div>';
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Stock non pris en charge.".'</div>'; 
                  }
                }
              }
              //Enregistrement de stock initial
            }
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';  
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
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Connexion perdue.".'</div>'; 
  }
}

// Mise à jour Stock
function edit_stock(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_editstock'])) {
      if (empty($_GET['ref_article'])&& empty($_GET['Societe'])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $compte_artcle = $_GET['ref_article'];
        $id_societe = $_GET['Societe'];
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
          $categorie_stock = $bd->real_escape_string($_POST['categorie_stock']);
          $article = $bd->real_escape_string($_POST['article']);
          $numero = $bd->real_escape_string($_POST['numero']);
          $unite = $bd->real_escape_string($_POST['unite']);
          $quantite = $bd->real_escape_string($_POST['quantite']);
          $devise = $bd->real_escape_string($_POST['devise']);
          $taux = $bd->real_escape_string($_POST['taux']);
          $date_stock = $bd->real_escape_string($_POST['date_stock']);
          $punite = $bd->real_escape_string($_POST['punite']);
          $indexa = $bd->real_escape_string($_POST['indexa']);
          $dette_usd = $quantite * $punite;
          $statut_appro = $bd->real_escape_string($_POST['statut_appro']);
          $ref_doc = substr($categorie_stock,0 ,4);
          $code_ref = $ref_doc.'_'.$numero;
          $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
          $params=1;
          $droit=0;
          $statut="master";
          
          if (!filter_var($categorie_stock)) {
                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                "Le format e-mail non autorisé.".'</div>'; 
          }
          else{
            $requete = "SELECT * FROM  admin_tb WHERE statut='$statut' AND pseudo='".$_SESSION['pseudo']."'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows < 0) {
              while($row = $resultats ->fetch_assoc()){
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration'.'</div>'; 
              }
            }
            else{// code admin

              $sql = "UPDATE appro_stocks SET categorie ='$categorie_stock', article ='$article', numero ='$numero', unite_stock ='$unite', Qte_stock ='$quantite', psunit='$punite', 
                                          pstotal ='$dette_usd', indexa='$indexa', devise ='$devise', taux ='$taux', date_stock ='$date_stock', date_edit ='$dat', customer ='$customer', ip_user='$ip_user' 
                                          WHERE ref_article ='$compte_artcle' AND societe='$id_societe' AND statut ='$statut_appro'";

              $sql1 ="UPDATE appro_invent SET categorie='$categorie_stock',article='$article',unite_stock='$unite',qte_stock='$quantite',pstotal='$dette_usd',
                                          date_edit='$dat',customer='$customer' WHERE ref_article='$compte_artcle' AND societe='$id_societe'";
              $sav = $bd->query($sql);
              $sav1 = $bd->query($sql1);

              if ($sav == true && $sav1 == true) {
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="mess">'.'Modification effectuée.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Modification echouée.'.'</div>'; 
              }
            }// code admin

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
//fin mise à jour stock

//debut de la suppression Articles
function delete_stock(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_delArticle'])) {
      if (empty($_GET['ref_article'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Aucun parametre trouvé'.'</div>';
      }
      else{
        $compte_artcle= $_GET['ref_article'];
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
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration vous est donné.'.'</div>'; 
            }
          }
          else{// code admin
            $requete = "SELECT * FROM appro_stocks WHERE ref_article ='$compte_artcle' AND statut ='Actif'";
            $resultats = $bd ->query($requete);

            if ($resultats ->num_rows > 0) {// verification de l'admin master
              $sql="DELETE FROM appro_stocks WHERE ref_article ='$compte_artcle' AND statut ='Actif'";
              $sav = $bd->query($sql);

              if ($sav == true) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="mess">'.'Article vient de supprimé avec succès.'.'</div>';
              }
              else{
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Suppression echouée.'.'</div>'; 
              }
            }
            else{
              echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Compte Article introuvable'.'</div>'; 
            }
          }// code admin
        }
        $bd->close();
      }
    }  
  } // fin fonction
  //fin de la suppression stock
}

//Enregistrement d'Achats de stock
function new_Achatstock(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_Achat'])) {
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
        $bloc4 = 4111;
        $deban = substr($d_id,6 ,8);
        $categorie = $bd->real_escape_string($_POST['categorie']);
        $article = $bd->real_escape_string($_POST['article']);
        $ref_article = $bd->real_escape_string($_POST['ref_article']);
        $unite = $bd->real_escape_string($_POST['unite']);
        $quantite = $bd->real_escape_string($_POST['quantite']);
        $devise = $bd->real_escape_string($_POST['devise']);
        $taux = $bd->real_escape_string($_POST['taux']);
        $punite = $bd->real_escape_string($_POST['punite']);
        $index = $bd->real_escape_string($_POST['index']);
        $date_fac = $bd->real_escape_string($_POST['date_fac']);
        $nomsf = $bd->real_escape_string($_POST['nomsf']);
        $phonef = $bd->real_escape_string($_POST['phonef']);
        $mail_fourn = $bd->real_escape_string($_POST['mail_fourn']);
        $avenue = $bd->real_escape_string($_POST['avenue']);
        $quartier = $bd->real_escape_string($_POST['quartier']);
        $adressef = $bd->real_escape_string($_POST['adressef']);
        $adressecomplet = $avenue.' '.$quartier.' '.$adressef;
        $facture = $punite * $index;
        $pa_total = $quantite * $punite;
        $statut_achat = $bd->real_escape_string($_POST['statut_achat']);
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
        $params=1;
        $admin = $_SESSION['pseudo'];

        if (!filter_var($date_fac)) {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."le format e-mail non autorisé.".'</div>'; 
        }
        else{
          $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
          $resultats = $bd ->query($requete);

          if ($resultats ->num_rows > 0) {
            while($row = $resultats ->fetch_assoc()){
              $code_admin = $row['code_admin'];
              $societe = $row['societe'];
              $codsoc = $row['code_soc'];
            }
            $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_inscription = 1 AND params ='$params'";
            $res1 = $bd ->query($req1);

            if ($res1 ->num_rows > 0) {

              //Enregistrement Achat stock
              $req2 = "SELECT * FROM appro_stocks WHERE societe='$societe' AND article ='$article' AND ref_article ='$ref_article' AND statut ='Actif'";
              $res2 = $bd ->query($req2);

              if ($res2 ->num_rows > 0) {
                while($row = $res2 ->fetch_assoc()){
                  $id = $row['id'];
                  $description = $row['description'];
                }

                $req3 = "SELECT * FROM appro_achats WHERE societe='$societe' AND adresse_fourn ='$unite' AND statut ='$statut_achat'";
                $res3 = $bd ->query($req3);

                if ($res3 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cette reference existe déjà.".'</div>'; 
                }
                else{
                  $req4 = "INSERT INTO appro_achats(code_soc,societe,ref_article, date_facture, categorie, description, article, unite_achat, Qte_achat, pa_unite, pa_total, devise, taux, facture, 
                                                    nom_fourn, adresse_fourn, tel_fourn, email_fourn, groupe, date_crea, statut, customer, ip_user) 
                                              VALUES ('".$codsoc."','".$societe."','".$ref_article."','".$date_fac."','".$categorie."','".$description."','".$article."','".$unite."','".$quantite."','".$punite."', 
                                                        '".$pa_total."', '".$devise."', '".$taux."', '".$facture."', '".$nomsf."','".$adressecomplet."','".$phonef."','".$mail_fourn."',  
                                                        '".$categorie."', '".$dat."', '".$statut_achat."', '".$admin."', '".$ip_user."')";
                  $res4 = $bd ->query($req4);

                  if ($res4 == true) {
                    $req4x = "SELECT * FROM appro_stocks WHERE societe='$societe' AND ref_article ='$ref_article'";
                    $res4x = $bd ->query($req4x);

                    if ($res4x ->num_rows > 0) {
                      while($row4x = $res4x ->fetch_assoc()){
                        $Qte_stock = $row4x['Qte_stock'];
                      }
                      $solde = $Qte_stock*$punite;

                      $req4x1 ="UPDATE appro_stocks SET psunit = '$punite', pstotal ='$solde', facture ='$facture', indexa ='$index' WHERE societe='$societe' AND ref_article ='$ref_article'";
                      $res4x1 = $bd ->query($req4x1);

                      if ($res4x1 == true){
                        //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement pris en charge".'</div>';
                        $req4x2 = "SELECT * FROM appro_invent WHERE societe='$societe' AND ref_article ='$ref_article'";
                        $res4x2 = $bd ->query($req4x2);

                        if ($res4x2 ->num_rows > 0) {
                          while ($row4x2 = $res4x2 ->fetch_assoc()) {
                            $qte_stock = $row4x2['qte_stock'];
                            $qte_vente = $row4x2['qte_vente'];
                            $qte_achat = $row4x2['qte_achat'];
                            $patotal   = $row4x2['patotal'];
                            $pstotal   = $row4x2['pstotal'];
                            $pvtotal   = $row4x2['pvtotal'];
                            $totstock  = $row4x2['totstock'];
                            $stock_fin = $row4x2['stock_fin'];
                          }
                          //Calcule
                          $QuantiteAcht = $qte_achat + $quantite;
                          $PA_total = $QuantiteAcht * $punite;
                          $Stock_fin = ($stock_fin + $quantite)-$qte_vente;
                          $Totstock = ($solde + $PA_total)-$pvtotal;

                          $req4x3 = "UPDATE appro_invent SET qte_achat ='$QuantiteAcht', pstotal ='$solde', patotal ='$PA_total', stock_fin ='$Stock_fin', totstock ='$Totstock' WHERE societe='$societe' AND ref_article ='$ref_article'";
                          $res4x3 = $bd ->query($req4x3);

                          if ($res4x3 == true && $res4x2 == true) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur" style="font-size:18px">'."Article avec success".'</div>';
                          }
                          else {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge".'</div>';
                          }
                        }
                      }
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge".'</div>';
                      }
                    }
                  }
                  /*INSERT INTO `appro_invent`(`id`, `ref_article`, `categorie`, `description`, `article`, `unite_stock`, `qte_stock`, `qte_achat`, `qte_vente`, `stock_fin`, `pstotal`, `patotal`, `pvtotal`, `totstock`, `date_crea`, `date_edit`, `customer`) VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]','[value-15]','[value-16]','[value-17]')*/

                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge.".'</div>'; 
                  }
                }
              }
              else{
                $req5 = "SELECT * FROM appro_achats WHERE societe='$societe' AND adresse_fourn ='$unite' AND statut ='actif'";
                $res5 = $bd ->query($req5);

                if ($res5 ->num_rows > 0) {
                  echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Cet reference existe déjà.".'</div>'; 
                }
                else{
                  $req6 = "INSERT INTO appro_achats(code_soc,societe,ref_article, date_facture, categorie, description, article, unite_achat, Qte_achat, pa_unite, pa_total, devise, taux, facture, 
                                                    nom_fourn, adresse_fourn, tel_fourn, email_fourn, groupe, date_crea, statut, customer, ip_user) 
                                              VALUES ('".$codsoc."','".$societe."','".$ref_article."','".$date_fac."','".$categorie."','".$description."','".$article."','".$unite."','".$quantite."','".$punite."', 
                                                      '".$pa_total."','".$devise."','".$taux."','".$facture."','".$nomsf."','".$adressecomplet."','".$phonef."','".$mail_fourn."',
                                                      '".$categorie."','".$dat."','".$statut_achat."','".$admin."','".$ip_user."')";
                  $res6 = $bd ->query($req6);

                  if ($res6 == true) {
                    $req6x = "SELECT * FROM appro_stocks WHERE societe='$societe' AND ref_article ='$ref_article'";
                    $res6x = $bd ->query($req6x);

                    if ($res6x ->num_rows > 0) {
                      while($row6x = $res6x ->fetch_assoc()){
                        $Qte_stock = $row6x['Qte_stock'];
                      }
                      $solde =  $punite * $Qte_stock;

                      $req6x1 ="UPDATE appro_stocks SET psunit = '$punite', pstotal ='$solde', facture ='$facture', indexa ='$index' WHERE societe='$societe' AND ref_article ='$ref_article'";
                      $res6x1 = $bd ->query($req6x1);

                      if ($res6x1 == true){
                        //echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement pris en charge".'</div>';
                        $req6x2 = "SELECT * FROM appro_invent WHERE societe='$societe' AND ref_article ='$ref_article'";
                        $res6x2 = $bd ->query($req6x2);

                        if ($res6x2 ->num_rows > 0) {
                          while ($row6x2 = $res6x2 ->fetch_assoc()) {
                            $qte_stock = $row6x2['qte_stock'];
                            $qte_vente = $row6x2['qte_vente'];
                            $qte_achat = $row6x2['qte_achat'];
                            $patotal   = $row6x2['patotal'];
                            $pstotal   = $row6x2['pstotal'];
                            $pvtotal   = $row6x2['pvtotal'];
                            $totstock  = $row6x2['totstock'];
                            $stock_fin = $row6x2['stock_fin'];
                          }
                          //Calcule
                          $QuantiteAcht = $qte_achat + $quantite;
                          $PA_total = $QuantiteAcht * $punite;
                          $Stock_fin = ($stock_fin + $quantite)-$qte_vente;
                          $Totstock = ($solde + $PA_total)-$pvtotal;

                          $req6x3 = "UPDATE appro_invent SET qte_achat ='$QuantiteAcht', pstotal ='$solde', patotal ='$PA_total', stock_fin ='$Stock_fin', totstock ='$Totstock' WHERE societe='$societe' AND ref_article ='$ref_article'";
                          $res6x3 = $bd ->query($req6x3);

                          if ($res6x3 == true && $res6x2 == true) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur" style="font-size:18px">'."Article avec success".'</div>';
                          }
                          else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge2".'</div>';
                          }
                        }
                      }
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Enregistrement non pris en charge1".'</div>';
                      }
                    }
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Stock non pris en charge.".'</div>'; 
                  }
                }
              }
              //Enregistrement Achat stock
            }
            else{
              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Aucun droit d'administration trouvé".'</div>';  
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
//Fin Enregistrement d'Achats de stock

//Enregistrement Client divers dans la table client_tb
function new_client_autre(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_validAutre'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("y-m-d");
        $d_ida=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_ida." ".$h_id;
        $conc_id=md5($dat);
        $code_ref=substr($conc_id,0 ,7);
        $deban = substr($d_ida,6 ,8);
        $deban2 = $deban + 1;
        $admin = $_SESSION['pseudo'];
        $nom_complet = $bd->real_escape_string($_POST['nom_complet']);
        $nature =  $bd->real_escape_string($_POST['nature']);
        $date_doc = $bd->real_escape_string($_POST['date_doc']);
        $devise = "USD";
        $params = 1;
        $status = 'Actif';
        $ref_doc = $code_ref.substr($admin,0 ,3);
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);

        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $societe = $row['societe'];
          }
          $req1 ="SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif
            $req3 = "SELECT * FROM appro_client_tb WHERE nom_complet ='$nom_complet' AND statut ='fin'";
            $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Situation financière de stock déjà en cloturée".'</div>'; 
              }
              else{// Insertion de la situation financiere
                if ($nature == "Cash") {
                  $requete = "SELECT * FROM appro_client_tb WHERE ref_doc ='$ref_doc'";
                  $resultat = $bd ->query($requete);

                  if ($resultat ->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                  }
                  else{
                    $req4 ="INSERT INTO appro_client_tb(societe,nom_complet, ref_doc, nature, date_crea, statut) 
                                    VALUES ('".$societe."','".$nom_complet."','".$ref_doc."','".$nature."','".$date_doc."','".$status."')";
                    $res4 = $bd ->query($req4);

                    if ($res4 == true){
                      //redirect_intent_or('main/dashboard.php');
                      echo '<div class="alert alert-warning alert-dismissible" id="erreur">'.'Veuillez le finaliser svp'.'&nbsp;&nbsp;'.'<a href="ajouter_article.php?ref_doc='.$ref_doc.'&&nature='.$nature.'&&date_doc='.$date_doc.'&&ghfhefg='.$nom_complet.'" style="color:white!important;font-weight:bold!important;font-size:19px">Cliquez ici pour ajouter les Articles</a>'.'<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.'</div>';

                      //header("location:ajouter_article.php?ref_doc=".$ref_doc."");
                    }
                    else{
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Echec d'Enregistrement de client".'</div>';
                    }
                  }
                }
                else{
                  if ($nature == "Credit") {
                    $requete = "SELECT * FROM appro_client_tb WHERE ref_doc = '$ref_doc' AND statut ='en cours'";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                      $req6 ="INSERT INTO appro_client_tb(societe,nom_complet,ref_doc,nature,date_crea,statut) 
                                        VALUES ('".$societe."','".$nom_complet."','".$ref_doc."','".$nature."','".$date_doc."','".$status."')";

                      $res6 = $bd ->query($req6);
                      if ($res6 == true) {
                        //header("location:ajouter_article.php?ref_doc='.$ref_doc.'");
                        echo '<div class="alert alert-warning alert-dismissible" id="erreur">'.'Veuillez le finaliser svp'.'&nbsp;&nbsp;'.'<a href="ajouter_article.php?ref_doc='.$ref_doc.'&&nature='.$nature.'&&date_doc='.$date_doc.'&&ghfhefg='.$nom_complet.'" style="color:white!important;font-weight:bold!important">Cliquez ici pour ajouter les Articles</a>'.'<span aria-hidden="true" data-dismiss="alert" aria-label="close">'.'&times;'.'</span>'.'</div>';
                      }
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit non effectué1".'</div>';  
                      }
                    }
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nature d'operation invalide".'</div>';
                  } 
                }
              }// Insertion de la situation financiere
            
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
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
//Fin Enregistrement Autre dans la table client_tb

//Appro Ajouter l'article dans la table artible_tb
function new_ajout(){ // debut creation participants
  if (isset($_SESSION['pseudo'])) {
    if (isset($_POST['cmd_article'])) {
      include("connexion.php");
      if ($bd -> connect_error) {
        die('Impossible de se connecter à la BD:'.$bd ->connect_error);
      }
      else{
        $d_id=date("y-m-d");
        $d_ida=date("d-m-y");
        $h_id=date("h:i:s");
        $dat=$d_ida." ".$h_id;
        $conc_id=md5($dat);
        $code_ref=substr($conc_id,0 ,5);
        $deban = substr($d_ida,6 ,8);
        $deban2 = $deban + 1;
        $admin = $_SESSION['pseudo'];
        $categorie = $bd->real_escape_string($_POST['categorie']);
        $article = $bd->real_escape_string($_POST['article']);
        $pvunite = $bd->real_escape_string($_POST['pvunite']);
        $quantite = $bd->real_escape_string($_POST['quantite']);
        $ref_doc = $bd->real_escape_string($_POST['ref_doc']);
        $unitev = $bd->real_escape_string($_POST['unite_vente']);
        $ref_art = $bd->real_escape_string($_POST['ref_article']);
        $nature = $bd->real_escape_string($_POST['nature']);
        $date_doc = $bd->real_escape_string($_POST['date_doc']);
        $noms = $bd->real_escape_string($_POST['noms']);
        $Pv_total = $pvunite * $quantite;
        $devise = "USD";
        $params = 1;
        $reference = $code_ref.substr($admin,0, 3);
        $taux = 2800;
        $statut ="en cours";
        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);
                      
        $requete = "SELECT * FROM admin_tb WHERE pseudo ='$admin' AND params ='$params'";
        $resultats = $bd ->query($requete);

        if ($resultats ->num_rows > 0) {// verification du compte administratif
          while($row = $resultats ->fetch_assoc()){
            $code_admin = $row['code_admin'];
            $codsoc = $row['code_soc'];
            $societe = $row['societe'];
          }
          $req1 = "SELECT * FROM d_admin_tb WHERE code_admin ='$code_admin' AND droit_finance ='$params' AND params ='$params'";
          $res1 = $bd ->query($req1);

          if ($res1 ->num_rows > 0) {// verification de droit administratif

              $req3 = "SELECT * FROM appro_article_tb WHERE ref_doc ='$ref_doc' AND statut ='fin'";
              $res3 = $bd ->query($req3);

              if ($res3 ->num_rows > 0) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Situation financière de stock déjà en cloturée".'</div>'; 
              }
              else{// Insertion de la situation financiere
                if ($nature == "Cash") {
                  $requete = "SELECT * FROM appro_article_tb WHERE ref_doc ='$reference' AND statut ='en cours'";
                  $resultat = $bd ->query($requete);

                  if ($resultat ->num_rows > 0) {
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                  }
                  else{
                      $req4 ="INSERT INTO appro_article_tb(code_soc, societe, date_facture, noms, ref_doc, ref_article, categorie, article, unite_vente, Qte, Pv_unite, Pv_total, devise, taux, nature, 
                                                              statut, date_doc, date_crea, customer, ip_user) 
                                                      VALUES ('".$codsoc."','".$societe."','".$date_doc."','".$noms."', '".$ref_doc."', '".$ref_art."','".$categorie."', '".$article."', '".$unitev."', '".$quantite."', 
                                                              '".$pvunite."','".$Pv_total."','".$devise."', '".$taux."', '".$nature."','".$statut."','".$date_doc."', '".$dat."', '".$admin."','".$ip_user."')";
                      $res4 = $bd ->query($req4);

                      if ($res4 == true){
                        $req4x1 = "SELECT * FROM appro_invent WHERE ref_article ='$ref_art' AND societe='$societe'";
                        $res4x1 = $bd ->query($req4x1);

                        if ($res4x1 ->num_rows > 0) {
                          while ($row = $res4x1 -> fetch_assoc()) {
                            $stock_fin = $row['stock_fin'];
                            $totstock  = $row['totstock'];
                            $qte_vente = $row['qte_vente'];
                            $pvtotal   = $row['pvtotal'];
                          }
                          //Calcul vente 
                          $Qvente = $qte_vente+$quantite;
                          $Pvente = $pvtotal+$Pv_total;
                          $Stock_fin = $stock_fin-$quantite;
                          $Totstock  = $totstock-$Pv_total;

                          $req4x2 = "UPDATE appro_invent SET qte_vente ='$Qvente', pvtotal ='$Pvente', stock_fin ='$Stock_fin', totstock ='$Totstock', date_edit ='$date_doc' WHERE ref_article ='$ref_art' AND societe='$societe'";
                          $res4x2 = $bd ->query($req4x2);
                          
                          if ($res4x2 == true && $res4 == true) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Ajout de l'article avec success".'</div>';
                            //save_input_data();
                          }
                          else {
                            //save_input_data();
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Echec Vente article".'</div>';
                          }
                        }
                      }
                      else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Article non prise en charge".'</div>';  
                      }
                  }
                }
                else{
                  if ($nature == "Credit") {
                    $requete = "SELECT * FROM appro_article_tb WHERE ref_doc ='$reference' AND statut ='en cours'";
                    $resultat = $bd ->query($requete);

                    if ($resultat ->num_rows > 0) {
                      echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Il y a eu conflit de Reference Document".'</div>'; 
                    }
                    else{
                        $req6 ="INSERT INTO appro_article_tb(code_soc, societe,date_facture, noms, ref_doc, ref_article, categorie, article, unite_vente, Qte, Pv_unite, Pv_total, devise, 
                                                              taux, nature, statut, date_doc, date_crea, customer, ip_user) 
                                                      VALUES ('".$codsoc."','".$societe."','".$date_doc."','".$noms."', '".$ref_doc."','".$ref_art."','".$categorie."','".$article."','".$unitev."', 
                                                                '".$quantite."', '".$pvunite."', '".$Pv_total."', '".$devise."', '".$taux."', '".$nature."', '".$statut."','".$date_doc."', '".$dat."', '".$admin."','".$ip_user."')";
                        $res6 = $bd ->query($req6);

                        if ($res6 == true) {
                          $req6x1 = "SELECT * FROM appro_invent WHERE ref_article ='$ref_art' AND societe='$societe'";
                          $res6x1 = $bd ->query($req6x1);

                          if ($res6x1 ->num_rows > 0) {
                            while ($row6 = $res6x1 -> fetch_assoc()) {
                              $stock_fin = $row6['stock_fin'];
                              $totstock  = $row6['totstock'];
                              $qte_vente = $row6['qte_vente'];
                              $pvtotal   = $row6['pvtotal'];
                            }
                            //Calcul vente 
                            $Qvente = $qte_vente+$quantite;
                            $Pvente = $pvtotal+$Pv_total;
                            $Stock_fin = $stock_fin-$quantite;
                            $Totstock  = $totstock-$Pv_total;


                            $req6x2 = "UPDATE appro_invent SET qte_vente ='$Qvente', pvtotal ='$Pvente', stock_fin ='$Stock_fin', totstock ='$Totstock', date_edit ='$date_doc' WHERE ref_article ='$ref_art' AND societe='$societe'";
                            $res6x2 = $bd ->query($req6x2);
                            
                            if ($res6x2 == true && $res6 == true) {
                              echo '<div class="alert alert-success alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit Ajout effectué".'</div>';
                            }
                            else {
                              echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Echec Vente article".'</div>';
                            }
                          }
                        }
                        else{
                          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Mouvement de credit non effectué1".'</div>';  
                        }
                    }
                  }
                  else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'."Nature d'operation invalide".'</div>';
                  } 
                }
              }// Insertion de la situation financiere
            
          }// verification de droit administratif
          else{
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert" id="erreur">'.'Aucun droit d\'administration trouvé'.'</div>'; 
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
//Fin Ajouter l'article dans la table article_tb



