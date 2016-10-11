	<div id='footer'>
		<div class='limit-perfection'>
			<?php if ( is_active_sidebar( 'perfection_footer_widget_location' ) ) : ?>
				<div id="header-sidebar" class="footer-sidebar widget-area" role="complementary">
					<?php dynamic_sidebar( 'perfection_footer_widget_location' ); ?>
				</div><!-- #primary-sidebar -->
			<?php endif; ?>
		</div>

		<div class='footer-scripts'>
			<?php wp_footer(); ?>
		</div>
	</div>
	</body>
</html>