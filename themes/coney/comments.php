<?php if ( post_password_required() ) { ?>
    <p class="qodef-no-password"><?php esc_html_e( 'This post is password protected. Enter the password to view any comments.', 'coney' ); ?></p>
<?php } else { ?>
	<?php if ( have_comments() ) { ?>
        <div class="qodef-comment-holder clearfix" id="comments">
            <div class="qodef-comment-holder-inner">
                <div class="qodef-comments-title">
                    <h6><?php esc_html_e( 'COMMENTS', 'coney' ); ?></h6>
                </div>
                <div class="qodef-comments">
                    <ul class="qodef-comment-list">
						<?php wp_list_comments( array( 'callback' => 'coney_qodef_comment' ) ); ?>
                    </ul>
                </div>
            </div>
        </div>
	<?php } else { ?>
		<?php if ( ! comments_open() ) : ?>
            <p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'coney' ); ?></p>
		<?php endif; ?>
	<?php } ?>
<?php } ?>
<?php
$qodef_commenter = wp_get_current_commenter();
$qodef_req       = get_option( 'require_name_email' );
$qodef_aria_req  = ( $qodef_req ? " aria-required='true'" : '' );
$qodef_consent   = empty( $qodef_commenter['comment_author_email'] ) ? '' : ' checked="checked"';

$qodef_args = array(
	'id_form'              => 'commentform',
	'id_submit'            => 'submit_comment',
	'title_reply'          => esc_html__( 'Post a comment', 'coney' ),
	'title_reply_before'   => '<h6 id="reply-title" class="comment-reply-title">',
	'title_reply_after'    => '</h6>',
	'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'coney' ),
	'cancel_reply_link'    => esc_html__( 'cancel reply', 'coney' ),
	'label_submit'         => esc_html__( 'Send Comment', 'coney' ),
	'comment_field'        => '<div><label for="comment">' . esc_html__( 'Comment', 'coney' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>',
	'comment_notes_before' => '',
	'comment_notes_after'  => '',
	'fields'               => apply_filters( 'comment_form_default_fields', array(
		'author'  => '<div class="qodef-comment-author-holder"><label for="author">' . esc_html__( 'Name', 'coney' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $qodef_commenter['comment_author'] ) . '"' . $qodef_aria_req . ' /></div>',
		'email'   => '<div class="qodef-comment-email-holder"><label for="email">' . esc_html__( 'Email', 'coney' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr( $qodef_commenter['comment_author_email'] ) . '"' . $qodef_aria_req . ' /></div>',
		'url'     => '<div class="qodef-comment-url-holder"><label for="url">' . esc_html__( 'Website', 'coney' ) . '</label><input id="url" name="url" type="text" value="' . esc_attr( $qodef_commenter['comment_author_url'] ) . '"' . $qodef_aria_req . ' /></div>',
		'cookies' => '<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $qodef_consent . ' />' .
		             '<label for="wp-comment-cookies-consent">' . esc_html__( 'Save my name, email, and website in this browser for the next time I comment.', 'coney' ) . '</label></p>'
	) )
);
?>
<?php if ( get_comment_pages_count() > 1 ) { ?>
    <div class="qodef-comment-pager">
        <p><?php paginate_comments_links(); ?></p>
    </div>
<?php } ?>
<?php if ( comments_open() ) { ?>
    <div class="qodef-comment-form">
        <div class="qodef-comment-form-inner">
			<?php comment_form( $qodef_args ); ?>
        </div>
    </div>
<?php } ?>	