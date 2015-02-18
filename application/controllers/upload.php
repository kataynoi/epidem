<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
    public $year;
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','file'));
        if(!$this->session->userdata("username_".sys_id()))
            redirect(site_url('users/login'));

        $this->hospcode = $this->session->userdata('hospcode');
        $this->hserv = $this->session->userdata('hserv');
        $this->amp_code = $this->session->userdata('amp_code');
        $this->user_level = $this->session->userdata('user_level');
        $this->year = $this->session->userdata('year');
        $this->provid = $this->session->userdata('provid');
        if($this->user_level == '3')
            $this->layout->setLayout('default_layout');

        if($this->user_level == '2')
            $this->layout->setLayout('ampur_layout');

        if($this->user_level == '1')
            redirect(site_url('admin'));

        $this->load->model('Imports_model', 'imports');
    }

    public function index()
    {
        $this->load->view('upload/index', array('error' => ''));
    }

 public function do_upload_r506()

    {
        $info=new stdClass();
        $upload_path_url = base_url().'uploads/';

        $config['upload_path'] = FCPATH.'uploads';
        $config['allowed_types'] = 'txt';
        $config['max_size'] = '300000';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('upload/index', $error);

        } else {
            $data = $this->upload->data();
            //set the data for the json array
            $info->name = $data['file_name'];
            $info->size = $data['file_size'];
            $info->type = $data['file_type'];
            $info->url = $upload_path_url .$data['file_name'];
            // I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$data['file_name']
            $info->thumbnail_url = $upload_path_url .$data['file_name'];
            $info->delete_url = base_url().'upload/deleteImage/'.$data['file_name'];
            $info->delete_type = 'DELETE';

            //this is why we put this in the constants to pass only json data
            if (isset($_REQUEST['is_ajax'])) {
                echo json_encode(array($info));
            } else {
                $file_data['upload_data'] = $this->upload->data();
                $file_data['import']=$this->import_r506($info->name);
                $this->layout->view('upload/upload_success', $file_data);
            }
        }
    }

    public function import_r506($file){
        $file_name=$file;
        $file=FCPATH.'uploads/'.$file;
        chmod($file,0666);
        $handle = fopen($file, "r+b");
//echo $file;exit();
        $line=0;
        $filed='';
        $sql='';
  while (!feof($handle))
    {
        $line++;
            $buffer = fgets($handle, 4096);
            if($line==1){continue;}
            $buffer= str_replace('"','', $buffer);
            $buffer= str_replace(',','|', $buffer);
            $sql.=$this->provid."|".$this->hospcode."|".$this->year."|".$buffer."|".$file_name."|1"."\n";
    }
        $last = sizeof($sql) - 1 ;
        fclose($handle);
        $handle = fopen($file, "wb");
        fwrite($handle, $sql);
        fclose($handle);
        $file= str_replace('\\','/', $file);
        $this->imports->imports_r506($file);
}

}