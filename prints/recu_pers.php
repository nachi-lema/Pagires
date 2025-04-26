  <!--- Partie entête ---->
  <?php 
    require_once '../includes/Globals_function.php';
  ?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Gestion de paie || PAYROLL </title>
  <link rel="stylesheet" href="../assets/css/app.min.css">
  <link rel="stylesheet" href="../assets/bundles/prism/prism.css">
  <link rel="stylesheet" href="../assets/bundles/owlcarousel2/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/bundles/owlcarousel2/dist/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
  <link rel="stylesheet" href="../assets/css/custom.css">
  <link rel="stylesheet" href="../assets/bundles/summernote/summernote-bs4.css">
  <link rel="stylesheet" href="../assets/bundles/codemirror/lib/codemirror.css">
  <link rel="stylesheet" href="../assets/bundles/codemirror/theme/duotone-dark.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="../assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel='shortcut icon' type='image/x-icon' href="../assets/img/favicon.png" />

  <link rel="stylesheet" href="../assets/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <!-- <link rel="stylesheet" href="assets/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"> -->
  <!-- <link rel="stylesheet" href="assets/css/bootstrap.min02.css"> -->
  <!-- <link rel="stylesheet" href="assets/css/style002.css"> -->
  <!-- <link rel="stylesheet" href="assets/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css"> -->
  <link rel="stylesheet" href="assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="assets/bundles/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="assets/bundles/fullcalendar/fullcalendar.min.css" />
  <link rel="stylesheet" href="assets/bundles/jquery-selectric/selectric.css">

  <link rel='shortcut icon' type='image/x-icon' href="assets/img/favicon.png" />
  <style type="text/css">
    .title-h h1 {
      color: white !important;
      font-weight: bold !important;
    }

    .profile-box {
      width: 375px;
      height: 100% !important;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      border: 1px solid #e5eded;
      min-height: 980px;
      position: absolute;
      left: -500px;
      z-index: 1000 !important;
      margin-top: -120px !important;
      box-shadow: 0px 0px 10px #000 !important;
    }

    .container {
      max-width: 90% !important;
      padding: 15px !important;
    }

    .form_filter {
      display: inline-block !important;
    }

    .tete-table {
      background-color: #3f4040 !important;
      text-align: center !important;
      color: #fff;
      font-weight: bold;
      border: 0px solid #ddd !important;
      box-shadow: 0 1px 4px rgba(0, 0, 0, 0.6);
      width: auto;
    }

    .corp-table {
      color: white !important;
      text-align: center !important;
    }

    .list-form-acces li {
      display: block !important;
      width: 100% !important;
    }

    .modal-title {
      color: #575757 !important;
    }

    img#cimg {
      height: 25vh;
      width: 15vw;
      object-fit: scale-down;
      object-position: center center;
    }

    p,
    label {
      margin-bottom: 5px;
    }

    #uni_modal .modal-footer {
      display: none !important;
    }
  </style>
</head>

<!-- page wrapper -->

<body>
  <div class="boxed_wrapper">

    <!-- preloader -->
    <div class="preloader"></div>
    <!-- preloader -->

    <!-- doctors-dashboard -->
    <section class="doctors-dashboard bg-color-3">
      <div class="left-panel">

      </div>
      <div class="container" style="background-color: white;width: 40%">
        <div class="w-100 d-flex justify-content-end mb-2">
          <div class="col-5 d-flex w-max-100">
            <h5 class="text-center" style="font-size: 16px">
              <b>PROXIMITY</b>
            </h5>
          </div><br><br>
          <div class="col-4 d-flex w-max-100"></div>
          <div class="col-3 d-flex w-max-100">LOGO</div>
        </div>

        <!-- Affichage de recu --->
        <?php reci_paie_pers(); ?>

        <fieldset class="col-lg-6 col-md-6 col-sm-12">
          <button type="button" class="btn btn-primary mt-2" tabindex="170" style="background-color: #304c79">
            <a href="javascript:void(0)" onclick="javascript:print()" class="text-white">
              <i class="fa fa-print"></i> Imprimer</a>
          </button>
        </fieldset>
      </div>
    </section>
    <!-- doctors-dashboard -->

    <!--Scroll to top-->
    <button class="scroll-top scroll-to-target" data-target="html">
      <span class="fa fa-arrow-up"></span>
    </button>
  </div>

  <!-- jequery plugins -->
  <script src="../assets/js/jquery.js"></script>
  <script src="../assets/js/popper.min.js"></script>
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/owl.js"></script>
  <script src="../assets/js/wow.js"></script>
  <script src="../assets/js/validation.js"></script>
  <script src="../assets/js/jquery.fancybox.js"></script>
  <script src="../assets/js/appear.js"></script>
  <script src="../assets/js/scrollbar.js"></script>

  <!-- map script -->

  <!-- main-js -->
  <script src="assets/js/script.js"></script>
  <script type="text/javascript">
    function opensideNav() {
      document.getElementById('side_nav').style.left = "0px";
    }

    function closesideNav() {
      document.getElementById('side_nav').style.left = "-500px";
    }
  </script>