<?php

/*
   Class: ConeyQodefMultipleImages
   A class that initializes Qode Multiple Images
*/

class ConeyQodefMultipleImages implements iConeyQodefRender {
	private $name;
	private $label;
	private $description;

	function __construct( $name, $label = "", $description = "" ) {
		global $coney_qodef_Framework;
		$this->name        = $name;
		$this->label       = $label;
		$this->description = $description;
		$coney_qodef_Framework->qodeMetaBoxes->addOption( $this->name, "" );
	}

	public function render( $factory ) {
		global $post;
		?>

        <div class="qodef-page-form-section">
            <div class="qodef-field-desc">
                <h4><?php echo esc_html( $this->label ); ?></h4>
                <p><?php echo esc_html( $this->description ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="qode-gallery-images-holder clearfix">
								<?php
								$image_gallery_val = get_post_meta( $post->ID, $this->name, true );
								if ( $image_gallery_val != '' ) {
									$image_gallery_array = explode( ',', $image_gallery_val );
								}

								if ( isset( $image_gallery_array ) && is_array($image_gallery_array) && count( $image_gallery_array ) != 0 ):
									foreach ( $image_gallery_array as $gimg_id ):
										$gimage_wp = wp_get_attachment_image_src( $gimg_id, 'thumbnail', true );
										echo '<li class="qode-gallery-image-holder"><img src="' . esc_url( $gimage_wp[0] ) . '"/></li>';
									endforeach;
								endif;
								?>
                            </ul>
                            <input type="hidden" value="<?php echo esc_attr( $image_gallery_val ); ?>" id="<?php echo esc_attr( $this->name ) ?>" name="<?php echo esc_attr( $this->name ) ?>">
                            <div class="qodef-gallery-uploader">
                                <a class="qodef-gallery-upload-btn btn btn-sm btn-primary" href="javascript:void(0)"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                <a class="qodef-gallery-clear-btn btn btn-sm btn-default pull-right" href="javascript:void(0)"><?php esc_html_e( 'Remove All', 'coney' ); ?></a>
                            </div>
                            <?php wp_nonce_field( 'coney-qode-update-images_' . esc_attr($this->name), 'coney-qode-update-images_' . esc_attr($this->name) ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
	}
}

/*
   Class: ConeyQodefImagesVideos
   A class that initializes Qode Images Videos
*/

class ConeyQodefImagesVideos implements iConeyQodefRender {
	private $label;
	private $description;

	function __construct( $label = "", $description = "" ) {
		$this->label       = $label;
		$this->description = $description;
	}

	public function render( $factory ) {
		global $post;
		?>

        <div class="qodef_hidden_portfolio_images" style="display: none">
            <div class="qodef-page-form-section">
                <div class="qodef-field-desc">
                    <h4><?php echo esc_html( $this->label ); ?></h4>
                    <p><?php echo esc_html( $this->description ); ?></p>
                </div>
                <div class="qodef-section-content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-2">
                                <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                <input type="text" class="form-control qodef-input qodef-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x"/>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-12">
                                <em class="qodef-field-description"><?php esc_html_e( 'Image', 'coney' ); ?></em>
                                <div class="qodef-media-uploader">
                                    <div style="display: none" class="qodef-media-image-holder">
                                        <img src="" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail"/>
                                    </div>
                                    <div style="display: none" class="qodef-media-meta-fields">
                                        <input type="hidden" class="qodef-media-upload-url" name="portfolioimg_x" id="portfolioimg_x"/>
                                        <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value=""/>
                                        <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value=""/>
                                    </div>
                                    <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                    <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-3">
                                <em class="qodef-field-description"><?php esc_html_e( 'Video Type', 'coney' ); ?></em>
                                <select class="form-control qodef-form-element qodef-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
                                    <option value=""></option>
                                    <option value="youtube"><?php esc_html_e( 'Youtube', 'coney' ); ?></option>
                                    <option value="vimeo"><?php esc_html_e( 'Vimeo', 'coney' ); ?></option>
                                    <option value="self"><?php esc_html_e( 'Self hosted', 'coney' ); ?></option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <em class="qodef-field-description"><?php esc_html_e( 'Video ID', 'coney' ); ?></em>
                                <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x"/>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-12">
                                <em class="qodef-field-description"><?php esc_html_e( 'Video image', 'coney' ); ?></em>
                                <div class="qodef-media-uploader">
                                    <div style="display: none" class="qodef-media-image-holder">
                                        <img src="" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail"/>
                                    </div>
                                    <div style="display: none" class="qodef-media-meta-fields">
                                        <input type="hidden" class="qodef-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x"/>
                                        <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value=""/>
                                        <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value=""/>
                                    </div>
                                    <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                    <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-4">
                                <em class="qodef-field-description"><?php esc_html_e( 'Video mp4', 'coney' ); ?></em>
                                <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x"/>
                            </div>
                        </div>
                        <div class="row next-row">
                            <div class="col-lg-12">
                                <a class="qodef_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e( 'Remove portfolio image/video', 'coney' ); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php
		$no               = 1;
		$portfolio_images = get_post_meta( $post->ID, 'qode_portfolio_images', true );
		if ( is_array($portfolio_images) && count( $portfolio_images ) > 1 ) {
			usort( $portfolio_images, "coney_qodef_compare_portfolio_videos" );
		}
		while ( isset( $portfolio_images[ $no - 1 ] ) ) {
			$portfolio_image = $portfolio_images[ $no - 1 ];
			?>

            <div class="qodef_portfolio_image" rel="<?php echo esc_attr( $no ); ?>" style="display: block;">
                <div class="qodef-page-form-section">
                    <div class="qodef-field-desc">
                        <h4><?php echo esc_html( $this->label ); ?></h4>
                        <p><?php echo esc_html( $this->description ); ?></p>
                    </div>
                    <div class="qodef-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfolioimgordernumber_<?php echo esc_attr( $no ); ?>" name="portfolioimgordernumber[]" value="<?php echo isset( $portfolio_image['portfolioimgordernumber'] ) ? esc_attr( stripslashes( $portfolio_image['portfolioimgordernumber'] ) ) : ""; ?>"/>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Image', 'coney' ); ?></em>
                                    <div class="qodef-media-uploader">
                                        <div<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == false ) { ?> style="display: none"<?php } ?> class="qodef-media-image-holder">
                                            <img src="<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == true ) {
												echo esc_url( coney_qodef_get_attachment_thumb_url( stripslashes( $portfolio_image['portfolioimg'] ) ) );
											} ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail"/>
                                        </div>
                                        <div style="display: none" class="qodef-media-meta-fields">
                                            <input type="hidden" class="qodef-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfolioimg'] ); ?>"/>
                                            <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value=""/>
                                            <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value=""/>
                                        </div>
                                        <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                        <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-3">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Video Type', 'coney' ); ?></em>
                                    <select class="form-control qodef-form-element qodef-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr( $no ); ?>">
                                        <option value=""></option>
                                        <option <?php if ( $portfolio_image['portfoliovideotype'] == "youtube" ) {
											echo "selected='selected'";
										} ?> value="youtube">Youtube
                                        </option>
                                        <option <?php if ( $portfolio_image['portfoliovideotype'] == "vimeo" ) {
											echo "selected='selected'";
										} ?> value="vimeo">Vimeo
                                        </option>
                                        <option <?php if ( $portfolio_image['portfoliovideotype'] == "self" ) {
											echo "selected='selected'";
										} ?> value="self">Self hosted
                                        </option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Video ID', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideoid_<?php echo esc_attr( $no ); ?>" name="portfoliovideoid[]" value="<?php echo isset( $portfolio_image['portfoliovideoid'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideoid'] ) ) : ""; ?>"/>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Video image', 'coney' ); ?></em>
                                    <div class="qodef-media-uploader">
                                        <div<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == false ) { ?> style="display: none"<?php } ?> class="qodef-media-image-holder">
                                            <img src="<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == true ) {
												echo esc_url( coney_qodef_get_attachment_thumb_url( stripslashes( $portfolio_image['portfoliovideoimage'] ) ) );
											} ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail"/>
                                        </div>
                                        <div style="display: none" class="qodef-media-meta-fields">
                                            <input type="hidden" class="qodef-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfoliovideoimage'] ); ?>"/>
                                            <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value=""/>
                                            <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value=""/>
                                        </div>
                                        <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                        <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-4">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Video mp4', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideomp4_<?php echo esc_attr( $no ); ?>" name="portfoliovideomp4[]" value="<?php echo isset( $portfolio_image['portfoliovideomp4'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideomp4'] ) ) : ""; ?>"/>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <a class="qodef_remove_image btn btn-sm btn-primary" href="/" onclick="javascript: return false;"><?php esc_html_e( 'Remove portfolio image/video', 'coney' ); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			$no ++;
		}
		?>
        <br/>
        <a class="qodef_add_image btn btn-sm btn-primary" onclick="javascript: return false;" href="/"><?php esc_html_e( 'Add portfolio image/video', 'coney' ); ?></a>
		<?php
	}
}

/*
   Class: ConeyQodefImagesVideos
   A class that initializes Qode Images Videos
*/

class ConeyQodefImagesVideosFramework implements iConeyQodefRender {
	private $label;
	private $description;

	function __construct( $label = "", $description = "" ) {
		$this->label       = $label;
		$this->description = $description;
	}

	public function render( $factory ) {
		global $post;
		?>

        <div class="qodef-hidden-portfolio-images" style="display: none">
            <div class="qodef-portfolio-toggle-holder">
                <div class="qodef-portfolio-toggle qodef-toggle-desc">
                    <span class="number">1</span><span class="qodef-toggle-inner"><?php esc_html_e( 'Image - ', 'coney' ); ?><em><?php esc_html_e( 'Order Number', 'coney' ); ?></em></span>
                </div>
                <div class="qodef-portfolio-toggle qodef-portfolio-control">
                    <span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
                    <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="qodef-portfolio-toggle-content">
                <div class="qodef-page-form-section">
                    <div class="qodef-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="qodef-media-uploader">
                                        <em class="qodef-field-description"><?php esc_html_e( 'Image', 'coney' ); ?></em>
                                        <div style="display: none" class="qodef-media-image-holder">
                                            <img src="" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail">
                                        </div>
                                        <div class="qodef-media-meta-fields">
                                            <input type="hidden" class="qodef-media-upload-url" name="portfolioimg_x" id="portfolioimg_x">
                                            <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value="">
                                            <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value="">
                                        </div>
                                        <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                        <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
                                </div>
                            </div>
                            <input type="hidden" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
                            <input type="hidden" name="portfoliovideotype_x" id="portfoliovideotype_x">
                            <input type="hidden" name="portfoliovideoid_x" id="portfoliovideoid_x">
                            <input type="hidden" name="portfoliovideomp4_x" id="portfoliovideomp4_x">
                            <input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="qodef-hidden-portfolio-videos" style="display: none">
            <div class="qodef-portfolio-toggle-holder">
                <div class="qodef-portfolio-toggle qodef-toggle-desc">
                    <span class="number">2</span><span class="qodef-toggle-inner"><?php esc_html_e( 'Video - ', 'coney' ); ?><em><?php esc_html_e( 'Order Number', 'coney' ); ?></em></span>
                </div>
                <div class="qodef-portfolio-toggle qodef-portfolio-control">
                    <span class="toggle-portfolio-media"><i class="fa fa-caret-up"></i></span>
                    <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="qodef-portfolio-toggle-content">
                <div class="qodef-page-form-section">
                    <div class="qodef-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="qodef-media-uploader">
                                        <em class="qodef-field-description"><?php esc_html_e( 'Cover Video Image', 'coney' ); ?></em>
                                        <div style="display: none" class="qodef-media-image-holder">
                                            <img src="" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail">
                                        </div>
                                        <div style="display: none" class="qodef-media-meta-fields">
                                            <input type="hidden" class="qodef-media-upload-url" name="portfoliovideoimage_x" id="portfoliovideoimage_x">
                                            <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value="">
                                            <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value="">
                                        </div>
                                        <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                        <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                            <input type="text" class="form-control qodef-input qodef-form-element" id="portfolioimgordernumber_x" name="portfolioimgordernumber_x">
                                        </div>
                                    </div>
                                    <div class="row next-row">
                                        <div class="col-lg-2">
                                            <em class="qodef-field-description"><?php esc_html_e( 'Video Type', 'coney' ); ?></em>
                                            <select class="form-control qodef-form-element qodef-portfoliovideotype" name="portfoliovideotype_x" id="portfoliovideotype_x">
                                                <option value=""></option>
                                                <option value="youtube"><?php esc_html_e( 'Youtube', 'coney' ); ?></option>
                                                <option value="vimeo"><?php esc_html_e( 'Vimeo', 'coney' ); ?></option>
                                                <option value="self"><?php esc_html_e( 'Self hosted', 'coney' ); ?></option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 qodef-video-id-holder">
                                            <em class="qodef-field-description" id="videoId"><?php esc_html_e( 'Video ID', 'coney' ); ?></em>
                                            <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideoid_x" name="portfoliovideoid_x">
                                        </div>
                                    </div>
                                    <div class="row next-row qodef-video-self-hosted-path-holder">
                                        <div class="col-lg-4">
                                            <em class="qodef-field-description"><?php esc_html_e( 'Video mp4', 'coney' ); ?></em>
                                            <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideomp4_x" name="portfoliovideomp4_x">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="portfolioimg_x" id="portfolioimg_x">
                            <input type="hidden" name="portfolioimgtype_x" id="portfolioimgtype_x" value="video">
                        </div>
                    </div>
                </div>
            </div>
        </div>

		<?php
		$no               = 1;
		$portfolio_images = get_post_meta( $post->ID, 'qode_portfolio_images', true );
		if ( is_array($portfolio_images) && count( $portfolio_images ) > 1 ) {
			usort( $portfolio_images, "coney_qodef_compare_portfolio_videos" );
		}
		while ( isset( $portfolio_images[ $no - 1 ] ) ) {
			$portfolio_image = $portfolio_images[ $no - 1 ];
			if ( isset( $portfolio_image['portfolioimgtype'] ) ) {
				$portfolio_img_type = $portfolio_image['portfolioimgtype'];
			} else {
				if ( stripslashes( $portfolio_image['portfolioimg'] ) == true ) {
					$portfolio_img_type = "image";
				} else {
					$portfolio_img_type = "video";
				}
			}
			if ( $portfolio_img_type == "image" ) {
				?>

                <div class="qodef-portfolio-images qodef-portfolio-media" rel="<?php echo esc_attr( $no ); ?>">
                    <div class="qodef-portfolio-toggle-holder">
                        <div class="qodef-portfolio-toggle qodef-toggle-desc">
                            <span class="number"><?php echo esc_html( $no ); ?></span><span class="qodef-toggle-inner"><?php esc_html_e( 'Image - ', 'coney' ); ?><em><?php echo stripslashes( $portfolio_image['portfolioimgordernumber'] ); ?></em></span>
                        </div>
                        <div class="qodef-portfolio-toggle qodef-portfolio-control">
                            <a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
                            <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="qodef-portfolio-toggle-content" style="display: none">
                        <div class="qodef-page-form-section">
                            <div class="qodef-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="qodef-media-uploader">
                                                <em class="qodef-field-description"><?php esc_html_e( 'Image', 'coney' ); ?></em>
                                                <div<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == false ) { ?> style="display: none"<?php } ?> class="qodef-media-image-holder">
                                                    <img src="<?php if ( stripslashes( $portfolio_image['portfolioimg'] ) == true ) {
														echo esc_url( coney_qodef_get_attachment_thumb_url( stripslashes( $portfolio_image['portfolioimg'] ) ) );
													} ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail"/>
                                                </div>
                                                <div style="display: none" class="qodef-media-meta-fields">
                                                    <input type="hidden" class="qodef-media-upload-url" name="portfolioimg[]" id="portfolioimg_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfolioimg'] ); ?>"/>
                                                    <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value=""/>
                                                    <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value=""/>
                                                </div>
                                                <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                                <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                            <input type="text" class="form-control qodef-input qodef-form-element" id="portfolioimgordernumber_<?php echo esc_attr( $no ); ?>" name="portfolioimgordernumber[]" value="<?php echo isset( $portfolio_image['portfolioimgordernumber'] ) ? esc_attr( stripslashes( $portfolio_image['portfolioimgordernumber'] ) ) : ""; ?>">
                                        </div>
                                    </div>
                                    <input type="hidden" id="portfoliovideoimage_<?php echo esc_attr( $no ); ?>" name="portfoliovideoimage[]">
                                    <input type="hidden" id="portfoliovideotype_<?php echo esc_attr( $no ); ?>" name="portfoliovideotype[]">
                                    <input type="hidden" id="portfoliovideoid_<?php echo esc_attr( $no ); ?>" name="portfoliovideoid[]">
                                    <input type="hidden" id="portfoliovideomp4_<?php echo esc_attr( $no ); ?>" name="portfoliovideomp4[]">
                                    <input type="hidden" id="portfolioimgtype_<?php echo esc_attr( $no ); ?>" name="portfolioimgtype[]" value="image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			} else {
				?>
                <div class="qodef-portfolio-videos qodef-portfolio-media" rel="<?php echo esc_attr( $no ); ?>">
                    <div class="qodef-portfolio-toggle-holder">
                        <div class="qodef-portfolio-toggle qodef-toggle-desc">
                            <span class="number"><?php echo esc_html( $no ); ?></span><span class="qodef-toggle-inner"><?php esc_html_e( 'Video - ', 'coney' ); ?><em><?php echo stripslashes( $portfolio_image['portfolioimgordernumber'] ); ?></em></span>
                        </div>
                        <div class="qodef-portfolio-toggle qodef-portfolio-control">
                            <a href="#" class="toggle-portfolio-media"><i class="fa fa-caret-down"></i></a>
                            <a href="#" class="remove-portfolio-media"><i class="fa fa-times"></i></a>
                        </div>
                    </div>
                    <div class="qodef-portfolio-toggle-content" style="display: none">
                        <div class="qodef-page-form-section">
                            <div class="qodef-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <div class="qodef-media-uploader">
                                                <em class="qodef-field-description"><?php esc_html_e( 'Cover Video Image', 'coney' ); ?></em>
                                                <div<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == false ) { ?> style="display: none"<?php } ?> class="qodef-media-image-holder">
                                                    <img src="<?php if ( stripslashes( $portfolio_image['portfoliovideoimage'] ) == true ) {
														echo esc_url( coney_qodef_get_attachment_thumb_url( stripslashes( $portfolio_image['portfoliovideoimage'] ) ) );
													} ?>" alt="<?php esc_attr_e( 'Image thumbnail', 'coney' ); ?>" class="qodef-media-image img-thumbnail"/>
                                                </div>
                                                <div style="display: none" class="qodef-media-meta-fields">
                                                    <input type="hidden" class="qodef-media-upload-url" name="portfoliovideoimage[]" id="portfoliovideoimage_<?php echo esc_attr( $no ); ?>" value="<?php echo stripslashes( $portfolio_image['portfoliovideoimage'] ); ?>"/>
                                                    <input type="hidden" class="qodef-media-upload-height" name="qode_options_theme[media-upload][height]" value=""/>
                                                    <input type="hidden" class="qodef-media-upload-width" name="qode_options_theme[media-upload][width]" value=""/>
                                                </div>
                                                <a class="qodef-media-upload-btn btn btn-sm btn-primary" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'coney' ); ?>" data-frame-button-text="<?php esc_html_e( 'Select Image', 'coney' ); ?>"><?php esc_html_e( 'Upload', 'coney' ); ?></a>
                                                <a style="display: none;" href="javascript: void(0)" class="qodef-media-remove-btn btn btn-default btn-sm"><?php esc_html_e( 'Remove', 'coney' ); ?></a>
                                            </div>
                                        </div>
                                        <div class="col-lg-10">
                                            <div class="row">
                                                <div class="col-lg-2">
                                                    <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfolioimgordernumber_<?php echo esc_attr( $no ); ?>" name="portfolioimgordernumber[]" value="<?php echo isset( $portfolio_image['portfolioimgordernumber'] ) ? esc_attr( stripslashes( $portfolio_image['portfolioimgordernumber'] ) ) : ""; ?>">
                                                </div>
                                            </div>
                                            <div class="row next-row">
                                                <div class="col-lg-2">
                                                    <em class="qodef-field-description"><?php esc_html_e( 'Video Type', 'coney' ); ?></em>
                                                    <select class="form-control qodef-form-element qodef-portfoliovideotype" name="portfoliovideotype[]" id="portfoliovideotype_<?php echo esc_attr( $no ); ?>">
                                                        <option value=""></option>
                                                        <option <?php if ( $portfolio_image['portfoliovideotype'] == "youtube" ) {
															echo "selected='selected'";
														} ?> value="youtube">Youtube
                                                        </option>
                                                        <option <?php if ( $portfolio_image['portfoliovideotype'] == "vimeo" ) {
															echo "selected='selected'";
														} ?> value="vimeo">Vimeo
                                                        </option>
                                                        <option <?php if ( $portfolio_image['portfoliovideotype'] == "self" ) {
															echo "selected='selected'";
														} ?> value="self">Self hosted
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 qodef-video-id-holder">
                                                    <em class="qodef-field-description"><?php esc_html_e( 'Video ID', 'coney' ); ?></em>
                                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideoid_<?php echo esc_attr( $no ); ?>" name="portfoliovideoid[]" value="<?php echo isset( $portfolio_image['portfoliovideoid'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideoid'] ) ) : ""; ?>"/>
                                                </div>
                                            </div>
                                            <div class="row next-row qodef-video-self-hosted-path-holder">
                                                <div class="col-lg-4">
                                                    <em class="qodef-field-description"><?php esc_html_e( 'Video mp4', 'coney' ); ?></em>
                                                    <input type="text" class="form-control qodef-input qodef-form-element" id="portfoliovideomp4_<?php echo esc_attr( $no ); ?>" name="portfoliovideomp4[]" value="<?php echo isset( $portfolio_image['portfoliovideomp4'] ) ? esc_attr( stripslashes( $portfolio_image['portfoliovideomp4'] ) ) : ""; ?>"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" id="portfolioimg_<?php echo esc_attr( $no ); ?>" name="portfolioimg[]">
                                    <input type="hidden" id="portfolioimgtype_<?php echo esc_attr( $no ); ?>" name="portfolioimgtype[]" value="video">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			}
			$no ++;
		}
		?>

        <div class="qodef-portfolio-add">
            <a class="qodef-add-image btn btn-sm btn-primary" href="#"><i class="fa fa-camera"></i><?php esc_html_e( 'Add Image', 'coney' ); ?>
            </a>
            <a class="qodef-add-video btn btn-sm btn-primary" href="#"><i class="fa fa-video-camera"></i><?php esc_html_e( 'Add Video', 'coney' ); ?>
            </a>
            <a class="qodef-toggle-all-media btn btn-sm btn-default pull-right" href="#"><?php esc_html_e( 'Expand All', 'coney' ); ?></a>
        </div>
		<?php
	}
}

class ConeyQodefTwitterFramework implements iConeyQodefRender {
	public function render( $factory ) {
		$twitterApi = QodefTwitterApi::getInstance();
		$message    = '';

		if ( ! empty( $_GET['oauth_token'] ) && ! empty( $_GET['oauth_verifier'] ) ) {
			if ( ! empty( $_GET['oauth_token'] ) ) {
				update_option( $twitterApi::AUTHORIZE_TOKEN_FIELD, $_GET['oauth_token'] );
			}

			if ( ! empty( $_GET['oauth_verifier'] ) ) {
				update_option( $twitterApi::AUTHORIZE_VERIFIER_FIELD, $_GET['oauth_verifier'] );
			}

			$responseObj = $twitterApi->obtainAccessToken();
			if ( $responseObj->status ) {
				$message = esc_html__( 'You have successfully connected with your Twitter account. If you have any issues fetching data from Twitter try reconnecting.', 'coney' );
			} else {
				$message = $responseObj->message;
			}
		}

		$buttonText = $twitterApi->hasUserConnected() ? esc_html__( 'Re-connect with Twitter', 'coney' ) : esc_html__( 'Connect with Twitter', 'coney' );
		?>
		<?php if ( $message !== '' ) { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html( $message ); ?></span>
            </div>
		<?php } ?>
        <div class="qodef-page-form-section" id="qodef_enable_social_share">
            <div class="qodef-field-desc">
                <h4><?php esc_html_e( 'Connect with Twitter', 'coney' ); ?></h4>
                <p><?php esc_html_e( 'Connecting with Twitter will enable you to show your latest tweets on your site', 'coney' ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a id="qodef-tw-request-token-btn" class="btn btn-primary" href="#"><?php echo esc_html( $buttonText ); ?></a>
                            <input type="hidden" data-name="current-page-url" value="<?php echo esc_url( $twitterApi->buildCurrentPageURI() ); ?>"/>
                            <?php wp_nonce_field( 'qodef_twitter_connect_nonce', 'qodef_twitter_connect_nonce' ); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php }
}

class ConeyQodefInstagramFramework implements iConeyQodefRender {
	public function render( $factory ) {
		$instagram_api = QodefInstagramApi::getInstance();
		$message       = '';

		//if code wasn't saved to database
		if ( ! get_option( 'qodef_instagram_code' ) ) {
			//check if code parameter is set in URL. That means that user has connected with Instagram
			if ( ! empty( $_GET['code'] ) ) {
				//update code option so we can use it later
				$instagram_api->storeCode();
				$instagram_api->getAccessToken();
				$message = esc_html__( 'You have successfully connected with your Instagram account. If you have any issues fetching data from Instagram try reconnecting.', 'coney' );

			} else {
				$instagram_api->storeCodeRequestURI();
			}
		}

		$buttonText = $instagram_api->hasUserConnected() ? esc_html__( 'Re-connect with Instagram', 'coney' ) : esc_html__( 'Connect with Instagram', 'coney' );

		?>
		<?php if ( $message !== '' ) { ?>
            <div class="alert alert-success" style="margin-top: 20px;">
                <span><?php echo esc_html( $message ); ?></span>
            </div>
		<?php } ?>
        <div class="qodef-page-form-section" id="qodef_enable_social_share">
            <div class="qodef-field-desc">
                <h4><?php esc_html_e( 'Connect with Instagram', 'coney' ); ?></h4>
                <p><?php esc_html_e( 'Connecting with Instagram will enable you to show your latest photos on your site', 'coney' ); ?></p>
            </div>
            <div class="qodef-section-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-primary" href="<?php echo esc_url( $instagram_api->getAuthorizeUrl() ); ?>"><?php echo esc_html( $buttonText ); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	<?php }
}

/*
   Class: ConeyQodefImagesVideos
   A class that initializes Qode Images Videos
*/

class ConeyQodefOptionsFramework implements iConeyQodefRender {
	private $label;
	private $description;


	function __construct( $label = "", $description = "" ) {
		$this->label       = $label;
		$this->description = $description;
	}

	public function render( $factory ) {
		global $post;
		?>

        <div class="qodef-portfolio-additional-item-holder" style="display: none">
            <div class="qodef-portfolio-toggle-holder">
                <div class="qodef-portfolio-toggle qodef-toggle-desc">
                    <span class="number">1</span><span class="qodef-toggle-inner"><?php esc_html_e( 'Additional Sidebar Item ', 'coney' ); ?><em><?php esc_html_e( '(Order Number, Item Title)', 'coney' ); ?></em></span>
                </div>
                <div class="qodef-portfolio-toggle qodef-portfolio-control">
                    <span class="toggle-portfolio-item"><i class="fa fa-caret-up"></i></span>
                    <a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <div class="qodef-portfolio-toggle-content">
                <div class="qodef-page-form-section">
                    <div class="qodef-section-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-2">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="optionlabelordernumber_x" name="optionlabelordernumber_x">
                                </div>
                                <div class="col-lg-10">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Item Title', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="optionLabel_x" name="optionLabel_x">
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Item Text', 'coney' ); ?></em>
                                    <textarea class="form-control qodef-input qodef-form-element" id="optionValue_x" name="optionValue_x"></textarea>
                                </div>
                            </div>
                            <div class="row next-row">
                                <div class="col-lg-12">
                                    <em class="qodef-field-description"><?php esc_html_e( 'Enter Full URL for Item Text Link', 'coney' ); ?></em>
                                    <input type="text" class="form-control qodef-input qodef-form-element" id="optionUrl_x" name="optionUrl_x">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<?php
		$no         = 1;
		$portfolios = get_post_meta( $post->ID, 'qode_portfolios', true );
		if ( is_array($portfolios) && count( $portfolios ) > 1 ) {
			usort( $portfolios, "coney_qodef_compare_portfolio_options" );
		}
		while ( isset( $portfolios[ $no - 1 ] ) ) {
			$portfolio = $portfolios[ $no - 1 ];
			?>
            <div class="qodef-portfolio-additional-item" rel="<?php echo esc_attr( $no ); ?>">
                <div class="qodef-portfolio-toggle-holder">
                    <div class="qodef-portfolio-toggle qodef-toggle-desc">
                        <span class="number"><?php echo esc_html( $no ); ?></span><span class="qodef-toggle-inner"><?php esc_html_e( 'Additional Sidebar Item - ', 'coney' ); ?><em>(<?php echo stripslashes( $portfolio['optionlabelordernumber'] ); ?>, <?php echo stripslashes( $portfolio['optionLabel'] ); ?>)</em></span>
                    </div>
                    <div class="qodef-portfolio-toggle qodef-portfolio-control">
                        <span class="toggle-portfolio-item"><i class="fa fa-caret-down"></i></span>
                        <a href="#" class="remove-portfolio-item"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="qodef-portfolio-toggle-content" style="display: none">
                    <div class="qodef-page-form-section">
                        <div class="qodef-section-content">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <em class="qodef-field-description"><?php esc_html_e( 'Order Number', 'coney' ); ?></em>
                                        <input type="text" class="form-control qodef-input qodef-form-element" id="optionlabelordernumber_<?php echo esc_attr( $no ); ?>" name="optionlabelordernumber[]" value="<?php echo isset( $portfolio['optionlabelordernumber'] ) ? esc_attr( stripslashes( $portfolio['optionlabelordernumber'] ) ) : ""; ?>">
                                    </div>
                                    <div class="col-lg-10">
                                        <em class="qodef-field-description"><?php esc_html_e( 'Item Title', 'coney' ); ?></em>
                                        <input type="text" class="form-control qodef-input qodef-form-element" id="optionLabel_<?php echo esc_attr( $no ); ?>" name="optionLabel[]" value="<?php echo esc_attr( stripslashes( $portfolio['optionLabel'] ) ); ?>">
                                    </div>
                                </div>
                                <div class="row next-row">
                                    <div class="col-lg-12">
                                        <em class="qodef-field-description"><?php esc_html_e( 'Item Text', 'coney' ); ?></em>
                                        <textarea class="form-control qodef-input qodef-form-element" id="optionValue_<?php echo esc_attr( $no ); ?>" name="optionValue[]"><?php echo esc_attr( stripslashes( $portfolio['optionValue'] ) ); ?></textarea>
                                    </div>
                                </div>
                                <div class="row next-row">
                                    <div class="col-lg-12">
                                        <em class="qodef-field-description"><?php esc_html_e( 'Enter Full URL for Item Text Link', 'coney' ); ?></em>
                                        <input type="text" class="form-control qodef-input qodef-form-element" id="optionUrl_<?php echo esc_attr( $no ); ?>" name="optionUrl[]" value="<?php echo stripslashes( $portfolio['optionUrl'] ); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
			$no ++;
		}
		?>

        <div class="qodef-portfolio-add">
            <a class="qodef-add-item btn btn-sm btn-primary" href="#"><?php esc_html_e( 'Add New Item', 'coney' ); ?></a>
            <a class="qodef-toggle-all-item btn btn-sm btn-default pull-right" href="#"><?php esc_html_e( 'Expand All', 'coney' ); ?></a>
        </div>
		<?php
	}
}