<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Controller
 *
 * Controller information information
 *
 * @package     Controller
 * @author      Satit Rianpit <rianpit@gmail.com>
 * @since       Version 1.0.0
 * @copyright   Copyright 2013 Data center of Maha Sarakham Hospital
 * @license     http://his.mhkdc.com/licenses
 */

class Users extends CI_Controller
{
    public $provid;
    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('login_layout');
        //load model
        $this->load->model('Basic_model', 'basic');
        $this->load->model('User_model', 'users');
        $this->user_db = $this->load->database('user', true);

        $this->sys_id =sys_id();
        $this->provid=$this->session->userdata('provid');
    }

    //index action
    public function index()
    {
        $this->login();
    }
    public function login(){

        if($this->session->userdata("username_".sys_id()))
        {
            redirect(site_url(), 'refresh');
        }
        else
        {
            $this->layout->view('users/login_view');
        }
    }

    public function do_login()
    {
        $username = $this->input->post('username');
        $old_pass=$this->input->post('password');
        $password = $this->encode($this->input->post('password'));

        $users = $this->users->do_auth($username, $password,$this->sys_id);
        if($users)
        {
            $data = array(
                "username_".$this->sys_id      => $users->username,
                'user_id'       => $users->id,
                'hospcode'      => $users->hospcode,
                'hospname'      => $users->hospname,
                'user_level'    => $users->user_level,
                'off_type'    => $users->off_type,
                'user_type'     => $users->user_type,
                'fullname'      => $users->name,
                'amp_code'      => $this->basic->get_amp_code($users->hospcode),
                'sys_id'        => $users->sys_id,
                'sys_name'      => $users->sys_name,
                'email'         =>$users->email,
                'new_msg'       =>$this->users->get_new_msg_total($users->id),
                'year'          =>date('Y'),
                'provid'        =>$this->basic->get_provid($users->hospcode),
                'hserv'         =>$this->basic->get_hserv($users->hospcode)
            );
            $this->set_login_time($users->id);
            $this->session->set_userdata($data);

            if($old_pass=='1234')
                redirect(site_url('users/change_pass'));
            else if($users->user_level == 0)
                redirect(site_url('admin'));
            else if($users->user_level == 1)
                redirect(site_url('changwat'));
            else if($users->user_level == 2)
                redirect(site_url('ampur'));
            else redirect(site_url());
        }
        else
        {
            $data = array('error' => 1);
            $this->layout->view('users/login_view', $data);
        }
    }

    public function user_profile()
    {
        $this->layout->setLayout('default_layout');
        $this->layout->view('users/user_profile_view');
    }
//#### list Users
    public function all_users()
    {
        $data['amp']=$this->users->get_amp($this->provid);
        $this->layout->setLayout('default_layout');
        $this->layout->view('users/all_users_view',$data);
    }

    public function get_all_users (){
        $sys_id =$this->session->userdata('sys_id');
        $start  = $this->input->post('start');
        $stop   = $this->input->post('stop');
        $amp=$this->input->post('amp');
        $hospcode=$this->input->post('hospcode');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;
        if(empty($amp) && empty($hospcode)){
            $rs=$this->users->get_all_users($sys_id,$start,$stop);
        }else if(!empty($amp) && empty($hospcode)){
            $rs=$this->users->get_all_users_by_amp($sys_id,$amp,$start,$stop);
        }else if(!empty($amp) && !empty($hospcode)){
            $rs=$this->users->get_all_users_by_hospcode($sys_id,$hospcode,$start,$stop);
        }


        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->id        = $r->user_id;
                $obj->name        = $this->users->get_username($r->user_id);
                $obj->off_name  = $this->users->get_off_name($r->user_id);
                $obj->user_level  = $this->get_user_level($r->sys_level);
                $obj->login_time   =$r->login_time;
                $obj->in_time   =DateFormatDiff($r->time_in);
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


    public function get_all_users_total()
    {
        $amp=$this->input->post('amp');
        $hospcode=$this->input->post('hospcode');
        if(empty($amp) && empty($hospcode)){
            $rs = $this->users->get_all_users_total();
        }else if(!empty($amp) && empty($hospcode)){
            $rs = $this->users->get_all_users_total_by_amp($amp);
        }else if(!empty($amp) && !empty($hospcode)){
            $rs = $this->users->get_all_users_total_by_hospcode($hospcode);
        }


        $json = '{"success": true, "total": ' . $rs . '}';
        render_json($json);
    }

//#### End  List  Users
    public function edit_profile()
    {
        $id=$this->session->userdata('user_id');
        $data['office_list']=$this->users->get_office();
        $data['position_list']=$this->users->get_position();
        $data['user']=$this->users->get_user($id);

        $this->layout->setLayout('default_layout');
        $this->layout->view('users/edit_profile_view',$data);
    }
    public function change_pass()
    {
        if(!$this->session->userdata("username_".sys_id()))
        {
            $this->layout->view('users/login_view');
        }
        else
        {
        $this->layout->setLayout('default_layout');
        $this->layout->view('users/change_pass_view');
        }
    }
    public function save_pass(){
        $password = $this->encode($this->input->post('password'));
        $id = $this->input->post('user_id');
        //$id=$this->session->userdata('user_id');
        $rs=$this->users->save_pass($id,$password);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function save_edit_user(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');
        $rs=$this->users->save_edit_user($data);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
    public function save_edit_user_admin(){

        $data=$this->input->post('items');
        $rs=$this->users->save_edit_user_admin($data);
        if($rs){
            $json = '{"success": true,"msg":"บันทึกข้อมูลเรียบร้อยแล้ว"}';
        }else{
            $json = '{"success": false,"msg":"บันทึกข้อมูลไม่สำเร็จ"}';
        }

        render_json($json);
    }
    public function save_register(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $data=$this->input->post('items');
        $data['password']=$this->encode($data['password']);
        $rs=$this->users->save_register($data);
        $id=$this->users->getLastInserted();
        $rs2=$this->users->save_system_user($id,$data['sys_id']);
        if($rs){
            $json = '{"success": true,"msg":"ระบบจะแจ้งผลการลงทะเบรยนทาง Email ที่ท่านได้ลงทะเบียนไว้"}';
        //$json = '{"success": true,"msg":"ท่านสามารถเข้าสู่ระบบได้ทันที"}';


        }else{
            $json = '{"success": false,"msg":"ไม่สามารถบันทึกข้อมูลได้ อาจมีการส่งซ้ำซ้อน ..."}';
        }

        render_json($json);
    }
    public function request_use_system(){
        //$password = $this->encode($this->input->post('password'));
        //$id=$this->session->userdata('user_id');
        $username=$this->input->post('username');
        $password=$this->encode($this->input->post('password'));
        $sys_id=$this->input->post('sys_id');
        $id=$this->users->get_user_id($username,$password);

        if($id){
            $rs=$this->users->save_system_user($id,$sys_id);
            if($rs){
                $json = '{"success": true,"msg":"ระบบจะแจ้งผล ทาง Email ที่ท่านได้ลงทะเบียนไว้"}';
            }
        }else{
            $json = '{"success": false,"msg":"ไม่สามารถบันทึกข้อมูลได้ อาจมีการส่งซ้ำซ้อน ..."}';
        }
        render_json($json);
    }

    public function get_user (){
        $id  = $this->input->post('id');
        $rs=$this->users->get_user($id);

        if($rs)
        {
            $rows = json_encode($rs);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else
        {
            $json = '{"success": false, "msg": "ไม่มีข้อมูล."}';
        }

        render_json($json);
    }

    // ############### End of Users
    // ############### Start Message
    public function message()
    {
        $data['users']=$this->users->get_users();
        $this->layout->setLayout('default_layout');
        $this->layout->view('users/message_view',$data);
    }

    public function get_message (){
        $status=$this->input->post('status');
        $sys_id =$this->session->userdata('sys_id');
        $start  = $this->input->post('start');
        $stop   = $this->input->post('stop');

        $start = empty($start) ? 0 : $start;
        $stop = empty($stop) ? 25 : $stop;

        $limit = (int) $stop - (int) $start;
        if($status=='1'){
            $rs=$this->users->get_message($sys_id,$start,$stop);
        }else if($status=='2'){
            $rs=$this->users->get_message_out($sys_id,$start,$stop);
        }

        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->id        = $r->id;
                $obj->datesend  = to_thai_date_time($r->datesend);
                $obj->title     =$r->title;
                $obj->message   = $r->message;
                $obj->sender    = $this->users->get_username($r->sender);
                $obj->reciver   = $this->users->get_username($r->reciver);
                $obj->daterecive= to_thai_date($r->reciver);
                $obj->read      = $r->read;
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

    public function get_message_total()
    {
        $status=$this->input->post('status');
        if($status=='1'){
            $rs = $this->users->get_message_total();
        }else if($status=='2'){
            $rs = $this->users->get_message_out_total();
        }


        $json = '{"success": true, "total": ' . $rs . '}';
        render_json($json);
    }

    public function send_message(){
        $items=$this->input->post('items');
        $items['sys_id']=$this->sys_id;
        $rs=$this->users->save_message($items);
        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);

    }
    public function set_read_message(){
        $id=$this->input->post('id');
        $user_id=$this->session->userdata('user_id');
        $rs = $this->users->set_read_message($id);
        $new_msg=$this->users->get_new_msg_total($user_id);
        $this->session->set_userdata('new_msg',$new_msg);
        if($rs){
            $json = '{"success": true, "rows": '.$new_msg.'}';
        }else{
            $json = '{"success": false,"rows": '.$new_msg.'}';
        }

        render_json($json);
    }
    public function del_message(){
        $id=$this->input->post('id');
        $rs = $this->users->del_message($id);

        if($rs){
            $json = '{"success": true}';
        }else{
            $json = '{"success": false}';
        }

        render_json($json);
    }
 //######################## END Message

    public function get_hosptype ($hospcode){
        //echo $off_id;
        $rs=$this->users->get_hosptype($hospcode);
        return $rs->hosptype;
        }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url(),'refresh');
    }
    public  function get_duplicate_user(){
        $username=$this->input->post('username');
        $id=$this->input->post('id');
        $total = $this->users->get_duplicate_user($id,$username);
        $json = '{"success": true, "total": '.$total.'}';
        render_json($json);
    }
    public  function get_duplicate_email(){
        $email=$this->input->post('email');
        $id=$this->input->post('id');
        $total = $this->users->get_duplicate_email($id,$email);
        $json = '{"success": true, "total": '.$total.'}';
        render_json($json);
    }
    public function register()
    {   $data['office_list']=$this->users->get_office();
        $data['position_list']=$this->users->get_position();
        $this->layout->setLayout('login_layout');
        $this->layout->view('users/register_view',$data);
    }
public function forget_pass ($code){

    $data['code']=$code;
    $rs=$this->users->check_code_for_repass($code);
    $data['id']=$rs->id;
    $time=(DateTimeDiff(date('Y-m-d H:i:s'),$rs->date_repass)/60);
    if($time>30){

        $data['alert']="<div class='alert alert-danger text-center'>ระยะเวลา เปลี่ยนรหัสผ่าน หมด อายุ เกิน 30 นาที";
        $data['alert'].="<a href='".site_url('users/login')."'><br><i class='glyphicon glyphicon-refresh'></i> ขอเปลี่ยนรหัสผ่านใหม่</a></div>";
        $this->layout->setLayout('login_layout');
        $this->layout->view('users/forget_view',$data);
    }else if($data['id']!=''){
        $data['alert']='';
        $this->layout->setLayout('login_layout');
        $this->layout->view('users/forget_view',$data);
    }else{
        $this->layout->view('users/login_view');
    }

}
    public function get_waiting_users_total(){
        $sys_id=$this->input->post('sys_id');
        $total=$this->users->get_waiting_users_total($sys_id);

        $json = '{"success": true, "total": '.$total.'}';

        render_json($json);
    }
    public function get_waiting_users(){
        $sys_id=$this->input->post('sys_id');
        $rs=$this->users->get_waiting_users($sys_id);


        if($rs)
        {
            $arr_result = array();
            foreach($rs as $r)
            {
                $obj = new stdClass();
                $obj->id        = $r->id;
                $obj->name        = $r->name;
                $obj->email       = $r->email;
                $obj->off_name  = $this->users->get_off_name($r->id);
                $arr_result[] = $obj;
            }

            $rows = json_encode($arr_result);
            //$rows = json_encode($rs);
            $json = '{"success": true, "rows": '.$rows.'}';
        }
        else{
            $json = '{"success": false, "msg": "ไม่มีข้อมูล."}';
        }
        render_json($json);
    }
    public function access_denied(){
        $json = '{"success": false, "msg": "Access denied, please login."}';

        render_json($json);
    }
    public function set_approve_user(){
        $id=$this->input->post('id');
        $sys_id=$this->input->post('sys_id');
        $rs=$this->users->set_approve_user($sys_id,$id);
        if($rs){
            $json = '{"success": true, "msg":" ส่ง Email เรียบร้อยแล้ว กรุณาตรวจสอบ " }';
        }else{
            $json = '{"success": false, "msg": "ไม่มี Username หรือ Email นี้ ในระบบ"}';
            }
            render_json($json);
    }    public function set_del_user(){
        $id=$this->input->post('id');
        $sys_id=$this->input->post('sys_id');
        $rs=$this->users->del_user_system($sys_id,$id);
        if($rs){
            $json = '{"success": true, "msg":" ลบเรียบร้อย " }';
        }else{
            $json = '{"success": false, "msg": "ไม่สามารถ ลบ ได้"}';
            }
            render_json($json);
    }
    public function set_login_time($user_id){
        $rs=$this->users->set_login_time(sys_id(),$user_id);
    }
    public function encode($txt){
        $en=md5(md5($txt).'84c9aef34f7bc237');
        //$en=md5(md5($txt).'bhjhjghjg');
        return $en;
    }
    public function get_encode($txt='1234'){

        echo $this->encode($txt);
    }
    public function get_user_level($id)
    {
        $text='';
        switch ($id)
        {
            case '0':
                $text='Administrator';
                break;
            case '1':
                $text='สสจ.';
                break;
            case '2':
                $text='สสอ.';
                break;
            case '3':
                $text='รพ.สต.';
                break;
        }

        return $text;
    }



}