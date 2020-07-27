<section class="qodef-side-menu">
	<div class="qodef-close-side-menu-holder">
		<a class="qodef-close-side-menu" href="#" target="_self">
			<i class="fa fa-times" aria-hidden="true"></i>
		</a>
	</div>
	<?php if(is_active_sidebar('sidearea')) {
		dynamic_sidebar('sidearea');
	} ?>
</section>