<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>REPORT INVENTORY BUILDING</title>
    <link href="<?php echo base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-report-ui.css?v=1.2" rel='stylesheet'>
</head>

<body>
    <h2>REPORT INVENTORY BUILDING</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Code</th>
                <th>Asset Name</th>
                <th>Address</th>
                <th>Flour Amount</th>
                <th>Surface Area</th>
                <th>Building Area</th>
                <th>Present Date</th>
                <th>Calculation Date</th>
                <th>Residual Value</th>
                <th>Yearly Depreciation</th>
                <th>Procurement Year</th>
                <th>Purchase Price</th>
                <th>Expectation Life Time</th>
                <th>Present Date</th>
                <th>Accumulated Depreciation</th>
                <th>Book Values</th>

                <!-- <th>WARRANTY EXPIRED</th> -->
                <!-- <th>CREATED DATE</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($assets['data'] as $asset) { ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $asset['catCode'] . '-' . $asset['idAsset']; ?></td>
                    <td><?= $asset['assetName']; ?></td>
                    <td><?= $asset['propAssetPropbuilding']['buildingDesc']; ?></td>
                    <td><?= sizeof($asset['propAssetPropbuilding']['propAssetPropbuildingFloor']); ?></td>
                    <td><?= $asset['propAssetPropbuilding']['luasTanah']; ?></td>
                    <td><?= $asset['propAssetPropbuilding']['luasBangunan']; ?></td>
                    <td><?= $asset['propAssetProptax']['presentDate']; ?></td>
                    <td><?= $asset['propAssetProptax']['calcStart']; ?></td>
                    <td><?= number_format($asset['propAssetProptax']['residuVal'], 0, ',', '.'); ?></td>
                    <td><?= number_format($asset['propAssetProptax']['yearlyDep'], 0, ',', '.'); ?></td>
                    <td><?= $asset['propAssetPropadmin']['procureDate']; ?></td>
                    <td><?= number_format($asset['propAssetProptax']['cost'], 0, ',', '.'); ?></td>
                    <td><?= $asset['propAssetProptax']['expectedLifeTime'] . " Year"; ?></td>
                    <td><?= $asset['propAssetProptax']['presentDate']; ?></td>
                    <td><?= number_format($asset['propAssetProptax']['accuVal'], 0, ',', '.'); ?></td>
                    <td><?= number_format($asset['propAssetProptax']['bookVal'], 0, ',', '.'); ?></td>

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
