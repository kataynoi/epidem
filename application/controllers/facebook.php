<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Facebook extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('input');
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->library('security');
    }

    function Facebook() {
        parent::Controller();
        $cookies = $this->load->model('facebook_model');
    }
    function index() {
        $this->load->view('facebook/facebook_log_view');
    }

    function test1() {
        $data = array();
        $data['user'] = $this->facebook_model->get_facebook_cookie();
        $this->load->view('facebook/test1', $data);
    }

    function test2() {
        $data['friends'] = $this->facebook_model->get_facebook_cookie();
        $this->load->view('facebook/facebook_log_view', $data);
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
?>