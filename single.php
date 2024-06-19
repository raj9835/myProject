<?php
/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      28/08/2018
 *
 * @package Neve
 */

$container_class = apply_filters( 'neve_container_class_filter', 'container', 'single-post' );

get_header();

?>
<div class="wrap-title">
	<h2>LATEST <strong>BLOG POSTS</strong></h2>
</div>
	<div class="<?php echo esc_attr( $container_class ); ?> single-post-container">
		<div class="row">
			<?php do_action( 'neve_do_sidebar', 'single-post', 'left' ); ?>
			<article id="post-<?php echo esc_attr( get_the_ID() ); ?>"
					class="<?php echo esc_attr( join( ' ', get_post_class( 'nv-single-post-wrap col' ) ) ); ?>">
				<?php
				/**
				 *  Executes actions before the post content.
				 *
				 * @since 2.3.8
				 */
				do_action( 'neve_before_post_content' );

				// if ( have_posts() ) {
				// // 	while ( have_posts() ) {
				// // 		the_post();
				// // 		get_template_part( 'template-parts/content', 'single' );
				// // 	}
				// // } else {
				// // 	get_template_part( 'template-parts/content', 'none' );
				// // }
				?>
				
				<div class="blog-main">
					<div class="blog-ind">
						<div class='blog-date'><span class='day-post'><?php echo get_the_date('j'); ?></span><span class='mon-year'><?php echo get_the_date('M Y'); ?><span></div>
							<div class='blog-img-wrap'>
								<div class='blog-title'><?php echo get_the_title(); ?></div>
								<div class='blog-auth-wrap'>
								<div class='blog-auth'><label>Posted By:</label><div class="entry-author"><?php echo get_the_author(); ?></div></div>
									<div class='blog-cate'>
										<label>Category:</label>
											<?php
											echo the_category();
											?>
									</div>
									</div>
								</div>
							</div>
							<div class='blog-img'>
								<?php
								add_image_size( 'custom-size', 765, 400 );
								the_post_thumbnail( 'custom-size' );
								?>
							</div>
							<div class='blog-excerpt'>
								<?php echo get_the_content(); ?>
							</div>
							<div class='blog-readmore'>
							<?php echo do_shortcode('[addtoany]');?>
							</div>
							
					
				<?php
				/**
				 *  Executes actions after the post content.
				 *
				 * @since 2.3.8
				 */
				do_action( 'neve_after_post_content' );
				?>
			</article>
			<?php do_action( 'neve_do_sidebar', 'single-post', 'right' ); ?>
		</div>
	</div>
<?php
get_footer();
