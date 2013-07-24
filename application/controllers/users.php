<?php
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'user');
    }

    public function user_session()

    {
        $json=$this->input->post('datajson');
           $data = array(
                'username' => $json['rows']['username'],
                'status' => 'online',
                'user_id' => $json['rows']['id'],
                'off_id' => $json['rows']['office'],
                'user_level' => $json['rows']['user_level'],
                'user_type' => $json['rows']['user_type'],
                'user_name' => $json['rows']['name'],
                'off_name' => $json['rows']['off_name']
            );
            $this->session->set_userdata($data);
        return true;
    }
    public function login()
    {
        $this->load->view('users/login_view');
    }
    public function user_profile()
    {
        $this->layout->view('users/user_profile_view');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('main/'));
    }
    function _render_json($json)
    {
        ini_set('display_errors', 0);
        header('Content-Type: application/json');
        echo $json;
    }
}