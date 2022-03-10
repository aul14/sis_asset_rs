<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chillerlan\QRCode\QRCode;

class Schedule_report extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->simple_login->cek_login(); // cek login
    $this->load->model([
      'M_task'                => 'm_task',
      'M_asset'               => 'm_asset',
      'M_file'                => 'm_file',
      'M_file_cat'            => 'm_file_cat',
      'M_task_complain'       => 'm_task_complain',
      'M_progress'            => 'm_progress',
      'M_task_files'          => 'm_task_files',
      'M_task_calibration'          => 'm_task_calibration',
      'M_task_maintenance'          => 'm_task_maintenance',
      'M_contact'          => 'm_contact',
      'M_schedule'          => 'm_schedule',
      'M_form_template'          => 'm_form_template',
      'M_form_pic'          => 'm_form_pic',
      'M_form'          => 'm_form',
      'M_otp'          => 'm_otp'
    ]);
  }

  public function index()
  {
    $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

    $data['result_role'] = $result_role;
    $this->load->model('M_notifikasi', 'm_notifikasi');
    $data['notif'] = $this->m_notifikasi->list()['data'];

    if ($result_role[2]['subMenu1'][1]['subMenu2'][2]['subMenu3'][0]['isAllow'] != true) {
      exit('You dont have access!!');
    }

    $this->load->view('components/header');
    $this->load->view('components/sidebar', $data);
    $this->load->view('task/non_medic_task/print/maintenance/task_print');
    $this->load->view('task/non_medic_task/form/maintenance_form');
    $this->load->view('task/non_medic_task/form/maintenance_form_edit');
    $this->load->view('task/non_medic_task/form/maintenance_form_times');
    $this->load->view('task/non_medic_task/maintenance_schedule_nmd_report');
    $this->load->view('components/sidebar_footer');
    $this->load->view('components/footer');
    $this->load->view('task/task');
  }

  private function task_file_upload($file, $docNumber = NULL)
  {

    $filename = $file['name'];

    $dir = 'assets/upload/file/';

    if (!is_dir($dir)) {
      mkdir($dir, 0777, TRUE);
      // chmod (FCPATH . $dir, 0777);
    }

    pathinfo($filename, PATHINFO_EXTENSION);

    $target_file = $dir . basename($filename);

    $fileCat = $this->m_file_cat->fileCatByFileCatName('MTNFile');

    // chmod (FCPATH . $dir, 0777);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {

      $data = [
        'idCat' => $fileCat['queryResult'] == true ? $fileCat['data']['idFileCat'] : 0,
        'folder' => $dir,
        'files' => $dir . $filename,
        'docNumber' => $docNumber,
        'userName' => $this->session->userdata('username')
      ];

      $file_upload = $this->m_file->fileUpload($data);
      // var_dump($file_upload);
      // die;

      return $file_upload;
      die();
    }

    return false;
  }

  public function finishSign()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->input->post();

    $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
    $signHash = isset($post['signHash']) ? $post['signHash'] : 'sdfdsfs';

    $task = $this->m_task->taskById($idTask);
    $task['data']['propProgress']['finishSign'] = $signHash;
    $task['data']['propProgress']['idFinishBy'] = $this->session->userdata('id_user');
    $task['data']['propProgress']['finishBy'] = $this->session->userdata('username');

    $propProgress = $task['data']['propProgress'];

    $update = $this->m_progress->progressUpdate($propProgress);

    echo json_encode($update);
    // echo json_encode($update);
  }

  public function approveSign()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->input->post();

    $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
    $signHash = isset($post['signHash']) ? $post['signHash'] : 'sdfdsfs';

    $task = $this->m_task->taskById($idTask);
    $task['data']['propProgress']['approveSign'] = $signHash;
    $task['data']['propProgress']['idApproveBy'] = $this->session->userdata('id_user');
    $task['data']['propProgress']['approveBy'] = $this->session->userdata('username');
    $task['data']['propProgress']['timeApproved'] = date('Y-m-d H:i:s');

    $propProgress = $task['data']['propProgress'];

    $update = $this->m_progress->progressUpdate($propProgress);

    echo json_encode($update);
    // echo json_encode($update);
  }

  public function generate_ttd()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->input->post();

    // $idTask = isset($post['idTask']) ? $post['idTask'] : 89;
    $signHash = isset($post['signHash']) ? $post['signHash'] : '';

    $generate = $signHash == '' ? '' : $this->m_otp->signatureByHash($signHash);

    $ttd['otp'] = $generate == '' ? '' : (new QRCode)->render(json_encode($generate));
    $ttd['otp_name'] = $generate == '' ? '' : $generate['signPerson'];

    echo json_encode($ttd);
    die;
  }

  public function approve_id_task()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idTask = [];

    if (!empty($this->input->post('idTask'))) {
      $idTask = $this->input->post('idTask');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idTask as $key => $id) {
      $task = $this->m_task->taskById($id)['data'];

      $task['timeFinish'] = date('Y-m-d', strtotime($task['propProgress']['timeFinish']));
      // $task = $this->m_task_calibration->delete($id, $idAsset);
      $task['idAssigneeChairman'] = $this->session->userdata('id_user');

      $approveSign = $task['propProgress']['approveSign'];
      $finishSign = $task['propProgress']['finishSign'];

      $finishDraw = strpos($finishSign, "DRAW");

      if ($finishDraw !== FALSE) {
        $approveSign2 = $approveSign ? $approveSign : '';
        $task['approveSign'] = $approveSign2 == '' ? '' : $approveSign2;

        $finishSign2 = $finishSign ? $finishSign : '';
        $task['finishSign'] = $finishSign2 == '' ? '' : $finishSign2;
      } else {
        $approveSign2 = $approveSign ? $this->m_otp->signatureByHash($approveSign) : '';
        $task['approveSign'] = $approveSign2 == '' ? '' : (new QRCode)->render(json_encode($approveSign2));

        $finishSign2 = $finishSign ? $this->m_otp->signatureByHash($finishSign) : '';
        $task['finishSign'] = $finishSign2 == '' ? '' : (new QRCode)->render(json_encode($finishSign2));
      }
      $task['username'] = $this->session->userdata('username');
    }

    echo json_encode($task);
    exit;
  }

  public function task_by_id()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $idTask = [];

    if (!empty($this->input->post('idTask'))) {
      $idTask = $this->input->post('idTask');
    }

    // $id_asset = $this->input->post('idAsset');
    foreach ($idTask as $key => $id) {
      $task = $this->m_task->taskById($id)['data'];

      $idAssetMaster = $task['propTaskMaintenance'][0]['propAsset']['idAssetMaster'];

      $task['formTemplate'] = $this->m_form_template->formTemplateByTypeMaster($idAssetMaster, 2)['data'];
    }

    echo json_encode($task);
    exit;
  }

  public function store_form_edit()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    $form = [
      'idForm'    => !empty($post['idForm']) ? $post['idForm'] : 0,
      'idFormType'    => 2,
      'formName'    => !empty($post['ftName']) ? $post['ftName'] : "",
      'formCode'    => !empty($post['ftCode']) ? $post['ftCode'] : "",
      'finalResult'    => !empty($post['finalResult']) ? $post['finalResult'] : "",
      'finalNote'    => !empty($post['finalNote']) ? $post['finalNote'] : "",
    ];

    if (isset($post['idAssetFormAlkur'])) {
      foreach ($post['idAssetFormAlkur'] as $key => $value) {
        $propFormAlkur[] = [
          "idFpAlkur" => (int)$post['idFpAlkur'][$key],
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => 0,
          "idAsset" => (int)$post['idAssetFormAlkur'][$key],
          "assetName" => $post['assetNameFormAlkur'][$key],
          "assetMerk" => $post['assetMerkFormAlkur'][$key],
          "assetType" => $post['assetTypeFormAlkur'][$key],
          "assetSN" => $post['assetSNFormAlkur'][$key]
        ];
      }
    }

    if (isset($post['idAssetFormTools'])) {
      foreach ($post['idAssetFormTools'] as $key => $value) {
        $propFormTools[] = [
          "idFpTools" => (int)$post['idFpTools'][$key],
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => 0,
          "idAsset" => (int)$post['idAssetFormTools'][$key],
          "assetName" => $post['assetNameFormTools'][$key],
          "assetMerk" => $post['assetMerkFormTools'][$key],
          "assetType" => $post['assetTypeFormTools'][$key],
          "assetSN" => $post['assetSNFormTools'][$key]
        ];
      }
    }

    $propFormElect = [];
    if (isset($post['electParam'])) {
      foreach ($post['electParam'] as $key => $value) {
        $propFormElect[$key] = [
          "idFpElect"   => (int)$post['idFpElect'][$key],
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "electParam" => $post['electParam'][$key],
          "electMeasure" => isset($post['electMeasure']) ? (int)$post['electMeasure'][$key] : 0,
          "electUpper" => isset($post['electUpper']) ? (int)$post['electUpper'][$key] : 0,
          "electLower" => isset($post['electLower']) ? (int)$post['electLower'][$key] : 0,
          "electUnit" => isset($post['electUnit']) ? $post['electUnit'][$key] : '',
          "electResult" => $post['electResult'][$key],
        ];
      }
    }

    $propFormUkur = [];
    if (isset($post['ukurSubjectFormUkur'])) {
      foreach ($post['ukurSubjectFormUkur'] as $key => $value) {
        $propFormUkur[$key] = [
          "idUkur" => isset($post['idUkurFormUkur'][$key]) ? (int)$post['idUkurFormUkur'][$key] : 0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "ukurSubject" => $post['ukurSubjectFormUkur'][$key],
          "ukurUnit" => $post['ukurUnitFormUkur'][$key],
          "ukurSet" => (int)$post['ukurSetFormUkur'][$key],
          "ukurVal" => (int)$post['ukurVal'][$key],
          "ukurMin" => (int)$post['ukurMinFormUkur'][$key],
          "ukurMax" => (int)$post['ukurMaxFormUkur'][$key],
          "ukurAvg" => isset($post['ukurAvgFormUkur'][$key]) ? (int)$post['ukurAvgFormUkur'][$key] : 0,
          "ukurResult" => $post['ukurResultFormUkur'][$key], //$post['ukurResultFormUkur'][$key]
        ];
      }
    }

    $propFormPart = [];
    if (!empty($post['idAssetPart'])) {
      foreach ($post['idAssetPart'] as $key => $value) {
        $propFormPart[] = [
          "idFPart" => isset($post['idFPart'][$key]) ? (int)$post['idFPart'][$key] : 0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "idAssetPart" => $post['idAssetPart'][$key],
          "partName" => $post['partName'][$key],
          "partQTY" => (int)$post['partQTY'][$key],
          "partPrice" => $post['partPrice'][$key],
        ];
      }
    }

    $propFormEncon = [
      "idFpEncon" => isset($post['idFpEncon']) ? (int)$post['idFpEncon'] : 0,
      "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
      "idTemplate" =>  0,
      "tempStart" => !empty($post['tempStartFormEncon']) ? $post['tempStartFormEncon'] : 0,
      "tempEnd" => 0,
      "humidityStart" => !empty($post['humidityStartFormEncon']) ? $post['humidityStartFormEncon'] : 0,
      "humidityEnd" => 0
    ];

    $propFormEqdata = [
      "idFpEqdata" => isset($post['idFpEqdata']) ? (int)$post['idFpEqdata'] : 0,
      "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
      "idTemplate" =>  0,
      "eqCode" => $post['eqCodeFormEqdata'],
      "eqName" => $post['eqNameFormEqdata'],
      "eqMerk" => $post['eqMerkFormEqdata'],
      "eqType" => $post['eqTypeFormEqdata'],
      "eqSN" => $post['eqSNFormEqdata'],
      "eqLocation" => $post['eqLocationFormEqdata'],
      "idAsset" => $post['idAssetSignature'],
      "createdDate" => date('Y-m-d H:i:s')
    ];

    $propFormGen = [];
    if (isset($post['genActionFormGen'])) {
      foreach ($post['genActionFormGen'] as $key => $value) {
        $propFormGen[$key] = [
          "idGen" => isset($post['idGenFormGen'][$key]) ? (int)$post['idGenFormGen'][$key] : 0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "genAction" => !empty($post['genActionFormGen'][$key]) ? $post['genActionFormGen'][$key] : "",
          "genResult" => !empty($post['genResult'][$key]) ? $post['genResult'][$key] : ""
        ];
      }
    }

    $propFormFisfung = [];
    if (isset($post['fisfungItem'])) {
      foreach ($post['fisfungItem'] as $key => $value) {
        $propFormFisfung[$key] = [
          "idFisfung" => isset($post['idFisfung'][$key]) ? (int)$post['idFisfung'][$key] : 0,
          "idTemplate" =>  0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "fisfungItem" => $post['fisfungItem'][$key],
          "fisfungResult" => !empty($post['fisfungResult'][$key]) ? $post['fisfungResult'][$key] : ""
        ];
      }
    }

    $propFormTemplateitem = [
      "idTmpItem" => isset($post['idTmpItem']) ? (int)$post['idTmpItem'] : 0,
      "idTemplate" =>  0,
      "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
      "tmpitemEQ" => false,
      "tmpitemEngineer" => $post['tmpitemEngineer'] == "true" ? true : false,
      "tmpitemAlkur" => $post['tmpitemAlkur'] == "true" ? true : false,
      "tmpitemTools" => $post['tmpitemTools'] == "true" ? true : false,
      "tmpitemEncon" => $post['tmpitemEncon'] == "true" ? true : false,
      "tmpitemESM" =>   $post['tmpitemESM'] == "true" ? true : false,
      "tmpitemFisfung" => $post['tmpitemFisfung'] == "true" ? true : false,
      "tmpitemPerf" => $post['tmpitemPerf'] == "true" ? true : false,
      "tmpitemAction" => $post['tmpitemAction'] == "true" ? true : false,
      "tmpitemUseVendor" => $post['tmpitemUseVendor'] == "true" ? true : false,
      "tmpitemSignMode" =>   false,
    ];

    $propTaskMaterial = [];
    if (!empty($post['idAssetMaintenanceMaterial'])) {
      foreach ($post['idAssetMaintenanceMaterial'] as $key => $value) {
        $propTaskMaterial[] = [
          "idTaskMaterial" => isset($post['idTaskMaterial'][$key]) ? (int)$post['idTaskMaterial'][$key] : 0,
          "idTask" => isset($post['idTask']) ? (int)$post['idTask'] : 0,
          "materialName" => $post['assetNameMaintenanceMaterial'][$key],
          "materialQty" => (int)$post['assetQuantityMaintenanceMaterial'][$key],
          "materialCost" => $post['assetTotalPriceMaintenanceMaterial'][$key],
        ];
      }
    }



    $form['propFormAlkur'] = $propFormAlkur;
    $form['propFormTools'] = $propFormTools;
    $form['propFormElect'] = $propFormElect;
    $form['propFormEncon'] = $propFormEncon;
    $form['propFormEqdata'] = $propFormEqdata;
    $form['propFormGen'] = $propFormGen;
    $form['propFormUkur'] = $propFormUkur;
    $form['propFormPart'] = $propFormPart;
    $form['propFormPic'] = !empty($_SESSION['sesspropFormPic']) ? $_SESSION['sesspropFormPic'] : [];
    $form['propFormFisfung'] = $propFormFisfung;
    $form['propFormTemplateitem'] = $propFormTemplateitem;

    // echo json_encode($form);
    // die;
    $insert = $this->m_form->formInsert($form);
    // echo json_encode($insert);
    // die;

    $task = $this->m_task->taskById($post['idTask']);

    if (isset($post['idStartBy'])) {
      $task['data']['propProgress']['startBy'] = $this->session->userdata('username');
      $task['data']['propProgress']['idStartBy'] = $this->session->userdata('id_user');
      $task['data']['propProgress']['timeStart'] = date('Y-m-d H:i:s');

      $task['data']['propProgress']['finishBy'] =  $this->session->userdata('username');
      $task['data']['propProgress']['idFinishBy'] = $this->session->userdata('id_user');
      $task['data']['propProgress']['timeFinish'] = date('Y-m-d H:i:s');
    }


    // if (isset($post['idDelegator'])) {
    //   $task['data']['propProgress']['delegateBy'] = $post['delegateBy'];
    //   $task['data']['propProgress']['idDelegator'] = (int)$post['idDelegator'];
    //   $task['data']['propProgress']['timeDelegate'] = date('Y-m-d H:i:s');
    // }

    if (!empty($post['idVendor'])) {
      $task['data']['idVendor'] = $post['idVendor'];
    } else {
      $task['data']['idVendor'] = 0;
    }

    if ($_FILES['file_maintenance_result']['name'] == '') {
      $task_files[] = $this->m_task_files->data(
        $post['idTaskFile'] ? $post['idTaskFile'] : 0,
        $post['idTask'] ? $post['idTask'] : 0,
        $post['idFile'] ? $post['idFile'] : 0,
        $post['fileDesc'] //fileDesc
      );
    } else {

      $task_file = $_FILES['file_maintenance_result'] ? $this->task_file_upload($_FILES['file_maintenance_result']) : '';

      if (isset($task_file['queryResult'])) {
        if ($task_file['queryResult'] == true) {
          $task_files[] = $this->m_task_files->data(
            $post['idTaskFile'] ? $post['idTaskFile'] : 0,
            $post['idTask'] ? $post['idTask'] : 0,
            $post['idFile'] ? $post['idFile'] : $task_file['data']['idFile'],
            $_FILES['file_maintenance_result']['name'] //fileDesc
          );
        }
      }
    }

    $task_files_insert = [];
    foreach ($task_files as $task_file) {
      if ($task_file['idFile'] != 0) {
        $task_files_insert[] = $task_file;
      }
    }

    $get_form = $this->m_form->formById((int)$insert['data']);

    $task['data']['taskKpi'] = isset($post['kpi_point']) ? $post['kpi_point'] : 0;

    $task['data']['taskAmount'] = isset($post['service_price']) ? $post['service_price'] : 0;

    $task['data']['propTaskMaintenance'][0]['maintenanceNote'] = $post['maintenanceNote'];
    $task['data']['propTaskMaintenance'][0]['maintenanceResult'] = !empty($post['finalResult']) ? $post['finalResult'] : "";
    $task['data']['propTaskMaintenance'][0]['idForm'] = (int)$insert['data'];
    $task['data']['propTaskMaintenance'][0]['propForm'] = $get_form['data'];
    $task['data']['propTaskMaterial'] = !empty($propTaskMaterial) ? $propTaskMaterial : [];
    $task['data']['propTaskFiles'] = $task_files_insert;


    $task_update = $this->m_task->taskUpdate($task['data']);

    $get_asset = $this->m_asset->assetById($post['idAssetSignature']);
    $get_asset['data']['propAssetPropadmin']['condition'] = $post['finalResult'];

    $this->m_asset->assetUpdate($get_asset['data']);

    if ($insert['queryResult'] == true && $task_update['queryResult'] == true) {
      $this->session->unset_userdata('sesspropFormPic');
      $this->session->set_userdata('sesspropFormPic', []);
      echo json_encode($task_update);
      die;
      // $message = !empty($insert['queryMessage']) || !empty($task_update['queryMessage']) ? $insert['queryMessage'] . $task_update['queryMessage'] : 'Failed';
      // $this->session->set_flashdata('error', $message);
    } else {
      $this->session->unset_userdata('sesspropFormPic');
      $this->session->set_userdata('sesspropFormPic', []);

      echo json_encode([
        "queryResult" => false,
        "queryMessage"  => "Data, failed to save!"
      ]);
      die;
      // $this->session->set_flashdata('sukses', "Success, data insert report form successfully");
    }
  }

  public function store_form_old_edit()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    $form = [
      'idForm'    => !empty($post['idForm']) ? $post['idForm'] : 0,
      'idFormType'    => 2,
      'formName'    => !empty($post['ftName']) ? $post['ftName'] : "",
      'formCode'    => !empty($post['ftCode']) ? $post['ftCode'] : "",
      'finalResult'    => !empty($post['finalResult']) ? $post['finalResult'] : "",
      'finalNote'    => !empty($post['finalNote']) ? $post['finalNote'] : "",
    ];

    if (isset($post['idAssetFormAlkur'])) {
      foreach ($post['idAssetFormAlkur'] as $key => $value) {
        $propFormAlkur[] = [
          "idFpAlkur" => (int)$post['idFpAlkur'][$key],
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => 0,
          "idAsset" => (int)$post['idAssetFormAlkur'][$key],
          "assetName" => $post['assetNameFormAlkur'][$key],
          "assetMerk" => $post['assetMerkFormAlkur'][$key],
          "assetType" => $post['assetTypeFormAlkur'][$key],
          "assetSN" => $post['assetSNFormAlkur'][$key]
        ];
      }
    }

    if (isset($post['idAssetFormTools'])) {
      foreach ($post['idAssetFormTools'] as $key => $value) {
        $propFormTools[] = [
          "idFpTools" => (int)$post['idFpTools'][$key],
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" => 0,
          "idAsset" => (int)$post['idAssetFormTools'][$key],
          "assetName" => $post['assetNameFormTools'][$key],
          "assetMerk" => $post['assetMerkFormTools'][$key],
          "assetType" => $post['assetTypeFormTools'][$key],
          "assetSN" => $post['assetSNFormTools'][$key]
        ];
      }
    }

    $propFormElect = [];
    if (isset($post['electParam'])) {
      foreach ($post['electParam'] as $key => $value) {
        $propFormElect[$key] = [
          "idFpElect"   => (int)$post['idFpElect'][$key],
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "electParam" => $post['electParam'][$key],
          "electMeasure" => isset($post['electMeasure']) ? (int)$post['electMeasure'][$key] : 0,
          "electUpper" => isset($post['electUpper']) ? (int)$post['electUpper'][$key] : 0,
          "electLower" => isset($post['electLower']) ? (int)$post['electLower'][$key] : 0,
          "electUnit" => isset($post['electUnit']) ? $post['electUnit'][$key] : '',
          "electResult" => $post['electResult'][$key],
        ];
      }
    }

    $propFormUkur = [];
    if (isset($post['ukurSubjectFormUkur'])) {
      foreach ($post['ukurSubjectFormUkur'] as $key => $value) {
        $propFormUkur[$key] = [
          "idUkur" => isset($post['idUkurFormUkur'][$key]) ? (int)$post['idUkurFormUkur'][$key] : 0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "ukurSubject" => $post['ukurSubjectFormUkur'][$key],
          "ukurUnit" => $post['ukurUnitFormUkur'][$key],
          "ukurSet" => (int)$post['ukurSetFormUkur'][$key],
          "ukurVal" => (int)$post['ukurVal'][$key],
          "ukurMin" => (int)$post['ukurMinFormUkur'][$key],
          "ukurMax" => (int)$post['ukurMaxFormUkur'][$key],
          "ukurAvg" => isset($post['ukurAvgFormUkur'][$key]) ? (int)$post['ukurAvgFormUkur'][$key] : 0,
          "ukurResult" => $post['ukurResultFormUkur'][$key], //$post['ukurResultFormUkur'][$key]
        ];
      }
    }

    $propFormPart = [];
    if (!empty($post['idAssetPart'])) {
      foreach ($post['idAssetPart'] as $key => $value) {
        $propFormPart[] = [
          "idFPart" => isset($post['idFPart'][$key]) ? (int)$post['idFPart'][$key] : 0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "idAssetPart" => $post['idAssetPart'][$key],
          "partName" => $post['partName'][$key],
          "partQTY" => (int)$post['partQTY'][$key],
          "partPrice" => $post['partPrice'][$key],
        ];
      }
    }


    $propFormEncon = [
      "idFpEncon" => isset($post['idFpEncon']) ? (int)$post['idFpEncon'] : 0,
      "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
      "idTemplate" =>  0,
      "tempStart" => !empty($post['tempStartFormEncon']) ? $post['tempStartFormEncon'] : 0,
      "tempEnd" => 0,
      "humidityStart" => !empty($post['humidityStartFormEncon']) ? $post['humidityStartFormEncon'] : 0,
      "humidityEnd" => 0
    ];

    $propFormEqdata = [
      "idFpEqdata" => isset($post['idFpEqdata']) ? (int)$post['idFpEqdata'] : 0,
      "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
      "idTemplate" =>  0,
      "eqCode" => $post['eqCodeFormEqdata'],
      "eqName" => $post['eqNameFormEqdata'],
      "eqMerk" => $post['eqMerkFormEqdata'],
      "eqType" => $post['eqTypeFormEqdata'],
      "eqSN" => $post['eqSNFormEqdata'],
      "eqLocation" => $post['eqLocationFormEqdata'],
      "idAsset" => $post['idAssetSignature'],
      "createdDate" => date('Y-m-d H:i:s')
    ];

    $propFormGen = [];
    if (isset($post['genActionFormGen'])) {
      foreach ($post['genActionFormGen'] as $key => $value) {
        $propFormGen[$key] = [
          "idGen" => isset($post['idGenFormGen'][$key]) ? (int)$post['idGenFormGen'][$key] : 0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "idTemplate" =>  0,
          "genAction" => !empty($post['genActionFormGen'][$key]) ? $post['genActionFormGen'][$key] : "",
          "genResult" => !empty($post['genResult'][$key]) ? $post['genResult'][$key] : ""
        ];
      }
    }

    $propFormFisfung = [];
    if (isset($post['fisfungItem'])) {
      foreach ($post['fisfungItem'] as $key => $value) {
        $propFormFisfung[$key] = [
          "idFisfung" => isset($post['idFisfung'][$key]) ? (int)$post['idFisfung'][$key] : 0,
          "idTemplate" =>  0,
          "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
          "fisfungItem" => $post['fisfungItem'][$key],
          "fisfungResult" => !empty($post['fisfungResult'][$key]) ? $post['fisfungResult'][$key] : ""
        ];
      }
    }

    $propFormTemplateitem = [
      "idTmpItem" => isset($post['idTmpItem']) ? (int)$post['idTmpItem'] : 0,
      "idTemplate" =>  0,
      "idForm" => isset($post['idForm']) ? (int)$post['idForm'] : 0,
      "tmpitemEQ" => false,
      "tmpitemEngineer" => $post['tmpitemEngineer'] == "true" ? true : false,
      "tmpitemAlkur" => $post['tmpitemAlkur'] == "true" ? true : false,
      "tmpitemTools" => $post['tmpitemTools'] == "true" ? true : false,
      "tmpitemEncon" => $post['tmpitemEncon'] == "true" ? true : false,
      "tmpitemESM" =>   $post['tmpitemESM'] == "true" ? true : false,
      "tmpitemFisfung" => $post['tmpitemFisfung'] == "true" ? true : false,
      "tmpitemPerf" => $post['tmpitemPerf'] == "true" ? true : false,
      "tmpitemAction" => $post['tmpitemAction'] == "true" ? true : false,
      "tmpitemUseVendor" => $post['tmpitemUseVendor'] == "true" ? true : false,
      "tmpitemSignMode" =>   false,
    ];

    $propTaskMaterial = [];
    if (!empty($post['idAssetMaintenanceMaterial'])) {
      foreach ($post['idAssetMaintenanceMaterial'] as $key => $value) {
        $propTaskMaterial[] = [
          "idTaskMaterial" => isset($post['idTaskMaterial'][$key]) ? (int)$post['idTaskMaterial'][$key] : 0,
          "idTask" => isset($post['idTask']) ? (int)$post['idTask'] : 0,
          "materialName" => $post['assetNameMaintenanceMaterial'][$key],
          "materialQty" => (int)$post['assetQuantityMaintenanceMaterial'][$key],
          "materialCost" => $post['assetTotalPriceMaintenanceMaterial'][$key],
        ];
      }
    }



    $form['propFormAlkur'] = $propFormAlkur;
    $form['propFormTools'] = $propFormTools;
    $form['propFormElect'] = $propFormElect;
    $form['propFormEncon'] = $propFormEncon;
    $form['propFormEqdata'] = $propFormEqdata;
    $form['propFormGen'] = $propFormGen;
    $form['propFormUkur'] = $propFormUkur;
    $form['propFormPart'] = $propFormPart;
    $pic = $this->m_form_pic->by_idform($post['idForm']);
    $form['propFormPic'] = $pic['data'];
    $form['propFormFisfung'] = $propFormFisfung;
    $form['propFormTemplateitem'] = $propFormTemplateitem;

    // echo json_encode($form);
    // die;
    $insert = $this->m_form->formUpdate($form);

    $task = $this->m_task->taskById($post['idTaskSignature']);


    if (!empty($post['idVendor'])) {
      $task['data']['idVendor'] = $post['idVendor'];
    } else {
      $task['data']['idVendor'] = 0;
    }

    if ($_FILES['file_maintenance_result']['name'] == '') {
      $task_files[] = $this->m_task_files->data(
        $post['idTaskFile'] ? $post['idTaskFile'] : 0,
        $post['idTask'] ? $post['idTask'] : 0,
        $post['idFile'] ? $post['idFile'] : 0,
        $post['fileDesc'] //fileDesc
      );
    } else {

      $task_file = $_FILES['file_maintenance_result'] ? $this->task_file_upload($_FILES['file_maintenance_result']) : '';

      if (isset($task_file['queryResult'])) {
        if ($task_file['queryResult'] == true) {
          $task_files[] = $this->m_task_files->data(
            $post['idTaskFile'] ? $post['idTaskFile'] : 0,
            $post['idTask'] ? $post['idTask'] : 0,
            $post['idFile'] ? $post['idFile'] : $task_file['data']['idFile'],
            $_FILES['file_maintenance_result']['name'] //fileDesc
          );
        }
      }
    }

    $task_files_insert = [];
    foreach ($task_files as $task_file) {
      if ($task_file['idFile'] != 0) {
        $task_files_insert[] = $task_file;
      }
    }

    $get_form = $this->m_form->formById((int)$post['idForm']);

    $task['data']['taskKpi'] = isset($post['kpi_point']) ? $post['kpi_point'] : 0;
    $task['data']['taskAmount'] = isset($post['service_price']) ? $post['service_price'] : 0;
    $task['data']['propTaskMaintenance'][0]['maintenanceNote'] = $post['maintenanceNote'];
    $task['data']['propTaskMaintenance'][0]['maintenanceResult'] = !empty($post['finalResult']) ? $post['finalResult'] : "";
    $task['data']['propTaskMaintenance'][0]['idForm'] = (int)$post['idForm'];
    $task['data']['propTaskMaintenance'][0]['propForm'] = $get_form['data'];
    $task['data']['propTaskMaterial'] = !empty($propTaskMaterial) ? $propTaskMaterial : [];
    $task['data']['propTaskFiles'] = $task_files_insert;



    $task_update = $this->m_task->taskUpdate($task['data']);

    $get_asset = $this->m_asset->assetById($post['idAssetSignature']);
    $get_asset['data']['propAssetPropadmin']['condition'] = $post['finalResult'];

    $this->m_asset->assetUpdate($get_asset['data']);


    if ($insert['queryResult'] == true && $task_update['queryResult'] == true) {
      $this->session->unset_userdata('sesspropFormPic');
      $this->session->set_userdata('sesspropFormPic', []);
      echo json_encode($task_update);
      die;
      // $message = !empty($insert['queryMessage']) || !empty($task_update['queryMessage']) ? $insert['queryMessage'] . $task_update['queryMessage'] : 'Failed';
      // $this->session->set_flashdata('error', $message);
    } else {
      $this->session->unset_userdata('sesspropFormPic');
      $this->session->set_userdata('sesspropFormPic', []);

      echo json_encode([
        "queryResult" => false,
        "queryMessage"  => "Data, failed to save!"
      ]);
      die;
      // $this->session->set_flashdata('sukses', "Success, data insert report form successfully");
    }
  }

  public function store_form_schedule_edit()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    $task = $this->m_task->taskById($post['idTaskEditTimes']);

    $task['data']['propSchedule']['scheduleStart'] = $post['scheduleStartEdit'];
    $task['data']['propSchedule']['scheduleEnd'] = $post['scheduleStartEdit'];
    $task['data']['propTaskMaintenance'][0]['idFormTemplate'] = $post['formTemplateEdit'];

    // echo json_encode($task['data']);
    // die;

    $task_update = $this->m_task->taskUpdate($task['data']);

    echo json_encode($task_update);
    die;
  }

  public function store()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $post = $this->security->xss_clean($this->input->post());

    //insert data ke dalam segment task
    $task = $this->m_task->data(
      !empty($post['idTask']) ? $post['idTask'] : 0,
      $taskCode = 'NMTN', //maintenance
      !empty($post['idProgress']) ? $post['idProgress'] : 0,
      !empty($post['idSchedule']) ? $post['idSchedule'] : 0,
      !empty($post['idRelatedTask']) ? $post['idRelatedTask'] : 0,
      !empty($post['taskType']) ? $post['taskType'] : '',
      $taskName = 'MAINTENANCE',
      $taskDesc = 'MAINTENANCE',
      !empty($post['idVendor']) ? $post['idVendor'] : 0,
      !empty($post['taskKpi']) ? $post['taskKpi'] : 0,
      !empty($post['taskAmount']) ? $post['taskAmount'] : 0,
      'NON'
    );

    $schedule = $this->m_schedule->data(
      $post['idSchedule'],
      $parentSchedule = 0,
      $scheduleType = $post['scheduleType'], //$post['scheduleType'],
      $scheduleName = 'MAINTENANCE',
      $scheduleDesc = 'MAINTENANCE',
      $post['scheduleStart'],
      $post['scheduleEnd'], //$post['scheduleEnd'],
      $dayRepeat = '',
      $createBy = $this->session->userdata('username'),
      'NON'
    );

    $progress = $this->m_progress->data(
      $post['idProgress'] ? $post['idProgress'] : 0,
      $progressStatus = '',
      $timeInit = '',
      $timeRespon = '',
      $timeStart = '',
      $timeFinish = '',
      $timePending = '',
      $timeApproved = '',
      $timeDelegate = '',
      $timeAssign = date('Y-m-d H:i:s'),
      $idInitBy = '',
      $idResponBy = 0,
      $idStartBy = 0,
      $idFinishBy = 0,
      $idPendingBy = 0,
      $idApproveBy = 0,
      $idAssignee = isset($post['idAssignee']) ? $post['idAssignee'] : 0,
      $idDelegator = 0,
      $initBy = '',
      $responBy = '',
      $startBy = '',
      $finishBy = '',
      $pendingBy = '',
      $approveBy = '',
      $delegateBy = '',
      $assignTo = isset($post['assignTo']) ? $post['assignTo'] : 0
    );


    if ($post['formType'] == 'add') {
      $task['propProgress'] = $progress;
      $task['propSchedule'] = $schedule;
      if (empty($post['idAsset'])) {
        echo json_encode([
          "queryResult" => false,
          "queryMessage"  => "Asset data is null, please select asset data!"
        ]);
        die;
      }
      foreach ($post['idAsset'] as $key => $value) {
        // clear array terlebih dahulu
        $taskMaintenance = [];

        $taskMaintenance[] = $this->m_task_maintenance->data(
          $post['idTask'] ? $post['idTask'] : 0,
          $post['idAsset'][$key],
          $isNeedPart = 0,
          !empty($post['idForm']) ? $post['idForm'] : 0,
          // $idForm = 0,
          $post['formTemplate'][$key],
          $maintenanceResult = '',
          $maintenanceNote = ''
        );

        $task['propTaskMaintenance'] = $taskMaintenance;


        $task_insert = $this->m_task->taskAutoInsert($task);
      }
      $this->session->unset_userdata('idAssetSelected');
      echo json_encode($task_insert);
      die;
    }
  }

  public function report()
  {
    $q1 = htmlspecialchars($this->input->post('q1'));
    $v1 = htmlspecialchars($this->input->post('v1'));
    $q2 = htmlspecialchars($this->input->post('q2'));
    $v2 = htmlspecialchars($this->input->post('v2'));
    $q3 = htmlspecialchars($this->input->post('q3'));
    $v3 = htmlspecialchars($this->input->post('v3'));
    $bq3 = htmlspecialchars($this->input->post('bq3'));
    $bv3 = htmlspecialchars($this->input->post('bv3'));
    $q4 = htmlspecialchars($this->input->post('q4'));
    $v4 = htmlspecialchars($this->input->post('v4'));
    $bq4 = htmlspecialchars($this->input->post('bq4'));
    $bv4 = htmlspecialchars($this->input->post('bv4'));
    $q5 = htmlspecialchars($this->input->post('q5'));
    $v5 = htmlspecialchars($this->input->post('v5'));
    $bq5 = htmlspecialchars($this->input->post('bq5'));
    $bv5 = htmlspecialchars($this->input->post('bv5'));
    $q6 = htmlspecialchars($this->input->post('q6'));
    $v6 = htmlspecialchars($this->input->post('v6'));
    $bq6 = htmlspecialchars($this->input->post('bq6'));
    $bv6 = htmlspecialchars($this->input->post('bv6'));
    $q7 = htmlspecialchars($this->input->post('q7'));
    $v7 = htmlspecialchars($this->input->post('v7'));
    $bq7 = htmlspecialchars($this->input->post('bq7'));
    $bv7 = htmlspecialchars($this->input->post('bv7'));
    $q8 = htmlspecialchars($this->input->post('q8'));
    $v8 = htmlspecialchars($this->input->post('v8'));
    $bq8 = htmlspecialchars($this->input->post('bq8'));
    $bv8 = htmlspecialchars($this->input->post('bv8'));
    $q9 = htmlspecialchars($this->input->post('q9'));
    $v9 = htmlspecialchars($this->input->post('v9'));
    $bq9 = htmlspecialchars($this->input->post('bq9'));
    $bv9 = htmlspecialchars($this->input->post('bv9'));
    $q10 = htmlspecialchars($this->input->post('q10'));
    $v10 = htmlspecialchars($this->input->post('v10'));
    $bq10 = htmlspecialchars($this->input->post('bq10'));
    $bv10 = htmlspecialchars($this->input->post('bv10'));

    $startDateq3 = htmlspecialchars($this->input->post('startDateq3'));
    $startDatev3 = htmlspecialchars($this->input->post('startDatev3'));
    $startDatebq3 = htmlspecialchars($this->input->post('startDatebq3'));
    $startDatebv3 = htmlspecialchars($this->input->post('startDatebv3'));

    $startDateq4 = htmlspecialchars($this->input->post('startDateq4'));
    $startDatev4 = htmlspecialchars($this->input->post('startDatev4'));
    $startDatebq4 = htmlspecialchars($this->input->post('startDatebq4'));
    $startDatebv4 = htmlspecialchars($this->input->post('startDatebv4'));

    $startDateq5 = htmlspecialchars($this->input->post('startDateq5'));
    $startDatev5 = htmlspecialchars($this->input->post('startDatev5'));
    $startDatebq5 = htmlspecialchars($this->input->post('startDatebq5'));
    $startDatebv5 = htmlspecialchars($this->input->post('startDatebv5'));

    $status = $this->input->post('status');
    $taskSysCat = "NON";
    $idRelatedTask = $this->input->post('idRelatedTask');
    $taskCode = "NMTN";

    $periode = $this->input->post('periode');

    $startDate = $this->input->post('startDate');
    $endDate = $this->input->post('endDate');

    $timeAssign = $this->input->post('timeAssign');
    $idAssignee = $this->input->post('idAssignee');
    $assignTo = $this->input->post('assignTo');

    $any_toogle = $this->input->post('toogle_signature');
    $lokasi_print = $this->input->post('lokasi_print');
    $tgl_print = $this->input->post('tgl_print');
    $button_pdf = $this->input->post('button_pdf');
    $button_excel = $this->input->post('button_excel');
    $officer = $this->input->post('officer');

    $data['any_toogle'] = $any_toogle;
    $data['lokasi_print'] = $lokasi_print;
    $data['tgl_print'] = $tgl_print;
    $data['officer'] = $officer;

    if ($button_pdf == 'pdf') {
      $query_params = [];
      $query_params_like_or = [];
      $query_params_where_between = [];

      $scheduleStart = '';
      $scheduleEnd = '';
      if ($periode != '') {
        if ($periode == 'this_year') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate;
          $scheduleStart = $secondDate->modify("-1 year");
        } elseif ($periode == 'last_year') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate->modify("-1 year");
          $scheduleStart = $secondDate->modify("-2 year");
        } elseif ($periode == 'next_year') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleStart = $firstDate;
          $scheduleEnd = $secondDate->modify("+1 year");
        } elseif ($periode == 'last_month') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate->modify("-1 month");
          $scheduleStart = $secondDate->modify("-2 month");
        } elseif ($periode == 'next_month') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleStart = $firstDate;
          $scheduleEnd = $secondDate->modify("+1 month");
        } elseif ($periode == 'this_month') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate;
          $scheduleStart = $secondDate->modify("-1 month");
        }
      }

      if ($periode != '') {

        $scheduleStart_query_params = [
          "column" => "scheduleStart",
          "value" => $scheduleStart->format('Y-m-d'),
        ];
        array_push($query_params_where_between, $scheduleStart_query_params);
      }

      if ($periode != '') {

        $scheduleEnd_query_params = [
          "column" => "scheduleEnd",
          "value" => $scheduleEnd->format('Y-m-d'),
        ];
        array_push($query_params_where_between, $scheduleEnd_query_params);
      }
      ///////// ADVANCED SEACRH DATE ///////////////////
      if ($startDateq3 != '') {

        $startDateq3_query_params = [
          "column" => $startDateq3,
          "value" => $startDatev3,
        ];
        array_push($query_params_where_between, $startDateq3_query_params);
      }

      if ($startDatebq3 != '') {

        $startDatebq3_query_params = [
          "column" => $startDatebq3,
          "value" => $startDatebv3,
        ];
        array_push($query_params_where_between, $startDatebq3_query_params);
      }

      if ($startDateq4 != '') {

        $startDateq4_query_params = [
          "column" => $startDateq4,
          "value" => $startDatev4,
        ];
        array_push($query_params_where_between, $startDateq4_query_params);
      }

      if ($startDatebq4 != '') {

        $startDatebq4_query_params = [
          "column" => $startDatebq4,
          "value" => $startDatebv4,
        ];
        array_push($query_params_where_between, $startDatebq4_query_params);
      }

      if ($startDateq5 != '') {

        $startDateq5_query_params = [
          "column" => $startDateq5,
          "value" => $startDatev5,
        ];
        array_push($query_params_where_between, $startDateq5_query_params);
      }

      if ($startDatebq5 != '') {

        $startDatebq5_query_params = [
          "column" => $startDatebq5,
          "value" => $startDatebv5,
        ];
        array_push($query_params_where_between, $startDatebq5_query_params);
      }

      ///////// ADVANCED SEACRH DATE ///////////////////


      if ($idRelatedTask != '') {
        $idRelatedTask_query_params = [
          "column" => "idRelatedTask",
          "value" => (int)$idRelatedTask
        ];
        array_push($query_params, $idRelatedTask_query_params);
      }

      if ($timeAssign != '') {
        $timeAssign_query_params = [
          "column" => "timeAssign",
          "value" => $timeAssign
        ];
        array_push($query_params, $timeAssign_query_params);
      }

      if ($idAssignee != '') {
        $idAssignee_query_params = [
          "column" => "idAssignee",
          "value" => $idAssignee
        ];
        array_push($query_params, $idAssignee_query_params);
      }

      if ($assignTo != '') {
        $assignTo_query_params = [
          "column" => "assignTo",
          "value" => $assignTo
        ];
        array_push($query_params, $assignTo_query_params);
      }

      if ($taskSysCat != 'ALL') {
        if ($taskSysCat != '') {
          $taskSysCat_query_params = [
            "column" => "taskSysCat",
            "value" => $taskSysCat
          ];
          array_push($query_params, $taskSysCat_query_params);
        }
      }

      if ($taskCode != 'ALL') {
        if ($taskCode != '') {
          $taskCode_query_params = [
            "column" => "taskCode",
            "value" => strtoupper($taskCode)
          ];
          array_push($query_params, $taskCode_query_params);
        }
      }

      if ($q1 != '') {

        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q1_query_params = [
            "column" => $q1,
            "value" => $v1
          ];
          array_push($query_params_like_or, $q1_query_params);
        } else {
          $q1_query_params = [
            "column" => $q1,
            "value" => $v1
          ];

          array_push($query_params, $q1_query_params);
        }
      }

      if ($q2 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q2_query_params = [
            "column" => $q2,
            "value" => $v2
          ];
          array_push($query_params_like_or, $q2_query_params);
        } else {
          $q2_query_params = [
            "column" => $q2,
            "value" => $v2
          ];

          array_push($query_params, $q2_query_params);
        }
      }

      if ($q3 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q3_query_params = [
            "column" => $q3,
            "value" => $v3
          ];
          array_push($query_params_like_or, $q3_query_params);
        } else {
          $q3_query_params = [
            "column" => $q3,
            "value" => $v3
          ];

          array_push($query_params, $q3_query_params);
        }
      }

      if ($bq3 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq3_query_params = [
            "column" => $bq3,
            "value" => $bv3
          ];
          array_push($query_params_like_or, $bq3_query_params);
        } else {
          $bq3_query_params = [
            "column" => $bq3,
            "value" => $bv3
          ];

          array_push($query_params, $bq3_query_params);
        }
      }

      if ($q4 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q4_query_params = [
            "column" => $q4,
            "value" => $v4
          ];
          array_push($query_params_like_or, $q4_query_params);
        } else {
          $q4_query_params = [
            "column" => $q4,
            "value" => $v4
          ];

          array_push($query_params, $q4_query_params);
        }
      }

      if ($bq4 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq4_query_params = [
            "column" => $bq4,
            "value" => $bv4
          ];
          array_push($query_params_like_or, $bq4_query_params);
        } else {
          $bq4_query_params = [
            "column" => $bq4,
            "value" => $bv4
          ];

          array_push($query_params, $bq4_query_params);
        }
      }

      if ($q5 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q5_query_params = [
            "column" => $q5,
            "value" => $v5
          ];
          array_push($query_params_like_or, $q5_query_params);
        } else {
          $q5_query_params = [
            "column" => $q5,
            "value" => $v5
          ];

          array_push($query_params, $q5_query_params);
        }
      }

      if ($bq5 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq5_query_params = [
            "column" => $bq5,
            "value" => $bv5
          ];
          array_push($query_params_like_or, $bq5_query_params);
        } else {
          $bq5_query_params = [
            "column" => $bq5,
            "value" => $bv5
          ];

          array_push($query_params, $bq5_query_params);
        }
      }

      if ($q6 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q6_query_params = [
            "column" => $q6,
            "value" => $v6
          ];
          array_push($query_params_like_or, $q6_query_params);
        } else {
          $q6_query_params = [
            "column" => $q6,
            "value" => $v6
          ];

          array_push($query_params, $q6_query_params);
        }
      }

      if ($bq6 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq6_query_params = [
            "column" => $bq6,
            "value" => $bv6
          ];
          array_push($query_params_like_or, $bq6_query_params);
        } else {
          $bq6_query_params = [
            "column" => $bq6,
            "value" => $bv6
          ];

          array_push($query_params, $bq6_query_params);
        }
      }

      if ($q7 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q7_query_params = [
            "column" => $q7,
            "value" => $v7
          ];
          array_push($query_params_like_or, $q7_query_params);
        } else {
          $q7_query_params = [
            "column" => $q7,
            "value" => $v7
          ];

          array_push($query_params, $q7_query_params);
        }
      }

      if ($bq7 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq7_query_params = [
            "column" => $bq7,
            "value" => $bv7
          ];
          array_push($query_params_like_or, $bq7_query_params);
        } else {
          $bq7_query_params = [
            "column" => $q7,
            "value" => $v7
          ];

          array_push($query_params, $bq7_query_params);
        }
      }

      if ($q8 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q8_query_params = [
            "column" => $q8,
            "value" => $v8
          ];
          array_push($query_params_like_or, $q8_query_params);
        } else {
          $q8_query_params = [
            "column" => $q8,
            "value" => $v8
          ];

          array_push($query_params, $q8_query_params);
        }
      }

      if ($bq8 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq8_query_params = [
            "column" => $bq8,
            "value" => $bv8
          ];
          array_push($query_params_like_or, $bq8_query_params);
        } else {
          $bq8_query_params = [
            "column" => $bq8,
            "value" => $bv8
          ];

          array_push($query_params, $bq8_query_params);
        }
      }

      if ($q9 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q9_query_params = [
            "column" => $q9,
            "value" => $v9
          ];
          array_push($query_params_like_or, $q9_query_params);
        } else {
          $q9_query_params = [
            "column" => $q9,
            "value" => $v9
          ];

          array_push($query_params, $q9_query_params);
        }
      }

      if ($bq9 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq9_query_params = [
            "column" => $bq9,
            "value" => $bv9
          ];
          array_push($query_params_like_or, $bq9_query_params);
        } else {
          $bq9_query_params = [
            "column" => $bq9,
            "value" => $bv9
          ];

          array_push($query_params, $bq9_query_params);
        }
      }

      if ($q10 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q10_query_params = [
            "column" => $q10,
            "value" => $v10
          ];
          array_push($query_params_like_or, $q10_query_params);
        } else {
          $q10_query_params = [
            "column" => $q10,
            "value" => $v10
          ];

          array_push($query_params, $q10_query_params);
        }
      }

      if ($bq10 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq10_query_params = [
            "column" => $bq10,
            "value" => $bv10
          ];
          array_push($query_params_like_or, $bq10_query_params);
        } else {
          $bq10_query_params = [
            "column" => $bq10,
            "value" => $bv10
          ];

          array_push($query_params, $bq10_query_params);
        }
      }

      if ($status != '') {
        $progressStatus = '';
        if ($status == 1) {
          // belum di kerjakan
          $progressStatus = 'NEW-ASSIGNED';
        } else if ($status == 2) {
          // belum approve
          $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
        } else if ($status == 3) {
          // approve
          $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
        }

        $status_query_params = [
          "column" => "progressStatus",
          "value" => $progressStatus
        ];
        array_push($query_params, $status_query_params);
      }

      $query_groups_like_or = [];
      $query_groups_where_between = [];
      $query_groups = [];
      // if($q1 != '' || $q2 != '' || $status != '' || $taskSysCat) {
      if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $status != '' || $taskSysCat) {

        if (($q1 != '' && $q2 != '') || ($q3 != '' && $bq3 != '') || ($q4 != '' && $bq4 != '') ||  ($q5 != '' && $bq5 != '')  || ($q6 != '' && $bq6 != '') || ($q7 != '' && $bq7 != '') || ($q8 != '' && $bq8 != '') || ($q9 != '' && $bq9 != '') || ($q10 != '' && $bq10 != '')) {
          if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
            $query_groups_like_or = [
              [
                "queryMethod" => "LIKEOR",
                "queryParams" => $query_params_like_or
              ]
            ];
          }
        }

        $query_groups = [
          [
            "queryMethod" => "EXACTAND", //"LIKEAND",
            "queryParams" => $query_params
          ]
        ];
      }

      if ($periode != '' || $startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
        $query_groups_where_between = [
          [
            "queryMethod" => "BETWEEN",
            "queryParams" => $query_params_where_between
          ]
        ];
      }

      $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
      $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);



      $request = [
        "queryGroupMethod" => "AND",
        "queryGroups" => $query_params ? $merge_query_groups : [],
        "sortingParams" => [
          [
            "column" => "idTask",
            "value" => "desc"
          ]
        ],
        "withDetails" => true,
        "subDetails" => true,
      ];


      $data['tasks'] = $this->m_task->taskQuery($request);

      $mpdfConfig = array(
        'tempDir' => sys_get_temp_dir() . DIRECTORY_SEPARATOR,
        'mode' => 'utf-8',
        'format' => 'A4',    // format - A4, for example, default ''
        'margin_left' => 5,        // 15 margin_left
        'margin_right' => 5,        // 15 margin right
        // 'margin_top' => 5,        // 15 margin right
        // 'margin_bottom' => 5,        // 15 margin right
        'orientation' => 'L'      // L - landscape, P - portrait
      );
      $mpdf = new \Mpdf\Mpdf($mpdfConfig);
      $data['mpdf'] = $mpdf;
      $html = $this->load->view('task/electromedic_task/print/maintenance/pdf', $data, TRUE);
      $mpdf->WriteHTML($html);
      $mpdf->shrink_tables_to_fit = 1;
      $mpdf->Output();
    } else {
      $query_params = [];
      $query_params_like_or = [];
      $query_params_where_between = [];

      $scheduleStart = '';
      $scheduleEnd = '';
      if ($periode != '') {
        if ($periode == 'this_year') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate;
          $scheduleStart = $secondDate->modify("-1 year");
        } elseif ($periode == 'last_year') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate->modify("-1 year");
          $scheduleStart = $secondDate->modify("-2 year");
        } elseif ($periode == 'next_year') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleStart = $firstDate;
          $scheduleEnd = $secondDate->modify("+1 year");
        } elseif ($periode == 'last_month') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate->modify("-1 month");
          $scheduleStart = $secondDate->modify("-2 month");
        } elseif ($periode == 'next_month') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleStart = $firstDate;
          $scheduleEnd = $secondDate->modify("+1 month");
        } elseif ($periode == 'this_month') {

          $firstDate  = new DateTime(date('Y-m-d H:i:s'));
          $secondDate  = new DateTime(date('Y-m-d H:i:s'));

          $scheduleEnd = $firstDate;
          $scheduleStart = $secondDate->modify("-1 month");
        }
      }

      if ($periode != '') {

        $scheduleStart_query_params = [
          "column" => "scheduleStart",
          "value" => $scheduleStart->format('Y-m-d'),
        ];
        array_push($query_params_where_between, $scheduleStart_query_params);
      }

      if ($periode != '') {

        $scheduleEnd_query_params = [
          "column" => "scheduleEnd",
          "value" => $scheduleEnd->format('Y-m-d'),
        ];
        array_push($query_params_where_between, $scheduleEnd_query_params);
      }
      ///////// ADVANCED SEACRH DATE ///////////////////
      if ($startDateq3 != '') {

        $startDateq3_query_params = [
          "column" => $startDateq3,
          "value" => $startDatev3,
        ];
        array_push($query_params_where_between, $startDateq3_query_params);
      }

      if ($startDatebq3 != '') {

        $startDatebq3_query_params = [
          "column" => $startDatebq3,
          "value" => $startDatebv3,
        ];
        array_push($query_params_where_between, $startDatebq3_query_params);
      }

      if ($startDateq4 != '') {

        $startDateq4_query_params = [
          "column" => $startDateq4,
          "value" => $startDatev4,
        ];
        array_push($query_params_where_between, $startDateq4_query_params);
      }

      if ($startDatebq4 != '') {

        $startDatebq4_query_params = [
          "column" => $startDatebq4,
          "value" => $startDatebv4,
        ];
        array_push($query_params_where_between, $startDatebq4_query_params);
      }

      if ($startDateq5 != '') {

        $startDateq5_query_params = [
          "column" => $startDateq5,
          "value" => $startDatev5,
        ];
        array_push($query_params_where_between, $startDateq5_query_params);
      }

      if ($startDatebq5 != '') {

        $startDatebq5_query_params = [
          "column" => $startDatebq5,
          "value" => $startDatebv5,
        ];
        array_push($query_params_where_between, $startDatebq5_query_params);
      }

      ///////// ADVANCED SEACRH DATE ///////////////////


      if ($idRelatedTask != '') {
        $idRelatedTask_query_params = [
          "column" => "idRelatedTask",
          "value" => (int)$idRelatedTask
        ];
        array_push($query_params, $idRelatedTask_query_params);
      }

      if ($timeAssign != '') {
        $timeAssign_query_params = [
          "column" => "timeAssign",
          "value" => $timeAssign
        ];
        array_push($query_params, $timeAssign_query_params);
      }

      if ($idAssignee != '') {
        $idAssignee_query_params = [
          "column" => "idAssignee",
          "value" => $idAssignee
        ];
        array_push($query_params, $idAssignee_query_params);
      }

      if ($assignTo != '') {
        $assignTo_query_params = [
          "column" => "assignTo",
          "value" => $assignTo
        ];
        array_push($query_params, $assignTo_query_params);
      }

      if ($taskSysCat != 'ALL') {
        if ($taskSysCat != '') {
          $taskSysCat_query_params = [
            "column" => "taskSysCat",
            "value" => $taskSysCat
          ];
          array_push($query_params, $taskSysCat_query_params);
        }
      }

      if ($taskCode != 'ALL') {
        if ($taskCode != '') {
          $taskCode_query_params = [
            "column" => "taskCode",
            "value" => strtoupper($taskCode)
          ];
          array_push($query_params, $taskCode_query_params);
        }
      }

      if ($q1 != '') {

        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q1_query_params = [
            "column" => $q1,
            "value" => $v1
          ];
          array_push($query_params_like_or, $q1_query_params);
        } else {
          $q1_query_params = [
            "column" => $q1,
            "value" => $v1
          ];

          array_push($query_params, $q1_query_params);
        }
      }

      if ($q2 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q2_query_params = [
            "column" => $q2,
            "value" => $v2
          ];
          array_push($query_params_like_or, $q2_query_params);
        } else {
          $q2_query_params = [
            "column" => $q2,
            "value" => $v2
          ];

          array_push($query_params, $q2_query_params);
        }
      }

      if ($q3 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q3_query_params = [
            "column" => $q3,
            "value" => $v3
          ];
          array_push($query_params_like_or, $q3_query_params);
        } else {
          $q3_query_params = [
            "column" => $q3,
            "value" => $v3
          ];

          array_push($query_params, $q3_query_params);
        }
      }

      if ($bq3 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq3_query_params = [
            "column" => $bq3,
            "value" => $bv3
          ];
          array_push($query_params_like_or, $bq3_query_params);
        } else {
          $bq3_query_params = [
            "column" => $bq3,
            "value" => $bv3
          ];

          array_push($query_params, $bq3_query_params);
        }
      }

      if ($q4 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q4_query_params = [
            "column" => $q4,
            "value" => $v4
          ];
          array_push($query_params_like_or, $q4_query_params);
        } else {
          $q4_query_params = [
            "column" => $q4,
            "value" => $v4
          ];

          array_push($query_params, $q4_query_params);
        }
      }

      if ($bq4 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq4_query_params = [
            "column" => $bq4,
            "value" => $bv4
          ];
          array_push($query_params_like_or, $bq4_query_params);
        } else {
          $bq4_query_params = [
            "column" => $bq4,
            "value" => $bv4
          ];

          array_push($query_params, $bq4_query_params);
        }
      }

      if ($q5 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q5_query_params = [
            "column" => $q5,
            "value" => $v5
          ];
          array_push($query_params_like_or, $q5_query_params);
        } else {
          $q5_query_params = [
            "column" => $q5,
            "value" => $v5
          ];

          array_push($query_params, $q5_query_params);
        }
      }

      if ($bq5 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq5_query_params = [
            "column" => $bq5,
            "value" => $bv5
          ];
          array_push($query_params_like_or, $bq5_query_params);
        } else {
          $bq5_query_params = [
            "column" => $bq5,
            "value" => $bv5
          ];

          array_push($query_params, $bq5_query_params);
        }
      }

      if ($q6 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q6_query_params = [
            "column" => $q6,
            "value" => $v6
          ];
          array_push($query_params_like_or, $q6_query_params);
        } else {
          $q6_query_params = [
            "column" => $q6,
            "value" => $v6
          ];

          array_push($query_params, $q6_query_params);
        }
      }

      if ($bq6 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq6_query_params = [
            "column" => $bq6,
            "value" => $bv6
          ];
          array_push($query_params_like_or, $bq6_query_params);
        } else {
          $bq6_query_params = [
            "column" => $bq6,
            "value" => $bv6
          ];

          array_push($query_params, $bq6_query_params);
        }
      }

      if ($q7 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q7_query_params = [
            "column" => $q7,
            "value" => $v7
          ];
          array_push($query_params_like_or, $q7_query_params);
        } else {
          $q7_query_params = [
            "column" => $q7,
            "value" => $v7
          ];

          array_push($query_params, $q7_query_params);
        }
      }

      if ($bq7 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq7_query_params = [
            "column" => $bq7,
            "value" => $bv7
          ];
          array_push($query_params_like_or, $bq7_query_params);
        } else {
          $bq7_query_params = [
            "column" => $q7,
            "value" => $v7
          ];

          array_push($query_params, $bq7_query_params);
        }
      }

      if ($q8 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q8_query_params = [
            "column" => $q8,
            "value" => $v8
          ];
          array_push($query_params_like_or, $q8_query_params);
        } else {
          $q8_query_params = [
            "column" => $q8,
            "value" => $v8
          ];

          array_push($query_params, $q8_query_params);
        }
      }

      if ($bq8 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq8_query_params = [
            "column" => $bq8,
            "value" => $bv8
          ];
          array_push($query_params_like_or, $bq8_query_params);
        } else {
          $bq8_query_params = [
            "column" => $bq8,
            "value" => $bv8
          ];

          array_push($query_params, $bq8_query_params);
        }
      }

      if ($q9 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q9_query_params = [
            "column" => $q9,
            "value" => $v9
          ];
          array_push($query_params_like_or, $q9_query_params);
        } else {
          $q9_query_params = [
            "column" => $q9,
            "value" => $v9
          ];

          array_push($query_params, $q9_query_params);
        }
      }

      if ($bq9 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq9_query_params = [
            "column" => $bq9,
            "value" => $bv9
          ];
          array_push($query_params_like_or, $bq9_query_params);
        } else {
          $bq9_query_params = [
            "column" => $bq9,
            "value" => $bv9
          ];

          array_push($query_params, $bq9_query_params);
        }
      }

      if ($q10 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $q10_query_params = [
            "column" => $q10,
            "value" => $v10
          ];
          array_push($query_params_like_or, $q10_query_params);
        } else {
          $q10_query_params = [
            "column" => $q10,
            "value" => $v10
          ];

          array_push($query_params, $q10_query_params);
        }
      }

      if ($bq10 != '') {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $bq10_query_params = [
            "column" => $bq10,
            "value" => $bv10
          ];
          array_push($query_params_like_or, $bq10_query_params);
        } else {
          $bq10_query_params = [
            "column" => $bq10,
            "value" => $bv10
          ];

          array_push($query_params, $bq10_query_params);
        }
      }

      if ($status != '') {
        $progressStatus = '';
        if ($status == 1) {
          // belum di kerjakan
          $progressStatus = 'NEW-ASSIGNED';
        } else if ($status == 2) {
          // belum approve
          $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
        } else if ($status == 3) {
          // approve
          $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
        }

        $status_query_params = [
          "column" => "progressStatus",
          "value" => $progressStatus
        ];
        array_push($query_params, $status_query_params);
      }

      $query_groups_like_or = [];
      $query_groups_where_between = [];
      $query_groups = [];
      // if($q1 != '' || $q2 != '' || $status != '' || $taskSysCat) {
      if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $status != '' || $taskSysCat) {

        if (($q1 != '' && $q2 != '') || ($q3 != '' && $bq3 != '') || ($q4 != '' && $bq4 != '') ||  ($q5 != '' && $bq5 != '')  || ($q6 != '' && $bq6 != '') || ($q7 != '' && $bq7 != '') || ($q8 != '' && $bq8 != '') || ($q9 != '' && $bq9 != '') || ($q10 != '' && $bq10 != '')) {
          if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
            $query_groups_like_or = [
              [
                "queryMethod" => "LIKEOR",
                "queryParams" => $query_params_like_or
              ]
            ];
          }
        }

        $query_groups = [
          [
            "queryMethod" => "EXACTAND", //"LIKEAND",
            "queryParams" => $query_params
          ]
        ];
      }

      if ($periode != '' || $startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
        $query_groups_where_between = [
          [
            "queryMethod" => "BETWEEN",
            "queryParams" => $query_params_where_between
          ]
        ];
      }

      $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
      $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);



      $request = [
        "queryGroupMethod" => "AND",
        "queryGroups" => $query_params ? $merge_query_groups : [],
        "sortingParams" => [
          [
            "column" => "idTask",
            "value" => "desc"
          ]
        ],
        "withDetails" => true,
        "subDetails" => true,
      ];


      $data['tasks'] = $this->m_task->taskQuery($request);

      $this->load->view('task/electromedic_task/print/maintenance/excell', $data);
    }
  }

  public function data_table()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $q1 = htmlspecialchars($this->input->post('q1'));
    $v1 = htmlspecialchars($this->input->post('v1'));
    $q2 = htmlspecialchars($this->input->post('q2'));
    $v2 = htmlspecialchars($this->input->post('v2'));
    $q3 = htmlspecialchars($this->input->post('q3'));
    $v3 = htmlspecialchars($this->input->post('v3'));
    $bq3 = htmlspecialchars($this->input->post('bq3'));
    $bv3 = htmlspecialchars($this->input->post('bv3'));
    $q4 = htmlspecialchars($this->input->post('q4'));
    $v4 = htmlspecialchars($this->input->post('v4'));
    $bq4 = htmlspecialchars($this->input->post('bq4'));
    $bv4 = htmlspecialchars($this->input->post('bv4'));
    $q5 = htmlspecialchars($this->input->post('q5'));
    $v5 = htmlspecialchars($this->input->post('v5'));
    $bq5 = htmlspecialchars($this->input->post('bq5'));
    $bv5 = htmlspecialchars($this->input->post('bv5'));
    $q6 = htmlspecialchars($this->input->post('q6'));
    $v6 = htmlspecialchars($this->input->post('v6'));
    $bq6 = htmlspecialchars($this->input->post('bq6'));
    $bv6 = htmlspecialchars($this->input->post('bv6'));
    $q7 = htmlspecialchars($this->input->post('q7'));
    $v7 = htmlspecialchars($this->input->post('v7'));
    $bq7 = htmlspecialchars($this->input->post('bq7'));
    $bv7 = htmlspecialchars($this->input->post('bv7'));
    $q8 = htmlspecialchars($this->input->post('q8'));
    $v8 = htmlspecialchars($this->input->post('v8'));
    $bq8 = htmlspecialchars($this->input->post('bq8'));
    $bv8 = htmlspecialchars($this->input->post('bv8'));
    $q9 = htmlspecialchars($this->input->post('q9'));
    $v9 = htmlspecialchars($this->input->post('v9'));
    $bq9 = htmlspecialchars($this->input->post('bq9'));
    $bv9 = htmlspecialchars($this->input->post('bv9'));
    $q10 = htmlspecialchars($this->input->post('q10'));
    $v10 = htmlspecialchars($this->input->post('v10'));
    $bq10 = htmlspecialchars($this->input->post('bq10'));
    $bv10 = htmlspecialchars($this->input->post('bv10'));

    $startDateq3 = htmlspecialchars($this->input->post('startDateq3'));
    $startDatev3 = htmlspecialchars($this->input->post('startDatev3'));
    $startDatebq3 = htmlspecialchars($this->input->post('startDatebq3'));
    $startDatebv3 = htmlspecialchars($this->input->post('startDatebv3'));

    $startDateq4 = htmlspecialchars($this->input->post('startDateq4'));
    $startDatev4 = htmlspecialchars($this->input->post('startDatev4'));
    $startDatebq4 = htmlspecialchars($this->input->post('startDatebq4'));
    $startDatebv4 = htmlspecialchars($this->input->post('startDatebv4'));

    $startDateq5 = htmlspecialchars($this->input->post('startDateq5'));
    $startDatev5 = htmlspecialchars($this->input->post('startDatev5'));
    $startDatebq5 = htmlspecialchars($this->input->post('startDatebq5'));
    $startDatebv5 = htmlspecialchars($this->input->post('startDatebv5'));

    $status = $this->input->post('status');
    $taskSysCat = $this->input->post('taskSysCat');
    $idRelatedTask = $this->input->post('idRelatedTask');
    $taskCode = $this->input->post('taskCode');

    $periode = $this->input->post('periode');

    $startDate = $this->input->post('startDate');
    $endDate = $this->input->post('endDate');

    $timeAssign = $this->input->post('timeAssign');
    $idAssignee = $this->input->post('idAssignee');
    $assignTo = $this->input->post('assignTo');

    $draw   = $this->input->post('draw');
    $start  = $this->input->post('start');
    $length = $this->input->post('length') ? $this->input->post('length') : 1;

    $search = str_replace("'", "", strtolower($this->input->post('search')['value']));
    $searchTerms = explode(" ",  $search);
    $orderColumn = isset($this->input->post('order')[0]['column']) ? $this->input->post('order')[0]['column'] : '';
    $dir = isset($this->input->post('order')[0]['dir']) ? $this->input->post('order')[0]['dir'] : '';

    $query_params = [];
    $query_params_like_or = [];
    $query_params_where_between = [];

    $scheduleStart = '';
    $scheduleEnd = '';
    if ($periode != '') {
      if ($periode == 'this_year') {

        $firstDate  = new DateTime(date('Y-m-d H:i:s'));
        $secondDate  = new DateTime(date('Y-m-d H:i:s'));

        $scheduleEnd = $firstDate;
        $scheduleStart = $secondDate->modify("-1 year");
      } elseif ($periode == 'last_year') {

        $firstDate  = new DateTime(date('Y-m-d H:i:s'));
        $secondDate  = new DateTime(date('Y-m-d H:i:s'));

        $scheduleEnd = $firstDate->modify("-1 year");
        $scheduleStart = $secondDate->modify("-2 year");
      } elseif ($periode == 'next_year') {

        $firstDate  = new DateTime(date('Y-m-d H:i:s'));
        $secondDate  = new DateTime(date('Y-m-d H:i:s'));

        $scheduleStart = $firstDate;
        $scheduleEnd = $secondDate->modify("+1 year");
      } elseif ($periode == 'last_month') {

        $firstDate  = new DateTime(date('Y-m-d H:i:s'));
        $secondDate  = new DateTime(date('Y-m-d H:i:s'));

        $scheduleEnd = $firstDate->modify("-1 month");
        $scheduleStart = $secondDate->modify("-2 month");
      } elseif ($periode == 'next_month') {

        $firstDate  = new DateTime(date('Y-m-d H:i:s'));
        $secondDate  = new DateTime(date('Y-m-d H:i:s'));

        $scheduleStart = $firstDate;
        $scheduleEnd = $secondDate->modify("+1 month");
      } elseif ($periode == 'this_month') {

        $firstDate  = new DateTime(date('Y-m-d H:i:s'));
        $secondDate  = new DateTime(date('Y-m-d H:i:s'));

        $scheduleEnd = $firstDate;
        $scheduleStart = $secondDate->modify("-1 month");
      }
    }

    if ($periode != '') {

      $scheduleStart_query_params = [
        "column" => "scheduleStart",
        "value" => $scheduleStart->format('Y-m-d'),
      ];
      array_push($query_params_where_between, $scheduleStart_query_params);
    }

    if ($periode != '') {

      $scheduleEnd_query_params = [
        "column" => "scheduleEnd",
        "value" => $scheduleEnd->format('Y-m-d'),
      ];
      array_push($query_params_where_between, $scheduleEnd_query_params);
    }
    ///////// ADVANCED SEACRH DATE ///////////////////
    if ($startDateq3 != '') {

      $startDateq3_query_params = [
        "column" => $startDateq3,
        "value" => $startDatev3,
      ];
      array_push($query_params_where_between, $startDateq3_query_params);
    }

    if ($startDatebq3 != '') {

      $startDatebq3_query_params = [
        "column" => $startDatebq3,
        "value" => $startDatebv3,
      ];
      array_push($query_params_where_between, $startDatebq3_query_params);
    }

    if ($startDateq4 != '') {

      $startDateq4_query_params = [
        "column" => $startDateq4,
        "value" => $startDatev4,
      ];
      array_push($query_params_where_between, $startDateq4_query_params);
    }

    if ($startDatebq4 != '') {

      $startDatebq4_query_params = [
        "column" => $startDatebq4,
        "value" => $startDatebv4,
      ];
      array_push($query_params_where_between, $startDatebq4_query_params);
    }

    if ($startDateq5 != '') {

      $startDateq5_query_params = [
        "column" => $startDateq5,
        "value" => $startDatev5,
      ];
      array_push($query_params_where_between, $startDateq5_query_params);
    }

    if ($startDatebq5 != '') {

      $startDatebq5_query_params = [
        "column" => $startDatebq5,
        "value" => $startDatebv5,
      ];
      array_push($query_params_where_between, $startDatebq5_query_params);
    }

    ///////// ADVANCED SEACRH DATE ///////////////////
    $array = [];
    if ($searchTerms) {
      foreach ($searchTerms as $searchTerm) {
        $array['search'] = $searchTerm;
      }
    }

    if ($dir === 'asc') {
      $array['order'] = 'desc';
    }

    if ($array['search'] != '') {

      $idTask_query_params = [
        "column" => "idTask",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $idTask_query_params);

      $idAsset_query_params = [
        "column" => "idAsset",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $idAsset_query_params);

      $taskCode_query_params = [
        "column" => "taskCode",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $taskCode_query_params);

      $taskName_query_params = [
        "column" => "taskName",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $taskName_query_params);

      $assignTo_query_params = [
        "column" => "assignTo",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $assignTo_query_params);

      $taskDesc_query_params = [
        "column" => "taskDesc",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $taskDesc_query_params);

      $scheduleStart_query_params = [
        "column" => "scheduleStart",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $scheduleStart_query_params);

      $scheduleEnd_query_params = [
        "column" => "scheduleEnd",
        "value" => $array['search']
      ];
      array_push($query_params_like_or, $scheduleEnd_query_params);
    }

    if ($idRelatedTask != '') {
      $idRelatedTask_query_params = [
        "column" => "idRelatedTask",
        "value" => (int)$idRelatedTask
      ];
      array_push($query_params, $idRelatedTask_query_params);
    }

    if ($timeAssign != '') {
      $timeAssign_query_params = [
        "column" => "timeAssign",
        "value" => $timeAssign
      ];
      array_push($query_params, $timeAssign_query_params);
    }

    if ($idAssignee != '') {
      $idAssignee_query_params = [
        "column" => "idAssignee",
        "value" => $idAssignee
      ];
      array_push($query_params, $idAssignee_query_params);
    }

    if ($assignTo != '') {
      $assignTo_query_params = [
        "column" => "assignTo",
        "value" => $assignTo
      ];
      array_push($query_params, $assignTo_query_params);
    }

    if ($taskSysCat != 'ALL') {
      if ($taskSysCat != '') {
        $taskSysCat_query_params = [
          "column" => "taskSysCat",
          "value" => $taskSysCat
        ];
        array_push($query_params, $taskSysCat_query_params);
      }
    }

    if ($taskCode != 'ALL') {
      if ($taskCode != '') {
        $taskCode_query_params = [
          "column" => "taskCode",
          "value" => strtoupper($taskCode)
        ];
        array_push($query_params, $taskCode_query_params);
      }
    }

    if ($q1 != '') {

      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q1_query_params = [
          "column" => $q1,
          "value" => $v1
        ];
        array_push($query_params_like_or, $q1_query_params);
      } else {
        $q1_query_params = [
          "column" => $q1,
          "value" => $v1
        ];

        array_push($query_params, $q1_query_params);
      }
    }

    if ($q2 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q2_query_params = [
          "column" => $q2,
          "value" => $v2
        ];
        array_push($query_params_like_or, $q2_query_params);
      } else {
        $q2_query_params = [
          "column" => $q2,
          "value" => $v2
        ];

        array_push($query_params, $q2_query_params);
      }
    }

    if ($q3 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q3_query_params = [
          "column" => $q3,
          "value" => $v3
        ];
        array_push($query_params_like_or, $q3_query_params);
      } else {
        $q3_query_params = [
          "column" => $q3,
          "value" => $v3
        ];

        array_push($query_params, $q3_query_params);
      }
    }

    if ($bq3 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq3_query_params = [
          "column" => $bq3,
          "value" => $bv3
        ];
        array_push($query_params_like_or, $bq3_query_params);
      } else {
        $bq3_query_params = [
          "column" => $bq3,
          "value" => $bv3
        ];

        array_push($query_params, $bq3_query_params);
      }
    }

    if ($q4 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q4_query_params = [
          "column" => $q4,
          "value" => $v4
        ];
        array_push($query_params_like_or, $q4_query_params);
      } else {
        $q4_query_params = [
          "column" => $q4,
          "value" => $v4
        ];

        array_push($query_params, $q4_query_params);
      }
    }

    if ($bq4 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq4_query_params = [
          "column" => $bq4,
          "value" => $bv4
        ];
        array_push($query_params_like_or, $bq4_query_params);
      } else {
        $bq4_query_params = [
          "column" => $bq4,
          "value" => $bv4
        ];

        array_push($query_params, $bq4_query_params);
      }
    }

    if ($q5 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q5_query_params = [
          "column" => $q5,
          "value" => $v5
        ];
        array_push($query_params_like_or, $q5_query_params);
      } else {
        $q5_query_params = [
          "column" => $q5,
          "value" => $v5
        ];

        array_push($query_params, $q5_query_params);
      }
    }

    if ($bq5 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq5_query_params = [
          "column" => $bq5,
          "value" => $bv5
        ];
        array_push($query_params_like_or, $bq5_query_params);
      } else {
        $bq5_query_params = [
          "column" => $bq5,
          "value" => $bv5
        ];

        array_push($query_params, $bq5_query_params);
      }
    }

    if ($q6 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q6_query_params = [
          "column" => $q6,
          "value" => $v6
        ];
        array_push($query_params_like_or, $q6_query_params);
      } else {
        $q6_query_params = [
          "column" => $q6,
          "value" => $v6
        ];

        array_push($query_params, $q6_query_params);
      }
    }

    if ($bq6 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq6_query_params = [
          "column" => $bq6,
          "value" => $bv6
        ];
        array_push($query_params_like_or, $bq6_query_params);
      } else {
        $bq6_query_params = [
          "column" => $bq6,
          "value" => $bv6
        ];

        array_push($query_params, $bq6_query_params);
      }
    }

    if ($q7 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q7_query_params = [
          "column" => $q7,
          "value" => $v7
        ];
        array_push($query_params_like_or, $q7_query_params);
      } else {
        $q7_query_params = [
          "column" => $q7,
          "value" => $v7
        ];

        array_push($query_params, $q7_query_params);
      }
    }

    if ($bq7 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq7_query_params = [
          "column" => $bq7,
          "value" => $bv7
        ];
        array_push($query_params_like_or, $bq7_query_params);
      } else {
        $bq7_query_params = [
          "column" => $q7,
          "value" => $v7
        ];

        array_push($query_params, $bq7_query_params);
      }
    }

    if ($q8 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q8_query_params = [
          "column" => $q8,
          "value" => $v8
        ];
        array_push($query_params_like_or, $q8_query_params);
      } else {
        $q8_query_params = [
          "column" => $q8,
          "value" => $v8
        ];

        array_push($query_params, $q8_query_params);
      }
    }

    if ($bq8 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq8_query_params = [
          "column" => $bq8,
          "value" => $bv8
        ];
        array_push($query_params_like_or, $bq8_query_params);
      } else {
        $bq8_query_params = [
          "column" => $bq8,
          "value" => $bv8
        ];

        array_push($query_params, $bq8_query_params);
      }
    }

    if ($q9 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q9_query_params = [
          "column" => $q9,
          "value" => $v9
        ];
        array_push($query_params_like_or, $q9_query_params);
      } else {
        $q9_query_params = [
          "column" => $q9,
          "value" => $v9
        ];

        array_push($query_params, $q9_query_params);
      }
    }

    if ($bq9 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq9_query_params = [
          "column" => $bq9,
          "value" => $bv9
        ];
        array_push($query_params_like_or, $bq9_query_params);
      } else {
        $bq9_query_params = [
          "column" => $bq9,
          "value" => $bv9
        ];

        array_push($query_params, $bq9_query_params);
      }
    }

    if ($q10 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $q10_query_params = [
          "column" => $q10,
          "value" => $v10
        ];
        array_push($query_params_like_or, $q10_query_params);
      } else {
        $q10_query_params = [
          "column" => $q10,
          "value" => $v10
        ];

        array_push($query_params, $q10_query_params);
      }
    }

    if ($bq10 != '') {
      if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
        $bq10_query_params = [
          "column" => $bq10,
          "value" => $bv10
        ];
        array_push($query_params_like_or, $bq10_query_params);
      } else {
        $bq10_query_params = [
          "column" => $bq10,
          "value" => $bv10
        ];

        array_push($query_params, $bq10_query_params);
      }
    }

    if ($status != '') {
      $progressStatus = '';
      if ($status == 1) {
        // belum di kerjakan
        $progressStatus = 'NEW-ASSIGNED';
      } else if ($status == 2) {
        // belum approve
        $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED';
      } else if ($status == 3) {
        // approve
        $progressStatus = 'NEW-ASSIGNED-STARTED-FINISHED-APPROVED';
      }

      $status_query_params = [
        "column" => "progressStatus",
        "value" => $progressStatus
      ];
      array_push($query_params, $status_query_params);
    }

    $query_groups_like_or = [];
    $query_groups_where_between = [];
    $query_groups = [];
    // if($q1 != '' || $q2 != '' || $status != '' || $taskSysCat) {
    if ($q1 != null || $q2 != null || $q3 != null || $bq3 != null || $q4 != null || $bq4 != null || $q5 != null || $bq5 != null || $q6 != null || $bq6 != null || $q7 != null || $bq7 != null || $q8 != null || $bq8 != null || $q9 != null || $bq9 != null || $q10 != null || $bq10 != null || $status != '' || $taskSysCat) {

      if (($q1 != '' && $q2 != '') || ($q3 != '' && $bq3 != '') || ($q4 != '' && $bq4 != '') ||  ($q5 != '' && $bq5 != '')  || ($q6 != '' && $bq6 != '') || ($q7 != '' && $bq7 != '') || ($q8 != '' && $bq8 != '') || ($q9 != '' && $bq9 != '') || ($q10 != '' && $bq10 != '')) {
        if ($q1 == $q2 || $q1 == $q3 || $q1 == $bq3 || $q1 == $bq4  || $q1 == $q4 || $q1 == $q5 || $q1 == $bq5 ||  $q1 == $q6 || $q1 == $bq6 || $q1 == $q7 || $q1 == $bq7 || $q1 == $q8 || $q1 == $bq8 || $q1 == $q9 || $q1 == $bq9 || $q1 == $q10 || $q1 == $bq10) {
          $query_groups_like_or = [
            [
              "queryMethod" => "LIKEOR",
              "queryParams" => $query_params_like_or
            ]
          ];
        }
      }

      $query_groups = [
        [
          "queryMethod" => "EXACTAND", //"LIKEAND",
          "queryParams" => $query_params
        ]
      ];
    }

    if ($array['search'] != '') {
      $query_groups_like_or = [
        [
          "queryMethod" => "LIKEOR",
          "queryParams" => $query_params_like_or
        ]
      ];
    }

    if ($periode != '' || $startDateq3 != '' || $startDatev3 != '' || $startDatebq3 != '' || $startDatebv3 != '' || $startDateq4 != '' || $startDatev4 != '' || $startDatebq4 != '' || $startDatebv4 != '' || $startDateq5 != '' || $startDatev5 != '' || $startDatebq5 != '' || $startDatebv5 != '') {
      $query_groups_where_between = [
        [
          "queryMethod" => "BETWEEN",
          "queryParams" => $query_params_where_between
        ]
      ];
    }

    $merge_query_groups = array_merge($query_groups, $query_groups_like_or);
    $merge_query_groups = array_merge($merge_query_groups, $query_groups_where_between);

    $page = ($start / $length) + 1;

    $request = [
      "queryGroupMethod" => "AND",
      "queryGroups" => $query_params ? $merge_query_groups : [],
      "sortingParams" => [
        [
          "column" => "idTask",
          "value" => "desc"
        ]
      ],
      "withDetails" => true,
      "subDetails" => true,
      "page" =>  $page,
      "limit" =>  isset($length) ? (int)$length : 15
    ];


    $posts = $this->m_task->taskQuery($request);

    $totalFiltered = $posts['dataCount'];

    if (sizeof($posts) > 0) {
      $no = 1;
      // $data = [];
      foreach ($posts['data'] as $key => $value) {

        if (!empty($value['propProgress']['timeFinish'])) {
          $posts['data'][$key]['timeFinish'] = date('Y-m-d', strtotime($value['propProgress']['timeFinish']));
        } else {
          $posts['data'][$key]['timeFinish'] = "-";
        }
        // $posts['data'][$key] = [];
        foreach ($value['propTaskMaintenance'] as $propTaskMaintenance) {
          $idAsset = $propTaskMaintenance['idAsset'];
          $idTask = $propTaskMaintenance['idTask'];
          $idFormTemplate = $propTaskMaintenance['idFormTemplate'];
          $scheduleStart1 = date('Y-m-d', strtotime($value['propSchedule']['scheduleStart']));




          if (!empty($value['propProgress']['assignTo'])) {
            $posts['data'][$key]['assignTo'] = $value['propProgress']['assignTo'];
          } else {
            $posts['data'][$key]['assignTo'] = "-";
          }

          if (!empty($value['propProgress']['finishBy'])) {
            $posts['data'][$key]['finishBy'] = $value['propProgress']['finishBy'];
          } else {
            $posts['data'][$key]['finishBy'] = "-";
          }

          $posts['data'][$key]['idAsset'] = $idAsset;
          $posts['data'][$key]['maintenanceResult'] = $propTaskMaintenance['maintenanceResult'];
          $posts['data'][$key]['check_box_cuk'] = "<input type='checkbox' id='delcheck_{$idTask}' data-asset='{$idAsset}'  name='msg[]' class='delete_check' value='{$idTask}' />";

          if (isset($value['propProgress']['progressStatus'])) {
            $propProgress = $value['propProgress']['progressStatus'];

            if ($propProgress == 'NEW-ASSIGNED') {
              $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-formtemplate="' . $idFormTemplate . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-mtn"><img src="' . base_url() . '/assets/images/icon/cross.png"
          alt="Not Work" style="height:14px; display:block; margin:0 auto;"
          title="Not Work" class="tip"></a>';
            } else if ($value['propProgress']['timeApproved'] != '') {
              $status_img = '<img src="' . base_url() . '/assets/images/icon/check.png"
      alt="Approved"
      style="height:14px; display:block; margin:0 auto;"
      title="Approved" class="tip">';
            } else if (strpos($propProgress, 'FINISHED') == true) {
              $status_img = '<img src="' . base_url() . '/assets/images/icon/check_red.png"
      alt="Finish Not Approved"
      style="height:14px; display:block; margin:0 auto;"
      title="Finish Not Approved" class="tip">';
            } else {
              $status_img = '<a href="javascript:void(0)" data-idtask="' . $idTask . '" data-formtemplate="' . $idFormTemplate . '" data-idasset="' . $idAsset . '" data-schedule="' . $scheduleStart1 . '" id="update-mtn"><img src="' . base_url() . '/assets/images/icon/cross.png"
          alt="Not Work" style="height:14px; display:block; margin:0 auto;"
          title="Not Work" class="tip"></a>';
            }
            $posts['data'][$key]['no']                  = $no++;
            $posts['data'][$key]['status_img']      =  $status_img;
            $posts['data'][$key]['assetCode']      =  $propTaskMaintenance['propAsset']['assetCode'];
            $posts['data'][$key]['scheduleStart']      =  $scheduleStart1;
            $posts['data'][$key]['assetName']      =  $propTaskMaintenance['propAsset']['assetName'];
            $posts['data'][$key]['merk']      =  $propTaskMaintenance['propAsset']['propAssetPropgenit']['merk'];
            $posts['data'][$key]['tipe']      =  $propTaskMaintenance['propAsset']['propAssetPropgenit']['tipe'];
            $posts['data'][$key]['serialNumber']      =  $propTaskMaintenance['propAsset']['propAssetPropgenit']['serialNumber'];
            $posts['data'][$key]['roomName']      =  $propTaskMaintenance['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'];
            $posts['data'][$key]['floorName']      =  $propTaskMaintenance['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName'];
            $posts['data'][$key]['buildingName']      =  $propTaskMaintenance['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName'];

            // $data[] = $posts['data'][$key];
          }
        }
      }
    }

    $json_data = [
      "page"            => $page,
      "limit"           => $length,
      "draw"            => $draw,
      "recordsTotal"    => $totalFiltered,
      "recordsFiltered" => $totalFiltered,
      "data"            => $posts['data'],
      "search"          => isset($array['search']) ?  $array['search'] : '',
      "query_groups"    => $request,
      "query_message"   => $posts['queryMessage']
    ];

    echo json_encode($json_data);
  }

  public function update_mtn()
  {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }

    $query_params = [];

    $idTask = $this->input->post('idTask');
    $idAsset = $this->input->post('idAsset');
    $idFormTemplate = $this->input->post('idFormTemplate');

    if ($idTask != '') {
      $idTask_query_params = [
        "column" => "idTask",
        "value" => $idTask
      ];

      array_push($query_params, $idTask_query_params);
    }

    if ($idAsset != '') {
      $idAsset_query_params = [
        "column" => "idAsset",
        "value" => $idAsset
      ];

      array_push($query_params, $idAsset_query_params);
    }

    $query_groups = [];
    if ($idTask != '' || $idAsset != '') {
      $query_groups = [
        [
          "queryMethod" => "EXACTAND",
          "queryParams" => $query_params
        ]
      ];
    }

    $request = [
      "queryGroupMethod" => "AND",
      "queryGroups" => $query_groups,
      "page" => 1,
      "limit" => 1
    ];

    $task = $this->m_task->taskQuery($request)['data'];
    $formTemplate = $this->m_form_template->formTemplateById($task[0]['propTaskMaintenance'][0]['idFormTemplate'])['data'];

    $show['task'] = $task;
    $show['formTemplate'] = $formTemplate;
    $show['username'] = $this->session->userdata('username');
    $show['id_user'] = $this->session->userdata('id_user');

    echo json_encode($show);
  }
}
