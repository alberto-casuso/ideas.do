<div class="qodef-ps-image-holder">
    <div class="qodef-ps-image-inner">
        <?php
        $media = coney_qodef_get_portfolio_single_media();
    
        if(is_array($media) && count($media)) : ?>
            <?php foreach($media as $single_media) : ?>
                <div class="qodef-ps-image">
                    <?php coney_qodef_portfolio_get_media_html($single_media); ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
<div class="qodef-columns-wrapper qodef-content-columns-75-25 qodef-content-sidebar-right qodef-content-has-sidebar qodef-columns-normal-space">
    <div class="qodef-columns-inner">
        <div class="qodef-column-content qodef-column-content1">
            <?php coney_qodef_get_module_template_part('templates/single/parts/content', 'portfolio', $item_layout); ?>
        </div>
        <div class="qodef-column-content qodef-column-content2">
            <div class="qodef-ps-info-holder">
                <?php
                //get portfolio custom fields section
                coney_qodef_get_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
                
                //get portfolio categories section
                coney_qodef_get_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
                
                //get portfolio date section
                coney_qodef_get_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
                
                //get portfolio tags section
                coney_qodef_get_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
                
                //get portfolio share section
                coney_qodef_get_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
                ?>
            </div>
        </div>
    </div>
</div>