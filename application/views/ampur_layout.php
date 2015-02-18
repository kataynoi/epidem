<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <?php header('Content-Type: text/html; charset=utf-8');?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo version(); ?></title>
    
    <script type="text/javascript" charset="utf-8">
    var site_url = '<?php echo site_url()?>';
    var base_url = '<?php echo base_url()?>';

    var csrf_token = '<?php echo $this->security->get_csrf_hash(); ?>';
    </script>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/flags.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/css/freeow/freeow.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/apps/css/app.css" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="<?php echo base_url()?>assets/js/html5shiv.js"></script>
    <script src="<?php echo base_url()?>assets/js/respond.min.js"></script>
    <![endif]-->

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url()?>assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url()?>assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url()?>assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url()?>assets/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" href="<?php echo base_url()?>assets/ico/favicon.png">

    <script src="<?php echo base_url()?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/heighcharts/js/highcharts.js"></script>
    <!-- load library -->
    <script src="<?php echo base_url()?>assets/js/underscore.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.cookie.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.freeow.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.numeric.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.paging.min.js"></script>
    <script src="<?php echo base_url()?>assets/js/numeral.min.js"></script>

    <!-- load application -->
    <script src="<?php echo base_url()?>assets/apps/js/apps.js"></script>
</head>
<body>

<style>
    body { padding-top: 60px; }
</style>

<div id="freeow" class="freeow freeow-bottom-right"></div>
<!-- Fixed navbar -->
<nav role="navigation" class="navbar navbar-default navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">EPIDEM <?php echo $this->session->userdata('year');?></a>
    </div>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav">
            <li><a href="<?php echo site_url()?>"><i class="glyphicon glyphicon-home"></i> หน้าหลัก</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-list"></i> บริการหลัก <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li role="presentation" class="dropdown-header">MAIN SERVICES</li>
                    <?php if($this->session->userdata('user_level') == '1'){ ?>
                        <li><a href="<?php echo site_url('changwat')?>"><i class="glyphicon glyphicon-th-list"></i> ทะเบียนผู้ป่วย</a></li>
                    <?php } else if($this->session->userdata('user_level') == '2') {?>
                        <li><a href="<?php echo site_url('ampur')?>"><i class="glyphicon glyphicon-th-list"></i> ทะเบียนผู้ป่วย</a></li>
                    <?php } else { ?>
                        <li><a href="<?php echo site_url('patients')?>"><i class="glyphicon glyphicon-th-list"></i> ทะเบียนผู้ป่วย</a></li>
                    <?php } ?>

                </ul>
            </li>
            <li class="">
                <a href="<?php echo site_url('/reports')?>" class=""><i class="glyphicon glyphicon-print"></i> รายงาน </a>
            </li>
            <li class="">
                <a href="<?php echo base_url('assets/manual.pdf')?>" target="_blank" class=""><i class="glyphicon glyphicon-book"></i> คู่มือ </a>

            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-cog"></i> เครื่องมือ <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">TOOLS</li>
                    <li><a href="<?php echo site_url('exports')?>"><i class="glyphicon glyphicon-cloud-download"></i> ส่งออกข้อมูล (R506)</a></li>
                    <li><a href="<?php echo site_url('maps')?>"><i class="glyphicon glyphicon-globe"></i> ระบบ GIS งานระบาดวิทยา</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-cog"></i> <b class="caret"></b></a>
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
        <p class="navbar-text pull-right"> สวัสดี, <i><?php echo $this->session->userdata('fullname')."</i><a href='".site_url('/users/message')."'>  [ <span id='new_msg'>  ".$this->session->userdata('new_msg');?></a></span> ]</p>
    </div>
</nav>

<div class="container">
    <?php echo $content_for_layout?>
</div>
<nav role="navigation" class="navbar-default navbar-fixed-bottom" >
    <div class="text-right"><a href="<?php echo site_url('/admin')?>" class="link">Administrator </a>  : Phanpichit Keawmong &copy; thait-rex@hotmail.com</div>
</nav>
</body>
</html>
