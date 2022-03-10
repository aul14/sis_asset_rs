<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Otp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login

        $this->load->model('M_otp', 'm_otp');
    }

    public function signatureOtpRequest()
    {
        $otpContext = [
            'otpContext' => $this->input->post('otpContext')
        ];

        $otp = $this->m_otp->signatureOtpRequest($otpContext);

        echo json_encode($otp);
    }

    public function signatureSigning()
    {
        $otpCode = explode('-', $this->input->post('otpCode'));

        $data = [
            "otpPrefix" => $otpCode[0],
            "otpCode" => $otpCode[1],
            "objectContext" => $this->input->post('objectContext')
        ];

        $otp = $this->m_otp->signatureSigning($data);

        echo json_encode($otp);
    }

    public function signatureSendSignNotif()
    {
        $data = [
            'dstUserID' => $this->input->post('dstUserID'),
            'objectContext' => $this->input->post('objectContext'),
        ];

        $otp = $this->m_otp->signatureSendSignNotif($data);

        echo json_encode($otp);
    }
}

/* End of file Otp.php */
