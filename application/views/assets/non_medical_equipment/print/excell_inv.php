<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report_nonmed_inventory.xls");
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
                <h1>REPORT NON MEDICAL EQUIPMENT INVENTORY <?= strtoupper($this->session->userdata('hospital')); ?></h1>
            </div>
            <br>

            <br>
            <table border="1" width="50%">
                <thead>
                    <tr>
                        <th align="center" style="width:70px !important">No</th>
                        <th align="center">Code</th>
                        <th align="center">Barcode</th>
                        <th align="center">Teracode</th>
                        <th align="center">Category</th>
                        <th align="center">Tools Type</th>
                        <th align="center">Asset Name</th>
                        <th align="center">Merk</th>
                        <th align="center">Tipe</th>
                        <th align="center">Room Name</th>
                        <th align="center">Floor Name</th>
                        <th align="center">Building Name</th>
                        <th align="center">Supplier</th>
                        <th align="center">Calibration Required</th>
                        <th align="center">Condition</th>
                        <th align="center">Purchace Price</th>
                        <th align="center">Life Time</th>
                        <th align="center">Year Procurement</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($assets['data'] as $asset) { ?>
                        <tr>
                            <td align="center" style="width:70px !important"><?= $no++; ?></td>
                            <td align="justify"><?= $asset['catCode'] . '-' . $asset['idAsset']; ?></td>
                            <td align="justify"><?= $asset['kodeBar']; ?></td>
                            <td align="justify"><?= $asset['kodeTera']; ?></td>
                            <td align="justify"><?= $asset['propAssetCat']['assetCatName']; ?></td>
                            <td align="justify"><?= $asset['propAssetMaster']['assetMasterName']; ?></td>
                            <td align="justify"><?= $asset['assetName']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropgenit']['merk']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropgenit']['tipe']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropadmin']['propContact']['contactCompany']; ?></td>
                            <td align="justify"><?= $asset['propAssetMaster']['calibMust'] == true ? 'YES' : 'NO'; ?></td>
                            <td align="justify"><?= $asset['propAssetPropadmin']['condition']; ?></td>
                            <td align="justify"><?= number_format($asset['propAssetPropadmin']['priceBuy'], 0, ',', '.'); ?></td>
                            <td align="justify"><?= $asset['propAssetMaster']['lifeTime']; ?></td>
                            <td align="justify"><?= $asset['propAssetPropadmin']['procureDate']; ?></td>
                        </tr>
                    <?php } ?>
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