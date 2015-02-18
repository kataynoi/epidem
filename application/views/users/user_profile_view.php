<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li class="active"> ข้อมูลผู้ใช้ </li>
</ul>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">ข้อมูลผู้ใช้ : User Profile จาก ระบบ Usercenter
            <a href='<?php echo site_url('users/edit_profile');?>' class=''> <i class="glyphicon glyphicon-edit"></i> แก้ไข : Edit</a>
    </div>
    <dl class="dl-horizontal">
        <dt>ระบบ : System</dt>
        <dd><?php echo $this->session->userdata('sys_name')."( SystemID : ".$this->session->userdata('sys_id').")";?></dd>
        <dt>ชื่อ สกุล</dt>
        <dd><?php echo $this->session->userdata('user_name')."( UserID : ".$this->session->userdata('user_id').")";?></dd>
        <dt>Username :</dt>
        <dd><?php echo $this->session->userdata("username_".sys_id())." (".$this->session->userdata('user_level').")";?></dd>
        <dt>หน่วยบริการ </dt>
        <dd><?php echo $this->session->userdata('hospname').' ('.$this->session->userdata('hospcode').' )';?></dd>
        <dt>ประเภทหน่วยบริการ </dt>
        <dd><?php echo $this->session->userdata('user_type');?></dd>
        <dt>E-mail </dt>
        <dd><?php echo $this->session->userdata('email');?></dd>
        <dt>เบอร์โทร </dt>
        <dd><?php echo $this->session->userdata('amp_code');?></dd>
    </dl>
</div>
