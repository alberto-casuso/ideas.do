<?php defined('ABSPATH') or die("No script kiddies please!");

global $post;
$all_comments_approved = WPCD_LITE_CLASS::parent_comment_counter($post_id);
$total = ceil($all_comments_approved / $items_per_page);
$pagination_type='page-number';
?>

<div class="wpcd-comment-pagination-wrapper wpcd-pagination-not-demo wpcd-<?php echo $pagination_type ?> ">
    <?php
        ?>
        <ul>
            <?php
            for ($i = 1; $i <= $total - 1; $i++) {
                ?>
                <li><a href="javascript:void(0);" data-total-page="<?php echo $total; ?>" id="wpcd-page-number" data-page-number="<?php echo $i; ?>" data-pagination-type="page-number" class= "<?php echo ($i == 1) ? 'wpcd-current-page' : ''; ?> wpcd-page-link" ><?php echo $i; ?></a></li>
                <?php
            }
            if ($total > 1) {
                ?>
                <li class="wpcd-next-page-wrap"><a href="javascript:void(0);" data-total-page="<?php echo $total; ?>" data-page-number="2" data-pagination-type= "page-number" class="wpcd-next-page" ><i class="fa fa-angle-right"></i></a></li>
            <?php } ?>
        </ul>
        <img src="<?php echo WPCD_LITE_PLUGIN_URL . 'img/ajax-loader.gif'?>" class="wpcd-page-number-loader" style="display:none;">
        <?php
    ?>
</div>