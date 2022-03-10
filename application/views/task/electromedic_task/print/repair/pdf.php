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
    <title>REPORT TASK REPAIR</title>
</head>

<body>
    <h2 style="text-align: center;">REPORT TASK REPAIR</h2>
    <table border="1" width="50%" autosize="1">
        <thead>
            <tr>
                <th align="center">No</th>
                <th align="center">Status</th>
                <th align="center">Code Complain</th>
                <th align="center">Asset Code</th>
                <th align="center">Asset Name</th>
                <th align="center">Merk</th>
                <th align="center">Type</th>
                <th align="center">Serial Number</th>
                <th align="center">Location/Room</th>
                <th align="center">Complain Date</th>
                <th align="center">Repair Date</th>
                <th align="center">Complain Duration</th>
                <th align="center">Technician</th>
                <th align="center">Vendor/Supplier</th>
                <th align="center">Informant</th>
                <th align="center">Complain Description</th>
                <th align="center">Repair Description</th>
                <th align="center">Result</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;

            function differenceTimestamps($timestamps1, $timestamps2)
            {
                $datetime1 = new DateTime($timestamps1); //start time
                $datetime2 = new DateTime($timestamps2); //end time
                $interval = $datetime1->diff($datetime2);

                $get_years = $interval->format('%Y');
                $get_months = $interval->format('%m');
                $get_days = $interval->format('%d');
                $get_hours = $interval->format('%H');
                $get_minutes = $interval->format('%i');

                $years = $get_years != 00 ? $get_years . ' years' : '';
                $months = $get_months != 0 ? $get_months . ' months' : '';
                $days = $get_days != 0 ? $get_days . ' days' : '';
                $hours = $get_hours != 00 ? $get_hours . ' hours' : '';
                $minutes = $get_minutes != 0 ? $get_minutes . ' minutes' : '';

                return $interval->format("{$years} {$months} {$days} {$hours} {$minutes}"); //00 years 0 months 0 days 00 hours 0 minutes 0 seconds
            }


            foreach ($tasks['data'] as $task) :
                $time_finish = $task['propProgress']['timeFinish'] == '' ? date('Y-m-d H:i:s') : $task['propProgress']['timeFinish'];
            ?>
                <?php foreach ($task['propTaskRepair'] as $propTaskRepair) { ?>
                    <tr>
                        <td align="center"><?= $no++; ?></td>
                        <?php if ($task['propProgress']['progressStatus'] == "NEW") { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/cross.png'); ?>" style="width:50px; display:block; margin:0 auto;"></td>
                        <?php } else if ($task['propProgress']['progressStatus'] == "NEW-RESPONDED-ASSIGNED-STARTED-PENDING") { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/pending.png'); ?>" style="height:50px; display:block; margin:0 auto;"></td>
                        <?php } else if ($task['propProgress']['progressStatus'] == "NEW-RESPONDED-ASSIGNED-STARTED-FINISHED" || $task['propProgress']['progressStatus'] == "NEW-RESPONDED-ASSIGNED-STARTED-PENDING-FINISHED") { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/check_red.png'); ?>" style="height:50px; display:block; margin:0 auto;"></td>
                        <?php } else if ($task['propProgress']['progressStatus'] == "NEW-RESPONDED-ASSIGNED-STARTED-FINISHED-APPROVED" || $task['propProgress']['progressStatus'] == "NEW-RESPONDED-ASSIGNED-STARTED-PENDING-FINISHED-APPROVED") { ?>
                            <td align="center"><img src="<?= base_url('assets/images/icon/check.png'); ?>" style="height:50px; display:block; margin:0 auto;"></td>
                        <?php } ?>
                        <td align="justify"><?= "CPL" . "-" . $task['idRelatedTask']; ?></td>
                        <td align="justify"><?= $propTaskRepair['propTaskComplain']['propAsset']['assetCode']; ?></td>
                        <td align="justify"><?= $propTaskRepair['propTaskComplain']['propAsset']['assetName']; ?></td>
                        <td align="justify"><?= $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropgenit']['merk'] == "" ? "-" : $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropgenit']['merk']; ?></td>
                        <td align="justify"><?= $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropgenit']['tipe'] == "" ? "-" : $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropgenit']['tipe']; ?></td>
                        <td align="justify"><?= $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropgenit']['serialNumber'] == "" ? "-" : $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropgenit']['serialNumber']; ?></td>
                        <td align="justify"><?= $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'] == "" ? "-" : $propTaskRepair['propTaskComplain']['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></td>
                        <td align="justify"><?= $task['propProgress']['timeInit']; ?></td>
                        <td align="justify"><?= $task['propProgress']['timeStart']; ?></td>
                        <td align="justify"><?= differenceTimestamps($task['propProgress']['timeInit'], $time_finish); ?></td>
                        <td align="justify"><?= $task['propProgress']['assignTo']; ?></td>
                        <td align="justify"><?= $task['propContact']['contactCompany']; ?></td>
                        <td align="justify"><?= $task['propProgress']['initBy']; ?></td>
                        <td align="justify"><?= $propTaskRepair['repairProblem']; ?></td>
                        <td align="justify"><?= $propTaskRepair['repairNote']; ?></td>
                        <td align="justify"><?= $propTaskRepair['repairResult']; ?></td>
                    </tr>
                <?php } ?>
            <?php endforeach; ?>
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