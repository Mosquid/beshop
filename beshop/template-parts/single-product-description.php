<?php

$heading = get_query_var('description_heading');
$contents = get_query_var('description_content');

?>

<div class="description-block">
    <div class="heading"><?php echo $heading ?></div>
    <div class="contents"><p><?php echo $contents ?></p></div>
</div>
