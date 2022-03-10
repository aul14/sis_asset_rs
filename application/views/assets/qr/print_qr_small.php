<?php

use chillerlan\QRCode\QRCode;
?>
<html>


<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>QR</title>

  <link href="<?php echo base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-qr-ui.css?v=1.2" rel='stylesheet'>
</head>

<body>
  <style>
    td,
    th {
      border: none;
      vertical-align: top;
      text-align: center;
      line-height: 11px;
    }
  </style>

  <?php if (isset($data_list)) : ?>
    <?php foreach ($data_list as $field) : ?>
      <table style='width:24mm;margin:2.5mm 0mm 1mm 0mm;page-break-after: always;'>
        <tbody>
          <tr>
            <td style='padding:0mm 0px 0px 0px; text-align: center'>
              <img src='<?= (new QRCode)->render($field['assetCode']); ?>' alt='QR Code' style='display:inline;margin:0;' width='60'>
            </td>
          </tr>
          <tr>
            <td>
              <div style='font-size:8px; font-weight: bold'><?= $field['assetCode']; ?></div>
            <td>
          </tr>

        </tbody>
      </table>
    <?php endforeach; ?>
  <?php else : ?>
    <?php foreach ($data_room_list as $field) : ?>
      <table style='width:24mm;margin:2.5mm 0mm 1mm 0mm;page-break-after: always;'>
        <tbody>
          <tr>
            <td style='padding:0mm 0px 0px 0px; text-align: center'>
              <img src='<?= (new QRCode)->render($field['idRoom']); ?>' alt='QR Code' style='display:inline;margin:0;' width='60'>
            </td>
          </tr>
          <tr>
            <td>
              <div style='font-size:8px; font-weight: bold'><?= "ROOM" . "-" . $field['idRoom']; ?></div>
            <td>
          </tr>

        </tbody>
      </table>
    <?php endforeach; ?>
  <?php endif; ?>
</body>
<script type=" text/javascript">
  window.print();
</script>

</html>