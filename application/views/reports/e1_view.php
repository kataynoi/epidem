<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url()."/reports/"?>">รายงาน </a></li>
    <li class="active"> รายงาน E1</li>
</ul>
<div class="navbar navbar-default">
    <form action="#" class="navbar-form">
        <label>ตั้งแต่วันที่</label>
        <input type="text" id="txt_query_start_date" data-type="date" class="form-control"
               placeholder="วว/ดด/ปปปป" title="เช่น 01/01/2556" data-rel="tooltip" style="width: 110px;">

        <label>ถึงวันที่</label>
        <input type="text" id="txt_query_end_date" data-type="date" class="form-control"
               placeholder="วว/ดด/ปปปป" style="width: 110px;" title="เช่น 31/01/2556" data-rel="tooltip">

        <select id="sl_query_code506" style="width: 180px;" class="form-control">
            <option value="">ทั้งหมด</option>
            <?php
            foreach($code506 as $r) {
                echo '<option value="' . $r->code . '">' . $r->name .'['.$r->code. ']</option>';
            } ?>
        </select>
    <select id="sl_query_nation" style="width: 180px;" class="form-control">
            <option value="">ทั้งหมด</option>
            <?php
            foreach($nation as $r) {
                echo '<option value="' . $r->code . '">[' .$r->code.'] '. $r->name . '</option>';
            } ?>
        </select>

        <div class="btn-group">
            <button type="button" class="btn btn-primary" id="btn_get_e1_list">
                <i class="glyphicon glyphicon-search"></i> แสดง
            </button>
        </div>
        <!--
        <label>ค้นหา</label>
        <input type="text" id="txt_query" class="form-control"
               placeholder="ระบุสิ่งที่ต้องการค้นหา" title="หมายเลขบัตรประชาชน, ชื่อ, HN"
               data-rel="tooltip" style="width: 210px;">

        -->
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default" id="btn_search">
                <i class="glyphicon glyphicon-search"></i> ค้นหา
            </button>

            <button type="button" class="btn btn-success" id="btn_refresh">
                <i class="glyphicon glyphicon-refresh"></i> รีเฟรช
            </button>
        </div>
    </form>
</div>
<table class="table table-striped" id='tbl_e1_list'>
    <thead>
    <th>#</th>
    <th>E0</th>
    <th>E1</th>
    <th>ชื่อโรค506</th>
    <th>ชื่อสกุล</th>
    <th>ที่อยู่</th>
    <th>สถานะการรักษา</th>
    <th>ICD10</th>
    <th>วันพบผู้ป่วย</th>
    <th>วันที่รับรักษา</th>
    <th>...</th>
    </thead>
    <tbody>
    <tr>
        <td colspan="11">...</td>
    </tr>
    </tbody>
</table>
<ul class="pagination" id="main_paging"></ul>
<script src="<?php echo base_url()?>assets/apps/js/report.e1.js" charset="utf-8"></script>