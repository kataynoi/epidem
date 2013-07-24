<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title> EPIDEM Online </title>
    
    <script type="text/javascript" charset="utf-8">
    var site_url = '<?=site_url()?>';
    </script>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url()?>assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/font-awesome-ie7.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?=base_url()?>assets/js/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Favicons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?=base_url()?>assets/ico/favicon.png">

    <script src="<?=base_url()?>assets/js/jquery.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <!-- load library -->
    <script src="<?=base_url()?>assets/js/underscore.min.js"></script>
    <script src="<?=base_url()?>assets/js/highcharts.js"></script>
    <script src="<?=base_url()?>assets/js/highcharts-more.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.blockUI.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.cookie.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.freeow.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.numeric.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.paging.min.js"></script>
    <script src="<?=base_url()?>assets/js/numeral.min.js"></script>
    <script src="<?=base_url()?>assets/js/taffy.js"></script>
    <script src="<?=base_url()?>assets/js/typeahead.js"></script>
    
    <!-- load application -->
    <script src="<?=base_url()?>assets/apps/js/apps.js"></script>
    <script src="<?=base_url()?>assets/apps/js/apps.users.js"></script>

</head>
<body>

<style>

    body {
        padding-top: 60px;
    }

    .jumbotron {
        margin-top: 20px;
    }

</style>

<div id="freeow" class="freeow freeow-bottom-right"></div>
<!-- Fixed navbar -->
<div class="navbar navbar-fixed-top">
    <div class="container">
        <a class="navbar-toggle" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <a class="navbar-brand" href="#">EPIDEM</a>
        <div class="nav-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?=site_url()?>"><i class="icon-home"></i> หน้าหลัก</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print"></i> บริการหลัก <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">MAIN SERVICES</li>
                        <li><a href="<?=site_url('patients')?>"><i class="icon-th-list"></i> ทะเบียนผู้ป่วย</a></li>
                        <li><a href="<?=site_url('patients/register');?>"><i class="icon-plus-sign-alt"></i> ลงทะเบียนรายใหม่</a></li>
                        <li><a href="<?=site_url('imports/upload')?>"><i class="icon-upload-alt"></i> อัปโหลดไฟล์</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i> เครื่องมือ <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">TOOLS</li>
                        <li><a href="<?=site_url('patients/imports')?>"><i class="icon-refresh"></i> นำเข้าผู้ป่วยจาก 43 แฟ้ม</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-print"></i> รายงาน <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">Nav header</li>
                        <li><a href="<?=site_url('/reports/e0')?>"><i class="icon-th-list"></i> E0</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>

            <ul class="nav navbar-nav pull-right">
               <?php if($this->session->userdata('status')!='online'){?>
                <li>
                <form class="form-inline">
                    <input type="text" id="txtUsername" placeholder="Username" class="col-lg-3">
                    <input type="password" id="txtPassword" placeholder="Password" class="col-lg-3" >
                    <button type="button" id="btnDoLogin" class="btn btn-default link">Sign in</button>
                </form>
<?php }else{?>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs"></i> เมนูส่วนตัว <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li class="nav-header">USER PROFILE</li>
                        <li><a href="<?=site_url('/users/user_profile')?>"><i class="icon-group"></i> ข้อมูลส่วนตัว</a></li>
                        <li><a href="#"><i class="icon-key"></i> เปลี่ยนรหัสผ่าน</a></li>
                        <li class="divider"></li>
                        <li><a href="#" id='btnDoLogout'><i class="icon-signout"></i> ออกจากระบบ</a></li>
                    </ul>
                </li>
                    <?php }?>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <?=$content_for_layout?>
</div>

</body>
</html>
