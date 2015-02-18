<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 30/5/2556
 * Time: 13:52 น.
 * To change this template use File | Settings | File Templates.
 */


class Reports extends CI_Controller {
    public $hospcode;
    public $hserv;
    public $amp_code;
    public $user_level;
    public $year;
    public $provid;
    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('reports_layout');

        //load model
        $this->load->model('Reports_model', 'report');
        $this->load->model('Basic_model', 'basic');

        $this->hospcode = $this->session->userdata('hospcode');
        $this->hserv = $this->session->userdata('hserv');
        $this->amp_code = $this->session->userdata('amp_code');
        $this->user_level = $this->session->userdata('user_level');
        $this->report->hospcode = $this->hospcode;
        $this->report->hserv = $this->hserv;
        $this->report->year = $this->session->userdata('year');
        $this->report->provid = $this->session->userdata('provcode');
    }



    public function index()
    {
        $this->layout->view('reports/index_view');
    }
    public function e0()
    {
        $this->layout->view('reports/e0_view');
    }
    public function e1()
    {
        $data['nation']         = $this->basic->get_nation_list();
        $data['code506']        = $this->basic->get_code506_list();
        $this->layout->view('reports/e1_view',$data);
    }
    public function get_e1_list()
    {
        if($this->user_level=='3'){
            $filed='hospcode';
            $val=$this->hospcode;
            $order_by='e0_hosp';
        } else if($this->user_level=='2'){
            $filed='amp_code';
            $val=$this->amp_code.' AND e1_sso IS NOT NULL ';
            $order_by='e0_sso';
        }else if($this->user_level=='1' || $this->user_level=='0'){
            $filed='e1 IS NOT NULL';
            $val='';
            $order_by='e1';
        }
        $start = $this->input->post('start');
        $stop = $this->input->post('stop');

        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $s = to_mysql_date($s);
        $e = to_mysql_date($e);

        $n = $this->input->post('n');
        $c = $this->input->post('c');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;

        $by_date = $s && $e;

        if($by_date && !empty($c) && empty($n))
        {
            $rs = $this->report->get_list_by_code506($filed,$val, $s, $e, $c ,$start,$limit,$order_by);
        }
        else if($by_date && !empty($c) && !empty($n))
        {
            $rs = $this->report->get_list_by_code506_nation($filed,$val,$s, $e,$c,$n,$start,$limit,$order_by);
        }
        else if($by_date && empty($c) && !empty($n))
        {
            $rs = $this->report->get_list_by_nation($filed,$val,$s, $e,$n,$start,$limit,$order_by);
        }
        else if($by_date && empty($c) && empty($n))
        {
            $rs = $this->report->get_list_by_date($filed,$val,$s, $e,$start,$limit,$order_by);
        }


        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();
                if($this->user_level=='1' || $this->user_level=='0'){
                    $obj->e0        = $r->e0;
                    $obj->e1        = $r->e1;
                }else if($this->user_level=='2'){
                    $obj->e0        = $r->e0_sso;
                    $obj->e1        = $r->e1_sso;
                }else if($this->user_level=='3'){
                    $obj->e0        = $r->e0_hosp;
                    $obj->e1        = $r->e1_hosp;
                }
                $obj->id        =$r->id;
                $obj->name      = $r->name;
                $obj->hn        = $r->hn;
                $obj->cid       = $r->cid;
                $obj->datesick  = to_thai_date($r->datesick);
                $obj->datefine  = to_thai_date($r->datefine);
                $obj->address   = $r->address . ' ' . get_address($r->addrcode);
                $obj->diag      = $r->icd10;
                $obj->code506   = $r->disease . ' ' . $this->basic->get_code506name($r->disease);
                $obj->nation    = get_nation_nhso_name($r->nation);
                $obj->ptstatus  = $r->result;
                $obj->latlng 	= !empty($r->latitude) && !empty($r->longtitude) ? '1' : '0';

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

    public function get_e1_list_total()
    {
        if($this->user_level=='3'){
            $filed='hospcode';
            $val=$this->hospcode;
        } else if($this->user_level=='2'){
            $filed='amp_code';
            $val=$this->amp_code.' AND e1_sso IS NOT NULL ';
        }else if($this->user_level=='1' || $this->user_level=='0'){
            $filed='e1 IS NOT NULL';
            $val='';
        }

        $c = $this->input->post('c');
        $n = $this->input->post('n');

        $s = $this->input->post('s');
        $e = $this->input->post('e');

        $s = to_mysql_date($s);
        $e = to_mysql_date($e);

        $by_date = $s && $e;

        if($by_date && !empty($c) && empty($n))
        {
            $total = $this->report->get_list_total_by_code506($filed,$val, $s, $e, $c);
        }
        else if($by_date && !empty($c) && !empty($n))
        {
            $total = $this->report->get_list_total_by_code506_nation($filed,$val,$s, $e,$c,$n);
        }
        else if($by_date && empty($c) && !empty($n))
        {
            $total = $this->report->get_list_total_by_nation($filed,$val,$s, $e,$n);
        }
        else if($by_date && empty($c) && empty($n))
        {
            $total = $this->report->get_list_total_by_date($filed,$val,$s, $e);
        }


        $json = '{"success": true, "total": '.$total.'}';
        render_json($json);
    }

    public function foreign(){

        $data['foreign']=$this->report->get_pt_foreign($this->session->userdata('year'));

        $this->layout->view('reports/foreign_view',$data);

    }
}
