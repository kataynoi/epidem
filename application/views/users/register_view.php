<ul class="breadcrumb">
    <li><a href="<?php echo site_url('users/login')?>">Login </a></li>
    <li class="active"> ลงทะเบียนใหม่ : Register </li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i>  ลงทะเบียนใหม่ : Register (การลงทะเบียนนี้เป็นการลงทะเบียน สมาชิก ของ User center หากท่านเป็นสมาชิกของระบบอยู่ ไม่ต้องลทะเบียนใหม่ ให้ทำการร้องขอใช้ระบบแทน)</div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post" id='frmEditUser'>
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อสกุล </label>
                <div class="col col-lg-3">
                    <input type="text" id="name" class="form-control" value="">
                    <input type="hidden" id="sys_id" class="form-control" value="<?php echo sys_id();?>">
                </div>
                <label class="col col-lg-2 control-label">เลขที่บัตรประชาชน </label>
                <div class="col col-lg-3">
                    <input type="text" id="cid" class="form-control" value="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">Email </label>
                <div class="col col-lg-3">
                    <input type="text" id="email" class="form-control" value=""><i id='check_email'></i>
                </div>
                <label class="col col-lg-2 control-label">เบอร์โทร </label>
                <div class="col col-lg-3">
                    <input type="text" id="user_mobile" class="form-control" value="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">User Name </label>
                <div class="col col-lg-3">
                    <input type="text" id="username" class="form-control" value=""><i id='check_user' class=''></i>
                </div>
                <label class="col col-lg-2 control-label">Password </label>
                <div class="col col-lg-3">
                    <input type="password" id="password" class="form-control" value="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">ชื่อเล่น </label>
                <div class="col col-lg-3">
                    <input type="text" id="nickname" class="form-control" value="">
                </div>
            </div>
            <br>
            <div class="row">
                <label class="col col-lg-2 control-label">หน่วยบริการ</label>
                <div class="col col-lg-3">
                    <select id="office" class="form-control">
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
                <label class="col col-lg-2 control-label">ตำแหน่ง </label>
                <div class="col col-lg-3">
                    <select id="position" class="form-control">
                        <option value="">-*-</option>
                        <?php foreach($position_list as $r)
                            if($user->position==$r->id){
                                echo '<option selected value="'.$r->id.'">['.$r->id.'] '.$r->name.'</option>';
                            }else{
                                echo '<option value="'.$r->id.'">['.$r->id.'] '.$r->name.'</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
    </div>
    </form>
</div>
<div class="panel-footer">

    <button type="button" class="btn btn-primary" id="btn_save_register">
        <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
    </button>
</div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/users.js" charset="utf-8"></script>