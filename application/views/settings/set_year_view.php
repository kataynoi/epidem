<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 12/11/2556
 * Time: 0:28 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url('settings')?>"> ตั้งค่าระบบ </a></li>
    <li class="active"> ตั้งค่าหน่วยบริการ</li>
</ul>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> แก้ไขข้อมูล ปี พ.ศ.เริ่มต้น (ค่าเริ่มต้นคือปี พ.ศ.ปัจจุบัน ใช้กรณีต้องการดูข้อมูลย้านหลังปีที่ผ่านมา)</div>
    <div class="panel-body text-center">
        <form  class="form-horizontal"  method="post" id='frmEditUser'>
            <div class="row">
                <label class="col col-lg-2 control-label">ปี พ.ศ.</label>
                <div class="col col-lg-3">
                    <select name='year' id='year' class='form-control' style="width:100">
                        <?php
                        for($i=(date('Y')-5);$i<=date('Y');$i++){
                            if($i==$this->session->userdata('year')){
                                echo "<option  value=".$i." selected = 'selected' >".($i+543)."</option>";
                            }else{
                                echo "<option value=".$i.">".($i+543)."</option>";
                            }

                        }
                        ?>
                    </select>

                </div>
            </div>

        </form>
    </div>
    <div class="panel-footer">

        <button type="button" class="btn btn-primary" id="btn_save_year">
            <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
        </button>
    </div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/setting.js" charset="utf-8"></script>