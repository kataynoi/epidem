<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 30/5/2556
 * Time: 13:52 น.
 * To change this template use File | Settings | File Templates.
 */


class Settings extends CI_Controller {
    public $hospcode;
    public $hserv;
    public $amp_code;
    public $user_level;
    public $provid;
    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('default_layout');

        //load model
        $this->load->model('Setting_model', 'setting');
        $this->load->model('Basic_model', 'basic');

        $this->hospcode = $this->session->userdata('hospcode');
        $this->provid = $this->session->userdata('provid');
        $this->hserv = $this->session->userdata('hserv');
        $this->amp_code = $this->session->userdata('amp_code');
        $this->user_level = $this->session->userdata('user_level');
        $this->setting->hospcode = $this->hospcode;
        $this->setting->hserv = $this->hserv;
        $this->setting->provid = $this->provid;
    }
    public function index()
    {
        $this->layout->view('settings/index_view');
    }
    public function set_office506()
    {
        $data['hserv']=$this->basic->get_office($this->hospcode);
        $this->layout->view('settings/set_office506_view',$data);
    }
    public function save_edit_hserv(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');
        $rs=$this->setting->save_edit_hserv($data);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function save_village_base(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');
        $rs=$this->setting->save_village_base($data);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    } public function save_village(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');
        $rs=$this->setting->save_village($data);
    if($rs){
        $json = '{"success": true, "msg": "บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $json = '{"success": false, "msg": "ไม่สามารถบันทึกข้อมูลได้"}';
    }

        render_json($json);
    } public function del_village_base(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $villid=$this->input->post('villid');
        $rs=$this->setting->del_village_base($villid);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function set_village()
    {
        $data['amp']=$this->basic->get_district_list($this->provid);
        $this->layout->view('settings/set_village_view',$data);
    }
    public  function set_median(){
        $data['amp']=$this->basic->get_district_list($this->provid);
        $data['code506']        = $this->basic->get_code506_list();
        $data['year'] =$this->session->userdata('year');
        $this->layout->view('settings/set_median_view',$data);
    }

    public  function get_median_month(){
        $items=$this->input->post('items');
        $hospcode=$items['hospcode'];
        $year=$items['year'];
        $code506=$items['code506'];
       if($this->count_median_month($year,$hospcode)==0){
            $this->setting->set_new_median_month($year,$hospcode);
       }
        if(empty($code506))
        {
            $rs=$this->setting->get_median_month($year,$hospcode);
        }else{
            $rs=$this->setting->get_median_month_by_code506($year,$hospcode,$code506);
        }
        if($rs)
        {
            $arr_result = array();

            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->hospname  = $this->basic->get_hospname($r->hospcode);
                $obj->year        =($r->year+543);
                $obj->diseasename ="[".$r->code506."] ".$this->basic->get_code506name($r->code506);
                $obj->m1    =$r->m1 <>''?$r->m1:'';
                $obj->m2    =$r->m2 <>''?$r->m2:'';
                $obj->m3    =$r->m3 <>''?$r->m3:'';
                $obj->m4    =$r->m4 <>''?$r->m4:'';
                $obj->m5    =$r->m5 <>''?$r->m5:'';
                $obj->m6    =$r->m6 <>''?$r->m6:'';
                $obj->m7    =$r->m7 <>''?$r->m7:'';
                $obj->m8    =$r->m8 <>''?$r->m8:'';
                $obj->m9    =$r->m9 <>''?$r->m9:'';
                $obj->m10    =$r->m10 <>''?$r->m10:'';
                $obj->m11    =$r->m11 <>''?$r->m11:'';
                $obj->m12    =$r->m12 <>''?$r->m12:'';

                $arr_result[] = $obj;
            }
            $json = $rs ? '{"success": "true", "rows": ' . json_encode($arr_result) . '}' : '{"success": false, "msg": "ไม่พบข้อมูล"}';

            /*$rows = json_encode($arr_result);
            $json = '{"success": true, "rows": '.$rows.'}';*/
    }
        render_json($json);
    }
    public function save_median_month(){
        $items=$this->input->post('items');
        $rs=$this->setting->save_median_month($items);
        if($rs){
            $json = '{"success": true, "msg": "บันทึกข้อมูลเรียบร้อย"}';
        }else{
            $json = '{"success": false, "msg": "ไม่สามารถบันทึกข้อมูลได้"}';
        }
        render_json($json);
    }
    public  function count_median_month($year,$hospcode){
        $rs=$this->setting->count_median_month($year,$hospcode);
        return $rs;
    }


    public  function set_year(){
        $data['amp']=$this->basic->get_district_list($this->provid);
        $this->layout->view('settings/set_year_view',$data);
    }
    public  function save_year(){
        $now_year=$this->input->post('year');
        //$re=$this->session>set_userdata('year',$now_year);
        //$this->session->set_userdata('year',$now_year);
        if($this->session->set_userdata('year',$now_year)){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }
        render_json($json);
    }

    public function manage_village()
    {
        $data['amp']=$this->basic->get_district_list($this->provid);
        $this->layout->view('settings/manage_village_view',$data);
    }

    public function about(){
        $this->layout->view('settings/about_view');
    }

}
