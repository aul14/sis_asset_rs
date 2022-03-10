<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>REPORT INVENTORY ROOM</title>
    <link href="<?php echo base_url('assets') ?>/main-ui/samrs-custom-ui/css/samrs-report-ui.css?v=1.2" rel='stylesheet'>
</head>

<body>
    <h2>REPORT INVENTORY ROOM</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ROOM CODE</th>
                <th>ROOM NAME</th>
                <th>FLOOR</th>
                <th>BUILDING NAME</th>
                <th>BUILDING AREA</th>
                <th>BED</th>
                <th>ELECTRICAL POWER</th>

                <!-- <th>WARRANTY EXPIRED</th> -->
                <!-- <th>CREATED DATE</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($assets['data'] as $asset) { ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $asset['roomCode']; ?></td>
                    <td><?php echo $asset['roomName']; ?></td>
                    <td><?php echo $asset['floorName']; ?></td>
                    <td><?php echo $asset['buildingName']; ?></td>
                    <td><?php echo $asset['roomSpace'] . ' ' . $asset['spaceUnit']; ?></td>
                    <td><?php echo $asset['bedCount']; ?></td>
                    <td><?php echo $asset['roomPower'] . ' ' . $asset['powerUnit']; ?></td>


                    <!-- <td><?php echo $asset['createDate']; ?></td> -->
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
