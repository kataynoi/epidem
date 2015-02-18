<div class='container'>



<div class='row' >
        <div class='col col-lg-12' >
            <div class='panel panel-info' >
<div class="panel-heading"> <span class='glyphicon glyphicon-th'></span>  กราฟแสดงจำนวนผู้ป่วย รายโรค</div>
 <div class="navbar navbar-default">
     <form action="#" class="navbar-form">
         <span>ปี
                 <select id="txt_year" style="width: 180px;" class="form-control">
                     <?php
                     $year=$this->session->userdata('year');
                     for($i=$year-5;$i<=$year;$i++){
                         if($i==$year){echo "<option value=".$i." selected=selected> ".($i+543)." </option>";
                         }else{
                             echo "<option value=".$i."> ".($i+543)." </option>";
                         }
                     }
                     ?>

                 </select>
<select id="sl_code506" style="width: 180px;" class="form-control">
    <option value="" selected="selected" value='00'> กลุ่มโรคทางระบาดวิทยา [ทั้งหมด] </option>
    <?php
    foreach($code506 as $r) {
        echo '<option value="' . $r->code . '">' . $r->name .'['.$r->code. ']</option>';
    } ?>
</select>

             <button class="btn btn-info" id='btn_show_chart'><span class="glyphicon glyphicon-print"></span> แสดงกราฟ </button>
     </span>



         </form>
                </div>
                <div class='panel-body'>
                    <div id="disease_year" ></div>

                </div>
            </div>
        </div>

    </div>


        <div class='row'>
            <div class='col col-lg-6' >
                <div class='panel panel-primary'>
                <div class="panel-heading"> <span class='glyphicon glyphicon-random'></span>  ข้อมูลผู้ป่วย ต่างชาติ <?php echo " ปี ".($this->session->userdata('year')+543);?></div>
                <div class='panel-body'>
                    <table class="table table-bordered" id='tbl_e1_list'>
                        <thead>
                        <th>#</th>
                        <th>รหัสประเทศ</th>
                        <th>ชื่อประเทศ</th>
                        <th>จำนวนผู้ป่วย</th>
                        </thead>
                        <tbody>
                        <?php
                        $n=1;
                        foreach($foreign as $r){
                            echo "<tr><td>".$n."</td><td>".$r->nation."</td><td>".$r->nation_name."</td><td>".number_format($r->total)."</td>";
                        echo "</tr>";
                        $n++;}
                        ?>
                        </tbody>
                    </table>
                   </div>
            </div>
                </div>
            <div class='col col-lg-6 pull-right' >
                <div class=' panel panel-primary' >
                    <div class="panel-heading"> <span class='glyphicon glyphicon-record'></span>  ข้อมูลจำนวนข้อมูล Epidem online <?php echo " ปี ".($this->session->userdata('year')+543);?></div>
                    <div class='panel-body'>
                        <table class="table">
                            <thead>
                            <th></th> <th></th> <th></th>
                            </thead>
                            <tbody>
                            <tr>
                                <td>จำนวนผู้ป่วยในแฟ้ม  Surveillance</td>
                                <td><?php echo number_format($surveillance);?></td>
                            </tr>
                            <tr>
                                <td>จำนวนผู้ป่วยในแฟ้ม  Epe0 ทั้งหมด </td>
                                <td><?php echo number_format($epe0);?></td>
                            </tr>
                            <tr>
                                <td>จำนวนผู้ป่วยในแฟ้ม  Epe0 ระดับอำเภอ </td>
                                <td><?php echo number_format($epe0_sso);?></td>
                            </tr>
                            <tr>
                                <td>จำนวนผู้ป่วยในแฟ้ม  Epe0 ระดับจังหวัด </td>
                                <td><?php echo number_format($epe0_ssj);?></td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    <div class='row'>
            <div class='col col-lg-6' >
                <div class='panel panel-info'>
                <div class="panel-heading"> <span class='glyphicon glyphicon-th'></span>  จำนวนโรคที่ป่วย 10 อันดับแรก <?php echo " ปี ".($this->session->userdata('year')+543);?></div>
                <div class='panel-body'>
                    <div id='top10'></div>
                    <!--<table class="table table-bordered" id='tbl_e1_list'>
                        <thead>
                        <th>#</th>
                        <th>รหัสโรค506</th>
                        <th>ชื่อโรค</th>
                        <th>จำนวนผู้ป่วย</th>
                        </thead>
                        <tbody>
                        <?php
/*                        $n=1;
                        foreach($top10_506 as $r){


                            echo "<tr><td>".$n."</td><td>".$r->disease."</td><td>".$r->name."</td><td>".number_format($r->total)."</td>";
                        echo "</tr>";
                        $n++;   }
                        */?>
                        </tbody>
                    </table>--></div>
            </div>
                </div>
            <div class='col col-lg-6 pull-right' >
                <div class=' panel panel-success' >
                    <div class="panel-heading"> <span class='glyphicon glyphicon-record'></span>  จำนวนผู้ป่วยแยกรายอำเภอ</div>
                    <div class='panel-body'>
                        <table class="table table-bordered" id='tbl_e1_list'>
                            <thead>
                            <th>#</th>
                            <th>รหัสอำเภอ</th>
                            <th>ชื่ออำเภอ</th>
                            <th>จำนวนผู้ป่วย</th>
                            </thead>
                            <tbody>
                            <?php
                            $n=1;
                            foreach($r506_by_amp as $r){


                                echo "<tr><td>".$n."</td><td>".$r->amp_code."</td><td>".$r->distname."</td><td>".number_format($r->total)."</td>";
                                echo "</tr>";
                                $n++;   }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    <!--Start Row 3 -->
    <div class='row'>
            <div class='col col-lg-6' >
                <div class='panel panel-info'>
                <div class="panel-heading"> <span class='glyphicon glyphicon-th'></span>  โรคที่ต้องบันทึกพิกัดใน ช่วงทดสอบระบบ  </div>
                <div class='panel-body'>
                    <ul class="nav-list">
                         <li> DHF </li>
                         <li> Leptospirosis</li>
                         <li> Hand Foot Mouth Disease</li>
                         <li> Influenza</li>
                         <li> Pneumonia</li>
                         <li> Measles</li>
                         <li> ชาวต่างชาติรายงานทุก Case </li>

                    </ul>
                </div>
            </div>
                </div>
            <div class='col col-lg-6 pull-right' >
                <div class=' panel panel-success' >
                    <div class="panel-heading"> <span class='glyphicon glyphicon-record'></span>  จำนวนผู้ป่วยแยกรายอำเภอ</div>
                    <div class='panel-body'>
<div id="chart1"></div>
                    </div>
                </div>
            </div>
        </div>

 </div>
<script src="<?php echo base_url()?>assets/heighcharts/js/modules/exporting.js"></script>

<!--<script src="<?/*=base_url()*/?>assets/apps/js/chart.js"></script>-->
<script src="<?php echo base_url()?>assets/apps/js/page.index.js"></script>

<?php
//print_r($this->session->all_userdata());

/*foreach($r as $s){
    echo " Session_id : ".$s->session_id." ip :".$s->ip_address."<br>";
}*/
?>