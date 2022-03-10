<main class="main-wrapper auth-background customs in-right" id="hospital">

    <hospital-card>
      <template>
        <?php foreach ($propHospital as $ph):?>
            <a class="swiper-slide hospital-info in-center" href="<?= base_url() . 'hospital/new_request/' . $ph['idRs']; ?>">
                <div class="hospital-logo">
                  <img with-state="hospital-logo" src="<?= base_url('assets/logos/').$ph['rsLogoFileID']; ?>" alt="">
                </div>
                <div class="hospital-name">
                  <p><?= $ph['rsName']; ?></p>
                </div>
                <div class="hospital-address">
                  <p><i class="fas fa-map-marker-alt mr-10"></i><?= $ph['rsAlamat']; ?>. <?= $ph['rsCity']; ?></p>
                </div>
            </a>
            <?php endforeach; ?>
      </template>
  </hospital-card>
</main>
