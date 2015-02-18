<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก </a></li>
    <li><a href="<?php echo site_url()."/reports/"?>">รายงาน </a></li>
    <li class="active"> รายงานผู้ป่วยต่างชาติ</li>
</ul>

<table class="table table-striped" id='tbl_e1_list'>
    <thead>
    <th>#</th>
    <th>รหัสประเทศ</th>
    <th>ชื่อประเทศ</th>
    <th>จำนวนผู้ป่วย</th>
    </thead>
    <tbody>
    <?php
    $n=1;
    foreach($foreign as $r)

    echo "<tr><td>".$n."</td><td>".$r->nation."</td><td>".$r->nation_name."</td><td>".$r->total."</td>";
    echo "</tr>";
    $n++;
    ?>
    </tbody>
</table>
<ul class="pagination" id="main_paging"></ul>
<script src="<?php echo base_url()?>assets/apps/js/report.e1.js" charset="utf-8"></script>