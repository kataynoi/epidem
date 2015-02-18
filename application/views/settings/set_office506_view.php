<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 12/11/2556
 * Time: 0:28 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url('settings')?>"> ตั้งค่าระบบ </a></li>
    <li class="active"> ตั้งค่าหน่วยบริการ</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> แก้ไขข้อมูลสถานบริการ : Edit Hserv Epidem</div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post" id='frmEditUser'>
            <div class="row">
                <label class="col col-lg-2 control-label">คำนำหน้าหน่วยบริการ </label>
                <div class="col col-lg-3">
                    <input type="text" id="title" class="form-control" value="<?php echo @$hserv->off_name2;?>">
                    <input type="hidden" id="hospcode" class="form-control" value="<?php echo @$hserv->off_id;?>">
                </div>
                <label class="col col-lg-2 control-label"> ชื่อหน่วยบริการ </label>
                <div class="col col-lg-3">
                    <input type="text" id="name" class="form-control" value="<?php echo @$hserv->off_name;?>">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">รหัสสถานบริการตาม R506 </label>
                <div class="col col-lg-3">
                    <input type="text" id="hserv" class="form-control" value="<?php echo @$hserv->hserv;?>">
                </div>
                <label class="col col-lg-2 control-label">รหัสอำเภอ (อำเภอที่ต้องการส่งข้อมูลไป) </label>
                <div class="col col-lg-3">
                    <input type="text" id="amp_code" class="form-control" value="<?php echo @$hserv->amphur;?>">
                </div>
            </div>

    </form>
</div>
<div class="panel-footer">

    <button type="button" class="btn btn-primary" id="btn_save_edit_hserv">
        <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
    </button>
</div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/setting.js" charset="utf-8"></script>