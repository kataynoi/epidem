<ul class="breadcrumb" xmlns="http://www.w3.org/1999/html">
    <li><a href="<?php echo site_url()?>">หน้าหลัก</a> </li>
    <li class="active">รายงาน</li>
</ul>

<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 30/5/2556
 * Time: 13:53 น.
 * To change this template use File | Settings | File Templates.
 */
//cho "Main Reports ";
?>
<div class="row" id='row1'>
    <div class=" col col-lg-6">
       <div class=" panel panel-info">
           <div class="panel-heading"><span class="glyphicon glyphicon-indent-right"></span> รายงานประจำ </div>
           <div class="panel-body">
               <ul class="list-unstyled">
                   <li><a href="<?php echo site_url('/reports/e0');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/send_report.png')?>' > รายงานผู้ป่วยทั้งหมดทุกโรค E0 </a><br><br></li>
                   <li><a href="<?php echo site_url('/reports/e1');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/report.png')?>' > รายงานผู้ป่วยแยกรายโรค E1 </a><br><br></li>
                   <li><a href="<?php echo site_url('/reports/foreign');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/homeee.png')?>' > รายงานผู้ป่วยต่างชาติ </a><br><br></li>
               </ul><ul class="list-unstyled">
                   <li><a href="<?php echo site_url('/reports/e0');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/send_report.png')?>' > รายงานผู้ป่วยทั้งหมดทุกโรค E0 </a><br><br></li>
                   <li><a href="<?php echo site_url('/reports/e1');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/report.png')?>' > รายงานผู้ป่วยแยกรายโรค E1 </a><br><br></li>
                   <li><a href="<?php echo site_url('/reports/foreign');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/homeee.png')?>' > รายงานผู้ป่วยต่างชาติ </a><br><br></li>
               </ul>


           </div>
           <div class="panel-footer">

           </div>
       </div>

    </div>
    <div class=" col col-lg-6">
        <div class=" panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>  รายงานตรวจสอบขอมูล </div>
            <div class="panel-body">
                <ul class="list-unstyled">
                    <li><a href="<?php echo site_url('/reports/e0');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/send_report.png')?>' > รายงานผู้ป่วยทั้งหมดทุกโรค E0 </a><br><br></li>
                    <li><a href="<?php echo site_url('/reports/e1');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/report.png')?>' > รายงานผู้ป่วยแยกรายโรค E1 </a><br><br></li>
                    <li><a href="<?php echo site_url('/reports/foreign');?>"><img style="width: 40px;height: 40px;" src='<?php echo base_url('images/icon/homeee.png')?>' > รายงานผู้ป่วยต่างชาติ </a><br><br></li>
                </ul>

            </div>
            <div class="panel-footer">

            </div>
        </div>

    </div>
</div>


<div class="row" id='row2'>
    <div class=" col col-lg-6">
       <div class=" panel panel-info">
           <div class="panel-heading"><span class="glyphicon glyphicon-indent-right"></span> รายงานอื่นๆ </div>
           <div class="panel-body">


           </div>
           <div class="panel-footer">

           </div>
       </div>

    </div>
    <div class=" col col-lg-6">
        <div class=" panel panel-info">
            <div class="panel-heading"><span class="glyphicon glyphicon-bullhorn"></span>  สถานการณ์โรคระดับจังหวัด </div>
            <div class="panel-body">


            </div>
            <div class="panel-footer">

            </div>
        </div>

    </div>
</div>