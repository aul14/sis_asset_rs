<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>REPORT NON MEDICAL EQUIPMENT INVENTORY</title>
    <link href="<?php echo base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-report-ui.css?v=1.2" rel='stylesheet'>

</head>

<body>
    <h2>REPORT NON MEDICAL EQUIPMENT INVENTORY <?= strtoupper($this->session->userdata('hospital')); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Barcode</th>
                <th>Teracode</th>
                <th>Category</th>
                <th>Tools Type</th>
                <th>Asset Name</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Room Name</th>
                <th>Floor Name</th>
                <th>Building Name</th>
                <th>Supplier</th>
                <th>Calibration Required</th>
                <th>Condition</th>
                <th>Purchace Price</th>
                <th>Life Time</th>
                <th>Year Procurement</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($assets['data'] as $asset) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $asset['catCode'] . '-' . $asset['idAsset']; ?></td>
                    <td><?= $asset['kodeBar']; ?></td>
                    <td><?= $asset['kodeTera']; ?></td>
                    <td><?= $asset['propAssetCat']['assetCatName']; ?></td>
                    <td><?= $asset['propAssetMaster']['assetMasterName']; ?></td>
                    <td><?= $asset['assetName']; ?></td>
                    <td><?= $asset['propAssetPropgenit']['merk']; ?></td>
                    <td><?= $asset['propAssetPropgenit']['tipe']; ?></td>
                    <td><?= $asset['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></td>
                    <td><?= $asset['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName']; ?></td>
                    <td><?= $asset['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName']; ?></td>
                    <td><?= $asset['propAssetPropadmin']['propContact']['contactCompany']; ?></td>
                    <td><?= $asset['propAssetMaster']['calibMust'] == true ? 'YES' : 'NO'; ?></td>
                    <td><?= $asset['propAssetPropadmin']['condition']; ?></td>
                    <td><?= number_format($asset['propAssetPropadmin']['priceBuy'], 0, ',', '.'); ?></td>
                    <td><?= $asset['propAssetMaster']['lifeTime']; ?></td>
                    <td><?= $asset['propAssetPropadmin']['procureDate']; ?></td>
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