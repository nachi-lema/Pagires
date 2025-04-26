<?php 
    if (session_status() == PHP_SESSION_NONE) {
    	session_start();
  	}
    include_once("admin/s/o/f/t/fonctions.php");
    login_user();
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
		<meta charset="UTF-8">
		<title>Gestion de paie || PAYROLL | Connexion</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Precision, permet d’apporter des solutions idoines. Sécurité, rapidité, facilité, Precision est une solution informatique qui répondra correctement aux besoins des étudiants et élèves." />
		<meta name="keywords" content="Bellevue" />
		<meta name="author" content="Bellevue" />

		<link rel='shortcut icon' type='image/x-icon' href="assets/img/favicon.ico" />
		<link rel="stylesheet" href="first/css/animate.css">
		<link rel="stylesheet" href="first/css/icomoon.css">
		<link rel="stylesheet" href="first/css/bootstrap.css">
		<link rel="stylesheet" href="first/css/magnific-popup.css">
		<link rel="stylesheet" href="first/css/owl.carousel.min.css">
		<link rel="stylesheet" href="first/css/owl.theme.default.min.css">
		<link rel="stylesheet" href="first/css/flexslider.css">
		<link rel="stylesheet" href="first/css/pricing.css">
		<link rel="stylesheet" href="first/css/style.css">
		<script src="first/js/modernizr-2.6.2.min.js"></script>

		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/app.min.css">

		<link rel="stylesheet" href="foot/css/bootstrap.min.css">
		<link rel="stylesheet" href="foot/css/animate.css">
		<link rel="stylesheet" href="foot/css/style.css">

	</head>
	<body>
		<div class="fh5co-loader"> </div>
		<div id="page">
			<nav class="fh5co-nav" role="navigation">
			  <div class="top-menu">
          
			  </div>
			</nav>
			<div class="container mb-5">
				<div class="row" style="margin-top: 100px;">
          <div class="col-md-6 col-lg-7">
            <img src="assets/img/login-page-img.png" alt="" sizes="" srcset="">
          </div>
					<div class="col-md-6 col-lg-4">
						<form method="POST" class="fh5co-form animate-box" data-animate-effect="fadeInLeft">
							<h2>Connexion</h2>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Par exemple: Pseudo" name="pseudo" required tabindex="10">
								<em class="text-danger small" name="pseudo"></em>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" placeholder="Votre mot de passe" name="mod_pass">
								<em class="text-danger small" name="mod_pass"></em>
							</div>
							<div class="form-group m-0 p-0">
								<!-- <label for="remember"><input type="checkbox" id="remember"> Se Souvenir de moi</label> -->
							</div>
							<p><em class="text-danger small" msg></em></p>
							<div class="form-group mb-5">
								<button type="submit" name="login_admin" class="btn" tabindex="30" style="background-color: #304c79;color: white">
									<i class="fa fa-unlock"></i>
									Se Connecter</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal Editiom du Image archivé -->
    <div class="modal" id="form_admin" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="title-box">
              <h5 class="modal-title" id="exampleModalLabel" style="color:black!important">Nouveau compte</h5>
            </div>
          </div>
          <div class="modal-body">
            <div class="inner-box">
              <div class="content-box">

              </div>
            </div>
            <form method="post" class="registration-form">
              <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <label>Pseudo</label>
                  <input type="text" class="form-control" name="new_pseudo" placeholder="Par exemple: Lema" required tabindex="100">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <label>Créer le mot de passe</label>
                  <input type="password" class="form-control" name="nouv_user_mop" placeholder="Votre mot de passe" required tabindex="110"><br>
                  <label>Confirmer le mot de passe</label>
                  <input type="password" class="form-control" name="nouv_user_confmop" placeholder="Votre mot de passe" required tabindex="110">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <label>Code admin</label>
                  <input type="password" class="form-control" name="code_admin" maxlength="8" placeholder="8 caractères" required tabindex="120">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <label for="master"><input type="checkbox" name="statut" value="master" required tabindex="130" id="master">&nbsp;Je suis l'administrateur</label>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                  <button type="submit" name="cmd_nouv_user" class="btn btn-warning" tabindex="30" style="background-color: #304c79;color: white">Sauvegarder</button>
                </div>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <a href="javascript:void(0)" class="btn btn-primary" onclick="closeNewAdmin()" style="background-color: #304c79;color: white">Quitter</a>
          </div>
        </div>
      </div>
    </div>

		<div class="gototop js-top">
			<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
		</div>

		<script src="first/js/jquery.min.js"></script>
		<script src="first/js/jquery.easing.1.3.js"></script>
		<script src="first/js/bootstrap.min.js"></script>
		<script src="first/js/jquery.waypoints.min.js"></script>
		<script src="first/js/jquery.stellar.min.js"></script>
		<script src="first/js/owl.carousel.min.js"></script>
		<script src="first/js/jquery.flexslider-min.js"></script>
		<script src="first/js/jquery.countTo.js"></script>
		<script src="first/js/jquery.magnific-popup.min.js"></script>
		<script src="first/js/magnific-popup-options.js"></script>
		<script src="first/js/simplyCountdown.js"></script>
		<script src="first/js/main.js"></script>

		<!--- Script modal --->
		<script type="text/javascript">
          function opnenNewAdmin() {
            document.getElementById('form_admin').style.display = "block";
          }

         function closeNewAdmin() {
            document.getElementById('form_admin').style.display = "none";
          }
        </script>
    <!--
		<script>
			/*$(function() {
				$('form').submit(function(e) {
					e.preventDefault();
					var form = $(this);
					var btn = $(':submit', form);
					var txt = btn.html();
					btn.attr('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Connexion');
					$(`em[name]`).html('');
					$(`em[msg]`).html('');

					$.post('../ajax/login.php', form.serialize(), function(log) {
						log = JSON.parse(log);
						if (log.status) {
							btn.attr('disabled', true).html('<i class="fa fa-check-circle"></i> Connexion');
							form.get(0).reset();
							setTimeout(() => {
								location.assign(log.url);
							}, 0);
						} else {
							btn.attr('disabled', false).html(txt);
							$('em[msg]').html(log.message).fadeIn('slow');
							var err = log.error;
							for (i in err) {
								$(`em[name=${i}]`).html(err[i]);
							}
						}
					})
				})
			})
		</script>-->
	</body>
</html>