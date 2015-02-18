<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Basic Controller
 *
 * @author  Mr.Satit Rianpit <rianpit@yahoo.com>
 * @copyright   MKHO <http://mkho.moph.go.th>
 *
 */
class Basic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Basic_model', 'basic');
    }

    public function get_ampur_list()
    {
        $chw = $this->input->post('chw');

        $rs = $this->basic->get_ampur_list($chw);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }

    public function get_tambon_list()
    {
        $chw = $this->input->post('chw');
        $amp = $this->input->post('amp');

        $rs = $this->basic->get_tambon_list($chw, $amp);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }
    public function get_subdistrict_list()
    {
        $amp = $this->input->post('amp');

        $rs = $this->basic->get_subdistrict_list($amp);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }
    public function get_village_list()
    {
        $tmb = $this->input->post('tmb');

        $rs = $this->basic->get_village_list($tmb);

        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->villid        = $r->villid;
                $obj->villno        = $r->villno;
                $obj->villname        = $r->villname;
                $obj->subdistid        = $r->subdistid;
                $obj->distid        = $r->distid;
                $obj->provid        = $r->provid;
                $obj->locatype        = $r->locatype;
                $obj->hospcode  = $this->basic->get_off_name($r->hospcode);

                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            //$rows = json_encode($rs);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่มีข้อมูล."}';
        }

        render_json($json);
    }

    public function get_village_base()
    {
        $hospcode = $this->input->post('hospcode');

        $rs = $this->basic->get_village_base($hospcode);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }
    
    public function get_moo_list()
    {
        $chw = $this->input->post('chw');
        $amp = $this->input->post('amp');
        $tmb = $this->input->post('tmb');

        $rs = $this->basic->get_moo_list($chw, $amp, $tmb);
        $rows = json_encode($rs);

        $json = '{"success": true, "rows": '.$rows.'}';
        render_json($json);
    }
    public function get_organism_list()
    {
        $code506 = $this->input->post('code506');
        $rs = $this->basic->get_ogranism_list($code506);
        $json = '{"success": true, "rows": '.json_encode($rs).'}';

        render_json($json);
    }

    public function search_icd_ajax()
    {
        $q = $this->input->post('query');
        $rs = $this->basic->search_icd_ajax($q);

        $arr_result = array();
        foreach($rs as $r)
        {
            $obj = new stdClass();
            $obj->name = $r->desc_r;
            $arr_result[] = $obj;
        }

        $rows = json_encode($arr_result);
        $json = '{"success": true, "rows": '.$rows.'}';

        render_json($json);
    }
    public function get_office_list_by_amp()
    {
        $amp=$this->input->post('amp');

        $rs = $this->basic->get_office_list_by_amp($amp);
        $json = '{"success": true, "rows": '.json_encode($rs).'}';

        render_json($json);
    }
    public function what_new (){
        $rs=$this->basic->get_what_new();
        $arr_result = array();
        foreach($rs as $r)
        {
            $obj = new stdClass();
            $obj->create_date = to_thai_date($r->create_date);
            $obj->version=$r->version;
            $obj->what_new=$r->what_new;
            $obj->memo=$r->memo;
            $obj->link=$r->link;
            $arr_result[] = $obj;
        }
        $data['what_new']=$arr_result;
        $this->layout->setLayout('default_layout');
        $this->layout->view('about/what_new_view',$data);
    }


}

/* End of file basic.php */
/* Location: ./application/controlers/basic.php */