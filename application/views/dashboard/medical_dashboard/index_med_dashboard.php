<main class="page-wrapper single-card-full" id="App">
  <main-app>
    <navigation-dashboard dashboard-name="Medical Dashboard" :dashboard-submenu="submenuParams()" :dashboard-years="urlParameters('years')">
      <template v-slot:nav-item>
        <?php if ($result_role[0]['subMenu1'][0]['subMenu2'][0]['isAllow'] == true) : ?>
          <li class="nav-item">
            <a class="nav-link" :href="'<?= base_url() ?>dashboard/med?dashboard=assets&years='+urlParameters('years')">assets</a>
          </li>
        <?php endif; ?>
        <?php if ($result_role[0]['subMenu1'][0]['subMenu2'][1]['isAllow'] == true) : ?>
          <li class="nav-item">
            <a class="nav-link" :href="'<?= base_url() ?>dashboard/med?dashboard=calibration&years='+urlParameters('years')">calibration</a>
          </li>
        <?php endif; ?>
        <?php if ($result_role[0]['subMenu1'][0]['subMenu2'][2]['isAllow'] == true) : ?>
          <li class="nav-item">
            <a class="nav-link" :href="'<?= base_url() ?>dashboard/med?dashboard=inspection&years='+urlParameters('years')">inspection</a>
          </li>
        <?php endif; ?>
        <?php if ($result_role[0]['subMenu1'][0]['subMenu2'][3]['isAllow'] == true) : ?>
          <li class="nav-item">
            <a class="nav-link" :href="'<?= base_url() ?>dashboard/med?dashboard=maintenance&years='+urlParameters('years')">maintenance</a>
          </li>
        <?php endif; ?>
        <?php if ($result_role[0]['subMenu1'][0]['subMenu2'][4]['isAllow'] == true) : ?>
          <li class="nav-item">
            <a class="nav-link" :href="'<?= base_url() ?>dashboard/med?dashboard=complain_repair&years='+urlParameters('years')">complain & repair</a>
          </li>
        <?php endif; ?>
        <?php if ($result_role[0]['subMenu1'][0]['subMenu2'][5]['isAllow'] == true) : ?>
          <li class="nav-item">
            <a class="nav-link" :href="'<?= base_url() ?>dashboard/med?dashboard=mutation&years='+urlParameters('years')">mutation</a>
          </li>
        <?php endif; ?>
        <li class="nav-item dropdown ml-2 samrs-dropdown" dropdown-style="zoom">
          <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            charts year
            <span class="text-sm"><i class="arrows fas fa-chevron-up"></i></span>
          </a>
          <div class="dropdown-menu" with-state="charts-data">
            <a class="dropdown-item" v-for="value in chartsYear" :href="'<?= $this->uri->segment(2) . '?dashboard=' . $this->input->get('dashboard') . '&years='; ?>'+value" :with-data="value">
              {{ value }}
            </a>
          </div>
        </li>
      </template>
    </navigation-dashboard>
    <dashboard-med-content :current-page="detectPage()" :charts-year="urlParameters('years')"></dashboard-med-content>
  </main-app>
</main>
