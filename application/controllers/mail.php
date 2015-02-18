<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail extends CI_Controller {
    public function __construct()
    {
        parent::__construct();

        $this->layout->setLayout('default_layout');
        //load model
        $this->load->model('User_model', 'users');
        $this->user_db = $this->load->database('user', true);
        $this->sys_id ='5';
    }
    function send($email_from,$email_name,$to_list,$replay_to,$subject,$message)
    {


        $ci = get_instance();
        $ci->load->library('email');
/*        $config['protocol'] = "smtp";
        $config['smtp_host'] = "ssl://smtp.gmail.com";
        $config['smtp_port'] = "465";
        $config['smtp_user'] = "phanpichit@gmail.com";
        $config['smtp_pass'] = "spiderman";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";*/

        $config['protocol'] = "smtp";
        $config['smtp_host'] = "mail.ssokudrang.com";
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "phanpichit@ssokudrang.com";
        $config['smtp_pass'] = "spiderman";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

/*        $config['protocol'] = "smtp";
        $config['smtp_host'] = "smtp.googlemail.com";
        $config['smtp_port'] = "25";
        $config['smtp_user'] = "phanpichit@gmail.com";
        $config['smtp_pass'] = "spiderman";
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";*/

        $ci->email->initialize($config);

        $ci->email->from($email_from, $email_name);
        //$list = array($to_list);
        $ci->email->to($to_list);
        $this->email->reply_to($replay_to,'');
        $ci->email->subject($subject);
        $ci->email->message($message);
        $this->email->send();

    }
public function mail_to_re_password(){
    $str=$this->rand_String(64,6);
    $url=site_url('users/forget_pass/').'/'.$str;
    $username=$this->input->post('username');
    $email=$this->input->post('email');
    $rs=$this->users->set_str_forget_pass($username,$email,$str);
    if($rs >0){
    $email_from='phanpichit@gmail.com';
    $email_name='ระบบ ucercenter';
    $to_list = array($email);
    $replay_to = 'phanpichit@gmail.com';
    $subject = 'ลืมรหัสผ่าน User Center มหาสารคาม';
    //$message='ccc';
    $message="<b>หากคุณไม่ได้ ร้องขอ ความช่วยเหลือการลืมรหัสผ่าน ของระบบ User Center มหาสารคาม กรุณา ลบ Email นี้ทิ้ง</b><br>";
    $message.="หากท่านได้ รองขอ เปลี่ยนหรัสผ่าน คลิกที่ นี่ เพื่อเปลี่ยนรหัสผ่าน <a href='".$url."'>".$url."</a>" ;
    $message.="<br><br> Admin User Center Mahasarakham <br> thait-rex@hotmail.com";

   $this->send($email_from,$email_name,$to_list,$replay_to,$subject,$message);
        $json = '{"success": true, "msg":" ส่ง Email เรียบร้อยแล้ว กรุณาตรวจสอบ " }';
    }
    else
    {
        $json = '{"success": false, "msg": "ไม่มี Username หรือ Email นี้ ในระบบ"}';
    }

    render_json($json);
}
public function send_mail_approve(){

    //$username=$this->input->post('username');
    $url=site_url('users/login');
    $url='http://mkho.moph.go.th/mis/epidem/index.php/users/login';
    $email=$this->input->post('email');
    $sys_name=$this->users->get_sys_name($this->input->post('sys_id'));
    $email_from='phanpichit@gmail.com';
    $email_name='ระบบ ucercenter';
    $to_list = $email;
    $replay_to = 'phanpichit@gmail.com';
    $subject = 'ยืนยัน '.$sys_name;
    //$message='ccc';
    $message="<b>ท่านได้รับ อนุมัติ ให้ใช้ระบบ ".$sys_name." แล้ว</b><br>";
    $message.="ท่านสามารถเข้าสู่ระบบได้ที่  <a href='".$url."'>".$url."</a>" ;
    $message.="<br><br> Admin User Center Mahasarakham <br> thait-rex@hotmail.com";
    $this->send($email_from,$email_name,$to_list,$replay_to,$subject,$message);

    $json = '{"success": true, "msg":" ส่ง Email เรียบร้อยแล้ว กรุณาตรวจสอบ " }';

    render_json($json);
}

public function rand_String($num, $op = 1) { // random string
    switch ($op) {
        case 1 :
            $alp_str = "0123456789";
            break;
        case 2 :
            $alp_str = "abcdefghijklmnopqrstuvwxyz";
            break;
        case 3 :
            $alp_str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            break;
        case 4 :
            $alp_str = "abcdefghijklmnopqrstuvwxyz0123456789";
            break;
        case 5 :
            $alp_str = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            break;
        case 6 :
            $alp_str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            break;
    }
    return substr ( str_shuffle ( $alp_str ), 0, $num );
}
    public function encode($txt){
        $en=base64_encode(md5(md5($txt).'84c9aef34f7bc237'));
        //$en=md5(md5($txt).'bhjhjghjg');
        return $en;
    }
}