<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 30/5/2556
 * Time: 13:52 น.
 * To change this template use File | Settings | File Templates.
 */
class Hdc extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->hdc = $this->load->database('hdc', true);
        $this->load->model('Epidem_model', 'epidem');

    }
    public function index()
    {

        $hospcode=$this->input->post('off_id');
        $s = $this->input->post('s');
        $e = $this->input->post('e');
        $date_start = to_string_date($s);
        $date_end = to_string_date($e);
        $rs = $this->epidem->get_epidem($date_start,$date_end,$hospcode);
        $rows = json_encode($rs);
        $json = '{"success": true, "rows": ' . $rows.'}';
        echo $json;
    }
    function _render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }
}
