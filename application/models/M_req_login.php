<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

use Karriere\JsonDecoder\JsonDecoder;

class M_req_login extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            'M_res_login' => 'm_res_login'
        ]);
    }

    private $userMail, $userPass;

    public function getUserMail()
    {
        return $this->userMail;
    }
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;

        return $this;
    }
    public function getUserPass()
    {
        return $this->userPass;
    }
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }


    public function loginByEmail($data)
    {
        try {

            $client = new Client();

            $jsonDecoder = new JsonDecoder();

            $request = $client->request('POST', config_api('url_api') . '/Login/ByEmail', [
                'json' => $data
            ]);

            // var_dump($request);
            // die();

            $data = $request->getBody()->getContents();

            $person = new M_res_login();

            $person = $jsonDecoder->decode($data, M_res_login::class);
            // $this->m_res_login->

            return $person;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function data($email, $password)
    {
        $data = [
            'userMail'  => $email,
            'userPass'  => $password
        ];

        return $data;
    }
}

/* End of file M_login.php */
