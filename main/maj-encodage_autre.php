  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>

<div class="main-content">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header dropdown">
              <h4 class="">MAJ_Encodage_Transactions -AUTRES</h4>
              <li><a href="maj-encodage_autre.php" class="btn btn-primary" style="background-color: #44597b"><i class="fa fa-spinner"></i> Actualiser</a></li>
              <li>
                <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #304c79"><i class="fa fa-print"></i> Imprimer</a>
                <ul class="dropdown-menu" style="display:none;box-shadow: 0px 0px 10px #000!important;border-radius: 10px;font-weight: bold;padding:15px!important;">
                  <?php link_reciPaie_autre(); ?>
                </ul>
              </li>
              <li>
                <a href="" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background-color: #53698c">Liste des comptes</a>
                <ul class="dropdown-menu" style="display: none;box-shadow: 0px 0px 10px #000!important;border-radius: 10px;font-weight: bold;width: 300px">
                  <li><a href="maj-encodage_pers.php">Listing_Comptes_Personnel</a></li>
                  <li><a href="maj-encodage_tiers.php">Listing_Comptes_Tiers</a></li>
                  <li><a href="maj-encodage_autre.php">Listing_Comptes_Autres</a></li>
                </ul>
              </li>

              <li><a href="encodage.php" class="btn btn-primary" style="background-color: #44597b"><i class="fa fa-arrow-left"></i>&nbsp;Retourne</a></li>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="p-3">
                  <form method="GET" action="maj-encodage_autre.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                    <div class="input-group">
                      <input type="date" name="date_doc" placeholder="Filtrer par Date" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                      <div class="input-group-btn m-0 p-0">
                        <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                      </div>
                    </div>
                  </form>
                  <form method="GET" action="maj-encodage_autre.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                    <div class="input-group">
                      <input type="search" name="nom_autre" placeholder="Filtrer par nom" autocomplete="on" required class="form-control" tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                      <div class="input-group-btn m-0 p-0">
                        <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check"></i></button>
                      </div>
                    </div>
                  </form>
                  <form method="GET" action="maj-encodage_autre.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
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
              <?php cptfin_autre(); ?>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id='table-r'>
                  <thead>
                    <tr>
                      <th>N° </th>
                      <th>REF_DOC</th>
                      <th>DEBIT </th>
                      <th>CREDIT_______ </th>
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
                    <?php liste_paeifrais_autre(); ?>
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