<main class="page-wrapper single-card-full" id="App">
  <main-app>
    <desktop-view>
      <template v-slot:home-dsb>
        <div class="row p-10" id="draggableArea">
          <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][0]['menuCode'] == "A.MED.INV" && $result_role[1]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary" ">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('asset/me/inventory_me'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-archive"></i>
                      <span class="shortcut-name">Inventory</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[1]['subMenu1'][0]['subMenu2'][1]['menuCode'] == "A.MED.SPT_DSE" && $result_role[1]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary" ">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('asset/me/sparepart_med'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-wrench"></i>
                      <span class="shortcut-name">Sparepart & Disposable</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][0]['menuCode'] == "A.NON.INV" && $result_role[1]['subMenu1'][1]['subMenu2'][0]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class=" card-body">
                  <a href="<?= base_url('asset/non/inventory_non'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-archive"></i>
                      <span class="shortcut-name">Inventory</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[1]['subMenu1'][1]['subMenu2'][1]['menuCode'] == "A.NON.SPT_DSE" && $result_role[1]['subMenu1'][1]['subMenu2'][1]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class=" card-body">
                  <a href="<?= base_url('asset/non/sparepart_non'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-wrench"></i>
                      <span class="shortcut-name">Sparepart & Disposable</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['menuCode'] == "T.MED.INS.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/med/inspection/schedule_report'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-check"></i>
                      <span class="shortcut-name">Inspection <br> (Schedule & Report)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['menuCode'] == "T.MED.INS.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/med/inspection/schedule_table'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-alt"></i>
                      <span class="shortcut-name">Inspection <br> (Schedule & Table)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][0]['menuCode'] == "T.NON.INS.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][0]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/non/inspection/schedule_report'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-check"></i>
                      <span class="shortcut-name">Inspection <br> (Schedule & Report)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][1]['menuCode'] == "T.NON.INS.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][1]['subMenu3'][1]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/non/inspection/schedule_table'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-alt"></i>
                      <span class="shortcut-name">Inspection <br> (Schedule & Table)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][0]['menuCode'] == "T.MED.MTC.SCH_RPT" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][0]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/med/maintenance/schedule_report'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-check"></i>
                      <span class="shortcut-name">Maintenance <br> (Schedule & Report)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][1]['menuCode'] == "T.MED.MTC.SCH_TBL" && $result_role[2]['subMenu1'][0]['subMenu2'][2]['subMenu3'][1]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/med/maintenance/schedule_table'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-alt"></i>
                      <span class="shortcut-name">Maintenance <br> (Schedule & Table)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['menuCode'] == "T.NON.MTC.SCH_RPT" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/non/maintenance/schedule_report'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-check"></i>
                      <span class="shortcut-name">Maintenance <br> (Schedule & Report)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][1]['menuCode'] == "T.NON.MTC.SCH_TBL" && $result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][1]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/non/maintenance/schedule_table'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-calendar-alt"></i>
                      <span class="shortcut-name">Maintenance <br> (Schedule & Table)</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][4]['menuCode'] == "CPL" && $result_role[2]['subMenu1'][0]['subMenu2'][4]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/med/complain'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-bullhorn"></i>
                      <span class="shortcut-name">Complain</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][0]['subMenu2'][5]['menuCode'] == "RPR" && $result_role[2]['subMenu1'][0]['subMenu2'][5]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <div class=" ribbon" data-color-type="danger">MED</div>
                  <!-- <div class=" ribbon" data-color-type="primary">NON MED</div> -->
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/med/repair'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-tools"></i>
                      <span class="shortcut-name">Repair</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][4]['menuCode'] == "NCPL" && $result_role[2]['subMenu1'][1]['subMenu2'][4]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/non/complain'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-bullhorn"></i>
                      <span class="shortcut-name">Complain</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
          <?php if ($result_role[2]['subMenu1'][1]['subMenu2'][5]['menuCode'] == "NRPR" && $result_role[2]['subMenu1'][1]['subMenu2'][5]['isAllow'] == true) : ?>
            <div class="col-lg-3">
              <div class=" card samrs-shortcut with-shadow is-soft-rounded" data-color-type="light">
                <div class="samrs-ribbon">
                  <!-- <div class=" ribbon" data-color-type="danger">MED</div> -->
                  <div class=" ribbon" data-color-type="primary">NON MED</div>
                </div>
                <div class="card-body">
                  <a href="<?= base_url('task/non/repair'); ?>" target="_blank">
                    <div class="samrs-flex wrapped is-column">
                      <i class="shortcut-icon fas fa-tools"></i>
                      <span class="shortcut-name">Repair</span>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          <?php endif; ?>
        </div>

      </template>
    </desktop-view>
  </main-app>
</main>
<script>
  // $('#introductions').modal('show');
  const swiper = new Swiper('#swiper', {
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