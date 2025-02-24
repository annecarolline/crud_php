<?php
require_once "../../mysql/define.php";
require_once "../../mysql/funcoes.php";


?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Projeto Template</title>

  <link rel="shortcut icon" href="../../favicon.ico">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-colreorder/css/colReorder.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.4/css/rowGroup.dataTables.min.css">
  <link rel="stylesheet" href="../../plugins/inputmask/jquery.inputmask.min.js">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../plugins/jquery-ui/jquery-ui.min.css">
  <!--Editor SummerNote -->
  <link href="../../plugins/summernote/summernote.min.css" rel="stylesheet">

  <!--JsTree-->
  <link rel="stylesheet" href="../../plugins/jstree/themes/default/style.min.css">

  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />
  <!-- Theme style -->
  <link rel="stylesheet" href="../../plugins/adminlte/css/adminlte.min.css">
  <link rel="stylesheet" href="../../assets/css/custom.css">
  <link rel="stylesheet" href="../../assets/css/style.css">

  

  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

 



  <style>
    
    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu a::after {
      transform: rotate(-90deg);
      position: absolute;
      right: 3px;
      top: 40%;
    }


    .dropdown-submenu:hover .dropdown-menu,
    .dropdown-submenu:focus .dropdown-menu {
      display: flex;
      flex-direction: column;
      position: absolute !important;
      margin-top: -30px;
      left: 100%;
    }

    @media (max-width: 992px) {
      .dropdown-menu {
        width: 50%;
      }

      .dropdown-menu .dropdown-submenu {
        width: auto;
      }
    }

   
  
  </style>

</head>

<body id="bodymain" class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed layout-top-nav ">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light layout-top-nav pt-2 pb-2" style="background-color: #33475b; ">  <!--#44546B;">-->
      <!-- Left navbar links -->
      <!--
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>-->



      <div class="collapse navbar-collapse menu_desktop_navbar font-nav" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto  ">

          <li class="nav-item">
            <a class="nav-link  d-flex align-items-center justify-content-center" href="../menu/dashboard.php">
              <img src="" alt="LOGO"  style="max-width: 120px; max-height: 40px;">
              <!--<div class="text-primary">LOGO</div>-->
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="../menu/dashboard.php">
              Início 
            </a>
          </li>


          <li class="nav-item">
            <a class="nav-link text-white" href="../cadastro/veiculocategoria.php">
              Modelo CRUD 
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="../cadastro/cadfuncionario.php">
              Cadastro de Funcionário 
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="../cadreserva/cadreserva.php">
              Cadastro de Reservas 
            </a>
          </li>

         
         


    

        </ul>



       
       


       

      </div>



      <header class="nav-menu w-100" id="headerMobile">
        <div class="row justify-content-beetween">
          <div class="col-4 callMenuListMobile cursor" id="callMenuMobile">
            <i class="fas fa-bars text-lg text-white"></i>
          </div>
          <div class="col-4 text-center  cursor">
            <a href="../menu/dashboard.php" class="text-white">

              <img src="../../assets/imgs/logo.png" alt="LOGO" style="max-width: 80px; max-height: 28px">
            </a>
          </div>
          <div class="col-4 ml-auto d-flex justify-content-end cursor">
          
            <a href="../menu/dashboard.php">
              <i class="fas fa-home text-lg text-white"></i>
            </a>
          </div>
        </div>
      </header>

    </nav>
    <!-- /.navbar -->

    <div class="menu-disable" id="menu-toggle">
      <div class="menu-toggle">
        <div class="list-menu card card-body p-0">
          <div class="list-item mt-4">
          </div>

          <a class="list-item" href="../menu/dashboard.php">
            <i class="fas fa-object-group text-info"></i>
            <span class="text-list-menu">Início</span>
          </a>


          <a class="list-item" href="../cadastro/veiculocategoria.php">
            <i class="fas fa-object-group text-info"></i>
            <span class="text-list-menu">Categorias de veículos</span>
          </a>


         

          
        </div>
      </div>
    </div>




   