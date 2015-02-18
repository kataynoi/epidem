<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Reports_model', 'report');
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Basic_model', 'basic');
        if(!$this->session->userdata("username_".sys_id()))
            redirect(site_url('users/login'));
    }
	/**
	* Index controller
	 */
	public function index()
	{
        $data['foreign']=$this->report->get_pt_foreign($this->session->userdata('year'));
        $data['epe0']     =$this->admin->get_all_epe0($this->session->userdata('year'));
        $data['epe0_sso']     =$this->admin->get_all_epe0_sso($this->session->userdata('year'));
        $data['epe0_ssj']     =$this->admin->get_all_epe0_ssj($this->session->userdata('year'));
        $data['surveillance']     =$this->admin->get_all_surveillance($this->session->userdata('year'));
        $data['top10_506']  =$this->report->get_top10_506($this->session->userdata('year'));
        $data['r506_by_amp']  =$this->report->get_r506_by_amp($this->session->userdata('year'));
        $data['code506']        = $this->basic->get_code506_list();
		$this->layout->view('pages/index_view',$data);
	}

    public function about()
    {
        $this->layout->view('pages/about_view');
    }
    public function get_eo_by_sso(){
        $year=$this->input->post('year');
        $rs     =$this->report->get_r506_by_amp($year);
        $json = '{"success": true, "rows": '.json_encode($rs).'}';
        render_json($json);
    }
    public function get_disease(){
        $year=$this->input->post('year');
        $code506 =$this->input->post('code506');
        if($code506 !='00'){
            $rs     =$this->report->get_disease_by_year_code506($year,$code506);
        }else{
            $rs     =$this->report->get_disease_by_year($year);
        }

        $arr_result = array();
        foreach($rs as $r)
        {
            $obj = new stdClass();
            $obj->m_id      = $r->m_id;
            $obj->fullname  =$r->fullname;
            $obj->total     =$r->total;
            $obj->median    =$this->report->get_median_month($year,$code506,$r->m_id);
            $arr_result[] = $obj;
        }
        $json = $rs ? '{"success": "true", "rows": ' . json_encode($arr_result) . '}' : '{"success": false, "msg": "ไม่พบข้อมูล"}';
        render_json($json);
    }
    public function get_top10(){
            $rs     =$this->report->get_top10_506($this->session->userdata('year'));
        $json = '{"success": true, "rows": '.json_encode($rs).'}';
        render_json($json);
    }
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */