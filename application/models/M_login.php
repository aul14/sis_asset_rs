<?php


defined('BASEPATH') or exit('No direct script access allowed');

use GuzzleHttp\Client;

class M_login extends CI_Model
{
    private $userMail, $userPass;

    public function loginByEmail($data)
    {
        try {

            $client = new Client();

            $request = $client->request('POST', config_api('url_api') . '/Login/ByEmail', [
                'json' => $data
            ]);

            // var_dump($request);
            // die();

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function loginSelectHospital($id)
    {
        try {

            $client = new Client();

            $headers = [
                'http_errors' => false,
                'Authorization' => config_api('auth_api'),
                "Content-Type" => "application/json",
            ];

            $request = $client->request('POST', config_api('url_api') . "/Login/SelectHospital?idHospital={$id}", [
                'headers' => $headers
            ]);

            // var_dump($request);
            // die();

            $data = $request->getBody()->getContents();

            $data = json_decode($data, TRUE);

            return $data;
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

    /**
     * Get the value of userMail
     */
    public function getUserMail()
    {
        return $this->userMail;
    }

    /**
     * Set the value of userMail
     *
     * @return  self
     */
    public function setUserMail($userMail)
    {
        $this->userMail = $userMail;

        return $this;
    }

    /**
     * Get the value of userPass
     */
    public function getUserPass()
    {
        return $this->userPass;
    }

    /**
     * Set the value of userPass
     *
     * @return  self
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }
}

/* End of file M_login.php */
