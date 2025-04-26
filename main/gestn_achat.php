<?php
  require_once '../includes/Globals_function.php';
  include_once("../includes/_header.php") ;
?>

      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <?php new_Achatstock();?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="">Gestion des Achats</h4>
                    <a href="gestn_achat.php" class="btn btn-primary" style="background-color: #44597b"><i class="fa fa-spinner"></i> Actualiser </a>
                    <a href="javascript:video" class="btn btn-info add_achat"><i class="fa fa-shopping-bag"></i> Ajouter Stock</a>
                    <!---<a href="javascript:video" class="btn btn-primary edit_staff" style="background-color: #44597b"><i class="fa fa-upload"></i> Modifier </a>--->
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="p-3">
                        <form method="GET" action="gestn_achat.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <select type="search" name="groupe" required placeholder="Filtrer par groupe" autocomplete="on" required class="form-control">
                              <option value="">Filtrer par groupe</option>
                              <?php liste_comboclasse(); ?>
                            </select>
                            <div class="input-group-btn m-0 p-0">
                              <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check" ></i></button> 
                            </div>
                          </div>   
                        </form>
                        <form method="GET" action="gestn_achat.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <input type="search" name="article" placeholder="Filtrer par Article" autocomplete="on" class="form-control"  tabindex="10" style="color: #575757;" onfocus="this.value=''" />
                            <div class="input-group-btn m-0 p-0">
                              <button type="submit" class="btn btn-warning m-0" tabindex="50"><i class="fa fa-check" ></i></button> 
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
          <!--- Partie Affichage des élèves --->
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <?php //compteur_Achatstock(); ?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Ref_article</th>
                            <th>Catégorie</th>
                            <th>Article</th>
                            <th>Unité_stock</th>
                            <th>Qte</th>
                            <th>Prix_unitaire</th>
                            <th>Prix_Total</th>
                            <th>Devise</th>
                            <th>Noms_Fournisseur</th>
                            <th>Téléphone_Fournisseur</th>
                            <th>Date_stock</th>
                            <th>Controleur</th>
                          </tr>
                        </thead>
                        <tbody><?php liste_achats(); ?></tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--- Fin Partie Affichage des élèves --->
        </section>
      </div>
    </div>

    <?php include('../includes/_footer.php'); ?>

    <!-- Modal Compte creation stock -->
    <div class="modal fade" id="achat-add-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border:1px solid #ccc">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-bag"></i>&nbsp;APPRO ACHATS</h5>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="categorie">Catégorie :</label>
                  <select id="groupe" name="categorie" class="form-control" required tabindex="100">
                    <option>Selectionnez une categorie</option>
                    <?php liste_comboclasse(); ?>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="article">Article :</label>
                  <select name="article" id="article" class="form-control" required tabindex="110">
                    
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="article">Ref_Article :</label>
                  <select name="ref_article" id="ref_article" class="form-control" required tabindex="110">
                    
                  </select>
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-3 col-md-3 col-sm-12 p-2 mt-2">
                  <label class="control-label" for="unite">Unite achat :</label>
                  <input type="text" class="form-control" name="unite" placeholder="Unite stock">
                </fieldset>
                <fieldset class="col-lg-3 col-md-3 col-sm-12 p-2 mt-2">
                  <label class="control-label" for="quantite">Qte_achat : </label>
                  <input type="number" class="form-control" name="quantite" required value="0" placeholder="Quantité de stock">
                </fieldset>
                <fieldset class="col-lg-3 col-md-3 col-sm-12 p-2 mt-2">
                  <label class="control-label" for="debit_cdf">Prix unitaire : </label>
                  <input type="number" class="form-control" name="punite" required value="0" placeholder="Prix de stock unitaire">
                </fieldset>
                <fieldset class="col-lg-3 col-md-3 col-sm-12 p-2 mt-2">
                  <label class="control-label" for="index">Index : </label>
                  <input type="number" class="form-control" name="index" required value="0" placeholder="Prix de stock unitaire">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="devise">Devise:</label>
                  <select name="devise" class="form-control" required tabindex="140">
                    <option value="USD">USD</option>
                    <option value="CDF">CDF</option>
                  </select>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label class="control-label" for="taux">Taux:</label>
                  <input type="text" class="form-control" name="taux" value="2800" required>
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Date-Facture</label>
                  <input type="date" name="date_fac" class="form-control" required tabindex="160">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12 p-2 mt-2">
                  <label class="control-label" for="nomsf">Noms fournisseur (euse) : </label>
                  <input type="text" class="form-control" name="nomsf" required placeholder="Noms fournisseur (euse)">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12 p-2 mt-2">
                  <label class="control-label" for="phonef">Télephone fournisseur (euse) : </label>
                  <input type="text" class="form-control" name="phonef" maxlength="9" required placeholder="+243">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12 p-2 mt-2">
                  <label>Email fournisseur (euse) :</label>
                  <input type="email" class="form-control" name="mail_fourn" required tabindex="170" placeholder="xxxx@contact.com">
                </fieldset>
              </div><br>
              <div class="row w-100">
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Avenue :</label>
                  <input type="text" name="avenue" class="form-control" placeholder="28A brikin" required tabindex="180">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Quartier :</label>
                  <input type="text" name="quartier" class="form-control" placeholder="Joli park" required tabindex="180">
                </fieldset>
                <fieldset class="col-lg-4 col-md-4 col-sm-12">
                  <label>Commune :</label>
                  <input type="text" name="adressef" class="form-control" placeholder="Ngaliema" required tabindex="180">
                  <input type="hidden" name="statut_achat" value="Actif">
                </fieldset>

              </div><br>
              <div class="row w-100">
                <div class="col-sm-2 col-md-2"></div>
                <div class="col-sm-5 col-md-5">
                  <button type="submit" name="cmd_Achat" class="btn btn-success mt-2 col-sm-5" tabindex="190">Enregistrer</button>
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
    <!-- Fin Modal Compte creation stock -->

    <!-- Modal UPDATE stock initial -->
    <div class="modal fade" id="staff-edit-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border:1px solid #ccc">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-bag"></i>&nbsp;Mise à Jour de Stock</h5>
          </div>
          <div class="modal-body">
            <form method="post">
              <?php //update_stock() ?>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="" class="btn btn-danger col-sm-3" data-bs-dismiss="modal" name="ferme">Ferme</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal UPDATE stock initial -->

    <script>
      $(document).on('click', '.add_achat', function(){
        $('#achat-add-form').modal('show');
      });
      (function($) {
       
        var table = $('#example5').DataTable({
          searching: false,
          paging:true,
          select: false,
          //info: false,
          lengthChange:false 
          
        });
        $('#example tbody').on('click', 'tr', function () {
          var data = table.row( this ).data();

        });

      })(jQuery);
    </script>
    <script>
      // Catégorie 
      $('#groupe').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_stock.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#article').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#article').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_article.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#ref_article').html(result);
          }
        })
      });
    </script>