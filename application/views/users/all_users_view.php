<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 16/9/2556
 * Time: 14:51 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li class="active"> ผู้ใช้ทั้งหมด</li>
</ul>
<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
        <select id="distid" style="width: 180px;" class="form-control">
            <option value="">อำเภอ [ทั้งหมด] </option>
            <?php
            foreach($amp as $r) {
                echo '<option value="' . $r->distid . '">'.''.$r->distid. ' : '. $r->distname .'</option>';
            } ?>
        </select>
        <select id="sl_office" style="width: 180px;" class="form-control">
            <option value=""> หน่วยบริการ </option>

        </select>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btn_show">
                <i class="glyphicon glyphicon-search"></i> แสดง
            </button>
        </div>
    </form>
</div>
<table class="table " id='tbl_message_list'>
    <thead>
    <th>#</th>
    <th>ชื่อผู้ใช้ </th>
    <th>หน่วยบริการ </th>
    <th>จำนวนครั้งที่เข้าระบบ</th>
    <th>รวมเวลาที่อยู่ในระบบ</th>
    <th>ส่งข้อความ</th>

    </thead>
    <tbody>
    <tr>
        <td colspan="4">....</td>
    </tr>
    </tbody>
</table>
<ul class="pagination" id="main_paging"></ul>
<div class="modal fade" id="mdl_user">
    <div class="modal-dialog" style="width: 960px;">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='msg_title'><i class="glyphicon glyphicon-user"></i>ข้อมูลผู้ใช้ .</h4>
            </div>
            <div class="modal-body" id='body_user'>
                <dl class="dl-horizontal">
                    <dt>ระบบ : System</dt>
                    <dd><?php echo $this->session->userdata('sys_name');?></dd>
                    <dt>ชื่อ สกุล</dt>
                    <dd id='name'></dd>
                    <dt>Username :</dt>
                    <dd id='username'></dd>
                    <dt>หน่วยบริการ </dt>
                    <dd id='office'></dd>
                    <dt>ประเภทหน่วยบริการ </dt>
                    <dd></dd>
                    <dt>E-mail </dt>
                    <dd id='email'></dd>
                    <dt>เบอร์โทร </dt>
                    <dd><?php echo $this->session->userdata('amp_code');?></dd>
                </dl>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/apps/js/users.all_users.js" charset="utf-8"></script>
<script src="<?php echo base_url()?>assets/apps/js/basic.js" charset="utf-8"></script>