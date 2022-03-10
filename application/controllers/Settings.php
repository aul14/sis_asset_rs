<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_user'                => 'm_user',
            'M_access_control'      => 'm_access_control',
            'M_file'                => 'm_file',
            'M_file_cat'                => 'm_file_cat'
        ]);
    }


    public function index()
    {
        $user = $this->m_user->userById($this->session->userdata('id_user'))['data'];

        if ($user['idFilePict'] == 0) {
            $picture = 'assets/images/users/avataruser.jpg';
            $data['picture'] =  base_url() . $picture;
        } else {
            $picture = $this->m_file->fileBase64($user['idFilePict'])['data'];
            $data['picture'] = "data:image/png;base64,"  . $picture;
        }

        $data['user']   = $user;

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        // echo "Anda berhasil login dengan nomor " . $token;
        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('users/user_configuration', $data);
        $this->load->view('components/footer');
        $this->load->view('components/sidebar_footer');
    }

    private function user_file_upload($file)
    {

        $filename = $file['name'];

        $dir = 'assets/upload/file/';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, TRUE);
            // chmod (FCPATH . $dir, 0777);
        }

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        $target_file = $dir . basename($filename);

        $fileCat = $this->m_file_cat->fileCatByFileCatName('PHOTO');
        // var_dump($fileCat);
        // die;
        $idFileCat = $fileCat['queryResult'] == true ? $fileCat['data']['idFileCat'] : 0;

        // chmod(FCPATH . $dir, 0777);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {

            $data = [
                'idCat' => $idFileCat,
                'folder' => $dir,
                'files' => $dir . $filename,
                'userName' => $this->session->userdata('username')
            ];
            $file_upload = $this->m_file->fileUpload($data);
            // echo "<pre>";
            // var_dump($file_upload);
            // die;
            // echo "</pre>";

            return $file_upload;
            die();
        }

        return false;
    }

    private function signature_file_upload($img, $fileName)
    {
        $img = 'data:' . $img;
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);

        $data = base64_decode($img);

        $dir = 'assets/upload/file/';

        if (!is_dir($dir)) {
            mkdir($dir, 0777, TRUE);
            chmod(FCPATH . $dir, 0777);
        }

        $file = $dir . $fileName . '.png';

        $success = file_put_contents($file, $data);

        $fileCat = $this->m_file_cat->fileCatByFileCatName('SignPicture');
        // var_dump($fileCat);
        // die;
        $idFileCat = $fileCat['queryResult'] == true ? $fileCat['data']['idFileCat'] : 0;

        $data = [
            'idCat' => $idFileCat,
            'folder' => $dir,
            'files' => $file,
            'userName' => $this->session->userdata('username')
        ];
        $file_upload = $this->m_file->fileUpload($data);

        return $file_upload;
        die();
    }

    public function upload_signature()
    {
        $post = $this->security->xss_clean($this->input->post());

        $img = $post['ImageDrawingBase64'];

        $fileName = $this->session->userdata('id_user');

        $upload =  $this->signature_file_upload($img, $fileName);

        $is_ttd = !empty($upload['data']['idFile']) ? (string) $upload['data']['idFile'] : 0;
        $user_val = !empty($upload['data']['idFile']) ? "signature|ttd" : "signature|otp";

        // $user = $this->m_user->userById($this->session->userdata('id_user'));

        $setting = [
            [
                'idUser'    => $this->session->userdata('id_user'),
                'userVar'   => $user_val,
                'userVal'   => $is_ttd
            ]
        ];

        $save = $this->m_user->userSettings($setting);

        echo json_encode($save);
        die;
    }


    public function information_setting()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $user = $this->m_user->userById($this->session->userdata('id_user'))['data'];

        $propSetting = $user['propUserSetting'];

        if (count($propSetting) > 0 && $propSetting[0]['userVar'] == "signature|ttd") {
            $set_file['set_file'] = $this->m_file->fileBase64($propSetting[0]['userVal'])['data'];
        } else {
            $set_file['set_file'] = "";
        }

        $set_file['userVar'] =  $user['propUserSetting'][0]['userVar'];

        echo json_encode($set_file);
        die;
    }


    public function information()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $user = $this->m_user->userById($this->session->userdata('id_user'))['data'];

        if ($user['propFile']['idFile'] == 0) {
            $picture = 'assets/images/users/avataruser.jpg';
            $show['picture'] =  base_url() . $picture;
        } else {
            $picture = $this->m_file->fileBase64($user['idFilePict'])['data'];
            $show['picture'] = "data:image/png;base64,"  . $picture;
        }

        $show['id_user']  = $this->session->userdata('id_user');
        $show['email']  = $user['userMail'];
        $show['username']  = $user['userFullName'];
        $show['role']  = $user['propRole']['roleName'];
        $show['hospital']  = count($this->session->userdata('propHospital'));
        $show['hospital_name']  = $this->session->userdata('hospital');

        echo json_encode($show);
    }

    public function change_profile()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());

        $post['userPict'] = isset($_FILES['userPict']);

        if (isset($_FILES['userPict'])) {
            $upload = $this->user_file_upload($_FILES['userPict']);
        }

        $user = [
            "idUser" => $this->session->userdata('id_user'),
            "userName" => $post['userName'],
            "userFullName" => $post['userFullName'],
            // "userPass" => isset($post['userPass']) ? $post['userPass'] : '',
            // "userMail" => $post['userMail'],
            "userPhone" => $post['userPhone'],
            "emailConfirm" => true,
            "isActive" => false,
            "createDate" => date('Y-m-d H:i:s'),
            "lastLogin" => "",
            "session" => "",
            "token1" => "",
            "token2" => "",
            "idRole" => (int)$post['idRole'],
            "idHospital" => (int)$post['idHospital'],
            "idFilePict" => !empty($upload['data']['idFile']) ? (int)$upload['data']['idFile'] : (int)$post['idFilePict']
        ];

        $save = $this->m_user->userUpdate($user);


        // redirect('settings', 'refresh');

        echo json_encode($save);
        die;
    }

    public function change_pwd()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $post = $this->security->xss_clean($this->input->post());

        $change = [
            'passOld'   => $post['passOld'],
            'passNew'   => $post['passNew'],
            'passNewConfirm'   => $post['passNewConfirm']
        ];

        $save = $this->m_user->userChangePwd($change);

        echo json_encode($save);
        die;
    }
}

/* End of file Setting.php */
