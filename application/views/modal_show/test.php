<?php $this->load->view('header') ?>
<?php
$current_d = date('d');
$current_m = date('m');
$current_y = date('Y');

$inc = 1;
?>

<style type="text/css">
    html,
    body {
        background: #fff !important;
    }

    #tab {
        position: relative;
    }

    #tab .tab-header {
        position: absolute;
        top: 0;
        left: 0;
    }

    #tab .tab-header a {
        color: #0000ff;
        display: block;
        float: left;
        padding: 5px 10px;
        border: 1px solid #ccc;
        text-decoration: none;
        background-color: #f0f0f0;
    }

    #tab .tab-header a:hover {
        background-color: #fff;
        border-bottom: 1px solid #ccc;
    }

    #tab .tab-header a.tab-active {
        background-color: #fff;
        border-bottom: 1px solid #fff;
    }

    #tab .tab-content {
        border-top: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }

    #tab .tab-content .padd {
        padding: 6px;
    }

    .t tr td {
        padding-bottom: 2px;
    }

    .s {
        text-align: center;
        width: 30px;
    }
</style>

<h1 style="text-align:left; margin:5px 0 10px; font-size:18px; font-weight:bold; color: #000080;">REMINDER</h1>

<div id="tab">
    <div class="tab-header">
        <a href="<?php echo site_url('calibration_notification') ?>" class="tab-header-item tab-active">Kalibrasi Alat Medik</a>
        <a href="<?php echo site_url('maintenance_notification') ?>" class="tab-header-item">Maintenance Alat Medik</a>
        <a href="<?php echo site_url('calibration_notification_nm') ?>" class="tab-header-item">Kalibrasi Alat Non Medik</a>
        <?php /* <a href="<?php echo site_url('nm_maintenance_notification') ?>" class="tab-header-item">Maintenance Non Alat Medik</a> */ ?>
        <div style="clear:both;"></div>
    </div>
    <div class="tab-content">
        <div class="tab-content-item">
            <div class="padd">
                <table class="grid1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Masa Berlaku Sertifikat</th>
                            <th>Mulai Tgl</th>
                            <th>Sampai Tgl</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?>">More than 3 months</a></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?></td>
                            <td>-</td>
                            <td><?= $mtn_med['reminderMore']['remCount']; ?></td>
                        </tr>
                        <tr>
                            <td>2. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?>">2 - 3 Months to go</a></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?></td>
                            <td><?= $mtn_med['reminder3Month']['remCount']; ?></td>
                        </tr>
                        <tr>
                            <td>3. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?>">1 - 2 Months to go</a></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?></td>
                            <td><?= $mtn_med['reminder2Month']['remCount']; ?></td>
                        </tr>
                        <tr>
                            <td>4. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?>">15 - 30 Days left</a></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?></td>
                            <td><?= $mtn_med['reminderMonth']['remCount']; ?></td>
                        </tr>
                        <tr>
                            <td>5. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?>">1 - 14 Days left</a></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?></td>
                            <td><?= $mtn_med['reminder2W']['remCount']; ?></td>
                        </tr>
                        <tr>
                            <td>6. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Today</a></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                            <td><?= $mtn_med['reminderToday']['remCount']; ?></td>
                        </tr>
                        <tr>
                            <td>7. </td>
                            <td><a href="javascript:void(0)" class="medcal-btn" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Missed</a></td>
                            <td>-</td>
                            <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                            <td><?= $mtn_med['reminderLate']['remCount']; ?></td>
                        </tr>
                    </tbody>
                </table>
                <br />
                <table class="grid2">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA ALAT</th>
                            <th>MERK</th>
                            <th>TIPE</th>
                            <th>NO.SERI</th>
                            <th>RUANGAN</th>
                            <th>KALIBRASI TERAKHIR</th>
                            <th>JATUH TEMPO</th>
                            <th>PELAKSANA</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <br>
                <p><a href="javascript:void(0)" onclick="popup_window('<?php echo site_url($this->uri->uri_string()) ?>?p=1', 'CETAK', 800, 600, false)">Cetak</a></p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#tab').css({
            'padding-top': $('.tab-header').height() - 1
        });
        $('.grid1').fixheadertable({
            width: 865,
            height: 130,
            resizeCol: true,
            colratio: [50, 200, 150, 150, 100]
        });
    });
    jQuery(document).ready(function() {
        $('.grid2').fixheadertable({
            width: 865,
            height: 200,
            resizeCol: true,
            colratio: [50, 200, 150, 150, 100, 100, 100, 100, 100]
        });
    });
</script>

<?php $this->load->view('footer') ?>