<?php

use chillerlan\QRCode\QRCode;
?>
<html>


<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>QR</title>

  <link href="<?php echo base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-qr-ui.css?v=1.7" rel='stylesheet'>
</head>

<body>
  <?php if (isset($data_list)) : ?>
    <?php foreach ($data_list as $field) : ?>
      <div class="page-size-70 paging">
        <p class="qr-title" samrs-typography="700"><span><?= $this->session->userdata('hospital'); ?></span></p>
        <div class="samrs-qr-template">
          <div class="qr-images">
            <img src='<?= (new QRCode)->render($field['assetCode']) ?>' alt="qr_image">
          </div>
          <div class="qr-long-info">
            <p class="tools-name" samrs-typography="500"><?= $field['assetName']; ?></p>
            <?php if ($field['propAssetPropgenit']['tipe'] != "") : ?>
              <p class="brand-name" samrs-typography="500"><?= $field['propAssetPropgenit']['merk'] . "/" . $field['propAssetPropgenit']['tipe']; ?></p>
            <?php else : ?>
              <p class="brand-name" samrs-typography="500"><?= $field['propAssetPropgenit']['merk']; ?></p>
            <?php endif; ?>
            <p class="serial-number" samrs-typography="500"><span class="title">s/n :</span><?= $field['propAssetPropgenit']['serialNumber']; ?></p>
            <p class="labels" samrs-typography="500"><?= $field['kodeBar']; ?></p>
            <p class="locations" samrs-typography="500"><?= $field['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></p>
            <p class="qr-id" samrs-typography="700"><?= $field['assetCode']; ?></p>
          </div>
        </div>
      </div>

    <?php endforeach; ?>
  <?php else : ?>
    <?php foreach ($data_room_list as $field) : ?>
      <div class="page-size-70 paging">
        <p class="qr-title" samrs-typography="700"><span><?= $this->session->userdata('hospital'); ?></span></p>
        <div class="samrs-qr-template">
          <div class="qr-images">
            <img src='<?= (new QRCode)->render($field['idRoom']) ?>' alt="qr_image">
          </div>
          <div class="qr-long-info">
            <p class="tools-name" samrs-typography="500"><?= $field['roomName']; ?></p>
            <p class="brand-name" samrs-typography="500"><?= $field['floorName']; ?></p>
            <p class="brand-name" samrs-typography="500"><?= $field['buildingName']; ?></p>
            <p class="qr-id" samrs-typography="700"><?= "ROOM" . "-" . $field['idRoom']; ?></p>
          </div>
        </div>
      </div>

    <?php endforeach; ?>
  <?php endif; ?>
  <script type="text/javascript">
    window.print();
  </script>

</body>


</html>