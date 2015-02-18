<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Imports extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function index()
    {
        $this->layout->view('imports/upload_view', array('error' => ' ' ));
    }

    function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'zip|rar|7z|txt|jpg|pdf';
        $config['max_size']	= '102400';
/*        $config['max_width']  = '10240';
        $config['max_height']  = '7680';*/

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());

            $this->layout->view('imports/upload_view', $error);
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->layout->view('imports/import43_view', $data);
        }
    }
    public function import_r506(){

        $this->layout->view('imports/upload_r506_view');
    }
}
?>