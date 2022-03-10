<main class="main-wrapper auth-background customs in-right" id="login">
  <?php
  $data = $this->session->flashdata('sukses');
  if ($data != "") { ?>
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-check"></i> <?= $data; ?>
    </div>
  <?php } ?>
  <?php
  $data2 = $this->session->flashdata('error');
  if ($data2 != "") { ?>
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fa fa-close"></i> <?= $data2; ?>
    </div>
  <?php } ?>
  <login-card form="<?= base_url('login'); ?>" brand-logo="<?php echo base_url(); ?>/assets/images/logos/samrs.png"
    version-view="Samrs Cloud V.1.3">
    <template v-slot>
      <?= $captcha; ?>
    </template>
  </login-card>
</main>
<?= $script_captcha; ?>
<script>
  function enableBtn() {
    document.getElementById("button1").disabled = false;
  }
</script>
