<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }

        td {
            font-size: 50px;
            font-family: 'Times New Roman', Times, serif;
        }

        th {
            font-family: 'Times New Roman', Times, serif;
            font-size: 50px;
        }
    </style>
    <title>REPORT TASK CALIBRATION</title>
</head>

<body>
    <h2 style="text-align: center;">REPORT TASK CALIBRATION</h2>
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
            <p><?= (empty($lokasi_print) ? 'Jakarta' : ucwords($lokasi_print)) . ', ' . (empty($tgl_print) ? date('Y-m-d') : $tgl_print) ?></p>
            <!-- <p><?= 'Ka. IPSRS' ?></p> -->
            <br><br><br><br><br>
            <p><span style="text-decoration:underline;line-height:10px;"><?= (empty($officer) ? 'Lukmanul Hakim, ST' : ucwords($officer))  ?></span><br>NIP : <?= '098.880.5357.765' ?></p>
        </div>
    <?php endif; ?>
</body>

</html>