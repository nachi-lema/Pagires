<?php
  require_once '../includes/Globals_function.php';
  include_once("../includes/_header.php") ;
?>

      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <?php new_stock();edit_stock();delete_stock();?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="">Creation Stock Initial</h4>
                    <a href="creat_stock.php" class="btn btn-primary" style="background-color: #44597b"><i class="fa fa-spinner"></i> Actualiser </a>
                    <a href="javascript:video" class="btn btn-info add_staff"><i class="fa fa-shopping-bag"></i> Ajouter nouveau article </a>
                    <a href="javascript:video" class="btn btn-warning edit_staff"><i class="fa fa-upload"></i> Modifier un article</a>
                    <a href="javascript:void(0)" onclick="opnenSupArticle()" class="btn btn-danger"><i class="fa fa-trash"></i> Supprimer un article </a>
                  </div>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="p-3">
                        <form method="GET" action="creat_stock.php" class="form_filter col-lg-3 col-md-3 col-sm-12">
                          <div class="input-group">
                            <select type="search" name="categorie" required placeholder="Filtrer par groupe" autocomplete="on" required class="form-control">
                              <option value="">Filtrer par groupe</option>
                              <?php liste_comboclasse(); ?>
                            </select>
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
                    <?php compteur_stock(); ?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                        <thead>
                          <tr>
                            <th>Id</th>
                            <th>Ref_article</th>
                            <th>Catégorie</th>
                            <th>Description</th>
                            <th>Article</th>
                            <th>Numéro</th>
                            <th>Unité_stock</th>
                            <th>Qte_stock</th>
                            <th>Prix_unitaire</th>
                            <th>Prix_Total</th>
                            <th>Devise</th>
                            <th>Date_stock</th>
                            <th>Controleur</th>
                          </tr>
                        </thead>
                        <tbody><?php liste_stocks(); ?></tbody>
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
    <div class="modal fade" id="staff-add-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border:1px solid #ccc">
            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-shopping-bag"></i>&nbsp;CRÉATION DU STOCK INITIAL</h5>
          </div>
          <div class="modal-body">
            <form method="post">
              <div class="row">
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="reference" class="col-form-label">Reference :</label>
                    <input type="text" class="form-control" name="reference" placeholder="Reference...">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="categorie_stock" class="col-form-label">Categorie :</label>
                    <select id="groupe" name="categorie_stock" class="form-control" required tabindex="100">
                      <option>Selectionnez une categorie</option>
                      <?php liste_comboclasse(); ?>
                    </select>
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="description" class="col-form-label">Description :</label>
                    <input type="text" class="form-control" name="description" placeholder="Description...">
                  </div>
                </div>
                <div class="col-xl-4">
                  <div class="form-group">
                    <label for="article" class="col-form-label">Article :</label>
                    <input type="text" class="form-control" name="article" placeholder="Article...">
                  </div>
                </div>
                <div class="col-xl-2">
                  <div class="form-group">
                    <label for="conf" class="col-form-label">Confection :</label>
                    <input type="text" class="form-control" name="conf" placeholder="...">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="numero" class="col-form-label">Numéro :</label>
                    <input type="text" class="form-control" name="numero" placeholder="N°...">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="unite" class="col-form-label">Unite stock:</label>
                    <input type="text" class="form-control" name="unite" placeholder="Unite stock">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="quantite" class="col-form-label">Qte_stock :</label>
                    <input type="number" class="form-control" name="quantite" value="0" required placeholder="Quantité de stock">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="punite" class="col-form-label">Prix unitaire :</label>
                    <input type="text" class="form-control" name="punite" value="0" required placeholder="Prix de stock unitaire">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="index" class="col-form-label">Index :</label>
                    <input type="text" class="form-control" name="index" value="0" required placeholder="">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="devise" class="col-form-label">Devise :</label>
                    <select name="devise" class="form-control">
                      <option value="USD">USD</option>
                    </select>
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="taux" class="col-form-label">Taux :</label>
                    <input type="number" class="form-control" name="taux" value="2800">
                  </div>
                </div>
                <div class="col-xl-3">
                  <div class="form-group">
                    <label for="date_stock" class="col-form-label">Date_stock :</label>
                    <input type="date" class="form-control" name="date_stock"  placeholder="Date stock">
                    <input type="hidden" name="statut_appro" value="Actif">
                  </div>
                </div>
              </div>
              <a type="submit" class="col-sm-4"></a>
              <button type="submit" class="btn btn-primary col-sm-4" name="cmd_stock">Sauvegarder</button>
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
              <?php update_stock() ?>
            </form>
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
          <a href="" class="btn btn-danger col-sm-3" data-bs-dismiss="modal" name="ferme">Ferme</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin Modal UPDATE stock initial -->


    <!-- Modal DELETE Stock initial -->
    <div class="modal" id="form_supArticle" tabindex="-1" role="dialog" aria-hidden="true">
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
              <h5 class="modal-title">Voulez-vous supprimer cet Article?</h5>
              <button type="submit" name="cmd_delArticle" class="btn btn-primary col-sm-3">OUI</button>&nbsp;<button type="button" class="btn btn-danger col-sm-3" onclick="closeSupArticle()">NON</button>
            </form>
            <!--Formulaires des acces admin-->
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="closeSupArticle()">Quitter</a>
          </div>
        </div>
      </div>
    </div>
    <!--Fin Modal UPDATE Stock initial -->  

    <script>
      $(document).on('click', '.add_staff', function(){
        $('#staff-add-form').modal('show');
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
      $(document).on('click', '.edit_staff', function(){
        $('#staff-edit-form').modal('show');
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
    <script type="text/javascript">
      function opnenSupArticle() {
        document.getElementById('form_supArticle').style.display = "block";
      }

      function closeSupArticle() {
        document.getElementById('form_supArticle').style.display = "none";
      }
    </script>
 