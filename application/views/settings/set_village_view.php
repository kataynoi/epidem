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
    <li class="active"> ตั้งค่าหมู่บ้านรับผิดชอบ</li>
</ul>
<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
         <input type="hidden" id="hospcode" value="<?php echo $this->session->userdata('hospcode')?>">
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
        <select id="sl_village" style="width: 180px;" class="form-control">
            <option value=""> เลือกหมู่บ้าน </option>

        </select>

        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btn_set_village_base">
                <i class="glyphicon glyphicon-save"></i> เพิ่มเข้าเป็นบ้านรับผิดชอบ
            </button>
        </div>
    </form>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> หมู่บ้านรับผิดชอบ </div>
    <div class="panel-body">
        <table class="table table-responsive" id="tbl_village_base">
            <thead>
                <th>ลำดับที่</th>
            <th>รหัสหมู่บ้าน</th>
            <th>ชื่อหมู่บ้าน</th>
            <th>หมู่ที่</th>
            <th>ตำบล</th>
            <th>อำเภอ</th>
            </thead>
            <tbody>
            <tr>
                <td colspan="6"> .... </td>
            </tr>
            </tbody>
        </table>
    </div>

</div>
<script src="<?php echo base_url()?>assets/apps/js/setting.js" charset="utf-8"></script>