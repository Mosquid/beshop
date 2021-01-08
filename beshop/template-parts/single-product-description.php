<?php

$heading = get_query_var('description_heading');
$contents = get_query_var('description_content');

?>

<div class="description-block">
    <?php if ($heading) : ?>
        <div class="heading"><?php echo $heading ?></div>
    <?php endif; ?>
    <?php if ($contents) : ?>
        <div class="contents"><p><?php echo $contents ?></p></div>
    <?php endif; ?>
</div>
