<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        table,
        td,
        th {
            border: 1px solid black;
        }

        h4 {
            text-align: center;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .child {
            background: yellow;
        }
    </style>
    <title>REPORT TASK STOCK OPNAME</title>
</head>

<body>
    <h2 style="text-align: center;">REPORT TASK STOCK OPNAME</h2>
    <table border="1" width="50%">
        <thead>
            <tr>
                <th style="width:70px !important">No</th>
                <th>Task Name</th>
                <th>Task Desc</th>
                <th>Schedule Start</th>
                <th>Schedule End</th>
                <th>Task Kpi</th>
                <th>Task Amount</th>
                <th style="width:70px !important">Scanned</th>
                <th style="width:70px !important">Not Scanned</th>
                <th style="width:70px !important">Total Asset</th>
                <!-- <th></th> -->
            </tr>
        </thead>
        <tbody>
            <?php if (sizeof($tasks) > 0) { ?>
                <?php $no = 1;
                foreach ($tasks['data'] as $task) { ?>
                    <tr>
                        <td style="width:70px !important">
                            <p class="text-center"><?php echo $no++; ?></p>
                        </td>
                        <td class="text-center"><?php echo $task['taskName']; ?></td>
                        <td class="text-center"><?php echo $task['taskDesc']; ?></td>
                        <td>
                            <p class="text-center"><?php echo $task['propSchedule']['scheduleStart']; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $task['propSchedule']['scheduleEnd']; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $task['taskKpi']; ?></p>
                        </td>
                        <td>
                            <p class="text-center"><?php echo $task['taskAmount']; ?></p>
                        </td>
                        <td style="width:70px !important">
                            <p class="text-center"><?php echo $task['scanned']; ?></p>
                        </td>
                        <td style="width:70px !important">
                            <p class="text-center"><?php echo $task['notScanned']; ?></p>
                        </td>
                        <td style="width:70px !important">
                            <p class="text-center"><?php echo $task['totalAsset']; ?></p>
                        </td>
                        <!-- <td></td> -->
                    </tr>


                <?php } ?>
            <?php } ?>
        </tbody>
    </table>
    <br>
    <?php foreach ($tasks['data'] as $task) { ?>
        <?php if (isset($task['propTaskStockopname'][0]['propTaskStockopnameDetail'])) { ?>
            <?php if (count($task['propTaskStockopname'][0]['propTaskStockopnameDetail']) > 0) { ?>
                <table border="1" width="50%">
                    <thead>
                        <tr class="child">
                            <th style="width:70px !important">No</th>
                            <th>Label Code</th>
                            <th>Asset Code</th>
                            <th colspan="3">Asset Name</th>
                            <th>Checked</th>
                            <th>Room</th>
                            <th>Checked By </th>
                            <th>Checked Time </th>
                            <th>Price </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($task['propTaskStockopname'] as $propTaskStockopname) { ?>
                            <?php $number = 1;
                            foreach ($propTaskStockopname['propTaskStockopnameDetail'] as $propTaskStockopnameDetail) { ?>
                                <tr>
                                    <td style="width:70px !important">
                                        <p class="text-center"><?php echo $number++; ?></p>
                                    </td>
                                    <td><?php echo $propTaskStockopnameDetail['propAsset']['kodeBar']; ?></td>
                                    <td>
                                        <p class="text-center"><?php echo $propTaskStockopnameDetail['propAsset']['catCode'] . '-' . $propTaskStockopnameDetail['propAsset']['idAsset']; ?></p>
                                    </td>
                                    <td colspan="3"><?php echo $propTaskStockopnameDetail['propAsset']['assetName']; ?></td>
                                    <td>
                                        <?php if ($propTaskStockopnameDetail['isChecked'] == true) { ?>
                                            <p class="text-center">YES</p>
                                        <?php } else { ?>
                                            <p class="text-center">NO</p>
                                        <?php } ?>
                                    </td>
                                    <td style="width:70px !important"><?php echo $propTaskStockopnameDetail['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName']; ?></td>
                                    <td><?php echo $propTaskStockopnameDetail['checkedByName']; ?></td>
                                    <td><?php echo $propTaskStockopnameDetail['checkedTime']; ?></td>
                                    <td>
                                        <p class="text-center"><?php echo $propTaskStockopnameDetail['propAsset']['propAssetPropadmin']['priceBuy']; ?></p>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>
        <?php } ?>
    <?php } ?>

</body>

</html>