<ul class="breadcrumb" xmlns="http://www.w3.org/1999/html">
    <li><a href="<?php echo site_url()?>">หน้าหลัก</a></li>
    <li><a href="<?php echo site_url('imports')?>">นำเข้าข้อมูล</a></li>
    <li class="active">อัปโหลดไฟล์</li>
</ul>

<div class="container">
    <h4>Upload R506 แฟ้มเพื่อนำเข้าข้อมูลทางระบาดวิทยา </h4>
    <form action="<?php echo site_url();?>/upload/do_upload_r506" method="POST" enctype="multipart/form-data">
    <div class="fileinput fileinput-new" data-provides="fileinput">
        <div class="input-group">
            <div class="form-control uneditable-input" data-trigger="fileinput">
                <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
            </div>
            <div class="input-group-btn">
                <div class="btn btn-default btn-file">
                    <span class="fileinput-new" >Select</span>
                    <span class="fileinput-exists">Change</span>
                    <input id='userfile' type="file" name="userfile" />
                </div>
                <button type="button" class="btn btn-default fileinput-exists" data-dismiss="fileinput" title="remove">
                    Remove
                </button>
                <button type="submit" datA-NAME='btn_upload' class="btn btn-info fileinput-exists"  title="Upload">
                    Upload
                </button>
            </div>
        </div>
    </div>
        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
</form>
<!--    <script src="<?php /*echo base_url()*/?>assets/apps/js/upload.r506.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php /*echo base_url()*/?>assets/js/ajaxfileupload.js"></script>-->
</div>