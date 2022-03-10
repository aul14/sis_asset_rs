<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Components extends CI_Controller
{

    public function login()
    {
        $this->load->view('auth/components/login.vue');
    }

    public function assets_inventory()
    {
        $this->load->view('assets/components/form_main.vue');
        $this->load->view('assets/components/form_room.vue');
        $this->load->view('assets/components/form_general.vue');
        $this->load->view('assets/components/form_code.vue');
        $this->load->view('assets/components/form_instrument.vue');
        $this->load->view('assets/components/form_building.vue');
        $this->load->view('assets/components/form_vehicle.vue');
        $this->load->view('assets/components/form_land.vue');
        $this->load->view('assets/components/form_stock.vue');
        $this->load->view('assets/components/form_file.vue');
        $this->load->view('assets/components/form_depreciation1.vue');
        $this->load->view('assets/components/form_depreciation2.vue');
        $this->load->view('assets/components/form_license.vue');
        $this->load->view('assets/components/form_aspak.vue');
        $this->load->view('assets/components/form_simak.vue');
    }

    public function navigasi_sidebar()
    {
        $this->load->view('components/navigation/sidebar_main.vue');
        $this->load->view('components/navigation/sidebar_link.vue');
        $this->load->view('components/navigation/sidebar_level.vue');
    }
}

/* End of file Components.php */
