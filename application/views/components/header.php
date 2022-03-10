<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="theme-color" content="#2cabe3">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>SAMRS New Generation - SAMRS_NG</title>

  <!-- Fontawesome new version -->
  <link href="<?= base_url(); ?>assets/main-library/font-awesome/css/all.min.css" rel="stylesheet">

  <link REL="SHORTCUT ICON" href="<?= base_url(); ?>assets/images/icon/favesamrscloud.jpeg" type="image/png">

  <!-- Custom CSS -->
  <link href="<?= base_url(); ?>assets/main-ui/dist/css/style.css" rel="stylesheet">

  <!-- Samrs Custom UI -->
  <link href="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/css/samrs-style-ui.css?v=1.3.0" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/css/single-custom/samrs-navs.css?v=1.1.1" rel="stylesheet">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/main-library/bootstrap-toggle/css/bootstrap-toggle.min.css">

  <link href="<?= base_url(); ?>assets/main-library/datatables.net-bs4/css/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/extra-library/DataTables/DataTables-1.10.16/css/select.dataTables.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/extra-library/DataTables/DataTables-1.10.16/css/fixedColumns.dataTables.min.css" rel="stylesheet">

  <link href="<?= base_url(); ?>assets/extra-library/jquery.ui/jquery-ui.min.css" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/main-library/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css">

  <link rel="stylesheet" href="<?= base_url(); ?>assets/extra-library/bootstrap-select/bootstrap-select.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/extra-library/bootstrap-select/ajax-bootstrap-select.min.css">
  <link href="<?= base_url(); ?>assets/extra-library/jquery-confirm/jquery.confirm.min.css" rel="stylesheet" />
  <link href="<?= base_url(); ?>assets/main-library/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="<?= base_url(); ?>assets/main-library/click-tap-image/dist/css/image-zoom.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= base_url(); ?>assets/main-library/fancybox/jquery.fancybox.min.css" />
  <link href="<?= base_url(); ?>assets/main-library/select2/dist/css/select2.min.css" rel="stylesheet">

  <link href="<?= base_url(); ?>assets/main-library/hummingbird-tree/hummingbird-treeview.css" rel="stylesheet" type="text/css">

  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/extra-library/SignaturePad/css/jquery.signature.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/extra-library/Swiperjs/swiper-bundle.min.css">
  <link href="<?= base_url(); ?>assets/main-library/datepicker/datepicker.min.css" rel="stylesheet">

  <link href="<?= base_url(); ?>assets/extra-library/OwlCarousel/css/owl.carousel.css" rel="stylesheet">
  <!-- All Jquery -->
  <script src="<?= base_url(); ?>assets/main-library/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/taskboard/js/jquery.ui.touch-punch-improved.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/jquery.ui/jquery-ui.min.js"></script>
  <!-- Bootstrap tether Core JavaScript -->
  <script src="<?= base_url(); ?>assets/main-library/popper.js/dist/umd/popper.min.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- apps -->
  <script src="<?= base_url(); ?>assets/main-ui/dist/js/app.js"></script>
  <!-- slimscrollbar scrollbar JavaScript -->
  <script src="<?= base_url(); ?>assets/main-library/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/sparkline/sparkline.js"></script>
  <!--Wave Effects -->
  <script src="<?= base_url(); ?>assets/main-ui/dist/js/waves.js"></script>
  <!--Menu sidebar -->
  <!-- <script src="<?= base_url(); ?>assets/main-ui/dist/js/sidebarmenu-vue.js"></script> -->
  <!-- Moment JS -->
  <script src="<?= base_url(); ?>assets/main-library/moment/min/moment-with-locales.min.js"></script>
  <!--Custom JavaScript -->
  <script src="<?= base_url(); ?>assets/main-ui/dist/js/custom.min.js"></script>

  <script src="<?= base_url(); ?>assets/main-library/bootstrap-toggle/js/bootstrap-toggle.min.js"></script>

  <script src="<?= base_url(); ?>assets/main-library/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js"></script>

  <script src="<?= base_url(); ?>assets/extra-library/DataTables/datatables.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/DataTables/DataTables-1.10.16/js/dataTables.select.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/DataTables/DataTables-1.10.16/js/dataTables.fixedColumns.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/DataTables/DataTables-1.10.16/js/dataTables.colResize.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/DataTables/DataTables-1.10.16/js/ColReorderWithResize.js"></script>

  <script src="<?= base_url(); ?>assets/extra-library/SignaturePad/js/signature_pad.umd.js"></script>

  <script src="<?= base_url(); ?>assets/extra-library/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/bootstrap-select/ajax-bootstrap-select.min.js"></script>
  <script src="<?= base_url(); ?>assets/extra-library/jquery-confirm/jquery-confirm.min.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/jqbootstrapvalidation/validation.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/jquery-validation/dist/jquery.validate.min.js"></script>

  <script src="<?= base_url(); ?>assets/main-library/sweetalert2/dist/sweetalert2@9.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/click-tap-image/dist/js/image-zoom.min.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/fancybox/jquery.fancybox.min.js"></script>
  <!-- select2 -->
  <script src="<?= base_url(); ?>assets/main-library/select2/dist/js/select2.full.min.js"></script>
  <!-- <script src="<?= base_url(); ?>assets/main-library/select2/dist/js/select2.full.js"></script> -->
  <script src="<?= base_url(); ?>assets/main-library/select2/dist/js/select2.min.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/select2/dist/js/select2.js"></script>

  <script src="<?= base_url('assets/main-library/tree-view/jquery.cookie.js'); ?>"></script>
  <script src="<?= base_url('assets/main-library/tree-view/jquery.treeview.js'); ?>"></script>
  <script src="<?= base_url(); ?>assets/main-library/hummingbird-tree/hummingbird-treeview.js"></script>


  <script src="<?= base_url(); ?>assets/main-library/echarts/dist/echarts-en.min.js"></script>

  <script src="<?= base_url(); ?>assets/extra-library/Swiperjs/swiper-bundle.min.js"></script>
  <script src="<?= base_url(); ?>assets/main-library/datepicker/bootstrap-datepicker.min.js"></script>

  <script src="<?= base_url(); ?>assets/extra-library/OwlCarousel/js/owl.carousel.js"></script>
  
  <script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/printThis.js?v=1.15.1"></script>

  <!-- Vue Compiler and Plugins -->
  <script src="<?= base_url(); ?>assets/main-ui/vue/testing/vue.js"></script>
  <script src="<?= base_url(); ?>assets/main-ui/vue/axios/axios.min.js"></script>
  <script src="<?= base_url(); ?>assets/main-ui/vue/http-vue-loader.js"></script>
  <script src="<?= base_url(); ?>vue-components/config.js"></script>
  <script>
    var BASE_URL = '<?= base_url(); ?>';
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  </script>
</head>

<body dir="ltr">
  <noscript>
    <p class="text-center" data-color-type="primary">SAMRS : We need javascript to interacts with you</p>
  </noscript>
