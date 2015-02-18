<div class='container'>
    <div class="row">
        <div class="col col-lg-4" id="left">

        </div>
        <div class="col col-lg-4" id="center">
            <form id="frm_login" class="form-signin" action="<?php echo site_url('users/do_login') ?>" method="post">

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>

                        <p>ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง</p>
                    </div>
                <?php } ?>

                <input type="text" name="username" id="txt_password" class="form-control" placeholder="ชื่อผู้ใช้งาน"
                       autofocus>
                <input type="password" name="password" id="txt_username" class="form-control" placeholder="รหัสผ่าน">
                <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
                <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn_login"><i
                        class='glyphicon glyphicon-share'></i> Sign in
                </button>
                <div class=' btn-block text-center'>
                    <a href="<?php echo site_url('users/register') ?>" class="btn btn-success pull-left"
                       id="btn_register"><i class='glyphicon glyphicon-record'> </i> ลงทะเบียนใหม่ </a>
                    <a href="#" class="btn btn-success pull-right" id="btn_request"><i
                            class='glyphicon glyphicon-th-list'> </i> ขอเข้าใช้ระบบ </a>
                </div>
                <br><br>
                <a href='#' class="btn btn-warning btn-block " id="btn_forget_pass"><i
                        class='glyphicon glyphicon-repeat'> </i> ลืมรหัสผ่าน </a>
            </form>

            <form id="frm_forgot_pass" class="form-signin" action="" method="post">

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger">
                        <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>

                        <p> ชื่อผู้ใช้งาน หรือ รหัสผ่าน ไม่ถูกต้อง </p>
                    </div>
                <?php } ?>

                <!-- <input type="text" name="repass_username" id="txt_repass_username" class="form-control" placeholder="ชื่อผู้ใช้งาน" autofocus>-->
                <input type="text" name="repass_email" id="txt_repass_email" class="form-control" placeholder="email">
                <input type="hidden" name="csrf_token" value="<?php echo $this->security->get_csrf_hash() ?>">
                <button class="btn btn-lg btn-primary btn-block" id="send_mail_forget_pass"><i
                        class='glyphicon glyphicon-send'></i> ส่งรหัสผ่านไปที่ Email
                </button>
                <a href='#' class="btn btn-warning btn-block" id="btn_back"><i class='glyphicon glyphicon-repeat'> </i>
                    กลับ</a>

            </form>
        </div>

        <div class="col col-lg-4" id="right">

        </div>
    </div>
<!--    <div class="row ">
        <div class="col col-md-1"></div>
        <div class="col col-md-10 alert alert-success">
            <ul>
                <li> sdfsdfsdffdsfs</li>
            </ul>
        </div>
    </div>-->
</div>


<script type="text/javascript">
    $('#frm_forgot_pass').hide();
</script>
<script src="<?php echo base_url() ?>assets/apps/js/users.js" charset="utf-8"></script>
