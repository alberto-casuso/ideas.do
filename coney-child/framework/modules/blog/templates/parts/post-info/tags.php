<?php
$tags = get_the_tags();
?>
<?php if($tags) { ?>
<div class="qodef-tags-holder">
    <div class="qodef-tags">
       <span class="qodef-tag-text"><?php echo  esc_html__('Etiquetas:', 'coney');?></span> <?php the_tags('', ', ', ''); ?>
    </div>
</div>
<?php } ?>