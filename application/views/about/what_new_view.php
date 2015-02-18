<?php
/**
 * Created by JetBrains PhpStorm.
 * User: spiderman
 * Date: 31/12/2556
 * Time: 12:15 น.
 * To change this template use File | Settings | File Templates.
 */
?>
<table class="table ">
    <thead>
    <tr>
        <th> Date</th>
        <th> Version</th>
        <th> What new</th>
        <th> Link</th>
        <th> Memo </th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach($what_new as $r) {
        echo '<tr><td>' . $r->create_date . '</td><td>'.$r->version. '</td><td>'. $r->what_new .'</td><td><a href="'. site_url($r->link) . '"><i class="glyphicon glyphicon-link"></i></a></td><td>'. $r->memo .'<td></tr>';
    } ?>
    </tbody>
</table>