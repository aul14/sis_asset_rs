<?php
$current_d = date('d');
$current_m = date('m');
$current_y = date('Y');

$ci = &get_instance();

$ci->load->model('m_reminder');

$cal_med = $ci->m_reminder->reminder_med_calibration()['data'];
$cal_non = $ci->m_reminder->reminder_non_calibration()['data'];
$mtn_med = $ci->m_reminder->reminder_med_maintenance()['data'];
$mtn_non = $ci->m_reminder->reminder_non_maintenance()['data'];
?>
<div id="task_reminder" class="modal samrs-modal zoom fade" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="card-title m-auto" samrs-typography="uppercase 700">task reminder</h2>
      </div>
      <div class="modal-body fixed-height only-vertical samrs-form">
        <div id="taskSwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide mr-10">
              <div class="samrs-detail-box mt-20" data-border="primary">
                <label class="detail-title">medical task</label>
                <div class="samrs-pills">
                  <div class="nav nav-pills samrs-flex wrapped is-row in-center" role="tablist" data-color="primary">
                    <a class="nav-link active" data-toggle="pill" href="#calibrationlist"><i class="fas fa-drafting-compass"></i> calibration lists</a>
                    <a class="nav-link" data-toggle="pill" href="#maintenancelist"><i class="fas fa-toolbox"></i> maintenance lists</a>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane mt-10 fade show active" id="calibrationlist">
                      <div class="card is-soft-rounded mb-10" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>certificates validity period</th>
                                <th>start date</th>
                                <th>end date</th>
                                <th>total</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderMore" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?>" data-akhir="9999-12-31">More than 3 months</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?></td>
                                  <td>-</td>
                                  <td><?= $cal_med['reminderMore']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>2. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminder3Month" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?>">2 - 3 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_med['reminder3Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>3. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminder2Month" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?>">1 - 2 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_med['reminder2Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>4. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderMonth" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?>">15 - 30 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_med['reminderMonth']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>5. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminder2W" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?>">1 - 14 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?></td>
                                  <td><?= $cal_med['reminder2W']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>6. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderToday" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Today</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_med['reminderToday']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>7. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderLate" data-syscat="MED" data-code="CAL" class="btn-reminder" data-mulai="" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Missed</a></td>
                                  <td>-</td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_med['reminderLate']['remCount']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="card is-soft-rounded" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>assets name</th>
                                <th>brand</th>
                                <th>type</th>
                                <th>serial number</th>
                                <th>location</th>
                                <th>schedule</th>
                              </thead>

                              <tbody class="tbody-remindercal">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane mt-10 fade" id="maintenancelist">
                      <div class="card is-soft-rounded mb-10" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>maintenance schedule</th>
                                <th>1st interval</th>
                                <th>2nd interval</th>
                                <th>total assets</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderMore" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?>" data-akhir="9999-12-31">More than 3 months</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?></td>
                                  <td>-</td>
                                  <td><?= $mtn_med['reminderMore']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>2. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminder3Month" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?>">2 - 3 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_med['reminder3Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>3. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminder2Month" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?>">1 - 2 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_med['reminder2Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>4. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderMonth" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?>">15 - 30 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_med['reminderMonth']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>5. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminder2W" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?>">1 - 14 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?></td>
                                  <td><?= $mtn_med['reminder2W']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>6. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderToday" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Today</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_med['reminderToday']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>7. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderLate" data-syscat="MED" data-code="MTN" class="btn-reminder" data-mulai="" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Missed</a></td>
                                  <td>-</td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_med['reminderLate']['remCount']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="card is-soft-rounded mb-10" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive" data-color-type="gray">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>assets name</th>
                                <th>brand</th>
                                <th>type</th>
                                <th>serial number</th>
                                <th>location</th>
                                <th>schedule</th>
                              </thead>
                              <tbody class="tbody-remindermtn">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide ml-10">
              <div class="samrs-detail-box mt-20" data-border="primary">
                <label class="detail-title">non medical task</label>
                <div class="samrs-pills">
                  <div class="nav nav-pills samrs-flex wrapped is-row in-center" role="tablist" data-color="primary">
                    <a class="nav-link active" data-toggle="pill" href="#calibrationlistnon"><i class="fas fa-drafting-compass"></i> calibration lists</a>
                    <a class="nav-link" data-toggle="pill" href="#maintenancelistnon"><i class="fas fa-toolbox"></i> maintenance lists</a>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane mt-10 fade show active" id="calibrationlistnon">
                      <div class="card is-soft-rounded mb-10" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>certificates validity period</th>
                                <th>start date</th>
                                <th>end date</th>
                                <th>total</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderMore" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?>" data-akhir="9999-12-31">More than 3 months</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?></td>
                                  <td>-</td>
                                  <td><?= $cal_non['reminderMore']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>2. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminder3Month" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?>">2 - 3 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_non['reminder3Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>3. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminder2Month" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?>">1 - 2 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_non['reminder2Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>4. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderMonth" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?>">15 - 30 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_non['reminderMonth']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>5. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminder2W" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?>">1 - 14 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?></td>
                                  <td><?= $cal_non['reminder2W']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>6. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderToday" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Today</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_non['reminderToday']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>7. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW" data-tipe="reminderLate" data-syscat="NON" data-code="NCAL" class="btn-reminder" data-mulai="" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Missed</a></td>
                                  <td>-</td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $cal_non['reminderLate']['remCount']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="card is-soft-rounded" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>assets name</th>
                                <th>brand</th>
                                <th>type</th>
                                <th>serial number</th>
                                <th>location</th>
                                <th>schedule</th>

                              </thead>
                              <tbody class="tbody-reminderncal">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane mt-10 fade" id="maintenancelistnon">
                      <div class="card is-soft-rounded mb-10" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>maintenance schedule</th>
                                <th>1st interval</th>
                                <th>2nd interval</th>
                                <th>total assets</th>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>1. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderMore" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?>" data-akhir="9999-12-31">More than 3 months</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d + 1, $current_y)); ?></td>
                                  <td>-</td>
                                  <td><?= $mtn_non['reminderMore']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>2. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminder3Month" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?>">2 - 3 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 3, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_non['reminder3Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>3. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminder2Month" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?>">1 - 2 Months to go</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 2, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_non['reminder2Month']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>4. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderMonth" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?>">15 - 30 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 15, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m + 1, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_non['reminderMonth']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>5. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminder2W" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?>">1 - 14 Days left</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 1, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d + 14, $current_y)); ?></td>
                                  <td><?= $mtn_non['reminder2W']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>6. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderToday" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Today</a></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_non['reminderToday']['remCount']; ?></td>
                                </tr>
                                <tr>
                                  <td>7. </td>
                                  <td><a href="javascript:void(0)" data-status="NEW-ASSIGNED" data-tipe="reminderLate" data-syscat="NON" data-code="NMTN" class="btn-reminder" data-mulai="" data-akhir="<?= date("Y-m-d", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?>">Missed</a></td>
                                  <td>-</td>
                                  <td><?= date("d-m-Y", mktime(0, 0, 0, $current_m, $current_d, $current_y)); ?></td>
                                  <td><?= $mtn_non['reminderLate']['remCount']; ?></td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <div class="card is-soft-rounded mb-10" data-color-type="gray">
                        <div class="card-body p-10">
                          <div class="table-responsive" data-color-type="gray">
                            <table class="table samrs-tableview capitalize">
                              <thead>
                                <th>no</th>
                                <th>assets name</th>
                                <th>brand</th>
                                <th>type</th>
                                <th>serial number</th>
                                <th>location</th>
                                <th>schedule</th>
                              </thead>
                              <tbody class="tbody-remindernmtn">

                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="slider-button">
          <button class="prev-slider btn samrs-primary" type="button" name="button"><i class="fas fa-file-medical"></i> Medical</button>
          <button class="next-slider btn samrs-primary" type="button" name="button"><i class="fas fa-clipboard-list"></i> Non Medical</button>
        </div>
        <a class="btn samrs-primary" with-state="skip" href="#" data-dismiss="modal">Skip for now</a>
      </div>
    </div>
  </div>
</div>
<script>
  $(".btn-reminder").click(function(e) {
    e.preventDefault();

    let date_mulai = $(this).data('mulai');
    let date_akhir = $(this).data('akhir');
    let data_syscat = $(this).data('syscat');
    let data_code = $(this).data('code');
    let data_status = $(this).data('status');

    $.ajax({
      type: "POST",
      url: BASE_URL + "reminder/get_reminder",
      data: {
        'date_mulai': date_mulai,
        'date_akhir': date_akhir,
        'data_syscat': data_syscat,
        'data_code': data_code,
        'data_status': data_status
      },
      dataType: "json",
      success: function(data) {
        // console.log(response);
        var html = '';
        var i;
        var no = 1;
        if (data.length > 0) {
          for (i = 0; i < data.length; i++) {
            if (data_code == "CAL" || data_code == "NCAL") {
              html += "<tr>";
              html += '<td>' + no++ + '</td>';
              html += '<td>' + data[i].propTaskCalibration[0].propAsset.assetName + '</td>';
              html += '<td>' + data[i].propTaskCalibration[0].propAsset.propAssetPropgenit.merk + '</td>';
              html += '<td>' + data[i].propTaskCalibration[0].propAsset.propAssetPropgenit.tipe + '</td>';
              html += '<td>' + data[i].propTaskCalibration[0].propAsset.propAssetPropgenit.serialNumber + '</td>';
              html += '<td>' + data[i].propTaskCalibration[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName + " | " + data[i].propTaskCalibration[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.floorName + " | " + data[i].propTaskCalibration[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.buildingName + '</td>';
              html += '<td>' + data[i].propSchedule.scheduleStart + '</td>';
              html += "</tr>";
            } else {
              html += "<tr>";
              html += '<td>' + no++ + '</td>';
              html += '<td>' + data[i].propTaskMaintenance[0].propAsset.assetName + '</td>';
              html += '<td>' + data[i].propTaskMaintenance[0].propAsset.propAssetPropgenit.merk + '</td>';
              html += '<td>' + data[i].propTaskMaintenance[0].propAsset.propAssetPropgenit.tipe + '</td>';
              html += '<td>' + data[i].propTaskMaintenance[0].propAsset.propAssetPropgenit.serialNumber + '</td>';
              html += '<td>' + data[i].propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.roomName + " | " + data[i].propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.floorName + " | " + data[i].propTaskMaintenance[0].propAsset.propAssetPropadmin.propAssetPropbuildingRoom.buildingName + '</td>';
              html += '<td>' + data[i].propSchedule.scheduleStart + '</td>';
              html += "</tr>";
            }

          }

          if (data_code == "CAL") {
            $('.tbody-remindercal').html(html);
          } else if (data_code == "MTN") {
            $('.tbody-remindermtn').html(html);
          } else if (data_code == "NCAL") {
            $('.tbody-reminderncal').html(html);
          } else {
            $('.tbody-remindernmtn').html(html);
          }
        } else {
          for (i = 0; i < data.length; i++) {
            html += "<tr>";
            html += '<td colspan="6">"Data is Null"</td>';
            html += "</tr>";
          }
          if (data_code == "CAL") {
            $('.tbody-remindercal').html(html);
          } else if (data_code == "MTN") {
            $('.tbody-remindermtn').html(html);
          } else if (data_code == "NCAL") {
            $('.tbody-reminderncal').html(html);
          } else {
            $('.tbody-remindernmtn').html(html);
          }
        }
      }
    });

  });
  if (sessionStorage.getItem('reminder') != 1) {
    window.setTimeout(function() {
      $('#task_reminder').modal('show');
      sessionStorage.setItem('reminder', 1);
    }, 1000);
  }
  const swiper = new Swiper('#taskSwiper', {
    // Optional parameters
    direction: 'horizontal',
    loop: false,
    // Navigation arrows
    navigation: {
      nextEl: ".next-slider",
      prevEl: ".prev-slider",
    }

  });
</script>