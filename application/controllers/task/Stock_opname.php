<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Mpdf\Tag\Strong;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Stock_opname extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->simple_login->cek_login(); // cek login
        $this->load->model([
            'M_task'                => 'm_task',
            'M_asset'               => 'm_asset',
            'M_task_stockopname'               => 'm_task_stockopname',
            'M_task_stockopname_detail'               => 'm_task_stockopname_detail',
            'M_task_complain'       => 'm_task_complain',
            'M_progress'            => 'm_progress',
            'M_schedule'            => 'm_schedule',
            'M_report'              => 'm_report'
        ]);
    }


    public function index()
    {
        $this->delete_from_session();

        $result_role = $this->m_access_control->MyRole()['data']['roleACL'];

        $data['result_role'] = $result_role;
        $this->load->model('M_notifikasi', 'm_notifikasi');
        $data['notif'] = $this->m_notifikasi->list()['data'];

        if ($result_role[2]['subMenu1'][2]['isAllow'] != true) {
            exit('You dont have access!!');
        }

        $this->load->view('components/header');
        $this->load->view('components/sidebar', $data);
        $this->load->view('task/stock_opname/opname_index');
        $this->load->view('task/stock_opname/form/opname_form');
        $this->load->view('task/stock_opname/print/opname_print');
        $this->load->view('task/stock_opname/details/opname_details');
        $this->load->view('task/task');
        $this->load->view('components/sidebar_footer');
        $this->load->view('components/footer');
    }

    public function delete_from_session($idAsset = NULL)
    {
        $taskStockopnameDetails = [];
        if ($idAsset != NULL) {
            if (sizeof($_SESSION['taskStockopnameDetails']) > 0) {
                foreach ($_SESSION['taskStockopnameDetails'] as $key => $value) {
                    if ($value['idAsset'] != $idAsset) {
                        $taskStockopnameDetails[] = $value;
                    }
                }
            }
        }

        // remove session task stock opanme detail data
        $session = $this->session->userdata();
        $session['taskStockopnameDetails'] = $taskStockopnameDetails;

        $this->session->set_userdata($session);
        // end remove session task stock opanme detail data

        return $session;
        // redirect($_SERVER['HTTP_REFERER']);
        // echo json_encode($session);
    }

    public function stockopname_by_id()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $show = [];
        $id_task = [];

        $id_task = $this->input->post('idTask');

        foreach ($id_task as $key => $id) {
            $result = $this->m_task->taskById($id);
        }

        $show['data_update'] = $result['data'];

        echo json_encode($show);
        exit;
    }

    public function stockopname_detail()
    {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }

        $show = [];
        $id_task = [];

        $id_task = $this->input->post('idTask');

        foreach ($id_task as $key => $id) {
            $result = $this->m_task->taskById($id);
        }

        $show['data_update'] = $result['data'];

        $locations = [];
        $asset_categories = [];
        foreach ($result['data']['propTaskStockopname'] as $propTaskStockopname) {
            foreach ($propTaskStockopname['propTaskStockopnameDetail'] as $propTaskStockopnameDetail) {

                $asset_categories[] = $propTaskStockopnameDetail['propAsset']['propAssetCat']['assetCatName'];

                $locations[] = $propTaskStockopnameDetail['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['buildingName']  . ' | ' .
                    $propTaskStockopnameDetail['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['floorName'] . ' | ' .
                    $propTaskStockopnameDetail['propAsset']['propAssetPropadmin']['propAssetPropbuildingRoom']['roomName'];
            }
        }

        $show['locations'] = array_values(array_flip(array_flip($locations)));
        $show['asset_categories'] = array_values(array_flip(array_flip($asset_categories)));

        echo json_encode($show);
        exit;
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
            !empty($post['taskCode']) ? $post['taskCode'] : '',
            !empty($post['idProgress']) ? $post['idProgress'] : 0,
            !empty($post['propSchedule_idSchedule']) ? $post['propSchedule_idSchedule'] : 0,
            !empty($post['idRelatedTask']) ? $post['idRelatedTask'] : 0,
            !empty($post['taskType']) ? $post['taskType'] : '',
            !empty($post['taskName']) ? $post['taskName'] : '',
            !empty($post['taskDesc']) ? $post['taskDesc'] : '',
            !empty($post['idVendor']) ? $post['idVendor'] : 0,
            !empty($post['taskKpi']) ? $post['taskKpi'] : 0,
            !empty($post['taskAmount']) ? $post['taskAmount'] : 0,
            ''
        );

        $progress = $this->m_progress->data(
            $idProgress = 0,
            $progressStatus = 'NEW',
            $timeInit = date('Y-m-d H:i:s'),
            $timeRespon = '',
            $timeStart = '',
            $timeFinish = '',
            $timePending = '',
            $timeApproved = '',
            $timeDelegate = '',
            $timeAssign = '',
            $idInitBy = $this->session->userdata('id_user'),
            $idResponBy = 0,
            $idStartBy = 0,
            $idFinishBy = 0,
            $idPendingBy = 0,
            $idApproveBy = 0,
            $idAssignee = 0,
            $idDelegator = 0,
            $initBy = $this->session->userdata('username'),
            $responBy = '',
            $startBy = '',
            $finishBy = '',
            $pendingBy = '',
            $approveBy = '',
            $delegateBy = '',
            $assignTo = ''
        );
        $task['propProgress'] = $progress;

        $schedule = $this->m_schedule->data(
            !empty($post['propSchedule_idSchedule']) ? $post['propSchedule_idSchedule'] : 0,
            $parentSchedule = 0,
            $scheduleType = 'ONCE',
            $scheduleName = !empty($post['taskName']) ? $post['taskName'] : '',
            $scheduleDesc = !empty($post['taskDesc']) ? $post['taskDesc'] : '',
            !empty($post['propSchedule_scheduleStart']) ? $post['propSchedule_scheduleStart'] : '',
            !empty($post['propSchedule_scheduleEnd']) ? $post['propSchedule_scheduleEnd'] : '',
            $dayRepeat = '',
            $createBy = $this->session->userdata('username'),
            ''
        );
        $task['propSchedule'] = $schedule;

        if (empty($post['idTask'])) {
            $propTaskStockopnameDetail = [];
            if (sizeof($_SESSION['taskStockopnameDetails']) > 0) {

                $uniqueTaskStockopnameDetails = array_map("unserialize", array_unique(array_map("serialize", $_SESSION['taskStockopnameDetails'])));

                foreach ($uniqueTaskStockopnameDetails as $value) {

                    $task_stockopname_detail = $this->m_task_stockopname_detail->data(
                        !empty($post['propTaskStockopname_idTaskOpname']) ? $post['propTaskStockopname_idTaskOpname'] : 0,
                        $value['idAsset'],
                        !empty($post['propTaskStockopname_isChecked']) ? $post['propTaskStockopname_isChecked'] : 0,
                        !empty($post['propTaskStockopname_checkedByID']) ? $post['propTaskStockopname_checkedByID'] : 0,
                        !empty($post['propTaskStockopname_checkedByName']) ? $post['propTaskStockopname_checkedByName'] : '',
                        !empty($post['propTaskStockopname_checkedTime']) ? $post['propTaskStockopname_checkedTime'] : ''
                    );
                    $task_stockopname_detail['propAsset'] = $value;

                    $propTaskStockopnameDetail[] = $task_stockopname_detail;
                }
            }

            $task_stockopname = $this->m_task_stockopname->data(
                !empty($post['propTaskStockopname_idTaskOpname']) ? $post['propTaskStockopname_idTaskOpname'] : 0,
                !empty($post['idTask']) ? $post['idTask'] : 0,
                !empty($post['taskDesc']) ? $post['taskDesc'] : '',
                $lastUpdated = date('Y-m-d H:i:s')
            );
            $task['propTaskStockopname'] = [$task_stockopname];

            $task['propTaskStockopname'][0]['propTaskStockopnameDetail'] = $propTaskStockopnameDetail;

            $task_insert = $this->m_task->taskInsert($task);
            if ($task_insert['queryMessage'] == true) {
                // remove session task stock opanme detail data
                $session = $this->session->userdata();
                $session['taskStockopnameDetails'] = [];

                $this->session->set_userdata($session);
                // end remove session task stock opanme detail data
            }
        } else {
            $task_insert = $this->m_task->taskUpdate($task);
        }

        $this->delete_from_session();
        echo json_encode($task_insert, JSON_PRETTY_PRINT);
    }

    public function report()
    {
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
        } else {
            $idTask = [];

            if (!empty($this->input->post('idTask'))) {
                $idTask = $this->input->post('idTask');
            }

            $im = implode(",", $idTask);
            $val = explode(",", $im);

            $report = $this->m_report->reportStockOpname($val);
            //
            // echo json_encode($report );
            // die;
            // $res =  array_count_values(array_column($report['dataSO'], 'taskName'));
            // echo json_encode($res);
            // die;

            header("Content-type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=report_task_stockopname.xlsx");
            $spreadsheet = new Spreadsheet();
            // Sheet 1
            $columns_1 = 6;
            $spreadsheet->setActiveSheetIndex(0)->setTitle('RESUME');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A1:B1');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A2:B2');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A4:A5');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('B4:B5');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('C4:E4');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('F4:H4');
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('I4:J4');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'DATA STOCK OPNAME - RESUME');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A2', $this->session->userdata('hospital'));
            $spreadsheet->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A4', 'NO');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B4', 'TASK OPNAME');
            $spreadsheet->getActiveSheet()->getStyle('A4:B4')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C4', 'ASSET COUNT');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C5', 'UNSCAN');
            $spreadsheet->getActiveSheet()->getStyle('C4:C5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D5', 'SCAN');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E5', 'TOTAL');
            $spreadsheet->getActiveSheet()->getStyle('D5:E5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F4', 'ASSET VALUE');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F5', 'UNSCAN');
            $spreadsheet->getActiveSheet()->getStyle('F4:F5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G5', 'SCAN');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H5', 'TOTAL');
            $spreadsheet->getActiveSheet()->getStyle('G5:H5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I4', 'ASSET CONDITION');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I5', 'GOOD');
            $spreadsheet->getActiveSheet()->getStyle('I4:I5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J5', 'DAMAGE');
            $spreadsheet->getActiveSheet()->getStyle('J5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('B')->setWidth(191, 'px');
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('F')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('G')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(0)->getColumnDimension('H')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(0)->getStyle('C4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(0)->getStyle('F4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(0)->getStyle('I4')->getAlignment()->setHorizontal('center');
            $col_total = count($report['dataTaskResume']) + $columns_1;
            $col_total_end = count($report['dataTaskResume']) + $columns_1 + 1;
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A' . $col_total . ':A' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('B' . $col_total . ':B' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('C' . $col_total . ':C' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('D' . $col_total . ':D' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('E' . $col_total . ':E' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('F' . $col_total . ':F' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('G' . $col_total . ':G' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('H' . $col_total . ':H' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('I' . $col_total . ':I' . $col_total_end);
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('J' . $col_total . ':J' . $col_total_end);

            $total_unscan = 0;
            $total_scan = 0;
            $total_scan_end = 0;
            $total_val_unscan = 0;
            $total_val_scan = 0;
            $total_val_scan_end = 0;
            $total_good = 0;
            $total_dmg = 0;
            foreach ($report['dataTaskResume'] as $key => $val) {
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('A' . $columns_1, $key + 1);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $columns_1, $val['taskName']);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $columns_1, $val['countUnScan']);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $columns_1, $val['countScan']);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $columns_1, $val['countTotal']);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $columns_1, number_format($val['valUnScan'], 0));
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $columns_1, number_format($val['valScan'], 0));
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . $columns_1, number_format($val['valTotal'], 0));
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('I' . $columns_1, $val['countGood']);
                $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $columns_1, $val['countDamage']);

                $total_unscan = $total_unscan + $val['countUnScan'];
                $total_scan = $total_scan + $val['countScan'];
                $total_scan_end = $total_scan_end + $val['countTotal'];
                $total_val_unscan = $total_val_unscan + $val['valUnScan'];
                $total_val_scan = $total_val_scan + $val['valScan'];
                $total_val_scan_end = $total_val_scan_end + $val['valTotal'];
                $total_good = $total_good + $val['countGood'];
                $total_dmg = $total_dmg + $val['countDamage'];
                $columns_1++;
            }
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('B' . $col_total, 'SUB TOTAL');
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('C' . $col_total, $total_unscan);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('D' . $col_total, $total_scan);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $col_total, $total_scan_end);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $col_total, number_format($total_val_unscan, 0));
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $col_total, number_format($total_val_scan, 0));
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('H' . $col_total, number_format($total_val_scan_end, 0));
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('I' . $col_total, $total_good);
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('J' . $col_total, $total_dmg);
            $spreadsheet->getActiveSheet()->getStyle('B' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('C' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('D' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('E' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('F' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('G' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('H' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('I' . $col_total)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('J' . $col_total)->getFont()->setBold(true);

            // Sheet 2
            $columns_2 = 6;
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex(1)->setTitle('CATEGORY');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('A1:B1');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('A2:B2');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('A1', 'DATA STOCK OPNAME - RESUME BY CATEGORY');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('A2', $this->session->userdata('hospital'));
            $spreadsheet->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('A4:A5');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('B4:B5');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('C4:C5');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('D4:F4');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('G4:I4');
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('J4:K4');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('A4', 'NO');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('B4', 'CODE');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('C4', 'ASSET CATEGORY');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('D4', 'ASSET COUNT');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('D5', 'UNSCAN');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('E5', 'SCAN');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('F5', 'TOTAL');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('G4', 'ASSET VALUE');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('G5', 'UNSCAN');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('H5', 'SCAN');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('I5', 'TOTAL');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('J4', 'ASSET CONDITION');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('J5', 'GOOD');
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('K5', 'DAMAGE');
            $spreadsheet->getActiveSheet(1)->getStyle('A4:K5')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(1)->getColumnDimension('G')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(1)->getColumnDimension('H')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(1)->getColumnDimension('I')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(1)->getColumnDimension('B')->setWidth(140, 'px');
            $spreadsheet->setActiveSheetIndex(1)->getColumnDimension('A')->setWidth(80, 'px');
            $spreadsheet->setActiveSheetIndex(1)->getColumnDimension('C')->setWidth(200, 'px');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('G')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('H')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('I')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('A')->getAlignment()->setHorizontal('left');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('D4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('H4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(1)->getStyle('J4')->getAlignment()->setHorizontal('center');
            $col_total_2 = count($report['dataCatResume']) + $columns_2;
            $col_total_2_end = count($report['dataCatResume']) + $columns_2 + 1;
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('A' . $col_total_2 . ':A' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('B' . $col_total_2 . ':B' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('C' . $col_total_2 . ':C' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('D' . $col_total_2 . ':D' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('E' . $col_total_2 . ':E' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('F' . $col_total_2 . ':F' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('G' . $col_total_2 . ':G' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('H' . $col_total_2 . ':H' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('I' . $col_total_2 . ':I' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('J' . $col_total_2 . ':J' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->mergeCells('K' . $col_total_2 . ':K' . $col_total_2_end);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('C' . $col_total_2, 'SUB TOTAL');
            $total_2unscan = 0;
            $total_2scan = 0;
            $total_2scan_end = 0;
            $total_2val_unscan = 0;
            $total_2val_scan = 0;
            $total_2val_scan_end = 0;
            $total_2good = 0;
            $total_2dmg = 0;
            foreach ($report['dataCatResume'] as $key => $val) {
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('A' . $columns_2, $key + 1);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('B' . $columns_2, $val['catCode']);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('C' . $columns_2, $val['catName']);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('D' . $columns_2, $val['countUnScan']);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('E' . $columns_2, $val['countScan']);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('F' . $columns_2, $val['countTotal']);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('G' . $columns_2, number_format($val['valUnScan'], 0));
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('H' . $columns_2, number_format($val['valScan'], 0));
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('I' . $columns_2, number_format($val['valTotal'], 0));
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('J' . $columns_2, $val['countGood']);
                $spreadsheet->setActiveSheetIndex(1)->setCellValue('K' . $columns_2, $val['countDamage']);
                $total_2unscan = $total_2unscan + $val['countUnScan'];
                $total_2scan = $total_2scan + $val['countScan'];
                $total_2scan_end = $total_2scan_end + $val['countTotal'];
                $total_2val_unscan = $total_2val_unscan + $val['valUnScan'];
                $total_2val_scan = $total_2val_scan + $val['valScan'];
                $total_2val_scan_end = $total_2val_scan_end + $val['valTotal'];
                $total_2good = $total_2good + $val['countGood'];
                $total_2dmg = $total_2dmg + $val['countDamage'];
                $columns_2++;
            }
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('D' . $col_total_2, $total_2unscan);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('E' . $col_total_2, $total_2scan);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('F' . $col_total_2, $total_2scan_end);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('G' . $col_total_2, number_format($total_2val_unscan, 0));
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('H' . $col_total_2, number_format($total_2val_scan, 0));
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('I' . $col_total_2, number_format($total_2val_scan_end, 0));
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('J' . $col_total_2, $total_2good);
            $spreadsheet->setActiveSheetIndex(1)->setCellValue('K' . $col_total_2, $total_2dmg);
            $spreadsheet->getActiveSheet(1)->getStyle('C' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('D' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('E' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('F' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('G' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('H' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('I' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('J' . $col_total_2)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(1)->getStyle('K' . $col_total_2)->getFont()->setBold(true);

            // Sheet 3
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex(2)->setTitle('DATA STOCK OPNAME');
            $columns_3 = 5;
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('A1', 'DATA STOCK OPNAME');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('A2', $this->session->userdata('hospital'));
            $spreadsheet->getActiveSheet(2)->getStyle('A1:A2')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('A4', 'NO');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('B4', 'TASK NAME');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('C4', 'LABEL');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('D4', 'ASSET CODE');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('E4', 'ASSET NAME');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('F4', 'CONDITION');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('G4', 'CHECKED');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('H4', 'ROOM');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('I4', 'CHECKER');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('J4', 'CHECK TIME');
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('K4', 'PRICE');
            $spreadsheet->getActiveSheet(2)->getStyle('A4:K4')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('B')->setWidth(450, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('C')->setWidth(400, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('D')->setWidth(150, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('E')->setWidth(450, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('F')->setWidth(90, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('G')->setWidth(90, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('H')->setWidth(250, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('I')->setWidth(160, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('J')->setWidth(160, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getColumnDimension('K')->setWidth(160, 'px');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('B4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('C4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('D4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('E4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('H4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('I4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('J4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('K4')->getAlignment()->setHorizontal('center');
            // $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $col_total_3, 'TES TOTAL');

            $i = 1;
            $res = array_count_values(array_column($report['dataSO'], 'taskName'));
            $k1 = 0;
            $k2 = 0;
            $g1 = 0;
            $g2 = 0;
            $total_scan_3 = 0;
            $total_unscan_3 = 0;
            $total_asset_3 = 0;
            $total_g1_3 = 0;
            $total_g2_3 = 0;
            $total_gall_3 = 0;
            foreach ($report['dataSO'] as $key => $val) {

                $range = $res[$val['taskName']];
                $excelDateValue = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(
                    $val['checkedTime']
                );

                $spreadsheet->setActiveSheetIndex(2)->setCellValue('A' . $columns_3, $key + 1);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $columns_3, $val['taskName']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('C' . $columns_3, $val['codeLabel']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('D' . $columns_3, $val['codeAsset']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('E' . $columns_3, $val['assetName']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('F' . $columns_3, $val['assetCondition']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('G' . $columns_3, $val['isChecked']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, $val['room']);
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, $val['checkerName']);
                // $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $col_total_3, "GRAND TOTAL");
                if ($val['checkedTime'] != "") {
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $excelDateValue);
                    $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)
                        ->getNumberFormat()
                        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);
                } else {
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, "");
                }
                $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($val['assetValue'], 0));
                $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('right');

                $k1 += $val['isChecked'] == true ? 1 : 0;
                $g1 += $val['isChecked'] == true ? $val['assetValue'] : 0;
                $k2 += $val['isChecked'] == true ? 0 : 1;
                $g2 += $val['isChecked'] == true ? 0 : $val['assetValue'];


                if ($range == $i) {
                    $total_scan_3 += $k1;
                    $total_unscan_3 += $k2;
                    $total_asset_3 += $k1 + $k2;
                    $total_g1_3 += $g1;
                    $total_g2_3 += $g2;
                    $total_gall_3 += $g1 + $g2;

                    $columns_3++;
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, "Count");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, "Value");
                    $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');

                    $columns_3++;
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "Sub Total");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "Total Scanned");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $k1);
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($g1, 0));
                    $spreadsheet->getActiveSheet(2)->getStyle('H' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('I' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');

                    $columns_3++;
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $columns_3, $val['taskName']);
                    $spreadsheet->getActiveSheet(2)->getStyle('B' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, $val['taskName']);
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "Total Not Scanned");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $k2);
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($g2, 0));
                    $spreadsheet->getActiveSheet(2)->getStyle('H' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('I' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');

                    $columns_3++;
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "Total Asset");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $k1 + $k2);
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($g1 + $g2, 0));
                    $spreadsheet->getActiveSheet(2)->getStyle('I' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
                    $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');

                    $columns_3++;
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('B' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, "");
                    $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, "");


                    $i = 1;
                    $k1 = 0;
                    $g1 = 0;
                    $k2 = 0;
                    $g2 = 0;
                    // $total_scan_3 = 0;
                } else $i++;

                $columns_3++;
            }

            $columns_3  += 1;
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "GRAND TOTAL");
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "Total Scanned");
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $total_scan_3);
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($total_g1_3, 0));
            $spreadsheet->getActiveSheet(2)->getStyle('H' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('I' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');
            $columns_3  += 1;
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "");
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "Total Not Scanned");
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $total_unscan_3);
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($total_g2_3, 0));
            $spreadsheet->getActiveSheet(2)->getStyle('H' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('I' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');
            $columns_3  += 1;
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('H' . $columns_3, "");
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('I' . $columns_3, "Total Asset");
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('J' . $columns_3, $total_asset_3);
            $spreadsheet->setActiveSheetIndex(2)->setCellValue('K' . $columns_3, number_format($total_gall_3, 0));
            $spreadsheet->getActiveSheet(2)->getStyle('H' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('I' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('J' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->getActiveSheet(2)->getStyle('K' . $columns_3)->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(2)->getStyle('J' . $columns_3)->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(2)->getStyle('K' . $columns_3)->getAlignment()->setHorizontal('center');

            // Sheet 4
            $spreadsheet->createSheet();
            $spreadsheet->setActiveSheetIndex(3)->setTitle('NOLPRICE');
            $columns_4 = 5;
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('A1', 'DATA NOL-PRICE');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('A2', $this->session->userdata('hospital'));
            $spreadsheet->getActiveSheet(3)->getStyle('A1:A2')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('A4', 'NO');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('B4', 'LABEL');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('C4', 'ASSET CODE');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('D4', 'ASSET NAME');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('E4', 'CONDITION');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('F4', 'ROOM');
            $spreadsheet->setActiveSheetIndex(3)->setCellValue('G4', 'PRICE');
            $spreadsheet->getActiveSheet(3)->getStyle('A4:G4')->getFont()->setBold(true);
            $spreadsheet->setActiveSheetIndex(3)->getColumnDimension('B')->setWidth(400, 'px');
            $spreadsheet->setActiveSheetIndex(3)->getColumnDimension('C')->setWidth(150, 'px');
            $spreadsheet->setActiveSheetIndex(3)->getColumnDimension('D')->setWidth(450, 'px');
            $spreadsheet->setActiveSheetIndex(3)->getColumnDimension('E')->setWidth(90, 'px');
            $spreadsheet->setActiveSheetIndex(3)->getColumnDimension('F')->setWidth(150, 'px');
            $spreadsheet->setActiveSheetIndex(3)->getStyle('B4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(3)->getStyle('C4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(3)->getStyle('D4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(3)->getStyle('E4')->getAlignment()->setHorizontal('center');
            $spreadsheet->setActiveSheetIndex(3)->getStyle('F4')->getAlignment()->setHorizontal('center');
            foreach ($report['dataNolPrice'] as $key => $val) {
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('A' . $columns_4, $key + 1);
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('B' . $columns_4, $val['codeLabel']);
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('C' . $columns_4, $val['codeAsset']);
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('D' . $columns_4, $val['assetName']);
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('E' . $columns_4, $val['assetCondition']);
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('F' . $columns_4, $val['room']);
                $spreadsheet->setActiveSheetIndex(3)->setCellValue('G' . $columns_4, number_format($val['assetValue'], 0));
                $columns_4++;
            }

            $spreadsheet->setActiveSheetIndex(0);

            // $sheet->setCellValue('A1', 'Hello World !');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }
    }
    // public function report()
    // {
    //     $idTask = $this->input->post('idTaskPrint');
    //     $button_pdf = $this->input->post('button_pdf');
    //     $button_excel = $this->input->post('button_excel');
    //     $query_params_like_or = [];
    //
    //     if ($button_pdf == 'pdf') {
    //         $idTask_query_params = [
    //             "column" => 'idTask',
    //             "value" => (int)$idTask
    //         ];
    //
    //         array_push($query_params_like_or, $idTask_query_params);
    //
    //         $query_groups = [
    //             [
    //                 "queryMethod" => "EXACTOR",
    //                 "queryParams" => $query_params_like_or
    //             ]
    //         ];
    //
    //
    //         $request = [
    //             "queryGroupMethod" => "AND",
    //             "queryGroups" => $query_groups,
    //             "withDetails" => true,
    //             "subDetails" => true
    //         ];
    //
    //         $tasks = $this->m_task->taskQuery($request);
    //         if (sizeof($tasks) > 0) {
    //             foreach ($tasks['data'] as $key => $value) {
    //
    //                 // $isCheckedFalse = [];
    //                 // $isCheckedTrue = [];
    //                 foreach ($value['propTaskStockopname'] as $propTaskStockopname) {
    //                     $countItem = $propTaskStockopname['countItem'];
    //                     $countScan = $propTaskStockopname['countScan'];
    //                 }
    //
    //                 $tasks['data'][$key]['scanned'] = $countScan;
    //                 $tasks['data'][$key]['notScanned'] = $countItem - $countScan;
    //                 $tasks['data'][$key]['totalAsset'] = $countItem;
    //             }
    //         }
    //
    //         $data['tasks'] = $tasks;
    //
    //         $mpdfConfig = array(
    //             'mode' => 'utf-8',
    //             'format' => 'A4',    // format - A4, for example, default ''
    //             'margin_left' => 5,        // 15 margin_left
    //             'margin_right' => 5,        // 15 margin right
    //             // 'margin_top' => 5,        // 15 margin right
    //             // 'margin_bottom' => 5,        // 15 margin right
    //             'orientation' => 'L'      // L - landscape, P - portrait
    //         );
    //         $mpdf = new \Mpdf\Mpdf($mpdfConfig);
    //         $data['mpdf'] = $mpdf;
    //         $html = $this->load->view('task/stock_opname/print/pdf', $data, TRUE);
    //         $mpdf->WriteHTML($html);
    //         $mpdf->Output();
    //     } else {
    //         $idTask_query_params = [
    //             "column" => 'idTask',
    //             "value" => (int)$idTask
    //         ];
    //
    //         array_push($query_params_like_or, $idTask_query_params);
    //
    //         $query_groups = [
    //             [
    //                 "queryMethod" => "EXACTOR",
    //                 "queryParams" => $query_params_like_or
    //             ]
    //         ];
    //
    //
    //         $request = [
    //             "queryGroupMethod" => "AND",
    //             "queryGroups" => $query_groups,
    //             "withDetails" => true,
    //             "subDetails" => true
    //         ];
    //
    //         $tasks = $this->m_task->taskQuery($request);
    //         if (sizeof($tasks) > 0) {
    //             foreach ($tasks['data'] as $key => $value) {
    //
    //                 // $isCheckedFalse = [];
    //                 // $isCheckedTrue = [];
    //                 foreach ($value['propTaskStockopname'] as $propTaskStockopname) {
    //                     $countItem = $propTaskStockopname['countItem'];
    //                     $countScan = $propTaskStockopname['countScan'];
    //                 }
    //
    //                 $tasks['data'][$key]['scanned'] = $countScan;
    //                 $tasks['data'][$key]['notScanned'] = $countItem - $countScan;
    //                 $tasks['data'][$key]['totalAsset'] = $countItem;
    //             }
    //         }
    //
    //         $data['tasks'] = $tasks;
    //         $this->load->view('task/stock_opname/print/pdf', $data);
    //     }
    // }
}
