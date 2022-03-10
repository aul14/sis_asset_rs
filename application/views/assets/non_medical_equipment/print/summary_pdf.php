<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>REPORT SUMMARY NON MEDICAL EQUIPMENT</title>
    <link href="<?php echo base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-report-ui.css?v=1.2" rel='stylesheet'>
</head>

<body>
    <h2>REPORT SUMMARY NON MEDICAL EQUIPMENT <?= strtoupper($this->session->userdata('hospital')); ?></h2>
    <table>
        <thead>
          <tr>
              <th>No</th>
              <th>Asset Name</th>
              <th>Total</th>
              <th>Good</th>
              <th>Slightly Damage</th>
              <th>Heavy Damage</th>
              <th>Unknown</th>
          </tr>
        </thead>
        <tbody>
            <?php $number = 0;
            $total = [];
            $baik = [];
            $rusakRingan = [];
            $rusakBerat = [];
            $unknown = [];
            foreach ($asset_masters['data'] as $key => $asset_master) {

                $total[] = $asset_master['total'];
                $baik[] = $asset_master['baik'];
                $rusakRingan[] = $asset_master['rusakRingan'];
                $rusakBerat[] = $asset_master['rusakBerat'];
                $unknown[] = $asset_master['unknown']; ?>

                <tr>
                    <td><?= $asset_master['no']; ?></td>
                    <td><?= $asset_master['namaAlat']; ?></td>
                    <td><?= $asset_master['total']; ?></td>
                    <td><?= $asset_master['baik']; ?></td>
                    <td><?= $asset_master['rusakRingan']; ?></td>
                    <td><?= $asset_master['rusakBerat']; ?></td>
                    <td><?= $asset_master['unknown']; ?></td>
                </tr>
            <?php } ?>

            <?php
            $footers = [
                "total" => array_sum($total),
                "baik" => array_sum($baik),
                "rusakRingan" => array_sum($rusakRingan),
                "rusakBerat" => array_sum($rusakBerat),
                "unknown" => array_sum($unknown),
            ];
            ?>
        </tbody>

        <tbody>
            <tr>
                <td colspan="2" align="center"><b>Total</b></td>
                <?php foreach ($footers as $footer) { ?>
                    <td align="center"> <b><?= $footer; ?></b> </td>
                <?php } ?>
            </tr>
        </tbody>
    </table>


    <?php if ($any_toogle == "Yes") : ?>
        <div id="ttd" style="width:200px;border:1px solid #fff;float:right;margin-top:20px;text-align:center;">
            <p><?= (empty($lokasi_print) ? 'Jakarta' : ucwords($lokasi_print)) . ', ' . (empty($tgl_print) ? date('Y-m-d') : $tgl_print) ?></p>
            <!-- <p><?= 'Ka. IPSRS' ?></p> -->
            <br><br><br><br><br>
            <p><span style="text-decoration:underline;line-height:10px;"><?= (empty($officer) ? 'Lukmanul Hakim, ST' : ucwords($officer))  ?></span><br>NIP : <?= '098.880.5357.765' ?></p>
        </div>
    <?php endif; ?>
</body>

</html>
