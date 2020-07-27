<li>
    <?php if($month_has_posts){ ?>
    <a href="<?php echo esc_url(home_url() . '/' . $year . '/' . $month); ?>">
    <?php } ?>
        <span class='qodef-archive-month'>
            <?php echo esc_html($month_name); ?>
        </span>
    <?php if($month_has_posts){ ?>
    </a>
    <?php } ?>
</li>