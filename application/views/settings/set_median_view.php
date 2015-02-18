<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 16/11/2556
 * Time: 17:25 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url('settings')?>"> ตั้งค่าระบบ </a></li>
    <li class="active"> ตั้งค่า Median <label for="">สถานบริการ </label>
        <label for=""><?php echo $this->session->userdata('hospcode')." : ".$this->session->userdata('hospname')?></label>
    </li>
</ul>
<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
         <input type="hidden" id="hospcode" value="<?php echo $this->session->userdata('hospcode')?>">
        <label for="" value="<?php echo $this->session->userdata('hospcode')?>"</label>
        <label for="">กลุ่มโรค 506</label>
        <select id="sl_year" style="width: 180px;" class="form-control">
            <option value=""> เลือกปี </option>
           <?php
            $year2=$year-5;
            for($i=$year;$i>$year2;$i--){
                if($i==$year){
                    echo "<option value=".$i." selected=selected> ".($i+543)." </option>";
                }else{
                    echo "<option value=".$i."> ".($i+543)." </option>";
                }
            }
            ?>


        </select>
        <label for="">กลุ่มโรค 506</label>
        <select id="sl_code506" class="form-control" style="width: 180px;">
            <option value="">-*-</option>
            <?php
            foreach($code506 as $r)
            {
                echo '<option value="'.$r->code.'">['. $r->code .'] '. $r->name . '</option>';
            }
            ?>
        </select>
        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btn_show">
                <i class="glyphicon glyphicon-save"></i> ดูข้อมูล
        </div>
    </form>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><i class="glyphicon glyphicon-refresh"></i> ค่า Median </div>
    <div class="panel-body">
        <table class="table table-responsive" id="tbl_median">
            <thead>
            <TR>
                <th rowspan="2" >หน่วยบริการ</th>
                <th rowspan="2" >ปี</th>
                <th rowspan="2" >โรค 506</th>
                <th colspan="12" >เดือน</th>
            </TR>
            <TR>
                <th>ม.ค.</th>
                <th>ก.พ.</th>
                <th>มี.ค.</th>
                <th>เม.ย.</th>
                <th>พ.ค.</th>
                <th>มิ.ย.</th>
                <th>ก.ค.</th>
                <th>ส.ค.</th>
                <th>ก.ย.</th>
                <th>ต.ค.</th>
                <th>พ.ย.</th>
                <th>ธ.ค.</th>

            </TR>

            </thead>
            <tbody>
            <tr>
                <td colspan="6"> .... </td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="panel-footer text-center">

        <button type="button" class="btn btn-primary" id="btn_save">
            <i class="glyphicon glyphicon-floppy-saved"></i> บันทึก
        </button>
    </div>
</div>
<script src="<?php echo base_url()?>assets/apps/js/setting.median.js" charset="utf-8"></script>