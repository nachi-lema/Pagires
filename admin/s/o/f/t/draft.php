    function admin_session(){
            if(isset($_POST["cmd_nouv_user"])){
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
                        $code=sha1($dat);
                        $code_user=substr($code,0 ,8);
                        $nom = $bd->real_escape_string($_POST['new_pseudo']);
                        $mot_pass = $bd->real_escape_string(sha1($_POST['nouv_user_mop']));
                        $conf_pass= $bd->real_escape_string(sha1($_POST['nouv_user_confmop']));
                        $code_admin = $bd->real_escape_string($_POST['code_admin']);
                        $avatar="assets/images/avatar/maquette/user.png";
                        $affectation="non";
                        $statut = $bd->real_escape_string($_POST['status']);
                        $privilege = 1;
                        $params = 1;
                        $droit = 0;                                   
                        $ip_user=$bd->real_escape_string($_SERVER['REMOTE_ADDR']);

                        if (!filter_var($ad_mail, FILTER_VALIDATE_EMAIL)) {
                                            echo'<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Le format e-mail non autorisé!".'</div>'; 
                                        }
                        else{

                                if ($mot_pass != $conf_pass ) {
                                                //echo "Les deux mots de passe ne correspondent pas!";
                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'."Incoherence des mots de passe.".'</div>';
                                            }
                                            else{//verification du mot de passe
                                                $requete = "SELECT * FROM  code_admintb WHERE code_admin='$code_admin' AND params='0'";
                                                $resultats = $bd ->query($requete);

                                                    if ($resultats ->num_rows > 0) {
                                                                while($row = $resultats ->fetch_assoc()){
                                                                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Code admin invalide.'.
                                                                            '</div>'; 
                                                                }
                                                    }
                                                        else{// code admin

                                                                    $requete = "SELECT * FROM  user_tb WHERE nom_complet='$nom' AND params='".$params."'";
                                                                    $resultats = $bd ->query($requete);

                                                                        if ($resultats ->num_rows > 0) {
                                                                            while($row = $resultats ->fetch_assoc()){
                                                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Cet administrateur existe déjà.'.'</div>'; 
                                                                            }
                                                                    }
                                                                    else{//verification nom user

                                                                            $requete = "SELECT * FROM  user_tb WHERE statut='$statut' AND params='".$params."'";
                                                                            $resultats = $bd ->query($requete);

                                                                                if ($resultats ->num_rows > 0) {
                                                                                    while($row = $resultats ->fetch_assoc()){
                                                                                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.
                                                                                            'Le master administrateur existe déjà.'.'</div>'; 
                                                                                    }
                                                                                }
                                                                            else{// verification master

                                                                                $sql="INSERT INTO user_tb(code_user, nom_complet, photo, ad_mail, mot_pass, question_ref, reponse_ref, params, droit, affectation, statut, date_crea, ip_user) VALUES ('".$code_user."', '".$nom."', '".$avatar."','".$ad_mail."', '".$mot_pass."', '".$phrase_ref."', '".$rep_ref."', '".$params."', '".$droit."', '".$affectation."','".$statut."', '".$dat."','".$ip_user."')";
                                                                                $sav = $bd->query($sql);

                                                                            if ($sav == true) {
                                                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="mess">'.'Nouveau administrateur créé.'.'</div>';
                                                                            }
                                                                           else{
                                                                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert" id="erreur">'.'Creation Admin echouée.'.
                                                                                    '</div>'; 
                                                                                }


                                                                                 }// verification master

                                                                           
                                                                    }//verification nom user

                                                            }// code admin


                                            }//verification du mot de passe            
                        }
                    }
                    $bd->close();

                        
                }
            
        }