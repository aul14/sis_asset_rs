<!-- Custom SAMRS JS -->
<script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/samrs-style-ui.js?v=1.1.0"></script>
<script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/single-custom/samrs-modal.js?v=1.0"></script>
<script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/single-custom/initLibrary.js?v=1.3"></script>
<script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/single-custom/samrsOverlay.js?v=1.1"></script>
<script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/single-custom/togglePassword.js?v=1.0"></script>
<script src="<?= base_url(); ?>assets/main-ui/samrs-custom-ui/js/single-custom/samrs-dropdown.js?v=1.0"></script>

<script src="<?php echo base_url(); ?>vue-components/main.js?v=1.2.6"></script>

<script>
  $(document).ready(function() {
    SamrsModal();
    SamrsDropdown();
    InputFiles();
    $('.selectpicker').selectpicker();
  })
</script>
<script>
  $('[data-fancybox="preview"]').fancybox({});
</script>
<script>
  $('.changeview').on('click', function() {
    if ($('body').prop('dir') == 'rtl') {
      $('body').attr('dir', 'ltr');
      $('.changeview').removeClass('btn-success');
      $('.changeview').addClass('btn-primary');
      $('.samrs-dropdown').find('.dropdown-menu').removeClass('slideInRight');
    } else if ($('body').prop('dir') == 'ltr') {
      $('body').attr('dir', 'rtl');
      $('.changeview').removeClass('btn-primary');
      $('.changeview').addClass('btn-success');
      $('.samrs-dropdown').find('.dropdown-menu').removeClass('slideInLeft');
    }
  });
</script>
<script>
  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
      return false;
    }
    return true;
  }

  function getNameAsset(name) {
    var name_asset, br = "- <br> ";
    if (name.length <= 50) {
      name_asset = name;
    } else if (name.length > 50 && name.length <= 100) {
      name_asset = name.substring(0, 50) + br;
      name_asset += name.substring(50, name.length);
    } else if (name.length > 100 && name.length <= 150) {
      name_asset = name.substring(0, 50) + br;
      name_asset += name.substring(50, 100) + br;
      name_asset += name.substring(100, name.length);
    } else if (name.length > 150 && name.length <= 200) {
      name_asset = name.substring(0, 50) + br;
      name_asset += name.substring(50, 100) + br;
      name_asset += name.substring(100, 150) + br;
      name_asset += name.substring(150, name.length);
    } else if (name.length > 200) {
      name_asset = name.substring(0, 50) + br;
      name_asset += name.substring(50, 100) + br;
      name_asset += name.substring(100, 150) + br;
      name_asset += name.substring(150, 200) + br;
      name_asset += name.substring(200, name.length);
    }
    return name_asset;
  }
</script>
</body>

</html>