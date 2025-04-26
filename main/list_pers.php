    <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>

  <div class="main-content">
    <section class="section">
      <div class="section-body">
        <?php new_pers();edit_personnel()//delete_personnel(); ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="">Gestion des Personnels</h4>
                <a href="list_pers.php" class="btn btn-primary" style="background-color: #44597b"><i class="spinner-border spinner-border-sm"></i> Actualiser</a>
                <!--<a href="javascript:void(0)" class="btn btn-primary add_agent" style="background-color: #304c79"><i class="fa fa-user-plus"></i> Ajouter</a>
                <a href="javascript:void(0)" onclick="opnenupdatePersonnel();" class="btn btn-primary" style="background-color: #304c79"><i class="fa fa-upload"></i> Mise à jour</a>--->
              </div>
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="p-3">
                    <form method="GET" action="list_pers.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                      <div class="input-group">
                        <input type="search" name="nom_personnel" required placeholder="Filtrer par Noms" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                        <div class="input-group-btn m-0 p-0">
                          <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                        </div>
                      </div>
                    </form>
                    <form method="GET" action="list_pers.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                      <div class="input-group">
                        <input type="search" name="fonction_pers" required placeholder="Filtrer par Fonction" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
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
      <!--- Partie Affichage des Personnel --->
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <?php cpteur_pers(); ?>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                    <thead>
                      <tr>
                        <th>Nom Complet</th>
                        <th>Compte </th>
                        <th>Fonction </th>
                        <th>Télephone</th>
                        <th>E-mail</th>
                        <th>Date début</th>
                        <th>Statut</th>
                        <th>Controleur</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php liste_perso(); ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--- Fin Partie Affichage des Personnel --->
    </section>
  </div>
</div>

<?php require '../includes/_footer.php'; ?>

<!-- Modal Compte Personnel -->
<div class="modal" id="form_CptPers" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height:550px!important;overflow:auto!important; margin-bottom: 10px!important;box-shadow: 0px 2px 8px 0px black">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i>&nbsp;Formulaire d'Inscription personnel</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin--
            <form method="post">
              <div class="row w-100 p-2">
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="nom_personnel">Noms complet:</label>
                  <input type="text" class="form-control" name="nom_personnel" placeholder="Nom, Postnom et Prenom">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="Fonction">Fonction:</label>
                  <input type="text" class="form-control" name="fonction_pers" placeholder="Fonction">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="date_debut">Date debut:</label>
                  <input type="date" class="form-control" name="date_debut" placeholder="Date debut">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="Téléphone">Téléphone:</label>
                  <input type="text" class="form-control" id="telephone" name="telephone_pers" maxlength="9"  placeholder="8105637000">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="email">Email </label>
                  <input type="email" class="form-control" name="email_pers"  placeholder="Entrer votre email">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="solde1_cdf">Solde cdf:</label>
                  <input type="number" class="form-control" id="solde1_cdf" name="solde1_cdf" value="0" placeholder="report solde cdf">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <label class="control-label" for="solde1_usd">Solde usd:</label>
                  <input type="number" class="form-control" id="solde1_usd" name="solde1_usd" value="0" placeholder="report solde usd">
                  <input type="hidden" name="statut_pers" value="Actif">
                </fieldset>
                <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2">
                  <button type="submit" name="cmd_pers" class="btn btn-primary mt-2 col-md-6 col-sm-6" tabindex="170" style="background-color: #304c79">Sauvegarder</button>
                </fieldset>
              </div>
            </form>
            <Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeComptPers()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!-- Modal Compte Personnel -->

<!-- Modal Création Compte Agent -->
<div class="modal fade" id="creat_agent-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content" style="background-color: #e7eaeb">
      <div class="modal-header" style="border:1px solid #ccc">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i>&nbsp;Formulaire d'Inscription personnel</h5>
      </div>
      <div class="modal-body">
        <form method="post">
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="departemnt">Departement :</label>
              <select name="departemnt" class="form-control" required tabindex="100">
                <option value="">Selectionnez un département</option>
                <option value="Administration scolaire">Administration Scolaire</option>
                <option value="Administration Centrale">Administration Centrale</option>
                <option value="Intendance Generale">Intendance Generale</option>
              </select>
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="service">Service :</label>
              <select name="service" class="form-control" required tabindex="100">
                <option value="">Selectionnez un service</option>
                <option value="Informatique">Informatique</option>
                <option value="Secretariat">Secretariat</option>
                <option value="Administration">Administration</option>
                <option value="Comptabilite">Comptabilite</option>
                <option value="Direction scolaire">Direction scolaire</option>
                <option value="Enseignement">Enseignement</option>
                <option value="Intendance">Intendance</option>
                <option value="Protocole et charroie">Protocole et charroie</option>
                <option value="Hygiene scolaire et Sante">Hygiene scolaire et Sante</option>
                <option value="Securite">Securite</option>
              </select>
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="fonction">Fonction :</label>
              <select name="fonction_pers" id="fonction" class="form-control" required tabindex="100">
                <option value="">Selectionnez une Fonction</option>
                <option value="Manager Informatique">Manager Informatique</option>
                <option value="Secrétaire">Secrétaire</option>
                <option value="Administrateur">Administrateur</option>
                <option value="Comptable">Comptable</option>
                <option value="Caissière">Caissière</option>
                <option value="Préfet des études">Préfet des études</option>
                <option value="Directeur des études">Directeur des études</option>
                <option value="Directrice d'école primaire">Directrice d'école primaire</option>
                <option value="Directeur adjoint EP">Directeur adjoint EP</option>
                <option value="Surnuméraire">Surnuméraire</option>
                <option value="Directrice d'école maternelle">Directrice d'école maternelle</option>
                <option value="Directrice Adjointe EM">Directrice Adjointe EM</option>
                <option value="Institutrice">Institutrice</option>
                <option value="Enseignant">Enseignant</option>
                <option value="Directrice des études">Directrice des études</option>
                <option value="Instituteur">Instituteur</option>
                <option value="Ménagère">Ménagère</option>
                <option value="Cantinière">Cantinière</option>
                <option value="Maintenancier">Maintenancier</option>
                <option value="Chargé d'entretien">Chargé d'entretien</option>
                <option value="Chauffeur">Chauffeur</option>
                <option value="Infirmière">Infirmière</option>
                <option value="Cantinière">Cantinière</option>
                <option value="Agent de sécurité">Agent de sécurité</option>
                <option value="Ménager">Ménager</option>
              </select>
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-6 col-md-6 col-sm-12">
              <label class="control-label" for="nom_personnel">Nom complet : </label>
              <input type="text" class="form-control" name="nom_personnel" required="required" placeholder="Nom complet...">
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12">
              <label class="control-label" for="etat_civil">Etat Civil :</label>
              <select class="form-control" name="etat_civil">
                <option>Sélectionnez l'Etat civil</option>
                <option value="Celibataire">Célibataire</option>
                <option value="Divorce">Divorcé</option>
                <option value="Marie">Marié</option>
                <option value="Veuf">Veuf</option>
              </select>
            </fieldset>
            <fieldset class="col-lg-3 col-md-3 col-sm-12">
              <label class="control-label" for="sexe">Genre :</label>
              <select class="form-control" name="sexe">
                <option>Sélectionnez le sexe</option>
                <option value="Féminin">Féminin</option>
                <option value="Mascule">Mascule</option>
              </select>
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="telephone">Téléphone :</label>
              <input type="text" class="form-control" name="telephone_pers" maxlength="9" placeholder="Téléphone...">
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="mail">Adresse-Email :</label>
              <input type="email" class="form-control" name="email_pers" required placeholder="Adresse-Email...">
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12">
              <label class="control-label" for="date_debut">Date Début :</label>
              <input type="date" name="date_debut" class="form-control" required tabindex="160" placeholder="05-12-2022">
            </fieldset>
          </div><br>
          <div class="row w-100">
            <fieldset class="col-lg-4 col-md-4 col-sm-12 p-2">
              <label class="control-label" for="solde1_cdf">Solde cdf :</label>
              <input type="number" class="form-control" id="solde1_cdf" name="solde1_cdf" value="0" placeholder="report solde cdf">
            </fieldset>
            <fieldset class="col-lg-4 col-md-4 col-sm-12 p-2">
              <label class="control-label" for="solde1_usd">Solde usd :</label>
              <input type="number" class="form-control" id="solde1_usd" name="solde1_usd" value="0" placeholder="report solde usd">
              <input type="hidden" name="statut_pers" value="Actif">
            </fieldset>
          </div><br>
          <div class="row w-100">
            <div class="col-sm-2 col-md-2"></div>
            <div class="col-sm-6 col-md-6">
              <button type="submit" name="cmd_pers" class="btn btn-primary mt-2 col-sm-6" tabindex="190" style="background-color: #44597b;">Enregistrer</button>
            </div>
            <div class="col-sm-4 col-md-4">
              <button type="reset" class="btn btn-danger mt-2 col-sm-4" tabindex="200">Annuler</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="" class="btn btn-danger col-sm-3" data-bs-dismiss="modal" name="ferme">Ferme</a>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal Création Agent -->

<!-- Modal DELETE Personnel -->
<div class="modal" id="form_supPersonnel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 1px solid #ccc">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post">
          <h5 class="modal-title">Voulez-vous supprimer cet Personne?</h5>
          <button type="submit" name="cmd_delPersonnel" class="btn btn-primary col-md-3 col-sm-3" style="background-color: #304c79">OUI</button>&nbsp;<button type="button" class="btn btn-danger col-md-3 col-sm-3" onclick="closeSupPersonnel()" style="background-color: red">NON</button>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer" style="border-top: 1px solid #ccc">
        <a href="javascript:void(0)" class="btn btn-primary" onclick="closeSupPersonnel()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal UPDATE Personnel -->

<!-- Modal UPDATE Personnel -->
<div class="modal" id="form_updatePersonnel" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="height:550px!important;overflow:auto!important; margin-bottom: 10px!important;">
      <div class="modal-header">
        <div class="title-box">
          <h5 class="modal-title" id="exampleModalLabel">Mise à Jour Personnel</h5>
        </div>
      </div>
      <div class="modal-body">
        <div class="inner-box">
          <div class="content-box">

          </div>
        </div>
        <!--Formulaires des acces admin-->
        <form method="post">
          <?php update_pers() ?>
        </form>
        <!--Formulaires des acces admin-->
      </div>
      <div class="modal-footer">
        <a href="javascript:void(0)" class="btn btn-danger" onclick="closeupdatePersonnel()">Quitter</a>
      </div>
    </div>
  </div>
</div>
<!--Fin Modal UPDATE Personnel -->

<script type="text/javascript">
  function openComptPers() {
    document.getElementById('form_CptPers').style.display = "block";
  }

  function closeComptPers() {
    document.getElementById('form_CptPers').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenSupPersonnel() {
    document.getElementById('form_supPersonnel').style.display = "block";
  }

  function closeSupPersonnel() {
    document.getElementById('form_supPersonnel').style.display = "none";
  }
</script>
<script type="text/javascript">
  function opnenupdatePersonnel() {
    document.getElementById('form_updatePersonnel').style.display = "block";
  }

  function closeupdatePersonnel() {
    document.getElementById('form_updatePersonnel').style.display = "none";
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
  $(document).on('click', '.add_agent', function() {
    $('#creat_agent-form').modal('show');
  });
  (function($) {

    var table = $('#example5').DataTable({
      searching: false,
      paging: true,
      select: false,
      //info: false,         
      lengthChange: false

    });
    $('#example tbody').on('click', 'tr', function() {
      var data = table.row(this).data();

    });

  })(jQuery);
</script>
<script>
  // Catégorie 
  $('#ArchivgroupeG').on('change', function() {
    var groupe = this.value;
    $.ajax({
      url: 'auto_script/listing_classeArchiv.php',
      type: "POST",
      data: {
        cat_data: groupe
      },
      success: function(result) {
        $('#Archivcompte_eleveG').html(result);
      }
    })
  });
</script>