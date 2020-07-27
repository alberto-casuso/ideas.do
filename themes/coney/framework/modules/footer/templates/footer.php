<?php coney_qodef_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer) { ?>
			<footer class="qodef-page-footer">
				<?php
					if($display_footer_top) {
                        coney_qodef_get_footer_top();
					}
					if($display_footer_bottom) {
						coney_qodef_get_footer_bottom();
					}
				?>
			</footer>
		<?php } else { ?>
			<?php wp_footer(); ?>
		<?php } ?>
	</div> <!-- close div.qodef-wrapper-inner  -->
</div> <!-- close div.qodef-wrapper -->
<?php wp_footer(); ?>
</body>
</html>