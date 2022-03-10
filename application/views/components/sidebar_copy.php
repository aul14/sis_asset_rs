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
                <div class="drop-title border-bottom">You have <?= count($notif); ?> new messanges</div>
              </li>
              <li>
                <div class="message-center message-body">
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
  <!-- <script src="<?php echo base_url(); ?>vue-components/navigation-header.js?v=1.1"></script> -->
  <script>
  let headerNav = new Vue ({
    el: '#header_main',
    components:{
        'header-main':httpVueLoader(BASE_URL+'vue-components/ui-components/navigation/header.vue?v=1.2'),
    }
  });
  </script>

  <!-- Sidebar -->
  <aside class="left-sidebar" id="sidebarColor">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" id="sidebar_main">
      <sidebar-main>
        <sidebar-link have-arrow="has-arrow" menu-name="Dashboard" icons="fas fa-tachometer-alt">
          <template v-slot:dropdown-menu>
            <sidebar-level dropdown-level="first-level">
              <template v-slot:link>
                <sidebar-link menu-link="<?php echo base_url(); ?>dashboard/home" menu-name="Home" icons="fas fa-laptop"></sidebar-link>
                <?php if ($result_role[0]['subMenu1'][2]['menuCode'] == "D.BLD" && $result_role[0]['subMenu1'][2]['isAllow'] == true) : ?>
                  <sidebar-link menu-link="<?php echo base_url(); ?>dashboard/building?dashboard=assets&years=<?= date('Y'); ?>" menu-name="Building Dashboard" icons="fas fa-hospital"></sidebar-link>
                <?php endif; ?>
                <?php if ($result_role[0]['subMenu1'][0]['menuCode'] == "D.MED" && $result_role[0]['subMenu1'][0]['isAllow'] == true) : ?>
                  <sidebar-link menu-link="<?php echo base_url(); ?>dashboard/med?dashboard=assets&years=<?= date('Y'); ?> " menu-name="Medical Dashboard" icons="fas fa-notes-medical"></sidebar-link>
                <?php endif; ?>
                <?php if ($result_role[0]['subMenu1'][1]['menuCode'] == "D.NON" && $result_role[0]['subMenu1'][1]['isAllow'] == true) : ?>
                  <sidebar-link menu-link="<?php echo base_url(); ?>dashboard/non?dashboard=assets&years=<?= date('Y'); ?>" menu-name="Non-medical Dashboard" icons="fas fa-clipboard-list"></sidebar-link>
                <?php endif; ?>
              </template>
            </sidebar-level>
          </template>
        </sidebar-link>

        <?php if ($result_role[1]['menuCode'] == "A" && $result_role[1]['isAllow'] == true) : ?>
          <sidebar-link have-arrow="has-arrow" menu-name="Assets" icons="fas fa-cubes">
            <template v-slot:dropdown-menu>
              <sidebar-level dropdown-level="first-level">
                <template v-slot:link>
                  <?php if ($result_role[1]['subMenu1'][2]['menuCode'] == "A.BLD" && $result_role[1]['subMenu1'][2]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Building" icons="fas fa-hospital">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][0]['menuCode'] == "A.BLD.INV" && $result_role[1]['subMenu1'][2]['subMenu2'][0]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>asset/building/inventory_bld" menu-name="Building Inventory" icons="fas fa-building"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[1]['subMenu1'][2]['subMenu2'][1]['menuCode'] == "A.BLD.ROM" && $result_role[1]['subMenu1'][2]['subMenu2'][1]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>asset/building/room_bld" menu-name="Room" icons="fas fa-bed"></sidebar-link>
                            <?php endif; ?>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[1]['subMenu1'][0]['menuCode'] == "A.MED" && $result_role[1]['subMenu1'][0]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Medical Equipment" icons="fas fa-file-medical">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "A.MED.INV" && $result_role[1]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url(); ?>asset/me/inventory_me" menu-name="Inventory" icons="fas fa-archive"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "A.MED.SPT_DSE" && $result_role[1]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url(); ?>asset/me/sparepart_med" menu-name="Sparepart & Disposable" icons="fas fa-wrench"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][2]['menuCode'] == "A.MED.TLS_MTR" && $result_role[1]['subMenu1'][0]['subMenu2'][2]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url(); ?>asset/me/tools_med" menu-name="Tools & Meter" icons="fas fa-toolbox"></sidebar-link>
                            <?php endif; ?>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[1]['subMenu1'][1]['menuCode'] == "A.NON" && $result_role[1]['subMenu1'][1]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Non-medical Equipment" icons="fas fa-clipboard-list">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['menuCode'] == "A.NON.INV" && $result_role[1]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>asset/non/inventory_non" menu-name="Inventory" icons="fas fa-archive"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][1]['menuCode'] == "A.NON.SPT_DSE" && $result_role[1]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>asset/non/sparepart_non" menu-name="Sparepart & Disposable" icons="fas fa-wrench"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][2]['menuCode'] == "A.NON.TLS_MTR" && $result_role[1]['subMenu1'][1]['subMenu2'][2]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>asset/non/tools_non" menu-name="Tools & Meter" icons="fas fa-toolbox"></sidebar-link>
                            <?php endif; ?>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>
                </template>
              </sidebar-level>
            </template>
          </sidebar-link>
        <?php endif; ?>

        <?php if ($result_role[2]['menuCode'] == "T" && $result_role[2]['isAllow'] == true) : ?>
          <sidebar-link have-arrow="has-arrow" menu-name="Task" icons="fas fa-clipboard-list">
            <template v-slot:dropdown-menu>
              <sidebar-level dropdown-level="first-level">
                <template v-slot:link>
                  <?php if ($result_role[2]['subMenu1'][0]['menuCode'] == "T.MED" && $result_role[2]['subMenu1'][0]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Electromedic Task" icons="fas fa-file-medical">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "CAL" && $result_role[2]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
                              <sidebar-link have-arrow="has-arrow" menu-name="Calibration" icons="fas fa-drafting-compass">
                                <template v-slot:dropdown-menu>
                                  <sidebar-level dropdown-level="third-level">
                                    <template v-slot:link>
                                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['menuCode'] == "T.MED.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][0]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/med/calibration/schedule_report" menu-name="Schedule & Report" icons="fas fa-calendar-check"></sidebar-link>
                                      <?php endif; ?>
                                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['menuCode'] == "T.MED.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][0]['subMenu3'][1]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/med/calibration/schedule_table" menu-name="Schedule Table" icons="fas fa-calendar-alt"></sidebar-link>
                                      <?php endif; ?>
                                    </template>
                                  </sidebar-level>
                                </template>
                              </sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "INP" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
                              <sidebar-link have-arrow="has-arrow" menu-name="Inspection" icons="fas fa-check">
                                <template v-slot:dropdown-menu>
                                  <sidebar-level dropdown-level="third-level">
                                    <template v-slot:link>
                                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['menuCode'] == "T.MED.INS.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/med/inspection/schedule_report" menu-name="Schedule & Report" icons="fas fa-calendar-check"></sidebar-link>
                                      <?php endif; ?>
                                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['menuCode'] == "T.MED.INS.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/med/inspection/schedule_table" menu-name="Schedule Table" icons="fas fa-calendar-alt"></sidebar-link>
                                      <?php endif; ?>
                                    </template>
                                  </sidebar-level>
                                </template>
                              </sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['menuCode'] == "MTN" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['isAllow'] == true) : ?>
                              <sidebar-link have-arrow="has-arrow" menu-name="Maintenace" icons="fas fa-toolbox">
                                <template v-slot:dropdown-menu>
                                  <sidebar-level dropdown-level="third-level">
                                    <template v-slot:link>
                                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][0]['menuCode'] == "T.MED.MTC.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][0]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/med/maintenance/schedule_report" menu-name="Schedule & Report" icons="fas fa-calendar-check"></sidebar-link>
                                      <?php endif; ?>
                                      <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][1]['menuCode'] == "T.MED.MTC.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][1]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/med/maintenance/schedule_table" menu-name="Schedule Table" icons="fas fa-calendar-alt"></sidebar-link>
                                      <?php endif; ?>
                                    </template>
                                  </sidebar-level>
                                </template>
                              </sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][3]['menuCode'] == "MUT" && $result_role[2]['subMenu1'][0]['subMenu2'][3]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>task/med/mutation" menu-name="Mutation" icons="fas fa-copy"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['menuCode'] == "CPL" && $result_role[2]['subMenu1'][0]['subMenu2'][4]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>task/med/complain" menu-name="Complain" icons="fas fa-bullhorn"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][5]['menuCode'] == "RPR" && $result_role[2]['subMenu1'][0]['subMenu2'][5]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>task/med/repair" menu-name="Repair" icons="fas fa-tools"></sidebar-link>
                            <?php endif; ?>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>

                  <?php if ($result_role[2]['subMenu1'][1]['menuCode'] == "T.NON" && $result_role[2]['subMenu1'][1]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Non-medic Task" icons="fas fa-clipboard-list">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][0]['menuCode'] == "NCAL" && $result_role[2]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
                              <sidebar-link have-arrow="has-arrow" menu-name="Calibration" icons="fas fa-drafting-compass">
                                <template v-slot:dropdown-menu>
                                  <sidebar-level dropdown-level="third-level">
                                    <template v-slot:link>
                                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][0]['menuCode'] == "T.NON.CAL.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][0]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/non/calibration/schedule_report" menu-name="Schedule & Report" icons="fas fa-calendar-check"></sidebar-link>
                                      <?php endif; ?>
                                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][1]['menuCode'] == "T.NON.CAL.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][0]['subMenu3'][1]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/non/calibration/schedule_table" menu-name="Schedule Table" icons="fas fa-calendar-alt"></sidebar-link>
                                      <?php endif; ?>
                                    </template>
                                  </sidebar-level>
                                </template>
                              </sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['menuCode'] == "NINP" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
                              <sidebar-link have-arrow="has-arrow" menu-name="Inspection" icons="fas fa-check">
                                <template v-slot:dropdown-menu>
                                  <sidebar-level dropdown-level="third-level">
                                    <template v-slot:link>
                                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][0]['menuCode'] == "T.NON.INS.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/non/inspection/schedule_report" menu-name="Schedule & Report" icons="fas fa-calendar-check"></sidebar-link>
                                      <?php endif; ?>
                                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][1]['menuCode'] == "T.NON.INS.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/non/inspection/schedule_table" menu-name="Schedule Table" icons="fas fa-calendar-alt"></sidebar-link>
                                      <?php endif; ?>
                                    </template>
                                  </sidebar-level>
                                </template>
                              </sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['menuCode'] == "NMTN" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['isAllow'] == true) : ?>
                              <sidebar-link have-arrow="has-arrow" menu-name="Maintenace" icons="fas fa-toolbox">
                                <template v-slot:dropdown-menu>
                                  <sidebar-level dropdown-level="third-level">
                                    <template v-slot:link>
                                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['menuCode'] == "T.NON.MTC.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/non/maintenance/schedule_report" menu-name="Schedule & Report" icons="fas fa-calendar-check"></sidebar-link>
                                      <?php endif; ?>
                                      <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][1]['menuCode'] == "T.NON.MTC.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][1]['isAllow'] == true) : ?>
                                        <sidebar-link menu-link="<?php echo base_url() ?>task/non/maintenance/schedule_table" menu-name="Schedule Table" icons="fas fa-calendar-alt"></sidebar-link>
                                      <?php endif; ?>
                                    </template>
                                  </sidebar-level>
                                </template>
                              </sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][3]['menuCode'] == "NMUT" && $result_role[2]['subMenu1'][1]['subMenu2'][3]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>task/non/mutation" menu-name="Mutation" icons="fas fa-copy"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][4]['menuCode'] == "NCPL" && $result_role[2]['subMenu1'][1]['subMenu2'][4]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>task/non/complain" menu-name="Complain" icons="fas fa-bullhorn"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][5]['menuCode'] == "NRPR" && $result_role[2]['subMenu1'][1]['subMenu2'][5]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>task/non/repair" menu-name="Repair" icons="fas fa-tools"></sidebar-link>
                            <?php endif; ?>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[2]['subMenu1'][2]['menuCode'] == "SOM" && $result_role[2]['subMenu1'][2]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?php echo base_url() ?>task/stock_opname" menu-name="Inventory Opname" icons="fas fa-archive"></sidebar-link>
                  <?php endif; ?>
                </template>
              </sidebar-level>
            </template>
          </sidebar-link>
        <?php endif; ?>
        <?php if ($result_role[3]['menuCode'] == "F" && $result_role[3]['isAllow'] == true) : ?>
          <sidebar-link have-arrow="has-arrow" menu-name="Files" icons="fas fa-folder-open">
            <template v-slot:dropdown-menu>
              <sidebar-level dropdown-level="first-level">
                <template v-slot:link>
                  <?php if ($result_role[3]['subMenu1'][0]['menuCode'] == "F.FM" && $result_role[3]['subMenu1'][0]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Forms" icons="fas fa-file-alt">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "F.FM.INS" && $result_role[3]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>files/forms/inspection" menu-name="Inspection" icons="fas fa-file-alt"></sidebar-link>
                            <?php endif; ?>
                            <?php if ($result_role[3]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "F.FM.MTN" && $result_role[3]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
                              <sidebar-link menu-link="<?php echo base_url() ?>files/forms/maintenance" menu-name="Maintenace" icons="fas fa-cog"></sidebar-link>
                            <?php endif; ?>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>
                </template>
              </sidebar-level>
            </template>
          </sidebar-link>
        <?php endif; ?>
        <?php if ($result_role[4]['menuCode'] == "MD" && $result_role[4]['isAllow'] == true) : ?>
          <sidebar-link have-arrow="has-arrow" menu-name="Master Data" icons="fas fa-database">
            <template v-slot:dropdown-menu>
              <sidebar-level dropdown-level="first-level">
                <template v-slot:link>
                  <?php if ($result_role[4]['subMenu1'][0]['menuCode'] == "MD.CPI" && $result_role[4]['subMenu1'][0]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/company_information" menu-name="Company Information" icons="fas fa-info-circle"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][1]['menuCode'] == "MD.INS" && $result_role[4]['subMenu1'][1]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/installation" menu-name="Installation" icons="fas fa-notes-medical"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][2]['menuCode'] == "MD.BND" && $result_role[4]['subMenu1'][2]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/brand" menu-name="Brands" icons="fas fa-clipboard-list"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][3]['menuCode'] == "MD.INC" && $result_role[4]['subMenu1'][3]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/inventory_category" menu-name="Inventory Categories" icons="fas fa-file-archive"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][4]['menuCode'] == "MD.INM" && $result_role[4]['subMenu1'][4]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/inventory_master" menu-name="Inventory Master" icons="fas fa-archive"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][5]['menuCode'] == "MD.FNC" && $result_role[4]['subMenu1'][5]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/funding_category" menu-name="Funding Categories" icons="fas fa-money-check-alt"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][6]['menuCode'] == "MD.MSU" && $result_role[4]['subMenu1'][6]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/measurement_unit" menu-name="Measurement Units" icons="fas fa-tachometer-alt"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][7]['menuCode'] == "MD.ECRI" && $result_role[4]['subMenu1'][7]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/master_ecri" menu-name="Master ECRI" icons="fas fa-hashtag"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][8]['menuCode'] == "MD.SIMAK" && $result_role[4]['subMenu1'][8]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/master_simak" menu-name="Master SIMAK" icons="fas fa-hashtag"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][9]['menuCode'] == "MD.ASPAK" && $result_role[4]['subMenu1'][9]['isAllow'] == true) : ?>
                    <sidebar-link have-arrow="has-arrow" menu-name="Master ASPAK" icons="fas fa-hashtag">
                      <template v-slot:dropdown-menu>
                        <sidebar-level dropdown-level="second-level">
                          <template v-slot:link>
                            <sidebar-link menu-link="<?= base_url(); ?>master_data/master_aspak/master_aspak" menu-name="Master Aspak" icons="fas fa-hashtag"></sidebar-link>
                            <sidebar-link menu-link="<?= base_url(); ?>master_data/master_aspak/master_aspak_items" menu-name="Master Aspak Items" icons="fas fa-hashtag"></sidebar-link>
                          </template>
                        </sidebar-level>
                      </template>
                    </sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][10]['menuCode'] == "MD.FIC" && $result_role[4]['subMenu1'][10]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/file_category" menu-name="File Category" icons="fas fa-file-alt"></sidebar-link>
                  <?php endif; ?>
                  <?php if ($result_role[4]['subMenu1'][11]['menuCode'] == "MD.TSC" && $result_role[4]['subMenu1'][11]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="<?= base_url(); ?>master_data/task_category" menu-name="Task Category" icons="fas fa-clipboard-list"></sidebar-link>
                  <?php endif; ?>
                </template>
              </sidebar-level>
            </template>
          </sidebar-link>
        <?php endif; ?>
        <?php if ($result_role[5]['menuCode'] == "C" && $result_role[5]['isAllow'] == true) : ?>
          <sidebar-link menu-link="<?php echo base_url() ?>contact/" menu-name="Contact" icons="fas fa-id-card"></sidebar-link>
        <?php endif; ?>
        <div class="devider"></div>
        <?php if ($result_role[6]['menuCode'] == "S" && $result_role[6]['isAllow'] == true) : ?>
          <sidebar-link menu-link="javascript:void(0)" have-arrow="has-arrow" menu-name="Systems" icons="fas fa-cogs">
            <template v-slot:dropdown-menu>
              <sidebar-level dropdown-level="first-level">
                <template v-slot:link>
                  <?php if ($result_role[6]['subMenu1'][0]['menuCode'] == "S.HLP" && $result_role[6]['subMenu1'][0]['isAllow'] == true) : ?>
                    <sidebar-link menu-link="javascript:void(0)" menu-name="Help" icons="fas fa-question-circle">
                    <?php endif; ?>
                    </sidebar-link>
                    <?php if ($result_role[6]['subMenu1'][1]['menuCode'] == "S.ADM" && $result_role[6]['subMenu1'][1]['isAllow'] == true) : ?>
                      <sidebar-link menu-link="<?php echo base_url() ?>system_menu/user_admin" menu-name="User Administration" icons="fas fa-user-cog"></sidebar-link>
                    <?php endif; ?>
                    <?php if ($result_role[6]['subMenu1'][2]['menuCode'] == "S.ACS" && $result_role[6]['subMenu1'][2]['isAllow'] == true) : ?>
                      <sidebar-link menu-link="<?php echo base_url() ?>system_menu/access_control" menu-name="Access Control" icons="fas fa-user-check"></sidebar-link>
                    <?php endif; ?>
                </template>
              </sidebar-level>
            </template>
          </sidebar-link>
        <?php endif; ?>
      </sidebar-main>
    </div>
    <!-- End Sidebar scroll-->
  </aside>
  <!-- /Sidebar -->
  <script>
   const sidebar =  new Vue({
      el: '#sidebar_main',
      components: {
        'sidebar-link':httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/sidebar_link.vue?v=1.0'),
        'sidebar-level':httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/sidebar_level.vue?v=1.0'),
        'sidebar-main':httpVueLoader(BASE_URL + 'vue-components/ui-components/navigation/sidebar_main.vue?v=1.2')
      },
      updated(){
        function sidebarActive() {
          $(function() {
            "use strict";
            let url = window.location + "";
            const path = url
            .replace(
              window.location.protocol + "//" + window.location.host + "/",
              ""
            )
            .split("?");
            let element = $("ul#sidebarnav a.sidebar-link").filter(function() {
              return (
                this.href.split("?")[0] === url.split("?")[0] ||
                this.href.split("?")[0] === path ||
                this.href.split("?")[0] === url.split("#")[0]
              );
            });
            element.addClass("active");
            element.parentsUntil(".sidebar-nav").each(function(index) {
              if ($(this).is("li") && $(this).children("a.sidebar-link").length !== 0) {
                $(this).children("a.sidebar-link").addClass("active");
                $(this).parent("ul#sidebarnav").length === 0 ?
                  $(this).addClass("active") :
                  $(this).addClass("selected");
              } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
                $(this).addClass("selected");
              } else if ($(this).is("ul")) {
                $(this).addClass("in");
              }
            });
          });
        }
        Vue.nextTick(function() {
          $(document).ready(function() {
            sidebarActive();
          })
        })
      }
  });
  </script>
  <script>
    $(function() {
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
                      });
                      location.href = window.location.origin + window.location.pathname;
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
