<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 14/10/2556
 * Time: 9:20 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<ul class="breadcrumb" xmlns="http://www.w3.org/1999/html">
    <li><a href="<?php echo site_url('/admin')?>">หน้าหลัก</a> </li>
    <li class="active">Admin</li>
</ul>

<div class="tab-content">

</div>
<div class="container">
    <table class="table">
        <thead>
            <th></th> <th></th> <th></th>
        </thead>
        <tbody>
            <tr>
                <td>จำนวนผู้ป่วยในแฟ้ม  Surveillance</td>
                <td><?php echo $surveillance;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วยในแฟ้ม  Epe0 ทั้งหมด </td>
                <td><?php echo $epe0;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วยในแฟ้ม  Epe0 ระดับอำเภอ </td>
                <td><?php echo $epe0_sso;?></td>
            </tr>
            <tr>
                <td>จำนวนผู้ป่วยในแฟ้ม  Epe0 ระดับจังหวัด </td>
                <td><?php echo $epe0_ssj;?></td>
            </tr>
        </tbody>
    </table>
</div>
<script src="<?php echo base_url()?>assets/apps/js/admin.index.js" charset="utf-8"></script>