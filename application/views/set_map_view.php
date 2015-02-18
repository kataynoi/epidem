<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url()?>">EPIDEM </a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <form action="#" class="navbar-form navbar-left">
            <input type="hidden" id="txt_id" value="<?php echo $id?>" />
            <label for="">CID</label>
            <input type="text" class="form-control" style="width: 160px;" value="<?php echo $cid?>"
                   id="txt_cid" disabled />
            <label for="">ชื่อ - สกุล</label>
            <input type="text" class="form-control" style="width: 200px;" value="<?php echo $fullname?>"
                   id="txt_fullname" disabled />
            <label for="">Lat</label>
            <input type="text" class="form-control" style="width: 200px;"
                   id="txt_lat" value="<?php echo $lat?>"  />
            <label for="">Lng</label>
            <input type="text" class="form-control" style="width: 200px;"
                   id="txt_lng" value="<?php echo $lng?>"  />
            <button type="button" class="btn btn-primary" id="btn_save">
                <i class="glyphicon glyphicon-floppy-disk"></i>
            </button>
        </form>
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-th"></i> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">
                        <?php echo $this->session->userdata('hospcode')?> :
                        <?php echo $this->session->userdata('hospname')?>
                    </li>
                    <li><a href="<?php echo site_url('/users/user_profile')?>"><i class="glyphicon glyphicon-user"></i> ข้อมูลส่วนตัว</a></li>
                    <li><a href="<?php echo site_url('/users/message')?>"><i class="glyphicon glyphicon-comment"></i> กล่องข้อความ</a></li>
                    <li><a href="<?php echo site_url('/users/change_pass')?>"><i class="glyphicon glyphicon-lock"></i> เปลี่ยนรหัสผ่าน</a></li>
                    <li><a href="<?php echo site_url('/users/all_users')?>"><i class="glyphicon glyphicon-list-alt"></i> ผู้ใช้ทั้งหมด</a></li>
                    <li class="divider"></li>
                    <li><a href="<?php echo site_url('users/logout')?>"><i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div id="map"></div>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&language=th"></script>
<script>
    var lat_office=<?php echo $office_lat;?>;
    var lng_office=<?php echo $office_lng;?>;
    //alert(lat_office+' '+lng_office);
</script>
<script src="<?php echo base_url()?>assets/apps/js/set_map.js" charset="utf-8"></script>

