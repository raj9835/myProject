<?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      04/09/2018
 *
 * @package Neve
 */

$container_class = apply_filters('neve_container_class_filter', 'container', 'blog-archive');

get_header();

echo do_shortcode( '[search]' );

$wrapper_classes = ['posts-wrapper'];
if (!neve_is_new_skin()) {
	$wrapper_classes[] = 'row';
}
$wrapper_classes = apply_filters('neve_posts_wrapper_class', $wrapper_classes);

?>
<div class="<?php echo esc_attr($container_class); ?> archive-container">
	<div class='row'>
		<?php do_action('neve_do_sidebar', 'blog-archive', 'left');
		?>
		<div class='nv-index-posts search col'>
			<?php
			do_action('neve_page_header', 'search');
			if (have_posts()) {
				while (have_posts()):
					the_post();

					
					?>
					<!-- banner -->
							<!-- <div class='blog-img'>
								<?php
								// add_image_size( 'custom-size', 765, 400 );
								// the_post_thumbnail( 'custom-size' );
								?>
							</div> -->
					<div class='blog-main'>
						<div class='blog-ind'>
							<div class='blog-date'><span class='day-post'>
									<?php echo get_the_date('j');
									?>
								</span><span class='mon-year'>
									<?php echo get_the_date('M Y');
									?><span></div>
							<div class='blog-img-wrap'>
								<div class='blog-title'><a href='<?php the_permalink(); ?>'><?php echo get_the_title();
								  ?></a></div>
								<div class='blog-auth-wrap'>
									<div class='blog-auth'><label>Posted By:</label>
										<div class='entry-author'>
											<?php echo get_the_author();
											?>
										</div>
									</div>
									<div class='blog-cate'><label>Category:</label>
										<?php
											echo the_category();
										?>
									</div>
								</div>
							</div>
						</div>
						<div class='blog-img'>
							<?php

							add_image_size('custom-size', 765, 400);
							the_post_thumbnail('custom-size');

							?>
						</div>
						<div class='blog-excerpt'>
							<?php echo get_the_excerpt();
							?>
						</div>
						<div class='blog-readmore'>
							<a href='<?php echo get_the_permalink(); ?>'>Read more</a>
						</div>
					</div>
					<?php
				endwhile;
				
			}
			else {
				echo 'No Results Found';
			}
			?>
			<div class='w-100'></div>
		</div>
		<?php do_action('neve_do_sidebar', 'blog-archive', 'right');
		?>
	</div>
</div>
<?php
get_footer();
