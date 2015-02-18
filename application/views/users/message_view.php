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
    <li class="active"> กล่องข้อความ</li>
</ul>
<div class="container">
    <div class="panel panel-default col col-lg-2 equal-height" id='menu_box'>
        <ul class="nav nav-list">

            <li class="nav-header glyphicon glyphicon-th-list"><b> กล่องข้อความ</b></li>
            <li class=""><a href="#" data-name="new_message"><i class="glyphicon glyphicon-pencil"></i> เขียนข้อความใหม่</a></li>
            <li class="active" ><a href="#" data-name="in_box"><i class="glyphicon glyphicon-comment"></i> กล่องข้อความเข้า</a></li>
            <li><a href="#" data-name="out_box"><i class="glyphicon glyphicon-share"></i> กล่องข้อความออก</a></li>
            <li><a href="#"><i class="glyphicon glyphicon-trash"></i> ถังขยะ</a></li>
        </ul>
    </div>
    <div class="col "></div>
    <div class=" tab-content panel panel-default col col-lg-10 equal-height" id='body_box' >
        <table class="table " id='tbl_message_list'>
            <thead>
            <th>#</th>
            <th>วันที่ เวลา</th>
            <th>ข้อความ</th>
            <th>ผู้ส่ง</th>
            <th>ผู้รับ</th>
            </thead>
            <tbody>
            <tr>
                <td colspan="4">....</td>
            </tr>
            </tbody>
        </table>
        <div id='frm_send_message' class='hide'>
            <form class="form-horizontal">
                <div class="row">
                    <div class='panel-heading'> <i class='glyphicon glyphicon-phone'></i> ส่งข้อความหาผู้ใช้ </div>
                    <input type="hidden" id='txt_sender' value="<?php echo $this->session->userdata('user_id');?>">
                    <label for="txt_reciver" class="col col-lg-2 control-label">ผู้รับ</label>
                    <div class="col col-lg-10">
                       <select id='reciver' class="form-control" style="width:100;">
                           <option>--*--</option>
                           <?php
                           foreach($users as $r) {
                               echo '<option value="' . $r->id . '">' . $r->name . '</option>';
                           } ?>
                       </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="txt_title" class="col col-lg-2 control-label">หัวข้อ</label>
                    <div class="col col-lg-10">
                        <input type="text" id="txt_title" placeholder="Title" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <label for="" class="col col-lg-2 control-label"></label>
                    <div class="col col-lg-10">
                        <textarea id="txt_message" placeholder="Message" class="form-control" row="10"></textarea>
                    </div>

                </div>
                <br>
                <div onclick="row">
                    <div class="col col-lg-10 col-offset-2  text-center">
                        <button type="submit" class="btn btn-info" id='btn_send_message'><i class="glyphicon glyphicon-saved"></i> บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
        <br>
        <ul class="pagination" id="main_paging"></ul>
        <div class="modal fade" id="mdl_message">
            <div class="modal-dialog" style="width: 960px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id='msg_title'> Title</h4>
                    </div>
                    <div class="modal-body" id='msg_message'>
                        test Message...................
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="icon-remove"></i> ปิดหน้าต่าง</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
</div>
<script src="<?php echo base_url()?>assets/apps/js/users.message.js" charset="utf-8"></script>