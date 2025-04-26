    <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
    include_once("../includes/_header.php") ;
    include("../includes/modal.php");
  ?>

  		<div class="main-content">
  			<section class="section">
  				<div class="section-body">
            <?php new_user();delete_admin();new_droit();edit_admin(); ?>
  					<div class="row">
  						<div class="col-12">
  							<div class="card">
  								<div class="card-header">
  									<h5><span ecole><?php affiche_profil1(); ?></span> | Utilisateur </h5>
  								</div>
  								<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <div class="p-3">
    										<form action="" method="post" id="f-pass" class="row clearfix">
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label><i class="fa fa-user"></i>&nbsp;Pseudo :</label>
      											<input class="form-control" type="text" name="pseudo" placeholder="Par exemple: Nachi">
      											<em class="text-danger" name='pass'></em>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label><i class="fa fa-lock"></i>&nbsp;Mot de passe :</label>
      											<input class="form-control" type="text" name="mot_passe" placeholder="Nouveau mot de passe">
      											<em class="text-danger" name='new'></em>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-12">
                            <label><i class="fa fa-envelope"></i>&nbsp;E-mail :</label>
      											<input class="form-control" type="email" name="ad_mail" placeholder="Par exemple: dido@gmail.com">
      											<em class="text-danger" name='cnew'></em>
                          </div>
    											<p><em msg2></em></p>
    											<div class="col-lg-3 col-md-3 col-sm-12 mt-4 p-2">
    												<button type="submit" name="cmd_User" class="btn btn-primary col-sm-3 text-white" style="background-color: #304c79"><i class="fa fa-plus"></i> Ajouter</button>
    											</div>
    										</form>
                      </div>
                    </div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>
          <!--- Partie Affichage des utilisateurs --->
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <?php compteur_user(); ?>
                    <a href="user_societe.php" class="btn btn-primary" style="background-color: #304c79"><i class="fa fa-spinner"></i> Actualiser</a>
                    <a href="javascript:void(0)" onclick="opnenaccesAdmin();" class="btn btn-primary" style="background-color: #304c79">Accès admin.</a>
                    <a href="javascript:void(0)"  onclick="opnenupdateAdmin()" class="btn btn-primary" style="background-color: #304c79"><i class="fa fa-upload"></i> Mise à jour</a>
                    <a href="javascript:void(0)" onclick="opnenSupAdmin();" class="btn btn-primary" style="background-color: red"><i class="fa fa-trash"></i> Supprimer</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id='table-r' style="width:100%;">
                        <thead>
                          <tr>
                            <th>Code_Societe</th>
                            <th>Noms</th>
                            <th>Adresse e-mail</th>
                            <th>Telephone</th>
                            <th>Date</th>
                            <th>Controleur</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php liste_user2(); ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
  		</div>
  	</div>

    <!-- Modal Droits d'acces admin -->
    <div class="modal" id="form_acces" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
                <h5 class="modal-title" id="exampleModalLabel">Droits d'accès</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box"></div> 
            </div>
            <!--Formulaires des acces admin-->
            <form method="post">
              <ul class="list-form-acces">
                <li>
                  <a href="javascript:void(0)" onclick="javascript:visibility('drop_accuser')"><i class="fa fa-user"></i>&nbsp; Gestion des utilisateurs&nbsp;<i class="bi bi-arrow-up-short"></i></a>
                  <div id="drop_accuser" style="display:none">
                    <label for="oui1"><input type="radio" name="droit_user" id="oui1" required value="1" tabindex="150">&nbsp;Oui</label>
                    <label for="non1"><input type="radio" name="droit_user" id="non1" required value="0" tabindex="160">&nbsp;Non</label>
                  </div>
                </li>
                <li>
                  <a href="javascript:void(0)" onclick="javascript:visibility('drop_elev')"><i class="fa fa-users"></i>&nbsp; Gestion Personnel&nbsp;<i class="bi bi-arrow-up-short"></i></a>
                  <div id="drop_elev" style="display:none">
                    <label for="oui2"><input type="radio" name="droit_elev" id="oui2" required value="1" tabindex="170">&nbsp;Oui</label>
                    <label for="non2"><input type="radio" name="droit_elev" id="non2" required value="0" tabindex="180">&nbsp;Non</label>
                  </div>
                </li>
                <li>
                  <a href="javascript:void(0)" onclick="javascript:visibility('drop_finance')"><i class="fas fa-money-bill"></i>&nbsp; Gestion financière&nbsp;<i class="bi bi-arrow-up-short"></i></a>
                  <div id="drop_finance" style="display:none">
                    <label for="oui3"><input type="radio" name="droit_fin" id="oui3" required value="1" tabindex="170">&nbsp;Oui</label>
                    <label for="non3"><input type="radio" name="droit_fin" id="non3" required value="0" tabindex="180">&nbsp;Non</label>
                  </div>
                </li>
                <br>
                <button type="submit" name="cmd_droitAcces" class="btn btn-warning col-md-6" tabindex="190" style="background-color: #304c79">Sauvegarder</button>
              </ul>
            </form>
            <!--Formulaires des acces admin-->
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
              <a href="javascript:void(0)" class="btn btn-primary" onclick="closeaccesAdmin()" style="background-color: #304c79">Quitter</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal UPDATE Admin -->
    <div class="modal" id="form_updateUser" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header" style="border-bottom: 1px solid #ccc">
            <div class="title-box">
                <h5 class="modal-title" id="exampleModalLabel">Mise en jour Utilisateur</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
                <div class="content-box">

                </div>
            </div>
            <!--Formulaires des acces admin-->
            <form method="post">
               <?php update_admin(); ?> 
            </form>
            <!--Formulaires des acces admin-->
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
              <a href="javascript:void(0)" class="btn btn-primary" onclick="closeupdateAdmin()" style="background-color: #304c79">Quitter</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal DELETE Admin -->
    <div class="modal" id="form_supAdmin" tabindex="-1" role="dialog" aria-hidden="true">
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
              <h5 class="modal-title">Voulez-vous supprimer cet utilisateur?</h5>
              <button type="submit" name="cmd_delAdmin" class="btn btn-primary col-lg-4 col-md-4" style="background-color: #304c79">OUI</button>&nbsp;<button type="button" class="btn btn-danger col-lg-4 col-md-4" onclick="closeSupAdmin()" style="background-color: red">NON</button>
            </form>
            <!--Formulaires des acces admin-->
          </div>
          <div class="modal-footer" style="border-top: 1px solid #ccc">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="closeSupAdmin()" style="background-color: #304c79">Quitter</a>
          </div>
        </div>
      </div>
    </div>

  	<?php include('../includes/_footer.php'); ?>


    <script type="text/javascript">
      function opnenupdateAdmin() {
         document.getElementById('form_updateUser').style.display = "block";
      }

      function closeupdateAdmin() {
        document.getElementById('form_updateUser').style.display = "none";
      }
    </script>