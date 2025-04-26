<?php 
  require_once '../includes/Globals_function.php';
  include_once("../includes/_header.php") ;
?>

      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <?php new_ajout(); ?>
          </div>
          <!--- Partie Affichage des élèves --->
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <?php //compteur_Vente(); ?>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <!-- Modal Compte Appro vente -->
                      <div class="row w-100">
                        <div class=" row w-100 col-md-12 col-sm-12" style="border:1px solid #ccc">
                          <div class="modal-header col-sm-8 col-md-8" >
                            <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-user"></i>&nbsp;<?php affichage_client(); ?> </h5>
                          </div>
                          <div class="modal-header col-sm-4 col-md-4">
                            <h5 class="modal-title" id="exampleModalLabel"><i class=""></i>&nbsp;N° de Reference : <?php afficher_ref_doc(); ?></h5>
                          </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                          <div class="" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <form method="POST" autocomplete="off">
                                    <div class="row w-100">
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mt-2">
                                        <label class="control-label" for="groupe">Catégorie :</label>
                                        <select id="groupe1" name="categorie" class="form-control" required tabindex="100">
                                          <option>Selectionnez une categorie</option>
                                          <?php liste_comboclasse(); ?>
                                        </select>
                                      </fieldset>
                                      </fieldset>
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mt-2">
                                        <label class="control-label" for="nom_complet">Article : </label>
                                        <select name="article" id="article" class="form-control" required tabindex="130">
                                          
                                        </select>
                                      </fieldset>
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <label class="control-label" for="pvunite">Prix unitaire : </label>
                                        <select name="pvunite" id="pvunite" class="form-control" required tabindex="110">

                                        </select>
                                      </fieldset>
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                        <label class="control-label" for="quantite_vente">Qte vente : </label>
                                        <input type="number" class="form-control" name="quantite" required value="1">
                                      </fieldset>
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mt-2">
                                        <select hidden name="ref_doc" id="ref_doc" class="form-control" required tabindex="130">
                                          <?php voir_refdoc(); ?>
                                        </select>
                                      </fieldset>
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mt-2">
                                        <select hidden name="nature" id="nature" class="form-control" required tabindex="130">
                                          <?php voir_nature(); ?>
                                        </select>
                                      </fieldset>
                                      <fieldset class="col-lg-12 col-md-12 col-sm-12 p-2 mt-2">
                                        <select hidden name="date_doc" id="date_doc" class="form-control" tabindex="130">
                                          <?php voir_datedoc(); ?>
                                        </select>
                                      </fieldset>
                                    </div><br>
                                    <div class="row w-100">
                                      <fieldset class="col-lg-4 col-md-4 col-sm-12">
                                        <!---<label class="control-label" for="unite">Unite vente :</label>--->
                                        <select hidden name="unite_vente" id="unite_vente" class="form-control">
 
                                        </select>
                                      </fieldset>
                                      <fieldset class="col-lg-3 col-md-3 col-sm-12">
                                        <!--<label class="control-label" for="ref_article">Ref_Article :</label>-->
                                        <select hidden name="ref_article" id="ref_article" class="form-control" tabindex="110">
 
                                        </select>
                                        <select hidden name="noms" id="noms" class="form-control" tabindex="110">
                                          <?php voir_noms(); ?>
                                        </select>
                                      </fieldset>
                                    </div><br>
                                    <div class="row w-100">
                                      <div class="col-sm-6 col-md-6">
                                        <button type="submit" name="cmd_article" class="btn btn-success mt-2 col-sm-6" tabindex="190">Ajouter</button>
                                      </div>
                                      <div class="col-sm-6 col-md-6">
                                        <button type="reset" class="btn btn-danger mt-2 col-sm-6" tabindex="200">Annuler</button>
                                      </div>
                                    </div>
                                  </form>
                                </div>
                                <div class="modal-footer" style="border-top: 1px solid #ccc">
                                  <a href="facture_autre.php" class="btn btn-danger col-sm-3" data-bs-dismiss="modal" name="ferme">Ferme</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <table class="table table-striped table-hover" id='table-r' style="width: 100%;border:1px solid #000;">
                              <thead>
                                <tr>
                                  <th style="border: 1px solid #000;font-weight: bold;">DESIGNATION</th>
                                  <th style="border: 1px solid #000;font-weight: bold;">QTE</th>
                                  <th style="border: 1px solid #000;font-weight: bold;">PU</th>
                                  <th style="border: 1px solid #000;font-weight: bold;">PT</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php voir_vente(); ?> 
                              </tbody>
                            </table>
                            <?php botton_print(); ?>
                        </div>
                      </div>
                      <!-- Fin Modal Appro vente -->   
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

    <script type="text/javascript">
      function openrecustock() {
        document.getElementById('form_recu').style.display = "block";
      }

      function closerecustock() {
        document.getElementById('form_recu').style.display = "none";
      }
    </script>

    <script>      
      $(document).on('click', '.openFrais_stock', function(){
        $('#appro_vente-form').modal('show');
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
      $(document).on('click', '.openFrais_stockA', function(){
        $('#appro_vente-formA').modal('show');
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
      $(document).on('click', '.openFrais_stockP', function(){
        $('#appro_vente-formP').modal('show');
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
      $('#groupe1').on('change', function() {
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
      // Article
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
    <script>
      // Catégorie 
      $('#article').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_prix.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#pvunite').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#article').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_unite.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#unite_vente').html(result);
          }
        })
      });
    </script>
    <!----- Fin Script form Eleve ----->

    <!----- Script form Autre ----->
    <script>
      // Catégorie 
      $('#groupe3').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_stock.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#article2').html(result);
          }
        })
      });
    </script>
    <script>
      // Article
      $('#article2').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_article.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#ref_article2').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#article2').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_prix.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#pvunite2').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#article2').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_unite.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#unite_vente2').html(result);
          }
        })
      });
    </script>
    <!----- Fin Script form Autre ----->

    <!------ Script form perso ---->
    <script>
      // Catégorie 
      $('#groupe2').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_stock.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#article1').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#article1').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_article.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#ref_article1').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#article1').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/listing_prix.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#pvunite1').html(result);
          }
        })
      });
    </script>
    <script>
      // Catégorie 
      $('#Ventegroupe').on('change', function() {
        var groupe = this.value;
        $.ajax({
          url: '../auto_script/stock_classe.php',
          type: "POST",
          data: {
            cat_data: groupe
          },
          success: function(result) {
            $('#ventecompte').html(result);
          }
        })
      });
    </script>
