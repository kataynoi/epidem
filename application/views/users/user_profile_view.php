<ul class="breadcrumb">
    <li><a href="<?=site_url()?>">หน้าหลัก </a></li>
    <li class="active"> ข้อมูลผู้ใช้ </li>
</ul>
<div class="panel panel-primary col col-lg-12">
    <!-- Default panel contents -->
    <div class="panel-heading">ข้อมูลผู้ใช้ : User Profile</div>
    <dl class="dl-horizontal">
        <dt>ระบบ : System</dt>
        <dd>ระบบราบงานระบาดวิทยา : Epidem online (5)</dd>
        <dt>ชื่อ สกุล</dt>
        <dd><?=$this->session->userdata('user_name');?></dd>
        <dt>Username :</dt>
        <dd><?=$this->session->userdata('username');?></dd>
        <dt>หน่วยบริการ </dt>
        <dd><?=$this->session->userdata('off_name').' ('.$this->session->userdata('off_id').' )';?></dd>
    </dl>

</div>