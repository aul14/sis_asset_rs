<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>REPORT TASK MAINTENANCE</title>
    <link href="<?= base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-report-ui.css" rel='stylesheet'>
</head>

<body>
    <h2>REPORT TASK MAINTENANCE <?= strtoupper($this->session->userdata('hospital')); ?></h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Status</th>
                <th>Asset Code</th>
                <th>Asset Name</th>
                <th>Merk</th>
                <th>Type</th>
                <th>Serial Number</th>
                <th>Location/Room</th>
                <th>Planning Date</th>
                <th>Implementation Date</th>
                <th>Executor</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($tasks['data'] as $task) { ?>

                <?php foreach ($task['propTaskMaintenance'] as $propTaskMaintenance) { ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <?php if ($task['propProgress']['progressStatus'] == "NEW-ASSIGNED") { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/cross.png'); ?>" style="width:15px; display:block; margin:0 auto;"></td>
                        <?php } else if ($task['propProgress']['progressStatus'] == "NEW-ASSIGNED-STARTED-FINISHED") { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/check_red.png'); ?>" style="height:15px; display:block; margin:0 auto;"></td>
                        <?php } else { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/check.png'); ?>" style="height:15px; display:block; margin:0 auto;"></td>
                        <?php } ?>
                        <td><?php echo $propTaskMaintenance['propAsset']['assetCode']; ?></td>
                        <td><?php echo $propTaskMaintenance['propAsset']['assetName']; ?></td>
                        <td><?php echo $propTaskMaintenance['propAsset']['propAssetPropgenit']['merk'] == "" ? "-" : $propTaskMaintenance['propAsset']['propAssetPropgenit']['merk']; ?></td>
                        <td><?php echo $propTaskMaintenance['propAsset']['propAssetPropgenit']['tipe'] == "" ? "-" : $propTaskMaintenance['propAsset']['propAssetPropgenit']['tipe']; ?></td>
                        <td><?php echo $propTaskMaintenance['propAsset']['propAssetPropgenit']['serialNumber'] == "" ? "-" : $propTaskMaintenance['propAsset']['propAssetPropgenit']['serialNumber']; ?></td>
                        <td><?php echo $propTaskMaintenance['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'] == "" ? "-" : $propTaskMaintenance['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></td>
                        <td><?php echo $task['propSchedule']['scheduleStart'] == "" ? "-" : date('Y-m-d', strtotime($task['propSchedule']['scheduleStart']));; ?></td>
                        <td><?php echo $task['propProgress']['timeFinish'] == "" ? "-" : date('Y-m-d', strtotime($task['propProgress']['timeFinish'])); ?></td>
                        <td><?php echo $task['propProgress']['finishBy']; ?></td>
                        <td><?php echo $propTaskMaintenance['propForm']['finalResult']; ?></td>
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