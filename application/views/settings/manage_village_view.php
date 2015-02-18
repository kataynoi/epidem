<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 16/11/2556
 * Time: 17:25 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url('settings')?>"> ตั้งค่าระบบ </a></li>
    <li class="active"> จัดการหมู่บ้านรับผิดชอบ</li>
</ul>
<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
        <select id="sl_amp" style="width: 180px;" class="form-control">
            <option value=""> เลือกอำเภอ </option>
            <?php
            foreach($amp as $r) {
                echo '<option value="' . $r->distid . '">['.$r->distid. '] ' . $r->distname .'</option>';
            } ?>
        </select>
        <select id="sl_tambon" style="width: 180px;" class="form-control">
            <option value=""> เลือกตำบล </option>
        </select>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btn_search_village">
                <i class="glyphicon glyphicon-search"></i> ค้นหา
            </button>


        </div>
        <button type="button" class="btn btn-primary pull-right" id="btn_add_village">
            <i class="glyphicon glyphicon-floppy-saved"></i> เพิ่มหมู่บ้านรับผิดชอบ
        </button>
    </form>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> หมู่บ้านรับผิดชอบ </div>
    <div class="panel-body">
        <table class="table table-responsive" id="tbl_village_base">
            <thead>
            <th>ลำดับที่</th>
            <th>หมู่ที่</th>
            <th>รหัสหมู่บ้าน</th>
            <th>ชื่อหมู่บ้าน</th>
            <th>รหัสตำบล</th>
            <th>รหัสอำเภอ</th>
            <th>รหัสจังหวัด</th>
            <th>ที่ตังหมู่บ้าน</th>
            <th>สถานบริการ</th>
            </thead>
            <tbody>
            <tr>
                <td colspan="6"> .... </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="panel-footer">
    </div>
</div>

<div class="modal fade" id="mdl_village">
    <div class="modal-dialog" style="width: 600px;">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='msg_title'><i class="glyphicon glyphicon-saved"></i> เพิ่มข้อมูลหมู่บ้าน</h4>
            </div>
            <div class="modal-body" id='body_user'>
                <dl class="dl-horizontal">
                    <dt>ระบบ : System</dt>
                        <dd><?php echo $this->session->userdata('sys_name');?></dd><br>
                    <dt>ชื่อหมู่บ้าน</dt>
                        <dd><input class="form-control" style="width: 300px" type='text' id="s_villname" value=""></dd><br>
                    <dt>หมู่ที่</dt>
                        <dd ><input class="form-control" style="width: 300px" type='text' id="s_villno" value=""></dd><br>
                    <dt>เขตที่ตั้งหมู่บ้าน</dt>
                        <dd><select  style="width: 300px" class="form-control" id="s_locatype">
                            <option value="">เลือกเขตที่ตั้งหมู่บ้าน</option>
                            <option value="1">เขต อบต.</option>
                            <option value="2">เขต เทศบาล.</option>
                        </select></dd><br>
                    <dt> รหัสหมู่บ้าน </dt>
                        <dd><input class="form-control " disabled="disabled" style="width: 300px" type='text' id="s_villid" value=""></dd><br>
                    <dt> รหัสตำบล </dt>
                        <dd><input class="form-control " disabled="disabled" style="width: 300px" type='text' id="s_subdistid" value=""></dd><br>
                    <dt> รหัสอำเภอ </dt>
                        <dd><input class="form-control " disabled="disabled" style="width: 300px" type='text' id="s_distid" value=""></dd><br>
                    <dt> รหัสจังหวัด </dt>
                        <dd><input class="form-control " disabled="disabled" style="width: 300px" type='text' id="s_provid" value=""></dd><br>

                </dl>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-info text-center" id="btn_save_village"><i class="glyphicon glyphicon-saved"></i> บันทึก</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/apps/js/setting.manage_village.js" charset="utf-8"></script>