<div class="qodef-fullscreen-search-holder">
    <div class="qodef-fullscreen-search-close-container">
        <div class="qodef-search-close-holder">
            <a class="qodef-fullscreen-search-close" href="javascript:void(0)">
                <span class="icon_close"></span>
            </a>
        </div>
    </div>
    <div class="qodef-fullscreen-search-table">
        <div class="qodef-fullscreen-search-cell">
            <div class="qodef-fullscreen-search-inner">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="qodef-fullscreen-search-form" method="get">
                    <div class="qodef-form-holder">
                        <div class="qodef-form-holder-inner">
                            <div class="qodef-field-holder">
                                <input type="text" placeholder="<?php esc_attr_e( 'Buscar por...', 'coney' ); ?>" name="s" class="qodef-search-field" autocomplete="off"/>
                            </div>
                            <button type="submit" class="qodef-search-submit"><span class="icon_search "></span>
                            </button>
                            <div class="qodef-line"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>