<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report_task_calibration.xls");
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
                <h1>REPORT TASK CALIBRATION</h1>
            </div>
            <br>

            <br>
            <table border="1" width="50%">
                <thead>
                    <tr>
                        <th align="center">No</th>
                        <th align="center">Status</th>
                        <th align="center">Asset Code</th>
                        <th align="center">Asset Name</th>
                        <th align="center">Merk</th>
                        <th align="center">Type</th>
                        <th align="center">Serial Number</th>
                        <th align="center">Location</th>
                        <th align="center">Planning Date</th>
                        <th align="center">Implementation Date</th>
                        <th align="center">Supplier</th>
                        <th align="center">Result</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($tasks['data'] as $task) { ?>

                        <?php foreach ($task['propTaskCalibration'] as $propTaskCalibration) { ?>
                            <tr>
                                <td align="center" style="width:30px !important"><?= $no++; ?></td>
                                <?php if (isset($propTaskCalibration['propItemProgress']['progressStatus'])) {
                                    $propProgress = $propTaskCalibration['propItemProgress']['progressStatus'];

                                    if ($propProgress == 'NEW') {
                                        echo "<td>NEW</td>";
                                    } else {
                                        echo "<td>FINISH</td>";
                                    }
                                } else {
                                    $propProgress = $task['propProgress']['progressStatus'];
                                    if ($propProgress == 'NEW') {
                                        echo "<td>NEW</td>";
                                    } else {
                                        echo "<td>FINISH</td>";
                                    }
                                }
                                ?>

                                <td align="justify" style="width:80px !important"><?= $propTaskCalibration['propAsset']['assetCode']; ?></td>
                                <td align="justify"><?= $propTaskCalibration['propAsset']['assetName']; ?></td>
                                <td align="justify"><?= $propTaskCalibration['propAsset']['propAssetPropgenit']['merk']; ?></td>
                                <td align="justify"><?= $propTaskCalibration['propAsset']['propAssetPropgenit']['tipe']; ?></td>
                                <td align="justify"><?= $propTaskCalibration['propAsset']['propAssetPropgenit']['serialNumber']; ?></td>
                                <td align="justify"><?= $propTaskCalibration['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></td>
                                <td align="justify"><?= $task['propSchedule']['scheduleStart']; ?></td>
                                <td align="justify"><?= !empty($propTaskCalibration['propItemProgress']['timeFinish']) ? date('Y-m-d', strtotime($propTaskCalibration['propItemProgress']['timeFinish'])) : '-'; ?></td>
                                <td align="justify"><?= !empty($propTaskCalibration['propItemVendor']['contactCompany']) ? $propTaskCalibration['propItemVendor']['contactCompany'] : '-'; ?></td>
                                <td><?= $propTaskCalibration['calibResult']; ?></td>

                            </tr>
                        <?php } ?>
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