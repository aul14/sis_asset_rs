<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=report_task_stockopname.xls");
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

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
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
                <h1>REPORT TASK STOCK OPNAME</h1>
            </div>
            <br>

            <br>
            <table border="1">
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
                        <th></th>
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
                                <td></td>
                            </tr>


                        <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
            <br>
            <?php foreach ($tasks['data'] as $task) { ?>
                <?php if (isset($task['propTaskStockopname'][0]['propTaskStockopnameDetail'])) { ?>
                    <?php if (count($task['propTaskStockopname'][0]['propTaskStockopnameDetail']) > 0) { ?>
                        <table border="1">
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