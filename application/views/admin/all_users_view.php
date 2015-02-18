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
<ul class="nav nav-tabs">
    <li class="active"><a href="#tab_users" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> สมาชิกทั้งหมด <span class="badge" id="spn_total">0</span></a></li>
    <li><a href="#tab_wait" data-toggle="tab"><i class="glyphicon glyphicon-time"></i> รออนุมัติ <span class="badge" id="spn_wait">0</span></a></li>

</ul>
<div class="tab-content">
    <div class="tab-pane active" id="tab_users">
<table class="table " id='tbl_users_list'>
    <thead>
    <th>#</th>
    <th>ชื่อผู้ใช้ </th>
    <th>หน่วยบริการ </th>
    <th>ระดับผู้ใช้งาน </th>

    <th>ส่งข้อความ</th>
    </thead>
    <tbody>
    <tr>
        <td colspan="4">....</td>
    </tr>
    </tbody>
</table>
<ul class="pagination" id="main_paging"></ul>
 </div>
    <div class="tab-pane" id="tab_wait">
        <table class="table " id='tbl_waiting_list'>
            <thead>
            <th>#</th>
            <th>ชื่อผู้ใช้ </th>
            <th>หน่วยบริการ </th>
            <th>ส่งข้อความ</th>
            </thead>
            <tbody>
            <tr>
                <td colspan="4">....</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
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

<div class="modal fade" id="mdl_edit_user">
    <div class="modal-dialog" style="width: 960px;">
        <div class="modal-content">
            <div class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id='msg_title'><i class="glyphicon glyphicon-user"></i>ข้อมูลผู้ใช้ .</h4>
            </div>
            <div class="modal-body" id='body_user'>
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
                    <li class="active"> แก้ไขข้อมูลผู้ใช้ </li>
                </ul>

                <div class="panel panel-default">
                    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> เปลี่ยนข้อมูลส่วนตัว : Edit User Profile (การแก้ไขข้อมูลส่วนตัว จะมีผลกับระบบอื่นๆที่ท่านเป็น สมาชิก ของ User center ด้วย)</div>
                    <br>
                        <form  class="form-horizontal"  method="post" id='frmEditUser'>
                            <input type="hidden" id='edit_sys_id' value=<?php echo sys_id();?>>
                            <input type="hidden" id='edit_user_id' value="">

                            <div class="row">
                                <label class="col col-lg-2 control-label">ชื่อผู้ใช้ </label>
                                <div class="col col-lg-3" id="edit_name"></div>
                                <label class="col col-lg-2 control-label">Email </label>
                                <div class="col col-lg-3" id="edit_email"></div>
                            </div>
                            <br>
                            <div class="row">
                            <label class="col col-lg-2 control-label">หน่วยบริการ</label>
                                    <div class="col col-lg-3">
                                        <select id="edit_office" class="form-control" >
                                            <option value="">-*-</option>
                                            <?php foreach($office_list as $r)
                                                if($user->office==$r->off_id){
                                                    echo '<option selected value="'.$r->off_id.'">['.$r->off_id.'] '.$r->off_name.'</option>';
                                                }else{
                                                    echo '<option value="'.$r->off_id.'">['.$r->off_id.'] '.$r->off_name.'</option>';
                                                }
                                            ?>
                                        </select>
                                </div>
                                <label class="col col-lg-2 control-label">ระดับผู้ใช้งาน</label>
                                <div class="col col-lg-3">
                                    <select id="edit_user_level" class="form-control">
                                        <option value="">-*-</option>
                                        <option value="0">Administrator</option>
                                        <option value="1">สสจ.</option>
                                        <option value="2">สสอ.</option>
                                        <option value="3">รพ.สต.</option>

                                    </select>
                                </div>

                    </div>
                    </form>
                    <br>
                <div class="panel-footer text-center">

                    <button type="button" class="btn btn-primary" id="btn_save_edit_user">
                        <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
                    </button>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i> ปิดหน้าต่าง</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url()?>assets/apps/js/admin.users.js" charset="utf-8"></script>
<script src="<?php echo base_url()?>assets/apps/js/basic.js" charset="utf-8"></script>