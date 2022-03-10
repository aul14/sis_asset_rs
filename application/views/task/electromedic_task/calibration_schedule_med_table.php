<?php
$VIEW_MONTH = 1;

$day = 1;
$month = $this->input->get('month') != "" ? (int) $this->input->get('month') : date("n");
$year = $this->input->get('years') != "" ? (int) $this->input->get('years') : (int) date("Y");

$prev_month_y = date("Y", mktime(0, 0, 0, $month - 1, 1, $year));
$prev_month_m = date("m", mktime(0, 0, 0, $month - 1, 1, $year));
$next_month_y = date("Y", mktime(0, 0, 0, $month + 1, 1, $year));
$next_month_m = date("m", mktime(0, 0, 0, $month + 1, 1, $year));



?>
<main dir="ltr" class="page-wrapper full-height" id="App">
  <main-app>
    <action-button-card title="Electromedic Task - Calibration Schedule Table" with-search="false">
      <template v-slot:buttons>
        <schedule-init></schedule-init>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['subMenu4'][0]['isAllow'] == true) : ?>
          <previous data-form="getForm" link="<?php echo site_url('task/med/calibration/schedule_table') ?>?years=<?php echo $prev_month_y ?>&month=<?php echo $prev_month_m ?>"></previous>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['subMenu4'][1]['isAllow'] == true) : ?>
          <next data-form="getForm" link="<?php echo site_url('task/med/calibration/schedule_table') ?>?years=<?php echo $next_month_y ?>&month=<?php echo $next_month_m ?>"></next>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['subMenu4'][2]['isAllow'] == true) : ?>
          <print-data modal="task_print"></print-data>
        <?php endif; ?>
        <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['subMenu4'][3]['isAllow'] == true) : ?>
          <table-advance-search overlay="advanced_search"></table-advance-search>
        <?php endif; ?>
      </template>
      <template v-slot:content>
        <form method="GET" id="getForm">
          <input type="hidden" name="scheduleSysCat" value="<?= $scheduleSysCat; ?>">
          <schedule-search>

          </schedule-search>
        </form>
      </template>
    </action-button-card>
    <schedule-view-card>
      <template v-slot:schedule-content>
        <table class="samrs-table2 table samrs-tableview capitalize">
          <thead>
            <tr>
              <th rowspan="3">No</th>
              <th rowspan="3">Assets Code</th>
              <th rowspan="3">Assets Name</th>
              <th rowspan="3">Rooms</th>
              <?php
              $dayofmonth = 0;
              for ($i = $month; $i < $month + $VIEW_MONTH; $i++) {
                $dayofmonth = $dayofmonth + date(
                  "t",
                  mktime(0, 0, 0, $i, 1, $year)
                );
              }
              ?>
              <th colspan="<?php echo $dayofmonth ?>">MONTH - YEAR</th>
            </tr>
            <tr>
              <?php for ($i = $month; $i < $month + $VIEW_MONTH; $i++) { ?>
                <?php
                $dayofmonth = date("t", mktime(0, 0, 0, $i, 1, $year));
                ?>
                <th colspan="<?php echo $dayofmonth ?>"><?php echo strtoupper($BULAN[$i]) . " - " . $year ?></th>
              <?php } ?>
            </tr>
            <?php for ($i = $month; $i < $month + $VIEW_MONTH; $i++) { ?>
              <?php
              $dayofmonth = date("t", mktime(0, 0, 0, $i, 1, $year));
              ?>
              <?php for ($j = 1; $j <= $dayofmonth; $j++) { ?>
                <th><?php echo $j ?></th>
            <?php
              }
            }
            ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($schedule as $key => $val) : ?>
              <tr>
                <td><?= $key + 1; ?></td>
                <td><?= $val['assetCode']; ?></td>
                <td><?= $val['assetName']; ?></td>
                <td><?= $val['roomName']; ?></td>
                <?php for ($i = $month; $i < $month + $VIEW_MONTH; $i++) :
                  $dayofmonth = date(
                    "t",
                    mktime(0, 0, 0, $i, 1, $year)
                  ); ?>
                  <?php for ($j = 1; $j <= $dayofmonth; $j++) :
                    $date = date('Y-m-d', strtotime($val['start']));
                    if ($val['progressStatus'] == "NEW") {
                      $style = 'style="' . ($j == substr($date, -2) ? "background-color:var(--samrs-danger);position:relative;" : "") . '"';
                      $_info = $date;
                    } else {
                      $style = 'style="' . ($j == substr($date, -2) ? "background-color:var(--samrs-blue);position:relative;" : "") . '"';
                      $_info = $date;
                    }


                    $adajadwal = ''; ?>
                    <td <?php echo $style ?> title="<?php echo $_info ?>">&nbsp;</td>
                  <?php endfor; ?>
                <?php endfor; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </template>
    </schedule-view-card>
  </main-app>
</main>
<script>
  function ScheduleTable() {
    var schedule = $('.samrs-table2').DataTable({
      retrieve: true,
      dom: 'rt<"table-pagination" p>',
      searching: false,
      ordering: false,
      bSort: false,
      scrollX: true,
      scrollY: "45vh",
      pageLength: 20,
    });
    return schedule;
  }
</script>