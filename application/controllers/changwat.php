<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Changwat extends CI_Controller
{
    public $hospcode;
    public $hserv;
    public $provid;
    public $amp_code;
    public $user_level;
    public $year;

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->userdata("username_".sys_id()))
            redirect(site_url('users/login'));

        $this->layout->setLayout('changwat_layout');

        $this->hospcode     = $this->session->userdata('hospcode');
        $this->hserv        = $this->session->userdata('hserv');
        $this->amp_code     = $this->session->userdata('amp_code');
        $this->user_level   = $this->session->userdata('user_level');
        $this->provid = $this->session->userdata('provid');
        $this->year=$this->session->userdata('year');

        if($this->user_level == '3')
            redirect(site_url());

        if($this->user_level == '2')
            redirect(site_url('ampur'));

        $this->load->model('Changwat_model', 'changwat');
        $this->load->model('Basic_model', 'basic');
        $this->changwat->hospcode = $this->hospcode;
        $this->changwat->hserv = $this->hserv;
        $this->changwat->year = $this->year;
        $this->changwat->provid = $this->provid;
    }

    public function index()
    {
        $data['comp']           = $this->basic->get_complication_list();
        $data['code506']        = $this->basic->get_code506_list();
        $data['chw']            = $this->basic->get_changwat_list();
        $data['occpuation']     = $this->basic->get_occupation_list();
        $data['nation']         = $this->basic->get_nation_list();
        $data['hospital_type']  = $this->basic->get_hospital_type_list();

        $this->layout->view('changwat/index_view', $data);
    }

    public function get_list()
    {
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->changwat->get_list( $start, $limit);

        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();

                $obj->e0        = $r->e0;
                $obj->e1        = $r->e1;
                $obj->id        = $r->id;
                $obj->cid       = $r->cid;
                $obj->name      = $r->name;
                $obj->datesick  = to_thai_date($r->datesick);
                $obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10 . ' ' . $this->basic->get_diagname($r->icd10);
                $obj->code506   = $r->disease . ' ' . $this->basic->get_code506name($r->disease);
                $obj->age       = count_age($r->birth);
                $obj->birth     = to_thai_date($r->birth);
                $obj->ptstatus  = $r->result;
                $obj->hospcode  = $r->hospcode;
                $obj->hospname  = get_hospital_name($r->hospcode);

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่มีข้อมูล."}';
        }

        render_json($json);
    }

    public function get_list_total()
    {
        $total = $this->changwat->get_list_total();

        $json = '{"success": true, "total": '.$total.'}';
        render_json($json);
    }

    public function get_detail()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->post('id');
            if(!empty($id))
            {
                $rs = $this->changwat->get_detail($id);
                if($rs)
                {
                    $obj = new stdClass();

                    $obj->id            = $rs->id;
                    $obj->disease       = $rs->disease;
                    $obj->name          = $rs->name;
                    $obj->birth         = to_thai_date($rs->birth);
                    $obj->age           = get_current_age($rs->birth);
                    $obj->sex           = $rs->sex;
                    $obj->cid           = $rs->cid;
                    $obj->hn            = $rs->hn;
                    $obj->mstatus       = $rs->marietal;
                    $obj->nation        = $rs->nation;
                    $obj->nmepate       = $rs->nmepate;
                    $obj->occupation    = $rs->occupat;
                    $obj->date_serv     = to_thai_date($rs->datesick);
                    $obj->ptstatus      = $rs->result;
                    $obj->date_death    = to_thai_date($rs->datedeath);
                    $obj->ptstatus_code = $rs->result;
                    $obj->illdate       = to_thai_date($rs->datefine);
                    $obj->patient_type  = $rs->type;
                    $obj->service_place = $rs->hospital;
                    $obj->school        = $rs->school;
                    $obj->school_class  = $rs->class;
                    $obj->address_type  = $rs->metropol;

                    $obj->chw = substr($rs->addrcode, 0, 2);
                    $obj->amp = substr($rs->addrcode, 2, 2);
                    $obj->tmb = substr($rs->addrcode, 4, 2);
                    $obj->moo = substr($rs->addrcode, 6, 2);

                    $obj->address   = $rs->address;
                    $obj->soi       = $rs->soi;
                    $obj->road      = $rs->road;

                    $obj->code506       = $rs->disease;
                    $obj->diagname      = $this->basic->get_diagname($rs->icd10);
                    $obj->diagcode      = $rs->icd10;
                    $obj->office_id     =$rs->office_id;
                    $obj->complication  = $rs->complica;
                    $obj->organism      = $rs->organism;
                    $obj->date_report   = to_thai_date($rs->datereach);
                    $obj->date_record   = to_thai_date($rs->daterecord);

                    $json = $rs ? '{"success": "true", "rows": ' . json_encode($obj) . '}' : '{"success": false, "msg": "ไม่พบข้อมูล"}';
                }
                else
                {
                    $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
                }
            }
            else
            {
                $json = '{"success": false, "msg": "ไม่พบรายการ"}';
            }

            render_json($json);
        }
        else
        {
            show_error('Not ajax.', 404);
        }
    }

    public function get_waiting_list_total()
    {
        $rs = $this->changwat->get_waiting_list_total();

        $json = '{"success": true, "total": ' . $rs . '}';
        render_json($json);
    }

    public function get_waiting_list()
    {
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $rs = $this->changwat->get_waiting_list( $start, $limit);

        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();

                $obj->id        =$r->id;
                $obj->name      = $r->name;
                $obj->hn        = $r->hn;
                $obj->cid       = $r->cid;
                $obj->sex       = $r->sex;
                $obj->birth     = to_thai_date($r->birth);
                $obj->age       = count_age($r->birth);
                $obj->datesick  = to_thai_date($r->datesick);
                $obj->ptstatus  = $r->result;
                //$obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10 . ' ' . $this->basic->get_diagname($r->icd10);
                $obj->code506   = $r->disease;
                $obj->code506_name = $this->basic->get_code506name($r->disease);
                $obj->hospcode  = $r->hospcode;
                $obj->hospname  = get_hospital_name($r->hospcode);

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบข้อมูล"}';
        }

        //$json = $rs ? '{"success": true, "rows": ' . json_encode($rs) . '}' : '{"success": false, "msg": "ไม่พบรายการ"}';
        render_json($json);
    }

    public function do_approve()
    {
        $id = $this->input->post('id');
        $code506 = $this->input->post('code506');

        if(empty($id) || empty($code506))
        {
            $json = '{"success": false, "msg": "ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบ"}';
        }
        else
        {
            $e0 = ($this->changwat->get_e0()) + 1;
            $e1 = ($this->changwat->get_e1($code506)) + 1;

            $rs = $this->changwat->do_approve($id, $e0, $e1);

            $json = $rs ? '{"success": true}' : '{"success": false, "msg": "ไม่สามารถบันทึกรายการได้"}';
        }

        render_json($json);
    }

    public function do_import()
    {
        $items = $this->input->post('items');

        if(!empty($items))
        {
            foreach($items as $i)
            {

                $e0 = ($this->changwat->get_e0()) + 1;
                $e1 = ($this->changwat->get_e1($i['code506'])) + 1;

                $this->changwat->do_approve($i['id'], $e0, $e1);
            }

            $json = '{"success": true}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่พบรหัสที่ต้องการลบ"}';
        }

        render_json($json);
    }

    public function do_delete_e0()
    {
        $id = $this->input->post('id');

        if(empty($id))
        {
            $json = '{"success": false, "msg": "ข้อมูลไม่สมบูรณ์ กรุณาตรวจสอบ"}';
        }
        else
        {

            $rs = $this->changwat->do_delete_e0($id);

            $json = $rs ? '{"success": true}' : '{"success": false, "msg": "ไม่สามารถบันทึกรายการได้"}';
        }

        render_json($json);
    }

}