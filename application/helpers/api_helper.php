<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
function config_api($key = '')
{
    $ci = &get_instance();

    $ci->load->config('app');

    $config['url_api'] = $ci->config->item("base_url_api");
    $config['auth_api'] = $ci->config->item("authorization_api") . (empty($ci->session->userdata('token')) ? '' : $ci->session->userdata('token'));

    return isset($config[$key]) ? $config[$key] : '';
}
