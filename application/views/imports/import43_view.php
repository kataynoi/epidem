<ul class="breadcrumb">
    <li><a href="<?php echo site_url()?>">หน้าหลัก</a></li>
    <li><a href="<?php echo site_url('imports')?>">นำเข้าข้อมูล</a></li>
    <li class="active">นำเข้าข้อมูล</li>
</ul>

<h3>Your file was successfully uploaded!</h3>

<ul>
    <?php foreach (@$upload_data as $item => $value):?>
        <li><?php echo @$item;?>: <?php echo @$value;?></li>
    <?php endforeach; ?>
</ul>

<p><?php echo anchor('imports', 'Upload Another File!'); ?></p>

</body>
