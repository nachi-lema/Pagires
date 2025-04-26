  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
  ?>

    <div class="main-content">
      <section class="section">
        <div class="section-body">
          <?php new_frais_autre();new_frais_tiers();new_frais_perso() ?>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header dropdown">
                  <h4 class="">MAJ_Encodage_Transactions</h4>
                  <li><a href="encodage.php" class="btn btn-primary" style="background-color: #44597b"><i class="fa fa-spinner"></i>&nbsp;Actualiser </a></li>
                  <li>
                    <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #304c79">Caisses</a>
                    <ul class="dropdown-menu" style="box-shadow: 0px 0px 10px #000!important;border-radius: 10px;font-weight: bold">
                      <li><a href="javascript:void(0)" onclick="opnenpersonnel()">Personnel</a></li>
                      <li><a href="javascript:void(0)" onclick="opnentiers()">Tiers</a></li>
                      <li><a href="javascript:void(0)" onclick="opnenautres()">Lexique_comptes</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #304c79"><i class="fa fa-bank"></i> Banques</a>
                    <ul class="dropdown-menu" style="box-shadow: 0px 0px 10px #000!important;border-radius: 10px;font-weight: bold">
                      <li><a href="javascript:void(0)" onclick="opnenpersonnelBank()">Personnel</a></li>
                      <li><a href="javascript:void(0)" onclick="opnentiersBank()">Tiers</a></li>
                      <li><a href="javascript:void(0)" onclick="opnenautresBank()">Lexique_comptes</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #53698c">Liste des comptes</a>
                    <ul class="dropdown-menu" style="display: none;box-shadow: 0px 0px 10px #000!important;border-radius: 10px;font-weight: bold;width: 300px">
                      <li><a href="maj-encodage_pers.php">Comptes_Personnel</a></li>
                      <li><a href="maj-encodage_tiers.php">Comptes_Tiers</a></li>
                      <li><a href="maj-encodage_autre.php">Lexique_comptes</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #304c79"><i class="fa fa-print"></i>&nbsp;Imprimer</a>
                    <ul class="dropdown-menu" style="display:none;box-shadow: 0px 0px 10px #000!important;border-radius: 10px;font-weight: bold;padding:15px!important;">
                      <?php //link_reciPaie();  ?>
                    </ul>
                  </li>

                </div>
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="p-3">
                      <form method="GET" action="encodage.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                        <div class="input-group">
                          <input type="date" name="date_doc" placeholder="Filtrer par Date" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                          <div class="input-group-btn m-0 p-0">
                            <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                          </div>
                        </div>
                      </form>
                      <form method="GET" action="encodage.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                        <div class="input-group">
                          <input type="search" name="nom_eleve" placeholder="Filtrer par nom" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                          <div class="input-group-btn m-0 p-0">
                            <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                          </div>
                        </div>
                      </form>
                      <form method="GET" action="encodage.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                        <div class="input-group">
                          <input type="search" name="ref_doc" placeholder="Filtrer par Réference" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                          <div class="input-group-btn m-0 p-0">
                            <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--- Partie Affichage des Transaction élèves --->
        <div class="section-body">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <?php //cpteur_fin(); ?>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id='table-r'>
                      <thead>
                        <tr>
                          <th>N° </th>
                          <th>REF_DOC</th>
                          <th>DEBIT </th>
                          <th>CREDIT____ </th>
                          <th>NAT_OP</th>
                          <th>LIBELLE</th>
                          <th>MONTANT</th>
                          <th>DEVISE</th>
                          <th>TAUX</th>
                          <th>DATE_DOC</th>
                          <th>Statut</th>
                          <th>Controleur</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php listing_frais(); ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--- Partie Affichage des Transaction élèves --->
      </section>
    </div>
    </div>

    <?php require '../includes/_footer.php'; ?>

    <!-- Modal Recu de paiement tiers -->
    <div class="modal" id="form_tiers" tabindex="-1" role="dialog" aria-hidden="true" style="width: 40%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
      <div role="document">
        <div class="modal-content" style="background-color: #e7eaeb">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fas fa-comment-dollar"></i>&nbsp;Transaction_TIERS</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form action="" method="post">
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="nature_operation">Nature operation:</label>
                  <select name="nature_operation" class="form-control">
                    <option value="entree">Entrée</option>
                    <option value="sortie">Sortie</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_debit">Compte :</label>
                  <select name="compte_debit" class="form-control">
                    <?php liste_compteDebit(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <select id="taux" name="taux" class="form-control" required>
                    <?php liste_taux2(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_tier">Tiers:</label>
                  <select name="compte_t" class="form-control">
                    <?php liste_tierActif(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Montant</label>
                  <input type="text" class="form-control" name="montant_frais">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Doc</label>
                  <input type="date" name="date_doc" class="form-control">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <label>Libelle</label>
                  <input name="libelle_frais" type="text" class="form-control" placeholder="----------------------------------------------------------------------------------------------------------------------------------------------">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <select hidden id="annee_scolaire" name="annee_scolaire" class="form-control" required>
                    <?php liste_anscola2(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="submit" name="cmd_TPaieFrais" class="btn btn-primary mt-2 col-sm-6" tabindex="170" style="background-color: #304c79">Enregistrer</button>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="reset" class="btn btn-warning mt-2 col-sm-6" tabindex="200">Annuler</button>
                </fieldset>
              </div>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-danger" onclick="closetiers()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal de paiement tiers -->

    <!-- Modal Recu de paiement personnel -->
    <div class="modal" id="form_pers" tabindex="-1" role="dialog" aria-hidden="true" style="width: 40%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
      <div role="document">
        <div class="modal-content" style="background-color: #e7eaeb">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fas fa-comment-dollar"></i>&nbsp;Transaction_Personnel</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form action="" method="post" style="width: 700px">
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="nature_operation">Nature operation:</label>
                  <select name="nature_operation" class="form-control">
                    <option value="entree">Entrée</option>
                    <option value="sortie">Sortie</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_debit">Compte :</label>
                  <select name="compte_debit" class="form-control">
                    <?php liste_compteDebit(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <select id="taux" name="taux" class="form-control" required>
                    <?php liste_taux2(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_personnel">Personnel :</label>
                  <select name="compte_pers" class="form-control">
                    <?php liste_personnelActif(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Montant</label>
                  <input type="text" class="form-control" name="montant_frais">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Doc</label>
                  <input type="date" name="date_doc" class="form-control">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <label>Libelle</label>
                  <input name="libelle_frais" type="text" class="form-control" placeholder="----------------------------------------------------------------------------------------------------------------------------------------------">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <select hidden id="annee_scolaire" name="annee_scolaire" class="form-control" required>
                    <?php liste_anscola2(); ?>
                  </select>
                </fieldset>
              </div>
              <br>
              <div class="row w-100">
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="submit" name="cmd_PPaieFrais" class="btn btn-primary mt-2 col-sm-6" tabindex="170" style="background-color: #304c79">Enregistrer</button>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="reset" class="btn btn-danger mt-2 col-sm-6" tabindex="200" style="background-color: red">Annuler</button>
                </fieldset>
              </div>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="closepersonnel()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal Recu de paiement personnel -->

    <!-- Modal Recu de paiement autre -->
    <div class="modal" id="form_autre" tabindex="-1" role="dialog" aria-hidden="true" style="width: 40%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
      <div role="document">
        <div class="modal-content" style="background-color: #e7eaeb">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fas fa-comment-dollar"></i>&nbsp;Transaction_COMPTE</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form action="" method="post">
              <div class="row w-100">
                <fieldset class="col-lg-3 col-md-3 col-sm-12">
                  <label class="control-label" for="nature_operation">Nature operation:</label>
                  <select name="nature_operation" class="form-control">
                    <option value="entree">Entrée</option>
                    <option value="sortie">Sortie</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-3 col-md-3 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <select id="taux" name="taux" class="form-control" required>
                    <?php liste_taux2(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <label class="control-label" for="compte_debit">Compte:</label>
                  <select name="compte_debit" class="form-control">
                    <?php liste_compteDebit(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="classe_autre">Classe:</label>
                  <select id="groupe_classe" class="form-control">
                    <option value="">Rechercher par classe</option>
                    <?php liste_classe_autrecompte(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_autre">Descriptions:</label>
                  <select id="compte_autre" name="compte_autre" class="form-control">

                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Montant</label>
                  <input type="text" class="form-control" name="montant_frais">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Doc</label>
                  <input type="date" name="date_doc" class="form-control">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <label>Libelle</label>
                  <input name="libelle_frais" type="text" class="form-control" placeholder="----------------------------------------------------------------------------------------------------------------------------------------------">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <select hidden id="annee_scolaire" name="annee_scolaire" class="form-control" required>
                    <?php liste_anscola2(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="submit" name="cmd_AuPaieFrais" class="btn btn-primary mt-2 col-sm-6" tabindex="170" style="background-color: #304c79">Enregistrer</button>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="reset" class="btn btn-warning mt-2 col-sm-6" tabindex="200">Annuler</button>
                </fieldset>
              </div>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-danger" onclick="closeautres()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal de paiement Autre -->

    <!--- La partie banque ---->
    <!-- Modal Recu de paiement tiers -->
    <div class="modal" id="form_tiersBank" tabindex="-1" role="dialog" aria-hidden="true" style="width: 40%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
      <div role="document">
        <div class="modal-content" style="background-color: #e7eaeb">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fas fa-comment-dollar"></i>&nbsp;Transaction_TIERS</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form action="" method="post">
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="nature_operation">Nature operation:</label>
                  <select name="nature_operation" class="form-control">
                    <option value="entree">Entrée</option>
                    <option value="sortie">Sortie</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_debit">Compte :</label>
                  <select name="compte_debit" class="form-control">
                    <?php liste_compteDebitBank(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <select id="taux" name="taux" class="form-control" required>
                    <?php liste_taux2(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_tier">Tiers:</label>
                  <select name="compte_t" class="form-control">
                    <?php liste_tierActif(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Montant</label>
                  <input type="text" class="form-control" name="montant_frais">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Doc</label>
                  <input type="date" name="date_doc" class="form-control">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <label>Libelle</label>
                  <input name="libelle_frais" type="text" class="form-control" placeholder="----------------------------------------------------------------------------------------------------------------------------------------------">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <select hidden id="annee_scolaire" name="annee_scolaire" class="form-control" required>
                    <?php liste_anscola2(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="submit" name="cmd_TPaieFrais" class="btn btn-primary mt-2 col-sm-6" tabindex="170" style="background-color: #304c79">Enregistrer</button>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="reset" class="btn btn-warning mt-2 col-sm-6" tabindex="200">Annuler</button>
                </fieldset>
              </div>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-danger" onclick="closetiersBank()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal de paiement tiers -->

    <!-- Modal Recu de paiement personnel -->
    <div class="modal" id="form_persBank" tabindex="-1" role="dialog" aria-hidden="true" style="width: 40%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
      <div role="document">
        <div class="modal-content" style="background-color: #e7eaeb">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fas fa-comment-dollar"></i>&nbsp;Transaction_Personnel</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form action="" method="post" style="width: 700px">
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="nature_operation">Nature operation:</label>
                  <select name="nature_operation" class="form-control">
                    <option value="entree">Entrée</option>
                    <option value="sortie">Sortie</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_debit">Compte :</label>
                  <select name="compte_debit" class="form-control">
                    <?php liste_compteDebitBank(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <select id="taux" name="taux" class="form-control" required>
                    <?php liste_taux2(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_personnel">Personnel :</label>
                  <select name="compte_pers" class="form-control">
                    <?php liste_personnelActif(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Montant</label>
                  <input type="text" class="form-control" name="montant_frais">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Doc</label>
                  <input type="date" name="date_doc" class="form-control">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <label>Libelle</label>
                  <input name="libelle_frais" type="text" class="form-control" placeholder="----------------------------------------------------------------------------------------------------------------------------------------------">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <select hidden id="annee_scolaire" name="annee_scolaire" class="form-control" required>
                    <?php liste_anscola2(); ?>
                  </select>
                </fieldset>
              </div>
              <br>
              <div class="row w-100">
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="submit" name="cmd_PPaieFrais" class="btn btn-primary mt-2 col-sm-6" tabindex="170" style="background-color: #304c79">Enregistrer</button>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="reset" class="btn btn-danger mt-2 col-sm-6" tabindex="200" style="background-color: red">Annuler</button>
                </fieldset>
              </div>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="closepersonnelBank()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal Recu de paiement personnel -->

    <!-- Modal Recu de paiement autre -->
    <div class="modal" id="form_autreBank" tabindex="-1" role="dialog" aria-hidden="true" style="width: 40%;margin-left: 400px;height: auto!important;overflow:auto!important;margin-top: 30px;box-shadow: 0px 2px 8px 0px black">
      <div role="document">
        <div class="modal-content" style="background-color: #e7eaeb">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important"><i class="fas fa-comment-dollar"></i>&nbsp;Transaction_COMPTE</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form action="" method="post">
              <div class="row w-100">
                <fieldset class="col-lg-3 col-md-3 col-sm-12">
                  <label class="control-label" for="nature_operation">Nature operation:</label>
                  <select name="nature_operation" class="form-control">
                    <option value="entree">Entrée</option>
                    <option value="sortie">Sortie</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-3 col-md-3 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <select id="taux" name="taux" class="form-control" required>
                    <?php liste_taux2(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <label class="control-label" for="compte_debit">Compte:</label>
                  <select name="compte_debit" class="form-control">
                    <?php liste_compteDebitBank(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="classe_autre">Classe:</label>
                  <select id="groupe_classe1" class="form-control">
                    <option value="">Rechercher par classe</option>
                    <?php liste_classe_autrecompte(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-8 col-md-8 col-sm-12">
                  <label class="control-label" for="compte_autre">Descriptions:</label>
                  <select id="compte_autre1" name="compte_autre" class="form-control">

                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Montant</label>
                  <input type="text" class="form-control" name="montant_frais">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Doc</label>
                  <input type="date" name="date_doc" class="form-control">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <label>Libelle</label>
                  <input name="libelle_frais" type="text" class="form-control" placeholder="----------------------------------------------------------------------------------------------------------------------------------------------">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12">
                  <select hidden id="annee_scolaire" name="annee_scolaire" class="form-control" required>
                    <?php liste_anscola2(); ?>
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="submit" name="cmd_AuPaieFrais" class="btn btn-primary mt-2 col-sm-6" tabindex="170" style="background-color: #304c79">Enregistrer</button>
                </fieldset>
                <fieldset class="col-lg-6 col-md-6 col-sm-12">
                  <button type="reset" class="btn btn-warning mt-2 col-sm-6" tabindex="200">Annuler</button>
                </fieldset>
              </div>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-danger" onclick="closeautresBank()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!-- fin Modal de paiement Autre -->

    <!--- Fin de la partie banque ---->

    <script type="text/javascript">
      function opnenpersonnel() {
        document.getElementById('form_pers').style.display = "block";
      }

      function closepersonnel() {
        document.getElementById('form_pers').style.display = "none";
      }
    </script>
    <script type="text/javascript">
      function opnentiers() {
        document.getElementById('form_tiers').style.display = "block";
      }

      function closetiers() {
        document.getElementById('form_tiers').style.display = "none";
      }
    </script>
    <script type="text/javascript">
      function opnenautres() {
        document.getElementById('form_autre').style.display = "block";
      }

      function closeautres() {
        document.getElementById('form_autre').style.display = "none";
      }
    </script>
    <!------- Fin Modal de formulaire (caisse et banque) --------->
    <!------- Partie Banque Modal de formulaire (banque) --------->
    <script type="text/javascript">
      function opnenpersonnelBank() {
        document.getElementById('form_persBank').style.display = "block";
      }

      function closepersonnelBank() {
        document.getElementById('form_persBank').style.display = "none";
      }
    </script>
    <script type="text/javascript">
      function opnentiersBank() {
        document.getElementById('form_tiersBank').style.display = "block";
      }

      function closetiersBank() {
        document.getElementById('form_tiersBank').style.display = "none";
      }
    </script>
    <script type="text/javascript">
      function opnenautresBank() {
        document.getElementById('form_autreBank').style.display = "block";
      }

      function closeautresBank() {
        document.getElementById('form_autreBank').style.display = "none";
      }
    </script>


    <!------- Fin Modal de formulaire Guichet --------->

    <script type="text/javascript">
      function opnenValidePaie() {
        document.getElementById('form_validation').style.display = "block";
      }

      function closeValidePaie() {
        document.getElementById('form_validation').style.display = "none";
      }
    </script>
    <script type="text/javascript">
      function opnenCanceledPaie() {
        document.getElementById('form_annulation').style.display = "block";
      }

      function closeCanceledPaie() {
        document.getElementById('form_annulation').style.display = "none";
      }
    </script>
    <script type="text/javascript">
      function opnentransfertmonney() {
        document.getElementById('form_transfertmonney').style.display = "block";
      }

      function closetransfertmonney() {
        document.getElementById('form_transfertmonney').style.display = "none";
      }
    </script>


    <script type="text/javascript">
      function visibility(thingId) {
        var targetElement;
        targetElement = document.getElementById(thingId);
        if (targetElement.style.display == "none") {
          targetElement.style.display = "";
        } else {
          targetElement.style.display = "none";
        }
      }
    </script>
    <script>
      // Catégorie 
      $('#groupe_classe').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_autre.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#compte_autre').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#groupe_classe1').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_autre.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#compte_autre1').html(result);
          }
        })
      });
    </script>