<!-- Start Content Tags -->
<div id="main-wrapper">
  <!-- Header -->
  <header class="topbar" id="header_main">

    <header-main is-light="yes" brand-logo="<?= base_url(); ?>assets/images/logos/samrs.png" company-logo="<?= base_url(); ?>/assets/images/logos/hospital_logo.png">

      <template v-slot:notification>
        <li class="nav-item dropdown samrs-dropdown" dropdown-style="bounce">
          <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="font-18 fas fa-bell"></i>
            <?php if (count($notif) != 0) : ?>
              <div class="notify">
                <span class="heartbit"></span>
                <span class="point"></span>
              </div>
            <?php endif; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right mailbox" aria-labelledby="2">

            <ul class="list-style-none">
              <li>
                <div class="drop-title border-bottom">You have <?= count($notif); ?> new notification</div>
              </li>
              <li>
                <div class="message-center message-body">
                  <a class="message-item samrs-flex wrapped is-row in-center" href="javascript:void(0)" data-toggle="modal" data-target="#task_reminder">
                    <span class="user-img">
                      <button class="btn btn-sm samrs-info" type="button" name="button"><i class="fas fa-history"></i></button>
                    </span>
                    <span class="pl-10">
                      Task Reminder
                    </span>
                  </a>
                  </a>
                  <?php if (sizeof($notif) > 0) : ?>
                    <?php foreach ($notif as $data) : ?>
                      <!-- Message -->
                      <a href="javascript:void(0)" class="message-item">
                        <?php if ($data['actionRequired'] == true) : ?>
                          <span class="user-img">
                            <button type="button" id="btn-seedata" data-id="<?= $data['idNotif']; ?>" class="btn btn-sm samrs-primary" title="See Data"><i class="fas fa-eye"></i></button>
                          </span>
                        <?php endif; ?>
                        <span class="user-img">
                          <button type="button" id="btn-readdata" data-id="<?= $data['idNotif']; ?>" class="btn btn-sm samrs-success" title="Read Data"><i class="fas fa-check"></i></button>
                        </span>
                        <span class="mail-contnet">
                          <h5 class="message-title"><?= $data['notifTitle']; ?></h5> <span class="mail-desc"><?= $data['notifMessage']; ?></span> <span class="time"><?= date('Y-m-d', strtotime($data['notifTime'])); ?></span>
                        </span>
                      </a>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </li>
              <!-- <li>
                <a class="nav-link text-center link text-dark" href="javascript:void(0);"> <b>See all Notifications</b> <i class="fa fa-angle-right"></i> </a>
              </li> -->
            </ul>

          </div>
        </li>
      </template>
    </header-main>
  </header>
  <!-- /Header -->
  <script>
    new Vue({
      el: '#header_main',
      components: {
        'header-main': httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/header.vue'),
      }
    });
  </script>

  <!-- Sidebar -->
  <aside class="left-sidebar" id="sidebarColor">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" id="sidebar_main">
      <nav class="sidebar-nav">
        <ul id="sidebarnav">
          <!-- sidebar dashboard -->
          <li class="sidebar-item">
            <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
              <i class="fas fa-tachometer-alt"></i>
              <span class="hide-menu">Dashboard</span>
            </a>
            <!-- sidebar level -->
            <ul class="collapse first-level">
              <li class="sidebar-item">
                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>dashboard/home">
                  <i class="fas fa-laptop"></i>
                  <span class="hide-menu">Home</span>
                </a>
              </li>
              <?php if ($result_role[0]['subMenu1'][2]['menuCode'] == "D.BLD" && $result_role[0]['subMenu1'][2]['isAllow'] == true) : ?>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>dashboard/building?dashboard=assets&years=<?= date('Y'); ?>">
                    <i class="fas fa-hospital"></i>
                    <span class="hide-menu">Building Dashboard</span>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($result_role[0]['subMenu1'][2]['menuCode'] == "D.BLD" && $result_role[0]['subMenu1'][0]['isAllow'] == true) : ?>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>dashboard/med?dashboard=assets&years=<?= date('Y'); ?>">
                    <i class="fas fa-notes-medical"></i>
                    <span class="hide-menu">Medical Dashboard</span>
                  </a>
                </li>
              <?php endif; ?>
              <?php if ($result_role[0]['subMenu1'][2]['menuCode'] == "D.BLD" && $result_role[0]['subMenu1'][1]['isAllow'] == true) : ?>
                <li class="sidebar-item">
                  <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>dashboard/non?dashboard=assets&years=<?= date('Y'); ?>">
                    <i class="fas fa-clipboard-list"></i>
                    <span class="hide-menu">Non Medical Dashboard</span>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
          <?php if ($result_role[1]['menuCode'] == "A" && $result_role[1]['isAllow'] == true) : ?>
            <!-- sidebar asset -->
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                <i class="fas fa-cubes"></i>
                <span class="hide-menu">Assets</span>
              </a>
              <!-- sidebar level -->
              <ul class="collapse first-level">
                <?php if ($result_role[1]['subMenu1'][2]['menuCode'] == "A.BLD" && $result_role[1]['subMenu1'][2]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-hospital"></i>
                      <span class="hide-menu">Building</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][0]['menuCode'] == "A.BLD.INV" && $result_role[1]['subMenu1'][2]['subMenu2'][0]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/building/inventory_bld">
                            <i class="fas fa-building"></i>
                            <span class="hide-menu">Building Inventory</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['menuCode'] == "A.BLD.ROM" && $result_role[1]['subMenu1'][2]['subMenu2'][1]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/building/room_bld">
                            <i class="fas fa-bed"></i>
                            <span class="hide-menu">Room</span>
                          </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?>
                <!--  -->
                <?php if ($result_role[1]['subMenu1'][0]['menuCode'] == "A.MED" && $result_role[1]['subMenu1'][0]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-file-medical"></i>
                      <span class="hide-menu">Medical Equipment</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "A.MED.INV" && $result_role[1]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/me/inventory_me">
                            <i class="fas fa-archive"></i>
                            <span class="hide-menu">Inventory</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "A.MED.SPT_DSE" && $result_role[1]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/me/sparepart_med">
                            <i class="fas fa-wrench"></i>
                            <span class="hide-menu">Sparepart & Disposable</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][2]['menuCode'] == "A.MED.TLS_MTR" && $result_role[1]['subMenu1'][0]['subMenu2'][2]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/me/tools_med">
                            <i class="fas fa-toolbox"></i>
                            <span class="hide-menu">Tools & Metes</span>
                          </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?>
                <!--  -->
                <?php if ($result_role[1]['subMenu1'][1]['menuCode'] == "A.NON" && $result_role[1]['subMenu1'][1]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-file-medical"></i>
                      <span class="hide-menu">Non-Medical Equipment</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['menuCode'] == "A.NON.INV" && $result_role[1]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/non/inventory_non">
                            <i class="fas fa-archive"></i>
                            <span class="hide-menu">Inventory</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][1]['menuCode'] == "A.NON.SPT_DSE" && $result_role[1]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/non/sparepart_non">
                            <i class="fas fa-wrench"></i>
                            <span class="hide-menu">Sparepart & Disposable</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][2]['menuCode'] == "A.NON.TLS_MTR" && $result_role[1]['subMenu1'][1]['subMenu2'][2]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>asset/non/tools_non">
                            <i class="fas fa-toolbox"></i>
                            <span class="hide-menu">Tools & Metes</span>
                          </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if ($result_role[2]['menuCode'] == "T" && $result_role[2]['isAllow'] == true) : ?>
            <!-- sidebar task -->
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                <i class="fas fa-clipboard-list"></i>
                <span class="hide-menu">Task</span>
              </a>
              <!-- sidebar level -->
              <ul class="collapse first-level">
                <!--  -->
                <?php if ($result_role[2]['subMenu1'][0]['menuCode'] == "T.MED" && $result_role[2]['subMenu1'][0]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-file-medical"></i>
                      <span class="hide-menu">Electromedic Task</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "CAL" && $result_role[2]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                            <i class="fas fa-drafting-compass"></i>
                            <span class="hide-menu">Calibration</span>
                          </a>
                          <!-- sidebar level -->
                          <ul class="collapse third-level">
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['menuCode'] == "T.MED.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/med/calibration/schedule_report">
                                  <i class="fas fa-calendar-check"></i>
                                  <span class="hide-menu">Schedule & Report</span>
                                </a>
                              </li>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['menuCode'] == "T.MED.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/med/calibration/schedule_table">
                                  <i class="fas fa-calendar-alt"></i>
                                  <span class="hide-menu">Schedule Table</span>
                                </a>
                              </li>
                            <?php endif; ?>
                          </ul>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "INP" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                            <i class="fas fa-check"></i>
                            <span class="hide-menu">Inspection</span>
                          </a>
                          <!-- sidebar level -->
                          <ul class="collapse third-level">
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['menuCode'] == "T.MED.INS.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/med/inspection/schedule_report">
                                  <i class="fas fa-calendar-check"></i>
                                  <span class="hide-menu">Schedule & Report</span>
                                </a>
                              </li>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['menuCode'] == "T.MED.INS.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/med/inspection/schedule_table">
                                  <i class="fas fa-calendar-alt"></i>
                                  <span class="hide-menu">Schedule Table</span>
                                </a>
                              </li>
                            <?php endif; ?>
                          </ul>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['menuCode'] == "MTN" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                            <i class="fas fa-toolbox"></i>
                            <span class="hide-menu">Maintenace</span>
                          </a>
                          <!-- sidebar level -->
                          <ul class="collapse third-level">
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][0]['menuCode'] == "T.MED.MTC.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][0]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/med/maintenance/schedule_report">
                                  <i class="fas fa-calendar-check"></i>
                                  <span class="hide-menu">Schedule & Report</span>
                                </a>
                              </li>
                            <?php endif ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][1]['menuCode'] == "T.MED.MTC.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][1]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/med/maintenance/schedule_table">
                                  <i class="fas fa-calendar-alt"></i>
                                  <span class="hide-menu">Schedule Table</span>
                                </a>
                              </li>
                            <?php endif; ?>
                          </ul>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][3]['menuCode'] == "MUT" && $result_role[2]['subMenu1'][0]['subMenu2'][3]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/med/mutation">
                            <i class="fas fa-copy"></i>
                            <span class="hide-menu">Mutation</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['menuCode'] == "CPL" && $result_role[2]['subMenu1'][0]['subMenu2'][4]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/med/complain">
                            <i class="fas fa-bullhorn"></i>
                            <span class="hide-menu">Complain</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][5]['menuCode'] == "RPR" && $result_role[2]['subMenu1'][0]['subMenu2'][5]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/med/repair">
                            <i class="fas fa-tools"></i>
                            <span class="hide-menu">Repair</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                    </ul>
                  </li>
                <?php endif; ?>
                <!--  -->
                <?php if ($result_role[2]['subMenu1'][1]['menuCode'] == "T.NON" && $result_role[2]['subMenu1'][1]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-clipboard-list"></i>
                      <span class="hide-menu">Non-Electromedic Task</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][0]['menuCode'] == "NCAL" && $result_role[2]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                            <i class="fas fa-drafting-compass"></i>
                            <span class="hide-menu">Calibration</span>
                          </a>
                          <!-- sidebar level -->
                          <ul class="collapse third-level">
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][0]['menuCode'] == "T.NON.CAL.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][0]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/non/calibration/schedule_report">
                                  <i class="fas fa-calendar-check"></i>
                                  <span class="hide-menu">Schedule & Report</span>
                                </a>
                              </li>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][1]['menuCode'] == "T.NON.CAL.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][1]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/non/calibration/schedule_table">
                                  <i class="fas fa-calendar-alt"></i>
                                  <span class="hide-menu">Schedule Table</span>
                                </a>
                              </li>
                            <?php endif; ?>
                          </ul>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['menuCode'] == "NINP" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                            <i class="fas fa-check"></i>
                            <span class="hide-menu">Inspection</span>
                          </a>
                          <!-- sidebar level -->
                          <ul class="collapse third-level">
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][0]['menuCode'] == "T.NON.INS.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/non/inspection/schedule_report">
                                  <i class="fas fa-calendar-check"></i>
                                  <span class="hide-menu">Schedule & Report</span>
                                </a>
                              </li>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][1]['menuCode'] == "T.NON.INS.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/non/inspection/schedule_table">
                                  <i class="fas fa-calendar-alt"></i>
                                  <span class="hide-menu">Schedule Table</span>
                                </a>
                              </li>
                            <?php endif; ?>
                          </ul>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['menuCode'] == "NMTN" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                            <i class="fas fa-toolbox"></i>
                            <span class="hide-menu">Maintenace</span>
                          </a>
                          <!-- sidebar level -->
                          <ul class="collapse third-level">
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['menuCode'] == "T.NON.MTC.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/non/maintenance/schedule_report">
                                  <i class="fas fa-calendar-check"></i>
                                  <span class="hide-menu">Schedule & Report</span>
                                </a>
                              </li>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][1]['menuCode'] == "T.NON.MTC.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][1]['isAllow'] == true) : ?>
                              <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>task/non/maintenance/schedule_table">
                                  <i class="fas fa-calendar-alt"></i>
                                  <span class="hide-menu">Schedule Table</span>
                                </a>
                              </li>
                            <?php endif; ?>
                          </ul>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['menuCode'] == "NMUT" && $result_role[2]['subMenu1'][1]['subMenu2'][3]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/non/mutation">
                            <i class="fas fa-copy"></i>
                            <span class="hide-menu">Mutation</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][4]['menuCode'] == "NCPL" && $result_role[2]['subMenu1'][1]['subMenu2'][4]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/non/complain">
                            <i class="fas fa-bullhorn"></i>
                            <span class="hide-menu">Complain</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <!--  -->
                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][5]['menuCode'] == "NRPR" && $result_role[2]['subMenu1'][1]['subMenu2'][5]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/non/repair">
                            <i class="fas fa-tools"></i>
                            <span class="hide-menu">Repair</span>
                          </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?>
                <!--  -->
                <?php if ($result_role[2]['subMenu1'][2]['menuCode'] == "SOM" && $result_role[2]['subMenu1'][2]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url() ?>task/stock_opname">
                      <i class="fas fa-archive"></i>
                      <span class="hide-menu">Inventory Opname</span>
                    </a>
                  </li>
                <?php endif; ?>
                <!--  -->
              </ul>
            </li>
          <?php endif; ?>
          <!-- sidebar files -->
          <?php if ($result_role[3]['menuCode'] == "F" && $result_role[3]['isAllow'] == true) : ?>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                <i class="fas fa-folder-open"></i>
                <span class="hide-menu">Files</span>
              </a>
              <!-- sidebar level -->
              <ul class="collapse first-level">
                <?php if ($result_role[3]['subMenu1'][0]['menuCode'] == "F.FM" && $result_role[3]['subMenu1'][0]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-file-alt"></i>
                      <span class="hide-menu">Forms</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "F.FM.INS" && $result_role[3]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>files/forms/inspection">
                            <i class="fas fa-file-alt"></i>
                            <span class="hide-menu">Inspection</span>
                          </a>
                        </li>
                      <?php endif; ?>
                      <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "F.FM.MTN" && $result_role[3]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
                        <li class="sidebar-item">
                          <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>files/forms/maintenance">
                            <i class="fas fa-cog"></i>
                            <span class="hide-menu">Maintenance</span>
                          </a>
                        </li>
                      <?php endif; ?>
                    </ul>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          <!-- sidebar master data -->
          <?php if ($result_role[4]['menuCode'] == "MD" && $result_role[4]['isAllow'] == true) : ?>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                <i class="fas fa-database"></i>
                <span class="hide-menu">Master Data</span>
              </a>

              <!-- sidebar level -->
              <ul class="collapse first-level">
                <?php if ($result_role[4]['subMenu1'][0]['menuCode'] == "MD.CPI" && $result_role[4]['subMenu1'][0]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/company_information">
                      <i class="fas fa-info-circle"></i>
                      <span class="hide-menu">Company Information</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][1]['menuCode'] == "MD.INS" && $result_role[4]['subMenu1'][1]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/installation">
                      <i class="fas fa-notes-medical"></i>
                      <span class="hide-menu">Installation</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][2]['menuCode'] == "MD.BND" && $result_role[4]['subMenu1'][2]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/brand">
                      <i class="fas fa-clipboard-list"></i>
                      <span class="hide-menu">Brands</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][3]['menuCode'] == "MD.INC" && $result_role[4]['subMenu1'][3]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/inventory_category">
                      <i class="fas fa-file-archive"></i>
                      <span class="hide-menu">Inventory Categories</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][4]['menuCode'] == "MD.INM" && $result_role[4]['subMenu1'][4]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/inventory_master">
                      <i class="fas fa-archive"></i>
                      <span class="hide-menu">Inventory Master</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][5]['menuCode'] == "MD.FNC" && $result_role[4]['subMenu1'][5]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/funding_category">
                      <i class="fas fa-money-check-alt"></i>
                      <span class="hide-menu">Funding Categories</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][6]['menuCode'] == "MD.MSU" && $result_role[4]['subMenu1'][6]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/measurement_unit">
                      <i class="fas fa-tachometer-alt"></i>
                      <span class="hide-menu">Measurement Unit</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][7]['menuCode'] == "MD.ECRI" && $result_role[4]['subMenu1'][7]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/master_ecri">
                      <i class="fas fa-hashtag"></i>
                      <span class="hide-menu">Master ECRI</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][8]['menuCode'] == "MD.SIMAK" && $result_role[4]['subMenu1'][8]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/master_simak">
                      <i class="fas fa-hashtag"></i>
                      <span class="hide-menu">Master SIMAK</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][9]['menuCode'] == "MD.ASPAK" && $result_role[4]['subMenu1'][9]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                      <i class="fas fa-hashtag"></i>
                      <span class="hide-menu">Master ASPAK</span>
                    </a>
                    <!-- sidebar level -->
                    <ul class="collapse second-level">
                      <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/master_aspak/master_aspak">
                          <i class="fas fa-hashtag"></i>
                          <span class="hide-menu">Master Aspak</span>
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/master_aspak/master_aspak_items">
                          <i class="fas fa-hashtag"></i>
                          <span class="hide-menu">Master Aspak Items</span>
                        </a>
                      </li>
                    </ul>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][10]['menuCode'] == "MD.FIC" && $result_role[4]['subMenu1'][10]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/file_category">
                      <i class="fas fa-file-alt"></i>
                      <span class="hide-menu">File Category</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[4]['subMenu1'][11]['menuCode'] == "MD.TSC" && $result_role[4]['subMenu1'][11]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>master_data/task_category">
                      <i class="fas fa-clipboard-list"></i>
                      <span class="hide-menu">Task Category</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
          <!-- sidebar contact -->
          <?php if ($result_role[5]['menuCode'] == "C" && $result_role[5]['isAllow'] == true) : ?>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>contact">
                <i class="fas fa-id-card"></i>
                <span class="hide-menu">Contact</span>
              </a>
            </li>
          <?php endif; ?>

          <div class="devider"></div>

          <!-- sidebar systems -->
          <?php if ($result_role[6]['menuCode'] == "S" && $result_role[6]['isAllow'] == true) : ?>
            <li class="sidebar-item">
              <a class="sidebar-link waves-effect waves-dark has-arrow" href="javascript:void(0)">
                <i class="fas fa-cogs"></i>
                <span class="hide-menu">Systems</span>
              </a>

              <!-- sidebar level -->
              <ul class="collapse first-level">
                <?php if ($result_role[6]['subMenu1'][0]['menuCode'] == "S.HLP" && $result_role[6]['subMenu1'][0]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="javascript:void(0)">
                      <i class="fas fa-question-circle"></i>
                      <span class="hide-menu">Help</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[6]['subMenu1'][0]['menuCode'] == "S.HLP" && $result_role[6]['subMenu1'][1]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>system_menu/user_admin">
                      <i class="fas fa-user-cog"></i>
                      <span class="hide-menu">User Administration</span>
                    </a>
                  </li>
                <?php endif; ?>
                <?php if ($result_role[6]['subMenu1'][0]['menuCode'] == "S.HLP" && $result_role[6]['subMenu1'][2]['isAllow'] == true) : ?>
                  <li class="sidebar-item">
                    <a class="sidebar-link waves-effect waves-dark" href="<?php echo base_url(); ?>system_menu/access_control">
                      <i class="fas fa-user-check"></i>
                      <span class="hide-menu">Access Control</span>
                    </a>
                  </li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!-- /Sidebar -->
  <script>
    function sidebarMenu() {
      // $(function() {
      // "use strict";
      const url = window.location + "";
      const path = url
        .replace(
          window.location.protocol + "//" + window.location.host + "/",
          ""
        )
        .split("?");
      const element = $("ul#sidebarnav a").filter(function() {
        return (
          this.href.split("?")[0] === url.split("?")[0] ||
          this.href.split("?")[0] === path ||
          this.href.split("?")[0] === url.split("#")[0]
        ); // || url.href.indexOf(this.href) === 0;
      });
      element.addClass("active");
      element.parentsUntil(".sidebar-nav").each(function(index) {
        if ($(this).is("li") && $(this).children("a").length !== 0) {
          $(this).children("a").addClass("active");
          $(this).parent("ul#sidebarnav").length === 0 ?
            $(this).addClass("active") :
            $(this).addClass("selected");
        } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
          $(this).addClass("selected");
        } else if ($(this).is("ul")) {
          $(this).addClass("in");
        }
      });
      $("#sidebarnav a").on("click", function(e) {
        if (!$(this).hasClass("active")) {
          // hide any open menus and remove all other classes
          $("ul", $(this).parents("ul:first")).removeClass("in");
          $("a", $(this).parents("ul:first")).removeClass("active");

        } else if ($(this).is("ul")) {
          $(this).addClass('in');
        }

      });
      $('#sidebarnav a').on('click', function(e) {

        if (!$(this).hasClass("active")) {
          // hide any open menus and remove all other classes
          $("ul", $(this).parents("ul:first")).removeClass("in");
          $("a", $(this).parents("ul:first")).removeClass("active");

          // open our new menu and add the open class
          $(this).next("ul").addClass("in");
          $(this).addClass("active");

        } else if ($(this).hasClass("active")) {
          $(this).removeClass("active");
          $(this).parents("ul:first").removeClass("active");
          $(this).next("ul").removeClass("in");
        }
      })
      // $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
      //     e.preventDefault();
      // });

      // });
    }
  </script>
  <script>
    $(document).ready(function() {
      sidebarMenu();
    });
  </script>
  <script>
    $(document).ready(function() {
      $(document).on('click', '#btn-readdata', function(e) {
        var idNotif = $(this).data('id');

        $.confirm({
          title: "Confirmation",
          content: "Are you sure you have read this message?",
          theme: 'bootstrap',
          columnClass: 'medium',
          typeAnimated: true,
          buttons: {
            hapus: {
              text: 'Submit',
              btnClass: 'btn-success',
              action: function() {
                $.ajax({
                  type: "POST",
                  url: BASE_URL + "notifikasi/read",
                  data: {
                    'idNotif': idNotif
                  },
                  dataType: "json",
                  success: function(response) {
                    if (response.queryResult == true) {
                      Swal.fire({
                        icon: 'success',
                        title: 'Success..',
                        text: "Success, read notification successfully"
                      }).then(function() {
                        location.href = window.location.origin + window.location.pathname;
                      });

                    } else {
                      Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: response.queryMessage,
                      });
                    }
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                    Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: thrownError,
                    });
                  }
                });
              }
            },
            close: function() {}
          }
        });
      });
    });
  </script>