<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report_summary_medic_equipment.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 10pt "Tahoma";
        }

        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }

        .full {
            display: block;
            clear: both;
            width: 100%;
            float: left;
        }

        .label-danger {
            background-color: #FF0000
        }

        .label-warning {
            background-color: #FFFF00
        }

        .label-success {
            background-color: #00FFFF
        }

        .label-default {
            background-color: #0000FF
        }

        .page {
            width: 29.7cm;
            min-height: 21cm;
            padding: 1cm;
            size: landscape;
            background: white;
            font-size: 10px;
        }

        .judul {
            text-align: center;
            /*color: #066;*/
            font-size: 14px;
            text-transform: uppercase;
        }

        .judul th,
        .judul td {
            font-family: Cambria, "Times New Roman", serif;
            text-align: center !important;
            border-right: none;
            border-left: none;
        }

        h2 {
            font-size: 14px;
            text-align: center;
            font-family: Cambria, "Times New Roman", serif;
            font-weight: bold;
            color: #066;
            margin: 0;
        }

        h3 {
            font-family: Cambria, "Times New Roman", serif;
        }

        h1 {
            font-family: Cambria, "Times New Roman", serif;
        }

        .logo {
            width: 2cm;
            padding: 2mm;
            text-align: center;
        }

        .logo img,
        img.logo {
            width: 100%;
            height: auto;
        }

        .foto {
            width: 3cm;
            height: auto;
            padding: 1mm;
            border: solid 1mm #CCC;
            float: left;
            text-align: center;
        }

        .foto img,
        img.foto {
            width: 3cm;
            height: auto !important;
        }

        .jadwal {
            float: right;
            width: 14.2cm;
            min-height: 4cm;
            height: auto;
            margin-left: 3mm;
            font-size: 11px;
        }

        .page .setengah {
            width: 21cm;
            height: auto;
            padding: 5mm;
            float: left;
        }

        .page .setengah1 {
            width: 21cm;
            height: auto;
            padding: 0 5mm;
            float: left;
        }

        table {
            border: solid thin #CCC;
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2mm;
        }

        th,
        td {
            font-family: Cambria, "Times New Roman", serif;
            padding: 1mm 2mm;
            text-align: left;
            vertical-align: top;
            border-collapse: collapse;
        }

        th {
            text-align: center;
            background-color: #F5F5F5;
        }

        td.title {
            text-align: center !important;
        }

        .subpage {
            padding: 1cm;
            height: 256mm;
            size: landscape;
        }

        .sponsor {
            width: 100%;
            max-height: 8cm;
        }

        @page {
            size: A4;
            margin: 0;
            size: landscape;
        }
    </style>
</head>

<body>
    <div class="book">
        <div class="page">
            <div style="text-align: center;">
                <h1>REPORT SUMMARY MEDICAL EQUIPMENT <?= strtoupper($this->session->userdata('hospital')); ?></h1>
            </div>
            <br>

            <br>
            <table border="1" width="50%">
                <thead>
                    <tr>
                    <tr>
                        <th align="justify" style="width:70px !important">No</th>
                        <th align="justify">Asset Name</th>
                        <th align="justify">Total</th>
                        <th align="justify">Good</th>
                        <th align="justify">Slightly Damage</th>
                        <th align="justify">Heavy Damage</th>
                        <th align="justify">Unknown</th>
                    </tr>
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
                            <td align="justify" style="width:70px !important"><?= $asset_master['no']; ?></td>
                            <td align="justify"><?= $asset_master['namaAlat']; ?></td>
                            <td align="justify"><?= $asset_master['total']; ?></td>
                            <td align="justify"><?= $asset_master['baik']; ?></td>
                            <td align="justify"><?= $asset_master['rusakRingan']; ?></td>
                            <td align="justify"><?= $asset_master['rusakBerat']; ?></td>
                            <td align="justify"><?= $asset_master['unknown']; ?></td>
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
                    <p><?php echo (empty($lokasi_print) ? 'Jakarta' : ucwords($lokasi_print)) . ', ' . (empty($tgl_print) ? date('Y-m-d') : $tgl_print) ?></p>
                    <!-- <p><?php echo 'Ka. IPSRS' ?></p> -->
                    <br><br><br><br><br>
                    <p><span style="text-decoration:underline;line-height:10px;"><?php echo (empty($officer) ? 'Lukmanul Hakim, ST' : ucwords($officer))  ?></span><br>NIP : <?php echo '098.880.5357.765' ?></p>
                </div>
            <?php endif; ?>
</body>

</html>