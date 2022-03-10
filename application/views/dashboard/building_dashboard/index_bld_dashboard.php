<main class="page-wrapper single-card-full" id="App">
  <main-app>
    <navigation-dashboard dashboard-name="Building Dashboard" :dashboard-submenu="submenuParams()" :dashboard-years="urlParameters('years')">
      <template v-slot:nav-item>
        <li class="nav-item">
          <a class="nav-link" :href="'<?= base_url() ?>dashboard/building?dashboard=assets&years='+urlParameters('years')">assets</a>
        </li>
        <li class="nav-item dropdown ml-2">
          <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            charts year
            <span class="text-sm"><i class="arrows fas fa-chevron-up"></i></span>
          </a>
          <div class="dropdown-menu" with-state="charts-data">
            <a class="dropdown-item" v-for="value in chartsYear" :href="'<?= $this->uri->segment(2).'?dashboard='.$this->input->get('dashboard').'&years='; ?>'+value">
              {{ value }}
            </a>
          </div>
        </li>
      </template>
    </navigation-dashboard>
    <dashboard-bld-content :current-page="detectPage()" :charts-year="urlParameters('years')"></dashboard-bld-content>
  </main-app>
</main>
