<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>GESTION INTEGREE DES RESSOURCES || PAGIRES</title>
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
  <link rel="stylesheet" href="../assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="../assets/bundles/select2/dist/css/select2.min.css">

  <link rel="stylesheet" href="../assets/bundles/fullcalendar/fullcalendar.min.css" />
  <link rel="stylesheet" href="../assets/bundles/jquery-selectric/selectric.css">

  <link rel='shortcut icon' type='image/x-icon' href="../assets/img/favicon.png" />
  <?php include("../includes/modal.php"); ?>
  <style>
    .page-item.active .page-link {
      color: #fff !important;
      background-color: #ffc107 !important;
      border-color: #ffc107 !important;
    }

    .page-link {
      color: #ffc107 !important;
      background-color: #fff !important;
      border: 1px solid #dee2e6 !important;
    }

    .page-link:hover {
      color: #fff !important;
      background-color: #ffc107 !important;
      border-color: #ffc107 !important;
    }

    .db-icon {
      background-color: #304c79;
      padding: 20px;
      border-radius: 12px
    }

    .db-icon i {
      font-size: 32px;
      color: white;
    }

    .list-form-acces li a {
      color: #304c79
    }

    .form_filter {
      display: inline-block !important;
    }

    .list-form-acces li {
      display: block !important;
      width: 100% !important;
    }

    .modal-title {
      color: #575757 !important;
    }

    input {
      border: 2px solid #ccc;
    }

    .form-control {
      border-radius: 50px 50px 50px !important
    }

    button {
      width: 40px;
      height: 35px;
      padding: 12px
    }

    .card-header li {
      list-style: none;
    }

    .card-header li ul li a {
      font-size: 14px;
      padding: 15px;
      font-weight: bold;
      color: #304c79;
      text-decoration: none;
    }

    .card-header li ul li {
      border-bottom: 1px solid black;
      color: white
    }

    .card-header li ul li:hover {
      background-color: #304c79;
      color: white
    }

    .card-header li ul li a:hover {
      color: white
    }

    .title-box i {
      font-size: 21px;
      color: #304c79
    }
  </style>
</head>

<body>

  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <!--- En tete ---->
      <?php include('header.php'); ?>
      <!--- fin_En tete ---->

      <!--- Navbar --->
      <div class="main-sidebar sidebar-style-2">
        <?php include('navbar.php'); ?>
      </div>

      <!--- fin_Navbar --->
    </div>