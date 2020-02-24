<?php  if(isset($result_array) && !empty($result_array) ) { ?>
    <ul>
    <?php foreach ($result_array as $row) { ?>
        <li> <?php echo $row['name'] ?> </li>
    <?php } ?>
    </ul>
<?php } ?>